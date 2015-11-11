  <?php
	session_start();
	include("includes/dbcon.php");
	
	if(isset($_POST['btnSavePass'])) {
		$new = $_POST['pass1'];
		$newpass = md5(trim($_POST['pass1']));
		$conf = $_POST['pass2'];
		$username = "admin";
				
				if($new=='') {
					$msg =  '<font color="red"><center>New Password is Required!</center></font>';
				}
				else if($conf=='') {
					$msg =  '<font color="red"><center>Confirm New Password is Required!</center></font>';
				}
				else {
						$myQuery = mysql_query("SELECT * FROM tbl_admin");

						if(!(  strlen($new)>7 // at least 8 chars
									&& strlen($new)<17 // at most 16 chars
									&& preg_match('`[A-Z]`',$new) // at least one upper case
									&& preg_match('`[a-z]`',$new) // at least one lower case
									&& preg_match('`[0-9]`',$new) // at least one digit
									&&  preg_match('/[^a-zA-Z\d]/', $new) // at least one special
									)) {
							$msg =  '<font color="red"><center>Password should contain at least one lower case and upper case latter, one digit and one special character!</center></font>';
						}
						else {
							if($new!=$conf) {
								$msg = '<font color="red"><center>New Password and Confirm Password should match!</center></font>';
							}
							else {
								$myQuery = mysql_query("UPDATE tbl_admin SET pass='$new', password='$newpass' WHERE username='$username'")
											   or die(mysql_error()) ;
								$msg = '<font color="yellow"><center>Password has been changed! You can now login!</center></font>';
							}
						}
				
			}
		}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Administrator | Change Password</title>
    <link rel="shortcut icon" href="../_public/img/favicon.ico" />
    <!-- Bootstrap -->
     <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
      <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen"> 
      <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../_public/http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="../_public/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
  </head>
  <body id="login">
    <div class="container">
	<br><br><br><br><br>
      <form method="post" action="" class="form-signin">
        <h2 class="form-signin-heading" align="center">Change Password</h2>
        <input type="password" class="input-block-level" placeholder="New Password" name="pass1" required>
        <input type="password" class="input-block-level" placeholder="Confirm Password" name="pass2" required>
       <center>
        <button class="btn btn-large btn-primary" type="submit" name="btnSavePass">Save</button>
		<button class="btn btn-large" type="reset" name="btnCancel">Cancel</button>
		</center>
      </form>

    </div> <!-- /container -->
	<?php if(isset($_POST['btnSavePass'])) { echo $msg; }?>
    <script src="../_public/vendors/jquery-1.9.1.min.js"></script>
    <script src="../_public/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>