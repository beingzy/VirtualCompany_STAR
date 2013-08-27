<?php
session_start();
require("db/db_connection.php");

if(isset($_POST['title'])){
    $title = mysql_real_escape_string($_POST['title']);
}else{
    $title = 'Untitled Project';
}
$department = mysql_real_escape_string ($_POST['department']);
$textbody = mysql_real_escape_string($_POST['textbody']);
$userid = $_SESSION['userid']; // not defined by post form
$deadline = $_POST['deadline']; // not defined by post form

AddProject($db, $userid, $title, $department, $bodytext, $deadline);

function AddProject($db, $userid, $title, $department, $textbody, $deadline)
{
    $sql_query = "
        insert into project(userid, created, modified, title, department, 
        textbody, deadline) VALUES('".$userid."', now(), now(),'". $title . "', '" .
        $department. "','" . $bodytext . "','".$deadline."')";
    $result = $db->query($sql_query);
    if(!$result){ 
        $msg = "Failed to create a new project!";
        $db_error = $db->error; 
        header("location: ../error_page.php?msg={$msg}&db_error={$db_error}");
        die();
    }else{
        $msg = "The project had been created.<br>";
        // get the projectid of newly created project
        $newprojectid = mysql_insert_id($db);
        if(isset($newprojectid)){
            $msg .= "<a href='ProjectPage.php?projectid={$newprojectid}'> Click </a> to the project prage.";
        }
        header("location: ../success_page.php?msg={$msg}");
        die();
    }
}

$db->close();
?>
