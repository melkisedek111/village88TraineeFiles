<?php
require("new-connection.php");
session_start();

function alert($show, $head, $message, $class)
{
    $_SESSION['alert']['show'] = $show;
    $_SESSION['alert']['head'] = $head;
    $_SESSION['alert']['message'] = $message;
    $_SESSION['alert']['class'] = $class;
}

function salted_password($password)
{
    $salt = bin2hex(openssl_random_pseudo_bytes(22));
    $encrypted_password = md5($password. '' .$salt);
    return ['password' => $encrypted_password, 'salt' => $salt];
};

if (isset($_POST['signup'])) {
    unset($_POST['signup']);
    if (empty($_POST['email'])) {
        $_SESSION['signup']['errors']['email'] = 'Your email is required!';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['signup']['errors']['email'] = 'Your email is not valid!';
    } elseif (select_data("tbl_users", ['email'], "WHERE email = '{$_POST['email']}'")) {
        $_SESSION['signup']['errors']['email'] = 'Your email is already exist!';
    }
    if (empty($_POST['first_name'])) {
        $_SESSION['signup']['errors']['first_name'] = 'Your first name is required!';
    } elseif (ctype_alpha(str_replace(' ', '', $_POST['first_name'])) == false) {
        $_SESSION['signup']['errors']['first_name'] = 'Your first name must contain letters only!';
    } elseif (strlen($_POST['first_name']) < 2) {
        $_SESSION['signup']['errors']['first_name'] = 'Your first name must be at least 2 letters!';
    }
    if (empty($_POST['last_name'])) {
        $_SESSION['signup']['errors']['last_name'] = 'Your last name is required!';
    } elseif (ctype_alpha(str_replace(' ', '', $_POST['last_name'])) == false) {
        $_SESSION['signup']['errors']['last_name'] = 'Your last name must contain letters only!';
    } elseif (strlen($_POST['last_name']) < 2) {
        $_SESSION['signup']['errors']['last_name'] = 'Your last name must be at least 2 letters!';
    }
    if (empty($_POST['password'])) {
        $_SESSION['signup']['errors']['password'] = 'Your password is required!';
    } elseif (strlen($_POST['password']) < 8) {
        $_SESSION['signup']['errors']['password'] = 'Your password should at least 8 characters long';
    } elseif ($_POST['confirm_password'] !== $_POST['password']) {
        $_SESSION['signup']['errors']['confirm_password'] = 'Your confirm password does not matched!';
    }
    if (empty($_POST['confirm_password'])) {
        $_SESSION['signup']['errors']['confirm_password'] = 'Your confirm password is required!';
    }

    foreach ($_POST as $key => $values) {
        $_SESSION['signup']['values'][$key] = $values;
    }

    if (@$_SESSION['signup']['errors']) {
        header("Location: index.php");
        exit;
    }
    unset($_POST['confirm_password']);
    $encrypted_password = salted_password($_POST['password']);
    $_POST['password'] = $encrypted_password['password'];
    $_POST['salt'] = $encrypted_password['salt'];
    $user_id = add_data($_POST, "tbl_users", true);
    if ($user_id) {
        $_SESSION['user'] = [
            'user_id' => $user_id,
            'name' => $_POST['first_name'] . ' ' .$_POST['last_name'],
            'email' => $_POST['email']
        ];
        header("Location: home.php");
        exit;
    }
}

if (isset($_POST['logout'])) {
    unset($_SESSION['user']);
    session_destroy();
    header("Location: index.php");
    exit;
}

if (isset($_POST['signin'])) {
    if (empty($_POST['email'])) {
        $_SESSION['signin']['errors']['email'] = 'Your email is required!';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['signin']['errors']['email'] = 'Your email is not valid!';
    }
    if (empty($_POST['password'])) {
        $_SESSION['signin']['errors']['password'] = 'Your password is required!';
    }
    if (@$_SESSION['signin']['errors']) {
        header("Location: index.php");
        exit;
    }
    $user = select_data("tbl_users", ['user_id', 'email', 'first_name', 'last_name', 'salt', 'password'], "WHERE email = '{$_POST['email']}'");
    if ($user) {
        $encrypted_password = md5($_POST['password'] . '' . $user['salt']);
        if ($user['password'] == $encrypted_password) {
            $_SESSION['user'] = [
                'user_id' => $user['user_id'],
                'name' => $user['first_name'] . ' ' .$user['last_name'],
                'email' => $user['email']
            ];
            header("Location: home.php");
            exit;
        } else {
            alert($show, "Account Aunthentication Error!2", "Email or password does not matched!", "danger");
            header("Location: index.php");
            exit;
        }
    } else {
        alert($show, "Account Aunthentication Error!1", "Email or password does not matched!", "danger");
        header("Location: index.php");
        exit;
    }
}

if (isset($_SESSION['user']) && isset($_POST['add_post'])) {
    unset($_POST['add_post']);
    if (empty($_POST['message'])) {
        $_SESSION['post']['errors']['message'] = "Message box is empty, please write a message!";
    }

    foreach ($_POST as $key => $value) {
        $_SESSION['post']['values'][$key] = $value;
    }

    if (@$_SESSION['post']['errors']) {
        header("Location: home.php");
        exit();
    }
    $_POST['user_id'] = $_SESSION['user']['user_id'];
    if (add_data($_POST, "tbl_messages")) {
        alert(true, "message", "Your post has been successfully added to the wall.", "alert_post");
        header("Location: home.php");
        exit();
    }
};

if (isset($_SESSION['user']) && isset($_POST['post_comment'])) {
    unset($_POST['post_comment']);
    if (empty($_POST['comment'])) {
        $_SESSION['comment']['errors']['comment'] = "Comment box is empty, please write one!";
        $_SESSION['comment']['errors']['message_id'] = $_POST['message_id'];
    }

    foreach ($_POST as $key => $value) {
        $_SESSION['post']['values'][$key] = $value;
    }

    if (@$_SESSION['comment']['errors']) {
        header("Location: home.php");
        exit();
    }
    $_POST['user_id'] = $_SESSION['user']['user_id'];
    if (add_data($_POST, "tbl_comments")) {
        alert(true, "comment", "You write a comment to a post", "alert_comment");
        $_SESSION['comment']['add_comment']['message_id'] = $_POST['message_id'];
        header("Location: home.php");
        exit();
    }
}

if (isset($_POST['delete_post'])) {
    $message_id = filter_var($_POST['message_id'], FILTER_SANITIZE_NUMBER_INT);
    
    if($_SESSION['user']['user_id'] == $_POST['user_id']) {
        $post_created = select_data("tbl_messages", ['message_id'], "WHERE message_id = $message_id AND created_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE) LIMIT 1");

        if($post_created) {
            alert(true, "message", "You need to wait 30 minutes to delete your post message the moment you post it", "danger_post");
            header("Location: home.php");
            exit();
        }

        if(delete_data("tbl_messages", "WHERE message_id = $message_id AND user_id = {$_SESSION['user']['user_id']}")) {
            alert(true, "message", "Your post message has been deleted.", "danger_post");
            $_SESSION['comment']['add_comment']['message_id'] = $_POST['message_id'];
            header("Location: home.php");
            exit();
        } else {
            alert(true, "message", "Something went wrong while deleting a post", "danger_post");
            header("Location: home.php");
            exit();
        }
        
    } else {
        alert(true, "message", "The post message cannot be deleted!", "danger_post");
        header("Location: home.php");
        exit();
    }
}

if($_POST['delete_comment']) {
    $comment_id = filter_var($_POST['comment_id'], FILTER_SANITIZE_NUMBER_INT);
    $message_id = filter_var($_POST['message_id'], FILTER_SANITIZE_NUMBER_INT);

    if($_SESSION['user']['user_id'] == $_POST['user_id']) {

        if(delete_data("tbl_comments", "WHERE comment_id = $comment_id AND user_id = {$_SESSION['user']['user_id']}")) {
            alert(true, "comment", "Your comment has been deleted.", "danger_comment");
            $_SESSION['comment']['add_comment']['message_id'] = $_POST['message_id'];
            header("Location: home.php");
            exit();
        } else {
            alert(true, "comment", "Something went wrong while deleting a comment", "danger_comment");
            $_SESSION['comment']['add_comment']['message_id'] = $_POST['message_id'];
            header("Location: home.php");
            exit();
        }

    } else {
        alert(true, "comment", "The comment cannot be deleted!", "danger_comment");
        $_SESSION['comment']['add_comment']['message_id'] = $_POST['message_id'];
        header("Location: home.php");
        exit();
    }
}