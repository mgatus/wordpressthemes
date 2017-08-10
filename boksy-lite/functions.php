<?php
/**
 * boksy functions and definitions
 *
 * @package boksy
 */

define( 'BOKSY_VERSION', wp_get_theme()->get( 'Version' ) );




if ( ! function_exists( 'boksy_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function boksy_setup() {
	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 2048; /* pixels */
	}


	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on boksy, use a find and replace
	 * to change 'boksy' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'boksy', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );


	/*
   * Add editor styles.
   */
	$font_url = urlencode( '//fonts.googleapis.com/css?family=Raleway:300,700' );
  add_editor_style( 'css/editor-style.css', $font_url );


	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'boksy' ),
	) );


	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );


	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'boksy_custom_background_args', array(
		'default-color' => 'f5f5f5',
	) ) );
}
endif; // boksy_setup
add_action( 'after_setup_theme', 'boksy_setup' );




/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function boksy_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Sidebar Widgets', 'boksy' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widgets', 'boksy' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widgets 2', 'boksy' ),
		'id'            => 'sidebar-3',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widgets 3', 'boksy' ),
		'id'            => 'sidebar-4',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

}
add_action( 'widgets_init', 'boksy_widgets_init' );

if(function_exists('add_image_size')) {
	add_image_size('300x180',300,180,true);
	add_image_size('banner',1000,300,true);
}

/*
Prepare REST
*/
function prepare_rest($data,$post,$request) {
	$_data = $data->data;

	$thumbnail_id = get_post_thumbnail_id($post->ID);
	$thumbnail300x180 = wp_get_attachment_image_src($thumbnail_id, '300x180');
	$thumbnailbanner = wp_get_attachment_image_src($thumbnail_id, 'banner');

	$cats = get_the_category($post->ID);

	// next/prev

	$nextPost = get_adjacent_post(false,'',true);
	$nextPost = $nextPost->ID;

	$prevPost = get_adjacent_post(false,'',false);
	$prevPost = $prevPost->ID;

	$_data['fi_300x180'] = $thumbnail300x180[0];
	$_data['banner'] = $thumbnailbanner[0];

	$_data['cats'] = $cats;

	$_data['next_post'] = $nextPost;
	$_data['prev_post'] = $prevPost;

	$data->data = $_data;

	return $data;



}

add_filter('rest_prepare_post', 'prepare_rest', 10, 3);

/**
 * Enqueue styles and scripts.
 */
function boksy_style_scripts() {

	/**
	 * Stylesheets
	 */
	// Icon font
	wp_enqueue_style( 'boksy-font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '4.2.0' );
	// Custom font
	wp_enqueue_style( 'boksy-raleway', "//fonts.googleapis.com/css?family=Raleway:300,700" );
	// Main stylsheet
	wp_enqueue_style( 'boksy-style', get_stylesheet_uri() );
	// Custom Stylesheet
	wp_enqueue_style( 'boksy-custom', get_template_directory_uri() . '/css/custom.css');


	/**
	 * JS Scripts
	 */
	//wp_enqueue_script( 'masonry' );
	// wp_enqueue_script( 'boksy-js', get_template_directory_uri() . '/js/theme.js', array( 'jquery' ), BOKSY_VERSION, true );
	// wp_enqueue_script( 'boksy-vue-js', get_template_directory_uri() . '/js/vue.js');
	// wp_enqueue_script( 'boksy-vue-router', get_template_directory_uri() . '/js/vue-router.min.js');
	// wp_enqueue_script( 'boksy-vue-resource', get_template_directory_uri() . '/js/vue-resource.min.js');
	wp_enqueue_script( 'boksy-app', get_template_directory_uri() . '/dist/bundle.js');


	// Load script for comments when available
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'boksy_style_scripts' );




/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';


/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';




/**
 * Load theme documentation in admin panel.
 */
require get_template_directory() . '/admin/docs/documentation.php';
