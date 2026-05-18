<?php

//header_logo
function header_logo()
{
    global $mindu; // Same as your opt_name
    $header_logo = $mindu['header-logo']['url'] ?? get_template_directory_uri() . '/assets/img/logo/logo.png';
?>

    <a href="<?php echo esc_url(home_url('/')); ?>">
        <img width="85" src="<?php echo esc_url($header_logo); ?>" alt="<?php bloginfo('name'); ?>">
    </a>
<?php
}
//header_transparent_logo
function header_transparent_logo()
{
    global $mindu; // Same as your opt_name
    $header_logo = $mindu['header-logo']['url'] ?? get_template_directory_uri() . '/assets/img/logo/logo.png';
    $header_logo_white = $mindu['header-logo-white']['url'] ?? get_template_directory_uri() . '/assets/img/logo/logo-white.png';
?>


    <a href="<?php echo esc_url(home_url('/')); ?>">
        <img class="logo-2 d-none" width="85" src="<?php echo esc_url($header_logo); ?>" alt="<?php bloginfo('name'); ?>">
        <img class="logo-1" width="85" src="<?php echo esc_url($header_logo_white); ?>" alt="<?php bloginfo('name'); ?>">
    </a>
<?php
}

function mindu_footer_copyright()
{
    global $mindu;

    $footer_copyright = $mindu['footer-copyright'] ?? esc_html__('© 2023 Your Company. All rights reserved.', 'mindu');
?>
    <p class="mb-0"><?php echo esc_html($footer_copyright); ?></p>
<?php
}


//header_menu
function header_menu()
{
    wp_nav_menu(array(
        'theme_location' => 'main-menu',
        'container' => '',
        'menu_class' => '',
        'menu_id' => '',
        'fallback_cb' => 'Mindu_Walker_Nav_Menu::fallback',
        'walker' => new Mindu_Walker_Nav_Menu,
    ));
}
//footer-menu
function footer_menu()
{
    wp_nav_menu(array(
        'theme_location' => 'footer-menu',
        'container' => '',
        'menu_class' => '',
        'menu_id' => '',
    ));
}
//language_menu
function  language_menu()
{
    wp_nav_menu(array(
        'theme_location' => 'lang-menu',
        'container' => '',
        'menu_class' => '',
        'menu_id' => '',
        'fallback_cb' => 'Mindu_Walker_Nav_Menu::fallback',
        'walker' => new Mindu_Walker_Nav_Menu,
    ));
}
