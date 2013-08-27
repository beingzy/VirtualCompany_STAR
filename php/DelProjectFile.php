<?php
require("db/db_connection.php");

if(isset($_GET['id']))
{
    $id = intval($_GET['id']);
    if(isset($_GET['projectid'])){
        $projectid = $_GET['projectid'];
    }
    // validate file id
    $sql_query = "select * from project_file where fileid = $id";
    $tmp_result = $db->query($sql_query);
    // Make sure the ID is in fact a valid ID
    if($tmp_result->num_rows == 0) 
    {
        die('No file had been found.');
        // free data
        $tmp_result->free();
    }
    else
    {
        $tmp_result->free();
        $sql_query = "delete from project_file where fileid = $id";
        $result = $db->query($sql_query);
        if($result)
        {
            $msg = "Selected file(s) had been deleted!";
            $msg .= '<a class="btn btntoprev" href="ProjectPage.php?projectid='.$projectid.'">click</a> to return to the project page.';
            header("location: ../success_page.php?msg={$msg}");
            die();
        }  else {
            $msg = "Failed to remove the selected file(s).<br>";
            $msg .= '<a class="btn btntoprev" href="ProjectPage.php?projectid='.$projectid.'">click</a> to return to the project page.';
            $db_error = $db->error;
            header("location: ../error_page.php?msg={$msg}&db_error={$db_error}");
            die();
        }
        $db->close();
    }
}else{
    $msg = "No file had been specified for deletion!<br>";
    header("location: ../error_page.php?msg={$msg}");
    die();
}
?>
