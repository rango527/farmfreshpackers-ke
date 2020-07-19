<?php
/*
Name: Product Style 17
Slug: content-product-style-17
Shortcode: true
Theme Option: false
*/
?>
<?php
global $product;
remove_action('woocommerce_before_shop_loop_item_title','ovic_woocommerce_group_flash', 10);
add_action('woocommerce_shop_loop_item_title','ovic_woocommerce_group_flash', 1);
remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating', 5);
?>
<div class="product-inner">
    <?php
    /**
     * woocommerce_before_shop_loop_item hook.
     *
     * @hooked woocommerce_template_loop_product_link_open - 10
     */
    do_action( 'woocommerce_before_shop_loop_item' );
    ?>
    <div class="product-thumb">
        <?php
        /**
         * woocommerce_before_shop_loop_item_title hook.
         *
         * @hooked woocommerce_show_product_loop_sale_flash - 10
         * @hooked woocommerce_template_loop_product_thumbnail - 15
         */
        do_action( 'woocommerce_before_shop_loop_item_title' );
        ?>
        <div class="biolife-countdown-wrapper">
            <?php  do_action( 'ovic_function_shop_loop_item_countdown' ); ?>
        </div>
        
    </div>
    <div class="product-info equal-elem">
        <?php
        /**
         * woocommerce_shop_loop_item_title hook.
         *
         * @hooked woocommerce_shop_loop_item_title - 10
         */
        do_action( 'woocommerce_shop_loop_item_title' );
        biolife_post_category_2( $product->get_id(), 'product_cat', '' );
        biolife_post_category_2( $product->get_id(), 'product_tag', '' );
        biolife_button_order_now();
        ?>
    </div>
</div>
<?php
add_action('woocommerce_before_shop_loop_item_title','ovic_woocommerce_group_flash', 10);
remove_action('woocommerce_shop_loop_item_title','ovic_woocommerce_group_flash', 1);
add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating', 5);
?>
