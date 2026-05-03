<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>
</head>

<body class="body-bg-3">
    <!--[if lte IE 9]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
   <![endif]-->

    <!-- Preloader Start -->
    <div class="preloader d-none">
        <div class="book">
            <div class="inner">
                <div class="left"></div>
                <div class="middle"></div>
                <div class="right"></div>
            </div>
            <ul>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>
    <!-- Preloader End -->

    <!-- back to top start -->
    <div class="back-to-top-wrapper">
        <button id="back_to_top" type="button" class="back-to-top-btn">
            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </button>
    </div>
    <!-- back to top end -->



    <?php echo get_template_part('template-parts/header/header-1', '3'); ?>

    <!-- tp-breadcrumb-area-start -->
    <div class="tp-breadcrumb-area tp-breadcrumb-2 tp-breadcrumb-3 p-relative bg-grey-4">
        <img class="tp-breadcrumb-3-shape d-none d-xl-block" src="<?php echo get_template_directory_uri(); ?>/assets/img/breadcrumb/shape.png" alt="">
        <img class="tp-breadcrumb-3-shape-2 d-none d-xl-block" src="<?php echo get_template_directory_uri(); ?>/assets/img/breadcrumb/shape-2.png" alt="">
        <img class="tp-breadcrumb-3-shape-3 d-none d-xl-block" src="<?php echo get_template_directory_uri(); ?>/assets/img/breadcrumb/shape-3.png" alt="">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tp-breadcrumb-3-content text-center">
                        <div class="tp-breadcrumb-list wow fadeInUp mb-10" data-wow-duration=".9s" data-wow-delay=".4s">
                            <span>
                                <a href="index.html">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0 7.99124V10.1053C0 12.884 -2.38419e-07 14.2734 0.863267 15.1368C1.72653 16 3.11593 16 5.89474 16H9.26316C12.0419 16 13.4313 16 14.2947 15.1368C15.1579 14.2734 15.1579 12.884 15.1579 10.1053V7.99124C15.1579 6.57541 15.1579 5.86756 14.8582 5.25478C14.5585 4.642 13.9997 4.20739 12.8822 3.3382L11.198 2.02825C9.45945 0.676084 8.59023 0 7.57895 0C6.56766 0 5.69843 0.676084 3.95993 2.02825L2.27571 3.3382C1.15817 4.20739 0.599402 4.642 0.299705 5.25478C5.96046e-08 5.86756 0 6.57541 0 7.99124Z" fill="currentColor" />
                                        <path d="M11.7896 12.6316V9.26315" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    Home
                                </a>
                            </span>
                            <span class="dvir">
                                <svg width="6" height="13" viewBox="0 0 6 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.75 0.75L4.52696 4.90465C5.22045 5.6675 5.22045 6.8325 4.52696 7.59535L0.75 11.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </span>
                            <span class="active">Blog</span>
                        </div>
                        <h2 class="tp-breadcrumb-title text-black mb-0 fw-700 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".3s">Blog _ Standard</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- tp-breadcrumb-area-end -->