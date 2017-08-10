<?php
/**
 * @package boksy
 */
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'boksy' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search and press enter...', 'placeholder', 'boksy' ); ?>" title="<?php esc_attr_e( 'Press Enter to submit your search', 'boksy' ) ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	</label>
	<button class="search-submit" id="searchsubmit"><i class="fa fa-search"></i></button>
</form>