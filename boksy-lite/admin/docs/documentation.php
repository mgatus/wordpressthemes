<?php
function boksy_register_documentation_admin_page() {

  add_theme_page(
  	__( 'Theme Documentation', 'boksy' ), // $page-slug
  	__( 'Theme Documentation', 'boksy' ), // $menu-title
  	'manage_options',
  	'documentation', // $menu-slug
  	'boksy_documentation_admin_page',		
  	'dashicons-info', // $icon_url
  	100
  ); 

}
add_action( 'admin_menu', 'boksy_register_documentation_admin_page' );




function boksy_documentation_admin_page() {


	$theme = wp_get_theme();
	$theme_version = $theme->get( 'Version' );

	$theme_screenshot = get_template_directory() . '/screenshot.png';
	$theme_screenshot_url = get_template_directory_uri() . '/screenshot.png';

	?>
	<div class="wrap" style="max-width: 700px;">


		<h2>Theme Documentation</h2>


		<div class="doc-header">
	 		<p>
				<?php
					printf( __( 
						'Hey! Thank you for using %sBoksy%s!', 'boksy' ),
						"<strong>",
						"</strong>"
					);
				?>
			</p>

			<p>
				<?php
					printf(
						__( 'Please note that this is the %slite version of Boksy%s. As this is meant to be a teaser for the full version, support is limited to bugs and errors while using the theme. If you like what you\'re seeing, check out the full version with more features %shere%s! Please feel free to email me at %sgbobbd@gmail.com%s.', 'boksy' ),
						"<strong>",
						"</strong>",
						"<a href='https://creativemarket.com/gbobbd/93233-Boksy-WordPress-Theme-for-Bloggers' target='_blank'>",
						"</a>",
						"<strong>",
						"</strong>"
					);
				?>
			</p>
		</div> <!-- /.doc-header -->
		



		<hr>




		<div class="doc-content">

			<div id="theme_info" class="theme-info">
				<h3><?php _e( 'Theme Information', 'boksy' ); ?></h3>

				<h4 class="theme-info-name">
					Boksy
					<span class="theme-version">v<?php echo $theme_version; ?></span>
				</h4>

				<p class="theme-info-author">
					<?php
						printf(
							_x(
								'By %sboksy%s',
								'by as in by the theme author',
								'boksy'
							),
							"<a href=''>",
							"</a>"
						);
					?>
				</p>

				<?php if ( file_exists( $theme_screenshot ) ) : ?>
				<p class="theme-screenshot">
					<img src="<?php echo esc_url( $theme_screenshot_url ); ?>" alt="Screenshot" style="max-width: 500px;">
				</p>
				<?php endif; ?>				

				<p class="theme-desc">
					<?php _e( 'Boksy is a clean and minimal responsiveWordPress theme for personal bloggers. Putting content first is the key focus in the overall design. It looks good both on large and small screens. If you are familiar to use WordPress, you already know how to use Boksy as it is built with the most essential and standards of the WordPress framework. Personalizing Boksy can never be easier as it takes advantage of one of WordPress most powerful tool - the customizer. Please check out the full version if you like it!', 'boksy'); ?>
				</p>
			</div> <!-- /.theme-info -->




			<hr>




			<div id="theme_options" class="theme_options">
				<h3><?php _e( 'Theme Options', 'boksy' ); ?></h3>

				<p>
				<?php
					printf(
						__( '%sBoksy\'s%s options are built around WordPress theme customizer which you can find under %sAppearance > Customize%s. Any editing done using the customizer will be %supdated live%s. That means no more %sF5%s spamming (yay).', 'boksy' ),
						"<strong>",
						"</strong>",
						"<code>",
						"</code>",
						"<strong>",
						"</strong>",
						"<strong>",
						"</strong>"
					);
				?>
				</p>

				<p>
					<?php _e( 'The options are very easy to understand, so please go ahead and try it right away.', 'boksy' ); ?>
				</p>
			</div> <!-- /.theme-setup -->





			<hr>
			



			<div id="theme_credits" class="theme-credits">
				<h3><?php _e( 'Credits', 'boksy' ); ?></h3>

		    <p>
		    	<?php
		    		printf(
		    			__( '%sBoksy%s is built using the following resources:', 'boksy' ),
		    			"<strong>",
		    			"</strong>"
		    		);
		    	?>
		    </p>

				<table class="form-table">					
					<tbody>
						<tr>
							<th><?php _e( 'Icons', 'boksy' ); ?></th>
	
							<td><a href="http://fortawesome.github.io/Font-Awesome/">FontAwesome</a></td>
						</tr>
	
						<tr>
							<th><?php _e( 'Fonts', 'boksy' ); ?></th>
	
							<td><a href="http://www.google.com/fonts/specimen/Raleway">Raleway</a></td>
						</tr>
					</tbody>
				</table>
			</div> <!-- /.theme-credits -->




			<hr>
			



			<div id="theme_license" class="theme_license">
				<h3><?php _e( 'License', 'boksy' ); ?></h3>

				<p>
					<?php
						printf(
							__( 'Boksy Lite WordPress Theme, Copyright 2014 %sgbobbd%s is distributed under the terms of the %sGNU General Public License v2%s.', 'boksy' ),
							"<a href=''>",
							"</a>",
							"<a href='http://www.gnu.org/licenses/gpl-2.0.html'>",
							"</a>"
						);
					?>
				</p>
			</div> <!-- /.theme-translation -->

		</div>  <!-- /.doc-content -->


	</div> <!-- /.wrap -->
	<?php

}




function boksy_documentation_admin_page_styles() {
?>
	<style id="theme_documentation_styles">
	   hr {
	   	margin: 24px 0;
	   }
	</style>
<?php
}
add_action( 'admin_print_styles-appearance_page_documentation', 'boksy_documentation_admin_page_styles' );




function boksy_documentation_notice() {

	$screen = get_current_screen();
	// return if it's not theme documentation page 
	if ( $screen->id !== 'appearance_page_documentation' ) {
		return;
	}

	?>
	<div class="update-nag">
 		<?php
 			printf(
        __( 'You are using the Lite version of this theme. Get the full version %shere%s!', 'boksy' ),
        "<a href='https://creativemarket.com/gbobbd/93233-Boksy-WordPress-Theme-for-Bloggers'>",
        "</a>"
      );
 		?>
  </div>
	<?php
}
add_action( 'admin_notices', 'boksy_documentation_notice' );
