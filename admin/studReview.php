<?php
	session_start();
	include("includes/dbcon.php");
	if(!($_SESSION['login'])) {
		header("Location: index.php");
	}
	else {
	$sql1 = mysql_query("Select * FROM tbl_student ORDER BY id DESC LIMIT 1")
						or die(mysql_error());
					while($row = mysql_fetch_array($sql1)){
						$a = $row['student_id'];
						$b = $row['first_name'];
						$c = $row['middle_name'];
						$d = $row['last_name'];
						$e = $row['gender'];
						$f = $row['birthday'];
						$g = $row['program'];
						$h = $row['level'];
						$i = $row['contact'];
						$j = $row['email'];
						$k = $row['parent_number'];
						$l = $row['parent_email'];
						
					}
	echo "<script>alert (\"Student's Account Successfully Created and Account Infomation has been sent to the Parent's Email!\")</script>";
?>  
<!DOCTYPE html>
<html>
    
    <head>
        <title>Administrator | Review Student</title>
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
		
		<script src="../_public/https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> <!-- or use local jquery -->
		<script src="../_public/js/jqBootstrapValidation.js"></script>
		<script>
  $(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
</script>
		
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
	                                        <a href="dashboard.php">Dashboard</a> <span class="divider">/</span>	
	                                    </li>
										<li>
	                                        <a href="user.php">User Account Manager</a> <span class="divider">/</span>	
	                                    </li>
										<li>
	                                        <a href="createStudent.php">Create Student</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li>Review</li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
					

                     <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Review</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <form method="post" action="" class="form-horizontal">
                                      <fieldset>
                                        <legend>Review of Newly Created Student</legend>
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">Student Number </label>
                                          <div class="controls">
                                            <label class="control-label" for="typeahead"><?php echo $a; ?></label>
                                          </div>
										 
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">First Name </label>
                                          <div class="controls">
                                            <label class="control-label" for="typeahead"><?php echo $b; ?></label>
                                          </div>
										  
                                        </div>										
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">Middle Name </label>
                                          <div class="controls">
                                            <label class="control-label" for="typeahead"><?php echo $c; ?></label>
                                          </div>
										  
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">Last Name </label>
                                          <div class="controls">
                                            <label class="control-label" for="typeahead"><?php echo $d; ?></label>
                                          </div>
										  
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">Gender </label>
                                          <div class="controls">
                                            <label class="control-label" for="typeahead"><?php echo $e; ?></label>
                                          </div>
										  
                                        </div>	
										<div class="control-group">
                                          <label class="control-label" for="typeahead">Program </label>
                                          <div class="controls">
                                            <label class="control-label" for="typeahead"><?php echo $g; ?></label>
                                          </div>
										  <div class="controls">
										 
										  </div>
                                        </div>
										<div class="control-group">
                                          <label class="control-label" for="typeahead">Year Level </label>
                                          <div class="controls">
                                            <label class="control-label" for="typeahead"><?php echo $h; ?></label>
                                          </div>
										  <div class="controls">
										  
										  </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">Contact Number </label>
                                          <div class="controls">
                                            <label class="control-label" for="typeahead"><?php echo $i; ?></label>
                                          </div>
										  
                                        </div>
                                        
										<div class="control-group">
                                          <label class="control-label" for="typeahead">Email </label>
                                          <div class="controls">
                                            <label class="control-label" for="typeahead"><?php echo $j; ?></label>
                                          </div>
										  
                                        </div>	
										
										  <div class="control-group">
                                          <label class="control-label" for="typeahead">Parent's Contact Number </label>
                                          <div class="controls">
                                            <label class="control-label" for="typeahead"><?php echo $k; ?></label>
                                          </div>
										  
										  </div>
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">Parent's Email </label>
                                          <div class="controls">
                                            <label class="control-label" for="typeahead"><?php echo $l; ?></label>
                                          </div>
										  
                                        </div>										
                                        <div class="control-group">
                                          <label class="control-label" for="date01">Birthday</label>
                                          <div class="controls">
                                            <label class="control-label" for="typeahead"><?php echo $f; ?></label>
											</div>

                                        </div>
                                        

                                        <div class="form-actions">
                                        </div>
                                      </fieldset>
                                    </form>						
                                </div>
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