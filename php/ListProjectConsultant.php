<?php
function ListConsultants($db, $projectid){
if(!isset($db)){
    require("db/db_connection.php");
}
// send variable by the means of url?var=val
//$projectid = $_GET['projectid'];

// pull out consultant information
$mysql_query = "SELECT A.firstname, A.lastname, A.department, A.email, A.phone
                FROM user as A LEFT JOIN consultant_profile as B
                ON A.userid = B.userid
                WHERE B.projectid = {$projectid}";
$result = $db->query($mysql_query);

if($result->num_rows > 0){
    // there is at lest one consultant in this project
    echo  "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert'>&times;</button>";
    echo "<strong>Consultant (s) for this project:</strong>";
    while($row = $result->fetch_assoc()){
        $fn  = ucfirst($row['firstname']);
        $ln  = ucfirst($row['lastname']);
        echo "&nbsp;<a class='btn btn-small'><i class='icon-user'></i>&nbsp;<strong>{$fn} {$ln}<strong></a>&nbsp;";
    }
    echo "<br><div class='pull-right'>";
    include 'AddConsultantButton.php';
    echo "</div><br><br></div>";
    
}else{
    // no data had been found
    $db_error = $db->error;
    if(!empty($db_error)){
        // error occurs to querying data
        echo  "<div class='alert alert-error'><strong>This error in pulling out data from Database.</strong><br>
                <strong>Error:</strong>{$db_error}.</div>";
    }else{
        // no querry error
        echo "<div class='alert'><button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>No consultant had been invited to consult this project.</strong><br>
                <div class='pull-right'>";
        include 'AddConsultantButton.php';
        echo  "</div><br><br></div>";
    }
}
}
?>
