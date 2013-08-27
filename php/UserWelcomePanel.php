<?php
session_start();
require "db/db_connection.php";

$userid     = $_SESSION['userid'];
$user_role  = $_SESSION['role'];
$department = $_SESSION['department'];
$user_fn    = $_SESSION['fn'];
$user_ln    = $_SESSION['ln'];
$date_today = Date("l") . ", ". Date("M j Y");

switch($user_role)
{
    case 'engineer':
    $mysql_query = "SELECT projectid FROM team
                WHERE userid = {$userid}";

    $result = $db->query($mysql_query);
    if(!$result){
        echo "No data had been found";
    }
    // total number attained
    // tatal number of project in which the user has been enrolled
    $total_projects = $result->num_rows; 
    $add_s = "";
    if($total_projects > 1){
        $add_s = "s";
    }   
    $output = "<p>Hello, {$user_fn} {$user_ln}:</p>
        
               <p>Today is {$date_today}.<br>
               You are an engineer in {$department} department.<br>
               You have been assigned to work on {$total_projects} project".$add_s.".</p>";

    break;
    //***************************************************************
    case "consultant":
    $mysql_query = "SELECT projectid FROM project
                WHERE department = '{$department}'";
    $result = $db->query($mysql_query);
    if(!$result){
        echo "No data had been found, due to ".$db->error;
    }
    $total_projects = $result->num_rows; 
    $add_s = "";
    if($total_projects > 1){
        $add_s = "s";
    }
    $output = "<p>Hello, {$user_fn} {$user_ln}:</p>
        
               <p>Today is {$date_today}.<br>
               You are a consultant of the {$department} department.<br>
               There are {$total_projects} project".$add_s." in your department.</p>"; 
        break;
    //***************************************************************   
    case "director":
    $mysql_query = "SELECT projectid FROM project
                    WHERE userid = {$userid}";
    $result = $db->query($mysql_query);
    if(!$result){
        echo "No data had been found, due to ".$db->error;
    }
    $total_projects = $result->num_rows; 
    $add_s = "";
    if($total_projects > 1){
        $add_s = "s";
    }
    $result->free();
    $output = "<p>Hello, {$user_fn} {$user_ln}:</p>
               
               <p>Today is {$date_today}.<br>
               You are the director of the {$department} department. <br>
               You are managing {$total_projects} project".$add_s.".</p>";     
        break;
    //***************************************************************
    default:
    $output = "<p>Your working portfolio had not been found.<p>";
        break;
}
$result->free();
echo $output;

?>
