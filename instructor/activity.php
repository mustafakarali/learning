<?php
	session_start();
	//error_reporting(0);
	include("../include/dbcon.php");
	date_default_timezone_set('Etc/GMT'); 
	
	if(!($_SESSION['login'])) {
		header("Location: ../instructor.php");
	}
	else {
		$insID  = $_SESSION['username'];
		include("includes/classMenu.php");
		
		//echo date("Y-m-d").' ';
		//echo date("H:i:s");
		
		$query_start = mysql_query("SELECT month, day FROM tbl_calendar ORDER BY calendar_id ASC LIMIT 1") or die(mysql_error());
		while($row = mysql_fetch_array($query_start))
		{
			$query_Smonth = $row['month'];
			$query_Sday = $row['day'];
		}
		
		$query_end = mysql_query("SELECT month, day FROM tbl_calendar ORDER BY calendar_id DESC LIMIT 1") or die(mysql_error());
		while($row = mysql_fetch_array($query_end))
		{
			$query_Emonth = $row['month'];
			$query_Eday = $row['day'];
		}
		
		$cur_year = date("Y");
		$term_start = strtotime($cur_year.'-'.$query_Smonth.'-'.$query_Sday);
		$term_end = strtotime($cur_year.'-'.$query_Emonth.'-'.$query_Eday);
		
		if(isset($_REQUEST['file'])) {
			ob_start();  
			$fileID= $_REQUEST['file'];
			$query = "SELECT filename, file FROM tbl_activity_grade WHERE activity_grade_id='$fileID'";

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
        <title>Instructor | Activity</title>
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
	                                        <a href="classList.php">Class List</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li>Activity</li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>				
                    <div class="row-fluid">
					<form class="form-horizontal" enctype="multipart/form-data" method="post" action="">
                            <!-- block -->
							<?php
								if(isset($_REQUEST['action'])) {
									if($_REQUEST['action']==1) {
										$activityID=$_REQUEST['activity'];
										
										if(isset($_POST['btnSaveGrade'])) {
											$sql = mysql_query("SELECT c.class_class_id as enrollID FROM tbl_class_class c, tbl_student s WHERE c.class_id='$classID' AND c.student_id=s.student_id") or die(mysql_error()) ;
											while($row = mysql_fetch_array($sql))
											{	$score = 0;
												$DSscore=0;
												$DStotal =0;
												$Sscore = 0;
												$Stotal=0;
												$total=0;
												$ave = 0;
												$percent = 0;
												$grade = 0;
												$final = 0;
												$totalpercent = 0;
												$enrollID = $row['enrollID'];
												$sql2= mysql_query("SELECT b.component, b.over , b.dated , a.grade_id, a.activity_grade_id, b.category  FROM tbl_activity_grade a, tbl_activity b WHERE a.class_class_id='$enrollID' AND a.class_class_id='$enrollID' AND a.activity_id='$activityID' AND a.activity_id=b.activity_id") or die(mysql_error()) ;
												if(mysql_num_rows($sql2) >0) {
													while($row2 = mysql_fetch_array($sql2))
													{ 
														$id = $row2['activity_grade_id'];
														$over = $row2['over'];
														$category = $row2['category'];
														$comp = $row2['component'];
														$grade =  $_POST["id$id"];
														$dated = $row2['dated'];
														$gradeID = $row2['grade_id'];
														
													/*	$sql5 = mysql_query("SELECT g.score,g.grade_id, g.component, g.category, g.class_class_id, cc.class_class_id, cc.class_id, c.class_id FROM tbl_grades g, tbl_class_class cc, tbl_class c WHERE g.component='$comp' and g.category='$category' AND g.score='' AND cc.class_class_id=g.class_class_id AND cc.class_id=c.class_id  AND c.class_id='$classID'") or die(mysql_error());
														while($row5 = mysql_fetch_array($sql5))
														{
																	echo $row5['grade_id'].' ';
																	echo $row5['component'].' ';
																	echo $row5['category'].' ';
														}*/
																
														if($grade!=''){
															$act_score = mysql_result(mysql_query("SELECT grade_id FROM tbl_grades WHERE class_class_id='$enrollID' AND component='$comp' AND category='$category'"),0);
															
															if($gradeID=='N/A') {
																mysql_query("INSERT INTO tbl_notification(class_class_id, category, status) VALUES('$enrollID','sar','0')") or die(mysql_error());
																
																mysql_query("UPDATE tbl_activity_grade SET grade_id='$act_score' WHERE activity_grade_id='$id'")
																or die (mysql_error());
															}
																mysql_query("UPDATE tbl_grades SET dated='$dated', noOfItems='$over', score='$grade' WHERE grade_id='$act_score'")
																or die (mysql_error());
															
																								
																$sql3 = mysql_query("SELECT * FROM tbl_grades WHERE class_class_id='$enrollID' AND component='$comp' AND category!='AVG'") or die(mysql_error()) ;
																while($row3 = mysql_fetch_array($sql3))
																{
																	$score += $row3['score'];
																	$total += $row3['noOfItems'];
																}
																
																$average = intval(($score/$total)*100);
																$query2 =mysql_query("SELECT COUNT(*) FROM tbl_grades WHERE component='$comp' AND class_class_id='$enrollID' AND category='AVG'") or die(mysql_error());
																$result2 = mysql_result($query2,0);
																if(!$result2) {
																	mysql_query("INSERT INTO tbl_grades (score, component, category, class_class_id) VALUES ('$average','$comp','AVG','$enrollID')")  or die (mysql_error());
																}
																else {
																	mysql_query("UPDATE tbl_grades SET score='$average' WHERE component='$comp' AND class_class_id='$enrollID' AND category='AVG'")
																	or die (mysql_error());
																}
																$sql7 = mysql_query("SELECT * FROM tbl_grades WHERE class_class_id='$enrollID' AND category='AVG'")
																		or die(mysql_error()) ;
																$num_rows2 = mysql_num_rows($sql7);

																if($num_rows2 > 0){
																	while($row7 = mysql_fetch_array($sql7))
																	{										
																		$gradeID = $row7['grade_id'];
																		$sql = mysql_query("SELECT g.score as score, c.percentage as percent FROM tbl_grades g, tbl_component c WHERE g.grade_id='$gradeID' AND c.name=g.component AND class_id='$classID'")
																		or die(mysql_error());
																		while($row = mysql_fetch_array($sql))
																		{
																			$ave = $row['score'];
																			$percent = $row['percent'];
																			$totalpercent += $percent;
																			$grade = ($ave * ($percent/100));
																			$final += $grade;
																		}
																	}
																}
																$finalgrade =($final/$totalpercent)*100;
																		
																$query =mysql_query("SELECT COUNT(*) FROM tbl_finalgrade WHERE class_class_id='$enrollID'") or die(mysql_error());
																$result = mysql_result($query,0);
																if(!$result) {
																	mysql_query("INSERT INTO tbl_finalgrade (class_class_id, grade) VALUES ('$enrollID','$finalgrade')")  or die (mysql_error());
																}
																else {
																	mysql_query("UPDATE tbl_finalgrade SET grade='$finalgrade' WHERE class_class_id='$enrollID'")
																	or die (mysql_error());
																}
														}
													}
												}
												if($Stotal==0) {
											}
											else {
												//update average in tbl_grades
												$Saverage = intval(($Sscore/$Stotal)*100);
												mysql_query("UPDATE tbl_grades SET score='$Saverage' WHERE component='$comp' AND class_class_id='$enrollID' AND category='AVG'")
														or die (mysql_error());
											
												//update tbl_final grade
												$sql7 = mysql_query("SELECT * FROM tbl_grades WHERE class_class_id='$enrollID' AND category='AVG'")
														or die(mysql_error()) ;
												$num_rows2 = mysql_num_rows($sql7);

												if($num_rows2 > 0){
													while($row7 = mysql_fetch_array($sql7))
													{										
														$gradeID = $row7['grade_id'];
														$sql = mysql_query("SELECT g.score as score, c.percentage as percent FROM tbl_grades g, tbl_component c WHERE g.grade_id='$gradeID' AND c.name=g.component AND class_id='$classID'")
														or die(mysql_error());
														while($row = mysql_fetch_array($sql))
														{
															if($row['score']!='') {
																$ave = $row['score'];
																$percent = $row['percent'];
																$totalpercent += $percent;
																$grade = ($ave * ($percent/100));
																$final += $grade;
															}
														}
													}
												}
												$finalgrade =($final/$totalpercent)*100;
												switch($finalgrade) {
												case ($finalgrade==100):
													$gpa = 4.00;
													break;
												case ($finalgrade>=97.50 && $finalgrade<100):
													$gpa = 3.75;
													break;
												case ($finalgrade>=95 && $finalgrade<97.50):
													$gpa = 3.50;
													break;
												case ($finalgrade>=92.50 && $finalgrade<95):
													$gpa = 3.25;
													break;
												case ($finalgrade>=90 && $finalgrade<92.50):
													$gpa = 3.00;
													break;
												case ($finalgrade>=87.50 && $finalgrade<90):
													$gpa = 2.75;
													break;
												case ($finalgrade>=85 && $finalgrade<87.50):
													$gpa = 2.50;
													break;
												case ($finalgrade>=82.5 && $finalgrade<85):
													$gpa = 2.25;
													break;
												case ($finalgrade>=80 && $finalgrade<82.50):
													$gpa = 2.00;
													break;
												case ($finalgrade>=75 && $finalgrade<80):
													$gpa = 1.50;
													break;
												case ($finalgrade>=72.50 && $finalgrade<75):
													$gpa = 1.25;
													break;
												case ($finalgrade>=70 && $finalgrade<72.50):
													$gpa = 1.00;
													break;
												default: $gpa = 0.00;
											}	
												$query =mysql_query("SELECT COUNT(*) FROM tbl_finalgrade WHERE class_class_id='$enrollID'") or die(mysql_error());
												$result = mysql_result($query,0);
												if(!$result) {
													mysql_query("INSERT INTO tbl_finalgrade (class_class_id, grade, gpa) VALUES ('$enrollID','$finalgrade','$gpa')")  or die (mysql_error());
												}
												else {
													mysql_query("UPDATE tbl_finalgrade SET grade='$finalgrade', gpa='$gpa' WHERE class_class_id='$enrollID'")
													or die (mysql_error());
												}
											}
											}
											
										}
									?>
										<div class="block">
										<div class="navbar navbar-inner block-header">
											<div class="muted pull-left">View Activity</div>
										</div>
										<div class="block-content collapse in">
											<table class="table table-striped">
												<thead>
													<tr>
														<th>Student</th>
														<th>Date|Time</th>
														<th>Status</th>
														<th>File</th>
														<th>Grade</th>
													</tr>
												</thead>
												<tbody>
													<?php $sql = mysql_query("SELECT s.first_name as fname, s.last_name as lname, c.class_class_id as enrollID FROM tbl_class_class c, tbl_student s WHERE c.class_id='$classID' AND c.student_id=s.student_id") or die(mysql_error()) ;
														$x = 1;
														while($row = mysql_fetch_array($sql))
														{ 
															$enrollID = $row['enrollID'];
															echo "<tr>";
															echo "<td>".$row['fname'].','.$row['lname']."</td>";
															
															$sql2 = mysql_query("SELECT a.activity_grade_id ,a.status,  b.over, a.date_submit, a. time_submit, a.filename, a.grade_id FROM  tbl_activity_grade a, tbl_activity b WHERE a.class_class_id='$enrollID' AND a.activity_id='$activityID' AND a.activity_id=b.activity_id ") or die(mysql_error()) ;
															if(mysql_num_rows($sql2) >0) {
																while($row2 = mysql_fetch_array($sql2))
																{ 	$over = $row2['over'];
																	$id = $row2['activity_grade_id'];
																	$late = $row2['status'];
																	echo "<td>".$row2['date_submit'].'|'.$row2['time_submit']."</td>";
																	if($late) {
																		echo '<td>LATE</td>';
																	}
																	else {
																		echo '<td></td>';
																	}
																	echo "<td><a href=\"activity.php?action=1&activity=1&file=$id\">".$row2['filename']."</a></td>";
																	if($row2['grade_id']=='N/A') {
																		echo "<td><select name=\"id$id\">";
																		echo "<option value='0'>N/A";
																				for($i=1;$i<=$over;$i++) {?>
																					<option value='<?php echo $i;?>'><?php echo  $i.'/'.$row2['over'];?>
																			<?php }
																			echo '</select></td>';
																	}
																	else {
																		$result = mysql_result(mysql_query("SELECT g.score FROM tbl_grades g, tbl_activity_grade a WHERE a.activity_grade_id='$id' AND g.grade_id=a.grade_id"),0);
																		echo "<td><select name=\"id$id\">";
																				for($i=1;$i<=$over;$i++) {?>
																					<option value='<?php echo $i;?>' <?php echo ($result == $i) ? 'selected="selected"' : ''; ?>><?php echo  $i.'/'.$row2['over'];?>
																			<?php }
																			echo '</select></td>';
																	}
																}
															}
															else {
																echo "<td></td>";
																echo "<td></td>";
																echo "<td></td>";
																echo "<td></td>";
															}
															echo "</tr>";
															$x++;
														}
													?>
													<tr>
														<td colspan="5"><p  align="right"><input type="submit" value="Save" name="btnSaveGrade" style="width:150px"></input></p></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								<?php
									}
									else if ($_REQUEST['action']==2){ 
										$activityID = $_REQUEST['activity'];
										if(isset($_POST['btnSaveActivity']))
										{
											$error=0;
											$sql = mysql_query("SELECT * FROM tbl_activity WHERE activity_id='$activityID'") or die(mysql_error()) ;
				
											while($row = mysql_fetch_array($sql))
											{ 
												$file = $row['file'];
												$column2 = $row['add_late'];
												$category = $row['category'];
												$component = $row['component'];
											}
											
											$year = date("Y");

											
												$over = $_POST['over'];
												$allow = $_POST['size'];
												$date2 = date('Y-m-d');
												list($comp, $category) = explode('-', $row['category']);
												$late = $_POST['late'];
												$title = $_POST['title'];
												$desc = $_POST['desc'];
												$late = $_POST['late'];
												$deadline_date = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['date'])));
												
												$mn = $_POST['mn'];
												$hr = $_POST['hr'];
												$time = $hr.':'.$mn.':00';
												
												$cur_date = strtotime($date2);
												$cur_time = strtotime(date('H:i:s'));
												$set_date = strtotime($deadline_date );
												$set_time = strtotime($time);
												
												
												$fileName = $_FILES['userfile']['name'];
												$tmpName  = $_FILES['userfile']['tmp_name'];
												$fileSize = $_FILES['userfile']['size'];
												$fileType = $_FILES['userfile']['type'];
												
												if($fileName=='') {
															if($title=='' && $fileName=='' && $over=='' && $desc=='') {
																$msg = '<i><font color="red">No activity.</font></i>';
															}
															if($title=='')
															{
																$msg = '<i><font color="red">Title of this activity ahoud be given.</font></i>';
															}
															else if($desc=='')
															{
																$msg = '<i><font color="red">Give description to your file.</font></i>';
															}
															else if($category=='')
															{
																$msg = '<i><font color="red">Category</font></i>';
															}
															else if($size='') {
																$msg = '<i><font color="red">Set the maximum size of file to be uploaded.</font></i>';
															}
															else if($deadline_date=='')
															{
																$msg = '<i><font color="red">Date should be provided for deadline.</font></i>';
															}
															else if($mn==''||$hr=='')
															{
																$msg = '<i><font color="red">deadline time empty?.</font></i>';
															}
															else if($set_date<$term_start && $term_end>$set_date) {
																$msg = '<i><font color="red">Date?.</font></i>';
															}
															else if($set_date<$cur_date) {
																$msg = '<i><font color="red">Date2?.</font></i>';
															}
															else if($set_date==$cur_date && $set_time<=$cur_time) {
																$msg = '<i><font color="red">Time?.</font></i>';
															}
															else {
																mysql_query("UPDATE tbl_activity SET title='$title', over='$over', deadline_date='$deadline_date', deadline_time='$time', allow_size='$allow', description='$desc', category='$category', add_late='$late' WHERE activity_id='$activityID'")
																						or die (mysql_error());
															echo'<script> window.location="activity.php"; </script> ';
															}
												}
												else{
													if($fileType!='application/pdf') {
														$msg = '<i><font color="red">Invalid File.Only pdf file can be uploaded.</font></i>';
													}
													else {
														$fp      = fopen($tmpName, 'r');
														$content = fread($fp, filesize($tmpName));
														$content2 = addslashes($content);
														fclose($fp);

														if(!get_magic_quotes_gpc())
														{
															$fileName = addslashes($fileName);
														}
														mysql_query("UPDATE tbl_activity SET title='$title', over='$over', file='$content2', filename='$fileName', deadline_date='$deadline_date', deadline_time='$time', allow_size='$allow', description='$desc', category='$category', add_late='$late' WHERE activity_id='$activityID'")
																						or die (mysql_error());
															echo'<script> window.location="activity.php"; </script> ';
													}
												}
											}
										else {
											$sql = mysql_query("SELECT * FROM tbl_activity WHERE activity_id='$activityID'") or die(mysql_error()) ;
				
											while($row = mysql_fetch_array($sql))
											{ 
												$title = $row['title'];
												$over = $row['over'];
												$fileName = $row['filename'];
												$comp = $row['component'];
												$category  = $row['category'];
												$abc = $comp.'-'.$category;
												$status = $row['status'];
												$desc = $row['description'];
												$size = $row['allow_size'];
												$late = $row['add_late'];
												$deadline_date = $row['deadline_date'];
												$deadline_time = $row['deadline_time'];
												list($hr, $mn, $sec) = explode(':', $deadline_time);
											}
										}
											?>
										<div class="block">
											<div class="navbar navbar-inner block-header">
												<div class="muted pull-left">Edit Activity</div>
											</div>
											<div class="block-content collapse in">
												<div class="span12">
													  <fieldset>
														<legend>Activity Editor</legend>
														<div class="control-group">
														  <label class="control-label" for="typeahead">Title </label>
														  <div class="controls">
															<input type="text" class="span6" id="typeahead" name="title" value="<?php echo $title;?>" data-provide="typeahead" data-items="4" placeholder="Title">
														  </div>
														</div>
														<div class="control-group">
														<div class="control-group">
														<label class="control-label" for="fileInput">Upload File</label>
														  <div class="controls">
															<?php echo $fileName;?><input class="input-file uniform_on" name="userfile" type="file" id="userfile" value="">
														  </div>
														</div>
														<div class="control-group">
														<label class="control-label" for="fileInput">Component</label>
														 <div class="controls">
															<select name="category">
																<?php $sql = mysql_query("SELECT * FROM tbl_component WHERE class_id='$classID'");
																		while($row=mysql_fetch_array($sql)) {
																			$cat =$row['name'];
																			$number = $row['required_number'];
																			if($cat!='Attendance') {
																			for($i=1;$i<=$number;$i++) {
																			$we = $cat.'-'.$i;?>
																		<option value='<?php echo $row['name'].'-'.$i;?>'<?php if($abc =="$we"): ?> selected="selected"<?php endif; ?>><?php echo $row['name'].'-'.$i;?>
																<?php } 
																}
																}?>
															</select>
														  </div>
														</div>
														<div class="control-group">
														  <label class="control-label" for="typeahead">No. Of Items</label>
														  <div class="controls">
															<input type="text" class="span6" id="typeahead" name="over" value="<?php echo $over;?>" data-provide="typeahead" data-items="4" placeholder="Title">
														  </div>
														</div>
														<div class="control-group">
														  <label class="control-label" for="textarea2">Instruction:</label>
														  <div class="controls">
															<textarea class="input-xlarge textarea" placeholder="Enter text ..." style="width: 500px; height: 200px" name="desc"><?php  echo $desc; ?></textarea>
														  </div>
														</div>
														<div class="control-group">
														  <label class="control-label" for="textarea2">Allow Late Submission?</label>
														 <div class="controls">
															<input type="radio" name="late" value="1"  <?php  echo ($late == "1") ? 'checked="checked"' : '';?> />Yes</input>
															<input type="radio" name="late" value="0"  <?php  echo ($late == "0") ? 'checked="checked"' : ''; ?>/>No</input>
														  </div>
														</div>
														<div class="control-group">
														  <label class="control-label" for="textarea2">Allowable size (MB):</label>
														<div class="controls">
															<select name="size">
																<?php for($i=5;$i<=100;$i++) {
																	if(!($i%5)) {?>
																	<option value='<?php echo $i;?>'<?php if($size =="$i"): ?> selected="selected"<?php endif; ?>><?php echo $i;?>
																<?php } }?>
															</select>
														  </div>
														</div>
														<div class="control-group">
														  <label class="control-label" for="date01">Deadline </label>
														  <div class="controls">
															<input type="text" class="input-xlarge datepicker" id="date01" value="<?php  echo $deadline_date; ?>" name="date">
														  </div>
														  <div class="controls">
															<select name="hr">
																<?php for($i=1;$i<=24;$i++) {?>
																	<option value='<?php echo $i;?>'<?php if($hr =="$i"): ?> selected="selected"<?php endif; ?>><?php echo $i;?>
																<?php } ?>
															</select>
														  </div>
														  <div class="controls">
															<select name="mn">
																<?php for($i=0;$i<=60;$i++) {
																		$i = sprintf("%02s", $i);?>
																	<option value='<?php echo $i;?>'<?php if($mn =="$i"): ?> selected="selected"<?php endif; ?>><?php echo $i;?>
																<?php } ?>
															</select>
														  </div>
														</div>

														<div class="form-actions">
														  <button type="submit" class="btn btn-primary" name="btnSaveActivity">Save Changes</button>
														  <button type="reset" class="btn">Cancel</button>
														</div>
													  </fieldset>

												</div>
												<?php if(isset($_POST['btnSaveActivity'])) {
														echo $msg;
													}
												?>
											</div>
										</div>
									<?php }
								}
								else  {
							?>
							

				</form>
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Activity</div>
                                    <div class="pull-right">
									<a href="createActivity.php"><button class="btn" style="margin-bottom:5px;">Create Activity</button>
                                    </a>
                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                <?php
                                $sql = mysql_query("SELECT * FROM tbl_activity WHERE class_id='$classID'") or die(mysql_error());
									$count = mysql_num_rows($sql);
									if(!$count){
										echo '<div class="alert">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Warning!</strong> No activity.
									</div>'; 
									}
									else { ?>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Title</th>
                                                <th>Component</th>
                                                <th>Deadline</th>
                                                <th>Status</th>
                                                <th rowspan="2">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php $sql = mysql_query("SELECT * FROM tbl_activity where class_id='$classID'") or die(mysql_error()) ;
			
												while($row = mysql_fetch_array($sql))
												{ 
													$id = $row['activity_id'];
													echo "<tr>";
													echo "<td>".$row['dated']."</td>";
													echo "<td>".$row['title']."</td>";
													echo "<td>".$row['component'].''.$row['category'];"</td>";
													echo "<td>".$row['deadline_date']." / ".$row['deadline_time']."</td>";
													if($row['status']==1){
														echo "<td>Available</td>";
													}
													else {
														echo "<td>Expired</td>";
													}
													echo "<td><a href=\"activity.php?action=1&activity=$id\">View</a> | <a href=\"activity.php?action=2&activity=$id\">Edit</a></td>";
													echo "</tr>";
												}
											?>
                                        </tbody>
                                    </table>
                                    <?php } ?>
                                </div>
                            </div>
							<?php }
							?>
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