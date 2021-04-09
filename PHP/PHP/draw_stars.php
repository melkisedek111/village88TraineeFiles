<?php
// $x = array(4, 6, 1, 3, 5, 7, 25);
// function draw_stars($x) {
//     $html = "";
//     for ($i=0; $i < count($x); $i++) { 
//         for ($z=0; $z < $x[$i]; $z++) { 
//             $html .= "*";
//         }
//         $html .= "</br>";
//     }
//     echo $html;
// }
// draw_stars($x);

$x = array(4, "Tom", 1, "Michael", 5, 7, "Jimmy Smith");
function draw_stars($x) {
    $html = "";
    for ($i=0; $i < count($x); $i++) { 
        $l = is_string($x[$i]) ? [strlen($x[$i]), strtolower(substr($x[$i], 0, 1))] : [$x[$i], '*'];
        for ($z=0; $z < $l[0]; $z++) { 
            $html .= $l[1];
        }
        $html .= "</br>";
    }
    echo $html;
}
draw_stars($x);
