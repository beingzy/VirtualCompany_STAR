<?php 
     // define page enviroment varaibles
     $page_name = "department"; 
     $department = "quality assurance";
     
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
			<div class="span3">
                            	<div class="bs-docs-sidebar">
                                    <?php
                                    // load side-bar generator function
                                        include "php/ProjectSideNav.php"; 
                                        $navbar = ProjectSideNav($db, $department);
                                        echo $navbar;
                                    ?>
                                </div>
			</div>
			
			<!-- Project description-->
			<div class="span9">
                            <div class="well department-intro">
                                <!-- Department Picture -->
                                <img src="img/product/deck_services.jpg" class="img-rounded"/>
                                <div class="narrative" style="margin: 10px auto 10px auto;">
                                    <h4>Introduction</h4>
                                    <div class="divider"></div>
                                    <p>The Quality Assurance Department aims to ensure that all
                                    products produced by STAR Corp. meet customer requirements. Engineers in this
                                    Department are proficient in Engineering Statistics. They analyze data collected from
                                    designed experiments, random sampling inspections, production monitoring, and
                                    customer reports to identify quality related problems. Solutions are the developed to
                                    solve these problems.
                                    </p>
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
                                    <img src="img/product/product01.jpg" height="400" width="300" alt="" />
                                    <h3></h3>
                                    <p>Product Name</p>
                                </div>
                            </li>
                            
                            <li class="span3">
                                <div class="thumbnail">
                                    <img src="img/product/product02.jpg" height="400" width="300" alt="" />
                                    <h3></h3>
                                    <p>Product Name</p>
                                </div>
                            </li>
                            
                            <li class="span3">
                                <div class="thumbnail">
                                    <img src="img/product/product03.jpg" height="400" width="300" alt="" />
                                    <h3></h3>
                                    <p>Product Name</p>
                                </div>
                            </li>
                        </ul>
                    </div>                    
                </div><!--/.row -->
                
	</div><!--/.container--> 
                
     
        <?php include_once 'php/footer.php'; ?>   
