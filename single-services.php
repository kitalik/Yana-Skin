<?php get_header();  

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

<div class="container">
	<div class="row">
		<div class="col-sm-3 sidebar">
			<?php get_template_part('primary-sidebar'); ?>
		</div>	

		<div class="col-sm-9 content-right">
				<?php
				// Start the loop.
				while ( have_posts() ) : the_post(); ?>
					<a href="<?php echo $term_link ?>" class="btn">For ALL our <?php echo $term->name; ?> Services Click here</a>
					<?php // Include the page content template.

					get_template_part( 'content', 'page' );

				// End the loop.
				endwhile;
				 ?>
		</div>
	</div>

	<?php wp_reset_postdata(); ?>

</div>

<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>

	
		

