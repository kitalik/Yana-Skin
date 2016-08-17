<?php
/**
 * Custom buttons
 * Inspired by https://www.gavick.com/blog/wordpress-tinymce-custom-buttons
 */
/*
Plugin Name: TinyMCE custom buttons
Author: Teddy Bear
Version: 1.0
Author URI: http://weblabmedia.eu/
Description: Enhance WYSISWYG editor with shortcodes buttons.
*/

// todo: 1) add google map shortcode icon;

add_action( 'admin_head', 'add_tiny_mce_buttons' );
add_action( 'admin_enqueue_scripts', 'add_tiny_mce_buttons_css' );

/**
 * Declaring a new TinyMCE button
 */
function add_tiny_mce_buttons() {
  // check user permissions
  if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
    return;
  }
  // Select necessary post types.
  $args  = array( '_builtin' => FALSE, 'public' => TRUE );
  $types = get_post_types( $args, 'names' );
  array_push( $types, 'post' );

  // Form array in proper format.
  $post_types = array();
  foreach ( $types as $type ) {
    $obj          = new stdClass();
    $obj->text    = ucfirst( $type );
    $obj->value   = $type;
    $post_types[] = $obj;
  }
  $post_types = json_encode( $post_types );

  echo "<script>var postTypes = " . $post_types . "</script>";

  /**
   * restrict icon to certain post types if necessary
   */
  /*global $typenow;
  if ( ! in_array( $typenow, array( 'post', 'page' ) ) ) {
    return;
  }*/

  // check if WYSIWYG is enabled
  if ( get_user_option( 'rich_editing' ) == 'true' ) {
    add_filter( "mce_external_plugins", "add_tinymce_handlers" );
    add_filter( 'mce_buttons_3', 'register_tiny_mce_buttons' );
  }
}

/**
 * Specify path to the script with plugin for TinyMCE
 *
 * @param array $plugin_array
 *
 * @return array
 */
function add_tinymce_handlers( $plugin_array ) {
  $path                          = get_template_directory_uri() . '/inc/TinyMCE-shortcodes-buttons/';
  $plugin_array['grid_elements'] = $path . 'grid_elements.js';
  $plugin_array['boxes']         = $path . 'boxes.js';
  $plugin_array['add_content']   = $path . 'add_content.js';
  $plugin_array['table']         = $path . 'table.js';
  $plugin_array['lorem_ipsum']   = $path . 'lorem_ipsum.js';
  $plugin_array['mobile_detect'] = $path . 'mobile_detect.js';

  return $plugin_array;
}

/**
 * Add buttons to the editor.
 *
 * @param array $buttons
 *
 * @return array
 */
function register_tiny_mce_buttons( $buttons ) {
  array_push( $buttons, "grid_elements", "add_content", "boxes", "table", "mobile_detect", "lorem_ipsum" );

  return $buttons;
}

/**
 * Add styles.
 */
function add_tiny_mce_buttons_css() {
  $path = get_template_directory_uri() . '/inc/TinyMCE-shortcodes-buttons/';
  wp_enqueue_style( 'tiny_mce_buttons_css', $path . 'style.css' );
}
