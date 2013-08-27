<?php
function ListSolution($db, $userid, $projectid)
{
// get teamid based on $userid and $projectid
    $output = "";
    $mysql_query = "SELECT teamid FROM team WHERE userid={$userid} and projectid = {$projectid}";
    $result = $db->query($mysql_query);
    if($result){
        $ans = $result->fetch_assoc();
        $teamid = $ans['teamid'];
        $ans->free();
    }else{
        $ouput .= "<div class='alert alert-error'>Failed to find the teamid based on the combiantion of userid:{$userid} and projectid:{$projectid}.</div>";
    }
    $result->free();

// Query for a list of all existing files
$mysql_query = "SELECT fileid, userid, created, name, mime, size FROM file
              WHERE teamid = {$teamid} ORDER BY created DESC";
$result = $db->query($mysql_query);
// Check if it was successfull
    if($result)
    {
        // Make sure there are some files in there
        if($result->num_rows == 0)
        {
            echo '<p>There are no files in the database</p>';
        }
        else
        {
        // Print the top of a table
            $output.= '<table class="table table-condensed table-bordered" width="100%">
                <thead><tr>
                    <td><b>Owner (user id)</b></td>
                    <td><b>Name</b></td>
                    <td><b>Created</b></td>
                    <td><b>&nbsp;</b></td>
                </tr></thead>
                <tbody>';
        // Print each file
            while($row = $result->fetch_assoc())
            {
             $output.= "
                <tr>
                    <td>{$row['userid']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['created']}</td>
                    <td>
                        <div class='btn-group'>
                            <a class='btn' href='php/GetFile.php?id={$row['fileid']}'><i class='icon-download-alt'></i>&nbsp;Download</a>
                            <a class='btn' href='php/DelFile.php?id={$row['fileid']}'><i class='icon-trash'></i>&nbsp;Delete</a>
                        </div>
                    </td>     
                </tr>";
            }
        // Close table
            $output.= '</tbody></table>';
        }
    }
    else
    {
        $output.= "Failed to pull out the data for error(s): <pre>{$db->error}</pre>";
    }
    return $output;
}
?>