<?php
/**
 *
 * Name: Product Style 15
 * Slug: content-product-style-15
 * Shortcode: true
 * Theme Option: true
 **/
?>
<?php
global $product;
add_action('woocommerce_shop_loop_item_title','biolife_get_categories', 15);
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
?>
    <div class="product-wrapper">
        <div class="product-inner">
			<?php
			/**
			 * woocommerce_before_shop_loop_item hook.
			 *
			 * @hooked woocommerce_template_loop_product_link_open - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item' );
			?>
            <div class="product-thumb images">
				<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
				?>
                <div class="thumb-hover">
                    <?php biolife_get_stock(); ?>
                    <div class="group-button">
                        <?php
                        do_action( 'ovic_function_shop_loop_item_wishlist' );
                        do_action( 'ovic_function_shop_loop_item_compare' );
                        do_action( 'ovic_function_shop_loop_item_quickview' );
                        ?>
                    </div>
                </div>
            </div>
            <div class="product-info equal-elem">
				<?php
				/**
				 * woocommerce_after_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_template_loop_rating - 5
				 * @hooked woocommerce_template_loop_price - 10
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
				/**
				 * woocommerce_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_template_loop_product_title - 10
				 */
				do_action( 'woocommerce_shop_loop_item_title' );
				?>
                <div class="info-hover">
                    <div class="product-excerpt">
                        <?php echo wp_trim_words( apply_filters( 'the_excerpt', get_the_excerpt() ), 17, esc_html__( '...', 'biolife' ) ); ?>
                    </div>
                    <div class="add-to-cart">
                        <?php
                        /**
                         * woocommerce_after_shop_loop_item hook.
                         *
                         * @hooked woocommerce_template_loop_add_to_cart - 10
                         */
                        do_action( 'woocommerce_after_shop_loop_item' );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
remove_action('woocommerce_shop_loop_item_title','biolife_get_categories', 15);
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );