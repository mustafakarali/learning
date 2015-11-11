<?php
	session_start();
	include("includes/dbcon.php");
	if(!($_SESSION['login'])) {
		header("Location: index.php");
	}
	else {												
$btnactive = "<button class='btn btn-success btn-mini'><name='view'> View</button>";

?>
<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Administrator | Achievement Board</title>
                    <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <!-- Bootstrap -->
		<link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="../_public/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
        <link href="../_public/assets/DT_bootstrap.css" rel="stylesheet" media="screen">        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]><script src="../_public/http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]--><script src="../_public/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
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
	                                        <a href="achieve.php">Back</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li>Achievement Board</li>
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
                                    <div class="muted pull-left"><h5>Overall Ranking - Fourth Year</h5></div>
									<form method="post" action="">
									<div class="pull-right"><button class="btn btn-success btn-mini" name="acti"> Activate</button>
										<button class="btn btn-danger btn-mini" name="deac"> Deactivate</button>
                                    </a>
                                    </div>
								</div>
                                <div class="block-content collapse in">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">

                                        <thead>
                                            <tr>
												<th>Grade</th>
                                                <th>Student Number</th>
												<th>First Name</th>
                                                <th>Middle Name</th>
												<th>Last Name</th>
												<th>Course</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
													$selection = mysql_query("Select sy FROM tbl_batch WHERE status='1' ORDER BY sy DESC LIMIT 1")
													or die(mysql_error());
													while($row = mysql_fetch_array($selection)){
														$batch = $row['sy'];
													}
													$sql = mysql_query("SELECT s.student_id, s.first_name, s.middle_name, s.last_name, s.program, c.cgpa
													FROM tbl_student s
													JOIN tbl_cgpa c ON s.student_id = c.student_id
													WHERE s.level='4'
													ORDER BY c.cgpa DESC ");
													while($row = mysql_fetch_array($sql))
													{
														$a = $row['cgpa'];
														$b = $row['student_id'];
														$c = $row['first_name'];
														$d = $row['middle_name'];
														$e = $row['last_name'];
														$f = $row['program'];
														
														echo "<tr>";
														echo "<td>" . $row['cgpa'] . "</td>";
														echo "<td>" . $row['student_id'] . "</td>";
														echo "<td>" . $row['first_name'] . "</td>";
														echo "<td>" . $row['middle_name'] . "</td>";
														echo "<td>" . $row['last_name'] . "</td>";
														echo "<td>" . $row['program'] . "</td>";
														echo "</tr>";
														
														if(isset($_POST['acti']))
														{
															$activate = mysql_query("INSERT INTO tbl_achievetfourth(cgpa,student_id,first_name,middle_name,last_name,program,status)
																		VALUES ('$a','$b','$c','$d','$e','$f',1)") or die(mysql_error());
															$msg = "<script>alert (\"Rankings are now activated on the homepage!\")</script>";
														}
														else if(isset($_POST['deac']))
														{
															$deactivate = mysql_query("UPDATE tbl_achievefourth SET status='0'") or die(mysql_error());
															$msg = "<script>alert (\"Rankings are now deactivated on the homepage!\")</script>";
														}
													}
												?>
                                        </tbody>
                                    </table>
									<?php if(isset($_POST['acti'])) { echo $msg; }?>
										<?php if(isset($_POST['deac'])) { echo $msg; }?>
									</form>
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
        <!--/.fluid-container--><script src="../_public/vendors/jquery-1.9.1.min.js"></script><script src="../_public/bootstrap/js/bootstrap.min.js"></script><script src="../_public/vendors/easypiechart/jquery.easy-pie-chart.js"></script><script src="../_public/assets/scripts.js"></script>
        <script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000});
        });
        </script><script src="../_public/vendors/datatables/js/jquery.dataTables.min.js"></script><script src="../_public/assets/DT_bootstrap.js"></script>
        
		<script>
        $(function() {
            
        });
        </script>
    </body>

</html>
<?php
}
?>