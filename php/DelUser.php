<?php
require("db/db_connection.php");

$userid = $_POST["userid"];
$is_Deleted = FALSE;
// delete record in user;
$mysql_query = "DELETE FROM user WHERE userid = {$userid}";
$result = $db->query($mysql_query);
if($result){
    $is_Deleted = TRUE;
}else{
    $is_Deleted = FALSE;
}
// delete record in team;
$mysql_query = "DELETE FROM user WHERE userid = {$userid}";
$result = $db->query($mysql_query);
if($result){
    $is_Deleted = TRUE; // simplied version for avoiding reporting error 
                        // for user of no team
    // $is_Deleted = TRUE and $is_Deleted;
}else{
    $is_Deleted = FALSE;
}

if($is_Deleted){
    echo "User (ID: {$userid}) had been deleted!";
}else{
    echo "Failed to delete user (ID: {$userid})!";
}
?>
