<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 */
?>
	</div><!-- .site-inner -->
</div><!-- .site-content -->

<?php //if (is_front_page()): ?>
	<!-- Before Footer -->
	<div class="before-footer">
		<div class="container">
			<div class="row">
				<div class="col-xs-6 col-sm-6 col-md-3 first">
					<a href="/"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/footer-logo.jpg" alt="" class="footer-logo"></a>
					<ul class="socials">
						<li><a href=""><i class="fa fa-facebook"></i></a></li>
						<li><a href=""><i class="fa fa-twitter"></i></a></li>
						<li><a href=""><i class="fa fa-instagram"></i></a></li>
					</ul>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-3">
					<?php dynamic_sidebar('footer-1'); ?>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-3 first">
					<?php dynamic_sidebar('footer-2'); ?>
				</div>
				<div class="col-xs-6 col-sm-6 col-md-3">
					<?php dynamic_sidebar('footer-3'); ?>
				</div>
			</div>
		</div>
		
	</div>
	<!-- end Before Footer -->
<?php //endif ?>

<footer class="site-footer">
	<div class="container">
		<p class="pull-left">Yana Skin Care © Copyright <?php echo date("Y") ?> All Rights Reserved.</p><p class="pull-right"><a href="http://www.graphicsbycindy.com/" target="_blank">Houston Web Design</a> - Graphics by Cindy</p>
	</div>
</footer><!-- .site-footer -->

<?php wp_footer(); ?>

</body>
</html>
