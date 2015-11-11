  <?php
	session_start();
	include("includes/dbcon.php");
	$login = 0;
	
	if(isset($_POST['btnLogin'])) {
	
		$sec = $_POST['sec'];
		if($sec == 'feufern')
		{
			header("Location: process.php");
		}
		else
		{
			$msg = '<font color="red"><center>Invalid Security Code!</center></font>';
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
        <h2 class="form-signin-heading" align="center">Security Question</h2>
        <h4 align="center">Enter the security code</h4>
        <input type="password" class="input-block-level" placeholder="Security Code" name="sec">
       <center>
        <button class="btn btn-large btn-primary" type="submit" name="btnLogin">Submit</button>
		<button class="btn btn-large" type="reset" name="btnCancel">Cancel</button>
		</center>
      </form>

    </div> <!-- /container -->
	<?php if(isset($_POST['btnLogin'])) { echo $msg; }?>
    <script src="../_public/vendors/jquery-1.9.1.min.js"></script>
    <script src="../_public/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>