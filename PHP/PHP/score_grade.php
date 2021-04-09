<?php
for ($i=0; $i <= 100; $i++) { 
    $number = rand(50,100); 
    if($number < 70) {
        echo "<h1>$number/100</h1>";
        echo "<h2>Your grade is D</h2>";
    } elseif($number > 70 && $number < 80) {
        echo "<h1>$number/100</h1>";
        echo "<h2>Your grade is C</h2>";
    } elseif($number >= 80 && $number < 90) {
        echo "<h1>$number/100</h1>";
        echo "<h2>Your grade is B</h2>";
    } elseif($number >= 90 && $number < 100) {
        echo "<h1>$number/100</h1>";
        echo "<h2>Your grade is A</h2>";
    }
}