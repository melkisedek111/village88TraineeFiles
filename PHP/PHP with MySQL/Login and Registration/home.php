<?php
session_start();
if(!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" ></script>
    <title>Home</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container {
            margin: 0 auto;
            margin-top: 30px;
            width: 1500px;
            border: .5px solid #fed049;
            font-family: 'Quicksand', sans-serif !important;
            padding: 20px;
        }
        .nav {
            width: 100%;
            /* height: 60px; */
            background-color: #fed049;
            padding: 10px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .nav > h1 {
            font-family: 'Quicksand', sans-serif !important;
            font-size: 50px;
        }
        .nav > div > form >input {
            width: 150px;
            height: 50px;
            color: white;
            outline: none;
            border: none;
            background-color: #810000;
            cursor: pointer;
            font-weight: bold;
            font-family: 'Quicksand', sans-serif !important;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="nav">
        <h1>My App</h1>
        <div>
            <form action="process.php" method="POST">
                <input type="submit"  name="logout" value="Logout">
            </form>
        </div>
    </div>
    <div class="container">
        <h1>Welcome <?= strtoupper($_SESSION['user']['name']); ?></h1>
    </div>
</body>
</html>