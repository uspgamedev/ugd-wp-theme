<?php

/*

Limit character on post thumbnails

*/

add_filter( 'the_title_on_thumbnails', 'UGD_limit_post_title', 10, 1 );
function UGD_limit_post_title($title, $post_id = null) {
	
	$LIMIT = 32;
	
	if ( !is_single() && strlen($title) > $LIMIT ) {
		if ( preg_match('/[^\x20-\x7f]/', $title[$LIMIT-1] ) ) {
			// This checks to see if the last character is half a utf-8 character.
			// Since accentuated letters occupy two bytes, this is necessary.
			// Otherwise garbage is displayed.
			$LIMIT += 1;
		}
		$title =  substr($title, 0, $LIMIT) . "...";
	}

	return $title;
}

?>