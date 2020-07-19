<?php
if ( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Ovic_Products"
 */
if ( !class_exists( 'Ovic_Shortcode_Products' ) ) {
	class Ovic_Shortcode_Products extends Ovic_Shortcode
	{
		/**
		 * Shortcode name.
		 *
		 * @var  string
		 */
		public $shortcode = 'products';

		static public function add_css_generate( $atts )
		{
			$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'ovic_products', $atts ) : $atts;
			// Extract shortcode parameters.
			extract( $atts );
			$css = '';

			return apply_filters( 'Ovic_Shortcode_Products_css', $css, $atts );
		}

		public function output_html( $atts, $content = null )
		{
			$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'ovic_products', $atts ) : $atts;
            $css_animation = $hide_categories = $hide_review = $background_color = $image_background = $icon_images = $layout = $link = '';
			extract( $atts );
            if($hide_review == 'true'){
                $hide_review = 'review_hided';
            }else{
                $hide_review = '';
            }
            if($hide_categories == 'true'){
                $hide_categories = 'categories_hided';
            }else{
                $hide_categories = '';
            }

			$css_class    = array( $hide_categories, $hide_review, 'ovic-products',biolife_getCSSAnimation( $css_animation )  );
			$css_class[]  = 'style-' . $atts['product_style'];
			$css_class[]  = $atts['el_class'];
            if($layout){
                $css_class[] = 'ovic-products-'.$layout;
            }
			$class_editor = isset( $atts['css'] ) ? vc_shortcode_custom_css_class( $atts['css'], ' ' ) : '';
			$css_class[]  = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'ovic_products', $atts );
			/* Product Size */
			if ( $atts['product_image_size'] ) {
				if ( $atts['product_image_size'] == 'custom' ) {
					$thumb_width  = $atts['product_custom_thumb_width'];
					$thumb_height = $atts['product_custom_thumb_height'];
				} else {
					$product_image_size = explode( "x", $atts['product_image_size'] );
					$thumb_width        = $product_image_size[0];
					$thumb_height       = $product_image_size[1];
				}
				if ( $thumb_width > 0 ) {
                    add_filter( 'ovic_shop_product_thumb_width',
                        function () use ( $thumb_width ) {
                            return $thumb_width;
                        }
                    );
					//add_filter( 'ovic_shop_product_thumb_width', create_function( '', 'return ' . $thumb_width . ';' ) );
				}
				if ( $thumb_height > 0 ) {
                    add_filter( 'ovic_shop_product_thumb_height',
                        function () use ( $thumb_height ) {
                            return $thumb_height;
                        }
                    );
				}
			}
			$products             = apply_filters( 'ovic_getProducts', $atts );
			$total_product        = $products->post_count;
			$product_item_class   = array( 'product-item', $atts['target'] );
			$product_item_class[] = 'style-' . $atts['product_style'];
            if($atts['product_style'] == '6' || $atts['product_style'] == '11'){
                $product_item_class[] = 'style-1';
            }elseif ($atts['product_style'] == '12'){
                //$product_item_class[] = 'style-1 style-11';
            }

			$product_list_class   = array();
			$owl_settings         = '';
			if ( $atts['productsliststyle'] == 'grid' ) {
				$product_list_class[] = 'product-list-grid row auto-clear equal-container better-height ';
				$product_item_class[] = $atts['boostrap_rows_space'];
				$product_item_class[] = 'col-bg-' . $atts['boostrap_bg_items'];
				$product_item_class[] = 'col-lg-' . $atts['boostrap_lg_items'];
				$product_item_class[] = 'col-md-' . $atts['boostrap_md_items'];
				$product_item_class[] = 'col-sm-' . $atts['boostrap_sm_items'];
				$product_item_class[] = 'col-xs-' . $atts['boostrap_xs_items'];
				$product_item_class[] = 'col-ts-' . $atts['boostrap_ts_items'];
			}
			if ( $atts['productsliststyle'] == 'owl' ) {
				if ( $total_product < $atts['owl_lg_items'] ) {
					$atts['owl_loop'] = 'false';
				}
				$product_list_class[] = 'product-list-owl owl-slick equal-container better-height';
				$product_list_class[] = $atts['owl_navigation_style'];
				$product_item_class[] = $atts['owl_rows_space'];
				$owl_settings         = apply_filters( 'ovic_carousel_data_attributes', 'owl_', $atts );
			}
			$attribute_name       = $atts['attribute_options'];
			$attribute_taxonomies = wc_get_attribute_taxonomies();
			$taxonomy_terms       = array();
			if ( $attribute_taxonomies && $attribute_name != '' ) :
				foreach ( $attribute_taxonomies as $tax ) :
					if ( taxonomy_exists( wc_attribute_taxonomy_name( $tax->attribute_name ) ) && $tax->attribute_name == $attribute_name ) :
						$taxonomy_terms[$tax->attribute_name] = get_terms( wc_attribute_taxonomy_name( $tax->attribute_name ), 'orderby=name&hide_empty=1' );
					endif;
				endforeach;
			endif;

            if ($icon_images){
                $image_icon = apply_filters( 'ovic_resize_image', $icon_images, false, false, true, true );
            }

            if ($image_background){
                $image_thumb = apply_filters( 'ovic_resize_image', $image_background, false, false, true, true );
            }else{
                $image_thumb = array('url'=>'', 'width'=>0, 'height'=>0, 'img'=>'');
            }
            if ($background_color){
                $background_color = "background-color: ".$background_color.';';
            }

            if ($link) {
                $link = vc_build_link($atts['link']);
            } else {
                $link = array('title' => '', 'url' => '', 'target' => '_self');
            }

			ob_start(); ?>
            <?php if ($layout == 'style2'): ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <?php
                        if (isset($atts['title_background']) && $atts['title_background']){
                            $title_background = apply_filters( 'ovic_resize_image', $atts['title_background'], false, false, true, true );
                        }else{
                            $title_background = array('url'=>'', 'width'=>0, 'height'=>0, 'img'=>'');
                        }
                    ?>
                    <?php if ($atts['title']): ?>
                        <div class="box-title" <?php if ($title_background['url']): ?> style="background-image: url('<?php echo esc_url($title_background['url']); ?>')" <?php endif; ?>  >
                            <?php echo esc_html($atts['title']); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( !empty( $taxonomy_terms ) && $atts['product_style'] == 4 && $attribute_name != '' ): ?>
                        <div class="tabs-variable">
                            <?php foreach ( $taxonomy_terms[$attribute_name] as $taxonomy_term ): ?>
                                <a href="#" class="item-attribute" data-attribute_class="<?php echo esc_attr($taxonomy_term->slug); ?>"><?php echo esc_html($taxonomy_term->name); ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( $products->have_posts() ): ?>
                        <div class="<?php echo esc_attr( implode( ' ', $product_list_class ) ); ?>" <?php echo esc_attr( $owl_settings ); ?>>
                            <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                                <?php
                                    $product_item_class = apply_filters( 'ovic_class_item_shortcode_product', $product_item_class, $atts );
                                    remove_action('woocommerce_before_shop_loop_item_title','ovic_woocommerce_group_flash', 10);
                                ?>
                                <div <?php post_class( $product_item_class ); ?>>
                                    <div class="product-container">
                                        <div class="product-inner">
                                            <div class="product-thumb">
                                                <?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
                                            </div>
                                            <div class="product-info">
                                                <div class="inner">
                                                    <?php do_action( 'woocommerce_shop_loop_item_title' ); ?>
                                                    <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
                                                    <div class="short-description"><?php echo wp_trim_words(get_the_excerpt(), 12); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="group-button">
                                            <div class="inner">
                                                <div class="add-to-cart">
                                                    <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
                                                </div>
                                                <?php
                                                do_action('ovic_function_shop_loop_item_wishlist');
												do_action('ovic_function_shop_loop_item_compare');
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php add_action('woocommerce_before_shop_loop_item_title','ovic_woocommerce_group_flash', 10); ?>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <p>
                            <strong><?php esc_html_e( 'No Product', 'biolife' ); ?></strong>
                        </p>
                    <?php endif; ?>
                </div>
            <?php elseif($layout == 'style4'): ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <?php if ($atts['title']): ?>
                        <div class="box-title">
                            <?php echo esc_html($atts['title']); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( !empty( $taxonomy_terms ) && $atts['product_style'] == 4 && $attribute_name != '' ): ?>
                        <div class="tabs-variable">
                            <?php foreach ( $taxonomy_terms[$attribute_name] as $taxonomy_term ): ?>
                                <a href="#" class="item-attribute" data-attribute_class="<?php echo esc_attr($taxonomy_term->slug); ?>"><?php echo esc_html($taxonomy_term->name); ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( $products->have_posts() ): ?>
                        <div class="<?php echo esc_attr( implode( ' ', $product_list_class ) ); ?>" <?php echo esc_attr( $owl_settings ); ?>>
                            <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                                <?php
                                $product_item_class = apply_filters( 'ovic_class_item_shortcode_product', $product_item_class, $atts );
                                remove_action('woocommerce_before_shop_loop_item_title','ovic_woocommerce_group_flash', 10);
                                remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating', 5);
                                add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating', 15);
                                ?>
                                <div <?php post_class( $product_item_class ); ?>>
                                    <div class="product-container">
                                        <div class="product-inner">
                                            <div class="product-thumb">
                                                <?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
                                            </div>
                                            <div class="product-info">
                                                <div class="inner">
                                                    <?php do_action( 'woocommerce_shop_loop_item_title' ); ?>
                                                    <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating', 15);
                                    add_action('woocommerce_before_shop_loop_item_title','ovic_woocommerce_group_flash', 10);
                                    add_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating', 5);

                                ?>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <p>
                            <strong><?php esc_html_e( 'No Product', 'biolife' ); ?></strong>
                        </p>
                    <?php endif; ?>
                </div>
            <?php elseif($layout == 'style6'): ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <div class="box-container" style="<?php echo esc_attr($background_color); ?>">
                        <?php if ($image_thumb['url']): ?>
                            <div class="box-banner">
                                <?php echo wp_specialchars_decode($image_thumb['img']); ?>
                            </div>
                        <?php endif; ?>
                        <div class="box-content">
                            <?php
                            if ( $atts['title'] )
                                $this->ovic_title_shortcode( $atts['title'] ); ?>
                            <?php if ( $products->have_posts() ): ?>
                                <div class="<?php echo esc_attr( implode( ' ', $product_list_class ) ); ?>" <?php echo esc_attr( $owl_settings ); ?>>
                                    <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                                        <?php $product_item_class = apply_filters( 'ovic_class_item_shortcode_product', $product_item_class, $atts ); ?>
                                        <div <?php post_class( $product_item_class ); ?>>
                                            <?php do_action( 'ovic_product_template', 'style-' . $atts['product_style'] ); ?>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php else: ?>
                                <p>
                                    <strong><?php esc_html_e( 'No Product', 'biolife' ); ?></strong>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php elseif($layout == 'style8'): ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <?php if ($atts['title'] || $atts['sub_title']): ?>
                        <div class="box-title">
                            <?php if ($atts['sub_title']): ?>
                                <div class="sub-title"><?php echo esc_html($atts['sub_title']); ?></div>
                            <?php endif; ?>
                            <?php if ($atts['title']): ?>
                                <div class="title"><?php echo esc_html($atts['title']); ?></div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($link['url']): ?>
                        <a class="extent-url" href="<?php echo esc_url($link['url']) ?>" target="<?php echo esc_attr($link['target']); ?>"><?php echo esc_html($link['title']) ?></a>
                    <?php endif; ?>
                    <?php if ( !empty( $taxonomy_terms ) && $atts['product_style'] == 4 && $attribute_name != '' ): ?>
                        <div class="tabs-variable">
                            <?php foreach ( $taxonomy_terms[$attribute_name] as $taxonomy_term ): ?>
                                <a href="#" class="item-attribute" data-attribute_class="<?php echo esc_attr($taxonomy_term->slug) ?>"><?php echo esc_html($taxonomy_term->name); ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( $products->have_posts() ): ?>
                        <div class="<?php echo esc_attr( implode( ' ', $product_list_class ) ); ?>" <?php echo esc_attr( $owl_settings ); ?>>
                            <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                                <?php $product_item_class = apply_filters( 'ovic_class_item_shortcode_product', $product_item_class, $atts ); ?>
                                <div <?php post_class( $product_item_class ); ?>>
                                    <?php do_action( 'ovic_product_template', 'style-' . $atts['product_style'] ); ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <p>
                            <strong><?php esc_html_e( 'No Product', 'biolife' ); ?></strong>
                        </p>
                    <?php endif; ?>
                </div>
            <?php elseif($layout == 'style9'): ?>
                <div class="equal-container better-height <?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <?php if ($atts['title'] || $atts['sub_title'] || $atts['icon_images'] || $atts['link']): ?>
                        <div class="box-info equal-elem">
                            <?php if ($image_icon): ?>
                                <div class="image-icon">
                                    <?php echo wp_specialchars_decode($image_icon['img']); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($atts['title']): ?>
                                <div class="title"><?php echo esc_html($atts['title']); ?></div>
                            <?php endif; ?>
                            <?php if ($atts['sub_title']): ?>
                                <div class="sub-title"><?php echo esc_html($atts['sub_title']); ?></div>
                            <?php endif; ?>
                            <?php if ($link['url']): ?>
                                <a class="extent-url" href="<?php echo esc_url($link['url']) ?>" target="<?php echo esc_attr($link['target']); ?>"><?php echo esc_html($link['title']) ?></a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( !empty( $taxonomy_terms ) && $atts['product_style'] == 4 && $attribute_name != '' ): ?>
                        <div class="tabs-variable">
                            <?php foreach ( $taxonomy_terms[$attribute_name] as $taxonomy_term ): ?>
                                <a href="#" class="item-attribute" data-attribute_class="<?php echo esc_attr($taxonomy_term->slug) ?>"><?php echo esc_html($taxonomy_term->name); ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( $products->have_posts() ): ?>
                        <div class="equal-elem <?php echo esc_attr( implode( ' ', $product_list_class ) ); ?>" <?php echo esc_attr( $owl_settings ); ?>>
                            <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                                <?php $product_item_class = apply_filters( 'ovic_class_item_shortcode_product', $product_item_class, $atts ); ?>
                                <div <?php post_class( $product_item_class ); ?>>
                                    <?php do_action( 'ovic_product_template', 'style-' . $atts['product_style'] ); ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <p>
                            <strong><?php esc_html_e( 'No Product', 'biolife' ); ?></strong>
                        </p>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <?php
                    if ( $atts['title'] )
                        $this->ovic_title_shortcode( $atts['title'] ); ?>
                    <?php if ( !empty( $taxonomy_terms ) && $atts['product_style'] == 4 && $attribute_name != '' ): ?>
                        <div class="tabs-variable">
                            <?php foreach ( $taxonomy_terms[$attribute_name] as $taxonomy_term ): ?>
                                <a href="#" class="item-attribute" data-attribute_class="<?php echo esc_attr($taxonomy_term->slug) ?>"><?php echo esc_html($taxonomy_term->name); ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( $products->have_posts() ): ?>
                        <div class="<?php echo esc_attr( implode( ' ', $product_list_class ) ); ?>" <?php echo esc_attr( $owl_settings ); ?>>
                            <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                                <?php $product_item_class = apply_filters( 'ovic_class_item_shortcode_product', $product_item_class, $atts ); ?>
                                <div <?php post_class( $product_item_class ); ?>>
                                    <?php do_action( 'ovic_product_template', 'style-' . $atts['product_style'] ); ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php else: ?>
                        <p>
                            <strong><?php esc_html_e( 'No Product', 'biolife' ); ?></strong>
                        </p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

			<?php
			remove_all_filters( 'ovic_shop_product_thumb_width' );
			remove_all_filters( 'ovic_shop_product_thumb_height' );
			$array_filter = array(
				'item_class'    => $product_item_class,
				'contain_class' => $product_list_class,
				'carousel'      => $owl_settings,
				'query'         => $products,
			);
			wp_reset_postdata();
			return apply_filters( 'Ovic_Shortcode_Products', ob_get_clean(), $atts, $content, $array_filter );
		}
	}

	new Ovic_Shortcode_Products();
}