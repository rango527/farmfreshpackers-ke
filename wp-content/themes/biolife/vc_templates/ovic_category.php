<?php
if ( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Ovic_Category"
 * @version 1.0.0
 */
if ( !class_exists( 'Ovic_Shortcode_Category' ) ) {
	class Ovic_Shortcode_Category extends Ovic_Shortcode
	{
		/**
		 * Shortcode name.
		 *
		 * @var  string
		 */
		public $shortcode = 'category';

		static public function add_css_generate( $atts )
		{
			$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'ovic_category', $atts ) : $atts;
			// Extract shortcode parameters.
			extract( $atts );
			$css = $style = $text_position = '';

			return apply_filters( 'Ovic_Shortcode_Category_css', $css, $atts );
		}

		public function output_html( $atts, $content = null )
		{
			$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'ovic_category', $atts ) : $atts;
            $style = '';
			extract( $atts );
			$css_class   = array( 'ovic-category', $text_position, biolife_getCSSAnimation( $css_animation ) );
			$css_class[] = isset( $atts['style'] ) ? $atts['style'] : '';
			$css_class[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, '', 'ovic_category', $atts );
			ob_start(); ?>
			<?php if ($style == 'style1'): ?>
            <?php 
            if ($atts['taxonomy']) :
			    $term = get_term_by('slug', $atts['taxonomy'], 'product_cat');
			    if (!is_wp_error($term) && !empty($term)) :
			        $url = get_term_link($term->term_id, 'product_cat');
			        ?>
			        <div class="<?php echo esc_attr(implode(' ', $css_class)); ?>">
			            <div class="category-inner <?php if ($atts['background']) echo esc_attr('has-bg'); ?>">
			                <?php if ($atts['background']) : ?>
			                    <div class="thumb">
			                        <figure><?php echo wp_get_attachment_image($atts['background'], 'full'); ?></figure>
			                    </div>
			                <?php endif; ?>
			                <div class="content">
			                    <a href="<?php echo esc_url($url); ?>" class="button">
			                        <?php echo esc_html($term->name); ?>
			                    </a>
			                </div>
			            </div>
			        </div>
			    <?php endif;
			endif;?>
			<?php elseif ($style == 'style2'): ?>
				<?php
				if ( $atts['taxonomy'] ) :
					$term = get_term_by( 'slug', $atts['taxonomy'], 'product_cat' );
					if ( !is_wp_error( $term ) && !empty( $term ) ) :
						$url = get_term_link( $term->term_id, 'product_cat' );
					    $css_bg = '';
				        if ( $atts['color'] && $atts['color'] != '' ){
				            $css_bg = 'background-color: ' . $atts['color'] . ';';
				        }
						?>
				        <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
				            <div class="category-inner <?php if ( $atts['background'] ) echo esc_attr( 'has-bg' ); ?>" style="<?php echo esc_attr( $css_bg ); ?>">
								<?php if ( $atts['background'] ) : ?>
				                    <div class="thumb">
				                        <figure><?php echo wp_get_attachment_image( $atts['background'], 'full' ); ?></figure>
				                    </div>
								<?php endif; ?>
				                <div class="content">
									<h3 class="title"><?php echo esc_html( $term->name ); ?></h3>
				                    <div>
				                        <a href="<?php echo esc_url( $url ); ?>" class="button">
				                            <?php echo esc_html__( 'VIEW NOW', 'biolife' ); ?>
				                        </a>
				                    </div>
				                </div>
				            </div>
				        </div>
					<?php endif;
				endif;?>
			<?php endif; ?>
			<?php
			$html = ob_get_clean();

			return apply_filters( 'Ovic_Shortcode_Category', $html, $atts, $content );
		}
	}

	new Ovic_Shortcode_Category();
}