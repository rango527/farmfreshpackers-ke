<?php
/*
Name: Product Style 04
Slug: content-product-style-4
Shortcode: true
Theme Option: false
*/
?>
<?php
global $product;
add_action( 'woocommerce_shop_loop_item_title', 'biolife_get_categories', 5 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'ovic_woocommerce_group_flash', 10 );
?>
<div class="product-inner">
    <div class="product-thumb">
		<?php
		/**
		 * woocommerce_before_shop_loop_item_title hook.
		 *
		 * @hooked ovic_woocommerce_group_flash - 10
		 * @hooked woocommerce_template_loop_product_thumbnail - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item_title' );
		?>
    </div>
    <div class="product-info">
        <div class="product-top">
            <?php
            /**
             * woocommerce_shop_loop_item_title hook.
             *
             * @hooked woocommerce_template_loop_product_title - 10
             */
            do_action( 'woocommerce_shop_loop_item_title' );
            ?>
        </div>
        <div class="group-variable">
			<?php
			if ( $product->get_type() == 'variable' ) {
				$attributes           = $product->get_variation_attributes();
				$attribute_keys       = array_keys( $attributes );
				$get_variations       = count( $product->get_children() ) <= apply_filters( 'woocommerce_ajax_variation_threshold', 30, $product );
				$available_variations = $get_variations ? $product->get_available_variations() : false;
				foreach ( $available_variations as $available_variation ) {
					$class_price = implode( ' ', $available_variation['attributes'] );
					echo '<div class="item-target ' . $class_price . '">' . $available_variation['price_html'] . '</div>';
				}
			}
			?>
        </div>
    </div>
</div>
<?php
remove_action( 'woocommerce_shop_loop_item_title', 'biolife_get_categories', 5 );
add_action( 'woocommerce_before_shop_loop_item_title', 'ovic_woocommerce_group_flash', 10 );
?>
