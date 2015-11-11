<?php
	session_start();
	include("../include/dbcon.php");
	
	if(!($_SESSION['login'])) {
		header("Location: ../instructor.php");
	}
	else {
		$insID  = $_SESSION['username'];
		include("includes/classMenu.php");
		
		
		$query = mysql_query("SELECT a.first_name, a.middle_name, a.last_name, c.unit, c.course_code, c.description, b.section, b.room, b.schedule_day, b.schedule_time
					FROM tbl_instructor a
					JOIN tbl_class b ON a.instructor_id = b.instructor_id
					JOIN tbl_course c ON b.course_code = c.course_code
					WHERE b.class_id = '$classID'");
		while($row = mysql_fetch_array($query)){
			$fname1 = $row['first_name'];
			$mname1 = $row['middle_name'];
			$lname1 = $row['last_name'];
			$code = $row['course_code'];
			$desc = $row['description'];
			$sect = $row['section'];
			$unit = $row['unit'];
			$room = $row['room'];
			$day = $row['schedule_day'];
			$time = $row['schedule_time'];
		}	
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title><?php echo $course."-".$section;?></title>
        <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <!-- Bootstrap -->
                <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
        <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen"> 
        <link href="../_public/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen"> 
        <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
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
<?php include 'includes/classbar.php'; ?>
                <!--/span-->
                <div class="span9" id="content">
                    <div class="row-fluid">
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href="classList.php">Class List</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li>Subject Information</li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>				
                    <div class="row-fluid">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Subject</div>
                                    <div class="pull-right"><a href="upload.php">
                                    </a>
                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <tr>
											<td>Course Code:
											<td><?php echo $code ?>
										</tr>
										<tr>
											<td>Course Name:
											<td><?php echo $desc ?>
										</tr>
										<tr>
											<td>Unit:
											<td><?php echo $unit ?>
										</tr>
										<tr>
											<td>Section:
											<td><?php echo $sect ?>
										</tr>
										<tr>
											<td>Room:
											<td><?php echo $room ?>
										</tr>
										<tr>
											<td>Schedule:
											<td><?php echo $day.' '.$time; ?>
										</tr>
										<tr>
											<td>Instructor's Name:
											<td><?php echo $lname1.", ".$fname1." ".$mname1 ?>
										</tr>	
                                    </table>
                                </div>
                            </div>
                            <!-- /block -->

                    </div>


                </div>
            </div>
            </div>
				        <hr class="footer-divider">
			<p>&copy; 2013 FEU-FERN COLLEGE</p>
        </div>
        <!--/.fluid-container-->
        <link href="../_public/vendors/datepicker.css" rel="stylesheet" media="screen">
        <link href="../_public/vendors/uniform.default.css" rel="stylesheet" media="screen">
        <link href="../_public/vendors/chosen.min.css" rel="stylesheet" media="screen">

        <link href="../_public/vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">

        <script src="../_public/vendors/jquery-1.9.1.js"></script>
        <script src="../_public/bootstrap/js/bootstrap.min.js"></script>
        <script src="../_public/vendors/jquery.uniform.min.js"></script>
        <script src="../_public/vendors/chosen.jquery.min.js"></script>
        <script src="../_public/vendors/bootstrap-datepicker.js"></script>

        <script src="../_public/vendors/wysiwyg/wysihtml5-0.3.0.js"></script>
        <script src="../_public/vendors/wysiwyg/bootstrap-wysihtml5.js"></script>

        <script src="../_public/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>


        <script src="../_public/assets/scripts.js"></script>
        <script>
        $(function() {
            $(".datepicker").datepicker();
            $(".uniform_on").uniform();
            $(".chzn-select").chosen();
            $('.textarea').wysihtml5();

            $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#rootwizard').find('.bar').css({width:$percent+'%'});
                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $('#rootwizard').find('.pager .next').hide();
                    $('#rootwizard').find('.pager .finish').show();
                    $('#rootwizard').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#rootwizard').find('.pager .next').show();
                    $('#rootwizard').find('.pager .finish').hide();
                }
            }});
            $('#rootwizard .finish').click(function() {
                alert('Finished!, Starting over!');
                $('#rootwizard').find("a[href*='tab1']").trigger('click');
            });
        });
        </script>
    </body>

</html>


<?php
}
?>