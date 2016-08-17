<div class="container">
	<div class="row">
		<div class="col-sm-3 sidebar">
			<?php get_template_part('primary-sidebar'); ?>
		</div>	

		<div class="col-sm-9 content-right">
				<?php
				// Start the loop.
				while ( have_posts() ) : the_post();

					// Include the page content template.
					get_template_part( 'content', 'page' );

				// End the loop.
				endwhile;
				 ?>
		</div>
	</div>

	<div id="sub-services">
		<div class="row">
		<?php 
			$shortcodeid =  rwmb_meta( 'shortcodeid', get_the_ID() );
			$services_title =  rwmb_meta( 'services_title', get_the_ID() );
			
			echo '<h3>'.$services_title.'</h3>'; 
			echo do_shortcode('[text-blocks id="'.$shortcodeid.'"]'); 
		?>
		</div>
	</div>
</div>

	
		

