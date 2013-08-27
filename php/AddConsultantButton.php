<?php
if(!isset($db)){
  include "php/db/db_connection.php";
  if(!isset($db)){
      echo "DB connection is not found!";
  }
}

$projectid = $_GET['projectid'];
?>

<a href="#myModal" id="myModal_btn" role="button" class="btn btn-primary"  data-projectid ="1" data-toggle="modal" style="margin:20px auto 20px auto">
                Invite Consultants</a>


<div id="myModal" class="modal hide fade" tabindex="-1" style="color:black;min-width: 400px">
            <div id="myModal-header" class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>-->
                <h4 id="myModalLabel">Select consultants</h4>
            </div>
            <div id="myModal-body" class="modal-body">
<?php
$mysql_query = "SELECT userid, firstname, lastname, department FROM user 
                WHERE role = 'consultant'";
$result = $db->query($mysql_query);
if($result->num_rows > 0){
    echo "<form class='from' id='myform'>
           <input type='hidden' name='projectid' value='{$projectid}'>";
    while($row = $result->fetch_assoc()){
        $userid = $row['userid'];
        $fn     = ucfirst($row['firstname']);
        $ln     = ucfirst($row['lastname']);
        $dp     = ucwords($row['department']);
        echo '<label>
                <input type="checkbox" name="SelectedConsultant[]" value="'.$userid.'" />
                <span><strong>'.$fn.' '.$ln.'</strong>,'. $dp.'</span></label>';
    }
    //echo "<input type='submit' value='submit' class='btn btn-primary'>";
    echo "</form>";

}
else{
    echo "error, {$db->error}";
}
?>           
            <div id="feedback-disp"></div>
            </div>
            <div id="myModal-footer" class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">Close</a>
                <a href="#" id="submit_btn" class="btn btn-primary">Submit</a>
            </div>          
</div>
<script>
    $("#submit_btn").click(function(){
        // collect form data
        var $form_data = $("#myform").serialize();
        $("#data-disp").addClass("alert-success").append("<br><strong>Clicked</strong>");
        // send data by POST to PHP
        $.ajax({
            type: "POST",
            url:  "php/InviteConsultant.php",
            data: $form_data,
            success: function(msg){
               $("#feedback-disp").addClass("alert").addClass("alert-success").text(msg);
            }
        })
    })
</script>



