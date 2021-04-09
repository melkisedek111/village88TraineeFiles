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
    } elseif (ctype_alpha(str_replace(' ', '', $_POST['first_name'])) === false) {
        $_SESSION['signup']['errors']['first_name'] = 'Your first name must contain letters only!';
    } elseif (strlen($_POST['first_name']) < 2) {
        $_SESSION['signup']['errors']['first_name'] = 'Your first name must be at least 2 letters!';
    }
    if (empty($_POST['last_name'])) {
        $_SESSION['signup']['errors']['last_name'] = 'Your last name is required!';
    } elseif (ctype_alpha(str_replace(' ', '', $_POST['last_name'])) === false) {
        $_SESSION['signup']['errors']['last_name'] = 'Your last name must contain letters only!';
     }elseif (strlen($_POST['last_name']) < 2) {
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

if(isset($_POST['logout'])) {
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
    if($user) {
        $encrypted_password = md5($_POST['password'] . '' . $user['salt']);
        if($user['password'] == $encrypted_password) {
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
