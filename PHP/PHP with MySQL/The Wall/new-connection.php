<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '@Admin123'); //set DB_PASS as 'root' if you're using mac
define('DB_DATABASE', 'db_app'); //make sure to set your database
//connect to database host
$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

function add_data($posts, $table, $lastId = false) {
    global $connection;
    $query = "INSERT INTO $table(";
    foreach($posts as $key => $_) {
        $query .= "$key,";
    }
    $query = rtrim($query, ",") . ") VALUES(";
    foreach($posts as $_ => $values) {
        $query .= "'".$connection->real_escape_string($values)."',";
    }
    $query = rtrim($query, ",") . ")";
    $result = $connection->query($query);
    
    if($result) {
        if($lastId) {
            return $connection->insert_id;
        } else {
            return true;
        }
    } else {
        var_dump($connection->error);
        die;
    }
}
function select_data($table, $columns, $misc = "") {
    global $connection;
    $selected = "";
    if(is_array($columns)) {
        foreach($columns as $column) {
            $selected .= "$column,";
        }
    } elseif($columns === "*") {
        $selected = "*";
    }
    $selected = rtrim($selected, ",");
    $query = "SELECT $selected FROM $table $misc";
    $result = $connection->query($query);
    return $result->fetch_assoc();
}

function select_all_data($table, $columns, $misc = "") {
    global $connection;
    $selected = "";
    if(is_array($columns)) {
        foreach($columns as $column) {
            $selected .= "$column,";
        }
    } elseif($columns === "*") {
        $selected = "*";
    }
    $selected = rtrim($selected, ",");
    $query = "SELECT $selected FROM $table $misc";
    $result = $connection->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
}

function delete_data($table, $condition) {
    global $connection;
    $query = "DELETE FROM $table $condition";
    if($connection->query($query)) {
        return true;
    } else {
        return false;
    }
}

function d($d) {
    echo "<pre>";
    var_dump($d);
    die;
};