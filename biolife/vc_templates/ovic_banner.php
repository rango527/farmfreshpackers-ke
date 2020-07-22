<?php
if ( ! class_exists( 'Ovic_Shortcode_Banner' ) ) {
	class Ovic_Shortcode_Banner extends Ovic_Shortcode
	{
		/**
		 * Shortcode name.
		 *
		 * @var  string
		 */
		public $shortcode = 'banner';


		public function output_html( $atts, $content = null )
		{
			$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'ovic_banner', $atts ) : $atts;
			// Extract shortcode parameters.
			$css_animation = $texts_style = $text_1 = $text_2 = $text_3 = $text_4 = $text_5 = $text_6 = $layout = $link = $background_color_banner = '';
			extract( $atts );
			$css_class   = array( 'ovic-banner', $texts_style, biolife_getCSSAnimation( $css_animation ) );
			$css_class[] = $atts['layout'];
			if ( $layout == 'style4' || $layout == 'style6' ) {
				$css_class[] = 'style5';
			}
			if ( $layout == 'style21' ) {
				$css_class[] = 'style20';
			}
			$css_class[]  = isset( $atts['banner-effect'] ) ? $atts['banner-effect'] : '';
			$css_class[]  = $atts['el_class'];
			$class_editor = isset( $atts['css'] ) ? vc_shortcode_custom_css_class( $atts['css'], ' ' ) : '';
			if ( $link ) {
				$link = vc_build_link( $atts['link'] );
			} else {
				$link = array( 'title' => '', 'url' => '', 'target' => '_self' );
			}
			$link['url'] = apply_filters( 'ovic_shortcode_vc_link', $link['url'] );

			if ( isset( $atts['image_background'] ) && $atts['image_background'] ) {
				$image_thumb = apply_filters( 'ovic_resize_image', $atts['image_background'], false, false, true, true );
			} else {
				$image_thumb = array( 'url' => '', 'width' => 0, 'height' => 0, 'img' => '' );
			}
			$css = '';
            if ( $atts['image_background'] ) {
                $css = ' style=background-image:url(' . wp_get_attachment_image_url( $atts['image_background'], 'full' ) . ') ';
            }
			$border_color = '';
			if ( $background_color_banner ) {
				$border_color            = "border-color: " . $background_color_banner . ';';
				$background_color_banner = "background-color: " . $background_color_banner . ';';
			}
			$text_2_style = '';
			if ( ! empty( $atts['text_2_color'] ) ) {
				$text_2_style .= "color:{$atts['text_2_color']};";
			}
			ob_start();
			if ( $atts['layout'] == 'style1' ) : ?>
				<?php $css_class[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'ovic_banner', $atts ); ?>
                <div class="banner-effect <?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
					<?php if ( $atts['image_background'] ) : ?>
                        <div class="banner-img">
							<?php if ( $link['url'] ): ?>
                                <a class="banner-img-link" href="<?php echo esc_url( $link['url'] ) ?>">
									<?php echo wp_specialchars_decode( $image_thumb['img'] ); ?>
                                </a>
							<?php else: ?>
								<?php echo wp_specialchars_decode( $image_thumb['img'] ); ?>
							<?php endif; ?>
                        </div>
					<?php endif; ?>
                    <div class="banner-content"
                         style="<?php echo esc_attr( $background_color_banner . $border_color ) ?>">
                        <div class="arrow"></div>
						<?php if ( $text_1 ): ?>
                            <div class="text-1"><?php echo esc_html( $text_1 ) ?> </div>
						<?php endif; ?>
						<?php if ( $text_2 ): ?>
                            <div class="text-2"><?php echo wp_specialchars_decode( $text_2 ) ?> </div>
						<?php endif; ?>
						<?php if ( $text_3 ): ?>
                            <div class="text-3"><?php echo esc_html( $text_3 ) ?> </div>
						<?php endif; ?>
						<?php if ( $text_4 ): ?>
                            <div class="text-4-container">
                                <span class="text-4"><?php echo esc_html( $text_4 ) ?> </span>
                                <span class="text-5"><?php echo esc_html( $text_5 ) ?> </span>
                                <span class="text-6"><?php echo esc_html( $text_6 ) ?> </span>
                            </div>
						<?php endif; ?>
						<?php if ( $link['url'] ): ?>
                            <a class="banner-link"
                               href="<?php echo esc_url( $link['url'] ) ?>"><?php echo esc_html( $link['title'] ) ?>
                            </a>
						<?php endif; ?>
                    </div>
                </div>
			<?php elseif ( $atts['layout'] == 'style2' ) : ?>
				<?php $css_class[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'ovic_banner', $atts ); ?>
                <div class="banner-effect style1 <?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
					<?php if ( $atts['image_background'] ) : ?>
                        <div class="banner-img">
							<?php if ( $link['url'] ): ?>
                                <a class="banner-img-link" href="<?php echo esc_url( $link['url'] ) ?>">
									<?php echo wp_specialchars_decode( $image_thumb['img'] ); ?>
                                </a>
							<?php else: ?>
								<?php echo wp_specialchars_decode( $image_thumb['img'] ); ?>
							<?php endif; ?>
                        </div>
					<?php endif; ?>
                    <div class="banner-content"
                         style="<?php echo esc_attr( $background_color_banner . $border_color ) ?>">
                        <div class="arrow"></div>
						<?php if ( $text_1 ): ?>
                            <div class="text-1"><?php echo esc_html( $text_1 ) ?> </div>
						<?php endif; ?>
						<?php if ( $text_2 ): ?>
                            <div class="text-2"><?php echo wp_specialchars_decode( $text_2 ) ?> </div>
						<?php endif; ?>
						<?php if ( $text_3 ): ?>
                            <div class="text-3"><?php echo esc_html( $text_3 ) ?> </div>
						<?php endif; ?>
						<?php if ( $text_4 ): ?>
                            <div class="text-4"><?php echo esc_html( $text_4 ) ?></div>
						<?php endif; ?>
						<?php if ( $link['url'] ): ?>
                            <a class="banner-link"
                               href="<?php echo esc_url( $link['url'] ) ?>"><?php echo esc_html( $link['title'] ) ?>
                            </a>
						<?php endif; ?>
                    </div>
                </div>
			<?php elseif ( $atts['layout'] == 'style3' ) : ?>
				<?php $css_class[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'ovic_banner', $atts ); ?>
				<?php if ( $image_thumb['url'] ): ?>
                    <div class=" <?php echo esc_attr( implode( ' ', $css_class ) ); ?>"
                         style="background-image: url('<?php echo esc_url( $image_thumb['url'] ); ?>')">
						<?php if ( $link['url'] ): ?>
                            <a class="box-image"
                               href="<?php echo esc_url( $link['url'] ) ?>"><?php echo wp_specialchars_decode( $image_thumb['img'] ); ?></a>
                            <div class="link-container">
                                <a class="box-link"
                                   href="<?php echo esc_url( $link['url'] ) ?>"><?php echo esc_html( $link['title'] ) ?></a>
                            </div>
						<?php else: ?>
							<?php echo wp_specialchars_decode( $image_thumb['img'] ); ?>
						<?php endif; ?>
                    </div>
				<?php endif; ?>
			<?php elseif ( $atts['layout'] == 'style11' ) : ?>
				<?php $css_class[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'ovic_banner', $atts ); ?>
				<?php
				if ( isset( $atts['link_image_background'] ) && $atts['link_image_background'] ) {
					$link_image_background = apply_filters( 'ovic_resize_image', $atts['link_image_background'], false, false, true, true );
				} else {
					$link_image_background = array( 'url' => '', 'width' => 0, 'height' => 0, 'img' => '' );
				}
				?>
				<?php if ( $image_thumb['url'] ): ?>
                    <div class="effect effect16 <?php echo esc_attr( implode( ' ', $css_class ) ); ?>"
                         style="background-image: url('<?php echo esc_url( $image_thumb['url'] ); ?>')">
						<?php if ( $link['url'] ): ?>
                            <a class="box-image"
                               href="<?php echo esc_url( $link['url'] ) ?>"><?php echo wp_specialchars_decode( $image_thumb['img'] ); ?></a>
                            <div class="link-container">
                                <a class="box-link"
                                   style="<?php if ( $link_image_background['url'] ): ?> background-image: url('<?php echo esc_url($link_image_background['url']) ?>') <?php endif; ?>"
                                   href="<?php echo esc_url( $link['url'] ) ?>"><?php echo esc_html( $link['title'] ) ?></a>
                            </div>
						<?php else: ?>
							<?php echo wp_specialchars_decode( $image_thumb['img'] ); ?>
						<?php endif; ?>
                    </div>
				<?php endif; ?>
			<?php elseif ( $atts['layout'] == 'style4' || $atts['layout'] == 'style5' || $atts['layout'] == 'style6' || $atts['layout'] == 'style13' ) : ?>
				<?php $css_class[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'ovic_banner', $atts ); ?>
                <div class="effect effect16 <?php echo esc_attr( implode( ' ', $css_class ) ); ?>"
                     style="<?php echo esc_attr( $background_color_banner ); ?>">
					<?php if ( $image_thumb['url'] ): ?>
                        <div class="banner-image">
							<?php echo wp_specialchars_decode( $image_thumb['img'] ); ?>
                        </div>
					<?php endif; ?>
                    <div class="texts">
                        <div class="display-table">
                            <div class="table-cell">
								<?php if ( $atts['text_1'] ): ?>
                                    <div class="text-1"><?php echo esc_html( $atts['text_1'] ) ?> </div>
								<?php endif; ?>
								<?php if ( $atts['text_2'] ): ?>
                                    <div class="text-2"><?php echo wp_specialchars_decode( $atts['text_2'] ) ?> </div>
								<?php endif; ?>

								<?php if ( $atts['text_3'] || $atts['text_4'] ): ?>
                                    <div class="text-3-container">
										<?php if ( $atts['text_3'] ): ?>
                                            <label class="text-3"><?php echo esc_html( $atts['text_3'] ) ?> </label>
										<?php endif; ?>
										<?php if ( $atts['text_4'] ): ?>
                                            <strong class="text-4"><?php echo esc_html( $atts['text_4'] ) ?> </strong>
										<?php endif; ?>
                                    </div>
								<?php endif; ?>
								<?php if ( $atts['text_6'] ): ?>
                                    <div class="text-6"><?php echo wp_specialchars_decode( $atts['text_6'] ) ?> </div>
								<?php endif; ?>
								<?php if ( $link['url'] ): ?>
                                    <div class="link-text-container">
                                        <a class="link-text"
                                           href="<?php echo esc_url( $link['url'] ) ?>" <?php if ( $link['target'] ): ?> target="<?php echo esc_attr( $link['target'] ); ?>" <?php endif; ?>><?php echo esc_html( $link['title'] ) ?>
                                        </a>
                                    </div>
								<?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
			<?php elseif ( $atts['layout'] == 'style7' || $atts['layout'] == 'style8' || $atts['layout'] == 'style9' || $atts['layout'] == 'style10' || $atts['layout'] == 'style12' || $atts['layout'] == 'style15' || $atts['layout'] == 'style17' ) : ?>
				<?php $css_class[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'ovic_banner', $atts ); ?>
                <div class="banner-effect <?php echo esc_attr( implode( ' ', $css_class ) ); ?>"
                     style="<?php echo esc_attr( $background_color_banner ); ?>">
					<?php if ( $image_thumb['url'] ): ?>
                        <div class="banner-image">
							<?php if ( $link['url'] ): ?>
                                <a href="<?php echo esc_url( $link['url'] ) ?>"
								   <?php if ( $link['target'] ): ?>target="<?php echo esc_attr( $link['target'] ); ?>"<?php endif; ?>>
									<?php echo wp_specialchars_decode( $image_thumb['img'] ); ?>
                                </a>
							<?php else: ?>
								<?php echo wp_specialchars_decode( $image_thumb['img'] ); ?>
							<?php endif; ?>
                        </div>
					<?php endif; ?>
                    <div class="texts">
                        <div class="display-table">
                            <div class="table-cell">
								<?php if ( $text_1 ): ?>
                                    <div class="text-1"><?php echo esc_html( $text_1 ) ?> </div>
								<?php endif; ?>
								<?php if ( $text_2 ): ?>
                                    <div class="text-2"><?php echo wp_specialchars_decode( $text_2 ) ?> </div>
								<?php endif; ?>
								<?php if ( $text_3 ): ?>
                                    <div class="text-3"><?php echo esc_html( $text_3 ) ?> </div>
								<?php endif; ?>
								<?php if ( $text_4 ): ?>
                                    <div class="text-4"><?php echo esc_html( $text_4 ) ?> </div>
								<?php endif; ?>
								<?php if ( $text_5 ): ?>
                                    <div class="text-5"><?php echo wp_specialchars_decode( $text_5 ) ?> </div>
								<?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
			<?php elseif ( $atts['layout'] == 'style14' ) : ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <div class="shortcode-context <?php echo esc_attr( apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'ovic_banner', $atts ) ); ?>">
						<?php if ( $image_thumb['url'] ): ?>
                            <div class="banner-image">
								<?php if ( $link['url'] ): ?>
                                    <a href="<?php echo esc_url( $link['url'] ) ?>"
										<?php if ( $link['target'] ): ?> target="<?php echo esc_attr( $link['target'] ); ?>"<?php endif; ?>
                                    >
										<?php echo wp_specialchars_decode( $image_thumb['img'] ); ?>
                                    </a>
								<?php else: ?>
									<?php echo wp_specialchars_decode( $image_thumb['img'] ); ?>
								<?php endif; ?>
                            </div>
						<?php endif; ?>
                        <div class="texts">
							<?php if ( $text_1 ): ?>
                                <div class="text-1"><?php echo esc_html( $text_1 ) ?> </div>
							<?php endif; ?>
							<?php if ( $text_2 ): ?>
                                <div class="text-2"><?php echo wp_specialchars_decode( $text_2 ) ?> </div>
							<?php endif; ?>
							<?php if ( $text_3 ): ?>
                                <div class="text-3"><?php echo wp_specialchars_decode( $text_3 ) ?> </div>
							<?php endif; ?>
                        </div>
						<?php if ( ! empty( $link['url'] ) ): ?>
                            <a class="banner-link" href="<?php echo esc_url( $link['url'] ); ?>">
								<?php
								if ( ! empty( $link['title'] ) ) {
									echo esc_html( $link['title'] );
								} else {
									esc_html_e( 'Shop Now', 'biolife' );
								}
								?>
                            </a>
						<?php endif; ?>
                    </div>
                </div>
			<?php elseif ( $atts['layout'] == 'style16' ) : ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <div class="shortcode-context <?php echo esc_attr( apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'ovic_banner', $atts ) ); ?>">
						<?php if ( $text_1 || $text_2 || $text_3 || $link['url'] ): ?>
							<?php if ( $image_thumb['url'] ): ?>
                                <div class="is-texts banner-image">
									<?php if ( $link['url'] ): ?>
                                        <a href="<?php echo esc_url( $link['url'] ) ?>"
											<?php if ( $link['target'] ): ?> target="<?php echo esc_attr( $link['target'] ); ?>"<?php endif; ?>
                                        >
											<?php echo wp_specialchars_decode( $image_thumb['img'] ); ?>
                                        </a>
									<?php else: ?>
										<?php echo wp_specialchars_decode( $image_thumb['img'] ); ?>
									<?php endif; ?>
                                </div>
							<?php endif; ?>
                            <div class="texts">
								<?php if ( $text_1 ): ?>
                                    <div class="text-1"><?php echo esc_html( $text_1 ) ?> </div>
								<?php endif; ?>
								<?php if ( $text_2 ): ?>
                                    <div class="text-2"><?php echo wp_specialchars_decode( $text_2 ) ?> </div>
								<?php endif; ?>
								<?php if ( $text_3 ): ?>
                                    <div class="text-3"><?php echo wp_specialchars_decode( $text_3 ) ?> </div>
								<?php endif; ?>
								<?php if ( ! empty( $link['url'] ) ): ?>
                                    <a class="shortcode-url" href="<?php echo esc_url( $link['url'] ); ?>">
										<?php
										if ( ! empty( $link['title'] ) ) {
											echo esc_html( $link['title'] );
										} else {
											esc_html_e( 'Shop Now', 'biolife' );
										}
										?>
                                    </a>
								<?php endif; ?>
                            </div>
						<?php else: ?>
							<?php if ( $image_thumb['url'] ): ?>
                                <div class="no-texts banner-image">
									<?php if ( $link['url'] ): ?>
                                        <a href="<?php echo esc_url( $link['url'] ) ?>"
											<?php if ( $link['target'] ): ?> target="<?php echo esc_attr( $link['target'] ); ?>"<?php endif; ?>
                                        >
											<?php echo wp_specialchars_decode( $image_thumb['img'] ); ?>
                                        </a>
									<?php else: ?>
										<?php echo wp_specialchars_decode( $image_thumb['img'] ); ?>
									<?php endif; ?>
                                </div>
							<?php endif; ?>
						<?php endif; ?>
                    </div>
                </div>
			<?php elseif ( $atts['layout'] == 'style18' ) : ?>
				<?php $css_class[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'ovic_banner', $atts ); ?>
                <div class="banner-effect <?php echo esc_attr( implode( ' ', $css_class ) ); ?>"
                     style="<?php echo esc_attr( $background_color_banner ); ?>">
					<?php if ( $atts['image_background'] ) : ?>
                        <div class="banner-image">
							<?php echo wp_specialchars_decode( $image_thumb['img'] ); ?>
                        </div>
					<?php endif; ?>
                    <div class="texts">
						<?php if ( $text_1 ): ?>
                            <div class="text-1"><?php echo esc_html( $text_1 ) ?> </div>
						<?php endif; ?>
						<?php if ( $text_2 ): ?>
                            <div class="text-2"
                                 style="<?php echo esc_attr( $text_2_style ) ?>"><?php echo wp_specialchars_decode( $text_2 ) ?> </div>
						<?php endif; ?>
						<?php if ( $text_3 ): ?>
                            <div class="text-3"><?php echo esc_html( $text_3 ) ?> </div>
						<?php endif; ?>
						<?php if ( ! empty( $link['url'] ) ): ?>
                            <a class="shortcode-url" href="<?php echo esc_url( $link['url'] ); ?>">
								<?php
								if ( ! empty( $link['title'] ) ) {
									echo esc_html( $link['title'] );
								}
								?>
                            </a>
						<?php endif; ?>
                    </div>
                </div>
			<?php elseif ( $atts['layout'] == 'style19' ) : ?>
				<?php $css_class[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'ovic_banner', $atts ); ?>
                <div class="banner-effect <?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
					<?php if ( $atts['image_background'] ) : ?>
                        <div class="banner-img">
							<?php if ( $link['url'] ): ?>
                                <a class="banner-img-link" href="<?php echo esc_url( $link['url'] ) ?>">
									<?php echo wp_specialchars_decode( $image_thumb['img'] ); ?>
                                </a>
							<?php else: ?>
								<?php echo wp_specialchars_decode( $image_thumb['img'] ); ?>
							<?php endif; ?>
                        </div>
					<?php endif; ?>
                    <div class="texts">
						<?php if ( $text_1 ): ?>
                            <div class="text-1"><?php echo esc_html( $text_1 ) ?> </div>
						<?php endif; ?>
						<?php if ( $text_2 ): ?>
                            <div class="text-2"><?php echo wp_specialchars_decode( $text_2 ) ?> </div>
						<?php endif; ?>
						<?php if ( $text_3 ): ?>
                            <div class="text-3"><?php echo esc_html( $text_3 ) ?> </div>
						<?php endif; ?>
						<?php if ( $text_4 ): ?>
                            <div class="text-4"><?php echo esc_html( $text_4 ) ?></div>
						<?php endif; ?>
						<?php if ( $link['url'] ): ?>
                            <a class="banner-link"
                               href="<?php echo esc_url( $link['url'] ) ?>"><?php echo esc_html( $link['title'] ) ?>
                            </a>
						<?php endif; ?>
                    </div>
                </div>
			<?php elseif ( $atts['layout'] == 'style20' || $atts['layout'] == 'style21' ) : ?>
				<?php $css_class[] = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'ovic_banner', $atts ); ?>
                <div class="banner-effect <?php echo esc_attr( implode( ' ', $css_class ) ); ?>" <?php echo esc_attr( $css ); ?>>
                    <div class="texts">
						<?php if ( $text_2 ): ?>
                            <div class="text-3"><?php echo esc_html( $text_2 ) ?> </div>
						<?php endif; ?>
						<?php if ( $text_1 ): ?>
                            <div class="text-1"><?php echo esc_html( $text_1 ) ?> </div>
						<?php endif; ?>
						<?php if ( $atts['underline'] ) : ?>
					        <figure class="underline"><?php echo wp_get_attachment_image( $atts['underline'], 'full' ); ?></figure>
					    <?php endif; ?>
						<?php if ( $subtitle ): ?>
                            <div class="text-2"><?php echo wp_specialchars_decode( $subtitle ) ?> </div>
						<?php endif; ?>
                    </div>
                </div>
			<?php endif;
			$html = ob_get_clean();

			return apply_filters( 'Ovic_Shortcode_Banner', $html, $atts, $content );
		}
	}

	new Ovic_Shortcode_Banner();
}

