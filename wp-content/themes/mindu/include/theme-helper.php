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





// mindu_pagination 
function mindu_blog_pagination()
{
    $pages = paginate_links(array(
        'type' => 'array',
        'prev_text'    => __('<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.75 5.75H0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M5.75 10.75L0.75 5.75L5.75 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>', 'mindu'),
        'next_text'    => __('<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.75 5.75H10.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M5.75 10.75L10.75 5.75L5.75 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>', 'mindu'),
    ));
    if ($pages) {
        echo '<ul>';
        foreach ($pages as $page) {
            echo "<li>$page</li>";
        }
        echo '</ul>';
    }
}




/**
 * Generate custom search form
 *
 * @param string $form Form HTML.
 * @return string Modified form HTML.
 */
function mindu_search_form($form)
{
    $form = '
        <div class="tp-sidebar-search p-relative mb-40">
        <form role="search" method="get" action="' . home_url('/') . '" >
            <input name="s" value="' . get_search_query() . '" id="s" class="tp-input" type="text" placeholder="Search ...">
            <button class="tp-sidebar-search-btn" type="submit">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6.97222 13.1944C10.4087 13.1944 13.1944 10.4087 13.1944 6.97222C13.1944 3.53578 10.4087 0.75 6.97222 0.75C3.53578 0.75 0.75 3.53578 0.75 6.97222C0.75 10.4087 3.53578 13.1944 6.97222 13.1944Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M14.75 14.7502L11.3667 11.3669" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </form>
        </div>';

    return $form;
}
add_filter('get_search_form', 'mindu_search_form');




function mindu_post_tag(){
    $tags = get_the_tags();
    if ($tags) {
        foreach ($tags as $tag) {
            echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
        }
    }
}
