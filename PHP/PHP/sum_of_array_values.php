<?php
$array = [1,2,5,10,255,3];
$number = 0;
for ($i=0; $i < count($array); $i++) { 
    $number += $array[$i];
}
echo $number;