<?php
/*
*   Template Name: Blog
*/

get_header(); 
$post_meta_data = get_post_custom($post->ID);
$layout = $post_meta_data['layout'][0]; 
$addclass = "content-sidebar";
?>

<div id="blog-page" class="container">
	<?php 

	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	query_posts( array( 'post_type' => 'post', 'showposts' => 3, 'paged' => $paged ) );
	

  // Start the loop.
  if ( have_posts() ) : while ( have_posts() ) : the_post();
  	$result = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full');
    $url = $result[0]; 
    ?>
		
		<article class="post entry-content fadeInUp animated">
			<?php if (!empty($url)) { ?>
				<figure><a href="<?php the_permalink(); ?>" title="<?php _e('Permalink to:', 'yanaskincare'); ?> <?php the_title(); ?>"><img src="<?php echo $url; ?>" alt=""></a></figure>
			<?php } ?>
			<div class="wrap">
				<div class="meta">
		  		<?php echo yanaskincare_entry_meta(); ?>
		  	</div>
		  	<div class="padded-multiline">
		  		<h5><a href="<?php the_permalink(); ?>" title="<?php _e('Permalink to:', 'yanaskincare'); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h5>
		  	</div>
				<?php if (has_excerpt()) { ?>
					<p><?php framework_excerpt(50); ?> </p>
				<?php }else{  
			  	$content = get_the_content();
					$content = preg_replace("/<img[^>]+\>/i", " ", $content);          
					$content = apply_filters('the_content', $content);
					$content = str_replace(']]>', ']]>', $content);
					echo apply_filters('the_content', substr($content, 0, 250) );
				} ?>
		  	</a>
		  </div>	
  </article>
  <?php endwhile; endif; // End the loop.?>

  <div class="blog-nav">
	  <div class="prev-nav"><?php previous_posts_link('Previous /') ?></div>
	  <div class="next-nav"><?php next_posts_link('/ past') ?></div>
	</div>
	
</div>

<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>
