 <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>STAR TECH</title>
        
        <!-- header.php 
        ==========================================================-->
         <link href="css/bootstrap.min.css" rel="stylesheet">
         <link href="css/bootstrap-responsive.css" rel="stylesheet">
	 <link href="css/customization.css" rel="stylesheet">
        <!-- header.php ends -->
        
    </head>
    <body>  
        <?php include_once 'php/header.php'; ?>
        
        <!-- CANVAS
	======================================================-->
	
	<!-- CANVAS
	======================================================-->
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
	</div><!-- .container -->
        
        <div class="container">
        <div class="row">
            <div>
             <?php if(!isset($db)){
                            require("php/db/db_connection.php");
                      }
                      $mysql_query = "SELECT A.projectid, A.title, A.created
                                      FROM project AS A LEFT JOIN consultant_profile AS B
                                      ON A.projectid = B.projectid
                                      WHERE B.userid = {$_SESSION['userid']}
                                      ORDER BY A.created DESC";
                      $result = $db->query($mysql_query);
                      
                      if($result->num_rows > 0){
                          echo "<form>Select the project: <select id='list'>";
                          while($row = $result->fetch_assoc()){
                              echo "<option value='{$row['projectid']}'>{$row['title']}</option>";
                          }
                          echo "</select></form>";
                      }else{
                          echo "<div class='alert'>You are not consulanting on any projects.</div>";
                      }
                ?>
                <div class="text-center">
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
            $("#loadPage").load("php/DispTeam4Consultant.php?projectid="+selectItem);
        });
          $("#list").change(function()
            {   
                var selectItem = document.getElementById("list").value;
                $("#loadPage").html("loading...");
                $("#loadPage").load("php/DispTeam4Consultant.php?projectid="+selectItem);
            });
    </script>
       
<?php include_once 'php/footer.php'; ?> 

