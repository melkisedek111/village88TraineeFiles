<?php
session_start();

// session_destroy();
$cave_icon = "https://image.flaticon.com/icons/png/512/1566/1566543.png";
$farm_icon = "https://icons.iconarchive.com/icons/streamlineicons/streamline-ux-free/1024/farm-barn-icon.png";
$gold_coin_icon = "https://i.pinimg.com/originals/f7/bc/c5/f7bcc57146b2c3893e07864f56332a29.png";
$house_icon = "https://cdn3.iconfinder.com/data/icons/luchesa-vol-9/128/Home-256.png";
$casino_icon = "https://img.icons8.com/clouds/2x/chip.png";
$coin_bag = "https://lh3.googleusercontent.com/proxy/SLsWQAPQaz3y4cTcTT5Nxmm_IPzWPpU9HAT3MN0r0Sf986t_q7ZhR7V3dzhyvT10QIKeWFfQdTbeMUAbrvTHjoxa";
// Unset all of the session variables.
// Unset all of the session variables.
// $_SESSION = array();

// // If it's desired to kill the session, also delete the session cookie.
// // Note: This will destroy the session, and not just the session data!
// if (ini_get("session.use_cookies")) {
//     $params = session_get_cookie_params();
//     setcookie(session_name(), '', time() - 42000,
//         $params["path"], $params["domain"],
//         $params["secure"], $params["httponly"]
//     );
// }

// // Finally, destroy the session.
// session_destroy();
// echo "<pre>";
// var_dump($_SESSION)

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://bootswatch.com/4/sketchy/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" ></script>
    <title>Ninja Gold Game</title>
    <style>
        .gold_game {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .gold_game > div{
            width: 400px;
        }
        .gold_status {
            margin-bottom: 20px;
            display: flex;
            align-items:center;
            height: 75px;
        }
        .gold_status > h2 > img {
            height: 40px;
            object-fit: contain;
        }
        .gold_status > h2 {
            display: inline-block !important;
            width: 300px;
            height: 50px;
            font-weight: 800;
            font-size: 50px;
            margin: 0;
        }
        .gold_status > h1 {
            display: inline-block;
            margin: 0;
            margin-right: 20px;
        }
        form > img {
            height: 150px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }
        form > div {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form > div > img {
            height: 50px;
            object-fit: contain;
            margin-left: 10px;
        }
        form > div > h1 {
            font-size: 75px;
            font-weight: bolder;
        }
        form {
            text-align: center;
        }
        form > input {
            width: 200px;
            height: 50px;
            font-size: 30px !important;
        }
        .activities > div::-webkit-scrollbar-track
        {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        border-radius: 10px;
        background-color: #F5F5F5;
        }

        .activities > div::-webkit-scrollbar
        {
        width: 12px;
        background-color: #F5F5F5;
        }

        .activities > div::-webkit-scrollbar-thumb
        {
        border-radius: 10px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: #333333;
        }
        .activities {
            height: 350px;
        }
        .activities > div {
            overflow: scroll;
        }
        .activities > div > .lost {
            color: red !important;
        }
        .activities > div > p {
            font-size: 25px;
            color: green;
        }

        .error {
            border: 2px solid red;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="gold_status">
            <h1>Your Gold:</h1>
            <h2><?= @$_SESSION['my_gold'] ? $_SESSION['my_gold'] : 0 ?> <img src="<?= $coin_bag ?>" alt="coin-bag"></h2>
        </div>
        <div class="gold_game">
            <div class="card">
               <div class="card-body">
                    <form action="process.php" method="POST">
                        <div>
                            <h1>Farm</h1>
                            <img src="<?= $farm_icon ?>" alt="farm">
                        </div>
                        <h2>earns 10 - 20 golds</h2>
                        <img src="<?= $gold_coin_icon; ?>" alt="gold">
                        <input type="submit" value="Find Gold"  name="get_farm_coin" class="btn btn-primary">
                    </form>
               </div>
            </div>
            <div class="card">
               <div class="card-body">
                    <form action="process.php" method="POST">
                        <div>
                            <h1>Cave</h1>
                            <img src="<?= $cave_icon ?>" alt="cave">
                        </div>
                        <h2>earns 5 - 10 golds</h2>
                        <img src="<?= $gold_coin_icon; ?>" alt="gold">
                        <input type="submit" value="Find Gold" name="get_cave_coin" class="btn btn-primary">
                    </form>
               </div>
            </div>
            <div class="card">
               <div class="card-body">
                    <form action="process.php" method="POST">
                        <div>
                            <h1>House</h1>
                            <img src="<?= $house_icon; ?>" alt="house">
                        </div>
                        <h2>earns 2 - 5 golds</h2>
                        <img src="<?= $gold_coin_icon; ?>" alt="gold">
                        <input type="submit" value="Find Gold" name="get_house_coin" class="btn btn-primary">
                    </form>
               </div>
            </div>
            <div class="card">
               <div class="card-body">
                    <form action="process.php" method="POST">
                        <div>
                            <h1>Casino</h1>
                            <img src="<?= $casino_icon ?>" alt="casino">
                        </div>
                        <h2>earns/takes 0 - 50 golds</h2>
                        <img src="<?= $gold_coin_icon; ?>" alt="gold">
                        <input type="submit" value="Bet 10 Gold" name="get_casino_coin" class="btn btn-primary">
                    </form>
               </div>
            </div>
        </div>
        <div class="card activities">
            <div class="card-body activity_logs">
<?php if(@$_SESSION['activities']): ?>
    <?php foreach(@$_SESSION['activities'] as $log): ?>
        <p class="<?= $log['earned'] ? "" : "lost" ?>"><?= $log['log']; ?></p>
    <?php endforeach; ?>
<?php endif; ?>

            </div>
        </div>
    </div>
    <script>
        $(".activity_logs").animate({ scrollTop: $('.activity_logs').prop("scrollHeight")}, 300);
    </script>

    <?php
        unset($_SESSION['error_email']);
        unset($_SESSION['error_password']);
        unset($_SESSION['email_value']);
        unset($_SESSION['password_value']);
    ?>
</body>
</html>