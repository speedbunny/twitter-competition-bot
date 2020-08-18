<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
.buildingBlock {
    display:inline-block;
    width:20px;
    height:20px;
    margin:2px 5px;
    background-color:#eee;
    border:2px solid #ccc;
}
#container {
    text-align:center;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>1000 NUMBER GUESS TREE</title>
</head>

<body>
<table style="width:50000px" align="center" colspan="524">
<tr>
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


function drawsquare($x) {
	echo "------------<br>";
	echo "| <b>".$x."</b> |<br>";
	echo "------------<br>";
     return;
}
echo '<table width="1500">';
$x=500;
$array1=array();
array_push($array1, 500);
echo '<td align="center">'.$x.'</td>';


//Question Two
$array2=array();
$q=2;
$cells=pow(2,$q-1);
$loop = 0;
$startx=$x;
$firstx=round($x/2);
echo '<td>'.$firstx.'<br>';
array_push($array2, round($firstx));

	
while($cells-1 > $loop){
	$x=round($x+$firstx);
	if ($x!=$startx){
	
echo $x.'<br>';

	array_push($array2, round($x));

	$loop = $loop+1;
	}
	
}
echo '</td>';
$x=$startx/2;


//Question Three
echo '<td>';
$i=-1;
$array3=array();
$increment=round($array2[0]/2);

foreach ($array2 as $parent){
$i=$i+1;	
$parent=round($parent);	
$first=round($parent-$increment);
$second=round($parent+$increment);

echo $first.'<br>';
echo $second.'<br>';

$array3[$i] = $first;

$i=$i+1;
$array3[$i] =$second;
}
echo '</td>';


//Question Four
echo '<td>';
$i=-1;
$array4=array();
$increment=round(61);

foreach ($array3 as $parent){
$i=$i+1;	
$parent=round($parent);	
$first=round($parent-$increment);
$second=round($parent+$increment);

echo $first.'<br>';
echo $second.'<br>';

$array4[$i] = $first;
$i=$i+1;
$array4[$i] =$second;
}
echo '</td>';

//Question Five
echo '<td>';
$i=-1;
$array5=array();
$increment=round($array4[0]/2);

foreach ($array4 as $parent){
$i=$i+1;	
$parent=round($parent);	
$first=round($parent-$increment);
$second=round($parent+$increment);

echo $first.'<br>';
echo $second.'<br>';

$array5[$i] = $first;
$i=$i+1;
$array5[$i] =$second;
}
echo '</td>';

//Question Siz
echo '<td>';
$i=-1;
$array6=array();
$increment=round($array5[0]/2);

foreach ($array5 as $parent){
$i=$i+1;	
$parent=round($parent);	
$first=round($parent-$increment);
$second=round($parent+$increment);

echo $first.'<br>';
echo $second.'<br>';

$array6[$i] = $first;
$i=$i+1;
$array6[$i] =$second;
}
echo '</td>';

//Question Seven
echo '<td>';
$i=-1;
$array7=array();
$increment=round($array6[0]/2);

foreach ($array6 as $parent){
$i=$i+1;	
$parent=round($parent);	
$first=round($parent-$increment);
$second=round($parent+$increment);

echo $first.'<br>';
echo $second.'<br>';

$array7[$i] = $first;
$i=$i+1;
$array7[$i] =$second;
}
echo '</td>';

//Question Eight
echo '<td>';
$i=-1;
$array8=array();
$increment=round($array7[0]/2);

foreach ($array7 as $parent){
$i=$i+1;	
$parent=round($parent);	
$first=round($parent-$increment);
$second=round($parent+$increment);

echo $first.'<br>';
echo $second.'<br>';

$array8[$i] = $first;
$i=$i+1;
$array8[$i] =$second;
}
echo '</td>';

//Question Nine
echo '<td>';
$i=-1;
$array9=array();
$increment=round($array8[0]/2);

foreach ($array8 as $parent){
$i=$i+1;	
$parent=round($parent);	
$first=round($parent-$increment);
$second=round($parent+$increment);

echo $first.'<br>';
echo $second.'<br>';

$array9[$i] = $first;
$i=$i+1;
$array9[$i] =$second;
}
echo '</td>';

//Question Ten
echo '<td>';
$i=-1;
$array10=array();
$increment=round($array9[0]/2);

foreach ($array9 as $parent){
$i=$i+1;	
$parent=round($parent);	
$first=round($parent-$increment);
$second=round($parent+$increment);

echo $first.'<br>';
echo $second.'<br>';

$array10[$i] = $first;
$i=$i+1;
$array10[$i] =$second;
}
echo '</td>';
echo '</table>';

//Answer
$i=-1;
$array11=array();
$increment=round($array10[0]/2);

foreach ($array10 as $parent){
$i=$i+1;	
$parent=round($parent);	
$first=round($parent-$increment);
$second=round($parent+$increment);
$array11[$i] = $first;
$i=$i+1;
$array11[$i] =$second;
}


$data = array();
$data[0] = $array1;
$data[1] = $array2;
$data[2] = $array3;
echo json_encode($data);


?>



</body>
</html>