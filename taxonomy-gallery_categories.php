<?php
get_header(); 

?>

<?php global $wp_query;
$terms = get_the_terms($post->ID, 'gallery_categories');
if ($terms && !is_wp_error($terms)) :
  $project = array();
  foreach ($terms as $term) {
    $project[] = $term->name;
    $term_link = get_term_link($term, 'gallery_categories');
    if (is_wp_error($term_link)) {
      continue;
    }
  }
endif; ?>

<div class="main-title">
    <h1> <?php echo $term->name; ?></h1>
</div>
<div class="container">
  <div class="entry-content">   
    <div class="col-sm-12">
      <div id="gallery">
        <div class="wrap row">
          
            <div class="block-categories">
              <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
                $result = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
                $url = $result[0]; 
                $image = aq_resize( $url, 500, 400, false );
                ?>
                <article class="post col-xs-6 col-sm-3">
                  <figure><a href="<?php the_permalink(); ?>"><img src="<?php echo $image; ?>"></a></figure>
                  <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                </article>      
              <?php endwhile; endif; ?>        
            </div>
          

        </div>
      </div>
    </div>
	</div>
</div>
<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>

