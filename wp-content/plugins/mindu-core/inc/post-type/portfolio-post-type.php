<?php

/**
 * Register Portfolio Post Type
 */

function tp_register_portfolio_post_type() {

    $labels = array(
        'name'                  => esc_html__( 'Portfolios', 'textdomain' ),
        'singular_name'         => esc_html__( 'Portfolio', 'textdomain' ),
        'menu_name'             => esc_html__( 'Portfolio', 'textdomain' ),
        'name_admin_bar'        => esc_html__( 'Portfolio', 'textdomain' ),
        'add_new'               => esc_html__( 'Add New', 'textdomain' ),
        'add_new_item'          => esc_html__( 'Add New Portfolio', 'textdomain' ),
        'new_item'              => esc_html__( 'New Portfolio', 'textdomain' ),
        'edit_item'             => esc_html__( 'Edit Portfolio', 'textdomain' ),
        'view_item'             => esc_html__( 'View Portfolio', 'textdomain' ),
        'all_items'             => esc_html__( 'All Portfolios', 'textdomain' ),
        'search_items'          => esc_html__( 'Search Portfolios', 'textdomain' ),
        'not_found'             => esc_html__( 'No portfolios found.', 'textdomain' ),
        'not_found_in_trash'    => esc_html__( 'No portfolios found in Trash.', 'textdomain' ),
        'featured_image'        => esc_html__( 'Featured Image', 'textdomain' ),
        'set_featured_image'    => esc_html__( 'Set featured image', 'textdomain' ),
        'remove_featured_image' => esc_html__( 'Remove featured image', 'textdomain' ),
        'use_featured_image'    => esc_html__( 'Use as featured image', 'textdomain' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true, // Gutenberg Support
        'query_var'          => true,
        'rewrite'            => array(
            'slug'       => 'portfolio',
            'with_front' => false,
        ),
        'capability_type' => 'post',
        'has_archive'    => true,
        'hierarchical'   => false,
        'menu_position'  => 20,
        'menu_icon'      => 'dashicons-portfolio',
        'supports'       => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'author',
            'revisions',
            'page-attributes',
        ),
    );

    register_post_type( 'portfolio', $args );
}

add_action( 'init', 'tp_register_portfolio_post_type' );



function tp_register_portfolio_taxonomies()
{

    // Portfolio Categories
    register_taxonomy(
        'portfolio_category',
        'portfolio',
        array(
            'label'             => esc_html__('Portfolio Categories', 'textdomain'),
            'hierarchical'      => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,
            'rewrite'           => array(
                'slug' => 'portfolio-category',
            ),
        )
    );
}

add_action('init', 'tp_register_portfolio_taxonomies');
