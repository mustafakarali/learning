<?php
	session_start();
	include("../include/dbcon.php");
	
	if(!($_SESSION['login'])) {
		header("Location: ../student.php");
	}
	else {
		$studID  = $_SESSION['username'];
		include("includes/classMenu.php");
		
?>
<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title><?php echo $course."-".$section;?> | Records</title>
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
    </head>
    
    <body>
<?php include 'includes/navbar.php'; ?>
        <div class="container-fluid">
                <div class="span3" id="sidebar">
        <?php include 'includes/classbar.php'; ?>
        <?php include 'includes/note.php'; ?>
        </div>
            <div class="row-fluid">
                <div class="span9" id="content">
                    <div class="row-fluid">
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href="classlist.php">Class List</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li>Student Academic Records</a></li>
	                                </ul>
                            	</div>
                        	</div>
                    </div>
				
                    <div class="row-fluid">
                        <div class="span8">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Grades</div>
                                </div>
                                <div class="block-content collapse in">
                <p>                 
                             
                                <div class="block-content collapse in">
                                <?php $sql = mysql_query("SELECT * FROM tbl_grades WHERE class_class_id='$enrollID'") or die(mysql_error());
									$count = mysql_num_rows($sql);
									if(!$count){
										echo '<div class="alert">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Warning!</strong> No records has been encoded.
									</div>'; 
									}
									else { ?>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Score</th>
                                                <th>Out of </th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$sql = mysql_query("SELECT * FROM tbl_grades  WHERE class_class_id='$enrollID' AND category!='AVG' AND score!=''")
											        or die(mysql_error()) ;
											   
												while($row = mysql_fetch_array($sql))
												{ 
													$date = $row['dated'];
													$name = $row['component'].''.$row['category'];
													$noOfItems = $row['noOfItems'];
													$score = $row['score'];
													?>
													<tr>
														<td><?php echo $name; ?> </td>
														<td><?php echo $date; ?> </td>
														<td> <span><?php echo $score; ?></span></td>
														<td> <span><?php echo $noOfItems; ?></span></td>
													</tr>
											<?php }
											?>
                                        </tbody>
                                    </table>
									
								<table class="table">
								<tr>
									<th>Component</th>
									<th>Average</th>
									<th>Percentage</th>
								</tr>
								<?php 
									$sql2 = mysql_query("SELECT * FROM tbl_component  WHERE class_id='$classID'")
												or die(mysql_error()) ;
											   
									while($row2 = mysql_fetch_array($sql2))
									{ 
										$component = $row2['name'];
										$percent = $row2['percentage'];
										
										$sql = mysql_query("SELECT * FROM tbl_grades  WHERE component='$component' AND category='AVG' AND class_class_id='$enrollID'");
										$num_rows = mysql_num_rows($sql);

										if($num_rows > 0){
											while($row = mysql_fetch_array($sql))
											{ 
												$ave = $row['score'];
												if($ave=='') {
													$ave = '------';
												}
												else {
													$ave = $row['score'].'%';
												}
											}
										}
										echo '<tr>';
										echo "<td align=\"center\">$component</td>";
										echo "<td align=\"center\">$ave</td>";
										echo "<td align=\"center\">$percent% of Final</td>";
										echo '</tr>';
									}
									
									echo '<br><br>';
									
									$sql3 = mysql_query("SELECT * FROM tbl_finalgrade  WHERE class_class_id='$enrollID'")
												or die(mysql_error()) ;
											   
									while($row3 = mysql_fetch_array($sql3))
									{
										
										$finalgrade = $row3['grade'];
										echo '<tr>';
										echo "<td align=\"center\"><b>Total</b></td>";
										if($finalgrade=='') {
										echo "<td align=\"center\"><b></b></td>";
										}
										else {
										echo "<td align=\"center\"><b>$finalgrade%</b></td>";
										}
										echo "<td align=\"center\"><b>100%</b></td>";
										echo "</tr>";							
									}
								?>
								</table>
								<?php } ?>
                          </div>
				</p>
                </div>
                            </div>
                            <!-- /block -->
                        </div>
                        <div class="span4">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Attendance</div>
                                </div>
                                <div class="block-content collapse in">
                  <p>                 
                                
                                <div class="block-content collapse in">
                  <?php $sql2 = mysql_query("SELECT c.month, c.day, a.legend  FROM tbl_attendance a, tbl_calendar c WHERE a.class_class_id='$enrollID' AND a.calendar_id=c.calendar_id AND a.legend!=''")
												or die(mysql_error()) ;
											   	$try = mysql_num_rows($sql2);
											   	if($try) { ?>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Mark</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php 
												
												while($row2 = mysql_fetch_array($sql2))
												{ 
													$month = $row2['month'];
													$day = $row2['day'];
													$legend = $row2['legend'];
													
													
													echo "<tr>";
													echo "<td>$month/$day</td>";
													echo "<td> $legend</td>";
													echo "</tr>";
													
												}
											?>
                                        </tbody>
                                    </table>
                                    <?php 
												}
												else {
													echo '<div class="alert">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Warning!</strong> No attendance has been recorded.
									</div>'; 
												} ?>			  
				</div>  </p>
                
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