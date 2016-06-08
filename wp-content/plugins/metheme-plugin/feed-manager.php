<?php

// $ch = curl_init("https://api.github.com/users/sdmccaul/events");
// curl_setopt($ch,CURLOPT_USERAGENT, 'sdmccaul');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// $result = curl_exec($ch);
// curl_close($ch);


// $json = json_decode($result, true);
// foreach($json as $j) {
// 	echo $j["created_at"];
// }


// include('./library/httpful.phar');

// $result = \Httpful\Request::get('https://api.github.com/users/sdmccaul/events')->send();
// $json = json_decode($result, true);
// foreach($json as $j) {
// 	echo $j["created_at"];
// }
include('./library/guzzle.phar');
use GuzzleHttp\Client;

date_default_timezone_set('UTC');

$client = new Client(['base_uri' => 'https://api.github.com/']);
$response = $client->request('GET', 'users/sdmccaul/events');
$jresp = json_decode($response->getBody(), true);
$now = New DateTime(date('Y-m-d H:i:s', time()));
$interval = 7;
$results = array();
foreach($jresp as $j) {
	$createdAt = New DateTime($j['created_at']);
	$dateDelta = $now->diff($createdAt);
	if (($j["type"] == "PushEvent") && ($dateDelta->days < $interval)) {
		$res = array();
		$res["created_at"] = $j["created_at"];
		$index = 0;
		$list = "<ul>\n";
		foreach($j["payload"]["commits"] as $commit) {
			$index += 1; 
			$link = "<li><a href=\"".$commit["url"]."\">".$commit["message"]."</a></li>\n";
			$list .= $link;
		}
		$list .= "</ul>";
		$res["post_content"] = $list;
		if ($index > 1) {
			$commitText = " commits ";
		} else {
			$commitText = " commit ";
		}
		$res['post_title'] = "Pushed ".strval($index).$commitText."to GitHub";
		$results[] = $res;
	}
}
print_r($results);


// $my_post = array(
//     'post_title' => $_SESSION['booking-form-title'],
//     'post_date' => $_SESSION['cal_startdate'],
//     'post_content' => 'This is my post.',
//     'post_status' => 'publish',
//     'post_type' => 'feed-data',
// );
// $the_post_id = wp_insert_post( $my_post );


// __update_post_meta( $the_post_id, 'my-custom-field', 'my_custom_field_value' );

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