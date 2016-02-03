<?php

// handling ajax queries from front-page
add_action( 'wp_ajax_changepage', 'changepage' );
add_action( 'wp_ajax_nopriv_changepage', 'changepage' );
function changepage() {

	$cat_id = $_POST['section'];
	$where = $_POST['direction'];
	$currentpage = (int)$_POST['current'];
	$pagelimit = (int)$_POST['limit'];

	$wantedpage = $currentpage;

	$querylog = "I want the " . $where . " from the query of category id #" . $cat_id . ".";
	$queryresults = "Current page is #" . $currentpage . "; Total no. of pages is #" . $pagelimit . ".";

	if ($where == 'prev-page') {
		if ($currentpage > 1 ) {
			$wantedpage -= 1;
		}
	} elseif ($where == 'next-page') {
		if ($currentpage < $pagelimit ) {
			$wantedpage += 1;
		}
	}

	$querygetter = "Wanted page is #" . $wantedpage . ".";

	$args = array( 'cat' => $cat_id, 'posts_per_page' => 6, 'paged' => $wantedpage );
	$cat_query = new WP_Query($args);
	
	?>
	
	<div
		current-page="<?php echo $wantedpage; ?>"
		page-limit="<?php echo $pagelimit; ?>"
		id="query-<?php echo $cat_id; ?>"
		class="juicy juicy-low transition transition-delay">
		
		<?php while ( $cat_query->have_posts() ) : $cat_query->the_post(); ?>
			<?php get_template_part("query", "post"); ?>
		<?php endwhile; ?>
	</div>
	<div class="clearfix"></div>
	<?php if ($wantedpage > 1) { ?>
		<nav class="query-nav top" query-id="<?php echo $cat_id; ?>">
			<a class="query-nav-btn prev-page white-text"><i class="glyphicon glyphicon-arrow-up"></i></a>
		</nav>
	<?php } ?>
	<?php if ($wantedpage < $pagelimit) { ?>
		<nav class="query-nav bottom" query-id="<?php echo $cat_id; ?>">
			<a class="query-nav-btn next-page white-text"><i class="glyphicon glyphicon-arrow-down"></i></a>
		</nav>
	<?php } ?>

	<script type="text/javascript">
		// Note: This is solely for debugging the query to see if the parameters went to the back end safely.
		console.log("<?php echo $querylog; ?>");
		console.log("<?php echo $queryresults; ?>");
		console.log("<?php echo $querygetter; ?>");

		UGD.setAjaxPagination();
	</script>

	<?php

	wp_die(); // this is required to terminate immediately and return a proper response
}