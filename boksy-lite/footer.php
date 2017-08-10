<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package boksy
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-container">


			<?php get_sidebar( 'footer' ); ?>
			

			<div class="footer-footer">
				<div class="footer-meta">
					<div class="back-to-top">
						<a href="#page">
							<i class="fa fa-arrow-circle-up"></i>
						</a>
					</div>
				</div>

				<?php boksy_footer_text(); ?>
			</div><!-- .footer-footer -->

		</div><!-- .footer-container -->		
	</footer><!-- #colophon -->
</div><!-- #page -->


<?php wp_footer(); ?>

</body>
</html>