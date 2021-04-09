<?php
$users = ['first_name' => "Michael", 'last_name' => "Choi"];
function arrayFunc($arr) {
    $length = count($arr);
    $output = "There are $length keys in this array: ";
    foreach($arr as $key => $val) {
        $output .= "$key </br>";
    }
    foreach($arr as $key => $val) {
        $output .= "$key </br>";
        $output .= "The value in the key '$key' is '$val'.";
    }
    echo $output;
}

arrayFunc($users);