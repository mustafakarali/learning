<?php
	session_start();
	error_reporting(0);
	include("../include/dbcon.php");
	
	if(!($_SESSION['login'])) {
		header("Location: ../instructor.php");
	}
	else {
	
	$username = $_SESSION['username'];
	$password = $_SESSION['password'];
	$pass = $_SESSION['pass'];
	$great=0;
	
		if($_POST['btnSavePass']) {
			$user = $_POST['username'];
			$curr = trim($_POST['current']);
			$currpass = md5(trim($_POST['current']));
			$new = trim($_POST['new']);
			$newpass = md5(trim($_POST['new']));
			$conf = trim($_POST['confirm']);
			$msg = 'Error message';
			
			if($user=='' && $curr=='' && $new=='' && $conf=='') {
				$msg =  '<div class="alert alert-error">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Please fill out all fields.
				</div>';
			}
			else {
				if($user=='') {
					$msg =  '<div class="alert alert-error">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Current Password is required.
				</div>';
				}
				else if($curr=='') {
					$msg =  '<div class="alert alert-error">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Current Password is required.
				</div>';
				}
				else if($new=='') {
					$msg =  '<div class="alert alert-error">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> New Password is required.
				</div>';
				}
				else if($conf=='') {
					$msg =  '<div class="alert alert-error">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Confirm New Password is required.
				</div>';
				}
				else {
					if($user!=$username) {
						$msg =  '<div class="alert alert-error">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Not a valid username.
				</div>';
					}
					else if($currpass!=$password) {
						$msg =  '<div class="alert alert-error">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Not a valid current password.
				</div>';
					}
					else {
						$myQuery = mysql_query("SELECT * FROM tbl_instructor  WHERE password='$newpass'");

						if(mysql_num_rows($myQuery) >0){
							$msg =  '<div class="alert alert-error">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Password is already in use.
				</div>';
						}
						else if(!(  strlen($new)>7 // at least 8 chars
									&& strlen($new)<17 // at most 16 chars
									&& preg_match('`[A-Z]`',$new) // at least one upper case
									&& preg_match('`[a-z]`',$new) // at least one lower case
									&& preg_match('`[0-9]`',$new) // at least one digit
									&&  preg_match('/[^a-zA-Z\d]/', $new) // at least one special
									)) {
							$msg =  '<div class="alert alert-error">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Password should contain at least one lower case and upper case letter, one digit and one special character.
				</div>';
						}
						else {
							if($new!=$conf) {
								$msg = '<div class="alert alert-error">
					<strong>Error!</strong> New Password and Confirm New Password should match.
				</div>';
							}
							else {
								$myQuery = mysql_query("UPDATE tbl_instructor SET password='$newpass', pass='$new', status=1 WHERE instructor_id='$username'")
											   or die(mysql_error()) ;
								$msg = '<div class="alert alert-success">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Success!</strong> Password has been Changed. 
									</div>';
										
								$great=1;
								session_destroy();
							}
						}
					}
				}
			}
		}
		else if($_POST['btnCancel']) {
			header("location: index.php");
		}
?>
	
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="feu fern college">
    <meta name="author" content="Your name">
        <link rel="shortcut icon" href="../_public/img/favicon.ico" />
    <title>Change Default Password | Instructor</title>
    <!-- Bootstrap --> <link href="../_public/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap responsive --> <link href="../_public/css/bootstrap-responsive.min.css" rel="stylesheet">
    <!-- Font awesome - iconic font with IE7 support --> <link href="../_public/css/font-awesome.css" rel="stylesheet"> <link href="../_public/css/font-awesome-ie7.css" rel="stylesheet">
    <!-- Bootbusiness theme --> <link href="../_public/css/boot-business.css" rel="stylesheet">
    <script src="../_public/https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> <!-- or use local jquery -->
	<script src="../_public/js/jqBootstrapValidation.js"></script>
	<script>
	  $(function () {
	  $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
	</script>
  </head>
  <body style="background-color:#4db053;">
      <div class="container" style="margin-top:60px;">
        <div class="row">
          <div class="span6 offset3">
              <div class="center-align">
                <form method="post" action="" class="form-horizontal form-signin-signup">
                  <input type="text" name="username" placeholder="Student Number" value="<?php if($great==0) { echo $username; } ?>" readonly>
                  <input type="password" name="current" placeholder="Default Password" value="<?php if($great==0) { echo $pass; }?>" required>
                  <input type="password" name="new" placeholder="New Password"  required>
                  <input type="password" name="confirm" placeholder="Confirm New Password"  required>
                
					<input type="submit" value="Change Password" class="btn btn-primary btn-large" name="btnSavePass"></input>
                </form>
				<?php if(isset($_POST['btnSavePass'])) { echo $msg;?>
				
                  <div class="pull-right" style="margin-left:-40px;">
					<a href="../l_instructor.php">
				  </a>				  </div>
				<?php }?>
            </div>
          </div>
        </div>
      </div>

    <!-- Start: FOOTER -->
    <footer>
      <?php include '../_public/include/footer.php'; ?>
     </footer>
    <!-- End: FOOTER -->
    <script type="text/javascript" src="../_public/js/jquery.min.js"></script>
    <script type="text/javascript" src="../_public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../_public/js/boot-business.js"></script>
	
	<script>
        $(function() {
            $('.tooltip').tooltip();	
			$('.tooltip-right').tooltip({ placement: 'right' });	
        });
        </script>
  </body>
</html>

<?php
}
?>