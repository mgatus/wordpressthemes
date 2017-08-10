<?php
/**
 * boksy Theme Customizer - Color Settings
 *
 * @package boksy
 */




if ( ! function_exists( 'boksy_customize_register_colors' ) ) :
/**
 * Register custom control for colors.
 *
 * @uses boksy_customize_add_control()
 *
 * @param object $wp_customize
 */
function boksy_customize_register_colors( $wp_customize ) {
  // Logo image
  boksy_customize_add_control( $wp_customize, 'color','accent_color', array(
    'label'     => __( 'Choose Accent Color', 'boksy' ),
    'section'   => 'colors',
    'priority'  => 1,
    'class'     => 'WP_Customize_Color_Control',
  ) );
}
endif;




if ( ! function_exists( 'boksy_customize_colors_defaults' ) ) :
/**
 * Custom filter: add default customizer options for the colors settings.
 */
function boksy_customize_default_colors_defaults( $defaults ) {
  return array_merge( $defaults, array(
    'accent_color' => '#ff5722',
  ) );
}
endif;
add_filter( 'boksy_customize_default_theme_options', 'boksy_customize_default_colors_defaults' );




if ( ! function_exists( 'boksy_customize_colors_styles' ) ) :
/**
 * Apply settings values.
 */
function boksy_customize_colors_styles() {
  global $boksy;
  $accent_color = $boksy['accent_color'];
  ?>
    <style id="boksy_accent_color">
      .main-navigation .menu > li > a:before,
      .main-navigation .menu > .current-menu-item > a:before,
      .bypostauthor .comment-author:before,
      .bypostauthor .comment-author a:before,
      .error-404-icon i,
      .nothing-found-icon i,
      .widget li:before,
      .back-to-top a:hover,
      .menu-toggle.is-active i {
        color:<?php echo $accent_color; ?>;
      }

      button,
      .button,
      input[type="button"],
      input[type="reset"],
      input[type="submit"],
      .footer-widget .widget-title:after,
      .post-edit-link,
      .comment-reply-link,
      #cancel-comment-reply-link,
      .widget_tag_cloud .tagcloud a:hover,
      .footer-widget #wp-calendar caption:after {
        background-color:<?php echo $accent_color; ?>;
      }
    </style>
  <?php
}
endif;
add_action( 'wp_head', 'boksy_customize_colors_styles', 999 );