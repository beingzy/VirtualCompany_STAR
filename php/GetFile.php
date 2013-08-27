<?php
require("db/db_connection.php");

if(isset($_GET['id'])){
    // Get the ID
    $id = intval($_GET['id']);
    // validate file id
    $sql_query = "select * from file where fileid = $id";
    $tmp_result = $db->query($sql_query);
    // Make sure the ID is in fact a valid ID
    if($tmp_result->num_rows == 0) 
    {
        die('The file is not found by its ID.');
        // free data
        $tmp_result->free();
    }
    else
    {
        // free data
        $tmp_result->free();
        // Fetch the file information
        $sql_query = "
            SELECT mime, name, size, content
            FROM file
            WHERE fileid = $id";
        $result = $db->query($sql_query);
 
        if($result)
        {
            // Get the row
               $row = mysqli_fetch_assoc($result);
 
                // Print headers
                header("Content-Type: ". $row['mime']);
                header("Content-Length: ". $row['size']);
                header("Content-Disposition: attachment; filename=". $row['name']);
                header("Content-created: ". $row['created']);
 
                // Print data
                echo $row['content'];
                // free $result
                $result->free();
        }
        else 
        {
            echo "Failed to pull out the data for error(s): <pre>{$db->error}</pre>";
        }
        // close conncetion to mysql
        $db->close();
    }
}
else {
    echo 'Failed, you did not specify file ID';
}
?>