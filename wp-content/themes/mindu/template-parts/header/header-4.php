<?php

global $mindu; // Same as your opt_name

$header_phone = $mindu['header-phone'] ?? "";

$header_button = $mindu['header-button-text'] ?? "";
$header_button_url = $mindu['header-button-url'] ?? "";


?>





<header class="tp-header-height">

    <!-- header-area-start -->
    <div id="header-sticky" class="tp-header-area tp-header-3-border tp-header-2-spacing" data-bg-color="#faf8f1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-8 col-5">
                    <div class="tp-header-2-left d-flex align-items-center">
                        <div class="tp-header-logo mr-100">
                            <?php header_logo(); ?>
                        </div>
                        <div class="tp-main-menu tp-main-menu-2 tp-menu-dropdown d-none d-xl-block">
                            <nav class="tp-mobile-menu-active">
                                <?php header_menu(); ?>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-7">
                    <div class="tp-header-option tp-header-2-option d-flex align-items-center justify-content-end">
                        <?php if (!empty($header_phone)) : ?>
                            <a class="tp-header-phone fw-700 tp-ff-heading d-none d-md-inline-block" href="tel:<?php echo esc_attr($header_phone); ?>">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2.44992 7.45336L4.79696 5.10633C5.27573 4.62756 5.44139 3.92014 5.24775 3.27135C5.09634 2.76401 4.92575 2.15412 4.81235 1.63259C4.70747 1.15024 4.28421 0.75 3.79059 0.75H2.44992C1.46267 0.75 0.651923 1.55341 0.760216 2.53471C1.58346 9.99407 7.50638 15.917 14.9657 16.7403C15.9471 16.8485 16.7504 16.0378 16.7504 15.0505V13.7099C16.7504 13.2163 16.3486 12.8113 15.8629 12.723C15.327₁"></path>
                                </svg>
                            </a>
                        <?php endif; ?>

                        <?php if (!empty($header_button)) : ?>
                        <a href=" <?php echo esc_url($header_button_url); ?>" class="tp-btn ml-25 d-none d-sm-block"><?php echo esc_html($header_button); ?>
                                        <span class="ml-8">
                                            <svg width="11" height="10" viewBox="0 0 11 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M5.70151 0.20932C5.83044 0.0752924 6.00528 0 6.18758 0C6.36989 0 6.54472 0.0752924 6.67365 0.20932L10.7987 4.49886C10.9276 4.63293 11 4.81474 11 5.00432C11 5.19389 10.9276 5.3757 10.7987 5.50977L6.67365 9.79931C6.54399 9.92954 6.37032 10.0016 6.19006 9.99997C6.00979 9.99834 5.83736 9.92316 5.70989 9.7906C5.58242 9.65805 5.51011 9.47874 5.50855 9.29129C5.506 nine: nine: nine: nine: nine: nine: nine: nine: nine: nine: nine: nine: nine: nine: nine: nine: nine: nine: nine: nine: nine: nine: nine: nine: nine: nine: nine: nine: nine: nine: nine:" fill="white" />
                                            </svg>
                                        </span>
                            </a>
                        <?php endif; ?>
                        <div class="tp-header-toogle-wrapper d-xl-none ml-10">
                            <button class="tp-header-toogle"><i class="far fa-bars"></i></button>
                        </div>
                    </div>
                </div>
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