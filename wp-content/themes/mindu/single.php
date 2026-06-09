<?php get_header(); ?>




<div class="tp-postbox-area pt-140 pb-100">
    <div class="container container-1324">
        <div class="row">
            <div class="col-lg-8">
                <div class="tp-blog-details-wrap mr-50 mb-40">
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <?php echo get_template_part('template-parts/content'); ?>
                        <?php endwhile; ?>
                    <?php else : ?>
                        <p><?php echo esc_html__('No posts found.', 'mindu'); ?></p>
                    <?php endif; ?>
                    <?php echo get_template_part('template-parts/blog/post-navigation'); ?>
                    <?php echo get_template_part('template-parts/biography'); ?>

                    <?php if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif; ?>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="tp-sidebar-wrapper">
                    <?php dynamic_sidebar('blog-sidebar'); ?>
                </div>
            </div>
        </div>
    </div>
</div>






<?php get_footer(); ?>