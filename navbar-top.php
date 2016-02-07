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
                    <?php if ( is_user_logged_in() ) { ?>
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
                            <a title="Log Out" class="red-text" href="<?php echo wp_logout_url(); ?>">
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
                            <a title="Log In" class="greenlue-text"  href="<?php echo wp_login_url(); ?> ">
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