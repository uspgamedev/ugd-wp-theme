<?php

add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-header' );

get_template_part('section-post-type/section', 'init');
get_template_part('section-post-type/section', 'metabox');
get_template_part('section-post-type/section', 'save');

add_filter('show_admin_bar', '__return_false');

add_filter( 'wp_title', 'UGD_filter_wp_title' );
function UGD_filter_wp_title( $title ) {
	return $title . esc_attr( get_bloginfo( 'name' ) );
}

add_action('wp_head','UGD_ajax_script');
function UGD_ajax_script() { ?>
	<script type="text/javascript">
		var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
	</script>
<?php }

register_nav_menu( 'domains', __( 'Domains Menu' ) );

$POSTS_PER_PAGE = get_option('posts_per_page');

get_template_part('functions', 'comments');
get_template_part('functions', 'section-query');
get_template_part('functions', 'chara-limit');



?>
