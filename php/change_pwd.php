<?php
session_start();
require("db/db_connection.php");

$userid = $_POST["userid"];
$old_password = $_POST["old_password"];
$new_password = md5($_POST["new_password_02"]);


// validate the authorization
$mysql_query = "SELECT * FROM user WHERE userid = {$userid} AND password = md5({$old_password})";
$result = $db->query($mysql_query);
if($result->num_rows > 0){
    $validation = true;
}else{
    $msg = "The old password is incorrect.<br>
            <a class='btn btn-error' href='index.php'>Click Me</a> to return your start page.";
    $db_error = $db->error;
    header("location: ../error_page.php?msg={$msg}&db_error={$db_error}");
    die();
}

if($validation){
    $mysql_query = "UPDATE user SET password = '{$new_password}' WHERE userid = {$userid}";
    $result = $db->query($mysql_query);
    if(!$result){
        $msg = "Failed to update the password!<br>";
        $db_error = $db->error;
        header("location: ../error_page.php?msg={$msg}&db_error={$db_error}");
        die();
    }else{
        $msg = "Your account password had been updated.<br>
                <a class='btn btn-success' href='index.php'>Click Me</a> to return your start page.";
        header("location: ../success_page.php?msg={$msg}");
        die();
    }
}
?>
