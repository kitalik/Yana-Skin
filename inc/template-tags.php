<?php
/**
 * Custom template tags
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 */

if ( ! function_exists( 'yanaskincare_comment_nav' ) ) :
/**
 * Display navigation to next/previous comments when applicable.
 *
 */
function yanaskincare_comment_nav() {
	// Are there comments to navigate through?
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
	?>
	<nav class="navigation comment-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Comment navigation', 'yanaskincare' ); ?></h2>
		<div class="nav-links">
			<?php
				if ( $prev_link = get_previous_comments_link( __( 'Older Comments', 'yanaskincare' ) ) ) :
					printf( '<div class="nav-previous">%s</div>', $prev_link );
				endif;

				if ( $next_link = get_next_comments_link( __( 'Newer Comments', 'yanaskincare' ) ) ) :
					printf( '<div class="nav-next">%s</div>', $next_link );
				endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .comment-navigation -->
	<?php
	endif;
}
endif;



if ( ! function_exists( 'yanaskincare_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the categories, tags.
 *
 */
function yanaskincare_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() ) {
		printf( '<span class="sticky-post">%s</span>', __( 'Featured', 'yanaskincare' ) );
	}

	$format = get_post_format();
	if ( current_theme_supports( 'post-formats', $format ) ) {
		printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
			sprintf( '<span class="screen-reader-text">%s </span>', _x( 'Format', 'Used before post format.', 'yanaskincare' ) ),
			esc_url( get_post_format_link( $format ) ),
			get_post_format_string( $format )
		);
	}

	if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'F' ) ),
			get_the_date('F m / Y'),
			esc_attr( get_the_modified_date( 'F' ) ),
			get_the_modified_date()
		);

		printf( '<span class="posted-on">%3$s &nbsp;</span>',
			_x( '', 'Used before publish date.', 'yanaskincare' ),
			esc_url( get_permalink() ),
			$time_string
		);
	}

	if ( is_attachment() && wp_attachment_is_image() ) {
		// Retrieve attachment metadata.
		$metadata = wp_get_attachment_metadata();

		printf( '<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
			_x( 'Full size', 'Used before full size attachment link.', 'yanaskincare' ),
			esc_url( wp_get_attachment_url() ),
			$metadata['width'],
			$metadata['height']
		);
	}
}
endif;

/**
 * Determine whether blog/site has more than one category.
 *
 *
 * @return bool True of there is more than one category, false otherwise.
 */
function yanaskincare_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'yanaskincare_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'yanaskincare_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so yanaskincare_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so yanaskincare_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in {@see yanaskincare_categorized_blog()}.
 *
 */
function yanaskincare_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'yanaskincare_categories' );
}
add_action( 'edit_category', 'yanaskincare_category_transient_flusher' );
add_action( 'save_post',     'yanaskincare_category_transient_flusher' );

if ( ! function_exists( 'yanaskincare_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 */
function yanaskincare_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php
			the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) );
		?>
	</a>

	<?php endif; // End is_singular()
}
endif;

if ( ! function_exists( 'yanaskincare_get_link_url' ) ) :
/**
 * Return the post URL.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @see get_url_in_content()
 *
 * @return string The Link format URL.
 */
function yanaskincare_get_link_url() {
	$has_url = get_url_in_content( get_the_content() );

	return $has_url ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}
endif;

if ( ! function_exists( 'yanaskincare_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a 'Continue reading' link.
 *
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function yanaskincare_excerpt_more( $more ) {
	$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading %s', 'yanaskincare' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
		);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'yanaskincare_excerpt_more' );
endif;
