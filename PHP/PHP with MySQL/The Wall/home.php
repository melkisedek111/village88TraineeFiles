<?php
require("new-connection.php");
session_start();
if(!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}



$messages = select_all_data("tbl_messages", ['message_id', 'message', 'tbl_messages.user_id as user_message_id', " CONCAT(first_name , ' ' , last_name) as name", "DATE_FORMAT(tbl_messages.created_at, '%M %d %Y %I:%i %p') as message_created"], 'LEFT JOIN tbl_users ON tbl_messages.user_id = tbl_users.user_id ORDER BY tbl_messages.created_at DESC');

$comments = function($messages_id) {
    return select_all_data("tbl_comments", ['comment_id', "CONCAT(first_name , ' ' , last_name) as name", 'tbl_comments.user_id as comment_user_id', 'comment', "DATE_FORMAT(tbl_comments.created_at, '%M %d %Y %I:%i %p') as comment_created"], "LEFT JOIN tbl_users ON tbl_comments.user_id = tbl_users.user_id WHERE message_id = $messages_id ORDER BY tbl_comments.created_at DESC");
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
            font-family: 'Quicksand', sans-serif !important;
            padding: 20px;
        }
        .nav {
            width: 100%;
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
            border-radius: 30px;
        }
        .break {
            border-bottom: .5px solid #fed049;
            margin: 15px 0;
        }
        .break-g {
            border-bottom: .5px solid #6e7c7c;
            margin: 15px 0;
            opacity: .5;
        }
        .title {
            font-size: 40px;
        }
        .alert_post {
            background-color: #06BEE1;
        }
        .danger_post, .danger_comment {
            background-color: red;
        }
        .alert_comment h3, .danger_comment h3 {
            font-size: 17px !important;
            padding: 10px 20px;
        }
        .alert_comment {
            background-color: limegreen;
        }
        .alert {
            width: 100%;
            margin-bottom: 10px;
            color: white;
        }
        .alert h3 {
            font-size: 25px;
            padding: 15px 20px;
        }
        .feedback {
            font-size: 21px;
            color: red;
        }
        .is-invalid {
            border: .5px solid red !important;
        }
        .post > div {
            width: 1200px;
            display: block;
            margin: 0 auto;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 20px;
            box-shadow: 10px 10px 45px -16px rgba(0,0,0,0.75);
        }
        .post > div > div { 
            margin-top: 20px;
        }
        .post > div > h3 { 
            font-size: 30px;
        }
        .post > div > small { 
            font-size: 17px;
        }
        .post > div > p {
            margin: 10px 0;
            font-size: 25px;
            text-align: justify;
        }
        .post > div > form > h5, .comments{
            font-size: 22px;
            margin-bottom: 5px;
            margin-top: 15px;
        }
        textarea:focus {
            border: .5px solid #fed049 !important;
        }
        textarea {
            display: block;
            width: 100%;
            outline: none;
            border: none;
            background-color: #F4F8F7;
            padding: 20px;
            font-family: 'Quicksand', sans-serif !important;
            font-weight: 400;
            font-size: 17px;
            resize: none;
        }
        .post > div > form > input:hover {
            background-color: lime;
        }
        .button_block {
            display: block;
        }
        .button {
            width: 150px;
            height: 40px;
            color: white;
            outline: none;
            border: none;
            background-color: limegreen;
            cursor: pointer;
            font-weight: bold;
            font-family: 'Quicksand', sans-serif !important;
            margin-top: 10px;
            margin-left: auto;
            border-radius: 30px;
        }

        .write_post > form > h1 {
            margin-bottom: 10px;
        }
        .write_post > form > textarea {
            font-size: 30px !important;
        }
        .write_post > form > input:hover {
            background-color: #1AC8ED !important;
        }
        .write_post > form > input {
            background-color: #06BEE1 !important;
        }
        .comments > .section {
            margin-left: 20px;
        }
        .comments > .section > h5 {
            font-size: 20px;
            display: inline-block;
        }
        small {
            font-size: 15px !important;
            color: #6e7c7c;
            display: block;
            margin-bottom: 10px;
        }
        .comments > .section > p {
            font-size: 18px;
        }
        .comments > .section > form {
            display: inline-block;
            text-align: right;
            margin-left: auto;
        }
        .comments > .section > form > input:hover {
            background-color: red;
            color: white;
            border-radius: 10px;
        }
        .comments > .section > form > input {
            padding: 5px 10px;
            background-color: transparent;
            outline: none;
            border: none;
            cursor: pointer;
            color: red;
            text-decoration: underline;
            display: block;
            font-family: 'Quicksand', sans-serif !important;
        }
        .delete_button:hover {
            background-color: red !important;
        }
        .delete_button {
            background-color: maroon !important;
        }
        .neutral_button:hover {
            background-color: #F9F9F9;
        }
        .neutral_button {
            background-color: white;
            border: .4px solid gray;
            color: black;
        }
        .popup {
            display: none;
            position: fixed;
            height: 100vh;
            width: 100%;
            background-color: rgba(0, 0, 0, .5);
            z-index: 999;
            overflow-y: hidden;
        }
        .popup_content {
            display: block;
            height: auto;
            width: 550px;
            background-color: white;
            margin: 0 auto; 
            margin-top: 15%;
            padding: 30px;
            font-family: 'Quicksand', sans-serif !important;
        }
        .popup_content > p {
            font-size: 20px;
            text-align: justify;
            margin: 20px 0;
        }
        .popup_content > div {
            margin-top: 15px;
            border-top: .2px solid lightgray;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="popups"></div>
    <div class="nav">
        <h1>CodingDojo Wall</h1>
        <div>
            <form action="process.php" method="POST">
                <input type="submit"  name="logout" value="Logout">
            </form>
        </div>
    </div>
    <div class="container">
        <h1>Welcome <?= strtoupper($_SESSION['user']['name']); ?></h1>
        <div class="break"></div>
        <div class="write_post">
            <?php if(@$_SESSION['alert']['head'] == "message"): ?>
            <div class="alert <?= $_SESSION['alert']['class']; ?>">
                <h3><?= $_SESSION['alert']['message']; ?></h3>
            </div>
            <?php endif; ?>
            <form action="process.php" method="POST">
                <h1>Post a message</h1>
                <textarea class="<?= @!$_SESSION['post']['errors']['message'] ?: "is-invalid" ?>" name="message" rows="5" placeholder="Please write your message here!"></textarea>
                <div class="feedback"><?= @$_SESSION['post']['errors']['message']; ?></div>
                <input type="submit" class="button button_block" name="add_post" value="Post a message">
            </form>
        </div>
        <h1 class="title">Messages</h1>
        <div class="break"></div>
        <div class="post">
            <?php foreach($messages as $message): ?>
                <div>
                    <?php if($message['user_message_id'] == $_SESSION['user']['user_id']): ?>
                        <button type="button" value="Delete Message" class="delete_button button button_block delete_popup" attr-message-id="<?= $message['message_id']; ?>" attr-user-id="<?= $message['user_message_id']; ?>">Delete Message</button>
                    <?php endif; ?>
                    <h3><?= $message['name']; ?></h3>
                    <small><?= $message['message_created']; ?></small>
                    <p><?= $message['message']; ?></p>
                    <div class="break-g"></div>
                    <form action="process.php" method="POST">
                        <?php $commentError = @$_SESSION['comment']['errors']['message_id'] == $message['message_id']; ?>
                        <h5>Post a comment</h5>
                        <textarea class="<?= @$commentError ? "is-invalid" : "" ?>" name="comment" id="" rows="5" placeholder="Please write your comment for this post"></textarea>
                        <div class="feedback"><?= @$commentError ? $_SESSION['comment']['errors']['comment'] : ""; ?></div>
                        <input type="hidden" name="message_id" value="<?= $message['message_id']; ?>">
                        <input type="submit" class="button button_block" name="post_comment" value="Write a comment">
                    </form>

                    <div class="comments">

                        <?php if(@$_SESSION['alert']['head'] == "comment" &&  @$_SESSION['comment']['add_comment']['message_id'] == $message['message_id']): ?>
                            <div class="alert <?= $_SESSION['alert']['class']; ?>">
                                <h3><?= $_SESSION['alert']['message']; ?></h3>
                            </div>
                        <?php endif; ?>

                        <h5>Comments</h5>
                        <div class="break"></div>
                        <div class="section">

                            <?php foreach(@$comments($message['message_id']) as $comment): ?>
                                <h5><?= $comment['name']; ?></h5>

                                <?php if($comment['comment_user_id'] == $_SESSION['user']['user_id']): ?>
                                    <form action="process.php" method="POST">
                                        <input type="hidden" name="comment_id" value="<?= $comment['comment_id']; ?>">
                                        <input type="hidden" name="user_id" value="<?=$comment['comment_user_id']; ?>">
                                        <input type="hidden" name="message_id" value="<?= $message['message_id']; ?>">
                                        <input type="submit" name="delete_comment" value="Delete">
                                    </form>
                                <?php endif; ?>

                                <small><?= $comment['comment_created']; ?></small>
                                <p><?= $comment['comment']; ?></p>
                                <div class="break-g"></div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            function popup(message_id, user_id) {
                $('.popups').html(`
                    <div class="popup">
                        <div class="popup_content">
                            <h1>Delete Message</h1>
                            <p>Are you sure you want to delete this message? This cannot be undone.</p>
                            <div>
                                <form action="process.php" method="POST">
                                    <button type="button" class="button neutral_button cancel">Cancel</button>
                                    <input type="hidden" name="message_id" value="${message_id}" />
                                    <input type="hidden" name="user_id" value="${user_id}" />
                                    <input type="submit" class="delete_button button" id="popup_delete_button" name="delete_post" value="Delete">
                                </form>
                            </div>
                        </div>
                    </div>
                `);
            $('.popup').slideDown(250)
            }

            $(document).on('click', '.cancel', function(e) {
                $('.popup').slideUp(250, 'linear', function() {
                    $('.popup').remove();
                });
            });
            $(document).on('click', '.delete_popup', function(e) {
                e.preventDefault();
                popup($(this).attr('attr-message-id'), $(this).attr('attr-user-id'));
            });
            $('.alert').fadeIn({complete: function() {
                setTimeout(() => {
                    $(this).fadeOut(function() {
                        $(this).remove();
                    });
                }, 5000);
            }});
        });
    </script>
    <?php
        unset($_SESSION['post']['errors']);
        unset($_SESSION['post']['values']);
        unset($_SESSION['comment']['errors']);
        unset($_SESSION['comment']['values']);
        unset($_SESSION['comment']['add_comment']);
        unset($_SESSION['alert']);
    ?>
</body>
</html>