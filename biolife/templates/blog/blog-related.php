<?php
global $post;
$enable_related   = Biolife_Functions::get_option( 'ovic_enable_related_post' );
$number_related   = Biolife_Functions::get_option( 'ovic_related_post_per_page', 6 );
$categories       = get_the_category( $post->ID );
if ( $categories && $enable_related == 1 ) :
	$woo_ls_items = Biolife_Functions::get_option( 'ovic_related_post_ls_items', 3 );
	$woo_lg_items = Biolife_Functions::get_option( 'ovic_related_post_lg_items', 3 );
	$woo_md_items = Biolife_Functions::get_option( 'ovic_related_post_md_items', 3 );
	$woo_sm_items = Biolife_Functions::get_option( 'ovic_related_post_sm_items', 2 );
	$woo_xs_items = Biolife_Functions::get_option( 'ovic_related_post_xs_items', 1 );
	$woo_ts_items = Biolife_Functions::get_option( 'ovic_related_post_ts_items', 1 );
	$atts         = array(
		'owl_loop'     => 'false',
        'owl_navigation'    => 'false',
		'owl_ts_items' => $woo_ts_items,
		'owl_xs_items' => $woo_xs_items,
		'owl_sm_items' => $woo_sm_items,
		'owl_md_items' => $woo_md_items,
		'owl_lg_items' => $woo_lg_items,
		'owl_ls_items' => $woo_ls_items,
	);
	$owl_settings = apply_filters( 'ovic_carousel_data_attributes', 'owl_', $atts );
	$category_ids = array();
	foreach ( $categories as $value ) {
		$category_ids[] = $value->term_id;
	}
	$args      = array(
		'category__in'        => $category_ids,
		'post__not_in'        => array( $post->ID ),
		'posts_per_page'      => $number_related,
		'ignore_sticky_posts' => 1,
		'orderby'             => 'rand',
	);
	$new_query = new wp_query( $args );
	?>
    <h3 class="title-related"><span><?php echo esc_html__( 'Posts you may like', 'biolife' ); ?></span></h3>
	<?php
	if ( $new_query->have_posts() ) : ?>
        <div class="related-post owl-slick" <?php echo esc_attr( $owl_settings ); ?>>
			<?php while ( $new_query->have_posts() ): $new_query->the_post();
				$image_thumb = apply_filters( 'ovic_resize_image', get_post_thumbnail_id(), 370, 281, true, true );
				?>
                <article <?php post_class( 'post-item' ); ?>>
                    <div class="post-thumb">
                        <a class="thumb-link" href="<?php the_permalink(); ?>">
                            <figure><?php echo wp_specialchars_decode( $image_thumb['img'] ); ?></figure>
                        </a>
                    </div>
                    <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="info">
                        <div class="metas">
							<?php
							if ( is_sticky() && is_home() && !is_paged() ) {
								printf( '<span class="sticky-post"><i class="fa fa-flag" aria-hidden="true"></i> %s</span>', esc_html__( 'Sticky', 'biolife' ) );
							}
							?>
                            <span class="author">
								<i class="fa fa-user" aria-hidden="true"></i>
                                <span><?php echo esc_html__( 'By ', 'biolife' ) ?></span>
                                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>">
                                    <?php the_author() ?>
                                </a>
							</span>
                            <div class="date">
                                <i class="fa fa-clock-o"></i>
								<?php echo get_the_date(); ?>
                            </div>
                            <span class="comment">
                                <i class="fa fa-comment"></i>
								<?php comments_number( '(0)', '(1)', '(%)' ); ?>
                            </span>
                        </div>
                    </div>
                </article>
			<?php endwhile; ?>
        </div>
	<?php endif;
endif;
wp_reset_postdata();