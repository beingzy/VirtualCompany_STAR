<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>STAR Corp.</title>
        
        <link type="text/css" href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    
        <!-- bootstrap-wysihtml5 -->
        <link type="text/css" href="../assets/bootstrap-wysihtml5.css" rel="stylesheet" />
        <!-- X-editable -->
        <link type="text/css" href="../assets/x-editable/css/bootstrap-editable.css" rel="stylesheet" />
    </head>
    <body>
<?php
// MySQL database connection
$db_hostname = "localhost";
$db_username = "root";
$db_password = "8233156";
$db_database = "mockup_db";

$db = new mysqli($db_hostname, $db_username, $db_password, $db_database);
if($db->connect_errno > 0) die("Unable to connect to database: ". $db->connect_error);


//adding user
$username    = strtolower(mysql_real_escape_string($_POST['username']));
$password    = mysql_real_escape_string($_POST['password']);
$password_confirm   = mysql_real_escape_string($_POST['password_confirm']);
$department  = $_POST['department'];
$role        = $_POST['role'];
$firstname   = mysql_real_escape_string(ucfirst($_POST['firstname']));
$lastname    = mysql_real_escape_string(ucfirst($_POST['lastname']));
$ucid        = mysql_real_escape_string($_POST['ucid']);
$email       = mysql_real_escape_string($_POST['email']);
$phone       = mysql_real_escape_string($_POST['phone']);
$invi_code   = mysql_real_escape_string($_POST['invi_code']);

$allowSignup = FALSE;
// validation:
if($password != $password_confirm){
   die("<div class='alert alert-error'><strong>Passwords you enterred are not same.</strong><br> 
        <a class='btn btn-primary' href='..\login.php'>Click me </a> to signin page.
            </div>");
}else{
    $allowSignup = TRUE;
}


if(ValidateRegister($db, $username)){
     $allowSignup = $allowSignup && ValidateRegister($db, $username);
}else{
    die("<div class='alert alert-error'>Username: ".$username." had been used!
        <a class='btn btn-primary' href='..\login.php'>Click me </a> to signin page.
            </div>");
}

if(passInviCode($invi_code)){
     $allowSignup = $allowSignup & TRUE;
}else{
    die("<div class='alert alert-error'>Your invitation number is not correct!</div>
        <a class='btn btn-primary' href='..\login.php'>Click me </a> to signin page.</div></div>");
}

if($allowSignup){
    AddUser($db, $username, $password, $department, $role, $firstname, $lastname, $ucid, $email, $ucid);
}
// validate if record for username had been created
function ValidateRegister($db, $un){
    $sql_query = "select * from user where username = '".$un."'";
    $result = $db->query($sql_query);
    if(!$result) die("Failed to validate the submitted informaiton ". $result->eror);
    if($result->num_rows > 0){
        $validate = FALSE;
    }else{
        $validate = TRUE;
    }
    $result->free();
    return $validate;
}

function passInviCode($ic){
   if(strtolower($ic) == '2013star'){
       $pass = true;
   }else{
       $pass = false;
   }
   return $pass;
}

// add user function;
function AddUser($db, $un, $pw, $dp, $rl, $fn, $ln, $ucid, $email, $phone)
{
    $pw_md5 = md5($pw);
    $sql_query = "
        INSERT INTO user(username, password, department, role, firstname, lastname, ucid, email, phone, created)
        VALUES('$un', '$pw_md5', '$dp', '$rl', '$fn', '$ln', '$ucid', '$email', '$phone', now())";
    $result = $db->query($sql_query);
    if(!$result){die("Adding a user failed due to :" . $result->eror);}
    else{
        echo "<div class='text-center'><div class='alert alert-success'>
            Congratulation!: Your registration succeed. <a class='btn btn-primary' href='..\login.php'>Click me </a> to signin page
            </div></div>";
    }
    $result->free();
}

$db->close();
?>

<?php include_once 'footer.php'; ?> 