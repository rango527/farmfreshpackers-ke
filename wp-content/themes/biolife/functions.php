<?php
if ( !isset($content_width) ) {
    $content_width = 900;
}
if ( !class_exists('Biolife_Functions') ) {
    class  Biolife_Functions
    {
        /**
         * @var Biolife_Functions The one true Biolife_Functions
         * @since 1.0
         */
        private static $instance;

        public static function instance()
        {
            if ( !isset(self::$instance) && !( self::$instance instanceof Biolife_Functions ) ) {
                self::$instance = new Biolife_Functions;
            }
            define('OVIC_ACTIVE_VER', true);
            add_action('after_setup_theme', array( self::$instance, 'setups' ));
            add_action('wp_enqueue_scripts', array( self::$instance, 'scripts' ));
            add_action('admin_enqueue_scripts', array( self::$instance, 'admin_scripts' ), 999);
            add_filter('get_default_comment_status', array( self::$instance, 'open_default_comments_for_page' ), 10, 3);
            add_action('widgets_init', array( self::$instance, 'register_widgets' ));
            if ( !has_filter('ovic_resize_image') ) {
                add_filter('ovic_resize_image', array( self::$instance, 'ovic_resize_image' ), 10, 5);
            }
            add_filter('body_class', array( self::$instance, 'body_class' ));
            self::includes();

            return self::$instance;
        }

        function body_class( $classes )
        {
            $my_theme     = wp_get_theme();
            $classes[]    = $my_theme->get('Name') . "-" . $my_theme->get('Version');
            $catalog_mode = Biolife_Functions::get_option('biolife_catalog_mode');
            if ( $catalog_mode == 1 ) {
                $classes[] = 'enable-catalog';
            }
            if ( !class_exists('Ovic_Toolkit') ) {
                $classes[] = 'no-ovic-toolkit';
            }

            return $classes;
        }

        public function setups()
        {
            $this->load_theme_textdomain();
            $this->theme_support();
            $this->register_nav_menus();
        }

        public function theme_support()
        {
            add_theme_support('html5',
                array(
                    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
                )
            );
            add_theme_support('ovic-theme-option');
            add_theme_support('automatic-feed-links');
            add_theme_support('title-tag');
            add_theme_support('post-thumbnails');
            set_post_thumbnail_size(870, 635, true);
            // Add support for Block Styles.
            add_theme_support('wp-block-styles');
            // Add support for full and wide align images.
            add_theme_support('align-wide');
            // Add support for editor styles.
            add_theme_support('editor-styles');
            // Enqueue editor styles.
            add_editor_style(
                array(
                    'style-editor.css',
                    self::google_fonts(),
                )
            );
            // Add support for responsive embedded content.
            add_theme_support('responsive-embeds');
            // Add theme support for selective refresh for widgets.
            add_theme_support('customize-selective-refresh-widgets');
            /*Support woocommerce*/
            add_theme_support('woocommerce',
                array(
                    'gallery_thumbnail_image_width' => 100,
                )
            );
            add_theme_support('woocommerce');
            add_theme_support('wc-product-gallery-lightbox');
            add_theme_support('wc-product-gallery-slider');
            add_theme_support('wc-product-gallery-zoom');
            add_theme_support('ovic-footer-builder');
        }

        public function load_theme_textdomain()
        {
            load_theme_textdomain('biolife', get_template_directory() . '/languages');
        }

        public function register_nav_menus()
        {
            register_nav_menus(array(
                    'primary'                  => esc_html__('Primary Menu', 'biolife'),
                    'vertical_menu'            => esc_html__('Vertical Menu', 'biolife'),
                    'top_left_menu'            => esc_html__('Top Left Menu', 'biolife'),
                    'top_right_menu'           => esc_html__('Top Right Menu', 'biolife'),
                    'top_menu'                 => esc_html__('Top Menu', 'biolife'),
                    'search_menu'              => esc_html__('Search Menu', 'biolife'),
                    'language_menu'            => esc_html__('Menu Language', 'biolife'),
                    'top_menu_header_11'       => esc_html__('Top Menu Header 11', 'biolife'),
                    'top_left_menu_header_12'  => esc_html__('Top Left Menu Header 12', 'biolife'),
                    'top_right_menu_header_12' => esc_html__('Top Right Menu Header 12', 'biolife'),
                    'top_left_menu_header_13'  => esc_html__('Top Left Menu Header 13', 'biolife'),
                    'top_right_menu_header_13' => esc_html__('Top Right Menu Header 13', 'biolife'),
                )
            );
        }

        public function register_widgets()
        {
            register_sidebar(array(
                    'name'          => esc_html__('Widget Area', 'biolife'),
                    'id'            => 'widget-area',
                    'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'biolife'),
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h2 class="widgettitle">',
                    'after_title'   => '<span class="arrow"></span></h2>',
                )
            );
            register_sidebar(array(
                    'name'          => esc_html__('Shop Widget Area', 'biolife'),
                    'id'            => 'shop-widget-area',
                    'description'   => esc_html__('Add widgets here to appear in your sidebar.', 'biolife'),
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget'  => '</div>',
                    'before_title'  => '<h2 class="widgettitle">',
                    'after_title'   => '<span class="arrow"></span></h2>',
                )
            );
        }

        public function google_fonts()
        {
            $font_families   = array();
            $font_families[] = 'Cairo:300,400,600,700,900';
            $font_families[] = 'Roboto:400,400i,500,500i';
            $font_families[] = 'Playfair Display:400,400i,700,700i';
            $font_families[] = 'Poppins:300,400,500,600,700';
            $font_families[] = 'Lato:400,700';
            $font_families[] = 'Pacifico:400';
            $query_args      = array(
                'family' => urlencode(implode('|', $font_families)),
                'subset' => urlencode('latin,latin-ext'),
            );
            $fonts_url       = add_query_arg($query_args, 'https://fonts.googleapis.com/css');

            return esc_url_raw($fonts_url);
        }

        function admin_scripts()
        {
            wp_enqueue_style('flaticons', get_theme_file_uri('/assets/fonts/flaticon/flaticon.css'), array(), '1.0');
            wp_enqueue_style('font-awesomes', get_theme_file_uri('/assets/fonts/font-awesome/font-awesome.min.css'),
                array(), '1.0');
        }

        public function scripts()
        {
            // Load fonts
            wp_enqueue_style('biolife-googlefonts', $this->google_fonts(), array(), null);
            wp_enqueue_style('bootstrap', get_theme_file_uri('/assets/css/bootstrap.min.css'), array(), '1.0');
            wp_enqueue_style('flaticon', get_theme_file_uri('/assets/fonts/flaticon/flaticon.css'), array(), '1.0');
            wp_enqueue_style('font-awesome', get_theme_file_uri('/assets/fonts/font-awesome/font-awesome.min.css'),
                array(), '1.0');
            wp_enqueue_style('gurtenberg', get_theme_file_uri('/assets/css/gurtenberg.css'), array(), '1.0');
            wp_enqueue_style('style', get_theme_file_uri('/assets/css/style.css'), array(), '1.0');
            wp_enqueue_style('biolife-main', get_stylesheet_uri());
            if ( is_singular() && comments_open() && get_option('thread_comments') ) {
                wp_enqueue_script('comment-reply');
            }
            wp_enqueue_script('jquery-sticky', get_template_directory_uri() . '/assets/js/jquery.sticky.min.js',
                array( 'jquery' ), '1.0.4', true);
            wp_enqueue_script('bootstrap', get_theme_file_uri('/assets/js/bootstrap.min.js'), array(), '3.3.7', true);
            wp_enqueue_script('biolife-main', get_theme_file_uri('/assets/js/functions.js'), array( 'jquery' ), '1.0',
                true);
            if ( is_rtl() ) {
                wp_enqueue_style('bootstrap-rtl',
                    trailingslashit(get_template_directory_uri()) . 'assets/css/bootstrap-rtl.min.css', array(), '2.4');
                wp_enqueue_style('biolife-rtl',
                    trailingslashit(get_template_directory_uri()) . '/assets/css/style-rtl.css', array(), '1.0');
            }
            $enable_sticky_menu = $this->get_option('ovic_sticky_menu');
            $is_toolkit         = '1';
            if ( !class_exists('Ovic_Toolkit') ) {
                $is_toolkit = '0';
            }
            wp_localize_script('biolife-main', 'biolife_global_frontend',
                array(
                    'ovic_sticky_menu' => $enable_sticky_menu,
                    'ajaxurl'          => admin_url('admin-ajax.php'),
                    'day_text'         => esc_html__('Days', 'biolife'),
                    'hrs_text'         => esc_html__('Hrs', 'biolife'),
                    'mins_text'        => esc_html__('Mins', 'biolife'),
                    'secs_text'        => esc_html__('Secs', 'biolife'),
                    'is_toolkit'       => $is_toolkit,
                )
            );
        }

        public static function get_option( $key, $default = '' )
        {
            if ( has_filter('ovic_get_option') ) {
                return apply_filters('ovic_get_option', $key, $default);
            }

            return $default;
        }

        public static function get_post_meta( $post_id, $key, $default )
        {
            $value = get_post_meta($post_id, $key, true);
            if ( $value != "" ) {
                return $value;
            }

            return $default;
        }

        function ovic_resize_image( $attach_id, $width, $height, $crop = false, $use_lazy = false )
        {
            $size      = $width . 'x' . $height;
            $image_alt = get_the_title();
            if ( $attach_id ) {
                $image_src = wp_get_attachment_image_src($attach_id, $size);
                $image_alt = get_post_meta($attach_id, '_wp_attachment_image_alt', true);
                $vt_image  = array(
                    'url'    => $image_src[0],
                    'width'  => $image_src[1],
                    'height' => $image_src[2],
                    'img'    => '<img class="img-responsive" src="' . esc_url($image_src[0]) . '" ' . image_hwstring($image_src[1],
                            $image_src[2]) . ' alt="' . esc_attr($image_alt) . '">',
                );
            } else {
                $vt_image = array(
                    'url'    => '//via.placeholder.com/' . $width . 'x' . $height,
                    'width'  => $width,
                    'height' => $height,
                    'img'    => '<img class="img-responsive" src="' . esc_url('//via.placeholder.com/' . $width . 'x' . $height) . '" ' . image_hwstring($width,
                            $height) . ' alt="' . esc_attr($image_alt) . '">',
                );
            }

            return $vt_image;
        }

        /**
         * Filter whether comments are open for a given post type.
         *
         * @param  string  $status  Default status for the given post type,
         *                             either 'open' or 'closed'.
         * @param  string  $post_type  Post type. Default is `post`.
         * @param  string  $comment_type  Type of comment. Default is `comment`.
         *
         * @return string (Maybe) filtered default status for the given post type.
         */
        function open_default_comments_for_page( $status, $post_type, $comment_type )
        {
            if ( 'page' == $post_type ) {
                return 'open';
            }

            return $status;
            /*You could be more specific here for different comment types if desired*/
        }

        function not_toolkit_style()
        {
            wp_enqueue_style('ovic-style', get_theme_file_uri('/assets/css/no-toolkit/frontend.min.css'), array(),
                '1.0');
            wp_enqueue_style('mobile-menu-style', get_theme_file_uri('/assets/css/no-toolkit/mobile-menu.css'), array(),
                '1.0');
            wp_enqueue_script('countdown', get_theme_file_uri('/assets/js/no-toolkit/countdown.min.js'), array(),
                '1.0.0', true);
            wp_enqueue_script('ovic-script', get_theme_file_uri('/assets/js/no-toolkit/frontend.min.js'), array(),
                '1.0.0', true);
            wp_enqueue_script('mobile-menu', get_theme_file_uri('/assets/js/no-toolkit/mobile-menu.js'), array(),
                '1.0.0', true);
            $single_add_to_cart = biolife_get_option('ovic_ajax_add_to_cart');
            $single_thumbnail   = biolife_get_option('ovic_single_product_thumbnail', 'vertical');
            $atts               = array(
                'owl_loop'         => false,
                'owl_slide_margin' => 10,
                'owl_focus_select' => true,
                'owl_ts_items'     => biolife_get_option('ovic_product_thumbnail_ts_items', 2),
                'owl_xs_items'     => biolife_get_option('ovic_product_thumbnail_xs_items', 2),
                'owl_sm_items'     => biolife_get_option('ovic_product_thumbnail_sm_items', 3),
                'owl_md_items'     => biolife_get_option('ovic_product_thumbnail_md_items', 3),
                'owl_lg_items'     => biolife_get_option('ovic_product_thumbnail_lg_items', 3),
                'owl_ls_items'     => biolife_get_option('ovic_product_thumbnail_ls_items', 3),
            );
            if ( $single_thumbnail == 'vertical' ) {
                $atts['owl_vertical']            = true;
                $atts['owl_responsive_vertical'] = 768;
            }
            $atts             = apply_filters('ovic_thumb_product_single_slide', $atts);
            $owl_settings     = explode(' ', apply_filters('ovic_carousel_data_attributes', 'owl_', $atts));
            $slick_data       = isset($owl_settings[3]) ? $owl_settings[3] : '';
            $slick_responsive = isset($owl_settings[6]) ? $owl_settings[6] : '';
            wp_localize_script('ovic-script', 'ovic_ajax_frontend', array(
                    'ajaxurl'                         => admin_url('admin-ajax.php', 'relative'),
                    'ovic_ajax_url'                   => class_exists('OVIC_AJAX') ? OVIC_AJAX::get_endpoint('%%endpoint%%') : admin_url('admin-ajax.php',
                        'relative'),
                    'security'                        => wp_create_nonce('ovic_ajax_frontend'),
                    'added_to_cart_notification_text' => apply_filters('tools_added_to_cart_notification_text',
                        esc_html__('has been added to cart!', 'biolife')),
                    'view_cart_notification_text'     => apply_filters('tools_view_cart_notification_text',
                        esc_html__('View Cart', 'biolife')),
                    'added_to_cart_text'              => apply_filters('tools_adding_to_cart_text',
                        esc_html__('Product has been added to cart!', 'biolife')),
                    'wc_cart_url'                     => ( function_exists('wc_get_cart_url') ? esc_url(wc_get_cart_url()) : '' ),
                    'added_to_wishlist_text'          => get_option('yith_wcwl_product_added_text',
                        esc_html__('Product has been added to wishlist!', 'biolife')),
                    'wishlist_url'                    => ( function_exists('YITH_WCWL') ? esc_url(YITH_WCWL()->get_wishlist_url()) : '' ),
                    'browse_wishlist_text'            => get_option('yith_wcwl_browse_wishlist_text',
                        esc_html__('Browse Wishlist', 'biolife')),
                    'growl_notice_text'               => esc_html__('Notice!', 'biolife'),
                    'growl_duration'                  => 6000,
                    'removed_cart_text'               => esc_html__('Product Removed', 'biolife'),
                    'wp_nonce_url'                    => ( function_exists('wc_get_cart_url') ? wp_nonce_url(wc_get_cart_url()) : '' ),
                    'data_slick'                      => urldecode($slick_data),
                    'data_responsive'                 => urldecode($slick_responsive),
                    'single_add_to_cart'              => $single_add_to_cart,
                )
            );
        }

        public static function includes()
        {
            require_once get_parent_theme_file_path('/framework/classes/class-tgm-plugin-activation.php');
            require_once get_parent_theme_file_path('/framework/settings/theme-options.php');
            require_once get_parent_theme_file_path('/framework/settings/meta-box.php');
            require_once get_parent_theme_file_path('/framework/settings/plugins-load.php');
            require_once get_parent_theme_file_path('/framework/settings/custom-css.php');
            require_once get_parent_theme_file_path('/framework/theme-functions.php');
            if ( class_exists('Ovic_Toolkit') ) {
                require_once get_parent_theme_file_path('/framework/widgets/widget-twitter.php');
                // require_once get_parent_theme_file_path( '/import/import.php' );
                /* widget */
                require_once get_parent_theme_file_path('/framework/widgets/widget-recent-blog.php');
                if ( class_exists('Vc_Manager') ) {
                    require_once get_parent_theme_file_path('/framework/vc-functions.php');
                }
                if ( class_exists('WooCommerce') ) {
                    require_once get_parent_theme_file_path('/framework/woo-functions.php');
                    require_once get_parent_theme_file_path('/framework/widgets/widget-product-slide.php');
                }
                // add_filter('ovic_filter_content_footer', 'biolife_filter_content_footer', 10, 3);
            } else {
                add_filter('ovic_get_option', 'biolife_get_option', 10, 2);
                add_action('wp_footer', 'biolife_footer_content');
                add_action('wp_enqueue_scripts', array( self::$instance, 'not_toolkit_style' ));
                if ( class_exists('WooCommerce') ) {
                    require_once get_parent_theme_file_path('/woocommerce/template-functions.php');
                    require_once get_parent_theme_file_path('/woocommerce/template-hook.php');
                }
            }
        }
    }
}
if ( !class_exists('TwitterProxy') ) {
    class TwitterProxy
    {
        /**
         * The tokens, keys and secrets from the app you created at https://dev.twitter.com/apps
         */
        private $config = [
            'use_whitelist' => true, // If you want to only allow some requests to use this script.
            'base_url'      => 'https://api.twitter.com/1.1/',
        ];
        /**
         * Only allow certain requests to twitter. Stop randoms using your server as a proxy.
         */
        private $whitelist = [];

        /**
         * @param  string  $oauth_access_token  OAuth Access Token            ('Access token' on https://apps.twitter.com)
         * @param  string  $oauth_access_token_secret  OAuth Access Token Secret    ('Access token secret' on https://apps.twitter.com)
         * @param  string  $consumer_key  Consumer key                ('API key' on https://apps.twitter.com)
         * @param  string  $consumer_secret  Consumer secret                ('API secret' on https://apps.twitter.com)
         * @param  string  $user_id  User id (http://gettwitterid.com/)
         * @param  string  $screen_name  Twitter handle
         * @param  string  $count  The number of tweets to pull out
         */
        public function __construct(
            $oauth_access_token,
            $oauth_access_token_secret,
            $consumer_key,
            $consumer_secret,
            $screen_name,
            $count = 5
        ) {
            $this->config                                                                                                                    = array_merge($this->config,
                compact('oauth_access_token', 'oauth_access_token_secret', 'consumer_key', 'consumer_secret',
                    'screen_name', 'count'));
            $this->whitelist['statuses/user_timeline.json?screen_name=' . $this->config['screen_name'] . '&count=' . $this->config['count']] = true;
            $this->whitelist['statuses/home_timeline.json?screen_name=' . $this->config['screen_name'] . '&count=' . $this->config['count']] = true;
        }

        private function buildBaseString( $baseURI, $method, $params )
        {
            $r = [];
            ksort($params);
            foreach ( $params as $key => $value ) {
                $r[] = "$key=" . rawurlencode($value);
            }

            return $method . "&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
        }

        private function buildAuthorizationHeader( $oauth )
        {
            $r      = 'OAuth ';
            $values = [];
            foreach ( $oauth as $key => $value ) {
                $values[] = "$key=\"" . rawurlencode($value) . "\"";
            }
            $r .= implode(', ', $values);

            return $r;
        }

        public function get( $url )
        {
            if ( !isset($url) ) {
                die('No URL set');
            }
            if ( $this->config['use_whitelist'] && !isset($this->whitelist[$url]) ) {
                die('URL is not authorised');
            }
            // Figure out the URL parameters
            $url_parts = parse_url($url);
            parse_str($url_parts['query'], $url_arguments);
            $full_url = $this->config['base_url'] . $url;               // URL with the query on it
            $base_url = $this->config['base_url'] . $url_parts['path']; // URL without the query
            // Set up the OAuth Authorization array
            $oauth                    = [
                'oauth_consumer_key'     => $this->config['consumer_key'],
                'oauth_nonce'            => time(),
                'oauth_signature_method' => 'HMAC-SHA1',
                'oauth_token'            => $this->config['oauth_access_token'],
                'oauth_timestamp'        => time(),
                'oauth_version'          => '1.0',
            ];
            $base_info                = $this->buildBaseString($base_url, 'GET', array_merge($oauth, $url_arguments));
            $composite_key            = rawurlencode($this->config['consumer_secret']) . '&' . rawurlencode($this->config['oauth_access_token_secret']);
            $oauth_signature          = hash_hmac('sha1', $base_info, $composite_key, true);
            $oauth['oauth_signature'] = call_user_func('base' . '64' . '_encode', $oauth_signature);
            $args                     = array(
                'timeout'   => 100,
                'headers'   => array( 'Authorization' => $this->buildAuthorizationHeader($oauth) ),
                'sslverify' => false,
            );
            $response                 = wp_remote_get($full_url, $args);

            return wp_remote_retrieve_body($response);
        }
    }
}
if ( !function_exists('biolife_filter_content_footer') ) {
    function biolife_filter_content_footer( $html, $footer_content, $atts )
    {
        if ( $footer_content == '' ) {
            $html = '<div class="container xx"><div style="color: #222222; font-size: 15px;">' . esc_html__('Copyright © 2018',
                    'biolife') . '&nbsp;<span style="font-size: 17px; font-weight: 600;">' . esc_html__('BioLife',
                    'biolife') . '</span>. ' . esc_html__('All rights reserved', 'biolife') . '</div></div>';
        }

        return $html;
    }
}
if ( !function_exists('biolife_footer_content') ) {
    function biolife_footer_content()
    {
        ?>
        <div class="container xxx">
            <div style="color: #222222; font-size: 15px;"><?php echo esc_html__('Copyright © 2018', 'biolife'); ?>
                <span style="font-size: 17px; font-weight: 600;"><?php echo esc_html__('BioLife',
                        'biolife'); ?></span>. <?php echo esc_html__('All rights reserved', 'biolife'); ?>
            </div>
        </div>
        <?php
    }
}
if ( !function_exists('Biolife_Functions') ) {
    function Biolife_Functions()
    {
        return Biolife_Functions::instance();
    }

    Biolife_Functions();
}
function biolife_get_option( $option_name = '', $default = '' )
{
    $cs_option = null;
    if ( defined('OVIC_CUSTOMIZE') ) {
        $cs_option = get_option(OVIC_CUSTOMIZE);
    }
    if ( isset($_GET[$option_name]) ) {
        $default                 = $_GET[$option_name];
        $cs_option[$option_name] = $_GET[$option_name];
    }
    $options = apply_filters('ovic_get_customize_option', $cs_option, $option_name, $default);
    if ( !empty($option_name) && !empty($options[$option_name]) ) {
        $option = $options[$option_name];
        if ( is_array($option) && isset($option['multilang']) && $option['multilang'] == true ) {
            if ( defined('ICL_LANGUAGE_CODE') ) {
                if ( isset($option[ICL_LANGUAGE_CODE]) ) {
                    return $option[ICL_LANGUAGE_CODE];
                }
            } else {
                $option = reset($option);
            }
        }

        return $option;
    } else {
        return ( !empty($default) ) ? $default : null;
    }
}

function biolife_getCSSAnimation( $css_animation )
{
    $output = '';
    if ( '' !== $css_animation && 'none' !== $css_animation ) {
        wp_enqueue_script('vc_waypoints');
        wp_enqueue_style('vc_animate-css');
        $output = ' wpb_animate_when_almost_visible wpb_' . $css_animation . ' ' . $css_animation;
    }

    return $output;
}