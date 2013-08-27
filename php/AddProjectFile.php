<?php
// activate access to $_SESSION
session_start();
if(!isset($db)){
    // load $db link
    require("db/db_connection.php");
}
// retrieve user information
$userid         = $_SESSION['userid'];
$projectid      = $_POST['projectid'];
$projectPageURL = $_POST['projectPageURL'];

// Check if a file has been uploaded
if(isset($_FILES['uploaded_file']))
{
    if($_FILES['uploaded_file']['error'] == 0)
    {
       // retrieve all uploaded data
        $name = $db->real_escape_string($_FILES['uploaded_file']['name']);
        $mime = $db->real_escape_string($_FILES['uploaded_file']['type']);
        $data = $db->real_escape_string(file_get_contents($_FILES['uploaded_file']['tmp_name']));
        $size = intval($_FILES['uploaded_file']['size']);       
        // restriction 
        if($size  <= 20 * 1024* 1024)
        {
            // Create the SQL query
            $sql_query = "
            INSERT INTO project_file (
                userid, projectid, created, name, mime, size, content
            )
            VALUES ({$userid}, {$projectid}, NOW(), '{$name}', '{$mime}', '{$size}', '{$data}')";
            
            
            // Execute the query
            $result = $db->query($sql_query);
            // Check if it was successfull
            if($result)
            {
                $msg = 'Success! Your file was successfully added!<br>
                      <a class="btn btntoprev" href="ProjectPage.php?projectid='.$projectid.'">click</a> to return to the project page.';
                header("location: ../success_page.php?msg={$msg}");
                die();
            }
            else
            {
                $msg = "Failed to add the selected file(s).<br>";
                $db_error = $db->error;
                header("location: ../error_page.php?msg={$msg}&db_error={$db_error}");
                die();
            }
        }
        else
        {
            $msg = "Only files which is less than 20MB in size can be uploaded to our server!";
            $db_error = $db->error;
            header("location: ../error_page.php?msg={$msg}&db_error={$db_error}");
            die();
        }
    }
    else
    {
        $msg = 'An error accured while the file was being uploaded. ';
        $db_error = $db->error;
        header("location: ../error_page.php?msg={$msg}&db_error={$db_error}");
        die();
    }
 
    // Close the mysql connection
}
else
{
    $msg = "Error! A file was not sent!<br>";
    $db_error = $db->error;
    header("location: ../error_page.php?msg={$msg}&db_error={$db_error}");
    die();
}
 
?>
 