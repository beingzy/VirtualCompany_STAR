<?php include "php/header.php"; ?>
    <div class="container">
        <div class="row">
    <?php   
            require("php/db/db_connection.php");
            // extract data
            $mysql_query = "SELECT userid, username, department, role, 
                            firstname, lastname, created FROM user 
                            WHERE role != 'administrator'";
            $result = $db->query($mysql_query);

    ?>
    <div class="container">
        <div class="row">
            <div style="min-height: 350px">
            <!-- data container -->
           <div class="var_container"></div>
            <table id="user_table" cellspacing="1" class="dataTable">
                <thead>
                    <tr>
			<th>User ID</th>
                        <th>Username</th>
                        <th>Department</th>
                        <th>Role</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Created</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    while($row = $result->fetch_assoc()){
                        $userid     = $row['userid'];
                        $username   = $row['username'];
                        $department = $row['department'];
                        $role       = $row['role'];
                        $firstname  = $row['firstname'];
                        $lastname   = $row['lastname'];
                        $created    = $row['created'];
                        echo "<tr>
                                <td>{$userid}</td>
                                <td>{$username}</td>
                                <td>{$department}</td>
                                <td>{$role}</td>
                                <td>{$firstname}</td>
                                <td>{$lastname}</td>
                                <td>{$created}</td>
                                <td>
                                    <button href='#confirm_popup' class='btn btn-danger btn-del' role='button' data-toggle='modal' data-userid='{$userid}'>
                                        delete
                                    </button>
                                </td>
                              </tr>";
                    }
                ?>
                </tbody>
                <tfoot>
                    <tr>
			<th>User ID</th>
                        <th>Username</th>
                        <th>Department</th>
                        <th>Role</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Created</th>
                    </tr>
                </tfoot>
                </table>
            </div><!--/.div -->
        </div><!--/.row -->
    </div><!--/.container-->
    
    <hr>
    
 <div class="container">
    <div class="row">
        <div class="span7"></div>
            <div class="span4">
                <a href="Registry.php" class="btn btn-primary">Add a user</a>
                <a href='AddUser_csv.php' class='btn btn-success'>
                    <i class='icon-upload icon-white'></i>Create users by csv</a>
            </div>
        <div class="span1"></div>
    </div><!--/.row -->
</div><!--/.container-->

<div id="confirm_popup" class="modal hide fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
                <div class="modal-body">
                    <p><strong>Are you sure to delete this user?</strong></p>
                    <div id="feedback-info"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn">Cancel</button>
                    <button id="confirm_btn" type="button" class="btn btn-danger btn-del">Confirm</button>
                </div>
</div>
            
    
    <script>
        $(function(){
            $("#user_table").dataTable();
            
            //$(".del-user-btn").click(function(){
            //    var $userid = $(this).data("userid");
            //    alert("User ("+$userid+") had been deleted!");
            //    $.ajax({
            //        type: "POST",
            //        url: "php/DelUser.php",
            //        data: {userid: $userid},
            //        success: function(msg){
            //            alert(msg);
            //            location.reload();
             //       },
             //       error: function(){
             //           alert("Failed to send the query to server!");
             //       }       
             //   }); 
            //});
            
            var div = $("#var_container");
            
           $(".btn-del").click(function(){
                // delte button define the fileid value
                    jQuery.data(div, "userid", $(this).data("userid"));
           });  
    
            $("#confirm_btn").click(function(){
                // retrieve the selected file's fileid from the container.
                var $userid = jQuery.data(div, "userid");
                $.ajax({
                    type: "POST",
                    url: "php/DelUser.php",
                    data: {userid: $userid},
                    success: function(msg){
                        alert(msg);
                        location.reload();
                    },
                    error: function(){
                        alert("Failed to send the query to server!");
                    }       
                }); 
            });
        });
   </script>
<?php include "php/footer.php"; ?>