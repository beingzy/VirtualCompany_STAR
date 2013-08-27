<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
 <head>
   <meta charset="utf-8">
   <title>Experiment Site</title>
   <link type="text/css" href="assets/css/bootstrap.min.css" rel="stylesheet" />
   <!-- jquery UI -->
   <link type="text/css" href="assets/jqueryui/css/smoothness/jquery-ui-1.10.2.custom.min.css" rel="stylesheet" />
   <!-- tablecloth.js -->
   <link type="text/css" href="assets/tablecloth.js/css/bootstrap-tables.css" rel="stylesheet" />
   <link type="text/css" href="assets/tablecloth.js/css/tablecloth.css" rel="stylesheet" />
   <!-- modal master -->
   <link type="text/css" href="assets/bootstrap-modal-master/css/bootstrap-modal.css" rel="stylesheet">
   <!-- jquery ui 1.10.2 -->
   <link type="text/css" href="assets/jquery-ui-1.10.2.custom/css/ui-lightness/jquery-ui-1.10.2.custom.min.css" rel="stylesheet" /> 
   
   
   <script type="text/javascript" src="assets/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <!-- modal-master -->
    <script type="text/javascript" src="assets/bootstrap-modal-master/js/bootstrap-modal.js"></script>
    <script type="text/javascript" src="assets/bootstrap-modal-master/js/bootstrap-modalmanager.js"></script>
    <!-- jquery ui 1.10.2 -->
    <script type="text/javascript" src="assets/jquery-ui-1.10.2.custom/js/jquery-ui-1.10.2.custom.min.js"></script>
    <!-- json 2 -->
    <script type="text/javascript" src="assets/js/json2.js"></script>
   
   
   
   <!-- DataTable -->
   <link type="text/css" href="assets/DataTables-1.9.4/media/css/jquery.dataTables.css" rel="stylesheet">
   <script type="text/javascript" src="assets/DataTables-1.9.4/media/js/jquery.dataTables.js"></script>
</head>
<body>
    
	
	<div class="navbar navbar-inverse">
        <div class="navbar-inner">
          <!-- Responsive Navbar Part 1: button for triggering responsive navbar. Include responsive CSS to utilize. -->
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#"><img src="img/logo.png" /></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li <?php if($page_name == 'home') echo "class='active'"; ?>><a href="home_page.php">Home</a></li>
              <li <?php if($page_name == 'aboutus') echo "class='active'"; ?> ><a href="aboutus_page.php">About Us</a></li>
              
              <li class="dropdown <?php if($page_name == 'department') echo 'active'; ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Department<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="mf_department_page.php">Manufacturing</a></li>
                        <li><a href="qa_department_page.php">Quality Assurance</a></li>
                    </ul>
              </li>
              <li <?php if($page_name == 'news') echo "class='active'"; ?>><a href="news_page.php">News</a></li>
              
              <?php 
                switch($_SESSION['role'])
                {
                    case 'engineer':
                        echo "<li class='active'><a href='engineer_page.php'>Engineering Home</a></li>";
                        break;
                    case 'consultant':
                        echo "<li class='active'><a href='consultant_page.php'>Consultant Home</a></li>";
                        break;
                    case 'director':
                        echo "<li class='active'><a href='director_page.php'>Director Home</a></li>";
                        break;
                    case 'administrator':
                        echo "<li class='active'><a href='admin_page.php'>Administrator Home</a></li>";
                        break;
                    default:
                        break;
                }
                ?>
            </ul>
            <div class="pull-right">
                <a class="btn" href="login.php">
                    <?php 
                            if($_SESSION['login'])
                            {
                                echo "Log out";
                            }else{
                                echo "Log in";
                            }
                     ?>
                            </a>    
            </div>
                    </div> <!--/.nav-collapse -->
                    </div> <!--/.nav-bar-inner -->
                </div> <!-- /.nvabar --> 





