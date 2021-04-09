<?php
session_start();
if(isset($_SESSION['user'])) {
    header("Location: home.php");
    exit();
}

?>

<?php include "header.php"; ?>

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
            <?php if (@$_SESSION['login_errors'] === true): ?>
                <div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h4 class="alert-heading">Attention!</h4>
                    <p class="mb-0">Your email and password does not matched!</p>
                    <p class="mb-0">Please try again!</p>
                </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-header">
                    <h1>Login</h1>
                </div>
                <div class="card-body">
                    <form action="process.php" method="POST">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control <?= @$_SESSION['login_errors'] ? "is-invalid" : "" ?>" name="email" id="email" placeholder="Enter your email"
                            >
                            <div class="invalid-feedback"><?= @$_SESSION['login_errors']['email'] ?></div>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control <?= @$_SESSION['login_errors'] ? "is-invalid" : "" ?>" name="password" id="password" placeholder="Enter your password">
                            <div class="invalid-feedback"><?= @$_SESSION['login_errors']['password'] ?></div>
                        </div>
                        <div class="form-group ">
                            <input type="submit" name="login" value="Login" class="btn btn-block btn-success">
                            <a href="register.php" class="btn btn-block btn-danger">Register</a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>    
<?php $_SESSION['registered'] = false; ?>
<?php $_SESSION['login_errors'] = []; ?>
<?php include "footer.php"; ?>
