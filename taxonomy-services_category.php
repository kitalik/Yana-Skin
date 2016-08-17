<?php
get_header(); 

?>

<?php global $wp_query;
$terms = get_the_terms($post->ID, 'services_category');
if ($terms && !is_wp_error($terms)) :
  $project = array();
  foreach ($terms as $term) {
    $project[] = $term->name;
    $term_link = get_term_link($term, 'services_category');
    if (is_wp_error($term_link)) {
      continue;
    }
  }

endif; ?>

<div id="sub-services" style="padding:0">
  <div class="container">
    <div class="row"> 
      <?php 
        $wp_query->set('orderby', 'menu_order');
        $wp_query->set('order', 'ASC');
        $wp_query->get_posts();

        if ( have_posts() ) : while ( have_posts() ) : the_post(); 
        
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
      <?php endif ?>
      <?php endwhile; endif; ?>        
    </div>
  </div>
</div>


<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>

