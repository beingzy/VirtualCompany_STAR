<?php session_start(); 
    
?>
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
   
</head>
<body>
    <script type="text/javascript" src="assets/js/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <!-- jquery -->
    <script type="text/javascript" src="assets/jqueryui/js/jquery-ui-1.10.2.custom.min.js"></script>
    <!-- bootstrap tablecloth.js -->
    <script type="text/javascript" src="assets/tablecloth.js/js/jquery.metadata.js"></script>
    <script type="text/javascript" src="assets/tablecloth.js/js/jquery.tablesorter.js"></script>
    <script type="text/javascript" src="assets/tablecloth.js/js/jquery.tablecloth.js"></script>
    <div class="container">
        <div class="row">
            <div class="span2"></div>
            <div class="span8">
                
 <form class="form-horizontal" action='php/AddUser.php' method="POST">
  <fieldset>
    <div id="legend">
      <h5>Register</h5>
    </div>
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">Username</label>
      <div class="controls">
        <input type="text" id="username" name="username" placeholder="" class="input-xlarge">
        <p class="help-block">Username can contain any letters or numbers, without spaces</p>
      </div>
    </div>  
  
    <div class="control-group">
      <!-- department -->
      <label class="control-label" for="department">Department in which you are enrolled:</label>
      <div class="controls">
          <select id="department" name="department">
              <option value="quality assurance">Quality Assurance</option>
              <option value="manufacturing">Manufacturing</option>
          </select>
      </div>
    </div>
      
    <div class="control-group">
      <!-- role -->
      <label class="control-label" for="role">Your title: </label>
      <div class="controls">
          <select id="department" name="role">
              <option value="engineer">Engineer</option>
              <option value="consultant">Consultant</option>
              <option value="director">Director</option>
          </select>
      </div>
    </div>
    

 
    <div class="control-group">
      <!-- Password-->
      <label class="control-label" for="password">Password</label>
      <div class="controls">
        <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
        <p class="help-block">Password should be at least 4 characters</p>
      </div>
    </div>
 
    <div class="control-group">
      <!-- Password -->
      <label class="control-label"  for="password_confirm">Password (Confirm)</label>
      <div class="controls">
        <input type="password" id="password_confirm" name="password_confirm" placeholder="" class="input-xlarge">
        <p class="help-block">Please confirm password</p>
      </div>
    </div>
    
    <!-- personal information -->
    <div class="control-group">
      <!-- first name -->
      <label class="control-label" for="firstname">First Name</label>
      <div class="controls">
        <input type="text" id="firstname" name="firstname" placeholder="" class="input-xlarge">
        <p class="help-block">Please enter your first name</p>
      </div>
    </div>
      
    <div class="control-group">
      <!-- last name -->
      <label class="control-label" for="lastname">Last Name</label>
      <div class="controls">
        <input type="text" id="lastname" name="lastname" placeholder="" class="input-xlarge">
        <p class="help-block">Please enter your last name</p>
      </div>
    </div>
        
     <div class="control-group">
      <!-- registration code -->
      <label class="control-label" for="invi_code">Invitation Code</label>
      <div class="controls">
        <input type="text" id="invi_code" name="invi_code" placeholder="Invitation code" class="input-xlarge">
      </div>
    </div>
 
   <!-- contact information -->
   <div class="control-group">
      <!-- E-mail -->
      <label class="control-label" for="email">E-mail</label>
      <div class="controls">
        <input type="text" id="email" name="email" placeholder="" class="input-xlarge">
        <p class="help-block">Please provide your E-mail</p>
      </div>
    </div>
   
      
    <div class="control-group">
      <!-- Button -->
      <div class="controls">
        <button class="btn btn-success">Register</button>
      </div>
    </div>
  </fieldset>
</form>                      
            </div>
            <div class="span2"></div>
        </div>
    </div>
    
<?php include_once 'footer.php'; ?> 