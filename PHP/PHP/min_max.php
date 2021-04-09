<?php
$arr = array( 135, 2.4, 2.67, 1.23, 332, 2, 1.02); 
function get_max_and_min($arr) {
    $min = 0;
    $max = 0;
    for ($i=0; $i < count($arr); $i++) { 
        if(!$min) $min = $arr[$i];
        if(!$max) $max = $arr[$i];
        if($min > $arr[$i]) {
            $min = $arr[$i];
        }
        if($max < $arr[$i]) {
            $max = $arr[$i];
        }
    }
    return ['max' => $max, 'min' => $min];
}

var_dump(get_max_and_min($arr));