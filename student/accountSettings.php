<?php
	session_start();
	error_reporting(0);
	include("../include/dbcon.php");
	
	if(!($_SESSION['login'])) {
		header("Location: ../student.php");
	}
	else {
		$studID  = $_SESSION['username'];
		
?>

<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Student | Account Setting</title>
                    <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <!-- Bootstrap -->
        <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="../_public/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
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
<?php include 'includes/sidebar.php'; ?>
                
	<?php
	if(isset($_POST['btnSave'])) {
				$new = trim($_POST['new']);
				$newpass = md5(trim($_POST['new']));
				$conf = trim($_POST['confirm']);
				
				if($new=='' && $conf=='') {
					$msg =  '<i><font color="red">All fields should be filled out!</font></i>';
				}
				else {
				if($new=='') {
						$msg =  '<i><font color="red">New Password can\'t be empty!</font></i>';
					}
					else if($conf=='') {
						$msg =  '<i><font color="red">Confirm New Password can\'t be empty!</font></i>';
					}
					else {
							$myQuery = mysql_query("SELECT * FROM tbl_student  WHERE password='$newpass'");

							if(mysql_num_rows($myQuery) >0){
								$msg =  'Password is already used!</font></i>';
							}
							else if(!(  strlen($new)>5 // at least 6 chars
										&& strlen($new)<17 // at most 16 chars
										&& preg_match('`[A-Z]`',$new) // at least one upper case
										&& preg_match('`[A-Z]`',$new) // at least one upper case
										&& preg_match('`[a-z]`',$new) // at least one lower case
										&& preg_match('`[0-9]`',$new) // at least one digit
										&&  preg_match('/[^a-zA-Z\d]/', $new) // at least one special
										)) {
								$msg =  '<i><font color="red">Password should contain atleast one lower case and upper case latter, one digit and one special character and atleast 6 characters!</font></i>';
							}
							else {
								if($new!=$conf) {
									$msg = '<i><font color="red">New Password and Confirm New Password should match!</font></i>';
								}
								else {
									$myQuery = mysql_query("UPDATE tbl_student SET password='$newpass', pass='$new' WHERE student_id='$insID'")
												   or die(mysql_error()) ;
									$msg = '<i><font color="red">Password Successfully Changed</font></i>';
								}
							}
						}
					}
				
		}
	?>
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
                                           <input name="new" class="input-mini focused" id="focusedInput" type="password" value="<?php if(isset($_POST['btnSave'])) { echo $new; } ?>" style="width:270px;"></input>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label">Confirm New Password</label>
                                          <div class="controls">
                                           <input name="confirm" class="input-mini focused" id="focusedInput" type="password" value="<?php if(isset($_POST['btnSave'])) { echo $conf; } ?>" style="width:270px;"></input>
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