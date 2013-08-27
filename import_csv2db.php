<?php
require("db/db_connection.php");

echo "Collecting the data...<br>";
echo "Size of uploaded data is ". $_FILES['csv_file']['size']." bytes <br>";
    // get the csv file handler
echo "Importing data into DB is starting...<br>";
$file = $_FILES['csv_file']['tmp_name'];
echo "Tempory name of files: {$file} <br>";
$handle = fopen($file, "r");
echo "File handler for uploaded data had been initiated.<br>";
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
                               'engineer', 'manufacturing', '$pwd_md5', now())";
           $result = $db->query($mysql_query);
           if(!$result){
              $msg .= "</td>{$data[0]} {$data[1]} {$data[2]} {$data[3]}</td><br>";
              $if_error = TRUE;
           }
       }
       
       fclose($handle);

    if($if_error){
        $msg = "Failed to create users based on following records:!<br>".$msg;
        $db_error = $db->error;
        //header("location: ../error_page.php?msg={$msg}&db_error={$db_error}");
        //die();
    }else{
     $msg = "Users had been created based on .csv file.<br>
            <a class='btn btn-success' href='index.php'>Click Me</a> to return your start page.";
        //header("location: ../success_page.php?msg={$msg}");
        //die();
    }
}    

?>
