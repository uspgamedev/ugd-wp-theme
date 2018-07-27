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

add_action('wp_head', 'UGD_ajaxurl');
function UGD_ajaxurl() { ?>
  <script type="text/javascript">
     var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
  </script>
<?php }

add_action( 'wp_enqueue_scripts', 'UGD_styles' );
function UGD_styles() {
  wp_enqueue_style("ugd-fontintro",
      get_template_directory_uri() . "/_assets/fonts/intro_webfont/stylesheet.css");
  wp_enqueue_style("ugd-fontroboto",
      get_template_directory_uri() . "https://fonts.googleapis.com/css?family=Roboto:400,400italic,900,900italic");
  wp_enqueue_style("ugd-fontawesome",
      get_template_directory_uri() . "https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css");
  wp_enqueue_style("ugd-normalize", get_template_directory_uri() . "/_assets/css/normalize.min.css");
  wp_enqueue_style("ugd-bootstrap",
      get_template_directory_uri() . "/_assets/libs/bootstrap/css/bootstrap.min.css", ["ugd-normalize"]);
  wp_enqueue_style("ugd-theme-style",
      get_stylesheet_uri(), ["ugd-bootstrap", "ugd-fontroboto", "ugd-fontintro", "ugd-fontawesome"]);
}

add_action( 'wp_enqueue_scripts', 'UGD_scripts' );
function UGD_scripts() {
  wp_enqueue_script("ugd-jsjquery", "https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js",
      [], null, true);
  wp_enqueue_script("ugd-jshammer", get_template_directory_uri() . "/_assets/libs/hammer/hammer.min.js",
      [], null, true);
  wp_enqueue_script("ugd-jsmain", get_template_directory_uri() . "/_assets/js/ugd.min.js",
      ["ugd-jsjquery", "ugd-jshammer"], null, true);
}

register_nav_menu( 'domains', __( 'Domains Menu' ) );

$POSTS_PER_PAGE = get_option('posts_per_page');

get_template_part('functions', 'comments');
get_template_part('functions', 'section-query');
get_template_part('functions', 'chara-limit');



?>
