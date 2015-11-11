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
        <title>Instructor | Profile</title>
                    <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <!-- Bootstrap --> <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen"> <link href="../_public/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen"> <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="../_public/http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="../_public/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
         <script src="../_public/https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> <!-- or use local jquery -->
	<script src="../_public/js/jqBootstrapValidation.js"></script>
	<script>
	  $(function () {
	  $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
	</script>
    </head>
    
    <body>
<?php include 'includes/navbar.php'; ?>
        <div class="container-fluid">
            <div class="row-fluid">
<?php include 'includes/sidebar.php'; ?>
                
	<?php
	if(isset($_POST['btnSave'])) {
				$new = trim($_POST['new']);
				$newpass = md5(trim($_POST['new']));
				$conf = trim($_POST['confirm']);
				
				if($new=='' && $conf=='') {
					$msg =  '<div class="alert alert-error" style="min-width:200px;margin-right:1%;">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Please fill out all fields.
				</div>';
				}
				else {
				if($new=='') {
						$msg =  '<div class="alert alert-error" style="min-width:200px;margin-right:1%;">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> New Password is required.
				</div>';
					}
					else if($conf=='') {
						$msg =  '<div class="alert alert-error" style="min-width:200px;margin-right:1%;">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Confirm New Password is required.
				</div>';
					}
					else {
							$myQuery = mysql_query("SELECT * FROM tbl_instructor  WHERE password='$newpass'");

							if(mysql_num_rows($myQuery) >0){
								$msg =  '<div class="alert alert-error" style="min-width:30px;margin-right:20%;">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Password is already in use.
				</div>';
							}
							else if(!(  strlen($new)>5 // at least 6 chars
										&& strlen($new)<17 // at most 16 chars
										&& preg_match('`[A-Z]`',$new) // at least one upper case
										&& preg_match('`[a-z]`',$new) // at least one lower case
										&& preg_match('`[0-9]`',$new) // at least one digit
										&&  preg_match('/[^a-zA-Z\d]/', $new) // at least one special
										)) {
								$msg =  '<div class="alert alert-error" style="min-width:200px;margin-right:1%;">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Password should contain atleast one lower case and upper case latter, one digit and one special character and atleast 6 characters!</div>';
							}
							else {
								if($new!=$conf) {
									$msg = '<div class="alert alert-error" style="min-width:200px;margin-right:1%;">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> New Password and Confirm New Password should match.
				</div>';								}
								else {
									$myQuery = mysql_query("UPDATE tbl_instructor SET password='$newpass', pass='$new' WHERE instructor_id='$insID'")
												   or die(mysql_error()) ;
									$msg = '<div class="alert alert-success" style="min-width:200px;margin-right:1%;">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Success!</strong> Password has been changed</font></i>';
								}
							}
						}
					}
				
		}
	?>
                <!--/span-->
                <div class="span9" id="content">
                    <div class="row-fluid">
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href="profile.php">Profile</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li>Account Setting</a></li>
	                                </ul>
                            	</div>
                        	</div>
                    </div>

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
                                    <form class="form-horizontal" method="post" action="">
                                      <fieldset>
                                        <div class="control-group">
                                          <label class="control-label">Current password</label>
                                          <div class="controls">
                                            <span class="input-xlarge uneditable-input"><?php echo $pass;  ?></span>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label">New Password</label>
                                          <div class="controls">
                                           <input name="new" class="input-mini focused" id="focusedInput" type="password" value="<?php if(isset($_POST['btnSave'])) { echo $new; } ?>" style="width:270px;" required></input>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label">Confirm New Password</label>
                                          <div class="controls">
                                           <input name="confirm" class="input-mini focused" id="focusedInput" type="password" value="<?php if(isset($_POST['btnSave'])) { echo $conf; } ?>" style="width:270px;" required></input>
                                          </div>
                                        </div>									
                                        <div class="pull-right">
											<input type="submit" class="btn" style="margin-bottom:5px;" value="Save Changes" name="btnSave"></input>
											
										</div>
                                      </fieldset>
                                    </form>

                                  </div>
                                 
                                </div>

  <?php if(isset($_POST['btnSave'])) { echo $msg;}?>
								
                            </div>
                            
                        </div>
                        <!-- /block -->
                      
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