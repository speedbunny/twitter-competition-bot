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



$c=0;

$originals = array();
$namefile = file_get_contents('names.txt');
$goodn = explode(",",$namefile);


//Radiodeactives Oauth
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET,'1431530552-jpmronImIIqs5OWJeTSm1L81WAiPumCnjho29aj', 'KmauEEmvnyFjzXrK0xoY2d5DMyvbtx5SUqUCUFESf9G9F');


$yesterday = date('Y-m-d',strtotime("-1 days"));
$today = date("Y-m-d");

// ******************* EXPLICIT RT BLOCK ******************* 

$searchresults=$connection->get('https://api.twitter.com/1.1/search/tweets.json', array('result_type' => 'recent','count' => '100', 'since' => $yesterday, 'q' => '"competition" OR "win" OR #winitwednesday OR #freebiefriday OR #competition'));



$sr1 = json_encode($searchresults, true);
$sr = json_decode($sr1, true);
$results = $sr["statuses"];
unset ($results["metadata"]);



foreach ($results as $status) {
$tid= $status["id"];
$tweet_desc = $status["text"];
$goodprize = true;
$goodname = true;
$goodlocation = false;
$attest=0;
$twitcomp = array("RT to","RT and","Retweet and","Follow and","RT&","RT+","re tweet","RT to win", "RT and follow","RT ","RT + Follow","RT & Follow","Retweet & Follow");
if(strposa($tweet_desc, $twitcomp)===true){
$sevenchar = mb_substr($tweet_desc,0,7);

if ($tweet_desc[0] != "@" && $sevenchar !="I'm Ent" && $tweet_desc[1] != "@" && $tweet_desc[3] != "@"  && $tweet_desc[4] != "@"){
	$attest =1;
	
} 


	
if ($attest < 1){
	echo $tweet_desc." failed the AT TEST<br>";
} else {



echo "<br>".$tweet_desc."<br>";




$rt = $status["entities"]["media"][0]["source_status_id_str"];
if (is_null($rt)){
$rt = $tid;
}

$un = $status["retweeted_status"]["user"]["screen_name"];



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

$goodl = array("England","UK","United Kingdom","Folkestone","Germany","Cumbria","Bristol","Yorkshire","Cardiff","Cornwall","Wales","Scotland","London","Manchester","Birmingham","Newcastle","Guildford","West Midlands","Isle of White","Nottingham","Hastings","Canterbury","Coventry","Warwick","Oxford","Liverpool","Dover","Brighton","Norwich","Leeds","Reading","Richmond","Exeter","Cambridge","Gloucester","Leicester","Carlisle","Ipswich","Portsmouth","Berwick","Sheffield","Kingston upon Hull","Bradford","Stoke-on-Trent","Wolverhampton","Plymouth","Derby","Southampton","Dudley","Newcastle upon Tyne","Sunderland","Northampton","Preston","Walsall","Luton","Southend-on-Sea","Bournemouth","Middlesbrough","West Bromwich","Blackpool","Oldbury","Swindon","Huddersfield","Bolton","Poole","Peterborough","Stockport","Rotherham","Watford","Slough","St Helens","Sutton Coldfield","Blackburn","Oldham","Basildon","Woking","Chelmsford","Colchester","Worthing","Gillingham","Eastbourne","Solihull","Rochdale","Birkenhead","Cheltenham","Halifax","Southport","Maidstone","Grimsby","Crawley","Hartlepool","Darlington","Wigan","Bath","South Shields","Stockton-on-Tees","Gateshead","Warrington","Worcester","St Albans","	Lincoln","Chester","Salford","Hemel Hempstead","Basingstoke","Stevenage","Scunthorpe","Barnsley","Burnley","Harlow","Wakefield","Bedford","Newcastle-under-Lyme","Redditch","Chesterfield","Mansfield","High Wycombe","Chatham","Milton Keynes","Telford","Crawle","Aberdeen","Bangor","Brighton","Chichester","Dundee","Durham","Edinburgh","Ely","Glasgow","Hereford","Inverness","Lancaster","Lichfield","Lincoln","Lisburn","Londonderry","Newport","Newry","Ripon","Salisbury","St Davids","Stirling","Swansea","Truro","Wells","Westminster","Winchester","","Berkshire","Hampshire","Middleton","North London","West London","Cheshire","Kent","Hertfordshire","Tunbridge Wells","Farnborough","Barnstaple","Surrey","East Midlands","North Yorkshire","Southend-On-Sea","Croydon","Huntingdon","Neath","Northamptonshire","Newcastle Upon Tyne","South East London","Leighton Buzzard","Worcestershire","Romford","West Hampstead","Doncaster","North West London","Herefordshire","Merseyside","North West England","Lambeth","Devon","Ealing","Derbyshire","Midlothian","West Lothian","Cambridgeshire","Wiltshire","Essex","Bedfordshire","Staffordshire","Somerset","Crewe","North Waltham","Aberdeenshire","Gloucestershire","Eastleigh","Peckham","Lancashire","Kettering","Lincolnshire","Marton-In-Cleveland","Isle Of Wight","Oxfordshire","South Yorkshire","Wellington","Reigate","Hythe","Jedburgh","Arbroath","East London","South West London","North East England","Immingham","Brentwood","Windsor","Suffolk","Abbots Langley","Avon","South East England","Leatherhead","Buckinghamshire","Central London","Bracknell","Abingdon","Leicestershire","Walton-On-Thames","Dorset","Norfolk","Newbury","Fowey","Fleet","Yorkshire","East Sussex","West Sussex","Barry","Haywards Heath","East Sheen","Epsom","Staines","Harrogate","Seaford","Camberwell","Stafford","Torquay","Fareham","Bodmin","Kingston Upon Thames","Ashford","Hook","Southend","Lowestoft","Weymouth","Whitehaven","Barking","Airdrie","Tipton","Royston","Ware","North Lambeth","St. Austell","Barbican","West Yorkshire","Uxbridge","Gaydon","Warwickshire","Marlow","Letchworth","Didcot","Morpeth","Nottinghamshire","Runcorn","South West England","Stamford","Inverkeithing","Cupar","Livingston","Whyteleafe","Tonbridge","Hayes","Holmrook","St. Albans","Stanton-On-The-Wolds","Sittingbourne","Irlams O' Th' Height","Stratford-Upon-Avon","Chertsey","Dorking","Egham","Redhill","Broadstairs","Hackney","Hounslow","Leitrim","Heathrow","Little Chesterford","Welwyn","Margate","Burgess Hill","West End","Islington","Castleford","Dunfermline","Prescot","Bridport","Stourbridge","Fawley","Purley","Cirencester","Dorchester","Evesham","March","Shoreditch","Kingswood","Great Yarmouth","Isleworth","Earls Barton","Addlestone","Clifton","Titchfield","East Riding","Chalvey","France Lynch","Spalding","Deane","North Finchley","Wimbledon","Borehamwood","Beaconsfield","Greenwich","Hooke","South Lanarkshire","Quinton","Halewood","St. Neots","St Lukes","Chiswick","Hyde Park","Clacton-On-Sea","Bellshill","Eastern England","Downes","Fermanagh","Roehampton","Banbury","Northumberland","Scarborough","Prestwick","Sutton Green","Broadway","Witney","Bolton Le Sands","Farnham","Tewkesbury","Greater Manchester","Southsea","Melksham","Wellingborough","Melton Mowbray","Canary Wharf","Bury St. Edmunds","Guernsey","Brentford","North Lanarkshire","Theale","Corsham","Wokingham","Gerrards Cross","Paddington","Soho","Rugby","St. Helens","Swanley","Aberystwyth","Coscote","Winnersh","Beverley","Hinckley","Peterlee","Bromley","Redcar","Weston-Super-Mare","Knowsley","Dunstable","Shropshire","North Ewster","Weybridge","Towcester","Bradford-On-Avon","Blaenau Ffestiniog","North Piddle","Taunton","Sevenoaks","Cliftonville","Tenterden","Pembury","Ilford","Macclesfield","Esher","Harrow","Hertford","Mile End","Grays","Stokenchurch","Dumfries","Christchurch","Market Harborough","Warminster","Axbridge","Aston","Tyne & Wear","Edinburgh Technopole","Camberley","Droitwich","Oakdale","Shere","Matlock","Grangemouth","Aylesbury","Leamington Spa","Cwmbran","Chippenham","Two Mile Ash","Handbridge","Calcot","Manchester Science Park","Glasgow East Investment Park","Burn Bridge","Woodside","North Mymms","Trimley St. Mary","Crookham Village","Antrim","Sunbury-On-Thames","Ford","Leavesden","Craigiehall","Padworth","Shortlands","West Town","New Milton","Maldon","Brockworth","Grantham","Isles Of Scilly","Heywood","Chorley","Kendal","Kidderminster","Trowbridge","Godalming","Ham","Knutsford","Gipsy Hill","Broadgate","Cheltenham Trade Park","Newnham","Sewardstone","Cressington","Byfleet","Bourne End","East Molesey","Chatteris","Boldon Colliery","South Brent","Cockermouth","Hull","Dunham-On-Trent","North East Lincolnshire","Malvern","Alston","Bridgend","Cobham","Notting Hill","Bassaleg","Southampton International Airport","Coolham","Old Aberdeen","Flackwell Heath","Whittington Moor","Camperdown","The Upper Wyke","Thames Ditton","Cliddesden","Horsforth","Windsor", "Maidenhead","Hook Common","Teddington","Little Bromley","Bilston","Maidenhead","Ledbury","Battersea","Enfield","Braintree","Haverfordwest","Yeovil","Sleaford","Cramlington","Andover","Princes Risborough","Wotton-Under-Edge","Newquay","Horley","Stoke-On-Trent","Linlithgow","East Grinstead","Fife","Shoreham-By-Sea","Whitchurch","Selby","Skelmersdale","Amersham","Dartford","Highlands","Stockton-On-Tees","Penzance","Dronfield","Gravesend","Thatcham","Cranfield","East Ham","Lewes","Milford Haven","East Hanningfield","Accrington","Horsham","Southwark","Quedgeley","Barrow-In-Furness","Bradley Stoke","Lytham","Hatfield","Isle Of Man","Fulham","Colindale","Penrith","Chigwell","Oxford Circus","Sellafield","Gatwick","Broxburn","Llandaff North","Little London","London Stansted Airport","Eye","Alton","Howden","Northwich","Clapham Junction","Alfreton","Fitzrovia","Petersfield","Port Talbot","Loughborough","Rugeley","Leyland","Huntly","Rosyth","Cleckheaton","Daventry","Peterhead","Seascale","Jarrow","Hitchin","East Wall","Blaydon-On-Tyne","Corby","Victoria","Hamilton","Twickenham","Orkney","Banchory","Stowmarket","Chantry","Sompting","Aylesford","Lingfield","Shrewsbury","Conwy","Wrexham","Sidcup","Thurso","Wirral","Lydbury North","Thorpe St. Andrew","Brampton","Tamworth","Putney Heath","Lea Bridge","Waterlooville","Motherwell","Wetherby","Irthlingborough","Barnet","Waltham Forest","Worcester Park","Covent Garden","Worksop","California","Chipping Norton","Scotland Gate","Surrey Quays","Clackmannanshire","Alvaston","Park Street","Warfield Park","Broadfield","Ash Green","Hillingdon","Potters Bar","All Saints","Lechlade","Stocksfield","Normanton","Stratford","Broxbourne","Bisham","Woolwich","Edgware","Tadworth","Bow","Docklands","Ellesmere","New Cross","Enstone","North Ayrshire","Havering-Atte-Bower","Dingwall","Jersey","Crowthorne","Aldershot","Pembrokeshire","Rochester","Bury","Aberaeron","Cheshunt","Llandudno","Lewisham","Wallsend","Wandsworth","Rickmansworth","Welwyn","Epping","Moreton-In-Marsh","Dalkeith","Hammersmith","Heanor","Stoke","Kerry","Chepstow","Wallingford","Woodstock","Herne Bay","Camden Town","Northallerton","Melbourne","Lyndhurst","Burton-On-Trent","East Mersea","Kirknewton","Swadlincote","Caerphilly","Borders","Sea","Irvine","Coleshill","Pode Hole","Askham Bryan","Woodthorpe","Ashby-De-La-Zouch","Loughton","Bruntingthorpe","St. Leonards-On-Sea","Bewdley","Dagenham","Newport-On-Tay","Greenford","Blaenau Gwent","Melrose","Moray","Arundel","Sandwell","Hoddesdon","Buckingham","Castle Donington","Havant","Wythall","Bexley","Thetford","West Allington","Alnwick","North Rigton","Skelton","Marske","Kirkby-In-Ashfield","Cheadle","Biggleswade","Blackheath","Totnes","Arlesey","Brackley","West Dunbartonshire","Nuneaton","Thame","Central Treviscoe","Whitstable","Boston","Keynsham","Pudsey","Newmarket","Catterick Garrison","Stroud","Atherstone","North Ferriby","Barrow-Upon-Humber","Tidworth","North Down","Ruislip","Bournemouth International Airport","Bedfont","Hungerford Park","Exeter Airport","Kenn","Weston Coyney","Tuttington","Carleton","Lowfield Heath","Bromyard","Henley-On-Thames","Calne","Feltham","Heyshott","South Ayrshire","Exmouth","Renfrew","Widnes","Pride Park","Bedale","Beccles","Welburn","West Bradford","Stockland Bristol","Orkneys","Livingston Village","Leamouth","Withcall","Haultwick","Waltham On The Wolds","Tilbury","West Malling","Retford","Humber","Camden","Gainsborough","North Muskham","Edgbaston","Harwell","Bar Hill","Altrincham","Windsor Castle","Far Arnside","South Croydon","Wantage","Dundee Technology Park","The Doward","The Cross","Ramsgate","Skegness","Gosport","Erith","Street","Ringwood","Benham Hill","Kensington","Mitcham","London Colney","Falkland","Helensburgh","Bradshaw","West Lockinge","Chadbury","Mancetter","Old","Greasbrough","Woodbridge","Beckenham","Dawlish","Waterloo","Wembley","Bromsgrove","Uttoxeter","Brighouse","Bicester","Bexhill-On-Sea","Pontefract","Kilmarnock","Bognor Regis","Knottingley","Bishopbriggs","Aldgate","Ayr Central","Workington","Sutton","Newton Solney","Westhumble");

if(strposa($location, $goodl)===true){
 echo "<br>This is a GOOD LOCATION!<br>";
$goodlocation = true;
}

$intl = array("worldwide","intl","international");

if(strposa($tweet_desc, $intl)===true){
 echo "<br>This is an INTL COMP!<br>";
$goodname = true;
$goodlocation = true;
}


$teens = array("solo","gun","5SOS","fam","5/5","Niall","robux","DOTA", "MTVHottest","vote","Teenchoice","Ora","notifications");
$babies = array("baby","nappies","babies","change","children","pregnancy","pram","pushchair","stroller");
$pets = array("dog","_RT_","rabbit");
$sports = array("#RJJLegend","StudioCanalUK","_RT_","Atkins","JavaJohnZ","HerNextRemedy","@PamperPoint","Tailgate","#WipesWednesday","GiddySprite","Stick_in_there","MrDalekJD","#BlackCat","#NewMom","#NewBaby","The_BlueCrab","MATCH REPORT","Congratulations","6,500","29th Feb");

$me = array("radiodeactive","Nylon_Nylon");
if(strposa($un, $me)===true){
 echo "<br>This is YOUR OWN ACCOUNT!<br>";
$goodprize = false;
	$goodname = false;
	$goodlocation = false;
}

if(strposa($tweet_desc, $teens)===true){
	echo "<br>This is a TEEN PRIZE<br>";
	$goodprize = false;
	$goodname = false;
	$goodlocation = false;
} 

if(strposa($tweet_desc, $babies)===true){
	echo "<br>This is a BABY PRIZE<br>";
	$goodprize = false;
	$goodname = false;
	$goodlocation = false;
} 

if(strposa($tweet_desc, $pets)===true){
	echo "<br>This is a PET PRIZE<br>";
	$goodprize = false;
	$goodname = false;
	$goodlocation = false;
} 


if(strposa($tweet_desc, $sports)===true){
	echo "<br>This is a SPORTS PRIZE<br>";
	$goodprize = false;
	$goodname = false;
	$goodlocation = false;
} 
 



if ($goodlocation === true && $goodname === true && $goodprize === true){
echo "This is a good tweet for a quiet UK comper!";
} else {
echo "Next";
continue;
}

echo "<br>The original ID of this tweet is ".$rt."<br>";
//Create an array of original ids.

$originals[] .= $rt;


echo "<br>The url shoud be <a href='https://twitter.com/".$un."/status/".$rt."'>here</a><br><br><br>";


}
}
}

// ******************* SEARCH  ONLY VERIFIED ******************* 

$searchresults=$connection->get('https://api.twitter.com/1.1/search/tweets.json', array('result_type' => 'mixed','count' => '100', 'since' => $yesterday, 'q' => '"competition" OR "win" OR #winitwednesday OR #freebiefriday OR #competition filter:verified' ));


$sr1 = json_encode($searchresults, true);
$sr = json_decode($sr1, true);
$results = $sr["statuses"];
unset ($results["metadata"]);



foreach ($results as $status) {
$tid= $status["id"];
$tweet_desc = $status["text"];
$goodprize = true;
$goodname = true;
$goodlocation = false;
$attest=0;

$twitcomp = array("RT to","RT and","Retweet and","Follow and","RT&","RT+","re tweet","RT to win", "RT and follow","RT ","RT + Follow","RT & Follow","Retweet & Follow");
if(strposa($tweet_desc, $twitcomp)===true){
$sevenchar = mb_substr($tweet_desc,0,7);

if ($tweet_desc[0] != "@" && $sevenchar !="I'm Ent" && $tweet_desc[1] != "@" && $tweet_desc[3] != "@"){
	$attest =1;
	
} 


	
if ($attest < 1){
	echo $tweet_desc." failed the AT TEST<br>";
} else {

$good  = array("UK","England","Birmingham","&#163;","£","&pound;");

echo "<br>".$tweet_desc."<br>";
if(strposa($tweet_desc, $good)===true){
 echo "<br>This is a GOOD PRIZE!<br>";
$goodprize = true;
}




$rt = $status["entities"]["media"][0]["source_status_id_str"];
if (is_null($rt)){
$rt = $tid;
}

$un = $status["retweeted_status"]["user"]["screen_name"];



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

$goodl = array("England","UK","United Kingdom","Folkestone","Germany","Cumbria","Bristol","Yorkshire","Cardiff","Cornwall","Wales","Scotland","London","Manchester","Birmingham","Newcastle","Guildford","West Midlands","Isle of White","Nottingham","Hastings","Canterbury","Coventry","Warwick","Oxford","Liverpool","Dover","Brighton","Norwich","Leeds","Reading","Richmond","Exeter","Cambridge","Gloucester","Leicester","Carlisle","Ipswich","Portsmouth","Berwick","Sheffield","Kingston upon Hull","Bradford","Stoke-on-Trent","Wolverhampton","Plymouth","Derby","Southampton","Dudley","Newcastle upon Tyne","Sunderland","Northampton","Preston","Walsall","Luton","Southend-on-Sea","Bournemouth","Middlesbrough","West Bromwich","Blackpool","Oldbury","Swindon","Huddersfield","Bolton","Poole","Peterborough","Stockport","Rotherham","Watford","Slough","St Helens","Sutton Coldfield","Blackburn","Oldham","Basildon","Woking","Chelmsford","Colchester","Worthing","Gillingham","Eastbourne","Solihull","Rochdale","Birkenhead","Cheltenham","Halifax","Southport","Maidstone","Grimsby","Crawley","Hartlepool","Darlington","Wigan","Bath","South Shields","Stockton-on-Tees","Gateshead","Warrington","Worcester","St Albans","	Lincoln","Chester","Salford","Hemel Hempstead","Basingstoke","Stevenage","Scunthorpe","Barnsley","Burnley","Harlow","Wakefield","Bedford","Newcastle-under-Lyme","Redditch","Chesterfield","Mansfield","High Wycombe","Chatham","Milton Keynes","Telford","Crawle","Aberdeen","Bangor","Brighton","Chichester","Dundee","Durham","Edinburgh","Ely","Glasgow","Hereford","Inverness","Lancaster","Lichfield","Lincoln","Lisburn","Londonderry","Newport","Newry","Ripon","Salisbury","St Davids","Stirling","Swansea","Truro","Wells","Westminster","Winchester","","Berkshire","Hampshire","Middleton","North London","West London","Cheshire","Kent","Hertfordshire","Tunbridge Wells","Farnborough","Barnstaple","Surrey","East Midlands","North Yorkshire","Southend-On-Sea","Croydon","Huntingdon","Neath","Northamptonshire","Newcastle Upon Tyne","South East London","Leighton Buzzard","Worcestershire","Romford","West Hampstead","Doncaster","North West London","Herefordshire","Merseyside","North West England","Lambeth","Devon","Ealing","Derbyshire","Midlothian","West Lothian","Cambridgeshire","Wiltshire","Essex","Bedfordshire","Staffordshire","Somerset","Crewe","North Waltham","Aberdeenshire","Gloucestershire","Eastleigh","Peckham","Lancashire","Kettering","Lincolnshire","Marton-In-Cleveland","Isle Of Wight","Oxfordshire","South Yorkshire","Wellington","Reigate","Hythe","Jedburgh","Arbroath","East London","South West London","North East England","Immingham","Brentwood","Windsor","Suffolk","Abbots Langley","Avon","South East England","Leatherhead","Buckinghamshire","Central London","Bracknell","Abingdon","Leicestershire","Walton-On-Thames","Dorset","Norfolk","Newbury","Fowey","Fleet","Yorkshire","East Sussex","West Sussex","Barry","Haywards Heath","East Sheen","Epsom","Staines","Harrogate","Seaford","Camberwell","Stafford","Torquay","Fareham","Bodmin","Kingston Upon Thames","Ashford","Hook","Southend","Lowestoft","Weymouth","Whitehaven","Barking","Airdrie","Tipton","Royston","Ware","North Lambeth","St. Austell","Barbican","West Yorkshire","Uxbridge","Gaydon","Warwickshire","Marlow","Letchworth","Didcot","Morpeth","Nottinghamshire","Runcorn","South West England","Stamford","Inverkeithing","Cupar","Livingston","Whyteleafe","Tonbridge","Hayes","Holmrook","St. Albans","Stanton-On-The-Wolds","Sittingbourne","Irlams O' Th' Height","Stratford-Upon-Avon","Chertsey","Dorking","Egham","Redhill","Broadstairs","Hackney","Hounslow","Leitrim","Heathrow","Little Chesterford","Welwyn","Margate","Burgess Hill","West End","Islington","Castleford","Dunfermline","Prescot","Bridport","Stourbridge","Fawley","Purley","Cirencester","Dorchester","Evesham","March","Shoreditch","Kingswood","Great Yarmouth","Isleworth","Earls Barton","Addlestone","Clifton","Titchfield","East Riding","Chalvey","France Lynch","Spalding","Deane","North Finchley","Wimbledon","Borehamwood","Beaconsfield","Greenwich","Hooke","South Lanarkshire","Quinton","Halewood","St. Neots","St Lukes","Chiswick","Hyde Park","Clacton-On-Sea","Bellshill","Eastern England","Downes","Fermanagh","Roehampton","Banbury","Northumberland","Scarborough","Prestwick","Sutton Green","Broadway","Witney","Bolton Le Sands","Farnham","Tewkesbury","Greater Manchester","Southsea","Melksham","Wellingborough","Melton Mowbray","Canary Wharf","Bury St. Edmunds","Guernsey","Brentford","North Lanarkshire","Theale","Corsham","Wokingham","Gerrards Cross","Paddington","Soho","Rugby","St. Helens","Swanley","Aberystwyth","Coscote","Winnersh","Beverley","Hinckley","Peterlee","Bromley","Redcar","Weston-Super-Mare","Knowsley","Dunstable","Shropshire","North Ewster","Weybridge","Towcester","Bradford-On-Avon","Blaenau Ffestiniog","North Piddle","Taunton","Sevenoaks","Cliftonville","Tenterden","Pembury","Ilford","Macclesfield","Esher","Harrow","Hertford","Mile End","Grays","Stokenchurch","Dumfries","Christchurch","Market Harborough","Warminster","Axbridge","Aston","Tyne & Wear","Edinburgh Technopole","Camberley","Droitwich","Oakdale","Shere","Matlock","Grangemouth","Aylesbury","Leamington Spa","Cwmbran","Chippenham","Two Mile Ash","Handbridge","Calcot","Manchester Science Park","Glasgow East Investment Park","Burn Bridge","Woodside","North Mymms","Trimley St. Mary","Crookham Village","Antrim","Sunbury-On-Thames","Ford","Leavesden","Craigiehall","Padworth","Shortlands","West Town","New Milton","Maldon","Brockworth","Grantham","Isles Of Scilly","Heywood","Chorley","Kendal","Kidderminster","Trowbridge","Godalming","Ham","Knutsford","Gipsy Hill","Broadgate","Cheltenham Trade Park","Newnham","Sewardstone","Cressington","Byfleet","Bourne End","East Molesey","Chatteris","Boldon Colliery","South Brent","Cockermouth","Hull","Dunham-On-Trent","North East Lincolnshire","Malvern","Alston","Bridgend","Cobham","Notting Hill","Bassaleg","Southampton International Airport","Coolham","Old Aberdeen","Flackwell Heath","Whittington Moor","Camperdown","The Upper Wyke","Thames Ditton","Cliddesden","Horsforth","Windsor", "Maidenhead","Hook Common","Teddington","Little Bromley","Bilston","Maidenhead","Ledbury","Battersea","Enfield","Braintree","Haverfordwest","Yeovil","Sleaford","Cramlington","Andover","Princes Risborough","Wotton-Under-Edge","Newquay","Horley","Stoke-On-Trent","Linlithgow","East Grinstead","Fife","Shoreham-By-Sea","Whitchurch","Selby","Skelmersdale","Amersham","Dartford","Highlands","Stockton-On-Tees","Penzance","Dronfield","Gravesend","Thatcham","Cranfield","East Ham","Lewes","Milford Haven","East Hanningfield","Accrington","Horsham","Southwark","Quedgeley","Barrow-In-Furness","Bradley Stoke","Lytham","Hatfield","Isle Of Man","Fulham","Colindale","Penrith","Chigwell","Oxford Circus","Sellafield","Gatwick","Broxburn","Llandaff North","Little London","London Stansted Airport","Eye","Alton","Howden","Northwich","Clapham Junction","Alfreton","Fitzrovia","Petersfield","Port Talbot","Loughborough","Rugeley","Leyland","Huntly","Rosyth","Cleckheaton","Daventry","Peterhead","Seascale","Jarrow","Hitchin","East Wall","Blaydon-On-Tyne","Corby","Victoria","Hamilton","Twickenham","Orkney","Banchory","Stowmarket","Chantry","Sompting","Aylesford","Lingfield","Shrewsbury","Conwy","Wrexham","Sidcup","Thurso","Wirral","Lydbury North","Thorpe St. Andrew","Brampton","Tamworth","Putney Heath","Lea Bridge","Waterlooville","Motherwell","Wetherby","Irthlingborough","Barnet","Waltham Forest","Worcester Park","Covent Garden","Worksop","California","Chipping Norton","Scotland Gate","Surrey Quays","Clackmannanshire","Alvaston","Park Street","Warfield Park","Broadfield","Ash Green","Hillingdon","Potters Bar","All Saints","Lechlade","Stocksfield","Normanton","Stratford","Broxbourne","Bisham","Woolwich","Edgware","Tadworth","Bow","Docklands","Ellesmere","New Cross","Enstone","North Ayrshire","Havering-Atte-Bower","Dingwall","Jersey","Crowthorne","Aldershot","Pembrokeshire","Rochester","Bury","Aberaeron","Cheshunt","Llandudno","Lewisham","Wallsend","Wandsworth","Rickmansworth","Welwyn","Epping","Moreton-In-Marsh","Dalkeith","Hammersmith","Heanor","Stoke","Kerry","Chepstow","Wallingford","Woodstock","Herne Bay","Camden Town","Northallerton","Melbourne","Lyndhurst","Burton-On-Trent","East Mersea","Kirknewton","Swadlincote","Caerphilly","Borders","Sea","Irvine","Coleshill","Pode Hole","Askham Bryan","Woodthorpe","Ashby-De-La-Zouch","Loughton","Bruntingthorpe","St. Leonards-On-Sea","Bewdley","Dagenham","Newport-On-Tay","Greenford","Blaenau Gwent","Melrose","Moray","Arundel","Sandwell","Hoddesdon","Buckingham","Castle Donington","Havant","Wythall","Bexley","Thetford","West Allington","Alnwick","North Rigton","Skelton","Marske","Kirkby-In-Ashfield","Cheadle","Biggleswade","Blackheath","Totnes","Arlesey","Brackley","West Dunbartonshire","Nuneaton","Thame","Central Treviscoe","Whitstable","Boston","Keynsham","Pudsey","Newmarket","Catterick Garrison","Stroud","Atherstone","North Ferriby","Barrow-Upon-Humber","Tidworth","North Down","Ruislip","Bournemouth International Airport","Bedfont","Hungerford Park","Exeter Airport","Kenn","Weston Coyney","Tuttington","Carleton","Lowfield Heath","Bromyard","Henley-On-Thames","Calne","Feltham","Heyshott","South Ayrshire","Exmouth","Renfrew","Widnes","Pride Park","Bedale","Beccles","Welburn","West Bradford","Stockland Bristol","Orkneys","Livingston Village","Leamouth","Withcall","Haultwick","Waltham On The Wolds","Tilbury","West Malling","Retford","Humber","Camden","Gainsborough","North Muskham","Edgbaston","Harwell","Bar Hill","Altrincham","Windsor Castle","Far Arnside","South Croydon","Wantage","Dundee Technology Park","The Doward","The Cross","Ramsgate","Skegness","Gosport","Erith","Street","Ringwood","Benham Hill","Kensington","Mitcham","London Colney","Falkland","Helensburgh","Bradshaw","West Lockinge","Chadbury","Mancetter","Old","Greasbrough","Woodbridge","Beckenham","Dawlish","Waterloo","Wembley","Bromsgrove","Uttoxeter","Brighouse","Bicester","Bexhill-On-Sea","Pontefract","Kilmarnock","Bognor Regis","Knottingley","Bishopbriggs","Aldgate","Ayr Central","Workington","Sutton","Newton Solney","Westhumble");

if(strposa($location, $goodl)===true){
 echo "<br>This is a GOOD LOCATION!<br>";
$goodlocation = true;
}

$intl = array("worldwide","intl","international");

if(strposa($tweet_desc, $intl)===true){
 echo "<br>This is an INTL COMP!<br>";
$goodname = true;
}


$teens = array("solo","gun","5SOS","fam","5/5","Niall","robux","DOTA", "MTVHottest","vote","Teenchoice","Ora","notifications");
$babies = array("baby","nappies","babies","change","children","pregnancy","pram","pushchair","stroller");
$pets = array("dog","rabbit");
$sports = array("golf","HerNextRemedy","@PamperPoint");

$me = array("radiodeactive");
if(strposa($un, $me)===true){
 echo "<br>This is YOUR OWN ACCOUNT!<br>";
$goodprize = false;
	$goodname = false;
	$goodlocation = false;
}

if(strposa($tweet_desc, $teens)===true){
	echo "<br>This is a TEEN PRIZE<br>";
	$goodprize = false;
	$goodname = false;
	$goodlocation = false;
} 

if(strposa($tweet_desc, $babies)===true){
	echo "<br>This is a BABY PRIZE<br>";
	$goodprize = false;
	$goodname = false;
	$goodlocation = false;
} 

if(strposa($tweet_desc, $pets)===true){
	echo "<br>This is a PET PRIZE<br>";
	$goodprize = false;
	$goodname = false;
	$goodlocation = false;
} 


if(strposa($tweet_desc, $sports)===true){
	echo "<br>This is a SPORTS PRIZE<br>";
	$goodprize = false;
	$goodname = false;
	$goodlocation = false;
} 
 



if ($goodlocation === true && $goodname === true && $goodprize === true){
echo "This is a good tweet for a quiet UK comper!";
} else {
echo "Next";
continue;
}

echo "<br>The original ID of this tweet is ".$rt."<br>";
//Create an array of original ids.

$originals[] .= $rt;


echo "<br>The url shoud be <a href='https://twitter.com/".$un."/status/".$rt."'>here</a><br><br><br>";


}
}
}

// ******************* SEARCH FOR VERIFIED RECENT ******************* 

$searchresults=$connection->get('https://api.twitter.com/1.1/search/tweets.json', array('result_type' => 'recent','count' => '100', 'since' => $yesterday, 'q' => '"#win" OR "competition" OR #competition OR giveaway OR "giving away" AND  ("RT and" OR "RT to" OR "Retweet & Follow" OR "Retweet to" OR "RT to win") filter:verified'));


$sr1 = json_encode($searchresults, true);
$sr = json_decode($sr1, true);
$results = $sr["statuses"];
unset ($results["metadata"]);



foreach ($results as $status) {
$tid= $status["id"];
$tweet_desc = $status["text"];
$goodprize = true;
$goodname = true;
$goodlocation = false;
$attest=0;

$twitcomp = array("RT to","RT and","Retweet and","Follow and","RT&","RT+","re tweet","RT to win", "RT and follow","RT ","RT + Follow","RT & Follow","Retweet & Follow");
if(strposa($tweet_desc, $twitcomp)===true){
	
$sevenchar = mb_substr($tweet_desc,0,7);

if ($tweet_desc[0] != "@" && $sevenchar !="I'm Ent" && $tweet_desc[1] != "@" && $tweet_desc[3] != "@"){
	$attest =1;
	
} 


	
if ($attest < 1){
	echo $tweet_desc." failed the AT TEST<br>";
} else {

$good  = array("UK","England","Birmingham","&#163;","£","&pound;");

echo "<br>".$tweet_desc."<br>";
if(strposa($tweet_desc, $good)===true){
 echo "<br>This is a GOOD PRIZE!<br>";
$goodprize = true;
}




$rt = $status["entities"]["media"][0]["source_status_id_str"];
if (is_null($rt)){
$rt = $tid;
}

$un = $status["retweeted_status"]["user"]["screen_name"];



if (is_null($un)){
$un = $status["retweeted_status"]["in_reply_to_screen_name"];
}
if (is_null($un)){
$un = $status["user"]["screen_name"];
}
echo "User name is $un <br>";



if(strposa($un, $goodn)===true){
 echo "<br>This is a GOOD NAME!<br>";
$goodname = true;
}


//Check User Location
$locationinfo = $connection->get('users/show', array('screen_name' => $un, 'include_entities' => false));
echo "Location check ";
$obj6 = json_encode($locationinfo, true);
$obj7 = json_decode($obj6, true);

$location = $obj7["location"];
echo $location;

$goodl = array("England","UK","United Kingdom","Folkestone","Germany","Cumbria","Bristol","Yorkshire","Cardiff","Cornwall","Wales","Scotland","London","Manchester","Birmingham","Newcastle","Guildford","West Midlands","Isle of White","Nottingham","Hastings","Canterbury","Coventry","Warwick","Oxford","Liverpool","Dover","Brighton","Norwich","Leeds","Reading","Richmond","Exeter","Cambridge","Gloucester","Leicester","Carlisle","Ipswich","Portsmouth","Berwick","Sheffield","Kingston upon Hull","Bradford","Stoke-on-Trent","Wolverhampton","Plymouth","Derby","Southampton","Dudley","Newcastle upon Tyne","Sunderland","Northampton","Preston","Walsall","Luton","Southend-on-Sea","Bournemouth","Middlesbrough","West Bromwich","Blackpool","Oldbury","Swindon","Huddersfield","Bolton","Poole","Peterborough","Stockport","Rotherham","Watford","Slough","St Helens","Sutton Coldfield","Blackburn","Oldham","Basildon","Woking","Chelmsford","Colchester","Worthing","Gillingham","Eastbourne","Solihull","Rochdale","Birkenhead","Cheltenham","Halifax","Southport","Maidstone","Grimsby","Crawley","Hartlepool","Darlington","Wigan","Bath","South Shields","Stockton-on-Tees","Gateshead","Warrington","Worcester","St Albans","	Lincoln","Chester","Salford","Hemel Hempstead","Basingstoke","Stevenage","Scunthorpe","Barnsley","Burnley","Harlow","Wakefield","Bedford","Newcastle-under-Lyme","Redditch","Chesterfield","Mansfield","High Wycombe","Chatham","Milton Keynes","Telford","Crawle","Aberdeen","Bangor","Brighton","Chichester","Dundee","Durham","Edinburgh","Ely","Glasgow","Hereford","Inverness","Lancaster","Lichfield","Lincoln","Lisburn","Londonderry","Newport","Newry","Ripon","Salisbury","St Davids","Stirling","Swansea","Truro","Wells","Westminster","Winchester","","Berkshire","Hampshire","Middleton","North London","West London","Cheshire","Kent","Hertfordshire","Tunbridge Wells","Farnborough","Barnstaple","Surrey","East Midlands","North Yorkshire","Southend-On-Sea","Croydon","Huntingdon","Neath","Northamptonshire","Newcastle Upon Tyne","South East London","Leighton Buzzard","Worcestershire","Romford","West Hampstead","Doncaster","North West London","Herefordshire","Merseyside","North West England","Lambeth","Devon","Ealing","Derbyshire","Midlothian","West Lothian","Cambridgeshire","Wiltshire","Essex","Bedfordshire","Staffordshire","Somerset","Crewe","North Waltham","Aberdeenshire","Gloucestershire","Eastleigh","Peckham","Lancashire","Kettering","Lincolnshire","Marton-In-Cleveland","Isle Of Wight","Oxfordshire","South Yorkshire","Wellington","Reigate","Hythe","Jedburgh","Arbroath","East London","South West London","North East England","Immingham","Brentwood","Windsor","Suffolk","Abbots Langley","Avon","South East England","Leatherhead","Buckinghamshire","Central London","Bracknell","Abingdon","Leicestershire","Walton-On-Thames","Dorset","Norfolk","Newbury","Fowey","Fleet","Yorkshire","East Sussex","West Sussex","Barry","Haywards Heath","East Sheen","Epsom","Staines","Harrogate","Seaford","Camberwell","Stafford","Torquay","Fareham","Bodmin","Kingston Upon Thames","Ashford","Hook","Southend","Lowestoft","Weymouth","Whitehaven","Barking","Airdrie","Tipton","Royston","Ware","North Lambeth","St. Austell","Barbican","West Yorkshire","Uxbridge","Gaydon","Warwickshire","Marlow","Letchworth","Didcot","Morpeth","Nottinghamshire","Runcorn","South West England","Stamford","Inverkeithing","Cupar","Livingston","Whyteleafe","Tonbridge","Hayes","Holmrook","St. Albans","Stanton-On-The-Wolds","Sittingbourne","Irlams O' Th' Height","Stratford-Upon-Avon","Chertsey","Dorking","Egham","Redhill","Broadstairs","Hackney","Hounslow","Leitrim","Heathrow","Little Chesterford","Welwyn","Margate","Burgess Hill","West End","Islington","Castleford","Dunfermline","Prescot","Bridport","Stourbridge","Fawley","Purley","Cirencester","Dorchester","Evesham","March","Shoreditch","Kingswood","Great Yarmouth","Isleworth","Earls Barton","Addlestone","Clifton","Titchfield","East Riding","Chalvey","France Lynch","Spalding","Deane","North Finchley","Wimbledon","Borehamwood","Beaconsfield","Greenwich","Hooke","South Lanarkshire","Quinton","Halewood","St. Neots","St Lukes","Chiswick","Hyde Park","Clacton-On-Sea","Bellshill","Eastern England","Downes","Fermanagh","Roehampton","Banbury","Northumberland","Scarborough","Prestwick","Sutton Green","Broadway","Witney","Bolton Le Sands","Farnham","Tewkesbury","Greater Manchester","Southsea","Melksham","Wellingborough","Melton Mowbray","Canary Wharf","Bury St. Edmunds","Guernsey","Brentford","North Lanarkshire","Theale","Corsham","Wokingham","Gerrards Cross","Paddington","Soho","Rugby","St. Helens","Swanley","Aberystwyth","Coscote","Winnersh","Beverley","Hinckley","Peterlee","Bromley","Redcar","Weston-Super-Mare","Knowsley","Dunstable","Shropshire","North Ewster","Weybridge","Towcester","Bradford-On-Avon","Blaenau Ffestiniog","North Piddle","Taunton","Sevenoaks","Cliftonville","Tenterden","Pembury","Ilford","Macclesfield","Esher","Harrow","Hertford","Mile End","Grays","Stokenchurch","Dumfries","Christchurch","Market Harborough","Warminster","Axbridge","Aston","Tyne & Wear","Edinburgh Technopole","Camberley","Droitwich","Oakdale","Shere","Matlock","Grangemouth","Aylesbury","Leamington Spa","Cwmbran","Chippenham","Two Mile Ash","Handbridge","Calcot","Manchester Science Park","Glasgow East Investment Park","Burn Bridge","Woodside","North Mymms","Trimley St. Mary","Crookham Village","Antrim","Sunbury-On-Thames","Ford","Leavesden","Craigiehall","Padworth","Shortlands","West Town","New Milton","Maldon","Brockworth","Grantham","Isles Of Scilly","Heywood","Chorley","Kendal","Kidderminster","Trowbridge","Godalming","Ham","Knutsford","Gipsy Hill","Broadgate","Cheltenham Trade Park","Newnham","Sewardstone","Cressington","Byfleet","Bourne End","East Molesey","Chatteris","Boldon Colliery","South Brent","Cockermouth","Hull","Dunham-On-Trent","North East Lincolnshire","Malvern","Alston","Bridgend","Cobham","Notting Hill","Bassaleg","Southampton International Airport","Coolham","Old Aberdeen","Flackwell Heath","Whittington Moor","Camperdown","The Upper Wyke","Thames Ditton","Cliddesden","Horsforth","Windsor", "Maidenhead","Hook Common","Teddington","Little Bromley","Bilston","Maidenhead","Ledbury","Battersea","Enfield","Braintree","Haverfordwest","Yeovil","Sleaford","Cramlington","Andover","Princes Risborough","Wotton-Under-Edge","Newquay","Horley","Stoke-On-Trent","Linlithgow","East Grinstead","Fife","Shoreham-By-Sea","Whitchurch","Selby","Skelmersdale","Amersham","Dartford","Highlands","Stockton-On-Tees","Penzance","Dronfield","Gravesend","Thatcham","Cranfield","East Ham","Lewes","Milford Haven","East Hanningfield","Accrington","Horsham","Southwark","Quedgeley","Barrow-In-Furness","Bradley Stoke","Lytham","Hatfield","Isle Of Man","Fulham","Colindale","Penrith","Chigwell","Oxford Circus","Sellafield","Gatwick","Broxburn","Llandaff North","Little London","London Stansted Airport","Eye","Alton","Howden","Northwich","Clapham Junction","Alfreton","Fitzrovia","Petersfield","Port Talbot","Loughborough","Rugeley","Leyland","Huntly","Rosyth","Cleckheaton","Daventry","Peterhead","Seascale","Jarrow","Hitchin","East Wall","Blaydon-On-Tyne","Corby","Victoria","Hamilton","Twickenham","Orkney","Banchory","Stowmarket","Chantry","Sompting","Aylesford","Lingfield","Shrewsbury","Conwy","Wrexham","Sidcup","Thurso","Wirral","Lydbury North","Thorpe St. Andrew","Brampton","Tamworth","Putney Heath","Lea Bridge","Waterlooville","Motherwell","Wetherby","Irthlingborough","Barnet","Waltham Forest","Worcester Park","Covent Garden","Worksop","California","Chipping Norton","Scotland Gate","Surrey Quays","Clackmannanshire","Alvaston","Park Street","Warfield Park","Broadfield","Ash Green","Hillingdon","Potters Bar","All Saints","Lechlade","Stocksfield","Normanton","Stratford","Broxbourne","Bisham","Woolwich","Edgware","Tadworth","Bow","Docklands","Ellesmere","New Cross","Enstone","North Ayrshire","Havering-Atte-Bower","Dingwall","Jersey","Crowthorne","Aldershot","Pembrokeshire","Rochester","Bury","Aberaeron","Cheshunt","Llandudno","Lewisham","Wallsend","Wandsworth","Rickmansworth","Welwyn","Epping","Moreton-In-Marsh","Dalkeith","Hammersmith","Heanor","Stoke","Kerry","Chepstow","Wallingford","Woodstock","Herne Bay","Camden Town","Northallerton","Melbourne","Lyndhurst","Burton-On-Trent","East Mersea","Kirknewton","Swadlincote","Caerphilly","Borders","Sea","Irvine","Coleshill","Pode Hole","Askham Bryan","Woodthorpe","Ashby-De-La-Zouch","Loughton","Bruntingthorpe","St. Leonards-On-Sea","Bewdley","Dagenham","Newport-On-Tay","Greenford","Blaenau Gwent","Melrose","Moray","Arundel","Sandwell","Hoddesdon","Buckingham","Castle Donington","Havant","Wythall","Bexley","Thetford","West Allington","Alnwick","North Rigton","Skelton","Marske","Kirkby-In-Ashfield","Cheadle","Biggleswade","Blackheath","Totnes","Arlesey","Brackley","West Dunbartonshire","Nuneaton","Thame","Central Treviscoe","Whitstable","Boston","Keynsham","Pudsey","Newmarket","Catterick Garrison","Stroud","Atherstone","North Ferriby","Barrow-Upon-Humber","Tidworth","North Down","Ruislip","Bournemouth International Airport","Bedfont","Hungerford Park","Exeter Airport","Kenn","Weston Coyney","Tuttington","Carleton","Lowfield Heath","Bromyard","Henley-On-Thames","Calne","Feltham","Heyshott","South Ayrshire","Exmouth","Renfrew","Widnes","Pride Park","Bedale","Beccles","Welburn","West Bradford","Stockland Bristol","Orkneys","Livingston Village","Leamouth","Withcall","Haultwick","Waltham On The Wolds","Tilbury","West Malling","Retford","Humber","Camden","Gainsborough","North Muskham","Edgbaston","Harwell","Bar Hill","Altrincham","Windsor Castle","Far Arnside","South Croydon","Wantage","Dundee Technology Park","The Doward","The Cross","Ramsgate","Skegness","Gosport","Erith","Street","Ringwood","Benham Hill","Kensington","Mitcham","London Colney","Falkland","Helensburgh","Bradshaw","West Lockinge","Chadbury","Mancetter","Old","Greasbrough","Woodbridge","Beckenham","Dawlish","Waterloo","Wembley","Bromsgrove","Uttoxeter","Brighouse","Bicester","Bexhill-On-Sea","Pontefract","Kilmarnock","Bognor Regis","Knottingley","Bishopbriggs","Aldgate","Ayr Central","Workington","Sutton","Newton Solney","Westhumble");

if(strposa($location, $goodl)===true){
 echo "<br>This is a GOOD LOCATION!<br>";
$goodlocation = true;
}

$intl = array("worldwide","intl","international");

if(strposa($tweet_desc, $intl)===true){
 echo "<br>This is an INTL COMP!<br>";
$goodname = true;
}


$teens = array("solo","gun","5SOS","fam","5/5","Niall","robux","DOTA", "MTVHottest","vote","Teenchoice","Ora","notifications");
$babies = array("baby","nappies","babies","change","children","pregnancy","pram","pushchair","stroller");
$pets = array("dog","rabbit");
$sports = array("golf","HerNextRemedy","@PamperPoint");

$me = array("radiodeactive");
if(strposa($un, $me)===true){
 echo "<br>This is YOUR OWN ACCOUNT!<br>";
$goodprize = false;
	$goodname = false;
	$goodlocation = false;
}

if(strposa($tweet_desc, $teens)===true){
	echo "<br>This is a TEEN PRIZE<br>";
	$goodprize = false;
	$goodname = false;
	$goodlocation = false;
} 

if(strposa($tweet_desc, $babies)===true){
	echo "<br>This is a BABY PRIZE<br>";
	$goodprize = false;
	$goodname = false;
	$goodlocation = false;
} 

if(strposa($tweet_desc, $pets)===true){
	echo "<br>This is a PET PRIZE<br>";
	$goodprize = false;
	$goodname = false;
	$goodlocation = false;
} 


if(strposa($tweet_desc, $sports)===true){
	echo "<br>This is a SPORTS PRIZE<br>";
	$goodprize = false;
	$goodname = false;
	$goodlocation = false;
} 
 



if ($goodlocation === true && $goodname === true && $goodprize === true){
echo "This is a good tweet for a quiet UK comper!";
} else {
echo "Next";
continue;
}

echo "<br>The original ID of this tweet is ".$rt."<br>";
//Create an array of original ids.

$originals[] .= $rt;


echo "<br>The url shoud be <a href='https://twitter.com/".$un."/status/".$rt."'>here</a><br><br><br>";


}
}
}

// ******************* SEARCH FOR VERIFIED TOP ******************* 

$searchresults=$connection->get('https://api.twitter.com/1.1/search/tweets.json', array('result_type' => 'top','count' => '100', 'since' => $yesterday, 'q' => '"#win" OR "competition" OR #competition OR giveaway OR "giving away" filter:verified'));



$sr1 = json_encode($searchresults, true);
$sr = json_decode($sr1, true);
$results = $sr["statuses"];
unset ($results["metadata"]);



foreach ($results as $status) {
$tid= $status["id"];
$tweet_desc = $status["text"];
$goodprize = true;
$goodname = true;
$goodlocation = false;
$attest=0;

$twitcomp = array("RT to","RT and","Retweet and","Follow and","RT&","RT+","re tweet","RT to win", "RT and follow","RT ","RT + Follow","RT & Follow","Retweet & Follow");
if(strposa($tweet_desc, $twitcomp)===true){

$sevenchar = mb_substr($tweet_desc,0,7);

if ($tweet_desc[0] != "@" && $sevenchar !="I'm Ent" && $tweet_desc[1] != "@" && $tweet_desc[3] != "@"){
	$attest =1;
	
} 


	
if ($attest < 1){
	echo $tweet_desc." failed the AT TEST<br>";
} else {






$rt = $status["entities"]["media"][0]["source_status_id_str"];
if (is_null($rt)){
$rt = $tid;
}

$un = $status["retweeted_status"]["user"]["screen_name"];



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

$goodl = array("England","UK","United Kingdom","Folkestone","Germany","Cumbria","Bristol","Yorkshire","Cardiff","Cornwall","Wales","Scotland","London","Manchester","Birmingham","Newcastle","Guildford","West Midlands","Isle of White","Nottingham","Hastings","Canterbury","Coventry","Warwick","Oxford","Liverpool","Dover","Brighton","Norwich","Leeds","Reading","Richmond","Exeter","Cambridge","Gloucester","Leicester","Carlisle","Ipswich","Portsmouth","Berwick","Sheffield","Kingston upon Hull","Bradford","Stoke-on-Trent","Wolverhampton","Plymouth","Derby","Southampton","Dudley","Newcastle upon Tyne","Sunderland","Northampton","Preston","Walsall","Luton","Southend-on-Sea","Bournemouth","Middlesbrough","West Bromwich","Blackpool","Oldbury","Swindon","Huddersfield","Bolton","Poole","Peterborough","Stockport","Rotherham","Watford","Slough","St Helens","Sutton Coldfield","Blackburn","Oldham","Basildon","Woking","Chelmsford","Colchester","Worthing","Gillingham","Eastbourne","Solihull","Rochdale","Birkenhead","Cheltenham","Halifax","Southport","Maidstone","Grimsby","Crawley","Hartlepool","Darlington","Wigan","Bath","South Shields","Stockton-on-Tees","Gateshead","Warrington","Worcester","St Albans","	Lincoln","Chester","Salford","Hemel Hempstead","Basingstoke","Stevenage","Scunthorpe","Barnsley","Burnley","Harlow","Wakefield","Bedford","Newcastle-under-Lyme","Redditch","Chesterfield","Mansfield","High Wycombe","Chatham","Milton Keynes","Telford","Crawle","Aberdeen","Bangor","Brighton","Chichester","Dundee","Durham","Edinburgh","Ely","Glasgow","Hereford","Inverness","Lancaster","Lichfield","Lincoln","Lisburn","Londonderry","Newport","Newry","Ripon","Salisbury","St Davids","Stirling","Swansea","Truro","Wells","Westminster","Winchester","","Berkshire","Hampshire","Middleton","North London","West London","Cheshire","Kent","Hertfordshire","Tunbridge Wells","Farnborough","Barnstaple","Surrey","East Midlands","North Yorkshire","Southend-On-Sea","Croydon","Huntingdon","Neath","Northamptonshire","Newcastle Upon Tyne","South East London","Leighton Buzzard","Worcestershire","Romford","West Hampstead","Doncaster","North West London","Herefordshire","Merseyside","North West England","Lambeth","Devon","Ealing","Derbyshire","Midlothian","West Lothian","Cambridgeshire","Wiltshire","Essex","Bedfordshire","Staffordshire","Somerset","Crewe","North Waltham","Aberdeenshire","Gloucestershire","Eastleigh","Peckham","Lancashire","Kettering","Lincolnshire","Marton-In-Cleveland","Isle Of Wight","Oxfordshire","South Yorkshire","Wellington","Reigate","Hythe","Jedburgh","Arbroath","East London","South West London","North East England","Immingham","Brentwood","Windsor","Suffolk","Abbots Langley","Avon","South East England","Leatherhead","Buckinghamshire","Central London","Bracknell","Abingdon","Leicestershire","Walton-On-Thames","Dorset","Norfolk","Newbury","Fowey","Fleet","Yorkshire","East Sussex","West Sussex","Barry","Haywards Heath","East Sheen","Epsom","Staines","Harrogate","Seaford","Camberwell","Stafford","Torquay","Fareham","Bodmin","Kingston Upon Thames","Ashford","Hook","Southend","Lowestoft","Weymouth","Whitehaven","Barking","Airdrie","Tipton","Royston","Ware","North Lambeth","St. Austell","Barbican","West Yorkshire","Uxbridge","Gaydon","Warwickshire","Marlow","Letchworth","Didcot","Morpeth","Nottinghamshire","Runcorn","South West England","Stamford","Inverkeithing","Cupar","Livingston","Whyteleafe","Tonbridge","Hayes","Holmrook","St. Albans","Stanton-On-The-Wolds","Sittingbourne","Irlams O' Th' Height","Stratford-Upon-Avon","Chertsey","Dorking","Egham","Redhill","Broadstairs","Hackney","Hounslow","Leitrim","Heathrow","Little Chesterford","Welwyn","Margate","Burgess Hill","West End","Islington","Castleford","Dunfermline","Prescot","Bridport","Stourbridge","Fawley","Purley","Cirencester","Dorchester","Evesham","March","Shoreditch","Kingswood","Great Yarmouth","Isleworth","Earls Barton","Addlestone","Clifton","Titchfield","East Riding","Chalvey","France Lynch","Spalding","Deane","North Finchley","Wimbledon","Borehamwood","Beaconsfield","Greenwich","Hooke","South Lanarkshire","Quinton","Halewood","St. Neots","St Lukes","Chiswick","Hyde Park","Clacton-On-Sea","Bellshill","Eastern England","Downes","Fermanagh","Roehampton","Banbury","Northumberland","Scarborough","Prestwick","Sutton Green","Broadway","Witney","Bolton Le Sands","Farnham","Tewkesbury","Greater Manchester","Southsea","Melksham","Wellingborough","Melton Mowbray","Canary Wharf","Bury St. Edmunds","Guernsey","Brentford","North Lanarkshire","Theale","Corsham","Wokingham","Gerrards Cross","Paddington","Soho","Rugby","St. Helens","Swanley","Aberystwyth","Coscote","Winnersh","Beverley","Hinckley","Peterlee","Bromley","Redcar","Weston-Super-Mare","Knowsley","Dunstable","Shropshire","North Ewster","Weybridge","Towcester","Bradford-On-Avon","Blaenau Ffestiniog","North Piddle","Taunton","Sevenoaks","Cliftonville","Tenterden","Pembury","Ilford","Macclesfield","Esher","Harrow","Hertford","Mile End","Grays","Stokenchurch","Dumfries","Christchurch","Market Harborough","Warminster","Axbridge","Aston","Tyne & Wear","Edinburgh Technopole","Camberley","Droitwich","Oakdale","Shere","Matlock","Grangemouth","Aylesbury","Leamington Spa","Cwmbran","Chippenham","Two Mile Ash","Handbridge","Calcot","Manchester Science Park","Glasgow East Investment Park","Burn Bridge","Woodside","North Mymms","Trimley St. Mary","Crookham Village","Antrim","Sunbury-On-Thames","Ford","Leavesden","Craigiehall","Padworth","Shortlands","West Town","New Milton","Maldon","Brockworth","Grantham","Isles Of Scilly","Heywood","Chorley","Kendal","Kidderminster","Trowbridge","Godalming","Ham","Knutsford","Gipsy Hill","Broadgate","Cheltenham Trade Park","Newnham","Sewardstone","Cressington","Byfleet","Bourne End","East Molesey","Chatteris","Boldon Colliery","South Brent","Cockermouth","Hull","Dunham-On-Trent","North East Lincolnshire","Malvern","Alston","Bridgend","Cobham","Notting Hill","Bassaleg","Southampton International Airport","Coolham","Old Aberdeen","Flackwell Heath","Whittington Moor","Camperdown","The Upper Wyke","Thames Ditton","Cliddesden","Horsforth","Windsor", "Maidenhead","Hook Common","Teddington","Little Bromley","Bilston","Maidenhead","Ledbury","Battersea","Enfield","Braintree","Haverfordwest","Yeovil","Sleaford","Cramlington","Andover","Princes Risborough","Wotton-Under-Edge","Newquay","Horley","Stoke-On-Trent","Linlithgow","East Grinstead","Fife","Shoreham-By-Sea","Whitchurch","Selby","Skelmersdale","Amersham","Dartford","Highlands","Stockton-On-Tees","Penzance","Dronfield","Gravesend","Thatcham","Cranfield","East Ham","Lewes","Milford Haven","East Hanningfield","Accrington","Horsham","Southwark","Quedgeley","Barrow-In-Furness","Bradley Stoke","Lytham","Hatfield","Isle Of Man","Fulham","Colindale","Penrith","Chigwell","Oxford Circus","Sellafield","Gatwick","Broxburn","Llandaff North","Little London","London Stansted Airport","Eye","Alton","Howden","Northwich","Clapham Junction","Alfreton","Fitzrovia","Petersfield","Port Talbot","Loughborough","Rugeley","Leyland","Huntly","Rosyth","Cleckheaton","Daventry","Peterhead","Seascale","Jarrow","Hitchin","East Wall","Blaydon-On-Tyne","Corby","Victoria","Hamilton","Twickenham","Orkney","Banchory","Stowmarket","Chantry","Sompting","Aylesford","Lingfield","Shrewsbury","Conwy","Wrexham","Sidcup","Thurso","Wirral","Lydbury North","Thorpe St. Andrew","Brampton","Tamworth","Putney Heath","Lea Bridge","Waterlooville","Motherwell","Wetherby","Irthlingborough","Barnet","Waltham Forest","Worcester Park","Covent Garden","Worksop","California","Chipping Norton","Scotland Gate","Surrey Quays","Clackmannanshire","Alvaston","Park Street","Warfield Park","Broadfield","Ash Green","Hillingdon","Potters Bar","All Saints","Lechlade","Stocksfield","Normanton","Stratford","Broxbourne","Bisham","Woolwich","Edgware","Tadworth","Bow","Docklands","Ellesmere","New Cross","Enstone","North Ayrshire","Havering-Atte-Bower","Dingwall","Jersey","Crowthorne","Aldershot","Pembrokeshire","Rochester","Bury","Aberaeron","Cheshunt","Llandudno","Lewisham","Wallsend","Wandsworth","Rickmansworth","Welwyn","Epping","Moreton-In-Marsh","Dalkeith","Hammersmith","Heanor","Stoke","Kerry","Chepstow","Wallingford","Woodstock","Herne Bay","Camden Town","Northallerton","Melbourne","Lyndhurst","Burton-On-Trent","East Mersea","Kirknewton","Swadlincote","Caerphilly","Borders","Sea","Irvine","Coleshill","Pode Hole","Askham Bryan","Woodthorpe","Ashby-De-La-Zouch","Loughton","Bruntingthorpe","St. Leonards-On-Sea","Bewdley","Dagenham","Newport-On-Tay","Greenford","Blaenau Gwent","Melrose","Moray","Arundel","Sandwell","Hoddesdon","Buckingham","Castle Donington","Havant","Wythall","Bexley","Thetford","West Allington","Alnwick","North Rigton","Skelton","Marske","Kirkby-In-Ashfield","Cheadle","Biggleswade","Blackheath","Totnes","Arlesey","Brackley","West Dunbartonshire","Nuneaton","Thame","Central Treviscoe","Whitstable","Boston","Keynsham","Pudsey","Newmarket","Catterick Garrison","Stroud","Atherstone","North Ferriby","Barrow-Upon-Humber","Tidworth","North Down","Ruislip","Bournemouth International Airport","Bedfont","Hungerford Park","Exeter Airport","Kenn","Weston Coyney","Tuttington","Carleton","Lowfield Heath","Bromyard","Henley-On-Thames","Calne","Feltham","Heyshott","South Ayrshire","Exmouth","Renfrew","Widnes","Pride Park","Bedale","Beccles","Welburn","West Bradford","Stockland Bristol","Orkneys","Livingston Village","Leamouth","Withcall","Haultwick","Waltham On The Wolds","Tilbury","West Malling","Retford","Humber","Camden","Gainsborough","North Muskham","Edgbaston","Harwell","Bar Hill","Altrincham","Windsor Castle","Far Arnside","South Croydon","Wantage","Dundee Technology Park","The Doward","The Cross","Ramsgate","Skegness","Gosport","Erith","Street","Ringwood","Benham Hill","Kensington","Mitcham","London Colney","Falkland","Helensburgh","Bradshaw","West Lockinge","Chadbury","Mancetter","Old","Greasbrough","Woodbridge","Beckenham","Dawlish","Waterloo","Wembley","Bromsgrove","Uttoxeter","Brighouse","Bicester","Bexhill-On-Sea","Pontefract","Kilmarnock","Bognor Regis","Knottingley","Bishopbriggs","Aldgate","Ayr Central","Workington","Sutton","Newton Solney","Westhumble");

if(strposa($location, $goodl)===true){
 echo "<br>This is a GOOD LOCATION!<br>";
$goodlocation = true;
}

$intl = array("worldwide","intl","international");

if(strposa($tweet_desc, $intl)===true){
 echo "<br>This is an INTL COMP!<br>";
$goodname = true;
}


$teens = array("solo","gun","5SOS","fam","5/5","Niall","robux","DOTA", "MTVHottest","vote","Teenchoice","Ora","notifications","Mahone");
$babies = array("baby","nappies","babies","change","children","pregnancy","pram","pushchair","stroller");
$pets = array("dog","rabbit");
$sports = array("golf","#OnYourBike","potbelly", "#RJJLegend","HerNextRemedy","@PamperPoint");

$me = array("radiodeactive","hayleyw1");
if(strposa($un, $me)===true){
 echo "<br>This is YOUR OWN ACCOUNT or a SPAM ACCT!<br>";
$goodprize = false;
	$goodname = false;
	$goodlocation = false;
}

if(strposa($tweet_desc, $teens)===true){
	echo "<br>This is a TEEN PRIZE<br>";
	$goodprize = false;
	$goodname = false;
	$goodlocation = false;
} 

if(strposa($tweet_desc, $babies)===true){
	echo "<br>This is a BABY PRIZE<br>";
	$goodprize = false;
	$goodname = false;
	$goodlocation = false;
} 

if(strposa($tweet_desc, $pets)===true){
	echo "<br>This is a PET PRIZE<br>";
	$goodprize = false;
	$goodname = false;
	$goodlocation = false;
} 


if(strposa($tweet_desc, $sports)===true){
	echo "<br>This is a SPORTS PRIZE<br>";
	$goodprize = false;
	$goodname = false;
	$goodlocation = false;
} 
 



if ($goodlocation === true && $goodname === true && $goodprize === true){
echo "This is a good tweet for a quiet UK comper!";
} else {
echo "Next";
continue;
}

echo "<br>The original ID of this tweet is ".$rt."<br>";
//Create an array of original ids.

$originals[] .= $rt;


echo "<br>The url shoud be <a href='https://twitter.com/".$un."/status/".$rt."'>here</a><br><br><br>";


}
}
}


$finals = array_unique($originals);
if (count($finals) > 100){
	echo " - More than 100 ids - reducing";
$finals = array_splice($finals, -99);
}
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
$orig_desc = '"'.preg_replace("/[^a-zA-Z]+/", "", substr($nt,-60,59)).'"';
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
$owt = '"'.preg_replace("/[^a-zA-Z]+/", "", substr($nt,-60,59)).'",';
file_put_contents($file, $owt,FILE_APPEND);
}
}
}
}
}
?>
 





 
