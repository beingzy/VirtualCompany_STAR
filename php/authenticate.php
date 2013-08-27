<?php 
//authenticate.php
// start connection
session_start();
// db connection
require 'db/db_connection.php';

$tmp_un   = $_POST['username'];
$tmp_pw   = md5($_POST['password']);
$tmp_role = $_POST['role'];

// verify with data in user table
$sql_query = "
    select userid, role, department, firstname, lastname
    from user where
        username = '{$tmp_un}' and
        password = '{$tmp_pw}'";
$result = $db->query($sql_query);
$row = $result->fetch_assoc();
// evaluate authorization
$user_role = $row["role"];
// restricted user
$res_users = array("engineer", "consultant");
//if(in_array($user_role, $res_users)){
///    if($user_role != $temp_role){
 //       $result->free();
//        $_SESSION['login']      = false;
 //       header("location: ../login.php");
//        die();
//    }
//}

if($result->num_rows > 0)
{
   $_SESSION['login']      = true;
   $_SESSION['userid']     = $row['userid'];
   $_SESSION['username']   = $row['username'];
   $_SESSION['department'] = $row['department'];
   $_SESSION['fn']         = $row['firstname'];
   $_SESSION['ln']         = $row['lastname'];
   $result->free();
   header("location: ../index.php");
   if($user_role != 'administrator'){
      $_SESSION['role'] = $tmp_role;
   }else{
      $_SESSION['role'] = $user_role;
   }
}else{
   $result->free();
   $_SESSION['login']      = false;
   header("location: ../login.php");
}

?>
