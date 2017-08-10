<?php
/**
 * The sidebar containing the footer widget area.
 *
 * @package boksy
 */

if ( ! is_active_sidebar( 'sidebar-2' ) && ! is_active_sidebar( 'sidebar-3' ) && ! is_active_sidebar( 'sidebar-4' ) ) {
	return;
}
?>

<div class="footer-widget-area clear" role="complementary">
	<div class="footer-widget">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</div>
	<div class="footer-widget">
		<?php dynamic_sidebar( 'sidebar-3' ); ?>
	</div>
	<div class="footer-widget">
		<?php dynamic_sidebar( 'sidebar-4' ); ?>
	</div>
</div><!-- #secondary -->