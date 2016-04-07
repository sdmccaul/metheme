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
		'supports'			=> array('title','excerpt'),
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

function feed_data_source( $post ) {
	
	$source = get_post_meta($post->ID, '_source', true);
	
	echo '<input type="text" name="_source" value="' . $source  . '" class="widefat" />';

}

function feed_data_link( $post ) {

	$source = get_post_meta($post->ID, '_link', true);
	
	echo '<input type="text" name="_link" value="' . $source  . '" class="widefat" />';

}

function feed_data_image( $post ) {
	
	$source = get_post_meta($post->ID, '_image', true);
	
	echo '<input type="text" name="_image" value="' . $source  . '" class="widefat" />';

}

function feed_data_date( $post ) {
	
	$source = get_post_meta($post->ID, '_date', true);
	
	echo '<input type="text" name="_date" value="' . $source  . '" class="widefat" />';

}

function save_feed_meta($post_id, $post) {

	// if ( !wp_verify_nonce( $_POST['_wpnonce'] )) {
	// 	return $post->ID;
	// }

	// if ( !current_user_can( 'edit_post', $post->ID )) {
	// 	return $post->ID;
	// }
	
	$feed_meta['_source'] = $_POST['_source'];
	$feed_meta['_link'] = $_POST['_link'];
	$feed_meta['_image'] = $_POST['_image'];
	$feed_meta['_date'] = $_POST['_date'];

	foreach ($feed_meta as $key => $value) { 
		if(!$value) {
			delete_post_meta($post->ID, $key);
		} else {
			update_post_meta($post->ID, $key, $value);
		}
	}

}

add_action('save_post', 'save_feed_meta', 1, 2); // save the custom fields


add_action( 'init', 'custom_post_feed_init' );

/* Stop Adding Functions Below this Line */
?>
