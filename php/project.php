<?php


// add a project
function AddProject($db, $userid, $title, $department, $bodytext, $deadline)
{
    $sql_query = "
        insert into project(userid, created, modified, title, department, 
        textbody, deadline) VALUES('".$userid."', now(), now(),'". $title . "', '" .
        $department. "','" . $bodytext . "','".$deadline."')";
    $result = $db->query($sql_query);
    if(!$result){ die("Failed to create a new project! Error code: ".$db->error); };
    $result->free();
}

// remove a project
function RemoveProject($db, $projectid){
    $sql_query = "delete from project where projectid = ".$projectid;
    $result = $db->query($sql_query);
    if(!$result){ die("Failed to create a new project! Error code: ".$db->error); };
    $result->free();
}

// display a project
function DisplayProject($db, $projectid)
{
    $sql_query = "select * from project where projectid = ". $projectid;
    $result = $db->query($sql_query);
    if(!$result){die("No project with submitted ProjectID can not be found in Database;");}
    else{
        while($row = $result->fetch_assoc())
         {
                $output .= "<div class='project'>
                    <h1>". $row['title']. "</h1><br>
                    <h3>". $row['department']. " :</h3><br>
                    <h5>". $row['created']. " ;</h5>
                    <h5>and ". $row['modified']. ";</h5>
                    <h5><i>". $row['deadline']. ":</i></h5>
                    <hr><div class='project-body'>". $row['textbody']."</div></div>";
                echo $output;
        }
    }
    
    $result->free();   
}
?>
