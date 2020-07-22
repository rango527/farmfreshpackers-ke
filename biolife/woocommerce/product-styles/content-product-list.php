<?php
/**
 *
 * Name: Product Style List
 * Slug: product-stye-list
 * Shortcode: false
 * Theme Option: false
 **/
?>
<?php
add_action('woocommerce_shop_loop_item_title','biolife_get_categories', 5);
?>
<div class="product-inner">
    <div class="product-thumb">
        <?php
        /**
         * woocommerce_before_shop_loop_item_title hook.
         *
         * @hooked woocommerce_show_product_loop_sale_flash - 10
         * @hooked woocommerce_template_loop_product_thumbnail - 10
         */
        do_action( 'woocommerce_before_shop_loop_item_title' );
        do_action('ovic_function_shop_loop_item_quickview');
        ?>
    </div>
    <div class="product-attr-info">
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

		<?php
		/**
		 * ovic_custom_shop_item_info hook.
		 *
		 * @hooked ovic_woocommerce_group_flash - 1
		 */
		do_action( 'ovic_custom_shop_item_info' );
		?>
        <div class="excerpt-content">
			<?php echo wp_trim_words( apply_filters( 'the_excerpt', get_the_excerpt() ), 22, esc_html__( '', 'biolife' ) ); ?>
        </div>
        <?php
		/**
		 * woocommerce_after_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
        ?>
    </div>
    <div class="product-info">
        <?php
		do_action( 'biolife_show_attributes' );
		do_action( 'biolife_show_product_shipping_class' );
        ?>
        <div class="add-to-cart">
            <?php
            /**
             * woocommerce_after_shop_loop_item hook.
             *
             * @removed woocommerce_template_loop_product_link_close - 5
             * @hooked woocommerce_template_loop_add_to_cart - 10
             */
            do_action( 'woocommerce_after_shop_loop_item' );
            ?>
        </div>
    </div>
</div>
<?php
remove_action('woocommerce_shop_loop_item_title','biolife_get_categories', 5);
?>