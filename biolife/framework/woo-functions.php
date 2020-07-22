<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 *
 * SINGLE PRODUCT STYLE
 */
add_filter( 'ovic_thumb_product_single_slide',
	function ( $atts ) {
		$atts['owl_slide_margin'] = 10;

		return $atts;
	}
);
add_filter( 'ovic_carousel_related_single_product',
	function ( $atts ) {
		$atts['owl_slide_margin'] = 20;

		return $atts;
	}
);
add_filter( 'ovic_filter_related_title_product', 'biolife_related_title_product', 10, 2 );
/* breadcrumb */
remove_action( 'woocommerce_before_main_content', 'ovic_woocommerce_breadcrumb', 20 );
add_action( 'woocommerce_before_main_content', 'ovic_woocommerce_breadcrumb', 45 );
/* SHOP CONTROL */
add_filter( 'ovic_before_shop_control_html', 'biolife_before_shop_control' );
remove_action( 'ovic_control_after_content', 'woocommerce_result_count', 10 );
/*QUICKVIEW*/
remove_action( 'yith_wcqv_product_image', 'woocommerce_show_product_images', 20 );
add_action( 'yith_wcqv_product_image', 'biolife_quick_view_thumb', 20 );
remove_action( 'yith_wcqv_product_image', 'woocommerce_show_product_sale_flash', 10 );
add_action( 'yith_wcqv_product_summary', 'woocommerce_show_product_sale_flash', 12 );
add_action( 'yith_wcqv_product_summary', 'ovic_share_button', 30 );
// PRODUCT RATING
add_filter( 'woocommerce_product_get_rating_html', 'biolife_product_get_rating_html', 10, 3 );

add_action( 'biolife_woocommerce_template_loop_rating', 'biolife_woocommerce_template_loop_rating' );


add_action( 'woocommerce_archive_description', 'biolife_display_woocommerce_featured_products', 5 );

if ( ! function_exists( 'biolife_display_woocommerce_featured_products' ) ) {
	function biolife_display_woocommerce_featured_products()
	{
		$feature_products_enable = apply_filters( 'ovic_get_option', 'feature_products_enable', 'disable' );
		if ( $feature_products_enable == 'enable' ) {
			$atts = array(
				'target'   => 'featured_products',
				'orderby'  => 'date',
				'order'    => 'DESC',
				'per_page' => 6,
			);
			if ( is_product_category() ) {
				global $wp_query;
				$category = $wp_query->get_queried_object();
				if ( $category ) {
					$atts['taxonomy'] = $category->slug;
				}
			}
			$products = apply_filters( 'ovic_getProducts', $atts );
			if ( $products->have_posts() ) {
				$feature_product_style = apply_filters( 'ovic_get_option', 'feature_product_style', 3 );
				if ( $feature_product_style ) {
					$feature_product_style = 'style-' . $feature_product_style;
				} else {
					$feature_product_style = 'style-3';
				}
				$owl_settings['owl_slide_margin']    = 20;
				$owl_settings['owl_vertical']        = false;
				$owl_settings['owl_verticalswiping'] = false;
				$owl_settings['owl_number_row']      = 1;
				$owl_settings['owl_navigation']      = true;
				$owl_settings['owl_ts_items']        = apply_filters( 'ovic_get_option', 'feature_products_ts_items', 1 );
				$owl_settings['owl_xs_items']        = apply_filters( 'ovic_get_option', 'feature_products_xs_items', 2 );
				$owl_settings['owl_sm_items']        = apply_filters( 'ovic_get_option', 'feature_products_sm_items', 3 );
				$owl_settings['owl_md_items']        = apply_filters( 'ovic_get_option', 'feature_products_md_items', 4 );
				$owl_settings['owl_lg_items']        = apply_filters( 'ovic_get_option', 'feature_products_lg_items', 5 );
				$owl_settings['owl_ls_items']        = apply_filters( 'ovic_get_option', 'feature_products_ls_items', 5 );
				$owl_atts                            = apply_filters( 'ovic_carousel_data_attributes', 'owl_',
					$owl_settings );
				?>
                <div class="featured_products product-list-owl owl-slick equal-container better-height" <?php echo esc_attr( $owl_atts ); ?>>
					<?php while ( $products->have_posts() ) : $products->the_post(); ?>
                        <div <?php post_class( array( 'product-item', $feature_product_style ) ); ?>>
							<?php do_action( 'ovic_product_template', $feature_product_style ); ?>
                        </div>
					<?php endwhile; ?>
                </div>
				<?php
			}
			wp_reset_postdata();
		}
	}
}

if ( ! function_exists( 'biolife_woocommerce_template_loop_rating' ) ) {
	function biolife_woocommerce_template_loop_rating()
	{
		global $product;
		if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
			return;
		}
		$review_count = $product->get_review_count();
		$average      = $product->get_average_rating();
		$html         = '<div class="rating-wapper">';
		$html         .= '<span class="star-rating"><span style="width:' . ( ( $average / 5 ) * 100 ) . '%"></span></span>';
		if ( $review_count > 1 ) {
			$html .= '<span class="review-count">(' . $review_count . ' ' . esc_html__( 'Reviews',
					'biolife' ) . ')</span>';
		} else {
			$html .= '<span class="review-count">(' . $review_count . ' ' . esc_html__( 'Review',
					'biolife' ) . ')</span>';
		}
		$html .= '</div>';
		echo wp_specialchars_decode( $html );
	}
}


if ( ! function_exists( 'biolife_product_get_rating_html' ) ) {
	function biolife_product_get_rating_html( $html, $rating, $count )
	{
		$html = '<div class="rating-wapper"><div class="star-rating">';
		$html .= wc_get_star_rating_html( $rating, $count );
		$html .= '</div></div>';

		return $html;
	}
}

if ( defined( 'YITH_WCWL' ) ) {
	add_action( 'biolife_shop_loop_item_wishlist', 'biolife_shop_loop_item_wishlist' );
	add_action( 'wp_ajax_biolife_ajax_get_all_wishlist', 'biolife_ajax_get_all_wishlist' );
	add_action( 'wp_ajax_nopriv_biolife_ajax_get_all_wishlist', 'biolife_ajax_get_all_wishlist' );

}
if ( ! function_exists( 'biolife_ajax_get_all_wishlist' ) ) {
	function biolife_ajax_get_all_wishlist()
	{
		if ( function_exists( 'YITH_WCWL' ) ) {
			echo ! empty( YITH_WCWL()->count_products() ) ? YITH_WCWL()->count_products() : 0;
		}
		wp_die();
	}
}
if ( ! function_exists( 'biolife_shop_loop_item_wishlist' ) ) {
	function biolife_shop_loop_item_wishlist()
	{
		global $product;
		$product_id        = yit_get_product_id( $product );
		$default_wishlists = is_user_logged_in() ? YITH_WCWL()->get_wishlists( array( 'is_default' => true ) ) : false;
		if ( ! empty( $default_wishlists ) ) {
			$default_wishlist = $default_wishlists[0]['ID'];
		} else {
			$default_wishlist = false;
		}
		// exists in default wishlist
		if ( YITH_WCWL()->is_product_in_wishlist( $product_id, $default_wishlist ) ) {
			$added_class = 'added';
		} else {
			$added_class = '';
		}
		$html = '<div class="ovic-wishlist ' . $added_class . '">';
		$html .= '<a href="' . esc_url( add_query_arg( 'add_to_wishlist',
				$product_id ) ) . '" data-product-id="' . esc_attr( $product_id ) . '" data-product-type="' . esc_attr( $product->get_type() ) . '" class="add_to_wishlist"></a>';
		$html .= '<a href="' . esc_url( YITH_WCWL()->get_wishlist_url() ) . '" class="wishlist-url"></a>';
		$html .= '<i class="ajax-loading fa fa-spinner fa-spin"></i>';
		$html .= '</div>';
		echo wp_specialchars_decode( $html );
	}
}

/**
 *
 * HOOK WISHLIST
 */
add_action( 'biolife_wishlist', 'biolife_wishlist' );
if ( ! function_exists( 'biolife_wishlist' ) ) {
	function biolife_wishlist()
	{
		if ( defined( 'YITH_WCWL' ) ) :
			$wishlist_url = YITH_WCWL()->get_wishlist_url();
			if ( $wishlist_url != '' ) : ?>
                <div class="block-wishlist">
                    <a class="woo-wishlist-link" href="<?php echo esc_url( $wishlist_url ); ?>">
                        <span class="flaticon-valentines-heart"></span>
                        <span class="wishlist-count"><?php echo intval( YITH_WCWL()->count_all_products() ); ?></span>
                    </a>
                </div>
			<?php endif;
		endif;
	}
}
/**
 *
 * HOOK MINI CART
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'biolife_cart_link_fragment' );
add_action( 'biolife_header_mini_cart', 'biolife_header_mini_cart' );
/* MINI CART */
if ( ! function_exists( 'biolife_header_cart_link' ) ) {
	function biolife_header_cart_link()
	{
		global $woocommerce;
		?>
        <div class="shopcart-dropdown block-cart-link" data-ovic="ovic-dropdown">
            <a class="link-dropdown" href="<?php echo wc_get_cart_url(); ?>">
				<span class="group-cart-links">
                    <span class="flaticon-bag"></span>
                    <span class="text-bags"><?php echo esc_html__( 'My Cart', 'biolife' ); ?></span>
                    <span class="count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                </span>
        		<span class="group-cart-link">
                    <span class="flaticon-bag"></span>
                    <span class="text-bag"><?php echo esc_html__( 'My Bag', 'biolife' ); ?></span>
                    <span class="count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                    <span class="text"><?php echo esc_html__( 'item', 'biolife' ); ?></span> -
					<?php echo wp_specialchars_decode( $woocommerce->cart->get_cart_subtotal() ); ?>
                </span>
                <span class="text-btn"><?php echo esc_html__( 'Go', 'biolife' ); ?></span>
            </a>
        </div>
		<?php
	}
}
add_action( 'biolife_footer_cart_link', 'biolife_footer_cart_link' );
if ( ! function_exists( 'biolife_footer_cart_link' ) ) {
	function biolife_footer_cart_link()
	{
		?>
        <div class="mobile-block mobile-block-minicart">
            <a class="link-dropdown" href="<?php echo wc_get_cart_url(); ?>">
                        <span class="fa fa-shopping-bag icon">
                            <span class="count"><?php echo WC()->cart->cart_contents_count; ?></span>
                        </span>
                <span class="text"><?php echo esc_html__( 'Cart', 'biolife' ); ?></span>
            </a>
        </div>
		<?php
	}
}
if ( ! function_exists( 'biolife_header_mini_cart' ) ) {
	function biolife_header_mini_cart()
	{
		?>
        <div class="block-minicart ovic-mini-cart">
			<?php
			biolife_header_cart_link();
			the_widget( 'WC_Widget_Cart', 'title=' );
			?>
        </div>
		<?php
	}
}
if ( ! function_exists( 'biolife_cart_link_fragment' ) ) {
	add_filter( 'woocommerce_add_to_cart_fragments', 'biolife_cart_link_fragment' );
	function biolife_cart_link_fragment( $fragments )
	{
		ob_start();
		biolife_header_cart_link();
		$fragments['div.block-cart-link'] = ob_get_clean();
		ob_start();
		biolife_footer_cart_link();
		$fragments['div.mobile-block-minicart'] = ob_get_clean();

		return $fragments;
	}
}
if ( ! function_exists( 'biolife_show_product_shipping_class' ) ) {
	add_action( 'biolife_show_product_shipping_class', 'biolife_show_product_shipping_class' );
	function biolife_show_product_shipping_class()
	{
		global $product;
		$shipping_class_id = $product->get_shipping_class_id();
		$html              = '';
		if ( $shipping_class_id ) {
			$shipping_class = get_term( $shipping_class_id );
			$html           .= '<div class="group-shipping">';
			$html           .= '<span class="shiping-class">' . esc_html( $shipping_class->name ) . '</span>';
			$html           .= '<span class="shiping-class-des">' . esc_html( $shipping_class->description ) . '</span>';
			$html           .= '</div>';
		}
		echo wp_specialchars_decode( $html );
	}
}
if ( ! function_exists( 'biolife_related_title_product' ) ) {
	function biolife_related_title_product( $html, $prefix )
	{
		if ( $prefix == 'ovic_woo_crosssell' ) {
			$default_text    = esc_html__( 'Cross Sell Products', 'biolife' );
			$default_subtext = esc_html__( 'All products of store', 'biolife' );
		} elseif ( $prefix == 'ovic_woo_related' ) {
			$default_text    = esc_html__( 'Related Products', 'biolife' );
			$default_subtext = esc_html__( 'All products of store', 'biolife' );
		} else {
			$default_text    = esc_html__( 'Upsell Products', 'biolife' );
			$default_subtext = esc_html__( 'All products of store', 'biolife' );
		}
		$title    = Biolife_Functions::get_option( $prefix . '_products_title', $default_text );
		$subtitle = Biolife_Functions::get_option( $prefix . '_products_subtitle', '' );
		$image    = Biolife_Functions::get_option( $prefix . '_products_image' );
		ob_start();
		?>
		<?php if ( $image ) : ?>
        <div class="product-grid-image">
			<?php echo wp_get_attachment_image( $image, 'full' ); ?>
        </div>
	<?php endif; ?>
		<?php if ( $subtitle ) : ?>
        <p class="product-grid-subtitle">
            <span><?php echo esc_html( $subtitle ); ?></span>
        </p>
	<?php endif; ?>
		<?php if ( $title ) : ?>
        <h2 class="product-grid-title">
            <span><?php echo esc_html( $title ); ?></span>
        </h2>
	<?php endif; ?>
		<?php
		return ob_get_clean();
	}
}
if ( ! function_exists( 'biolife_get_categories' ) ) {
	function biolife_get_categories()
	{
		global $product;
		$product_cat = $product->get_category_ids();
		if ( ! empty( $product_cat ) ) { ?>
            <div class="title-category">
                <ul>
					<?php
					foreach ( $product_cat as $cat_id ) {
						if ( $term = get_term_by( 'id', $cat_id, 'product_cat' ) ) {
							$link = apply_filters( 'ovic_shortcode_vc_link', get_term_link( $term ) );
							?>
                            <li>
                                <a class="product-cat" title="<?php echo esc_attr( $term->name ); ?>"
                                   href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $term->name ); ?></a>
                            </li>
							<?php
						}
					} ?>
                </ul>
            </div>
			<?php
		}
	}
}
if ( ! function_exists( 'biolife_get_stock' ) ) {
	function biolife_get_stock()
	{
		global $product;
		$stock = $product->get_stock_status();
		if ( $stock == 'instock' ) {
			$class = 'in-stock available-product';
			$text  = $product->get_stock_quantity() . ' In Stock';
		} elseif ( $stock == 'outofstock' ) {
			$class = 'out-stock available-product';
			$text  = 'Out of Stock';
		} else {
			$class = 'onbackorder available-product';
			$text  = 'On backorder';
		}
		?>
        <p class="stock <?php echo esc_attr( $class ); ?>">
            <span> <?php echo esc_html( $text ); ?></span>
        </p>

		<?php
	}
}
if ( ! function_exists( 'biolife_show_attributes' ) ) {
	add_action( 'biolife_show_attributes', 'biolife_show_attributes' );
	function biolife_show_attributes()
	{
		global $product;
		$attribute_name = Biolife_Functions::get_option( 'ovic_attribute_product', '' );
		if ( ! is_woocommerce() ) {
			$attribute_name = apply_filters( 'biolife_attribute_name', $attribute_name );
		}
		$terms = wc_get_product_terms( $product->get_id(), 'pa_' . $attribute_name, array( 'fields' => 'all' ) );
		if ( ! empty( $terms ) ) : ?>
            <ul class="list-attribute">
				<?php foreach ( $terms as $term ) : ?>
					<?php $link = get_term_link( $term->term_id, 'pa_' . $attribute_name ); ?>
                    <li>
                        <a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $term->name ); ?></a>
                    </li>
				<?php endforeach; ?>
            </ul>
		<?php
		endif;
	}
}
if ( ! function_exists( 'biolife_before_shop_control' ) ) {
	function biolife_before_shop_control()
	{
		?>
        <div class="shop-before-control">
			<?php do_action( 'ovic_control_before_content' ); ?>
        </div>
		<?php
	}
}
if ( ! function_exists( 'biolife_product_per_page_tmp' ) ) {
	remove_action( 'ovic_control_before_content', 'ovic_product_per_page_tmp', 20 );
	add_action( 'ovic_control_before_content', 'biolife_product_per_page_tmp', 20 );
	function biolife_product_per_page_tmp()
	{
		$total   = wc_get_loop_prop( 'total' );
		$perpage = apply_filters( 'ovic_get_option', 'ovic_product_per_page', '12' );
		if ( ! $perpage || ! is_numeric( $perpage ) ) {
			$perpage = 12;
		}
		global $wp;
		if ( '' === get_option( 'permalink_structure' ) ) {
			$form_action = remove_query_arg( array( 'page', 'paged', 'product-page' ),
				add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
		} else {
			$form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( trailingslashit( $wp->request ) ) );
		}
		?>
        <div class="shop-control-item showing">
            <span class="text-item"><?php echo esc_html__( 'Display', 'biolife' ); ?></span>
            <form class="per-page-form" method="get" action="<?php echo esc_attr( $form_action ); ?>">
                <select name="ovic_product_per_page" class="option-perpage">
                    <option value="<?php echo esc_attr( $perpage ); ?>" <?php echo esc_attr( 'selected' ); ?>>
						<?php printf( esc_html__( 'Show %s', 'biolife' ), zeroise( $perpage, 2 ) ); ?>
                    </option>
					<?php if ( $perpage != 5 ) : ?>
                        <option value="5">
							<?php echo esc_html__( 'Show 05', 'biolife' ); ?>
                        </option>
					<?php endif; ?>
					<?php if ( $perpage != 10 ) : ?>
                        <option value="10">
							<?php echo esc_html__( 'Show 10', 'biolife' ); ?>
                        </option>
					<?php endif; ?>
					<?php if ( $perpage != 12 ) : ?>
                        <option value="12">
							<?php echo esc_html__( 'Show 12', 'biolife' ); ?>
                        </option>
					<?php endif; ?>
					<?php if ( $perpage != 15 ) : ?>
                        <option value="15">
							<?php echo esc_html__( 'Show 15', 'biolife' ); ?>
                        </option>
					<?php endif; ?>
                    <option value="<?php echo esc_attr( $total ); ?>">
						<?php echo esc_html__( 'Show All', 'biolife' ); ?>
                    </option>
                </select>
				<?php wc_query_string_form_fields( null,
					array( 'ovic_product_per_page', 'submit', 'paged', 'product-page' ) ); ?>
            </form>
        </div>
		<?php
	}
}
if ( ! function_exists( 'biolife_catalog_ordering' ) ) {
	remove_action( 'ovic_control_before_content', 'woocommerce_catalog_ordering', 10 );
	add_action( 'ovic_control_before_content', 'biolife_catalog_ordering', 10 );
	function biolife_catalog_ordering()
	{
		?>
        <div class="shop-control-item ordering">
            <span class="text-item"><?php echo esc_html__( 'Sort', 'biolife' ); ?></span>
			<?php woocommerce_catalog_ordering(); ?>
        </div>
		<?php
	}
}
if ( ! function_exists( 'biolife_shop_display_mode_tmp' ) ) {
	remove_action( 'ovic_control_before_content', 'ovic_shop_display_mode_tmp', 30 );
	add_action( 'ovic_control_before_content', 'biolife_shop_display_mode_tmp', 30 );
	function biolife_shop_display_mode_tmp()
	{
		$shop_display_mode = apply_filters( 'ovic_get_option', 'ovic_shop_list_style', 'grid' );
		?>
        <div class="grid-view-mode">
            <form method="get">
                <button type="submit"
                        class="modes-mode mode-grid display-mode <?php if ( $shop_display_mode == 'grid' ): ?>active<?php endif; ?>"
                        value="grid"
                        name="ovic_shop_list_style">
                        <span class="button-inner">
                            <span class="flaticon-grid"></span>
                        </span>
                </button>
                <button type="submit"
                        class="modes-mode mode-list display-mode <?php if ( $shop_display_mode == 'list' ): ?>active<?php endif; ?>"
                        value="list"
                        name="ovic_shop_list_style">
                        <span class="button-inner">
                            <span class="flaticon-bullet"></span>
                        </span>
                </button>
				<?php wc_query_string_form_fields( null,
					array( 'ovic_shop_list_style', 'submit', 'paged', 'product-page' ) ); ?>
            </form>
        </div>
		<?php
	}
}
if ( ! function_exists( 'biolife_template_single_sku' ) ) {
	function biolife_template_single_sku()
	{
		global $product;
		$product_sku = $product->get_sku();
		if ( ! empty( $product_sku ) ) : ?>
            <p class="product-code">
				<?php echo esc_html__( 'Sku:', 'biolife' ); ?>
                <span><?php echo esc_html( $product_sku ); ?></span></p>
		<?php endif;
	}
}
if ( ! function_exists( 'biolife_template_single_sharing' ) ) {
	function biolife_template_single_sharing()
	{
		do_action( 'ovic_share_button', get_the_ID() );
	}
}
if ( ! function_exists( 'biolife_template_single_payment' ) ) {
	function biolife_template_single_payment()
	{
		$payment_item = Biolife_Functions::get_option( 'ovic_single_get_payment' );
		if ( ! empty( $payment_item ) ): ?>
            <ul class="single-payment">
				<?php
				foreach ( $payment_item as $item ) : ?>
                    <li class="item">
                        <a href="<?php echo esc_url( $item['payment_link'] ); ?>">
							<?php echo wp_get_attachment_image( $item['payment_img'], 'full', false, $attr = '' ) ?>
                        </a>
                    </li>
				<?php endforeach; ?>
            </ul>
		<?php endif;
	}
}
if ( ! function_exists( 'biolife_single_left_summary' ) ) {
	function biolife_single_left_summary()
	{
		?>
        <div class="left_summary_content">
			<?php
			woocommerce_template_single_title();
			woocommerce_template_single_rating();
			biolife_template_single_sku();
			woocommerce_template_single_excerpt();
			woocommerce_template_single_price();
			biolife_show_product_shipping_class();
			?>
        </div>
		<?php
	}
}
if ( ! function_exists( 'biolife_single_right_summary' ) ) {
	function biolife_single_right_summary()
	{
		?>
        <div class="right_summary_content">
			<?php
			woocommerce_template_single_add_to_cart();
			biolife_template_single_sharing();
			biolife_template_single_payment();
			?>
        </div>
		<?php
	}
}
if ( ! function_exists( 'biolife_quick_view_thumb' ) ) {
	function biolife_quick_view_thumb()
	{
		global $post, $product;
		$attachment_ids = $product->get_gallery_image_ids();
		$html_thumbnail = '';
		$html_single    = '';
		if ( $attachment_ids && has_post_thumbnail() ) {
			foreach ( $attachment_ids as $attachment_id ) {
				$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
				$attributes      = array(
					'title'                   => get_post_field( 'post_title', $attachment_id ),
					'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
					'data-src'                => $full_size_image[0],
					'data-large_image'        => $full_size_image[0],
					'data-large_image_width'  => $full_size_image[1],
					'data-large_image_height' => $full_size_image[2],
				);
				$html_single     .= '<div><span>' . wp_get_attachment_image( $attachment_id, 'shop_single', false,
						$attributes ) . '</span></div>';
				$html_thumbnail  .= '<div><span>' . wp_get_attachment_image( $attachment_id, 'shop_thumbnail', false,
						$attributes ) . '</span></div>';

			}
		}
		ob_start(); ?>
        <div class="images">
            <div class="slider-for">
                <div><?php echo get_the_post_thumbnail( $post->ID, 'shop_single' ); ?></div>
				<?php echo wp_specialchars_decode( $html_single ); ?>
            </div>
            <div class="slider-nav">
                <div><span><?php echo get_the_post_thumbnail( $post->ID, 'shop_thumbnail' ); ?></span></div>
				<?php echo wp_specialchars_decode( $html_thumbnail ); ?>
            </div>

        </div>
		<?php echo ob_get_clean();
	}
}


add_action( 'biolife_wishlist2', 'biolife_wishlist2' );
if ( ! function_exists( 'biolife_wishlist2' ) ) {
	function biolife_wishlist2()
	{
		if ( class_exists( 'YITH_WCWL' ) ) :
			$wishlist_url = YITH_WCWL()->get_wishlist_url();
			if ( $wishlist_url != '' ) : ?>
                <div class="block-wishlist">
                    <a class="woo-wishlist-link" href="<?php echo esc_url( $wishlist_url ); ?>">
                        <span class="wishlist-icon"></span>
                        <span class="wishlist-text"><?php esc_html_e( 'Wishlist', 'biolife' ) ?></span>
                    </a>
                </div>
			<?php endif;
		endif;
	}
}
add_action( 'biolife_user_link2', 'biolife_user_link2' );
if ( ! function_exists( 'biolife_user_link2' ) ) {
	function biolife_user_link2()
	{
		$myaccount_link = wp_login_url();
		$currentUser    = wp_get_current_user();
		if ( class_exists( 'WooCommerce' ) ) {
			$myaccount_link = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
		}
		?>
        <li class="menu-item block-userlink ovic-dropdown">
			<?php if ( is_user_logged_in() ): ?>
                <a data-ovic="ovic-dropdown" class="woo-wishlist-link logged"
                   href="<?php echo esc_url( $myaccount_link ); ?>">
                    <i class="userlink-icon"></i>
                    <span class="text">
                        <?php printf( '<strong>%s</strong><i>%s</i>', __( 'Hello', 'biolife' ), $currentUser->display_name ); ?>
                    </span>
                </a>
				<?php if ( function_exists( 'wc_get_account_menu_items' ) ): ?>
                    <ul class="sub-menu">
						<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
                            <li class="menu-item <?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
                                <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
                            </li>
						<?php endforeach; ?>
                    </ul>
				<?php else: ?>
                    <ul class="sub-menu">
                        <li class="menu-item">
                            <a href="<?php echo wp_logout_url( get_permalink() ); ?>"><?php esc_html_e( 'Logout',
									'biolife' ); ?></a>
                        </li>
                    </ul>
				<?php endif;
			else: ?>
                <a class="woo-wishlist-link" href="<?php echo esc_url( $myaccount_link ); ?>">
                    <span class="fa fa-user icon"></span>
                    <span class="text"><?php echo esc_html__( 'Login', 'biolife' ); ?></span>
                </a>
			<?php endif; ?>
        </li>
		<?php
	}
}
if ( ! function_exists( 'biolife_woocommerce_group_flash' ) ) {
	function biolife_woocommerce_group_flash()
	{
		global $post, $product;
		$postdate      = get_the_time( 'Y-m-d' );
		$postdatestamp = strtotime( $postdate );
		$newness       = apply_filters( 'ovic_get_option', 'ovic_product_newness', 7 );
		$percent       = '';
		if ( $product->is_on_sale() ) {
			if ( $product->is_type( 'variable' ) ) {
				$available_variations = $product->get_available_variations();
				$maximumper           = 0;
				$minimumper           = 0;
				$percentage           = 0;
				for ( $i = 0; $i < count( $available_variations ); ++ $i ) {
					$variation_id      = $available_variations[ $i ]['variation_id'];
					$variable_product1 = new WC_Product_Variation( $variation_id );
					$regular_price     = $variable_product1->get_regular_price();
					$sales_price       = $variable_product1->get_sale_price();
					if ( $regular_price > 0 && $sales_price > 0 ) {
						$percentage = round( ( ( ( $regular_price - $sales_price ) / $regular_price ) * 100 ), 0 );
					}
					if ( $minimumper == 0 ) {
						$minimumper = $percentage;
					}
					if ( $percentage > $maximumper ) {
						$maximumper = $percentage;
					}
					if ( $percentage < $minimumper ) {
						$minimumper = $percentage;
					}
				}
				if ( $minimumper == $maximumper ) {
					$percent .= '-' . $minimumper . '%';
				} else {
					$percent .= '-(' . $minimumper . '-' . $maximumper . ')%';
				}
			} else {
				if ( $product->get_regular_price() > 0 && $product->get_sale_price() > 0 ) {
					$percentage = round( ( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 ),
						0 );
					$percent    .= $percentage . '%';
				}
			}
		}
		?>
        <div class="flash flash-2">
			<?php
			if ( $percent != '' ) {
				printf( '<span class="onsale"><span class="text">%s</span><span class="off">%s</span></span>', $percent,
					esc_html__( 'Off', 'biolife' ) );
			}
			?>
			<?php
			if ( ( time() - ( 60 * 60 * 24 * (int) $newness ) ) < (int) $postdatestamp ) {
				printf( '<span class="onnew"><span class="text">%s</span></span>', esc_html__( 'New', 'biolife' ) );
			}
			?>
        </div>
		<?php
	}
}
if ( ! function_exists( 'biolife_shop_loop_process_available' ) ) {
	function biolife_shop_loop_process_available()
	{
		global $product;
		$units_sold   = get_post_meta( $product->get_id(), 'total_sales', true );
		$availability = $product->get_stock_quantity();
		if ( $availability == '' ) {
			$percent = 0;
		} else {
			$total_percent = $availability + $units_sold;
			$percent       = round( ( ( $units_sold / $total_percent ) * 100 ), 0 );
		}
		?>
        <div class="process-valiable">
            <div class="valiable-text">
                <span class="text-availavle">
                    <?php echo wp_specialchars_decode( sprintf( esc_html( 'Availavle: <strong>%d</strong>', 'biolife' ),
	                    $units_sold ) ); ?>
                </span>
                <span class="text-quantity">
                    <?php if ( ! $availability ): ?>
	                    <?php echo esc_html__( 'Unlimit', 'biolife' ) ?>
                    <?php else: ?>
	                    <?php echo wp_specialchars_decode( sprintf( esc_html( 'Already sold: <strong>%d</strong>',
		                    'biolife' ), $availability ) ); ?>
                    <?php endif; ?>
                </span>
            </div>
            <span class="valiable-total total">
                <span class="process" style="width: <?php echo esc_attr( $percent ) . '%' ?>"></span>
            </span>
        </div>
		<?php
	}
}
add_action( 'biolife_function_shop_loop_item_countdown', 'biolife_function_shop_loop_item_countdown' );
if ( ! function_exists( 'biolife_function_shop_loop_item_countdown' ) ) {
	function biolife_function_shop_loop_item_countdown()
	{
		global $product;
		$date = ovic_get_max_date_sale( $product->get_id() );
		ob_start();
		if ( $date > 0 ) {
			?>
            <div class="text"><?php echo esc_html__( 'Hurry Up! Offer End In :', 'biolife' ); ?></div>
            <div class="ovic-countdown"
                 data-datetime="<?php echo date( 'm/j/Y g:i:s', $date ); ?>">
            </div>
			<?php
		}
		$html = ob_get_clean();
		echo apply_filters( 'ovic_custom_html_countdown', $html, $date );
	}
}
if ( !function_exists( 'biolife_button_order_now' ) ) {
	function biolife_button_order_now()
	{
		global $product;
		$sale_price = '';
		if ( 'simple' === $product->get_type() && $product->is_on_sale() ) {
			$sale_price = wc_price(
				round( $product->get_regular_price() - $product->get_sale_price() ),
				array(
					'decimals' => 0,
				)
			);
			$sale_price = "<span>-$sale_price</span>";
		}
		?>
        <a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="button order-now">
			<?php
			echo sprintf( '%s%s',
				$sale_price,
				esc_html__( 'ORDER NOW', 'biolife' )
			);
			?>
        </a>
		<?php
	}
}