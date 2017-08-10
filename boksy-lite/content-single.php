<?php
/**
 * @package boksy
 */
?>




<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">


		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php boksy_entry_meta(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'boksy' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php boksy_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->