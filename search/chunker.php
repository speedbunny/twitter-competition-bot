<?php
$namefile = file_get_contents('names.txt');
$goodn = explode(",",$namefile);
$unique = array_unique($goodn);
$chunks = array_chunk($goodn,150);


$i = 0;
foreach ($chunks as $chunk){
	$i++;
	$file = 'chunk'.$i.'.txt';
	$brands = implode(',',$chunk);
	file_put_contents($file, $brands);
}
