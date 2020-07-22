<?php
if ( !class_exists( 'Ovic_Shortcode_Iconbox' ) ) {
    class Ovic_Shortcode_Iconbox extends Ovic_Shortcode
    {
        /**
         * Shortcode name.
         *
         * @var  string
         */
        public $shortcode = 'iconbox';
        /**
         * Default $atts .
         *
         * @var  array
         */
        public $default_atts = array();

        public function output_html( $atts, $content = null )
        {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'ovic_iconbox', $atts ) : $atts;
            // Extract shortcode parameters.
            $text_content = $title = $title_1 = $before_title = $image = $icon = $product_category = $link = $link_2 = $number = $image_iconbox_background = '';
            extract( $atts );
            $css_class    = array( 'ovic-iconbox' );
            $css_class[]  = $atts['style'];
            $css_class[]  = $atts['text_align'];
            $css_class[]  = $atts['el_class'];
            $class_editor = isset( $atts['css'] ) ? vc_shortcode_custom_css_class( $atts['css'], ' ' ) : '';
            $css_class[]  = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'ovic_iconbox', $atts );
            if($atts['type'] === 'image'){
                if($image){
                    $image = apply_filters('ovic_resize_image', $atts['image'], false, false, false, true);
                }
            }else{
                if ( isset( $atts['type'] ) ) {
                    $icon         = $atts['icon_' . $atts['type']];
                    vc_icon_element_fonts_enqueue( $atts['type'] );
                }
            }
            if($image_iconbox_background){
                $image_iconbox_background = apply_filters('ovic_resize_image', $atts['image_iconbox_background'], false, false, false, true);
            }
            if($link){
                $link = vc_build_link( $atts['link'] );
            }else{
                $link = array('title'  => '', 'url'    => '', 'target' => '_self');
            }

            if($link_2){
                $link_2 = vc_build_link( $atts['link_2'] );
            }else{
                $link_2 = array('title'  => '', 'url'    => '', 'target' => '_self');
            }

            ob_start();
            if ( $atts['style'] == 'style1' ) : ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <div class="iconbox-inner">
                        <div class="box-icon">
                            <?php if ( $icon ): ?>
                                <div class="icon"><span class="<?php echo esc_attr( $icon ) ?>"></span></div>
                            <?php elseif ( $image ) : ?>
                                <?php echo wp_specialchars_decode ($image['img']);  ?>
                            <?php endif; ?>
                        </div>
                        <div class="content">
                            <?php if ( $atts['title'] ):
                                if ( $link['url'] ) : ?>
                                    <h4 class="title">
                                        <a href="<?php echo esc_url( $link['url'] ); ?>"
                                            <?php if ($link['target']): ?> target="<?php echo esc_attr( $link['target'] ); ?>" <?php endif; ?>>
                                            <?php echo esc_html( $atts['title'] ); ?>
                                        </a>
                                    </h4>
                                <?php else: ?>
                                    <h4 class="title"><?php echo esc_html( $atts['title'] ); ?></h4>
                                <?php endif;
                            endif;
                            if ( $atts['text_content'] ): ?>
                                <p class="text"><?php echo wp_specialchars_decode( $atts['text_content'] ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php elseif ( $atts['style'] == 'style2' ) : ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <div class="iconbox-inner">
                        <div class="box-icon">
                            <?php if ( $icon ): ?>
                                <div class="icon"><span class="<?php echo esc_attr( $icon ) ?>"></span></div>
                            <?php elseif ( $image ) : ?>
                                <?php echo wp_specialchars_decode ($image['img']);  ?>
                            <?php endif; ?>
                        </div>
                        <div class="content">
                            <?php if ( $atts['number'] ): ?>
                                <p class="number"><?php echo wp_specialchars_decode( $atts['number'] ); ?></p>
                            <?php endif; ?>
                            <?php if ( $atts['title'] ):
                                if ( $link['url'] ) : ?>
                                    <h4 class="title">
                                        <a href="<?php echo esc_url( $link['url'] ); ?>"
                                            <?php if ($link['target']): ?> target="<?php echo esc_attr( $link['target'] ); ?>" <?php endif; ?>>
                                            <?php echo esc_html( $atts['title'] ); ?>
                                        </a>
                                    </h4>
                                <?php else: ?>
                                    <h4 class="title"><?php echo esc_html( $atts['title'] ); ?></h4>
                                <?php endif;
                            endif;
                            if ( $atts['text_content'] ): ?>
                                <p class="text"><?php echo wp_specialchars_decode( $atts['text_content'] ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php elseif ( $atts['style'] == 'style3' ) : ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <div class="iconbox-inner">
                        <div class="box-icon">
                            <?php if ( $icon ): ?>
                                <div class="icon"><span class="<?php echo esc_attr( $icon ) ?>"></span></div>
                            <?php elseif ( $image ) : ?>
                                <?php echo wp_specialchars_decode ($image['img']);  ?>
                            <?php endif; ?>
                        </div>
                        <div class="content">
                            <?php if ( $atts['title'] ):
                                if ( $link['url'] ) : ?>
                                    <h4 class="title">
                                        <a href="<?php echo esc_url( $link['url'] ); ?>"
                                            <?php if ($link['target']): ?> target="<?php echo esc_attr( $link['target'] ); ?>" <?php endif; ?>>
                                            <?php echo esc_html( $atts['title'] ); ?>
                                        </a>
                                    </h4>
                                <?php else: ?>
                                    <h4 class="title"><?php echo esc_html( $atts['title'] ); ?></h4>
                                <?php endif;
                            endif;
                            if ( $atts['text_content'] ): ?>
                                <p class="text"><?php echo wp_specialchars_decode( $atts['text_content'] ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php elseif ( $atts['style'] == 'style4' ) : ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <div class="iconbox-inner">
                        <div class="box-icon">
                            <?php if ( $icon ): ?>
                                <div class="icon"><span class="<?php echo esc_attr( $icon ) ?>"></span></div>
                            <?php elseif ( $image ) : ?>
                                <?php echo wp_specialchars_decode ($image['img']);  ?>
                            <?php endif; ?>
                        </div>
                        <div class="content">
                            <?php if ( $atts['title'] ):
                                if ( $link['url'] ) : ?>
                                    <h4 class="title">
                                        <a href="<?php echo esc_url( $link['url'] ); ?>"
                                            <?php if ($link['target']): ?> target="<?php echo esc_attr( $link['target'] ); ?>" <?php endif; ?>>
                                            <?php echo esc_html( $atts['title'] ); ?>
                                        </a>
                                    </h4>
                                <?php else: ?>
                                    <h4 class="title"><?php echo esc_html( $atts['title'] ); ?></h4>
                                <?php endif;
                            endif;
                            if ( $atts['text_content'] ): ?>
                                <p class="text"><?php echo wp_specialchars_decode( $atts['text_content'] ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php elseif ( $atts['style'] == 'style5' ) : ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <div class="iconbox-inner">
                        <?php if ( $atts['number'] ): ?>
                            <p class="number"><?php echo wp_specialchars_decode( $atts['number'] ); ?></p>
                        <?php endif; ?>
                        <div class="box-icon">
                            <?php if ( $icon ): ?>
                                <div class="icon"><span class="<?php echo esc_attr( $icon ) ?>"></span></div>
                            <?php elseif ( $image ) : ?>
                                <?php echo wp_specialchars_decode ($image['img']);  ?>
                            <?php endif; ?>
                        </div>
                        <div class="content">
                            <?php if ( $atts['title'] ):
                                if ( $link['url'] ) : ?>
                                    <h4 class="title">
                                        <a href="<?php echo esc_url( $link['url'] ); ?>"
                                            <?php if ($link['target']): ?> target="<?php echo esc_attr( $link['target'] ); ?>" <?php endif; ?>>
                                            <?php echo esc_html( $atts['title'] ); ?>
                                        </a>
                                    </h4>
                                <?php else: ?>
                                    <h4 class="title"><?php echo esc_html( $atts['title'] ); ?></h4>
                                <?php endif;
                            endif;
                            if ( $atts['text_content'] ): ?>
                                <p class="text"><?php echo wp_specialchars_decode( $atts['text_content'] ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php elseif ( $atts['style'] == 'style6' ) : ?>
                <?php
                $link['url'] = '#';
                $number = 0;
                if((int)$product_category >0){
                    $category      = get_term( $product_category, 'product_cat' );
                    if ($category){
                        $link['url'] = get_term_link( $category->term_id, 'product_cat' );
                        $number = $category->count;
                    }

                }
                ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <div class="iconbox-inner">
                        <div class="box-image">
                            <?php if ($image): ?>
                                <?php if ($link['url']): ?>
                                    <a href="<?php echo esc_url($link['url']) ?>" <?php if ($link['target']): ?> target="<?php echo esc_attr( $link['target'] ); ?>" <?php endif; ?>>
                                        <?php echo wp_specialchars_decode ($image['img']);  ?>
                                    </a>
                                <?php else: ?>
                                    <?php echo wp_specialchars_decode ($image['img']);  ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="texts">
                            <?php if ( $atts['text_content'] ): ?>
                                <div class="content">
                                    <?php if ($link['url']): ?>
                                        <a href="<?php echo esc_url($link['url']) ?>" <?php if ($link['target']): ?> target="<?php echo esc_attr( $link['target'] ); ?>" <?php endif; ?>><?php echo wp_specialchars_decode( $atts['text_content'] ); ?></a>
                                    <?php else: ?>
                                        <?php echo wp_specialchars_decode( $atts['text_content'] ); ?>
                                    <?php endif; ?>

                                </div>
                            <?php endif; ?>
                            <?php if ($number): ?>
                                <?php if ((int)$number > 1):  ?>
                                    <div class="number">(<span class="text-value"><?php echo wp_specialchars_decode( $number ); ?></span><span class="text-label"><?php echo esc_html__('items', 'biolife') ?></span>)</div>
                                <?php else: ?>
                                    <div class="number">(<span class="text-value"><?php echo wp_specialchars_decode( $number ); ?></span><span class="text-label"><?php echo esc_html__('item', 'biolife') ?></span>)</div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="number">(<span class="text-value"><?php echo wp_specialchars_decode( $number ); ?></span><span class="text-label"><?php echo esc_html__('item', 'biolife') ?></span>)</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php elseif ( $atts['style'] == 'style7' ) : ?>
                <?php if ($image): ?>
                    <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>" style="background-image: url('<?php  echo esc_url($image['url'])?>')">
                        <div class="container">
                            <div class="texts">
                                <?php if ( $atts['text_content'] ): ?>
                                    <div class="content">
                                        <?php echo wp_specialchars_decode( $atts['text_content'] ); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (isset($atts['countdown_date']) && $atts['countdown_date']):  ?>
                                    <div class="countdown-container">
                                        <div class="biolife-countdown" data-datetime="<?php echo esc_attr($atts['countdown_date']); ?>" data-txt_day="<?php echo esc_attr__('Days', 'biolife') ?>" data-txt_hour="<?php echo esc_attr__('Hrs', 'biolife') ?>" data-txt_min="<?php echo esc_attr__('Mins', 'biolife') ?>" data-txt_sec="<?php echo esc_attr__('Secs', 'biolife') ?>" data-value_first="1"></div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($link['url']): ?>
                                    <div class="link-text-container">
                                        <a class="link-text" href="<?php echo esc_url($link['url']) ?>" <?php if ($link['target']): ?> target="<?php echo esc_attr( $link['target'] ); ?>" <?php endif; ?>><?php echo esc_html($link['title']); ?></a>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php elseif ( $atts['style'] == 'style8' || $atts['style'] == 'style11' ) : ?>
                <?php if ($image): ?>
                    <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>" style="background-image: url('<?php  echo esc_url($image['url'])?>')">
                        <div class="container">
                            <div class="texts">
                                <?php if ( $atts['title'] ): ?>
                                    <div class="title">
                                        <?php echo esc_html( $atts['title'] ); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ( $atts['sub_title'] ): ?>
                                    <div class="sub-title">
                                        <?php echo esc_html( $atts['sub_title'] ); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ( $atts['text_content'] ): ?>
                                    <div class="content">
                                        <?php echo wp_specialchars_decode( $atts['text_content'] ); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (isset($atts['countdown_date']) && $atts['countdown_date']):  ?>
                                    <div class="countdown-container">
                                        <div class="biolife-countdown" data-datetime="<?php echo esc_attr($atts['countdown_date']); ?>" data-txt_day="<?php echo esc_attr__('Days', 'biolife') ?>" data-txt_hour="<?php echo esc_attr__('Hrs', 'biolife') ?>" data-txt_min="<?php echo esc_attr__('Mins', 'biolife') ?>" data-txt_sec="<?php echo esc_attr__('Secs', 'biolife') ?>" data-value_first="1"></div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($link['url']): ?>
                                    <div class="link-text-container">
                                        <a class="link-text" href="<?php echo esc_url($link['url']) ?>" <?php if ($link['target']): ?> target="<?php echo esc_attr( $link['target'] ); ?>" <?php endif; ?>><?php echo esc_html($link['title']); ?></a>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php elseif ( $atts['style'] == 'style9' ) : ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <div class="inner">
                        <div class="box-icon">
                            <?php if ($image): ?>
                                <?php if ($link['url']): ?>
                                    <a href="<?php echo esc_url($link['url']) ?>" <?php if ($link['target']): ?> target="<?php echo esc_attr( $link['target'] ); ?>" <?php endif; ?>>
                                        <?php echo wp_specialchars_decode ($image['img']);  ?>
                                    </a>
                                <?php else: ?>
                                    <?php echo wp_specialchars_decode ($image['img']);  ?>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if ( $icon ): ?>
                                    <?php if ($link['url']): ?>
                                        <a href="<?php echo esc_url($link['url']) ?>" <?php if ($link['target']): ?> target="<?php echo esc_attr( $link['target'] ); ?>" <?php endif; ?>>
                                            <span class="<?php echo esc_attr( $icon ) ?>"></span>
                                        </a>
                                    <?php else: ?>
                                        <span class="<?php echo esc_attr( $icon ) ?>"></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="texts">
                            <?php if ($title): ?>
                                <div class="title-container">
                                    <?php if ($before_title): ?>
                                        <strong class="before-title"><?php echo esc_html($before_title) ?></strong>
                                    <?php endif; ?>
                                    <span class="title"><?php echo esc_html($title); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if ( $text_content): ?>
                                <div class="text-content"><?php echo esc_html($text_content); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php elseif ( $atts['style'] == 'style10' ) : ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <div class="inner">
                        <?php if ( $atts['number'] ): ?>
                            <div class="block-number"><?php echo wp_specialchars_decode( $atts['number'] ); ?></div>
                        <?php endif; ?>
                        <div class="block-icon">
                            <?php if ($image): ?>
                                <?php echo wp_specialchars_decode ($image['img']);  ?>
                            <?php else: ?>
                                <?php if ( $icon ): ?>
                                    <span class="<?php echo esc_attr( $icon ) ?>"></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="block-content">
                            <?php if ($link['url']): ?>
                                <a href="<?php echo esc_url($link['url']) ?>" <?php if ($link['target']): ?> target="<?php echo esc_attr( $link['target'] ); ?>" <?php endif; ?>>
                                    <?php echo esc_html($text_content); ?>
                                </a>
                            <?php else: ?>
                                <?php echo esc_html($text_content); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php elseif ( $atts['style'] == 'style12' ) : ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <div class="inner" style="background-image: url('<?php  echo esc_url($image_iconbox_background['url'])?>')">
                        <div class="box-icon">
                            <?php if ($image): ?>
                                <?php if ($link['url']): ?>
                                    <a href="<?php echo esc_url($link['url']) ?>" <?php if ($link['target']): ?> target="<?php echo esc_attr( $link['target'] ); ?>" <?php endif; ?>>
                                        <?php echo wp_specialchars_decode ($image['img']);  ?>
                                    </a>
                                <?php else: ?>
                                    <?php echo wp_specialchars_decode ($image['img']);  ?>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if ( $icon ): ?>
                                    <?php if ($link['url']): ?>
                                        <a href="<?php echo esc_url($link['url']) ?>" <?php if ($link['target']): ?> target="<?php echo esc_attr( $link['target'] ); ?>" <?php endif; ?>>
                                            <span class="<?php echo esc_attr( $icon ) ?>"></span>
                                        </a>
                                    <?php else: ?>
                                        <span class="<?php echo esc_attr( $icon ) ?>"></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if ($link['url']): ?>
                        <div class="link-text-container">
                            <a class="link-text" href="<?php echo esc_url($link['url']) ?>" <?php if ($link['target']): ?> target="<?php echo esc_attr( $link['target'] ); ?>" <?php endif; ?>><?php echo esc_html($link['title']); ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php elseif ( $atts['style'] == 'style13' ) : ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <div class="inner">
                        <?php if ( $atts['sub_title'] ): ?>
                            <div class="sub-title">
                                <?php echo esc_html( $atts['sub_title'] ); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ( $atts['title'] ): ?>
                            <div class="title">
                                <?php echo esc_html( $atts['title'] ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php elseif ( $atts['style'] == 'style14' || $atts['style'] == 'style16' ) : ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <div class="inner">
                        <div class="box-icon">
                            <?php if ($image): ?>
                                <?php if ($link['url']): ?>
                                    <a href="<?php echo esc_url($link['url']) ?>" <?php if ($link['target']): ?> target="<?php echo esc_attr( $link['target'] ); ?>" <?php endif; ?>>
                                        <?php echo wp_specialchars_decode ($image['img']);  ?>
                                    </a>
                                <?php else: ?>
                                    <?php echo wp_specialchars_decode ($image['img']);  ?>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if ( $icon ): ?>
                                    <?php if ($link['url']): ?>
                                        <a href="<?php echo esc_url($link['url']) ?>" <?php if ($link['target']): ?> target="<?php echo esc_attr( $link['target'] ); ?>" <?php endif; ?>>
                                            <span class="<?php echo esc_attr( $icon ) ?>"></span>
                                        </a>
                                    <?php else: ?>
                                        <span class="<?php echo esc_attr( $icon ) ?>"></span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="box-content">
                            <?php if ( $atts['title'] ): ?>
                                <div class="title">
                                    <?php echo esc_html( $atts['title'] ); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ( $atts['text_content'] ): ?>
                                <p class="text"><?php echo wp_specialchars_decode( $atts['text_content'] ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php elseif ( $atts['style'] == 'style15' ) : ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <div class="iconbox-inner">
                        <div class="info">
                            <?php if ( $atts['title_1'] ): ?>
                                <div class="title">
                                    <?php echo wp_specialchars_decode( $atts['title_1'] ); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ( $atts['text_content'] ): ?>
                                <p class="text"><?php echo wp_specialchars_decode( $atts['text_content'] ); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="group-button">
                            <?php if ($link['url']): ?>
                                <a class="link-text" href="<?php echo esc_url($link['url']) ?>" <?php if ($link['target']): ?> target="<?php echo esc_attr( $link['target'] ); ?>" <?php endif; ?>><?php echo esc_html($link['title']); ?></a>
                            <?php endif; ?>
                            <?php if ($link_2['url']): ?>
                                <a class="link-text text-2" href="<?php echo esc_url($link_2['url']) ?>" <?php if ($link_2['target']): ?> target="<?php echo esc_attr( $link_2['target'] ); ?>" <?php endif; ?>><?php echo esc_html($link_2['title']); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php elseif ( $atts['style'] == 'style17' || $atts['style'] == 'style18' ) : ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <div class="iconbox-inner">
                        <div class="box-icon">
                            <?php if ( $icon ): ?>
                                <div class="icon"><span class="<?php echo esc_attr( $icon ) ?>"></span></div>
                            <?php elseif ( $image ) : ?>
                                <?php echo wp_specialchars_decode ($image['img']);  ?>
                            <?php endif; ?>
                        </div>
                        <div class="content">
                            <?php if ( $atts['title'] ): ?>
                                <h4 class="title"><?php echo esc_html( $atts['title'] ); ?></h4>
                            <?php endif; ?>
                            <?php if ( $atts['text_content'] ): ?>
                                <p class="text"><?php echo wp_specialchars_decode( $atts['text_content'] ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php elseif ( $atts['style'] == 'style19' ) : ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <?php if ( $atts['title'] ): ?>
                        <div class="title">
                            <?php echo esc_html( $atts['title'] ); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( $atts['sub_title'] ): ?>
                        <div class="sub-title">
                            <?php echo esc_html( $atts['sub_title'] ); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( $atts['text_content'] ): ?>
                        <div class="content">
                            <?php echo wp_specialchars_decode( $atts['text_content'] ); ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($atts['countdown_date']) && $atts['countdown_date']):  ?>
                        <div class="countdown-container">
                            <div class="biolife-countdown" data-datetime="<?php echo esc_attr($atts['countdown_date']); ?>" data-txt_day="<?php echo esc_attr__('Days', 'biolife') ?>" data-txt_hour="<?php echo esc_attr__('Hrs', 'biolife') ?>" data-txt_min="<?php echo esc_attr__('Mins', 'biolife') ?>" data-txt_sec="<?php echo esc_attr__('Secs', 'biolife') ?>" data-value_first="1"></div>
                        </div>
                    <?php endif; ?>
                    <?php if ($link['url']): ?>
                        <div class="link-text-container">
                            <a class="link-text" href="<?php echo esc_url($link['url']) ?>" <?php if ($link['target']): ?> target="<?php echo esc_attr( $link['target'] ); ?>" <?php endif; ?>><?php echo esc_html($link['title']); ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php elseif ( $atts['style'] == 'style20' ) : ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <?php if ( $atts['title'] ): ?>
                        <div class="title">
                            <?php echo esc_html( $atts['title'] ); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( $atts['text_content'] ): ?>
                        <div class="content">
                            <?php echo wp_specialchars_decode( $atts['text_content'] ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php elseif ( $atts['style'] == 'style21' ) : ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <div class="iconbox-inner">
                        <div class="box-icon">
                            <?php if ( $icon ): ?>
                                <div class="icon"><span class="<?php echo esc_attr( $icon ) ?>"></span></div>
                            <?php elseif ( $image ) : ?>
                                <?php echo wp_specialchars_decode ($image['img']);  ?>
                            <?php endif; ?>
                        </div>
                        <div class="content">
                            <?php if ( $atts['title'] ): ?>
                                <h4 class="title"><?php echo esc_html( $atts['title'] ); ?></h4>
                            <?php endif; ?>
                            <?php if ( $atts['text_content'] ): ?>
                                <p class="text"><?php echo wp_specialchars_decode( $atts['text_content'] ); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php
            endif;
            wp_reset_postdata();
            $html = ob_get_clean();

            return apply_filters( 'Ovic_Shortcode_Iconbox', $html, $atts, $content );
        }
    }

    new Ovic_Shortcode_Iconbox();
}