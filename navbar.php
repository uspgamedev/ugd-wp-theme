<?php

// NAVIGATION BAR
$menusections = get_posts(
    array(
        "post_type" => "horisec_section",
        "posts_per_page" => 9,
        "orderby" => "menu_order",
        "order" => "ASC"
    )
);

?>

<nav id="masthead" class="dark-translucid intro">
	<div class="container-fluid text-center">

        <!-- Toggle Button -->
        <a href="#" id="nav-btn" class="visible-xs-inline-block pull-left toggle-button" toggle-target="navigation-menu">
            <i class="glyphicon glyphicon-th-list"></i>
        </a>

        <!-- Navigation Menu -->
        <div id="navigation-menu" class="navigation-menu white-text transition">

      		<ul class="list-unstyled">
  			<?php
      			for ($i=0; $i < count($menusections); $i++) {
      				$menu_item = $menusections[$i];
      				if ( !(get_post_meta($menu_item->ID, 'section_type', true) == 'cover') ) {
                        printf('<li class="navigation-menu-item"><a class="section-ctrl" href="#">%1$s</a></li>', $menu_item->post_title);
                    }
      			}
  			?>
		    </ul>
    	</div>
  	</div>
</nav>