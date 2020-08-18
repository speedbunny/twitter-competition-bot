<?php
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');

function strposa($haystack, $needles=array()) {
        $chr = array();
        foreach($needles as $needle) {
                $res = strpos($haystack, $needle, $offset);
                if ($res !== false) $chr[$needle] = false;
        }
        if(empty($chr)) return true;
        return min($chr);
}

$feed = new DOMDocument();
 $feed->load('https://script.google.com/macros/s/AKfycby3XazhDNwRSqAP_fXO4MMfm8znOJbWMLsirQiqItpa5EQ3y2H5/exec?624267123397890049');
 $json = array();
 $json['title'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('title')->item(0)->firstChild->nodeValue;
 $json['description'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('description')->item(0)->firstChild->nodeValue;
 $json['link'] = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('link')->item(0)->firstChild->nodeValue;
 $items = $feed->getElementsByTagName('channel')->item(0)->getElementsByTagName('item');

 $json['item'] = array();
 $i = 0;
 $c = 0;

 foreach($items as $key => $item) {
 
 $title = $item->getElementsByTagName('title')->item(0)->firstChild->nodeValue;
 $description = $item->getElementsByTagName('description')->item(0)->firstChild->nodeValue;
 $pubDate = $item->getElementsByTagName('pubDate')->item(0)->firstChild->nodeValue;
 $guid = $item->getElementsByTagName('guid')->item(0)->firstChild->nodeValue;

 $json['item'][$key]['title'] = $title;
 $json['item'][$key]['description'] = $description;
 $json['item'][$key]['pubdate'] = $pubDate;
 $json['item'][$key]['guid'] = $guid; 
 }

$string= json_encode($json);

$explodeo = explode('{',$string);
unset($explodeo[0]);
unset($explodeo[1]);
implode("},", $explodeo);
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, '1431530552-f1lmpNeDsJ1FyK0BfcFtSGhqPCSHrvT3KCADPLJ', 'GdD9SmEGJa3LBAyHzty6N4UDVEc27GdnyEyRBS4bEDQOR');
$loop = 0;


foreach ($explodeo as $status) {
//if (++$loop == 10) break;
 $explodep = explode('},',$status);
$ttid = explode('status',$explodep[0]);
$toid = explode(',',$ttid[1]);
$tid = substr(preg_replace("/[^0-9]/","",$toid[0]),0,18);
$tweetinfo = $connection->get('statuses/show', array('id' => $tid)); 
$obj2 = json_encode($tweetinfo, true);
$obj3 = json_decode($obj2, true);

$creation=$obj3["created_at"];


if(strtotime($creation)>strtotime('-7 days')){
echo $creation;
echo "Timecheck. Tweet created ".strtotime($creation)." 12 days ago number ".strtotime('-12 days');

$tweet_desc = $obj3["text"];
$twochar = mb_substr($tweet_desc,0,2);
echo "<br>".$tweet_desc."<br>";
echo "My Reply Check ".$twochar."<br>";
if (mb_substr($tweet_desc,0,2) == "RT"){
$checksum = 23;
echo $checksum;
}
if ($twochar  != "RT"){
if ($tweet_desc[0] != "@"){



$badd  = array("baby", "robux", "account of the day", "nappies","babies","change station","children","golf","pregnancy","change bag","pet","dog","rabbit");

if (strposa($tweet_desc, $badd)) {
 echo "<br>Prize OK<br>";

$rt = $obj3["entities"]["media"][0]["source_status_id_str"];
if (is_null($rt)){
$rt = $tid;
}

$un = $obj3["retweeted_status"]["user"]["screen_name"];


if (is_null($un)){
$un = $obj3["retweeted_status"]["in_reply_to_screen_name"];
}
if (is_null($un)){
$un = $obj3["user"]["screen_name"];
}

//Check User Location
$locationinfo = $connection->get('users/show', array('screen_name' => $un, 'include_entities' => false));
$obj6 = json_encode($locationinfo, true);
$obj7 = json_decode($obj6, true);

$location = $obj7["location"];
 echo "<br>Location OK<br>"; 

$bad  = array('USA','Cleveland','Sydney','Melbourne','Minnesota','Ohio','Texas','Charlotte','New Jersey','Baltic','America','Santa Ana','India','Toronto','Illinois','New York','Chicago','Los Angeles','Las Vegas','Nevada','Kansas','Austrailia','New Zealand');

if (strposa($location, $bad)) {
     
if (is_null($location)) {
echo "No locations <br>";

} else {
echo $location." <br>";
}

echo "<br>The original ID of this tweet is ".$rt."<br>";
echo "<br>The url shoud be <a href='https://twitter.com/".$un."/status/".$rt."'>here</a><br><br><br>";
//Check if we're friends
$friendcheck=$connection->get('friendships/show', array('source_screen_name' => "radiodeactive", 'target_screen_name' => $un ));
$obj4 = json_encode($friendcheck, true);
$obj5 = json_decode($obj4, true);
if ($obj5["relationship"]["source"]["following"] == false){
$connection->post('friendships/create', array('screen_name' => "$un"));

$c=$c+1;
}

echo "You have followed ".$c." new people.<br>";
//Favourite
$connection->post('https://api.twitter.com/1.1/favorites/create.json', array('id' => $rt));
echo "Faved & ";
//Retweet
$connection->post('https://api.twitter.com/1.1/statuses/retweet/'.$rt.'.json');

echo "Retweeted<br>";

}
}
}
}
}
}

?>