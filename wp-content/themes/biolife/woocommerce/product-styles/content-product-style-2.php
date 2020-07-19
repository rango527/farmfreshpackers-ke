<?php
/*
Name: Product Style 02
Slug: content-product-style-2
Shortcode: true
Theme Option: false
*/
?>
<?php
add_action('woocommerce_shop_loop_item_title','biolife_get_categories', 5);
remove_action('woocommerce_before_shop_loop_item_title','ovic_woocommerce_group_flash', 10);
remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating', 5);
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
	</div>
</div>
<?php
remove_action('woocommerce_shop_loop_item_title','biolife_get_categories', 5);
add_action('woocommerce_before_shop_loop_item_title','ovic_woocommerce_group_flash', 10);
add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating', 5);
?>
