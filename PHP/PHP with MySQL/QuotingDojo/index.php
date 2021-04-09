<?php
session_start();



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" ></script>
    <link href="https://bootswatch.com/4/sketchy/bootstrap.min.css" rel="stylesheet" />
    <title>QuotingDojo</title>
    <style>
        .title {
            font-size: 75px;
        }
        .quote_body > div > form > div {
            display: flex;
            margin-bottom: 20px;
            /* align-items: start; */
        }
        .quote_body > div > form > div > p {
            flex: .2;
            font-size: 30px; 
        }
        .quote_body > div > form > div > div {
            flex: .75;
        }
        .quote_body > div > form > div > div > input, textarea {
            font-size: 25px; 
        }
        .quote_body > div > form > input {
            width: 250px;
            height: 70px;
            font-size: 30px;
        }
        .quote_body > div > form > a {
            width: 250px;
            height: 70px;
            font-size: 30px;
            margin-left: 250px;
        }
        .invalid-feedback {
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-9 mx-auto quote_body">
                <?php if(@$_SESSION['ADD_SUCCESS']): ?>
                    <div class="alert alert-dismissible alert-success">
                        <button type="button" class="close" data-dismiss="alert" id="close-alert">&times;</button>
                        <strong>Well done!</strong> You successfully add your own quote!</a>.
                    </div>
                <?php endif; ?>
                <div class="jumbotron">
                    <form action="process.php" method="POST">
                        <p class="title text-center">Welcome to QuotingDojo</p>
                        <div>
                            <p>Your Name:</p>
                            <div>
                                <input type="text" class="form-control <?= @!$_SESSION['main']['errors']['name'] ?: "is-invalid" ?>" name="name" id="name" placeholder="Please enter your name">
                                <div class="invalid-feedback"><?= @$_SESSION['main']['errors']['name'] ?></div>
                            </div>
                        </div>
                        <div>
                            <p>Your Quote:</p>
                            <div>
                                <textarea class="form-control <?= @!$_SESSION['main']['errors']['quote'] ?: "is-invalid" ?>" name="quote" id="" cols="30" rows="10" placeholder="Your qoutes here!"></textarea>
                                <div class="invalid-feedback"><?= @$_SESSION['main']['errors']['quote'] ?></div>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary" name="add_quote" value="Add my quote!">
                        <a href="main.php" class="btn btn-danger">Skip to quotes!</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#close-alert").click(function(){
                $(".alert").slideUp(function() {
                    setTimeout({}, 500);
                });
            });
        });
    </script>
</body>
</html>
<?php 
unset($_SESSION['ADD_SUCCESS']); 
unset($_SESSION['main']['errors']); 
?>