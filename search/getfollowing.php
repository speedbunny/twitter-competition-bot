<?php
/* This code gets another persons followers and adds them to a list */
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET,'1431530552-jpmronImIIqs5OWJeTSm1L81WAiPumCnjho29aj', 'KmauEEmvnyFjzXrK0xoY2d5DMyvbtx5SUqUCUFESf9G9F');
print_r($connection);

$followers = $connection->get('https://api.twitter.com/1.1/friends/ids.json?screen_name=radiodeactive'); 
$put = implode(",",$followers->ids);
$file = "radioids.txt";
file_put_contents($file, $put);

	

 
?>
