<?php

/*
Plugin Name: Rave WooCommerce Payment Gateway
Plugin URI: https://rave.flutterwave.com/
Description: Official WooCommerce payment gateway for Rave.
Version: 2.2.5
Author: Flutterwave Developers
Author URI: http://developer.flutterwave.com
License: MIT License
WC requires at least:   3.0.0
WC tested up to:        4.0
*/


if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

define( 'FLW_WC_PLUGIN_FILE', __FILE__ );
define( 'FLW_WC_DIR_PATH', plugin_dir_path( FLW_WC_PLUGIN_FILE ) );



  function flw_woocommerce_rave_init() {

    if ( !class_exists( 'WC_Payment_Gateway' ) ) return;

    require_once( FLW_WC_DIR_PATH . 'includes/class.flw_wc_payment_gateway.php' );

    // include subscription if exists
    if ( class_exists( 'WC_Subscriptions_Order' ) && class_exists( 'WC_Payment_Gateway_CC' ) ) {

      require_once( FLW_WC_DIR_PATH . 'includes/class.flw_wc_subscription_payment.php' );
      
    }

    add_filter('woocommerce_payment_gateways', 'flw_woocommerce_add_rave_gateway', 99 );
  }
  add_action('plugins_loaded', 'flw_woocommerce_rave_init', 99);

  /**
   * Add the Settings link to the plugin
   *
   * @param  Array $links Existing links on the plugin page
   *
   * @return Array          Existing links with our settings link added
   */
  function flw_plugin_action_links( $links ) {

    $rave_settings_url = esc_url( get_admin_url( null, 'admin.php?page=wc-settings&tab=checkout&section=rave' ) );
    array_unshift( $links, "<a title='Rave Settings Page' href='$rave_settings_url'>Settings</a>" );

    return $links;

  }
  add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'flw_plugin_action_links' );

  /**
   * Add the Gateway to WooCommerce
   *
   * @param  Array $methods Existing gateways in WooCommerce
   *
   * @return Array          Gateway list with our gateway added
   */
  function flw_woocommerce_add_rave_gateway($methods) {

    if ( class_exists( 'WC_Subscriptions_Order' ) && class_exists( 'WC_Payment_Gateway_CC' ) ) {

      $methods[] = 'FLW_WC_Payment_Gateway_Subscriptions';

    } else {

      $methods[] = 'FLW_WC_Payment_Gateway';
    }

    return $methods;

  }


?>