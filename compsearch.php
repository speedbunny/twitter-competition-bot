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
//Uses the SUPER COMP connection for RADIODEACTIVE
$connection = new TwitterOAuth('J7HRsBEQw2aAW2PPlc7i4bj82', 'UxP63x0m54xKilyRVwj5OgaHBY8sTrDIJvUD1xSXM0dU36kvU9', '1431530552-M4v13jhUSRyUI9I4Fao7Nonlzx27AZlgmseOnAR', 'ahzSBszEwwHBUVtyOnmdBSoKbPWf7QJPVaVX08THZ4zOP');


$pointer = file_get_contents('pointer.txt');
echo $pointer;
$searchresults=$connection->get('https://api.twitter.com/1.1/search/tweets.json', array('since_id' => $pointer,'count' => '100', 'q' => '"win" OR #winitwednesday OR #freebiefriday AND ("RT&F" OR "Retweet & Follow" OR "Retweet to" OR "RT to win" -filter:retweets)'));


$sr1 = json_encode($searchresults, true);
$sr = json_decode($sr1, true);
$results = $sr["statuses"];
unset ($results["metadata"]);

$firsttweet = $results[2][id_str];

$file = 'pointer.txt';
$current = $firsttweet;
file_put_contents($file, $current);
echo "new pointer ".$firsttweet."<br>";

foreach ($results as $status) {
$tid= $status["id"];
$tweet_desc = $status["text"];
$twochar = mb_substr($tweet_desc,0,2);
$sevenchar = mb_substr($tweet_desc,0,7);
echo "My Reply Check ".$twochar."for $tid<br>";

if ($tweet_desc[0] != "@"){

$sevenchar = mb_substr($tweet_desc,0,7);
if ($sevenchar  != "I'm Ent"){




$badd  = array("baby","DM","gun","robux","DOTA","nappies","babies","change","children","golf","pregnancy","pet","dog","rabbit","account","vote","Teenchoice");
echo "Bad prize check<br>";


//$raw = preg_replace('/\W+/', ' ', $tweet_desc);
echo "<br>".$tweet_desc."<br>";
if(strposa($tweet_desc, $badd)===false){
 echo "<br>Prize OK<br>";

$rt = $status["entities"]["media"][0]["source_status_id_str"];
if (is_null($rt)){
$rt = $tid;
}

$un = $status["retweeted_status"]["user"]["screen_name"];


echo "User name check <br>";
if (is_null($un)){
$un = $status["retweeted_status"]["in_reply_to_screen_name"];
}
if (is_null($un)){
$un = $status["user"]["screen_name"];
}
echo "User name is $un <br>";
//Check User Location
$locationinfo = $connection->get('users/show', array('screen_name' => $un, 'include_entities' => false));
echo "Location check ";
$obj6 = json_encode($locationinfo, true);
$obj7 = json_decode($obj6, true);

$location = $obj7["location"];
echo $location;

$bad  = array("USA","Toronto","Cleveland","Canada","North Carolina","South Carolina","Louisiana","Vancouver","Sydney","Melbourne","Minnesota","Ohio","Texas","Charlotte","New Jersey","Baltic","America","Santa","India","Toronto","Illinois","New York","Chicago","Los Angeles","Las Vegas","Nevada","Kansas","Austrailia","New Zealand","California","States","America","Africa","Virginia","Nashville","Mississauga","Washington");

if(strposa($location, $bad)===true){
continue;
echo $location." <br>";
}
elseif(strposa($location, $bad)===false){
   echo "<br>Location OK<br>";    
if (is_null($location)) {
echo "No locations <br>";

} 

echo "<br>The original ID of this tweet is ".$rt."<br>";
echo "<br>The url shoud be <a href='https://twitter.com/".$un."/status/".$rt."'>here</a><br><br><br>";
//Check if we're friends
$friendcheck=$connection->get('friendships/show', array('source_screen_name' => "radiodeactive", 'target_screen_name' => $un ));
$obj4 = json_encode($friendcheck, true);
$obj5 = json_decode($obj4, true);
if ($obj5["relationship"]["source"]["blocking"] == 1) {
echo "Blocked user - skipping";
continue;
}

if ($obj5["relationship"]["source"]["following"] == false){
$connection->post('friendships/create', array('screen_name' => "$un"));

$c=$c+1;
if ($c > 5) break;
echo "You have added ".$c." friends.<br>";

}

$connection->post('https://api.twitter.com/1.1/statuses/retweet/'.$rt.'.json');
$nstring=$connection->post('https://api.twitter.com/1.1/statuses/retweet/'.$rt.'.json');
print_r ($nstring);
echo "Retweeted<br>";
sleep (5);
}
}
}
}
}
echo "end";
?>