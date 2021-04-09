<?php
$numbers = [1,2,5,10,255,3];
$total = 0;
$length = count($numbers);
for ($i=0; $i < $length; $i++) { 
    $total += $numbers[$i];
}
echo $total / $length;