<?php
    /*
    Script for update record from X-editable.
    */

    //delay (for debug only)
    require "db/db_connection.php";

    /*
    You will get 'pk', 'name' and 'value' in $_POST array.
    */
    $pk = $_POST['pk'];
    $name = $_POST['name'];
    $value = $_POST['value'];
    /*
     Check submitted value
    */
    if(isset($_POST))
    {
        switch($name)
        {
            case "feedback":
                $mysql_query = "UPDATE team_info SET feedback = '".$value."' WHERE teamid = ".$pk;
                $result = $db->query($mysql_query);
                if($result)
                {
                    header('HTTP 200 Good Request..', true, 200);
                    echo "Feedback been submitted and processed.";
                } 
                else 
                {
                    header('HTTP 400 Bad Request', true, 400);
                    echo "Feedback failed to be posted!";
                }
                break;
            case "grade":
                $mysql_query = "UPDATE team SET grade = '".$value."' WHERE teamid =".$pk;
                $result = $db->query($mysql_query);
                if($result)
                {
                    header('HTTP 200 Good Request.', true, 200);
                    echo "Team grade has been posted succesfully.";
                } 
                else 
                {
                    header('HTTP 400 Bad Request', true, 400);
                    echo "Grade failed to be assigned!";
                }
                break;
            case "comment":
                $mysql_query = "UPDATE team_info SET comment = '".$value."' WHERE teamid =".$pk;
                $result = $db->query($mysql_query);
                if($result)
                {
                    header('HTTP 200 Good Request..', true, 200);
                    echo "Comment has been submitted and processed.";
                } 
                else 
                {
                    header('HTTP 400 Bad Request', true, 400);
                    echo "Comment failed to be posted!";
                }
                break;
            case "textbody":
                $mysql_query = "UPDATE team SET textbody = '{$value}' WHERE teamid = {$pk}";
                $result = $db->query($mysql_query);
                if($result)
                {
                    header('HTTP 200 Good Request..', true, 200);
                    echo "Solution description has been submitted and processed.";
                } 
                else 
                {
                    header('HTTP 400 Bad Request', true, 400);
                    echo "Solution description failed to be posted!";
                }
                break;
            default :
                break;
        }
    }else{
        echo "No data was submitted.";
    }       

?>