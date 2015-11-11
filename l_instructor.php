<?php
	session_start();
	include("include/dbcon.php");
	$login = 0;
	
	
	
	if(isset($_POST['btnLogin'])) {
	
		$uname = $_POST['username'];
		$pass = $_POST['password'];
		
		$d1 = mysql_real_escape_string(trim($uname, "/\'\" \;"));
		$d2 = md5(mysql_real_escape_string(trim($pass, "/\'\" \;")));
		$msg = '';
		
		if(empty($d1) || empty($d2)) {
			$msg =  '<div class="alert alert-error">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Please Input Username or Password.
				</div>';
		}
		else {
			$myQuery = mysql_query("SELECT * FROM tbl_instructor  WHERE instructor_id='$d1' AND password='$d2'")
					   or die(mysql_error()) ;

				if(mysql_num_rows($myQuery)>0) {
								   
					while($row = mysql_fetch_array($myQuery))
					{
						$pass = $row['pass'];
						$status = $row['status'];
					}
					
					if($status==0){
						$login=1;
						$_SESSION['login'] = $login;
						$_SESSION['username'] = $d1;
						$_SESSION['password'] = $d2;
						$_SESSION['pass'] = $pass;
						header("Location: instructor/changePassword.php");
					}
					else {
						$login = 1;
						$_SESSION['login'] = $login;
						$_SESSION['username'] = $d1;
						header("Location: instructor/profile");
					}
				}
				else {
					$_SESSION['login'] = $login;
					$msg = '<div class="alert alert-error">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Invalid Username or Password.
				</div>';
				}
			}
			
		}
?>
	
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="FEU - FERN COLLEGE">
    <meta name="author" content="Your name">
        <link rel="shortcut icon" href="_public/img/favicon.ico" />
    <title>Sign in | Instructor</title>
    <!-- Bootstrap -->
    <link href="_public/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap responsive -->
    <link href="_public/css/bootstrap-responsive.min.css" rel="stylesheet">
    <!-- Font awesome - iconic font with IE7 support --> 
    <link href="_public/css/font-awesome.css" rel="stylesheet">
    <link href="_public/css/font-awesome-ie7.css" rel="stylesheet">
    <!-- Bootbusiness theme -->
    <link href="_public/css/boot-business.css" rel="stylesheet">
	
	<script src="_public/https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> <!-- or use local jquery -->
	<script src="_public/js/jqBootstrapValidation.js"></script>
	<script>
	  $(function () {
	  $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
	</script>	
  </head>
  <body>
    <!-- Start: HEADER -->
    <header>
      <!-- Start: Navigation wrapper -->
         <?php include 'include/header.php'; ?>
      <!-- End: Navigation wrapper -->   
    </header>
    <!-- End: HEADER -->
    <!-- Start: MAIN CONTENT -->
    <div class="content">
      <div class="container">
        <div class="page-header">
          <h2>Sign in as Instructor</h2>
        </div>
        <div class="row">
          <div class="span6 offset3">
            <h4 class="widget-header"> FEU - FERN COLLEGE</h4>
            <div class="widget-body" style="background-color:#FFF;">
              <div class="center-align">
                <form method="post" action="" class="form-horizontal form-signin-signup">
                  <input type="text" name="username" placeholder="Instructor ID" required>
                  <input type="password" name="password" placeholder="Password" required>
                  <div class="remember-me">
                    <div class="pull-right">
                      　<a href="i_forgot.php">Forgot Password?</a>
                    </div>
                    <div class="pull-left">
                     <input type="submit" value="Sign in" class="btn btn-primary" name="btnLogin"></input> <input type="reset" class="btn" value="Cancel">
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  
                </form>
				<?php if(isset($_POST['btnLogin'])) { echo $msg;}?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End: MAIN CONTENT -->
    <!-- Start: FOOTER -->
      <?php include 'include/footer.php'; ?>
    <!-- End: FOOTER -->
    <script type="text/javascript" src="_public/js/jquery.min.js"></script>
    <script type="text/javascript" src="_public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="_public/js/boot-business.js"></script>
  </body>
</html>