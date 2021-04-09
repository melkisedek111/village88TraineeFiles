<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://bootswatch.com/4/lux/bootstrap.min.css" rel="stylesheet" />
    <title>Survey Form Result</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h3>Submitted Information</h3>
                    </div>
                    <div class="card-body">
                        <h4>Name: <?= $_POST['name'] ?></h4>
                        <h4>Dojo Location: <?= $_POST['location'] ?></h4>
                        <h4>Favorite Language: <?= $_POST['language'] ?></h4>
                        <h4>Comment: <?= $_POST['comment'] ?></h4>
                    </div>
                    <div class="card-footer">
                        <a href="/register" class="btn btn-success">Go back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>