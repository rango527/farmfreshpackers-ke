<?php
if ( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Ovic_Shortcode_Custommenu"
 * @version 1.0.0
 */
if ( !class_exists( 'Ovic_Shortcode_Custommenu' ) ) {
	class Ovic_Shortcode_Custommenu extends Ovic_Shortcode
	{
		/**
		 * Shortcode name.
		 *
		 * @var  string
		 */
		public $shortcode = 'custommenu';

		static public function add_css_generate( $atts )
		{
			$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'ovic_custommenu', $atts ) : $atts;
			// Extract shortcode parameters.
			extract( $atts );
			$css = '';

			return apply_filters( 'Ovic_Shortcode_Custommenu_css', $css, $atts );
		}

		public function output_html( $atts, $content = null )
		{
			$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'ovic_custommenu', $atts ) : $atts;
            $css_animation = $link = '';
			// Extract shortcode parameters.
			extract( $atts );
			$css_class    = array( 'ovic-custommenu vc_wp_custommenu wpb_content_element', biolife_getCSSAnimation( $css_animation ) );
			$css_class[]  = $atts['el_class'];
            $css_class[]  = $atts['style_menu'];
            $class_editor = isset( $atts['css'] ) ? vc_shortcode_custom_css_class( $atts['css'], ' ' ) : '';
            if ($atts['style_menu'] == 'style13') {
            	$css_class[] = 'style07';
            }
            if($link){
                $link = vc_build_link( $atts['link'] );
            }else{
                $link = array('title'  => '', 'url'    => '', 'target' => '_self');
            }
			ob_start();
			$type = 'WP_Nav_Menu_Widget';
			$args = array();
			global $wp_widget_factory;
			?>
            <?php if ($atts['style_menu'] == 'style08'): ?>
            <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                <div class="shortcode-context <?php echo apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'ovic_custommenu', $atts ); ?>">
                    <?php
                    if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[$type] ) ) {
                        the_widget( $type, $atts, $args );
                    } else {
                        echo esc_html__( 'No content.', 'biolife' );
                    }
                    ?>
                </div>
            </div>
            <?php elseif ($atts['style_menu'] == 'style09') : ?>
				<div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
	                <?php
	                if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[$type] ) ) {
	                    the_widget( $type, $atts, $args );
	                } else {
	                    echo esc_html__( 'No content.', 'biolife' );
	                }
	                ?>
	                <?php if ($link['url']): ?>
                        <a class="link-text" href="<?php echo esc_url($link['url']) ?>" <?php if ($link['target']): ?> target="<?php echo esc_attr( $link['target'] ); ?>" <?php endif; ?>><?php echo esc_html($link['title']); ?></a>
                    <?php endif; ?>
	            </div>
            <?php else: ?>
            <?php $css_class[]  = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'ovic_custommenu', $atts ); ?>
            <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                <?php
                if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[$type] ) ) {
                    the_widget( $type, $atts, $args );
                } else {
                    echo esc_html__( 'No content.', 'biolife' );
                }
                ?>
            </div>
            <?php endif; ?>

			<?php
			$html = ob_get_clean();

			return apply_filters( 'Ovic_Shortcode_Custommenu', $html, $atts, $content );
		}
	}

	new Ovic_Shortcode_Custommenu();
}