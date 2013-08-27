<?php
// activate access to $_SESSION
session_start();
if(!isset($db)){
    // load $db link
    require("db/db_connection.php");
}
// retrieve user information
$userid         = $_SESSION['userid'];
// uploaded auxillary information
$projectid      = $_POST['projectid'];
$projectPageURL = $_POST['projectPageURL'];


// get teamid based on $userid and $projectid
if(isset($_POST['projectid'])){
    $mysql_query = "SELECT teamid FROM team WHERE userid={$userid} and projectid = {$projectid}";
    $result = $db->query($mysql_query);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $teamid = $row['teamid'];
        }
    }else{
        echo "<div class='alert alert-error'>You are not enrolled in any team working on this project.</div>";
    }
    $result->free();
}

echo "{$mysql_query}<br>";
echo "userid is: {$userid}<br>";
echo "teamid is: {$teamid}<br>";
echo "Project Page's URL: {$_POST['projectPageURL']}<br>";
echo "_POST is:<br>";
print_r($_POST);
echo "<br>";
echo "_FILES is:<br>";
print_r($_FILES);

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
            INSERT INTO file (
                userid, teamid, created, name, mime, size, content
            )
            VALUES ({$userid}, {$teamid}, NOW(), '{$name}', '{$mime}', '{$size}', '{$data}')";
            // Execute the query
            $result = $db->query($sql_query);
            // Check if it was successfull
            if($result)
            {
                $msg = 'Your file was successfully added!';
                $msg .= '<a class="btn btntoprev" href="ProjectPage.php?projectid='.$projectid.'">click</a> to return to the project page.';
                header("location: ../success_page.php?msg={$msg}");
        die();
            }
            else
            {
                $msg = "Failed to add the selected file(s).<br>";
                $msg .= '<a class="btn btntoprev" href="ProjectPage.php?projectid='.$projectid.'">click</a> to return to the project page.';
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
 