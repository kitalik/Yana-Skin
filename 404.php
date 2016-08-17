<?php
/**
 * The template for displaying 404 pages (not found)
 *
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

<div class="container <?php echo $addclass; ?> <?php echo $custom_post_class ?>">
	<div class="wrapper">
		<div class="row">
			<div class="col-sm-12 col-md-8 col-lg-9 content-area">
				<div class="wrap">

						<section class="error-404 not-found">
							<header class="page-header">
								<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'yanaskincare' ); ?></h1>
							</header><!-- .page-header -->

							<div class="page-content">
								<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'yanaskincare' ); ?></p>

								<?php get_search_form(); ?>
							</div><!-- .page-content -->
						</section>

				</div>
			</div>
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
