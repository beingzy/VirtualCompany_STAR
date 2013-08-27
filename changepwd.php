<?php session_start(); ?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>STAR Corp.</title>
        
        <link type="text/css" href="assets/css/bootstrap.min.css" rel="stylesheet" />  
        
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
      
    <div class="container">     

           <div class="container">     
        
            <form method="post" action="php/change_pwd.php" class="form-signin">
                <h3 class="form-signin-heading">Input new password</h3>
                <input type="hidden" name="userid" value='<?php echo $_SESSION["userid"];?>'>
                <input id="old_password" name="old_password" type="password" class="input-block-level" placeholder="Old Password" >
                <input id="new_password_01" name="new_password_01" type="password" class="input-block-level" placeholder="New Password" >
                <input id="new_password_02" name="new_password_02" type="password" class="input-block-level" placeholder="Retype New Password" >
             
                <div style="margin-top:5px">
                    <input id ="submit_btn" type="submit" class='btn btn-primary' value="Submit" disabled>
                    <a class="btn btn-danger" href="index.php">Cancel</a>
                </div>
            </form>
        </div>

    </div> <!-- /container -->
    
    <script src="assets/js/jquery-1.9.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script>
        $("#verify_pwd_tooltip").tooltip('hide');

        $("#new_password_02").focus(function(){
            $("#verify_pwd_tooltip").tooltip('show');
        })
        
        $("#new_password_02").keyup(function(){      
            var $new_pwd_01 = $("#new_password_01").val();
            var $new_pwd_02 = $("#new_password_02").val();
            
            $("#text01").html($new_pwd_02);
            
            if($new_pwd_01 == $new_pwd_02){
                $("verify_pwd_tooltip").tooltip({
                    title: 'Great! Your passwords match.'
                });
                $("#submit_btn").removeAttr("disabled");
        }
    });
    </script>
    
    
</body>


