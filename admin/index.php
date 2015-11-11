  <?php
	session_start();
	include("includes/dbcon.php");
	$login = 0;
	
	if(isset($_POST['btnLogin'])) {
	
		$uname = $_POST['username'];
		$pass = $_POST['pass'];
		
		$d1 = mysql_real_escape_string(trim($uname, "/\'\" \;"));
		$d2 = md5(mysql_real_escape_string(trim($pass, "/\'\" \;")));
		
		if(empty($d1) || empty($d2)) {
			$msg =  '<font color="red"><center>Please input username and password</center></font>';
		}
		else {
			$myQuery = mysql_query("SELECT * FROM tbl_admin  WHERE username='$d1' AND password='$d2'")
					   or die(mysql_error(). "Can't select") ;

				if(mysql_num_rows($myQuery)>0) {
					$login = 1;
					$_SESSION['login'] = $login;
					header("Location: dashboard.php");
				}
				else {
					$_SESSION['login'] = $login;
					$msg = '<font color="red"><center>Invalid Username/Password</center></font>';
				}
			}
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Administrator Login</title>
    <!-- Bootstrap --> <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen"> <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
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
        <h2 class="form-signin-heading">Please Sign In</h2>
        <input type="text" class="input-block-level" placeholder="Username" name="username" required>
        <input type="password" class="input-block-level" placeholder="Password" name="pass" required>
       <center>
        <button class="btn btn-large btn-primary" type="submit" name="btnLogin">Sign in</button> <button class="btn btn-large" type="reset">Cancel</button> 
        <br><br><a href="forgot.php">Forgot Password?</a></center>
      </form>

    </div> <!-- /container -->
	<?php if(isset($_POST['btnLogin'])) { echo $msg; }?>
    <script src="../_public/vendors/jquery-1.9.1.min.js"></script>
    <script src="../_public/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>