<?php

// NAVIGATION BAR
$menusections = get_posts(
    array(
        "post_type" => "UGD_section",
        "posts_per_page" => 9,
        "orderby" => "menu_order",
        "order" => "ASC"
    )
);

?>

<nav id="masthead" class="dark-translucid intro-font transition">
	<div class="container-fluid text-center unselectable">

        <!-- Toggle Button -->
        <a title="Toggle Left Navigation Menu" href="#" id="nav-btn" class="visible-xs-inline-block pull-left toggle-button" toggle-target="navigation-menu">
            <i class="glyphicon glyphicon-th-list"></i>
        </a>

        <!-- Navigation Menu -->
        <div id="navigation-menu" class="navigation-menu transition">

      		<ul class="list-unstyled">
      			<?php
          			for ($i=0; $i < count($menusections); $i++) {
          				$menu_item = $menusections[$i];
                        $href = "#";
                        if ( is_attachment() || is_singular() ) {
                            $href = get_home_url() . "?section=" . $i;
                        }

          				if ( !(get_post_meta($menu_item->ID, 'section_type', true) == 'cover') ) {
                            printf('<li class="navigation-menu-item white-text"><a title="%1$s" href="%2$s">%1$s</a></li>', $menu_item->post_title, $href);
                        } else {
                            printf('<li class="hidden navigation-menu-item white-text"><a title="%1$s" href="%2$s">%1$s</a></li>', $menu_item->post_title, $href);
                        }
          			}
      			?>
		    </ul>
    	</div>

        <?php include(locate_template('navbar-top.php')); ?>
        
  	</div>
</nav>