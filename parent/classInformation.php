<?php
	session_start();
	include("../include/dbcon.php");
	
	if(!($_SESSION['login'])) {
		header("Location: ../l_parent.php");
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
        <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="vendors/flot/excanvas.min.js"></script><![endif]-->
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="../_public/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        
        <!-- start pop up on page load -->
        		<style type="text/css">
		* { margin:0; padding:0; }
		body { font:12px, Georgia, "Times New Roman", Times, serif; }
		
		#mask {
		  position:absolute;
		  left:0;
		  top:0;
		  z-index:99998;
		  background-color: #4D4D4D;
		  display:none;
		  
		}  
		#boxes .window {
		  position:absolute;
		  left:0;
		  top:0;
		  width:500px;
		  height:330px;
		  display:none;
		  z-index:99999;
		  padding:10px;
		  -moz-border-radius: 10px;
		  -webkit-border-radius: 10px;
		  border-radius: 10px;
		  border: 2px solid #333333;
		  
		  -moz-box-shadow:4px 4px 30px #130507;
			-webkit-box-shadow:4px 4px 30px #130507;
		  box-shadow:4px 4px 30px #130507;
			-moz-transition:top 800ms;
			-o-transition:top 800ms;
			-webkit-transition:top 800ms;
		  transition:top 800ms;
		}
		#boxes #dialog {
		  width:500px; 
		  height:330px;
		  padding:0px;
		  background-color: #FFFFFF;
		}
		</style>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
		
		<!-- end pop up onload page -->
        
    </head>
    
    <body>
<?php include 'includes/navbar.php'; ?>
        <div class="container-fluid">
        <div class="span3" id="sidebar">
        <?php include 'includes/classbar.php'; ?>
        <?php include 'includes/note.php'; ?>
        </div>
            <div class="row-fluid">

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
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<a href="new.php"><button type="submit" value="Message" class="btn" name="btnRequest"><i class="icon-envelope"></i> Message</input></a>
										</tr>	
                                    </table>
                                </div>
                            </div>
                            <!-- /block -->

                    </div>


                </div>
            </div><hr class="footer-divider">
			<p>&copy; 2013 FEU-FERN COLLEGE</p>
        </div>
        <!-- start body pop up onload page -->
        	<?php 
	if(!isset($_SESSION['jquery_popup']))  { 
	$_SESSION['jquery_popup'] = 1;
	?>
	<script type="text/javascript">
	$(document).ready(function() {	
	
			var id = '#dialog';
		
			//Get the screen height and width
			var maskHeight = $(document).height();
			var maskWidth = $(window).width();
		
			//Set heigth and width to mask to fill up the whole screen
			$('#mask').css({'width':maskWidth,'height':maskHeight});
			
			//transition effect		
			$('#mask').fadeIn(800);	
			$('#mask').fadeTo("slow",0.8);	
		
			//Get the window height and width
			var winH = $(window).height();
			var winW = $(window).width();
				  
			//Set the popup window to center
			$(id).css('top',  winH/2-$(id).height()/2 -50);
			$(id).css('left', winW/2-$(id).width()/2);
		
			//transition effect
			$(id).fadeIn(500); 	
		
		//if close button is clicked
		$('.window .close').click(function (e) {
			//Cancel the link behavior
			e.preventDefault();
			
			$('#mask').hide();
			$('.window').hide();
		});		
		
		//if mask is clicked
		$('#mask').click(function () {
			$(this).preventDefault();
			$(this).hide();
			$('.window').hide();
		});		
		
	});
	
	</script>
	
	
	<?php
			$gradeID = mysql_result(mysql_query("SELECT status FROM tbl_notification3 WHERE category='warning' AND class_class_id='$enrollID' ORDER BY notif_id DESC LIMIT 1"),0);
			
			$abs = mysql_result(mysql_query("SELECT count(*) FROM tbl_attendance WHERE legend='a' and class_class_id='$enrollID'"),0);
			$late = mysql_result(mysql_query("SELECT count(*) FROM tbl_attendance WHERE legend='l' and class_class_id='$enrollID'"),0);
			$try = mysql_query("SELECT allow from tbl_absences WHERE class_id='$classID'");
			$yes = mysql_num_rows($try);

			if($yes) {
				$allow = mysql_result(mysql_query("SELECT allow from tbl_absences WHERE class_id='$classID'"),0);
			}
			else {
				$allow=0;
			}
			
			$late2 = floor($late/3);
			$abs += $late2;
	
		if($gradeID || $abs>=($allow-1)) { 
	?>
	<div id="boxes">
	<div style="top:150px; left: 551.5px; display: none;" id="dialog" class="window">
	<div style=" float:left; font-weight:bold; font-size:16px; padding-left:5px;"><h1 align="center">WARNING!</h1></div>
	<div align="right" style="font-weight:bold; margin:5px 3px 0 0;"><a href="javascript:void()" class="close"><img src="close.png" width="16" style="border:none; cursor:pointer;" /></a></div>
	<div align="center" style="margin:5px 0 5px 0;">
		<br><br><br> <p align="center"> 
		<?php 
		if($gradeID) { 
		
		$sql = mysql_query("SELECT * FROM tbl_grades WHERE grade_id='$gradeID'");
		while($row = mysql_fetch_array($sql)) {
			$component = $row['component'];
			$score = $row['score'];
			$items = $row['noOfItems'];
		}
		
		$ave = mysql_result(mysql_query("SELECT score FROM tbl_grades WHERE component='$component' AND category='AVG' AND class_class_id='$enrollID'"),0);
		if($ave<70) {
			$check = mysql_result(mysql_query("SELECT count(*) FROM tbl_grades WHERE component='$component' AND score='' AND class_class_id='$enrollID'"),0);
			if($check) { 
				$total = 0;
				$count = 0;
				$sql = mysql_query("SELECT * FROM tbl_grades WHERE component='$component' AND category!='AVG' AND class_class_id='$enrollID'");
				while($row = mysql_fetch_array($sql)) {
					if($row['score']!='') {
						$total += ($row['score']/$row['noOfItems']) * 100;
						$count++;
					}
				}
				$aim = (70 * ($count+1)) - $total; 
				$aim = number_format($aim, 2, '.', '');
			}
			else {
				$semi = 0;
				$percent =0;
				$ave2 = mysql_result(mysql_query("SELECT score FROM tbl_grades WHERE component='$component' AND category='AVG' AND class_class_id='$enrollID'"),0);
				$sql = mysql_query("SELECT * FROM tbl_defaultcomponent");
				while($row = mysql_fetch_array($sql)) {
					if($row['name']==$component) {
						if($semi<70) {
							$ave2 = $ave2 * ($row['percentage']/100);
							$percent = $row['percentage'];
						}
						$next = $row['default_id'];
					}
					else if($row['default_id']==($next+1)) {
						$percent += $row['percentage'];
						if($row['required_number']>1) {
							$nameID = $row['name'].'-1';	
						}
						else {$nameID = $row['name'];	 }
						
						$aim = (($percent*0.7) - $ave2)/($row['percentage']/100);
						$aim = number_format($aim, 2, '.', '');
						break;
					}
				}
			}
		}
		$grade = mysql_result(mysql_query("SELECT grade FROM tbl_finalgrade WHERE class_class_id='$enrollID'"),0);
		?> Your child's instructor encoded a grade for <?php echo $component.', <font color="red">'.$score.'</font> over '.$items.'.';?>
	    <br>It makes your child's average in <?php echo $component.' <b>'.$ave.'%</b>.<br>';?> 
		<?php if($ave<70) { if($check) { echo "Your child need to get atleast <b>$aim%</b> in the next $component.<br>";}
							else { echo "Your child need to get atleast <b>$aim%</b> in the $nameID.<br>"; }} 
		
				echo "Your child's final grade for now is ";
				if($grade<70) { echo "<font color=\"red\">$grade</font>.<br>"; }
				else  { echo "$grade.<br>"; }
		}
			if($allow){
				if($abs==$allow) {
					echo "ATTENDANCE: Your child already consumed all the allowable absences. <br> One more absent or late will automatically drop you.
					<br> NOTE: Only $allow allowable absences";
				}
				else if($abs==($allow-1)){
					echo "ATENDANCE: Your child already have $abs absences.
					<br> NOTE: Only $allow allowable absences";
				}
				else if ($abs>$allow){
					echo "ATENDANCE: Your child are considered unofficially dropped because of having $abs number of absences. <br>
					Please communicate to your instructor.
					<br> NOTE: Only $allow allowable absences";
				}
			}
			
		?>
		</p>
		<?php
			mysql_query("UPDATE tbl_notification3 SET status='0' WHERE class_class_id='$enrollID' AND category='warning'");
		?>
	</div>
	<div align="center" style="margin:5px; font-weight:bold; font-size:14px;"> 
	<a href="records.php" style="color: #333333;">Click Here to see Your Records</a> 
	</div>
	</div>
	
	<!-- Mask to cover the whole screen -->
	<div style="width: 2000px; height: 2000px; display: none; opacity: 0.7;" id="mask"></div>
	</div>
	<?php } 
	}
	if((isset($_SESSION['jquery_popup'])))  { unset($_SESSION['jquery_popup']); } //uncomment for testing
	?>
        <!-- end pop up onload page -->
        
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