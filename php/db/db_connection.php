<?php
// MySQL database connection
session_start();
//if($_SESSION['login']){
$db_hostname = "localhost"; // for local database on the server
$db_username = "username"; // database user name, mysql default username is root
$db_password = "password"; // password
$db_database = "database"; // database for virtual company

$db = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if($db->connect_errno > 0) die("Unable to connect to database: ". $db->connect_error);

//}else{
//    echo "Sorry, you did not have the authroization of sending this commandment!";
//}
?>
