<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 */

get_header(); 
$post_meta_data = get_post_custom($post->ID);
$layout = $post_meta_data['layout'][0]; 
$custom_post_class = $post_meta_data['custom_post_class'][0]; 
$addclass = "sidebar-content";


if ($layout == 'left'): $addclass = "sidebar-content"; 

elseif ($layout == 'right'): $addclass = "content-sidebar";  

elseif ($layout == 'both-sidebars'): $addclass = "sidebar-content-sidebar";  

elseif ($layout == 'full'): $addclass = "full-width-content";  

else : $addclass = "sidebar-content";  

endif; 

?>

<div class="<?php echo $addclass; ?> <?php echo $custom_post_class ?>">
	
	
		<?php if ($layout == 'left'): get_template_part('page-with-left-sidebar'); 

		elseif ($layout == 'right'): get_template_part('page-with-right-sidebar');  

		elseif ($layout == 'both-sidebars'): get_template_part('page-with-both-sidebar');  

		elseif ($layout == 'full'): get_template_part('page-full-width');  

		else : get_template_part('page-with-left-sidebar');  

		endif; ?>

	
</div>
<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>
