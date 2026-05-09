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
                'title'    => esc_html__('Header Black Logo', 'mindu'),
                'desc'     => esc_html__('Upload your Black logo here.', 'mindu'),
                'subtitle' => esc_html__('Header logo here.', 'mindu'),
                'default'  => array(
                    'url' => get_template_directory_uri() . '/assets/img/logo/logo.png'
                ),
            ),
            array(
                'id'       => 'header-logo-white',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__('Header White Logo', 'mindu'),
                'desc'     => esc_html__('Upload your White logo here.', 'mindu'),
                'subtitle' => esc_html__('Header logo here.', 'mindu'),
                'default'  => array(
                    'url' => get_template_directory_uri() . '/assets/img/logo/logo-white.png'
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
                'id'       => 'offcanvas-content',
                'type'     => 'textarea',
                'title'    => esc_html__('Offcanvas Content', 'mindu'),
                'default'  => esc_html__('lorem ipsum dolor sit amet', 'mindu'),
            ),
            array(
                'id'       => 'offcanvas-gallery',
                'type'     => 'gallery',
                'title'    => esc_html__('Offcanvas Gallery', 'mindu'),
                'default'  => esc_html__('lorem ipsum dolor sit amet', 'mindu'),
            ),
            array(
                'id'       => 'offcanvas-phone',
                'type'     => 'text',
                'title'    => esc_html__('Offcanvas Phone', 'mindu'),
                'default'  => esc_html__('+ 4 20 7700 1007', 'mindu'),
            ),
            array(
                'id'       => 'offcanvas-email',
                'type'     => 'text',
                'title'    => esc_html__('Offcanvas Email', 'mindu'),
                'default'  => esc_html__('hello@mindu.com', 'mindu'),
            ),
            array(
                'id'       => 'offcanvas-address',
                'type'     => 'text',
                'title'    => esc_html__('Offcanvas Address', 'mindu'),
                'default'  => esc_html__('Avenue de Roma 158b, Lisboa', 'mindu'),
            ),
            array(
                'id'       => 'offcanvas-address-url',
                'type'     => 'text',
                'title'    => esc_html__('Offcanvas Address URL', 'mindu'),
                'default'  => esc_html__('https://maps.google.com/?q=Avenue+de+Roma+158b,+Lisboa', 'mindu'),
            ),
            array(
                'id'       => 'offcanvas-fb-url',
                'type'     => 'text',
                'title'    => esc_html__('Offcanvas Facebook URL', 'mindu'),
                'default'  => esc_html__('#', 'mindu'),
            ),
            array(
                'id'       => 'offcanvas-x-url',
                'type'     => 'text',
                'title'    => esc_html__('Offcanvas Twitter URL', 'mindu'),
                'default'  => esc_html__('#', 'mindu'),
            ),
            array(
                'id'       => 'offcanvas-dr-url',
                'type'     => 'text',
                'title'    => esc_html__('Offcanvas Dribble URL', 'mindu'),
                'default'  => esc_html__('#', 'mindu'),
            ),
            array(
                'id'       => 'offcanvas-in-url',
                'type'     => 'text',
                'title'    => esc_html__('Offcanvas Instagram URL', 'mindu'),
                'default'  => esc_html__('#', 'mindu'),
            ),
        )
    )
);
