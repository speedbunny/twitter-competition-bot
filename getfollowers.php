<?php
/* This code gets another persons followers and adds them to a list */
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, "15777543-oshwD9W3R1ILoSLTgCye90bTvR6NQNiSmmdP1Ky2y", "9dtbI7Ho6oEuTwE1Iob94VLiqS5ema690U56GlOUlGU");
$followers = $connection->get('friends/ids', array('screen_name' => 'sondrelerche')); 

$userarray=$followers->ids;


for ($i=0; $i<=798; $i++){
	

$userstring .= $userarray[$i].",";
	
}

$ids = rtrim($userstring, ",");
 $string = $connection->post('https://api.twitter.com/1.1/lists/members/create_all.json?user_id='.$ids.'&list_id=135584683');
print_r($string); 
?>
