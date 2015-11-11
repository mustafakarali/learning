<?php
	session_start();
	error_reporting(0);
	include("../include/dbcon.php");
	
	if(!($_SESSION['login'])) {
		header("Location: ../instructor.php");
	}
	else {
		$insID  = $_SESSION['username'];
		
?>
<!DOCTYPE html>
<html class="no-js">
    
<head>
        <title>Instructor | Class List</title>
                    <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <!-- Bootstrap --> <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen"> <link href="../_public/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen"> <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
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
                        <div class="span6">
                            <!-- block -->
                            <div class="block">
							<?php
								$x = 0;
								$sql = mysql_query("SELECT * FROM tbl_class  WHERE instructor_id='$insID'")
											   or die(mysql_error()) ;
								$num_rows = mysql_num_rows($sql);

								if($num_rows > 0){
									while($row = mysql_fetch_array($sql))
									{
										$classID[$x] = $row['class_id'];
										$section[$x] = $row['section'];
										$course[$x] = $row['course_code'];
										
										echo "<div class=\"navbar navbar-inner block-header\">";
										echo "<div class=\"muted pull-left\"><a href=\"classInformation.php?class=$classID[$x]\">$course[$x] - $section[$x] </a></div>";
										echo "<div class=\"pull-right\">";
										echo "</div></div>";
									}
								}
								else {
										echo "<div class=\"navbar navbar-inner block-header\">";
										echo "<div class=\"muted pull-left\">No class yet. Maybe, classes are not yet imported.</div>";
										echo "</div></div>";
								}
							?>
								
                            <!-- /block -->
                        </div>

                    </div>
                </div>
            </div>
			</div>
            
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
    </body>

</html>
<?php
}
?>