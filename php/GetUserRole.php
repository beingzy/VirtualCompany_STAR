<?php
require "db/db_connection.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

if(isset($username) and isset($password)){
    $mysql_query = 'SELECT role, department FROM user
                    WHERE username = "'.$username.'"
                    AND password = "'.$password.'"';
    $result = $db->query($mysql_query);
    if($result){
        while($row = $result->fetch_assoc()){
            $role = $row['role'];
            $department = $row['department'];
        }
    }else{
        echo "<div div class='alert alert-error'><strong>Error! </strong> 
            The combination of username and 
            password is not correct!</div>";
    }
}

?>
