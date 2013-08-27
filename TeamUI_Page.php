<?php
    include "php/header.php";
    require "php/db/db_connection.php";
?>
<hr>
<div class="container">
    
<?php
    
    // collect information needed;
    $projectid = $_GET['projectid'];
    $num_teams = $_GET['num_teams'];
    // get department information based on proejctid
    $mysql_query = "SELECT department FROM project WHERE projectid = {$projectid}";
    $result = $db->query($mysql_query);
    if($result){
        while($row = $result->fetch_assoc()){
            $department = $row['department'];
        }
    }else{
        echo "Failed to find the project.";
    }
?>
    <div class="row"></div>
    <!-- div for storing data to pass through different events-->
    <div id="data-storage" data-projectid="<?php echo $projectid; ?>"></div>
     <div id='ui-wrap' class='text-center'>
         <div class="row">
            <div class="span4">
            <div id="data-storage" data-projectid="<?php echo $projectid; ?>">Data Storage</div>
            <div id='engineer-panel' class='span5' style='width:300px;float:left'>
<?php
    $mysql_query = "SELECT userid, firstname, lastname FROM user 
                    WHERE role='engineer' AND department = '{$department}'
                    ORDER BY lastname";
    $result_engineer = $db->query($mysql_query);
    if($result_engineer){
?>
        <!-- generate the wrap of enginner list -->
        <div id="engineer-list">
            <h2 class="ui-widget-header">Engineers</h2>
            <div id="enginner-list" class="pull-left">
            <h4><a href="#"><?php ucfirst($department); ?></a></h4>
                <div>
                    <ul>
<?php
        while($engineer = $result_engineer->fetch_assoc()){
            $userid = $engineer['userid'];
            $fn     = $engineer['firstname'];
            $ln     = $engineer['lastname'];
            // generate items representing enginners
            echo '<li class="engineer" data-val="'.$userid.'"><a class="btn"> '.$fn.' '.$ln.' </a></li>';
        }
?>   
                    </ul>
                </div>
            </div>

<?php }
?>
                   
    
                </div><!-- /.engineer-list-->
                </div><!--/.engineer-panel -->
            </div><!--/.
         
    <!-- generate team section -->     
    <div class='span5'>
        <div id='team-panel' class='span5' style='width:400px;float:left'>
<?php 
    for($i = 1; $i <= $num_teams; $i++){ 
?>  
            <div class="team" data-index="<?php echo $i; ?>" >
                <h3 class="ui-widget-header">Team <?php echo $i; ?></h3>
                <div class="ui-widget-content">
                    <ol>
                        <li class="placeholder">Drop selected engineer here...</li>
                    </ol>
                </div>
           </div>
<?php } // for loop ends here ?>
        </div>
    </div><!--/.span 5 -->
    <div class="span2"></div>
        </div><!--/.row -->
    
    <div class="row">
    <div class='btn-group pull-right' style='margin:25px 25px 25px auto'>
           <a class='btn btn-danger' href='javascript:location.reload(true)'>Refresh</a>
           <a id='collect-data-btn' class='btn btn-primary' href='#'>Confirm</a>
           <a id='submit-data-btn' class='btn btn-success disabled' href='#'>Submit</a>
    </div>
   <div id='display-panel' class='text-center'></div>
    <div class="text-center">
        <div id="display-panel"></div>
    </div>
    </div> <!--/.row -->
     </div><!--/.ui-wrap-->
</div><!--/.container-->
   
<script>
  var $data = $("#data-storage");     
  $(function() {
     $(".disabled").unbind("click");
      
        //present div in div[id='catalog'] in accordions
    $( "#engineer-list" ).accordion(); 
    // define draggable
    $( "#engineer-list li" ).draggable({
      appendTo: "body",
      helper: "clone"
    });
    // droppable
    $( ".team ol" ).droppable({
      activeClass: "ui-state-default",
      hoverClass: "ui-state-hover",
      accept: ":not(.ui-sortable-helper)",
      drop: function(event, ui ) {
          // get the value of interested attribute
        var item_val = $(ui.draggable).attr('data-val');
        $("#item-disp").data("val");
        $( this ).find( ".placeholder" ).remove();// arrival of droppable item eliminates label
        var $this_li = $("<li></li>");
        $this_li.addClass("dropped-engineer");
        $this_li.html("<i class='icon-user'></i>" + ui.draggable.text());
        $this_li.addClass("btn");
        $this_li.attr('data-val', item_val); // add attribute value
        $this_li.appendTo(this); // include dropped draggable in the droppable
        // add attribute
        $(ui.draggable).remove();
      }
    }).sortable({
      items: "li:not(.placeholder)",
      sort: function() {
        // gets added unintentionally by droppable interacting with sortable
        // using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
        $( this ).removeClass( "ui-state-default" );
      }
    });
    
    // engineer section is droppable
    $("#team div").droppable({
        hoverClass: "ui-state-hover",
        activeClass: "ui-state-default",
        accept: ".dropped-engineer",
        drop: function(event, ui){
            var $this_li = $("<li></li>");
            $this_li.appendTo(this);
            $(ui.dragable).remove();
        }
    })
    
    // display
    $("#collect-data-btn").click(function(){
        // collect data
        $(".team").find("li").css('color', 'red');
        var $index_col = new Array();
        var $text_array = new Array();
        $(".team").each(function(idx, cart){
            var $items = $(cart).find("li");
            var $index = $(cart).data("index");
            $items.each(function(index, value){
                var $val = $(value).data("val");
                if($val){
                    $text_array.push({
                        userid: $val,
                        team: $index
                    });
                }
            });
        })     
        jQuery.data($data, 'team', $text_array);
        $("#submit-data-btn").removeClass("disabled");
    });
    
    $("#pop-data-btn").click(function(){
        var $data_array = jQuery.data($data, 'team').pop();
        window.alert("team:" + $data_array['team'] + "; userid: "+ $data_array['userid']);
    });
    
    // send data to server
    $("#submit-data-btn").click(function(){        
        // harvest data
        var $data_item = jQuery.data($data, 'team');
        var $projectid = $("#data-storage").data("projectid");
	$("#display-panel").addClass("alert").html("Uploading...");

        $.ajax({
            method: "POST",
            url: "php/InsertTeam.php",
            data: {submit: $data_item, projectid: $projectid},
            success: function(msg){
                $("#display-panel").addClass("alert-success").html(msg);
            }
        });
    });
    
  });
  
  
  </script>

    <!-- -->
    <hr>
    <footer class="footer">
          <div class="container" style="text-align: center; min-height: 40px; margin-top: 5px">
              <p>&copy; 2013 <strong>STAR Corp.</strong></p>
          </div>
      </footer>
 </body>
 </html>
    