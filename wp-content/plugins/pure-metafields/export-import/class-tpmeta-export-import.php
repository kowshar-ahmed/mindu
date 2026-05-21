<?php
/**
 * TPMeta_Export_Import — Export/Import page for all Pure Fields data.
 * @package tpmeta
 * @since   1.7.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

class TPMeta_Export_Import {

	const HOOK = 'pure-fields_page_pure-fields-export-import';

	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'wp_ajax_pf_export',     array( $this, 'ajax_export' ) );
		add_action( 'wp_ajax_pf_import',     array( $this, 'ajax_import' ) );
	}

	public function enqueue( $hook ) {
		if ( self::HOOK !== $hook ) return;
		wp_enqueue_style(
			'tpmeta-export-import',
			TPMETA_URL . 'export-import/css/export-import.css',
			array( 'tpmeta-admin-shared', 'dashicons' ),
			TPMETA_VERSION
		);
		wp_enqueue_script(
			'tpmeta-export-import',
			TPMETA_URL . 'export-import/js/export-import.js',
			array( 'jquery' ),
			TPMETA_VERSION,
			true
		);
		wp_localize_script( 'tpmeta-export-import', 'PFExportImport', array(
			'nonce'   => wp_create_nonce( 'pf_nonce' ),
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'counts'  => array(
				'metafields' => count( TPMeta_Metafields_Store::all() ),
				'postTypes'  => count( TPMeta_Post_Types_Store::all() ),
				'taxonomies' => count( TPMeta_Taxonomies_Store::all() ),
				'options'    => count( TPMeta_Builder_Store::all() ),
			),
		) );
	}

	public function render() {
		if ( ! current_user_can( 'manage_options' ) ) wp_die();
		include TPMETA_PATH . 'export-import/templates/export-import.php';
	}

	public function ajax_export() {
		check_ajax_referer( 'pf_nonce', 'nonce' );
		if ( ! current_user_can( 'manage_options' ) ) wp_send_json_error( 'No permission', 403 );

		$types       = array_filter( explode( ',', sanitize_text_field( $_POST['types'] ?? 'all' ) ) );
		$export_all  = in_array( 'all', $types, true );
		$data        = array(
			'_version'  => TPMETA_VERSION,
			'_exported' => current_time( 'c' ),
		);

		if ( $export_all || in_array( 'metafields', $types, true ) ) {
			$data['metafields'] = TPMeta_Metafields_Store::all();
		}
		if ( $export_all || in_array( 'post_types', $types, true ) ) {
			$data['post_types'] = TPMeta_Post_Types_Store::all();
		}
		if ( $export_all || in_array( 'taxonomies', $types, true ) ) {
			$data['taxonomies'] = TPMeta_Taxonomies_Store::all();
		}
		if ( $export_all || in_array( 'options', $types, true ) ) {
			$data['options'] = TPMeta_Builder_Store::all();
		}

		wp_send_json_success( $data );
	}

	public function ajax_import() {
		check_ajax_referer( 'pf_nonce', 'nonce' );
		if ( ! current_user_can( 'manage_options' ) ) wp_send_json_error( 'No permission', 403 );

		$raw = wp_unslash( $_POST['data'] ?? '' );
		$pkg = json_decode( $raw, true );

		if ( ! is_array( $pkg ) ) {
			wp_send_json_error( 'Invalid JSON' );
		}

		$results   = array( 'metafields' => 0, 'post_types' => 0, 'taxonomies' => 0, 'options' => 0 );
		$failed    = array( 'metafields' => 0, 'post_types' => 0, 'taxonomies' => 0, 'options' => 0 );
		$max_items = 500;

		if ( ! empty( $pkg['metafields'] ) && is_array( $pkg['metafields'] ) ) {
			foreach ( array_slice( $pkg['metafields'], 0, $max_items ) as $box ) {
				if ( ! is_array( $box ) || empty( $box['metabox_id'] ) ) { $failed['metafields']++; continue; }
				TPMeta_Metafields_Store::save( $box );
				if ( TPMeta_Metafields_Store::get( sanitize_key( $box['metabox_id'] ) ) ) {
					$results['metafields']++;
				} else {
					$failed['metafields']++;
				}
			}
		}
		if ( ! empty( $pkg['post_types'] ) && is_array( $pkg['post_types'] ) ) {
			foreach ( array_slice( $pkg['post_types'], 0, $max_items ) as $pt ) {
				if ( ! is_array( $pt ) || empty( $pt['slug'] ) ) { $failed['post_types']++; continue; }
				TPMeta_Post_Types_Store::save( $pt );
				if ( TPMeta_Post_Types_Store::get( sanitize_key( $pt['slug'] ) ) ) {
					$results['post_types']++;
				} else {
					$failed['post_types']++;
				}
			}
		}
		if ( ! empty( $pkg['taxonomies'] ) && is_array( $pkg['taxonomies'] ) ) {
			foreach ( array_slice( $pkg['taxonomies'], 0, $max_items ) as $tax ) {
				if ( ! is_array( $tax ) || empty( $tax['slug'] ) ) { $failed['taxonomies']++; continue; }
				TPMeta_Taxonomies_Store::save( $tax );
				if ( TPMeta_Taxonomies_Store::get( sanitize_key( $tax['slug'] ) ) ) {
					$results['taxonomies']++;
				} else {
					$failed['taxonomies']++;
				}
			}
		}
		if ( ! empty( $pkg['options'] ) && is_array( $pkg['options'] ) ) {
			foreach ( array_slice( $pkg['options'], 0, $max_items ) as $panel ) {
				if ( ! is_array( $panel ) || empty( $panel['opt_name'] ) ) { $failed['options']++; continue; }
				// save() returns update_option's bool — false if value is identical
				// to existing (no-op) OR if opt_name sanitized to empty. We verify
				// presence in the store afterwards instead of trusting the bool,
				// so identical re-imports still count as successful.
				TPMeta_Builder_Store::save( $panel );
				if ( TPMeta_Builder_Store::get( sanitize_key( $panel['opt_name'] ) ) ) {
					$results['options']++;
				} else {
					$failed['options']++;
				}
			}
		}

		wp_send_json_success( array( 'imported' => $results, 'failed' => $failed ) );
	}
}
