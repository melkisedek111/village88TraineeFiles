<?php
// $A = array(2,4,10,16);
// function multiply($arr){
//     $a = [];
//     foreach($arr as $num) {
//         $a[] = $num * 5;
//     }
//     return $a;
// }
// $B = multiply($A);
// echo "<pre>";
// var_dump($B);
$A = array(2,4,10,16);
function multiply($arr, $f){
    $a = [];
    foreach($arr as $num) {
        $a[] = $num * $f;
    }
    return $a;
}
$B = multiply($A, 2);
echo "<pre>";
var_dump($B);