<?php
    include "header.php";
    require "db/db_connection.php";
    
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
    // UI wrap
    echo "<div id='ui-wrap'>";
    // data stroage div
    echo '<div id="data-storage" data-projectid="'.$projectid.'"></div>';
    // engineer list wrap
    echo "<table><tr><td>";
    echo "<div id='engineer-panel' class='span5' style='width:300px;float:left'>";
    $mysql_query = "SELECT userid, firstname, lastname FROM user 
                    WHERE role='engineer' AND department = '{$department}'
                    ORDER BY lastname";
    $result_engineer = $db->query($mysql_query);
    if($result_engineer){
        // generate the wrap of enginner list
        echo '<div id="engineer-list"><h4 class="ui-widget-header">Engineer</h4><div id="enginner-list">';
        echo '<h4><a href="#">'.ucfirst($department).'</a></h4>';
        echo "<div><ul>";
        while($engineer = $result_engineer->fetch_assoc()){
            $userid = $engineer['userid'];
            $fn     = $engineer['firstname'];
            $ln     = $engineer['lastname'];
            // generate items representing enginners
            echo '<li class="engineer" data-val="'.$userid.'"><a class="btn"> '.$fn.' '.$ln.' </a></li>';
        }
        echo "</ul></div></div>";
    }
    // closed tag div 'engineer-list'
    echo "</div>";
    echo "</td>";
 
    // generate list of enginner
    // team wrap div
    echo "<td>";
    echo "<div id='team-panel' class='span5' style='width:400px;float:left'>";
    for($i = 1; $i <= $num_teams; $i++){ 
        echo '<div class="team" data-index="'.$i.'" >
                <h1 class="ui-widget-header">Team '.$i.'</h1>
                <div class="ui-widget-content">
                    <ol>
                        <li class="placeholder">Drop engineer here...</li>
                    </ol>
                </div>
           </div>';
    }
    // close tag div id='team-panel'
    echo "</div>";
    // add submit data
    echo "<div class='btn-group pull-right' style='margin:25px 25px 25px auto'>
           <a class='btn btn-warning' href='javascript:location.reload(true)'>Refresh</a>
           <a id='collect-data_btn' class='btn btn-primary' href='#'>Confirm</a>
           <a id='submit-data_btn' class='btn btn-success disabled' href='#'>Submit</a>
           </div>";
    echo "<div id='display-panel' class='text-center'></div>";
    // closed tag div id='ui-wrap';
    echo "</div>";
    echo "<td></tr><table>"
?>

   
    <script>
  var $data = $("#data-storage");     
  $(function() {
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
    $("#collect-data_btn").click(function(){
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
        $("#submit-data_btn").removeClass("disabled");
    });
    
    // send data to server
    $("#submit-data_btn").click(function(){        
        // harvest data
        var $data_item = jQuery.data($data, 'team');
        var $projectid = $("#data-storage").data("projectid");
        //var $data_send = JSON.stringify($data_item);
        $.ajax({
            method: "POST",
            url: "php/InsertTeam.php",
            data: {submit: $data_item, projectid: $projectid},
            success: function(msg){
                $("#display-panel").html(msg);
            }
        });
    });
    
  });
  
  
  </script>
  
  
  <?php include "footer.php"; ?>