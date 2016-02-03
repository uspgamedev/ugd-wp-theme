<?php

// QUERY SECTION
$cat_query_args = array( 'cat' => $section_content, 'posts_per_page' => 9, 'paged' => 0 );
$cat_query = new WP_Query($cat_query_args);
$pagelimit = $cat_query->max_num_pages;

?>
<div class="vert-algn-sm">
	<div class="">
		<div current-page="1" page-limit="<?php echo $pagelimit; ?>" id="query-<?php echo $section_content; ?>" class="post-grid">
			<?php while ( $cat_query->have_posts() ) : $cat_query->the_post(); ?>
				<?php include(locate_template('query-post.php')); ?>
			<?php endwhile; ?>
		</div>
		<div class="clearfix"></div>
		<nav class="query-nav bottom" query-id="<?php echo $section_content; ?>">
			<?php if ($pagelimit > 1) { ?>
				<a class="query-nav-btn next-page white-text"><i class="glyphicon glyphicon-arrow-down"></i></a>
			<?php } ?>
		</nav>
	</div>
</div>