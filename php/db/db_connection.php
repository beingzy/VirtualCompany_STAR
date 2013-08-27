<?php
// MySQL database connection
session_start();
//if($_SESSION['login']){
$db_hostname = "localhost";
$db_username = "root";
$db_password = "8233156";
$db_database = "mockup_db";

$db = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if($db->connect_errno > 0) die("Unable to connect to database: ". $db->connect_error);

//}else{
//    echo "Sorry, you did not have the authroization of sending this commandment!";
//}
?>
