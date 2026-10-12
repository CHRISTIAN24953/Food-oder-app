<?php
// Start Session only if not already started
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

//Create Constants to Store Non Repeating Values
define('SITEURL', 'http://localhost/Food-Order/');
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'food_order');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));
?>

