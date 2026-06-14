<?php get_header(); ?>



<!-- tp-error-area-start -->
<div class="tp-error-area pt-140 pb-140">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="tp-error-wrap text-center">
                    <div class="tp-error-thumb mb-40">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/error/error.png" alt="">
                    </div>
                    <h2 class="tp-error-title tp-ff-body fw-500 mb-45">uh-oh! Nothing here...</h2>
                    <a href="<?php echo home_url(); ?>" class="tp-btn tp-error-btn">Go To Home Page
                        <span class="ml-8">
                            <svg width="21" height="18" viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.8847 0.376776C11.1308 0.135526 11.4646 0 11.8127 0C12.1607 0 12.4945 0.135526 12.7406 0.376776L20.6157 8.09796C20.8618 8.33928 21 8.66654 21 9.00777C21 9.349 20.8618 9.67626 20.6157 9.91758L12.7406 17.6388C12.4931 17.8732 12.1615 18.0029 11.8174 18C11.4732 17.997 11.144 17.8617 10.9007 17.6231C10.6573 17.3845 10.5193 17.0617 10.5163 16.7243C10.5133 16.3869 10.6456 16.0618 10.8847 15.8191L16.5193 10.2946H1.31252C0.964416 10.2946 0.630572 10.1591 0.384427 9.91772C0.138283 9.67638 0 9.34907 0 9.00777C0 8.66647 0.138283 8.33915 0.384427 8.09782C0.630572 7.85649 0.964416 7.7209 1.31252 7.7209H16.5193L10.8847 2.1964C10.6386 1.95508 10.5004 1.62782 10.5004 1.28659C10.5004 0.945358 10.6386 0.618099 10.8847 0.376776Z" fill="currentColor" />
                            </svg>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- tp-error-area-end -->



<?php get_footer(); ?>