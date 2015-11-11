<?php
	session_start();
	include("includes/dbcon.php");
	if(!($_SESSION['login'])) {
		header("Location: index.php");
	}
	else {																									
		$btnactive = "<button class='btn btn-inverse btn-mini'><name='actiStud'> Update</button>";

		$studID = $_REQUEST['var'];
		$sql = mysql_query("SELECT * FROM tbl_student WHERE student_id='$studID'");
		while($row = mysql_fetch_object($sql))
		{  
			$fname = $row->first_name;
			$lname = $row->last_name;
		}
		$classID2 = $_REQUEST['del'];
?>
<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Administrator | User Account Manager</title>
		    <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <!-- Bootstrap -->
		<link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
		<link href="../_public/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen"> 
		<link href="../_public/assets/styles.css" rel="stylesheet" media="screen"> 
		<link href="../_public/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="../_public/http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="../_public/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		<script>
		function myFunction()
			{
			var x;
			var fname = "<?php echo $fname; ?>";
			var lname = "<?php echo $lname; ?>";
			var r=confirm(fname+" "+lname" has encoded grades in the selected class. Continue?");
			if (r==true)
			  {
			  x="You pressed OK!";
			  }
			else
			  {
			  x="You pressed Cancel!";
			  }
			document.getElementById("demo").innerHTML=x;
			}
		</script>
    </head>
    
    <body>
<?php include 'includes/navbar.php'; ?>
        <div class="container-fluid">
            <div class="row-fluid">
<?php include 'includes/sidebar.php'; ?>
                
                <!--/span-->
                <div class="span9" id="content">
                    <div class="row-fluid">
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href="dashboard.php">Dashboard</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li>User Account Manager</a></li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            	<div class="bs-example">
            <ul class="nav nav-tabs" style="margin-bottom: 15px; margin-top:50px;">
                <li class="active"><a href="#student" data-toggle="tab">Student</a></li>
                <li><a href="#instructor" data-toggle="tab">Instructor</a></li>
                <li><a href="#parent" data-toggle="tab">Parent</a></li> 
                <li><a href="#subject" data-toggle="tab">Subject</a></li>
			</ul>
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="student">
					<p>                 
                        <!-- block -->
						<?php 
							if(isset($_REQUEST['var'])) {
								$studID = $_REQUEST['var']; 
								if(isset($_REQUEST['del'])) {
									$classID = $_REQUEST['del']; 
									$clear = mysql_result(mysql_query("SELECT count(*) FROM tbl_finalgrade WHERE class_class_id='$classID'"),0);
									if($clear) {
										echo '<script type="text/javascript">'
											   , 'myFunction();'
											   , '</script>';
										//echo "<script>alert(\"Are you sure?\")</script>";
									}
									else {
										//mysql_query("DROP * FROM tbl_grades WHERE class_class_id='$classID'") or die(mysql_error());
										//mysql_query("DROP * FROM tbl_finalgrade WHERE class_class_id='$classID'") or die(mysql_error());
										mysql_query("DELETE FROM tbl_class_class WHERE class_class_id='$classID'") or die(mysql_error());
										echo "<script>alert(\"".$fname." ".$lname." "."has been removed from the selected class.\")</script>";
									}
								}?> 
								<div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>Classes</h5></div>
                                    <div class="pull-right"><a href="user.php?var=<?php echo $studID;?>&add=1">
                                      <button class="btn" style="margin-bottom:5px;">Add Class</button></a>
                                    </div>
                                </div>
                               
									 <div class="block-content collapse in">
									 <h3><?php echo $studID.' - '.$fname.' '.$lname; ?></h3>
									<?php
										if(isset($_REQUEST['add'])) {
											if(isset($_REQUEST['addClass'])) {
												$classID = $_REQUEST['addClass'];
												mysql_query("INSERT INTO tbl_class_class(class_id, student_id) VALUES('$classID','$studID')") or die(mysql_error());
												$enrollID = mysql_result(mysql_query("SELECT class_class_id FROM tbl_class_class WHERE class_id='$classID' and student_id='$studID'"),0);
												/*$sql = mysql_query("SELECT * FROM tbl_component WHERE class_id='$classID'") or die(mysql_error());
												while($row=mysql_fetch_array($sql)) {
													$component = $row['name'];
													$no = $row['required_number'];
													for($i=1;$i<=$no;$i++) {
														mysql_query("INSERT INTO tbl_grades (component, category, class_class_id) VALUES ('$component','$i','$enrollID')") or die(mysql_error());
													}
														mysql_query("INSERT INTO tbl_grades (component, category, class_class_id) VALUES ('$component','AVG','$enrollID')") or die(mysql_error());
												}*/
											}
											if($_REQUEST['add']==1) { ?>
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered">

                                        <thead>
                                            <tr>
                                                <th>Class</th>
                                                <th>Course Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
											<tbody>

												<?php
													$sql = mysql_query("SELECT * FROM tbl_class_class cc, tbl_class c WHERE cc.student_id='$studID' AND cc.class_id=c.class_id");
													while($row = mysql_fetch_object($sql))
													{
														$course = $row->course_code;
														$desc = mysql_result(mysql_query("SELECT description FROM tbl_course WHERE course_code='$course'"),0);
														$classID = $row->class_class_id;
														echo "<tr>";
														echo "<td>" . $row->section.' - '.$row->course_code. "</td>";
														echo "<td>" . $desc . "</td>";
														echo "<td><a href=\"user.php?var=$studID&add=1&del=$classID\"><button class='btn btn-success btn-mini'><name='btnRm'>Remove</button></a></td>";
														echo "</tr>";
													}
												?>
												</tbody>
                                    </table>
									 <h3>Classes not part of  <?php echo $fname.' '.$lname.'\'s'; ?> schedule</h3>
										<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">

                                        <thead>
                                            <tr>
                                                <th>Class</th>
                                                <th>Course Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
											<tbody>

												<?php
												$courses = array();
												$sql = mysql_query("SELECT * FROM tbl_class_class WHERE student_id='$studID'");
													while($row = mysql_fetch_object($sql))
													{ 
														$classID = $row->class_id;
														array_push($courses, $classID);
													}
													
												$sql = mysql_query("SELECT * FROM tbl_class ");
													while($row = mysql_fetch_object($sql))
													{ 
														$course = $row->course_code;
														$desc = mysql_result(mysql_query("SELECT description FROM tbl_course WHERE course_code='$course'"),0);
														$classID = $row->class_id;
														if (in_array($classID, $courses)) {
															    
														}
														else {
															echo "<tr>";
															echo "<td>" . $row->section.' - '.$row->course_code. "</td>";
															echo "<td>" . $desc . "</td>";
															echo "<td><a href=\"user.php?var=$studID&add=1&addClass=$classID\"><button class='btn btn-success btn-mini'><name='btnRm'>Add</button></a></td>";
														}
													}
												
													/*$sql = mysql_query("SELECT distinct(c.class_id), cr.description, c.section, c.course_code, c.class_id FROM tbl_class_class cc, tbl_class c, tbl_course cr WHERE cc.student_id!='$studID' AND cc.class_id!=c.class_id AND c.course_code=cr.course_code "); 
													while($row = mysql_fetch_object($sql))
													{
														$classID = $row->class_id;
														echo "<tr>";
														echo "<td>" . $row->section.' - '.$row->course_code. "</td>";
														echo "<td>" . $row->description . "</td>";
														echo "<td><a href=\"user.php?var=$studID&add=1&addClass=$classID\"><button class='btn btn-success btn-mini'><name='btnRm'>Add</button></a></td>";
														echo "</tr>";
													}*/
												?>
												</tbody>
                                    </table>
									<?php } 
									}
									else { ?>
									 <div class="block-content collapse in">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">

                                        <thead>
                                            <tr>
                                                <th>Class</th>
                                                <th>Course Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
											<tbody>

												<?php
													$sql = mysql_query("SELECT * FROM tbl_class_class cc, tbl_class c WHERE cc.student_id='$studID' AND cc.class_id=c.class_id");
													while($row = mysql_fetch_object($sql))
													{
														$course = $row->course_code;
														$desc = mysql_result(mysql_query("SELECT description FROM tbl_course WHERE course_code='$course'"),0);
														$classID = $row->class_class_id;
														echo "<tr>";
														echo "<td>" . $row->section.' - '.$row->course_code. "</td>";
														echo "<td>" . $desc . "</td>";
														echo "<td><a href=\"user.php?var=$studID&add=1&del=$classID\"><button class='btn btn-success btn-mini'><name='btnRm'>Remove</button></a></td>";
														}
												?>
												</tbody>
                                    </table>
									</div>
									<?php }?>
                                </div>
                            </div> <?php 
							}
							else {
						?>
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>Students</h5></div>
                                    <div class="pull-right"><a href="createStudent.php">
                                      <button class="btn btn-success" style="margin-bottom:5px;"><i class=" icon-plus icon-white"></i> Create Single Entry</button>
                                    </a>
                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">

                                        <thead>
                                            <tr>
                                                <th>Student No.</th>
                                                <th>First Name</th>
												<th>Middle Name</th>
                                                <th>Last Name</th>
												<th>Gender</th>
                                                <th>Birthday</th>
												<th>Program</th>
												<th>Contact</th>
												<th>Email</th>
												<th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
											<tbody>

												<?php
													$sql = mysql_query("SELECT * FROM tbl_student");
													while($row = mysql_fetch_object($sql))
													{
														$studID = $row->student_id;
														echo "<tr>";
														echo "<td><a href=\"user.php?var=$studID\">" . $row->student_id . "</a></td>";
														echo "<td>" . $row->first_name . "</td>";
														echo "<td>" . $row->middle_name . "</td>";
														echo "<td>" . $row->last_name . "</td>";
														echo "<td>" . $row->gender . "</td>";
														echo "<td>" . $row->birthday . "</td>";
														echo "<td>" . $row->program . "</td>";
														echo "<td>" . $row->contact . "</td>";
														echo "<td>" . $row->email . "</td>";
														if($row->status==1) {
														echo "<td>Active</td>";
														}
														else {
														echo "<td>Inactive</td>";
														}
														echo "<td>" . "<a href=\"usera.php?myVar=$row->student_id\">". $btnactive."</td>";
														echo "</tr>";
													}
												?>
												</tbody>
                                    </table>
                                </div>
                            </div>
							<?php } ?>
					</p>
                </div>
				
                <div class="tab-pane fade" id="instructor">				
                  <p>
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>Instructors</h5></div>
                                    <div class="pull-right"><a href="createInstructor.php">
                                      <button class="btn btn-success" style="margin-bottom:5px;"><i class=" icon-plus icon-white"></i> Create Single Entry</button>
                                    </a>
                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example1">
                                        <thead>
                                            <tr>
                                                <th>Employee #</th>
                                                <th>First Name</th>
												<th>Middle Name</th>
                                                <th>Last Name</th>
												<th>Gender</th>
												<th>Contact</th>
												<th>Email</th>
												<th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
										<tbody>

										<?php
											$sql = mysql_query("SELECT * FROM tbl_instructor");
											while($row = mysql_fetch_object($sql))
											{
												echo "<tr>";
												echo "<td>" . $row->instructor_id . "</td>";
												echo "<td>" . $row->first_name . "</td>";
												echo "<td>" . $row->middle_name . "</td>";
												echo "<td>" . $row->last_name . "</td>";
												echo "<td>" . $row->gender . "</td>";
												echo "<td>" . $row->contact . "</td>";
												echo "<td>" . $row->email . "</td>";
												if($row->status==1) {
														echo "<td>Active</td>";
														}
														else {
														echo "<td>Inactive</td>";
														}
												echo "<td>" . "<a href=\"userb.php?myVar=$row->instructor_id\">". $btnactive."</td>";
												echo "</tr>";
											}
										?>
										</tbody>
                                    </table>
                                </div>
                            </div>				  
					</p>
                </div>
				
                <div class="tab-pane fade" id="parent">
				<p>
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>Parents</h5></div>
                                </div>
                                <div class="block-content collapse in">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example2">
                                        <thead>
                                            <tr>
                                                <th>Child's Student ID</th>
                                                <th>Username</th>
												<th>Status</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
										<tbody>

										<?php
											$sql = mysql_query("SELECT * FROM tbl_parent");
											while($row = mysql_fetch_object($sql))
											{
												echo "<tr>";
												echo "<td>" . $row->child_id . "</td>";
												echo "<td>" . $row->username . "</td>";
												if($row->status==1) {
														echo "<td>Active</td>";
														}
														else {
														echo "<td>Inactive</td>";
														}
												echo "<td>" . "<a href=\"userc.php?myVar=$row->child_id\">". $btnactive."</td>";
												echo "</tr>";
											}
										?>
                                    </table>
                                </div>
                            </div>				
				</p>
                </div>
				
                  <div class="tab-pane fade" id="subject">
				<p>
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>Courses</h5></div>
                                </div>
                                <div class="block-content collapse in">
                                   <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example3">
                                        <thead>
                                            <tr>
                                                <th>Course Code</th>
                                                <th>Description</th>
                                                <th>Unit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
											
											$sql = mysql_query("SELECT * FROM tbl_course");
											while($row = mysql_fetch_array($sql))
											{
											echo "<tr>";
											echo "<td>" . $row['course_code'] . "</td>";
											echo "<td>" . $row['description'] . "</td>";
											echo "<td>" . $row['unit'] . "</td>";
											echo "</tr>";
											}
										?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>				
				</p>
                </div>
              </div>
            </div>
                        </div>
                        <!-- /block -->
                    </div>


                </div>
            </div>
        </div>
<?php include 'includes/footer.php'; ?>    
        <!--/.fluid-container-->
        <script src="../_public/vendors/jquery-1.9.1.min.js"></script>
        <script src="../_public/bootstrap/js/bootstrap.min.js"></script>
        <script src="../_public/vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="../_public/assets/scripts.js"></script>
        <script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000});
        });
        </script>
		
		
        <script src="../_public/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<script src="../_public/assets/DT_bootstrap.js"></script>
        
		<script>
        $(function() {
            
        });
        </script>
    </body>

</html>
<?php } ?>