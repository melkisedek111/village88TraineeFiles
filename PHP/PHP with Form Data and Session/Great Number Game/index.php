<?php
session_start();
$play = true;
function reset_game() {
    $play = true;
    $isGuess;
    $response;
    $_SESSION['guess_number'] = rand(1, 100);
    $_SESSION['number_times_guess'] = 10;
}
if(!isset($_SESSION['guess_number'])) {
    $_SESSION['guess_number'] = rand(1, 100);
    $_SESSION['number_times_guess'] = 10;
} elseif(isset($_SESSION['guess_number']) && isset($_POST['play_again'])) {
    reset_game();
} elseif($_SESSION['number_times_guess'] === 1) {
    $_SESSION['number_times_guess'] -=1;
    $play = false;
    $isGuess = true;
    $response = $_SESSION['number_times_guess'] . " guesses, ". $_SESSION['guess_number'] . " was the right number";
}
$number_to_guess = $_SESSION['guess_number'];
if(isset($_POST['guess']) == "guess" && $play) {
    $_SESSION['number_times_guess'] -= 1;
    if($_POST['guess_number'] > $number_to_guess) {
        $isGuess = false;
        $response = "Too High";
    } elseif($_POST['guess_number'] < $number_to_guess) {
        $isGuess = false;
        $response = "Too Low";
    } elseif($_POST['guess_number'] == $number_to_guess) {
        $play = false;
        $isGuess = true;
        $response = "$number_to_guess was the number!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://bootswatch.com/4/sketchy/bootstrap.min.css" rel="stylesheet" />
    <title>Great Number Game</title>
    <style>
        .wrong {
            background-color: red;
        }
        .right {
            background-color: green;
        }
        .guess_number {
            font-size: 100px;
            padding: 50px;
            border: 1px solid black;
            color: white;
            display: block !important;
        }
        .input_guess {
            width: 250px;
            margin: 0 auto;
            display: block;
            margin-bottom: 10px;
            height: 50px;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <form action="/" method="POST">
                    <div class="text-center">
                        <h1>Welcome to the Great Number Game!</h1>
                        <p>I am thinking of a number between 1 and 100</p>
                        <p>Take a guess!</p>
                    </div>
                    <div class="text-center">
                        <h3>Number of times you guess: <?= @$_SESSION['number_times_guess'] ?></h3>
                        <?php if(@$response): ?>
                            <h1 class="guess_number <?= @$isGuess ? "right" : "wrong" ?> "><?= @$response; ?></h1>
                            <?php if(@$isGuess): ?>
                                <input type="submit" class="btn btn-success" name="play_again" value="Play Again">
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <div class="text-center mt-5">
                        <?php if($play): ?>
                            <input type="text" class="form-control input_guess" name="guess_number" placeholder="Please enter your guess!">
                            <input type="hidden" name="guess" value="guess">
                            <input type="submit" class="btn btn-primary" value="Submit">
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>