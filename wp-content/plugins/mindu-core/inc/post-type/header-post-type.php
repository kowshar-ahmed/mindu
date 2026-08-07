<?php 

function tp_register_header_post_type() {

    register_post_type(
        'tp_header',
        array(
            'labels' => array(
                'name'          => esc_html__( 'Headers', 'tp-core' ),
                'singular_name' => esc_html__( 'Header', 'tp-core' ),
                'menu_name'     => esc_html__( 'Headers', 'tp-core' ),
                'add_new_item'  => esc_html__( 'Add New Header', 'tp-core' ),
                'edit_item'     => esc_html__( 'Edit Header', 'tp-core' ),
            ),

            'public'             => false,
            'publicly_queryable' => false,
            'exclude_from_search'=> true,
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

add_action( 'init', 'tp_register_header_post_type' );