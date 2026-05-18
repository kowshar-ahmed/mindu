<?php

global $mindu; // Same as your opt_name
$header_button = $mindu['header-button-text'] ?? "";
$header_button_url = $mindu['header-button-url'] ?? "";

$header_right_switch = $mindu['header-right-switch'] ?? "";

$header_col = ($header_right_switch == true) ? 'col-xxl-8 col-xl-7 d-none d-xl-block' : 'col-xxl-10 col-xl-10 d-none d-xl-block';
$header_menu_pos = ($header_right_switch == true) ? 'justify-content-center' : 'justify-content-end';
?>



<header class="tp-header-height">
    <!-- header-area-start -->
    <div id="header-sticky" class="tp-header-area tp-header-lg-spacing">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xxl-2 col-xl-2 col-5">
                    <div class="tp-header-logo">
                        <?php header_logo(); ?>
                    </div>
                </div>
                <div class="<?php echo esc_attr($header_col); ?>">
                    <div class="tp-header-left d-flex align-items-center <?php echo esc_attr($header_menu_pos); ?>">
                        <div class="tp-main-menu tp-main-menu-2 tp-menu-dropdown">
                            <nav class="tp-mobile-menu-active">
                                <?php header_menu(); ?>
                            </nav>
                        </div>
                    </div>
                </div>
                <?php if ($header_right_switch) : ?>
                    <div class="col-xxl-2 col-xl-3 col-7">
                        <div class="tp-header-option tp-header-2-option d-flex align-items-center justify-content-end">
                            <button class="tp-header-search tp-search-click d-none d-sm-block">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.6389 11.6389L14.7499 14.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M13.1941 6.97222C13.1941 3.53578 10.4084 0.75 6.97206 0.75C3.53571 0.75 0.75 3.53578 0.75 6.97222C0.75 10.4087 3.53571 13.1944 6.97206 13.1944C10.4084 13.1944 13.1941 10.4087 13.1941 6.97222Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>

                            <?php if (!empty($header_button)) : ?>
                                <a href="<?php echo esc_url($header_button_url); ?>" class="tp-btn ml-15 d-none d-sm-block"><?php echo esc_html($header_button); ?>
                                    <span class="ml-8">
                                        <svg width="11" height="10" viewBox="0 0 11 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.70151 0.20932C5.83044 0.0752924 6.00528 0 6.18758 0C6.36989 0 6.54472 0.0752924 6.67365 0.20932L10.7987 4.49886C10.9276 4.63293 11 4.81474 11 5.00432C11 5.19389 10.9276 5.3757 10.7987 5.50977L6.67365 9.79931C6.54399 9.92954 6.37032 10.0016 6.19006 9.99997C6.00979 9.99834 5.83736 9.92316 5.70989 9.7906C5.58242 9.65805 5.51011 9.47874 5.50855 9.29129C5.50698 9.10384 5.57628 8.92325 5.70151 8.78841L8.65299 5.71924H0.687509C0.50517 5.71924 0.3303 5.64392 0.201367 5.50984C0.0724338 5.37577 0 5.19393 0 5.00432C0 4.81471 0.0724338 4.63286 0.201367 4.49879C0.3303 4.36471 0.50517 4.28939 0.687509 4.28939H8.65299L5.70151 1.22022C5.57263 1.08615 5.50022 0.904344 5.50022 0.714771C5.50022 0.525199 5.57263 0.343388 5.70151 0.20932Z" fill="white" />
                                        </svg>
                                    </span>
                                </a>
                            <?php endif; ?>


                            <div class="tp-header-toogle-wrapper d-xl-none ml-10">
                                <button class="tp-header-toogle"><i class="far fa-bars"></i></button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!$header_right_switch) : ?>
                    <div class="col-xxl-10 col-xl-10 col-7">
                        <div class="tp-header-option tp-header-2-option d-flex align-items-center justify-content-end">

                            <div class="tp-header-toogle-wrapper d-xl-none ml-10">
                                <button class="tp-header-toogle"><i class="far fa-bars"></i></button>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <!-- header-area-end -->
</header>




<?php
/*
<h2><?php echo esc_html__('Hello World','mindu'); ?></h2>

<input type="text" placeholder="<?php echo esc_attr__('Search Here','mindu'); ?>" />

<h3><?php echo esc_html($header_button); ?></h3>

<input type="text" value="<?php echo esc_attr($header_button); ?>" />

<a href="<?php echo esc_url($header_button_url); ?>">
    <?php echo esc_html($header_button); ?>
</a>
*/
?>




<?php echo get_template_part('template-parts/header/header-search', '3'); ?>
<?php echo get_template_part('template-parts/header/header-offcanvas', '3'); ?>