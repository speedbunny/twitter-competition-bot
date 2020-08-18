<?php
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


$c=0;

$originals = array();
$namefile = file_get_contents('names.txt');
$goodn = explode(",",$namefile);



$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET,'1431530552-jpmronImIIqs5OWJeTSm1L81WAiPumCnjho29aj', 'KmauEEmvnyFjzXrK0xoY2d5DMyvbtx5SUqUCUFESf9G9F');





//ONLY VERIFIED & NAMED



$searchresults=$connection->get('https://api.twitter.com/1.1/search/tweets.json', array('result_type' => 'top','count' => '100', 'q' => '"win" AND "competition" OR #winitwednesday OR #freebiefriday OR #giveaway AND ("RT and" OR "RT to" OR "Retweet & Follow" OR "Retweet to" OR "RT to win") -filter:retweets'));

$sr1 = json_encode($searchresults, true);
$sr = json_decode($sr1, true);
$results = $sr["statuses"];
print_r($results);
unset ($results["metadata"]);



foreach ($results as $status) {
$tid= $status["id"];
$goodname = false;


$originals[] .= $tid;

}

$finals = array_unique($originals);
$nids = implode(",", $finals);
print_r($nids);
$originaltweets = $connection->get('statuses/lookup', array('id' => $nids, 'include_entities' => false));
$or1 = json_encode($originaltweets, true);
$or = json_decode($or1, true);

foreach ($or as $status) {
	$already = 0;
$st= $status["id_str"];
$nn= $status["user"]["screen_name"];
$nt = $status["text"];

//Date check
$cd = $status["created_at"];
$ts = strtotime($cd);

if(time() - $ts < 126900) {
	echo $cd." is recent<br>";

//Check IDs against previously tweeted IDs
if (file_exists('rts.txt')) {
$donefile = file_get_contents('rts.txt');
$done = array();
$done = explode(",", $donefile);
if (in_array($st, $done)) {
    echo "Already tweeted ".$st."<br>";
$already = 1;
}

if ($already != 1){


$orfile = file_get_contents('tweets.txt');
$file = 'tweets.txt';
$orig_desc = '"'.preg_replace("/[^a-zA-Z]+/", "", substr($nt,-60,20)).'"';
$oldor = array();
$oldor = explode(",", $orfile);
echo "Text check for:".$orig_desc."<br>";


if (in_array($orig_desc, $oldor)) {
    echo "Text match ".$st."<br>";
$already = 1;
}

}
if ($already != 1){
	echo "Into Friend Check ".$st."<br>"; 
//Check if we're friends
$friendcheck=$connection->get('friendships/show', array('source_screen_name' => "radiodeactive", 'target_screen_name' => $nn ));


$obj4 = json_encode($friendcheck, true);
$obj5 = json_decode($obj4, true);

if (empty($obj5["relationship"]["source"]["blocking"])){
	echo "Not blocked<br>"; 
	

if (empty($obj5["relationship"]["source"]["following"]) ){
$file = 'add.html';
$current .= '<a href="http://twitter.com/'.$nn.'/">http://twitter.com/'.$nn.'/</a> <br><br>';
file_put_contents($file, $current,FILE_APPEND);
} elseif ($obj5["relationship"]["source"]["blocking"] === 1 || $nn == 'radiodeactive') {
echo "Blocked user - skipping<br>";
continue;
} 

echo "Starting mail";
//define the receiver of the email 
$to = 'buffer-81d41e4cbe467b9fd37e@to.bufferapp.com'; 
//define the subject of the email 
$subject = 'Retweet to Buffer'; 
//create a boundary string. It must be unique 
//so we use the MD5 algorithm to generate a random hash 
$random_hash = md5(date('r', time())); 
//define the headers we want passed. Note that they are separated with \r\n 
$headers = "From: buffer@nervousdating.com\r\nReply-To: buffer@nervousdating.com"; 
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

<div>(@<?=$nn?>)(https://twitter.com/<?=$nn?>/status/<?=$st?>?s=3D09)<br><br>Get the official Twitter app at <a href=3D"https://twitter.com/download?s=3D13" target=3D"_blank">https://twitter.com/download?s=3D13</a></div>

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
$owt = '"'.preg_replace("/[^a-zA-Z]+/", "", substr($nt,-60,20)).'",';
file_put_contents($file, $owt,FILE_APPEND);
}
}
}
}
}


?>
 





 
