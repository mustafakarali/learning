<?php
	session_start();
	include("../include/dbcon.php");
	
	if(!($_SESSION['login'])) {
		header("Location: ../instructor.php");
	}
	else {
		$studID  = $_SESSION['username'];
		
?>
<!DOCTYPE html>
<html class="no-js">
    
<head>
        <title>Student | Class List</title>
        <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <!-- Bootstrap -->
        <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="../_public/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]> <script src="../_public/http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]--> <script src="../_public/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    
    <body>
<?php include 'includes/navbar.php'; ?>
        <div class="container-fluid">
            <div class="row-fluid">
                
                <!--/span-->
                <div class="span9" id="content">

                    <div class="row-fluid">
                        <div class="span6">
							<h2>My Class List</h2>
                            <!-- block -->
                            <div class="block">
							<?php
								$sql = mysql_query("SELECT c.class_id as class_id, c.section as section, c.course_code as course FROM tbl_class c, tbl_class_class d  WHERE d.class_id=c.class_id AND d.student_id='$studID'")
											   or die(mysql_error()) ;
											   
								while($row = mysql_fetch_array($sql))
								{
									$classID = $row['class_id'];
									$section = $row['section'];
									$course = $row['course'];
								?>
									<div class="navbar navbar-inner block-header">
										<div class="muted pull-left"><a href="classInformation.php?class=<?php echo $classID; ?>"><?php echo $course.'-'.$section;?> </a></div>
										
									</div>
								<?php 
								}
							
							?>							

                            </div>
                            <!-- /block -->
                        </div>

                    </div>
                </div>
            </div>
        
<?php include 'includes/footer.php'; ?>
        </div>
        <!--/.fluid-container--> <script src="../_public/vendors/jquery-1.9.1.min.js"></script> <script src="../_public/bootstrap/js/bootstrap.min.js"></script> <script src="../_public/vendors/easypiechart/jquery.easy-pie-chart.js"></script> <script src="../_public/assets/scripts.js"></script>
        <script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000});
        });
        </script>
    </body>

</html>
<?php
}
?>