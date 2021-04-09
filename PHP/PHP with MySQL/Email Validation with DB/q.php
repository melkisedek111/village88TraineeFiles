<?php
require("db.php");

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '@Admin123'); //set DB_PASS as 'root' if you're using mac
define('DB_DATABASE', 'db_app'); //make sure to set your database
//connect to database host
$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);

/*INSERT QUERY*/
$query = "INSERT INTO users(email, first_name, last_name, password, birth_date) VALUES('{$_SESSION['values']['email']}', '{$_SESSION['values']['first_name']}', '{$_SESSION['values']['last_name']}', '{$_SESSION['values']['password']}', '{$_SESSION['values']['birth_date']}')";
$connection->query($query); /*its either int or array ang value*/
$connection->insert_id; /* return nya ung id nung insert mo sa db;*/
$connection->close();
/*SELECT QUERY*/
$query = "SELECT user_id, email, password, first_name, last_name FROM users WHERE email = '{$_POST['email']}' AND password = '{$_POST['password']}' LIMIT 1";
$result = $connection->query($query);
$result->num_rows > 0; /*ung $result->num_rows ang value nya is number*/
$user = $result->fetch_assoc(); /* $result->fetch_assoc() value nya is array na galing sa db*/
$connection->close();
/* DELETE QUERY*/
$query = "DELETE FROM users WHERE user_id = '{$_POST['user_id']}'";
$result = $connection->query($query);


