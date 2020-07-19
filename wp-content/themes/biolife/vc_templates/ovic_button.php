<?php
if ( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Ovic_Button"
 * @version 1.0.0
 */
if ( !class_exists( 'Ovic_Shortcode_Button' ) ) {
	class Ovic_Shortcode_Button extends Ovic_Shortcode
	{
		/**
		 * Shortcode name.
		 *
		 * @var  string
		 */
		public $shortcode = 'button';

		static public function add_css_generate( $atts )
		{
			$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'ovic_button', $atts ) : $atts;
			// Extract shortcode parameters.
			extract( $atts );
			$css = '';

			return apply_filters( 'Ovic_Shortcode_Button_css', $css, $atts );
		}

		public function output_html( $atts, $content = null )
		{
			$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'ovic_button', $atts ) : $atts;
            $style = '';
			extract( $atts );
			$css_class   = array( 'ovic-button', biolife_getCSSAnimation( $css_animation ) );
			$css_class[] = isset( $atts['style'] ) ? $atts['style'] : '';
			$css_class[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, '', 'ovic_button', $atts );
			$sections    = self::get_all_attributes( 'vc_tta_section', $content );
			if($link){
                $link = vc_build_link( $atts['link'] );
            }else{
                $link = array('title'  => '', 'url'    => '', 'target' => '_self');
            }
			ob_start(); ?>
            <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                <?php if ( $link['title'] ) : ?>
                    <a href="<?php echo esc_url( $link['url'] ); ?>"
                        <?php if ($link['target']): ?> target="<?php echo esc_attr( $link['target'] ); ?>" <?php endif; ?>>
                        <?php echo esc_html( $link['title'] ); ?>
                    </a>
                <?php endif; ?>
            </div>
			<?php
			$html = ob_get_clean();

			return apply_filters( 'Ovic_Shortcode_Button', $html, $atts, $content );
		}
	}

	new Ovic_Shortcode_Button();
}