<?php

/*

This file requires the following variables to be set before inclusion:

$section_content
$requested_page

*/

// QUERY SECTION
$cat_query_args = array( 'cat' => $section_content, 'posts_per_page' => 6, 'paged' => $requested_page );
$cat_query = new WP_Query($cat_query_args);
$pagelimit = $cat_query->max_num_pages;
$paged = $cat_query->get( 'paged', 1 );

?>
<div id="query-<?php echo $section_content; ?>" class="query-container">
	<div class="unselectable">
		<div class="post-grid">
			<!--header class="page-header intro-font">
				<h3><?php echo get_category($section_content)->name ?></h3>
			</header-->
			<?php while ( $cat_query->have_posts() ) : $cat_query->the_post(); ?>
				<?php if ($cat_query->current_post % 3 == 0) echo '<div class="clearfix hidden-xs"></div>'; ?>
				<?php //if ($cat_query->current_post % 2 == 0) echo '<div class="clearfix hidden-sm hidden-md hidden-lg"></div>'; ?>
				<?php include(locate_template('query-post.php')); ?>
			<?php endwhile; ?>
			<div class="clearfix"></div>
			
			<input  id="query_<?php echo $section_content; ?>_params"
					type="hidden"
					query-id="<?php echo $section_content; ?>"
					current-page="<?php echo $paged; ?>" />
			
			<nav class="query-nav text-center">
				<!--div class="col-xs-12">
					<?php echo $paged . "/" . $pagelimit; ?>
				</div-->
				<?php if ($paged > 1) { ?>
					<div class="col-xs-6 ">
						<a  href="#"
							params="query_<?php echo $section_content; ?>_params"
							class="query-nav-btn-prev white-text">

							<i class="icon-left glyphicon glyphicon-backward"></i> <span class="hidden-xs">Anterior</span>
						</a>
					</div>
				<?php } else { ?>
					<div class="col-xs-6 "></div>
				<?php } ?>

				
				<?php if ($paged < $pagelimit) { ?>
					<div class="col-xs-6 ">
						<a  href="#"
							params="query_<?php echo $section_content; ?>_params"
							class="query-nav-btn-next white-text">

							<span class="hidden-xs">Próxima</span> <i class="icon-right glyphicon glyphicon-forward"></i>
						</a>
					</div>
				<?php } else { ?>
					<div class="col-xs-6"></div>
				<?php } ?>
			</nav>
		</div>
	</div>
</div>