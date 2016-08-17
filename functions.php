<?php
/**
 * functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 */

if ( ! function_exists( 'theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Theme 1.0
 */
function theme_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on yanaskincare, use a find and replace
	 * to change 'yanaskincare' to the name of your theme in all the template files
	 */

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'yanaskincare' ),
		'secondary' => __( 'Secondary Menu',      'yanaskincare' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

}
endif; // theme_setup
add_action( 'after_setup_theme', 'theme_setup' );


/**
 * Enqueue scripts and styles.
 *
 * @since Theme 1.0
 */
function yanaskincare_scripts() {
	// Load our main stylesheet.
	wp_enqueue_style( 'yanaskincare-style', get_stylesheet_uri() );

	wp_enqueue_script( 'yanaskincare-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20141212', true );
}
add_action( 'wp_enqueue_scripts', 'yanaskincare_scripts' );


/**
 * Display descriptions in main navigation.
 *
 * @since Theme 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function yanaskincare_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'yanaskincare_nav_description', 10, 4 );


/**
 * Custom template tags for this theme.
 *
 * @since Theme 1.0
 */
require get_template_directory() . '/inc/template-tags.php';

//Shortcodes
require get_template_directory() . '/inc/theme_shortcodes/shortcodes.php';
require get_template_directory() . '/inc/widgets/featured-post-widget.php' ;
require get_template_directory() . '/theme-init.php';
require get_template_directory() . '/Mobile_Detect.php';
require get_template_directory() . '/aq_resizer.php';
require get_template_directory() . '/widget-css-classes/widget-css-classes.php';

function wpse97413_register_custom_widgets() {
    register_widget( 'WP_Widget_My_Custom_Recent_Posts' );
}
add_action( 'widgets_init', 'wpse97413_register_custom_widgets' );

/**
 * Load styles.
 *
 */
add_action( 'wp_enqueue_scripts', 'load_custom_stylesheet' );
function load_custom_stylesheet() {
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap-grid.css' );

    /* ============ Media Query Styles ================= */
    wp_enqueue_style( 'custom', get_template_directory_uri() . '/css/style.css' );

    /* ============ Mmenu Responsive ================= */
    wp_enqueue_style( 'mmenu', get_template_directory_uri() . '/css/jquery.mmenu.css', array(), '5.5.3' );

    wp_enqueue_style( 'fonts', '//fonts.googleapis.com/css?family=Poppins:400,300,500|Pacifico|Open+Sans:400,300,700|Raleway:300,400,700,500');
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.5.0' );

    if (is_front_page()) {
    	/* ============ Owl carousel ================= */
    	wp_enqueue_style( 'carousel', get_template_directory_uri() . '/css/owl.carousel.min.css', array(), '5.5.3' );
    }

  	/* ============ swipebox css ================= */
  	wp_enqueue_style( 'swipebox', get_template_directory_uri() . '/css/swipebox.css' );
} 

/**
 * Load JS Files
 *
 */
add_action( 'wp_enqueue_scripts', 'load_scripts' );
function load_scripts() {
    wp_enqueue_script('scripts', get_template_directory_uri() .'/js/default-scripts.js');

    wp_register_script( 'bootstrap', get_template_directory_uri() .'/js/bootstrap.min.js' );
    wp_enqueue_script ( 'bootstrap' );

    /* ============ Responsive Menu  ================= */
    wp_register_script( 'mmenu', get_template_directory_uri() .'/js/jquery.mmenu.min.js' );
    wp_enqueue_script ( 'mmenu' );

    /* ============ Superfish Menu ================= */   
    wp_register_script( 'superfish', get_template_directory_uri(). '/js/superfish.min.js' );
    wp_enqueue_script ( 'superfish' );

    /* ============ Smoothscroll ================= */
    wp_register_script( 'smoothscroll', get_template_directory_uri() . '/js/jquery.simplr.smoothscroll.min.js' );
    wp_enqueue_script ( 'smoothscroll' );  

    /* ============ Device ================= */
    wp_register_script( 'device', get_template_directory_uri() . '/js/device.min.js' );
    wp_enqueue_script ( 'device' );  

    /* ============ Device ================= */
    wp_register_script( 'mousewheel', '//cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.0.6/jquery.mousewheel.min.js' );
    wp_enqueue_script ( 'mousewheel' );

    wp_enqueue_script( 'easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array( 'jquery' ), '1.3', TRUE );

    /* ============ swipebox ================= */
  	wp_enqueue_script( 'swipebox', get_template_directory_uri() . '/js/jquery.swipebox.js', array( 'jquery' ), '1.3', TRUE );
  	wp_enqueue_script( 'swipebox-init', get_template_directory_uri() . '/js/swipebox-init.js', array( 'jquery' ), '1.3', TRUE );
    

    if (is_front_page()) {
    	wp_enqueue_script( 'carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '1.3', TRUE );
    	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array( 'jquery' ), '1.3', TRUE );
    	wp_enqueue_script( 'home-scripts', get_template_directory_uri() . '/js/home-scripts.js' );
    }
}

// Image Size
@define( 'PARENT_DIR', get_template_directory() );
@define( 'CHILD_DIR', get_stylesheet_directory() );

@define( 'PARENT_URL', get_template_directory_uri() );
@define( 'CHILD_URL', get_stylesheet_directory_uri() );

/* 
* Loads the Options Panel
*
* If you're loading from a child theme use stylesheet_directory
* instead of template_directory
*/
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', PARENT_URL . '/admin/' );
	include_once(PARENT_DIR . '/admin/options-framework.php');
}

//Loading options.php for theme customizer
include_once(PARENT_DIR . '/options.php');

/*-----------------------------------------------------------------------------------*/
/*	Include Meta Box
/*-----------------------------------------------------------------------------------*/
define( 'RWMB_URL', trailingslashit( PARENT_URL . '/framework/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( PARENT_DIR . '/framework/meta-box' ) );
require_once RWMB_DIR . 'meta-box.php';


/**
 * Include TinyMCE shortcodes buttons widget
 */
require_once PARENT_DIR . '/inc/TinyMCE-shortcodes-buttons/custom-buttons.php';
require_once PARENT_DIR . '/inc/wp-mobile-detect/wp-mobile-detect.php';