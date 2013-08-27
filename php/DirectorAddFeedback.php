<?php
include "db/db_connection.php";

$userid   = $_POST['userid'];
$textbody = $_POST['textbody'];
$teamid   = $_POST['teamid'];

$mysql_query = "INSERT INTO director_feedback(teamid, userid, textbody, datetime)
                VALUES ({$teamid}, {$userid}, '{$teamdi}', NOW())";
$result = $db->query($mysql_query);
if($result){
    // succeed in sending the feedback
}else{
    // failed to seend the feedback
}

?>
