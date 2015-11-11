<?php
	include("include/dbcon.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bootbusiness | Short description about company">
    <meta name="author" content="Your name">
    <title>FEU Diliman | Contact Us</title>
    <link rel="shortcut icon" href="_public/img/favicon.ico" />
    <!-- Bootstrap -->
    <link href="_public/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap responsive -->
    <link href="_public/css/bootstrap-responsive.min.css" rel="stylesheet">
    <!-- Font awesome - iconic font with IE7 support --> 
    <link href="_public/css/font-awesome.css" rel="stylesheet">
    <link href="_public/css/font-awesome-ie7.css" rel="stylesheet">
    <!-- Bootbusiness theme -->
    <link href="_public/css/boot-business.css" rel="stylesheet">
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
          <h1>Contact us</h1>
        </div>
        <div class="row-fluid">
          <!-- Start: CONTACT US FORM -->
          <div class="span4 offset1">
            <div class="page-header">
              <h2>Quick message</h2>
            </div>
            <form method="post" action="" class="form-contact-us">
              <div class="control-group">
                <div class="controls">
                  <input type="text" id="inputName" placeholder="Name(Optional)" name="name" value="<?php
						if(isset($_POST['send'])){
							echo $_POST['name'];
						}else{
							echo "";
						}
					?>"> 
                </div>
				<div class="controls">
										  <?php
							if(isset($_POST['send']))
							{
								$name = $_POST['name'];
                            	
								if($name != null)
								{
								if(!preg_match('/^[A-Z][a-zA-Z -]+$/',$name))
								{
								echo "<div class='control-group error' style='width:inherited; margin-top:-3%; margin-left:27%; margin-bottom:-5%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Invalid Format!</span>
                                          </div>
                                        </div>";
			
								}
								}
							}
	 ?>
										  </div>
              </div>
              <div class="control-group">
                <div class="controls">
                  <input type="email" id="inputEmail" placeholder="Email" name="email" value="<?php
						if(isset($_POST['send'])){
							echo $_POST['email'];
						}else{
							echo "";
						}
					?>" required >
                </div>
              </div>
              <div class="control-group">
                <div class="controls">
                  <textarea id="inputMessage" placeholder="Message" name="content" value="<?php
						if(isset($_POST['send'])){
							echo $_POST['content'];
						}else{
							echo "";
						}
					?>" required ></textarea>
                </div>
              </div>
              <div class="control-group">
                <div class="controls">
                  <input type="submit" class="btn btn-primary btn-large" name="send" value="Send" />
				  <input type="reset" class="btn btn-primary btn-large" name="reset" value="Reset" />
                </div>
              </div>
            </form>
          </div>
          <!-- End: CONTACT US FORM -->
		  <?php
			if(isset($_POST['send']))
			{
				$name = $_POST['name'];
				$email = $_POST['email'];
				$content = $_POST['content'];
				
				if(empty($email) || empty($content))
				{
					echo "";
				}
				else
				{
				//mail function here
		$b = $_POST['email'];
		$c = $_POST['content'];
		$email = "ivannmagadia@gmail.com";
		$to = $email;

        $subject = "FEU FERN College : Contact Us ";

        $headers = "From: $b \n";
        $headers .= "Reply-To: $email \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $message = '<html><body>';
        $message .= 'Hi <b>'.'FEU FERN College'.'!</b><br>';
        $message .= "$c";
        $message .= "</body></html>";

        mail($to, $subject, $message, $headers);
		
		echo "<script>alert (\"Message Sent!!\")</script>";
				
	}
	}
				
		  ?>
          <!-- Start: OFFICES -->
          <div class="span5 offset1">
            <h3>FEU-FERN COLLEGE</h3>
            <div>
              <address class="pull-left">
             
				Sampaguita Avenue, Mapayapa Village</br>
				Diliman, Quezon City 1101</br>
				Philippines<br>

              </address>
              <div class="pull-right">
                <div class="bottom-space">
                  <i class="icon-phone icon-large"></i> +63(2) 931 6064
                </div>
                <a href="mailto:contact@bootbusiness.com" class="contact-mail">
                  <i class="icon-envelope icon-large"></i>
                </a> info@feufern.edu.ph
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
          <!-- End: OFFICES -->
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