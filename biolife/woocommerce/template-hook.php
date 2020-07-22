<?php
/***
 * Core Name: WooCommerce
 * Version: 1.0.0
 * Author: Khanh
 */
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $wp_filter;
include_once dirname( __FILE__ ) . '/template-functions.php';
/**
 * HOOK TEMPLATE
 */
add_action( 'after_setup_theme', 'ovic_action_after_setup_theme' );
add_action( 'ovic_default_products', 'ovic_default_products' );
add_action( 'ovic_woocommerce_action_attributes', 'ovic_action_attributes' );
/**
 * WRAPPER CONTENT SHOP
 */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_before_main_content', 'ovic_woocommerce_before_main_content', 10 );
add_action( 'woocommerce_before_main_content', 'ovic_woocommerce_before_loop_content', 50 );
add_action( 'woocommerce_after_main_content', 'ovic_woocommerce_after_loop_content', 50 );
add_action( 'woocommerce_sidebar', 'ovic_woocommerce_sidebar', 10 );
add_action( 'woocommerce_sidebar', 'ovic_woocommerce_after_main_content', 100 );
/**
 * SHOP LOOP
 */
add_action( 'woocommerce_before_shop_loop', 'ovic_before_woocommerce_content', 50 );
add_action( 'woocommerce_after_shop_loop', 'ovic_after_woocommerce_content', 50 );
/**
 * SHOP CONTROL
 */
add_action( 'ovic_control_before_content', 'woocommerce_catalog_ordering', 10 );
add_action( 'ovic_control_before_content', 'ovic_product_per_page_tmp', 20 );
add_action( 'ovic_control_before_content', 'ovic_shop_display_mode_tmp', 30 );
add_action( 'ovic_control_after_content', 'woocommerce_result_count', 10 );
add_action( 'ovic_control_after_content', 'ovic_custom_pagination', 20 );
/**
 * CUSTOM SHOP CONTROL
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
add_action( 'woocommerce_before_shop_loop', 'ovic_before_shop_control', 20 );
add_action( 'woocommerce_after_shop_loop', 'ovic_after_shop_control', 100 );
/**
 * CUSTOM WC TEMPLATE PART
 */
add_filter( 'wc_get_template_part', 'ovic_wc_get_template_part', 10, 3 );
/**
 * CUSTOM PRODUCT POST PER PAGE
 */
add_filter( 'loop_shop_per_page', 'ovic_loop_shop_per_page', 20 );
add_filter( 'woof_products_query', 'ovic_woof_products_query', 20 );
/**
 * CUSTOM PRODUCT RATING
 */
add_filter( 'woocommerce_product_get_rating_html', 'ovic_product_get_rating_html', 10, 3 );
/**
 * REMOVE CSS
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_meta', 30 );
/**
 * CUSTOM PRODUCT NAME
 */
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'ovic_template_loop_product_title', 10 );
/**
 * PRODUCT THUMBNAIL
 */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'ovic_template_loop_product_thumbnail', 10 );
/**
 * REMOVE "woocommerce_template_loop_product_link_open"
 */
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
/**
 * ADD COUNTDOWN PRODUCT
 */
add_action( 'ovic_function_shop_loop_item_countdown', 'ovic_function_shop_loop_item_countdown' );
/**
 * CUSTOM FLASH
 */
add_action( 'ovic_group_flash_content', 'woocommerce_show_product_loop_sale_flash', 5 );
add_action( 'ovic_group_flash_content', 'ovic_custom_new_flash', 10 );
add_filter( 'woocommerce_sale_flash', 'ovic_custom_sale_flash' );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'ovic_woocommerce_group_flash', 10 );
add_action( 'woocommerce_single_product_summary', 'ovic_woocommerce_group_flash', 10 );
/**
 * BREADCRUMB
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
add_action( 'woocommerce_before_main_content', 'ovic_woocommerce_breadcrumb', 20 );
/**
 * UPSELL
 */

/**
 * RELATED
 */

/**
 * CROSS SELL
 */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );

/**
 * POSITION SINGLE PRODUCT
 */
