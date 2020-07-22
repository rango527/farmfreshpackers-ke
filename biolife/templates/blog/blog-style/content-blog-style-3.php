<?php
/*
Name: Blog Style 03
Slug: content-blog-style-3
*/
$permalink = apply_filters( 'ovic_shortcode_vc_link', get_permalink() );
?>
<div class="post-style3">
    <?php
    do_action('biolife_post_thumbnail_style1');
    ?>
    <div class="post-info">
        <h2 class="post-title"><a href="<?php echo esc_url( $permalink ); ?>"><?php the_title(); ?></a></h2>
        <div class="post-meta">
            <div class="post-meta-group post-content-group">
                <div class="post-author">
                    <span class="text"><?php echo esc_html__( 'Posted By: ', 'biolife' ) ?></span>
                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php the_author() ?></a>
                </div>
                <?php
                    do_action( 'biolife_simple_likes_button');
                ?>
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
        <div class="post-content">
            <?php echo wp_trim_words( apply_filters( 'the_excerpt', get_the_excerpt() ), 20, esc_html__( '...', 'biolife' ) ); ?>
        </div>
        <a href="<?php echo esc_url( $permalink ); ?>" class="read-more">
            <span class="text"><?php esc_html_e( 'Read more', 'biolife' ); ?></span>
        </a>
    </div>
</div>
