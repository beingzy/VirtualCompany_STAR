<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>STAR Corp.</title>
        
        <link type="text/css" href="assets/css/bootstrap.min.css" rel="stylesheet" />
    
        <!-- bootstrap-wysihtml5 -->
        <link type="text/css" href="assets/bootstrap-wysihtml5.css" rel="stylesheet" />
        <!-- X-editable -->
        <link type="text/css" href="assets/x-editable/css/bootstrap-editable.css" rel="stylesheet" />
   
        
        <style type="text/css">
      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 180px auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type=text], .form-signin input[type=password] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }

    </style>
        
    </head>
    <body>
    <!-- load homepage.php -->     
      
    <div class="container">     

       <?php
            session_set_cookie_params($lifetime, '/shared/path/to/files/');
            session_start();
            session_unset();
            $_SESSION['login']=false;
            
       ?>
        
        <form method="post" action="php/authenticate.php" class="form-signin">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input id="username" name="username" type="text" class="input-block-level" placeholder="Username" >
        <input id="password" name="password" type="password" class="input-block-level" placeholder="Password" >
        <div id ="role" class="multi-choice well" style="margin-top:5px; margin-bottom: 5px">
             <input name="role" type="radio" value="engineer" checked>&nbsp;Engineer<br>
             <input name="role" type="radio" value="director">&nbsp;Director<br>
             <input name="role" type="radio" value="consultant">&nbsp;Consultant<br>
        </div>
        <div style="margin-top:5px">
            <input class="btn btn-primary" type="submit" name="login" id="login" value="Login" />
	     <!--<a class='btn btn-warning'href="Registry.php">Sign up</a>-->
	     <a class="btn btn-danger pull-right" href="index.php">Cancel</a>
        </div>
        </form>

        </div>

    </div> <!-- /container -->

<?php include_once 'php/footer.php'; ?> 

