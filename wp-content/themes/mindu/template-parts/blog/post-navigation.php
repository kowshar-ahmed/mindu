<?php
$prev_post = get_previous_post();
$next_post = get_next_post();
?>


<div class="tp-blog-details-navigation mb-60">
    <div class="row align-items-center">
        <div class="col-xl-4 col-lg-4 col-md-4 col-12">
            <div class="tp-blog-details-navigation-content text-start text-md-start">
                <a class="tp-blog-details-navigation-btn" href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>">
                    <span>
                        <svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M5 1.5L1 5.5L5 9.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span><?php echo esc_html__('PREVIOUS', 'mindu'); ?>
                </a>
                <h2 class="tp-blog-details-navigation-title">
                    <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>"><?php echo esc_html(get_the_title($prev_post->ID)); ?></a>
                </h2>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-12">
            <div class="tp-blog-details-navigation-bar text-start text-md-center">
                <a href="#">
                    <span>
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.5" d="M0.75 4.96053C0.75 2.97567 0.75 1.98323 1.36662 1.36662C1.98323 0.75 2.97567 0.75 4.96053 0.75C6.94539 0.75 7.93782 0.75 8.55444 1.36662C9.17105 1.98323 9.17105 2.97567 9.17105 4.96053C9.17105 6.94539 9.17105 7.93782 8.55444 8.55444C7.93782 9.17105 6.94539 9.17105 4.96053 9.17105C2.97567 9.17105 1.98323 9.17105 1.36662 8.55444C0.75 7.93782 0.75 6.94539 0.75 4.96053Z" stroke="#1F242E" stroke-width="1.5" />
                            <path opacity="0.5" d="M12.3281 16.5396C12.3281 14.5548 12.3281 13.5623 12.9447 12.9457C13.5614 12.3291 14.5538 12.3291 16.5387 12.3291C18.5235 12.3291 19.5159 12.3291 20.1326 12.9457C20.7492 13.5623 20.7492 14.5548 20.7492 16.5396C20.7492 18.5245 20.7492 19.5169 20.1326 20.1335C19.5159 20.7502 18.5235 20.7502 16.5387 20.7502C14.5538 20.7502 13.5614 20.7502 12.9447 20.1335C12.3281 19.5169 12.3281 18.5245 12.3281 16.5396Z" stroke="#1F242E" stroke-width="1.5" />
                            <path d="M0.75 16.5394C0.75 14.5545 0.75 13.5621 1.36662 12.9455C1.98323 12.3289 2.97567 12.3289 4.96053 12.3289C6.94539 12.3289 7.93782 12.3289 8.55444 12.9455C9.17105 13.5621 9.17105 14.5545 9.17105 16.5394C9.17105 18.5242 9.17105 19.5167 8.55444 20.1333C7.93782 20.7499 6.94539 20.7499 4.96053 20.7499C2.97567 20.7499 1.98323 20.7499 1.36662 20.1333C0.75 19.5167 0.75 18.5242 0.75 16.5394Z" stroke="#1F242E" stroke-width="1.5" />
                            <path d="M12.3281 4.96053C12.3281 2.97567 12.3281 1.98323 12.9447 1.36662C13.5614 0.75 14.5538 0.75 16.5387 0.75C18.5235 0.75 19.5159 0.75 20.1326 1.36662C20.7492 1.98323 20.7492 2.97567 20.7492 4.96053C20.7492 6.94539 20.7492 7.93782 20.1326 8.55444C19.5159 9.17105 18.5235 9.17105 16.5387 9.17105C14.5538 9.17105 13.5614 9.17105 12.9447 8.55444C12.3281 7.93782 12.3281 6.94539 12.3281 4.96053Z" stroke="#1F242E" stroke-width="1.5" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-12">
            <div class="tp-blog-details-navigation-content next text-start text-md-end">
                <a class="tp-blog-details-navigation-btn" href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">
                    <?php echo esc_html__('Next', 'mindu'); ?>
                    <span>
                        <svg width="6" height="11" viewBox="0 0 6 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 1.5L5 5.5L1 9.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                </a>
                <h2 class="tp-blog-details-navigation-title">
                    <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>"><?php echo esc_html(get_the_title($next_post->ID)); ?></a>
                </h2>
            </div>
        </div>
    </div>
</div>