/* global wp, jQuery, tinyMCE */
/**
 * tpmeta-customizer-fields.js
 *
 * Customizer-side runtime for TPMeta options fields. Bridges template inputs
 * to wp.customize settings AND boots the widget JS that the admin-panel
 * runtime (tpmeta-options.js) normally provides — that runtime is gated by
 * a .tpmeta-options-wrap selector and never runs in the customizer pane.
 *
 * Per-type bootstraps live in this file because:
 *   - field templates' inline scripts (e.g. color_gradient's wp_add_inline_script
 *     on the wp-color-picker handle) attach AFTER scripts have been printed
 *     during customize_pane_settings, so the inline JS never executes;
 *   - control widgets (datepicker, select2, TinyMCE) need to be initialised
 *     after the control's DOM is embedded, which is exactly when our control
 *     constructor's ready() callback fires.
 */
( function ( $, api ) {
	'use strict';

	api.controlConstructor['tpmeta_field'] = api.Control.extend( {

		ready: function () {
			var control   = this;
			var fieldType = control.params.tpmeta_field_type;
			var isArray   = control.params.tpmeta_is_array;
			var fieldId   = control.id;
			var $c        = control.container;

			if ( 'section_heading' === fieldType ) return;

			if ( isArray ) {
				bindArrayField( control, $c, fieldId );
			} else {
				bindScalarField( control, $c, fieldId, fieldType );
			}

			// Per-type widget bootstraps. (editor has its own dedicated control
			// — TPMeta_Customize_TinyMCE_Control — and is not handled here.)
			switch ( fieldType ) {
				case 'image':          initImageField(      control, $c, fieldId );  break;
				case 'post_select':    initPostSelectField( $c );                    break;
				case 'datepicker':     initDatepickerField( $c );                    break;
				case 'radio_image':    initRadioImageField( $c );                    break;
				case 'color_gradient': initGradientField(   $c, fieldId );           break;
				case 'colorpicker':    initColorPickerField( $c );                   break;
				case 'typography':     initTypographySidebar( $c );                  break;
			}

			// Array fields may contain nested colorpickers / datepickers / select2.
			if ( isArray ) {
				initColorPickerField( $c );
				initDatepickerField( $c );
				if ( 'color_gradient' !== fieldType ) {
					initGradientField( $c, fieldId ); // typography/spacing don't have gradients but no-op
				}
			}
		}
	} );

	// ── Array-value binding ───────────────────────────────────────────────────

	function bindArrayField( control, $c, fieldId ) {
		var fieldType = control.params.tpmeta_field_type;

		$c.on( 'input change', 'input, select, textarea', function () {
			var val;

			if ( 'color_gradient' === fieldType ) {
				// Gradient stores its full state as JSON in one hidden input
				// (.tm-gradient-value). Its name is "field_id" (no [key] suffix)
				// so collectSubFields never finds it — read directly instead.
				var raw = $c.find( '.tm-gradient-value' ).val() || '';
				if ( ! raw ) return;
				try { val = JSON.parse( raw ); } catch ( e ) { val = {}; }
				if ( ! val || typeof val !== 'object' || Array.isArray( val ) ) val = {};
			} else {
				val = collectSubFields( $c[ 0 ], fieldId );
			}

			if ( control.setting ) control.setting.set( val );
		} );
	}

	function collectSubFields( container, fieldId ) {
		var result    = {};
		var prefix    = fieldId + '[';
		var prefixLen = prefix.length;

		$( container ).find( '[name]' ).each( function () {
			var name = this.name || '';
			if ( name.indexOf( prefix ) !== 0 ) return;

			var rest = name.slice( prefixLen );
			var key  = rest.slice( 0, rest.indexOf( ']' ) );
			if ( ! key ) return;

			if ( this.type === 'radio' ) {
				if ( this.checked ) result[ key ] = this.value;
			} else if ( this.type === 'checkbox' ) {
				// Only include CHECKED slots. Omitting unchecked keys means key
				// absence signals "not selected" — isset($val[$key]) on the PHP
				// side correctly returns false for unselected options (multicolor,
				// multicheck). Storing '' for unchecked causes all options to
				// appear selected on next load because isset('') === true.
				if ( this.checked ) result[ key ] = this.value || '1';
			} else {
				result[ key ] = this.value;
			}
		} );
		return result;
	}

	// ── Scalar-value binding ──────────────────────────────────────────────────

	function bindScalarField( control, $c, fieldId, fieldType ) {
		function pushValue() {
			var $primary = primaryInput( $c, fieldId );
			if ( ! $primary.length || ! control.setting ) return;

			if ( $primary.is( 'input[type="checkbox"]' ) ) {
				// Switch is the only scalar checkbox; the on/off token is fully
				// determined by data-switch-type + :checked. Do NOT consult
				// $primary.val() here — the sibling keep-mirror handler rewrites
				// input.value to "off" after an uncheck, so reading val() on a
				// later on-toggle would push "off" and silently freeze the
				// setting. Bug surfaces as: conditional fields stop reacting
				// after the first off→on cycle of their dep switch.
				var dataType = $primary.data( 'switch-type' );
				var onToken  = ( dataType === 'boolean' ? 'true'  : 'on'  );
				var offToken = ( dataType === 'boolean' ? 'false' : 'off' );
				control.setting.set( $primary.is( ':checked' ) ? onToken : offToken );
				return;
			}

			// Radio groups (tabs / radio_buttonset): every input shares the
			// fieldId as its name, so primaryInput() returns the FIRST radio,
			// not the selected one. Resolve to the :checked sibling here.
			if ( $primary.is( 'input[type="radio"]' ) ) {
				var $checked = $c.find( 'input[type="radio"][name="' + fieldId + '"]:checked' );
				control.setting.set( $checked.length ? $checked.val() : '' );
				return;
			}

			control.setting.set( $primary.val() || '' );
		}

		$c.on( 'input change', 'input, select, textarea', function () {
			if ( 'editor' === fieldType && typeof tinyMCE !== 'undefined' ) {
				tinyMCE.triggerSave();
			}
			pushValue();
		} );

		// Switch toggle: keep input.value mirrored to checked state.
		$c.on( 'change', '.tm-switch input[type="checkbox"]', function () {
			var $inp     = $( this );
			var dataType = $inp.data( 'switch-type' );
			$inp.val( $inp.is( ':checked' )
				? ( dataType === 'boolean' ? 'true' : 'on' )
				: ( dataType === 'boolean' ? 'false' : 'off' )
			);
		} );
	}

	function primaryInput( $c, fieldId ) {
		var $byName = $c.find( '[name="' + fieldId + '"]' );
		return $byName.length ? $byName.first() : $c.find( '#' + fieldId ).first();
	}

	// ── Image upload ──────────────────────────────────────────────────────────

	function initImageField( control, $c, fieldId ) {
		var $field  = $c.find( '.tm-image-field' ).first();
		if ( ! $field.length ) return;
		var $url    = $field.find( '.tpmeta-image-url' );
		var $alt    = $field.find( '.tpmeta-image-alt' );
		var $idIn   = $field.find( '.tpmeta-image-id' );
		var $img    = $field.find( '.tm-image-img' );
		var $cont   = $field.find( '.tm-image-container' );
		var $btn    = $field.find( '.tm-add-image, .tpmeta-image-upload' );
		var $rem    = $field.find( '.tpmeta-image-remove' );
		var $edit   = $field.find( '.tpmeta-image-edit' );

		// Trigger change on $url so bindArrayField's [name] listener picks up
		// the new url+alt pair via collectSubFields. $url is the named input
		// declared first in the template; one trigger suffices.
		function applyImage( att ) {
			var alt     = att.alt || '';
			var altAttr = $( '<div>' ).text( alt ).html();
			$url.val( att.url );
			$alt.val( alt );
			$idIn.val( att.id || '' );
			$img.html( '<img src="' + att.url + '" alt="' + altAttr + '" />' );
			$url.trigger( 'change' );
		}

		$btn.on( 'click', function ( e ) {
			e.preventDefault();
			var frame = wp.media( {
				title:    'Select Image',
				multiple: false,
				library:  { type: 'image' }
			} );
			frame.on( 'select', function () {
				var att = frame.state().get( 'selection' ).first().toJSON();
				applyImage( att );
				$cont.show();
				$btn.hide();
			} );
			frame.open();
		} );

		$edit.on( 'click', function ( e ) {
			e.preventDefault();
			var currentId  = parseInt( $idIn.val(), 10 ) || 0;
			var currentUrl = $url.val() || '';

			var frame = wp.media( {
				title:    'Replace Image',
				multiple: false,
				library:  { type: 'image' }
			} );

			// Pre-select the currently chosen image in the modal.
			frame.on( 'open', function () {
				var selection = frame.state().get( 'selection' );
				if ( currentId ) {
					var attachment = wp.media.attachment( currentId );
					attachment.fetch();
					selection.reset( [ attachment ] );
					return;
				}
				if ( currentUrl && wp.media.query ) {
					var lib = wp.media.query( { s: currentUrl, type: 'image', posts_per_page: 1 } );
					lib.more().done( function () {
						var first = lib.first();
						if ( first ) selection.reset( [ first ] );
					} );
				}
			} );

			frame.on( 'select', function () {
				var att = frame.state().get( 'selection' ).first().toJSON();
				applyImage( att );
			} );
			frame.open();
		} );

		$rem.on( 'click', function ( e ) {
			e.preventDefault();
			$url.val( '' );
			$alt.val( '' );
			$idIn.val( '' );
			$img.empty();
			$cont.hide();
			$btn.show();
			$url.trigger( 'change' );
		} );
	}

	// ── post_select: select2 + AJAX search ────────────────────────────────────

	function initPostSelectField( $c ) {
		if ( ! $.fn.select2 ) return;
		$c.find( 'select.tpmeta-post-select' ).each( function () {
			var $sel = $( this );
			if ( $sel.hasClass( 'select2-hidden-accessible' ) ) return;

			var ajaxUrl     = $sel.data( 'ajax-url' );
			var nonce       = $sel.data( 'nonce' );
			var postType    = $sel.data( 'post-type' )    || 'post';
			var saveFormat  = $sel.data( 'save-format' )  || 'id';
			var placeholder = $sel.data( 'placeholder' )  || '— Select post —';
			var taxFilter   = $sel.data( 'tax-filter' )   || null;
			var metaFilters = $sel.data( 'meta-filters' ) || null;

			var s2opts = {
				width:              '100%',
				placeholder:        placeholder,
				allowClear:         true,
				minimumInputLength: 0,
				// Append to body and tag with classes so CSS can z-index both
				// the container AND the dropdown above the customizer pane.
				// Without this the dropdown is clipped by the section's
				// overflow-hidden ancestor and appears empty.
				dropdownParent:     $( 'body' ),
				containerCssClass:  'tpmeta-customizer-select2',
				dropdownCssClass:   'tpmeta-customizer-select2-dd'
			};

			if ( ajaxUrl ) {
				s2opts.ajax = {
					url:      ajaxUrl,
					type:     'POST',
					dataType: 'json',
					delay:    300,
					data: function ( params ) {
						return {
							action:       'tpmeta_post_select_search',
							nonce:        nonce,
							post_type:    postType,
							save_format:  saveFormat,
							search:       params.term || '',
							page:         params.page || 1,
							tax_filter:   taxFilter   ? JSON.stringify( taxFilter )   : '',
							meta_filters: metaFilters ? JSON.stringify( metaFilters ) : ''
						};
					},
					processResults: function ( resp ) {
						if ( ! resp || ! resp.success ) return { results: [] };
						return { results: resp.data.results, pagination: { more: resp.data.more } };
					},
					cache: true
				};
			}

			$sel.select2( s2opts );
		} );
	}

	// ── datepicker ────────────────────────────────────────────────────────────

	function initDatepickerField( $c ) {
		if ( ! $.fn.datepicker ) return;
		$c.find( '.tm-datepicker-input' ).each( function () {
			if ( $( this ).hasClass( 'hasDatepicker' ) ) return;
			$( this ).datepicker( {
				dateFormat: 'yy-mm-dd',
				showAnim:   '',
				beforeShow: function () {
					setTimeout( function () {
						$( '#ui-datepicker-div' ).addClass( 'tm-datepicker' );
					}, 0 );
				},
				onSelect: function () {
					this.dispatchEvent( new Event( 'change', { bubbles: true } ) );
				}
			} );
		} );
	}

	// ── radio_image active state ──────────────────────────────────────────────

	function initRadioImageField( $c ) {
		$c.on( 'change', '.tm-ri-wrap input[type="radio"]', function () {
			var $group = $( this ).closest( '.tm-ri-wrap' );
			$group.find( '.tm-ri-card' ).removeClass( 'is-active' );
			$( this ).closest( '.tm-ri-card' ).addClass( 'is-active' );
		} );
	}

	// ── Generic colorpicker init (gradient stops use a separate gradient-aware boot) ─

	function initColorPickerField( $c ) {
		if ( ! $.fn.wpColorPicker ) return;
		$c.find( '.tm-colorpicker-input' ).each( function () {
			if ( $( this ).hasClass( 'wp-color-picker' ) ) return;
			// Skip gradient stop colors — they need gradient-specific change callbacks.
			if ( $( this ).hasClass( 'tpgrd-stop-color' ) ) return;
			if ( $( this ).closest( '.wp-picker-container' ).length ) return;
			$( this ).wpColorPicker( {
				change: function () {
					$( this ).trigger( 'change' );
				}
			} );
		} );
	}

	// ── color_gradient: define + boot TPMetaGradient ─────────────────────────
	//
	// The gradient template uses wp_add_inline_script() on the wp-color-picker
	// handle to define and boot TPMetaGradient.boot. That works in the admin
	// panel (page render flow) but not in the customizer (controls are JSON-
	// serialised after script tags have already been printed). So we define
	// boot ourselves here as a fallback and call it for every gradient wrap
	// inside the rendered control.

	function ensureGradientBoot() {
		if ( window.TPMetaGradient && window.TPMetaGradient.boot ) return;
		window.TPMetaGradient = window.TPMetaGradient || {};
		window.TPMetaGradient.boot = function ( wrap, hidden ) {
			if ( ! wrap || ! hidden ) return;
			var preview = wrap.querySelector( '.tm-gradient-preview' );

			var state = {};
			try { state = JSON.parse( hidden.value || '{}' ); } catch ( e ) {}
			if ( ! state.stops ) {
				state = { type: 'linear', angle: 135,
					stops: [ { color: '#3362FF', pos: 0 }, { color: '#5F4AFE', pos: 100 } ],
					css: '' };
			}

			function buildCSS() {
				var stops = state.stops.map( function ( s ) { return s.color + ' ' + s.pos + '%'; } ).join( ', ' );
				return state.type === 'radial'
					? 'radial-gradient(circle, ' + stops + ')'
					: 'linear-gradient(' + state.angle + 'deg, ' + stops + ')';
			}

			function update() {
				state.css    = buildCSS();
				hidden.value = JSON.stringify( state );
				hidden.dispatchEvent( new Event( 'change', { bubbles: true } ) );
				if ( preview ) preview.style.background = state.css;
			}

			function syncStops() {
				state.stops = [];
				wrap.querySelectorAll( '.tm-grd-stop' ).forEach( function ( row ) {
					var c = row.querySelector( '.tpgrd-stop-color' );
					var p = row.querySelector( '.tpgrd-stop-pos' );
					state.stops.push( {
						color: c ? c.value : '#000000',
						pos:   p ? parseInt( p.value, 10 ) : 0
					} );
				} );
				update();
			}

			function initStopColor( input ) {
				if ( ! window.jQuery || ! jQuery.fn.wpColorPicker ) return;
				if ( input.closest( '.wp-picker-container' ) ) return;
				jQuery( input ).wpColorPicker( {
					change: function ( ev, ui ) {
						jQuery( input ).val( ui.color.toString() );
						syncStops();
					},
					clear: function () { syncStops(); }
				} );
			}

			function addStopRow( color, pos, removable ) {
				var stopsWrap = wrap.querySelector( '.tm-gradient-stops' );
				var div = document.createElement( 'div' );
				div.className = 'tm-grd-stop';
				div.innerHTML = '<input type="text" class="tm-input tm-colorpicker-input tpgrd-stop-color" value="' + color + '" data-default-color="' + color + '" />'
					+ '<div class="tm-dimension-wrap"><input type="number" class="tm-input tm-dim-num tpgrd-stop-pos" min="0" max="100" value="' + pos + '" /><select class="tm-dim-unit"><option>%</option></select></div>'
					+ ( removable ? '<button type="button" class="tpgrd-remove-stop"><span class="dashicons dashicons-no-alt"></span></button>' : '' );
				stopsWrap.appendChild( div );
				initStopColor( div.querySelector( '.tpgrd-stop-color' ) );
				div.querySelector( '.tpgrd-stop-pos' ).addEventListener( 'input', syncStops );
				var rem = div.querySelector( '.tpgrd-remove-stop' );
				if ( rem ) rem.addEventListener( 'click', function () { div.remove(); syncStops(); } );
			}

			wrap.querySelectorAll( '.tpgrd-stop-color' ).forEach( initStopColor );
			wrap.querySelectorAll( '.tpgrd-stop-pos' ).forEach( function ( inp ) {
				inp.addEventListener( 'input', syncStops );
			} );
			wrap.querySelectorAll( '.tpgrd-remove-stop' ).forEach( function ( btn ) {
				btn.addEventListener( 'click', function () { btn.closest( '.tm-grd-stop' ).remove(); syncStops(); } );
			} );
			wrap.querySelectorAll( '.tpgrd-type' ).forEach( function ( r ) {
				r.addEventListener( 'change', function () {
					wrap.querySelectorAll( '.tpgrd-type' ).forEach( function ( other ) {
						other.checked = ( other === r );
					} );
					state.type = r.value;
					update();
				} );
			} );
			var angleInp = wrap.querySelector( '.tpgrd-angle' );
			if ( angleInp ) {
				angleInp.addEventListener( 'input', function () {
					state.angle = parseInt( angleInp.value, 10 ) || 0;
					update();
				} );
			}
			var addBtn = wrap.querySelector( '.tpgrd-add-stop' );
			if ( addBtn ) {
				addBtn.addEventListener( 'click', function () { addStopRow( '#cccccc', 50, true ); syncStops(); } );
			}
		};
	}

	function initGradientField( $c, fieldId ) {
		ensureGradientBoot();
		$c.find( '.tm-gradient-wrap' ).each( function () {
			var wrap   = this;
			var hidden = $c.find( '#' + fieldId )[ 0 ] || $c.find( '.tm-gradient-value' )[ 0 ];
			if ( ! wrap || ! hidden ) return;
			if ( wrap.dataset.tpmetaBooted ) return;
			wrap.dataset.tpmetaBooted = '1';
			window.TPMetaGradient.boot( wrap, hidden );
		} );
	}

	// editor field is handled by TPMeta_Customize_TinyMCE_Control via
	// js/tpmeta-customize-tinymce.js — not in this file.

	// ── Typography — sidebar compaction ──────────────────────────────────────
	//
	// In the narrow Customizer pane (~300px) the Apply-To tag-button rows
	// wrap awkwardly. We hide them via CSS and inject one <select> per
	// group; picking an option triggers a synthetic click on the matching
	// .tptypo-tag-btn, which reuses the template's existing toggle/pill/
	// hidden-input pipeline. No DOM/IDs/names are renamed, so the saved
	// value shape is identical to the options-page render.
	function initTypographySidebar( $c ) {
		var wrap = $c[ 0 ] ? $c[ 0 ].querySelector( '.tptypo-wrap' ) : null;
		if ( ! wrap ) return;
		var apply = wrap.querySelector( '.tptypo-apply-wrap' );
		if ( ! apply ) return;
		if ( apply.dataset.tpmetaSidebar ) return;
		apply.dataset.tpmetaSidebar = '1';

		var selectorInput = apply.querySelector( '.tptypo-selector-input' );
		var selectsByGroup = [];

		apply.querySelectorAll( '.tptypo-row--tags' ).forEach( function ( row ) {
			var label = row.querySelector( '.tptypo-row-label' );
			var ctrl  = row.querySelector( '.tptypo-row-ctrl' );
			var tagRow = ctrl ? ctrl.querySelector( '.tptypo-tag-row' ) : null;
			if ( ! ctrl || ! tagRow ) return;

			var buttons = tagRow.querySelectorAll( '.tptypo-tag-btn' );
			if ( ! buttons.length ) return;

			var groupWrap = document.createElement( 'div' );
			groupWrap.className = 'tptypo-tag-select-row';

			var lbl = document.createElement( 'span' );
			lbl.className = 'tptypo-tag-select-label';
			lbl.textContent = label ? label.textContent : '';
			groupWrap.appendChild( lbl );

			var select = document.createElement( 'select' );
			select.className = 'tptypo-tag-select';

			var placeholder = document.createElement( 'option' );
			placeholder.value = '';
			placeholder.textContent = '— Toggle a selector —';
			select.appendChild( placeholder );

			Array.prototype.forEach.call( buttons, function ( btn ) {
				var opt = document.createElement( 'option' );
				opt.value = btn.dataset.tag || '';
				opt.textContent = btn.dataset.tag || '';
				select.appendChild( opt );
			} );

			function refresh() {
				Array.prototype.forEach.call( buttons, function ( btn, i ) {
					var opt = select.options[ i + 1 ];
					if ( ! opt ) return;
					var active = btn.classList.contains( 'is-active' );
					opt.setAttribute( 'data-active', active ? '1' : '0' );
					opt.textContent = ( active ? '✓ ' : '' ) + ( btn.dataset.tag || '' );
				} );
				select.value = '';
			}

			select.addEventListener( 'change', function () {
				var v = this.value;
				if ( ! v ) return;
				var match = tagRow.querySelector(
					'.tptypo-tag-btn[data-tag="' + v.replace( /\\/g, '\\\\' ).replace( /"/g, '\\"' ) + '"]'
				);
				if ( match ) match.click();
				setTimeout( refresh, 0 );
			} );

			groupWrap.appendChild( select );
			ctrl.appendChild( groupWrap );
			selectsByGroup.push( refresh );
			refresh();
		} );

		function refreshAll() {
			selectsByGroup.forEach( function ( fn ) { fn(); } );
		}

		// Keep selects in sync when selectors change via the text input,
		// the pill remove (×) buttons, or the row-clear (×) button.
		if ( selectorInput ) {
			selectorInput.addEventListener( 'input', function () { setTimeout( refreshAll, 0 ); } );
		}
		apply.addEventListener( 'click', function ( e ) {
			if ( e.target.closest( '.tptypo-pill-remove' ) || e.target.closest( '.tptypo-selector-clear' ) ) {
				setTimeout( refreshAll, 0 );
			}
		} );
	}

	// ── Conditional fields (live show/hide) ──────────────────────────────────
	//
	// WP's PHP active_callback only runs at first render and never re-evaluates
	// against in-progress sidebar changes. We localise a {control_id → rule}
	// map and bind each rule's dependency setting so control.active.set() fires
	// the moment a dep changes. Works for native AND custom controls.

	function evalConditional( current, op, target ) {
		switch ( op ) {
			case '==':  /* loose */ // eslint-disable-line eqeqeq
				return current ==  target; // eslint-disable-line eqeqeq
			case '===': return current === target;
			case '!=':  return current !=  target; // eslint-disable-line eqeqeq
			case '!==': return current !== target;
			case '>':   return parseFloat( current ) >  parseFloat( target );
			case '<':   return parseFloat( current ) <  parseFloat( target );
			case '>=':  return parseFloat( current ) >= parseFloat( target );
			case '<=':  return parseFloat( current ) <= parseFloat( target );
			default:    return true;
		}
	}

	api.bind( 'ready', function () {
		var rules = window.TPMetaCustomizerConditionals;
		if ( ! rules || typeof rules !== 'object' ) return;

		Object.keys( rules ).forEach( function ( targetId ) {
			var rule = rules[ targetId ];
			if ( ! rule || ! rule.field ) return;

			// Wait for both the target control AND the dep setting to register.
			api.control( targetId, function ( control ) {
				api( rule.field, function ( setting ) {
					function apply() {
						control.active.set( evalConditional( setting.get(), rule.operator, rule.value ) );
					}
					setting.bind( apply );
					apply();
				} );
			} );
		} );
	} );

}( jQuery, wp.customize ) );
