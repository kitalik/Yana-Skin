<div id="header">
    <a class="mbtn" href="#menu"></a>
    <p class="phone"><a href="callto:<?php echo of_get_option('phone'); ?>"><?php echo of_get_option('phone'); ?></a></p>
</div> 
<div id="subnav">
    <nav id="menu">
        <?php wp_nav_menu( 
            array( 
                'menu'           => 'Main Menu', 
                'sort_column'    => 'menu_order', 
                'container_id'   => 'primary' , 
                'container'      => 'ul', 
                'link_before'    => '<span>', 
                'link_after'     => '</span>', 
                'menu_class'     => 'menu dl-menu', 
                'theme_location' => 'primary') ); 
            ?>
    </nav>
</div>