<?php
$orfile = array();
$dedupe = array();
$orfile = file_get_contents('radiodeactive.txt');
$array = explode(",", $orfile);
$dedupe = array_unique($array,SORT_REGULAR);
$rebuild = implode(",",$dedupe);
file_put_contents('radiodeactive.txt', $rebuild);
?>
