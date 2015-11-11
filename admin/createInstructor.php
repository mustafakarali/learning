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
        <title>Administrator | Create Instructor</title>
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
				
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> <!-- or use local jquery -->
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
	                                    <li>Create Instructor</li>
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
                                        <legend>Create Instructor</legend>
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">Employee Number </label>
                                          <div class="controls">
                                            <input type="text" class="span6" placeholder="Employee Number" id="typeahead" name="emp" value="<?php
						if(isset($_POST['sign'])){
							echo $_POST['emp'];
						}else{
							echo "";
						}
					?>" required>
                                          </div>
										  <div class="controls">
										  <?php
							if(isset($_POST['sign']))
							{
								$emp = $_POST['emp'];
                            	
								if(!preg_match('/^[0-9\s]+$/',$emp))
								{
								echo "<div class='control-group error' style='width:inherited; margin-top:-3%; margin-left:27%; margin-bottom:-5%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Invalid Format!</span>
                                          </div>
                                        </div>";
			
			
								}
								if(strlen($emp) < 3)
								{
									echo "<div class='control-group error' style='width:inherited; margin-top:-3%; margin-left:27%; margin-bottom:-5%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Employee Number should contain 3 digits!</span>
                                          </div>
                                        </div>";
								}
								if(strlen($emp) > 3)
								{
									echo "<div class='control-group error' style='width:inherited; margin-top:-3%; margin-left:27%; margin-bottom:-5%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Employee Number should contain 3 digits!</span>
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
					?>" >
                                          </div>
										  <div class="controls">
										  <?php
							if(isset($_POST['sign']))
							{
								$mname = $_POST['mname'];
                            	
								if($mname !=null)
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
									echo "<div class='control-group error' style='width:inherited; margin-top:-3%; margin-left:27%; margin-bottom:-5%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Gender must be selected!</span>
                                          </div>
                                        </div>";
			
								}
								
								
							}
					?>
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
										  <div class="controls">
										  <?php
							if(isset($_POST['sign']))
							{
								$email = $_POST['email'];
								$query = mysql_query("SELECT * FROM tbl_instructor where email = '$email'");
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

                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-success" name="sign"><i class=" icon-plus icon-white"></i> Create Instructor</button>
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
	$emp = $_POST['emp'];
	$fname = $_POST['fname'];
	$mname = $_POST['mname'];
	$lname = $_POST['lname'];
	$sex = $_POST['gender'];
	$contact = $_POST['contact'];
	$email = $_POST['email'];
	/*$pass = $_POST['bday'];
	$password = md5(trim($_POST['bday']));*/
	
	if(empty($emp) || empty($fname) || empty($lname) || empty($sex) || empty($contact) || empty($email))
	{
		echo "";
	}
	
	else if(!preg_match('/^[0-9\s]+$/',$emp))
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
	else if(strlen($emp) < 3)
	{
		echo "";
	}
	else if(strlen($emp) > 3)
	{
		echo "";
	}
	else if (!preg_match('/^[A-Z][a-zA-Z -]+$/',$fname))
	{
		echo "";
	}
	else if (!preg_match('/^[A-Z][a-zA-Z -]+$/',$lname))
	{
		echo "";
	}
	else if($mname)
	{
		if (!preg_match('/^[A-Z][a-zA-Z -]+$/',$mname))
		{
			echo "";
		}
		else {
		$emp = $_POST['emp'];	
		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$lname = $_POST['lname'];
		$sex = $_POST['gender'];
		$contact = $_POST['contact'];
		$email = $_POST['email'];
		/*$pass = $_POST['bday'];
		$password = md5(trim($_POST['bday']));*/
		$query = mysql_query("SELECT * FROM tbl_instructor where email = '$email'");
		
			 $myQuery = mysql_query("INSERT INTO tbl_instructor(instructor_id, first_name, middle_name, last_name, gender, contact, 
			 email,status) VALUES('$emp','$fname','$mname','$lname','$sex','$contact','$email','')") or die(mysql_error()."Can't insert");
	
		     echo "<script>alert (\"Instructor's Record Successfully Created!\")</script>";
			 header ("location: insReview.php");
		}
	}
	else {
	$emp = $_POST['emp'];	
	$fname = $_POST['fname'];
	$mname = $_POST['mname'];
	$lname = $_POST['lname'];
	$sex = $_POST['gender'];
	$contact = $_POST['contact'];
	$email = $_POST['email'];
	/*$pass = $_POST['bday'];
	$password = md5(trim($_POST['bday']));*/
	$query = mysql_query("SELECT * FROM tbl_instructor where email = '$email'");
	
		 $myQuery = mysql_query("INSERT INTO tbl_instructor(instructor_id, first_name, middle_name, last_name, gender, contact, 
		 email,password,status) VALUES('$emp','$fname','$mname','$lname','$sex','$contact','$email','$email','')") or die(mysql_error()."Can't insert");

	     echo "<script>alert (\"Instructor's Record Successfully Created!\")</script>";
		 header ("location: insReview.php");
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