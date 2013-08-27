<?php
session_start();

// collect the creator's information
$userid          = $_SESSION['userid'];
$user_role       = $_SESSION['role'];
$user_department = $_SESSION['department'];

// load the project content and information
$owner_userid = $_POST['userid'];
$projectid    = $_POST['projectid'];
$title        = $_POST['title'];
$department   = $_POST['department'];
$textbody     = $_POST['textbody'];
$deadline     = $_POST['deadline'];

// load database connection (object: $db)
require "db/db_connection.php";

if($userid != $owner_userid){
    echo "Warning: you do not have the authority to modify the project.";
}else{
    $mysql_query = "UPDATE project
                    SET modified   = NOW(),
                        title      = '{$title}',
                        department = '{$department}',
                        textbody   = '{$textbody}',
                        deadline   = '{$deadline}'
                    WHERE projectid = {$projectid}";

    $result = $db->query($mysql_query);
    if($result){
        echo "The project ({$title}) had been modified successfully.";
    }else{
        echo "Failure: the project is not updated with your modification";
    } 
}
      
$mysql_query->free();
$result->free();
$db->close(); 

?>
