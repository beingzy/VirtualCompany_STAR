<?php
   require 'db/db_connection.php';

   if(isset($_POST))
   {
       if(isset($_POST['department']))
       {
           $mysql_query = "UPDATE editable_tab SET department = '{$_POST['department']}'
                      WHERE userid = {$_POST['pk']}";
           $result = $db->query($mysql_query);
           if($reuslt->num_rows)
            {
                die("Fialed to update tables;".$db->error);
            }
            $result->free();
       }
       if(isset($_POST['username']))
       {
           $mysql_query = "UPDATE editable_tab SET username = '{$_POST['username']}'
                      WHERE userid = {$_POST['pk']}";
           $result = $db->query($mysql_query);
           if($reuslt->num_rows)
            {
                die("Fialed to update tables;".$db->error);
            }
            $result->free();
       }      
    }
    else 
    {
        /* 
        In case of incorrect value or error you should return HTTP status != 200. 
        Response body will be shown as error message in editable form.
        */

        header('HTTP 400 Bad Request', true, 400);
        echo "This field is required!";
    }
    $db->close();
?>