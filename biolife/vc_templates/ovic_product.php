<?php
if ( !class_exists( 'Ovic_Shortcode_Product' ) ) {
	class Ovic_Shortcode_Product extends Ovic_Shortcode
	{
		/**
		 * Shortcode name.
		 *
		 * @var  string
		 */
		public $shortcode = 'product';


		public function output_html( $atts, $content = null )
		{
		    global $product;
			$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'ovic_product', $atts ) : $atts;
			// Extract shortcode parameters.
            $link = $intro = $sub_title = $title = $attributes = $ids = $banner_effect = $layout = $background_color = $image = '';
			extract( $atts );
            if($ids && class_exists('WooCommerce')){
                $product = wc_get_product($ids);
            }else{
                return '';
            }
            if(!$product)
                return '';
			$css_class        = array( 'ovic-product product-item product', $layout, $banner_effect );
			$css_class[]      = $atts['el_class'];
			$class_editor     = isset( $atts['css'] ) ? vc_shortcode_custom_css_class( $atts['css'], ' ' ) : '';
            if ($background_color){
                $background_color = "background-color: ".$background_color;
            }
            if($image){
                $image = apply_filters( 'ovic_resize_image', $image, false, false, true, true );
            }else{
                $image = array('url'=>'', 'width'=>0, 'height'=>0, 'img'=>'');
            }
            if ($link) {
                $link = vc_build_link($atts['link']);
            } else {
                $link = array('title' => '', 'url' => '', 'target' => '_self');
            }
            if (!$link['url'])
                $link['url'] = $product->get_permalink();
            if (!$title)
                $title = $product->get_name();
			ob_start();
			if ( $layout == 'style1' ) : ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <div class="shortcode-context <?php echo esc_attr(apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'ovic_product', $atts )); ?>">
                        <?php if ($image['url']): ?>
                            <div class="banner">
                                <?php echo wp_specialchars_decode( $image['img'] ); ?>
                            </div>
                        <?php endif; ?>
                        <div class="texts">
                            <h2 class="title"><a href="<?php echo esc_url($link['url']); ?>"><?php echo  esc_html($title); ?></a></h2>
                            <?php if ($sub_title): ?>
                                <div class="sub_title"><?php echo wp_specialchars_decode($sub_title); ?></div>
                            <?php endif; ?>
                            <?php if (isset($atts['countdown_date']) && $atts['countdown_date']):  ?>
                                <div class="countdown-container">
                                    <div class="biolife-countdown" data-datetime="6/25/2020 01:04:33" data-txt_day="Days" data-txt_hour="Hrs" data-txt_min="Mins" data-txt_sec="Secs" data-value_first="1"><div class="countdown-item item-day"><span class="item-value">245</span><span class="item-label">Days</span></div><div class="countdown-item item-hour"><span class="item-value">15</span><span class="item-label">Hrs</span></div><div class="countdown-item item-min"><span class="item-value">53</span><span class="item-label">Mins</span></div><div class="countdown-item item-sec"><span class="item-value">20</span><span class="item-label">Secs</span></div></div>
                                </div>
                                <!--<div class="countdown-container">
                                    <div class="biolife-countdown" data-datetime="<?php /*echo esc_attr($atts['countdown_date']); */?>" data-txt_day="<?php /*echo esc_attr__('Days', 'biolife') */?>" data-txt_hour="<?php /*echo esc_attr__('Hrs', 'biolife') */?>" data-txt_min="<?php /*echo esc_attr__('Mins', 'biolife') */?>" data-txt_sec="<?php /*echo esc_attr__('Secs', 'biolife') */?>" data-value_first="1"></div>
                                </div>-->
                            <?php endif; ?>
                            <div class="url-container clearfix">
                                <?php woocommerce_template_loop_add_to_cart(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <?php $css_class[]      = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'ovic_product', $atts ); ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>" style="<?php echo esc_attr($background_color); ?>">
                    <?php if ($image['url']): ?>
                        <div class="banner">
                            <?php echo wp_specialchars_decode( $image['img'] ); ?>
                        </div>
                    <?php endif; ?>
                    <div class="content">
                        <h2 class="product-name">
                            <a href="<?php echo esc_url($product->get_permalink()); ?>">
                                <?php
                                if ($title){
                                    echo  esc_html($title);
                                }else{
                                    echo  esc_html($product->get_name());
                                }
                                ?>
                                <?php if ($sub_title): ?>
                                    <span class="sub-title"><?php echo esc_html($sub_title) ?></span>
                                <?php endif; ?>
                            </a>
                        </h2>
                        <?php if ($intro): ?>
                            <div class="intro"><?php echo wp_specialchars_decode($intro); ?></div>
                        <?php endif; ?>
                        <?php if ($attributes): ?>
                            <div class="display-attributes row auto-clear">
                                <?php $attributes = explode(',', $attributes); ?>
                                <?php foreach ($attributes as $attribute_slug): ?>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="attribute-name"><?php echo wc_attribute_label('pa_'.$attribute_slug); ?></div>
                                        <div class="attribute-values"><?php echo esc_html($product->get_attribute( $attribute_slug )); ?></div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <div class="url-container clearfix">
                            <?php woocommerce_template_loop_add_to_cart(); ?>
                            <?php if ($link['url']): ?>
                                <a class="extent-url" href="<?php echo esc_url($link['url']) ?>" target="<?php echo esc_attr($link['target']); ?>"><?php echo esc_html($link['title']) ?></a>
                            <?php  else: ?>
                                <a class="extent-url" href="<?php echo esc_url($product->get_permalink()); ?>"><?php echo esc_html__('Shop Now', 'biolife'); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
			<?php endif;
			return apply_filters( 'Ovic_Shortcode_Product', ob_get_clean(), $atts, $content );
		}
	}

	new Ovic_Shortcode_Product();
}

