<?php
// GET HEADER
if ( !function_exists( 'get_header_options' ) ) {
	function get_header_options()
	{
		$layoutDir      = get_template_directory() . '/templates/header/';
		$header_options = array();
		if ( is_dir( $layoutDir ) ) {
			$files = scandir( $layoutDir );
			if ( $files && is_array( $files ) ) {
				foreach ( $files as $file ) {
					if ( $file != '.' && $file != '..' ) {
						$fileInfo = pathinfo( $file );
						if ( $fileInfo['extension'] == 'php' && $fileInfo['basename'] != 'index.php' ) {
							$file_data                  = get_file_data( $layoutDir . $file, array( 'Name' => 'Name' ) );
							$file_name                  = str_replace( 'header-', '', $fileInfo['filename'] );
							$header_options[$file_name] = array(
								'title'   => $file_data['Name'],
								'preview' => get_theme_file_uri( '/templates/header/header-' . $file_name . '.jpg' ),
							);
						}
					}
				}
			}
		}
		return $header_options;
	}
}
if ( !class_exists( 'Biolife_Theme_Options' ) ) {
	class Biolife_Theme_Options
	{
		public function __construct()
		{
			add_filter( 'ovic_config_customize_sections_v2', array( $this, 'set_options' ) );
		}

		public function set_options( $sections )
		{
			/* RELATED SINGLE POST */
			$sections['blog_main']['sections']['related'] = array(
				'name'   => 'related',
				'title'  => esc_html__( 'Related', 'biolife' ),
				'fields' => array(
					'ovic_enable_related_post'   => array(
						'id'    => 'ovic_enable_related_post',
						'type'  => 'switcher',
						'title' => esc_html__( 'Enable Related Blog', 'biolife' ),
					),
					'ovic_related_post_per_page' => array(
						'id'         => 'ovic_related_post_per_page',
						'type'       => 'number',
						'title'      => esc_html__( 'Number Related Post', 'biolife' ),
						'default'    => '6',
						'dependency' => array( 'ovic_enable_related_post', '==', true ),
					),
					'ovic_related_post_ls_items' => array(
						'id'         => 'ovic_related_post_ls_items',
						'type'       => 'select',
						'title'      => esc_html__( 'Related items per row on Desktop', 'biolife' ),
						'desc'       => esc_html__( '(Screen resolution of device >= 1500px )', 'biolife' ),
						'options'    => array(
							'1' => esc_html__( '1 item', 'biolife' ),
							'2' => esc_html__( '2 items', 'biolife' ),
							'3' => esc_html__( '3 items', 'biolife' ),
							'4' => esc_html__( '4 items', 'biolife' ),
							'5' => esc_html__( '5 items', 'biolife' ),
							'6' => esc_html__( '6 items', 'biolife' ),
						),
						'default'    => '3',
						'dependency' => array( 'ovic_enable_related_post', '==', true ),
					),
					'ovic_related_post_lg_items' => array(
						'id'         => 'ovic_related_post_lg_items',
						'type'       => 'select',
						'title'      => esc_html__( 'Related items per row on Desktop', 'biolife' ),
						'desc'       => esc_html__( '(Screen resolution of device >= 1200px < 1500px )', 'biolife' ),
						'options'    => array(
							'1' => esc_html__( '1 item', 'biolife' ),
							'2' => esc_html__( '2 items', 'biolife' ),
							'3' => esc_html__( '3 items', 'biolife' ),
							'4' => esc_html__( '4 items', 'biolife' ),
							'5' => esc_html__( '5 items', 'biolife' ),
							'6' => esc_html__( '6 items', 'biolife' ),
						),
						'default'    => '3',
						'dependency' => array( 'ovic_enable_related_post', '==', true ),
					),
					'ovic_related_post_md_items' => array(
						'id'         => 'ovic_related_post_md_items',
						'type'       => 'select',
						'title'      => esc_html__( 'Related items per row on landscape tablet', 'biolife' ),
						'desc'       => esc_html__( '(Screen resolution of device >=992px and < 1200px )', 'biolife' ),
						'options'    => array(
							'1' => esc_html__( '1 item', 'biolife' ),
							'2' => esc_html__( '2 items', 'biolife' ),
							'3' => esc_html__( '3 items', 'biolife' ),
							'4' => esc_html__( '4 items', 'biolife' ),
							'5' => esc_html__( '5 items', 'biolife' ),
							'6' => esc_html__( '6 items', 'biolife' ),
						),
						'default'    => '3',
						'dependency' => array( 'ovic_enable_related_post', '==', true ),
					),
					'ovic_related_post_sm_items' => array(
						'id'         => 'ovic_related_post_sm_items',
						'type'       => 'select',
						'title'      => esc_html__( 'Related items per row on portrait tablet', 'biolife' ),
						'desc'       => esc_html__( '(Screen resolution of device >=768px and < 992px )', 'biolife' ),
						'options'    => array(
							'1' => esc_html__( '1 item', 'biolife' ),
							'2' => esc_html__( '2 items', 'biolife' ),
							'3' => esc_html__( '3 items', 'biolife' ),
							'4' => esc_html__( '4 items', 'biolife' ),
							'5' => esc_html__( '5 items', 'biolife' ),
							'6' => esc_html__( '6 items', 'biolife' ),
						),
						'default'    => '2',
						'dependency' => array( 'ovic_enable_related_post', '==', true ),
					),
					'ovic_related_post_xs_items' => array(
						'id'         => 'ovic_related_post_xs_items',
						'type'       => 'select',
						'title'      => esc_html__( 'Related items per row on Mobile', 'biolife' ),
						'desc'       => esc_html__( '(Screen resolution of device >=480  add < 768px)', 'biolife' ),
						'options'    => array(
							'1' => esc_html__( '1 item', 'biolife' ),
							'2' => esc_html__( '2 items', 'biolife' ),
							'3' => esc_html__( '3 items', 'biolife' ),
							'4' => esc_html__( '4 items', 'biolife' ),
							'5' => esc_html__( '5 items', 'biolife' ),
							'6' => esc_html__( '6 items', 'biolife' ),
						),
						'default'    => '1',
						'dependency' => array( 'ovic_enable_related_post', '==', true ),
					),
					'ovic_related_post_ts_items' => array(
						'id'         => 'ovic_related_post_ts_items',
						'type'       => 'select',
						'title'      => esc_html__( 'Related items per row on Mobile', 'biolife' ),
						'desc'       => esc_html__( '(Screen resolution of device < 480px)', 'biolife' ),
						'options'    => array(
							'1' => esc_html__( '1 item', 'biolife' ),
							'2' => esc_html__( '2 items', 'biolife' ),
							'3' => esc_html__( '3 items', 'biolife' ),
							'4' => esc_html__( '4 items', 'biolife' ),
							'5' => esc_html__( '5 items', 'biolife' ),
							'6' => esc_html__( '6 items', 'biolife' ),
						),
						'default'    => '1',
						'dependency' => array( 'ovic_enable_related_post', '==', true ),
					),
				),
			);
			if ( class_exists( 'WooCommerce' ) ) {
				$sections['woocommerce_main']['sections']['woocommerce']['fields'] = array(
                    'biolife_catalog_mode' => array(
                        'id'    => 'biolife_catalog_mode',
                        'type'  => 'switcher',
                        'title' => esc_html__( 'Enable Catalog Mode', 'biolife' ),
                    ),
					'ovic_product_newness'     => array(
						'id'      => 'ovic_product_newness',
						'default' => '10',
						'type'    => 'number',
						'title'   => esc_html__( 'Products Newness', 'biolife' ),
					),
					'ovic_sidebar_shop_layout' => array(
						'id'      => 'ovic_sidebar_shop_layout',
						'default' => 'full',
						'type'    => 'image_select',
						'title'   => esc_html__( 'Shop Page Sidebar Layout', 'biolife' ),
						'desc'    => esc_html__( 'Select sidebar position on Shop Page.', 'biolife' ),
						'options' => array(
							'left'  => esc_attr( ' data:image/png;base64,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' ),
							'right' => esc_attr( ' data:image/png;base64,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' ),
							'full'  => esc_attr( ' data:image/png;base64,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' ),
						),
					),
					'ovic_shop_used_sidebar'   => array(
						'id'         => 'ovic_shop_used_sidebar',
						'type'       => 'select',
						'title'      => esc_html__( 'Sidebar Used For Shop', 'biolife' ),
						'options'    => apply_filters( 'ovic_sidebar_options', 10, 1 ),
						'dependency' => array( 'ovic_sidebar_shop_layout_full', '==', false ),
					),
					'ovic_shop_list_style'     => array(
						'id'                => 'ovic_shop_list_style',
						'selective_refresh' => array(
							'selector' => '.grid-view-mode',
						),
						'default'           => 'grid',
						'type'              => 'image_select',
						'title'             => esc_html__( 'Shop Default Layout', 'biolife' ),
						'desc'              => esc_html__( 'Select default layout for shop, product category archive.', 'biolife' ),
						'options'           => array(
							'grid' => esc_attr( ' data:image/png;base64,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' ),
							'list' => esc_attr( ' data:image/png;base64,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' ),
						),
					),
					'ovic_product_per_page'    => array(
						'id'      => 'ovic_product_per_page',
						'default' => '10',
						'type'    => 'number',
						'title'   => esc_html__( 'Products perpage', 'biolife' ),
						'desc'    => esc_html__( 'Number of products on shop page.', 'biolife' ),
					),
					array(
						'id'      => 'ovic_attribute_product',
						'type'    => 'select',
						'title'   => esc_html__( 'Product Attribute', 'biolife' ),
						'options' => apply_filters( 'ovic_attributes_options', 10, 1 ),
					),
					'ovic_shop_product_style'  => array(
						'id'      => 'ovic_shop_product_style',
						'default' => '1',
						'type'    => 'select_preview',
						'title'   => esc_html__( 'Product Shop Layout', 'biolife' ),
						'desc'    => esc_html__( 'Select a Product layout in shop page', 'biolife' ),
						'options' => apply_filters( 'ovic_product_options', 'Theme Option' ),
					),
					'product_carousel'         => array(
						'id'      => 'product_carousel',
						'type'    => 'heading',
						'content' => esc_html__( 'Grid Settings', 'biolife' ),
					),
					'ovic_woo_bg_items'        => array(
						'id'      => 'ovic_woo_bg_items',
						'default' => '4',
						'type'    => 'select',
						'title'   => esc_html__( 'Items per row on Desktop( For grid mode )', 'biolife' ),
						'desc'    => esc_html__( '(Screen resolution of device >= 1500px )', 'biolife' ),
						'options' => array(
							'12' => esc_html__( '1 item', 'biolife' ),
							'6'  => esc_html__( '2 items', 'biolife' ),
							'4'  => esc_html__( '3 items', 'biolife' ),
							'3'  => esc_html__( '4 items', 'biolife' ),
							'15' => esc_html__( '5 items', 'biolife' ),
							'2'  => esc_html__( '6 items', 'biolife' ),
						),
					),
					'ovic_woo_lg_items'        => array(
						'id'      => 'ovic_woo_lg_items',
						'default' => '4',
						'type'    => 'select',
						'title'   => esc_html__( 'Items per row on Desktop( For grid mode )', 'biolife' ),
						'desc'    => esc_html__( '(Screen resolution of device >= 1200px < 1500px )', 'biolife' ),
						'options' => array(
							'12' => esc_html__( '1 item', 'biolife' ),
							'6'  => esc_html__( '2 items', 'biolife' ),
							'4'  => esc_html__( '3 items', 'biolife' ),
							'3'  => esc_html__( '4 items', 'biolife' ),
							'15' => esc_html__( '5 items', 'biolife' ),
							'2'  => esc_html__( '6 items', 'biolife' ),
						),
					),
					'ovic_woo_md_items'        => array(
						'id'      => 'ovic_woo_md_items',
						'default' => '4',
						'type'    => 'select',
						'title'   => esc_html__( 'Items per row on Desktop( For grid mode )', 'biolife' ),
						'desc'    => esc_html__( '(Screen resolution of device >=992px and < 1200px )', 'biolife' ),
						'options' => array(
							'12' => esc_html__( '1 item', 'biolife' ),
							'6'  => esc_html__( '2 items', 'biolife' ),
							'4'  => esc_html__( '3 items', 'biolife' ),
							'3'  => esc_html__( '4 items', 'biolife' ),
							'15' => esc_html__( '5 items', 'biolife' ),
							'2'  => esc_html__( '6 items', 'biolife' ),
						),
					),
					'ovic_woo_sm_items'        => array(
						'id'      => 'ovic_woo_sm_items',
						'default' => '4',
						'type'    => 'select',
						'title'   => esc_html__( 'Items per row on Desktop( For grid mode )', 'biolife' ),
						'desc'    => esc_html__( '(Screen resolution of device >=768px and < 992px )', 'biolife' ),
						'options' => array(
							'12' => esc_html__( '1 item', 'biolife' ),
							'6'  => esc_html__( '2 items', 'biolife' ),
							'4'  => esc_html__( '3 items', 'biolife' ),
							'3'  => esc_html__( '4 items', 'biolife' ),
							'15' => esc_html__( '5 items', 'biolife' ),
							'2'  => esc_html__( '6 items', 'biolife' ),
						),
					),
					'ovic_woo_xs_items'        => array(
						'id'      => 'ovic_woo_xs_items',
						'default' => '6',
						'type'    => 'select',
						'title'   => esc_html__( 'Items per row on Desktop( For grid mode )', 'biolife' ),
						'desc'    => esc_html__( '(Screen resolution of device >=480  add < 768px)', 'biolife' ),
						'options' => array(
							'12' => esc_html__( '1 item', 'biolife' ),
							'6'  => esc_html__( '2 items', 'biolife' ),
							'4'  => esc_html__( '3 items', 'biolife' ),
							'3'  => esc_html__( '4 items', 'biolife' ),
							'15' => esc_html__( '5 items', 'biolife' ),
							'2'  => esc_html__( '6 items', 'biolife' ),
						),
					),
					'ovic_woo_ts_items'        => array(
						'id'      => 'ovic_woo_ts_items',
						'default' => '12',
						'type'    => 'select',
						'title'   => esc_html__( 'Items per row on Desktop( For grid mode )', 'biolife' ),
						'desc'    => esc_html__( '(Screen resolution of device < 480px)', 'biolife' ),
						'options' => array(
							'12' => esc_html__( '1 item', 'biolife' ),
							'6'  => esc_html__( '2 items', 'biolife' ),
							'4'  => esc_html__( '3 items', 'biolife' ),
							'3'  => esc_html__( '4 items', 'biolife' ),
							'15' => esc_html__( '5 items', 'biolife' ),
							'2'  => esc_html__( '6 items', 'biolife' ),
						),
					),
                    'feature_products'         => array(
                        'id'      => 'feature_products',
                        'type'    => 'heading',
                        'content' => esc_html__( 'Feature products Settings', 'biolife' ),
                    ),
                    'feature_products_enable'            => array(
                        'id'                => 'feature_products_enable',
                        'type'              => 'select',
                        'default'           => 'disable',
                        'options'           => array(
                            'enable'  => esc_html__( 'Enable', 'biolife' ),
                            'disable' => esc_html__( 'Disable', 'biolife' ),
                        ),
                        'selective_refresh' => array(
                            'selector' => '.ovic_woo_related-product',
                        ),
                        'title'             => esc_html__( 'Enable', 'biolife' ),
                    ),
                    'feature_product_style'  => array(
                        'id'      => 'feature_product_style',
                        'default' => '1',
                        'type'    => 'select_preview',
                        'title'   => esc_html__( 'Product Layout', 'biolife' ),
                        'options' => apply_filters( 'ovic_product_options', 'Theme Option' ),
                        'dependency' => array( 'feature_products_enable', '==', 'enable' ),
                    ),
                    'feature_products_ls_items'          => array(
                        'id'         => 'feature_products_ls_items',
                        'type'       => 'select',
                        'title'      => esc_html__( 'Related products items per row on Desktop', 'biolife' ),
                        'desc'       => esc_html__( '(Screen resolution of device >= 1500px )', 'biolife' ),
                        'options'    => array(
                            '1' => esc_html__( '1 item', 'biolife' ),
                            '2' => esc_html__( '2 items', 'biolife' ),
                            '3' => esc_html__( '3 items', 'biolife' ),
                            '4' => esc_html__( '4 items', 'biolife' ),
                            '5' => esc_html__( '5 items', 'biolife' ),
                            '6' => esc_html__( '6 items', 'biolife' ),
                        ),
                        'default'    => '5',
                        'dependency' => array( 'feature_products_enable', '==', 'enable' ),
                    ),
                    'feature_products_lg_items'          => array(
                        'id'         => 'feature_products_lg_items',
                        'type'       => 'select',
                        'title'      => esc_html__( 'Related products items per row on Desktop', 'biolife' ),
                        'desc'       => esc_html__( '(Screen resolution of device >= 1200px < 1500px )', 'biolife' ),
                        'options'    => array(
                            '1' => esc_html__( '1 item', 'biolife' ),
                            '2' => esc_html__( '2 items', 'biolife' ),
                            '3' => esc_html__( '3 items', 'biolife' ),
                            '4' => esc_html__( '4 items', 'biolife' ),
                            '5' => esc_html__( '5 items', 'biolife' ),
                            '6' => esc_html__( '6 items', 'biolife' ),
                        ),
                        'default'    => '5',
                        'dependency' => array( 'feature_products_enable', '==', 'enable' ),
                    ),
                    'feature_products_md_items'          => array(
                        'id'         => 'feature_products_md_items',
                        'type'       => 'select',
                        'title'      => esc_html__( 'Related products items per row on landscape tablet', 'biolife' ),
                        'desc'       => esc_html__( '(Screen resolution of device >=992px and < 1200px )', 'biolife' ),
                        'options'    => array(
                            '1' => esc_html__( '1 item', 'biolife' ),
                            '2' => esc_html__( '2 items', 'biolife' ),
                            '3' => esc_html__( '3 items', 'biolife' ),
                            '4' => esc_html__( '4 items', 'biolife' ),
                            '5' => esc_html__( '5 items', 'biolife' ),
                            '6' => esc_html__( '6 items', 'biolife' ),
                        ),
                        'default'    => '4',
                        'dependency' => array( 'feature_products_enable', '==', 'enable' ),
                    ),
                    'feature_products_sm_items'          => array(
                        'id'         => 'feature_products_sm_items',
                        'type'       => 'select',
                        'title'      => esc_html__( 'Related product items per row on portrait tablet', 'biolife' ),
                        'desc'       => esc_html__( '(Screen resolution of device >=768px and < 992px )', 'biolife' ),
                        'options'    => array(
                            '1' => esc_html__( '1 item', 'biolife' ),
                            '2' => esc_html__( '2 items', 'biolife' ),
                            '3' => esc_html__( '3 items', 'biolife' ),
                            '4' => esc_html__( '4 items', 'biolife' ),
                            '5' => esc_html__( '5 items', 'biolife' ),
                            '6' => esc_html__( '6 items', 'biolife' ),
                        ),
                        'default'    => '3',
                        'dependency' => array( 'feature_products_enable', '==', 'enable' ),
                    ),
                    'feature_products_xs_items'          => array(
                        'id'         => 'feature_products_xs_items',
                        'type'       => 'select',
                        'title'      => esc_html__( 'Related products items per row on Mobile', 'biolife' ),
                        'desc'       => esc_html__( '(Screen resolution of device >=480  add < 768px)', 'biolife' ),
                        'options'    => array(
                            '1' => esc_html__( '1 item', 'biolife' ),
                            '2' => esc_html__( '2 items', 'biolife' ),
                            '3' => esc_html__( '3 items', 'biolife' ),
                            '4' => esc_html__( '4 items', 'biolife' ),
                            '5' => esc_html__( '5 items', 'biolife' ),
                            '6' => esc_html__( '6 items', 'biolife' ),
                        ),
                        'default'    => '2',
                        'dependency' => array( 'feature_products_enable', '==', 'enable' ),
                    ),
                    'feature_products_ts_items'          => array(
                        'id'         => 'feature_products_ts_items',
                        'type'       => 'select',
                        'title'      => esc_html__( 'Related products items per row on Mobile', 'biolife' ),
                        'desc'       => esc_html__( '(Screen resolution of device < 480px)', 'biolife' ),
                        'options'    => array(
                            '1' => esc_html__( '1 item', 'biolife' ),
                            '2' => esc_html__( '2 items', 'biolife' ),
                            '3' => esc_html__( '3 items', 'biolife' ),
                            '4' => esc_html__( '4 items', 'biolife' ),
                            '5' => esc_html__( '5 items', 'biolife' ),
                            '6' => esc_html__( '6 items', 'biolife' ),
                        ),
                        'default'    => '1',
                        'dependency' => array( 'feature_products_enable', '==', 'enable' ),
                    ),
				);
				/* Single Product Settings*/
				$sections['woocommerce_main']['sections']['single_product']['fields']['ovic_position_summary_product'] = array(
					'id'                => 'ovic_position_summary_product',
					'type'              => 'sorter',
					'title'             => esc_html__( 'Sorter Summary Single Product', 'biolife' ),
					'selective_refresh' => array(
						'selector' => '.entry-summary',
					),
					'options'           => array(
						'enabled'  => array(
							'biolife_single_left_summary'  => esc_html__( 'Single Product Info', 'biolife' ),
							'biolife_single_right_summary' => esc_html__( 'Single Group Add To Cart', 'biolife' ),
						),
						'disabled' => array(
							'woocommerce_template_single_title'       => esc_html__( 'Single Title', 'biolife' ),
							'ovic_woocommerce_group_flash'            => esc_html__( 'Single Group Flash', 'biolife' ),
							'woocommerce_template_single_rating'      => esc_html__( 'Single Rating', 'biolife' ),
							'woocommerce_template_single_price'       => esc_html__( 'Single Price', 'biolife' ),
							'woocommerce_template_single_excerpt'     => esc_html__( 'Single Excerpt', 'biolife' ),
							'woocommerce_template_single_add_to_cart' => esc_html__( 'Single Add To Cart', 'biolife' ),
						),
					),
					'enabled_title'     => esc_html__( 'Active', 'biolife' ),
					'disabled_title'    => '<p>' . esc_html__( 'Deactive', 'biolife' ) . '</p>',
				);
				$sections['woocommerce_main']['sections']['single_product']['fields']['ovic_single_get_payment']       = array(
					'id'              => 'ovic_single_get_payment',
					'type'            => 'group',
					'title'           => esc_html__( 'Payment', 'biolife' ),
					'button_title'    => esc_html__( 'Add item', 'biolife' ),
					'accordion_title' => esc_html__( 'Add New item', 'biolife' ),
					'fields'          => array(
						array(
							'id'    => 'payment_img',
							'type'  => 'image',
							'title' => esc_html__( 'Select image', 'biolife' ),
						),
						array(
							'id'    => 'payment_link',
							'type'  => 'text',
							'title' => esc_html__( 'Enter link for payment', 'biolife' ),
						),
					),
				);
				$sections['woocommerce_main']['sections']['related_product']['fields']       = array(
					'ovic_woo_related_enable'            => array(
						'id'                => 'ovic_woo_related_enable',
						'type'              => 'select',
						'default'           => 'enable',
						'options'           => array(
							'enable'  => esc_html__( 'Enable', 'biolife' ),
							'disable' => esc_html__( 'Disable', 'biolife' ),
						),
						'selective_refresh' => array(
							'selector' => '.ovic_woo_related-product',
						),
						'title'             => esc_html__( 'Enable Related Products', 'biolife' ),
					),
					'ovic_woo_related_products_image'    => array(
						'id'         => 'ovic_woo_related_products_image',
						'type'       => 'image',
						'title'      => esc_html__( 'Related products image', 'biolife' ),
						'desc'       => esc_html__( 'Related products image', 'biolife' ),
						'dependency' => array( 'ovic_woo_related_enable', '==', 'enable' ),
					),
					'ovic_woo_related_products_subtitle' => array(
						'id'         => 'ovic_woo_related_products_subtitle',
						'type'       => 'text',
						'title'      => esc_html__( 'Related products subtitle', 'biolife' ),
						'desc'       => esc_html__( 'Related products subtitle', 'biolife' ),
						'dependency' => array( 'ovic_woo_related_enable', '==', 'enable' ),
						'default'    => esc_html__( 'All the best item for You', 'biolife' ),
					),
					'ovic_woo_related_products_title'    => array(
						'id'         => 'ovic_woo_related_products_title',
						'type'       => 'text',
						'title'      => esc_html__( 'Related products title', 'biolife' ),
						'desc'       => esc_html__( 'Related products title', 'biolife' ),
						'dependency' => array( 'ovic_woo_related_enable', '==', 'enable' ),
						'default'    => esc_html__( 'Related Products', 'biolife' ),
					),
					'ovic_woo_related_ls_items'          => array(
						'id'         => 'ovic_woo_related_ls_items',
						'type'       => 'select',
						'title'      => esc_html__( 'Related products items per row on Desktop', 'biolife' ),
						'desc'       => esc_html__( '(Screen resolution of device >= 1500px )', 'biolife' ),
						'options'    => array(
							'1' => esc_html__( '1 item', 'biolife' ),
							'2' => esc_html__( '2 items', 'biolife' ),
							'3' => esc_html__( '3 items', 'biolife' ),
							'4' => esc_html__( '4 items', 'biolife' ),
							'5' => esc_html__( '5 items', 'biolife' ),
							'6' => esc_html__( '6 items', 'biolife' ),
						),
						'default'    => '3',
						'dependency' => array( 'ovic_woo_related_enable', '==', 'enable' ),
					),
					'ovic_woo_related_lg_items'          => array(
						'id'         => 'ovic_woo_related_lg_items',
						'type'       => 'select',
						'title'      => esc_html__( 'Related products items per row on Desktop', 'biolife' ),
						'desc'       => esc_html__( '(Screen resolution of device >= 1200px < 1500px )', 'biolife' ),
						'options'    => array(
							'1' => esc_html__( '1 item', 'biolife' ),
							'2' => esc_html__( '2 items', 'biolife' ),
							'3' => esc_html__( '3 items', 'biolife' ),
							'4' => esc_html__( '4 items', 'biolife' ),
							'5' => esc_html__( '5 items', 'biolife' ),
							'6' => esc_html__( '6 items', 'biolife' ),
						),
						'default'    => '3',
						'dependency' => array( 'ovic_woo_related_enable', '==', 'enable' ),
					),
					'ovic_woo_related_md_items'          => array(
						'id'         => 'ovic_woo_related_md_items',
						'type'       => 'select',
						'title'      => esc_html__( 'Related products items per row on landscape tablet', 'biolife' ),
						'desc'       => esc_html__( '(Screen resolution of device >=992px and < 1200px )', 'biolife' ),
						'options'    => array(
							'1' => esc_html__( '1 item', 'biolife' ),
							'2' => esc_html__( '2 items', 'biolife' ),
							'3' => esc_html__( '3 items', 'biolife' ),
							'4' => esc_html__( '4 items', 'biolife' ),
							'5' => esc_html__( '5 items', 'biolife' ),
							'6' => esc_html__( '6 items', 'biolife' ),
						),
						'default'    => '3',
						'dependency' => array( 'ovic_woo_related_enable', '==', 'enable' ),
					),
					'ovic_woo_related_sm_items'          => array(
						'id'         => 'ovic_woo_related_sm_items',
						'type'       => 'select',
						'title'      => esc_html__( 'Related product items per row on portrait tablet', 'biolife' ),
						'desc'       => esc_html__( '(Screen resolution of device >=768px and < 992px )', 'biolife' ),
						'options'    => array(
							'1' => esc_html__( '1 item', 'biolife' ),
							'2' => esc_html__( '2 items', 'biolife' ),
							'3' => esc_html__( '3 items', 'biolife' ),
							'4' => esc_html__( '4 items', 'biolife' ),
							'5' => esc_html__( '5 items', 'biolife' ),
							'6' => esc_html__( '6 items', 'biolife' ),
						),
						'default'    => '2',
						'dependency' => array( 'ovic_woo_related_enable', '==', 'enable' ),
					),
					'ovic_woo_related_xs_items'          => array(
						'id'         => 'ovic_woo_related_xs_items',
						'type'       => 'select',
						'title'      => esc_html__( 'Related products items per row on Mobile', 'biolife' ),
						'desc'       => esc_html__( '(Screen resolution of device >=480  add < 768px)', 'biolife' ),
						'options'    => array(
							'1' => esc_html__( '1 item', 'biolife' ),
							'2' => esc_html__( '2 items', 'biolife' ),
							'3' => esc_html__( '3 items', 'biolife' ),
							'4' => esc_html__( '4 items', 'biolife' ),
							'5' => esc_html__( '5 items', 'biolife' ),
							'6' => esc_html__( '6 items', 'biolife' ),
						),
						'default'    => '1',
						'dependency' => array( 'ovic_woo_related_enable', '==', 'enable' ),
					),
					'ovic_woo_related_ts_items'          => array(
						'id'         => 'ovic_woo_related_ts_items',
						'type'       => 'select',
						'title'      => esc_html__( 'Related products items per row on Mobile', 'biolife' ),
						'desc'       => esc_html__( '(Screen resolution of device < 480px)', 'biolife' ),
						'options'    => array(
							'1' => esc_html__( '1 item', 'biolife' ),
							'2' => esc_html__( '2 items', 'biolife' ),
							'3' => esc_html__( '3 items', 'biolife' ),
							'4' => esc_html__( '4 items', 'biolife' ),
							'5' => esc_html__( '5 items', 'biolife' ),
							'6' => esc_html__( '6 items', 'biolife' ),
						),
						'default'    => '1',
						'dependency' => array( 'ovic_woo_related_enable', '==', 'enable' ),
					),
				);
				$sections['woocommerce_main']['sections']['crosssell_product']['fields']     = array(
					'ovic_woo_crosssell_enable'            => array(
						'id'                => 'ovic_woo_crosssell_enable',
						'type'              => 'select',
						'default'           => 'enable',
						'options'           => array(
							'enable'  => esc_html__( 'Enable', 'biolife' ),
							'disable' => esc_html__( 'Disable', 'biolife' ),
						),
						'selective_refresh' => array(
							'selector' => '.ovic_woo_crosssell-product',
						),
						'title'             => esc_html__( 'Enable Cross Sell Products', 'biolife' ),
					),
					'ovic_woo_crosssell_products_image'    => array(
						'id'         => 'ovic_woo_crosssell_products_image',
						'type'       => 'image',
						'title'      => esc_html__( 'Cross Sell products image', 'biolife' ),
						'desc'       => esc_html__( 'Cross Sell products image', 'biolife' ),
						'dependency' => array( 'ovic_woo_crosssell_enable', '==', 'enable' ),
					),
					'ovic_woo_crosssell_products_subtitle' => array(
						'id'         => 'ovic_woo_crosssell_products_subtitle',
						'type'       => 'text',
						'title'      => esc_html__( 'Cross Sell products subtitle', 'biolife' ),
						'desc'       => esc_html__( 'Cross Sell products subtitle', 'biolife' ),
						'dependency' => array( 'ovic_woo_crosssell_enable', '==', 'enable' ),
						'default'    => esc_html__( 'All the best item for You', 'biolife' ),
					),
					'ovic_woo_crosssell_products_title'    => array(
						'id'         => 'ovic_woo_crosssell_products_title',
						'type'       => 'text',
						'title'      => esc_html__( 'Cross Sell products title', 'biolife' ),
						'desc'       => esc_html__( 'Cross Sell products title', 'biolife' ),
						'dependency' => array( 'ovic_woo_crosssell_enable', '==', 'enable' ),
						'default'    => esc_html__( 'Cross Sell Products', 'biolife' ),
					),
					'ovic_woo_crosssell_ls_items'          => array(
						'id'         => 'ovic_woo_crosssell_ls_items',
						'type'       => 'select',
						'title'      => esc_html__( 'Cross Sell products items per row on Desktop', 'biolife' ),
						'desc'       => esc_html__( '(Screen resolution of device >= 1500px )', 'biolife' ),
						'options'    => array(
							'1' => esc_html__( '1 item', 'biolife' ),
							'2' => esc_html__( '2 items', 'biolife' ),
							'3' => esc_html__( '3 items', 'biolife' ),
							'4' => esc_html__( '4 items', 'biolife' ),
							'5' => esc_html__( '5 items', 'biolife' ),
							'6' => esc_html__( '6 items', 'biolife' ),
						),
						'default'    => '3',
						'dependency' => array( 'ovic_woo_crosssell_enable', '==', 'enable' ),
					),
					'ovic_woo_crosssell_lg_items'          => array(
						'id'         => 'ovic_woo_crosssell_lg_items',
						'type'       => 'select',
						'title'      => esc_html__( 'Cross Sell products items per row on Desktop', 'biolife' ),
						'desc'       => esc_html__( '(Screen resolution of device >= 1200px < 1500px )', 'biolife' ),
						'options'    => array(
							'1' => esc_html__( '1 item', 'biolife' ),
							'2' => esc_html__( '2 items', 'biolife' ),
							'3' => esc_html__( '3 items', 'biolife' ),
							'4' => esc_html__( '4 items', 'biolife' ),
							'5' => esc_html__( '5 items', 'biolife' ),
							'6' => esc_html__( '6 items', 'biolife' ),
						),
						'default'    => '3',
						'dependency' => array( 'ovic_woo_crosssell_enable', '==', 'enable' ),
					),
					'ovic_woo_crosssell_md_items'          => array(
						'id'         => 'ovic_woo_crosssell_md_items',
						'type'       => 'select',
						'title'      => esc_html__( 'Cross Sell products items per row on landscape tablet', 'biolife' ),
						'desc'       => esc_html__( '(Screen resolution of device >=992px and < 1200px )', 'biolife' ),
						'options'    => array(
							'1' => esc_html__( '1 item', 'biolife' ),
							'2' => esc_html__( '2 items', 'biolife' ),
							'3' => esc_html__( '3 items', 'biolife' ),
							'4' => esc_html__( '4 items', 'biolife' ),
							'5' => esc_html__( '5 items', 'biolife' ),
							'6' => esc_html__( '6 items', 'biolife' ),
						),
						'default'    => '3',
						'dependency' => array( 'ovic_woo_crosssell_enable', '==', 'enable' ),
					),
					'ovic_woo_crosssell_sm_items'          => array(
						'id'         => 'ovic_woo_crosssell_sm_items',
						'type'       => 'select',
						'title'      => esc_html__( 'Cross Sell product items per row on portrait tablet', 'biolife' ),
						'desc'       => esc_html__( '(Screen resolution of device >=768px and < 992px )', 'biolife' ),
						'options'    => array(
							'1' => esc_html__( '1 item', 'biolife' ),
							'2' => esc_html__( '2 items', 'biolife' ),
							'3' => esc_html__( '3 items', 'biolife' ),
							'4' => esc_html__( '4 items', 'biolife' ),
							'5' => esc_html__( '5 items', 'biolife' ),
							'6' => esc_html__( '6 items', 'biolife' ),
						),
						'default'    => '2',
						'dependency' => array( 'ovic_woo_crosssell_enable', '==', 'enable' ),
					),
					'ovic_woo_crosssell_xs_items'          => array(
						'id'         => 'ovic_woo_crosssell_xs_items',
						'type'       => 'select',
						'title'      => esc_html__( 'Cross Sell products items per row on Mobile', 'biolife' ),
						'desc'       => esc_html__( '(Screen resolution of device >=480  add < 768px)', 'biolife' ),
						'options'    => array(
							'1' => esc_html__( '1 item', 'biolife' ),
							'2' => esc_html__( '2 items', 'biolife' ),
							'3' => esc_html__( '3 items', 'biolife' ),
							'4' => esc_html__( '4 items', 'biolife' ),
							'5' => esc_html__( '5 items', 'biolife' ),
							'6' => esc_html__( '6 items', 'biolife' ),
						),
						'default'    => '1',
						'dependency' => array( 'ovic_woo_crosssell_enable', '==', 'enable' ),
					),
					'ovic_woo_crosssell_ts_items'          => array(
						'id'         => 'ovic_woo_crosssell_ts_items',
						'type'       => 'select',
						'title'      => esc_html__( 'Cross Sell products items per row on Mobile', 'biolife' ),
						'desc'       => esc_html__( '(Screen resolution of device < 480px)', 'biolife' ),
						'options'    => array(
							'1' => esc_html__( '1 item', 'biolife' ),
							'2' => esc_html__( '2 items', 'biolife' ),
							'3' => esc_html__( '3 items', 'biolife' ),
							'4' => esc_html__( '4 items', 'biolife' ),
							'5' => esc_html__( '5 items', 'biolife' ),
							'6' => esc_html__( '6 items', 'biolife' ),
						),
						'default'    => '1',
						'dependency' => array( 'ovic_woo_crosssell_enable', '==', 'enable' ),
					),
				);
				$sections['woocommerce_main']['sections']['upsell_product']['fields']        = array(
					'ovic_woo_upsell_enable'            => array(
						'id'                => 'ovic_woo_upsell_enable',
						'type'              => 'select',
						'default'           => 'enable',
						'options'           => array(
							'enable'  => esc_html__( 'Enable', 'biolife' ),
							'disable' => esc_html__( 'Disable', 'biolife' ),
						),
						'selective_refresh' => array(
							'selector' => '.ovic_woo_upsell-product',
						),
						'title'             => esc_html__( 'Enable Up Sell Products', 'biolife' ),
					),
					'ovic_woo_upsell_products_image'    => array(
						'id'         => 'ovic_woo_upsell_products_image',
						'type'       => 'image',
						'title'      => esc_html__( 'Up Sell products image', 'biolife' ),
						'desc'       => esc_html__( 'Up Sell products image', 'biolife' ),
						'dependency' => array( 'ovic_woo_upsell_enable', '==', 'enable' ),
					),
					'ovic_woo_upsell_products_subtitle' => array(
						'id'         => 'ovic_woo_upsell_products_subtitle',
						'type'       => 'text',
						'title'      => esc_html__( 'Up Sell products subtitle', 'biolife' ),
						'desc'       => esc_html__( 'Up Sell products subtitle', 'biolife' ),
						'dependency' => array( 'ovic_woo_upsell_enable', '==', 'enable' ),
						'default'    => esc_html__( 'All the best item for You', 'biolife' ),
					),
					'ovic_woo_upsell_products_title'    => array(
						'id'         => 'ovic_woo_upsell_products_title',
						'type'       => 'text',
						'title'      => esc_html__( 'Up Sell products title', 'biolife' ),
						'desc'       => esc_html__( 'Up Sell products title', 'biolife' ),
						'dependency' => array( 'ovic_woo_upsell_enable', '==', 'enable' ),
						'default'    => esc_html__( 'Up Sell Products', 'biolife' ),
					),
					'ovic_woo_upsell_ls_items'          => array(
						'id'         => 'ovic_woo_upsell_ls_items',
						'type'       => 'select',
						'title'      => esc_html__( 'Up Sell products items per row on Desktop', 'biolife' ),
						'desc'       => esc_html__( '(Screen resolution of device >= 1500px )', 'biolife' ),
						'options'    => array(
							'1' => esc_html__( '1 item', 'biolife' ),
							'2' => esc_html__( '2 items', 'biolife' ),
							'3' => esc_html__( '3 items', 'biolife' ),
							'4' => esc_html__( '4 items', 'biolife' ),
							'5' => esc_html__( '5 items', 'biolife' ),
							'6' => esc_html__( '6 items', 'biolife' ),
						),
						'default'    => '3',
						'dependency' => array( 'ovic_woo_upsell_enable', '==', 'enable' ),
					),
					'ovic_woo_upsell_lg_items'          => array(
						'id'         => 'ovic_woo_upsell_lg_items',
						'type'       => 'select',
						'title'      => esc_html__( 'Up Sell products items per row on Desktop', 'biolife' ),
						'desc'       => esc_html__( '(Screen resolution of device >= 1200px < 1500px )', 'biolife' ),
						'options'    => array(
							'1' => esc_html__( '1 item', 'biolife' ),
							'2' => esc_html__( '2 items', 'biolife' ),
							'3' => esc_html__( '3 items', 'biolife' ),
							'4' => esc_html__( '4 items', 'biolife' ),
							'5' => esc_html__( '5 items', 'biolife' ),
							'6' => esc_html__( '6 items', 'biolife' ),
						),
						'default'    => '3',
						'dependency' => array( 'ovic_woo_upsell_enable', '==', 'enable' ),
					),
					'ovic_woo_upsell_md_items'          => array(
						'id'         => 'ovic_woo_upsell_md_items',
						'type'       => 'select',
						'title'      => esc_html__( 'Up Sell products items per row on landscape tablet', 'biolife' ),
						'desc'       => esc_html__( '(Screen resolution of device >=992px and < 1200px )', 'biolife' ),
						'options'    => array(
							'1' => esc_html__( '1 item', 'biolife' ),
							'2' => esc_html__( '2 items', 'biolife' ),
							'3' => esc_html__( '3 items', 'biolife' ),
							'4' => esc_html__( '4 items', 'biolife' ),
							'5' => esc_html__( '5 items', 'biolife' ),
							'6' => esc_html__( '6 items', 'biolife' ),
						),
						'default'    => '3',
						'dependency' => array( 'ovic_woo_upsell_enable', '==', 'enable' ),
					),
					'ovic_woo_upsell_sm_items'          => array(
						'id'         => 'ovic_woo_upsell_sm_items',
						'type'       => 'select',
						'title'      => esc_html__( 'Up Sell product items per row on portrait tablet', 'biolife' ),
						'desc'       => esc_html__( '(Screen resolution of device >=768px and < 992px )', 'biolife' ),
						'options'    => array(
							'1' => esc_html__( '1 item', 'biolife' ),
							'2' => esc_html__( '2 items', 'biolife' ),
							'3' => esc_html__( '3 items', 'biolife' ),
							'4' => esc_html__( '4 items', 'biolife' ),
							'5' => esc_html__( '5 items', 'biolife' ),
							'6' => esc_html__( '6 items', 'biolife' ),
						),
						'default'    => '2',
						'dependency' => array( 'ovic_woo_upsell_enable', '==', 'enable' ),
					),
					'ovic_woo_upsell_xs_items'          => array(
						'id'         => 'ovic_woo_upsell_xs_items',
						'type'       => 'select',
						'title'      => esc_html__( 'Up Sell products items per row on Mobile', 'biolife' ),
						'desc'       => esc_html__( '(Screen resolution of device >=480  add < 768px)', 'biolife' ),
						'options'    => array(
							'1' => esc_html__( '1 item', 'biolife' ),
							'2' => esc_html__( '2 items', 'biolife' ),
							'3' => esc_html__( '3 items', 'biolife' ),
							'4' => esc_html__( '4 items', 'biolife' ),
							'5' => esc_html__( '5 items', 'biolife' ),
							'6' => esc_html__( '6 items', 'biolife' ),
						),
						'default'    => '1',
						'dependency' => array( 'ovic_woo_upsell_enable', '==', 'enable' ),
					),
					'ovic_woo_upsell_ts_items'          => array(
						'id'         => 'ovic_woo_upsell_ts_items',
						'type'       => 'select',
						'title'      => esc_html__( 'Up Sell products items per row on Mobile', 'biolife' ),
						'desc'       => esc_html__( '(Screen resolution of device < 480px)', 'biolife' ),
						'options'    => array(
							'1' => esc_html__( '1 item', 'biolife' ),
							'2' => esc_html__( '2 items', 'biolife' ),
							'3' => esc_html__( '3 items', 'biolife' ),
							'4' => esc_html__( '4 items', 'biolife' ),
							'5' => esc_html__( '5 items', 'biolife' ),
							'6' => esc_html__( '6 items', 'biolife' ),
						),
						'default'    => '1',
						'dependency' => array( 'ovic_woo_upsell_enable', '==', 'enable' ),
					),
				);

			}
            $sections['header_main']['sections']['header']      = array(
                'name'   => 'header',
                'title'  => esc_html__( 'Header', 'biolife' ),
                'fields' => array(
                    'header_settings'  => array(
                        'id'      => 'header_settings',
                        'type'    => 'heading',
                        'content' => esc_html__( 'Header Settings', 'biolife' ),
                    ),
                    'biolife_header_background' => array(
                        'id'    => 'biolife_header_background',
                        'type'  => 'image',
                        'title' => esc_html__( 'Header background', 'biolife' ),
                    ),
                    'ovic_header_background' => array(
                        'id'    => 'ovic_header_background',
                        'type'  => 'image',
                        'title' => esc_html__( 'Header banner', 'biolife' ),
                    ),
                    'ovic_header_background_pages_off'=>array(
                        'id'         => 'ovic_header_background_pages_off',
                        'type'       => 'select',
                        'title'      => esc_html__( 'Disabled banner on pages', 'biolife' ),
                        'options'    => 'page',
                        'class'      => 'chosen',
                        'attributes' => array(
                            'placeholder' => 'Select a page',
                            'multiple'    => 'multiple',
                        ),
                    ),
                    'biolife_used_header' => array(
                        'id'         => 'biolife_used_header',
                        'type'       => 'select_preview',
                        'title'      => esc_html__( 'Header Layout', 'biolife' ),
                        'desc'       => esc_html__( 'Select a header layout', 'biolife' ),
                        'options'    => get_header_options(),
                        'default'    => 'style-01',
                        'attributes' => array(
                            'data-depend-id' => 'biolife_used_header',
                        ),
                    ),
                    'ovic_sticky_menu' => array(
                        'id'    => 'ovic_sticky_menu',
                        'type'  => 'switcher',
                        'title' => esc_html__( 'Sticky Menu', 'biolife' ),
                    ),
                    'header_middle_icon' => array(
                        'id'    => 'header_middle_icon',
                        'type'  => 'icon',
                        'title' => esc_html__( 'Select info icon', 'biolife' ),
                        'dependency' => array( 'biolife_used_header', 'any', 'style-02,style-07' ),
                    ),
                    'header_middle_text_1' => array(
                        'id'    => 'header_middle_text_1',
                        'type'  => 'text',
                        'title' => esc_html__( 'Enter info text 1', 'biolife' ),
                        'dependency' => array( 'biolife_used_header', 'any', 'style-02,style-07' ),
                        'multilang' => true,
                    ),
                    'header_middle_text_2' => array(
                        'id'    => 'header_middle_text_2',
                        'type'  => 'text',
                        'title' => esc_html__( 'Enter info text 2', 'biolife' ),
                        'dependency' => array( 'biolife_used_header', 'any', 'style-02,style-07' ),
                        'multilang' => true,
                    ),
                    'icon_text_before' => array(
                        'id'    => 'icon_text_before',
                        'type'  => 'icon',
                        'title' => esc_html__( 'Select icon text', 'biolife' ),
                        'dependency' => array( 'biolife_used_header', '==', 'style-11' ),
                    ),
                    'text_before_search' => array(
                        'id'    => 'text_before_search',
                        'type'  => 'text',
                        'title' => esc_html__( 'Text Before Search', 'biolife' ),
                        'dependency' => array( 'biolife_used_header', '==', 'style-11' ),
                    ),
                    'text_menu' => array(
                        'id'    => 'text_menu',
                        'type'  => 'text',
                        'title' => esc_html__( 'Text Last Menu', 'biolife' ),
                        'dependency' => array( 'biolife_used_header', '==', 'style-12' ),
                    ),
                    'top_background' => array(
                        'id' => 'top_background',
                        'type' => 'image',
                        'title' => esc_html__('Banner Image', 'organix'),
                        'dependency' => array( 'biolife_used_header', '==', 'style-13' ),
                    ),
                    'text_banner_top' => array(
                        'id' => 'text_banner_top',
                        'type' => 'wysiwyg',
                        'title' => esc_html__('Text Header Top', 'organix'),
                        'desc' => esc_html__('use tag <strong>text</strong> for bold text', 'organix'),
                        'height' => '100px',
                        'media_buttons' => false,
                        'tinymce' => false,
                        'dependency' => array( 'biolife_used_header', '==', 'style-13' ),
                    ),
                    'header_background' => array(
                        'id' => 'header_background',
                        'type' => 'image',
                        'title' => esc_html__('Background Image For Header', 'organix'),
                        'dependency' => array( 'biolife_used_header', '==', 'style-13' ),
                    ),
                ),
            );
			$sections['header_main']['sections']['vertical']      = array(
                'name'   => 'vertical',
                'title'  => esc_html__('Vertical Settings', 'biolife'),
                'fields' => array(
                    array(
                        'id'                => 'ovic_enable_vertical_menu',
                        'type'              => 'switcher',
                        'selective_refresh' => array(
                            'selector' => '.vertical-wapper',
                        ),
                        'attributes'        => array(
                            'data-depend-id' => 'enable_vertical_menu',
                        ),
                        'title'             => esc_html__('Enable Vertical Menu', 'biolife'),
                    ),
                    array(
                        'id'         => 'ovic_block_vertical_menu',
                        'type'       => 'select',
                        'title'      => esc_html__('Vertical Menu Always Open', 'biolife'),
                        'options'    => 'page',
                        'class'      => 'chosen',
                        'attributes' => array(
                            'placeholder' => 'Select a page',
                            'multiple'    => 'multiple',
                        ),
                        'dependency' => array(
                            'enable_vertical_menu', '==', true,
                        ),
                        'after'      => '<i class="ovic-text-desc">' . esc_html__('-- Vertical menu will be always open --',
                                'biolife') . '</i>',
                    ),
                    array(
                        'id'         => 'ovic_vertical_menu_title',
                        'type'       => 'text',
                        'title'      => esc_html__('Vertical Menu Title', 'biolife'),
                        'dependency' => array(
                            'enable_vertical_menu', '==', true,
                        ),
                        'default'    => esc_html__('CATEGORIES', 'biolife'),
                        'multilang' => true,
                    ),
                    array(
                        'id'         => 'ovic_vertical_menu_button_all_text',
                        'type'       => 'text',
                        'title'      => esc_html__('Vertical Menu Button show all text', 'biolife'),
                        'dependency' => array(
                            'enable_vertical_menu', '==', true,
                        ),
                        'default'    => esc_html__('All Categories', 'biolife'),
                        'multilang' => true,
                    ),
                    array(
                        'id'         => 'ovic_vertical_menu_button_close_text',
                        'type'       => 'text',
                        'title'      => esc_html__('Vertical Menu Button close text', 'biolife'),
                        'dependency' => array(
                            'enable_vertical_menu', '==', true,
                        ),
                        'default'    => esc_html__('Close', 'biolife'),
                        'multilang' => true,
                    ),
                    array(
                        'id'         => 'ovic_vertical_item_visible',
                        'type'       => 'number',
                        'title'      => esc_html__('The number of visible vertical menu items', 'biolife'),
                        'desc'       => esc_html__('The number of visible vertical menu items', 'biolife'),
                        'dependency' => array(
                            'enable_vertical_menu', '==', true,
                        ),
                        'default'    => 10,
                    ),
                ),
            );
            // GENERAL
            array_splice( $sections['general_main']['sections']['general']['fields'], 1, 0,
                array(
                    array(
                        'id'       => 'logo_mobile',
                        'type'     => 'image',
                        'url'      => true,
                        'title'    => esc_html__( 'Logo Mobile', 'biolife' ),
                        'compiler' => 'true',
                        'desc'     => esc_html__( 'Setting Logo Mobile For Site', 'biolife' ),
                    ),
                )
            );
            array_splice( $sections['general_main']['sections']['general']['fields'], 4, 0,
                array(
                    array(
                        'id'       => 'ovic_placeholder_image',
                        'type'     => 'image',
                        'url'      => true,
                        'title'    => esc_html__( 'Placeholder image', 'biolife' ),
                        'compiler' => 'true',
                    ),
                )
            );
			array_splice( $sections['blog_main']['sections']['blog']['fields'], 0, 0,
				array(
					array(
						'id'    => 'ovic_enable_social_blog',
						'type'  => 'switcher',
						'title' => esc_html__( 'Social Share Blog', 'biolife' ),
					),
				)
			);
			array_splice( $sections['general_main']['sections']['general']['fields'], 0, 0,
				array(
					array(
						'id'    => 'enable_back_to_top',
						'type'  => 'switcher',
						'title' => esc_html__( 'Enable Back To Top Button', 'biolife' ),
					),
				)
			);
			return $sections;
		}
	}

	new Biolife_Theme_Options();
}
/*==========================================================================
META BOX OPTIONS
===========================================================================*/
if ( !function_exists( 'biolife_metabox_options' ) ) {
    add_filter( 'ovic_options_metabox', 'biolife_metabox_options' );
    function biolife_metabox_options( $sections )
    {
        $option_footer = ( class_exists( 'Ovic_Footer_Builder' ) ) ? Ovic_Footer_Builder::ovic_get_footer_preview() : array();
        $sections[]    = array(
            'id'        => '_custom_metabox_theme_options',
            'title'     => esc_html__( 'Custom Theme Options', 'biolife' ),
            'post_type' => 'page',
            'context'   => 'normal',
            'priority'  => 'high',
            'sections'  => array(
                'metabox_options' => array(
                    'name'   => 'metabox_options',
                    'icon'   => 'fa fa-toggle-off',
                    'title'  => esc_html__( 'Meta Box Options', 'biolife' ),
                    'desc'   => esc_html__( 'Enable for using Themes setting on this page.', 'biolife' ),
                    'fields' => array(
                        array(
                            'id'    => 'metabox_options_enable',
                            'type'  => 'switcher',
                            'title' => esc_html__( 'Meta Box Options', 'biolife' ),
                            'desc'  => esc_html__( 'Enable for using Themes setting on this page.', 'biolife' ),
                        ),
                        array(
                            'id'         => 'metabox_logo',
                            'type'       => 'image',
                            'title'      => esc_html__( 'Logo', 'biolife' ),
                            'desc'       => esc_html__( 'Setting Logo For this page', 'biolife' ),
                            'dependency' => array( 'metabox_options_enable', '==', true ),
                        ),
                        array(
                            'id'         => 'metabox_biolife_page_banner',
                            'type'       => 'image',
                            'title'      => esc_html__( 'Page Banner', 'biolife' ),
                            'desc'       => esc_html__( 'Setting Banner For this page', 'biolife' ),
                            'dependency' => array( 'metabox_options_enable', '==', true ),
                        ),
                        array(
                            'id'         => 'metabox_biolife_used_header',
                            'type'       => 'select_preview',
                            'title'      => esc_html__( 'Header Layout', 'biolife' ),
                            'desc'       => esc_html__( 'Select a header layout', 'biolife' ),
                            'options'    => get_header_options(),
                            'default'    => 'style-1',
                            'dependency' => array( 'metabox_options_enable', '==', true ),
                        ),
                        array(
                            'id'         => 'metabox_biolife_used_footer',
                            'type'       => 'select_preview',
                            'title'      => esc_html__( 'Footer Layout', 'biolife' ),
                            'desc'       => esc_html__( 'Select a footer layout', 'biolife' ),
                            'options'    => $option_footer,
                            'dependency' => array( 'metabox_options_enable', '==', true ),
                        ),
                    ),
                ),
            ),
        );

        return $sections;
    }
}

