<?php
	session_start();
	error_reporting(0);
	include("../include/dbcon.php");
	date_default_timezone_set('Etc/GMT'); 
	
	if(!($_SESSION['login'])) {
		header("Location: ../instructor.php");
	}
	else {
		$insID  = $_SESSION['username'];
		include("includes/classMenu.php");
		
?>
<!DOCTYPE html>
<html>
    
<head>
        <title><?php echo $course."-".$section;?> | Members</title>
        <!-- Bootstrap -->
                <link rel="shortcut icon" href="../_public/img/favicon.ico" />
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
	                                    <li> Members</li>
                                  </ul>
                            	</div>
                        	</div>
                    	</div>				
                    <div class="row-fluid">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Members</div>
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Member</th>
                                                <th>Compose Message</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
													$y=1;
													$sql3 = mysql_query("SELECT * FROM tbl_class_class WHERE class_id='$classID'")
																   or die(mysql_error()) ;
																   
													while($row = mysql_fetch_array($sql3))
													{
																	$studID[$y] = $row['student_id'];
																	$enrollID[$y] = $row['class_class_id'];

																	
															
																$sql2 = mysql_query("SELECT first_name, last_name, middle_name FROM tbl_student WHERE student_id=$studID[$y]")
																			   or die(mysql_error()) ;
																			   
																while($row = mysql_fetch_array($sql2))
																{
																?> <tr>
																	<td><a href="pm.php?myVar=<?php echo $studID[$y]; ?>"><?php echo $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] ?></a></td>
																	<td><a href="pm.php?myVar=<?php echo $studID[$y]; ?>">Message</a></td>
																<?php
																	
																	$sql = mysql_query("SELECT * FROM tbl_grades WHERE component='$name' AND class_class_id='$enrollID[$y]' AND category='AVG'")
																		   or die(mysql_error()) ;
																		$num_rows = mysql_num_rows($sql);	
																}
															$y++;
													}
													
												?>
                              
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /block -->

                    </div>


                </div>
            </div>
        
<?php include 'includes/footer.php'; ?>
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