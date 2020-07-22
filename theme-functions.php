<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * HOOK BREADCRUMB
 */
add_action( 'biolife_before_content_inner', 'biolife_breadcrumb_page', 20 );
/**
 * HOOK HEADER
 */
add_action( 'biolife_header_content', 'biolife_header_content' );
add_filter( 'wp_nav_menu_items', 'biolife_top_right_menu', 10, 2 );
add_filter( 'wp_nav_menu_items', 'biolife_top_left_menu', 10, 2 );
/**
 * HOOK FOOTER
 */
add_action( 'biolife_footer', 'biolife_footer_mobile', 20 );
/**
 *
 * HOOK BLOG META
 */
add_action( 'biolife_comment_count', 'biolife_comment_count' );
add_action( 'biolife_simple_likes_button', 'biolife_simple_likes_button' );
add_action( 'biolife_share_button', 'biolife_share_button' );
add_action( 'biolife_post_author', 'biolife_post_author' );
add_action( 'biolife_post_contents', 'biolife_post_contents' );
add_action( 'biolife_post_readmore', 'biolife_post_readmore' );
add_action( 'biolife_post_tags', 'biolife_post_tags' );
/* POST INFO */
add_action( 'biolife_post_meta', 'biolife_post_meta', 20 );
add_action( 'biolife_post_info_content', 'biolife_post_title', 20 );
add_action( 'biolife_post_info_content', 'biolife_post_sticky', 25 );
add_action( 'biolife_post_info_content', 'biolife_post_contents', 30 );
add_action( 'biolife_post_info_content', 'biolife_post_readmore', 40 );
/* POST META */
add_action( 'biolife_post_meta_content', 'biolife_comment_count', 20 );
add_action( 'biolife_post_meta_content', 'biolife_simple_likes_button', 30 );
add_action( 'biolife_post_meta_content', 'biolife_share_button', 40 );
/**
 *
 * HOOK BLOG GRID, STANDARD
 */
add_action( 'biolife_after_blog_content', 'biolife_paging_nav', 10 );
add_action( 'biolife_post_content', 'biolife_post_thumbnail', 10 );
add_action( 'biolife_post_content', 'biolife_post_info', 20 );
add_action( 'biolife_post_thumbnail_style1', 'biolife_post_thumbnail_style1', 10 );
/**
 *
 * HOOK BLOG SINGLE
 */
add_action( 'biolife_single_post_content', 'biolife_post_thumbnail', 10 );
add_action( 'biolife_single_post_content', 'biolife_post_info', 20 );
add_action( 'biolife_before_full_width_inner', 'biolife_before_full_width_inner' );
add_action( 'biolife_single_post_thumbnail', 'biolife_single_post_thumbnail', 10 );
add_action( 'biolife_single_post_title', 'biolife_post_title', 10 );
add_action( 'biolife_single_post_category', 'biolife_single_post_category', 10 );
add_action( 'biolife_post_single_category2', 'biolife_post_single_category2', 10 );
add_action( 'biolife_single_post_date', 'biolife_single_post_date', 10 );
add_action( 'biolife_single_post_author', 'biolife_single_post_author', 10 );
add_action( 'biolife_post_single_content', 'biolife_post_single_content', 10 );
add_action( 'biolife_post_single_tags', 'biolife_post_single_tags', 10 );
add_action( 'biolife_post_single_sharing', 'biolife_post_single_sharing', 10 );
add_action( 'biolife_get_post_views', 'biolife_get_post_views', 10, 1 );
add_action( 'biolife_post_single_comment_count', 'biolife_post_single_comment_count', 10 );

if ( ! function_exists( 'biolife_get_post_views' ) ) {
	function biolife_get_post_views( $postID )
	{
		$count_key = 'ovic_post_views_count';
		$count     = get_post_meta( $postID, $count_key, true );
		if ( $count == '' ) {
			delete_post_meta( $postID, $count_key );
			add_post_meta( $postID, $count_key, '0' );
			$count = 0;
		}
		?>
        <span class="post-total-viewed">
            <i class="viewed-icon fa fa-eye"></i>
            <span class="text-value"><?php echo esc_html( $count ); ?></span>
        </span>
		<?php
	}
}
if ( ! function_exists( 'biolife_post_single_comment_count' ) ) {
	function biolife_post_single_comment_count()
	{
		?>
        <div class="comment-count">
            <i class="comment-icon fa fa-commenting"></i>
			<?php comments_number(
				esc_html__( '0', 'biolife' ),
				esc_html__( '1', 'biolife' ),
				esc_html__( '%', 'biolife' )
			);
			?>
        </div>
		<?php
	}
}
if ( ! function_exists( 'biolife_post_single_sharing' ) ) {
	function biolife_post_single_sharing( $post_id )
	{
		$enable_enable_social_blog = Biolife_Functions::get_option( 'ovic_enable_social_blog' );
		if ( $enable_enable_social_blog == 1 ): ?>
			<?php
			$share_image_url       = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
			$share_link_url        = get_permalink( $post_id );
			$share_link_title      = get_the_title();
			$share_twitter_summary = get_the_excerpt();
			$twitter               = 'https://twitter.com/share?url=' . $share_link_url . '&text=' . $share_twitter_summary;
			$facebook              = 'https://www.facebook.com/sharer.php?s=100&title=' . $share_link_title . '&url=' . $share_link_url;
			$google                = 'https://plus.google.com/share?url=' . $share_link_url . '&title=' . $share_link_title;
			$pinterest             = 'http://pinterest.com/pin/create/button/?url=' . $share_link_url . '&description=' . $share_twitter_summary . '&media=' . $share_image_url[0];
			?>
            <div class="post-socials-sharing">
                <span class="text-label"><?php echo esc_html__( 'Share:', 'biolife' ) ?></span>
                <a target="_blank" class="twitter"
                   href="<?php echo esc_url( $twitter ); ?>"
                   title="<?php echo esc_attr__( 'Twitter', 'biolife' ) ?>"
                   onclick='window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;'>
                    <span class="fa fa-twitter"></span>
                </a>
                <a target="_blank" class="facebook"
                   href="<?php echo esc_url( $facebook ); ?>"
                   title="<?php echo esc_attr__( 'Facebook', 'biolife' ) ?>"
                   onclick='window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;'>
                    <span class="fa fa-facebook-f"></span>
                </a>
                <a target="_blank" class="googleplus"
                   href="<?php echo esc_url( $google ); ?>"
                   title="<?php echo esc_attr__( 'Google+', 'biolife' ) ?>"
                   onclick='window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;'>
                    <span class="fa fa-google-plus"></span>
                </a>
                <a target="_blank" class="pinterest"
                   href="<?php echo esc_url( $pinterest ); ?>"
                   title="<?php echo esc_attr__( 'Pinterest', 'biolife' ) ?>"
                   onclick='window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;'>
                    <span class="fa fa-pinterest"></span>
                </a>
            </div>
		<?php endif;
	}
}

if ( ! function_exists( 'biolife_post_single_tags' ) ) {
	function biolife_post_single_tags()
	{
		$get_term_tag = get_the_terms( get_the_ID(), 'post_tag' );
		if ( ! is_wp_error( $get_term_tag ) && ! empty( $get_term_tag ) ) : ?>
            <div class="post-tags">
                <span class="text-label"><?php echo esc_html__( 'Tags:', 'biolife' ) ?></span>
				<?php the_tags( '', '' ); ?>
            </div>
		<?php endif;
	}
}
if ( ! function_exists( 'biolife_single_post_date' ) ) {
	function biolife_single_post_date()
	{
		?>
        <div class="post-time">

			<?php
			$archive_year  = get_the_time( 'Y' );
			$archive_month = get_the_time( 'm' );
			$archive_day   = get_the_time( 'd' );
			$time_string   = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
			$time_string   = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				get_the_date(),
				esc_attr( get_the_modified_date( 'c' ) ),
				get_the_modified_date()
			);
			printf( '<span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a>',
				_x( 'Posted on: ', 'Used before publish date.', 'biolife' ),
				esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) ),
				$time_string
			);
			?>
        </div>
		<?php
	}
}
if ( ! function_exists( 'biolife_single_post_author' ) ) {
	function biolife_single_post_author()
	{
		?>
        <div class="post-author">
            <span class="text-label"><?php echo esc_html__( 'By:', 'biolife' ) ?></span>
            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php the_author() ?></a>
        </div>
		<?php
	}
}
if ( ! function_exists( 'biolife_post_single_category2' ) ) {
	function biolife_post_single_category2()
	{
		$get_term_cat = get_the_terms( get_the_ID(), 'category' );
		if ( ! is_wp_error( $get_term_cat ) && ! empty( $get_term_cat ) ) : ?>
            <div class="post-tags post-categories">
                <span class="text-label"><?php echo esc_html__( 'Categories:', 'biolife' ) ?></span>
				<?php the_category( '<span class="hidden">&nbsp;</span>' ); ?>
            </div>
		<?php endif;
	}
}
if ( ! function_exists( 'biolife_single_post_category' ) ) {
	function biolife_single_post_category()
	{
		$get_term_cat = get_the_terms( get_the_ID(), 'category' );
		if ( ! is_wp_error( $get_term_cat ) && ! empty( $get_term_cat ) ) : ?>
            <div class="post-category">
				<?php the_category( ', ' ); ?>
            </div>
		<?php endif;
	}
}

if ( ! function_exists( 'biolife_single_post_thumbnail' ) ) {
	function biolife_single_post_thumbnail()
	{
		if ( has_post_thumbnail() ) {
			$biolife_blog_layout = Biolife_Functions::get_option( 'ovic_sidebar_blog_layout', 'left' );
			if ( $biolife_blog_layout == 'full' ) {
				$width  = 1170;
				$height = 726;
			} else {
				$width  = 870;
				$height = 635;
			}
			$thumb = '';
			$crop  = true;
			if ( has_filter( 'ovic_resize_image' ) ) {
				$image_thumb = apply_filters( 'ovic_resize_image', get_post_thumbnail_id(), $width, $height, $crop, true );
				if ( isset( $image_thumb['img'] ) && $image_thumb['img'] != "" ) {
					$thumb = $image_thumb['img'];
				}
			} else {
				$thumb = get_the_post_thumbnail();
			}
			if ( $thumb != "" ) {
				?>
                <div class="post-thumb">
					<?php
					if ( is_single() ) {
						echo wp_specialchars_decode( $thumb );
					} else {
						$permalink = apply_filters( 'ovic_shortcode_vc_link', get_permalink() );
						?>
                        <a href="<?php echo esc_url( $permalink ); ?>"><?php echo wp_specialchars_decode( $thumb ); ?></a>
						<?php
					}
					?>
                </div>
				<?php
			}
		}
	}
}

if ( ! function_exists( 'biolife_before_full_width_inner' ) ) {
	function biolife_before_full_width_inner()
	{
		global $post;

		if ( ! is_front_page() ) {
			$background_header       = 0;
			$banner_text             = '';
			$data_meta               = get_post_meta( get_the_ID(), '_custom_metabox_theme_options', true );
			$enable_theme_option     = isset( $data_meta['metabox_options_enable'] ) ? $data_meta['metabox_options_enable'] : 0;
			$background_page_options = Biolife_Functions::get_option( 'ovic_header_background', '' );
			$background_page_options = $enable_theme_option == 1 && isset( $data_meta['metabox_biolife_page_banner'] ) && $data_meta['metabox_biolife_page_banner'] != '' ? $data_meta['metabox_biolife_page_banner'] : $background_page_options;
			if ( isset( $post->post_type ) && $post->post_type == 'page' ) {
				$pages_block = apply_filters( 'ovic_get_option', 'ovic_header_background_pages_off' );
				if ( ! is_array( $pages_block ) || ! in_array( $post->ID, $pages_block ) ) {
					$background_header = $background_page_options;
					$banner_text       = $post->post_title;
				}
			} else {
				if ( is_home() ) {
					$banner_text       = single_post_title( '', false );
					$background_header = $background_page_options;
				} elseif ( is_search() ) {
					$banner_text       = get_search_query();
					$background_header = $background_page_options;
				} elseif ( is_single() ) {
					$banner_text = $post->post_title;;
					$background_header = $background_page_options;
				} else {
					if ( class_exists( 'WooCommerce' ) ) {
						if ( is_shop() ) {
							$banner_text       = woocommerce_page_title( false );
							$background_header = $background_page_options;
						} elseif ( is_product_category() ) {
							global $wp_query;
							$category = $wp_query->get_queried_object();
							if ( $category ) {
								$banner_text       = $category->name;
								$background_header = $background_page_options;
							}
						} elseif ( is_product() ) {
							$banner_text       = $post->post_title;
							$background_header = $background_page_options;
						}
					}
				}
			}
			if ( is_numeric( $background_header ) && $background_header > 0 ) {
				?>
                <div class="header-banner">
					<?php echo wp_get_attachment_image( $background_header, "full" ); ?>
					<?php if ( $banner_text ) : ?>
                        <h2> <?php echo esc_html( $banner_text ); ?> </h2>
					<?php endif; ?>
                </div>
				<?php
			}
		}
	}
}

/*add css fix compare*/
if ( ! function_exists( 'biolife_add_custom_css' ) ) {
	function biolife_add_custom_css()
	{
		echo wp_specialchars_decode( '<link rel="stylesheet" href="' . get_template_directory_uri() . '/assets/css/custom.css' . '">' );
	}
}

add_action( 'wp_head', 'biolife_add_custom_css', 99999 );
if ( ! function_exists( 'biolife_callback_comment' ) ) {
	/**
	 * watches comment template
	 *
	 * @param  array  $comment  the comment array.
	 * @param  array  $args  the comment args.
	 * @param  int  $depth  the comment depth.
	 *
	 * @since 1.0.0
	 */
	function biolife_callback_comment( $comment, $args, $depth )
	{
		if ( 'div' == $args['style'] ) {
			$tag       = 'div ';
			$add_below = 'comment';
		} else {
			$tag       = 'li ';
			$add_below = 'div-comment';
		}
		?>
        <<?php echo esc_attr( $tag ); ?><?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php echo get_comment_ID(); ?>">
        <div class="comment-body">
            <div class="comment-info">
                <div class="comment-meta">
					<?php echo get_avatar( $comment, 70 ); ?>
                    <div class="comment-name vcard">
						<?php printf( wp_kses_post( '<span class="high-light">%s</span>' ), get_comment_author_link() ); ?>
                    </div>
					<?php if ( '0' == $comment->comment_approved ) : ?>
                        <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'biolife' ); ?></em>
                        <br/>
					<?php endif; ?>
                    <a href="<?php echo esc_url( htmlspecialchars( get_comment_link( get_comment_ID() ) ) ); ?>"
                       class="comment-date">
                        <time datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo esc_html__( 'on ', 'biolife' ); ?>
                            <span class="high-light"><?php echo get_comment_date(); ?></span></time>
                    </a>
                    <span class="high-light"><?php edit_comment_link( __( 'Edit', 'biolife' ), '', '' ); ?></span>
					<?php do_action( 'ovic_comment_meta' ); ?>
                </div>
				<?php if ( 'div' != $args['style'] ): ?>
                <div id="div-comment-' . get_comment_ID() . '" class="comment-content">
					<?php endif; ?>
                    <div class="comment-text">
						<?php comment_text(); ?>
                    </div>
                    <div class="reply-content">
						<?php comment_reply_link( array_merge( $args, array(
							'add_below' => $add_below,
							'depth'     => $depth,
							'max_depth' => $args['max_depth']
						) ) ); ?>
                    </div>
					<?php if ( 'div' != $args['style'] ): ?>
                </div>
			<?php endif; ?>
            </div>
        </div>
		<?php
	}
}
if ( ! function_exists( 'biolife_get_logo' ) ) {
	function biolife_get_logo()
	{
		$logo_url  = get_template_directory_uri() . '/assets/images/logo.png';
		$logo_link = apply_filters( 'ovic_get_link_logo', get_home_url( '/' ) );
		$logo_id   = Biolife_Functions::get_option( 'ovic_logo' );
		if ( $logo_id > 0 ) {
			$logo_url = wp_get_attachment_url( $logo_id );
		}
		$data_meta           = get_post_meta( get_the_ID(), '_custom_metabox_theme_options', true );
		$enable_theme_option = isset( $data_meta['metabox_options_enable'] ) ? $data_meta['metabox_options_enable'] : 0;
		if ( $enable_theme_option == 1 && isset( $data_meta['metabox_logo'] ) && $data_meta['metabox_logo'] !== '' ) {
			$logo_url = wp_get_attachment_image_url( $data_meta['metabox_logo'], 'full' );
		}
		if ( function_exists( 'jetpack_photon_url' ) ) {
			$logo_url = jetpack_photon_url( $logo_url );
		}
		$html = '<a href="' . esc_url( $logo_link ) . '"><img alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" src="' . esc_url( $logo_url ) . '" class="_rw" /></a>';

		echo apply_filters( 'biolife_site_logo', $html );
	}
}
if ( ! function_exists( 'biolife_get_logo_mobile' ) ) {
	function biolife_get_logo_mobile()
	{
		$logo_url = get_template_directory_uri() . '/assets/images/logo-mobile.png';
		$logo_id  = Biolife_Functions::get_option( 'logo_mobile' );
		if ( $logo_id > 0 ) {
			$logo_url = wp_get_attachment_url( $logo_id );
		}
		$html = '<a href="' . esc_url( get_home_url( '/' ) ) . '"><img alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" src="' . esc_url( $logo_url ) . '" class="_rw" /></a>';
		echo apply_filters( 'biolife_site_logo', $html );
	}
}
if ( ! function_exists( 'biolife_search_form' ) ) {
	function biolife_search_form()
	{
		$data_meta           = get_post_meta( get_the_ID(), '_custom_metabox_theme_options', true );
		$enable_theme_option = isset( $data_meta['metabox_options_enable'] ) ? $data_meta['metabox_options_enable'] : 0;
		$header_options      = Biolife_Functions::get_option( 'biolife_used_header', 'style-01' );
		$header_options      = $enable_theme_option == 1 && isset( $data_meta['metabox_biolife_used_header'] ) && $data_meta['metabox_biolife_used_header'] != '' ? $data_meta['metabox_biolife_used_header'] : $header_options;
		// $header_options 	 = Biolife_Functions::get_option( 'biolife_used_header', 'style-01' );
		$selected = '';
		if ( isset( $_GET['product_cat'] ) && $_GET['product_cat'] ) {
			$selected = $_GET['product_cat'];
		}
		$args = array(
			'show_option_none'  => esc_html__( 'All Categories', 'biolife' ),
			'taxonomy'          => 'product_cat',
			'class'             => 'category-search-option',
			'hide_empty'        => 1,
			'orderby'           => 'name',
			'order'             => 'ASC',
			'tab_index'         => true,
			'hierarchical'      => true,
			'id'                => rand(),
			'name'              => 'product_cat',
			'value_field'       => 'slug',
			'selected'          => $selected,
			'option_none_value' => '0',
		);
		?>
        <div class="block-search">
            <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>"
                  class="form-search block-search ovic-live-search-form">
				<?php if ( $header_options == 'style-01' ) : ?>
					<?php if ( class_exists( 'WooCommerce' ) ): ?>
                        <input type="hidden" name="post_type" value="product"/>
                        <input type="hidden" name="taxonomy" value="product_cat">
					<?php else: ?>
                        <input type="hidden" name="post_type" value="post"/>
					<?php endif; ?>
                    <div class="form-content search-box results-search">
                        <div class="inner">
                            <input autocomplete="off" type="text" class="searchfield txt-livesearch input" name="s"
                                   value="<?php echo esc_attr( get_search_query() ); ?>"
                                   placeholder="<?php echo esc_attr__( 'Search here...', 'biolife' ); ?>">
                        </div>
                    </div>
				<?php elseif ( $header_options == 'style-09' || $header_options == 'style-12' ) : ?>
					<?php if ( class_exists( 'WooCommerce' ) ): ?>
                        <input type="hidden" name="post_type" value="product"/>
                        <input type="hidden" name="taxonomy" value="product_cat">
                        <div class="category">
							<?php wp_dropdown_categories( $args ); ?>
                        </div>
					<?php else: ?>
                        <input type="hidden" name="post_type" value="post"/>
					<?php endif; ?>
                    <div class="form-content search-box results-search">
                        <div class="inner">
                            <input autocomplete="off" type="text" class="searchfield txt-livesearch input" name="s"
                                   value="<?php echo esc_attr( get_search_query() ); ?>"
                                   placeholder="<?php echo esc_attr__( 'Search here...', 'biolife' ); ?>">
                        </div>
                    </div>
				<?php else: ?>
                    <div class="form-content search-box results-search">
                        <div class="inner">
                            <input autocomplete="off" type="text" class="searchfield txt-livesearch input" name="s"
                                   value="<?php echo esc_attr( get_search_query() ); ?>"
                                   placeholder="<?php echo esc_attr__( 'Search here...', 'biolife' ); ?>">
                        </div>
                    </div>
					<?php if ( class_exists( 'WooCommerce' ) ): ?>
                        <input type="hidden" name="post_type" value="product"/>
                        <input type="hidden" name="taxonomy" value="product_cat">
                        <div class="category">
							<?php wp_dropdown_categories( $args ); ?>
                        </div>
					<?php else: ?>
                        <input type="hidden" name="post_type" value="post"/>
					<?php endif; ?>
				<?php endif ?>
                <button type="submit" class="btn-submit">
                    <span class="flaticon-magnifying-glass"></span>
                </button>
            </form><!-- block search -->
        </div>
		<?php
	}
}
add_action( 'biolife_search_form_mobile', 'biolife_search_form_mobile' );
if ( ! function_exists( 'biolife_search_form_mobile' ) ) {
	function biolife_search_form_mobile()
	{
		$selected = '';
		if ( isset( $_GET['product_cat'] ) && $_GET['product_cat'] ) {
			$selected = $_GET['product_cat'];
		}
		$args = array(
			'show_option_none'  => esc_html__( 'All Categories', 'biolife' ),
			'taxonomy'          => 'product_cat',
			'class'             => 'category-search-option',
			'hide_empty'        => 1,
			'orderby'           => 'name',
			'order'             => 'ASC',
			'tab_index'         => true,
			'hierarchical'      => true,
			'id'                => rand(),
			'name'              => 'product_cat',
			'value_field'       => 'slug',
			'selected'          => $selected,
			'option_none_value' => '0',
		);
		?>
        <div class="block-search ab">
            <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ) ?>"
                  class="form-search block-search ovic-live-search-form">
				<?php if ( class_exists( 'WooCommerce' ) ): ?>
                    <input type="hidden" name="post_type" value="product"/>
                    <input type="hidden" name="taxonomy" value="product_cat">
                    <div class="category">
						<?php wp_dropdown_categories( $args ); ?>
                    </div>
				<?php else: ?>
                    <input type="hidden" name="post_type" value="post"/>
				<?php endif; ?>
                <div class="form-content search-box results-search">
                    <div class="inner">
                        <input autocomplete="off" type="text" class="searchfield txt-livesearch input" name="s"
                               value="<?php echo esc_attr( get_search_query() ); ?>"
                               placeholder="<?php esc_attr_e( 'Im searching for', 'biolife' ); ?>...">
                    </div>
                </div>
                <button type="submit" class="btn-submit">
                    <span class="fa fa-search" aria-hidden="true"></span>
                </button>
            </form><!-- block search -->
        </div>
		<?php
	}
}
if ( ! function_exists( 'biolife_search_form_click' ) ) {
	add_action( 'biolife_search_form_click', 'biolife_search_form_click' );
	function biolife_search_form_click()
	{
		?>
        <div class="form-search-mobile">
            <span class="icon flaticon-close close-search"></span>
			<?php biolife_search_form(); ?>
        </div>
		<?php
	}
}
if ( ! function_exists( 'biolife_ovic_user_social' ) ) {
	function biolife_ovic_user_social()
	{
		$social = Biolife_Functions::get_option( 'user_all_social' );
		?>
        <li class="socials-list">
			<?php
			if ( ! empty( $social ) ):?>
				<?php foreach ( $social as $item ) : ?>
                    <span>
                    <a href="<?php echo esc_url( $item['link_social'] ); ?>">
                        <span class="<?php echo esc_attr( $item['icon_social'] ); ?>"></span>
                    </a>
                </span>
				<?php endforeach; ?>
			<?php endif; ?>
        </li>
		<?php
	}
}
if ( ! function_exists( 'biolife_top_right_menu' ) ) {
	function biolife_top_right_menu( $items, $args )
	{
		$data_meta           = get_post_meta( get_the_ID(), '_custom_metabox_theme_options', true );
		$enable_theme_option = isset( $data_meta['metabox_options_enable'] ) ? $data_meta['metabox_options_enable'] : 0;
		$header_options      = Biolife_Functions::get_option( 'biolife_used_header', 'style-02' );
		$header_options      = $enable_theme_option == 1 && isset( $data_meta['metabox_biolife_used_header'] ) && $data_meta['metabox_biolife_used_header'] != '' ? $data_meta['metabox_biolife_used_header'] : $header_options;
		// $header_options = Biolife_Functions::get_option( 'biolife_used_header', 'style-02' );
		if ( $args->theme_location == 'top_right_menu' ) {
			$content = '';
			if ( $header_options == 'style-02' || $header_options == 'style-03' || $header_options == 'style-01' || $header_options == 'style-06' || $header_options == 'style-09' ) {
				ob_start();
				biolife_ovic_user_social();
				$content .= ob_get_clean();
			}
			ob_start();
			if ( class_exists( 'SitePress' ) ) {
				biolife_header_language();
			}
			if ( has_nav_menu( 'language_menu' ) ) {
				wp_nav_menu( array(
						'menu'            => 'language_menu',
						'theme_location'  => 'language_menu',
						'depth'           => 2,
						'container'       => '',
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => 'biolife-nav top-bar-menu language-menu',
					)
				);
			}
			$content .= ob_get_clean();
			$content .= $items;
			if ( $header_options == 'style-02' || $header_options == 'style-03' || $header_options == 'style-07' || $header_options == 'style-06' || $header_options == 'style-09' ) {
				ob_start();
				do_action( 'ovic_user_link' );

				$content .= ob_get_clean();
			}
			if ( $header_options == 'style-01' ) {
				ob_start();
				$content .= ob_get_clean();
				$content .= '<li><a class="search-click" href="#"><i class="flaticon-magnifying-glass"></i></a></li>';
			}
			$items = $content;
		}

		return $items;
	}
}
if ( ! function_exists( 'biolife_top_left_menu' ) ) {
	function biolife_top_left_menu( $items, $args )
	{
		if ( $args->theme_location == 'top_left_menu' ) {
			$content = '';
			$content .= $items;
			ob_start();
			$items = $content;
		}

		return $items;
	}
}
if ( ! function_exists( 'biolife_header_language' ) ) {
	function biolife_header_language()
	{
		if ( class_exists( 'SitePress' ) ) {
			$current_language = '';
			$list_language    = '';
			$menu_language    = '';
			$languages        = apply_filters( 'wpml_active_languages', null, 'skip_missing=0' );
			if ( ! empty( $languages ) ) {
				foreach ( $languages as $l ) {
					if ( ! $l['active'] ) {
						$list_language .= '
						<li class="menu-item">
                            <a href="' . esc_url( $l['url'] ) . '">
                                <img src="' . esc_url( $l['country_flag_url'] ) . '" height="12"
                                     alt="' . esc_attr( $l['language_code'] ) . '" width="18"/>
								' . esc_html( $l['native_name'] ) . '
                            </a>
                        </li>';
					} else {
						$current_language = '
						<a href="' . esc_url( $l['url'] ) . '" data-ovic="ovic-dropdown">
                            <img src="' . esc_url( $l['country_flag_url'] ) . '" height="12"
                                 alt="' . esc_attr( $l['language_code'] ) . '" width="18"/>
							' . esc_html( $l['native_name'] ) . '
                        </a>
                        <span class="toggle-submenu"></span>';
					}
				}
				$menu_language .= '
                 <li class="menu-item ovic-dropdown block-language">
                    ' . $current_language . '
                    <ul class="sub-menu">
                        ' . $list_language . '
                    </ul>
                </li>';
				$menu_language .= '<li class="menu-item block-currency">' . do_shortcode( '[currency_switcher format="%code%" switcher_style="wcml-dropdown"]' ) . '</li>';
			}
			echo wp_specialchars_decode( $menu_language );
		}
	}
}
if ( ! function_exists( 'biolife_header_mobile' ) ) {
	add_action( 'biolife_header_mobile', 'biolife_header_mobile' );
	function biolife_header_mobile()
	{
		?>
        <div class="header-mobile">
            <div class="container">
                <div class="header-mobile-inner">
                    <div class="logo">
						<?php biolife_get_logo_mobile(); ?>
                    </div>
                    <div class="header-control">
						<?php if ( class_exists( 'Ovic_Toolkit' ) ): ?>
                            <div class="header-settings ovic-dropdown">
                                <a href="#" data-ovic="ovic-dropdown">
                                    <span class="fa fa-angle-down" aria-hidden="true"></span>
                                </a>
                                <div class="sub-menu">
                                    <div class="settings-block search">
										<?php biolife_search_form_mobile() ?>
                                    </div>
									<?php if ( class_exists( 'SitePress' ) ) { ?>
                                        <ul class="header-mobile-language-select">
											<?php biolife_header_language(); ?>
                                        </ul>
									<?php } ?>
                                </div>
                            </div>
						<?php endif; ?>
						<?php if ( has_nav_menu( 'primary' ) ): ?>
                            <div class="block-menu-bar">
                                <a class="menu-bar menu-toggle" href="#">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </a>
                            </div>
						<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}
if ( ! function_exists( 'biolife_header_vertical' ) ) {
	function biolife_header_vertical( $menu_location, $mobile_active = false )
	{
		global $post;
		/* MAIN THEME OPTIONS */
		$ovic_enable_vertical      = apply_filters( 'ovic_get_option', 'ovic_enable_vertical_menu' );
		$ovic_block_vertical       = apply_filters( 'ovic_get_option', 'ovic_block_vertical_menu' );
		$ovic_item_visible         = apply_filters( 'ovic_get_option', 'ovic_vertical_item_visible', 10 );
		if ( $ovic_enable_vertical == 1 && has_nav_menu( $menu_location ) ) :
			/* MAIN THEME OPTIONS */
			$vertical_title = apply_filters( 'ovic_get_option', 'ovic_vertical_menu_title', esc_html__( 'CATEGORIES', 'biolife' ) );
			$vertical_button_all   = apply_filters( 'ovic_get_option', 'ovic_vertical_menu_button_all_text', esc_html__( 'All Categories', 'biolife' ) );
			$vertical_button_close = apply_filters( 'ovic_get_option', 'ovic_vertical_menu_button_close_text', esc_html__( 'Close', 'biolife' ) );
			$ovic_block_class      = array( 'vertical-wrapper block-nav-category' );
			$id                    = '';
			$post_type             = '';
			if ( $ovic_enable_vertical == 1 ) {
				$ovic_block_class[] = 'has-vertical-menu';
			}
			if ( isset( $post->ID ) ) {
				$id = $post->ID;
			}
			if ( isset( $post->post_type ) ) {
				$post_type = $post->post_type;
			}
			if ( is_array( $ovic_block_vertical ) && in_array( $id, $ovic_block_vertical ) && $post_type == 'page' ) {
				$ovic_block_class[] = 'always-open';
			}
			$locations  = get_nav_menu_locations();
			$menu_id    = $locations[ $menu_location ];
			$menu_items = wp_get_nav_menu_items( $menu_id );
			$count      = 0;
			foreach ( $menu_items as $menu_item ) {
				if ( $menu_item->menu_item_parent == 0 ) {
					$count ++;
				}
			}
			?>
            <!-- block category -->
            <div data-items="<?php echo esc_attr( $ovic_item_visible ); ?>"
                 class="<?php echo implode( ' ', $ovic_block_class ); ?>">
                <div class="block-title">
                    <span class="before">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    <span class="text-title"><?php echo esc_html( $vertical_title ); ?></span>
                </div>
                <div class="block-content verticalmenu-content">
					<?php
					wp_nav_menu( array(
							'menu'            => $menu_location,
							'theme_location'  => $menu_location,
							'depth'           => 4,
							'container'       => '',
							'container_class' => '',
							'container_id'    => '',
							'megamenu_layout'   => 'vertical',
							'menu_class'      => 'ovic-nav vertical-menu',
							'megamenu'        => true,
							'mobile_enable'   => $mobile_active,
						)
					);
					if ( $count > $ovic_item_visible ) : ?>
                        <div class="view-all-category">
                            <a href="#" data-closetext="<?php echo esc_attr( $vertical_button_close ); ?>"
                               data-alltext="<?php echo esc_attr( $vertical_button_all ) ?>"
                               class="btn-view-all open-cate"><?php echo esc_html( $vertical_button_all ) ?></a>
                        </div>
					<?php endif; ?>
                </div>
            </div><!-- block category -->
		<?php endif;
	}
}
if ( ! function_exists( 'biolife_header_sticky' ) ) {
	add_action( 'biolife_header_sticky', 'biolife_header_sticky' );
	function biolife_header_sticky()
	{
		$enable_sticky_menu = Biolife_Functions::get_option( 'ovic_sticky_menu' );
		if ( $enable_sticky_menu == 1 ): ?>
            <div class="header-sticky">
                <div class="container">
                    <div class="header-nav-inner header-responsive">
						<?php biolife_header_vertical( 'vertical_menu' ); ?>
                        <div class="box-header-nav">
                            <div class="header-nav">
								<?php
								if ( has_nav_menu( 'primary' ) ) {
									wp_nav_menu( array(
											'menu'            => 'primary',
											'theme_location'  => 'primary',
											'depth'           => 3,
											'container'       => '',
											'container_class' => '',
											'container_id'    => '',
											'megamenu'        => true,
											'mobile_enable'   => false,
											'menu_class'      => 'biolife-nav main-menu',
										)
									);
								}
								?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		<?php endif;
	}
}
if ( ! function_exists( 'biolife_footer_mobile' ) ) {
	function biolife_footer_mobile()
	{
		$myaccount_link = wp_login_url();
		if ( class_exists( 'WooCommerce' ) ) {
			$myaccount_link = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
		}
		?>
        <div class="mobile-footer is-sticky">
            <div class="mobile-footer-inner">
                <div class="mobile-block">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <span class="fa fa-home icon" aria-hidden="true"></span>
                        <span class="text"><?php echo esc_html__( 'Home', 'biolife' ); ?></span>
                    </a>
                </div>
				<?php do_action( 'biolife_footer_cart_link' ); ?>
                <div class="mobile-block mobile-block-userlink">
                    <a data-ovic="ovic-dropdown" class="woo-wishlist-link"
                       href="<?php echo esc_url( $myaccount_link ); ?>">
                        <span class="fa fa-user icon" aria-hidden="true"></span>
                        <span class="text"><?php echo esc_html__( 'Account', 'biolife' ); ?></span>
                    </a>
                </div>
				<?php if ( has_nav_menu( 'primary' ) ): ?>
                    <div class="mobile-block block-menu-bar">
                        <a href="#" class="menu-bar menu-toggle">
                        <span class="icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                            <span class="text"><?php echo esc_html__( 'Menu', 'biolife' ); ?></span>
                        </a>
                    </div>
				<?php endif; ?>
            </div>
        </div>
		<?php
	}
}
if ( ! function_exists( 'biolife_post_thumbnail_style1' ) ) {
	function biolife_post_thumbnail_style1()
	{
		if ( has_post_thumbnail() ) {
			$biolife_blog_layout = Biolife_Functions::get_option( 'ovic_sidebar_blog_layout', 'left' );
			if ( $biolife_blog_layout == 'full' ) {
				$width  = 1170;
				$height = 726;
			} else {
				$width  = 870;
				$height = 635;
			}
			$thumb = '';
			$crop  = true;
			if ( has_filter( 'ovic_resize_image' ) ) {
				$image_thumb = apply_filters( 'ovic_resize_image', get_post_thumbnail_id(), $width, $height, $crop, true );
				if ( isset( $image_thumb['img'] ) && $image_thumb['img'] != "" ) {
					$thumb = $image_thumb['img'];
				}
			} else {
				$thumb = get_the_post_thumbnail();
			}
			if ( $thumb != "" ) {
				?>
                <div class="post-thumb">
					<?php
					if ( is_single() ) {
						echo wp_specialchars_decode( $thumb );
					} else {
						$permalink = apply_filters( 'ovic_shortcode_vc_link', get_permalink() );
						?>
                        <a href="<?php echo esc_url( $permalink ); ?>"><?php echo wp_specialchars_decode( $thumb ); ?></a>
						<?php
					}
					?>
                    <div class="post-date">
                        <span class="date"><?php echo get_the_date( 'd' ); ?></span>
                        <span class="month"><?php echo get_the_date( 'M' ); ?></span>
                    </div>
                </div>
				<?php
			}
		}
	}
}
if ( ! function_exists( 'biolife_post_thumbnail' ) ) {
	function biolife_post_thumbnail()
	{
		if ( has_post_thumbnail() ) {
			$biolife_blog_layout = Biolife_Functions::get_option( 'ovic_sidebar_blog_layout', 'left' );
			if ( $biolife_blog_layout == 'full' ) {
				$width  = 1170;
				$height = 726;
			} else {
				$width  = 870;
				$height = 635;
			}
			$thumb = '';
			$crop  = true;
			if ( has_filter( 'ovic_resize_image' ) ) {
				$image_thumb = apply_filters( 'ovic_resize_image', get_post_thumbnail_id(), $width, $height, $crop, true );
				if ( isset( $image_thumb['img'] ) && $image_thumb['img'] != "" ) {
					$thumb = $image_thumb['img'];
				}
			} else {
				$thumb = get_the_post_thumbnail();
			}
			if ( $thumb != "" ) {
				?>
                <div class="post-thumb">
					<?php
					if ( is_single() ) {
						echo wp_specialchars_decode( $thumb );
					} else {
						$permalink = apply_filters( 'ovic_shortcode_vc_link', get_permalink() );
						?>
                        <a href="<?php echo esc_url( $permalink ); ?>"><?php echo wp_specialchars_decode( $thumb ); ?></a>
						<?php
					}
					?>
                    <div class="post-date">
                        <span class="date"><?php echo get_the_date( 'd' ); ?></span>
                        <span class="month"><?php echo get_the_date( 'M' ); ?></span>
                    </div>
					<?php do_action( 'biolife_post_meta' ); ?>
                </div>
				<?php
			}
		}
	}
}
if ( ! function_exists( 'biolife_post_thumbnail_default' ) ) {
	function biolife_post_thumbnail_default()
	{
		if ( has_post_thumbnail() ) {
			$biolife_blog_layout = Biolife_Functions::get_option( 'ovic_sidebar_blog_layout', 'left' );
			if ( $biolife_blog_layout == 'full' ) {
				$width  = 1170;
				$height = 726;
			} else {
				$width  = 870;
				$height = 635;
			}
			$thumb = '';
			$crop  = true;
			if ( has_filter( 'ovic_resize_image' ) ) {
				$image_thumb = apply_filters( 'ovic_resize_image', get_post_thumbnail_id(), $width, $height, $crop, true );
				if ( isset( $image_thumb['img'] ) && $image_thumb['img'] != "" ) {
					$thumb = $image_thumb['img'];
				}
			} else {
				$thumb = get_the_post_thumbnail();
			}
			if ( $thumb != "" ) {
				?>
                <div class="post-thumb">
					<?php
					if ( is_single() ) {
						echo wp_specialchars_decode( $thumb );
					} else {
						$permalink = apply_filters( 'ovic_shortcode_vc_link', get_permalink() );
						?>
                        <a href="<?php echo esc_url( $permalink ); ?>"><?php echo wp_specialchars_decode( $thumb ); ?></a>
						<?php
					}
					?>
					<?php do_action( 'biolife_post_meta' ); ?>
                </div>
				<?php
			}
		}
	}
}
if ( ! function_exists( 'biolife_post_meta' ) ) {
	function biolife_post_meta()
	{ ?>
        <div class="post-meta">
            <div class="post-meta-group">
				<?php
				/**
				 * Functions hooked into biolife_footer action
				 *
				 * @hooked biolife_post_sticky              - 10
				 * @hooked biolife_comment_count            - 20
				 * @hooked biolife_simple_likes_button      - 30
				 * @hooked biolife_share_button             - 40
				 */
				do_action( 'biolife_post_meta_content' );
				?>
            </div>
        </div>
		<?php
	}
}
if ( ! function_exists( 'biolife_post_info' ) ) {
	function biolife_post_info()
	{ ?>
        <div class="post-info">
			<?php
			/**
			 * Functions hooked into biolife_post_info_content action
			 *
			 * @hooked biolife_post_title               - 10
			 * @hooked biolife_post_contents            - 20
			 * @hooked biolife_post_meta                - 30
			 * @hooked biolife_post_readmore            - 40
			 */
			do_action( 'biolife_post_info_content' );
			?>
        </div>
		<?php
	}
}
if ( ! function_exists( 'biolife_post_date' ) ) {
	function biolife_post_date()
	{
		?>
        <div class="post-date default">
            <span class="date"><?php echo get_the_date(); ?></span>
        </div>
		<?php
	}
}
if ( ! function_exists( 'biolife_post_title' ) ) {
	function biolife_post_title()
	{
		$permalink = apply_filters( 'ovic_shortcode_vc_link', get_permalink() );
		if ( is_single() ): ?>
            <h1 class="post-title"><?php the_title(); ?></h1>
		<?php else: ?>
            <h2 class="post-title"><a href="<?php echo esc_url( $permalink ); ?>"><?php the_title(); ?></a></h2>
		<?php endif;
	}
}
if ( ! function_exists( 'biolife_post_sticky' ) ) {
	function biolife_post_sticky()
	{
		if ( is_sticky() ) : ?>
            <div class="sticky-post"><i class="fa fa-flag"></i>
				<?php echo esc_html__( ' Sticky', 'biolife' ); ?>
            </div>
		<?php endif;
	}
}
if ( ! function_exists( 'biolife_post_contents' ) ) {
	function biolife_post_contents()
	{
		?>
        <div class="post-content">
			<?php echo wp_trim_words( apply_filters( 'the_excerpt', get_the_excerpt() ), 40, esc_html__( '...', 'biolife' ) ); ?>
        </div>
		<?php
	}
}
if ( ! function_exists( 'biolife_post_readmore' ) ) {
	function biolife_post_readmore()
	{
		$permalink = apply_filters( 'ovic_shortcode_vc_link', get_permalink() );
		?>
        <a href="<?php echo esc_url( $permalink ); ?>" class="read-more screen-reader-text">
            <span class="text"><?php esc_html_e( 'Continue Reading', 'biolife' ); ?></span>
        </a>
		<?php
	}
}
if ( ! function_exists( 'biolife_post_single_content' ) ) {
	function biolife_post_single_content()
	{
		?>
        <div class="post-content">
			<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
					esc_html__( 'Continue reading %s', 'biolife' ),
					the_title( '<span class="screen-reader-text">', '</span>', false )
				)
			);
			wp_link_pages( array(
					'before'      => '<div class="post-pagination"><span class="title">' . esc_html__( 'Pages:', 'biolife' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				)
			);
			?>
        </div>
		<?php
	}
}
if ( ! function_exists( 'biolife_post_author' ) ) {
	function biolife_post_author()
	{
		?>
        <div class="post-author">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), 28 ); ?>
            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php the_author() ?></a>
        </div>
		<?php
	}
}
if ( ! function_exists( 'biolife_comment_count' ) ) {
	function biolife_comment_count()
	{
		?>
        <div class="comment-count">
			<?php comments_number(
				esc_html__( '0', 'biolife' ),
				esc_html__( '1', 'biolife' ),
				esc_html__( '%', 'biolife' )
			);
			?>
            <i class="flaticon-comment-white-oval-bubble"></i>
        </div>
		<?php
	}
}
if ( ! function_exists( 'biolife_share_button' ) ) {
	function biolife_share_button( $post_id )
	{
		$enable_enable_social_blog = Biolife_Functions::get_option( 'ovic_enable_social_blog' );
		if ( $enable_enable_social_blog == 1 ): ?>
			<?php
			$share_image_url       = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'full' );
			$share_link_url        = get_permalink( $post_id );
			$share_link_title      = get_the_title();
			$share_twitter_summary = get_the_excerpt();
			$twitter               = 'https://twitter.com/share?url=' . $share_link_url . '&text=' . $share_twitter_summary;
			$facebook              = 'https://www.facebook.com/sharer.php?s=100&title=' . $share_link_title . '&url=' . $share_link_url;
			$google                = 'https://plus.google.com/share?url=' . $share_link_url . '&title=' . $share_link_title;
			$pinterest             = 'http://pinterest.com/pin/create/button/?url=' . $share_link_url . '&description=' . $share_twitter_summary . '&media=' . $share_image_url[0];
			?>
            <div class="ovic-share-socials">
                <span class="share-button fa fa-share-alt"></span>
                <div class="list-social">
                    <a target="_blank" class="twitter"
                       href="<?php echo esc_url( $twitter ); ?>"
                       title="<?php echo esc_attr__( 'Twitter', 'biolife' ) ?>"
                       onclick='window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;'>
                        <span class="fa fa-twitter"></span>
                    </a>
                    <a target="_blank" class="facebook"
                       href="<?php echo esc_url( $facebook ); ?>"
                       title="<?php echo esc_attr__( 'Facebook', 'biolife' ) ?>"
                       onclick='window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;'>
                        <span class="fa fa-facebook-f"></span>
                    </a>
                    <a target="_blank" class="googleplus"
                       href="<?php echo esc_url( $google ); ?>"
                       title="<?php echo esc_attr__( 'Google+', 'biolife' ) ?>"
                       onclick='window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;'>
                        <span class="fa fa-google-plus"></span>
                    </a>
                    <a target="_blank" class="pinterest"
                       href="<?php echo esc_url( $pinterest ); ?>"
                       title="<?php echo esc_attr__( 'Pinterest', 'biolife' ) ?>"
                       onclick='window.open(this.href, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600");return false;'>
                        <span class="fa fa-pinterest"></span>
                    </a>
                </div>
            </div>
		<?php endif;
	}
}
if ( ! function_exists( 'biolife_simple_likes_button' ) ) {
	function biolife_simple_likes_button()
	{
		?>
		<?php do_action( 'ovic_simple_likes_button', get_the_ID() ); ?>
		<?php
	}
}
add_filter( 'ovic_filter_like_icon', 'biolife_get_liked_icon' );
if ( ! function_exists( 'biolife_get_liked_icon' ) ) {
	function biolife_get_liked_icon()
	{
		return '<i class="icon-images liked-icon"></i>';
	}
}
add_filter( 'ovic_filter_unlike_icon', 'biolife_get_unliked_icon' );
if ( ! function_exists( 'biolife_get_unliked_icon' ) ) {
	function biolife_get_unliked_icon()
	{
		return '<i class="icon-images unliked-icon"></i>';
	}
}
if ( ! function_exists( 'biolife_post_category' ) ) {
	function biolife_post_category()
	{
		$get_term_cat = get_the_terms( get_the_ID(), 'category' );
		if ( ! is_wp_error( $get_term_cat ) && ! empty( $get_term_cat ) ) : ?>
            <div class="post-category">
                <span class="text"><?php echo esc_html__( 'Category:', 'biolife' ) ?></span>
				<?php the_category( ', ' ); ?>
            </div>
		<?php endif;
	}
}
if ( ! function_exists( 'biolife_post_tags' ) ) {
	function biolife_post_tags()
	{
		$get_term_tag = get_the_terms( get_the_ID(), 'post_tag' );
		if ( ! is_wp_error( $get_term_tag ) && ! empty( $get_term_tag ) ) : ?>
            <div class="post-category">
                <span class="text"><?php echo esc_html__( 'Tags:', 'biolife' ) ?></span>
				<?php the_tags( '' ); ?>
            </div>
		<?php endif;
	}
}
if ( ! function_exists( 'biolife_paging_nav' ) ) {
	function biolife_paging_nav()
	{
		global $wp_query;
		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages < 2 ) {
			return;
		}
		echo get_the_posts_pagination( array(
				'screen_reader_text' => '&nbsp;',
				'before_page_number' => '',
			)
		);
	}
}
/**
 *
 * FLATICON
 */
if ( ! function_exists( 'biolife_add_icon' ) ) {
	add_filter( 'ovic_load_icon_json', 'biolife_add_icon' );
	function biolife_add_icon( $icon )
	{
		$icon[] = array(
			'name'  => 'Flaticon',
			'icons' => array(
				'flaticon-technology',
				'flaticon-headset',
				'flaticon-magnifying-glass',
				'flaticon-placeholder',
				'flaticon-heart-1',
				'flaticon-bag',
				'flaticon-comment-white-oval-bubble',
				'flaticon-user-image-with-black-background',
				'flaticon-heart-black-shape',
				'flaticon-bullet',
				'flaticon-grid',
				'flaticon-fresh-juice',
				'flaticon-heart',
				'flaticon-greenhouse',
				'flaticon-human-artery',
				'flaticon-medal',
				'flaticon-close',
				'flaticon-pack-of-oats',
				'flaticon-fish',
				'flaticon-fruit',
				'flaticon-peanut-butter',
				'flaticon-fast-food',
				'flaticon-harvest',
				'flaticon-papaya',
				'flaticon-onion',
				'flaticon-cauliflower',
				'flaticon-tea',
				'flaticon-grape',
				'flaticon-chop',
				'flaticon-medal',
				'flaticon-bullet',
				'flaticon-placeholder',
				'flaticon-clock',
				'flaticon-message',
				'flaticon-smartphone',
				'flaticon-truck',
				'flaticon-beer',
				'flaticon-weekly-calendar',
			),
		);

		return $icon;
	}
}
/**
 *
 * FLATICON FOR MENU
 */
if ( ! function_exists( 'biolife_menu_iconpicker_type' ) ) {
	add_filter( 'ovic_menu_icons_setting', 'biolife_menu_iconpicker_type' );
	function biolife_menu_iconpicker_type( $fonts )
	{
		$fonts_new = array(
			array( 'flaticon-headset' => 'Flaticon Technology' ),
			array( 'flaticon-magnifying-glass' => 'Flaticon Magnifying' ),
			array( 'flaticon-placeholder' => 'Flaticon Placeholder' ),
			array( 'flaticon-heart-1' => 'Flaticon Heart' ),
			array( 'flaticon-bag' => 'Flaticon Shop' ),
			array( 'flaticon-comment-white-oval-bubble' => 'Flaticon Comment White' ),
			array( 'flaticon-user-image-with-black-background' => 'Flaticon User Image' ),
			array( 'flaticon-heart-black-shape' => 'Flaticon Heart Balck' ),
			array( 'flaticon-bullet' => 'Flaticon List' ),
			array( 'flaticon-grid' => 'Flaticon Grid' ),
			array( 'flaticon-fresh-juice' => 'Flaticon Juice' ),
			array( 'flaticon-heart' => 'Flaticon Heart 2' ),
			array( 'flaticon-greenhouse' => 'Flaticon Piggy Bank' ),
			array( 'flaticon-human-artery' => 'Flaticon Human Artery' ),
			array( 'flaticon-medal' => 'Flaticon Medal' ),
			array( 'flaticon-close' => 'Flaticon Close' ),
			array( 'flaticon-pack-of-oats' => 'Flaticon Pack of oats' ),
			array( 'flaticon-fish' => 'Flaticon Fish' ),
			array( 'flaticon-fruit' => 'Flaticon Fruit' ),
			array( 'flaticon-peanut-butter' => 'Flaticon Peanut' ),
			array( 'flaticon-fast-food' => 'Flaticon Fast Foot' ),
			array( 'flaticon-harvest' => 'Flaticon Harvest' ),
			array( 'flaticon-papaya' => 'Flaticon Papaya' ),
			array( 'flaticon-onion' => 'Flaticon Onion' ),
			array( 'flaticon-cauliflower' => 'Flaticon Cauliflower' ),
			array( 'flaticon-tea' => 'Flaticon Tea' ),
			array( 'flaticon-grape' => 'Flaticon Grape' ),
			array( 'flaticon-chop' => 'Flaticon Chop' ),
			array( 'flaticon-medal' => 'Flaticon Medal' ),
			array( 'flaticon-bullet' => 'Flaticon Bullet' ),
			array( 'flaticon-placeholder' => 'Flaticon Placeholder' ),
			array( 'flaticon-clock' => 'Flaticon Clock' ),
			array( 'flaticon-message' => 'Flaticon Message' ),
			array( 'flaticon-smartphone' => 'Flaticon Smartphone' ),
			array( 'flaticon-truck' => 'Flaticon Truck' ),
			array( 'flaticon-beer' => 'Flaticon Beer' ),
			array( 'flaticon-weekly-calendar' => 'Flaticon Calendar' ),
		);
		$fonts     = array_merge( $fonts_new, $fonts );

		return $fonts;
	}
}
/**
 *
 * FLATICON FOR SC
 */
if ( ! function_exists( 'biolife_iconpicker_type' ) ) {
	add_filter( 'ovic_add_icon_field', 'biolife_iconpicker_type' );
	function biolife_iconpicker_type()
	{
		$fonts = array(
			array( 'flaticon-headset' => 'Flaticon Technology' ),
			array( 'flaticon-magnifying-glass' => 'Flaticon Magnifying' ),
			array( 'flaticon-placeholder' => 'Flaticon Placeholder' ),
			array( 'flaticon-heart-1' => 'Flaticon Heart' ),
			array( 'flaticon-bag' => 'Flaticon Shop' ),
			array( 'flaticon-comment-white-oval-bubble' => 'Flaticon Comment White' ),
			array( 'flaticon-user-image-with-black-background' => 'Flaticon User Image' ),
			array( 'flaticon-heart-black-shape' => 'Flaticon Heart Balck' ),
			array( 'flaticon-bullet' => 'Flaticon List' ),
			array( 'flaticon-grid' => 'Flaticon Grid' ),
			array( 'flaticon-fresh-juice' => 'Flaticon Juice' ),
			array( 'flaticon-heart' => 'Flaticon Heart 2' ),
			array( 'flaticon-greenhouse' => 'Flaticon Piggy Bank' ),
			array( 'flaticon-human-artery' => 'Flaticon Human Artery' ),
			array( 'flaticon-medal' => 'Flaticon Medal' ),
			array( 'flaticon-close' => 'Flaticon Close' ),
			array( 'flaticon-pack-of-oats' => 'Flaticon Pack of oats' ),
			array( 'flaticon-fish' => 'Flaticon Fish' ),
			array( 'flaticon-fruit' => 'Flaticon Fruit' ),
			array( 'flaticon-peanut-butter' => 'Flaticon Peanut' ),
			array( 'flaticon-fast-food' => 'Flaticon Fast Foot' ),
			array( 'flaticon-harvest' => 'Flaticon Harvest' ),
			array( 'flaticon-papaya' => 'Flaticon Papaya' ),
			array( 'flaticon-onion' => 'Flaticon Onion' ),
			array( 'flaticon-cauliflower' => 'Flaticon Cauliflower' ),
			array( 'flaticon-tea' => 'Flaticon Tea' ),
			array( 'flaticon-grape' => 'Flaticon Grape' ),
			array( 'flaticon-chop' => 'Flaticon Chop' ),
			array( 'flaticon-medal' => 'Flaticon Medal' ),
			array( 'flaticon-bullet' => 'Flaticon Bullet' ),
			array( 'flaticon-placeholder' => 'Flaticon Placeholder' ),
			array( 'flaticon-clock' => 'Flaticon Clock' ),
			array( 'flaticon-message' => 'Flaticon Message' ),
			array( 'flaticon-smartphone' => 'Flaticon Smartphone' ),
			array( 'flaticon-truck' => 'Flaticon Truck' ),
			array( 'flaticon-beer' => 'Flaticon Beer' ),
			array( 'flaticon-weekly-calendar' => 'Flaticon Calendar' ),
		);

		return $fonts;
	}
}
if ( ! function_exists( 'biolife_breadcrumb_page' ) ) {
	function biolife_breadcrumb_page()
	{
		do_action( 'ovic_breadcrumb' );
	}
}// GET HEADER
if ( ! function_exists( 'biolife_header_content' ) ) {
	function biolife_header_content()
	{
		$data_meta           = get_post_meta( get_the_ID(), '_custom_metabox_theme_options', true );
		$enable_theme_option = isset( $data_meta['metabox_options_enable'] ) ? $data_meta['metabox_options_enable'] : 0;
		$header_options      = Biolife_Functions::get_option( 'biolife_used_header', 'style-01' );
		$header_options      = $enable_theme_option == 1 && isset( $data_meta['metabox_biolife_used_header'] ) && $data_meta['metabox_biolife_used_header'] != '' ? $data_meta['metabox_biolife_used_header'] : $header_options;
		get_template_part( 'templates/header/header', $header_options );
	}
}
// GET FOOTER
add_filter( 'ovic_overide_footer_template', 'biolife_overide_footer_template' );
if ( ! function_exists( 'biolife_overide_footer_template' ) ) {
	function biolife_overide_footer_template()
	{
		$data_meta           = get_post_meta( get_the_ID(), '_custom_metabox_theme_options', true );
		$enable_theme_option = isset( $data_meta['metabox_options_enable'] ) ? $data_meta['metabox_options_enable'] : 0;
		$footer_options      = Biolife_Functions::get_option( 'ovic_footer_template', '' );
		$footer_options      = $enable_theme_option == 1 && isset( $data_meta['metabox_biolife_used_footer'] ) && $data_meta['metabox_biolife_used_footer'] != '' ? $data_meta['metabox_biolife_used_footer'] : $footer_options;

		return $footer_options;
	}
}
if ( !function_exists( 'biolife_post_category_2' ) ) {
	function biolife_post_category_2( $id = null, $taxonomy = 'category', $title = 'Categories:' )
	{
		if ( $id == null ) {
			$id = get_the_ID();
		}
		$get_term_cat = get_the_terms( $id, $taxonomy );
		if ( !is_wp_error( $get_term_cat ) && !empty( $get_term_cat ) ) : ?>
            <div class="post-<?php echo esc_attr( $taxonomy ); ?>">
				<?php if ( $title ): ?>
                    <span class="title"><?php echo esc_html( $title ) ?></span>
				<?php endif; ?>
                <ul class="post-categories">
					<?php foreach ( $get_term_cat as $item ):
						$link = get_term_link( $item->term_id, $taxonomy );
						?>
                        <li>
                            <a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $item->name ); ?></a>
                        </li>
					<?php endforeach; ?>
                </ul>
            </div>
		<?php endif;
	}
}

if ( ! function_exists( 'biolife_dokan_store_profile_frame_after' ) ) {
	function biolife_dokan_store_profile_frame_after()
	{
		wc_set_loop_prop( 'columns', 3 );
		set_query_var( 'is-dokan', true );
	}
}
add_action( 'dokan_store_profile_frame_after', 'biolife_dokan_store_profile_frame_after' );