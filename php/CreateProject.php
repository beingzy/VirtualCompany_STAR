<?php
session_start();
require("db/db_connection.php");

// collect the creator's information
$userid          = $_SESSION['userid'];
$user_role       = $_SESSION['role'];
$user_department = $_SESSION['department'];
// load the project content and information
if(isset($_POST['title'])){
    $title = mysql_real_escape_string($_POST['title']);
}else{
    $title = 'Untitled Project';
}
$department = mysql_real_escape_string($_POST['department']);
$textbody   = mysql_real_escape_string($_POST['textbody']);
$deadline   = $_POST['deadline'];

// load database connection (object: $db)
require "db/db_connection.php";

$mysql_query = "INSERT INTO project(userid, created, title, department, textbody, deadline) 
                VALUES({$userid}, NOW(), '{$title}', '{$department}', '{$textbody}', '{$deadline}')";

$result = $db->query($mysql_query);

    if($result){
        $msg = "A new project had been created.<br>";
        // get the projectid of newly created project
        $newprojectid = mysql_insert_id($db);
        if(isset($newprojectid)){
            $msg .= "<a href='ProjectPage.php?projectid={$newprojectid}'> Click </a> to the project prage.";
            header("location: ../success_page.php?msg={$msg}");
            die();
        }
        $msg = "Project had been created.";
        header("location: ../success_page.php?msg={$msg}");
        die();
    }else{
        $msg = "Failed to create a new project!";
        $db_error = $db->error; 
        header("location: ../error_page.php?msg={$msg}&db_error={$db_error}");
        die();
    }
                   
?>
