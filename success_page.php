<?php 
    include "php/header.php";
?>
    <script type="text/javascript" src="assets/js/jquery-1.9.1.min.js"></script>
    
    <div class="container" style="min-height:85%">
        <div class="row">
            <div class="alert alert-success">
                <strong>Congratulation!<br></strong>
                <?php if($_GET['msg']){ 
                    echo $_GET['msg'];
                } ?>     
            </div>
        </div>
    </div>
    
<?php
    include "php/footer.php";
 ?>