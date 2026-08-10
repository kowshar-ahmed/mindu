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
                <div class="col-xxl-2 col-xl-2 col-6">
                    <div class="tp-header-logo">
                        <?php header_logo(); ?>
                    </div>
                </div>
                <div class="col-xxl-10 col-xl-10 col-6">
                    <div class="tp-header-left d-none d-xl-block">
                        <div class="tp-main-menu tp-main-menu-2 tp-menu-dropdown">
                            <nav class="tp-mobile-menu-active">
                                <?php header_menu(); ?>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="tp-header-option tp-header-2-option d-flex align-items-center justify-content-end">

                    <div class="tp-header-toogle-wrapper d-xl-none ml-10">
                        <button class="tp-header-toogle"><i class="far fa-bars"></i></button>
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