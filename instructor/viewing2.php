<?php
	session_start();
	//error_reporting(0);
	include("../include/dbcon.php");
	
	if(!($_SESSION['login'])) {
		header("Location: ../instructor.php");
	}
	else {
		$insID  = $_SESSION['username'];
		include("includes/classMenu.php");
		
		
		
?>
<?php
$btnactive2 = "<button class='btn btn-success btn-mini'><i  name='actiStud'></i> Allowed</button>";
$btndeactive2 = "<button class='btn btn-danger btn-mini'><i name='deacStud'></i> Not Allowed</button>";
?>
<!DOCTYPE html>
<html>
    
    <head>
        <title><?php echo $course."-".$section;?> | Records</title>
        <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <!-- Bootstrap --> <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
        <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
         <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="vendors/flot/excanvas.min.js"></script><![endif]-->
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
	                                        <a href="classlist.php">Class List</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li>Student Academic Records</a></li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
    	<div class="bs-example">
            <ul class="nav nav-tabs" style="margin-bottom: 15px; margin-top:50px;">
                <li><a href="#student" data-toggle="tab">Grades</a></li>
                <li><a href="#instructor" data-toggle="tab">Attendance</a></li>
                <li  class="active"><a href="#viewing" data-toggle="tab">Viewing</a></li>
			</ul>
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="viewing">
					
                <p>        
					
					<!--Viewing-->
						<?php
							if(isset($_REQUEST['action'])) {?>
									<div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>Set Student Academic Records Viewing</h5></div>
                                </div>
                                <div class="block-content collapse in">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
											</tbody>
												<?php
													$sql = mysql_query("SELECT * from tbl_viewing v, tbl_request r WHERE v.class_id='$classID'" or die(mysql_error()));
													$num_rows = mysql_num_rows($sql);

													if($num_rows > 0){
														
													}
													
												?>
											</tbody>
                                    </table>
                                </div>
                            </div>
							
						<?php	}
							else {
						?>
									<div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>REQUESTS for Viewing of Student Academic Records</h5></div>
                                    <div class="pull-right"><a href="createStudent.php">
                                      <a href="viewing2.php?action=setSAR"><button class="btn" style="margin-bottom:5px;">Set SAR available</button></a>
                                    </a>
                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">

												<?php
													$sql = mysql_query("SELECT r.request_date as date, r.request_time as time, r.status as status, e.student_id as studID FROM tbl_request r, tbl_class_class e WHERE r.class_class_id=e.class_class_id AND e.class_id='$classID' ORDER BY r.request_date DESC, r.request_time DESC")
																		or die(mysql_error()) ;
													$num_rows = mysql_num_rows($sql);

													if($num_rows > 0){
														echo '<thead>';
														echo '<tr>';
														echo '<th>Date</th>';
														echo '<th>Time</th>';
														echo '<th>Student</th>';
														echo '</tr>';
														echo '</thead>';
															
														while($row = mysql_fetch_array($sql))
														{
															$studID  = $row['studID'];
															echo '<tbody>';
															echo '<tr>';
															echo '<td>'.$row['date'].'</td>';
															echo '<td>'.$row['time'].'</td>';
															
															$sql2 = mysql_query("SELECT * FROM tbl_student WHERE student_id='$studID'")
																		or die(mysql_error()) ;
															while($row2 = mysql_fetch_array($sql2))
															{
																echo '<td>'.$row2['last_name'].','.$row2['first_name'].' '.$row2['middle_name'].'</td>';
															}
															echo '</tr>';
															echo '</tbody>';
														}
													}
													else {
														echo '<tr><td>No requests yet</td></tr>';
													}
												
												?>
												<?php
													$acStat = 1;
													$deStat = 0;
													$id = $row['student_id'];
													if(isset($_POST['actiStud'])){
														$mySql =	mysql_query("UPDATE tbl_student SET status='$acStat' WHERE announcement_id='$id'")
																	or die (mysql_error(). "Can't Update :( ");
													}
												?>
												</tbody>
                                    </table>
                                </div>
                            </div>
						<?php
						}
						?>
					<!--End of Viewing-->
									
				</p>

                </div>
              </div>
				
				
              </div>
            </div>
                        </div>
                        <!-- /block -->
                    </div>


                </div>
            </div>
            
<?php include 'includes/footer.php'; ?>
        </div>
        <!--/.fluid-container--> <link href="../_public/vendors/datepicker.css" rel="stylesheet" media="screen"> <link href="../_public/vendors/uniform.default.css" rel="stylesheet" media="screen"> <link href="../_public/vendors/chosen.min.css" rel="stylesheet" media="screen"> <link href="../_public/vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">

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