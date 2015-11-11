<?php
	session_start();
	include("../include/dbcon.php");
	date_default_timezone_set('Etc/GMT+8'); 
	
	if(!($_SESSION['login'])) {
		header("Location: ../student.php");
	}
	else {
		$studID  = $_SESSION['username'];
		include("includes/classMenu.php");
		
		$sql = mysql_query("SELECT * FROM tbl_activity WHERE add_late=0") or die(mysql_error());
									while($row = mysql_fetch_array($sql)){
										$actID = $row['activity_id'];
										$date = strtotime($row['deadline_date']);
										$time = strtotime($row['deadline_time']);
									}
									$day = date("Y-m-d");
									$cur_day = strtotime(date("Y-m-d"));
									$cur_time1 = date("H:i:s");
									$cur_time = strtotime($cur_time1);
									
									if(isset($actID)) {
										if($date<=$cur_day){
											 if($time<=$cur_time) {
												mysql_query("UPDATE tbl_activity SET status='0' WHERE attendance_id='$actID'");
											}
										}
									}
									
		if(isset($_REQUEST['file'])) {
			ob_start();  
			$id2    = $_REQUEST['file'];
			$query = "SELECT filename, file FROM tbl_activity WHERE activity_id='$id2' ";

			$result = mysql_query($query) or die (mysql_error());
			list($name, $content) = mysql_fetch_array($result);
			var_dump($content);   
			ob_end_clean();
										  
			header("Accept-Ranges: bytes");
			header("Keep-Alive: timeout=15, max=100");
			header("Content-Disposition: attachment; filename='$name'");
			//header("Content-type: '$type'");
			header("Content-Transfer-Encoding: binary");
			header( "Content-Description: File Transfer");
			echo $content;
		}
		
?>
<!DOCTYPE html>
<html>
    
<head>
        <title>Student | Activity</title>
                    <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <!-- Bootstrap -->
        <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="vendors/flot/excanvas.min.js"></script><![endif]-->
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]> <script src="../_public/http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]--> <script src="../_public/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    
    <body>
<?php include 'includes/navbar.php'; ?>
        <div class="container-fluid">
        <div class="span3" id="sidebar">
        <?php include 'includes/classbar.php'; ?>
        <?php include 'includes/note.php'; ?>
        </div>
            <div class="row-fluid">
                <!--/span-->
                <div class="span9" id="content">
                    <div class="row-fluid">
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href="classList.php">Class List</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li>Activity</li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>				
                    <div class="row-fluid">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Activity</div>
                                </div>
								<?php
									if(isset($_REQUEST['id'])) {
										$activityID = $_REQUEST['id'];
										
										$sql = mysql_query("SELECT * FROM tbl_activity  WHERE activity_id='$activityID' AND status=1")
													or die(mysql_error()) ;
										$count = mysql_num_rows($sql);
										if($count<0) {
											echo '<div class="alert">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Warning!</strong> Late submission is not allowed.
									</div>';
										}
										else {
										while($row=mysql_fetch_array($sql))
										{
											$activityID = $row['activity_id'];
											$desc= $row['description'];
											$dead_date = $row['deadline_date'];
											$dead_time = $row['deadline_time'];
											$category = $row['component'];
											$size = $row['allow_size'];
										}
										
										if(isset($_POST['btnSubmit'])) {
											$date = date('Y-m-d');
											$time = date('H:i:s');
											$date2= strtotime($date);
											$time2=strtotime($time);
											$dead_date2 = strtotime($dead_date);
											$dead_time2 = strtotime($dead_time);
											
											
											$fileName = $_FILES['userfile']['name'];
											$tmpName  = $_FILES['userfile']['tmp_name'];
											$fileSize = $_FILES['userfile']['size'];
											$fileType = $_FILES['userfile']['type'];
											
											$late =0;
											$size2 =($fileSize*1024);
											if($fileName=='') {
												$msg = '<div class="alert alert-error">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> No File Selected.
				</div>';
											}
											/*else if($fileSize>$size) {
												$msg = '<i><font color="red">Exceed maximum size.</font></i>';
											}*/
											else if($fileSize>$size2) {
												'<div class="alert alert-error">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> File size is too big.
				</div>';
											}
											else {
												$fp = fopen($tmpName, 'r');
												$content = fread($fp, filesize($tmpName));
												$content2 = addslashes($content);
												fclose($fp);

												if(!get_magic_quotes_gpc()){
													$fileName = addslashes($fileName);
												}
												
													if($date2>=$dead_date2){
														 if($time2>$dead_time2) {
															$late = 1;
														}
													}	
													
												mysql_query("INSERT INTO tbl_notification2(class_id, category, status) VALUES('$classID','activity','0')") or die(mysql_error());
												mysql_query("INSERT INTO tbl_activity_grade (class_class_id, activity_id, file, filename, date_submit, time_submit, status, grade_id)
																	VALUES ('$enrollID','$activityID','$content2','$fileName','$date','$time','$late', 'N/A')")
																	or die(mysql_error());
																	
												$msg = '<div class="alert alert-success">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Success!</strong>  Your activity has been uploaded successfully. 
									</div>';
											}
										
										}
										
										
											$sql2 = mysql_query("SELECT * FROM tbl_activity_grade  WHERE activity_id='$activityID' AND class_class_id='$enrollID'")
																	   or die(mysql_error()) ;
											if(mysql_num_rows($sql2) > 0)
											{
												echo '<div class="alert alert-success">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Success!</strong>  Your activity has been uploaded. 
									</div>';
											}
										else {
									?>
										<form action="" method="post" enctype="multipart/form-data" >
										<div class="block-content collapse in">
										<table align="center" width="500px" height="300px">
											<tr>
												<td align="center"><b>Instruction</b></td>
												<td align="center"><?php echo $desc;?></td>
											</tr>
											<tr>
												<td align="center"><b>Category</b></td>
												<td align="center"><?php echo $category;?></td>
											</tr>
											<tr>
												<td align="center"><b>Deadline</b></td>
												<td align="center"><?php echo $dead_date.' | '.$dead_time;?></td>
											</tr>
											<tr>
												<td align="center" colspan="2">
													 Upload Up to <?php echo $size;?>MB <input class="input-file uniform_on" name="userfile" type="file" id="userfile">
												</td>
												<td align="center"></td>
											</tr>
											<tr>
												<td align="center" colspan="2">
												  <button type="submit" class="btn btn-primary" name="btnSubmit">Submit</button>
												  <button type="reset" class="btn">Cancel</button>
												 </td>
											</tr>
											<tr>
												<td colspan="2" align="center"><?php if(isset($_POST['btnSubmit'])) { echo $msg; }?></td>
											</tr>
											</table>
										</div>
										</form>
								<?php }
									}
								}
								else {
								?>
                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>File</th>
                                                <th>Date</th>
                                                <th>Grade</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$sql2 = mysql_query("SELECT * FROM tbl_activity  WHERE class_id='$classID' AND status='1'")
																   or die(mysql_error()) ;
												if(mysql_num_rows($sql2) == 0)
												{?>
													<tr>
														<td colspan="4"><?php echo '<div class="alert">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Warning!</strong> No activity has been uploaded.
									</div>'; ?></td>
													</tr><?php
												} 
												else
												{
													while($row=mysql_fetch_array($sql2))
													{
														$id = $row['activity_id'];
														echo '<tr>';
														echo '<td>'.$row['title'].'</a></td>';
														echo "<td>".$row['filename'].'</td>';
														echo '<td>'.$row['dated'].'</td>';
														$sql = mysql_query("SELECT g.score FROM tbl_activity_grade a, tbl_grades g WHERE a.activity_id='$id' AND a.grade_id!='N/A' AND g.grade_id=a.grade_id")
																   or die(mysql_error()) ;
														if(mysql_num_rows($sql) >0)
														{
															while($row2=mysql_fetch_array($sql))
															{ echo '<td>'.$row2['score'].'/'.$row['over'].'</td>'; }
														}
														else {
															echo '<td>N/A</td>';
														}
														?>
														
														<td><a href="activity.php?file=<?php echo $id;?>"><button class="btn"><i class="icon-download-alt"></i></button></a>
														<a href="activity.php?id=<?php echo $id;?>"><button class="btn"><i class="icon-edit"></i></button></a></td>
													<?php echo '<tr>';
													}
												}
											?>
                                        </tbody>
                                    </table>
                                </div>
								<?php
								}
								?>
                            </div>
                            <!-- /block -->

                    </div>


                </div>
            </div>
         
 <hr class="footer-divider">
			<p>&copy; 2013 FEU-FERN COLLEGE</p> 
        </div>
        <!--/.fluid-container-->
        <link href="../_public/vendors/datepicker.css" rel="stylesheet" media="screen">
        <link href="../_public/vendors/uniform.default.css" rel="stylesheet" media="screen">
        <link href="../_public/vendors/chosen.min.css" rel="stylesheet" media="screen">

        <link href="../_public/vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen"> <script src="../_public/vendors/jquery-1.9.1.js"></script> <script src="../_public/bootstrap/js/bootstrap.min.js"></script> <script src="../_public/vendors/jquery.uniform.min.js"></script> <script src="../_public/vendors/chosen.jquery.min.js"></script> <script src="../_public/vendors/bootstrap-datepicker.js"></script> <script src="../_public/vendors/wysiwyg/wysihtml5-0.3.0.js"></script> <script src="../_public/vendors/wysiwyg/bootstrap-wysihtml5.js"></script> <script src="../_public/vendors/wizard/jquery.bootstrap.wizard.min.js"></script> <script src="../_public/assets/scripts.js"></script>
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