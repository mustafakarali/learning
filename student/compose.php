<?php
	session_start();
	error_reporting(0);
	include("../include/dbcon.php");
	
	if(!($_SESSION['login'])) {
		header("Location: ../student.php");
	}
	else {
		$insID  = $_SESSION['username'];
		include("includes/classMenu.php");
		
?>
<!DOCTYPE html>
<html>
    
    <head>
        <title>Student | Compose Message</title>
        <!-- Bootstrap -->
        <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="../_public/vendors/flot/excanvas.min.js"></script><![endif]-->
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]> <script src="../_public/http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]--> <script src="../_public/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script> <script src="../_public/https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> <!-- or use local jquery --> <script src="../_public/../_public/js/jqBootstrapValidation.js"></script>
		<script>
  $(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
</script>
    </head>
    
    <body>
<?php include 'includes/navbar.php'; ?>
        <div class="container-fluid">
                     <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">New Message</div>
                            </div>
                            <div class="block-content collapse in">
 <?php
//We check if the user is logged
$con=mysqli_connect("localhost","root","","db_feufern");
//============== check connection
if(mysqli_errno($con))
{
echo "Can't Connect to mySQL:".mysqli_connect_error();
}
if(isset($_SESSION['username']))
{
$form = true;
$otitle = '';
$orecip = '';
$omessage = '';
//We check if the form has been sent
if(isset($_POST['title'], $_POST['recip'], $_POST['message']))
{
	$otitle = $_POST['title'];
	$orecip = $_POST['recip'];
	$omessage = $_POST['message'];
	//We remove slashes depending on the configuration
	if(get_magic_quotes_gpc())
	{
		$otitle = stripslashes($otitle);
		$orecip = stripslashes($orecip);
		$omessage = stripslashes($omessage);
	}
	//We check if all the fields are filled
	if($_POST['title']!='' and $_POST['recip']!='' and $_POST['message']!='')
	{
		//We protect the variables
		$title = mysql_real_escape_string($otitle);
		$recip = mysql_real_escape_string($orecip);
		$message = mysql_real_escape_string(nl2br(htmlentities($omessage, ENT_QUOTES, 'UTF-8')));
		//We check if the recipient exists
		$dn1 = mysql_fetch_array(mysql_query('select count(instructor_id) as recip, instructor_id as recipid, (select count(*) from tbl_pm) as npm from tbl_instructor where instructor_id="'.$recip.'"'));
//		$dn2 = mysql_fetch_array(mysql_query('select count(username) as recip, username as recipid, (select count(*) from pm) as npm from admin where username="'.$recip.'"'));
		if($dn1['recip']==1)
		{
			//We check if the recipient is not the actual user
			if($dn1['recipid']!=$_SESSION['username'])
			{
				$id = $dn1['npm']+1;
					$time = time() + (7 * 60 * 60);
				//We send the message
				if(mysql_query('insert into tbl_pm (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "1", "'.$title.'", "'.$_SESSION['username'].'", "'.$dn1['recipid'].'", "'.$message.'", "'.$time.'", "yes", "no")'))
				{
?>
<div class="message">The message has successfully been sent.<br />
<a href="inbox.php">List of my personnal messages</a></div>
<?php
					$form = false;
				}
				else
				{
					//Otherwise, we say that an error occured
					$error = 'An error occurred while sending the message';
				}
			}
		}
		if($dn2['receiver']==1)
		{
			//We check if the recipient is not the actual user
			if($dn1['receiverid']!=$_SESSION['username'])
			{
				$id = $dn1['npm']+1;
				//We send the message
				if(mysql_query('insert into tbl_pm (id, id2, subject, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "1", "'.$subject.'", "'.$studentid.'", "'.$dn2['receiverid'].'", "'.$message.'", "'.$time.'", "yes", "no")'))
				{
		?>
		<div class="message">The message has successfully been sent.<br />
		<a href="inbox.php">List of my personal messages</a></div>
		<?php
					$form = false;
				}
				else
				{
					//Otherwise, we say that an error occured
					$error = 'An error occurred while sending the message';
				}
			}
		}
		else
		{
			//Otherwise, we say the recipient does not exists
			$error = 'The recipient does not exists.';
		}
	}
	else
	{
		//Otherwise, we say a field is empty
		$error = 'A field is empty. Please fill of the fields.';
	}
}
elseif(isset($_GET['receiver']))
{
	//We get the username for the recipient if available
	$oreceiver = $_GET['receiver'];
}
if($form)
{
//We display a message if necessary
if(isset($error))
{
	echo '<div class="message">'.$error.'</div>';
}
//We display the form
?>
							
                                <div class="span12">
                                    <form class="form-horizontal" action="compose.php" method="post">
                                      <fieldset>
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">To </label>
                                          <div class="controls">
                                            <input type="text" class="span6" id="typeahead"  name="recip" placeholder="Username" value="" required>
												<p class="help-block"></p>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">Subject </label>
                                          <div class="controls">
                                            <input type="text" class="span6" id="typeahead"  name="title" placeholder="Subject" value="<?php echo htmlentities($otitle, ENT_QUOTES, 'UTF-8'); ?>" required>
												<p class="help-block"></p>
                                          </div>
                                        </div>
										
                                        <div class="control-group">
                                          <label class="control-label" for="textarea2">Content</label>
                                          <div class="controls">
                                            <textarea class="input-xlarge textarea" placeholder="Enter text ..." style="width: 500px; height: 200px" name="message"></textarea>
                                          </div>
                                        </div>
                                        <div class="form-actions">
											        <input type="submit" value="Send" class="btn btn-primary"/>
                                        </div>
                                      </fieldset>
                                    </form>

                                </div>
<?php
}
}
else
{
	echo '<div class="message">You must be logged to access this page.</div>';
}
?>								
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
            </div>
            
        </div>
        <!--/.fluid-container-->
        <link href="../_public/vendors/datepicker.css" rel="stylesheet" media="screen">
        <link href="../_public/vendors/uniform.default.css" rel="stylesheet" media="screen">
        <link href="../_public/vendors/chosen.min.css" rel="stylesheet" media="screen">

        <link href="../_public/vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen"> <script src="../_public/vendors/jquery-1.9.1.js"></script> <script src="../_public/bootstrap/js/bootstrap.min.js"></script> <script src="../_public/vendors/jquery.uniform.min.js"></script> <script src="../_public/vendors/chosen.jquery.min.js"></script> <script src="../_public/vendors/bootstrap-datepicker.js"></script> <script src="../_public/vendors/wysiwyg/wysihtml5-0.3.0.js"></script> <script src="../_public/vendors/wysiwyg/bootstrap-wysihtml5.js"></script> <script src="../_public/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>
		<script type="text/javascript" src="../_public/vendors/tinymce/js/tinymce/tinymce.min.js"></script> <script src="../_public/assets/scripts.js"></script>
		
		
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
				tinymce.init({
		    selector: "#tinymce_full",
		    plugins: [
		        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
		        "searchreplace wordcount visualblocks visualchars code fullscreen",
		        "insertdatetime media nonbreaking save table contextmenu directionality",
		        "emoticons template paste textcolor"
		    ],
		    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
		    toolbar2: "print preview media | forecolor backcolor emoticons",
		    image_advtab: true,
		    templates: [
		        {title: 'Test template 1', content: 'Test 1'},
		        {title: 'Test template 2', content: 'Test 2'}
		    ]
		});
        </script>
    </body>

</html>
<?php
}
?>