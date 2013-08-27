<?php
require "db/db_connection.php";
echo "Link is established";
if(isset($_POST['submit']) and isset($_POST['projectid'])){
    // retract ProjectID
    $projectid = $_POST['projectid'];
    // get the maxium of assigned teamid
    $mysql_query = "SELECT MAX(teamid) AS max_teamid FROM team";
    $result = $db->query($mysql_query);
    if($result){
        while($row = $result->fetch_assoc()){
            $max_used_teamid = $row['max_teamid'];
        }
    }else{
        echo "Error: Failed to find maximum of assigned teamid.";
    }
    echo $db->error."<br>";
    //$new_teamid = [];
    // 
    foreach($_POST['submit'] as $value){
        // looping through team and userid
        $insert_teamid = $value['team']+ $max_used_teamid;
        // store newly added teamid
	// $new_teamid[] = $insert_teamid;
         $userid = $value['userid'];
	 $mysql_query = "INSERT INTO team(teamid, projectid, userid) 
                        VALUES({$insert_teamid}, {$projectid}, {$userid})";
        $result = $db->query($mysql_query);
        if(!$result){
            echo "<div class='alert alert-error'>Error! Failed to assign the user 
                (ID: {$userid}) into the project (ID: {$projectid}).</div>";
        }
    }
    // distinct newly created teams' teamid
    //$new_teamid = array_unique($new_teamid);
    // initiate team accessory tables:
    //foreach($new_teamid as $teamid){
    //	echo "teamid: {$teamid}";
    //}
    echo "<div class='alert alert-success'>The teams had been created.</div>";
}else{
    echo "<div classs='alert alert-error'><strong>Error!</strong>The submitted data is not complete.
         ";
}
//echo $msg;
?>
