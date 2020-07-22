<?php
if ( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Ovic_Slide"
 */
if ( !class_exists( 'Ovic_Shortcode_Slide' ) ) {
	class Ovic_Shortcode_Slide extends Ovic_Shortcode
	{
		/**
		 * Shortcode name.
		 *
		 * @var  string
		 */
		public $shortcode = 'slide';

		static public function add_css_generate( $atts )
		{
			$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'ovic_slide', $atts ) : $atts;
			// Extract shortcode parameters.
			extract( $atts );
			$css = '';

			return apply_filters( 'Ovic_Shortcode_Slide_css', $css, $atts );
		}

		public function output_html( $atts, $content = null )
		{
			$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'ovic_slide', $atts ) : $atts;
            $css_animation = $style = '';
			extract( $atts );
			$css_class    = array( 'ovic-slide', $style, biolife_getCSSAnimation( $css_animation ) );
			$css_class[]  = $atts['el_class'];
			if($style){
			    $shortcode_class = 'ovic-slide-'.$style;
            }
			$css_class[]  = $atts['owl_rows_space'];
			$class_editor = isset( $atts['css'] ) ? vc_shortcode_custom_css_class( $atts['css'], ' ' ) : '';
			$css_class[]  = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'ovic_slide', $atts );
			/* START */
			$class_slide  = array( 'owl-slick' );
			$owl_settings = apply_filters( 'ovic_carousel_data_attributes', 'owl_', $atts );
			if ( $atts['owl_navigation_style'] )
				$class_slide[] = $atts['owl_navigation_style'];
			ob_start(); ?>
            <?php if ($style == 'style1'): ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <div class="<?php echo esc_attr($shortcode_class) ?>">
                        <div class="title-container">
                            <?php if ($atts['before_title']): ?>
                                <div class="before_title"><?php echo esc_html($atts['before_title'])?></div>
                            <?php endif; ?>

                            <?php if ($atts['slider_title']): ?>
                                <div class="slider_title"><?php echo esc_html($atts['slider_title'])?></div>
                            <?php endif; ?>

                            <?php if ($atts['after_title']): ?>
                                <div class="after_title"><?php echo esc_html($atts['after_title'])?></div>
                            <?php endif; ?>
                        </div>
                        <div class="<?php echo esc_attr( implode( ' ', $class_slide ) ); ?>" <?php echo esc_attr( $owl_settings ); ?>>
                            <?php echo wpb_js_remove_wpautop( $content ); ?>
                        </div>
                    </div>
                </div>
            <?php elseif ($style == 'style4'): ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <div class="title-container">
                        <?php if ($atts['slider_title_1']): ?>
                            <div class="title"><?php echo wp_specialchars_decode($atts['slider_title_1'])?></div>
                        <?php endif; ?>
                    </div>
                    <div class="<?php echo esc_attr( implode( ' ', $class_slide ) ); ?>" <?php echo esc_attr( $owl_settings ); ?>>
                        <?php echo wpb_js_remove_wpautop( $content ); ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <?php
                    if ( $atts['slider_title'] )
                        $this->ovic_title_shortcode( $atts['slider_title'] );
                    ?>
                    <div class="<?php echo esc_attr( implode( ' ', $class_slide ) ); ?>" <?php echo esc_attr( $owl_settings ); ?>>
                        <?php echo wpb_js_remove_wpautop( $content ); ?>
                    </div>
                </div>
            <?php endif; ?>

			<?php
			return apply_filters( 'Ovic_Shortcode_Slide', ob_get_clean(), $atts, $content );
		}
	}

	new Ovic_Shortcode_Slide();
}