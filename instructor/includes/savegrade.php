<?php 
	$year = date("Y");
	$sql = mysql_query("SELECT month, day FROM tbl_calendar LIMIT 1") or die(mysql_error());
	while($row = mysql_fetch_array($sql))
	{ 
		$Smonth  = $row['month'];
		$Sday = $row['day'];
	}
	$start = $year.'-'.$Smonth.'-'.$Sday;
		
	$sql = mysql_query("SELECT month, day FROM tbl_calendar ORDER BY calendar_id DESC LIMIT 1") or die(mysql_error());
	while($row = mysql_fetch_array($sql))
	{ 
		$Smonth2  = $row['month'];
		$Sday2 = $row['day'];
	}
	$end = $year.'-'.$Smonth2.'-'.$Sday2;
	
	
	$Sstart = strtotime($start);
	$Send = strtotime($end);

	
									$componentName = $_REQUEST['component'];
									$y = $_SESSION['y'];
									$total = $_SESSION['total'];
									$a=1;
									
									$sql4 = mysql_query("SELECT * FROM tbl_class_class WHERE class_id='$classID'")
															   or die(mysql_error()) ;
															   
									while($row = mysql_fetch_array($sql4))
									{
										$DSscore=0;
										$DStotal =0;
										$Sscore = 0;
										$Stotal=0;
										$ave = 0;
										$percent = 0;
										$grade = 0;
										$final = 0;
										$totalpercent = 0;
										$enrollID = $row['class_class_id'];
													
											for($b=1;$b<$total;$b++) {
												$l=1;
												$fgh = mysql_query("SELECT * FROM tbl_grades WHERE component='$componentName' AND category='$b' AND class_class_id='$enrollID'")or die(mysql_error());
												$jkl = mysql_num_rows($fgh);
												while($row = mysql_fetch_array($fgh)) {
													$score = $_POST["score$a$b$l"];
													$date = date('Y-m-d', strtotime(str_replace('-', '/', $_POST["date$b$l"])));
													$month = date("n",strtotime($date));
													$day = date("d",strtotime($date));
														$current = strtotime($date);
													$noOfItems = $_POST["noOfItems$b$l"];
													
													if($score)  {
														if($date==''){
															//Error message
															echo '<div class="alert alert-error">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Date needed.
				</div>';
														}
														else if($noOfItems=='') {
															//Error message
															echo '<div class="alert alert-error">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong>Number of Items needed.
				</div>';
														}
														else if(($Sstart < $current) && ($Send < $current)) {
															echo '<div class="alert alert-error">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Invalid Date.
				</div>';
														}
														else if(($Sstart > $current) && ($Send > $current)) {
															echo '<div class="alert alert-error">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Invalid Date.
				</div>';
														}
														else if (!is_numeric($noOfItems)){
															//Error message
															echo '<div class="alert alert-error">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Number of item should be numbers only.
				</div>';
														}
														else if (!is_numeric($score)){
															//Error message
															echo '<div class="alert alert-error">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Score should be numbers only.
				</div>';
														}
														else if ($score<0){
															//Error message
															echo '<div class="alert alert-error">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Score can\'t be negative.
				</div>';
														}
														else if($score>$noOfItems){
															//Error message
															echo '<div class="alert alert-error">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Invalid score.
				</div>';
														}
														else {
															$gradeID = $row['grade_id'];
															$warning = ($score/$noOfItems)*100;
															
															if($jkl!=1) {
																	$DSscore += $score;
																	$DStotal += $noOfItems;
																	$Sscore = $DSscore/$l;
																	$Stotal = $DStotal/$l;
																		$k = $l+1;
																	if($jkl==$l) {
																		$query =mysql_result(mysql_query("SELECT score FROM tbl_grades WHERE grade_id='$gradeID'"),0);
																		
																		if($query=='') {
																			//notification
																			mysql_query("INSERT INTO tbl_notification(class_class_id, category, status) VALUES('$enrollID','sar','0')") or die(mysql_error());
																			mysql_query("INSERT INTO tbl_notification3(student_id, class_class_id, category, status) VALUES('$studID','$enrollID','sar','0')") or die(mysql_error());
																			if($warning<70) {
																	mysql_query("INSERT INTO tbl_notification(class_class_id, category, status) VALUES('$enrollID', 'warning', '$gradeID')");
																	mysql_query("INSERT INTO tbl_notification3(student_id,class_class_id, category, status) VALUES('$studID','$enrollID', 'warning', '$gradeID')");
																	}
																		}
																		//update score in tbl_grades
																		mysql_query("UPDATE tbl_grades SET dated='$date', noOfItems='$noOfItems', score='$score' WHERE grade_id='$gradeID'")
																		or die (mysql_error());
																	}
																	else if($_POST["score$a$b$k"]=='') {
																		$query =mysql_result(mysql_query("SELECT score FROM tbl_grades WHERE grade_id='$gradeID'"),0);
																		
																		if($query=='') {
																			//notification
																			mysql_query("INSERT INTO tbl_notification(class_class_id, category, status) VALUES('$enrollID','sar','0')") or die(mysql_error());
																			mysql_query("INSERT INTO tbl_notification3(student_id, class_class_id, category, status) VALUES('$studID','$enrollID','sar','0')") or die(mysql_error());
																	if($warning<70) {
																		mysql_query("INSERT INTO tbl_notification(class_class_id, category, status) VALUES('$enrollID', 'warning', '$gradeID')");
																		mysql_query("INSERT INTO tbl_notification3(student_id,class_class_id, category, status) VALUES('$studID','$enrollID', 'warning', '$gradeID')");
																	}
																		}
																		//update score in tbl_grades
																		mysql_query("UPDATE tbl_grades SET dated='$date', noOfItems='$noOfItems', score='$score' WHERE grade_id='$gradeID'")
																		or die (mysql_error());
																	}
															}
															else {
																$Sscore += $score;
																$Stotal += $noOfItems;
																
																$query =mysql_result(mysql_query("SELECT score FROM tbl_grades WHERE grade_id='$gradeID'"),0);
																	
																	if($query=='') {
																		//notification
																		mysql_query("INSERT INTO tbl_notification(class_class_id, category, status) VALUES('$enrollID','sar','0')") or die(mysql_error());
																		mysql_query("INSERT INTO tbl_notification3(student_id, class_class_id, category, status) VALUES('$studID','$enrollID','sar','0')") or die(mysql_error());
																		if($warning<70) {
																	mysql_query("INSERT INTO tbl_notification(class_class_id, category, status) VALUES('$enrollID', 'warning', '$gradeID')");
																	mysql_query("INSERT INTO tbl_notification3(student_id,class_class_id, category, status) VALUES('$studID','$enrollID', 'warning', '$gradeID')");
																	}
																	}
																	//update score in tbl_grades
																	
																	mysql_query("UPDATE tbl_grades SET dated='$date', noOfItems='$noOfItems', score='$score' WHERE grade_id='$gradeID'")
																	or die (mysql_error());
																	
																
															}
															
														//	echo'<script> window.location="records.php"; </script> ';
														}
													}
													$l++;
												}
												
											}
											if($Stotal==0) {
											}
											else {
												//update average in tbl_grades
												$Saverage = intval(($Sscore/$Stotal)*100);
												mysql_query("UPDATE tbl_grades SET score='$Saverage' WHERE component='$componentName' AND class_class_id='$enrollID' AND category='AVG'")
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
													$gpa = "4.00";
													break;
												case ($finalgrade>=97.50 && $finalgrade<100):
													$gpa = "3.75";
													break;
												case ($finalgrade>=95 && $finalgrade<97.50):
													$gpa = "3.50";
													break;
												case ($finalgrade>=92.50 && $finalgrade<95):
													$gpa = "3.25";
													break;
												case ($finalgrade>=90 && $finalgrade<92.50):
													$gpa = "3.00";
													break;
												case ($finalgrade>=87.50 && $finalgrade<90):
													$gpa = "2.75";
													break;
												case ($finalgrade>=85 && $finalgrade<87.50):
													$gpa = "2.50";
													break;
												case ($finalgrade>=82.5 && $finalgrade<85):
													$gpa = "2.25";
													break;
												case ($finalgrade>=80 && $finalgrade<82.50):
													$gpa = "2.00";
													break;
												case ($finalgrade>=75 && $finalgrade<80):
													$gpa = "1.50";
													break;
												case ($finalgrade>=72.50 && $finalgrade<75):
													$gpa = "1.25";
													break;
												case ($finalgrade>=70 && $finalgrade<72.50):
													$gpa = "1.00";
													break;
												default: $gpa = "0.00";
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
										$a++;
									}
										if($gpa) {
											//update gpa
											$query5 = mysql_query("SELECT student_id FROM tbl_student") or die(mysql_error());
											while($row5 = mysql_fetch_array($query5))
											{
												$totalUnit =0;
												$totalAve = 0;
												
												$studID2 = $row5['student_id'];
												$query6 = mysql_query("SELECT f.grade, f.gpa, s.unit, s.course_code FROM tbl_finalgrade f, tbl_course s, tbl_class_class cc, tbl_class c, tbl_student ss WHERE cc.class_id=c.class_id AND f.class_class_id=cc.class_class_id AND s.course_code=c.course_code AND ss.student_id='$studID2' and ss.student_id=cc.student_id") or die(mysql_error());
												while($row6 = mysql_fetch_array($query6))
												{
													$gpa = $row6['gpa'];
													$unit = $row6['unit'];
													$ave = ($gpa * $unit);
													$totalAve += $ave;
													$totalUnit += $unit;
													$cgpa = ($totalAve/$totalUnit);
													
													$count2 = mysql_result(mysql_query("SELECT count(*) FROM tbl_cgpa WHERE student_id='$studID2'"),0);
													if($count2) {
														mysql_query("UPDATE tbl_cgpa SET cgpa='$cgpa' WHERE student_id='$studID2'") or die(mysql_error());
													}
													else {
														mysql_query("INSERT INTO tbl_cgpa(student_id, cgpa) VALUES ('$studID2','$cgpa')") or die(mysql_error());
													}
												}
											}
										}
?>