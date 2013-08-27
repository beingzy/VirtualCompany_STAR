<?php include_once 'php/header.php'; ?>

<?php 
    session_start();
    require 'php/db/db_connection.php';
    if(!isset($db)){
        echo "<div class='alert alert-error'>Database connection is not established.</div>";
    }    
    $department = $_SESSION['department'];
    // extract data for tabs presenting projects information
    $mysql_query = "SELECT projectid, title, created FROM project 
                    WHERE department = '{$department}'
                    ORDER BY created DESC";
    $result=$db->query($mysql_query);
?>     


	<div class="container">
                <div class="row">
                    <div class="span1"></div>
                        <div class="span10" style="text-align: left">
                            <div class="alert alert-info" style="margin:20px auto 20px auto; min-height: 130px">
                                <?php include "php/UserWelcomePanel.php"; ?>
                            </div>
                        </div>
                    <div class="span1"></div>
                </div>
            
                <div class="row">
                        <div class="span10">
                            <a class="btn btn-warning pull-right" href="changepwd.php">Change Password</a>
                        </div>
                        <div class="span2"></div>
                    </div><!--/.row -->
            
            <hr>
            
            <div class="row">
                
                    <div class="span12" style="text-align: left">
                        <a id="add-project" name="add-project" class="btn btn-primary" href="add_project_page.php">
                             Add a project
                        </a>
                    </div>
                
            </div>
            
	<hr>
	</div><!--/.container-->  
        
        <div class="container">
        <div class="row">
            <div>
             <?php if(!isset($db)){
                            require("php/db/db_connection.php");
                      }
                      $mysql_query = "SELECT projectid, title FROM project WHERE department = '{$department}'";
                      $result = $db->query($mysql_query);
                      echo "<form>Select the project: <select id='list'>";
                      if($result){
                          while($row = $result->fetch_assoc()){
                              echo "<option value='{$row['projectid']}'>{$row['title']}</option>";
                          }
                          echo "</select></form>";
                      }else{
                          echo "<div class='alert'>No projects had been created in your department.</div>";
                      }
                ?>
                <div align="left">
                    <div id="loadPage" class="well" style="min-height: 100px; min-width: 400px">Loading...</div>
                </div>
            </div>
        </div>
    </div>
        <script>
        $(".btnTooltip").tooltip();
        $(document).ready(function()
        {
            $("#list").attr("selectedIndex", -1);
            var selectItem = document.getElementById("list").value;
            $("#loadPage").html("loading...");
            $("#loadPage").load("php/DispTeam4Director.php?projectid="+selectItem);
        });
          $("#list").change(function()
            {   
                var selectItem = document.getElementById("list").value;
                $("#loadPage").html("loading...");
                $("#loadPage").load("php/DispTeam4Director.php?projectid="+selectItem);
            });
    </script>
<?php include_once 'php/footer.php'; ?> 

