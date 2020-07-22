<?php
if ( !class_exists( 'Ovic_Shortcode_Twitter' ) ) {
	class Ovic_Shortcode_Twitter extends Ovic_Shortcode
	{
		/**
		 * Shortcode name.
		 *
		 * @var  string
		 */
		public $shortcode = 'twitter';


		public function output_html( $atts, $content = null )
		{
			$atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'ovic_twitter', $atts ) : $atts;
			// Extract shortcode parameters.
            $css_animation = $el_class = $access_token = $access_token_secret = $consumer_key = $consumer_secret = $screen_name = $limit = $title = $layout = '';
			extract( $atts );
			$css_class        = array( 'ovic-twitter', $layout, $el_class, biolife_getCSSAnimation( $css_animation ) );
			$class_editor     = isset( $atts['css'] ) ? vc_shortcode_custom_css_class( $atts['css'], ' ' ) : '';
			$css_class[]      = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_editor, 'ovic_twitter', $atts );

			$twitter_url = 'statuses/user_timeline.json';
            $twitter_url .= '?screen_name=' . $screen_name;
            $twitter_url .= '&count=' . $limit;

            $twitter_proxy = new TwitterProxy(
                $access_token,			// 'Access token' on https://apps.twitter.com
                $access_token_secret,		// 'Access token secret' on https://apps.twitter.com
                $consumer_key,					// 'API key' on https://apps.twitter.com
                $consumer_secret,				// 'API secret' on https://apps.twitter.com
                $screen_name,					// Twitter handle
                $limit							// The number of tweets to pull out
            );
            $tweets = $twitter_proxy->get($twitter_url);
            if ($tweets)
                $tweets = json_decode($tweets, true);
            else
                return '';


            $owl_settings         = apply_filters( 'ovic_carousel_data_attributes', 'owl_', $atts );

			ob_start();
			if ( $layout == 'style1' ) : ?>

            <?php else: ?>
                <div class="<?php echo esc_attr( implode( ' ', $css_class ) ); ?>">
                    <?php if ($title): ?>
                        <h3 class="box-title"><?php echo esc_html($title); ?></h3>
                    <?php endif; ?>
                    <div class="box-content ovic-twitter-owl owl-slick equal-container better-height <?php echo esc_attr($atts['owl_navigation_style']); ?>" <?php echo esc_attr( $owl_settings ); ?>>
                        <?php  foreach ($tweets as $tweet): ?>
                            <div class="tweet equal-elem <?php echo esc_attr($atts['owl_rows_space']); ?>">
                                <div class="tweet-info">
                                    <i class="tweet-icon fa fa-twitter"></i>
                                    <div>
                                        <div class="tweet-name">
                                            <a href="<?php echo esc_url($tweet['user']['url']) ?>" target="_blank"><?php echo esc_html($tweet['user']['name']) ?></a>
                                        </div>
                                        <div class="tweet-screen_name">@<?php echo esc_html($tweet['user']['screen_name']) ?></div>
                                    </div>
                                </div>
                                <div class="tweet-text">
                                    <?php echo wp_trim_words($tweet['text'], 22, '...'); ?>
                                </div>
                                <div class="tweet-source">
                                    <?php echo wp_specialchars_decode($tweet['source']); ?>
                                </div>
                                <div class="tweet-titme">
                                    <?php echo date("h:i A - M d, Y", strtotime($tweet['created_at']));?>
                                </div>
                            </div>
                        <?php endforeach;  ?>
                    </div>
                </div>
			<?php endif;
			return apply_filters( 'Ovic_Shortcode_Twitter', ob_get_clean(), $atts, $content );
		}
	}

	new Ovic_Shortcode_Twitter();
}

