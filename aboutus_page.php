<?php $page_name = "aboutus"; ?>
<?php require 'php/header.php'; ?>  
    
	<div class="container">
		<!-- PAGE TITLE -->
		<div class="row">
			<div class="span12">
				<!-- PROJECT INFO -->
				<!-- breadcrubs:project organizations-->
					<div class="project-breadcrubs">
						<ul class="breadcrumb">
  							<li><a href="#">About Us</a>
					</div><!--.project-bradcrubs-->				
				</div>
		</div><!--/.row-->

                
		<div class="row">
                    <!-- sidebar for improving accessibility of reading long texts-->
                        <div class="span3 bs-docs-sidebar">
                            <ul class="nav nav-list bs-docs-sidenav affix">
                                <li>
                                    <a href="#company_intro">
                                        <i class="icon-chevron-right"></i>
                                        About Us
                                    </a>
                                </li>
                                <hr>
                                <li>
                                    <a href="#academic_mission">
                                        <i class="icon-chevron-right"></i>
                                        Academic Mission
                                    </a>
                                </li>
                                <hr>
                                <li>
                                    <a href="#contact">
                                        <i class="icon-chervon-right"></i>
                                        Contact
                                    </a>
                                </li>
                            </ul>   
                        </div>
                    
                        <div class="span9">
                        <div class="theme-image" style="text-align:left">
                            <img src="img/team_graduates.jpg" class="img-polaroid">
                        </div>
                        <section name="company_intro" id="company_intro">
                            <h3>About US</h3>
                            <p>STAR Corp. Technical Center is a virtual company that aims to exposed students to real-world industrial problems that will have a direct bearing on fundamental engineering concepts. The goal is to produce “industry ready” graduates that require minimum or no after-hire training.</p>
                            <p>Selected real-world industrial problems are broken down into sub-problems and mapped to a set of key concepts taught in clusters of core courses in the Mechanical Engineering curriculum. These problems are presented as projects and assigned to engineers working in different departments in STAR Corp. Technical Center (i.e., students taking different courses). These student engineers are required to post their works (proposed solutions and the procedures they used) in the Technical Center repository during different stages of the project work (learning process). Their works are viewed by department directors (i.e., course instructors), consultants (i.e., industry partners), and other engineers (students) who can provide periodical feedback. When a project is finished, the consultant meets with engineers to discuss the pros and cons of each solution from a real-world industry perspective.  
                            </p>
                        </section>
                            <hr>
                         <section name="academic_mission" id="academic_mission">
                            <h3>Academic Mission</h3>
                            <p>STAR Corp. Technical Center is supported by the National Science Foundation under grant no. DUE-1141120. It is a concrete implementation of the problem-based learning pedagogy in a well-designed learning environment. Requiring students to post the procedures they used for solutions allows instructors to use “diagnostic teaching” to achieve learner-centered education. Mapping real-world problems to key engineering concepts in the entire curriculum and sub-problems to courses help students “learn their way around” the Mechanical Engineering discipline; thus achieving knowledge-centered education. During the learning process, instructors and industry partners provide periodical review and feedback (formative assessment); in the meantime students also learn to assess their own work and that of their peers to help everyone learn more effectively. Finally, solving real-world problems that address the needs of the local industry provides a connection to the broader community.
                            </p>
                            <p>By unifying engineering education with industrial reality, undergraduates will be better educated in applying theory to solving real-world problems; thus allowing every stakeholder to maximize their return on investment in the education process. In addition, corporations will have better qualified applicants for their job openings, and faculty will have better awareness of the needs of corporate America, thus building an infrastructure of partnerships and networks for both education and research.<br>
                             </p>
                        </section> 
                            <hr>
                               <section name="contact" id="contact">
                            <h3>Contact</h3>
                            <div class="contact-card pull-left well" style="text-align: left;margin:20px 20px 20px 20px">
                                <h5>Dr. Samuel Huang</h5>
                                <p><strong>Phone:</strong><span>&nbsp 513-556-1154</span><br>
                                    <strong>Email:</strong>&nbsp sam.huang@uc.edu 
                                </p>
                            </div>
                            <div class="contact-card pull-left well" style="text-align: left;margin:20px 20px 20px 20px">
                                <h5>Dr. Sam Anand</h5>
                                <p><strong>Phone:</strong><span>&nbsp 513-556-5596</span><br>
                                    <strong>Email:</strong>&nbsp sam.anand@uc.edu 
                                </p>
                            </div>
                        </section>

                        </div><!--/.span10-->
                        <div class="span1"></div>
                    </div>
               
     
        <?php include_once 'php/footer.php'; ?>   