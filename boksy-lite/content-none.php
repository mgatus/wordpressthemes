<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package boksy
 */
?>

<section class="no-results not-found">
	<header class="page-header">
		<?php if ( is_search() ) : ?>
			<h1 class="page-title"><?php printf( __( 'Searched for: %s.', 'boksy' ), '<span class="search-query">' . get_search_query() . '</span>' ); ?></h1>
		<?php else : ?>
			<h1 class="page-title"><?php _e( 'Nothing Found', 'boksy' ); ?></h1>
		<?php endif; ?>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'boksy' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php else : ?>

			<div class="nothing-found">
				<div class="nothing-found-icon"><i class="fa fa-question"></i></div>
				<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Please try searching something else.', 'boksy' ); ?></p>
				<?php get_search_form(); ?>
			</div>

		<?php endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->