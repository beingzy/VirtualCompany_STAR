<?php
session_start();
require("db/db_connection.php");
// collect information
 
// Query for a list of all existing files
$sql_query = "SELECT fileid, userid, created, name, mime, size FROM file
              WHERE teamid = 
             (SELECT teamid FROM team WHERE userid = {$userid} AND projectid = {$projectid})";
$result = $db->query($sql_query);
 
// Check if it was successfull
if($result->num_rows > 0)
{
       // Print the top of a table
        echo '<table class="table table-condensed table-bordered" width="100%">
                <thead>
                <tr>
                    <td><b>Owner (user ID)</b></td>
                    <td><b>File Name</b></td>
                    <td><b>Submitted</b></td>
                    <td><b>&nbsp;</b></td>
                </tr></thead>
                <tbody>';
 
        // Print each file
        while($row = $result->fetch_assoc())
        {
            echo "<tr>
                    <td>{$row['userid']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['created']}</td>
                    <td>
                        <div class='btn-group'>
                            <a class='btn btn-success' href='php/GetFile.php?id={$row['fileid']}'><i class='icon-download-alt'></i>&nbsp;Download</a>
                            <a href='#confirm_popup' class='btn btn-warning btn-del' role='button' data-toggle='modal' data-fileid='{$row['fileid']}'>
                                <i class='icon-trash'></i>&nbsp;Delete</a>
                        </div>
                    </td>     
                </tr>";
        }
            
        echo '<div id="confirm_popup" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                <div class="var_container"></div>
                <div class="modal-body">
                    <p><strong>Are you sure to remove the selected file from team\'s project solution?</strong></p>
                    <div id="feedback-info"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn">Cancel</button>
                    <button id="confirm_btn" type="button" class="btn btn-danger btn-del">Confirm</button>
                </div>
               </div>';
        
        // Close table
        echo '</tbody></table>';
?>
<script>
// select a div for storing values which can be passed through multiple events
// for detail chekcing jQuey.data();
var div = $("#var_container");

$(".btn-del").click(function(){
    // delte button define the fileid value
    jQuery.data(div, "fileid", $(this).data("fileid"));
});  
    
$("#confirm_btn").click(function(){
    // retrieve the selected file's fileid from the container.
    var $fileid = jQuery.data(div, "fileid");
    $("#feedback-info").addClass("alert").text("clicked");
    $.ajax({
        type: "POST",
        url: "php/DelFile.php",
        data: {fileid: $fileid},
        success: function(msg){
            $("#feedback-info").addClass("alert").addClass("alert-success").text(msg);
        }
   })
});
    
</script>
<?php
            
         
}
else
{
     echo '<div class="alert alert-info">Your team did not submit any solutions.</div>';
}
$result->free();
// Close the mysql connection
$db->close();
?>