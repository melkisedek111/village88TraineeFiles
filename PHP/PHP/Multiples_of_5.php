<?php
// The first loop print the num that add 5 to itself for every loop but when I run the program, it lags
$num = 5;
for($i = 0; $num < 1000000; $i++) {
    $num += 5;
    echo "$num </br>";
}
echo "$num </br>";


// second loop the prints num1 that multiply 5 to itself
$num1 = 5;
for($i = 0; $num1 < 1000000; $i++) {
    $num1 *= 5;
}

echo "$num1 </br>";
