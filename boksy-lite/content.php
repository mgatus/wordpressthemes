<?php
/**
 * @package boksy
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-article' ); ?>>
	<header class="entry-header">

		<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-thumbnail">
			<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail(); ?></a>
		</div>
		<?php endif; ?>

		<h1 class="entry-title"><a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php boksy_entry_meta(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( '<span class="read-more">' . __( 'Continue reading', 'boksy' ) . ' <i class="fa fa-arrow-circle-right"></i></span>' );;
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->