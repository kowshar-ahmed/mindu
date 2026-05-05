<?php
if (! class_exists('Redux')) {
    return;
}

$opt_name = 'mindu';

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    'display_name'         => $theme->get('Name'),
    'display_version'      => $theme->get('Version'),
    'menu_title'           => esc_html__('Mindu Options', 'mindu'),
    'customizer'           => false,
);

Redux::set_args($opt_name, $args);

Redux::set_section(
    $opt_name,
    array(
        'title'  => esc_html__('Header', 'mindu'),
        'id'     => 'header-options',
        'desc'   => esc_html__('All header settings available here.', 'mindu'),
        'icon'   => 'el el-home',
        'fields' => array(
            array(
                'id'       => 'header-button-text',
                'type'     => 'text',
                'title'    => esc_html__('Button Text', 'mindu'),
                'desc'     => esc_html__('Button text here.', 'mindu'),
                'subtitle' => esc_html__('Button text here.', 'mindu'),
                'default'  => esc_html__('Login', 'mindu'),
                'hint'     => array(
                    'content' => 'If you remove the text, the button will be hidden.',
                )
            ),
            array(
                'id'       => 'header-button-url',
                'type'     => 'text',
                'title'    => esc_html__('Button URL', 'mindu'),
                'desc'     => esc_html__('Button URL here.', 'mindu'),
                'subtitle' => esc_html__('Button URL here.', 'mindu'),

            )
        )
    )
);




Redux::set_section(
    $opt_name,
    array(
        'title'  => esc_html__('Header Logo', 'mindu'),
        'id'     => 'header-logo-options',
        'desc'   => esc_html__('All header logo settings available here.', 'mindu'),
        'icon'   => 'el el-home',
        'fields' => array(
            array(
                'id'       => 'header-logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__('Header Logo', 'mindu'),
                'desc'     => esc_html__('Upload your header logo here.', 'mindu'),
                'subtitle' => esc_html__('Header logo here.', 'mindu'),
                'default'  => array(
                    'url' => get_template_directory_uri() . '/assets/img/logo/logo.png'
                ),
            )
        )
    )
);



Redux::set_section(
    $opt_name,
    array(
        'title'  => esc_html__('Header Offcanvas', 'mindu'),
        'id'     => 'header-offcanvas-options',
        'desc'   => esc_html__('All header offcanvas settings available here.', 'mindu'),
        'icon'   => 'el el-home',
        'fields' => array(
            array(
                'id'       => 'header-button-text',
                'type'     => 'text',
                'title'    => esc_html__('Button Text', 'mindu'),
                'desc'     => esc_html__('Button text here.', 'mindu'),
                'subtitle' => esc_html__('Button text here.', 'mindu'),
                'default'  => esc_html__('Login', 'mindu'),
                'hint'     => array(
                    'content' => 'If you remove the text, the button will be hidden.',
                )
            ),
        )
    )
);
