<?php
session_start();
if(isset($_SESSION['user'])) {
    header("Location: home.php");
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
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Quicksand', sans-serif !important;
        }
        .signin_and_signup {
            width: 1000px;
            border: .5px solid lightgray;
            height: 700px;
            margin: 0 auto;
            margin-top: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 0;
            border-radius: 20px;
            box-shadow: 6px 6px 5px 0px rgba(0,0,0,0.75);
        }
        .signin, .signup {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 1000px;
        }
        .signup .input_fields {
            text-align: center;
            padding-right: 120px;
        }
        .signin .input_fields {
            text-align: center;
            padding-left: 90px;
        }
        .signup .info_sign {
            border-radius: 20px 0 0 20px;
        }
        .signin .info_sign {
            border-radius: 0 20px 20px 0;
        }
        .info_sign {
            height: 700px;
            background-color: #ffc93c;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .input_fields > form > input:hover {
            background-color: #ffc93c;
        }
        .input_fields > form > a {
            display: inline-block;
            text-decoration: none;
            color: black;
            border-bottom: 2px solid #ffc93c;
            padding-bottom: 10px;
            margin-bottom: 50px;
        }
        .input_fields > form > small {
            font-size: 15px;
            margin-bottom: 20px;
        }

        .input_fields > form > input, .info_sign > button  {
            display: block;
            width: 250px;
            height: 50px;
            border-radius: 40px;
            outline: none;
            border: none;
            background-color: #fed049;
            cursor: pointer;
            font-weight: bold;
            font-family: 'Quicksand', sans-serif !important;
            margin: 0 auto;
        }

        .signin > div > form > h1, div, small, a, .signup > div > form > h1, div, small, a {
            display: block;
        }
        .signin > div > form > h1, .signup > div > form > h1 {
            font-weight: bolder;
            font-size: 50px;
            color: #ffc93c;
            margin-bottom: 20px;
        }
        .i-email {
            background-image: url("https://cdn3.iconfinder.com/data/icons/streamline-icon-set-free-pack/48/Streamline-58-512.png");
        }
        .i-password {
            background-image: url("https://cdn4.iconfinder.com/data/icons/basic-ui-2-line/32/key-password-main-keys-privilege-512.png");
        }
        .i-fb {
            background-image: url("https://cdn3.iconfinder.com/data/icons/social-media-black-white-2/512/BW_Facebook_2_glyph_svg-512.png");

        }
        .i-google {
            background-image: url("https://cdn4.iconfinder.com/data/icons/picons-social/57/40-google-plus-3-512.png");
        }
        .i-twitter {
            background-image: url("https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-social-twitter-512.png");
        }
        .i-confirm-password {
            background-image: url("https://cdn4.iconfinder.com/data/icons/top-search-7/128/_lock_password_trust_secure_security_closed_protect-512.png");
        }
        .i-user {
            background-image: url("https://cdn3.iconfinder.com/data/icons/sympletts-free-sampler/128/user-2-512.png");
        }
        .signin > div > form > div, .signup > div > form > div {
            margin: 20px 0;
        }
        .signin > div > form > div > a, .signup > div > form > div > a {
            height: 50px;
            width: 50px;
            border-radius: 50%;
            background-color: white;
            margin: 0 10px;
        }
        .i-email, .i-password, .i-twitter, .i-fb, .i-google, .i-confirm-password, .i-user {
            display: inline-block;
            margin: 0;
            background-size: 25px;
            background-repeat: no-repeat;
            background-position: center;
            height: 45px;
            width: 45px;
            background-color: #F4F8F7;
            border-right: 1px solid lightgray;
        }
        .input_container {
            display: block;
            margin: 0 auto;
            margin-bottom: 15px;
        }
        .input_container > input {
            font-family: 'Quicksand', sans-serif !important;
            vertical-align: top;
            width: 300px;
            height: 45px;
            outline: none;
            border: none;
            background-color: #F4F8F7;
            font-size: 17px;
            padding: 0 10px;
            font-weight: lighter !important;
            margin-left: -4.5px;
        }
        .info_sign > button {
            border: 1px solid white !important;
        }
        .info_sign > h1 {
            color: white;
            font-size: 40px;
            margin-bottom: 30px;
        }
        .info_sign > p {
            color: white;
            width: 350px;
            padding: 0 50px;
            font-size: 20px;
            margin-bottom: 30px;
        }
        .feedback {
            text-align: left;
            margin-left: 60px;
            color: red;
        }
        .is-invalid {
            border: .5px solid red !important;
        }
        .alert {
            display: block;
            width: auto;
            color: white;
            margin: 0 auto;
            padding: 10px;
        }
        .success {
            background-color: limegreen;
            border: 1px solid lime;
        }
        .danger {
            background-color: #810000;
            border: 1px solid #1b1717;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="signin_and_signup">
            <div class="signin">
                <div class="input_fields">
                    <form action="process.php" method="POST">
                        <h1>Sign in to Fhrallippi</h1>
                        <?php if(@$_SESSION['alert']): ?>
                            <div class="alert <?= $_SESSION['alert']['class'] ?>">
                                <h3><?= $_SESSION['alert']['head'] ?></h3>
                                <p><?= $_SESSION['alert']['message'] ?></p>
                            </div>
                        <?php endif; ?>
                        <div>
                            <a href="#" class="i-fb"></a>
                            <a href="#" class="i-google"></a>
                            <a href="#" class="i-twitter"></a>
                        </div>
                        <small>or user your email account</small>
                        <div class="input_container">
                            <span class="i-email"></span>
                            <input type="text" name="email" placeholder="Email" class="<?= @!$_SESSION['signin']['errors']['email'] ?: "is-invalid"?>">
                            <div class="feedback"><?= @$_SESSION['signin']['errors']['email'] ?></div>
                        </div>
                        <div class="input_container">
                            <span class="i-password"></span>
                            <input type="password" name="password" placeholder="Password" class="<?= @!$_SESSION['signin']['errors']['password'] ?: "is-invalid"?>">
                            <div class="feedback"><?= @$_SESSION['signin']['errors']['password'] ?></div>
                        </div>
                        <a href="#">Forgot your password?</a>
                        <input type="submit" name="signin" value="SIGN IN">
                    </form>
                </div>
                <div class="info_sign">
                    <h1>Hello, Friend</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button id="signup_button">SIGN UP</button>
                </div>
            </div>
            <div class="signup">
                <div class="info_sign">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button id="signin_button">SIGN IN</button>
                </div>
                <div class="input_fields">
                    <form action="process.php" method="POST">
                        <h1>Create Account</h1>
                        <div>
                            <a href="#" class="i-fb"></a>
                            <a href="#" class="i-google"></a>
                            <a href="#" class="i-twitter"></a>
                        </div>
                        <small>or user your email account</small>
                        <div class="input_container">
                            <span class="i-email"></span>
                            <input type="email" name="email" placeholder="Email" class="<?= @!$_SESSION['signup']['errors']['email'] ?: "is-invalid"?>" value="<?= @$_SESSION['signup']['values']['email'] ?>">
                            <div class="feedback"><?= @$_SESSION['signup']['errors']['email'] ?></div>
                        </div>
                        <div class="input_container">
                            <span class="i-user"></span>
                            <input type="text" name="first_name" placeholder="First name" class="<?= @!$_SESSION['signup']['errors']['first_name'] ?: "is-invalid"?>" value="<?= @$_SESSION['signup']['values']['first_name'] ?>">
                            <div class="feedback"><?= @$_SESSION['signup']['errors']['first_name'] ?></div>
                        </div>
                        <div class="input_container">
                            <span class="i-user"></span>
                            <input type="text" name="last_name" placeholder="Last name" class="<?= @!$_SESSION['signup']['errors']['last_name'] ?: "is-invalid"?>" value="<?= @$_SESSION['signup']['values']['last_name'] ?>">
                            <div class="feedback"><?= @$_SESSION['signup']['errors']['last_name'] ?></div>
                        </div>
                        <div class="input_container">
                            <span class="i-password"></span>
                            <input type="password" name="password" placeholder="Password" class="<?= @!$_SESSION['signup']['errors']['password'] ?: "is-invalid"?>" value="<?= @$_SESSION['signup']['values']['password'] ?>">
                            <div class="feedback"><?= @$_SESSION['signup']['errors']['password'] ?></div>
                        </div>
                        <div class="input_container">
                            <span class="i-confirm-password"></span>
                            <input type="password" name="confirm_password" placeholder="Password" class="<?= @!$_SESSION['signup']['errors']['confirm_password'] ?: "is-invalid"?>" value="<?= @$_SESSION['signup']['values']['confirm_password'] ?>">
                            <div class="feedback"><?= @$_SESSION['signup']['errors']['confirm_password'] ?></div>
                        </div>
                        <input type="submit" name="signup" value="SIGN UP">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            function reset_input() {
                $('.input_container input').removeClass('is-invalid');
                $('.input_container div').html('');
            }
            $('.signup').hide();
            <?php if(@$_SESSION['signin']['errors']): ?>
                $('.signup').hide();
                $('.signin').show();
            <?php endif; ?>
            <?php if(@$_SESSION['signup']['errors']): ?>
                $('.signup').show();
                $('.signin').hide();
            <?php endif; ?>

            $("#signup_button").click(function() {
                $('.input_fields').toggle(350);
                $('.signin').animate({
                    width: "toggle"
                }, 800, function() {
                    reset_input();
                    $('.input_fields').toggle(650);
                    $('.signup').animate({
                        width: "toggle"
                    }, 1000);
                });
            });
            $("#signin_button").click(function() {
                $('.input_fields').toggle(350);
                $('.signup').animate({
                    width: "toggle"
                }, 800, function() {
                    reset_input();
                    $('.input_fields').toggle(650);
                    $('.signin').animate({
                        width: "toggle"
                    }, 1000);
                });
            });
        });
        $('.alert').fadeIn({complete: function() {
            setTimeout(() => {
                $(this).fadeOut(function() {
                    $(this).remove();
                });
            }, 5000);
        }});
    </script>
    <?php 
        unset($_SESSION['signin']['errors']);
        unset($_SESSION['signup']['errors']);
        unset($_SESSION['signup']['values']);
        unset($_SESSION['alert']);
    ?>
</body>
</html>