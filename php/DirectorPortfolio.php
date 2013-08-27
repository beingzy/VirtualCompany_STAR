<?php 
session_start();
require "db/db_connection.php";
$userid = $_SESSION['userid'];
$department = $_SESSION['department'];
echo "<div class=well>userid:{$userid}<br> department: {$department}</div>";

$mysql_query = "SELECT projectid, title, created, deadline FROM project WHERE department = '{$department}'";
$result = $db->query($mysql_query);
if($result){
    $output = '<div class="tabbable" style="margin-bottom: 18px;"><ul class="nav nav-tabs" id="myPortfolio">';
    while($row = $result->fetch_assoc()){
        $title = $row['title'];
        $projectid = $row['projectid'];
        $output .= '<li class=""><a href="#tab{$projectid}" data-toggle="tab">{$title}</a></li>';
        $tab_count = $tab_count + 1;
    }
    $output .= '</ul>';
    $output .= '<div class="tab-content" style="padding-bottom: 9px; border-bottom: 1px solid #ddd;">';
    $tab_count = 1;
    while($row = $result->fetch_assoc()){
        
        $output .= '
            <div class="tab-pane" id="tab{$tab_count}">
             <?php 
                    $_get["projectid_view"] = {$projectid};
                    include("php/DispTeam4Director.php"); 
               ?>
            </div>';
    }
    $output .= "</div></div>"; // div closed tag for "tab-content"
    $output .= '<script>$("#myPortfolio a:first").tab("show");</script>';
    echo $output;
}
else
{
    echo "<div class='alert alert-error'>You do not have projects in your portfolio. due to {$db->error}</div>";
}
?>