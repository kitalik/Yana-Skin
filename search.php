<?php
/**
 * The template for displaying search results pages.
*/

get_header(); 
$post_meta_data = get_post_custom($post->ID);
$layout = $post_meta_data['layout'][0]; 
$custom_post_class = $post_meta_data['custom_post_class'][0]; 
$addclass = "content-sidebar";


if ($layout == 'left'): $addclass = "sidebar-content"; 

elseif ($layout == 'right'): $addclass = "content-sidebar";  

elseif ($layout == 'both-sidebars'): $addclass = "sidebar-content-sidebar";  

elseif ($layout == 'full'): $addclass = "full-width-content";  

else : $addclass = "content-sidebar";  

endif; 

?>

<div id="blog-page" class="container">
	<div class="<?php echo $addclass; ?>">
		<div class="row">
			<div class="col-sm-8 col-md-8 col-lg-9">	
					<?php if ( have_posts() ) : ?>

						<header class="page-header">
							<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'yanaskincare' ), get_search_query() ); ?></h1>
						</header><!-- .page-header -->

						<?php
						// Start the loop.
						while ( have_posts() ) : the_post(); ?>

							<?php
							/*
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'content', 'search' );

						// End the loop.
						endwhile;

						// Previous/next page navigation.
						theme_pagination();

					// If no content, include the "No posts found" template.
					else :
						get_template_part( 'content', 'none' );

					endif;
					?>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
