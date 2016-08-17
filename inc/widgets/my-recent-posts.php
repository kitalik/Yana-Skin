<?php
// =============================== My Recent Posts (News widget) ======================================
add_action('widgets_init', create_function('', "register_widget('MY_PostWidget');"));
class MY_PostWidget extends WP_Widget {
    /** constructor */
    function MY_PostWidget() {
        parent::WP_Widget(false, $name = 'My - Recent Posts');	
    }

  /** @see WP_Widget::widget */
  function widget($args, $instance) {		
    extract( $args );
    $title = apply_filters('widget_title', $instance['title']);
		$count = apply_filters('widget_count', $instance['count']);
		    
    echo $before_widget;
    
    if ( $title ) echo $before_title . $title . $after_title;

		$args = array(
			'showposts' => $count,
			'orderby' => $sort_by,
			'tax_query' => array(
			 'relation' => 'AND',
			)
		);
				
		$wp_query = new WP_Query( $args ); ?>
			<ul class="latestpost">
			<?php if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post();?>
				<li>
          <div class="dtable">
            <div class="excerpt">
              <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
            </div>
            <div class="meta">by <?php the_author_posts_link(); ?> </div>
          </div>
				</li>
			<?php endwhile; ?>
			<?php endif; ?>
			</ul>
			
			<?php $wp_query = null; $wp_query = $temp; echo $after_widget;
  }

  /** @see WP_Widget::update */
  function update($new_instance, $old_instance) {				
    return $new_instance;
  }

  /** @see WP_Widget::form */
  function form($instance) {				
    $title = esc_attr($instance['title']);
		$count = esc_attr($instance['count']); ?>
      
    <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'wp021'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
   
    <p><label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Posts per page:'); ?><input class="widefat" style="width:30px; display:block; text-align:center" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="text" value="<?php echo $count; ?>" /></label></p>
		
      <?php 
  }

} // class Widget
?>