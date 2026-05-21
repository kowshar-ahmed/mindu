<?php
/**
 * Options Builder — welcome / onboarding screen.
 * Always shown as the main page.
 * $first_visit (set by render_page) controls whether the transition animation plays.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$logo_url    = TPMETA_URL . 'options/builder/images/tp-logo-mark.svg';
$first_visit = isset( $first_visit ) ? (bool) $first_visit : false;
?>

<div class="tpmeta-welcome-page">

	<!-- ── TOP NAV BAR ─────────────────────────────────────── -->
	<nav class="tpmeta-welcome-nav">
		<div class="tpmeta-welcome-nav-logo">
			<img src="<?php echo esc_url( $logo_url ); ?>" alt="ThemePure" class="tpmeta-welcome-nav-mark" width="32" height="32">
			<span class="tpmeta-welcome-nav-brand">themepure<span class="tpmeta-welcome-nav-dot">.</span></span>
		</div>
		<a href="https://themepure.net" target="_blank" rel="noopener" class="tpmeta-welcome-nav-link">
			Visit themepure.net
			<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
				<path d="M1 11L11 1M11 1H4M11 1V8" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
		</a>
	</nav>

	<!-- ── HERO ────────────────────────────────────────────── -->
	<div class="tpmeta-welcome-hero">

		<div class="tpmeta-welcome-badge">
			<span class="tpmeta-welcome-badge-dot"></span>
			Options Builder — by ThemePure
		</div>

		<h1 class="tpmeta-welcome-headline">
			Build Professional<br>
			Theme Options.<br>
			<span class="tpmeta-welcome-headline-accent">Visually.</span>
		</h1>

		<p class="tpmeta-welcome-subhead">
			Create powerful, beautiful theme settings panels without writing a single line of PHP.
			Drag fields, build sections, and export production&#8209;ready code in minutes.
		</p>

		<div class="tpmeta-welcome-hero-actions">
			<button class="tpmeta-welcome-cta" id="tpmeta-get-started" type="button">
				Get Started
				<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
					<path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</button>
			<a href="https://themepure.net" target="_blank" rel="noopener" class="tpmeta-welcome-cta-secondary">
				Learn more
			</a>
		</div>

	</div>

	<!-- ── FEATURE CARDS ───────────────────────────────────── -->
	<div class="tpmeta-welcome-features">

		<div class="tpmeta-welcome-card">
			<div class="tpmeta-welcome-card-icon tpmeta-icon-blue">
				<span class="dashicons dashicons-layout"></span>
			</div>
			<h3>Visual Builder</h3>
			<p>Drag &amp; drop sections and fields. Arrange, reorder, and organise your options panel exactly how you want.</p>
		</div>

		<div class="tpmeta-welcome-card">
			<div class="tpmeta-welcome-card-icon tpmeta-icon-purple">
				<span class="dashicons dashicons-screenoptions"></span>
			</div>
			<h3>20+ Field Types</h3>
			<p>Text, color, typography, image, select, switch, repeater and more. Every field a professional theme needs.</p>
		</div>

		<div class="tpmeta-welcome-card">
			<div class="tpmeta-welcome-card-icon tpmeta-icon-green">
				<span class="dashicons dashicons-editor-code"></span>
			</div>
			<h3>Export to PHP</h3>
			<p>Generate clean, production-ready PHP code with one click. Version-control your options with your theme files.</p>
		</div>

		<div class="tpmeta-welcome-card">
			<div class="tpmeta-welcome-card-icon tpmeta-icon-pink">
				<span class="dashicons dashicons-images-alt2"></span>
			</div>
			<h3>Starter Templates</h3>
			<p>Jump-start with a full ready-made theme options panel. Load, tweak what you need, and ship faster.</p>
		</div>

	</div>

	<!-- ── FOOTER ──────────────────────────────────────────── -->
	<footer class="tpmeta-welcome-footer">
		<div class="tpmeta-welcome-footer-logo">
			<img src="<?php echo esc_url( $logo_url ); ?>" alt="" width="20" height="20" aria-hidden="true">
			<span>
				Made by <a href="https://themepure.net" target="_blank" rel="noopener" class="tpmeta-welcome-footer-link">ThemePure</a>
			</span>
		</div>
		<span class="tpmeta-welcome-footer-sep">&middot;</span>
		<span>Options Builder v<?php echo esc_html( TPMETA_VERSION ); ?></span>
		<span class="tpmeta-welcome-footer-sep">&middot;</span>
		<a href="https://themepure.net" target="_blank" rel="noopener" class="tpmeta-welcome-footer-link">themepure.net</a>
	</footer>

</div>

<!-- ── TRANSITION OVERLAY ───────────────────────────────── -->
<div class="tpmeta-transition-overlay" id="tpmeta-transition-overlay" aria-hidden="true">
	<div class="tpmeta-transition-inner">

		<div class="tpmeta-transition-greeting">
			<div class="tpmeta-transition-wave">👋</div>
			<h2 class="tpmeta-transition-hi"><?php esc_html_e( 'Hello! Welcome aboard.', 'pure-metafields' ); ?></h2>
		</div>

		<div class="tpmeta-transition-logo">
			<img src="<?php echo esc_url( $logo_url ); ?>" alt="" class="tpmeta-transition-mark" width="52" height="52" aria-hidden="true">
			<div class="tpmeta-transition-brand-wrap">
				<span class="tpmeta-transition-brand-name">themepure<span class="tpmeta-transition-brand-dot">.</span></span>
				<span class="tpmeta-transition-brand-sub">Options Builder</span>
			</div>
		</div>

		<div class="tpmeta-transition-spinner">
			<div class="tpmeta-transition-ring"></div>
		</div>

		<p class="tpmeta-transition-msg" id="tpmeta-transition-msg"><?php esc_html_e( 'Opening something exciting…', 'pure-metafields' ); ?></p>

		<div class="tpmeta-transition-progress">
			<div class="tpmeta-transition-progress-bar" id="tpmeta-transition-progress-bar"></div>
		</div>

		<div class="tpmeta-transition-steps" id="tpmeta-transition-steps">
			<div class="tpmeta-transition-step is-active">
				<div class="tpmeta-transition-step-dot"></div>
				<span><?php esc_html_e( 'Opening builder', 'pure-metafields' ); ?></span>
			</div>
			<div class="tpmeta-transition-step">
				<div class="tpmeta-transition-step-dot"></div>
				<span><?php esc_html_e( 'Loading tools', 'pure-metafields' ); ?></span>
			</div>
			<div class="tpmeta-transition-step">
				<div class="tpmeta-transition-step-dot"></div>
				<span><?php esc_html_e( 'Getting ready', 'pure-metafields' ); ?></span>
			</div>
			<div class="tpmeta-transition-step">
				<div class="tpmeta-transition-step-dot"></div>
				<span><?php esc_html_e( 'Almost there', 'pure-metafields' ); ?></span>
			</div>
		</div>

	</div>
</div>

<script>
(function () {
	var btn         = document.getElementById('tpmeta-get-started');
	var overlay     = document.getElementById('tpmeta-transition-overlay');
	var msgEl       = document.getElementById('tpmeta-transition-msg');
	var progressBar = document.getElementById('tpmeta-transition-progress-bar');
	var stepEls     = document.querySelectorAll('.tpmeta-transition-step');
	var firstVisit  = <?php echo $first_visit ? 'true' : 'false'; ?>;

	var messages = [
		<?php
		echo "'" . esc_js( __( 'Opening something exciting…', 'pure-metafields' ) ) . "',\n";
		echo "\t\t'" . esc_js( __( 'Getting your builder ready…', 'pure-metafields' ) ) . "',\n";
		echo "\t\t'" . esc_js( __( 'Loading fields and tools…', 'pure-metafields' ) ) . "',\n";
		echo "\t\t'" . esc_js( __( 'Ready to build great things!', 'pure-metafields' ) ) . "',\n";
		?>
	];

	function goToBuilder() {
		var url = new URL(window.location.href);
		url.searchParams.set('start', '1');
		window.location.href = url.toString();
	}

	function advanceStep(idx) {
		stepEls.forEach(function (el, i) {
			el.classList.toggle('is-active', i === idx);
			el.classList.toggle('is-done',   i < idx);
		});
	}

	if ( ! btn ) return;

	btn.addEventListener('click', function () {
		btn.disabled = true;

		if ( ! firstVisit || ! overlay || ! msgEl ) {
			goToBuilder();
			return;
		}

		overlay.classList.add('is-active');
		overlay.removeAttribute('aria-hidden');

		/* Progress bar: 0 → 100 % over ~2.3 s */
		if (progressBar) {
			setTimeout(function () { progressBar.style.width = '25%'; }, 80);
			setTimeout(function () { progressBar.style.width = '55%'; }, 700);
			setTimeout(function () { progressBar.style.width = '80%'; }, 1400);
			setTimeout(function () { progressBar.style.width = '100%'; }, 2050);
		}

		/* Message + step indicator rotation every 650 ms */
		var idx = 0;
		var interval = setInterval(function () {
			idx++;
			advanceStep(idx);
			if ( idx < messages.length ) {
				msgEl.classList.add('is-fading');
				setTimeout(function () {
					msgEl.textContent = messages[idx];
					msgEl.classList.remove('is-fading');
				}, 280);
			}
		}, 650);

		setTimeout(function () {
			clearInterval(interval);
			goToBuilder();
		}, 2600);
	});
}());
</script>
