<?php 
     // define page enviroment varaibles
     $page_name = "department"; 
     $department = "manufacturing";
     
     require 'php/header.php'; 
    ?>  
    
	<div class="container">
		<!-- PAGE TITLE -->
		<div class="row">
			<div class="span12">
				<!-- PROJECT INFO -->
				<!-- breadcrubs:project organizations-->
					<div class="project-breadcrubs">
						<ul class="breadcrumb">
                                                    <li><a href="#"><?php echo ucfirst($department); ?></a>
					</div><!--.project-bradcrubs-->				
				</div>
		</div><!--/.row-->

                
		<div class="row">
			<!-- SIDE NAVS -->
			<!-- Category  -->
                        <div class="span3">
                            	 <?php
                                    // load side-bar generator function
                                        include "php/ProjectSideNav.php"; 
                                        $navbar = ProjectSideNav($db, $department);
                                        echo $navbar;
                                    ?>
			</div>

			
			<!-- Project description-->
			<div class="span9">
                            <div class="well department-intro">
                                <!-- Department Picture -->
                                <img src="img/product/service.jpg" class="img-rounded"/>
                                <div class="narrative" style="margin: 10px auto 10px auto;">
                                    <section id="s_intro">
                                    <h4>Introduction</h4>
                                    <div class="divider"></div>
                                    <p>The Manufacturing Department provides support for tooling, machining, 
                                       and assembly operations to ensure the efficiency of the manufacturing operations 
                                       in STAR Corp. Engineers in this Department are knowledgeable in a variety of 
                                       manufacturing processes. The use their knowledge and analytical skills for process 
                                       design and improvement.
                                    </p>
                                    </section>
                                </div>
                            </div>
			</div><!--/.span9-->						
		</div><!--/.row-->
		
                
                <hr>
                
                <div class="row">
                    <div class="span3"></div>

                    <div class="span9">
                        
                        
                        <!-- product gallery -->
                        <ul class="thumbnails">
                            <li class="span3">
                                <div class="thumbnail">
                                    <img src="img/product/product05.jpg" height="400" width="300" alt="" />
                                    <h3></h3>
                                    <p>Product Name</p>
                                </div>
                            </li>
                            
                            <li class="span3">
                                <div class="thumbnail">
                                    <img src="img/product/product06.jpg" height="400" width="300" alt="" />
                                    <h3></h3>
                                    <p>Product Name</p>
                                </div>
                            </li>
                            
                            <li class="span3">
                                <div class="thumbnail">
                                    <img src="img/product/product07.jpg" height="400" width="300" alt="" />
                                    <h3></h3>
                                    <p>Product Name</p>
                                </div>
                            </li>
                        </ul>
                    </div>                    
                </div><!--/.row -->
                
	</div><!--/.container--> 
                
     
        <?php include_once 'php/footer.php'; ?>   