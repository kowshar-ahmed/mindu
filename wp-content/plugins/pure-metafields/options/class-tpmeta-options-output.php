<?php
/**
 * TPMeta_Options_Output
 *
 * Auto-generates frontend CSS and loads fonts with ZERO developer config.
 *
 * Typography fields:
 *   - Google fonts are enqueued automatically for every typography field
 *     that has a font_family saved, regardless of the panel's output_css flag.
 *   - Custom uploaded fonts get an @font-face rule automatically.
 *   - When the user has filled in the "Apply To" selectors, a complete CSS
 *     block is injected into wp_head — no PHP or field config needed.
 *
 * Other field types (colorpicker, text, …):
 *   - Still require 'output_css' => true on the panel AND an 'output' key
 *     on the field definition (existing behaviour, unchanged).
 *
 * @package    tpmeta
 * @subpackage tpmeta/options
 * @since      1.5.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

class TPMeta_Options_Output {

	public function __construct() {
		add_action( 'wp_head', array( $this, 'enqueue_fonts' ), 5  );
		add_action( 'wp_head', array( $this, 'print_css' ),    99  );
	}

	// -------------------------------------------------------------------------
	// Font loading — runs for EVERY panel, no output_css flag required
	// -------------------------------------------------------------------------

	/**
	 * Collect every typography field across all panels, enqueue Google Fonts in
	 * one combined request, and inject @font-face for custom uploads.
	 */
	public function enqueue_fonts() {
		$google_families = array(); // family => true
		$face_css        = '';

		foreach ( array_keys( TPMeta_Options::get_panels() ) as $opt_name ) {
			foreach ( TPMeta_Options::get_fields( $opt_name ) as $field ) {
				if ( 'typography' !== $field['type'] ) {
					continue;
				}

				$val = TPMeta_Options_Store::value( $field );
				if ( ! is_array( $val ) || empty( $val['font_family'] ) ) {
					continue;
				}

				$source = isset( $val['font_source'] ) ? $val['font_source'] : 'google';
				$family = trim( $val['font_family'] );

				if ( 'google' === $source && '' !== $family ) {
					$google_families[ $family ] = true;

				} elseif ( 'custom' === $source && ! empty( $val['font_url'] ) ) {
					$ext    = strtolower( pathinfo( $val['font_url'], PATHINFO_EXTENSION ) );
					$format = 'woff2' === $ext ? 'woff2' : ( 'woff' === $ext ? 'woff' : 'truetype' );
					$face_css .=
						"@font-face {\n"
						. "  font-family: '" . esc_attr( $family ) . "';\n"
						. "  src: url('" . esc_url( $val['font_url'] ) . "') format('" . esc_attr( $format ) . "');\n"
						. "  font-display: swap;\n"
						. "}\n";
				}
			}
		}

		// One combined Google Fonts request for all families
		if ( ! empty( $google_families ) ) {
			$frag = implode( '&', array_map(
				function ( $f ) {
					return 'family=' . rawurlencode( $f ) . ':ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,700';
				},
				array_keys( $google_families )
			) );
			$url = 'https://fonts.googleapis.com/css2?' . $frag . '&display=swap';

			echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";                   // phpcs:ignore
			echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";          // phpcs:ignore
			echo '<link rel="stylesheet" href="' . esc_url( $url ) . '">' . "\n";                       // phpcs:ignore
		}

		if ( '' !== $face_css ) {
			echo "<style id=\"tpmeta-custom-fonts\">\n" . $face_css . "</style>\n"; // phpcs:ignore
		}
	}

	// -------------------------------------------------------------------------
	// CSS output
	// -------------------------------------------------------------------------

	public function print_css() {
		$css = '';

		foreach ( TPMeta_Options::get_panels() as $opt_name => $args ) {
			$css .= $this->typography_css_for_panel( $opt_name );

			// Generic field output still requires the panel's output_css flag
			if ( ! empty( $args['output_css'] ) ) {
				$css .= $this->generic_css_for_panel( $opt_name );
			}
		}

		$css = trim( $css );
		if ( '' === $css ) {
			return;
		}

		echo "\n<style id=\"tpmeta-options-output\">\n" . $css . "\n</style>\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	// -------------------------------------------------------------------------
	// Internals
	// -------------------------------------------------------------------------

	/**
	 * Build CSS for every typography field in $opt_name that has selectors.
	 * No output_css panel flag required.
	 *
	 * @param  string $opt_name
	 * @return string
	 */
	protected function typography_css_for_panel( $opt_name ) {
		$css = '';
		foreach ( TPMeta_Options::get_fields( $opt_name ) as $field ) {
			if ( 'typography' === $field['type'] ) {
				$css .= $this->build_typography_css( $field );
			}
		}
		return $css;
	}

	/**
	 * Build CSS for non-typography fields that have an 'output' key.
	 * Only called when the panel has output_css => true.
	 *
	 * @param  string $opt_name
	 * @return string
	 */
	protected function generic_css_for_panel( $opt_name ) {
		$css = '';
		foreach ( TPMeta_Options::get_fields( $opt_name ) as $field ) {
			if ( 'typography' === $field['type'] ) {
				continue; // handled separately above
			}
			if ( empty( $field['output'] ) || ! is_array( $field['output'] ) ) {
				continue;
			}
			$value = TPMeta_Options_Store::value( $field );
			if ( '' === $value || null === $value || is_array( $value ) ) {
				continue;
			}
			foreach ( $field['output'] as $selector => $property ) {
				$selector = trim( wp_strip_all_tags( $selector ) );
				$property = trim( wp_strip_all_tags( $property ) );
				if ( '' === $selector || '' === $property ) {
					continue;
				}
				$css .= sprintf( "%s { %s: %s; }\n", $selector, $property, esc_html( $value ) );
			}
		}
		return $css;
	}

	/**
	 * Build the CSS block for one typography field.
	 *
	 * Selectors are read from the value['selectors'] key set by the Apply To UI.
	 * A field-level string 'output' key is also accepted for backwards compat.
	 * Returns '' when no selectors are configured.
	 *
	 * @param  array  $field
	 * @return string
	 */
	protected function build_typography_css( array $field ) {
		$val = TPMeta_Options_Store::value( $field );
		if ( ! is_array( $val ) ) {
			return '';
		}

		// Primary: selectors saved by the Apply To UI
		$selectors = isset( $val['selectors'] ) ? trim( $val['selectors'] ) : '';

		// Fallback: field-definition 'output' key (string form only)
		if ( '' === $selectors && ! empty( $field['output'] ) && is_string( $field['output'] ) ) {
			$selectors = trim( $field['output'] );
		}

		if ( '' === $selectors ) {
			return '';
		}

		$props  = array();
		$source = isset( $val['font_source'] ) ? $val['font_source'] : 'google';

		// font-family
		$family = isset( $val['font_family'] ) ? trim( $val['font_family'] ) : '';
		if ( '' !== $family ) {
			$q        = strpos( $family, ' ' ) !== false ? "'{$family}'" : $family;
			$fallback = 'custom' === $source ? 'sans-serif'
				: ( false !== stripos( $family, 'serif' ) ? 'serif' : 'sans-serif' );
			$props[]  = "font-family: {$q}, {$fallback}";
		}

		// font-size
		$size = isset( $val['font_size'] ) ? trim( $val['font_size'] ) : '';
		if ( '' !== $size ) {
			$unit    = isset( $val['font_size_unit'] ) ? $val['font_size_unit'] : 'px';
			$props[] = is_numeric( $size )
				? "font-size: {$size}{$unit}"
				: "font-size: {$size}";
		}

		// font-weight
		$weight = isset( $val['font_weight'] ) ? trim( $val['font_weight'] ) : '';
		if ( '' !== $weight ) {
			$props[] = "font-weight: {$weight}";
		}

		// font-style
		$style = isset( $val['font_style'] ) ? trim( $val['font_style'] ) : '';
		if ( '' !== $style && 'normal' !== $style ) {
			$props[] = "font-style: {$style}";
		}

		// line-height
		$lh = isset( $val['line_height'] ) ? trim( $val['line_height'] ) : '';
		if ( '' !== $lh ) {
			$props[] = "line-height: {$lh}";
		}

		// letter-spacing
		$ls = isset( $val['letter_spacing'] ) ? trim( $val['letter_spacing'] ) : '';
		if ( '' !== $ls && '0' !== $ls && '0px' !== $ls ) {
			$props[] = "letter-spacing: {$ls}";
		}

		// text-transform
		$tt = isset( $val['text_transform'] ) ? trim( $val['text_transform'] ) : '';
		if ( '' !== $tt && 'none' !== $tt ) {
			$props[] = "text-transform: {$tt}";
		}

		// color
		$color = isset( $val['color'] ) ? trim( $val['color'] ) : '';
		if ( '' !== $color ) {
			$props[] = "color: {$color}";
		}

		if ( empty( $props ) ) {
			return '';
		}

		return $selectors . " {\n  " . implode( ";\n  ", $props ) . ";\n}\n";
	}
}
