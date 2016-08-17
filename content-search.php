<?php
/**
 * The template part for displaying results in search pages
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 */
?>
	<article class="post entry-content">
  	<h2><a href="<?php the_permalink(); ?>" title="<?php _e('Permalink to:', 'yanaskincare'); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
  	<a class="readmore" href="<?php echo get_permalink( get_the_ID() ); ?>">Read more</a>
  </article>
	<!-- // Previous/next page navigation. -->

