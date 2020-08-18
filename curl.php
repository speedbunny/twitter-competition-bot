<?php
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config.php');
//Uses the COMPERO connection
$connection = new TwitterOAuth('9r5kyyVGWxd8scngj3cD8EfGy', 'BbtuGeF1OqnsIEeFLcFc2DQvLOBcTZG2YmRUy0zmRXY94v0Znj', '1431530552-Iu4VE0kTIOYLqsj3baMFTCEqM4zRxhkM0TvoRwd', 'xty2zi6UDALh88zbHqd10ljBPtX9wE97R3WTdyp6uqQvZ');


$friendcheck=$connection->get('friendships/show', array('source_screen_name' => "radiodeactive", 'target_screen_name' => 'BlanXuk' ));
$obj4 = json_encode($friendcheck, true);
$obj5 = json_decode($obj4, true);
print_r($obj5);
if (is_null($obj5["relationship"]["source"]["blocking"])){
echo "isnull";
}
if (empty($obj5["relationship"]["source"]["blocking"])){
echo "empty";
}

if (isset($obj5["relationship"]["source"]["blocking"])){

echo "isset";
}

if ($obj5["relationship"]["source"]["blocking"] == 0){

echo "equals 0";
}
echo okayyy
?>

 