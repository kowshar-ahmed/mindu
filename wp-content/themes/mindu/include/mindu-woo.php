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
                <div class="tp-product-details-rating">
                    <span><i class="fa-solid fa-star"></i></span>
                    <span><i class="fa-solid fa-star"></i></span>
                    <span><i class="fa-solid fa-star"></i></span>
                    <span><i class="fa-solid fa-star"></i></span>
                    <span><i class="fa-solid fa-star"></i></span>
                </div>
                <div class="tp-product-details-reviews">
                    <span>(36 Reviews)</span>
                </div>
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
            <h3 class="tp-product-details-action-title">Quantity</h3>
            <div class="tp-product-details-action-item-wrapper d-flex align-items-center">
                <div class="tp-product-details-quantity">
                    <div class="tp-product-quantity mb-15 mr-15">
                        <span class="tp-cart-minus">
                            <svg width="11" height="2" viewBox="0 0 11 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 1H10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                        <input class="tp-cart-input" type="text" value="1">
                        <span class="tp-cart-plus">
                            <svg width="11" height="12" viewBox="0 0 11 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 6H10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M5.5 10.5V1.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="tp-product-details-add-to-cart mb-15 w-100">
                    <button class="tp-product-details-add-to-cart-btn w-100">Add To Cart</button>
                </div>
            </div>
            <button class="tp-product-details-buy-now-btn w-100">Buy Now</button>
        </div>
        <?php woocommerce_template_single_meta(); ?>
        
        <div class="tp-product-details-social">
            <span>Share: </span>
            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#">
                <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4.41177 0H0L5.23083 6.87316L0.334618 12.6389H2.59681L6.29998 8.27809L9.58823 12.5988H14L8.6172 5.52593L8.62673 5.53813L13.2614 0.0802914H10.9992L7.55741 4.13336L4.41177 0ZM2.43522 1.20371H3.80866L11.5648 11.395H10.1913L2.43522 1.20371Z" fill="currentcolor"></path>
                </svg>
            </a>
            <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="#"><i class="fa-brands fa-vimeo-v"></i></a>
        </div>
        <div class="tp-product-details-msg mb-15">
            <ul>
                <li>30 days easy returns</li>
                <li>Order yours before 2.30pm for same day dispatch</li>
            </ul>
        </div>
        <div class="tp-product-details-payment d-inline-flex align-items-center flex-wrap justify-content-between">
            <p>Guaranteed safe <br> & secure checkout</p>
            <img src="assets/img/product/small/payment-option.png" alt="">
        </div>
    </div>





<?php


}


add_action('woocommerce_single_product_summary', 'mindu_product_single', 20);
