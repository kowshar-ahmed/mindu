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

require_once(__DIR__ . '/inc/plugin-helper.php');



function register_mindu_heading_widget($widgets_manager)
{

    require_once(__DIR__ . '/widgets/heading.php');
    require_once(__DIR__ . '/widgets/banner-practice.php');

    $widgets_manager->register(new \Mindu_Heading());
    $widgets_manager->register(new \Mindu_Banner_Practice());
}
add_action('elementor/widgets/register', 'register_mindu_heading_widget');
