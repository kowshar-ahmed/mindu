<?php

// mindu_get_post_id_by_slug
function mindu_get_post_id_by_slug($slug = '', $post_type = '') {
    if (empty($slug) || empty($post_type)) {
        return 0;
    }
    $post = get_page_by_path($slug, OBJECT, $post_type);

    return $post ? $post->ID : 0;
}


// mindu_header

function mindu_header()
{
    $tp_page_header = function_exists('tpmeta_field') ? tpmeta_field('tp_page_header') : '';
    $header_id = mindu_get_post_id_by_slug($tp_page_header, 'tp_header');

    $header_global = get_theme_mod('tp_header_global', '');
    $header_global_id = mindu_get_post_id_by_slug($header_global, 'tp_header');

    if (class_exists('\Elementor\Plugin') && $header_id) {
        echo \Elementor\Plugin::$instance->frontend->get_builder_content( $header_id, true);
    } 
    elseif (class_exists('\Elementor\Plugin') && $header_global_id) {
        echo \Elementor\Plugin::$instance->frontend->get_builder_content( $header_global_id, true );
    } 
    else {
        get_template_part('template-parts/header/header-1');
    }
}






// mindu_footer


function mindu_footer()
{

    $tp_footer_page = function_exists('tpmeta_field') ? tpmeta_field('tp_page_footer') : '';
    $footer_id = mindu_get_post_id_by_slug($tp_footer_page, 'tp_footer');

    $footer_global = get_theme_mod('tp_footer_global',);
    $footer_global_id = mindu_get_post_id_by_slug($footer_global, 'tp_footer');

    if (class_exists('\Elementor\Plugin') && $footer_id) {
        echo \Elementor\Plugin::$instance->frontend->get_builder_content($footer_id, true);
    } elseif ($footer_global_id) {
        echo \Elementor\Plugin::$instance->frontend->get_builder_content($footer_global_id, true);
    } else {
        echo get_template_part('template-parts/footer/footer-1');
    }
}



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




function mindu_post_tag()
{
    $tags = get_the_tags();
    if ($tags) {
        foreach ($tags as $tag) {
            echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
        }
    }
}




/**
 * Sanitize SVG markup for front-end display.
 *
 * @param  string $svg SVG markup to sanitize.
 * @return string 	  Sanitized markup.
 */
function mindu_kses($tag = '')
{
    $allowed_html = [
        'a' => [
            'class'    => [],
            'href'    => [],
            'title'    => [],
            'target'    => [],
            'rel'    => [],
        ],
        'b' => [],
        'blockquote'  =>  [
            'cite' => [],
        ],
        'cite'                      => [
            'title' => [],
        ],
        'code'                      => [],
        'del'                    => [
            'datetime'   => [],
            'title'      => [],
        ],
        'div'                    => [
            'class'   => [],
            'title'   => [],
            'style'   => [],
        ],
        'dl'                     => [],
        'dt'                     => [],
        'em'                     => [],
        'h1'                     => [],
        'h2'                     => [],
        'h3'                     => [],
        'h4'                     => [],
        'h5'                     => [],
        'h6'                     => [],
        'i'                         => [
            'class' => [],
        ],
        'img'                    => [
            'alt'  => [],
            'class'   => [],
            'height' => [],
            'src'  => [],
            'width'   => [],
        ],
        'li'                     => array(
            'class' => array(),
        ),
        'ol'                     => array(
            'class' => array(),
        ),
        'p'                         => array(
            'class' => array(),
        ),
        'q'                         => array(
            'cite'    => array(),
            'title'   => array(),
        ),
        'span'                      => array(
            'class'   => array(),
            'title'   => array(),
            'style'   => array(),
        ),
        'iframe'                 => array(
            'width'         => array(),
            'height'     => array(),
            'scrolling'     => array(),
            'frameborder'   => array(),
            'allow'         => array(),
            'src'        => array(),
        ),
        'strike'                 => array(),
        'br'                     => array(),
        'strong'                 => array(),
    ];

    return wp_kses($tag, $allowed_html);
}
