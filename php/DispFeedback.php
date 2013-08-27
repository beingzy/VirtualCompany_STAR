<?php
    require("db/db_connection.php");
    
    $teamid = $_POST['teamid'];
    $role   = $_POST['role'];
    //echo "role: {$role}";
    if(isset($role)){
        // ensure $role data had been received
        switch($role){
            // generate query based on role
            case 'consultant':
             $mysql_query = "SELECT textbody, datetime 
                    FROM consultant_feedback
                    WHERE teamid = {$teamid}
                    ORDER BY datetime DESC";
                break;
            case 'director':
             $mysql_query = "SELECT textbody, datetime 
                    FROM director_feedback
                    WHERE teamid = {$teamid}
                    ORDER BY datetime DESC";
                break;
            default:
                break;
        }
   
        $result = $db->query($mysql_query);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $textbody = $row['textbody'];
                $datetime = $row['datetime'];
                echo "<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>x</button>
                    <strong>{$textbody}</strong>
                    <span class='pull-right'>{$datetime}</span></div>";
            }
        }else{
            echo "<div class='alert alert-error'>No feedback or error: {$db->error}</div>";
        }
    }else{
        echo "<div class='alert alert-error'>The information which you submitted is not complete for retrieving data.</div>";
    }
?>
