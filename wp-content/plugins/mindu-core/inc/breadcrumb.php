<?php
/**
 * Consora Breadcrumb — minimal & clean
 *
 * tp_breadcrumb();               // echo defaults
 * tp_breadcrumb( $args );        // echo custom
 * $html = tp_get_breadcrumb();   // return HTML
 *
 * @package Consora_Core
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// ─── Public API ──────────────────────────────────────────────────────────────

if ( ! function_exists( 'tp_breadcrumb' ) ) {
	function tp_breadcrumb( $args = [] ) {
		echo tp_get_breadcrumb( $args ); // phpcs:ignore WordPress.Security.EscapeOutput
	}
}

if ( ! function_exists( 'tp_get_breadcrumb' ) ) {
	/**
	 * @param array $args {
	 *   @type string $separator   Crumb separator.           Default '/'.
	 *   @type bool   $show_home   Show home crumb.           Default true.
	 *   @type string $home_label  Label for home.            Default 'Home'.
	 *   @type string $type        Output type: 'list'|'inline'. Default 'list'.
	 * }
	 */
	function tp_get_breadcrumb( $args = [] ) {
		$args = wp_parse_args( $args, apply_filters( 'tp_breadcrumb_defaults', [
			'separator'  => '/',
			'show_home'  => true,
			'home_label' => __( 'Home', 'consora-core' ),
			'type'       => 'list', // 'list' = ul/li | 'inline' = span/a
		] ) );

		$crumbs = apply_filters( 'tp_breadcrumb_crumbs', _tp_crumbs( $args ) );

		if ( empty( $crumbs ) ) return '';

		return apply_filters( 'tp_breadcrumb_html',
			'list' === $args['type']
				? _tp_render_list( $crumbs, $args )
				: _tp_render_inline( $crumbs, $args ),
			$crumbs, $args
		);
	}
}

// ─── Crumb builder ───────────────────────────────────────────────────────────

function _tp_crumbs( $args ) {
	$crumbs = [];

	if ( $args['show_home'] ) {
		$crumbs[] = [ 'label' => $args['home_label'], 'url' => home_url( '/' ) ];
	}

	if ( is_front_page() ) {
		return _tp_make_current( $crumbs );
	}

	if ( is_404() ) {
		return array_merge( $crumbs, [ [ 'label' => __( '404 Not Found', 'consora-core' ) ] ] );
	}

	if ( is_search() ) {
		return array_merge( $crumbs, [ [ 'label' => sprintf( __( 'Search: %s', 'consora-core' ), get_search_query() ) ] ] );
	}

	// WooCommerce
	if ( class_exists( 'WooCommerce' ) ) {
		$woo = _tp_woo_crumbs();
		if ( $woo !== null ) return array_merge( $crumbs, $woo );
	}

	if ( is_home() ) {
		$id = get_option( 'page_for_posts' );
		return array_merge( $crumbs, [ [ 'label' => $id ? get_the_title( $id ) : __( 'Blog', 'consora-core' ) ] ] );
	}

	if ( is_single() ) {
		$post = get_post();
		if ( 'post' === $post->post_type ) {
			$blog_id = get_option( 'page_for_posts' );
			if ( $blog_id ) $crumbs[] = [ 'label' => get_the_title( $blog_id ), 'url' => get_permalink( $blog_id ) ];
			$cats = get_the_category( $post->ID );
			if ( $cats ) $crumbs = array_merge( $crumbs, _tp_term_trail( _tp_primary( $cats ), 'category' ) );
		} else {
			$pto = get_post_type_object( $post->post_type );
			if ( $pto && $pto->has_archive ) {
				$crumbs[] = [ 'label' => $pto->labels->name, 'url' => get_post_type_archive_link( $post->post_type ) ];
			}
		}
		$crumbs[] = [ 'label' => get_the_title( $post ) ];
		return $crumbs;
	}

	if ( is_page() ) {
		foreach ( array_reverse( get_post_ancestors( $post = get_post() ) ) as $id ) {
			$crumbs[] = [ 'label' => get_the_title( $id ), 'url' => get_permalink( $id ) ];
		}
		$crumbs[] = [ 'label' => get_the_title( $post ) ];
		return $crumbs;
	}

	if ( is_category() ) {
		$cat    = get_queried_object();
		$crumbs = array_merge( $crumbs, _tp_term_trail( $cat, 'category', false ) );
		$crumbs[] = [ 'label' => $cat->name ];
		return $crumbs;
	}

	if ( is_tag() ) {
		$crumbs[] = [ 'label' => single_tag_title( '', false ) ];
		return $crumbs;
	}

	if ( is_tax() ) {
		$term     = get_queried_object();
		$crumbs   = array_merge( $crumbs, _tp_term_trail( $term, $term->taxonomy, false ) );
		$crumbs[] = [ 'label' => $term->name ];
		return $crumbs;
	}

	if ( is_post_type_archive() ) {
		$crumbs[] = [ 'label' => post_type_archive_title( '', false ) ];
		return $crumbs;
	}

	if ( is_author() ) {
		$crumbs[] = [ 'label' => sprintf( __( 'Author: %s', 'consora-core' ), get_queried_object()->display_name ) ];
		return $crumbs;
	}

	if ( is_year() )  { $crumbs[] = [ 'label' => get_the_date( 'Y' ) ]; return $crumbs; }
	if ( is_month() ) {
		$crumbs[] = [ 'label' => get_the_date( 'Y' ), 'url' => get_year_link( get_the_date( 'Y' ) ) ];
		$crumbs[] = [ 'label' => get_the_date( 'F' ) ];
		return $crumbs;
	}
	if ( is_day() ) {
		$crumbs[] = [ 'label' => get_the_date( 'Y' ), 'url' => get_year_link( get_the_date( 'Y' ) ) ];
		$crumbs[] = [ 'label' => get_the_date( 'F' ), 'url' => get_month_link( get_the_date( 'Y' ), get_the_date( 'm' ) ) ];
		$crumbs[] = [ 'label' => get_the_date( 'd' ) ];
		return $crumbs;
	}

	return $crumbs;
}

// ─── WooCommerce ─────────────────────────────────────────────────────────────

function _tp_woo_crumbs() {
	$shop_id    = wc_get_page_id( 'shop' );
	$shop_crumb = [ 'label' => get_the_title( $shop_id ), 'url' => get_permalink( $shop_id ) ];

	if ( is_shop() )            return [ [ 'label' => $shop_crumb['label'] ] ];
	if ( is_product_tag() )     return [ $shop_crumb, [ 'label' => single_term_title( '', false ) ] ];

	if ( is_product_category() ) {
		$term   = get_queried_object();
		$crumbs = [ $shop_crumb ];
		$crumbs = array_merge( $crumbs, _tp_term_trail( $term, 'product_cat', false ) );
		$crumbs[] = [ 'label' => $term->name ];
		return $crumbs;
	}

	if ( is_product() ) {
		$crumbs = [ $shop_crumb ];
		$terms  = get_the_terms( get_the_ID(), 'product_cat' );
		if ( $terms && ! is_wp_error( $terms ) ) {
			$primary = _tp_primary( $terms );
			$crumbs  = array_merge( $crumbs, _tp_term_trail( $primary, 'product_cat' ) );
		}
		$crumbs[] = [ 'label' => get_the_title() ];
		return $crumbs;
	}

	return null;
}

// ─── Helpers ─────────────────────────────────────────────────────────────────

/** Build ancestor trail for a term. Includes the term itself when $include_self = true. */
function _tp_term_trail( $term, $taxonomy, $include_self = true ) {
	$crumbs = [];
	foreach ( array_reverse( get_ancestors( $term->term_id, $taxonomy, 'taxonomy' ) ) as $id ) {
		$t        = get_term( $id, $taxonomy );
		$crumbs[] = [ 'label' => $t->name, 'url' => get_term_link( $t ) ];
	}
	if ( $include_self ) {
		$crumbs[] = [ 'label' => $term->name, 'url' => get_term_link( $term ) ];
	}
	return $crumbs;
}

/** Pick lowest term_id as primary; respects Yoast primary term meta. */
function _tp_primary( $terms ) {
	global $post;
	if ( $post ) {
		$tax  = $terms[0]->taxonomy;
		$meta = get_post_meta( $post->ID, '_yoast_wpseo_primary_' . $tax, true );
		if ( $meta ) {
			foreach ( $terms as $t ) {
				if ( (int) $meta === $t->term_id ) return $t;
			}
		}
	}
	usort( $terms, fn( $a, $b ) => $a->term_id - $b->term_id );
	return $terms[0];
}

/** Make the last crumb the current (remove its URL). */
function _tp_make_current( $crumbs ) {
	if ( ! empty( $crumbs ) ) {
		$crumbs[ count( $crumbs ) - 1 ]['url'] = '';
	}
	return $crumbs;
}

// ─── Renderers ───────────────────────────────────────────────────────────────

/** ul > li > a output with schema.org markup */
function _tp_render_list( $crumbs, $args ) {
	$total = count( $crumbs );
	$sep   = '<span class="tp-bc-sep" aria-hidden="true">' . esc_html( $args['separator'] ) . '</span>';
	$html  = '<nav class="tp-breadcrumb" aria-label="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">';
	$html .= '<ul>';

	foreach ( $crumbs as $i => $crumb ) {
		$is_last = ( $i + 1 === $total );
		$label   = esc_html( $crumb['label'] );
		$url     = ! empty( $crumb['url'] ) ? esc_url( $crumb['url'] ) : '';

		$html .= '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
		$html .= '<meta itemprop="position" content="' . ( $i + 1 ) . '">';

		if ( $url && ! $is_last ) {
			$html .= '<a href="' . $url . '" itemprop="item"><span itemprop="name">' . $label . '</span></a>';
		} else {
			$html .= '<span itemprop="name"' . ( $is_last ? ' aria-current="page"' : '' ) . '>' . $label . '</span>';
		}

		$html .= '</li>';
		if ( ! $is_last ) $html .= '<li class="tp-breadcrumb-sep">' . $sep . '</li>';
	}

	$html .= '</ul></nav>';
	return $html;
}

/** span > a inline output */
function _tp_render_inline( $crumbs, $args ) {
	$total = count( $crumbs );
	$sep   = '<span class="tp-bc-sep" aria-hidden="true">' . esc_html( $args['separator'] ) . '</span>';
	$html  = '<nav class="tp-breadcrumb" aria-label="breadcrumb">';

	foreach ( $crumbs as $i => $crumb ) {
		$is_last = ( $i + 1 === $total );
		$label   = esc_html( $crumb['label'] );
		$url     = ! empty( $crumb['url'] ) ? esc_url( $crumb['url'] ) : '';

		if ( $url && ! $is_last ) {
			$html .= '<a href="' . $url . '">' . $label . '</a>';
		} else {
			$html .= '<span' . ( $is_last ? ' aria-current="page"' : '' ) . '>' . $label . '</span>';
		}

		if ( ! $is_last ) $html .= $sep;
	}

	$html .= '</nav>';
	return $html;
}
