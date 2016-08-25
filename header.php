<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">

	<!-- Behavioral Meta Data -->
  <meta name="apple-mobile-web-app-capable" content="yes">

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php if(of_get_option('favicon') != ''){ ?>
	<link rel="icon" href="<?php echo of_get_option('favicon', "" ); ?>" type="image/x-icon" />
	<?php } else { ?>
	<link rel="icon" href="<?php bloginfo( 'template_url' ); ?>/favicon.ico" type="image/x-icon" />
	<?php } ?>
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	<script>(function(){document.documentElement.className='js'})();
		theme_directory = "<?php echo get_template_directory_uri() ?>";
	</script>

	<?php wp_head(); ?>
	<?php if (is_singular()) wp_enqueue_script('comment-reply'); ?>
</head>

<?php $post_meta_data = get_post_custom($post->ID); ?>
<?php $custom_class = $post_meta_data['layout'][0]; ?>

<?php  

$terms = get_the_terms($post->ID, 'services_category');
if ($terms && !is_wp_error($terms)) :
  $project = array();
  foreach ($terms as $term) {
    $project[] = $term->name;
    $term_link = get_term_link($term, 'services_category');
    if (is_wp_error($term_link)) {
      continue;
    }
  }
endif; 
	
?>

<body <?php body_class(); ?>>
	<div class="site-container">
				
		<header class="site-header">
			<?php echo get_template_part('template-parts/mobile_nav'); ?>
		
			<div class="container">
				<!-- Logo -->
					<div class="title-area">
						<?php if(of_get_option('logo_url')){ ?>
							<a href="<?php bloginfo('url'); ?>/" id="logo">
								<img src="<?php echo of_get_option('logo_url', "" ); ?>" alt="<?php bloginfo('name'); ?>" title="<?php bloginfo('description'); ?>">
							</a>
						<?php } else { ?>
							<a href="<?php bloginfo('url'); ?>/">
								<?php if (is_front_page()) { ?>
									<h1><?php bloginfo( 'name' ); ?> </h1>
								<?php }else{ ?>
									<h2><?php bloginfo( 'name' ); ?> </h2>
								<?php } ?>
							</a>
						<?php } ?>
					</div>
					<!-- end Logo -->
					
					<div class="right-area">
						<a href="<?php echo of_get_option('header_btn_link'); ?>" class="btn"><?php echo of_get_option('header_btn_text'); ?></a>

						<!-- Phone -->
						<div class="phone">
							<p><?php echo of_get_option('phone_text'); ?>
								<strong><i class="fa fa-phone"></i><a href="callto:<?php echo of_get_option('phone'); ?>"><?php echo of_get_option('phone'); ?></a></strong></p>
							
						</div>
						<!-- end Phone -->
					</div>

			</div>
			
		</header><!-- .site-header -->

		<!-- Navigation -->
		<nav id="nav" class="nav-primary">
			<div class="container">
				<?php wp_nav_menu( array(
					'menu'           => 'Main Menu',
					'sort_column'    => 'menu_order',
					'container_id'   => 'primary' ,
					'container'      => 'ul',
					'link_before'    => '<span>',
					'link_after'     => '</span>',
					'menu_class'     => 'menu',
					'theme_location' => 'primary') );
				?>
			</div>
		</nav><!-- End Navigation -->	

		<?php if (is_front_page()): ?>
			<!-- Slider --> 
			<div id="slider">
				<?php echo do_shortcode('[smartslider3 slider=2]');	?>
			</div>
			<!-- end Slider --> 
		<?php endif ?>

		<?php if (!is_front_page()): ?>
			<!-- Top Banner -->
			<div class="top-banner">
				<div class="container">
					<?php $banner_img = rwmb_meta( 'banner_img', 'type=image' );  ?>

					<?php if ($banner_img): ?>
						<?php foreach ( $banner_img as $image ) { 
							$image = aq_resize( $image['full_url'], 570, 318, true ); ?>
							<img class="banner-img" src="<?php echo $image; ?>" alt="<?php echo $image['title']; ?>">
						<?php } ?>
					<?php else: ?>
						<img class="banner-img" src="<?php echo get_template_directory_uri(); ?>/images/bannerimg.jpg" alt="">
					<?php endif; ?>	
					
					<?php $parent_title = get_the_title($post->post_parent); ?>

					<div class="wrapper">
						<div class="block">
							<?php if (is_tax('services_category')): ?>
								<h1> <?php echo $term->name; ?></h1>
							<?php else: ?>
								<h1><?php echo $parent_title; ?></h1>
							<?php endif ?>
							
						</div>
					</div>

				</div>
			</div>
			<!-- end Top Banner -->

			<!-- Breadcrumbs -->
			<div id="breadcrumbs">
				<div class="container">
	  			<?php the_breadcrumb(); ?>
	  		</div>
		  </div>
		  <!-- End Breadcrumbs -->
	
		<?php endif ?>
		<div class="site-inner">
