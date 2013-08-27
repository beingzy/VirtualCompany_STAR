<?php
require("db/db_connection.php");
if(isset($_POST['fileid']))
{
    $fileid = intval($_POST['fileid']);
    // validate file id
    $sql_query = "select * from file where fileid = {$fileid}";
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
        $sql_query = "delete from file where fileid = {$fileid}";
        $result = $db->query($sql_query);
        if($result)
        {
            echo "Selected file(s) had been deleted!";
            //header("location: ../success_page.php?msg={$msg}");
            //die();
        }  else {
            echo "Failed to remove the selected file(s).<br>";
            echo $db->error;
            //header("location: ../error_page.php?msg={$msg}&db_error={$db_error}");
            //die();
        }
    }
}else{
    echo "No file had been specified for deletion!<br>";
    //header("location: ../error_page.php?msg={$msg}");
    //die();
}
?>
