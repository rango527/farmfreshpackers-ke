<?php
/**
 *
 * Name: Product Style 01
 * Slug: content-product-style-1
 * Shortcode: true
 * Theme Option: true
 **/
?>
<?php
add_action('woocommerce_after_shop_loop_item_title','biolife_show_product_shipping_class', 30);
remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating', 5);
add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating', 20);
add_action('woocommerce_shop_loop_item_title','biolife_get_categories', 5);
add_action('woocommerce_before_shop_loop_item_title','biolife_get_stock', 10);
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
		do_action('ovic_function_shop_loop_item_wishlist');
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
        <div class="group-button">
            <div class="inner">
                <?php do_action('ovic_function_shop_loop_item_quickview'); ?>
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
                <?php do_action('ovic_function_shop_loop_item_compare'); ?>
            </div>
        </div>
    </div>
</div>
<?php
remove_action('woocommerce_after_shop_loop_item_title','biolife_show_product_shipping_class', 30);
add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating', 20);
remove_action('woocommerce_shop_loop_item_title','biolife_get_categories', 5);
remove_action('woocommerce_before_shop_loop_item_title','biolife_get_stock', 10);
?>
