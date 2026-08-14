<?php

function tp_register_footer_post_type()
{

    register_post_type(
        'tp_footer',
        array(
            'labels' => array(
                'name'          => esc_html__('Footers', 'tp-core'),
                'singular_name' => esc_html__('Footer', 'tp-core'),
                'menu_name'     => esc_html__('Footers', 'tp-core'),
                'add_new_item'  => esc_html__('Add New Footer', 'tp-core'),
                'edit_item'     => esc_html__('Edit Footer', 'tp-core'),
            ),

            'public'             => true,
            'publicly_queryable' => true,
            'exclude_from_search' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_rest'       => true,
            'menu_icon'          => 'dashicons-editor-kitchensink',
            'supports'           => array(
                'title',
                'editor',
                'revisions',
            ),

            'rewrite'     => false,
            'has_archive' => false,
        )
    );
}

add_action('init', 'tp_register_footer_post_type');
