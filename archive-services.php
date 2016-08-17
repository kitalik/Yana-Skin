<?php
/*
    Template name: Gallery Page
*/

get_header(); 
?>
	
<div class="container">
  <div class="entry-content">
    
    <div class="col-sm-12">
      <div id="gallery">
        
        <div class="wrap row">
          <?php // Start the loop.
          if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          <?php endwhile; endif; // End the loop. ?>

        </div>
      </div>
    </div>
	</div>
</div>
<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>

