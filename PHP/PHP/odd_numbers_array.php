<?php
$arr = [];
for ($i=0; $i <= 20000; $i++) { 
    if($i % 2 == 1) {
        $arr[] = $i;
    }
}
var_dump($arr);
