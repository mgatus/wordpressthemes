<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package boksy
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>




<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<h1 class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php boksy_header_logo(); ?>
				</a>
			</h1>
			<?php boksy_site_tagline(); ?>
		</div>

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<span class="menu-toggle"><?php _e( 'Menu', 'boksy' ); ?><i class="fa fa-bars"></i></span>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'after' => '') ); ?>

			<?php get_search_form(); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		
