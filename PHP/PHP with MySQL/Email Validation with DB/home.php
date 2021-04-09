<?php
require("db.php");
session_start();
if(!isset($_SESSION['user'])) {
    header("Location: .");
    exit();
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$query = "SELECT * FROM users";
$result = $connection->query($query);
$users = $result->fetch_all(MYSQLI_ASSOC);


?>

<?php include "header.php"; ?>
<?php include "nav.php"; ?>
<div class="container-fluid pt-5">
    <div class="row">
        <div class="col-md-9 mx-auto">
            <?php if (@$_SESSION['delete_user']): ?>
                <div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <h4 class="alert-heading">Deleted!</h4>
                    <p class="mb-0">The record of <?= $_SESSION['delete_user']['name'] ?> has been deleted!</p>
                </div>
            <?php endif; ?>
            <h3>Welcome <?= $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'] ?></h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user): ?>
                        <tr>
                            <td><?= $user['user_id']; ?></td>
                            <td><?= $user['email']; ?></td>
                            <td><?= $user['first_name']; ?></td>
                            <td><?= $user['last_name']; ?></td>
                            <td><?php
                            $date = new DateTime($user['created_at']);
                            echo $date->format('m/d/y h:i:s');
                            
                            ?></td>
                            <td>
                                <?php if($_SESSION['user']['user_id'] !== $user['user_id']): ?>
                                    <form action="process.php" method="POST">
                                        <input type="hidden" name="user_id" value="<?= $user['user_id']; ?>">
                                        <input type="hidden" name="name" value="<?= $user['first_name'] .' ' . $user['last_name']; ?>">
                                        <input type="submit" value="Delete" name="delete" class="btn btn-danger btn-sm">
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php unset($_SESSION['delete_user']); ?>
<?php include "footer.php"; ?>