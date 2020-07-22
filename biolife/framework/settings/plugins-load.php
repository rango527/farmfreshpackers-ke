<?php

if ( !class_exists( 'Biolife_PluginLoad' ) ) {
	class Biolife_PluginLoad
	{
		public $plugins = array();
		public $config  = array();

		public function __construct()
		{
			$this->plugins();
			$this->config();

			if ( function_exists( 'tgmpa' ) ) {
				tgmpa( $this->plugins, $this->config );
			}
		}

		public function plugins()
		{
			$this->plugins = array(
				array(
					'name'               => 'Ovic Toolkit',
					'slug'               => 'ovic-toolkit',
					'source'             => esc_url( 'http://plugins.kutethemes.net/ovic-toolkit.zip' ),
					'required'           => true,
					'version'            => '1.5.0',
					'force_activation'   => false,
					'force_deactivation' => false,
					'external_url'       => '',
				),
				array(
					'name'               => 'Revolution Slider',
					'slug'               => 'revslider',
					'source'             => esc_url( 'http://plugins.kutethemes.net/revslider.zip' ),
					'required'           => true,
					'version'            => '6.2.15',
					'force_activation'   => false,
					'force_deactivation' => false,
					'external_url'       => '',
				),
				array(
					'name'               => 'WPBakery Visual Composer',
					'slug'               => 'js_composer',
					'source'             => esc_url( 'http://plugins.kutethemes.net/js_composer.zip' ),
					'required'           => true,
					'version'            => '6.1',
					'force_activation'   => false,
					'force_deactivation' => false,
					'external_url'       => '',
				),
				array(
					'name'     => 'Ovic Import Demo',
					'slug'     => 'ovic-import-demo',
					'required' => true,
				),
				array(
					'name'     => 'WooCommerce',
					'slug'     => 'woocommerce',
					'required' => true,
					'image'    => esc_url( 'http://kutethemes.net/wordpress/plugins/images/woocommerce.png' ),
				),
				array(
					'name'     => 'YITH WooCommerce Compare',
					'slug'     => 'yith-woocommerce-compare',
					'required' => false,
					'image'    => esc_url( 'http://kutethemes.net/wordpress/plugins/images/compare.jpg' ),
				),
				array(
					'name'     => 'YITH WooCommerce Wishlist',
					'slug'     => 'yith-woocommerce-wishlist',
					'required' => false,
					'image'    => esc_url( 'http://kutethemes.net/wordpress/plugins/images/wishlist.jpg' ),
				),
				array(
					'name'     => 'YITH WooCommerce Quick View',
					'slug'     => 'yith-woocommerce-quick-view',
					'required' => false,
					'image'    => esc_url( 'http://kutethemes.net/wordpress/plugins/images/quickview.jpg' ),
				),
				array(
					'name'     => 'Contact Form 7',
					'slug'     => 'contact-form-7',
					'required' => false,
					'image'    => esc_url( 'http://kutethemes.net/wordpress/plugins/images/contactform7.jpg' ),
				),
			);
		}

		public function config()
		{
			$this->config = array(
				'id'           => 'biolife',                 // Unique ID for hashing notices for multiple instances of TGMPA.
				'default_path' => '',                      // Default absolute path to bundled plugins.
				'menu'         => 'biolife-install-plugins', // Menu slug.
				'parent_slug'  => 'themes.php',            // Parent menu slug.
				'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
				'has_notices'  => true,                    // Show admin notices or not.
				'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
				'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
				'is_automatic' => true,                   // Automatically activate plugins after installation or not.
				'message'      => '',                      // Message to output right before the plugins table.
			);
		}
	}
}
if ( !function_exists( 'Biolife_PluginLoad' ) ) {
	function Biolife_PluginLoad()
	{
		new  Biolife_PluginLoad();
	}
}
add_action( 'tgmpa_register', 'Biolife_PluginLoad' );