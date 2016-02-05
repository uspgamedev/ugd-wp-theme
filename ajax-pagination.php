<?php

// handling ajax queries from front-page
add_action( 'wp_ajax_changepage', 'changepage' );
add_action( 'wp_ajax_nopriv_changepage', 'changepage' );
function changepage() {

	$section_content = $_POST['query_id'];
	$requested_page = 0;
	if ($_POST['intention'] == 'prev') {
		$requested_page -= 1;
	} elseif ($_POST['intention'] == 'next') {
		$requested_page += 1;
	}
	$requested_page += (int)$_POST['current_page'];
	
	include(locate_template('section-query.php'));

	wp_die(); // this is required to terminate immediately and return a proper response
}
