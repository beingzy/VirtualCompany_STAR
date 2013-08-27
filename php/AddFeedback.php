<?php
    require("db/db_connection.php");
    session_start();
    $teamid = $_POST['teamid'];
    $userid = $_SESSION['userid'];
    $textbody = $_POST['textbody'];
    $role = $_SESSION['role'];
    
    switch ($role)
    {
       case 'consultant':
        $mysql_query = "INSERT INTO consultant_feedback(teamid, userid, textbody, datetime)
                    VALUES ({$teamid}, {$userid}, '{$textbody}', NOW())";
        $result = $db->query($mysql_query);
        if($result){
            echo "<div class='alert alert-success'>Success: the feedback had been sent!</div>";
        }else{
            echo "<div class='alert alert-success'>Error: the feedback had not been sent! $db->error</div>";
        }
        break;
      case 'director':
        $mysql_query = "INSERT INTO director_feedback(teamid, userid, textbody, datetime)
                    VALUES ({$teamid}, {$userid}, '{$textbody}', NOW())";
        $result = $db->query($mysql_query);
        if($result){
            echo "<div class='alert alert-success'>Success: the feedback had been sent!</div>";
        }else{
            echo "<div class='alert alert-success'>Error: the feedback had not been sent! $db->error</div>";
        }
        break;
      default:
            break;
    }
    
?>
