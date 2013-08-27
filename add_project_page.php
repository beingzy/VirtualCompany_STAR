<?php include('php/header.php'); ?>
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
        <form action="php/CreateProject.php" method="POST">
            <fieldset>
                <legend>Create a new project</legend>
                <label for="title">Project Title:</label><br>
                <input name="title" id="title" type="text" placeholder="type title here...">
                <br>
                <br>
                <label for="department">Project belongs to department:</label>
                <select name="department" id="department">
                    <option value="quality assurance">Quality Assurance</option>
                    <option value="manufacturing">Manufacturing</option>
                </select>
                <hr>
                <label for="deadline">Define the deadline</label>
                <div id="deadline_datetimepicker" class="input-append date">
                    <input name="deadline" id="deadline" data-format="dd/MM/yyyy hh:mm:ss" type="text">
                        <span class="add-on">
                        <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                    </span>
                </div>
                <hr>
            <hr>
            <textarea name="textbody" id="textbody" class="textarea" placeholder="Enter text ..." style="width: 810px; height: 200px"></textarea>
            
            
            <hr>
                <input type="submit" class="btn btn-primary" value="Create the project">
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

