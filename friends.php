<?php
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

$connection = new TwitterOAuth("lPQo4xr0mdfeq1H8vRiA", "A93aiiT9W95Ll3p8VXB10LDBRa07xSPnDYT1M6IeQ", "15777543-oshwD9W3R1ILoSLTgCye90bTvR6NQNiSmmdP1Ky2y", "9dtbI7Ho6oEuTwE1Iob94VLiqS5ema690U56GlOUlGU");
$string = $connection->get('https://api.twitter.com/1.1/friendships/show.json?source_screen_name=sondrelerche&target_screen_name=flightsideuk');
print_r ($string);
$string = $connection->get('https://api.twitter.com/1.1/friendships/show.json?source_screen_name=flightsideuk&target_screen_name=sondrelerche');
print_r ($string);

 









?>
