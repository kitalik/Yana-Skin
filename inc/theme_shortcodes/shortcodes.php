<?php

/**
 * Layout controls & grid markup based on Bootstrap version 3.* framework.
 */

// Container
function container_shortcode( $atts, $content = NULL ) {

  extract( shortcode_atts( array(
    'class' => ''
  ), $atts ) );

  // add divs to the content
  $output = '<div class="container ' . $class . '">';
  $output .= do_shortcode( $content );
  $output .= '</div> <!-- .container (end) -->';

  return $output;
}

add_shortcode( 'container', 'container_shortcode' );

// Row
function row_shortcode( $atts, $content = NULL ) {

  extract( shortcode_atts( array(
    'class' => ''
  ), $atts ) );

  // add divs to the content
  $output = '<div class="row ' . $class . '">';
  $output .= do_shortcode( $content );
  $output .= '</div> <!-- .row (end) -->';

  return $output;
}

add_shortcode( 'row', 'row_shortcode' );

// Row inner
function row_inner_shortcode( $atts, $content = NULL ) {

  extract( shortcode_atts( array(
    'class' => ''
  ), $atts ) );

  // add divs to the content
  $output = '<div class="row ' . $class . '">';
  $output .= do_shortcode( $content );
  $output .= '</div> <!-- .row inner (end) -->';

  return $output;
}

add_shortcode( 'row_inner', 'row_inner_shortcode' );

/**
 * Columns: add bootstrap classes to make grid layout.
 * Eg.: [column class="col-sm-6"]
 */
function column_shortcode( $atts, $content = NULL ) {

  extract( shortcode_atts( array(
    'class' => ''
  ), $atts ) );

  $return = '<div class="' . $class . '">';
  $return .= do_shortcode( $content );
  $return .= '</div>';

  return $return;
}

add_shortcode( 'column', 'column_shortcode' );

// Column inner
function column_inner_shortcode( $atts, $content = NULL ) {

  extract( shortcode_atts( array(
    'class' => ''
  ), $atts ) );

  $return = '<div class="' . $class . '">';
  $return .= do_shortcode( $content );
  $return .= '</div>';

  return $return;
}

add_shortcode( 'column_inner', 'column_inner_shortcode' );

// Wrapper
function wrapper_shortcode( $atts, $content = NULL ) {

  extract( shortcode_atts( array(
    'class' => ''
  ), $atts ) );

  // add divs to the content
  $output = '<div class="wrapper ' . $class . '">';
  $output .= do_shortcode( $content );
  $output .= '</div> <!-- .row (end) -->';

  return $output;
}

add_shortcode( 'wrapper', 'wrapper_shortcode' );

// Text
function text_shortcode( $atts, $content = NULL ) {

  extract( shortcode_atts( array(
    'class' => ''
  ), $atts ) );

  // add divs to the content
  $output = '<div class="text ' . $class . '">';
  $output .= do_shortcode( $content );
  $output .= '</div> <!-- .row (end) -->';

  return $output;
}

add_shortcode( 'text', 'text_shortcode' );

// Universal block wrapper for styling purposes.
function block_shortcode( $atts, $content = NULL ) {

  extract( shortcode_atts( array(
    'class' => ''
  ), $atts ) );

  // add divs to the content
  $output = '<div class="block ' . $class . '">';
  $output .= do_shortcode( $content );
  $output .= '</div>';

  return $output;
}

add_shortcode( 'block', 'block_shortcode' );

// Clear
function clear_shortcode( $atts, $content = NULL ) {

  $output = '<div class="clear"></div>';

  return $output;
}

add_shortcode( 'clear', 'clear_shortcode' );

// Spacer
function spacer_shortcode( $atts, $content = NULL ) {

  $output = '<div class="spacer"></div>';

  return $output;
}

add_shortcode( 'spacer', 'spacer_shortcode' );

// Divider
function divider_shortcode( $atts, $content = NULL ) {

  $output = '<div class="divider"></div>';

  return $output;
}

add_shortcode( 'divider', 'divider_shortcode' );

// HR
function hr_shortcode( $atts, $content = NULL ) {

  $output = '<div class="hr"></div>';

  return $output;
}

add_shortcode( 'hr', 'hr_shortcode' );


/**
 * Content adding section
 */
// Content (list of recent posts by default)
// todo: make shortcode more flexible and universal.
function shortcode_content( $atts, $content = NULL ) {
  extract( shortcode_atts( array(
    'post_type'        => 'post',
    'category'         => '',
    'custom_category'  => '',
    'layout'           => 'primary',
    'num'              => '-1',
    'meta'             => 'false',
    'thumb'            => 'false',
    'thumb_width'      => '120',
    'thumb_height'     => '120',
    'more_text_single' => '',
    'excerpt_count'    => '0',
    'content_count'    => '0',
    'wrapper_tag'      => 'div',
    'class'            => '',
    'class_item'       => ''
  ), $atts ) );
  if ( $wrapper_tag == 'div' ) {
    $item_tag = $wrapper_tag;
  } else {
    $item_tag = 'li';
  }
  $output = '<' . $wrapper_tag . ' class="recent-posts ' . $class . '">';
  // Split items into columns.
  /*if ( $layout == 'secondary' ) {
    $output .= '<div class="column ' . $class_item . '">';
  }*/
  global $post;
  $args = array(
    'post_type'              => $post_type,
    'category_name'          => $category,
    $post_type . '_category' => $custom_category,
    'numberposts'            => $num,
    'orderby'                => 'post_date',
    'order'                  => 'DESC'
  );
  $latest = get_posts( $args );
  $i = 0;
  foreach ( $latest as $post ) {
    setup_postdata( $post );
    $excerpt        = get_the_excerpt( $post->ID );
    $content        = get_the_content( $post->ID );
    $attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
    $url            = $attachment_url['0'];
    $image          = aq_resize( $url, $thumb_width, $thumb_height, TRUE );
    $post_classes = get_post_class();
    foreach ( $post_classes as $key => $value ) {
      $pos = strripos( $value, 'tag-' );
      if ( $pos !== FALSE ) {
        unset( $post_classes[ $i ] );
      }
    }
    $post_classes = implode( ' ', $post_classes );
    // Major layouts.
    switch ( $layout ) {
      // Default layout.
      case 'primary':
        $output .= '<' . $item_tag . ' class="' . $post_classes . ' ' . $class_item . '"><div class="wrapper">';
        if ( $thumb == 'true' ) {
          if ( has_post_thumbnail( $post->ID ) ) {
            $output .= '<figure class="featured-thumbnail"><a href="' . get_permalink( $post->ID ) . '" title="' . get_the_title( $post->ID ) . '">';
            if ( $image ) {
              $output .= '<img  src="' . $image . '" alt="' . get_the_title( $post->ID ) . '"/>';
            } else {
              $output .= '<img  src="' . $url . '" alt="' . get_the_title( $post->ID ) . '"/>';
            }
            $output .= '</a></figure>';
          }
        }
        $output .= '<div class="wrap-info">';
        $output .= '<h5><a href="' . get_permalink( $post->ID ) . '" title="' . get_the_title( $post->ID ) . '">';
        $output .= get_the_title( $post->ID );
        $output .= '</a></h5>';
        if ( $meta == 'true' ) {
          $output .= '<span class="meta">';
          $output .= '<span class="day">' . get_the_time( 'd' ) . '/</span><span class="months">' . get_the_time( 'm' ) . '/</span><span class="year">' . get_the_time( 'Y' ) . '</span>';
          $output .= '</span>';
        }
        if ( $excerpt_count >= 1 || $content_count >= 1 ) {
          $output .= '<div class="post-content">';
          if ( $excerpt_count >= 1 ) {
            $output .= '<div class="excerpt">';
            $output .= trim_string_length( $excerpt, $excerpt_count );
            $output .= '</div>';
          }
          if ( $content_count >= 1 ) {
            $output .= '<div class="content">';
            $output .= trim_string_length( $content, $content_count );
            $output .= '</div>';
          }
          $output .= '</div>';
        }
        if ( $more_text_single != "" ) {
          $output .= '<a href="' . get_permalink( $post->ID ) . '" class="readmore" title="' . get_the_title( $post->ID ) . '">';
          $output .= $more_text_single;
          $output .= '</a>';
        }
        $output .= '</div>';
        $output .= '</div></' . $item_tag . '><!-- .entry (end) -->';
        break;
      // Secondary layout.
      case 'secondary':
        $i ++;
        $output .= '<' . $item_tag . ' class="item item-' . $i . '">';
        if ( $thumb == 'true' ) {
          if ( has_post_thumbnail( $post->ID ) ) {
            $output .= '<figure class="featured-thumbnail">';
            if ( $image ) {
              $output .= '<img  src="' . $image . '" alt="' . get_the_title( $post->ID ) . '"/>';
            } else {
              $output .= '<img  src="' . $url . '" alt="' . get_the_title( $post->ID ) . '"/>';
            }
            $output .= '</figure>';
          }
        }
        $output .= '<div class="wrap-info">';
        if ( $excerpt_count >= 1 ) {
          $output .= '<div class="excerpt">';
          $output .= trim_string_length( $excerpt, $excerpt_count );
          $output .= '</div>';
        }
        if ( $content_count >= 1 ) {
          $output .= '<div class="content">';
          $output .= trim_string_length( $content, $content_count );
          $output .= '</div>';
        }
        $output .= '<h5><a href="' . get_permalink( $post->ID ) . '" title="' . get_the_title( $post->ID ) . '">';
        $output .= get_the_title( $post->ID );
        $output .= '</a></h5>';
        if ( $meta == 'true' ) {
          $output .= '<span class="meta">';
          $output .= '<span class="day">' . get_the_time( 'd' ) . '/</span><span class="months">' . get_the_time( 'm' ) . '/</span><span class="year">' . get_the_time( 'Y' ) . '</span>';
          $output .= '</span>';
        }
        $output .= '</div>';
        $output .= '</' . $item_tag . '><!-- .entry (end) -->';
        break;
      // Custom layout.
      case 'testimonials':
        $output .= '<div class="' . $post_classes . ' ' . $class_item . '">';
        $output .= '<div class="wrap-info">';
        if ( $content_count >= 1 ) {
          $output .= '<div class="content"><i class="fa fa-quote-left"></i>';
          $output .= trim_string_length( $content, $content_count );
          $output .= '</div>';
        }
        // Custom fields & title.
        $output .= '<div class="custom-info">';
        $output .= '<strong>' . get_the_title( $post->ID ) . '</strong> ';
        $output .= '<span class="location">' . rwmb_meta( 'location' ) . '</span>';
        $output .= '</div>';
        // wrap-info end.
        $output .= '</div>';
        $output .= '</div><!-- .entry (end) -->';
        break;
    }
  }
  /*if ( $layout == 'secondary' ) {
    $output .= '</div>';
  }*/
  $output .= '</' . $wrapper_tag . '><!-- .recent-posts (end) -->';
  wp_reset_postdata();
  return $output;
}
add_shortcode( 'content', 'shortcode_content' );

// Display Table
function dtable_shortcode($atts, $content=null) {

    // add divs to the content  
    $output = '<div class="d-table">';
    $output .= do_shortcode($content);
    $output .= '</div> <!-- .d-table (end) -->';
   
    return $output;
}
add_shortcode('dtable', 'dtable_shortcode');

// create shortcode to list all clothes which come in blue
add_shortcode( 'services', 'services_shortcode' );
function services_shortcode( $atts ) {
    ob_start();
    
    extract( shortcode_atts( array (
      'cat' => '',
      'title' => ''
    ), $atts ) );

    $query = new WP_Query( array(
      'post_type' => 'services',
      'services_category' => $cat,
      'posts_per_page' => -1,
      'order' => 'ASC',
      'orderby' => 'title',
    ) );

    global $post, $meta_boxes;
    global $my_string_limit_words; 


    ?>

    <div id="sub-services">
      <?php if ($title): ?>
        <h2><?php echo $title; ?></h2>
      <?php endif ?>
      
    
      <div class="row">

      <?php while ( $query->have_posts() ) : $query->the_post();
        $result = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
        $url = $result[0]; 
        $image = aq_resize( $url, 368, 278, false );
        ?>
        <?php if ($image): ?>
          <div class="col-sm-4">
            <div class="block">
              <img src="<?php echo $image; ?>" alt="<?php the_title(); ?>">
              <div class="text">
                <a href="<?php the_permalink(); ?>">link</a>
              </div>
              <h4><?php the_title(); ?></h4>
            </div>
          </div> 
        <?php endif; endwhile; ?> 

    </div>
    <?php wp_reset_postdata(); ?>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
}

// create shortcode to list all clothes which come in blue
add_shortcode( 'gal', 'rmcc_post_listing_shortcode2' );
function rmcc_post_listing_shortcode2( $atts ) {
    ob_start();

    // define attributes and their defaults
    extract( shortcode_atts( array (
      'cat' => '',
      'title' => ''
    ), $atts ) );

    $query = new WP_Query( array(
      'post_type' => 'gallery',
      'gallery_categories' => $cat,
      'posts_per_page' => -1,
      'order' => 'ASC',
      'orderby' => 'title',
    ) );
    if ( $query->have_posts() ) { ?>
      
    <div class="gallery"> 
      <?php if ($title): ?>
        <h2><?php echo $title; ?></h2>   
      <?php endif ?>
    
      <div class="row"> 

      <?php while ( $query->have_posts() ) : $query->the_post(); ?>
      <?php $photos_images = rwmb_meta( 'photos', 'type=plupload_image&size', $post->ID ); 
        foreach( $photos_images as $prop_image_id=>$prop_image_meta ){ ?>
          <div class="col-sm-6">
            <a class="swipebox" href="<?php echo $prop_image_meta['url']; ?>">
              <figure>
                <img src="<?php echo $prop_image_meta['url']; ?>" alt="<?php echo $prop_image_meta['caption']; ?>">
                <span class="zoom-icon"><i class="fa fa-search"></i></span>
                <figcaption><?php echo $prop_image_meta['caption']; ?></figcaption>       
              </figure>
              </a>
          </div>
        <?php } ?>
      </div>
    </div>

    <?php endwhile;
    wp_reset_postdata(); ?>
    <?php $myvariable = ob_get_clean();
    return $myvariable;
  }
}

