<?php 

// handling pagination
add_action( 'wp_ajax_section_setpage_nosearch', 'section_setpage_nosearch' );
add_action( 'wp_ajax_nopriv_section_setpage_nosearch', 'section_setpage_nosearch' );
function section_setpage_nosearch($cat = 0, $pag = 1) {
	/*
	
	Requires fields:
	cat_id
	target_page

	This function may be called without ajax (on normal page load), so we must treat both cases.

	*/
	if (defined('DOING_AJAX') && DOING_AJAX) {
		// if ajax
		$category = $_POST['cat_id'];
		if ( isset($_POST['target_page']) ) {
			$target_page = (int)$_POST['target_page'];
		} else {
			$target_page = 1;
		}
	} else {
		// if direct call
		$category = $cat;
		$target_page = $pag;
	}
	
	$cat_query = get_section_query_no_search($category, $target_page);
	include(locate_template('section-query-view.php'));

	if (defined('DOING_AJAX') && DOING_AJAX) {
		// if ajax
		wp_die(); // this is required to terminate immediately and return a proper response
	}
}


// handling search pagination
add_action( 'wp_ajax_section_setpage_search', 'section_setpage_search' );
add_action( 'wp_ajax_nopriv_section_setpage_search', 'section_setpage_search' );
function section_setpage_search() {
	/*
	
	Requires fields:
	cat_id
	search_params
	
	Optional fields:
	target_page

	This function is ONLY called via ajax.
	It can only be triggered by:
	- Typing stuff on the search input
	- Clicking the next/prev buttons on the search input

	*/
	if ( isset($_POST) ) {
		$category = $_POST['cat_id'];
		$search_params = $_POST['search_params'];
		if ( isset($_POST['target_page']) ) {
			$target_page = (int)$_POST['target_page'];
		} else {
			$target_page = 1;
		}
	}

	$search_input = sanitized_input($search_params);
	$cat_query = get_section_query_by_search($category, $target_page, $search_input);
	include(locate_template('section-query-view.php'));

	wp_die(); // this is required to terminate immediately and return a proper response
}


function get_section_query_no_search($category_id, $page = 1) {
	global $POSTS_PER_PAGE;
	return new WP_Query(
		array(
			'cat' => $category_id,
			'posts_per_page' => $POSTS_PER_PAGE,
			'paged' => $page
		)
	);
}

function get_section_query_by_search($category_id, $page = 1, $search_params) {
	global $POSTS_PER_PAGE;
	// We build the query using the array of parameters given
	$search = section_query_process_search($search_params);
	return new WP_Query( 
		array_merge(
			array(
				'cat' => $category_id,
				'posts_per_page' => $POSTS_PER_PAGE,
				'paged' => $page,
			),
			$search
		)
	);
}

function sanitized_input($input) {
	// Sanitize the user input for security reasons
	
	$pos = strpos($input, "\'");
	while ( $pos !== false ) {
		$input[$pos] = "'";
		$input[$pos + 1] = "";
		$pos = strpos($input, "\'");
	}

	return sanitize_text_field($input);
}

function section_query_process_search($input) {
	// Creates the query for the search

	$simple_search = get_posts( array( 's' => $input, 'post_status' => 'publish', ) );
	$taxonomy_search = get_posts_by_taxonomy_terms( explode(" ", $input) );

	$mergedposts = array_merge($simple_search, $taxonomy_search);

	$postids = array();
	foreach( $mergedposts as $item ) {
		$postids[] = $item->ID; //create a new array only of the post ids
	}
	$uniqueposts = array_unique($postids);

    // return array to use the unique post ids as a query parameter
	return array(
	    'post__in' => $uniqueposts
    );
}


function get_posts_by_taxonomy_terms($terms) {
	return get_posts(
		array(
			'post_status' => 'publish',
			'tax_query' => array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'post_tag',
					'field' => 'slug',
					'terms' => $terms
				),
				array(
					'taxonomy' => 'category',
					'field' => 'slug',
					'terms' => $terms
				),
				array(
					'taxonomy' => 'post_tag',
					'field' => 'name',
					'terms' => $terms
				),
				array(
					'taxonomy' => 'category',
					'field' => 'name',
					'terms' => $terms
				)
			)
		)
	);
}



?>