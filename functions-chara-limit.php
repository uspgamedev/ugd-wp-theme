<?php

/*

Limit character on post thumbnails

*/

add_filter( 'the_title_on_thumbnails', 'UGD_limit_post_title', 10, 1 );
function UGD_limit_post_title($title, $post_id = null) {
	
	$LIMIT = 32;
	
	if ( !is_single() && strlen($title) > $LIMIT ) {
		$title = substr($title, 0, $LIMIT) . "...";
	}

	return $title;
}

?>