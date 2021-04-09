<?php
session_start();
$error_messages = [
    'email' => 'Your email is required',
    'first_name' => 'Your first name is required',
    'last_name' => 'Your last name is required',
    'password' => 'Your password is required',
    'confirm_password' => 'Your password does not matched',
    'birth_date' => 'Your date of birth is required',
    'upload_image' => 'Your image is required',
    'length_password' => 'The password should be more than 6 characters',
    'letter_first_name'  => 'First name should contain letter only',
    'letter_last_name'  => 'Last name should contain letter only',
];

if (isset($_POST['submit_registration'])) {
    $_SESSION['registered'] = false;
    $_SESSION['errors'] = [];
    $_SESSION['values'] = [];
    foreach ($_POST as $key => $value) {
        if ($key === "password" && (strlen($value) <= 6 && strlen($value) > 1)) {
            $_SESSION['errors'][$key] = $error_messages['length_password'];
        } else {
            $_SESSION['values'][$key] = $value;
        }
        if ($key === "confirm_password" && $value !== $_POST['password']) {
            $_SESSION['errors'][$key] = $error_messages[$key];
        } else {
            $_SESSION['values'][$key] = $value;
        }

        if ($_FILES['upload_image']['size'] == 0) {
            $_SESSION['errors']['upload_image'] = $error_messages['upload_image'];
        } else {
            $_SESSION['values']['upload_image'] = $_FILES['upload_image'];
        }

        if (empty($value)) {
            $_SESSION['errors'][$key] = $error_messages[$key];
        } elseif ($key === "first_name" && !ctype_alpha($value)) {
            $_SESSION['errors'][$key] = $error_messages['letter_first_name'];
        } elseif ($key === "last_name" && !ctype_alpha($value)) {
            $_SESSION['errors'][$key] = $error_messages['letter_last_name'];
        } else {
            $_SESSION['values'][$key] = $value;
        }
    }
    if (count($_SESSION['errors']) === 0) {
        $_SESSION['errors'] = [];
        $_SESSION['values'] = [];
        $_SESSION['registered'] = true;
    }

    header('Location: .');
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://bootswatch.com/4/yeti/bootstrap.min.css" rel="stylesheet" />
    <title>Registration without DB</title>
</head>
<body>
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <?php if (@$_SESSION['registered']): ?>
                    <div class="alert alert-dismissible alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <h4 class="alert-heading">Success!</h4>
                        <p class="mb-0">You are now successfully registered. Thanks for submitting your information.</p>
                    </div>
                <?php endif; ?>
                <div class="card">
                    <div class="card-header">
                        <h1>Registration</h1>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control <?= !$_SESSION['errors']['email'] ?: "is-invalid" ?> <?= !$_SESSION['values']['email'] ?: "is-valid" ?>" name="email" id="email" placeholder="Please enter your email" value="<?= @$_SESSION['values']['email'] ?>">
                                <div class="invalid-feedback"><?= @$_SESSION['errors']['email'] ?></div>
                            </div>
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control <?= @!$_SESSION['errors']['first_name'] ?: "is-invalid" ?> <?= !$_SESSION['values']['first_name'] ?: "is-valid" ?>" name="first_name" id="first_name" placeholder="Please enter your first name" value="<?= @$_SESSION['values']['first_name'] ?>">
                                <div class="invalid-feedback"><?= @$_SESSION['errors']['first_name'] ?></div>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control <?= @!$_SESSION['errors']['last_name'] ?: "is-invalid" ?> <?= !$_SESSION['values']['last_name'] ?: "is-valid" ?>" name="last_name" id="last_name" placeholder="Please enter your last name" value="<?= @$_SESSION['values']['last_name'] ?>">
                                <div class="invalid-feedback"><?= @$_SESSION['errors']['last_name'] ?></div>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control <?= @!$_SESSION['errors']['password'] ?: "is-invalid" ?> <?= !$_SESSION['values']['password'] ?: "is-valid" ?>" name="password" id="password" placeholder="Please enter your password" value="<?= @$_SESSION['values']['password'] ?>">
                                <div class="invalid-feedback"><?= @$_SESSION['errors']['password'] ?></div>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control <?= @!$_SESSION['errors']['confirm_password'] ?: "is-invalid" ?> <?= !$_SESSION['values']['confirm_password'] ?: "is-valid" ?>" name="confirm_password" id="confirm_password" placeholder="Please confirm your password" value="<?= @$_SESSION['values']['confirm_password'] ?>">
                                <div class="invalid-feedback"><?= @$_SESSION['errors']['confirm_password'] ?></div>
                            </div>
                            <div class="form-group">
                                <label for="birth_date">Date of Birth</label>
                                <input type="date" class="form-control <?= @!$_SESSION['errors']['birth_date'] ?: "is-invalid" ?> <?= !$_SESSION['values']['birth_date'] ?: "is-valid" ?>" name="birth_date" id="birth_date" value="<?= @$_SESSION['values']['birth_date'] ?>">
                                <div class="invalid-feedback"><?= @$_SESSION['errors']['birth_date'] ?></div>
                            </div>
                            <div class="form-group">
                                <label for="upload_image">Upload Profile Image</label>
                                <input type="file" class="form-control-file <?= @!$_SESSION['errors']['upload_image'] ?: "is-invalid" ?> <?= @!$_SESSION['values']['upload_image'] ?: "is-valid" ?>" name="upload_image" id="upload_image" aria-describedby="fileHelp">
                                <small id="fileHelp" class="form-text text-muted">Please upload your profile image</small>
                                <div class="invalid-feedback"><?= @$_SESSION['errors']['upload_image'] ?></div>
                            </div>
                            <input type="submit" class="btn btn-block btn-success" name="submit_registration" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>