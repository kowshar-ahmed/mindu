<?php
/**
 * TPMeta_Builder_REST
 *
 * REST endpoints used by the builder UI.
 *
 *   GET    /tpmeta/v1/builder/panels             — list all panels
 *   GET    /tpmeta/v1/builder/panels/(slug)      — fetch one panel
 *   POST   /tpmeta/v1/builder/panels             — create or update
 *   DELETE /tpmeta/v1/builder/panels/(slug)      — delete
 *   POST   /tpmeta/v1/builder/bake               — generate PHP source
 *
 * All endpoints require `manage_options`.
 *
 * @package    tpmeta
 * @subpackage tpmeta/options/builder
 * @since      1.6.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class TPMeta_Builder_REST {

	const NAMESPACE_BASE = 'tpmeta/v1';

	public function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
	}

	public function register_routes() {
		register_rest_route( self::NAMESPACE_BASE, '/builder/panels', array(
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => array( $this, 'list_panels' ),
				'permission_callback' => array( $this, 'auth' ),
			),
			array(
				'methods'             => WP_REST_Server::CREATABLE,
				'callback'            => array( $this, 'save_panel' ),
				'permission_callback' => array( $this, 'auth' ),
			),
		) );

		register_rest_route( self::NAMESPACE_BASE, '/builder/panels/(?P<slug>[a-z0-9_\-]+)', array(
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => array( $this, 'get_panel' ),
				'permission_callback' => array( $this, 'auth' ),
			),
			array(
				'methods'             => WP_REST_Server::DELETABLE,
				'callback'            => array( $this, 'delete_panel' ),
				'permission_callback' => array( $this, 'auth' ),
			),
		) );

		register_rest_route( self::NAMESPACE_BASE, '/builder/bake', array(
			'methods'             => WP_REST_Server::CREATABLE,
			'callback'            => array( $this, 'bake_panel' ),
			'permission_callback' => array( $this, 'auth' ),
		) );

		register_rest_route( self::NAMESPACE_BASE, '/builder/directories', array(
			'methods'             => WP_REST_Server::READABLE,
			'callback'            => array( $this, 'list_directories' ),
			'permission_callback' => array( $this, 'auth' ),
		) );

		register_rest_route( self::NAMESPACE_BASE, '/builder/images', array(
			'methods'             => WP_REST_Server::READABLE,
			'callback'            => array( $this, 'list_images' ),
			'permission_callback' => array( $this, 'auth' ),
		) );

		register_rest_route( self::NAMESPACE_BASE, '/builder/demos', array(
			array(
				'methods'             => WP_REST_Server::READABLE,
				'callback'            => array( $this, 'list_demos' ),
				'permission_callback' => array( $this, 'auth' ),
			),
			array(
				'methods'             => WP_REST_Server::CREATABLE,
				'callback'            => array( $this, 'seed_demo' ),
				'permission_callback' => array( $this, 'auth' ),
			),
		) );
	}

	/**
	 * Capability + nonce check.
	 *
	 * @param WP_REST_Request $request
	 * @return bool|WP_Error
	 */
	public function auth( $request ) {
		if ( ! current_user_can( 'manage_options' ) ) {
			return new WP_Error( 'tpmeta_forbidden', __( 'You do not have permission to use the options builder.', 'pure-metafields' ), array( 'status' => 403 ) );
		}
		// REST nonce is auto-checked by WP when using wp_rest action; verify presence as defense-in-depth.
		$nonce = $request->get_header( 'x-wp-nonce' );
		if ( ! $nonce || ! wp_verify_nonce( $nonce, 'wp_rest' ) ) {
			return new WP_Error( 'tpmeta_bad_nonce', __( 'Invalid security token.', 'pure-metafields' ), array( 'status' => 403 ) );
		}
		return true;
	}

	public function list_panels( $request ) {
		return rest_ensure_response( array(
			'panels' => TPMeta_Builder_Store::all(),
		) );
	}

	public function get_panel( $request ) {
		$slug  = $request->get_param( 'slug' );
		$panel = TPMeta_Builder_Store::get( $slug );
		if ( ! $panel ) {
			return new WP_Error( 'tpmeta_not_found', 'Panel not found', array( 'status' => 404 ) );
		}
		return rest_ensure_response( $panel );
	}

	public function save_panel( $request ) {
		$panel = $request->get_json_params();
		if ( ! is_array( $panel ) || empty( $panel['opt_name'] ) ) {
			return new WP_Error( 'tpmeta_bad_request', 'Missing or invalid panel payload', array( 'status' => 400 ) );
		}

		$ok = TPMeta_Builder_Store::save( $panel );
		if ( ! $ok ) {
			// update_option returns false if value is identical — treat as success.
			$existing = TPMeta_Builder_Store::get( $panel['opt_name'] );
			if ( ! $existing ) {
				return new WP_Error( 'tpmeta_save_failed', 'Failed to save panel', array( 'status' => 500 ) );
			}
		}

		return rest_ensure_response( array(
			'saved' => true,
			'panel' => TPMeta_Builder_Store::get( $panel['opt_name'] ),
		) );
	}

	public function delete_panel( $request ) {
		$slug = $request->get_param( 'slug' );
		TPMeta_Builder_Store::delete( $slug );
		return rest_ensure_response( array( 'deleted' => true ) );
	}

	/**
	 * List available starter demo panels from the demos/ directory.
	 *
	 * @return WP_REST_Response
	 */
	public function list_demos( $request ) {
		return rest_ensure_response( TPMeta_Builder_Demos::available() );
	}

	/**
	 * Seed (load) a specific demo panel into the builder store.
	 *
	 * @param WP_REST_Request $request  Must contain { file: 'filename.json' }.
	 * @return WP_REST_Response|WP_Error
	 */
	public function seed_demo( $request ) {
		$body     = $request->get_json_params();
		$filename = isset( $body['file'] ) ? basename( (string) $body['file'] ) : '';
		$as_new   = ! empty( $body['as_new'] );

		if ( empty( $filename ) || ! preg_match( '/\.json$/i', $filename ) ) {
			return new WP_Error( 'tpmeta_bad_request', 'Invalid demo filename.', array( 'status' => 400 ) );
		}

		$demo_path = TPMeta_Builder_Demos::DEMO_DIR . $filename;
		if ( ! file_exists( $demo_path ) ) {
			return new WP_Error( 'tpmeta_not_found', 'Demo file not found.', array( 'status' => 404 ) );
		}

		$raw = json_decode( file_get_contents( $demo_path ), true );
		if ( ! is_array( $raw ) || empty( $raw['opt_name'] ) ) {
			return new WP_Error( 'tpmeta_seed_failed', 'Invalid demo JSON.', array( 'status' => 500 ) );
		}

		// as_new: always create a fresh copy so no existing panel is overwritten.
		if ( $as_new ) {
			$raw['opt_name']  = $this->unique_opt_name( sanitize_key( $raw['opt_name'] ) );
			$raw['menu_slug'] = str_replace( '_', '-', $raw['opt_name'] );
		}

		TPMeta_Builder_Store::save( $raw );
		$opt_name = $raw['opt_name'];

		return rest_ensure_response( array(
			'seeded'   => true,
			'opt_name' => $opt_name,
			'panel'    => TPMeta_Builder_Store::get( $opt_name ),
		) );
	}

	/**
	 * Generate a unique opt_name that does not already exist in the store.
	 *
	 * @param string $base
	 * @return string
	 */
	private function unique_opt_name( $base ) {
		$existing = array_column( TPMeta_Builder_Store::all(), 'opt_name' );
		if ( ! in_array( $base, $existing, true ) ) {
			return $base;
		}
		$i = 2;
		while ( in_array( $base . '_' . $i, $existing, true ) ) {
			$i++;
		}
		return $base . '_' . $i;
	}

	/**
	 * Return writable directories under wp-content (themes + plugins) for the
	 * bake modal directory picker.
	 *
	 * @return WP_REST_Response
	 */
	public function list_directories( $request ) {
		$dirs        = array();
		$content_dir = wp_normalize_path( WP_CONTENT_DIR );

		// --- Themes ---
		$themes_root = wp_normalize_path( get_theme_root() );
		if ( is_dir( $themes_root ) ) {
			foreach ( (array) glob( $themes_root . '/*', GLOB_ONLYDIR ) as $theme_path ) {
				$theme_path = wp_normalize_path( $theme_path );
				$name       = basename( $theme_path );
				$rel        = ltrim( str_replace( $content_dir, '', $theme_path ), '/' );

				$dirs[] = array(
					'value' => $rel,
					'label' => 'Theme: ' . $name,
					'group' => 'themes',
				);

				foreach ( array( 'inc', 'includes', 'options', 'framework', 'lib', 'functions' ) as $sub ) {
					if ( is_dir( $theme_path . '/' . $sub ) ) {
						$dirs[] = array(
							'value' => $rel . '/' . $sub,
							'label' => $name . ' / ' . $sub,
							'group' => 'themes',
						);
					}
				}
			}
		}

		// --- Plugins ---
		$plugins_root = wp_normalize_path( WP_PLUGIN_DIR );
		if ( is_dir( $plugins_root ) ) {
			foreach ( (array) glob( $plugins_root . '/*', GLOB_ONLYDIR ) as $plugin_path ) {
				$plugin_path = wp_normalize_path( $plugin_path );
				$name        = basename( $plugin_path );
				$rel         = ltrim( str_replace( $content_dir, '', $plugin_path ), '/' );

				$dirs[] = array(
					'value' => $rel,
					'label' => 'Plugin: ' . $name,
					'group' => 'plugins',
				);
			}
		}

		return rest_ensure_response( $dirs );
	}

	/**
	 * List image files inside a given wp-content-relative directory.
	 * Used by the radio_image field builder to browse theme/plugin images.
	 *
	 * Query param: dir — relative path inside wp-content, e.g. "themes/finzo/inc/img/headers"
	 *
	 * @param WP_REST_Request $request
	 * @return WP_REST_Response|WP_Error
	 */
	public function list_images( $request ) {
		$rel_dir     = $request->get_param( 'dir' );
		$rel_dir     = $rel_dir ? sanitize_text_field( (string) $rel_dir ) : '';
		$content_dir = wp_normalize_path( WP_CONTENT_DIR );
		$content_url = content_url();

		if ( false !== strpos( $rel_dir, '..' ) ) {
			return new WP_Error( 'tpmeta_bad_path', 'Invalid path.', array( 'status' => 400 ) );
		}

		$abs_dir = wp_normalize_path( $content_dir . '/' . ltrim( $rel_dir, '/' ) );

		// Must still be under wp-content.
		if ( 0 !== strpos( $abs_dir, $content_dir ) || ! is_dir( $abs_dir ) ) {
			return rest_ensure_response( array( 'images' => array() ) );
		}

		$exts    = array( 'jpg', 'jpeg', 'png', 'gif', 'svg', 'webp', 'avif' );
		$pattern = $abs_dir . '/*.{' . implode( ',', $exts ) . '}';
		$images  = array();

		foreach ( (array) glob( $pattern, GLOB_BRACE ) as $file ) {
			$file     = wp_normalize_path( $file );
			$rel_file = ltrim( str_replace( $content_dir, '', $file ), '/' );
			$images[] = array(
				'filename' => basename( $file ),
				'url'      => $content_url . '/' . $rel_file,
				// Portable form for the image-default picker. Resolves to
				// the same URL on any installation via tpmeta_resolve_image_url().
				'token'    => function_exists( 'tpmeta_tokenize_content_path' )
					? tpmeta_tokenize_content_path( $rel_file )
					: $content_url . '/' . $rel_file,
			);
		}

		usort( $images, function ( $a, $b ) {
			return strcmp( $a['filename'], $b['filename'] );
		} );

		return rest_ensure_response( array( 'images' => $images ) );
	}

	/**
	 * Generate PHP source for a panel. If `write_path` is provided the
	 * source is also written to disk (must be under wp-content/themes
	 * or wp-content/plugins for safety).
	 *
	 * @param WP_REST_Request $request
	 * @return WP_REST_Response|WP_Error
	 */
	public function bake_panel( $request ) {
		$body       = $request->get_json_params();
		$opt_name   = isset( $body['opt_name'] )   ? sanitize_key( $body['opt_name'] ) : '';
		$write_path = isset( $body['write_path'] ) ? (string) $body['write_path']      : '';

		$panel = TPMeta_Builder_Store::get( $opt_name );
		if ( ! $panel ) {
			return new WP_Error( 'tpmeta_not_found', 'Panel not found', array( 'status' => 404 ) );
		}

		$source = TPMeta_Builder_Codegen::from_panel( $panel );

		$write_result = null;
		if ( '' !== $write_path ) {
			$write_result = $this->write_to_disk( $source, $write_path );
			if ( is_wp_error( $write_result ) ) {
				return $write_result;
			}
		}

		return rest_ensure_response( array(
			'source'        => $source,
			'written_to'    => $write_result,
			'suggested_filename' => $opt_name . '-options.php',
		) );
	}

	/**
	 * Write source to disk after validating the path.
	 *
	 * @param string $source
	 * @param string $path Relative or absolute path inside wp-content.
	 * @return string|WP_Error Absolute path written to, or error.
	 */
	protected function write_to_disk( $source, $path ) {
		// Resolve to absolute path.
		if ( ! path_is_absolute( $path ) ) {
			$path = WP_CONTENT_DIR . '/' . ltrim( $path, '/\\' );
		}
		$path = wp_normalize_path( $path );

		// Reject unless inside wp-content (themes or plugins).
		$content_dir = wp_normalize_path( WP_CONTENT_DIR );
		if ( 0 !== strpos( $path, $content_dir ) ) {
			return new WP_Error( 'tpmeta_bad_path', 'Write path must be inside wp-content.', array( 'status' => 400 ) );
		}

		// Reject directory traversal post-normalization.
		if ( false !== strpos( $path, '..' ) ) {
			return new WP_Error( 'tpmeta_bad_path', 'Path traversal not allowed.', array( 'status' => 400 ) );
		}

		// Must end in .php.
		if ( '.php' !== strtolower( substr( $path, -4 ) ) ) {
			return new WP_Error( 'tpmeta_bad_path', 'Filename must end in .php', array( 'status' => 400 ) );
		}

		$dir = dirname( $path );
		if ( ! wp_mkdir_p( $dir ) ) {
			return new WP_Error( 'tpmeta_mkdir_failed', 'Could not create directory.', array( 'status' => 500 ) );
		}

		$bytes = file_put_contents( $path, $source );
		if ( false === $bytes ) {
			return new WP_Error( 'tpmeta_write_failed', 'Failed to write file.', array( 'status' => 500 ) );
		}

		return $path;
	}
}
