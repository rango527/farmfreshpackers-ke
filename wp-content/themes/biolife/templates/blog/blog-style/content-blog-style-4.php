<?php
/*
Name: Blog Style 04
Slug: content-blog-style-4
*/
?>
<div class="post-style2 post-style4">
	<?php
	$permalink = apply_filters( 'ovic_shortcode_vc_link', get_permalink() );
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
	?>
    <div class="post-info">
        <h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="post-meta">
            <div class="post-meta-group">
				<?php
                do_action( 'biolife_post_author');
                do_action( 'biolife_comment_count');
                do_action( 'biolife_simple_likes_button');
                do_action( 'biolife_share_button' );
                do_action( 'biolife_get_liked_icon' );


				?>
            </div>
        </div>
        <div class="post-content">
			<?php echo wp_trim_words( apply_filters( 'the_excerpt', get_the_excerpt() ), 20, esc_html__( '...', 'biolife' ) ); ?>
        </div>
		<a href="<?php echo esc_url( $permalink ); ?>" class="read-more">
            <span class="text"><?php esc_html_e( 'Continue Reading', 'biolife' ); ?></span>
        </a>
    </div>
</div>
