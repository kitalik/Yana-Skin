<div class="row">
	<div class="col-sm-8 col-md-8 col-lg-9 content-area">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'content', 'page' );

		// End the loop.
		endwhile;
		?>
	</div>

<?php get_sidebar(); ?>
</div>
	
		

