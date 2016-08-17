<?php

if ( ! function_exists( 'my_setup' ) ):

function my_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

}
endif;

// Remove invalid tags
function remove_invalid_tags($str, $tags) 
{
    foreach($tags as $tag)
    {
    	$str = preg_replace('#^<\/'.$tag.'>|<'.$tag.'>$#', '', trim($str));
    }

    return $str;
}

// Remove Empty Paragraphs
add_filter('the_content', 'shortcode_empty_paragraph_fix');
function shortcode_empty_paragraph_fix($content)
{   
	$array = array (
			'<p>[' => '[', 
			']</p>' => ']', 
			']<br />' => ']'
	);

	$content = strtr($content, $array);

return $content;
}

setlocale(LC_ALL, 'en_US.UTF8');
function toAscii($str, $replace=array(), $delimiter='-') {
 if( !empty($replace) ) {
  $str = str_replace((array)$replace, ' ', $str);
 }

 $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
 $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
 $clean = strtolower(trim($clean, '-'));
 $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

 return $clean;
}

/*-----------------------------------------------------------------------------------*/
//  Theme Pagination Method
/*-----------------------------------------------------------------------------------*/
function theme_pagination($pages = ''){
    global $paged;

    if(is_page_template('template-home.php')){
        $paged = intval(get_query_var( 'page' ));
    }

    if(empty($paged))$paged = 1;

    $prev = $paged - 1;
    $next = $paged + 1;
    $range = 2; // only change it to show more links
    $showitems = ($range * 2)+1;

    if($pages == ''){
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages){
            $pages = 1;
        }
    }


    if(1 != $pages){
        echo "<div class='pagination' id='pagi'>";
        echo ($paged > 2 && $paged > $range+1 && $showitems < $pages)? "<a href='".get_pagenum_link(1)."' class='real-btn'>&laquo; ".__('First', 'framework')."</a> ":"";
        echo ($paged > 1 && $showitems < $pages)? "<a href='".get_pagenum_link($prev)."' class='real-btn' >&laquo; ". __('Previous', 'framework')."</a> ":"";

        for ($i=1; $i <= $pages; $i++){
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
                echo ($paged == $i)? "<a href='".get_pagenum_link($i)."' class='real-btn current' >".$i."</a> ":"<a href='".get_pagenum_link($i)."' class='real-btn'>".$i."</a> ";
            }
        }
        echo ($paged < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($next)."' class='real-btn' >". __('Next', 'framework') ." &raquo;</a> " :"";
        echo ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($pages)."' class='real-btn' >". __('Last', 'framework') ." &raquo;</a> ":"";
        echo "</div>";
    }
}   
 
/*-----------------------------------------------------------------------------------*/
/*	Custom Excerpt Method
/*-----------------------------------------------------------------------------------*/
function framework_excerpt($len=15, $trim="&hellip;"){
    $limit = $len+1;
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    $num_words = count($excerpt);
    if($num_words >= $len){
        $last_item = array_pop($excerpt);
    }
    else {
        $trim = "";
    }
    $excerpt = implode(" ",$excerpt)."$trim";
    echo $excerpt;
}

// The excerpt based on words
function my_string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words).'';
} 

/**
 * Cut string length to a specified words limit
 *
 * @param string $text
 * @param integer $limit
 *
 * @return string
 */
function trim_string_length( $text, $limit ) {
  $text = strip_tags( $text );
  if ( str_word_count( $text, 0 ) > $limit ) {
    $words = str_word_count( $text, 2 );
    $pos   = array_keys( $words );
    $text  = substr( $text, 0, $pos[ $limit ] );
  }

  return $text;
}


/**
 * Dimox Breadcrumbs
 * http://dimox.net/wordpress-breadcrumbs-without-a-plugin/
 * Since ver 1.0
 * Add this to any template file by calling dimox_breadcrumbs()
 * Changes: MC added taxonomy support
 */
function the_breadcrumb(){
  /* === OPTIONS === */
    $text['home']     = '<span class="home"><i class="fa fa-home"></i></span>'; // text for the 'Home' link
    $text['category'] = '%s'; // text for a category page
    $text['tax']      = '%s'; // text for a taxonomy page
    $text['search']   = 'Search Results for "%s" Query'; // text for a search results page
    $text['tag']      = 'Posts Tagged "%s"'; // text for a tag page
    $text['author']   = 'Articles Posted by %s'; // text for an author page
    $text['404']      = 'Error 404'; // text for the 404 page
    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter   = '<span class="sep">/</span>'; // delimiter between crumbs
    $before      = '<span class="current">'; // tag before the current crumb
    $after       = '</span>'; // tag after the current crumb
    /* === END OF OPTIONS === */
    global $post;
    $homeLink = get_bloginfo('url') . '/';
    $linkBefore = '<span typeof="v:Breadcrumb">';
    $linkAfter = '</span>';
    $linkAttr = ' rel="v:url" property="v:title"';
    $link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
    if (is_home() || is_front_page()) {
        if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $text['home'] . '</a></div>';
    } else {
        echo '<div class="wrap">' . sprintf($link, $homeLink, $text['home']) . $delimiter;
        
        if ( is_category() ) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo $cats;
            }
            echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;
        } elseif( is_tax() ){
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0) {
                $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo $cats;
            }
            echo $before . sprintf($text['tax'], single_cat_title('', false)) . $after;
        
        }elseif ( is_search() ) {
            echo $before . sprintf($text['search'], get_search_query()) . $after;
        } elseif ( is_day() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
            echo $before . get_the_time('d') . $after;
        } elseif ( is_month() ) {
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
            echo $before . get_the_time('F') . $after;
        } elseif ( is_year() ) {
            echo $before . get_the_time('Y') . $after;
        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
                if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
            } else {
                $cat = get_the_category(); $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, $delimiter);
                if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
                echo $cats;
                if ($showCurrent == 1) echo $before . get_the_title() . $after;
            }
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            echo $before . $post_type->labels->singular_name . $after;
        } elseif ( is_attachment() ) {
            $parent = get_post($post->post_parent);
            $cat = get_the_category($parent->ID); $cat = $cat[0];
            $cats = get_category_parents($cat, TRUE, $delimiter);
            $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
            $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
            echo $cats;
            printf($link, get_permalink($parent), $parent->post_title);
            if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
        } elseif ( is_page() && !$post->post_parent ) {
            if ($showCurrent == 1) echo $before . get_the_title() . $after;
        } elseif ( is_page() && $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo $breadcrumbs[$i];
                if ($i != count($breadcrumbs)-1) echo $delimiter;
            }
            if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
        } elseif ( is_tag() ) {
            echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
        } elseif ( is_author() ) {
            global $author;
            $userdata = get_userdata($author);
            echo $before . sprintf($text['author'], $userdata->display_name) . $after;
        } elseif ( is_404() ) {
            echo $before . $text['404'] . $after;
        }
        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
            echo __('Page') . ' ' . get_query_var('paged');
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        }
        echo '</div>';
    }
} // end dimox_breadcrumbs()

/*-----------------------------------------------------------------------------------*/
/*  Custom Widgets
/*-----------------------------------------------------------------------------------*/

// Primary Sidebar
register_sidebar( array(
    'id'            => 'primary-sidebar',
    'name'          => __( 'Primary Sidebar', 'yanaskincare' ),
    'description'   => __( '', 'yanaskincare' ),
    'before_widget' => '<div id="%1$s" class="widget-area">',
    'after_widget' => '</div>',
) );

// Secondary Sidebar
register_sidebar( array(
    'id'            => 'secondary-sidebar',
    'name'          => __( 'Secondary Sidebar', 'yanaskincare' ),
    'description'   => __( '', 'yanaskincare' ),
    'before_widget' => '<div id="%1$s" class="widget-area">',
    'after_widget' => '</div>',
) );

// Footer #1
register_sidebar( array(
    'id'            => 'footer-1',
    'name'          => __( 'Footer #1', 'yanaskincare' ),
    'description'   => __( '', 'yanaskincare' ),
    'before_widget' => '<div id="%1$s" class="widget-area">',
    'after_widget' => '</div>',
) );

// Footer #2
register_sidebar( array(
    'id'            => 'footer-2',
    'name'          => __( 'Footer #2', 'yanaskincare' ),
    'description'   => __( '', 'yanaskincare' ),
    'before_widget' => '<div id="%1$s" class="widget-area">',
    'after_widget' => '</div>',
) );

// Footer #3
register_sidebar( array(
    'id'            => 'footer-3',
    'name'          => __( 'Footer #3', 'yanaskincare' ),
    'description'   => __( '', 'yanaskincare' ),
    'before_widget' => '<div id="%1$s" class="widget-area">',
    'after_widget' => '</div>',
) );

// Register Post type Gallery
function gallery_post_type() {
    $labels = array(
        'name' => __( 'Gallery' ),
        'singular_name' => __( 'Gallery' ),
        'add_new' => __( 'New Gallery' ),
        'add_new_item' => __( 'Add New Gallery' ),
        'edit_item' => __( 'Edit Gallery' ),
        'new_item' => __( 'New Gallery' ),
        'view_item' => __( 'View Gallery' ),
        'search_items' => __( 'Search Gallery' ),
        'not_found' =>  __( 'No Gallery Found' ),
        'not_found_in_trash' => __( 'No Gallery found in Trash' ),
    );
    $args = array(
        'labels' => $labels,
        'has_archive' => true,
        'public' => true,
        'hierarchical' => true,
        'menu_icon' => 'dashicons-format-gallery',
        'supports' => array(
            'title',
            'thumbnail',
            'page-attributes'
        )
    );
    register_post_type( 'gallery', $args );
}
add_action( 'init', 'gallery_post_type', 0 );

// Register Gallery Taxonomy
add_action( 'init', 'gallery_taxonomies', 0 );
function gallery_taxonomies() {
    $labels = array(
        'name'              => _x( 'Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Categories' ),
        'all_items'         => __( 'All Categories' ),
        'parent_item'       => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item'         => __( 'Edit Category' ),
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category' ),
        'menu_name'         => __( 'Categories' ),
    );
    register_taxonomy(
        'gallery_categories', 'gallery',
        array(
            'hierarchical' => true,
            'labels' => $labels,
            'query_var' => true,
            'rewrite' => true,
            'show_admin_column' => true
        )
    );
}

// Register Services Post Type
add_action( 'init', 'services_post_type' );
function services_post_type() {  
    // set up labels
    $labels = array(
        'name' => 'Services',
        'singular_name' => 'Services',
        'add_new' => 'Add New',
        'add_new_item' => 'Add New Service Item',
        'edit_item' => 'Edit Service Item',
        'new_item' => 'New Service Item',
        'all_items' => 'All Services',
        'view_item' => 'View Service Item',
        'search_items' => 'Search Services',
        'not_found' =>  'No Services Found',
        'not_found_in_trash' => 'No Services found in Trash',
        'parent_item_colon' => '',
        'menu_name' => 'Services',
    );
    register_post_type(
        'services',
        array(
            'labels' => $labels,
            'has_archive' => true,
            'public' => true,
            'hierarchical' => true,
            'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes' ),
            'capability_type' => 'post',
        )
    );
}
 
// register two taxonomies to go with the post type
add_action( 'init', 'services_taxonomies', 0 );
function services_taxonomies() {
    $labels = array(
        'name'              => _x( 'Categories', 'taxonomy general name' ),
        'singular_name'     => _x( 'Category', 'taxonomy singular name' ),
        'search_items'      => __( 'Search Categories' ),
        'all_items'         => __( 'All Categories' ),
        'parent_item'       => __( 'Parent Category' ),
        'parent_item_colon' => __( 'Parent Category:' ),
        'edit_item'         => __( 'Edit Category' ),
        'update_item'       => __( 'Update Category' ),
        'add_new_item'      => __( 'Add New Category' ),
        'new_item_name'     => __( 'New Category' ),
        'menu_name'         => __( 'Categories' ),
    );
    register_taxonomy(
        'services_category',
        'services',
        array(
            'hierarchical' => true,
            'labels' => $labels,
            'query_var' => true,
            'rewrite' => true,
            'show_admin_column' => true
        )
    );
}


/**
 * Add support for shortcodes inside contact form 7
 * @link https://wordpress.org/support/topic/plugin-contact-form-7-include-custom-shortcodes-in-form
 */
function custom_wpcf7_form_elements( $form ) {
  $form = do_shortcode( $form );

  return $form;
}

add_filter( 'wpcf7_form_elements', 'custom_wpcf7_form_elements' );

/**
 * Add specific CSS body classes by filter
 * @link https://codex.wordpress.org/Function_Reference/body_class
 */
add_filter( 'body_class', 'custom_body_css' );
function custom_body_css( $classes ) {

    // front page check.
    if ( ! is_front_page() ) {
      $classes[] = 'not-home';
    }

    // touch device check.
    $detect = new Mobile_Detect;
    if ( ! $detect->isMobile() && ! $detect->isTablet() ) {
      $classes[] = 'non-touch';
    } else {
      $classes[] = ' touch';
    }

    return $classes;
}
if ( is_admin() ) {
    
    // Meta Boxes
    add_filter( 'rwmb_meta_boxes', 'your_prefix_meta_boxes' );
    function your_prefix_meta_boxes( $meta_boxes ) {
        // Banner page
        $meta_boxes[] = array(
            // Meta box id, UNIQUE per meta box. Optional since 4.1.5
            'id' => 'banner-meta-box',

            // Meta box title - Will appear at the drag and drop handle bar. Required.
            'title' => __('Page Layout','framework'),

            // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
            'pages' => array( 'page' ),

            // Where the meta box appear: normal (default), advanced, side. Optional.
            'context' => 'normal',

            // Order of meta box: high (default), low. Optional.
            'priority' => 'high',

            // List of meta fields
            'fields' => array(
                array(
                  'id'       => 'layout',
                  'name'     => __( 'Layout', 'framework' ),
                  'type'     => 'image_select',
                  // Array of 'value' => 'Image Source' pairs
                  'options'  => array(
                      'left'  => 'https://placeholdit.imgix.net/~text?txtsize=25&txt=left+sidebar&w=150&h=150',
                      'right' => 'https://placeholdit.imgix.net/~text?txtsize=25&txt=right+sidebar&w=150&h=150',
                      'both-sidebars'  => 'https://placeholdit.imgix.net/~text?txtsize=25&txt=both+sidebars&w=150&h=150',
                      'full'  => 'https://placeholdit.imgix.net/~text?txtsize=25&txt=full+width&w=150&h=150',
                  ),
                ),
                array(
                  'name'             => __('Custom Post Class','framework'),
                  'id'               => "custom_post_class",
                  'desc' => __('','framework'),
                  'type'             => 'text'
                )
            ),
        );
        // Custom Class Custom Field
        $meta_boxes[] = array(
            // Meta box id, UNIQUE per meta box. Optional since 4.1.5
            'id' => 'banner_img',

            // Meta box title - Will appear at the drag and drop handle bar. Required.
            'title' => __('Banner Top Image','framework'),

            // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
            'pages' => array( 'page' ),

            // Where the meta box appear: normal (default), advanced, side. Optional.
            'context' => 'normal',

            // Order of meta box: high (default), low. Optional.
            'priority' => 'high',

            // List of meta fields
            'fields' => array(
                array(
                    'name'             => __('Upload Banner Image','framework'),
                    'id'               => "banner_img",
                    'desc' => __('Images should have minimum width of 570px and minimum height of 318px, Bigger size images will be cropped automatically.','framework'),
                    'type'             => 'image_advanced',
                    'max_file_uploads' => 1
                )
            )
        );
         // Custom Class Custom Field
        $meta_boxes[] = array(
            // Meta box id, UNIQUE per meta box. Optional since 4.1.5
            'id' => 'banner_img',

            // Meta box title - Will appear at the drag and drop handle bar. Required.
            'title' => __('Banner Top Image','framework'),

            // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
            'pages' => array( 'services' ),

            // Where the meta box appear: normal (default), advanced, side. Optional.
            'context' => 'normal',

            // Order of meta box: high (default), low. Optional.
            'priority' => 'high',

            // List of meta fields
            'fields' => array(
                array(
                    'name'             => __('Upload Banner Image','framework'),
                    'id'               => "banner_img",
                    'desc' => __('Images should have minimum width of 570px and minimum height of 318px, Bigger size images will be cropped automatically.','framework'),
                    'type'             => 'image_advanced',
                    'max_file_uploads' => 1
                )
            )
        );
        // Custom Class Custom Field
        $meta_boxes[] = array(
            // Meta box id, UNIQUE per meta box. Optional since 4.1.5
            'id' => 'gallery',

            // Meta box title - Will appear at the drag and drop handle bar. Required.
            'title' => __('Photos for gallery','framework'),

            // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
            'pages' => array( 'gallery' ),

            // Where the meta box appear: normal (default), advanced, side. Optional.
            'context' => 'normal',

            // Order of meta box: high (default), low. Optional.
            'priority' => 'high',

            // List of meta fields
            'fields' => array(
                array(
                    'name'             => __('Upload Banner Image','framework'),
                    'id'               => "photos",
                    'desc' => __('Images should have minimum width of 295px and minimum height of 295px, Bigger size images will be cropped automatically.','framework'),
                    'type'             => 'image_advanced',
                    'max_file_uploads' => 100
                )
            )
        );
        return $meta_boxes;
    }
}


 



?>