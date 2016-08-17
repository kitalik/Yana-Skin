<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'yanaskincare' ),
					number_format_i18n( get_comments_number() ), get_the_title() );
			?>
		</h2>
		<?php yanaskincare_comment_nav(); ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 71,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php yanaskincare_comment_nav(); ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'yanaskincare' ); ?></p>
	<?php endif; ?>


	<?php
	$comments_args = array(
		'comment_notes_before' => '<p class="comment-notes"><small></small></p>',
    'comment_notes_after' => '<p><small></small></p>',
     // redefine your own textarea (the comment body)
    'comment_field' => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun' ) . '</label><br /><textarea id="comment" name="comment" aria-required="true" placeholder="Type your comment here..." rows="8" cols="37" wrap="hard"></textarea></p>',
		'fields' => apply_filters( 'comment_form_default_fields', array(

    'author' =>
      '<p class="comment-form-author">' .
      '<input id="author" placeholder="Name" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
      '" size="30"' . $aria_req . ' />' . ( $req ? '<span style="color:red" class="required">*</span>' : '' ) . '</p>',

    'email' =>
      '<p class="comment-form-email">' .
      '<input id="email" placeholder="Email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
      '" size="30"' . $aria_req . ' />' . ( $req ? '<span style="color:red" class="required">*</span>' : '' ) . '</p>',

    'url' =>
      '<p class="comment-form-url">' .
      '<input id="url" placeholder="Website" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
      '" size="30" /></p>'
    )
  ),
);
	comment_form($comments_args); ?>

</div><!-- .comments-area -->
