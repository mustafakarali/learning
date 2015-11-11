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
<html class="no-js">
    
    <head>
        <title>Student | Message</title>
        <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <!-- Bootstrap --> <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen"> <link href="../_public/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen"> <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="../_public/http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="../_public/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    
    <body>
<?php include 'includes/navbar.php'; ?>
        <div class="container-fluid" >
            <div class="row-fluid">
                
                <!--/span-->
                <div class="span12" id="content">

                    <div class="row-fluid">
                        <div class="span12">
                            <!-- block -->
                            <div class="block">
<?php
//We check if the user is logged
if(isset($_SESSION['username']))
{
//We check if the ID of the discussion is defined
if(isset($_GET['id']))
{
$id = intval($_GET['id']);
//We get the title and the narators of the discussion
$req1 = mysql_query('select title, user1, user2 from tbl_pm where id="'.$id.'" and id2="1"');
$dn1 = mysql_fetch_array($req1);
//We check if the discussion exists
if(mysql_num_rows($req1)==1)
{
//We check if the user have the right to read this discussion
if($dn1['user1']==$_SESSION['username'] or $dn1['user2']==$_SESSION['username'])
{
//The discussion will be placed in read messages
if($dn1['user1']==$_SESSION['username'])
{
	mysql_query('update tbl_pm set user1read="yes" where id="'.$id.'" and id2="1"');
	$user_partic = 2;
}
else
{
	mysql_query('update tbl_pm set user2read="yes" where id="'.$id.'" and id2="1"');
	$user_partic = 1;
}
//We get the list of the messages
$req2 = mysql_query('select pm.timestamp, pm.message, 
		tbl_student.student_id as userid, 
		tbl_student.student_id from tbl_pm as pm, tbl_student
		where pm.id="'.$_GET['id'].'" 
		and tbl_student.student_id=pm.user1 order by pm.timestamp');
$req3 = mysql_query('select pm.timestamp, pm.message, 
		tbl_instructor.instructor_id as userid, 
		tbl_instructor.instructor_id from tbl_pm as pm, tbl_instructor
		where pm.id="'.$_GET['id'].'" 
		and tbl_instructor.instructor_id=pm.user1 order by pm.timestamp');		
$req4 = mysql_query('select pm.timestamp, pm.message, 
		tbl_parent.username as userid, 
		tbl_parent.username from tbl_pm as pm, tbl_parent
		where pm.id="'.$_GET['id'].'" 
		and tbl_parent.username=pm.user1 order by pm.timestamp');				
//We check if the form has been sent
if(isset($_POST['message']) and $_POST['message']!='')
{
	$message = $_POST['message'];
	//We remove slashes depending on the configuration
	if(get_magic_quotes_gpc())
	{
		$message = stripslashes($message);
	}
	//We protect the variables
		$time = time() + (7 * 60 * 60);
	$message = mysql_real_escape_string(nl2br(htmlentities($message, ENT_QUOTES, 'UTF-8')));
	//We send the message and we change the status of the discussion to unread for the recipient
	if(mysql_query('insert into tbl_pm (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "'.(intval(mysql_num_rows($req2))+1).'", "", "'.$_SESSION['username'].'", "'.$dn1['user2'].'", "'.$message.'", "'.$time.'", "", "")') and mysql_query('update tbl_pm set user'.$user_partic.'read="yes" where id="'.$id.'" and id2="1"'))
	{
?>
<div class="message">Your message has successfully been sent.<br />
<a href="message.php?id=<?php echo $id; ?>">Go to the discussion</a></div>
<?php
	}
	else
	{
?>
<div class="message">An error occurred while sending the message.<br />
<a href="message.php?id=<?php echo $id; ?>">Go to the discussion</a></div>
<?php
	}
}
else
{
//We display the messages
?>							
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">
                                          <div class="controls">
										  <label><?php echo $dn1['title']; ?></label>
                                          </div>
									</div>
                                    <div class="pull-right">
                                      <button class="btn btn-primary" style="margin-bottom:5px;"><i class="icon-trash icon-white"></i> Delete</button>
                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped" style="overflow:scroll;">
                                        <tbody>
<?php
while($dn2 = mysql_fetch_array($req2) or $dn3 = mysql_fetch_array($req3) or $dn4 = mysql_fetch_array($req4))
{

?>									
                                            <tr><td>
                                <div class="navbar">
                                    <div class="muted pull-left">
                                          <div class="controls">
										  <label><?php if($dn2['userid'])
										  echo $dn2['userid']; 
										  else if($dn3['userid'])
										  echo $dn3['userid']; 
										  else if($dn4['userid'])
										  echo $dn4['userid'];?></label>
                                          </div>
										  <p>
										<?php if($dn2['userid'])
										echo htmlspecialchars_decode($dn2['message']); 
										else if($dn3['userid'])
										echo htmlspecialchars_decode($dn3['message']);
										else if($dn4['userid'])
										echo htmlspecialchars_decode($dn4['message']);
										?>
										  </p>
									</div>
                                    <div class="pull-right">
										<label><?php if($dn2['userid'])
										echo date('m/d/Y H:i:s' ,$dn2['timestamp']);
										else if($dn3['userid'])
										echo date('m/d/Y H:i:s' ,$dn3['timestamp']);
										else if($dn4['userid'])
										echo date('m/d/Y H:i:s' ,$dn4['timestamp']);?>
										</label>
                                    </div>
									
                                </div></td>
                                            </tr>
<?php
}
//We display the reply form
?>											
											
                                        </tbody>
                                    </table>
                                </div>
<?php
}
}
else
{
	echo '<div class="message">You do not have the right to access this page.</div>';
}
}
else
{
	echo '<div class="message">This discussion does not exists.</div>';
}
}
else
{
	echo '<div class="message">The discussion ID is not defined.</div>';
}
}
else
{
	echo '<div class="message">You must be logged to access this page.</div>';
}
?>									
                            </div>
                            <!-- /block -->
                        </div>
                    </div>
                     <div class="row-fluid" >
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Reply</div>
                            </div>
                            <div class="block-content collapse in">

							
                                <div class="span12">
                                    <form class="form-horizontal" action="message.php?id=<?php echo $id; ?>" method="post">
                                      <fieldset>
                                        <div class="control-group">
                                          <label class="control-label" for="textarea2">Message</label>
                                          <div class="controls">
                                            <textarea class="input-xlarge textarea" placeholder="Enter text ..." style="width: 500px; height: 200px" name="message" id="message"></textarea>
                                          </div>
                                        </div>
                                        <div class="form-actions">
											        <input type="submit" value="Send" class="btn btn-primary"/>
                                        </div>
                                      </fieldset>
                                    </form>

                                </div>	
							
                            </div>
                        </div>
                        <!-- /block -->
                    </div>

                </div>
            </div>
        </div>
        <!--/.fluid-container--> <link href="../_public/vendors/datepicker.css" rel="stylesheet" media="screen"> <link href="../_public/vendors/uniform.default.css" rel="stylesheet" media="screen"> <link href="../_public/vendors/chosen.min.css" rel="stylesheet" media="screen"> <link href="../_public/vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">

        <script src="../_public/vendors/jquery-1.9.1.js"></script>
        <script src="../_public/bootstrap/js/bootstrap.min.js"></script>
        <script src="../_public/vendors/jquery.uniform.min.js"></script>
        <script src="../_public/vendors/chosen.jquery.min.js"></script>
        <script src="../_public/vendors/bootstrap-datepicker.js"></script>

        <script src="../_public/vendors/wysiwyg/wysihtml5-0.3.0.js"></script>
        <script src="../_public/vendors/wysiwyg/bootstrap-wysihtml5.js"></script>

        <script src="../_public/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>
		<script type="text/javascript" src="../_public/vendors/tinymce/js/tinymce/tinymce.min.js"></script>

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