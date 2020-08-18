<?php
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


$orfile = file_get_contents('radiodeactive.txt');
$radiodeactive = explode(",", $orfile);
print_r($radiodeactive);
$check = count($radiodeactive);
echo "here". $check;
$arfile = file_get_contents('names.txt');
$brands = explode(",", $arfile);

//If Radiodeactive 'owns' a brand, remove it from general brand list

$unownedbrands = array_diff ($brands, $radiodeactive);
print_r($unownedbrands);
$nbrands = implode(",",$unownedbrands);
$file = 'names.txt';
file_put_contents($file, $nbrands);