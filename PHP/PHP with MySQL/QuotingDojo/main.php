<?php
session_start();
require("new-connection.php");
$quotes = select_all_data("quotes", ['name, quote, created_at'], "ORDER BY created_at DESC");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://bootswatch.com/4/sketchy/bootstrap.min.css" rel="stylesheet" />
    <title>QuotingDojo</title>
    <style>
        .title {
            font-size: 65px;
        }
        .break {
            border-bottom: 5px solid #333333;
            border-style: ridge;
            margin-bottom: 20px;
        }
        .quotes_main > div > h5 {
            font-size: 30px;
            font-weight: 900;
        }
        .quotes_main > div > p {
            font-size: 35px;
            padding: 0 10px;
        }
    </style>
</head>
<body>
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-9 mx-auto quotes_main">
                <p class="title text-center">Here are the awesome quotes!</p>
                <a href="index.php" class="btn btn-danger mb-5">Add quotes!</a>
                <div>
                    <?php foreach($quotes as $quote): ?>
                        <p>" <?= $quote['quote']; ?> "</p>
                        <h5 class="text-center">-
                            <?= $quote['name'] ?> at 
                            <?php $date = new DateTime($quote['created_at']);
                            echo $date->format('h:i:s A F d, Y'); ?>
                        </h5>
                        <div class="break"></div>
                    <?php endforeach; ?>
                  
                </div>
            </div>
        </div>
    </div>
</body>
</html>