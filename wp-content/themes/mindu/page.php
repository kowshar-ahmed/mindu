<?php get_header(); ?>



<div class="tp-page-area pt-100 pb-100">
    <div class="container container-1324">
        <div class="postbox-wrapper mr-50 mb-40">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
            <?php else : ?>
                <p>No posts found.</p>
            <?php endif; ?>
        </div>
    </div>
</div>






<?php get_footer(); ?>