<?php
function ProjectSideNav($db, $department){
// load DB connection (object: $db);
require "db/db_connection.php";

$mysql_query = "SELECT projectid, title FROM project 
                WHERE department = '{$department}'
	         ORDER BY created DESC";

$result = $db->query($mysql_query);

if($result)
{
    $output = '<div class="bs-docs-sidebar"><div class="side-nav"><ul class="nav nav-tabs nav-stacked pull-left" style="width:100%">';
    while($row = $result->fetch_assoc())
    {
       $output .= "<li ><a href='ProjectPage.php?projectid={$row['projectid']}'>{$row['title']}<i class='icon-chevron-right pull-right'></i></a></li>";
    }
    $output .= '</ul></div></div>';
}else
{
   $output = "No project had been found.";
}
    return $output;
}
?>
