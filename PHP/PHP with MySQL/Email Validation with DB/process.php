<?php
require("db.php");

session_start();
$error_messages = [
    'email' => 'Your email is required',
    'first_name' => 'Your first name is required',
    'last_name' => 'Your last name is required',
    'password' => 'Your password is required',
    'confirm_password' => 'Your password does not matched',
    'birth_date' => 'Your date of birth is required',
    'length_password' => 'The password should be more than 6 characters',
    'letter_first_name'  => 'First name should contain letter only',
    'letter_last_name'  => 'Last name should contain letter only',
];

if (isset($_POST['submit_registration'])) {
    
    foreach ($_POST as $key => $value) {
        if ($key === "password" && (strlen($value) <= 6 && strlen($value) > 1)) {
            $_SESSION['errors'][$key] = $error_messages['length_password'];
        }
        if ($key === "confirm_password" && $value !== $_POST['password']) {
            $_SESSION['errors'][$key] = $error_messages[$key];
        }

        if($key === "email") {
            $check_email_query = "SELECT email FROM users WHERE email = '$value'";
            $result = $connection->query($check_email_query);
            if($result->num_rows > 0) {
                $_SESSION['errors'][$key] = 'The email is already taken!';
                $connection->close();
            }
        }

        if (empty($value)) {
            $_SESSION['errors'][$key] = $error_messages[$key];
        } elseif ($key === "first_name" && !ctype_alpha($value)) {
            $_SESSION['errors'][$key] = $error_messages['letter_first_name'];
        } elseif ($key === "last_name" && !ctype_alpha($value)) {
            $_SESSION['errors'][$key] = $error_messages['letter_last_name'];
        }
        $_SESSION['values'][$key] = filter_var($value, FILTER_SANITIZE_STRING);
    }

    if (count($_SESSION['errors']) === 0) {
        $query = "INSERT INTO users(email, first_name, last_name, password, birth_date) VALUES('{$_SESSION['values']['email']}', '{$_SESSION['values']['first_name']}', '{$_SESSION['values']['last_name']}', '{$_SESSION['values']['password']}', '{$_SESSION['values']['birth_date']}')";

        if($connection->query($query)) {
            $connection->close();
            $_SESSION['errors'] = [];
            $_SESSION['values'] = [];
            $_SESSION['registered'] = true;
            header('Location: .');
            exit();
        }
    }

    header('Location: register.php');
    exit();
}


$login_error_messages = [
    'email' => 'Your email is required',
    'password' => 'Your password is required'
];

if(isset($_POST['login'])) {
    $query = "SELECT user_id, email, password, first_name, last_name FROM users WHERE email = '{$_POST['email']}' AND password = '{$_POST['password']}' LIMIT 1";
    $result = $connection->query($query);

    if(empty($_POST['email'])) {
        $_SESSION['login_errors']['email'] = $login_error_messages['email'];
    }
    if(empty($_POST['password'])) {
        $_SESSION['login_errors']['password'] = $login_error_messages['password'];
    }
    if(count($_SESSION['login_errors'])) {
        header("Location: .");
        exit();
    }

    if($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        unset($_SESSION['login_errors']);
        $_SESSION['user'] = [
            'user_id' => $user['user_id'],
            'email' => $user['email'],
            'first_name' => $user['first_name'],
            'last_name' => $user['last_name'],
        ];
        header("Location: home.php");
        exit();
    } else {
        $_SESSION['login_errors'] = true;
        header("Location: .");
        exit();
    }
    $connection->close();
}


if(isset($_POST['logout'])) {
    unset($_SESSION['user']);
    header("Location: .");
    exit();
}

if(isset($_POST['delete'])) {
    $query = "DELETE FROM users WHERE user_id = '{$_POST['user_id']}'";
    $result = $connection->query($query);
    if($result) {
        $_SESSION['delete_user']['name'] = $_POST['name'];
        header("Location: home.php");
        exit;
    }
}

?>
