<?php
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Ovic Products Slide
 *
 * Displays Products Slide widget.
 *
 * @author   Khanh
 * @category Widgets
 * @package  Ovic/Widgets
 * @version  1.0.0
 * @extends  OVIC_Widget
 */
if ( class_exists( 'OVIC_Widget' ) ) {
	if ( !class_exists( 'Twitter_Widget' ) ) {
		class Twitter_Widget extends OVIC_Widget
		{
			/**
			 * Constructor.
			 */
			public function __construct()
			{
				$array_settings           = apply_filters( 'ovic_filter_settings_widget_twitter',
					array(
						'title'    => array(
							'type'  => 'text',
							'title' => esc_html__( 'Title', 'biolife' ),
						),
                        'access_token'    => array(
                            'type'  => 'text',
                            'title' => esc_html__( 'Access token', 'biolife' ),
                        ),
                        'access_token_secret'    => array(
                            'type'  => 'text',
                            'title' => esc_html__( 'Access token secret', 'biolife' ),
                        ),
                        'consumer_key'    => array(
                            'type'  => 'text',
                            'title' => esc_html__( 'Consumer key', 'biolife' ),
                        ),
                        'consumer_secret'    => array(
                            'type'  => 'text',
                            'title' => esc_html__( 'Consumer secret', 'biolife' ),
                        ),
                        'screen_name'    => array(
                            'type'  => 'text',
                            'title' => esc_html__( 'Screen name', 'biolife' ),
                        ),
                        'limit'    => array(
                            'type'  => 'text',
                            'title' => esc_html__( 'Limit', 'biolife' ),
                        ),
					)
				);
				$this->widget_cssclass    = 'widget-twitter';
				$this->widget_description = esc_html__( 'Display twitter feeds.', 'biolife' );
				$this->widget_id          = 'widget_twitter';
				$this->widget_name        = esc_html__( 'Ovic: Twitter Feeds', 'biolife' );
				$this->settings           = $array_settings;
				parent::__construct();
			}

			/**
			 * Output widget.
			 *
			 * @see WP_Widget
			 *
			 * @param array $args
			 * @param array $instance
			 */
			public function widget( $args, $instance )
			{
				$this->widget_start( $args, $instance );

				if (!$instance['access_token'] || !$instance['access_token_secret'] || !$instance['consumer_key'] || !$instance['consumer_secret'] || !$instance['screen_name'] || !$instance['limit'])
				    return '';
                $twitter_url = 'statuses/user_timeline.json';
                $twitter_url .= '?screen_name=' . $instance['screen_name'];
                $twitter_url .= '&count=' . $instance['limit'];
                $twitter_proxy = new TwitterProxy(
                    $instance['access_token'],			// 'Access token' on https://apps.twitter.com
                    $instance['access_token_secret'],		// 'Access token secret' on https://apps.twitter.com
                    $instance['consumer_key'],					// 'API key' on https://apps.twitter.com
                    $instance['consumer_secret'],				// 'API secret' on https://apps.twitter.com
                    $instance['screen_name'],					// Twitter handle
                    $instance['limit']							// The number of tweets to pull out
                );
                $tweets = $twitter_proxy->get($twitter_url);
                if ($tweets)
                    $tweets = json_decode($tweets, true);
                else
                    return '';
				ob_start();
				?>
                <div>
                    <?php foreach ($tweets as $tweet): ?>
                        <div class="tweet">
                            <div class="tweet-avatar">
                                <?php if (is_ssl()): ?>
                                    <img src="<?php echo esc_url($tweet['user']['profile_image_url_https']) ?>" alt="<?php echo esc_attr($tweet['user']['name']) ?>" />
                                <?php else: ?>
                                    <img src="<?php echo esc_url($tweet['user']['profile_image_url']) ?>" alt="<?php echo esc_attr($tweet['user']['name']) ?>" />
                                <?php endif; ?>
                            </div>
                            <div class="tweet-info">
                                <div class="tweet-name">
                                    <span class="name"><?php echo esc_html($tweet['user']['name']) ?></span>&nbsp;@<span class="screen_name"><?php echo esc_html($tweet['user']['screen_name']) ?></span>
                                </div>
                                <div class="tweet-text">
                                    <?php echo wp_trim_words($tweet['text'], 10, '...'); ?>
                                </div>
                                <div class="tweet-source">
                                    <?php echo wp_specialchars_decode($tweet['source']); ?>
                                </div>
                                <div class="tweet-follow">
                                    <span class="tweet-com">
                                        <i class="tweet-com-icon fa fa-comment"></i>
                                        <span class="tweet-total-com"><?php echo esc_html($tweet['retweet_count']); ?></span>
                                    </span>
                                    <span class="tweet-like">
                                        <i class="tweet-like-icon fa fa-heart"></i>
                                        <span class="tweet-total-like"><?php echo esc_html($tweet['favorite_count']); ?></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <div class="tweet-all">
                        <a href="https://twitter.com/<?php echo esc_attr($instance['screen_name']) ?>"><?php echo esc_html__('View all', 'biolife') ?></a>
                    </div>
                </div>
				<?php
				echo apply_filters( 'ovic_filter_widget_twitter', ob_get_clean(), $instance );
				$this->widget_end( $args );
			}
		}
	}
	/**
	 * Register Widgets.
	 *
	 * @since 2.3.0
	 */
	function Twitter_Widget_Widget()
	{
		register_widget( 'Twitter_Widget' );
	}

	add_action( 'widgets_init', 'Twitter_Widget_Widget' );
}