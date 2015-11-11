<?php
	session_start();
	//error_reporting(0);
	include("../include/dbcon.php");
	
	if(!($_SESSION['login'])) {
		header("Location: ../instructor.php");
	}
	else {
		$insID  = $_SESSION['username'];
		include("includes/classMenu.php");
		
		
		$year = date('Y');
		$i=1;
		
		$sql = mysql_query("SELECT * FROM tbl_class WHERE class_id='$classID'") or die(mysql_error());
		while($row = mysql_fetch_array($sql))
		{
			$sked_day = strtoupper($row['schedule_day']);
			$sked_time = strtoupper($row['schedule_time']);
		}
		
		$traits = explode( '/' , $sked_day );
		$d=1;
		$r=0;
		$s=0;
		$t=0;
		$u=0;
		$v=0;
		$w=0;
		foreach ($traits as $trait){
			switch($trait) {
				case 'M': $day2[$d]='Monday';  $r++; break;
				case 'T': $day2[$d]='Tuesday'; $s++; break;
				case 'W': $day2[$d]='Wednesday'; $t++; break;
				case 'TH': $day2[$d]='Thursday'; $u++; break;
				case 'F': $day2[$d]='Friday'; $v++; break;
				case 'S': $day2[$d]='Saturday'; $w++; break;
			}
			$d++;
		}
		
		$sql2 = mysql_query("SELECT distinct(attendance_id) FROM tbl_attendance a, tbl_class_class c WHERE  c.class_id='$classID' AND a.class_class_id=c.class_class_id") or die(mysql_error());
		$num_rows = mysql_num_rows($sql2);
		if(!$num_rows) {
			$sql = mysql_query("SELECT * FROM tbl_class_class WHERE class_id='$classID'") or die(mysql_error());
			while($row = mysql_fetch_array($sql))
			{ 
				$enrollID = $row['class_class_id'];
				$sql2 = mysql_query("SELECT * FROM tbl_calendar") or die(mysql_error()) ;
				while($row2 = mysql_fetch_array($sql2))
				{ 
					$month=$row2['month'];
					$day=$row2['day'];
					$sql4 = mysql_query("SELECT day, DAYNAME('$year-$month-$day') as dayName, calendar_id FROM tbl_calendar WHERE calendar_id='".$row2['calendar_id']."'") or die(mysql_error());
					while($row4 = mysql_fetch_array($sql4))
					{ 
						if (in_array($row4['dayName'], $day2)) {
							$calendarID = $row4['calendar_id'];
							if($row4['dayName']=='Monday') {
								for($i=1;$i<=$r;$i++){
									mysql_query("INSERT INTO tbl_attendance(calendar_id, number, class_class_id) VALUES('$calendarID','$i','$enrollID')");
								}
							}
							else if($row4['dayName']=='Tuesday') {
								for($i=1;$i<=$s;$i++){
									mysql_query("INSERT INTO tbl_attendance(calendar_id, number, class_class_id) VALUES('$calendarID','$i','$enrollID')");
								}
							}
							else if($row4['dayName']=='Wednesday') {
								for($i=1;$i<=$t;$i++){
									mysql_query("INSERT INTO tbl_attendance(calendar_id, number, class_class_id) VALUES('$calendarID','$i','$enrollID')");
								}
							}
							else if($row4['dayName']=='Thursday') {
								for($i=1;$i<=$u;$i++){
									mysql_query("INSERT INTO tbl_attendance(calendar_id, number, class_class_id) VALUES('$calendarID','$i','$enrollID')");
								}
							}
							else if($row4['dayName']=='Friday') {
								for($i=1;$i<=$v;$i++){
									mysql_query("INSERT INTO tbl_attendance(calendar_id, number, class_class_id) VALUES('$calendarID','$i','$enrollID')");
								}
							}
							else if($row4['dayName']=='Saturday') {
								for($i=1;$i<=$w;$i++){
									mysql_query("INSERT INTO tbl_attendance(calendar_id, number, class_class_id) VALUES('$calendarID','$i','$enrollID')");
								}
							}
						}
					}
				}
			}
		}
		
		$sql = mysql_query("SELECT * FROM tbl_legend");
		while($row = mysql_fetch_array($sql))
		{
			$ad_legend[$i] = $row['legend'];
			$i++;
		}
		
		
		
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title><?php echo $section . "-" . $course; ?> | Attendance</title>
        <!-- Bootstrap --> 
                            <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
         <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen"> 
         <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="vendors/flot/excanvas.min.js"></script><![endif]-->
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="../_public/http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="../_public/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    
    <body>
<?php include 'includes/navbar.php'; ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <!--/span-->
                <div class="span12" id="content">
                    <div class="row-fluid">
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href="classList.php">Class List</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li><a href="records.php">Student Academic Records</a></li> <span class="divider">/</span>
										<li>Attendance</a></li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
            <ul class="nav nav-tabs" style="margin-bottom: 15px; margin-top:50px;">
                <li class="active"><a href="#attendance" data-toggle="tab">Attendance</a></li>
               <!-- <li><a href="#settings" data-toggle="tab">Settings</a></li>-->
			</ul>
              <div id="myTabContent" class="tab-content">
               <div class="tab-pane fade active in" id="attendance">

                  <p><?php 
						if(isset($_POST['btnSaveAtt'])) {
							$x=1;
							$y=1;
							$sql = mysql_query("SELECT * FROM tbl_class_class WHERE class_id='$classID'") or die(mysql_error());
							
							while($row = mysql_fetch_array($sql))
							{
								$x=1;
								$totalpercent=0;
								$final=0;
								$enrollID = $row['class_class_id'];
								$sql2 = mysql_query("SELECT * FROM tbl_attendance WHERE class_class_id='$enrollID'") or die(mysql_error());
								while($row2 = mysql_fetch_array($sql2))
								{
									$attID = $row2['attendance_id'];
									$att = $_POST["attendance$y$x"];
										if (in_array($att, $ad_legend)) {
												$query =mysql_result(mysql_query("SELECT legend FROM tbl_attendance WHERE attendance_id='$attID'"),0);
												mysql_query("UPDATE tbl_attendance SET legend='$att' WHERE attendance_id='$attID'")
												or die (mysql_error());
											}
									
									$x++;
								}
								
								$y++;
														$sql9 = mysql_result(mysql_query("SELECT COUNT(*) FROM tbl_attendance WHERE class_class_id='$enrollID' AND legend='a'"),0);
																		$ers = mysql_result(mysql_query("SELECT allow from tbl_absences WHERE class_id='$classID'"),0);
																		$sql8 = mysql_result(mysql_query("SELECT COUNT(*) FROM tbl_attendance WHERE class_class_id='$enrollID' AND legend='l'"),0);
																		
																		$ret = floor($sql8/3);
																		$das = $ret + $sql9;
															$perc =  mysql_result(mysql_query("SELECT percentage FROM tbl_component WHERE name='Attendance' AND class_id='$classID'"),0);
														$ddd = 100-$das;
															mysql_query("UPDATE tbl_grades SET score='$ddd' WHERE component='Attendance' AND class_class_id='$enrollID' AND category='AVG'");
																			
															if($das>=$ers) {
																			mysql_query("UPDATE tbl_grades SET score='UD' WHERE component='Attendance' AND class_class_id='$enrollID' AND category='AVG'");
																		}
																		else if($das==($ers-1)){
																			mysql_query("UPDATE tbl_grades SET score='WARNING' WHERE component='Attendance' AND class_class_id='$enrollID' AND category='AVG'");
																		}
																		else {
																			mysql_query("UPDATE tbl_grades SET score='$ddd' WHERE component='Attendance' AND class_class_id='$enrollID' AND category='AVG'");
																		}
											/*$sql7 = mysql_query("SELECT * FROM tbl_grades WHERE class_class_id='$enrollID' AND category='AVG'")
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
												}*/
							}
							
						}
				  ?>
								<form action="" method="post" style="overflow:auto;">
                                    <table class="table table-striped" cellspacing="0" cellpadding="0">
                                        <thead>
                                            <tr>
                                                <th rowspan="2" align="center">STUDENTS</th>
											<tr>
													<th></th>
											<?php
											$enrollID = mysql_result(mysql_query("SELECT distinct(class_class_id) FROM tbl_class_class WHERE class_id='$classID' ORDER by class_class_id ASC LIMIT 1"),0);
											$sql =  mysql_query("SELECT * FROM tbl_attendance WHERE class_class_id='$enrollID'") or die(mysql_error()) ;
											while($row = mysql_fetch_array($sql))
											{
												$calendarID = $row['calendar_id'];
												$sql2 =  mysql_query("SELECT * FROM tbl_calendar WHERE calendar_id='$calendarID'") or die(mysql_error()) ;
												while($row2 = mysql_fetch_array($sql2))
												{
													echo "<th>".$row2['month'].'/'.$row2['day']."</th>";
												}
											}
											
											?>
											
											</tr>
                                        </thead>
                                        <tbody>
                                            <tr>
												<?php
													$y=1;
													$sql3 = mysql_query("SELECT * FROM tbl_class_class WHERE class_id='$classID'")
																   or die(mysql_error()) ;
																   
													while($row = mysql_fetch_array($sql3))
													{
															$studID[$y] = $row['student_id'];
															$enrollID = $row['class_class_id'];
																								
																		$sql9 = mysql_result(mysql_query("SELECT COUNT(*) FROM tbl_attendance WHERE class_class_id='$enrollID' AND legend='a'"),0);
																		$ers = mysql_query("SELECT allow from tbl_absences WHERE class_id='$classID'");
																		$wer = mysql_num_rows($ers);
																		if($wer) {
																			$asd = mysql_result(mysql_query("SELECT allow from tbl_absences WHERE class_id='$classID'"),0);
																		}
																		else {
																			$asd=0;
																		}
																		$sql8 = mysql_result(mysql_query("SELECT COUNT(*) FROM tbl_attendance WHERE class_class_id='$enrollID' AND legend='l'"),0);
																		
																		$ret = floor($sql8/3);
																		$das = $ret + $sql9;
																		
																		if($asd){
																		if($das>$asd) {
																			$status[$y] = 'UD';
																		}
																		else if($das==($asd)){
																			$status[$y] = 'WARNING';
																		}
																		else {
																			$status[$y] ='';
																		}
																		}
																		else {
																			$status[$y] ='';
																		}
															
																$sql2 = mysql_query("SELECT first_name, last_name, middle_name FROM tbl_student WHERE student_id=$studID[$y]")
																			   or die(mysql_error()) ;
																			   
																while($row = mysql_fetch_array($sql2))
																{	
																		
																?> <tr>
																	<?php 
																$x=1;
																			echo "<td bgcolor=\"\" width=\"150px\" align=\"center\">".$row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name']."</td>";

																			echo "<td bgcolor=\"\" width=\"150px\" align=\"center\">".$status[$y]."</td>";
																			
																	$sql = mysql_query("SELECT * FROM tbl_attendance WHERE class_class_id='$enrollID'")
																	   or die(mysql_error()) ;
																	$num_rows = mysql_num_rows($sql);
																	
																	if($num_rows > 0){
																		while($row2 = mysql_fetch_array($sql))
																		{
																			$legend = $row2['legend'];
																				echo "<td><input name=\"attendance$y$x\" class=\"input-mini focused\" id=\"focusedInput\" type=\"text\" value=\"$legend\"></td>";
																			
																		$x++;
																		}
																	}
															}
															$y++;
													}
												?>									
                                            </tr>
											<tr>
													<td></td>
													<td colspan="18"><p align="right"><input type="submit" value="Save" name="btnSaveAtt" style="width:150px"></input></p></td>
											   </tr>
											   <tr>
													<td  colspan="18" align="center"><br><?php if(isset($_POST['btnSave'])) { echo $msg;}?></td>
											   </tr>
                                        </tbody>
                                    </table>
								</form>
				  </p>
				   <p>
										<form action="" method="post">
											<table border="0" width="500px"height="200px" >
											   <tr>
													<td align="center" width="200px">
														<table border="0" cellspacing="0" cellpadding="10">
															<tr>
																<th colspan="2">ATTENDANCE LEGEND:</th>
															</tr>
															<?php $sql = mysql_query("SELECT * FROM tbl_legend"); 
																while($row = mysql_fetch_array($sql)) {
																	echo "<tr>";
																		echo "<td>".$row['description']."</td>";
																		echo "<td>".$row['legend']."</td>";
																	echo "</tr>";
																 }
															?>
														</table>
													</td>
													<td align="center"><div class="control-group">
														<label class="control-label" for="textarea2">Allowable Absences:</label>
														<?php 
															$sa =mysql_query("SELECT allow From tbl_absences WHERE class_id='$classID'");
															$sa = mysql_num_rows($sa);
															if($sa) {
																$perc =mysql_result(mysql_query("SELECT percent From tbl_absences WHERE class_id='$classID'"),0);
																$la =mysql_result(mysql_query("SELECT hours From tbl_absences WHERE class_id='$classID'"),0);
																echo $la.'hours';
															}
														?>
														<div class="controls">
															<select name="number">
																<?php for($i=1;$i<=100;$i++) {
																		$i = sprintf("%02s", $i)?>
																		<option value='<?php echo $i;?>'<?php if(isset($perc)) { if($perc =="$i"): ?> selected="selected"<?php endif; }?>><?php echo $i.'%';?>
																<?php  }?>
															</select>
														 </div>
														</div>
														<?php
															
															echo "<input type=\"submit\" value=\"Save\" name=\"btnSaveAbs\" style=\"width:150px\"></input>";
																
														?>
													</td>
											   </tr> 
										</table>
									</form>
				  </p>
                </div>
				
				<?php
					if(isset($_POST['btnSaveAbs'])) {
						
						$no = $_POST['number'];
						$totalhr =  mysql_result(mysql_query("SELECT total_hours From tbl_class WHERE class_id='$classID'"),0);
						$hours = $totalhr*($no/100);
						$hr_day = mysql_result(mysql_query("SELECT day_hours FROM tbl_class WHERE class_id='$classID'"),0);

						$allow = $hours / $hr_day;
						$lo = mysql_result(mysql_query("SELECT count(*) From tbl_absences WHERE class_id='$classID'"),0);
						if($lo) {
							mysql_query("UPDATE tbl_absences SET percent='$no', hours='$hours', allow='$allow' WHERE class_id='$classID'");
						}
						else {
							mysql_query("INSERT INTO tbl_absences(class_id, percent, hours, allow) VALUES('$classID', '$no','$hours','$allow')");
							}
						header("Location: attendance.php");
					}
				?>
				
		</div>


            </div>
                    </div>
</div>
</div>
  				        <hr class="footer-divider">
			<p>&copy; 2013 FEU-FERN COLLEGE</p>           

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