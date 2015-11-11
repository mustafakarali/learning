<?php
	session_start();
	error_reporting(0);
	include("../include/dbcon.php");
	
	if(!($_SESSION['login'])) {
		header("Location: ../instructor.php");
	}
	else {
		$insID  = $_SESSION['username'];
		$pmID = $_REQUEST['myVar'];		
		$parentID = mysql_result(mysql_query("SELECT parent_id FROM tbl_parent WHERE child_id='$pmID'"),0);
		
		include("includes/classMenu.php");
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title><?php echo $course."-".$section;?> - Messages</title>
                    <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <!-- Bootstrap -->
        <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="vendors/flot/excanvas.min.js"></script><![endif]-->
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="../_public/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    
    <body>
<?php include 'includes/navbar.php'; ?>
        <div class="container-fluid">
            <div class="row-fluid">
<?php include 'includes/classbar.php'; ?>
                <!--/span-->
                <div class="span9" id="content">
                    <div class="row-fluid">
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href="members.php">Members</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li><a href="pm.php?myVar=<?php echo $pmID;?>">Inbox</a><span class="divider">/</span></li>
	                                    <li><a href="sent.php?myVar=<?php echo $pmID;?>">Sent Items</a><span class="divider">/</span></li>
	                                    <li><a href="new.php?myVar=<?php echo $pmID;?>">Compose New</a></li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>				
                    <div class="row-fluid">
                            <!-- block --><?php 
								if(isset($_REQUEST['conver'])) {
									$chatID2 = $_REQUEST['conver'];
									$sender2 = mysql_result(mysql_query("SELECT sender FROM tblchat WHERE id='$chatID2' AND sender_b='$insID'"),0);
									if(!$sender2) {
										$sender2 = $pmID;
									}
									if(isset($_POST['submit'])) {
										$msg=$_POST['msg'];
										$pmID2 = $_REQUEST['conver'];				
										//$sender=$_POST['sender'];
										$sender = $pmID;
										$sql="INSERT into tblchat (msg,sender,sender_b,status) values ('$msg','$insID','$sender2','$pmID2')";
										mysql_query($sql);
									} ?>
									<form action="" method="post">
								<div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Conversation</div>
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Messages</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php 	
											$z=0;
											$y=0;
											$l=0;
											$sql="select * from tblchat WHERE sender = '$sender2' AND sender_b='$insID' AND status='$chatID2' order by id DESC";
													$query=mysql_query($sql) or die(mysql_error());
													while ($row=mysql_fetch_array($query))
													{
														$z=1;
														$chatID = $row['id'];
														$status = $row['status'];
														$sender = $row['sender'];
														
														$check = mysql_result(mysql_query("SELECT count(*) FROM tbl_student WHERE student_id='$sender'"),0);
														
														if($check) {
															$sql3 = mysql_query("SELECT * FROM tbl_student WHERE student_id='$sender2'") or die(mysql_error());
															while($row3=mysql_fetch_array($sql3)){
																$fname_stud = $row3['first_name'];
																$lname_stud = $row3['last_name'];
																$to = $fname_stud.' '.$lname_stud;
															}
														}
														else {
																$to = 'Parent';
														}
														if($status!=0) {
															if($y==0) {
																$y=1;
															$sql2 = mysql_query("SELECT * FROM tblchat WHERE id='$status'") or die(mysql_error());
															while($row2=mysql_fetch_array($sql2)) {
																echo "<tr>";
																if($row2['sender']==$insID) {
																	echo "<td>Me</td>";
																}
																else {
																	echo "<td>$to</td>";
																}
																echo '<td>'.'<div class="pull-right">'.$row2['time'].'</div>'.' :'.'&nbsp;&nbsp;'.$row2['msg'].'</td>';
																echo "</tr>";
															}
															}
														}
														
														/*echo "<tr>";
														echo "<td>$to</td>";
														echo '<td>'.'a<div class="pull-right">'.$row['time'].'</div>'.' :'.'&nbsp;&nbsp;'.$row['msg'].'</td>';
														echo "</tr>";*/
														
															if($l==0) {
																$l=1;
														$sql2 = mysql_query("SELECT * FROM tblchat WHERE status='$chatID2'") or die(mysql_error());
														while($row2=mysql_fetch_array($sql2)) {
															echo "<tr>";
															if($row2['sender']==$insID) {
																echo "<td>Me</td>";
															}
															else {
																echo "<td>$to</td>";
															}
															echo '<td>'.'<div class="pull-right">'.$row2['time'].'</div>'.' :'.'&nbsp;&nbsp;'.$row2['msg'].'</td>';
															echo "</tr>";
														}
														}
													}
													
													if($z==0) {
													$sql="select * from tblchat WHERE sender = '$sender2' AND sender_b='$insID' AND id='$chatID2' order by id DESC";
													$query=mysql_query($sql) or die(mysql_error());
													while ($row=mysql_fetch_array($query))
													{
														$z=1;
														$chatID = $row['id'];
														$status = $row['status'];
														$sender = $row['sender'];
														
														$check = mysql_result(mysql_query("SELECT count(*) FROM tbl_student WHERE student_id='$sender'"),0);
														
														if($check) {
															$sql3 = mysql_query("SELECT * FROM tbl_student WHERE student_id='$sender2'") or die(mysql_error());
															while($row3=mysql_fetch_array($sql3)){
																$fname_stud = $row3['first_name'];
																$lname_stud = $row3['last_name'];
																$to = $fname_stud.' '.$lname_stud;
															}
														}
														else {
																$to = 'Parent';
														}
														echo "<tr>";
														echo "<td>$to</td>";
														echo '<td>'.'<div class="pull-right">'.$row['time'].'</div>'.' :'.'&nbsp;&nbsp;'.$row['msg'].'</td>';
														echo "</tr>";
														
														if($status!=0) {
															echo $status;
															$sql2 = mysql_query("SELECT * FROM tblchat WHERE id='$status'") or die(mysql_error());
															while($row2=mysql_fetch_array($sql2)) {
																echo "<tr>";
																if($row2['sender']==$insID) {
																	echo "<td>Me</td>";
																}
																else {
																	echo "<td>$to</td>";
																}
																echo '<td>'.'<div class="pull-right">'.$row2['time'].'</div>'.' :'.'&nbsp;&nbsp;'.$row2['msg'].'</td>';
																echo "</tr>";
															}
														}
														
														/*echo "<tr>";
														echo "<td>$to</td>";
														echo '<td>'.'a<div class="pull-right">'.$row['time'].'</div>'.' :'.'&nbsp;&nbsp;'.$row['msg'].'</td>';
														echo "</tr>";*/
														$sql2 = mysql_query("SELECT * FROM tblchat WHERE status='$chatID2'") or die(mysql_error());
														while($row2=mysql_fetch_array($sql2)) {
															echo "<tr>";
															if($row2['sender']==$insID) {
																echo "<td>Me</td>";
															}
															else {
																echo "<td>$to</td>";
															}
															echo '<td>'.'<div class="pull-right">'.$row2['time'].'</div>'.' :'.'&nbsp;&nbsp;'.$row2['msg'].'</td>';
															echo "</tr>";
														}
														
													}
													
													}
													
												?> 
										<tr>
											<td width="5%">Message:
											<td ><textarea name="msg" type="text" placeholder="Type Message Here...."  class="input-xlarge textarea" placeholder="Enter text ..." style="width: 500px; height: 70px"required></textarea> <input name="submit" id="post_button" type="submit"  value="Send" class="btn btn-primary"/> </td>
										</tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
							</form>
								<?php
								}
								else {
                            
								?>
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Conversation</div>
                                    <div class="pull-right"><a href="upload.php">
                                    </a>
                                    </div>
                                </div>
                                
								
                           <?php  $ggg = mysql_query("SELECT * FROM tblchat WHERE sender_b='$insID'") or die(mysql_error());
                            $gg2 = mysql_num_rows($ggg);
                            if($gg2) { ?>
                                <div class="block-content collapse in">
								<form method="post" name="" action="">
                                    <table class="table table-striped">
											<?php 
													$sql="select * from tblchat WHERE sender_b = '$insID' AND sender='$pmID' OR sender='$parentID' order by id DESC";
													$query=mysql_query($sql);
													while ($row=mysql_fetch_array($query))
													{
													
												$d=0;
														$chatID = $row['id'];
														$sender = $row['sender'];
															$status2 = $row['status'];
														$check = mysql_result(mysql_query("SELECT count(*) FROM tbl_student WHERE student_id='$sender'"),0);
														
														if($check) {
															$sql3 = mysql_query("SELECT * FROM tbl_student WHERE student_id='$pmID'") or die(mysql_error());
															while($row3=mysql_fetch_array($sql3)){
																$fname_stud = $row3['first_name'];
																$lname_stud = $row3['last_name'];
																$to = $fname_stud.' '.$lname_stud;
															}
														}
														else {
																$to = 'Parent';
														}
														
														if($row['status']!=0) {
														
														if($d==0) {
															$d=1;
															$sql2="select * from tblchat WHERE status='$status2' AND sender_b='$insID' order by id DESC LIMIT 1";
															$query2=mysql_query($sql2) or die(mysql_error());
															while ($row2=mysql_fetch_array($query2))
															{
																echo "<tr>";
																echo "<td><a href=\"pm.php?myVar=$pmID&conver=$status2\">$to</a></td>";
																echo '<td>'.'<div class="pull-right">'.$row2['time'].'</div>'.' :'.'&nbsp;&nbsp;'.$row2['msg'].'</td>';
																echo "</tr>";
															}
														}
														}
														else {
														
															echo "<tr>";
															echo "<td><a href=\"pm.php?myVar=$pmID&conver=$chatID\">$to</a></td>";
															echo '<td>'.'<div class="pull-right">'.$row['time'].'</div>'.' :'.'&nbsp;&nbsp;'.$row['msg'].'</td>';
															echo "</tr>";
														}
													}
												?>      
										
                                    </table>
									</form>
                                </div><?php  } else {
                                	echo '<div class="alert">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Warning!</strong> Inbox is empty.
									</div>';
                                } ?>
                            </div>
							<?php } ?>
                            <!-- /block -->

                    </div>


                </div>
            </div>

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
?>