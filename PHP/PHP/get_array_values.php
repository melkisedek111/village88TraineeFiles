<?php
function print_lists($arr){
    $html = "<ul>";
    foreach($arr as $li) {
        $html .= "<li>$li</li>";
    }
    $html .= "</ul>";
    echo $html;
}
$A = array(2,3,'hello'); 
print_lists($A);