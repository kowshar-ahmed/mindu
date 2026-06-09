<?php
$author_id = get_the_author_meta('ID');

$author_name = get_the_author_meta('display_name', $author_id);
$author_description = get_the_author_meta('description', $author_id);
$author_image = get_avatar_url($author_id, ['size' => 100]);

$fb_url = get_the_author_meta('fb_url', $author_id);
$tw_url = get_the_author_meta('tw_url', $author_id);
$ins_url = get_the_author_meta('ins_url', $author_id);
?>




<div class="tp-blog-details-author-box mb-115 p-relative">
    <div class="tp-blog-details-author-wrap d-flex align-items-center">
        <div class="tp-blog-details-author-avata">
            <img src="<?php echo esc_url($author_image); ?>" alt="<?php echo esc_attr($author_name); ?>">
        </div>
        <div class="tp-blog-details-author-content">
            <h2><?php echo esc_html($author_name); ?></h2>
            <p><?php echo esc_html($author_description); ?></p>
        </div>
    </div>
    <div class="tp-blog-details-author-social">
        <a href="<?php echo esc_url($fb_url); ?>" target="_blank">
            <svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 0H5.81818C4.85376 0 3.92883 0.383116 3.24688 1.06507C2.56493 1.74702 2.18182 2.67194 2.18182 3.63636V5.81818H0V8.72727H2.18182V14.5455H5.09091V8.72727H7.27273L8 5.81818H5.09091V3.63636C5.09091 3.44348 5.16753 3.25849 5.30392 3.1221C5.44031 2.98571 5.6253 2.90909 5.81818 2.90909H8V0Z" fill="currentColor" />
            </svg>
        </a>
        <a href="<?php echo esc_url($tw_url); ?>" target="_blank">
            <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.41407 0H0L5.23355 6.83748L0.334792 12.5733H2.59816L6.30326 8.23512L9.59323 12.5334H14.0073L8.62168 5.49724L8.63122 5.50938L13.2683 0.0798746H11.0049L7.56134 4.1119L4.41407 0ZM2.43649 1.19746H3.81064L11.5708 11.3359H10.1966L2.43649 1.19746Z" fill="currentColor" />
            </svg>
        </a>
        <a href="<?php echo esc_url($ins_url); ?>" target="_blank">
            <svg width="11" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.75 7.75C0.75 4.45017 0.75 2.80025 1.77513 1.77513C2.80025 0.75 4.45017 0.75 7.75 0.75C11.0498 0.75 12.6997 0.75 13.7249 1.77513C14.75 2.80025 14.75 4.45017 14.75 7.75C14.75 11.0498 14.75 12.6997 13.7249 13.7249C12.6997 14.75 11.0498 14.75 7.75 14.75C4.45017 14.75 2.80025 14.75 1.77513 13.7249C0.75 12.6997 0.75 11.0498 0.75 7.75Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                <path d="M11.0681 7.75036C11.0681 9.58162 9.58357 11.0661 7.75231 11.0661C5.92105 11.0661 4.43652 9.58162 4.43652 7.75036C4.43652 5.9191 5.92105 4.43457 7.75231 4.43457C9.58357 4.43457 11.0681 5.9191 11.0681 7.75036Z" stroke="currentColor" stroke-width="1.5" />
                <path d="M11.8076 3.69629L11.7974 3.69629" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
    </div>
</div>