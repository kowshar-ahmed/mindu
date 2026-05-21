<?php
/**
 * Pure Fields — Welcome / Dashboard page.
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$logo_url  = TPMETA_URL . 'options/builder/images/tp-logo-mark.svg';
$admin_url = admin_url( 'admin.php' );

$features = array(
	array(
		'slug'  => 'pure-fields-metafields',
		'icon'  => 'editor-table',
		'color' => 'blue',
		'title' => __( 'Metafield Builder', 'pure-metafields' ),
		'desc'  => __( 'Drag-and-drop metaboxes for any post type — no PHP required.', 'pure-metafields' ),
		'label' => __( 'Build Metafields', 'pure-metafields' ),
	),
	array(
		'slug'  => 'pure-fields-options-builder',
		'icon'  => 'admin-customizer',
		'color' => 'purple',
		'title' => __( 'Option Builder', 'pure-metafields' ),
		'desc'  => __( 'Visual theme options panels exported as clean, production-ready PHP.', 'pure-metafields' ),
		'label' => __( 'Build Options', 'pure-metafields' ),
	),
	array(
		'slug'  => 'pure-fields-post-types',
		'icon'  => 'admin-post',
		'color' => 'pink',
		'title' => __( 'Post Types', 'pure-metafields' ),
		'desc'  => __( 'Register custom post types with every WordPress argument from a visual form.', 'pure-metafields' ),
		'label' => __( 'Create Post Type', 'pure-metafields' ),
	),
	array(
		'slug'  => 'pure-fields-taxonomies',
		'icon'  => 'tag',
		'color' => 'green',
		'title' => __( 'Taxonomies', 'pure-metafields' ),
		'desc'  => __( 'Create and attach custom taxonomies to any post type in one click.', 'pure-metafields' ),
		'label' => __( 'Create Taxonomy', 'pure-metafields' ),
	),
	array(
		'slug'  => 'pure-fields-export-import',
		'icon'  => 'database-import',
		'color' => 'orange',
		'title' => __( 'Export / Import', 'pure-metafields' ),
		'desc'  => __( 'Back up and restore all fields, post types, and panels as JSON.', 'pure-metafields' ),
		'label' => __( 'Manage Data', 'pure-metafields' ),
	),
);
?>

<div class="pfw-page" id="pfw-page">

	<!-- ══ NAV BAR ═══════════════════════════════════════════════════════ -->
	<nav class="pfw-nav" aria-label="Pure Fields navigation">
		<div class="pfw-nav-brand">
			<img src="<?php echo esc_url( $logo_url ); ?>" alt="ThemePure" width="28" height="28">
			<span class="pfw-nav-name">Pure Fields</span>
			<span class="pfw-nav-version">v<?php echo esc_html( TPMETA_VERSION ); ?></span>
		</div>

		<div class="pfw-nav-divider" aria-hidden="true"></div>

		<div class="pfw-nav-links">
			<?php foreach ( $features as $f ) : ?>
			<a href="<?php echo esc_url( add_query_arg( 'page', $f['slug'], $admin_url ) ); ?>"
			   class="pfw-nav-link">
				<?php echo esc_html( $f['title'] ); ?>
			</a>
			<?php endforeach; ?>
		</div>

		<span class="pfw-nav-spacer" aria-hidden="true"></span>

		<a href="https://themepure.net" target="_blank" rel="noopener" class="pfw-nav-external">
			themepure.net
			<svg width="10" height="10" viewBox="0 0 10 10" fill="none" aria-hidden="true">
				<path d="M1 9L9 1M9 1H3.5M9 1V6.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
			</svg>
		</a>
	</nav>

	<!-- ══ HERO ══════════════════════════════════════════════════════════ -->
	<section class="pfw-hero">

		<div class="pfw-orb pfw-orb-1" aria-hidden="true"></div>
		<div class="pfw-orb pfw-orb-2" aria-hidden="true"></div>
		<div class="pfw-orb pfw-orb-3" aria-hidden="true"></div>

		<div class="pfw-hero-inner">
			<div class="pfw-badge pfw-animate" style="--pfw-delay:.1s">
				<span class="pfw-badge-dot"></span>
				<?php esc_html_e( 'The Complete WordPress Fields Framework', 'pure-metafields' ); ?>
			</div>

			<h1 class="pfw-hero-headline pfw-animate" style="--pfw-delay:.2s">
				<?php esc_html_e( 'Build WordPress Fields.', 'pure-metafields' ); ?><br>
				<span class="pfw-gradient-text"><?php esc_html_e( 'Visually.', 'pure-metafields' ); ?></span>
			</h1>

			<p class="pfw-hero-sub pfw-animate" style="--pfw-delay:.3s">
				<?php esc_html_e( 'Custom metaboxes, theme options, post types, and taxonomies — all from a visual interface, zero PHP required.', 'pure-metafields' ); ?>
			</p>

			<div class="pfw-hero-cta pfw-animate" style="--pfw-delay:.4s">
				<a href="<?php echo esc_url( add_query_arg( 'page', 'pure-fields-metafields', $admin_url ) ); ?>"
				   class="pfw-btn pfw-btn--primary">
					<span><?php esc_html_e( 'Get Started', 'pure-metafields' ); ?></span>
					<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
						<path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</a>
				<a href="https://themepure.net" target="_blank" rel="noopener" class="pfw-btn pfw-btn--ghost">
					<?php esc_html_e( 'Documentation', 'pure-metafields' ); ?>
				</a>
			</div>

			<!-- Inline stats strip -->
			<div class="pfw-hero-stats pfw-animate" style="--pfw-delay:.5s">
				<div class="pfw-hero-stat">
					<strong>5</strong><?php esc_html_e( 'Tools', 'pure-metafields' ); ?>
				</div>
				<div class="pfw-hero-stat">
					<strong>13+</strong><?php esc_html_e( 'Field Types', 'pure-metafields' ); ?>
				</div>
				<div class="pfw-hero-stat">
					<span class="dashicons dashicons-editor-code"></span>
					<?php esc_html_e( 'Export to PHP', 'pure-metafields' ); ?>
				</div>
				<div class="pfw-hero-stat">
					<strong>0</strong><?php esc_html_e( 'PHP Required', 'pure-metafields' ); ?>
				</div>
			</div>
		</div>
	</section>

	<!-- ══ FEATURE CARDS ═════════════════════════════════════════════════ -->
	<section class="pfw-features">
		<div class="pfw-section-label pfw-animate" style="--pfw-delay:.05s">
			<?php esc_html_e( 'Everything in one plugin', 'pure-metafields' ); ?>
		</div>

		<div class="pfw-feat-grid">
			<?php foreach ( $features as $i => $f ) :
				$delay = round( .1 + $i * .07, 2 );
			?>
			<a href="<?php echo esc_url( add_query_arg( 'page', $f['slug'], $admin_url ) ); ?>"
			   class="pfw-feat-card pfw-feat-card--<?php echo esc_attr( $f['color'] ); ?> pfw-animate"
			   style="--pfw-delay:<?php echo esc_attr( $delay ); ?>s">
				<div class="pfw-feat-card-top">
					<div class="pfw-feat-icon pfw-icon-<?php echo esc_attr( $f['color'] ); ?>">
						<span class="dashicons dashicons-<?php echo esc_attr( $f['icon'] ); ?>"></span>
					</div>
					<div class="pfw-feat-arrow">
						<svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true">
							<path d="M3 13L13 3M13 3H6M13 3V10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
						</svg>
					</div>
				</div>
				<h3 class="pfw-feat-title"><?php echo esc_html( $f['title'] ); ?></h3>
				<p class="pfw-feat-desc"><?php echo esc_html( $f['desc'] ); ?></p>
				<span class="pfw-feat-link"><?php echo esc_html( $f['label'] ); ?> &rarr;</span>
			</a>
			<?php endforeach; ?>
		</div>
	</section>

	<!-- ══ HOW IT WORKS ══════════════════════════════════════════════════ -->
	<section class="pfw-steps">
		<div class="pfw-section-label pfw-animate" style="--pfw-delay:.05s">
			<?php esc_html_e( 'How it works', 'pure-metafields' ); ?>
		</div>
		<h2 class="pfw-section-title pfw-animate" style="--pfw-delay:.1s">
			<?php esc_html_e( 'From idea to live in', 'pure-metafields' ); ?>
			<span class="pfw-gradient-text"><?php esc_html_e( 'three steps.', 'pure-metafields' ); ?></span>
		</h2>

		<div class="pfw-steps-grid">
			<div class="pfw-step pfw-animate" style="--pfw-delay:.15s">
				<div class="pfw-step-badge">1</div>
				<div class="pfw-step-icon">
					<span class="dashicons dashicons-art"></span>
				</div>
				<h3 class="pfw-step-title"><?php esc_html_e( 'Design', 'pure-metafields' ); ?></h3>
				<p class="pfw-step-desc"><?php esc_html_e( 'Drag and drop fields, sections, and panels in the visual builder.', 'pure-metafields' ); ?></p>
			</div>

			<div class="pfw-steps-line" aria-hidden="true"></div>

			<div class="pfw-step pfw-animate" style="--pfw-delay:.22s">
				<div class="pfw-step-badge">2</div>
				<div class="pfw-step-icon">
					<span class="dashicons dashicons-admin-settings"></span>
				</div>
				<h3 class="pfw-step-title"><?php esc_html_e( 'Configure', 'pure-metafields' ); ?></h3>
				<p class="pfw-step-desc"><?php esc_html_e( 'Set post types, labels, and conditions from a clean admin UI.', 'pure-metafields' ); ?></p>
			</div>

			<div class="pfw-steps-line" aria-hidden="true"></div>

			<div class="pfw-step pfw-animate" style="--pfw-delay:.29s">
				<div class="pfw-step-badge">3</div>
				<div class="pfw-step-icon">
					<span class="dashicons dashicons-migrate"></span>
				</div>
				<h3 class="pfw-step-title"><?php esc_html_e( 'Export & Ship', 'pure-metafields' ); ?></h3>
				<p class="pfw-step-desc"><?php esc_html_e( 'Export production-ready PHP or use live from the database.', 'pure-metafields' ); ?></p>
			</div>
		</div>
	</section>

	<!-- ══ PROMO STRIP ═══════════════════════════════════════════════════ -->
	<section class="pfw-promo pfw-animate" style="--pfw-delay:.1s">
		<div class="pfw-promo-inner">
			<div class="pfw-promo-brand">
				<img src="<?php echo esc_url( $logo_url ); ?>" alt="ThemePure" width="44" height="44">
				<div>
					<div class="pfw-promo-name">ThemePure<span class="pfw-promo-dot">.</span></div>
					<div class="pfw-promo-tagline"><?php esc_html_e( 'Premium WordPress Development Framework', 'pure-metafields' ); ?></div>
				</div>
			</div>
			<div class="pfw-promo-stats">
				<div class="pfw-stat">
					<span class="pfw-stat-num">5</span>
					<span class="pfw-stat-label"><?php esc_html_e( 'Tools', 'pure-metafields' ); ?></span>
				</div>
				<div class="pfw-stat">
					<span class="pfw-stat-num">13+</span>
					<span class="pfw-stat-label"><?php esc_html_e( 'Field Types', 'pure-metafields' ); ?></span>
				</div>
				<div class="pfw-stat">
					<span class="pfw-stat-num">0</span>
					<span class="pfw-stat-label"><?php esc_html_e( 'PHP Required', 'pure-metafields' ); ?></span>
				</div>
			</div>
			<a href="https://themepure.net" target="_blank" rel="noopener" class="pfw-btn pfw-btn--ghost pfw-btn--sm">
				<?php esc_html_e( 'Visit ThemePure.net', 'pure-metafields' ); ?>
				<svg width="11" height="11" viewBox="0 0 10 10" fill="none" aria-hidden="true">
					<path d="M1 9L9 1M9 1H3.5M9 1V6.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
				</svg>
			</a>
		</div>
	</section>

	<!-- ══ FOOTER ════════════════════════════════════════════════════════ -->
	<footer class="pfw-footer">
		<span>Pure Fields v<?php echo esc_html( TPMETA_VERSION ); ?></span>
		<span class="pfw-footer-sep">&middot;</span>
		<span><?php esc_html_e( 'Made with', 'pure-metafields' ); ?> <span class="pfw-heart">&#9829;</span> <?php esc_html_e( 'by', 'pure-metafields' ); ?>
			<a href="https://themepure.net" target="_blank" rel="noopener">ThemePure</a>
		</span>
		<span class="pfw-footer-sep">&middot;</span>
		<a href="https://themepure.net" target="_blank" rel="noopener">themepure.net</a>
	</footer>

</div>
