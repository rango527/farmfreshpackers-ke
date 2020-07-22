<?php
if ( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Ovic_Person"
 */
if ( !class_exists( 'Ovic_Shortcode_Person' ) ) {
	class Ovic_Shortcode_Person extends Ovic_Shortcode
	{
		/**
		 * Shortcode name.
		 *
		 * @var  string
		 */
		public $shortcode = 'person';

		static public function add_css_generate( $atts )
		{
			$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'ovic_person', $atts ) : $atts;
			// Extract shortcode parameters.
			extract( $atts );
			$css = '';

			return apply_filters( 'Ovic_Shortcode_Person_css', $css, $atts );
		}

		public function output_html( $atts, $content = null )
		{
			$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'ovic_person', $atts ) : $atts;
            $css_animation = $layout = '';
			extract( $atts );
			$css_class    = array( 'ovic-person', $layout , biolife_getCSSAnimation( $css_animation ) );
			$css_class[]  = $atts['el_class'];
			$class_editor = isset( $atts['css'] ) ? vc_shortcode_custom_css_class( $atts['css'], ' ' ) : '';
			$css_class[]  = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'ovic_person', $atts );
			$person_link  = vc_build_link( $atts['link'] );
			if ( $person_link['url'] ) {
				$link_url    = $person_link['url'];
				$link_target = $person_link['target'];
			} else {
				$link_target = '_blank';
				$link_url    = '#';
			}
			ob_start(); ?>
            <?php if ($layout == 'style1'): ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <div class="inner">
                        <?php if ( $atts['avatar'] ) : ?>
                            <div class="avatar">
                                <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                    <?php
                                    $thumb_avatar = apply_filters( 'ovic_resize_image', $atts['avatar'], false, false, true, true );
                                    echo wp_specialchars_decode( $thumb_avatar['img'] );
                                    ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="content-person">
                            <?php if ( $atts['name'] ) : ?>
                                <h3 class="name">
                                    <a href="<?php echo esc_url( $link_url ); ?>"
                                       target="<?php echo esc_attr( $link_target ); ?>">
                                        <?php echo esc_html( $atts['name'] ); ?>
                                    </a>
                                </h3>
                            <?php endif; ?>
                            <?php if ( $atts['positions'] ) : ?>
                                <div class="person-positions"><?php echo esc_html( $atts['positions'] ); ?></div>
                            <?php endif; ?>
                            <?php if ( $atts['desc'] ) : ?>
                                <div class="person-desc"><?php echo wp_specialchars_decode( $atts['desc'] ); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php elseif ($layout == 'style2'): ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <div class="inner">
                        <div class="content-person">
                            <?php if ( $atts['name'] ) : ?>
                                <h3 class="name">
                                    <a href="<?php echo esc_url( $link_url ); ?>"
                                       target="<?php echo esc_attr( $link_target ); ?>">
                                        <?php echo esc_html( $atts['name'] ); ?>
                                    </a>
                                </h3>
                            <?php endif; ?>
                            <?php if ( $atts['positions'] ) : ?>
                                <div class="person-positions"><?php echo esc_html( $atts['positions'] ); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <?php if ( $atts['avatar'] ) : ?>
                        <div class="thumb-avatar">
                            <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>">
                                <?php
                                $thumb_avatar = apply_filters( 'ovic_resize_image', $atts['avatar'], false, false, true, true );
                                echo wp_specialchars_decode( $thumb_avatar['img'] );
                                ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="content-person">
                        <?php if ( $atts['desc'] ) : ?>
                            <p class="desc"><?php echo wp_specialchars_decode( $atts['desc'] ); ?></p>
                        <?php endif; ?>
                        <?php if ( $atts['name'] ) : ?>
                            <h3 class="name">
                                <a href="<?php echo esc_url( $link_url ); ?>"
                                   target="<?php echo esc_attr( $link_target ); ?>">
                                    <?php echo esc_html( $atts['name'] ); ?>
                                </a>
                            </h3>
                        <?php endif; ?>
                        <?php if ( $atts['positions'] ) : ?>
                            <p class="positions"><?php echo esc_html( $atts['positions'] ); ?></p>
                        <?php endif; ?>
                        <div class="star-rating" style="width=100%;"><span></span></div>
                    </div>
                </div>
            <?php endif; ?>

			<?php
			return apply_filters( 'Ovic_Shortcode_Person', ob_get_clean(), $atts, $content );
		}
	}

	new Ovic_Shortcode_Person();
}