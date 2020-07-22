<?php
if ( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Shortcode_Special_Offer"
 * @version 1.0.0
 */
if ( !class_exists( 'Ovic_Shortcode_Special_Offer' ) ) {
	class Ovic_Shortcode_Special_Offer extends Ovic_Shortcode
	{
		/**
		 * Shortcode name.
		 *
		 * @var  string
		 */
		public $shortcode = 'special_offer';

		public function output_html( $atts, $content = null )
		{
			$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'ovic_special_offer', $atts ) : $atts;
			// Extract shortcode parameters.
			extract( $atts );
			$css_class   = array( 'ovic-slider-products product' );
			$css_class[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, '', 'ovic_special_offer', $atts );
			/* START */
			ob_start();
			?>
            <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
				<?php
				$products          = array();
				if ( $atts['ids'] ) {
					$products = wc_get_products(
						array(
							'limit'       => -1,
							'post_status' => 'published',
							'include'     => (array)explode( ',', $atts['ids'] ),
						)
					);
				}
				if ( !empty( $products ) ):
					$id_primary = uniqid( 'primary' );
					$id_thumb      = uniqid( 'thumb' );
					$slick_primary = array(
						'infinite'     => false,
						'autoplay'     => false,
						'fade'         => true,
						'slidesToShow' => 1,
						'asNavFor'     => ".$id_thumb",
					);
					$slick_thumb   = array(
						'infinite'      => false,
						'autoplay'      => false,
						'focusOnSelect' => true,
						'slidesToShow'  => 3,
						'slidesMargin'  => 0,
						'vertical'  	=> true,
						'asNavFor'      => ".$id_primary",
						'responsive'    => array(
							array(
								'breakpoint' => 992,
								'settings'   => array(
									'vertical'  => false,
									'slidesMargin'  => 10,
								),
							),
							array(
								'breakpoint' => 768,
								'settings'   => array(
									'slidesMargin'  => 10,
									'vertical'  => false,
								),
							),
							array(
								'breakpoint' => 480,
								'settings'   => array(
									'slidesMargin'  => 10,
									'vertical'  => false,
								),
							),
						),
					);
					?>
					<div class="product-container clearfix">
	                    <div class="second-thumbnail owl-slick <?php echo esc_attr( $id_thumb ); ?>"
	                         data-slick="<?php echo esc_attr( json_encode( $slick_thumb ) ); ?>">
							<?php
							foreach ( $products as $product ) {
								$thumbnail = apply_filters( 'ovic_resize_image', get_post_thumbnail_id( $product->get_id() ), 96, 96, true, true ); ?>
	                            <div class="item"><?php echo wp_kses_post( $thumbnail['img'] ); ?></div>
							<?php } ?>
	                    </div>
	                    <div class="primary-offer owl-slick <?php echo esc_attr( $id_primary ); ?>"
	                         data-slick="<?php echo esc_attr( json_encode( $slick_primary ) ); ?>">
							<?php
							add_filter( 'ovic_shop_product_thumb_width', function () { return 498; } );
							add_filter( 'ovic_shop_product_thumb_height', function () { return 457; } );
							foreach ( $products as $product ) :
								$post_object = get_post( $product->get_id() );
								setup_postdata( $GLOBALS['post'] =& $post_object );
								?>
	                            <div class="product-offer-item">
	                                <div <?php post_class( 'product-item' ); ?>>
	                                    <div class="product-inner clearfix">
	                                    	<div class="product-thumb">
												<?php
												/**
												 * woocommerce_before_shop_loop_item_title hook.
												 *
												 * @hooked woocommerce_show_product_loop_sale_flash - 10
												 * @hooked woocommerce_template_loop_product_thumbnail - 10
												 */
												do_action( 'woocommerce_before_shop_loop_item_title' );
												?>
	                                        </div>
	                                        <div class="product-info summary">
												<?php
												/**
												 * woocommerce_shop_loop_item_title hook.
												 *
												 * @hooked woocommerce_template_loop_product_title - 10
												 */
												do_action( 'woocommerce_shop_loop_item_title' );
												/**
												 * woocommerce_after_shop_loop_item_title hook.
												 *
												 * @hooked woocommerce_template_loop_rating - 5
												 * @hooked woocommerce_template_loop_price - 10
												 */
												do_action( 'woocommerce_after_shop_loop_item_title' );
												?>
	                                            <div class="product-deal">
													<?php do_action( 'biolife_function_shop_loop_item_countdown' ); ?>
	                                            </div>
	                                            <div class="product-process">
	                                            	<?php biolife_shop_loop_process_available(); ?>
	                                            </div>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
							<?php endforeach;
							remove_all_filters( 'ovic_shop_product_thumb_width' );
							remove_all_filters( 'ovic_shop_product_thumb_height' ); ?>
	                    </div>
                    </div>
				<?php endif; ?>
            </div>
			<?php
			$html = ob_get_clean();

			return apply_filters( 'Ovic_Shortcode_Special_Offer', $html, $atts, $content );
		}
	}

	new Ovic_Shortcode_Special_Offer();
}