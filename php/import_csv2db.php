<?php
require("db/db_connection.php");


$department = $_POST["department"];
echo "Department had been defined..<br>";
$role       = 'engineer';
$file = $_FILES['csv_file']['tmp_name'];
$handle = fopen($file, "r");
$if_error = FALSE;
$msg = "";
    
if($handle !== FALSE){
       echo "start importing...<br>";
       $row = 1;
       while(($data = fgetcsv($handle, 1000, ",")) !== FALSE){
           echo ($row++)."th records is imported into DB...<br>";
           $pwd_md5 = md5(123);
           $mysql_query = "INSERT INTO user(lastname, firstname, username, email, role, department, password, created)
                           VALUES('". $data[0]. "', '". $data[1] ."', '".$data[2]."', '".$data[3]."', 
                               '".$role."', '".$department."', '$pwd_md5', now())";
           $result = $db->query($mysql_query);
           if(!$result){
              $msg .= "Created a user for {$data[0]} {$data[1]} {$data[2]} {$data[3]}<br>";
              $if_error = TRUE;
           }
       }
       
       fclose($handle);

    if($if_error){
        $msg = "Failed to create users based on following records:!<br>".$msg;
        $db_error = $db->error;
        header("location: ../error_page.php?msg={$msg}&db_error={$db_error}");
        die();
    }else{
     $msg = "Users had been created based on .csv file.<br>
            <a class='btn btn-success' href='../index.php'>Click Me</a> to return your start page.";
        header("location: ../success_page.php?msg={$msg}");
        die();
    }
}    

?>
