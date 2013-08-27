<?php
if(!isset($db)){
    require ("php/db/db_connection.php");
}

// pull out all consultant
$mysql_query = "SELECT A.userid, A.firstname, A.lastname, A.department, A.email, A.phone
                FROM user as A LEFT JOIN consultant_profile as B
                ON A.userid = B.userid
                WHERE B.projectid = {$projectid}";
$result = $db->query($mysql_query);
if($result->num_rows > 0){
    echo '<form action="ShowResult.php?projectid={$projectid}" method="POST">
            <div class="check_combo">
            <label for="check_combo>Select consultant(s)</label>';
    while($row = $result->fetch_assoc()){
        $userid = $row['userid'];
        $fn     = ucfirst($row['firstname']);
        $ln     = ucfirst($row['lastname']);
        $dp     = ucwords($row['department']);
        echo '<input type="checkbox" name="consultant[]" value="$userid"><a class="btn"> {$fn} {$ln} | {$dp} </a><br>';
    }
    echo '</div><div class="pull-right">
            <input class="btn btn-primary" type="submit" value="Submit">
        </div></form>';
}else{
    // no data had been found
    $db_error = $db->error;
    if(!empty($db_error)){
        // error occurs to querying data
        $msg = "<div class='alert alert-error'>This error in pulling out data from Database.<br>
                <strong>Error:</strong>{$db_error}.</div>";
    }else{
        // no querry error
        $msg = "<div class='alert'>Oops! It seems that no consultant who had been hired for helping our company.<br>
                </div>";
    }
}
?>
