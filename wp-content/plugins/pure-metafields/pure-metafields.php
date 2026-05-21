<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://themepure.net
 * @since             1.4.8
 * @package           tpmeta
 *
 * @wordpress-plugin
 * Plugin Name:       PureFields – Meta Fields & Theme Options Builder for WordPress
 * Plugin URI:        https://themepure.net/plugins/puremetafields/files/pure-metafields.zip
 * Description:       Custom metaboxes, a theme-options framework (theme_mod storage), and a visual options builder for ThemePure themes & plugins.
 * Version:           1.7.0
 * Author:            ThemePure
 * Author URI:        https://themepure.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pure-metafields
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'TPMETA_VERSION', '1.7.0' );
define( 'TPMETA_PATH', plugin_dir_path(__FILE__) );
define( 'TPMETA_URL', plugin_dir_url(__FILE__) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pure-metafields-activator.php
 */
if(!function_exists('tpmeta_activate_tp_metabox')){
	function tpmeta_activate_tp_metabox() {
		require_once TPMETA_PATH . 'includes/class-pure-metafields-activator.php';
		tpmeta_activator::activate();
	}
	register_activation_hook( __FILE__, 'tpmeta_activate_tp_metabox' );
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pure-metafields-deactivator.php
 */
if(!function_exists('tpmeta_deactivate_tp_metabox')){
	function tpmeta_deactivate_tp_metabox() {
		require_once TPMETA_PATH . 'includes/class-pure-metafields-deactivator.php';
		tpmeta_deactivator::deactivate();
	}
	register_deactivation_hook( __FILE__, 'tpmeta_deactivate_tp_metabox' );
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require TPMETA_PATH . 'includes/class-pure-metafields.php';

/**
 * Centralised enqueue helpers for the shared field-runtime and
 * builder-runtime asset bundles. Required early so any class
 * registering admin_enqueue_scripts hooks can reference it.
 */
require_once TPMETA_PATH . 'includes/class-tpmeta-assets.php';



/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.4.0
 */
if(!function_exists('tpmeta_kick')){
	function tpmeta_kick() {
		$plugin = new tpmeta();
		$plugin->run();
	}
	tpmeta_kick();
}

require_once TPMETA_PATH . 'metaboxes/functions.php';
require_once TPMETA_PATH . 'metaboxes/class-metabox.php';

/**
 * Theme-options framework (theme_mod storage).
 * Available API:
 *   - TPMeta_Options::set_args( $opt_name, $args )
 *   - TPMeta_Options::set_section( $opt_name, $section )
 *   - tpmeta_get_option( $key, $default ) — wraps get_theme_mod()
 *
 * @since 1.5.0
 */
require_once TPMETA_PATH . 'options/class-tpmeta-options.php';
require_once TPMETA_PATH . 'options/class-tpmeta-options-store.php';
require_once TPMETA_PATH . 'options/class-tpmeta-options-field.php';
require_once TPMETA_PATH . 'options/class-tpmeta-options-render.php';
require_once TPMETA_PATH . 'options/class-tpmeta-options-ajax.php';
require_once TPMETA_PATH . 'options/class-tpmeta-options-output.php';

if ( ! function_exists( 'tpmeta_options_boot' ) ) {
	function tpmeta_options_boot() {
		new TPMeta_Options_Render();
		new TPMeta_Options_Ajax();
		new TPMeta_Options_Output();
	}
	// Boot late so theme/plugin code can register panels on `init` or earlier.
	add_action( 'plugins_loaded', 'tpmeta_options_boot', 20 );
}

/**
 * Visual Options Builder (drag & drop UI that emits JSON, optionally bakes to PHP).
 *
 * @since 1.6.0
 */
require_once TPMETA_PATH . 'options/builder/class-tpmeta-builder-store.php';
require_once TPMETA_PATH . 'options/builder/class-tpmeta-builder-codegen.php';
require_once TPMETA_PATH . 'options/builder/class-tpmeta-builder-loader.php';
require_once TPMETA_PATH . 'options/builder/class-tpmeta-builder-rest.php';
require_once TPMETA_PATH . 'options/builder/class-tpmeta-builder-demos.php';
require_once TPMETA_PATH . 'options/builder/class-tpmeta-builder.php';
// Unified Customizer registrar. Routes each field type to either a native
// WP_Customize_Control or our TPMeta_Customize_Field_Control (which renders
// the same options/templates/fields/<type>.php template used by the admin
// panel) based on a single $field_map table inside the class.
require_once TPMETA_PATH . 'options/class-tpmeta-customizer.php';

new TPMeta_Builder_Demos();

if ( ! function_exists( 'tpmeta_builder_boot' ) ) {
	function tpmeta_builder_boot() {
		new TPMeta_Builder();
		new TPMeta_Builder_REST();
		new TPMeta_Builder_Loader();
		new TPMeta_Customizer();
	}
	add_action( 'plugins_loaded', 'tpmeta_builder_boot', 25 );
}

/**
 * Pure Fields — extended feature suite.
 * Main menu + Metafield Builder + Post Types + Taxonomies + Export/Import.
 *
 * @since 1.7.0
 */

// Shared admin menu.
require_once TPMETA_PATH . 'admin/class-tpmeta-main-menu.php';

// Metafield Builder.
require_once TPMETA_PATH . 'metafields-builder/class-tpmeta-metafields-store.php';
require_once TPMETA_PATH . 'metafields-builder/class-tpmeta-metafields-loader.php';
require_once TPMETA_PATH . 'metafields-builder/class-tpmeta-metafields-codegen.php';
require_once TPMETA_PATH . 'metafields-builder/class-tpmeta-metafields-scanner.php';
TPMeta_Metafields_Scanner::init();
require_once TPMETA_PATH . 'metafields-builder/class-tpmeta-metafields-rest.php';
require_once TPMETA_PATH . 'metafields-builder/class-tpmeta-metafields-builder.php';

// Post Types.
require_once TPMETA_PATH . 'post-types/class-tpmeta-post-types-store.php';
require_once TPMETA_PATH . 'post-types/class-tpmeta-post-types-loader.php';
require_once TPMETA_PATH . 'post-types/class-tpmeta-post-types-page.php';

// Taxonomies.
require_once TPMETA_PATH . 'taxonomies/class-tpmeta-taxonomies-store.php';
require_once TPMETA_PATH . 'taxonomies/class-tpmeta-taxonomies-loader.php';
require_once TPMETA_PATH . 'taxonomies/class-tpmeta-taxonomies-page.php';

// Export / Import.
require_once TPMETA_PATH . 'export-import/class-tpmeta-export-import.php';

if ( ! function_exists( 'tpmeta_pure_fields_boot' ) ) {
	function tpmeta_pure_fields_boot() {
		new TPMeta_Main_Menu();
		new TPMeta_Metafields_Builder();
		new TPMeta_Metafields_REST();
		new TPMeta_Metafields_Loader();
		new TPMeta_Post_Types_Loader();
		new TPMeta_Post_Types_Page();
		new TPMeta_Taxonomies_Loader();
		new TPMeta_Taxonomies_Page();
		new TPMeta_Export_Import();
	}
	add_action( 'plugins_loaded', 'tpmeta_pure_fields_boot', 30 );
}