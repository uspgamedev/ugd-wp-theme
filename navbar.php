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

        <!-- Meta Toggle Button -->
        <a title="Toggle Upper Navigation Menu" href="#" id="meta-nav-btn" class="pull-right toggle-button" toggle-target="meta-menu">
            <i class="glyphicon glyphicon-option-horizontal"></i>
        </a>

        <!-- Meta Navigation Menu -->
        <div id="meta-navigation-menu" class="meta-navigation-menu transition">
            <div class="container-fluid">
                <div class="row">
                    <!-- User Profile Options -->
                    <div class="meta-area-container small">
                        <ul class="meta-area list-inline list-unstyled pull-right">
                            <?php if ( is_user_logged_in () ) { ?>
                                <?php if ( current_user_can('edit_posts') ) { ?>
                                    <li class="meta-area-item">
                                        <a title="Admin Area" href="<?php echo admin_url(); ?>">
                                            <i class="normal-size icon glyphicon glyphicon-wrench"></i> <span class="hidden-xs">Dashboard</span>
                                        </a>
                                    </li>
                                <?php } ?>
                                <li class="meta-area-item">
                                    <a title="Edit Profile" href="<?php echo get_edit_user_link() ?> ">
                                        <i class="normal-size icon glyphicon glyphicon-user"></i> <span class="hidden-xs">Editar Perfil</span>
                                    </a>
                                </li>
                                <li class="meta-area-item">
                                    <a title="Log Out" href="<?php echo wp_logout_url(); ?>">
                                        <i class="normal-size icon glyphicon glyphicon-off"></i> <span class="hidden-xs">Log Out</span>
                                    </a>
                                </li>
                            <?php } else { ?>
                                <li class="meta-area-item">
                                    <a title="Sign Up" href="<?php echo wp_registration_url(); ?>">
                                        <i class="normal-size icon glyphicon glyphicon-plus"></i> <span class="hidden-xs">Registrar</span>
                                    </a>
                                </li>
                                <li class="meta-area-item">
                                    <a title="Log In" href="<?php echo wp_login_url(); ?> ">
                                        <i class="normal-size icon glyphicon glyphicon-off"></i> <span class="hidden-xs">Log In</span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- Other Domains -->
                    <div class="domains-menu-container">
                        <ul id="domains-menu" class="list-inline list-unstyled white-text pull-left small">
                            <li class="menu-item">
                                <a title="Forum" href="<?php echo get_home_url(); ?>/smf">
                                    <i class="normal-size icon fa fa-comments"></i> <span class="hidden-xs">Forum</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a title="Wiki" href="<?php echo get_home_url(); ?>/wiki">
                                    <i class="normal-size icon fa fa-wikipedia-w"></i> <span class="hidden-xs">Wiki</span>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a title="Github" href="http://github.com/uspgamedev/">
                                    <i class="normal-size icon fa fa-github"></i> <span class="hidden-xs">Github</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
  	</div>
</nav>