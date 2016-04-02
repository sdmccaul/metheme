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
		'supports'			=> array('title','excerpt','custom-fields'),
		'register_meta_box_cb' => 'add_feed_data_metaboxes',
	);
	register_post_type( 'feed-data', $args );
	flush_rewrite_rules();
}

function add_feed_data_metaboxes() {
	add_meta_box('feed_data_source', 'Data Source', 'feed_data_source', 'feed-data', 'normal', 'default');
	add_meta_box('feed_data_link', 'Data Link', 'feed_data_link', 'feed-data', 'normal', 'default');
	add_meta_box('feed_data_image', 'Image Data', 'feed_data_image', 'feed-data', 'normal', 'default');
	add_meta_box('feed_data_date', 'Data Create Date', 'feed_data_date', 'feed-data', 'normal', 'default');
}
// The Event Location Metabox

function feed_data_source() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="feedmeta_noncename" id="feedmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the location data if its already been entered
	$source = get_post_meta($post->ID, '_source', true);
	
	// Echo out the field
	echo '<input type="text" name="_source" value="' . $source  . '" class="widefat" />';

}

function feed_data_link() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="feedmeta_noncename" id="feedmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the location data if its already been entered
	$source = get_post_meta($post->ID, '_link', true);
	
	// Echo out the field
	echo '<input type="text" name="_link" value="' . $source  . '" class="widefat" />';

}

function feed_data_image() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="feedmeta_noncename" id="feedmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the location data if its already been entered
	$source = get_post_meta($post->ID, '_image', true);
	
	// Echo out the field
	echo '<input type="text" name="_image" value="' . $source  . '" class="widefat" />';

}

function feed_data_date() {
	global $post;
	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="feedmeta_noncename" id="feedmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	
	// Get the location data if its already been entered
	$source = get_post_meta($post->ID, '_date', true);
	
	// Echo out the field
	echo '<input type="text" name="_date" value="' . $source  . '" class="widefat" />';

}


add_action( 'init', 'custom_post_feed_init' );

// add_action( 'add_meta_boxes', 'add_feed_data_metaboxes');

/* Stop Adding Functions Below this Line */
?>
