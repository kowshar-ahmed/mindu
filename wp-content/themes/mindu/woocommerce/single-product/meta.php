<?php

/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.7.0
 */

use Automattic\WooCommerce\Enums\ProductType;

if (! defined('ABSPATH')) {
	exit;
}

global $product;
$cats = get_the_terms(get_the_ID(), 'product_cat');
$tags = get_the_terms(get_the_ID(), 'product_tag');

?>


<div class="tp-product-details-query">

	<?php if (wc_product_sku_enabled() && ($product->get_sku() || $product->is_type(ProductType::VARIABLE))) : ?>
		<div class="tp-product-details-query-item d-flex align-items-center">
			<span><?php esc_html_e('SKU:', 'woocommerce'); ?> </span>
			<p><?php echo ($sku = $product->get_sku()) ? $sku : esc_html__('N/A', 'woocommerce'); ?></p>
		</div>
	<?php endif; ?>

	<div class="tp-product-details-query-item d-flex align-items-center">
		<span><?php esc_html_e('Category:', 'woocommerce'); ?> </span>
		<p>
			<?php
			$html = '';
			$count = 0;
			foreach ($cats as $key => $cat) {

				$html .= '<a href="' . get_category_link($cat->term_id) . '">' . $cat->name . '</a>, ';

				$count++;
				if ($count == 4) {
					break;
				}
			}
			echo rtrim($html, ', ');
			?>
		</p>
	</div>
	<div class="tp-product-details-query-item d-flex align-items-center">
		<span><?php esc_html_e('Tag:', 'woocommerce'); ?> </span>
		<p>
			<?php
			$html = '';
			$count = 0;
			foreach ($tags as $key => $tag) {

				$html .= '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>, ';

				$count++;
				if ($count == 4) {
					break;
				}
			}
			echo rtrim($html, ', ');
			?>
		</p>
	</div>
</div>

