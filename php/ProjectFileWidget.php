<?php
session_start();
// get necessary information
//$projectid = $_GET['projectid'];

// return user role
$user_role = $_SESSION['role'];

// retreive data
if(!isset($db)){
    require("db/db_connection.php");
}

$mysql_query = "SELECT fileid, name, created FROM project_file 
                WHERE projectid = {$projectid}";
$result = $db->query($mysql_query);
if($result->num_rows > 0){
    // generate HTML table div and define table head
    echo "<div class='well'><table id='file_table' class='table table-bordered'>
        <thead><th>File Name</th><th>Datetime of uploaded</th><th></th>
        </thead><tbody>";
    // fill rows
    while($row = $result->fetch_assoc()){
        $fileid  = $row['fileid'];
        $name    = $row['name'];
        $created = $row['created'];
        echo "<tr><td>{$name}</td><td>{$created}</td><td>";
        if($user_role == "director"){
        // build btn-groups of get and delete for director
            echo "<div class='btn-group'>
                            <a class='btn btn-success' href='php/GetProjectFile.php?id={$row['fileid']}'><i class='icon-download-alt'></i>&nbsp;Download</a>
                            <a class='btn btn-warning' href='php/DelProjectFile.php?id={$row['fileid']}'><i class='icon-trash'></i>&nbsp;Delete</a>
                    </div>";
        }else{
        // build btn for get
            echo "<a class='btn' href='php/GetProjectFile.php?id={$row['fileid']}'><i class='icon-download-alt'></i>&nbsp;Download</a>";
        }                 
                            
        echo   "</td><tr>";
    }
    // close table div
    echo "</tbody></table></div>";
}
?>