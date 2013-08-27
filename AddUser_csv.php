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
        
        <form action="php/import_csv2db.php" method="POST" enctype="multipart/form-data">
                        <label for="department"><h4>Select department:<h4></label>
                        <select name="department" id="department">
                            <option value="quality assurance" selected>Quality Assurance</option>
                            <option value="manufacturing">Manufacturing</option>
                        </select>
                        <label for="csv_file">Upload .csv file (without column name)</label>
                        <input type="file" name="csv_file" id="csv_file"><br>
                        <input type="submit" name="submit" value="Submit">
         </form>   
    </div>

    </div> <!-- /container -->

<?php include_once 'php/footer.php'; ?> 

