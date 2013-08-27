<?php $page_name="department"; ?>
<?php include_once 'php/header.php'; ?>
 
    <!-- MAIN 
	==========================================================-->
	<div class="container">
		<!-- PAGE TITLE -->
		<div class="row">
			<div class="span12">
				<!-- PROJECT INFO -->
				<!-- breadcrubs:project organizations-->
					<div class="project-breadcrubs">
						<ul class="breadcrumb">
  							<li><a href="#">Quality Assurance</a> <span class="divider">/</span></li>
  							<li class="active">Shaft-and-Hole Assembling</li>
  						</ul><!--/.braedcrumb-->
					</div><!--.project-bradcrubs-->				
				</div>
		</div><!--/.row-->
		
   
                
		<div class="row">
			<!-- SIDE NAVS -->
			<!-- Category  -->
			<div class="span3">
				<div class="side-nav">
					<ul class="nav nav-tabs nav-stacked pull-left" style="width:100%">
						<li class="active"><a href="#" data="tab">Shaft-and-Hole Assembling</a></li>
						<li><a href="#">Project 3</a></li>
						<li><a hfre="#">Project 2</a></li>
						<li><a hfre="#">Project 1</a></li>
					</ul>
				</div><!--side-nav-->			
			</div>
			
			<!-- Project description-->
			<div class="span9">
				<!--<div class="design-block" style="height:400px"><p>Porjects Description<p></div>-->
                                <h3>Choose Your Supplier: Shaft-and-Hole Assembling</h3>
                                <hr style="height:5px">
                                <div class="well tabbable">
  					<div class="embed-container">
                                             <iframe width="560" height="315" src="http://www.youtube.com/embed/8VcIfaNxsvg" frameborder="0" allowfullscreen></iframe>       
                                        </div>
                                    <div>
                                        <h4>General Explanation of Worm gearbox</h4>
<p>A worm gearbox is a mechanic unit, whose main functional components is a gear arrangement consisted of a worm-shaft and a worm-wheel. A worm gear delivers the capability of substantially reducing rotational speed and allowing higher torque to be transmitted. For explanation, with a single start worm, worm-wheel advances only a single tooth of gear by a 360° turn of worm-shaft. Therefore, for deploying a single start worm, the gear ratio is "size of the worm-wheel gear divided by 1". For instance, a gearbox of a 18 tooth worm-wheel and a single start worm can reduce the rotational speed by a ratio of 18:1.
</p>
<p>As a compact means of substantial increasing torque by reducing rotational speed, gearbox had been applied to various mechanical systems for translating the mechanical properties in a manipulative manner. For example, electric motors are generally having high-speed and low-torque output. Employing a gearbox can make this line of motors meet the requirements of a wider range of applications.
</p>
<h4>Problem Statement</h4>
<p>Our department, Quality Assurance, is requested to inspect the worm-shaft and associated bearing regarding the failure rate of forming transitional fits. The concern about the failure of satisfying the transitional fit between worm-shafts and bearings has arisen after the supply of new parts. This is because that a significant number of produced gearboxes had been reported to fail to pass performance tests. In addition, an increased failure rate of assembling these parts, particular between worm-shafts and bearings, had also been documented in manufacturing department. And, in fact, the worm-shafts and bearings were fabricated by two different companies. In order to avoid failing to meet our quality standards, our department must find out the causing factors.
</p>
<p>In order to answer the claim, there are a number of steps we have to go through with analytic answers. They are:<p>
	
<ol>
<li>Confirm the significance of failure of assembling;</li>
	
<li>If the increased failure rate had been confirmed significant, the manufacturing quality of each type of products must to be inspected regarding if they meet their dimension and tolerance specification;</li>
	
<li>In order to ensure that the quality target can be met, a quality control procedure must to be developed. Therefore, as a long-term solution, acceptable quality limit (AQL) particular needs to be determined and associated sampling plan must be spcified.
</li>
</ol>	

                                    </div>
				</div><!-- /.tabbable -->
			</div><!--/.span9-->						
		</div><!--/.row-->
		
		<div class="row">
                    <div class="span3">
                    </div>
			
			<!-- REQUIREMENT 
			========================================================-->
			<div class="span9">
                            <!-- Display uploaded files-->
                                <?php 
                                    if($_SESSION['login'])
                                    {
                                            if($_SESSION['role'] == 'engineer')
                                             echo "
                                                    <div class='well'><h5>Upload your solution</h5>
                                                    <form action='php/AddFile.php' method='post' enctype='multipart/form-data'>
                                                    <label for='file'>Filename:</label>
                                                    <input type='file' name='uploaded_file' id='uploaded_file'><br>
                                                    <input type='submit' name='submit' value='Submit'>
                                                    </form></div>";
                                    }
                                ?>
                            
                        </div>
                </div><!--/.row -->
                
                <hr>
                <div class="row">
                    <div class="span12">
                        <div class="table-wrapper">
                            <h5>Files submitted by your team are considered as the project solution:</h5>
                           <?php 
                                   if($_SESSION['login'])
                                   {
                                       if($_SESSION['role'] == 'engineer')
                                       {
                                           include "php/ListFile.php";
                                       }
                                   }
                          ?>
                        </div>
                    </div>
                </div><!--/.row-->
		
	</div><!--/.container-->
    
    <?php include_once 'php/footer.php'; ?>