<?php
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Ovic Products Slide
 *
 * Displays Products Slide widget.
 *
 * @author   Khanh
 * @category Widgets
 * @package  Ovic/Widgets
 * @version  1.0.0
 * @extends  OVIC_Widget
 */
if ( class_exists( 'OVIC_Widget' ) ) {
	if ( !class_exists( 'Products_Slide_Widget' ) ) {
		class Products_Slide_Widget extends OVIC_Widget
		{
			/**
			 * Constructor.
			 */
			public function __construct()
			{
				$array_settings           = apply_filters( 'ovic_filter_settings_widget_product_slide',
					array(
						'title'    => array(
							'type'  => 'text',
							'title' => esc_html__( 'Title', 'biolife' ),
						),
						'target'   => array(
							'type'       => 'select',
							'options'    => array(
								'best-selling'      => esc_html__( 'Best Selling Products', 'biolife' ),
								'top-rated'         => esc_html__( 'Top Rated Products', 'biolife' ),
								'recent-product'    => esc_html__( 'Recent Products', 'biolife' ),
								'featured_products' => esc_html__( 'Featured Products', 'biolife' ),
								'on_sale'           => esc_html__( 'On Sale', 'biolife' ),
								'on_new'            => esc_html__( 'On New', 'biolife' ),
							),
							'attributes' => array(
								'data-depend-id' => 'target',
								'style'          => 'width: 100%;',
							),
							'title'      => esc_html__( 'Choose Target', 'biolife' ),
						),
						'orderby'  => array(
							'type'       => 'select',
							'options'    => array(
								'date'          => esc_html__( 'Date', 'biolife' ),
								'ID'            => esc_html__( 'ID', 'biolife' ),
								'author'        => esc_html__( 'Author', 'biolife' ),
								'title'         => esc_html__( 'Title', 'biolife' ),
								'modified'      => esc_html__( 'Modified', 'biolife' ),
								'rand'          => esc_html__( 'Random', 'biolife' ),
								'comment_count' => esc_html__( 'Comment count', 'biolife' ),
								'menu_order'    => esc_html__( 'Menu order', 'biolife' ),
								'_sale_price'   => esc_html__( 'Sale price', 'biolife' ),
							),
							'attributes' => array(
								'style' => 'width: 100%;',
							),
							'title'      => esc_html__( 'Order By', 'biolife' ),
						),
						'order'    => array(
							'type'       => 'select',
							'options'    => array(
								'ASC'  => esc_html__( 'ASC', 'biolife' ),
								'DESC' => esc_html__( 'DESC', 'biolife' ),
							),
							'attributes' => array(
								'style' => 'width: 100%;',
							),
							'title'      => esc_html__( 'Order', 'biolife' ),
						),
						'per_page' => array(
							'type'  => 'number',
							'title' => esc_html__( 'Product per page', 'biolife' ),
						),
					)
				);
				$this->widget_cssclass    = 'widget-products-slide';
				$this->widget_description = esc_html__( 'Display the customer Products Slide.', 'biolife' );
				$this->widget_id          = 'widget_products';
				$this->widget_name        = esc_html__( 'Ovic: Products Slide', 'biolife' );
				$this->settings           = $array_settings;
				parent::__construct();
			}

			/**
			 * Output widget.
			 *
			 * @see WP_Widget
			 *
			 * @param array $args
			 * @param array $instance
			 */
			public function widget( $args, $instance )
			{
				$this->widget_start( $args, $instance );
				ob_start();
				$product_item_class   = array( 'product-item' );
				$product_item_class[] = 'style-2';
				$atts                 = array(
					'owl_loop'       => 'false',
					'owl_autoplay'   => 'false',
					'owl_slidespeed' => '400',
					'owl_number_row' => '3',
					'owl_ts_items'   => 1,
					'owl_xs_items'   => 1,
					'owl_sm_items'   => 1,
					'owl_md_items'   => 1,
					'owl_lg_items'   => 1,
					'owl_ls_items'   => 1,
				);
				$owl_settings         = apply_filters( 'ovic_carousel_data_attributes', 'owl_', $atts );
				$products             = apply_filters( 'ovic_getProducts', $instance );
				?>
				<div class="ovic-products">
					<?php if ( $products->have_posts() ): ?>
						<ul class="product-list-owl owl-slick equal-container better-height" <?php echo esc_attr( $owl_settings ); ?>>
							<?php while ( $products->have_posts() ) : $products->the_post(); ?>
								<li <?php post_class( $product_item_class ); ?>>
									<?php get_template_part( 'woocommerce/product-styles/content-product-style', '2' ); ?>
								</li>
							<?php endwhile; ?>
							<?php wp_reset_postdata(); ?>
						</ul>
					<?php else: ?>
						<p>
							<strong><?php esc_html_e( 'No Product', 'biolife' ); ?></strong>
						</p>
					<?php endif; ?>
				</div>
				<?php
				echo apply_filters( 'ovic_filter_widget_product_slide', ob_get_clean(), $instance );
				$this->widget_end( $args );
			}
		}
	}
	/**
	 * Register Widgets.
	 *
	 * @since 2.3.0
	 */
	function Products_Slide_Widget()
	{
		register_widget( 'Products_Slide_Widget' );
	}

	add_action( 'widgets_init', 'Products_Slide_Widget' );
}