<?php 
include("include/dbcon.php");
if(isset($_POST['submit']))
{
//keep it inside
$email=$_POST['email'];
$code = $_GET['activation_code'];

$query = mysql_query("select * from tbl_student where email='$email'") or die(mysqli_error()); 

 if (mysql_num_rows ($query)==1) 
 {
$code=rand(1000,9999);

$from ="fernapms@outlook.com"; 
$subject = "Notification: Reset your password";
$message='<html><body>';
$message .='Hi,<br>';
$message .= 'To reset your password, please click the link below. Your changes will update your password<br>';
$message .= 'Your activation code is ' ."$code".'<br>';
$message .= "http://jetextsteeldetailers.com/fern/s_resetpass.php?email=$email&code=$code";
$message .= "</body></html>";
$headers = "From: $from \n";
        $headers .= "Reply-To: $from \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
		
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
mail($email, $subject, $message, $headers);

$msg =  '<div class="alert alert-success">
								<button class="close" data-dismiss="alert">&times;</button>
								<strong>Success!</strong> Email successfully sent. <a href="index.php">Return to Homepage</a>
							</div>';
$query2 = mysql_query("update tbl_student set activation_code='$code' where email='$email' ")or die(mysql_error()); 
}
else
{
$msg = '<div class="alert alert-error">
								<button class="close" data-dismiss="alert">&times;</button>
								<strong>Error!</strong> No user exist with this email. <a href="index.php">Return to Homepage</a>
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
    <!-- Font awesome - iconic font with IE7 support --> 
    <link href="_public/css/font-awesome.css" rel="stylesheet"> <link href="_public/css/font-awesome-ie7.css" rel="stylesheet">
    <!-- Bootbusiness theme --> <link href="_public/css/boot-business.css" rel="stylesheet">
  </head>
  <body style="background-color:#4db053;">
      <div class="container" style="margin-top:60px;">
        <div class="row">
          <div class="span6 offset3">
              <div class="center-align">
              <p><h3>Get back into your account</h3>Enter your email address to reset your password:</p>
                <form action="s_forgot.php" method="post" class="form-horizontal form-signin-signup">
                  <input type="text" name="email" placeholder="someone@example.com">
				</br><input type="submit" name="submit" value="Reset Password" class="btn btn-primary btn-large" name="btnSavePass"></input>
                <input type="reset" class="btn btn-large" value="Cancel"></input><a href="index.php"> <input type="button" class="btn btn-warning btn-large" value="Home"></input></a>

                </form>
<?php if(isset($_POST['submit'])) { echo $msg;}?>
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