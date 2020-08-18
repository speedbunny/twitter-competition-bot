<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');


function strposa($haystack, $needle) {
     if (is_array($needle)) {
         foreach ($needle as $need) {
               if (strpos($haystack, $need) !== false) {
                       return true;
               }
         }
     }else {
          if (strpos($haystack, $need) !== false) {
                       return true;
          }
     }

     return false;
}


//Set the variables
$c=0;


$originals = array();
$pointer = file_get_contents('pointer.txt');
$namefile = file_get_contents('chunk'.$pointer.'.txt');
$goodn = explode(",",$namefile);

//get the master names file chunk it to see how many chunks

$pointercalc = file_get_contents('names.txt');
$calc = explode (",",$pointercalc);
$chunks = array_chunk($calc,150);
$maxpointer = count($chunks);


foreach ($goodn as $name){ //open
echo "Checking ".$name."<br>";


//Using MAYLYLX's auth 
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET,'1514172019-aOEIRsb626FgjN4XCQzelrg006MGu4KCvfE3hin', 'hOXcUjsuFtNzzc218EYUGonazVDBtLCll6TUTWffp1lsm');


$yesterday = date('Y-m-d',strtotime("-3 days"));
$today = date("Y-m-d");

// ******************* EXPLICIT RT BLOCK ******************* 

$searchresults=$connection->get('https://api.twitter.com/1.1/statuses/user_timeline.json', array('screen_name' => $name, 'exclude_replies' => 'true', 'count' => '7','include_rts' => 'false'));
$sr1 = json_encode($searchresults, true);
$sr = json_decode($sr1, true);




foreach ($sr as $status) { //open

$tweet_desc = $status["text"];
$tweet_desc = $status["text"];
$goodprize = true;
$tid= $status["id"];

$compwords = array("competition", "win", "#winitwednesday", "#freebiefriday", "#competition","give away","giveaway","contest","#win","comp", "#Win","RT to","RT and","Retweet and","Follow and","RT&","RT+","re tweet","RT to win", "RT and follow","RT + Follow","RT & Follow","Retweet & Follow","RT and FOLLOW","Re-Tweet","Follow &");
if(strposa($tweet_desc, $compwords)===true){ //open
	echo "<br>Competition found: ".$tweet_desc."<br>";
$twitcomp = array("RT to","RT and","Retweet and","Follow and","RT&","RT+","re tweet","RT to win", "RT and follow","RT ");
if(strposa($tweet_desc, $twitcomp)===true){ //open
echo "<br>Looks like a Twitter Comp!<br>";
$teens = array("solo","gun","5SOS","fam","5/5","Niall","robux","DOTA", "MTVHottest","vote","Teenchoice","Ora","notifications");
$babies = array("baby","nappies","babies","change","children","pregnancy");
$pets = array("dog","rabbit");
$sports = array("potbelly","#RJJLegend","HerNextRemedy","@PamperPoint","#RJJLegend");


if(strposa($tweet_desc, $teens)===true){
	echo "<br>This is a TEEN PRIZE<br>";
	$goodprize = false;
	
} 

if(strposa($tweet_desc, $babies)===true){
	echo "<br>This is a BABY PRIZE<br>";
	$goodprize = false;
	
} 

if(strposa($tweet_desc, $pets)===true){
	echo "<br>This is a PET PRIZE<br>";
	$goodprize = false;

} 


if(strposa($tweet_desc, $sports)===true){
	echo "<br>This is a SPORTS PRIZE<br>";
	$goodprize = false;
	
} 
 
if ($goodprize === true){
echo "This is a good BRAND PRIZE from ".$name."<br>";
} else {
continue;
}

$originals[] .= $tid;


}
}

}

}



$finals = array_unique($originals);
echo "There are ".count($finals)." in the final array";
if (count($finals) > 100){
	echo " - More than 100 ids - reducing";
$finals = array_splice($finals, -99);
}
$nids = implode(",", $finals);
$originaltweets = $connection->get('statuses/lookup', array('id' => $nids, 'include_entities' => false));
$or1 = json_encode($originaltweets, true);
$or = json_decode($or1, true);
echo "original array: ";
print_r($or);


foreach ($or as $status) { //open
	
	
	$already = 0;
$st= $status["id_str"];
$nn= $status["user"]["screen_name"];
$nt = $status["text"];


//Date check
$cd = $status["created_at"];
$ts = strtotime($cd);


if(time() - $ts < 259200) { 
	
	echo $st." is recent<br>";
	$recent = true;
} else {
	
	echo $st." is too old<br>";
	$recent = false;
}

//Check IDs against previously tweeted IDs

$donefile = file_get_contents('rts.txt');
$done = array();
$done = explode(",", $donefile);
if (in_array($st, $done)) {
    echo "Already tweeted ".$st."<br>";
$already = true;
} else {
	$already = false;
}



if ($already === false && $recent === true){ //open
echo "both conditions matched onto text match<br>";
$orfile = file_get_contents('tweets.txt');
$file = 'tweets.txt';
$orig_desc = '"'.preg_replace("/[^a-zA-Z]+/", "", substr($nt,-60,59)).'"';
$oldor = array();
$oldor = explode(",", $orfile);



if (in_array($orig_desc, $oldor)) {
    echo "Text match ".$st."<br>";
$already = true;
} else
$already = false;
}

if ($already === false && $recent === true){

echo "Starting mail";
//define the receiver of the email 
$to = 'buffer-3a90dbfc4b4ae439f240@to.bufferapp.com'; 
//define the subject of the email 
$subject = 'Retweet to Buffer'; 
//create a boundary string. It must be unique 
//so we use the MD5 algorithm to generate a random hash 
$random_hash = md5(date('r', time())); 
//define the headers we want passed. Note that they are separated with \r\n 
$headers = "From: buffer@suddenvibe.com\r\nReply-To: buffer@suddenvibe.com"; 
//add boundary string and mime type specification 
$headers .= "\r\nContent-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\""; 
ob_start(); //Turn on output buffering 
?> 
--PHP-mixed-<?php echo $random_hash; ?>  
Content-Type: multipart/alternative; boundary="PHP-alt-<?php echo $random_hash; ?>" 

--PHP-alt-<?php echo $random_hash; ?>  
Content-Type: text/plain; charset="iso-8859-1" 
Content-Transfer-Encoding: 7bit

(@<?=$nn?>)(https://twitter.com/<?=$nn?>/status/<?=$st?>?s=09)

Get the official Twitter app at https://twitter.com/download?s=13
--PHP-alt-<?php echo $random_hash; ?>  
Content-Type: text/html; charset="iso-8859-1" 
Content-Transfer-Encoding: 7bit

<div>(@<?=$nn?>)(https://twitter.com/<?=$nn?>/status/<?=$st?>?s=3D09)<br>@profiles compinggee<br>Get the official Twitter app at <a href=3D"https://twitter.com/download?s=3D13" target=3D"_blank">https://twitter.com/download?s=3D13</a></div>

--PHP-alt-<?php echo $random_hash; ?>-- 

<?php 
//copy current buffer contents into $message variable and delete current output buffer 
$message = ob_get_clean(); 
//send the email 
$mail_sent = @mail( $to, $subject, $message, $headers ); 
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed" 
echo $mail_sent ? "Mail sent" : "Mail failed"; 
print_r($mail_sent);
//Append ID to done
$file = 'rts.txt';
$tete = $st.',';
file_put_contents($file, $tete,FILE_APPEND);
//Append text to status list
$file = 'tweets.txt';
$owt = '"'.preg_replace("/[^a-zA-Z]+/", "", substr($nt,-60,59)).'",';
file_put_contents($file, $owt,FILE_APPEND);

}

}

echo "max pointer is ".$maxpointer."<br>";
if ($pointer == $maxpointer){
	$newpointer = 1;} else
	{$newpointer = $pointer+1;}
	$file = 'pointer.txt';
	file_put_contents($file,$newpointer);
echo "The new pointer is ".$newpointer."<br>";


?>