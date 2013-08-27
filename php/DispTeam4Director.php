<?php
// retrieve project id
session_start();
$projectid = $_GET['projectid'];
$department = $_SESSION['department'];
// load connection
require("db/db_connection.php");

// load list of consultants;
include "ListProjectConsultant.php";
$consultant_list = ListConsultants($db, $projectid);
echo $consultant_list;

$mysql_query = "SELECT DISTINCT teamid FROM team WHERE projectid={$projectid}";
$result = $db->query($mysql_query);
if($result->num_rows == 0){
        $disp =  "<h5>Dear Director:</h5>
                You do not assign any engineers into working on the project.<br>
                <strong>Do you want to create the teams now?</strong><br>
                If you want to do so,  click";
        $disp .= '<a href="#TeamUI_config_modal" class="btn btn-warning" role="button" data-toggle="modal">Create Teams</a>';
        $disp .= 'to start allocating your human resources.';
        echo $disp;
        // prepare the data for generating Team UI
    $mysql_query = "SELECT COUNT(userid) as tot FROM user   
                WHERE department = '{$department}'
                AND role = 'engineer'";
    $result = $db->query($mysql_query);
    if($result){
        while($row = $result->fetch_assoc()){
            $tot_engineer = $row['tot'];
        }
     }
}else{
    
$result_teamid = $result;

echo "<table class='table table-condensed table-bordered' witdh='100%'> 
            <thead>
                   <tr>
                        <th>Team ID</th>
                        <th>Member(s)</th>
                        <th>Director Feedback</th>
                        <th>Consultant Feedback</th>
                        <th>Grade</th>
                        <th>Solution</th>
                        <th>Description</th>
                    </tr>
             </thead>
             <tbody>";
while($row = $result_teamid->fetch_assoc())
{
    $teamid = $row['teamid'];
    // row starts
    echo "<tr><td>{$row['teamid']}</td>";
    
    // retrive team member information
    $sql_query_members = "SELECT A.userid, A.firstname, A.lastname, A.email, A.phone FROM
                         user AS A JOIN team AS B ON A.userid = B.userid
                         WHERE B.teamid = ".$row['teamid'];
    $result_members = $db->query($sql_query_members);
    if($result_members->num_rows == 0)
    {
        echo "<td>NO member is in the team.</td>";
    }else{
        echo "<td>";
        while($member = $result_members->fetch_assoc())
        {
            echo "<a class='btn btn-small btnTooltip' href='mailto:{$member['email']}' data-toggle='tooltip' data-original-title='Email:{$member['email']} and
                                Phone:{$member['phone']}'><i class='icon-user'></i>&nbsp;{$member['firstname']}&nbsp;{$member['lastname']}</a><br>";
        }
        echo "</td>";
    }
        
    // retrieve team information
    // retrieve feedback information from director
    $mysql_query = "SELECT textbody, datetime FROM director_feedback
                    WHERE teamid = {$row['teamid']}
                    ORDER BY datetime DESC
                    LIMIT 1"; // select the latest feedback
    $result_df = $db->query($mysql_query);
    $msg = "<td>";
    if($result_df->num_rows >= 0){
        $msg .= "<div class='alert alert-success'>";
        while($row_df = $result_df->fetch_assoc()){
            $msg .= "<strong>{$row_df['textbody']}</strong>";
            //$msg .= "<p class='pull-right'>{$row_df['datetime']}</p>";
        }
        $msg .="</div>";
    }else{
        $db_error = $db->error;
        if(!empty($db_error)){
            $msg .= "<div class='alert alert-error' style='width:100%,height:100%'>Error! {$db_error}</div>";
        }else{
            $msg .= "<div class='alert alert-success' style='width:100%,height:100%'>No feedback<div>";
        }
    }
    // add feedback btn group
    $msg .= '<div class="btn-group pull-right">
                <a class="btn btn-mini feedback_add" href="#" data-toggle="popover" data-content="loading..."
                   title data-original-title="Edit feedback" data-teamid="'.$teamid.'" data-role="director"><i class="icon-plus"></i></a>
                <a href="#feedback_modal" class="btn btn-mini btn-success feedback_exp" role="button" 
                    data-toggle="modal" data-teamid="'.$teamid.'" data-role="director"><i class="icon-chevron-right"></i></a>
                </div>';
    $msg .= "</td>";
    echo $msg;
    
     // retrieve feedback information from consultant
    $mysql_query = "SELECT textbody, datetime FROM consultant_feedback
                    WHERE teamid = {$row['teamid']}
                    ORDER BY datetime DESC
                    LIMIT 1"; // select the latest feedback
    $result_cf = $db->query($mysql_query);
    $msg = "<td>";
    if($result_cf->num_rows >= 0){
        $msg .= "<div class='alert alert-info'>";
        while($row_cf = $result_cf->fetch_assoc()){
            $msg .= "<strong>{$row_cf['textbody']}</strong>";
            //$msg .= "<p class='pull-right'>{$row_cf['datetime']}</p>";
        }
        $msg .="</div>";
    }else{
        $db_error = $db->error;
        if(!empty($db_error)){
            $msg .= "<div class='alert alert-error' style='width:100%,height:100%'>Error! {$db_error}</div>";
        }else{
            $msg .= "<div>No feedback<div>";
        }
    }
   // add btngroup
   $msg .= '<div class="pull-right">
                <a href="#feedback_modal" class="btn btn-mini btn-success feedback_exp" role="button" 
                    data-toggle="modal" data-teamid="'.$teamid.'" data-role="consultant"><i class="icon-chevron-right"></i></a>
                </div>';
    $msg .= "</td>";
    echo $msg;
                    
    // retrieve grade
    $mysql_query = "SELECT distinct grade FROM team where teamid = ".$row['teamid'];
    $result_gd = $db->query($mysql_query);
    $result_team_info = $result_gd->fetch_assoc();
    echo '<td><a class="grade editable" href="#" data-type="text" data-pk="'.$teamid.'" >'.$result_team_info['grade'].'</a></td>';
    
    // retrieve solution files
    $mysql_query = "SELECT fileid, name 
                    FROM file
                    WHERE teamid={$row['teamid']}";
    $result_sl = $db->query($mysql_query);

    if($result_sl->num_rows == 0){
        echo "<td>No solution has been submitted.</td>";
    }
    else{
        echo "<td>";
        while($result_solution = $result_sl->fetch_assoc()){   
        echo "<a class='btn btn-small' href='php/GetFile.php?id={$result_solution['fileid']}' width='100%'><i class='icon-file'></i>&nbsp;".$result_solution['name']."&nbsp;<i class='icon-download-alt'></i></a><br>";
    }
        echo "</td>";
    }
    
    // description
    $mysql_query = "SELECT distinct textbody FROM team 
                    WHERE teamid = {$row['teamid']}";
    $result_tb = $db->query($mysql_query);
    if($result_tb->num_rows >= 0){
        while($row_tb = $result_tb->fetch_assoc()){
            echo "<td><div class='alert'>{$row_tb['textbody']}</div></td>";
        }
    }else{
        echo "<td>No description for the solution</td>";
    }
    
    echo  "</tr>";
}

echo "</tbody></table>";

echo '<script type="text/javascript" src="assets/x-editable/js/bootstrap-editable.min.js"></script>        
<script>
    $(".feedback").editable({
        url: "php/ModTeamInfo.php",
        name: "feedback",
        title: "Feedback sent to the engineer team"
        });
    $(".grade").editable({
        url: "php/ModTeamInfo.php",
        name: "grade",
        title: "Numeric evaluation"
        });
</script>';
}

?>

<!-- popover feedback form -->
            <div id="addFeedback_widget" style="position: absolute;top: -9999px;">
                    <div id="data-storage"></div> <!-- important invisible div-->
                    <div id="data-storage-info"></div>
                    <textarea rows="3" id="form_feedback_textbody"></textarea><br>
                    <div id="form_server_return"></div><br>
                    <a class="btn btn-primary pull-right disabled" id="form_feedback_send" style="margin:auto auto 20px auto">Send</a>
                    <script>
                        $("#form_feedback_textbody").keyup(function(){
                            var $textbody = $("#form_feedback_textbody").val();
                            if($textbody.length > 0){
                                // if text is not null enable sending
                                $("#form_feedback_send").removeClass("disabled");
                            }else{
                                $("#form_feedback_send").addClass("disabled");
                            }
                        })
                        $("#form_feedback_send").click(function(){
                            var $teamid = jQuery.data(div, "teamid");
                            var $role   = jQuery.data(div, "role");
                            var $textbody = $("#form_feedback_textbody").val();
                            $.ajax({
                                type:"POST",
                                url:"php/AddFeedback.php",
                                data: {teamid: $teamid, role: $role, textbody: $textbody},
                                success: function(msg){
                                    $("#form_server_return").html(msg);
                                }
                            })
                        })
                    </script>
            </div>
            
            <!-- popup modal -->
            <div id="feedback_modal" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                <div class="var_container"></div>
                <div class="modal-body">
                    <p><strong>Loading...</strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn">Cancel</button>
                    <button id="confirm_btn" type="button" class="btn btn-danger btn-del">Confirm</button>
                </div>
           </div>
            
            <!-- Team UI Configuration modal -->
            <div id="TeamUI_config_modal" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                <div class="var_container"></div>
                <div class="modal-body">
                    <div class="alert">
                        <p>Your department has <strong><?php $tot_engineer; ?></strong>engineers.<br>
                           <strong>Please, indicate the number of teams you want to create for working on this project.
                           </strong>
                        </p>
			</div>
                        <div class="pull-left" style="margin: 20px auto 20px 20px">
                            <form class="pull-left">
                                <input type="text" id="input_tot_team" placeholder="# of teams">
                            </form>
                        </div>
                        <br>
                  </div>
                  <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn">Cancel</button>
                    <a href="#" id="TeamUI_config_btn" class="btn btn-primary" 
                       role="button" data-projectid="<?php echo $projectid;?>">Launch Team UI</a>
                  </div>
            </div>
            
            
       <script>
        // define a data container for passing data among div
        var div = $("#data-storage");
       
        $(".feedback_exp").click(function(){
        // retrieve the selected file's fileid from the container.
            var $teamid = $(this).data("teamid")
            var $role   = $(this).data("role")
            $.ajax({
                    type: "POST",
                    url: "php/DispFeedback.php",
                    data: {teamid: $teamid, role: $role},
                    success: function(msg){
                        $("#feedback_modal").children(".modal-body").html(msg);
                    }
               });
        });
        
        $(".feedback_add").popover({
         // assign div form into popover content
            html:true,
            content: function(){
                var output = $("#addFeedback_widget").html();
                return output;
            }
        });
        
        $(".feedback_add").click(function(){
            jQuery.data(div, "teamid", $(this).data("teamid"));
            jQuery.data(div, "role", $(this).data("role"));
            $(this).css({})
            //jQuery.data(div, "role", $(this).data("role"));
        });                      
       
       $("#TeamUI_config_btn").click(function(){
           var $num_teams = $("#input_tot_team").val();
           var $projectid = $(this).data("projectid");
           window.location="TeamUI_Page.php?num_teams="+$num_teams+"&projectid="+$projectid;
       });
       
       $("#input_tot_team").keyup(function(){
           var $content = $(this).val();
           if($content){
               $("#disp-input-div").addClass("alert").html($content);
           }else{
               $("#disp-input-div").removeClass("alert");
           } 
       });
    </script>
    
 
