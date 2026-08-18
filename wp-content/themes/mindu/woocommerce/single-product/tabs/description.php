<?php

/**
 * Description tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.0.0
 */

defined('ABSPATH') || exit;

global $post;

$heading = apply_filters('woocommerce_product_description_heading', __('Description', 'woocommerce'));

?>



<div class="tp-product-details-desc-wrapper pt-50">
	<div class="row justify-content-center">
		<div class="col-xl-10">
			<div class="tp-product-details-desc-item">
				<div class="row">
					<div class="col-lg-12">
						<div class="tp-product-details-desc-content pt-25">
							<?php if ($heading) : ?>
								<h3 class="tp-product-details-desc-title"><?php echo esc_html($heading); ?></h3>
							<?php endif; ?>
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


