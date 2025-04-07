<?php
ob_start(); //Should this be on? I dont know. Turns on output buffering. Good if you host online apparently?

if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
    // session hasn't started
    session_start();
}

/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ns_database');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>