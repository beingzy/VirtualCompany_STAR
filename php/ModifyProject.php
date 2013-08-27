<?php
require("db/db_connection.php");

$projectid = $_POST['projectid'];
echo "proejctid: {$projectid}";
$title = mysql_real_escape_string($_POST['title']);
$department = mysql_real_escape_string ($_POST['department']);
$textbody = mysql_real_escape_string($_POST['textbody']);
$userid = 3; // not defined by post form
$deadline = $_POST['deadline']; // not defined by post form

AddProject($db, $projectid, $title, $department, $textbody, $deadline);

function AddProject($db, $projectid, $title, $department, $textbody, $deadline)
{
    $sql_query = "
        UPDATE project
        SET 
        modified   = NOW(),
        title      = '{$title}',
        department = '{$department}',
        textbody   = '{$textbody}',
        deadline   = '{$deadline}'
        WHERE projectid = {$projectid}";
    $result = $db->query($sql_query);
    if(!$result)
    { 
        $msg = "Failed to modify a new project!<br>";
        $db_error = $db->error;
        header("location: ../error_page.php?msg={$msg}&db_error={$db_error}");
        die();
    }
    else{
        $msg = "Project had been modified successfully. <a class='btn btn-success' 
            href='ProjectPage.php?projectid={$projectid}'> Return </a> to the project page ";
        header("location: ../success_page.php?msg={$msg}");
        die();          
    }
}

$db->close();
?>
