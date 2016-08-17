<?php
/*
*   Template Name: Main Services Category
*/

get_header(); ?>

<div class="container">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
  
  the_content();
  
  endwhile; endif; ?>
	
</div>

<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>
