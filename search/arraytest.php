<?php
//Sarah Eaglesfield - Feb 2016 - Proof of Concept sentiment script

//Array search function
function strposa( $haystack, $needles = array( ), $offset = 0 ) {
$chr = array( );
foreach ( $needles as $needle )
    {
    $res = strpos( $haystack, $needle, $offset );
    if ( $res !== false )
        return $needle;
    }
return 'no';
}
//Connect to the Twitter API with OAuth consumer key & secret, perform a search on mentions of MyRestaurant, and return results as an array
$results=array("The eggs at @MyRestaurant were horrible","I went to @MyRestaurant this morning","Just had delicious bacon and eggs at MyRestaurant! Yum!","I'm at MyRestaurant for dinner tonight");

//For each tweet 
foreach ($results as $status) {

//Does this tweet relate to the breakfast menu?
$breakfastmenu = array("breakfast","this morning","muffin","bacon","eggs","sarnie");

//If this tweet is about the breakfast menu
if (strposa($status, $breakfastmenu) !== 'no') {

//Default sentiment
$sentiment = "neutral";	

//good keywords and bad keywords
$good  = array("delicious","amazing","great","fab","yum","lovely");
$bad = array("horrible","nasty","bland","yuck","not happy","bad");


//if good keyword present in tweet
if(strposa($status, $good) !== 'no'){
$sentiment = "good";
}

//if bad keyword present in tweet
if(strposa($status, $bad)!== 'no'){
$sentiment = "bad";
}

//What have customers been tweeting about the breakfast menu?
echo '"'.$status.'"';
echo "<br>>>> This is a ".$sentiment." tweet about ".strposa($status, $breakfastmenu)."<br><br>";
} else {
	echo '"'.$status.'"';
	echo "<br>>>> This is not related to the breakfast menu";
	}
} 
?>

