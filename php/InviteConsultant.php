<?php
require "db/db_connection.php";

$projectid = $_POST['projectid'];

function isAdded($userid, $projectid, $db){
    // check if this record exists.
    $mysql_query = "SELECT * FROM consultant_profile 
                    WHERE projectid = {$projectid}
                    AND userid = {$userid}";
    $result = $db->query($mysql_query);
    $output = FALSE;
    if($result->num_rows > 0){
        $output = TRUE;
    }else{
        $output = FALSE;
    }
    return $output;
}

if(isset($_POST['SelectedConsultant'])){
    foreach($_POST['SelectedConsultant'] as $consultant){
       $userid = $consultant;
       $had_record = isAdded($userid, $projectid, $db);
       if(!$had_record){
           // if no consultant had not been assigned to consulting this project
          $mysql_query = "INSERT INTO consultant_profile(userid, projectid)
                            VALUES({$userid}, {$projectid})";
          $result = $db->query($mysql_query);
          //if($result){
              //
          //}
      }
    }
}

echo "Data is submitted successfully!.";

?>
