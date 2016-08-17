<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	

	<?php if (!is_page() && !is_search() && !is_single()) : ?>
	  <div class="meta clearfix">
  		<?php echo yanaskincare_entry_meta(); ?>
  	</div>

  <?php endif; 

	// Post thumbnail.
	$thumb = get_post_thumbnail_id();
	$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
	$image = aq_resize( $img_url, 269, 269, true ); //resize & crop the image
	
	if (!is_page() && !is_search() && !is_single()) { ?>
		<figure><img class="alignleft" src="<?php if (!empty($image)) { echo $image; }else{ echo get_template_directory_uri(); ?>/images/thumb.gif <?php } ?>" alt=""></figure>
	<?php } ?>

	<?php if (!is_page() && !is_search() && !is_single()) { ?>
		<?php if (has_excerpt()) { ?>
				<p><?php framework_excerpt(50); ?> </p>
			<?php }else{  
	  	echo apply_filters('the_content', substr(get_the_content(), 0, 715) ); } ?>
 		<a class="read-more" href="<?php echo get_permalink( get_the_ID() ); ?>">read more</a>
 	<?php }else{ ?>
	
	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s', 'yanaskincare' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'yanaskincare' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'yanaskincare' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php } ?>
	

</article><!-- #post-## -->
