<?php 
      // active $_SESSION in this page
      session_start(); 
      // load DB connection (object: $db)
      require "php/db/db_connection.php";

      if(isset($_GET['projectid'])){
          $projectid = $_GET['projectid'];
      }else{
          echo "Project ID is not specified.";
      }
      
      // pull out session information
      $userid = $_SESSION['userid'];
      
      // retrieve information of the project
      $mysql_query = "SELECT userid, title, department, textbody, deadline
                      FROM project WHERE projectid = {$projectid}";
      $result = $db->query($mysql_query);
      $row = $result->fetch_assoc();
      if($result){
          $owner_userid = $row['userid'];
          $title        = $row['title'];
          $department   = $row['department'];
          $textbody     = $row['textbody'];
          $deadline     = $row['deadline'];
      }else{
          echo "Failed to pull out the project information. due to ". $db->error.".";
      }
?>

<?php $page_name="department";
      include_once 'php/header.php';
    ?>

    <!-- MAIN 
	==========================================================-->
	<div class="container">
		<!-- PAGE TITLE -->
		<div class="row">
                    <div class="span12">
					<div class="project-breadcrubs">
						<ul class="breadcrumb">
                                                    <li><a href="#"><?php echo ucfirst($department); ?></a> <span class="divider">/</span></li>
  							<li class="active"><?php echo ucfirst($title); ?></li>
  						</ul><!--/.braedcrumb-->
					</div><!--.project-bradcrubs-->				
				</div>
		</div><!--/.row-->
		
   
                
		<div class="row">
			<!-- SIDE NAVS -->
			<!-- Category  -->
			<div class="span3">                           	
				<?php
                                    // load side-bar generator function
                                    include "php/ProjectSideNav.php"; 
                                    $navbar = ProjectSideNav($db, $department);
                                    echo $navbar;
                                    ?>
			</div>
			
			<!-- Project description-->
			<div class="span9">
                                <h3><?php echo $title; ?></h3>
                                <hr style="height:5px">
                                <div class="well tabbable">
                                    <?php 
						print html_entity_decode($textbody); 
					?>
				</div><!-- /.tabbable -->
			</div><!--/.span9-->						
		</div><!--/.row-->
                
                <?php if($_SESSION['role'] == 'director'){ 
                        // create project modify button only for director
                    ?>
                
                <div class="row">
                    <div class="span3"></div>
                    <div class="span9">
                        <div class="pull-right">
                            <a class="btn btn-primary" href="modify_project_page.php?projectid=<?php echo $projectid; ?>" style="margin-bottom: 20px">
                                Modify the Project
                            </a>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="span3"></div>
                    <div class="span9">
                    <?php
                        include "php/ProjectFileWidget.php";
                    ?>
                    </div>
                </div><!--/.row -->
                    
		<div class="row">
                    <div class="span3">
                    </div>
			
			<div class="span9">
                                <?php
                                    if(isset($deadline))
                                    {
                                        echo "<div id='deadline-msg' class='alert'>
                                              <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                              <strong>Project deadline is :</strong> {$deadline}.
                                              </div>";
                                    }
                                ?>
                            
                            <!-- Display upload UI -->
                                <?php 
                                    if($_SESSION['login'])
                                    {
                                            // engineer submit solution
                                            if($_SESSION['role'] == 'engineer'){
                                             echo "
                                                    <div class='well'><h5>Upload your solution</h5>
                                                    <form action='php/AddFile.php' method='post' enctype='multipart/form-data'>
                                                    <input type='hidden' name='projectid' value='{$projectid}'>
                                                    <input type='hidden' name='projectPageURL' value='{$_SERVER['PATH_INFO']}'>
                                                    <label for='file'>Filename:</label>
                                                    <input type='file' name='uploaded_file' id='uploaded_file'><br>
                                                    <input type='submit' name='submit' value='Submit'>
                                                    </form></div>";
                                                    }
                                            
                                            // director attach downloadable file to project
                                            if($_SESSION['role'] == 'director'){
                                             echo "
                                                    <div class='well'><h5>Attach files to the project</h5>
                                                    <form action='php/AddProjectFile.php' method='post' enctype='multipart/form-data'>
                                                    <input type='hidden' name='projectid' value='{$projectid}'>
                                                    <input type='hidden' name='projectPageURL' value='{$_SERVER['PATH_INFO']}'>
                                                    <label for='file'>Filename:</label>
                                                    <input type='file' name='uploaded_file' id='uploaded_file'><br>
                                                    <input type='submit' name='submit' value='Submit'>
                                                    </form></div>";
                                                    }
                                    }
                                ?>
                        </div>
                </div><!--/.row -->
                
                <hr>
                <div class="row">
                    <div class="span12">
                        <div class="table-wrapper">
                            
                           <?php 
                                   if($_SESSION['login'])
                                   {
                                       if($_SESSION['role'] == 'engineer')
                                       {
                                           echo "<h5>Files submitted by your team are considered as the project solution:</h5>";
                                           include "php/ListFile.php";
                                       }
                                   }
                          ?>
                        </div>
                        
                        <?php if($_SESSION['role'] == 'engineer'){ ?>
                        <div class="well">
                            <h5>Please leave some messages attached to your team solution:</h5>
                            <?php 
                                   require("php/db/db_connection.php");
                                   // get teamid 
                                   $mysql_query = "SELECT teamid FROM team 
                                                    WHERE projectid = {$projectid} AND userid = {$userid}";
                                   $result = $db->query($mysql_query);
                                   if($result->num_rows > 0){
                                       while($row_teamid = $result->fetch_assoc()){
                                           $teamid = $row_teamid['teamid'];
                                       }
                                   }
                                   // get solution description
                                   $mysql_query = "SELECT textbody FROM team_info WHERE teamid = {$teamid}";
                                   $result = $db->query($mysql_query);
                                   if($result->num_rows > 0){
                                       while($row_tb = $result->fetch_assoc()){
                                           $sl_descirption = $row_tb['textbody'];
                                       }
                                   }
                                   
                            ?>
                            <a id="textbody_solution" class="editable" href="#" data-type="text" data-pk="<?php echo $teamid; ?>" >
                                <?php echo $sl_descirption; ?>     
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                </div><!--/.row-->
		
	</div><!--/.container-->

    <?php 
    echo '<script type="text/javascript" src="assets/x-editable/js/bootstrap-editable.min.js"></script>        
            <script>
                $("#textbody_solution").editable({
                    url: "php/ModTeamInfo.php",
                    name: "textbody",
                    title: "Comment made on team\'s solution."
                    });
            </script>';
    ?>
        
    <?php include_once 'php/footer.php'; ?>