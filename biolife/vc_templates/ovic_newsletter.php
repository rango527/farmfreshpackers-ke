<?php
if ( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Ovic_Newsletter"
 */
if ( !class_exists( 'Ovic_Shortcode_Newsletter' ) ) {
	class Ovic_Shortcode_Newsletter extends Ovic_Shortcode
	{
		/**
		 * Shortcode name.
		 *
		 * @var  string
		 */
		public $shortcode = 'newsletter';

		public function output_html( $atts, $content = null )
		{
			$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'ovic_newsletter', $atts ) : $atts;
            $css_animation = '';
			extract( $atts );
			$css_class    = array( 'widget-ovic-mailchimp', biolife_getCSSAnimation( $css_animation ) );
			$css_class[]  = $atts['el_class'];
			$css_class[]  = $atts['style'];
			$class_editor = isset( $atts['css'] ) ? vc_shortcode_custom_css_class( $atts['css'], ' ' ) : '';
			$css_class[]  = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'ovic_newsletter', $atts );
			$shortcode    = '';
			$default      = array(
				'title'       => $atts['title'],
				'images'       => $atts['images'],
				'subtitle'    => $atts['subtitle'],
				'show_list'   => $atts['show_list'],
				'field_name'  => $atts['field_name'],
				'fname_text'  => $atts['fname_text'],
				'lname_text'  => $atts['lname_text'],
				'placeholder' => $atts['placeholder'],
				'button_text' => $atts['button_text'],
			);
			foreach ( $default as $key => $value ) {
				$shortcode .= ' ' . $key . '="' . $value . '" ';
			}
			if (isset($atts['style']) && $atts['style'] == 'style4'){
                add_filter('ovic_output_mailchimp_form', array($this, 'output_mailchimp_form'), 11, 4);
            }
			if ($atts['style'] == 'style6'){
                //$css_class[] = 'style5';
            }

			ob_start(); ?>
			<div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
				<?php if ( $atts['images'] ) : ?>
					<?php $image_thumb = apply_filters( 'ovic_resize_image', $atts['images'], false, false, true, true ); ?>
                    <div class="img-newsletter">
						<?php echo wp_specialchars_decode( $image_thumb['img'] ); ?>
                    </div>
				<?php endif; ?>
                <div class="info">
                    <?php if ( $atts['title'] ): ?>
                        <h3 class="title"><?php echo wp_specialchars_decode( $atts['title'] ); ?></h3>
                    <?php endif; ?>
                    <?php if ( $atts['title_text'] ): ?>
                        <h3 class="title"><?php echo wp_specialchars_decode( $atts['title_text'] ); ?></h3>
                    <?php endif; ?>
                    <?php if ( $atts['subtitle'] ): ?>
                        <div class="subtitle"><?php echo wp_specialchars_decode( $atts['subtitle'] ); ?></div>
                    <?php endif; ?>
                    <?php if ( $atts['desc'] ): ?>
                        <div class="desc"><?php echo wp_specialchars_decode( $atts['desc'] ); ?></div>
                    <?php endif; ?>
                </div>
				<?php echo do_shortcode( '[ovic_mailchimp' . $shortcode . ']' ); ?>
			</div>
			<?php
			return apply_filters( 'Ovic_Shortcode_Newsletter', ob_get_clean(), $atts, $content );
		}
        public function output_mailchimp_form($html, $atts, $list_id, $options){
            $list_selected = isset( $options['email_lists'] ) ? $options['email_lists'] : '';
            $class         = array( 'newsletter-form-wrap' );
            if ( $atts['show_list'] == 'yes' ) {
                $class[] = 'has-list-field';
            }
            if ( $atts['field_name'] == 'yes' ) {
                $class[] = 'has-name-field';
            }
            ?>
            <div class="<?php echo esc_attr( implode( ' ', $class ) ); ?>">
                <form class="newsletter-form-wrap">
                    <?php if ( $atts['show_list'] == 'yes' && !empty( $list_id ) ): ?>
                        <div class="list">
                            <?php foreach ( $list_id as $key => $value ): ?>
                                <label for="<?php echo esc_attr( $key ); ?>">
                                    <input <?php if ( $list_selected == $key ): ?> checked="checked"<?php endif; ?>
                                            id="<?php echo esc_attr( $key ); ?>" name="list_id"
                                            value="<?php echo esc_attr( $key ); ?>" type="radio">
                                    <span class="text"><?php echo esc_html( $value ); ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( $atts['field_name'] == 'yes' ): ?>
                        <label class="text-field field-fname">
                            <input class="input-text fname" type="text" name="fname"
                                   placeholder="<?php echo esc_attr( $atts['fname_text'] ); ?>">
                        </label>
                        <label class="text-field field-lname">
                            <input class="input-text lname" type="text" name="lname"
                                   placeholder="<?php echo esc_attr( $atts['lname_text'] ); ?>">
                        </label>
                    <?php endif; ?>
                    <div class="submit-newsletter-container">
                        <a href="#" class="button btn-submit submit-newsletter">
                            <i class="newsletter-icon fa fa-envelope"></i>
                            <span class="text">
                            <?php echo esc_html( $atts['button_text'] ); ?>
                        </span>
                        </a>
                        <input class="input-text email email-newsletter" type="email" name="email" placeholder="<?php echo esc_attr( $atts['placeholder'] ); ?>">
                    </div>
                </form>
            </div>
            <?php
        }
	}

	new Ovic_Shortcode_Newsletter();
}