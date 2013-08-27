<!-- conditional direction based on role -->
<?php 
      session_start();
    
      if(isset($_SESSION['login']))
      {
          if($_SESSION['login'])
          {
                switch ($_SESSION['role'])
                {
                    case 'engineer':
                        include "engineer_page.php";
                        break;
                    case 'director':
                        include "director_page.php";
                        break;
                    case 'consultant':
                        include "consultant_page.php";
                        break;
                    case 'administrator':
                        include "admin_page.php";
                        break;
                    default:
                        include "home_page.php";
                        break;
                }
          }
          else
          {
                include "home_page.php";
           }
      }
      else
      {
          include "home_page.php";
      }
      
?>
       
