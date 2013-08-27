<?php

function GetTeamID($db, $userid, $projectid)
{
    // get teamid
    $mysql_query = "SELECT teamid FROM team WHERE userid={$userid} and projectid = {$projectid}";
    $result = $db->query($mysql_query);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $teamid = $row['teamid'];
            $res = $teamid;
        }
    }else{
        $res = "<div class='alert alert-error'>You are not enrolled in any team working on this project.</div>";
    }
    return $res;
}

function GetTeamMember($db, $teamid)
{
    // get all members
    $mysql_query = "SELECT userid FROM teamid = {$teamid}";
    $result = $db->query($mysql_query);
}

function ListDepartmentProjects($db, $departmentname){
    // list all the proejctid of projects in a department
   $mysql_query = "SELECT projectid FROM project WHERE department = '{$departmentname}'";
   $result = $db->query($mysql_query);
   $projectid_array = [];
   if($result){
       while($row = $result->fetch_assoc()){
           $projectid_array[] = $row['projectid'];
       }
   }else{
       echo "<div class='alert alert-error'>No project had been found in your department, otherwise, possible to {$db->error}</div>";
   }
   return $projectid_array;
}

function ListEngineerProjects($db, $userid){
    // retrieve all the projects which engineer is working on
    $mysql_query = "SELECT DISTINCT projectid FROM team WHERE userid = {$userid}";
    $result = $db->query($mysql_query);
    $project_array = [];
    if($result)
    {
        while($row = $result->fetch_assoc())
        {
           $project_array[] = $row['projectid'];
        }
    }
    else
    {
        echo "<div class='alert alert-error'>Failed to pull out your working portfolio, or possible due to: {$db->error}</div>";
    }
    return $project_array;
}
    
    
?>
