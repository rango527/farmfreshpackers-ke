<?php
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Ovic_Tabs"
 */
if ( !class_exists( 'Ovic_Shortcode_Tabs' ) ) {
    class Ovic_Shortcode_Tabs extends Ovic_Shortcode
    {
        /**
         * Shortcode name.
         *
         * @var  string
         */
        public $shortcode = 'tabs';

        static public function add_css_generate( $atts )
        {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'ovic_tabs', $atts ) : $atts;
            // Extract shortcode parameters.
            extract( $atts );
            $css = '';

            return apply_filters( 'Ovic_Shortcode_Tabs_css', $css, $atts );
        }

        public function output_html( $atts, $content = null )
        {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'ovic_tabs', $atts ) : $atts;
            $css_animation = $layout = $sub_title = $tab_title = $tab_title_1 = '';
            extract( $atts );
            $css_class    = array( 'ovic-tabs', $layout, biolife_getCSSAnimation( $css_animation ) );
            $css_class[]  = $atts['el_class'];
            $class_editor = isset( $atts['css'] ) ? vc_shortcode_custom_css_class( $atts['css'], ' ' ) : '';
            $css_class[]  = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'ovic_tabs', $atts );
            $sections     = self::get_all_attributes( 'vc_tta_section', $content );
            $rand         = uniqid();
            if($layout == 'style4'){
                $css_class[] = 'style1';
            }
            ob_start(); ?>
            <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                <?php if ( $sections && is_array( $sections ) && count( $sections ) > 0 ){ ?>
                    <?php if ($layout == 'style1' || $layout == 'style2' || $layout == 'style4' || $layout == 'style5'){ ?>
                        <?php
                        if (isset($atts['icon']) && $atts['icon']){
                            $icon = apply_filters( 'ovic_resize_image', $atts['icon'], false, false, true, true );
                        }else{
                            $icon = array('url'=>'', 'width'=>0, 'height'=>0, 'img'=>'');
                        }
                        ?>

                        <div class="tab-head ovic-dropdown">
                            <div class="title-container">
                                <?php if ($icon['url']): ?>
                                    <?php echo wp_specialchars_decode( $icon['img'] ); ?>
                                <?php endif; ?>
                                <?php if ($layout == 'style5'): ?>
                                    <?php if ($tab_title_1): ?>
                                        <div class="title"><?php echo wp_specialchars_decode($tab_title_1); ?></div>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if ($sub_title): ?>
                                    <div class="sub_title"><?php echo esc_html($sub_title); ?></div>
                                <?php endif; ?>
                                <?php if ($tab_title): ?>
                                    <div class="title"><?php echo esc_html($tab_title); ?></div>
                                <?php endif; ?>
                            </div>
                            <span class="tabs-toggle" data-ovic="ovic-dropdown"></span>
                            <ul class="tab-link">
                                <?php foreach ( $sections as $key => $section ) : ?>
                                    <?php
                                    $class_tab = array('tab-link-item');

                                    /* Get icon from section tabs */
                                    $section['i_type'] = isset( $section['i_type'] ) ? $section['i_type'] : 'fontawesome';
                                    $add_icon          = isset( $section['add_icon'] ) ? $section['add_icon'] : '';
                                    $class_tab[]       =  $section_style = isset( $section['style'] ) ? $section['style'] : '';
                                    $position_icon     = isset( $section['i_position'] ) ? $section['i_position'] : '';
                                    $icon_html         = $this->constructIcon( $section );
                                    $section_id        = $section['tab_id'] . '-' . $rand;
                                    $color_default              = isset($section['color_default']) ? $section['color_default'] : '#888';
                                    $color              = isset($section['color']) ? $section['color'] : '#fff';
                                    
                                    if (!isset($section['css_animation']))
                                        $section['css_animation'] = '';
                                    $style_color = 'color: '.$color_default;
                                    $loaded = '';
                                    if ( $key == $atts['active_section'] ){
                                        $class_tab[] = 'active';
                                        $style_color = 'color: '.$color;
                                        $loaded = 'loaded';
                                    }
                                    ?>
                                    <li class="<?php echo esc_attr( implode( ' ', $class_tab ) ); ?>" style="<?php echo esc_attr($style_color); ?>" data-color="<?php echo esc_attr($color); ?>" data-color_default="<?php echo esc_attr($color_default); ?>">
                                        <a class="<?php echo esc_attr($loaded); ?>"
                                           data-ajax="<?php echo esc_attr( $atts['ajax_check'] ) ?>"
                                           data-animate="<?php echo esc_attr( $section['css_animation'] ); ?>"
                                           data-section="<?php echo esc_attr( $section['tab_id'] ); ?>"
                                           data-id="<?php echo get_the_ID(); ?>"
                                           href="#<?php echo esc_attr( $section_id ); ?>">
                                            <?php if ( isset( $section['title_image'] ) ) : ?>
                                                <?php $image_thumb = apply_filters( 'ovic_resize_image', $section['title_image'], false, false, true, true ); ?>
                                                <?php if ($section_style == 'style3' || $section_style == 'style5'): ?>
                                                    <i class="tab-icon" style="background-image: url('<?php echo esc_url($image_thumb['url']); ?>')"></i>
                                                <?php else: ?>
                                                    <?php echo wp_specialchars_decode( $image_thumb['img'] ); ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if ($add_icon === 'true' && $icon_html): ?>
                                                <?php if ($position_icon === 'right'): ?>
                                                    <span><?php echo esc_html( $section['title'] ); ?></span>
                                                    <?php echo wp_specialchars_decode($icon_html); ?>
                                                <?php else: ?>
                                                    <?php echo wp_specialchars_decode($icon_html); ?>
                                                    <span><?php echo esc_html( $section['title'] ); ?></span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span><?php echo esc_html( $section['title'] ); ?></span>
                                            <?php endif; ?>

                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="tab-container">
                            <?php foreach ( $sections as $key => $section ): ?>
                                <?php
                                $section_id = $section['tab_id'] . '-' . $rand;
                                $active_tab = array( 'tab-panel' );
                                if ( $key == $atts['active_section'] )
                                    $active_tab[] = 'active';
                                ?>
                                <div class="<?php echo esc_attr( implode( ' ', $active_tab ) ); ?>"
                                     id="<?php echo esc_attr( $section_id ); ?>">
                                    <?php if ( $atts['ajax_check'] == '1' ) :
                                        echo esc_attr( $key ) == $atts['active_section'] ? do_shortcode( $section['content'] ) : '';
                                    else :
                                        echo do_shortcode( $section['content'] );
                                    endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php }elseif($layout == 'style3'){ ?>
                        <div class="tab-head ovic-dropdown">
                            <div class="title-container">
                                <?php if ($tab_title): ?>
                                    <div class="title"><?php echo esc_html($tab_title); ?></div>
                                <?php endif; ?>
                            </div>
                            <span class="tabs-toggle" data-ovic="ovic-dropdown"></span>
                            <ul class="tab-link">
                                <?php foreach ( $sections as $key => $section ) : ?>
                                    <?php
                                    $class_tab = array('tab-link-item');

                                    /* Get icon from section tabs */
                                    $section['i_type'] = isset( $section['i_type'] ) ? $section['i_type'] : 'fontawesome';
                                    $add_icon          = isset( $section['add_icon'] ) ? $section['add_icon'] : '';
                                    $class_tab[]       =  $section_style = isset( $section['style'] ) ? $section['style'] : '';
                                    $position_icon     = isset( $section['i_position'] ) ? $section['i_position'] : '';
                                    $icon_html         = $this->constructIcon( $section );
                                    $section_id        = $section['tab_id'] . '-' . $rand;
                                    if (!isset($section['css_animation']))
                                        $section['css_animation'] = '';
                                    $loaded = '';
                                    if ( $key == $atts['active_section'] ){
                                        $class_tab[] = 'active';
                                        $loaded = 'loaded';
                                    }
                                    ?>
                                    <li class="<?php echo esc_attr( implode( ' ', $class_tab ) ); ?>">
                                        <a class="<?php echo esc_attr($loaded); ?>"
                                           data-ajax="<?php echo esc_attr( $atts['ajax_check'] ) ?>"
                                           data-animate="<?php echo esc_attr( $section['css_animation'] ); ?>"
                                           data-section="<?php echo esc_attr( $section['tab_id'] ); ?>"
                                           data-id="<?php echo get_the_ID(); ?>"
                                           href="#<?php echo esc_attr( $section_id ); ?>">
                                            <?php if ( isset( $section['title_image'] ) ) : ?>
                                                <?php $image_thumb = apply_filters( 'ovic_resize_image', $section['title_image'], false, false, true, true ); ?>
                                                <?php if ($section_style == 'style3' || $section_style == 'style5'): ?>
                                                    <i class="tab-icon" style="background-image: url('<?php echo esc_url($image_thumb['url']); ?>')"></i>
                                                <?php else: ?>
                                                    <?php echo wp_specialchars_decode( $image_thumb['img'] ); ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if ($add_icon === 'true' && $icon_html): ?>
                                                <?php if ($position_icon === 'right'): ?>
                                                    <span><?php echo esc_html( $section['title'] ); ?></span>
                                                    <?php echo wp_specialchars_decode($icon_html); ?>
                                                <?php else: ?>
                                                    <?php echo wp_specialchars_decode($icon_html); ?>
                                                    <span><?php echo esc_html( $section['title'] ); ?></span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span><?php echo esc_html( $section['title'] ); ?></span>
                                            <?php endif; ?>

                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="shortcode-context">
                            <?php if (isset($atts['banner']) && $atts['banner']): ?>
                                <?php
                                if (isset($atts['banner']) && $atts['banner']){
                                    $banner = apply_filters( 'ovic_resize_image', $atts['banner'], false, false, true, true );
                                }else{
                                    $banner = array('url'=>'', 'width'=>0, 'height'=>0, 'img'=>'');
                                }
                                if(!empty($atts['link'])){
                                    $atts['link'] = vc_build_link( $atts['link'] );
                                    if (isset($atts['icon']) && $atts['icon']){
                                        $icon = apply_filters( 'ovic_resize_image', $atts['icon'], false, false, true, true );
                                    }else{
                                        $icon = array('url'=>'', 'width'=>0, 'height'=>0, 'img'=>'');
                                    }
                                }else{
                                    $atts['link'] = array('title'  => '', 'url'    => '', 'target' => '');
                                }
                                ?>
                            <div class="shortcode-banner">
                                <?php if (!empty($atts['link']['url'])): ?>
                                    <a href="<?php echo esc_url($atts['link']['url']) ?>">
                                        <?php echo wp_specialchars_decode( $banner['img'] ); ?>
                                    </a>
                                <?php else: ?>
                                    <?php echo wp_specialchars_decode( $banner['img'] ); ?>
                                <?php endif; ?>
                                <?php if (!empty($atts['link']['url']) && !empty($atts['link']['title'])): ?>
                                    <a class="shortcode-link" href="<?php echo esc_url($atts['link']['url']); ?>"
                                    <?php if (!empty($atts['link']['target'])): ?> target="<?php echo esc_attr($atts['link']['target']) ?>"<?php endif; ?>>
                                        <?php if ($icon['url']): ?>
                                            <?php echo wp_specialchars_decode( $icon['img'] ); ?>
                                        <?php endif; ?>
                                        <span><?php echo esc_html($atts['link']['title']); ?></span>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                            <div class="tab-container">
                                <?php foreach ( $sections as $key => $section ): ?>
                                    <?php
                                    $section_id = $section['tab_id'] . '-' . $rand;
                                    $active_tab = array( 'tab-panel' );
                                    if ( $key == $atts['active_section'] )
                                        $active_tab[] = 'active';
                                    ?>
                                    <div class="<?php echo esc_attr( implode( ' ', $active_tab ) ); ?>"
                                         id="<?php echo esc_attr( $section_id ); ?>">
                                        <?php if ( $atts['ajax_check'] == '1' ) :
                                            echo esc_attr( $key ) == $atts['active_section'] ? do_shortcode( $section['content'] ) : '';
                                        else :
                                            echo do_shortcode( $section['content'] );
                                        endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php }elseif($layout == 'style7'){ ?>
                        <div class="tab-head ovic-dropdown">
                            <?php
                            if ( $atts['tab_title'] )
                                $this->ovic_title_shortcode( $atts['tab_title'] );
                            ?>
                            <span class="tabs-toggle" data-ovic="ovic-dropdown"></span>
                            <ul class="tab-link">
                                <?php foreach ( $sections as $key => $section ) : ?>
                                    <?php
                                    $class_tab = array();
                                    /* Get icon from section tabs */
                                    $section['i_type'] = isset( $section['i_type'] ) ? $section['i_type'] : 'fontawesome';
                                    $add_icon          = isset( $section['add_icon'] ) ? $section['add_icon'] : '';
                                    $style_tab         = isset( $section['style'] ) ? $section['style'] : '';
                                    $position_icon     = isset( $section['i_position'] ) ? $section['i_position'] : '';
                                    $icon_html_left = $icon_html_right = '';
                                    if ('true' === $add_icon && 'right' !== $position_icon){
                                        $icon_html_left         = $this->constructIcon( $section );
                                    }
                                    if ('true' === $add_icon && 'right' === $position_icon){
                                        $icon_html_right         = $this->constructIcon( $section );
                                    }
                                    $section_id        = $section['tab_id'] . '-' . $rand;
                                    if ( $style_tab )
                                        $class_tab[] = $style_tab;
                                    if ( $key == $atts['active_section'] )
                                        $class_tab[] = 'active';

                                    $loaded = '';
                                    if ($key == $atts['active_section']){
                                        $loaded = 'loaded';
                                    }
                                    ?>
                                    <li class="<?php echo esc_attr( implode( ' ', $class_tab ) ); ?>">
                                        <?php if ( isset( $section['background_image'] ) ) : ?>
                                            <?php $image_bg = apply_filters( 'ovic_resize_image', $section['background_image'], false, false, true, true ); ?>
                                        <?php endif; ?>
                                        <a class="<?php echo esc_attr($loaded); ?>" style="background-image: url('<?php echo esc_url($image_bg['url']); ?>')"
                                           data-ajax="<?php echo esc_attr( $atts['ajax_check'] ) ?>"
                                           data-animate="<?php echo esc_attr( $atts['css_animation'] ); ?>"
                                           data-section="<?php echo esc_attr( $section['tab_id'] ); ?>"
                                           data-id="<?php echo get_the_ID(); ?>"
                                           href="#<?php echo esc_attr( $section_id ); ?>">
                                           <?php if ( isset( $section['title_image'] ) ) : ?>
                                                <?php $image_thumb = apply_filters( 'ovic_resize_image', $section['title_image'], false, false, true, true ); ?>
                                                    <i class="tab-icon" style="background-image: url('<?php echo esc_url($image_thumb['url']); ?>')"></i>
                                            <?php endif; ?>
                                            <?php if ( isset( $section['title'] ) ) : ?>
                                                <?php echo esc_html($icon_html_left); ?>
                                                <span><?php echo esc_html( $section['title'] ); ?></span>
                                                <?php echo esc_html($icon_html_right); ?>
                                            <?php endif; ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="tab-container">
                            <?php foreach ( $sections as $key => $section ): ?>
                                <?php
                                $section_id = $section['tab_id'] . '-' . $rand;
                                $active_tab = array( 'tab-panel' );
                                if ( $key == $atts['active_section'] )
                                    $active_tab[] = 'active';
                                ?>
                                <div class="<?php echo esc_attr( implode( ' ', $active_tab ) ); ?>"
                                     id="<?php echo esc_attr( $section_id ); ?>">
                                    <?php if ( $atts['ajax_check'] == '1' ) :
                                        echo esc_attr( $key ) == $atts['active_section'] ? do_shortcode( $section['content'] ) : '';
                                    else :
                                        echo do_shortcode( $section['content'] );
                                    endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php }else{ ?>
                        <div class="tab-head ovic-dropdown">
                            <?php
                            if ( $atts['tab_title'] )
                                $this->ovic_title_shortcode( $atts['tab_title'] );
                            ?>
                            <span class="tabs-toggle" data-ovic="ovic-dropdown"></span>
                            <ul class="tab-link">
                                <?php foreach ( $sections as $key => $section ) : ?>
                                    <?php
                                    $class_tab = array();
                                    /* Get icon from section tabs */
                                    $section['i_type'] = isset( $section['i_type'] ) ? $section['i_type'] : 'fontawesome';
                                    $add_icon          = isset( $section['add_icon'] ) ? $section['add_icon'] : '';
                                    $style_tab         = isset( $section['style'] ) ? $section['style'] : '';
                                    $position_icon     = isset( $section['i_position'] ) ? $section['i_position'] : '';
                                    $icon_html_left = $icon_html_right = '';
                                    if ('true' === $add_icon && 'right' !== $position_icon){
                                        $icon_html_left         = $this->constructIcon( $section );
                                    }
                                    if ('true' === $add_icon && 'right' === $position_icon){
                                        $icon_html_right         = $this->constructIcon( $section );
                                    }
                                    $section_id        = $section['tab_id'] . '-' . $rand;
                                    if ( $style_tab )
                                        $class_tab[] = $style_tab;
                                    if ( $key == $atts['active_section'] )
                                        $class_tab[] = 'active';

                                    $loaded = '';
                                    if ($key == $atts['active_section']){
                                        $loaded = 'loaded';
                                    }
                                    ?>
                                    <li class="<?php echo esc_attr( implode( ' ', $class_tab ) ); ?>">
                                        <?php if ( isset( $section['select_rating'] ) ) : ?>
                                            <span class="<?php echo esc_attr( $section['select_rating'] ); ?>"></span>
                                        <?php endif; ?>
                                        <a class="<?php echo esc_attr($loaded); ?>"
                                           data-ajax="<?php echo esc_attr( $atts['ajax_check'] ) ?>"
                                           data-animate="<?php echo esc_attr( $atts['css_animation'] ); ?>"
                                           data-section="<?php echo esc_attr( $section['tab_id'] ); ?>"
                                           data-id="<?php echo get_the_ID(); ?>"
                                           href="#<?php echo esc_attr( $section_id ); ?>">
                                            <?php if ( isset( $section['title_image'] ) ) : ?>
                                                <figure>
                                                    <?php
                                                    $image_thumb = apply_filters( 'ovic_resize_image', $section['title_image'], false, false, true, true );
                                                    echo wp_specialchars_decode( $image_thumb['img'] );
                                                    ?>
                                                </figure>
                                            <?php else : ?>
                                                <?php echo esc_html($icon_html_left); ?>
                                                <span><?php echo esc_html( $section['title'] ); ?></span>
                                                <?php echo esc_html($icon_html_right); ?>
                                            <?php endif; ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="tab-container">
                            <?php foreach ( $sections as $key => $section ): ?>
                                <?php
                                $section_id = $section['tab_id'] . '-' . $rand;
                                $active_tab = array( 'tab-panel' );
                                if ( $key == $atts['active_section'] )
                                    $active_tab[] = 'active';
                                ?>
                                <div class="<?php echo esc_attr( implode( ' ', $active_tab ) ); ?>"
                                     id="<?php echo esc_attr( $section_id ); ?>">
                                    <?php if ( $atts['ajax_check'] == '1' ) :
                                        echo esc_attr( $key ) == $atts['active_section'] ? do_shortcode( $section['content'] ) : '';
                                    else :
                                        echo do_shortcode( $section['content'] );
                                    endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
            <?php
            return apply_filters( 'Ovic_Shortcode_Tabs', ob_get_clean(), $atts, $content );
        }
    }

    new Ovic_Shortcode_Tabs();
}