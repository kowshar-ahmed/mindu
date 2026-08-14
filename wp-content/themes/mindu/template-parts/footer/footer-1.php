<footer>
    <div class="tp-footer-area" data-bg-color="#050517">
        <?php if (is_active_sidebar('footer-1-widget-1') || is_active_sidebar('footer-1-widget-2') || is_active_sidebar('footer-1-widget-3') || is_active_sidebar('footer-1-widget-4')) : ?>
            <div class="container pt-135 pb-100">
                <div class="row">
                    <?php if (is_active_sidebar('footer-1-widget-1')) : ?>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                            <?php dynamic_sidebar('footer-1-widget-1'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('footer-1-widget-2')) : ?>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                            <?php dynamic_sidebar('footer-1-widget-2'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('footer-1-widget-3')) : ?>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                            <?php dynamic_sidebar('footer-1-widget-3'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (is_active_sidebar('footer-1-widget-4')) : ?>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-12 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".6s">
                            <?php dynamic_sidebar('footer-1-widget-4'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="tp-footer-bottom">
            <div class="container">
                <div class="tp-footer-bottom-border">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="tp-footer-menu mb-20">
                                <?php footer_menu(); ?>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="tp-footer-copyright text-xl-end mb-20">
                                <?php mindu_footer_copyright(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>