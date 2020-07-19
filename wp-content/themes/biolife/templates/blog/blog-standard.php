<?php
if ( have_posts() ) : ?>
	<?php do_action( 'biolife_before_blog_content' ); ?>
    <div class="blog-standard content-post blog-new">
		<?php while ( have_posts() ) : the_post(); $is_thumbnail = (int)has_post_thumbnail(); $excerpt=apply_filters( 'the_excerpt', get_the_excerpt() ); ?>
            <article <?php post_class( 'post-item' ); ?>>
				<?php do_action('biolife_single_post_thumbnail'); ?>
                <div class="post-info">
                    <?php do_action('biolife_single_post_title'); ?>
                    <div class="post-meta">
                        <?php
                        do_action('biolife_single_post_date');
                        do_action('biolife_single_post_author');
                        ?>
                    </div>
                    <?php if ($excerpt): ?>
                        <div class="post-content">
                            <?php echo wp_trim_words( $excerpt, 21, esc_html__( '...', 'biolife' ) ); ?>
                        </div>
                    <?php endif; ?>
                    <div class="post-read-more">
                        <a href="<?php the_permalink(); ?>" class="read-more screen-reader-text">
                            <span class="text"><?php esc_html_e( 'Read more', 'biolife' ); ?></span>
                        </a>
                        <?php do_action( 'biolife_simple_likes_button'); ?>
                        <div class="comment-count">
                            <span class="count">
                                <?php comments_number(
                                    esc_html__( '0', 'biolife' ),
                                    esc_html__( '1', 'biolife' ),
                                    esc_html__( '%', 'biolife' )
                                );
                                ?>
                            </span>
                            <i class="icon-images comment-counts"></i>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </article>
		<?php endwhile;
		wp_reset_postdata(); ?>
    </div>
	<?php
	/**
	 * Functions hooked into biolife_after_blog_content action
	 *
	 * @hooked biolife_paging_nav               - 10
	 */
	do_action( 'biolife_after_blog_content' ); ?>
<?php else :
	get_template_part( 'content', 'none' );
endif;