<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Biolife
 * @since biolife 1.0
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
$comment_field     = '<p class="comment-form-comment"><textarea class="input-form" id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . esc_attr__( 'Comment *', 'biolife' ) . '">' .
	'</textarea></p>';
$fields            = array(
	'author' => '<div class="row"><div class="col-xs-12 col-sm-6"><p><input type="text" name="author" id="name" class="input-form" placeholder="' . esc_attr__( 'Name *', 'biolife' ) . '" /></p></div>',
	'email'  => '<div class="col-xs-12 col-sm-6"><p><input type="text" name="email" id="email" class="input-form" placeholder="' . esc_attr__( 'Email *', 'biolife' ) . '" /></p></div></div><!-- /.row -->',
);
$comment_form_args = array(
	'class_submit'  => 'button',
	'comment_field' => $comment_field,
	'fields'        => $fields,
	'label_submit'  => esc_html__( 'POST COMMENT', 'biolife' ),
	'title_reply'   => esc_html__( 'Leave a comment', 'biolife' ),
);
?>
<div id="comments" class="post-comments">
	<?php if ( have_comments() ) :
		$comments_number = get_comments_number(); ?>
        <h6 class="comments-title"><span><?php esc_html_e( ' COMMENTS', 'biolife' ) ?><i>(<?php echo esc_html( $comments_number ); ?>)</i></span></h6>
        <ol class="comment-list">
			<?php
			wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => true,
					'callback'   => 'biolife_callback_comment',
				)
			);
			?>
        </ol>
		<?php
	endif;
	the_comments_pagination( array(
			'screen_reader_text' => '',
			'prev_text'          => '<span class="screen-reader-text">' . esc_html__( 'Prev', 'biolife' ) . '</span>',
			'next_text'          => '<span class="screen-reader-text">' . esc_html__( 'Next', 'biolife' ) . '</span>',
		)
	);
	if ( !comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
        <p class="no-comments"><?php echo esc_html__( 'Comments are closed.', 'biolife' ); ?></p>
		<?php
	endif;
	comment_form( $comment_form_args );
	?>
</div><!-- #comments -->