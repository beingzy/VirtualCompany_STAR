<?php
    require("db_connection.php");
    
    // display
    $sql_query = "
        select * from comment";
    
   $result = $db->query($sql_query);
   
   if($result->num_rows == 0)
      {
       // no records 
       $entry_display  = "<div class='alert'>Page is under construction...</div>";
       echo $entry_display;
      }else{           
            $entry_display .= '
                 <table class="table">
                <thead>
                    <tr>
                        <td>Title</td>
                        <td>Body</td>
                        <td>Create time</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>';
            
            while($row = $result->fetch_assoc())
            {
                // loop through recrods
                  $entry_display .= '
                        <tr>
                        <td>'.$row["title"].'</td>
                        <td>'.$row["bodytext"].'</td>
                        <td>'.$row["created"].'</td>
                        <td><a class="btn btn-small"><i class="icon-plus"></i></a></td>
                        </tr>';
            }
            $entry_display .="</tbody></table>";        
      }  
                      
    echo $entry_display; 
    // free $result container
    $result->free();
    // close the connection
    $db->close();  
   
?>
