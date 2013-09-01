<?php
/**
 * @package Admin Social Shares
 * @version 1.1
 */
/*
Plugin Name: WordiZ - Admin Social Shares
Plugin URI: http://blog.wordiz.it/plugins/wordpress-admin-shares
Description: A plugin that adds three columns to the listing of your articles on your administration. It shows the number of +1, tweets and facebook likes for every post. Like this you quickly see which post received a lot of social attention.
Author: Jean-Christophe Lavocat
Version: 1.1
Author URI: http://www.wordiz.it
*/


// Display tweet number

function insert_js($randnb,$url){
$js_txt="<script type='text/javascript'>";
$js_txt.="jQuery(document).ready(function(jQuery){";
$js_txt.="	var url ='".$url."';";
$js_txt.="	var iddivTwit='#twitter".$randnb."';";
$js_txt.="	var iddivFb='#facebook".$randnb."';";
$js_txt.="	var iddivGp='#plusones".$randnb."';";

//$js_txt.="alert('Hello');";
$js_txt.="	getfbcount(url,iddivFb);";
$js_txt.="	gettwcount(url,iddivTwit);";
$js_txt.="	getgpcount(url,iddivGp);";
$js_txt.="	 });";
$js_txt.="</script>";


/*$js_txt="<script type='text/javascript'>";
$js_txt.="jQuery(document).ready(function(){alert('Hello');});";
$js_txt.="</script>";*/
return $js_txt;
}
 // Add the columns to the admin listing of posts

function my_custom_columns($defaults) { 
unset($defaults['author']); 
unset($defaults['tags']); 
$defaults['nb_tweets'] = 'Tweets';
$defaults['nb_fb_likes'] = 'Likes';
$defaults['nb_googleplus'] = '+1';
return $defaults; 
} 
add_filter('manage_posts_columns', 'my_custom_columns');
add_action('manage_posts_custom_column', 'my_show_columns'); 

function my_show_columns($name) {
 global $post; $mypost = $post->ID; 
 $randid=rand();
 $url=get_permalink();
 echo insert_js($randid,$url);
switch ($name) { 
	case 'nb_tweets':
		echo"<div id='twitter".$randid."' class='twitter_count'></div>";
		break;
	case 'nb_fb_likes':
		echo"<div id='facebook".$randid."' class='facebook_count'></div>";
		break;
	case 'nb_googleplus':
		echo"<div id='plusones".$randid."' class='google_count'></div>";
		break;
	}
}

// Load the JS scripts
add_action('admin_enqueue_scripts','wordiz_init');
function wordiz_init($hook) {

	if( $hook != 'edit.php' ) //do not import outside edit.php
		return;
	wp_enqueue_script( 'wordiz_social_shares', plugins_url( '/js/wordiz_social_shares.js', __FILE__ ));
        //wp_enqueue_script('wordiz_social_shares', plugins_url('/js/wordiz_social_shares.js', array('jquery')));
	//enqueue_script('jquery');
}
?>
