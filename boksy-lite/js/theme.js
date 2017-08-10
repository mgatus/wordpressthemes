(function( $ ){

  "use strict";

$(document).ready(function() {

	/* ===========================================
		Custom Theme JS
	=========================================== */
	/**
	 * Search form in Main Navigation
	 */
	// click search button to open form
	$('.menu-item-search a').click(function(e){
		e.preventDefault();
		$(this).toggleClass('is-active');
		$('.main-navigation .search-form').slideToggle();


		// Toggle search icon during open and close state.
		if ($(this).hasClass('is-active')) {
			$(this).find('i').removeClass('fa-search').addClass('fa-close');
		} else {
			$(this).find('i').removeClass('fa-close').addClass('fa-search');
		}
	});

	// if ESC key is pressed when search form is opened, close search form
	$(document).keyup(function(e) {
		if (e.keyCode === 27 && $('.menu-item-search a').hasClass('is-active')) {
			$('.menu-item-search a').click();
		}
	});



	/**
	 * Main Mobile Menu
	 */
	$('.menu-toggle').click(function(){
		$('.menu').slideToggle();

		$(this).toggleClass('is-active');
	});


	$('.menu-item-has-children').children('a').click(function(e){
		e.preventDefault();
		$(this).parent().children('.sub-menu').slideToggle();

		$(this).parent().toggleClass('is-open');
	});




	/* ===========================================
		Plugins
	=========================================== */
	/**
	 * Masonry
	 */
	if( $('.entry-masonry').length ) {
		var container = document.querySelector('.entry-masonry');
		var msnry;
		imagesLoaded( container, function() {
			msnry = new Masonry( container, {
				itemSelector: '.entry-article'
			});
		});
	}

});

})( jQuery );