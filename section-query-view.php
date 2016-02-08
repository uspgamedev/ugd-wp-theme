<?php

/*

PARAMS:

Required: $cat_query
Optional: $search_input

*/

$pagelimit = $cat_query->max_num_pages;
$paged = $cat_query->get( 'paged', 1 );
$category = $cat_query->get( 'cat' );

?>
<div id="query-<?php echo $category; ?>" class="query-container">
	<div class="unselectable">
		<div class="post-grid">
			
			<?php echo ( isset($search_input) ? '<div class="container-fluid">
				<div class="alert alert-success">Searching for: ' . $search_input . '</div>
				</div>' : "" ); ?>
				
			<?php while ( $cat_query->have_posts() ) : $cat_query->the_post(); ?>
				<?php if ($cat_query->current_post % 3 == 0) echo '<div class="clearfix hidden-xs"></div>'; ?>
				<?php //if ($cat_query->current_post % 2 == 0) echo '<div class="clearfix hidden-sm hidden-md hidden-lg"></div>'; ?>
				<?php include(locate_template('section-query-post.php')); ?>
			<?php endwhile; ?>
			<div class="clearfix"></div>
			
			<nav class="query-nav text-center">
				<div class="col-xs-12">
					<div class="current-page">
						<?php echo $paged; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
					<?php if ($paged > 1) { ?>
						<div class="col-xs-6 ">
							<a  href="#"
								class="query-nav-btn query-nav-btn-prev white-text"
								target="<?php echo ($paged - 1); ?>"
								category-id="<?php echo $category; ?>"
								<?php if (isset($search_input)) echo ' search="' . $search_input . '" '; ?>>

								<i class="icon-left fa fa-long-arrow-left"></i> <?php echo ($paged - 1); ?>
							</a>
						</div>
					<?php } else { ?>
						<div class="col-xs-6 "></div>
					<?php } ?>					
					<?php if ($paged < $pagelimit) { ?>
						<div class="col-xs-6 ">
							<a  href="#"
								class="query-nav-btn query-nav-btn-next white-text"
								target="<?php echo ($paged + 1); ?>"
								category-id="<?php echo $category; ?>"
								<?php if (isset($search_input)) echo ' search="' . $search_input . '" '; ?>>

								<?php echo ($paged + 1); ?> <i class="icon-right fa fa-long-arrow-right"></i>
							</a>
						</div>
					<?php } else { ?>
						<div class="col-xs-6"></div>
					<?php } ?>
					</div>
				</div>
			</nav>
		</div>
	</div>
</div>

