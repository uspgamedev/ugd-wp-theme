
<?php $sectionqueryargs = array(
	"post_type" => "UGD_section",
	"posts_per_page" => 9,
	"orderby" => "menu_order",
	"order" => "ASC"
);

$querypage = [];
?>

<?php get_header(); ?>

<?php $sections = new WP_Query( $sectionqueryargs ); ?>
<?php while ( $sections->have_posts() ) { $sections->the_post(); ?>
	<?php

		// Meta Field: section type (cover, query, page)
		$section_type = get_post_meta($sections->post->ID, 'section_type', true);

		// Meta Field: section content (nothing, category-id, page-id)
		$section_content = get_post_meta($sections->post->ID, 'section_content', true);

	?>
	<div class="section col-xs-12 h-100 transition juicy <?php echo $section_type; ?>" section-type="<?php echo $section_type; ?>">
		<div class="container-fluid h-100">
			<?php include(locate_template('section-' . $section_type . '.php')); ?>
		</div>
	</div>
<?php } ?>

<?php wp_reset_query(); ?>

<?php get_footer(); ?>