<?php if (has_post_format('image')) : ?>

    <?php if (has_post_thumbnail()) : ?>
        <div class="tp-blog-thumb overflow-hidden mb-35">s
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail(); ?>
            </a>
        </div>
    <?php endif; ?>

<?php elseif (has_post_format('video')) :
    $video_url = function_exists('tpmeta_field') ? tpmeta_field('formate_video_url') : '';

?>

    <?php if (has_post_thumbnail()) : ?>
        <div class="tp-blog-thumb postbox-overly p-relative overflow-hidden mb-35">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail(); ?>
            </a>
            <?php if (!empty($video_url)) : ?>
                <div class="postbox-video">
                    <a class="popup-video" href="<?php echo esc_url($video_url); ?>">
                        <span>
                            <svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 1.83167C0 1.0405 0.875246 0.562658 1.54076 0.990487L12.6915 8.15882C13.3038 8.55246 13.3038 9.44754 12.6915 9.84118L1.54076 17.0095C0.875246 17.4373 0 16.9595 0 16.1683V1.83167Z" fill="#031F42" />
                            </svg>
                        </span>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>




<?php elseif (has_post_format('audio')) :
    $audio_url = function_exists('tpmeta_field') ? tpmeta_field('format_audio') : '';

?>
    <?php if (!empty($audio_url)) : ?>
        <div class="tp-blog-thumb overflow-hidden mb-35">
            <div class="ratio ratio-16x9">
                <?php echo wp_oembed_get($audio_url); ?>
            </div>
        </div>
    <?php endif; ?>





<?php elseif (has_post_format('gallery')) :
    $gallery_images = function_exists('tpmeta_gallery_field') ? tpmeta_gallery_field('format_gallery') : '';
?>

    <?php if (!empty($gallery_images)) : ?>

    <div class="tp-postbox-slider-wrap p-relative mb-35">
        <div class="swiper postbox-gallery-active">
            <div class="swiper-wrapper">
                <?php foreach ($gallery_images as $image) : ?>
                    <div class="swiper-slide">
                        <div class="tp-blog-thumb overflow-hidden p-relative">
                            <a href="blog-details.html">
                                <img class="w-100" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_url($image['alt']); ?>">
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="postbox-gallery-navigation">
            <button class="postbox-gallery-arrow-prev">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M14.75 7.75H0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M7.75 14.75L0.75 7.75L7.75 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <button class="postbox-gallery-arrow-next">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.75 7.75H14.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M7.75 14.75L14.75 7.75L7.75 0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </div>
    <?php endif; ?>

<?php else : ?>
    <?php if (has_post_thumbnail()) : ?>

        <div class="tp-blog-thumb overflow-hidden mb-35">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail(); ?>
            </a>
        </div>
    <?php endif; ?>
<?php endif; ?>