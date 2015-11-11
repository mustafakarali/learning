<?php
	session_start();
	include("includes/dbcon.php");
													

if(!($_SESSION['login'])) {
		header("Location: index.php");
	}
else {
	if(isset($_REQUEST['myId']))
		{
			$studID = $_REQUEST['myId'];
			$classID = $_REQUEST['myVar'];
			$sql1 = mysql_query("INSERT into tbl_class_class(class_id,student_id,late_status) VALUES('$classID','$studID','1')")
								or die(mysql_error());
								
				echo "<script>alert (\"Student is Successfully Added to Class!\")</script>";
		}
?>
<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Administrator | Adding to Class</title> <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <!-- Bootstrap --> <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen"> <link href="../_public/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen"> <link href="../_public/assets/styles.css" rel="stylesheet" media="screen"> <link href="../_public/assets/DT_bootstrap.css" rel="stylesheet" media="screen">        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="../_public/http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="../_public/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
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
	                                        <a href="class.php">Back</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li>Adding to Class</li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            	<div class="bs-example">
            
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="top">
					
                <p>                 
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>List of Late Enrollee Students</h5></div>
                                </div>
                                <div class="block-content collapse in">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">

                                        <thead>
                                            <tr>
                                                <th>Student ID</th>
												<th>FName</th>
												<th>MName</th>
												<th>LName</th>
												<th>Course</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
													$id = $_REQUEST['myVar'];
													$btnactive = "<button class='btn btn-success btn-mini' name='add'> Add Student</button>";
													
													$sql = mysql_query("SELECT * FROM tbl_student WHERE late_status=1") or die(mysql_error());
													
													/*$sql = mysql_query("SELECT * FROM tbl_class_class c, tbl_student s WHERE class_id!='$id' AND c.student_id=s.student_id AND s.late_status='1' AND c.late_status='0'")
																																   or die(mysql_error()) ;*/
													
														while($row = mysql_fetch_array($sql))
														{
															$a = 0;
															$student = $row['student_id'];
															$sql2 = mysql_query("SELECT class_id FROM tbl_class_class WHERE student_id='$student'") or die(mysql_error()) ;				
																																   
															while($row2 = mysql_fetch_array($sql2))
															{
																if($row2['class_id']=="$id") {
																	$a = 1;
																	break;
																}
															}
															if($a==0) {
																echo "<td>" . $row['student_id'] . "</td>";
																echo "<td>" . $row['first_name'] . "</td>";
																echo "<td>" . $row['middle_name'] . "</td>";
																echo "<td>" . $row['last_name'] . "</td>";
																echo "<td>" . $row['program'] . "</td>";
																echo "<td>" . "<a href=\"classList.php?myVar=$id&myId=$student\"><button class='btn btn-success btn-mini'>Add Student</button></a>" ."</td>";
																echo "</tr>";
															}
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
            <hr>
<?php include 'includes/footer.php'; ?>
        </div>
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
<?php
}
?>