<?php

$ch = curl_init("https://api.github.com/users/sdmccaul/events");
curl_setopt($ch,CURLOPT_USERAGENT, 'sdmccaul');
$result = curl_exec($ch);
curl_close($ch);

echo $result;

// function programmatically_create_post() {

// 	// Initialize the page ID to -1. This indicates no action has been taken.
// 	$post_id = -1;

// 	// Setup the author, slug, and title for the post
// 	$author_id = 1;
// 	$slug = 'example-post';
// 	$title = 'My Example Post';

// 	// If the page doesn't already exist, then create it
// 	if( null == get_page_by_title( $title ) ) {

// 		// Set the post ID so that we know the post was created successfully
// 		$post_id = wp_insert_post(
// 			array(
// 				'comment_status'	=>	'closed',
// 				'ping_status'		=>	'closed',
// 				'post_author'		=>	$author_id,
// 				'post_name'		=>	$slug,
// 				'post_title'		=>	$title,
// 				'post_status'		=>	'publish',
// 				'post_type'		=>	'post'
// 			)
// 		);

// 	// Otherwise, we'll stop
// 	} else {

//     		// Arbitrarily use -2 to indicate that the page with the title already exists
//     		$post_id = -2;

// 	} // end if

// } // end programmatically_create_post
// add_filter( 'after_setup_theme', 'programmatically_create_post' );

// //The various calls to this function would look like this:

// $post_id = programmatically_create_post()
// if( -1 == $post_id || -2 == $post_id ) {
//    // The post wasn't created or the page already exists
// } // end if


// //https://codex.wordpress.org/Function_Reference/register_activation_hook
// register_activation_hook(__FILE__, 'my_activation');

// function my_activation() {
// 	wp_schedule_event(time(), 'hourly', 'my_hourly_event');
// }

// add_action('my_hourly_event', 'do_this_hourly');

// function do_this_hourly() {
// 	// do something every hour
// }

?>