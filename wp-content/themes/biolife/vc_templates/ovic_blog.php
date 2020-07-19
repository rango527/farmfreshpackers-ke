<?php
if ( !defined( 'ABSPATH' ) ) {
    die( '-1' );
}
/**
 * Shortcode attributes
 * @var $atts
 * Shortcode class
 * @var $this "Ovic_Blog"
 */
if ( !class_exists( 'Ovic_Shortcode_Blog' ) ) {
    class Ovic_Shortcode_Blog extends Ovic_Shortcode
    {
        /**
         * Shortcode name.
         *
         * @var  string
         */
        public $shortcode = 'blog';

        static public function add_css_generate( $atts )
        {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'ovic_blog', $atts ) : $atts;
            // Extract shortcode parameters.
            extract( $atts );
            $css = '';

            return apply_filters( 'Ovic_Shortcode_Blog_css', $css, $atts );
        }

        public function output_html( $atts, $content = null )
        {
            $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'ovic_blog', $atts ) : $atts;
            $css_animation = $link = $layout = '';
            extract( $atts );
            $css_class    = array( 'ovic-blog', biolife_getCSSAnimation( $css_animation )  );
            if($layout){
                $css_class[]  = 'ovic-blog-'.$layout;
            }
            $css_class[]  = isset( $atts['blog_style'] ) ? $atts['blog_style'] : '';
            $css_class[]  = $atts['el_class'];
            $class_editor = isset( $atts['css'] ) ? vc_shortcode_custom_css_class( $atts['css'], ' ' ) : '';
            $css_class[]  = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'ovic_blog', $atts );
            /* START */
            $i            = 0;
            $class_item   = array( 'blog-item' );
            $class_slide  = array( 'owl-slick blog-list-owl equal-container better-height' );
            $data_loop    = vc_build_loop_query( $atts['loop'] )[1];
            $total_post   = $data_loop->post_count;
            $owl_settings = apply_filters( 'ovic_carousel_data_attributes', 'owl_', $atts );
            if ( $atts['owl_navigation_style'] )
                $class_slide[] = $atts['owl_navigation_style'];
            if ( $atts['owl_rows_space'] )
                $class_item[] = $atts['owl_rows_space'];
            $css_class[] = ( function_exists( 'ovic_generate_class_nav' ) ) ? ovic_generate_class_nav( 'owl_', $atts, $total_post ) : '';
            if($link){
                $link = vc_build_link( $atts['link'] );
            }else{
                $link = array('title'  => '', 'url'    => '', 'target' => '_self');
            }
            ob_start(); ?>
            <?php if ($layout == 'style1'): ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <div class="title-container">
                        <?php if($atts['sub_title']): ?>
                            <div class="sub_title"><?php echo esc_html($atts['sub_title']); ?></div>
                        <?php endif; ?>
                        <?php
                        if ( $atts['blog_title'] )
                            $this->ovic_title_shortcode( $atts['blog_title'] );
                        ?>
                    </div>
                    <?php if ( $data_loop->have_posts() ) : ?>
                        <div class="<?php echo esc_attr( implode( ' ', $class_slide ) ); ?>" <?php echo esc_attr( $owl_settings ); ?>>
                            <?php while ( $data_loop->have_posts() ) : $data_loop->the_post();
                                $class_item_position = $class_item;
                                $position = ( $i % 2 == 0 ) ? 'left' : 'right' ;
                                $i++;
                                $class_item_position[] = $position;
                                $class_item_position = apply_filters( 'ovic_template_blog_class', $class_item_position, $atts );
                                ?>
                                <article <?php post_class( $class_item_position ); ?>>
                                    <div class="blog-inner">
                                        <?php do_action( 'get_template_blog', $atts['blog_style'] ); ?>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>
                    <?php else :
                        get_template_part( 'content', 'none' );
                    endif; ?>
                </div>
            <?php elseif ($layout == 'style2'): ?>
            <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                <?php if (!$link['title']) $link['title'] = esc_html__('View All Articles', 'biolife'); ?>
                <?php if($atts['blog_title']): ?>
                    <div class="title">
                        <span><?php echo esc_html($atts['blog_title']); ?></span>
                        <?php if ($link['url']): ?>
                            <a href="<?php echo esc_url($link['url']) ?>" <?php if ($link['target']):  ?>target="<?php echo esc_attr( $link['target'] ); ?>"<?php endif; ?>><?php echo esc_html($link['title']) ?></a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if ( $data_loop->have_posts() ) : ?>
                    <div class="<?php echo esc_attr( implode( ' ', $class_slide ) ); ?>" <?php echo esc_attr( $owl_settings ); ?>>
                        <?php while ( $data_loop->have_posts() ) : $data_loop->the_post();
                            if ( $i % 2 == 0 ) {
                                $class_item[] = 'left';
                            } else {
                                $class_item[] = 'right';
                            }
                            $i++;
                            $class_item = apply_filters( 'ovic_template_blog_class', $class_item, $atts );
                            ?>
                            <article <?php post_class( $class_item ); ?>>
                                <div class="blog-inner">
                                    <?php do_action( 'get_template_blog', $atts['blog_style'] ); ?>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>
                <?php else :
                    get_template_part( 'content', 'none' );
                endif; ?>
            </div>
            <?php else: ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <?php
                    if ( $atts['blog_title'] )
                        $this->ovic_title_shortcode( $atts['blog_title'] );
                    ?>
                    <?php if ( $data_loop->have_posts() ) : ?>
                        <div class="<?php echo esc_attr( implode( ' ', $class_slide ) ); ?>" <?php echo esc_attr( $owl_settings ); ?>>
                            <?php while ( $data_loop->have_posts() ) : $data_loop->the_post();
                                if ( $i % 2 == 0 ) {
                                    $class_item[] = 'left';
                                } else {
                                    $class_item[] = 'right';
                                }
                                $i++;
                                $class_item = apply_filters( 'ovic_template_blog_class', $class_item, $atts );
                                ?>
                                <article <?php post_class( $class_item ); ?>>
                                    <div class="blog-inner">
                                        <?php do_action( 'get_template_blog', $atts['blog_style'] ); ?>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>
                    <?php else :
                        get_template_part( 'content', 'none' );
                    endif; ?>
                </div>
            <?php endif; ?>

            <?php
            $array_filter = array(
                'carousel' => $owl_settings,
                'query'    => $data_loop,
            );
            wp_reset_postdata();
            $html = ob_get_clean();

            return apply_filters( 'Ovic_Shortcode_Blog', $html, $atts, $content, $array_filter );
        }
    }

    new Ovic_Shortcode_Blog();
}