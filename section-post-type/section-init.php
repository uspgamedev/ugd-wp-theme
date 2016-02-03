<?php

//initialise plugin

add_action( 'init', 'register_section_post_type' );
function register_section_post_type() {
  	register_post_type( 'ugd_section',
	    array(
			'labels' => array(
				'name' => __('Sections'),
				'singular_name' => __('Section'),
				'add_new'            => __('Add New'),
				'add_new_item'       => __('Add New Section'),
				'new_item'           => __('New Section'),
				'edit_item'          => __('Edit Section'),
				'view_item'          => __('View Section'),
				'all_items'          => __('All Sections'),
			),
			'public' => true,
			'menu_position' => 5,
			'supports' => array('title', 'page-attributes')
	    )
  	);
}

?>