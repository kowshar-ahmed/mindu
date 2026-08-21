<?php 

function mindu_breadcrumb(){ 

		if ( is_front_page() && is_home() ) {
			$title = __('Blog','consora');
		}

		elseif ( is_home() ) {
			if ( get_option( 'page_for_posts' ) ) {
				$title = get_the_title( get_option( 'page_for_posts') );
			}
		}

		/* ================= SINGLE ================= */
		elseif ( is_single() && 'post' == get_post_type() ) {
			$title = get_the_title();
		} 
		elseif ( is_single() && 'service' == get_post_type() ) {
			$title = get_the_title();
		} 
		elseif ( is_single() && 'product' == get_post_type() ) {
			$title = get_theme_mod( 'breadcrumb_product_details', __( 'Shop', 'consora' ) );
		}

		/* ================= PAGE ================= */
		elseif ( is_page() ) {
			$title = get_the_title();
		}

		/* ================= TAXONOMY ================= */
		elseif ( is_category() ) {
			$title = single_cat_title('', false);
		}
		elseif ( is_tag() ) {
			$title = single_tag_title('', false);
		}
		elseif ( is_tax() ) {
			$title = single_term_title('', false);
		}

		/* ================= WOOCOMMERCE ================= */
		elseif ( function_exists('is_shop') && is_shop() ) {
			$title = get_the_title( wc_get_page_id( 'shop' ) );
		}
		elseif ( function_exists('is_product_category') && is_product_category() ) {
			$title = single_term_title('', false);
		}
		elseif ( function_exists('is_product_tag') && is_product_tag() ) {
			$title = single_term_title('', false);
		}

		/* ================= SEARCH / ERROR ================= */
		elseif ( is_search() ) {
			$title = esc_html__( 'Search Results for: ', 'consora' ) . get_search_query();
		}
		elseif ( is_404() ) {
			$title = esc_html__( '404 Page not Found', 'consora' );
		}

		/* ================= ARCHIVE ================= */
		elseif ( is_author() ) {
			$title = get_the_author();
		}
		elseif ( is_date() ) {
			$title = get_the_archive_title();
		}
		elseif ( is_archive() ) {
			$title = get_the_archive_title();
		}

		/* ================= FALLBACK ================= */
		else {
			$title = get_the_title();
		}
    
   $breadcrumb_page_switch = function_exists('tpmeta_field')? tpmeta_field('breadcrumb_page_switch') : true;

   $breadcrumb_global = get_theme_mod('tp_breadcrum_switch',true);

	$breadcrumb_image = get_theme_mod('breadcrumb_image');

   $breadcrumb_on_off = $breadcrumb_global && ($breadcrumb_page_switch == true);

    ?>

      <!-- <?php if($breadcrumb_on_off) : ?> -->

      <div class="tp-breadcrumb-area tp-breadcrumb-2 tp-breadcrumb-3 p-relative bg-grey-4" style="background-image: url(<?php echo esc_url($breadcrumb_image); ?>">

         <img class="tp-breadcrumb-3-shape d-none d-xl-block" src="<?php echo get_template_directory_uri(); ?>/assets/img/breadcrumb/shape.png" alt="">
         <img class="tp-breadcrumb-3-shape-2 d-none d-xl-block" src="<?php echo get_template_directory_uri(); ?>/assets/img/breadcrumb/shape-2.png" alt="">
         <img class="tp-breadcrumb-3-shape-3 d-none d-xl-block" src="<?php echo get_template_directory_uri(); ?>/assets/img/breadcrumb/shape-3.png" alt="">

         <div class="container">
            <div class="row">
               <div class="col-12">
                  <div class="tp-breadcrumb-3-content text-center">
                    <?php if( function_exists('tp_breadcrumb')) : ?> 
				  	<div class="tp-breadcrumb-list wow fadeInUp mb-10" data-wow-duration=".9s" data-wow-delay=".4s">
						<?php 
							tp_breadcrumb( array(
								'separator'  => '›',
								'type'      => '',
							) ); 
						?>
                     </div>
					 <?php endif; ?>

                     <h2 class="tp-breadcrumb-title text-black mb-0 fw-700 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".3s"><?php echo mindu_kses($title);?></h2>
                  </div>
               </div>
            </div>
         </div>
      </div>   



      <?php endif; ?>

<?php    
}

add_action('mindu_before_header','mindu_breadcrumb',11);