<?php 
    include "php/header.php";
?>
    <script type="text/javascript" src="assets/js/jquery-1.9.1.min.js"></script>
    
    <div class="container" style="min-height:85%">
        <div class="row">
            <div class="alert alert-error">
                <strong>Oops, some errors occurs in the processing of your command.<br></strong>
                <?php if(isset($_GET['msg'])){
                        echo "<strong>{$_GET['msg']}</strong><br>";
                }; ?>
                <?php if(isset($_GET['db_error'])){ 
                    echo "Your Database encounter problems:<br>
                          <strong>{$_GET['db_error']}</strong>";
                } ?>
            </div>
        </div>
    </div>
    
<?php
    include "php/footer.php";
 ?>