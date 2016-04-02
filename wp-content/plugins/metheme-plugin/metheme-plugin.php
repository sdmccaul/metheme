<?php
/*
Plugin Name: Metheme Plugin for stevenmccauley.me
Description: Site specific code changes for stevenmccauley.me
*/
/* Start Adding Functions Below this Line */
function custom_post_feed_init() {
	$labels = array(
		'name' => 'Feed Data',
		'singular_name' => 'Feed Post',
		'add_new' => 'Add New',
		'add_new_item' => 'Add New Feed Post',
		'edit_item' => 'Edit Feed Post',
		'new_item' => 'New Feed Post',
		'view_item' => 'View Feed Post',
		'search_items' => 'Search Feed Data',
		'not_found' => 'No feed data found',
		'not_found_in_trash' => 'No feed data found in trash'
	);
	$args = array(
		'labels'			=> $labels,
		'description'		=> 'Data from external feeds',
		'public'			=> true,
		'rewrite'			=> array('slug' => 'feed-data'),
		'has_archive'		=> true,
		'menu_icon'			=> 'dashicons-controls-repeat',
		'menu_position'		=> 5,
		'supports'			=> array( 'title','custom-fields')
	);
	register_post_type( 'feed-data', $args );
	flush_rewrite_rules();
}
add_action( 'init', 'custom_post_feed_init' );

/* Stop Adding Functions Below this Line */
?>
