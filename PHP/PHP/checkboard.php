<?php
$container = "<div class='container'>";
$block = "<div class='board1'>";
for ($i=0; $i < 8; $i++) { 
    if($i % 2 === 1) {
        $block .= "<div class='evenRow'>";
        for ($x=0; $x < 8; $x++) { 
            if($x % 2 == 1) {
                $block .= "<div class='odd'></div>";
            } else {
                $block .= "<div class='even'></div>";
            }
        }
        $block .= "</div>";
    } else {
        $block .= "<div class='oddRow'>";
        for ($x=0; $x < 8; $x++) { 
            if($x % 2 == 1) {
                $block .= "<div class='even'></div>";
            } else {
                $block .= "<div class='odd'></div>";
            }
        }
        $block .= "</div>";
    }
}
$block .= "</div>";
$container .= $block;

$block = "<div class='board2'>";
for ($i=0; $i < 8; $i++) { 
    if($i % 2 === 1) {
        $block .= "<div class='evenRow'>";
        for ($x=0; $x < 8; $x++) { 
            if($x % 2 == 1) {
                $block .= "<div class='odd1'></div>";
            } else {
                $block .= "<div class='even1'></div>";
            }
        }
        $block .= "</div>";
    } else {
        $block .= "<div class='oddRow'>";
        for ($x=0; $x < 8; $x++) { 
            if($x % 2 == 1) {
                $block .= "<div class='even1'></div>";
            } else {
                $block .= "<div class='odd1'></div>";
            }
        }
        $block .= "</div>";
    }
}
$block .= "</div>";

$container .= $block . "</div>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkerboard</title>
    <style>
        * {
            box-sizing: border-box;   
        }
        .container {
            display: flex;
            /* margin:  */
        }
        .board1 {
            width: 900px;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
        }
        .odd, .even, .odd1, .even1 {
            padding: 40px;
        }
        .odd {
            background-color: red;
        }
        .even {
            background-color: black;
        }
        .odd1 {
            background-color: #FFFFE0;
        }
        .even1 {
            background-color: #556B2F;
        }
        .oddRow, .evenRow {
            display: flex;
        }
    </style>
</head>
<body>
    <?= $container ?>
</body>
</html>