<?php
do_action( 'biolife_before_single_blog_content' );
remove_action( 'biolife_post_info_content', 'biolife_post_contents', 30 );
remove_action( 'biolife_post_info_content', 'biolife_post_readmore', 40 );
add_action( 'biolife_post_info_content', 'biolife_post_single_content', 50 );
add_action( 'biolife_single_post_content', 'biolife_post_category', 25 );
remove_action( 'biolife_single_post_content', 'biolife_post_thumbnail', 10 );
add_action( 'biolife_single_post_content', 'biolife_post_thumbnail_default', 10 );
add_action( 'biolife_post_info_content', 'biolife_post_date', 21 );
?>
	<div class="blog-single">
		<article <?php post_class( 'post-item' ); ?>>
			<?php
			/**
			 * Functions hooked into biolife_single_post_content action
			 *
			 * @hooked biolife_post_thumbnail          - 10
			 * @hooked biolife_post_info               - 20
			 */
			do_action( 'biolife_single_post_content' );
			do_action( 'biolife_post_tags' );
			?>
		</article>
		<?php
		get_template_part( 'templates/blog/blog', 'related' );
		?>
	</div>
<?php
add_action( 'biolife_post_info_content', 'biolife_post_contents', 30 );
add_action( 'biolife_post_info_content', 'biolife_post_readmore', 40 );
remove_action( 'biolife_post_info_content', 'biolife_post_single_content', 50 );
remove_action( 'biolife_single_post_content', 'biolife_post_category', 25 );
add_action( 'biolife_single_post_content', 'biolife_post_thumbnail', 10 );
remove_action( 'biolife_single_post_content', 'biolife_post_thumbnail_default', 10 );
remove_action( 'biolife_post_info_content', 'biolife_post_date', 21 );
do_action( 'biolife_after_single_blog_content' );