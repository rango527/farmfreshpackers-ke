<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || !$product->is_visible() ) {
	return;
}

// Custom columns
$is_dokan = get_query_var( 'is-dokan', false);

$ovic_woo_bg_items = apply_filters( 'ovic_get_option', 'ovic_woo_bg_items', 4 );
$ovic_woo_lg_items = apply_filters( 'ovic_get_option', 'ovic_woo_lg_items', 4 );
$ovic_woo_md_items = apply_filters( 'ovic_get_option', 'ovic_woo_md_items', 4 );
$ovic_woo_sm_items = apply_filters( 'ovic_get_option', 'ovic_woo_sm_items', 6 );
$ovic_woo_xs_items = apply_filters( 'ovic_get_option', 'ovic_woo_xs_items', 6 );
$ovic_woo_ts_items = apply_filters( 'ovic_get_option', 'ovic_woo_ts_items', 12 );
$shop_display_mode = apply_filters( 'ovic_get_option', 'ovic_shop_list_style', 'grid' );
$product_style     = apply_filters( 'ovic_get_option', 'ovic_shop_product_style', 1 );
$template_style    = 'style-' . $product_style;
$classes           = array( 'product-item' );
if ( $shop_display_mode == 'grid' ) {
    if (!$is_dokan){
        $classes[] = 'col-bg-' . $ovic_woo_bg_items;
        $classes[] = 'col-lg-' . $ovic_woo_lg_items;
        $classes[] = 'col-md-' . $ovic_woo_md_items;
        $classes[] = 'col-sm-' . $ovic_woo_sm_items;
        $classes[] = 'col-xs-' . $ovic_woo_xs_items;
        $classes[] = 'col-ts-' . $ovic_woo_ts_items;
    }else{
        $classes[] = 'col-bg-4';
        $classes[] = 'col-lg-4';
        $classes[] = 'col-md-4';
        $classes[] = 'col-sm-6';
        $classes[] = 'col-xs-6';
        $classes[] = 'col-ts-12';
    }
} else {
	$classes[] = 'list col-sm-12';
}
if ( $shop_display_mode == 'grid' ) {
	$classes[] = $template_style;
}
$classes = apply_filters( 'ovic_class_content_product', $classes );
?>
<li <?php wc_product_class( $classes, $product ); ?>>
	<?php if ( $shop_display_mode == 'grid' ):
		get_template_part( 'woocommerce/product-styles/content-product', $template_style );
	else:
		get_template_part( 'woocommerce/product-styles/content-product', 'list' );
	endif; ?>
</li>