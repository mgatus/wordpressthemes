<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package boksy
 */




if ( ! function_exists( 'boksy_header_logo' ) ) :
/**
 * Display site logo.
 *
 * If display site title option is checked, display site title text.
 * If custom image is uploaded and display site title is unchecked, use custom image as logo.
 * If display site title is unchecked and no custom image is uploaded, use default theme logo.
 */
function boksy_header_logo() {
	$logo_image_link = boksy_customize_get_options( 'theme_logo' );

	if ( !empty( $logo_image_link ) ) {
	?>

		<img src="<?php echo esc_url( $logo_image_link ); ?>" alt="<?php _e( 'Logo', 'boksy'); ?>">

	<?php
	} else {
	?>

		<?php echo get_bloginfo( 'name', 'display' ); ?>
		
	<?php
	}
}
endif;




if ( ! function_exists( 'boksy_site_tagline' ) ) :
/**
 * Display site tagline
 */
function boksy_site_tagline() {
	global $boksy;
	if ( $boksy['theme_display_tagline'] ) {
	?>
		<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
	<?php
	}
}
endif;




if ( ! function_exists( 'boksy_footer_text' ) ) :
/**
 * Display footer text normally used for copyright info
 */
function boksy_footer_text() {
	$footer_text = boksy_customize_get_options( 'theme_footer_text' );

	if ( !empty( $footer_text ) ) {
	?>
		<div class="site-info">
			<?php echo esc_attr( $footer_text ); ?>
		</div><!-- .site-info -->	
	<?php
	} else {
	// defualt
	?>
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'boksy' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'boksy' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php
				printf(
						__( 'Theme: %1$s by %2$s.', 'boksy' ),
					'boksy',
					'<a href="https://creativemarket.com/gbobbd" rel="designer">gbobbd</a>'
				);
			?>
		</div><!-- .site-info -->
	<?php
	}
}
endif;




if ( ! function_exists( 'boksy_list_comments' ) ) :
/**
 * Display custom list of comments
 */
function boksy_list_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'boksy' ); ?>
			<?php comment_author_link(); ?>
			<?php edit_comment_link( __( 'Edit', 'boksy' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .comment-body-->
	</li>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'comment-parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			
			<div class="comment-avatar">
				<?php echo get_avatar( $comment, 48 ); ?>
			</div>

			<header class="comment-header">
				<div class="comment-author vcard">
					<?php echo get_comment_author_link(); ?>
				</div><!-- .comment-author -->


				<div class="comment-date">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php
							printf(
								_x( '%1$s - %2$s', '1: date, 2: time', 'make' ),
								get_comment_date(),
								get_comment_time()
							);
							?>
						</time>
					</a>
				</div><!-- .comment-date -->


				<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="comment-reply">',
					'after'     => '</div>',
				) ) );
				?>		

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'boksy' ); ?></p>
				<?php endif; ?>		
			</header><!-- .comment-header -->


			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->
		</article>
	</li>

	<?php endif;
}
endif;



if ( ! function_exists( 'boksy_entry_author' ) ) :
/**
 * Displays post author after the entry footer.
 */
function boksy_entry_author() {
	$author_ID 		= get_the_author_meta( 'ID' );
	$avatar 			= get_avatar( $author_ID, 60 );
	$name 				= get_the_author_meta( 'display_name', $author_ID );
	$website 			= get_the_author_meta( 'user_url', $author_ID );
	$description 	= get_the_author_meta( 'description', $author_ID) ;

	?>
		<div class="entry-author">
			<div class="entry-author-avatar"><?php echo $avatar; ?></div>

			<h6 class="entry-author-name">
				<?php _e( 'Written by: ', 'boksy' ); ?>
				<a href="<?php esc_url( '$website ' ); ?> "><?php echo $name ?></a>				
			</h6>
			<?php if ( $description ) : ?>
				<div class="entry-author-desc"><?php echo $description; ?></div>
			<?php else : ?>
				<div class="entry-author-desc"><?php __('The author has not yet added any personal or biographical info to his author profile.', 'boksy'); ?></div>
			<?php endif; ?>
		</div><!-- .entry-author -->
	<?php
}
endif;




if ( ! function_exists( 'boksy_comment_form' ) ) :
/**
 * Display custom list of comments
 */
function boksy_comment_form() {

	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );

	$placeholder_author		= __( 'Name', 'boksy' );
	$placeholder_email		= __( 'Email', 'boksy' );
	$placeholder_url			= __( 'Website', 'boksy' );
	$placeholder_comment	= __( 'Comment', 'boksy' );


	// custom inputs
	$fields = array(
	  'author' =>
	    '<div class="comment-form-author">
	    	<input id="author" name="author" class="comment-form-control" type="text" placeholder="' . $placeholder_author . ( $req ? '*' : '' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '"' . $aria_req . ' />
	    </div>',

	  'email' =>
	    '<div class="comment-form-email">
	    <input id="email" name="email" class="comment-form-control" type="text" placeholder="' . $placeholder_email . ( $req ? '*' : '' ) . '" value="' . esc_attr(  $commenter['comment_author_email'] ) . '"' . $aria_req . ' />
	    </div>',

	  'url' =>
	    '<div class="comment-form-url">
	    	<input id="url" name="url" class="comment-form-control" type="text" placeholder="' . $placeholder_url .'" value="' . esc_attr( $commenter['comment_author_url'] ) . '" />
	    </div>',
	);

	// custom textarea
	$comment_field =
		'<div class="comment-form-comment">
			<textarea id="comment" name="comment" class="comment-form-textarea" placeholder="' . $placeholder_comment .'"aria-required="true" rows="6"></textarea>
		</div>';


	$comment_form_args = array(
		'fields'							=> apply_filters( 'comment_form_default_fields', $fields ),
		'comment_field'				=> $comment_field,
		'comment_notes_before' => '',
		'comment_notes_after'	=> '',
		'label_submit'				=> __( 'Post', 'boksy' ),
		'title_reply'					=> __( 'Say Something', 'boksy' ),
  	'title_reply_to'			=> __( 'Leave a Reply to %s', 'boksy' ),
	);


	// the comment form
	comment_form( $comment_form_args );
}
endif;




if ( ! function_exists( 'boksy_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function boksy_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation clear" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'boksy' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<i class="fa fa-arrow-circle-left"></i> Older posts', 'boksy' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <i class="fa fa-arrow-circle-right"></i>', 'boksy' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;




if ( ! function_exists( 'boksy_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function boksy_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation clearfix" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'boksy' ); ?></h1>
		<div class="nav-links clear">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<i class="fa fa-arrow-circle-left"></i>%title', 'Previous post link', 'boksy' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title<i class="fa fa-arrow-circle-right"></i>', 'Next post link',     'boksy' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;




if ( ! function_exists( 'boksy_comments_nav' ) ) :
/**
 * Display navigation to next/previous comments when applicable.
 */
function boksy_comment_nav() {
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
	?>
	<nav id="comment-nav" class="comment-navigation" role="navigation">
		<?php 
			paginate_comments_links( array(
				'prev_text' => '<i class="fa fa-arrow-circle-left"></i>',
				'next_text' => '<i class="fa fa-arrow-circle-right"></i>'
			));
		?> 
	</nav><!-- #comment-nav-above -->
	<?php
	}
}
endif;




if ( ! function_exists( 'boksy_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function boksy_entry_meta() {

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
	?>
	<span class="entry-date">
		<i class="fa fa-clock-o"></i>
		<a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark"><?php echo $time_string; ?></a>
	</span>

	<span class="entry-author">
		<i class="fa fa-pencil"></i>
		<a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>"><?php echo esc_html( get_the_author() ); ?></a>
	</span>

	<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
		<span class="entry-comments-no">
			<i class="fa fa-comment-o"></i>
			<?php comments_popup_link( __( '0 comment', 'boksy' ), __( '1 Comment', 'boksy' ), __( '% Comments', 'boksy' ) ); ?>
		</span>
		<?php	endif; ?>
	<?php


	if ( is_single() ) {
		edit_post_link( __( 'Edit', 'boksy' ), '<span class="edit-link">', '</span>' );
	}
}
endif;




if ( ! function_exists( 'boksy_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function boksy_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		// Categories
		?>
			<div class="cat-links clear">
				<span class="cat-link-title"><?php _e( 'Categories', 'boksy' ); ?></span>
				<div class="cat-link-list"><?php echo get_the_category_list(); ?></div>
			</div>
			<?php

		// Tags
		?>
		<div class="tags-links">
			<span class="tags-link-title"><?php _e( 'Tags', 'boksy' ); ?></span>
			<span class="tags-link-list"><?php echo get_the_tag_list( '', __( '&nbsp;&nbsp;', 'boksy' ) ); ?></span>
		</div>
		<?php
	}
}
endif;




/**
 * Flush out the transients used in boksy_categorized_blog.
 */
function boksy_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'boksy_categories' );
}
add_action( 'edit_category', 'boksy_category_transient_flusher' );
add_action( 'save_post',     'boksy_category_transient_flusher' );
