<?php
session_start();
require("new-connection.php");
$_SESSION['main']['errors'] = [];
if(isset($_POST['add_quote'])) {
    if(!ctype_alpha(str_replace(' ', '', $_POST['name']))) {
        $_SESSION['main']['errors']['name'] = 'Your name should contain letters only';
    }
    if(empty($_POST['name'])) {
        $_SESSION['main']['errors']['name'] = 'Your name is required!';
    }
    if(empty($_POST['quote'])) {
        $_SESSION['main']['errors']['quote'] = 'Quote should not be empty, please write one.';
    }
    if($_SESSION['main']['errors']) {
        header("Location: index.php");
        exit();
    }

    unset($_POST['add_quote']);
    if(add_data($_POST, "quotes")) {
        $_SESSION['ADD_SUCCESS'] = true;
        header("Location: index.php");
        exit;
    }
}