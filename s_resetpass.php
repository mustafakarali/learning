<?php
include("include/dbcon.php");
if(isset($_POST['pass'])){
$pass = $_POST['pass'];
$acode=$_POST['code'];
$npass = $_POST['npass'];
$newpass = md5(trim($_POST['npass']));

$query = mysql_query("select * from tbl_student where activation_code='$acode'")
or die(mysql_error()); 

if (mysql_num_rows ($query)==1) 
{
$query3 = mysql_query("update tbl_student set password='$newpass', pass='$npass' where activation_code='$acode'")
or die(mysql_error()); 

header ("Location: l_student.php");
}
else
{
$msg = '<div class="alert alert-error">
								<button class="close" data-dismiss="alert">&times;</button>
								<strong>Error!</strong> Wrong code. <a href="index.php">Return to Homepage</a>
							</div>';
}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bootbusiness | Short description about company">
    <meta name="author" content="Your name">
        <link rel="shortcut icon" href="_public/img/favicon.ico" />
    <title>FEU Diliman | Reset Password</title>
    <!-- Bootstrap --> <link href="_public/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap responsive --> <link href="_public/css/bootstrap-responsive.min.css" rel="stylesheet">
    <!-- Font awesome - iconic font with IE7 support --> <link href="_public/css/font-awesome.css" rel="stylesheet"> <link href="_public/css/font-awesome-ie7.css" rel="stylesheet">
    <!-- Bootbusiness theme --> <link href="_public/css/boot-business.css" rel="stylesheet">
  </head>
  <body style="background-color:#4db053;">
      <div class="container" style="margin-top:60px;">
        <div class="row">
          <div class="span6 offset3">
              <div class="center-align">
              <p><h3>Get back into your account</h3>Please enter your activation code. Your changes here will update your password.</p>
                <form action="s_resetpass.php" method="POST" class="form-horizontal form-signin-signup">
                  <input type="text" name="pass" placeholder="Activation Code">
                  <input type="password" name="npass" placeholder="New Password">                  
				</br><input type="submit"  name="submit" value="Reset Password" class="btn btn-primary btn-large" name="btnSavePass"></input>
                <input type="reset" class="btn btn-large"></input> <a href="index.php"> <input type="button" class="btn btn-warning btn-large" value="Home"></input></a>
				<input type="hidden" name="code" value="<?php echo $_GET['code'];?>" />
                </form>
<?php if(isset($_POST['pass'])) { echo $msg;}?>
            </div>
          </div>
        </div>
      </div>

    <!-- Start: FOOTER -->

    <!-- End: FOOTER -->
    <script type="text/javascript" src="_public/js/jquery.min.js"></script>
    <script type="text/javascript" src="_public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="_public/js/boot-business.js"></script>
	
	<script>
        $(function() {
            $('.tooltip').tooltip();	
			$('.tooltip-right').tooltip({ placement: 'right' });	
        });
        </script>
  </body>
</html>