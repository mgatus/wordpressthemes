<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package boksy
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
		<div class="comments-header">
			<h2 class="comments-title">
				<?php
					printf(
						_n( '%1$s Comment', '%2$s Comments', get_comments_number(), 'comments title', 'boksy' ),
						'<span class="comments-no">0</span>', '<span class="comments-no">' . number_format_i18n( get_comments_number() )  . '</span>'
					);
				?>
			</h2>
		</div><!-- .comments-header -->


		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'style'				=> 'ul',
					'short_ping'	=> true,
					'callback'		=> 'boksy_list_comments'
				) );
			?>
		</ul><!-- .comment-list -->


		<?php boksy_comment_nav(); ?>


	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<div class="no-comments"><?php _e( 'Comments are closed', 'boksy' ); ?></div>
	<?php endif; ?>


	<?php boksy_comment_form(); ?>


</div><!-- #comments -->