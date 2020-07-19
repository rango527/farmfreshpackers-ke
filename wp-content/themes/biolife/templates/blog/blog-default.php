<?php
if ( have_posts() ) : ?>
	<?php
	do_action( 'biolife_before_blog_content' );
	?>
    <div class="row blog-grid blog-standard blog-default content-post auto-clear">
        <?php while ( have_posts() ) : the_post(); ?>
            <article <?php post_class( 'post-item post-item-default col-xs-12' ); ?>>
                <header class="entry-header">
                    <?php
                    $edit_post = '';
                    $edit_url = get_edit_post_link();
                    if ($edit_url){
                        $edit_post = '<a class="edit-url" href="'.$edit_url.'"><i class="fa fa-pencil"></i></a>';
                    }
                    $title = get_the_title();
                    ?>
                    <?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
                        <?php the_title( sprintf( '<h2 class="entry-title is_sticky"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>'.$edit_post.'</h2>' ); ?>
                    <?php else: ?>
                        <?php if (!$title): ?>
                            <h2 class="entry-title"><a href="<?php echo esc_url( get_permalink() );?>" rel="bookmark"><?php echo esc_html__('No title', 'biolife') ?></a><?php wp_specialchars_decode($edit_post) ?></h2>
                        <?php else: ?>
                            <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>'.$edit_post.'</h2>' ); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="meta">
                        <?php
                        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
                        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
                            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
                        }
                        $time_string = sprintf( $time_string,
                            esc_attr( get_the_date( 'c' ) ),
                            get_the_date(),
                            esc_attr( get_the_modified_date( 'c' ) ),
                            get_the_modified_date()
                        );
                        printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
                            _x( 'Posted on: ', 'Used before publish date.', 'biolife' ),
                            esc_url( get_permalink() ),
                            $time_string
                        );

                        printf( '<span class="sp"><i class="fa fa-circle"></i></span><span class="byline"><span class="screen-reader-text">%1$s </span> <a class="url fn n" href="%2$s">%3$s</a></span>',
                            _x( 'By: ', 'Used before post author name.', 'biolife' ),
                            esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                            get_the_author()
                        );
                        if ( ! is_singular() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
                            echo wp_specialchars_decode('<span class="sp"><i class="fa fa-circle"></i></span><span class="comments-link">');
                            comments_popup_link();
                            echo wp_specialchars_decode('</span>');
                        }
                        ?>
                    </div>
                </header><!-- .entry-header -->

                <?php if ( has_excerpt() || is_search() ) : ?>
                    <div class="entry-summary">
                        <?php the_excerpt(); ?>
                    </div>
                <?php endif; ?>
                <?php if ( !post_password_required() && !is_attachment() && has_post_thumbnail() ) { ?>
                    <div class="post-thumbnail">
                        <a class="" href="<?php the_permalink(); ?>" aria-hidden="true">
                            <?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
                        </a>
                    </div>
                <?php } ?>

                <div class="entry-content">
                    <?php
                    /* translators: %s: Name of current post */
                    the_content( sprintf(
                        __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'biolife' ),
                        get_the_title()
                    ) );

                    wp_link_pages( array(
                        'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'biolife' ) . '</span>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                        'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'biolife' ) . ' </span>%',
                        'separator'   => '<span class="screen-reader-text">, </span>',
                    ) );
                    ?>
                    <div class="clearfix"></div>
                </div><!-- .entry-content -->

                <footer class="entry-footer">


                    <?php





                    $format = get_post_format();
                    if ( current_theme_supports( 'post-formats', $format ) ) {
                        printf( '<div class="entry-format">%1$s<a href="%2$s">%3$s</a></div>',
                            sprintf( '<span class="screen-reader-text">%s </span>', _x( 'Format', 'Used before post format.', 'biolife' ) ),
                            esc_url( get_post_format_link( $format ) ),
                            get_post_format_string( $format )
                        );
                    }
                    if ( 'post' === get_post_type() ) {
                        $categories_list = get_the_category_list(_x(', ', 'Used between list items, there is a space after the comma.', 'biolife'));
                        if ($categories_list) {
                            printf('<div class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</div>',
                                _x('Categories: ', 'Used before category names.', 'biolife'),
                                $categories_list
                            );
                        }

                        $tags_list = get_the_tag_list('', _x(', ', 'Used between list items, there is a space after the comma.', 'biolife'));
                        if ($tags_list && !is_wp_error($tags_list)) {
                            printf('<div class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</div>',
                                _x('Tags: ', 'Used before tag names.', 'biolife'),
                                $tags_list
                            );
                        }
                    }




                    ?>

                </footer><!-- .entry-footer -->




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