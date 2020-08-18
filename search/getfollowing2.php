<?php
/* This code gets another persons followers and adds them to a list */
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET,'1431530552-jpmronImIIqs5OWJeTSm1L81WAiPumCnjho29aj', 'KmauEEmvnyFjzXrK0xoY2d5DMyvbtx5SUqUCUFESf9G9F');
print_r($connection);
$pointer = file_get_contents('idpointer.txt');
$namefile = file_get_contents('idchunk'.$pointer.'.txt');
//increase by 1 for every thousand following
$maxpointer = 4;
$goodn = explode(",",$namefile);
$unique = array_unique($goodn);
$chunks = array_chunk($goodn,99);


foreach ($chunks as $chunk){
	
$followers = implode(',',$chunk);
	
	$string = $connection->get('https://api.twitter.com/1.1/users/lookup.json?user_id='.$followers);
	
	foreach ($string as $person){
		$userarray=$person->screen_name;
	$file = 'radiodeactive.txt';
	$put = $userarray.",";
file_put_contents($file, $put,FILE_APPEND);

	}
}

$followfile = file_get_contents('radiodeactive.txt');
$followarr = explode (",",$followfile);
$uniquefollow = array_unique($followarr);
$rebuildtweets = implode(",",$uniquefollow);
$nfollowfile = 'nfollowing.txt';
file_put_contents($nfollowfile,$rebuildtweets);
unlink ("radiodeactive.txt");
rename("nfollowing.txt", "radiodeactive.txt");

echo "max pointer is ".$maxpointer."<br>";
if ($pointer == $maxpointer){
	$newpointer = 1;} else
	{$newpointer = $pointer+1;}
	$file = 'idpointer.txt';
	file_put_contents($file,$newpointer);
echo "The new pointer is ".$newpointer."<br>";
 
?>
