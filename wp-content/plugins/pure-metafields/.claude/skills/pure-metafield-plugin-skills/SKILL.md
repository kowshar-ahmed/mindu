---
name: pure-metafield-plugin-skills
description: Patterns, conventions, and hard-won bug fixes for working with (or building extensions against) the ThemePure pure-metafields WordPress plugin. Trigger when the user mentions pure-metafields, tpmeta_, TPMeta_, the options framework, the visual builder, repeaters, the customizer-fields module, or asks to add/extend a field type. Covers metabox + options + customizer integration, repeater internals, JSON sanitization, asset structure, and WP_Customize_Control lazy-loading rules.
---

# pure-metafields plugin skills

A consolidated playbook of conventions and pitfalls learned while extending the **pure-metafields** plugin (a Redux-like WordPress options/metabox/visual-builder framework prefixed `tpmeta_` / `TPMeta_`). Apply these whenever working in a project that uses pure-metafields, or when porting the same patterns to a sibling plugin.

---

## 1. Naming & boot conventions

- **Class prefix:** `TPMeta_`. **Function prefix:** `tpmeta_`. **Constants:** `TPMETA_VERSION`, `TPMETA_PATH`, `TPMETA_URL`.
- No PHP namespaces, no Composer autoloader — manual `require_once`.
- Bootstrap order: `tpmeta` core → options on `plugins_loaded:20` → builder on `plugins_loaded:25`.
- Storage backend = WordPress **theme_mods** (`set_theme_mod` / `get_theme_mod`), one key per field. NOT a single grouped option row. This is deliberate so options integrate naturally with the Customizer.
- Public getter: `tpmeta_get_option( $key, $default )` — thin wrapper around `get_theme_mod`. `$opt_name` arg is for panel-level config (menu, title, capability) only — NOT a storage prefix.

## 2. Extension surface (registration filters & APIs)

**Metabox / user meta registration**
- Filter `tp_meta_boxes` — return array of metabox defs (`metabox_id`, `title`, `post_type`, `context`, `priority`, `columns`, `fields[]`).
- Filter `tp_user_meta` — same shape for user profile fields.
- Field def keys: `id`, `type`, `label`, `description`, `default`, `placeholder`, plus type-specific options. Optional `sanitize_callback` overrides default per-type sanitization.
- Field types are separate PHP templates in `metaboxes/fields/{type}.php`. Adding a new type = drop a file + handle in the save-side switch in `metaboxes/class-metabox.php`.
- Nonces: `_nonce_action_tp_metabox` / `_nonce_tp_metabox` (post), `_nonce_action_tp_user_meta` / `_nonce_tp_user_meta` (user).

**Read helpers** (`metaboxes/functions.php`):
- `tpmeta_field( $id, $post_id )`
- `tpmeta_image_field( $key, $post_id )`, `tpmeta_gallery_field( $key, $post_id )`
- `tpmeta_image( $id, $size )`, `tpmeta_gallery_images( $csv )`

**Options framework**
- Static facade: `TPMeta_Options::set_args( $opt_name, $args )` then `TPMeta_Options::set_section( $opt_name, $section )`. Hook on `init:5` (early).
- Read via `tpmeta_get_option( $key, $default )` or `get_theme_mod()`.
- Save AJAX action: `tpmeta_options_save` (nonce: `tpmeta_options_save`). Post-select search: `tpmeta_post_select_search`.
- Save hooks: `tpmeta/options/saved` ($opt_name, $saved) and `tpmeta/options/{$opt_name}/saved` ($saved) — use the latter for per-panel cache busting.
- Field defs may include `output => [ 'selector' => 'css_property' ]`; with panel `output_css => true`, CSS auto-injected on `wp_head:99`.
- Sanitization centralized in `TPMeta_Options_Store::sanitize( $field, $value )` — dispatches by type. Asymmetric with metaboxes (which sanitize inline in the save loop).

**Visual builder**
- Gated on `WP_DEBUG` (admin UI + REST endpoints both). In production it only loads saved panels via `TPMeta_Builder_Loader`.
- `TPMeta_Builder_Codegen::from_panel( $panel )` turns a JSON panel into a committable PHP file using the same `set_args` / `set_section` API.

**Repeater field (options context)**
- Sub-fields registered via `fields` or `sub_fields` key on the repeater field def.
- Stored as JSON-encoded array of rows in a single theme_mod. Each row is a flat-ish assoc; complex sub-fields (color_gradient, etc.) are stored as **nested arrays**, not JSON strings.
- Fetch (one-liner): `tpmeta_get_repeater_rows( $field_id )` returns decoded array ready for `foreach`.

```php
$rows = tpmeta_get_repeater_rows( 'my_repeater_field_id' );
foreach ( $rows as $row ) {
    echo $row['text_field'];
    echo $row['gradient_field']['css']; // nested array — not a JSON string
    // $row['_item_num'] is the stable label number
}
```

**SVG sanitization**: `tpmeta_allowed_svg_tags` filter whitelists SVG inside textarea sanitization.

## 3. Asset structure (post Phase 1 refactor)

```
pure-metafields/
  assets/
    css/  tpmeta-fields.css, tpmeta-builder.css
    js/   tpmeta-fields.js, tpmeta-builder-modal.js
    vendor/{css,js}/  dragula, select2, sortable
  includes/class-tpmeta-assets.php   ← single static enqueue helper
  metaboxes/js/repeater.js           ← enqueued only on repeater field
  options/{js,css}/                  ← panel chrome (tabs, AJAX save, conditionals)
  options/builder/js/builder.js      ← builder app
```

Use the helper, not raw `wp_enqueue_*`:

```php
TPMeta_Assets::enqueue_field_runtime();   // colorpicker, datepicker, select2, dragula, tpmeta-fields.{js,css}
TPMeta_Assets::enqueue_builder_libs();    // builder CSS + JS libs (sortable + modal)
TPMeta_Assets::register_metabox_repeater(); // registers 'repeater' handle for on-demand enqueue
```

**Public handles (preserved for backward compat):** `tm-metabox-js`, `tm-metabox-css`, `select2`, `dragula`, `tpmeta-builder`, `tpmeta-sortable`, `tpmeta-builder-modal`, `repeater`.

---

## 4. Repeater internals — the hard-won lessons

### 4.1 `collectRow` JSON-carrier two-pass detection

Sub-fields like `color_gradient` store their canonical value in a hidden input as JSON. The `data-sfid` injection regex tags ALL `<input>` tags inside a sub-field with the same `data-sfid`, so naive collection picks up internal controls (gradient stops, angle, type radios) and skips the canonical hidden carrier.

**Fix — two-pass:**
1. Pass 1: identify hidden inputs whose `.value` starts with `{` or `[` → `jsonCarrier[sfid] = inp`.
2. Pass 2: if `jsonCarrier[sfid]` exists, collect ONLY that input. `data[sfid] = JSON.parse(inp.value)` (object, not string).

Result: clean nested JSON in payload, no `"my_gradient":"{\"type\":...}"` double-escape.

### 4.2 Stable item labels via `_item_num`

User sorts "Item 4" to top → save → reload. Don't re-derive labels from DOM position.

- **PHP render** (`repeater.php`): read `$row['_item_num']` if set, fall back to `$count`. Render hidden `name="{id}_item_num[]"`. Template row uses `data-count="0"` to signal "unnumbered".
- **PHP save** (`class-metabox.php`): read `$_POST['{id}_item_num']` and store as `$_row['_item_num']`.
- **JS `updateCounter`**: never renumber ALL rows. Only update `.tp-row-counter` value, then assign `max(existing) + 1` to rows with `data-count <= 0`.
- **Dragula drop**: only update `.tp-row-counter`, do NOT call `updateCounter`. Input-name reindexing (for PHP save order) is separate from display label.

### 4.3 cloneNode widget contamination — strip + reinit

`cloneNode(true)` copies DOM + classes but NOT event listeners. The hidden template row gets globally-initialised widgets (`wpColorPicker` wraps in `.wp-picker-container`; jQuery UI datepicker adds `hasDatepicker`). Clones look initialised but have no live handlers.

**Add Row handler must:**
1. **Colorpicker:** walk every `.wp-picker-container` in the clone, extract value + `data-sfid` from `input.wp-color-picker`, replace the entire container with a fresh plain `<input>`, then reinit.
2. **Datepicker:** remove `hasDatepicker` class **and** rename `id` (see 4.4) before `initDatepickers(newRow)`.
3. **Select2:** destroy stale state — `$(newRow).find('.select2-hidden-accessible').select2('destroy')`.

CSS class clues: `.wp-color-picker` / `.wp-picker-container` / `.hasDatepicker` / `.select2-hidden-accessible` = widget already inited.

### 4.4 Datepicker ID collision after clone

jQuery UI datepicker renders day cells with `onclick="jQuery.datepicker._selectDay('#' + id, ...)"`. Two elements with the same `id` → `$('#id')` returns the FIRST DOM match (the hidden template). Clicks set value on template, change event fires outside the cloned row, `syncAll()` never runs.

```js
$( newRow ).find( '.tm-datepicker-input' ).each( function () {
    $( this ).removeClass( 'hasDatepicker' );
    if ( this.id ) this.id = this.id + '__n' + newIdx;
} );
```

Run BEFORE `initDatepickers(newRow)`. Suffix `__n{idx}` matches PHP convention `__r{idx}`. Colorpicker/gradient don't have this issue (direct DOM refs, not ID lookups).

### 4.5 jQuery `.trigger()` vs native `addEventListener` mismatch

`$(this).trigger('change')` walks jQuery's internal handler registry only. It is **invisible** to native `addEventListener`. The repeater's `bindRow` uses `rowEl.addEventListener('change', fn)`, so jQuery-triggered changes never reach `syncAll()`.

**Always use:** `this.dispatchEvent(new Event('change', {bubbles:true}))` — fires both native AND jQuery handlers.

Applies in: `assets/js/tpmeta-fields.js` datepicker `onSelect`, `options/templates/fields/repeater.php` `initDatepickers` `onSelect`, and ANY new widget callback that must propagate to a parent.

### 4.6 Form name pollution (known issue, deferred)

Sub-field inputs have `name="sfid"` on template, `name="sfid__rN"` on PHP-rendered rows, `name="sfid"` on JS-cloned rows. `$form.serialize()` produces duplicate top-level params; `parse_str` collapses to last. Harmless **only if** `sfid` is never registered as a top-level option. Proper fix = strip `name` attrs from repeater sub-field inputs (Phase 2).

---

## 5. Sanitization rules

### 5.1 Don't double-`wp_unslash` JSON

The AJAX save handler runs `parse_str( wp_unslash( $_POST['form'] ), $values )` — values are **already** clean. A second `wp_unslash` inside `json_decode` strips legitimate JSON escapes (`\"` → `"`), produces invalid JSON, returns null, save falls through to `'[]'`.

```php
// CORRECT
json_decode( $value, true );

// WRONG — corrupts nested JSON (color_gradient inside repeater, etc.)
json_decode( wp_unslash( $value ), true );
```

`wp_unslash` on plain text/colorpicker/date is harmless (no intentional backslashes). Only JSON-decoded fields are affected.

### 5.2 Always `is_array()` guard before scalar sanitizers

Complex types (typography, spacing, dimension, color_gradient, multicolor, gallery, multicheck, repeater) return arrays from `get_theme_mod()` and `$_POST`. Passing arrays to `sanitize_text_field()`, `esc_html()`, or `sprintf("%s", ...)` produces "Array to string conversion" warnings inside `wp-includes/formatting.php` — looks like a WP bug, isn't.

**Three recurring sources:**

1. **CSS output loop** (`generic_css_for_panel`):
   ```php
   if ( '' === $value || null === $value || is_array( $value ) ) { continue; }
   ```

2. **Metabox `$types` branch save**:
   ```php
   $_raw = $_POST[ $field['id'] ];
   if ( is_array( $_raw ) ) {
       $_clean = array_map( 'sanitize_text_field', array_map( 'wp_unslash', $_raw ) );
   } else {
       $_clean = sanitize_text_field( wp_unslash( (string) $_raw ) );
   }
   ```

3. **Catch-all `else` + user meta save**: same is_array → array_map / scalar branch.

**Rule:** never `sanitize_text_field( $value )` or `esc_html( $value )` without an `is_array()` check first.

---

## 6. Customizer integration (customizer-fields module)

The module lives at `options/customizer-fields/` and renders all complex field types in the Customizer sidebar using existing PHP templates.

### 6.1 File layout

```
options/customizer-fields/
├── class-tpmeta-customize-field-control.php   ← WP_Customize_Control subclass
├── class-tpmeta-customizer-fields.php         ← orchestrator
├── js/tpmeta-customizer-fields.js             ← sub-input → wp.customize sync
└── css/tpmeta-customizer-fields.css           ← sidebar layout overrides
```

### 6.2 The CRITICAL `WP_Customize_Control` lazy-load rule

**Never `require_once` a file that extends `WP_Customize_Control` (or `WP_Customize_Color_Control`, `WP_Customize_Image_Control`, etc.) at plugin boot time.** Those classes only exist during Customizer requests (loaded via `_wp_customize_include()` on `wp_loaded`). On every other request — admin-ajax, regular admin pages, frontend — they don't exist. Eager-loading produces a fatal: `Class "WP_Customize_Control" not found`.

**Correct pattern:**
```php
// Orchestrator constructor (safe to load eagerly — only adds an action):
add_action( 'customize_register', array( $this, 'register' ), 11 );

// In register() — fires DURING customize_register, when the parent class exists:
public function register( WP_Customize_Manager $wp_customize ) {
    require_once TPMETA_PATH . 'options/customizer-fields/class-tpmeta-customize-field-control.php';
    // ... rest of registration
}
```

The orchestrator class itself can be required at boot (only calls `add_action`, never extends a Customizer class).

### 6.3 Orchestrator (`TPMeta_Customizer_Fields`)

- Hooks `customize_register` at **priority 11** (core class runs at 10 so panels/sections already exist).
- Hooks `customize_controls_enqueue_scripts` for field runtime + module assets.
- Reads `TPMeta_Builder_Store::all()`, processes panels with `customizer_integration = true`.
- Replicates the same priority counter as `TPMeta_Customizer` so relative field order is preserved.
- Only registers settings + controls for `self::$handled_types`; skips others (already handled by core).
- `section_heading` gets a dummy `__return_empty_string` setting so the control can call `$this->value()` safely.
- `sanitize_array()` accepts PHP array or JSON string, deep-sanitizes (`sanitize_key` keys, `sanitize_text_field` leaves).
- Active callbacks support both numeric `[field, op, value]` and assoc `{field, operator, value}` formats.
- Transport: `'refresh'` for all complex fields (live preview not yet implemented).

### 6.4 Control class (`TPMeta_Customize_Field_Control`)

- `public $type = 'tpmeta_field'` — matched in JS to custom constructor.
- `public $field = array()` — full field def passed from orchestrator.
- `public static $array_types` — types whose theme_mod value is an array (typography, spacing, dimension, color_gradient, multicolor, gallery, multicheck, repeater).
- `to_json()` adds `tpmeta_field_type` and `tpmeta_is_array` params to JS.
- `render_content()` sets up `$id`, `$field`, `$value` and includes `options/templates/fields/{type}.php` directly. `section_heading` rendered as a visual divider.
- Value normalisation: if theme_mod returns a JSON string for an array-type field, decode before passing to template.

### 6.5 Handled types

| Type | Value shape | Notes |
|---|---|---|
| typography | assoc array | Template has self-contained JS (Google Fonts, preview, color sync) |
| spacing | `{top,right,bottom,left,unit}` | |
| dimension | scalar `"150px"` (hidden input) | Template JS combines num+unit |
| color_gradient | assoc array | |
| multicolor | assoc array | |
| gallery | array of IDs | |
| multicheck | `{key: '1'\|''}` | |
| repeater | array of row objects | Complex; works but iterate carefully |
| radio_image | scalar key | Single-value type |
| section_heading | none | Visual divider only; `__return_empty_string` sanitizer |

### 6.6 JS sync pattern

Registers `api.controlConstructor['tpmeta_field']`. In `ready()`:
- If `tpmeta_is_array`: watch `input change` on all `[name]` descendants → `collectSubFields()` → `control.setting.set(val)`.
- If scalar: watch `change` on `input[type="radio"]` → `control.setting.set(this.value)`.
- `collectSubFields(container, fieldId)` extracts sub-key from `field_id[key]` name format. Checkboxes → `'1'` (checked) or `''` (unchecked). Radios skip unchecked.

### 6.7 TinyMCE in the Customizer — only this works

Every alternative tried and failed. Use this exact pattern.

**PHP** (`class-tpmeta-customize-tinymce-control.php`):
- Extend `WP_Customize_Control`, type = `'tpmeta_tinymce'`.
- Use `content_template()` (Underscore JS template), NOT `render_content()`.
- Render plain `<textarea>` with `{{{ data.link }}}` for auto value-binding.
- Enqueue `wp-tinymce` directly via `wp_enqueue_script('wp-tinymce')` inside `customize_controls_enqueue_scripts`. Do NOT call `wp_enqueue_editor()` (defers to priority 50, after the print queue).
- Register Backbone constructor: `api.controlConstructor['tpmeta_tinymce']`.

**JS timing:**
```js
control.deferred.embedded.done(function () {
    section.expanded.bind(function (expanded) {
        if ( ! expanded ) return;
        // init tinymce here — section MUST be open/visible
    });
});
```

**TinyMCE init:**
```js
tinymce.init({
    selector: '#' + editorId,                           // selector, NOT target (target = TinyMCE 5+)
    init_instance_callback: function (ed) {
        ed.getContainer().style.visibility = 'visible'; // TinyMCE hides during init
    },
    // ...
});
```

Do NOT use `wp.editor.initialize()` — it requires `tinyMCEPreInit`, only emitted by `wp_editor()` PHP calls (which the Customizer doesn't make).

---

## 7. Process / collaboration patterns

When working on this plugin (or porting these patterns):

- **Analyze first, extend don't modify.** Treat existing public APIs (`tpmeta_*` functions, filter names, AJAX action names, JS handle names) as load-bearing. Add new files; don't rewrite existing ones unless explicitly asked.
- **Phased delivery with review gates.** For large features, split into numbered phases. Stop at each phase end and wait for explicit "proceed". Bugs in a phase must be fixed before advancing.
- **Architectural plan format** (when user says "design X" / "architecture for Y"): file tree → class skeletons → timing → edge cases table → integration points → phased order → ask "scaffold?". Code-as-design, no theory essays.
- **Verify memory-recalled file paths and function names** before recommending — the plugin moves quickly; a 3-day-old memory may already be stale.

---

## Quick checklist when adding a new field type

1. Drop template in `metaboxes/fields/{type}.php` (and/or `options/templates/fields/{type}.php` for options).
2. Add a `case` in `metaboxes/class-metabox.php` save switch with `is_array()` guard.
3. Add a `case` in `TPMeta_Options_Store::sanitize()` — use raw `json_decode($value, true)` (no `wp_unslash`).
4. If complex/array-valued: add type to `$handled_types` AND `$array_types` in both Customizer classes; add sanitizer case in `sanitize_array()` or `scalar_sanitize_for()`.
5. If the field renders sub-inputs: ensure `collectRow` two-pass detection works, and that any widget reinit on Add Row (colorpicker / datepicker / select2) follows the strip+reinit pattern with unique-id renaming.
6. If a JS callback must propagate to repeater `syncAll()`: use `dispatchEvent(new Event('change', {bubbles:true}))`, never `$(this).trigger('change')`.
