<?php
/**
 * boksy Theme Customizer
 *
 * @package boksy
 */




/**
 * Add control templates for custom settings
 */
require get_template_directory() . '/inc/customizer-theme.php';
require get_template_directory() . '/inc/customizer-colors.php';




/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function boksy_customize_register( $wp_customize ) {

	/**
	 * Get options setting fields.
	 */
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';


	/**
	 * Add custom theme options section.
	 */
  $wp_customize->add_section( 'boksy_theme', array(
    'title'       => __( 'Theme Settings', 'boksy' ),
    'priority'    => 91,
    // 'panel'  => 'testing_panel',
  ) );


  /**
   * Add custom control templates.
   */
  boksy_customize_register_theme( $wp_customize );
  boksy_customize_register_colors( $wp_customize );

}
add_action( 'customize_register', 'boksy_customize_register' );




/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function boksy_customize_preview_js() {
	wp_enqueue_script( 'boksy_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), BOKSY_VERSION, true );
}
add_action( 'customize_preview_init', 'boksy_customize_preview_js' );




/**
 * Add a customizer setting and control.
 *
 * @see boksy_customize_register()
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * 				string 							 $name 				 Control name.
 * 				array 							 $options 		 Arguments of $wp_customize->add_control().
 */
function boksy_customize_add_control( $wp_customize, $input_type, $name, $options = array() ) {
  // Default transport
  $transport = 'postMessage';
  // Set transport if it's set
  if ( isset( $options['transport'] ) ) {
    $transport = $options['transport'];
    unset( $options['transport'] );
  }

  // Sanitize callback
  if ( $input_type == 'image' ) {
    $sanitize_cb = 'esc_url_raw';
  } else {
    $sanitize_cb = 'boksy_sanitize_' . $input_type;
  }

  // Set settings of the control
  $wp_customize->add_setting( $name, array(
    'default'     => boksy_customize_get_default_options( $name ),
    'capability'  => 'edit_theme_options',
    'transport'   => $transport,
    'sanitize_callback' =>  $sanitize_cb,
  ) );


  /**
   * Check if using predefined WP Class for the control options.
   *
   * @link http://codex.wordpress.org/Class_Reference/WP_Customize_Manager/add_control
   */
  if ( isset( $options['class'] ) ) {
    $classname = $options['class'];
    unset( $options['class'] );

    // Use predefined Class
    $wp_customize->add_control( new $classname( $wp_customize, $name, $options ) );
  } else {
  	// Use one of WP input types
    $wp_customize->add_control( $name, $options );
  }
}




if ( ! function_exists( 'boksy_customize_get_options' ) ) :
/**
 * Get customizer options.
 *
 * @param string (optional) $key
 * 				Customizer control name. If nothing is set, returns all options.
 *
 * @return array|mixed
 */
function boksy_customize_get_options( $key = null ) {
  if ( null === $key ) {
    return wp_parse_args( get_theme_mods(), boksy_customize_get_default_options() );
  } else {
    return get_theme_mod( $key, boksy_customize_get_default_options( $key ) );
  }
}
endif;




if ( ! function_exists( 'boksy_customize_get_default_options' ) ) :
/**
 * Get default customizer options.
 *
 * @param string (optional) $key Customizer control name. If nothing is set, returns all options.
 *
 * @return array|mixed
 */
function boksy_customize_get_default_options( $key = null ) {
  static $defaults;

  if ( ! isset( $defaults ) ) {
    $defaults = apply_filters( 'boksy_customize_default_theme_options', array() );
  }

  if ( null === $key ) {
  	// default for all options
    return $defaults;
  } else {
  	// default for specific option name
    return ( isset( $defaults[$key] ) ) ? $defaults[$key] : null;
  }
}
endif;



/**
 * Data sanitization
 */
function boksy_sanitize_textarea( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
function boksy_sanitize_integer( $input ) {
    return strip_tags( $input );
}
function boksy_sanitize_checkbox( $input ) {
  if ( $input == 1 ) {
    return 1;
  } else {
    return '';
  }
}
function boksy_sanitize_color( $input ) {
  return sanitize_hex_color( $input );
}


/**
 * Create global variable for theme options
 */
$boksy = boksy_customize_get_options();