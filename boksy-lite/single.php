<?php
/**
 * The template for displaying all single posts.
 *
 * @package boksy
 */
?>




<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
			
			<?php if ( has_post_thumbnail() ) : ?>
			<div class="entry-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
			<?php endif; ?>

			<div class="main-container">
				<?php get_template_part( 'content', 'single' ); ?>


				<?php boksy_post_nav(); ?>

				<?php boksy_entry_author(); ?>


				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) :
						comments_template();
					endif;
				?>
		</div><!-- .main-container -->

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>