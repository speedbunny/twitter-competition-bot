<?php
session_start();
require_once('twitteroauth/twitteroauth.php');
require_once('config2.php');
$top = $_POST['top'];
$user = $_POST['user'];

echo 'top'.$top;
echo 'tweet'.$user;
// Get user information from Database

// Create connection
$username = "nervousd_twitter";
$password = "tw33t3r";
$hostname = "localhost"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
 or die("Unable to connect to MySQL");


//select a database to work with
$selected = mysql_select_db("nervousd_twitter",$dbhandle) 
  or die("Could not select nervousd_twitter");

//execute the SQL query and return records
$result = mysql_query("SELECT * FROM `rss_twitter_users` WHERE oauth_provider = 'twitter'");


$rows = array();
 
// Fetch all rows and store them in the new array:
while ($row = mysql_fetch_assoc($result))
    $rows[] = $row;
 
// Randomize all result rows
shuffle($rows);
 
// Now do something cool with the randomized
// results:
if ($top > 0){ 
$i = 0;
foreach($rows as $data){ 
print_r ($data);
$usern = $data{'username'};
echo '<h1>'.$usern.'</h1><br />';
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $data{'oauth_token'}, $data{'oauth_secret'});
$string=$connection->post('https://api.twitter.com/1.1/friendships/create.json', array('screen_name' => $user, 'screen_name' => 'true'));
print_r ($string);

if (++$i >= $top) break;
}
}








?>
