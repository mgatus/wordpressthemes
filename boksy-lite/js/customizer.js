/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	/**
	 * Site title and description.
	 */
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );




	/**
	 * Color Settings
	 */
	wp.customize( 'accent_color', function( value ) {
		value.bind( function( to ) {
			var el = $( '#boksy_accent_color' );
			var css = el.text();
			css = css.replace(/:(#[0-9A-Fa-f]{3,6})/g, ':' + to );
			el.text( css );
		} );
	} );




	/**
	 * Theme Settings
	 */
	wp.customize( 'theme_logo', function( value ) {
		value.bind( function( to ) {
			$('.site-title')
				.toggle( ( to !== '' ) )
				.find('img')
				.attr( 'src', to );
		} );
	} );


	wp.customize( 'theme_display_tagline', function( value ) {
		value.bind( function( to ) {
			$('.site-description').toggle( to );
		});
  });


	wp.customize( 'theme_display_sidebar', function( value ) {
		value.bind( function( to ) {
			var sidebar_is_shown = to; // true or false

			$('.single .widget-area').toggle( to );

			if ( sidebar_is_shown ) {
				$('.single .main-container').css({
					float: 'left',
					margin: ''
				});
			} else {
				$('.single .main-container').css({
					float: 'none',
					margin: '0 ' + 'auto'
				});
			}
		});
  });


	wp.customize( 'theme_footer_text', function( value ) {
		value.bind( function( to ) {
			$('.site-info').html( to );
		});
  });

} )( jQuery );