<?php include('php/header.php'); ?>
<?php
    $projectid = $_GET['projectid'];
    
    if(!isset($db)){
        require "php/db/db_connection.php";
    }
    
    $mysql_query = "SELECT title, department, textbody, deadline FROM project
                    WHERE projectid = {$projectid}";
    $result = $db->query($mysql_query);
    if($result->num_rows > 0){
       while($row = $result->fetch_assoc()){
           $project_title      = $row['title'];
           $project_department = $row['department'];
           $project_textbody   = $row['textbody'];
           $project_deadline   = $row['deadline'];
       }
    }else{
       echo "<div class='alert alert-error'>Error occur, {$db->error}<div>";
    }
?>
<!-- CKEditor -->
<script type ="text/javascript" src="assets/ckeditor/ckeditor.js"></script>
<!-- date picker -->
<script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>

<hr>
<div class="container">
    
    <div class="row">
        <div class="span1"></div>
        <div class="span10">
        <!-- input neccessary information -->
        <form action="php/ModifyProject.php" method="POST">
            <fieldset>
                <legend>Create a new project</legend>
                <label for="title">Project Title:</label><br>
                <input name="projectid" value='<?php echo $projectid; ?>' type="hidden">
                <input name="title" id="title" type="text" <?php if(isset($project_title)) echo "value='{$project_title}'"; ?> >
                <br>
                <br>
                <label for="department">Project belongs to department:</label>
                <select name="department" id="department">
                    <option value="quality assurance" <?php if($project_department == 'quality assurance') echo "checked='checked'"; ?> >
                            Quality Assurance</option>
                    <option value="manufacturing" <?php if($project_department == 'manufacturing') echo "checked='checked'"; ?> >
                        Manufacturing</option>
                </select>
                <hr>
                <label for="deadline">Define the deadline</label>
                <div id="deadline_datetimepicker" class="input-append date">
                    <input name="deadline" id="deadline" data-format="dd/MM/yyyy hh:mm:ss" type="text" <?php if(isset($project_deadline)) echo "value = '{$project_deadline}'"; ?>>
                        <span class="add-on">
                        <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                    </span>
                </div>
                <hr>
            <hr>
            <textarea name="textbody" id="textbody" class="textarea" style="width: 810px; height: 200px">
                <?php if(isset($project_textbody)) echo "{$project_textbody}"; ?>
            </textarea>
            
            
            <hr>
                <input type="submit" class="btn btn-primary" value="Modify the Project">
                <a class="btn btn-warning" href="ProjectPage.php?projectid=<?php echo $projectid; ?>">Cancel</a>
            </fieldset>
        </form>
        </div>
                <div class="span1"></div>
    </div>
    
</div>
     <script>
    CKEDITOR.replace('textbody');
    </script>
    <script type="text/javascript">
        $('#deadline_datetimepicker').datetimepicker({
            language: 'pt-BR'
        });
    </script>
<?php include('php/footer.php'); ?>

