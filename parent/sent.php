<?php
	session_start();
	error_reporting(0);
	include("../include/dbcon.php");
	date_default_timezone_set('Etc/GMT'); 
	
	if(!($_SESSION['login'])) {
		header("Location: ../parent.php");
	}
	else {
		$parentID  = $_SESSION['username'];
		include("includes/classMenu.php");
		
											$insID = mysql_result(mysql_query("SELECT instructor_id FROM tbl_class WHERE class_id='$classID'"),0);
											$sql = mysql_query("SELECT * FROM tbl_instructor WHERE instructor_id='$insID'") or die(mysql_error());
											while($row=mysql_fetch_array($sql)){
												$fname_ins = $row['first_name'];
												$lname_ins = $row['last_name'];
											}
		
?>
<!DOCTYPE html>
<html>
    
<head>
        <title><?php echo $course."-".$section;?> | Members</title>
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
                <!--/span-->
                <div class="span9" id="content">
                    <div class="row-fluid">
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        Message <span class="divider">/</span>	
                                      </li>
	                                    <li><a href="message.php">Inbox</a><span class="divider">/</span></li>
	                                    <li><a href="sent.php">Sent Items</a><span class="divider">/</span></li>
	                                    <li><a href="new.php">Compose New</a></li>
	                                </ul>
                                  </ul>
                            	</div>
                        	</div>
                    	</div>				
                    <div class="row-fluid">
                            <!-- block -->
							
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Sent Items</div>
                                </div>
                                 <?php  $ggg = mysql_query("SELECT * FROM tblchat WHERE sender='$parentID'") or die(mysql_error());
                            $gg2 = mysql_num_rows($ggg);
                            if($gg2) { ?>
                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Messages</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php 
											$sql="select * from tblchat WHERE sender = '$parentID' AND sender_b='$insID'  order by id DESC";
													$query=mysql_query($sql);
													while ($row=mysql_fetch_array($query))
													{
														echo "<tr>";
														echo "<td>$fname $lname</td>";
														echo '<td>'.'<div class="pull-right">'.$row['time'].'</div>'.' :'.'&nbsp;&nbsp;'.$row['msg'].'</td>';
														echo "</tr>";
													}
												?> 
                                        </tbody>
                                    </table>
                                </div><?php  } else {
                                	echo '<div class="alert">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Warning!</strong> Sent Item is empty.
									</div>';
                                } ?>
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