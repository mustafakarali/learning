<?php
	session_start();
	include("../include/dbcon.php");
	
	if(!($_SESSION['login'])) {
		header("Location: ../parent.php");
	}
	else {
		$parent_username  = $_SESSION['username'];
		
?>
<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Parent | Manage Profile</title>
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

                
                <!--/span-->
                <div class="span9" id="content">


                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Profile</div>
                            </div>
							
                        </div>
                            <div class="block-content collapse in">
                                <div class="row-fluid padd-bottom">
                                  <div class="span3">
                                    <form class="form-horizontal">
                                      <fieldset>
                                        <div class="control-group">
                                          <label class="control-label">Student Number</label>
                                          <div class="controls">
                                            <span class="input-xlarge uneditable-input">Student Number</span>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label">First Name</label>
                                          <div class="controls">
                                            <span class="input-xlarge uneditable-input">First Name</span>
                                          </div>
                                        </div>									
                                        <div class="control-group">
                                          <label class="control-label">Middle Name</label>
                                          <div class="controls">
                                            <span class="input-xlarge uneditable-input">Middle Name</span>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label">Last Name</label>
                                          <div class="controls">
                                            <span class="input-xlarge uneditable-input">Last Name</span>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="date01">BirthDate</label>
                                          <div class="controls">
                                            <input type="text" class="input-xlarge datepicker" id="date01" value="02/16/12">
                                          </div>
                                        </div>                                        
                                        <div class="control-group">
                                          <label class="control-label">Gender</label>
                                          <div class="controls">
                                            <span class="input-xlarge uneditable-input">Gender</span>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label">Program</label>
                                          <div class="controls">
                                            <span class="input-xlarge uneditable-input">Program</span>
                                          </div>
                                        </div>
													<div class="control-group">
													  <label class="control-label" for="focusedInput">Contact Number</label>
													  <div class="controls">
														<input class="input-xlarge focused" id="focusedInput" type="text" value="Contact Number">
													  </div>
													</div>
													<div class="control-group">
													  <label class="control-label" for="focusedInput">Email Address</label>
													  <div class="controls">
														<input class="input-xlarge focused" id="focusedInput" type="text" value="Email Address">
													  </div>
													</div>                                        
                                        <div class="control-group">
                                          <div class="controls">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                          </div>
                                        </div>													
								
                                        
                                      </fieldset>
                                    </form>

                                  </div>

                                </div>


                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
        </div>
		<?php include 'includes/footer.php'; ?>
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