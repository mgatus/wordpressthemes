<?php
/**
 * boksy Theme Customizer - Theme Settings
 *
 * @package boksy
 */




if ( ! function_exists( 'boksy_customize_register_theme' ) ) :
/**
 * Register custom control for theme customizer.
 *
 * @uses boksy_customize_add_control()
 *
 * @param object $wp_customize
 */
function boksy_customize_register_theme( $wp_customize ) {

  // Logo image
  boksy_customize_add_control( $wp_customize, 'image', 'theme_logo', array(
    'label'     => __( 'Upload Logo Image', 'boksy' ),
    'section'   => 'boksy_theme',
    'priority'  => 1,
    'class'     => 'WP_Customize_Image_Control',
    'transport' => 'refresh',
  ) );

  boksy_customize_add_control( $wp_customize, 'checkbox', 'theme_display_tagline', array(
    'label'     => __( 'Display site tagline?', 'boksy' ),
    'section'   => 'boksy_theme',
    'priority'  => 2,
    'type'      => 'checkbox',
  ) );

  boksy_customize_add_control( $wp_customize, 'checkbox', 'theme_display_sidebar', array(
    'label'     => __( 'Display sidebar on blog post page?', 'boksy' ),
    'section'   => 'boksy_theme',
    'priority'  => 4,
    'type'      => 'checkbox',
  ) );

  boksy_customize_add_control( $wp_customize, 'textarea', 'theme_footer_text', array(
    'label'     => __( 'Footer Text', 'boksy' ),
    'section'   => 'boksy_theme',
    'priority'  => 5,
    'type'      => 'textarea',
  ) );
}
endif;




if ( ! function_exists( 'boksy_customize_theme_defaults' ) ) :
/**
 * Custom filter: add default customizer options for the theme settings.
 */
function boksy_customize_default_theme_defaults( $defaults ) {
  return array_merge( $defaults, array(
    'theme_logo' => '',
    'theme_display_tagline' => true,
    'theme_display_sidebar' => false,
  ) );
}
endif;
add_filter( 'boksy_customize_default_theme_options', 'boksy_customize_default_theme_defaults' );




if ( ! function_exists( 'boksy_theme_display_sidebar_styles' ) ) :
/**
 * Apply settings values.
 */
function boksy_theme_display_sidebar_styles() {
  global $boksy;
  $display_sidebar = $boksy['theme_display_sidebar'];
  ?>
    <style id="boksy_display_sidebar">
      <?php if ( $display_sidebar ) : ?>
      .single .main-container {
        float: left;
        margin: auto;
      }
      <?php else : ?>
      .single .main-container {
        float: none;
        margin: 0 auto;
      }      
      .single .widget-area {
        display: none;
      }
      <?php endif; ?>
    </style>
  <?php
}
endif;
add_action( 'wp_head', 'boksy_theme_display_sidebar_styles', 999 );