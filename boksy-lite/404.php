<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package boksy
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'boksy' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">

					<div class="error-404-container">
						<div class="error-404-icon"><i class="fa fa-chain-broken"></i></div>
						<div class="error-404">404</div>
					</div>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>