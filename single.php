<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 */

get_header(); 
$post_meta_data = get_post_custom($post->ID);
$layout = $post_meta_data['layout'][0]; 
$addclass = "content-sidebar";
?>

<div class="<?php echo $addclass; ?> container single-post-page">
	<div class="wrapper">
			
		<div class="row">
			<div class="col-sm-12 col-md-8 col-lg-9">	

				<?php
				// Start the loop.
				while ( have_posts() ) : the_post(); 
				$result = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
    		$url = $result[0]; 
				?>

					<article class="post single">
						<div class="single-content">
							<?php the_title('<h2>', '</h2>'); ?>			
							<div class="meta">
					  		<?php echo yanaskincare_entry_meta(); ?>
					  	</div>		
					  	<?php if (!empty($url)) { ?>
								<figure class="main-thumbnail"><a href="<?php the_permalink(); ?>" title="<?php _e('Permalink to:', 'yanaskincare'); ?> <?php the_title(); ?>"><img src="<?php echo $url; ?>" alt=""></a>
								</figure>
							<?php } ?><?php if (has_excerpt()) { ?>
								<p><?php framework_excerpt(50); ?> </p>
							<?php } ?>	
							<div class="content-single-post"><?php the_content(); ?></div>
						</div>
					</article>

				<?php endwhile; ?>
			</div>	

			<?php get_sidebar(); ?>

		</div>



	</div>	
</div>


<?php get_footer(); ?>
