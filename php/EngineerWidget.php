<?php 
    session_start();
    require "db/db_connection.php";
    include "funcMySQL.php";
    $userid = $_SESSION['userid'];
       
    $allProject = ListEngineerProjects($db, $_SESSION['userid']); // 
    
    if(isset($_GET['projectid'])){
        $projectid = $_GET['projectid'];
    }else{
        // if project id is not defined, redirect to error page
        //die("Project is not defined.");
    }
    // echo "<div class='alert alert-info'>ProjectID: {$projectid} AND User ID: {$userid}</div>";
    
    // get project information
    $mysql_query = "SELECT title, department, deadline FROM project WHERE projectid = {$projectid}";
    $result = $db->query($mysql_query);
    if($result){
        while($row = $result->fetch_assoc()){
            $project_title      = $row['title'];
            $project_department = $row['department'];
            $project_deadline   = $row['deadline'];
        }
    }else{
        echo "<div class='alert alert-error'>Failed to pull out some of the project detail, possible due to: {$db->error}</div>";
    }
    
    // team information
    $mysql_query = "SELECT teamid FROM team 
                    WHERE userid = {$userid} AND projectid = {$projectid}";
    $result = $db->query($mysql_query);
    if($result){
        while($row = $result->fetch_assoc()){
            $team_teamid = $row['teamid'];
        }
    }else{
        echo "<div class='alert alert-error'>Failed to pull out your teamid for this project, possible due to: {$db->error}</div>";
    }
    
    // lastest director feedback
    $mysql_query = "SELECT textbody, datetime FROM director_feedback
                    WHERE teamid = {$team_teamid}
                    ORDER BY datetime DESC
                    LIMIT 1";
    $result = $db->query($mysql_query);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $d_feedback = $row['textbody'];
            $d_feedback_datetime = $row['datetime'];
        }
    }else{
        $d_feedback = "No feedback";
    }
    
    // lastest director feedback
    $mysql_query = "SELECT textbody, datetime FROM consultant_feedback
                    WHERE teamid = {$team_teamid}
                    ORDER BY datetime DESC
                    LIMIT 1";
    $result = $db->query($mysql_query);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $c_feedback = $row['textbody'];
            $c_feedback_datetime = $row['datetime'];
        }
    }else{
        $c_feedback = "No feedback";
    }
    
    
    
    // team information
    $mysql_query = "SELECT DISTINCT grade FROM team WHERE teamid = {$team_teamid}";
    $result = $db->query($mysql_query);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $team_grade    = $row['grade'];
        }
    }else{
        $team_grade = "Not graded";
    }
    
    
?>


<table class="table table-striped table-bordered table-hover">
     <thead></thead>
     <tbody>
     <tr>
        <td><strong>Project Name:</strong></td>
        <td><?php echo $project_title; ?></td>
     </tr>
     <tr>
        <td><strong>Department:</strong></td>
        <td><?php echo $project_department; ?></td>
     </tr>
     <tr>
         <td><strong>Team ID:</strong></td>
         <td><?php echo $team_teamid; ?></td>
     </tr>
     <tr>
         <td><strong>Consultant Feedback:</strong></td>
         <td><p><strong><?php echo $c_feedback; ?></strong></p>
             <span class="pull-right"><?php echo $c_feedback_datetime; ?></span>
         </td>
     </tr>
     <tr>
        <td><strong>Director Feedback:</strong></td>
        <td><p><strong><?php echo $d_feedback; ?></strong></p>
             <span class="pull-right"><?php echo $d_feedback_datetime; ?></span>
         </td>
     </tr>
     <tr>
         <td><strong>Grade:</strong></td>
         <td><?php echo $team_grade; ?></td>
     </tr>
     <tr>
         <td><strong>Engineers in your team:</strong></td>
         <td>
             <?php 
                    // pull out team member information
                    $mysql_query = "SELECT userid, firstname, lastname, email, phone 
                                   FROM user
                                   WHERE userid in (SELECT userid FROM team WHERE teamid = {$team_teamid})
                                   ORDER BY firstname";
                    $result = $db->query($mysql_query);
                    echo "<div class='pull-left'>";
                    if($result){
                        while($row = $result->fetch_assoc())
                        {
                            $member_userid = $row['userid'];
                                      $fn  = $row['firstname'];
                                      $ln  = $row['lastname'];
                                   $email  = $row['email'];
                                   $phone  = $row['phone'];
                           echo "<a class='btn btn-small btnTooltip' href='mailto:{$email}' data-toggle='tooltip' data-original-title='Email:{$email} and
                                Phone:{$phone}'>
                               <i class='icon-envelope'></i>&#160;{$fn}&#160;{$ln}&#160;</a>";
                        }
                    }else{
                        echo "<div class='alert alert-error'>Error! No engineer 
                            has been found working in the team, 
                            due to {$db->error}</div>";
                    }
                    echo "<div>";
             ?>
         </td>
     </tr>
     <tr>
         <td colspan="2"><a class="btn btn-primary btnTooltip" data-toggle='tooltip' data-original-title="Go to the project page" href="ProjectPage.php?projectid=<?php echo $projectid; ?>">View</a></td>
      </tr>
    </tbody>
</table>
<script>
    $(".btnTooltip").tooltip();
</script>