<div class="col-sm-2 sidebar">
	<?php get_template_part('primary-sidebar');  ?>
</div>

<div class="col-sm-7">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'content', 'page' );

		// End the loop.
		endwhile;
		?>
</div>

<div class="col-sm-3 secondary-sidebar">
	<?php get_template_part('secondary-sidebar'); ?>
</div>
	
		

