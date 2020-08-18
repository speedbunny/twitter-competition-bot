<?php
/* Takes the IDs of people radiodeactive is following and breaks into chunks of 1000 */
$idfile = file_get_contents('radioids.txt');
$goodn = explode(",",$idfile);
$unique = array_unique($goodn);
$chunks = array_chunk($goodn,1000);


$i = 0;
foreach ($chunks as $chunk){
	$i++;
	$file = 'idchunk'.$i.'.txt';
	$ids = implode(',',$chunk);
	file_put_contents($file, $ids);
}

