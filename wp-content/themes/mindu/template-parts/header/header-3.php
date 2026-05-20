<?php

global $mindu; // Same as your opt_name
$header_top_switch = $mindu['header-top-switch'] ?? "";
$header_phone = $mindu['header-phone'] ?? "";
$header_email = $mindu['header-email'] ?? "";
$header_time = $mindu['header-time'] ?? "";

$header_button = $mindu['header-button-text'] ?? "";
$header_button_url = $mindu['header-button-url'] ?? "";

$header_right_switch = $mindu['header-right-switch'] ?? "";

$header_col = ($header_right_switch == true) ? 'col-xl-9 col-5' : 'col-xl-12 col-12';
$header_menu_pos = ($header_right_switch == true) ? '' : 'justify-content-between';


?>






<header class="tp-header-height">

    <!-- header-area-start -->

    <?php if ($header_top_switch == true) : ?>
        <div class="tp-header-top-spacing d-none d-lg-block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="tp-header-top-info d-flex align-items-center">
                            <?php if (!empty($header_phone)) : ?>
                                <span class="mr-30 d-inline-block">
                                    <svg width="12" height="15" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.43652 4V6.8C9.43652 8.73298 7.89749 10.3 5.99902 10.3C4.10055 10.3 2.56152 8.73298 2.56152 6.8V4C2.56152 2.06701 4.10055 0.5 5.99902 0.5C7.89749 0.5 9.43652 2.06701 9.43652 4Z" stroke="currentColor" />
                                        <path d="M11.5 6.8C11.5 9.89281 9.03758 12.4 6 12.4M6 12.4C2.96243 12.4 0.5 9.89281 0.5 6.8M6 12.4V14.5M6 14.5H8.0625M6 14.5H3.9375" stroke="currentColor" stroke-linecap="round" />
                                    </svg>
                                    <?php echo esc_html__('Call Us:', 'mindu'); ?>
                                    <a href="tel:<?php echo esc_attr($header_phone); ?>"><?php echo esc_html($header_phone); ?></a>
                                </span>
                            <?php endif; ?>
                            <?php if (!empty($header_email)) : ?>
                                <span>
                                    <svg width="16" height="13" viewBox="0 0 16 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.5 2.26472L5.37978 5.02964C7.17877 6.04896 7.93887 6.04896 9.73788 5.02964L14.6176 2.26472" stroke="currentColor" stroke-linejoin="round" />
                                        <path d="M0.511132 7.5416C0.557275 9.70555 0.580351 10.7875 1.3788 11.589C2.17723 12.3904 3.28847 12.4183 5.51094 12.4742C6.88068 12.5086 8.23696 12.5086 9.60673 12.4742C11.8292 12.4183 12.9404 12.3904 13.7389 11.589C14.5373 10.7875 14.5604 9.70555 14.6065 7.5416C14.6214 6.84581 14.6214 6.15419 14.6065 5.4584C14.5604 3.29449 14.5373 2.21253 13.7389 1.41105C12.9404 0.609575 11.8292 0.581657 9.60673 0.525815C8.23696 0.491396 6.88068 0.491396 5.51093 0.525808C3.28847 0.581643 2.17723 0.609561 1.37879 1.41105C0.580344 2.21253 0.557275 3.29448 0.511125 5.4584C0.496287 6.15419 0.496294 6.84581 0.511132 7.5416Z" stroke="currentColor" stroke-linejoin="round" />
                                    </svg>
                                    <?php echo esc_html__('Email:', 'mindu'); ?>
                                    <a href="mailto:<?php echo esc_attr($header_email); ?>"><?php echo esc_html($header_email); ?></a>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="tp-header-top-info d-flex align-items-center justify-content-end">
                            <?php if (!empty($header_time)) : ?>
                                <span>
                                    <svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M8.54465 0.6V3M3.65576 0.6V3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M6.71121 1.8H5.48899C3.18434 1.8 2.03202 1.8 1.31606 2.50294C0.600098 3.20589 0.600098 4.33726 0.600098 6.6V7.8C0.600098 10.0627 0.600098 11.1941 1.31606 11.897C2.03202 12.6 3.18434 12.6 5.48899 12.6H6.71121C9.01583 12.6 10.1682 12.6 10.8841 11.897C11.6001 11.1941 11.6001 10.0627 11.6001 7.8V6.6C11.6001 4.33726 11.6001 3.20589 10.8841 2.50294C10.1682 1.8 9.01583 1.8 6.71121 1.8Z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M0.600098 5.4H11.6001" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <?php echo esc_html($header_time); ?>
                                </span>
                            <?php endif; ?>

                            <?php if (has_nav_menu('lang-menu')) : ?>
                                <div class="tp-lang-nav ml-25">
                                    <?php language_menu(); ?>
                                </div>
                            <?php else : ?>
                                <div class="tp-header-menu-item tp-header-currency ml-25">
                                    <span class="tp-header-currency-toggle" id="tp-header-currency-toggle"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/flag/01.png" alt=""> <?php echo esc_html__('English', 'mindu'); ?></span>
                                    <ul>
                                        <li>
                                            <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/flag/01.png" alt=""><?php echo esc_html__('Canada', 'mindu'); ?> </a>
                                        </li>
                                        <li>
                                            <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/flag/02.png" alt=""><?php echo esc_html__('Malaysia', 'mindu'); ?> </a>
                                        </li>
                                        <li>
                                            <a href="#"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/flag/03.png" alt=""><?php echo esc_html__('German', 'mindu'); ?> </a>
                                        </li>
                                        <li>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>


    </div>
    <div id="header-sticky" class="tp-header-area tp-header-2-spacing" data-bg-color="#fff">
        <div class="container">
            <div class="row align-items-center">

                <!-- Left Side -->
                <div class="<?php echo esc_attr($header_col); ?>">

                    <div class="tp-header-2-left d-flex align-items-center <?php echo esc_attr($header_menu_pos); ?>">

                        <!-- Logo -->
                        <div class="tp-header-logo mr-100">
                            <?php header_logo(); ?>
                        </div>

                        <!-- Menu -->
                        <div class="tp-main-menu tp-main-menu-2 tp-menu-dropdown d-none d-xl-block">
                            <nav class="tp-mobile-menu-active">
                                <?php header_menu(); ?>
                            </nav>
                        </div>

                        <!-- Mobile Toggle When Right Section Disabled -->
                        <?php if (!$header_right_switch) : ?>
                            <div class="tp-header-option tp-header-2-option d-flex d-xl-none align-items-center justify-content-end">
                                <div class="tp-header-toogle-wrapper ml-10">
                                    <button class="tp-header-toogle">
                                        <i class="far fa-bars"></i>
                                    </button>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>

                </div>

                <!-- Right Side -->
                <?php if ($header_right_switch) : ?>

                    <div class="col-xl-3 col-7">

                        <div class="tp-header-option tp-header-2-option d-flex align-items-center justify-content-end">

                            <!-- Search Button -->
                            <button class="tp-header-search tp-search-click d-none d-sm-block">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.6389 11.6389L14.7499 14.75"
                                        stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />

                                    <path d="M13.1941 6.97222C13.1941 3.53578 10.4084 0.75 6.97206 0.75C3.53571 0.75 0.75 3.53578 0.75 6.97222C0.75 10.4087 3.53571 13.1944 6.97206 13.1944C10.4084 13.1944 13.1941 10.4087 13.1941 6.97222Z"
                                        stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>

                            <!-- Header Button -->
                            <?php if (!empty($header_button)) : ?>

                                <a href="<?php echo esc_url($header_button_url); ?>"
                                    class="tp-btn ml-10 d-none d-sm-block">

                                    <?php echo esc_html($header_button); ?>

                                    <span class="ml-8">
                                        <svg width="11" height="10" viewBox="0 0 11 10" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">

                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M5.70151 0.20932C5.83044 0.0752924 6.00528 0 6.18758 0C6.36989 0 6.54472 0.0752924 6.67365 0.20932L10.7987 4.49886C10.9276 4.63293 11 4.81474 11 5.00432C11 5.19389 10.9276 5.3757 10.7987 5.50977L6.67365 9.79931C6.54399 9.92954 6.37032 10.0016 6.19006 9.99997C6.00979 9.99834 5.83736 9.92316 5.70989 9.7906C5.58242 9.65805 5.51011 9.47874 5.50855 9.29129C5.50698 9.10384 5.57628 8.92325 5.70151 8.78841L8.65299 5.71924H0.687509C0.50517 5.71924 0.3303 5.64392 0.201367 5.50984C0.0724338 5.37577 0 5.19393 0 5.00432C0 4.81471 0.0724338 4.63286 0.201367 4.49879C0.3303 4.36471 0.50517 4.28939 0.687509 4.28939H8.65299L5.70151 1.22022C5.57263 1.08615 5.50022 0.904344 5.50022 0.714771C5.50022 0.525199 5.57263 0.343388 5.70151 0.20932Z"
                                                fill="white" />
                                        </svg>
                                    </span>

                                </a>

                            <?php endif; ?>

                            <!-- Mobile Toggle -->
                            <div class="tp-header-toogle-wrapper d-xl-none ml-10">
                                <button class="tp-header-toogle">
                                    <i class="far fa-bars"></i>
                                </button>
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