<?php

/*

Limit character on post thumbnails

*/

add_filter( 'the_title_on_thumbnails', 'UGD_limit_post_title', 10, 2 );
function UGD_limit_post_title($title, $post_id = null) {
	// This filter cuts off the post title to a select number of characters so as not to clutter the UI.
	
	$LIMIT = 48; // How many characters is the limit for a post title to show.
	$min = 2;

	if ( is_single() ) return; // We only want this to work on thumbnails.

	if ( strlen($title) > $LIMIT ) {
	
		$words = explode(" ", $title);
		$count = 0;

		// First we count the chars
		foreach ($words as $_word) {
			$count += strlen($_word);
		}
		
		// Now we take the excess
		while ($count > $LIMIT) {
			$count -= strlen( array_pop($words) );
		}

		$title = implode(' ', $words) . " [...]";
		$min = 3;
	}

	return apply_filters('no_widow', $title, $post_id, $min);
}

add_filter( 'no_widow', 'UGD_no_widow_breakline', 10, 3 );
function UGD_no_widow_breakline($text, $ID = null, $min = 2) {
	// This filter breaks the last line in a text in an orderly fashion.
	
	$words = explode(" ", $text);

	if ( count($words) > $min ) {
		$last_words = array();

		for ($i=0; $i < $min; $i++) { 
			$last_words[] = array_pop($words);
		}
		$last_words[0] = $last_words[0] . '</div>';
		$last_words[count($last_words) - 1] = '<div class="inline-block">' . $last_words[count($last_words) - 1];

		for ($i=0; $i < $min; $i++) { 
			array_push( $words, array_pop($last_words) );
		}

		$text = "";
		foreach ($words as $word) {
			$text .= $word . ' ';
		}
	}

	return $text;
}

?>