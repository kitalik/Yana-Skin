<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

if(!function_exists('optionsframework_option_name')) {
	function optionsframework_option_name() {
		// This gets the theme name from the stylesheet (lowercase and without spaces)
		$themename = 'yanaskincare';
		
		$optionsframework_settings = get_option('optionsframework');
		$optionsframework_settings['id'] = $themename;
		update_option('optionsframework', $optionsframework_settings);
		
	}
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

 
if(!function_exists('optionsframework_options')) {

	function optionsframework_options() {
	
	
		// Pull all the categories into an array
		$options_categories = array();  
		$options_categories_obj = get_categories();
		foreach ($options_categories_obj as $category) {
				$options_categories[$category->cat_ID] = $category->cat_name;
		}
		
		// Pull all the pages into an array
		$options_pages = array();  
		$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
		$options_pages[''] = 'Select a page:';
		foreach ($options_pages_obj as $page) {
				$options_pages[$page->ID] = $page->post_title;
		}
			
		// If using image radio buttons, define a directory path
		$imagepath =  get_bloginfo('template_directory') . '/inc/images/';
			
		$options = array();
		
		// General
		$options[] = array( 
			"name" => "General",
			"type" => "heading"
		);
		
		$options['logo_url'] = array( 
			"name" => "Home Page Logo Image Path",
			"desc" => "Enter the direct path to your <strong>logo image</strong>. For example <em>http://your_website_url_here/wp-content/themes/themeXXXX/images/logo.png</em>",
			"id" => "logo_url",
			"type" => "upload"
		);
							
		$options['favicon'] = array( 
			"name" => "Favicon",
			"desc" => "Enter the direct path to your <strong>favicon</strong>. For example <em>http://your_website_url_here/wp-content/themes/themeXXXX/images/logo.png</em>",
			"id" => "favicon",
			"type" => "upload"
		);

		// Header
		$options[] = array(
			"name" => "Header",
			"type" => "heading"
		);
		$options['phone_text'] = array(
			"name" => "Phone Text",
			"desc" => "",
			"id"   => "phone_text",
			"std"  => "",
			"type" => "text"
		);	
		$options['phone'] = array(
			"name" => "Phone Number",
			"desc" => "",
			"id"   => "phone",
			"std"  => "",
			"type" => "text"
		);	
		$options['header_btn_text'] = array(
			"name" => "Button Text",
			"desc" => "",
			"id"   => "header_btn_text",
			"std"  => "",
			"type" => "text"
		);
		$options['header_btn_link'] = array(
			"name" => "Button Link",
			"desc" => "",
			"id"   => "header_btn_link",
			"std"  => "",
			"type" => "text"
		);	
		
		// Footer	
		$options[] = array( 
			"name" => "Footer",
			"type" => "heading"
		);
		$options['footer_address'] = array( 
			"name" => "Footer address",
			"desc" => "",
			"id"   => "footer_address",
			"std"  => "",
			"type" => "editor"
		);
		return $options;
	}
	
}

/* 
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');


if(!function_exists('optionsframework_custom_scripts')) {

	function optionsframework_custom_scripts() { ?>

		<script type="text/javascript">
		jQuery(document).ready(function($) {

			$('#example_showhidden').click(function() {
					$('#section-example_text_hidden').fadeToggle(400);
			});
			
			if ($('#example_showhidden:checked').val() !== undefined) {
				$('#section-example_text_hidden').show();
			}
		
		});
		</script>

		<?php
		}

}



