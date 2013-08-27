<?php
if(!isset($db)){
    require "php/db/db_connection.php";
}

// receive the projectid
$projectid=$_GET['projectid'];
if(!isset($projectid)){
    die("<div class='alert alert-error'>Projectid is not provided.</div>");
}

if(isset($_POST['consultant'])){
    foreach($_POST['consultant'] as $checked){
        $mysql_query = "UPDATE consultant VALUES ({$checked['userid']}, {$projectid})";
        $result = $db->query($mysql_query);
        if($result){
            echo "<div class='alert alert-success'>The consultant, <strong>userid {$checked['userid']}</strong>.
                   had been added to this project.</div>";
        }else{
            echo "<div class='alert alert-error'>The consultant, <strong>userid {$checked['userid']}</strong>.
                   failed to be added to this project.</div>";
        }
    }
}else{
    echo "<div class='alert alert-error'>Eorror! No consultant had been selected.</div>";
}
?>
