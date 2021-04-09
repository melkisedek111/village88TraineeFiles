<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '@Admin123'); //set DB_PASS as 'root' if you're using mac
define('DB_DATABASE', 'hackerhero_practice'); //make sure to set your database
//connect to database host
$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
echo "<pre>";
var_dump($connection);

