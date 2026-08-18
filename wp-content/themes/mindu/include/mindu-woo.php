<?php

// archive hook
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_shop_loop_header', 'woocommerce_product_taxonomy_archive_header', 10);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

// content product hook
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

// single product hook
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
// remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

// wpc compare button remove
add_filter('woosc_button_position_archive', '__return_false');
add_filter('woosc_button_position_single', '__return_false');

// wpc quick view button remove
add_filter('woosq_button_position', '__return_false');

// wpc wishlist button remove
add_filter('woosw_button_position_archive', '__return_false');
add_filter('woosw_button_position_single', '__return_false');





// product add to cart button
function mindu_wooc_add_to_cart($args = array())
{
    global $product;

    if ($product) {
        $defaults = array(
            'quantity'   => 1,
            'class'      => implode(
                ' ',
                array_filter(
                    array(
                        'tp-product-add-cart-btn-large',
                        'product_type_' . $product->get_type(),
                        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                        $product->supports('ajax_add_to_cart') && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
                    )
                )
            ),
            'attributes' => array(
                'data-product_id'  => $product->get_id(),
                'data-product_sku' => $product->get_sku(),
                'aria-label'       => $product->add_to_cart_description(),
                'rel'              => 'nofollow',
            ),
        );

        $args = wp_parse_args($args, $defaults);

        if (isset($args['attributes']['aria-label'])) {
            $args['attributes']['aria-label'] = wp_strip_all_tags($args['attributes']['aria-label']);
        }
    }


    // check product type 
    if ($product->is_type('simple')) {
        $btntext = esc_html__("Add to Cart", 'kindaid');
    } elseif ($product->is_type('variable')) {
        $btntext = esc_html__("Select Options", 'kindaid');
    } elseif ($product->is_type('external')) {
        $btntext = esc_html__("Buy Now", 'kindaid');
    } elseif ($product->is_type('grouped')) {
        $btntext = esc_html__("View Products", 'kindaid');
    } else {
        $btntext = esc_html__("Add to Cart", 'kindaid');
    }

    echo sprintf(
        '<a title="%s" href="%s" data-quantity="%s" class="%s" %s>%s</a>',
        $btntext,
        esc_url($product->add_to_cart_url()),
        esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
        esc_attr(isset($args['class']) ? $args['class'] : 'tp-btn text-capitalize w-100 justify-content-center'),
        isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
        '' . $btntext
    );
}






function mindu_product()
{
    global $product;

    $cats = get_the_terms(get_the_ID(), 'product_cat');

?>

    <div class="tp-product-item mb-50">
        <div class="tp-product-thumb mb-15 fix p-relative z-index-1">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('full', ['class' => 'w-100']); ?>
            </a>
            <div class="tp-product-badge">
                <?php woocommerce_show_product_loop_sale_flash(); ?>
            </div>
            <!-- product action -->
            <div class="tp-product-action tp-product-action-blackStyle">
                <div class="tp-product-action-item d-flex flex-column">

                    <div type="button" class="tp-product-action-btn tp-product-add-cart-btn">
                        <?php echo do_shortcode('[woosc]'); ?>
                        <span class="tp-product-tooltip">Add To Compare</span>
                    </div>
                    <div type="button" class="tp-product-action-btn tp-product-quick-view-btn" data-bs-toggle="modal" data-bs-target="#producQuickViewModal">
                        <?php echo do_shortcode('[woosq]'); ?>
                        <span class="tp-product-tooltip">Quick View</span>
                    </div>
                    <div type="button" class="tp-product-action-btn tp-product-add-to-wishlist-btn">
                        <?php echo do_shortcode('[woosw]'); ?>

                        <span class="tp-product-tooltip">Add To Wishlist</span>
                    </div>
                </div>
            </div>

            <div class="tp-product-add-cart-btn-large-wrapper">
                <?php mindu_wooc_add_to_cart(); ?>
                <!-- <button type="button" class="tp-product-add-cart-btn-large">
                    Add To Cart
                </button> -->
            </div>
        </div>
        <div class="tp-product-content">
            <div class="al-product-tag">
                <?php
                $html = '';
                $count = 0;
                foreach ($cats as $key => $cat) {

                    $html .= '<a href="' . get_category_link($cat->term_id) . '">' . $cat->name . '</a>, ';

                    $count++;
                    if ($count == 2) {
                        break;
                    }
                }
                echo rtrim($html, ', ');
                ?>
            </div>
            <h3 class="tp-product-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h3>
            <div class="tp-product-price-wrapper">
                <?php woocommerce_template_loop_price(); ?>
            </div>
        </div>
    </div>


<?php

}

add_action('woocommerce_before_shop_loop_item', 'mindu_product', 10);





// mindu_product_single
function mindu_product_single()
{
    global $product;
    // var_dump($product);
    $cats = get_the_terms(get_the_ID(), 'product_cat');

    $product_fea = get_theme_mod('product_feature');
    $card_image = get_theme_mod('card_image');
    $card_text = get_theme_mod('card_text');
?>


    <div class="tp-product-details-wrapper">
        <div class="tp-product-details-category">
            <?php
            $html = '';
            $count = 0;
            foreach ($cats as $key => $cat) {

                $html .= '<span><a href="' . get_category_link($cat->term_id) . '">' . $cat->name . '</a></span>, ';

                $count++;
                if ($count == 3) {
                    break;
                }
            }
            echo rtrim($html, ', ');
            ?>
        </div>
        <h3 class="tp-product-details-title"><?php the_title(); ?></h3>

        <!-- inventory details -->
        <div class="tp-product-details-inventory d-flex align-items-center mb-10">
            <div class="tp-product-details-stock mb-10">
                <span><?php echo $product->get_stock_status() === 'instock' ? 'In Stock' : 'Out of Stock'; ?></span>
            </div>
            <div class="tp-product-details-rating-wrapper d-flex align-items-center mb-10">
                <?php woocommerce_template_single_rating(); ?>

            </div>
        </div>
        <div class="tp-product-details-sort-desc">
            <p><?php echo $product->get_short_description(); ?></p>
        </div>

        <!-- price -->
        <div class="tp-product-details-price-wrapper mb-40">
            <?php woocommerce_template_single_price(); ?>

            <!-- <span class="tp-product-details-price old-price">$320.00</span>
            <span class="tp-product-details-price new-price">$236.00</span> -->
        </div>

        <!-- actions -->
        <div class="tp-product-details-action-wrapper">
            <h3 class="tp-product-details-action-title"><?php esc_html_e('Quantity', 'mindu'); ?></h3>
            <?php woocommerce_template_single_add_to_cart(); ?>

        </div>
        <?php woocommerce_template_single_meta(); ?>

        <?php mindu_product_share(); ?>
        <div class="tp-product-details-msg mb-15">
            <?php if ($product_fea) : ?>
                <p><?php echo mindu_kses($product_fea); ?></p>
            <?php endif; ?>
        </div>
        <?php if ($product_fea) : ?>

            <div class="tp-product-details-payment d-inline-flex align-items-center flex-wrap justify-content-between">
                <p><?php echo mindu_kses($card_text); ?></p>
                <img src="<?php echo esc_url($card_image); ?>" alt="">
            </div>
        <?php endif; ?>

    </div>




<?php


}


add_action('woocommerce_single_product_summary', 'mindu_product_single', 20);



// Add "Buy Now" button next to Add to Cart button

function add_buy_now_button()
{
    global $product;

    $product_id = $product->get_id();

    $checkout_url = wc_get_checkout_url();

    echo '<a href="' . esc_url($checkout_url . '?add-to-cart=' . $product_id) . '" class="tp-product-details-buy-now-btn w-100 text-center" style="margin-left: 10px;">Buy Now</a>';
}

add_action('woocommerce_after_add_to_cart_form', 'add_buy_now_button');


// Redirect to checkout page if "Buy Now" button is clicked

function custom_add_to_cart_redirect($url)
{
    if (isset($_REQUEST['add-to-cart']) && has_term('', 'product_cat', $_REQUEST['add-to-cart'])) {
        return wc_get_checkout_url();
    }

    return $url;
}

add_filter('woocommerce_add_to_cart_redirect', 'custom_add_to_cart_redirect');




function mindu_product_share()
{
    // Get current post URL and title
    $post_url   = urlencode(get_permalink());
    $post_title = urlencode(get_the_title());

?>


    <div class="tp-product-details-social">
        <span><?php echo esc_html__('Share: ', 'mindu'); ?></span>
        <!-- Facebook -->
        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post_url; ?>" target="_blank" rel="noopener noreferrer">
            <svg width="8" height="15" viewBox="0 0 8 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8 0H5.81818C4.85376 0 3.92883 0.383116 3.24688 1.06507C2.56493 1.74702 2.18182 2.67194 2.18182 3.63636V5.81818H0V8.72727H2.18182V14.5455H5.09091V8.72727H7.27273L8 5.81818H5.09091V3.63636C5.09091 3.44348 5.16753 3.25849 5.30392 3.1221C5.44031 2.98571 5.6253 2.90909 5.81818 2.90909H8V0Z" fill="currentColor" />
            </svg>
        </a>

        <!-- X (Twitter) -->
        <a href="https://twitter.com/intent/tweet?url=<?php echo $post_url; ?>&text=<?php echo $post_title; ?>" target="_blank" rel="noopener noreferrer">
            <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.41407 0H0L5.23355 6.83748L0.334792 12.5733H2.59816L6.30326 8.23512L9.59323 12.5334H14.0073L8.62168 5.49724L8.63122 5.50938L13.2683 0.0798746H11.0049L7.56134 4.1119L4.41407 0ZM2.43649 1.19746H3.81064L11.5708 11.3359H10.1966L2.43649 1.19746Z" fill="currentColor" />
            </svg>
        </a>

        <!-- Instagram (opens profile — direct post sharing not supported) -->
        <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.75 7.75C0.75 4.45017 0.75 2.80025 1.77513 1.77513C2.80025 0.75 4.45017 0.75 7.75 0.75C11.0498 0.75 12.6997 0.75 13.7249 1.77513C14.75 2.80025 14.75 4.45017 14.75 7.75C14.75 11.0498 14.75 12.6997 13.7249 13.7249C12.6997 14.75 11.0498 14.75 7.75 14.75C4.45017 14.75 2.80025 14.75 1.77513 13.7249C0.75 12.6997 0.75 11.0498 0.75 7.75Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round" />
                <path d="M11.0681 7.75036C11.0681 9.58162 9.58357 11.0661 7.75231 11.0661C5.92105 11.0661 4.43652 9.58162 4.43652 7.75036C4.43652 5.9191 5.92105 4.43457 7.75231 4.43457C9.58357 4.43457 11.0681 5.9191 11.0681 7.75036Z" stroke="currentColor" stroke-width="1.5" />
                <path d="M11.8076 3.69629L11.7974 3.69629" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
    </div>






<?php
}
