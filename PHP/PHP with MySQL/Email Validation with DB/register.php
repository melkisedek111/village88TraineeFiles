<?php
session_start();


?>

<?php include "header.php"; ?>
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h1>Registration</h1>
                    </div>
                    <div class="card-body">
                        <form action="process.php" method="POST" enctype="multipart/form-data">
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
                            <input type="submit" class="btn btn-block btn-success" name="submit_registration" value="Submit">
                            <a href="./" class="btn btn-primary btn-block">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
    $_SESSION['registered'] = false;
    $_SESSION['errors'] = [];
    $_SESSION['values'] = [];
?>
<?php include "footer.php"; ?>
