<?php

/**
 * Plugin Name: Mindu Core
 * Description: Mindu core plugin for mindu theme.
 * Version:     1.0.0
 * Author:      Kowshar Ahmed
 * Author URI:  https://kowsharahmed.com/
 * Text Domain: mindu-core
 *
 * Requires Plugins: elementor
 * Elementor tested up to: 3.25.0
 * Elementor Pro tested up to: 3.25.0
 */

require_once(__DIR__ . '/inc/trait/common-trait.php');
require_once(__DIR__ . '/inc/plugin-helper.php');
require_once(__DIR__ . '/inc/post-type/portfolio-post-type.php');
require_once(__DIR__ . '/inc/post-type/header-post-type.php');

function register_mindu_heading_widget($widgets_manager)
{

    require_once(__DIR__ . '/widgets/header-menu.php');
    require_once(__DIR__ . '/widgets/blog-post.php');
    require_once(__DIR__ . '/widgets/heading.php');
    require_once(__DIR__ . '/widgets/hero-practice.php');
    require_once(__DIR__ . '/widgets/hero.php');
    require_once(__DIR__ . '/widgets/icon-box.php');
    require_once(__DIR__ . '/widgets/image-box.php');
    require_once(__DIR__ . '/widgets/brand.php');
    require_once(__DIR__ . '/widgets/button.php');
    require_once(__DIR__ . '/widgets/team.php');
    require_once(__DIR__ . '/widgets/team-list.php');
    require_once(__DIR__ . '/widgets/testimonial.php');
    require_once(__DIR__ . '/widgets/faq.php');
    require_once(__DIR__ . '/widgets/video.php');
    require_once(__DIR__ . '/widgets/image-flip.php');
    require_once(__DIR__ . '/widgets/hero-practice-eduker.php');
    require_once(__DIR__ . '/widgets/features-practice-eduker.php');


    $widgets_manager->register(new \Mindu_Header_Menu());
    $widgets_manager->register(new \Mindu_Blog_Post());
    $widgets_manager->register(new \Mindu_Heading());
    $widgets_manager->register(new \Mindu_Hero_Practice());
    $widgets_manager->register(new \Mindu_Hero());
    $widgets_manager->register(new \Mindu_Icon_Box());
    $widgets_manager->register(new \Mindu_Image_Box());
    $widgets_manager->register(new \Mindu_Brand());
    $widgets_manager->register(new \Mindu_Button());
    $widgets_manager->register(new \Mindu_Team());
    $widgets_manager->register(new \Mindu_Team_List());
    $widgets_manager->register(new \Mindu_Testimonial());
    $widgets_manager->register(new \Mindu_FAQ());
    $widgets_manager->register(new \Mindu_Video());
    $widgets_manager->register(new \Mindu_Image_Flip());
    $widgets_manager->register(new \Mindu_Hero_Practice_Eduker());
    $widgets_manager->register(new \Mindu_Features_Practice_Eduker());
}
add_action('elementor/widgets/register', 'register_mindu_heading_widget');



// Mindu widget category register

function add_widget_categories($elements_manager)
{

    $elements_manager->add_category(
        'mindu-category',
        [
            'title' => esc_html__('Mindu', 'textdomain'),
            'icon' => 'fa fa-plug',
        ]
    );

}
add_action('elementor/elements/categories_registered', 'add_widget_categories');
