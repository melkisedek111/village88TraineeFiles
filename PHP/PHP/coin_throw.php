<?php
$heads = 0;
$tails = 0;
echo "<h1>Starting the program</h1>";
for ($i=1; $i <= 5000; $i++) { 
    if(rand(0,1) == 1) {
        $heads += 1;
        echo "Attempt #$i: Throwing a coin... It's a head! ... Got $heads head(s) so far and $tails tail(s) so far <br>";
    } else {
        $tails += 1;
        echo "Attempt #$i: Throwing a coin... It's a tail! ... Got $heads head(s) so far and $tails tail(s) so far <br>";
    }
}
echo "<h1>Ending the program - thank you!</h1>";