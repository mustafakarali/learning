<?php
	session_start();
	//error_reporting(0);
	include("../include/dbcon.php");
	
	if(!($_SESSION['login'])) {
		header("Location: ../instructor.php");
	}
	else {
		$insID  = $_SESSION['username'];
		
					
		if(isset($_POST['btnSettings'])) {
			header("Location: accountSettings.php");
		}
?>

<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Instructor | Profile</title>
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
    <?php
	
		if(isset($_POST['btnSave'])) {
						$newContact = $_POST['newContact'];
						$newEmail = $_POST['newEmail'];
						
						if($contact==$newContact && $email==$newEmail) {
								$msgProfile =  '<div class="alert alert-info">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Info!</strong> No changes has been made.
									</div>';
						}
						else {
							if($contact!=$newContact){
								$myQuery = mysql_query("SELECT * FROM tbl_instructor  WHERE contact='$newContact'");
								
								if(mysql_num_rows($myQuery) >0){
									  $msgProfile =  '<div class="alert alert-error" style="min-width:30px;margin-right:10%;margin-top:1%;">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Error!</strong> Contact number is already in use.
									</div>';
								}
								else {
										$myQuery2 = mysql_query("UPDATE tbl_instructor SET contact='$newContact' WHERE instructor_id='$insID'")or die(mysql_error()) ;
										$msgProfile =  '<div class="alert alert-success alert-block">
										<a class="close" data-dismiss="alert" href="#">&times;</a>
										<h4 class="alert-heading">Success!</h4> Contact information successfully updated.
									</div>';
									}
								}
							if ($email!=$newEmail) {
								$myQuery = mysql_query("SELECT * FROM tbl_instructor  WHERE email='$newEmail'");
										

								if(mysql_num_rows($myQuery) >0){
									$msgProfile =  '<div class="alert alert-error" style="min-width:30px;margin-right:10%;margin-top:1%;">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Error!</strong> Email Address is already in use.
									</div>';
								}
								else {
									$myQuery3 = mysql_query("UPDATE tbl_instructor SET email='$newEmail' WHERE instructor_id='$insID'") or die(mysql_error()) ;
									$msgProfile =  '<div class="alert alert-success alert-block">
										<a class="close" data-dismiss="alert" href="#">&times;</a>
										<h4 class="alert-heading">Success!</h4> Contact information successfully updated.
									</div>';								}
							}
						}
					}
	?>
                <!--/span-->
                <div class="span9" id="content">


                    <div class="row-fluid">
                        <!-- block -->
						  <form class="form-horizontal" action="" method="post">
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Profile</div>
                                

                                </div>
                            </div>
							<div class="pull-right">
						<input type="submit" class="btn" style="margin-bottom:5px;" value="Account Settings" name="btnSettings"></input><br>
								<?php  if(isset($_POST['btnEdit'])){ ?>
										<input type="submit" class="btn" style="margin-bottom:5px;" name="btnSave" value="Save Changes"></input>
										<?php } else { ?>
										<input type="submit" class="btn" style="margin-bottom:5px;" name="btnEdit" value="Edit Contact Information"></input>
								<?php } ?>
                            </div>
                            <div class="block-content collapse in">
                                <div class="row-fluid padd-bottom">
                                  <div class="span3">
                                      <fieldset>
                                        <div class="control-group">
                                          <label class="control-label">Instructor ID</label>
                                          <div class="controls">
                                            <span class="input-xlarge uneditable-input"><?php echo $id ?></span>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label">First Name</label>
                                          <div class="controls">
                                            <span class="input-xlarge uneditable-input"><?php echo $fname ?></span>
                                          </div>
                                        </div>									
                                        <div class="control-group">
                                          <label class="control-label">Middle Name</label>
                                          <div class="controls">
                                            <span class="input-xlarge uneditable-input"><?php echo $mname ?></span>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label">Last Name</label>
                                          <div class="controls">
                                            <span class="input-xlarge uneditable-input"><?php echo $lname ?></span>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label">Gender</label>
                                          <div class="controls">
                                            <span class="input-xlarge uneditable-input"><?php if($gender=='F') { echo 'Female';}
												else echo 'Male';?></span>
                                          </div>
                                        </div>
										<?php
										 if(isset($_POST['btnEdit'])){?>
											 <div class="control-group">
											  <label class="control-label">Contact Number</label>
											  <div class="controls">
												<input class="input-mini focused" id="focusedInput" type="text" data-validation-regex-regex="((\+[0-9]{2})|0)[.\- ]?9[0-9]{2}[.\- ]?[0-9]{3}[.\- ]?[0-9]{4}" 
        data-validation-regex-message="Invalid Contact Number" value="<?php echo $contact;?>" style="width:270px;" name="newContact" required></input>
		<p class="help-block"></p>
											  </div>
											</div>
											<div class="control-group">
											  <label class="control-label">Email Address</label>
											  <div class="controls">
												<input class="input-mini focused" id="focusedInput" type="email" value="<?php echo $email;?>" style="width:270px;" name="newEmail" required></input>
												<p class="help-block"></p>
											  </div>
											</div>
										<?php } else {
										?>
                                        <div class="control-group">
                                          <label class="control-label">Contact Number</label>
                                          <div class="controls">
                                            <span class="input-xlarge uneditable-input"><?php echo $contact;  ?></span>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label">Email Address</label>
                                          <div class="controls">
                                            <span class="input-xlarge uneditable-input"><?php echo $email; ?></span>
                                          </div>
                                        </div>
										<?php } ?>
                                        <div class="control-group">
                                          <label class="control-label">Password</label>
                                          <div class="controls">
                                            <span class="input-xlarge uneditable-input"><?php echo $pass ?></span>
                                          </div>
                                        </div>									
                                        
                                      </fieldset>

                                  </div>

                                </div>
							
							<?php if(isset($_POST['btnSave'])) { echo $msgProfile; }?>

                            </div>
                                    </form>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
            </div>
      
<hr class="footer-divider">
			<p>&copy; 2013 FEU-FERN COLLEGE</p>
        </div>
        <!--/.fluid-container-->
        <script src="../_public/vendors/jquery-1.9.1.min.js"></script>
        <script src="../_public/bootstrap/js/bootstrap.min.js"></script>
        <script src="../_public/vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="../_public/assets/scripts.js"></script>
		
		<script src="../_public/https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> <!-- or use local jquery -->
		<script src="../_public/js/jqBootstrapValidation.js"></script>
		
		<script>
		  $(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
		</script>		
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