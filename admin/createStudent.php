<?php
	ob_start();
	session_start();
	include("includes/dbcon.php");
	if(!($_SESSION['login'])) {
		header("Location: index.php");
	}
	else {
?>  
<!DOCTYPE html>
<html>
    
    <head>
        <title>Administrator | Create Student</title>
        <!-- Bootstrap -->
        <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="vendors/flot/excanvas.min.js"></script><![endif]-->
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="../_public/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		
		<script src="../_public/https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> <!-- or use local jquery -->
		<script src="../_public/js/jqBootstrapValidation.js"></script>
		<script>
  $(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
</script>
		
    </head>
    
    <body>
<?php include 'includes/navbar.php'; ?>
        <div class="container-fluid">
            <div class="row-fluid">
<?php include 'includes/sidebar.php'; ?>
                <!--/span-->
                <div class="span9" id="content">
                    <div class="row-fluid">
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href="dashboard.php">Dashboard</a> <span class="divider">/</span>	
	                                    </li>
										<li>
	                                        <a href="user.php">User Account Manager</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li>Create Student</li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
					

                     <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Create Single Entry</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <form method="post" action="" class="form-horizontal">
                                      <fieldset>
                                        <legend>Create Student</legend>
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">Student Number </label>
                                          <div class="controls">
                                            <input type="text" class="span6" id="typeahead"  placeholder="Student Number" data-provide="typeahead" data-items="4" data-source='["2011","2012","2013","2014"]' name="stud" value="<?php
						if(isset($_POST['sign'])){
							echo $_POST['stud'];
						}else{
							echo "";
						}
					?>" required>
                                          </div>
										  <div class="controls">
										  <?php
							if(isset($_POST['sign']))
							{
								$stud = $_POST['stud'];
								$query = mysql_query("SELECT * FROM tbl_student where student_id = '$stud'");
								$validate = mysql_num_rows($query);
								if($validate >= 1)
								{
									echo "<div class='control-group error' style='width:inherited; margin-top:-3%; margin-left:27%; margin-bottom:-5%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Student ID is already taken.</span>
                                          </div>
                                        </div>";
								}
                            	
								if(!preg_match('/^[0-9\s]+$/',$stud))
								{
								echo "<div class='control-group error' style='width:inherited; margin-top:-3%; margin-left:27%; margin-bottom:-5%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Invalid Format!</span>
                                          </div>
                                        </div>";
			
								}
								if(strlen($stud) < 9)
								{
									echo "<div class='control-group error' style='width:inherited; margin-top:-3%; margin-left:27%; margin-bottom:-5%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Student Number should contain 9 digits!</span>
                                          </div>
                                        </div>";
								}
								if(strlen($stud) > 9)
								{
									echo "<div class='control-group error' style='width:inherited; margin-top:-3%; margin-left:27%; margin-bottom:-5%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Student Number should contain 9 digits!</span>
                                          </div>
                                        </div>";
								}
							}
	 ?>
										  </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">First Name </label>
                                          <div class="controls">
                                            <input type="text" class="span6" id="typeahead"  data-provide="typeahead" data-items="4" placeholder="First Name" name="fname" value="<?php
						if(isset($_POST['sign'])){
							echo $_POST['fname'];
						}else{
							echo "";
						}
					?>" required>
                                          </div>
										  <div class="controls">
										  <?php
							if(isset($_POST['sign']))
							{
								$fname = $_POST['fname'];
                            	
								if(!preg_match('/^[A-Z][a-zA-Z -]+$/',$fname))
								{
								echo "<div class='control-group error' style='width:inherited; margin-top:-3%; margin-left:27%; margin-bottom:-5%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Invalid Format!</span>
                                          </div>
                                        </div>";
			
								}
							}
	 ?>
										  </div>
                                        </div>										
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">Middle Name </label>
                                          <div class="controls">
                                            <input type="text" class="span6" id="typeahead"  data-provide="typeahead" data-items="4" placeholder="Middle Name(Optional)" name="mname" value="<?php
						if(isset($_POST['sign'])){
							echo $_POST['mname'];
						}else{
							echo "";
						}
					?>">
                                          </div>
										  <div class="controls">
										  <?php
							if(isset($_POST['sign']))
							{
								$mname = $_POST['mname'];
                            	
								if($mname != null)
								{
								if(!preg_match('/^[A-Z][a-zA-Z -]+$/',$mname))
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
                                          <label class="control-label" for="typeahead">Last Name </label>
                                          <div class="controls">
                                            <input type="text" class="span6" id="typeahead"  data-provide="typeahead" data-items="4" placeholder="Last Name" name="lname" value="<?php
						if(isset($_POST['sign'])){
							echo $_POST['lname'];
						}else{
							echo "";
						}
					?>" required>
                                          </div>
										  <div class="controls">
										  <?php
							if(isset($_POST['sign']))
							{
								$lname = $_POST['lname'];
                            	
								if(!preg_match('/^[A-Z][a-zA-Z -]+$/',$lname))
								{
								echo "<div class='control-group error' style='width:inherited; margin-top:-3%; margin-left:27%; margin-bottom:-5%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Invalid Format!</span>
                                          </div>
                                        </div>";
			
								}
							}
	 ?>
										  </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">Gender </label>
                                          <div class="controls">
                                            <input type="radio" id="optionsRadios1" checked="" value="Male" name="gender"> Male
											<input type="radio" id="optionsRadios2" value="Female" name="gender"> Female
                                          </div>
										  <div class="controls">
										  <?php
							if(isset($_POST['sign']))
							{
								$sex = $_POST['gender'];
								if(empty($sex))
								{
									echo "<font color=\"#FF0000\">  Gender MUST be selected!</font>";
								}
								
								
							}
					?>
										  </div>
                                        </div>	
										<div class="control-group">
                                          <label class="control-label" for="typeahead">Program </label>
                                          <div class="controls">
                                            <select name="program">
												<option value="BSA">Bachelor of Science in Accountancy</option>
												<option value="BSBA">Bachelor of Science in Business Administration</option>
												<option value="BSBA-FM">Bachelor of Science in Business Administration (Major in Financial Management)</option>
												<option value="BSBA-Marketing">Bachelor of Science in Business Administration (Major in Marketing)</option>
												<option value="BSBA-Management">Bachelor of Science in Business Administration (Major in Operations Management)</option>
												<option value="BSBA-LM">Bachelor of Science in Business Administration (Major in Legal Management)</option>
												<option value="BSIT">Bachelor of Science in Information Technology</option>
												<option value="BSCS">Bachelor of Science in Computer Science</option>
											</select>
                                          </div>
										  <div class="controls">
										 
										  </div>
                                        </div>
										<div class="control-group">
                                          <label class="control-label" for="typeahead">Year Level </label>
                                          <div class="controls">
                                            <select name="level">
												<option value="1">1st Year</option>
												<option value="2">2nd Year</option>
												<option value="3">3rd Year</option>
												<option value="4">4th Year</option>
											</select>
                                          </div>
										  <div class="controls">
										  
										  </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">Contact Number </label>
                                          <div class="controls">
                                            <input type="text" class="span6" id="typeahead"  data-provide="typeahead" data-items="4" placeholder="Contact Number" name="contact" value="<?php
						if(isset($_POST['sign'])){
							echo $_POST['contact'];
						}else{
							echo "";
						}
					?>" required>
                                          </div>
										  <div class="controls">
										  <?php
							if(isset($_POST['sign']))
							{
								$contact = $_POST['contact'];
                            	
								if(!preg_match('/^[0-9\s]+$/',$contact))
								{
								echo "<div class='control-group error' style='width:inherited; margin-top:-3%; margin-left:27%; margin-bottom:-5%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Invalid Format!</span>
                                          </div>
                                        </div>";
			
								}
								if(strlen($contact) < 11)
								{
									echo "<div class='control-group error' style='width:inherited; margin-top:-3%; margin-left:27%; margin-bottom:-5%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Contact Number should contain 11 digits!</span>
                                          </div>
                                        </div>";
								}
								if(strlen($contact) > 11)
								{
									echo "<div class='control-group error' style='width:inherited; margin-top:-3%; margin-left:27%; margin-bottom:-5%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Contact Number should contain 11 digits!</span>
                                          </div>
                                        </div>";
								}
							}
	 ?>
										  </div>
                                        </div>
                                        
										<div class="control-group">
                                          <label class="control-label" for="typeahead">Email </label>
                                          <div class="controls">
                                            <input type="email" class="span6" id="typeahead"  data-provide="typeahead" data-items="4" placeholder="Email Address" name="email" value="<?php
						if(isset($_POST['sign'])){
							echo $_POST['email'];
						}else{
							echo "";
						}
					?>" required>
                                          </div>
										  <div class="controls" >
										  <?php
							if(isset($_POST['sign']))
							{
								$email = $_POST['email'];
								$query = mysql_query("SELECT * FROM tbl_student where email = '$email'");
								$validate = mysql_num_rows($query);
								if($validate >= 1)
								{
									echo "<div class='control-group error' style='width:inherited; margin-top:-3%; margin-left:27%; margin-bottom:-5%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>E-mail is already taken.</span>
                                          </div>
                                        </div>";
								}
							}
							?>
										  </div>
                                        </div>	
										
										  <div class="control-group">
                                          <label class="control-label" for="typeahead">Parent's Contact Number </label>
                                          <div class="controls">
                                            <input type="text" class="span6" id="typeahead"  data-provide="typeahead" data-items="4" placeholder="Parent Contact Number" name="par_contact" value="<?php
						if(isset($_POST['sign'])){
							echo $_POST['par_contact'];
						}else{
							echo "";
						}
					?>" required>
                                          </div>
										  <div class="controls">
										  <?php
							if(isset($_POST['sign']))
							{
								$par_contact = $_POST['par_contact'];
                            	
								if(!preg_match('/^[0-9\s]+$/',$par_contact))
								{
								echo "<div class='control-group error' style='width:inherited; margin-top:-3%; margin-left:27%; margin-bottom:-5%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Invalid Format!</span>
                                          </div>
                                        </div>";
			
								}
								if(strlen($par_contact) < 11)
								{
									echo "<div class='control-group error' style='width:inherited; margin-top:-3%; margin-left:27%; margin-bottom:-5%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Contact Number should contain 11 digits!</span>
                                          </div>
                                        </div>";
								}
								if(strlen($par_contact) > 11)
								{
									echo "<div class='control-group error' style='width:inherited; margin-top:-3%; margin-left:27%; margin-bottom:-5%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Contact Number should contain 11 digits!</span>
                                          </div>
                                        </div>";
								}
							}
	 ?>
										  </div>
										  </div>
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">Parent's Email </label>
                                          <div class="controls">
                                            <input type="email" class="span6" id="typeahead"  data-provide="typeahead" data-items="4" placeholder="Parent Email Address" name="par_email" value="<?php
						if(isset($_POST['sign'])){
							echo $_POST['par_email'];
						}else{
							echo "";
						}
					?>" required>
                                          </div>
										  <div class="controls" >
										  <?php
							if(isset($_POST['sign']))
							{
								$par_email = $_POST['par_email'];
								$query = mysql_query("SELECT * FROM tbl_student where parent_email = '$par_email'");
								$validate = mysql_num_rows($query);
								if($validate >= 1)
								{
									echo "<div class='control-group error' style='width:inherited; margin-top:-3%; margin-left:27%; margin-bottom:-5%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>E-mail is already taken.</span>
                                          </div>
                                        </div>";
								}
							}
							?>
										  </div>
                                        </div>										
                                        <div class="control-group">
                                          <label class="control-label" for="date01">Birthday</label>
                                          <div class="controls"> 
                                            <input type="text" class="input-xlarge datepicker" id="date01" name="bday" value="<?php
													if(isset($_POST['sign'])){
														echo $_POST['bday'];
													}else{
														echo "";
													}
												?>" required>                                          </div>

                                        </div>
                                        

                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-success" name="sign"><i class=" icon-plus icon-white"></i> Create Student</button>
                                          <button type="reset" class="btn">Cancel</button>
                                        </div>
                                      </fieldset>
                                    </form>						
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
<?php
	if(isset($_POST['sign'])){
	$stud = $_POST['stud'];
	$fname = $_POST['fname'];
	$mname = $_POST['mname'];
	$lname = $_POST['lname'];
	$sex = $_POST['gender'];
	$bday = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['bday'])));
	$program = $_POST['program'];
	$level = $_POST['level'];
	$contact = $_POST['contact'];
	$email = $_POST['email'];
	$par_contact = $_POST['par_contact'];
	$par_email = $_POST['par_email'];
	$pass = $_POST['bday'];
	$password = md5(trim($_POST['bday']));
	
	if(empty($stud) || empty($fname) || empty($lname) || empty($sex) || empty($bday) || empty($contact) || empty($email) || empty($par_contact) || empty($par_email))
	{
		echo "";
	}
	
	else if(!preg_match('/^[0-9\s]+$/',$stud))
	{
		echo "";
			
	}
	
	else if(!preg_match('/^[0-9\s]+$/',$contact))
	{
		echo "";
			
	}

	else if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/',$email))
	{
		echo "";
	}
	
	
	else if(!preg_match('/^[0-9\s]+$/',$contact))
	{
		echo "";
			
	}
	
	else if(strlen($contact) > 11)
	{
		echo "";
	}
	
	else if(strlen($contact) < 11)
	{
		echo "";
	}
	

	
	else if(strlen($stud) < 9)
	{
		echo "";
	}
	else if(strlen($stud) > 9)
	{
		echo "";
	}
	
	else if(!preg_match('/^[0-9\s]+$/',$par_contact))
	{
		echo "";
			
	}
	
	else if(strlen($par_contact) > 11)
	{
		echo "";
	}
	
	else if(strlen($par_contact) < 11)
	{
		echo "";
	}
	
	else if (!preg_match('/^[A-Z][a-zA-Z -]+$/',$fname))
	{
		echo "";
	}
	else if($mname) {
		if (!preg_match('/^[A-Z][a-zA-Z -]+$/',$mname))
		{
			echo "";
		}
		else {
	$stud = $_POST['stud'];	
	$fname = $_POST['fname'];
	$mname = $_POST['mname'];
	$lname = $_POST['lname'];
	$sex = $_POST['gender'];
	$bday = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['bday'])));
	$program = $_POST['program'];
	$level = $_POST['level'];
	$contact = $_POST['contact'];
	$email = $_POST['email'];
	$par_contact = $_POST['par_contact'];
	$par_email = $_POST['par_email'];
	$pass = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['bday'])));
	$password = md5(trim($pass));
	$parentPass = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['bday'])));
	$parentPassword = md5(trim($parentPass));
	$query = mysql_query("SELECT * FROM tbl_student where email = '$email'");
	
	$first = $_POST['fname'];
	$second = $_POST['mname'];
	$third = $_POST['lname'];
	
	$f = substr($first, 0, 1);
	$s = substr($second, 0, 1);
	
	$f1 = strtolower($f);
	$s1 = strtolower($s);
	$t1 = strtolower($lname);
	
	$t2 = preg_replace('/[ ,]+/', '', $t1);
	
	$username = $f1 . $s1 . $t2;
	
		 $myQuery = mysql_query("INSERT INTO tbl_student(student_id, first_name, middle_name, last_name, gender, birthday, program, level, contact, 
		 email, parent_number, parent_email, pass, password,status,late_status) VALUES('$stud','$fname','$mname','$lname','$sex','$bday','$program','$level','$contact','$email','$par_contact','$par_email',
		 '$pass','$password','0','1')") or die(mysql_error()."Can't insert");

			echo "<script>alert (\"Student's Account Successfully Created!\")</script>";
		 
		 $parentQuery = mysql_query("INSERT INTO tbl_parent(child_id,username,pass,password,status) VALUES('$stud','$stud','$parentPass','$parentPassword','')") or die(mysql_error()."Can't insert");
		
		//email here
		$b = $_POST['par_email'];
		$c = $username;
		$d = $parentPass;
		$email = "ivannmagadia@gmail.com";
		$to = $b;

        $subject = "FEU FERN College : Parent's Account Information ";

        $headers = "From: $email \n";
        $headers .= "Reply-To: $email \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $message = '<html><body>';
        $message .= 'Hi <b>'.'Parent'.'!</b><br>';
        $message .= '<b>Username: </b>'."$c".'<br>';
		$message .= '<b>Password: </b>'."$d".'<br>';
        $message .= "</body></html>";

        mail($to, $subject, $message, $headers);
		
		echo "<script>alert (\"Message Sent!!\")</script>";
		header ("location: studReview.php");
				
	}
	}
	else {
	$stud = $_POST['stud'];	
	$fname = $_POST['fname'];
	$mname = $_POST['mname'];
	$lname = $_POST['lname'];
	$sex = $_POST['gender'];
	$bday = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['bday'])));
	$program = $_POST['program'];
	$level = $_POST['level'];
	$contact = $_POST['contact'];
	$email = $_POST['email'];
	$par_contact = $_POST['par_contact'];
	$par_email = $_POST['par_email'];
	$pass = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['bday'])));
	$password = md5(trim($pass));
	$parentPass = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['bday'])));
	$parentPassword = md5(trim($parentPass));
	$query = mysql_query("SELECT * FROM tbl_student where email = '$email'");
	
	$first = $_POST['fname'];
	$second = $_POST['mname'];
	$third = $_POST['lname'];
	
	$f = substr($first, 0, 1);
	$s = substr($second, 0, 1);
	
	$f1 = strtolower($f);
	$s1 = strtolower($s);
	$t1 = strtolower($lname);
	
	$t2 = preg_replace('/[ ,]+/', '', $t1);
	
	$username = $f1 . $s1 . $t2;
	
		 $myQuery = mysql_query("INSERT INTO tbl_student(student_id, first_name, middle_name, last_name, gender, birthday, program, level, contact, 
		 email, parent_number, parent_email, pass, password,status,late_status) VALUES('$stud','$fname','$mname','$lname','$sex','$bday','$program','$level','$contact','$email','$par_contact','$par_email',
		 '$pass','$password','0','1')") or die(mysql_error()."Can't insert");

			echo "<script>alert (\"Student's Account Successfully Created!\")</script>";
		 
		 $parentQuery = mysql_query("INSERT INTO tbl_parent(child_id,username,pass,password,status) VALUES('$stud','$stud','$parentPass','$parentPassword','')") or die(mysql_error()."Can't insert");
		
		//email here
		$b = $_POST['par_email'];
		$c = $stud;
		$d = $parentPass;
		$email = "ivannmagadia@gmail.com";
		$to = $b;

        $subject = "FEU FERN College : Parent's Account Information ";

        $headers = "From: $email \n";
        $headers .= "Reply-To: $email \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $message = '<html><body>';
        $message .= 'Hi <b>'.'Parent'.'!</b><br>';
        $message .= '<b>Username: </b>'."$c".'<br>';
		$message .= '<b>Password: </b>'."$d".'<br>';
        $message .= "</body></html>";

        mail($to, $subject, $message, $headers);
		
		echo "<script>alert (\"Message Sent!!\")</script>";
		header ("location: studReview.php");
				
	}
	}
	?>

                </div>
            </div>
          
<?php include 'includes/footer.php'; ?>
        </div>
        <!--/.fluid-container-->
        <link href="../_public/vendors/datepicker.css" rel="stylesheet" media="screen">
        <link href="../_public/vendors/uniform.default.css" rel="stylesheet" media="screen">
        <link href="../_public/vendors/chosen.min.css" rel="stylesheet" media="screen">

        <link href="../_public/vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">

        <script src="../_public/vendors/jquery-1.9.1.js"></script>
        <script src="../_public/bootstrap/js/bootstrap.min.js"></script>
        <script src="../_public/vendors/jquery.uniform.min.js"></script>
        <script src="../_public/vendors/chosen.jquery.min.js"></script>
        <script src="../_public/vendors/bootstrap-datepicker.js"></script>

        <script src="../_public/vendors/wysiwyg/wysihtml5-0.3.0.js"></script>
        <script src="../_public/vendors/wysiwyg/bootstrap-wysihtml5.js"></script>

        <script src="../_public/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>


        <script src="../_public/assets/scripts.js"></script>
        <script>
        $(function() {
            $(".datepicker").datepicker();
            $(".uniform_on").uniform();
            $(".chzn-select").chosen();
            $('.textarea').wysihtml5();

            $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#rootwizard').find('.bar').css({width:$percent+'%'});
                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $('#rootwizard').find('.pager .next').hide();
                    $('#rootwizard').find('.pager .finish').show();
                    $('#rootwizard').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#rootwizard').find('.pager .next').show();
                    $('#rootwizard').find('.pager .finish').hide();
                }
            }});
            $('#rootwizard .finish').click(function() {
                alert('Finished!, Starting over!');
                $('#rootwizard').find("a[href*='tab1']").trigger('click');
            });
        });
        </script>
    </body>

</html>
<?php
}
ob_flush();
?>