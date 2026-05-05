<?php

//header_logo
function header_logo(){ 
    
    global $mindu; // Same as your opt_name
    $header_logo = $mindu['header-logo']['url'] ?? get_template_directory_uri() . '/assets/img/logo/logo.png';

    ?>


    <a href="<?php echo esc_url(home_url('/')); ?>">
        <img width="85" src="<?php echo esc_url($header_logo); ?>" alt="<?php bloginfo('name'); ?>">
    </a>
<?php
}


//header_menu
function header_menu(){
    wp_nav_menu(array(
        'theme_location' => 'main-menu',
        'container' => '',
        'menu_class' => '',
        'menu_id' => '',
        'fallback_cb' => 'Mindu_Walker_Nav_Menu::fallback',
        'walker' => new Mindu_Walker_Nav_Menu,
    ));
}

