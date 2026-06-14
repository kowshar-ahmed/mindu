<?php get_header(); ?>




<div class="tp-postbox-area pt-140 pb-100">
    <div class="container container-1324">
        <div class="row">
            <div class="col-lg-8">
                <div class="postbox-wrapper mr-50 mb-40">
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <?php echo get_template_part('template-parts/content'); ?>
                        <?php endwhile; ?>
                        <?php else : ?>
                            <p>No posts found.</p>
                    <?php endif; ?>

                    <div class="pt-5">
                        <nav class="navigation pagination wp-pagination">
                            <div class="nav-links">
                                <?php mindu_blog_pagination(); ?>
                            </div>
                        </nav>
                    </div>
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