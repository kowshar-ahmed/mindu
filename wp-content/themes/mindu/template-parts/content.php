<article id="post-<?php the_ID(); ?>" <?php post_class('postbox-item mb-45'); ?>>
    <div class="tp-blog-item mb-40">

        <?php echo get_template_part('template-parts/blog/post-formate'); ?>
        
        <div class="tp-blog-content">
            <?php echo get_template_part('template-parts/blog/blog-meta'); ?>
            
            <h3 class="tp-blog-title fs-32 fw-600 mb-15">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <p class="fw-500"><?php the_excerpt(); ?></p>
        </div>
    </div>
</article>