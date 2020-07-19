<?php
/*
Name: Blog Style 08
Slug: content-blog-style-8
*/
$permalink = apply_filters( 'ovic_shortcode_vc_link', get_permalink() );
?>
<div class="post-style8">
	<div class="post-thumb">
		<a href="<?php echo esc_url( $permalink ); ?>">
			<?php
			$image_thumb = apply_filters( 'ovic_resize_image', get_post_thumbnail_id(), 100, 73, true, true );
			echo wp_specialchars_decode( $image_thumb['img'] );
			?>
		</a>
	</div>
    <div class="post-info">
		<h4 class="post-title">
			<a href="<?php echo esc_url( $permalink ); ?>"><?php the_title(); ?></a>
		</h4>
		<div class="post-meta">
            <span class="date"><?php echo get_the_date( 'd M Y' ); ?></span>
			<span class="comment">
                <?php comments_number(
					esc_html__( '0', 'biolife' ),
					esc_html__( '1', 'biolife' ),
					esc_html__( '%', 'biolife' )
				);
				?>
				<?php echo esc_html__( 'Comments', 'biolife' ); ?>
            </span>
		</div>
	</div>
</div>
