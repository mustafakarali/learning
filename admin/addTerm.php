<?php
	session_start();
	include("includes/dbcon.php");
	ini_set('max_execution_time', 0);												

if(!($_SESSION['login'])) {
		header("Location: index.php");
	}
else {
	if(isset($_POST['add']))
	{
	$rows1 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_absences'), 0);
	$rows2 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_activity'), 0);
	$rows3 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_activity_grade'), 0);
	$rows4 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_attendance'), 0);
	$rows5 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_calendar'), 0);
	$rows6 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_cgpa'), 0);
	$rows7 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_class'), 0);
	$rows8 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_class_class'), 0);
	$rows9 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_component'), 0);
	$rows10 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_course'), 0);
	$rows11 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_defaultcomponent'), 0);
	$rows12 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_files'), 0);
	$rows13 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_finalgrade'), 0);
	$rows14 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_grades'), 0);
	$rows15 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_request'), 0);
	$rows16 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_viewing'), 0);
	$rows17 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_achievetop'), 0);
	$rows18 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_achievefirst'), 0);
	$rows19 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_achievesecond'), 0);
	$rows20 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_achievethird'), 0);
	$rows21 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_achievefourth'), 0);
	
	if($rows1||$rows2||$rows3||$rows4||$rows5||$rows6||$rows7||$rows8||$rows9||$rows10||$rows11||$rows12||$rows13||$rows14||$rows15||$rows16||$rows17||$rows18||$rows19||$rows20||$rows21)
	{
		$sql1 = mysql_query("Select sy FROM tbl_batch ORDER BY sy DESC LIMIT 1")
						or die(mysql_error());
					while($row = mysql_fetch_array($sql1)){
						$sy1 = $row['sy'];
					}
				
				$update = mysql_query("UPDATE tbl_batch SET status='0' WHERE sy='$sy1'") or die(mysql_error());
				
				$new_sy = $sy1+1;
				
		//---absences
		$query1 = mysql_query("Select * FROM tbl_absences")
					or die(mysql_error());
				while($row = mysql_fetch_array($query1))
				{
					$a = $row['class_id'];
					$b = $row['percent'];
					$c = $row['allow'];
					
					$query2 = mysql_query("INSERT INTO tbl_archive_absences(class_id,percent,allow,sy) 
					VALUES('$a','$b','$c','$sy1')")
					or die(mysql_error());
				}
				$query3 = mysql_query("TRUNCATE TABLE tbl_absences") or die(mysql_error());
		//---end of absences
		
		//---activity
		$query4 = mysql_query("Select * FROM tbl_activity")
					or die(mysql_error());
				while($row = mysql_fetch_array($query4))
				{
					$b = $row['class_id'];
					$c = $row['title'];
					$d = $row['dated'];
					$o = $row['over'];
					$e = $row['file'];
					$f = $row['filename'];
					$g = $row['allow_size'];
					$h = $row['deadline_date'];
					$i = $row['deadline_time'];
					$j = $row['description'];
					$p = $row['component'];
					$k = $row['category'];
					$l = $row['add_late'];
					$m = $row['status'];
					
					$query5 = mysql_query("INSERT INTO tbl_archive_activity(class_id,title,
					dated,over, file,filename,allow_size,deadline_date,deadline_time,description,component,category,
					add_late,status,sy) VALUES('$b','$c','$d','$o','$e','$f','$g','$h','$i','$j','$p','$k','$l','$m','$sy1')")
					or die(mysql_error());
				}
				$query6 = mysql_query("TRUNCATE TABLE tbl_activity") or die(mysql_error());
		//---end of activity
		
		//---activity grade
				$query7 = mysql_query("Select * FROM tbl_activity_grade")
					or die(mysql_error());
				while($row = mysql_fetch_array($query7))
				{
					$a = $row['class_class_id'];
					$b = $row['activity_id'];
					$c = $row['file'];
					$d = $row['filename'];
					$e = $row['date_submit'];
					$f = $row['time_submit'];
					$h = $row['status'];
					$g = $row['grade_id'];
					
					$query8 = mysql_query("INSERT INTO tbl_archive_activity_grade(class_class_id,activity_id,file,filename,date_submit,time_submit,status,grade_id,sy) 
					VALUES('$a','$b','$c','$d','$e','$f','$h','$g','$sy1')")
					or die(mysql_error());
				}
				$query9 = mysql_query("TRUNCATE TABLE tbl_activity_grade") or die(mysql_error());
				//---activity grade
				
				//---attendance
				$query10 = mysql_query("Select * FROM tbl_attendance")
					or die(mysql_error());
				while($row = mysql_fetch_array($query10))
				{
					$b = $row['calendar_id'];
					$c = $row['class_class_id'];
					$e = $row['number'];
					$d = $row['legend'];
					
					$query11 = mysql_query("INSERT INTO tbl_archive_attendance(calendar_id,class_class_id,number,legend,sy) 
					VALUES('$b','$c','$e','$d','$sy1')")
					or die(mysql_error());
				}
				$query12 = mysql_query("TRUNCATE TABLE tbl_attendance") or die(mysql_error());
				//---end of attendance
				
				$query13 = mysql_query("Select * FROM tbl_calendar")
					or die(mysql_error());
				while($row = mysql_fetch_array($query13))
				{
					$b = $row['month'];
					$c = $row['day'];
					$d = $row['status'];
					
					$query14 = mysql_query("INSERT INTO tbl_archive_calendar(month,day,status,sy) 
					VALUES('$b','$c','$d','$sy1')")
					or die(mysql_error());
				}
				$query15 = mysql_query("TRUNCATE TABLE tbl_calendar") or die(mysql_error());
				//---end of calendar
				
				//---cgpa
				$query16 = mysql_query("Select * FROM tbl_cgpa")
					or die(mysql_error());
				while($row = mysql_fetch_array($query16))
				{
					$a = $row['student_id'];
					$b = $row['cgpa'];
					
					$query17 = mysql_query("INSERT INTO tbl_archive_cgpa(student_id,cgpa,sy) 
					VALUES('$a','$b','$sy1')")
					or die(mysql_error());
				}
				$query18 = mysql_query("TRUNCATE TABLE tbl_cgpa") or die(mysql_error());
				//---end of cgpa
				
				//---class
				$query19 = mysql_query("Select * FROM tbl_class")
					or die(mysql_error());
				while($row = mysql_fetch_array($query19))
				{
					$a = $row['class_id'];
					$b = $row['section'];
					$c = $row['course_code'];
					$d = $row['instructor_id'];
					$e = $row['room'];
					$f = $row['schedule_day'];
					$g = $row['schedule_time'];
					$h = $row['total_hours'];
					$i = $row['day_hours'];
					
					$query20 = mysql_query("INSERT INTO tbl_archive_class(class_id,section,course_code,
					instructor_id,room,schedule_day,schedule_time,total_hours,day_hours,sy) VALUES('$a','$b','$c','$d','$e','$f','$g','$h','$i','$sy1')")
					or die(mysql_error());
				}
				$query21 = mysql_query("TRUNCATE TABLE tbl_class") or die(mysql_error());
				//---end of class
				
				//---class_class
				$query22 = mysql_query("Select * FROM tbl_class_class")
					or die(mysql_error());
				while($row = mysql_fetch_array($query22))
				{
					$b = $row['class_id'];
					$c = $row['student_id'];
					$d = $row['late_status'];
					
					$query23 = mysql_query("INSERT INTO tbl_archive_class_class(class_id,student_id,
					late_status,sy) VALUES('$b','$c','$d','$sy1')")
					or die(mysql_error());
				}
				$query24 = mysql_query("TRUNCATE TABLE tbl_class_class") or die(mysql_error());
				//---end of class_class
				
				//---component
				$query25 = mysql_query("Select * FROM tbl_component")
					or die(mysql_error());
				while($row = mysql_fetch_array($query25))
				{
					$b = $row['name'];
					$c = $row['required_number'];
					$d = $row['percentage'];
					$e = $row['class_id'];
					$f = $row['status'];
					
					$query26 = mysql_query("INSERT INTO tbl_archive_component(name,required_number,
					percentage,class_id,status,sy) VALUES('$b','$c','$d','$e','$f','$sy1')")
					or die(mysql_error());
				}
				$query27 = mysql_query("TRUNCATE TABLE tbl_component") or die(mysql_error());
				//---end of component
				
				//---course
				$query28 = mysql_query("Select * FROM tbl_course")
					or die(mysql_error());
				while($row = mysql_fetch_array($query28))
				{
					$a = $row['course_code'];
					$b = $row['description'];
					$c = $row['unit'];
					
					$query29 = mysql_query("INSERT INTO tbl_archive_course(course_code,description,unit,sy) 
					VALUES('$a','$b','$c','$sy1')")
					or die(mysql_error());
				}
				$query30 = mysql_query("TRUNCATE TABLE tbl_course") or die(mysql_error());
				//---end of course
				
				//---default component
				$query31 = mysql_query("Select * FROM tbl_defaultcomponent")
					or die(mysql_error());
				while($row = mysql_fetch_array($query31))
				{
					$a = $row['name'];
					$b = $row['required_number'];
					$c = $row['percentage'];
					
					$query32 = mysql_query("INSERT INTO tbl_archive_defaultcomponent(name,required_number,percentage,sy) 
					VALUES('$a','$b','$c','$sy1')")
					or die(mysql_error());
				}
				$query33 = mysql_query("TRUNCATE TABLE tbl_defaultcomponent") or die(mysql_error());
				//---end of default component
				
				//---files
				$query34 = mysql_query("Select * FROM tbl_files")
					or die(mysql_error());
				while($row = mysql_fetch_array($query34))
				{
					$a = $row['name'];
					$b = $row['size'];
					$c = $row['type'];
					$d = $row['content'];
					$e = $row['dated'];
					$f = $row['description'];
					$g = $row['status'];
					$h = $row['class_id'];
					
					$query35 = mysql_query("INSERT INTO tbl_archive_files(name,size,type,content,dated,description,status,class_id,sy) 
					VALUES('$a','$b','$c','$d','$e','$f','$g','$h','$sy1')")
					or die(mysql_error());
				}
				$query36 = mysql_query("TRUNCATE TABLE tbl_files") or die(mysql_error());
				//---end of files
				
				//---final grade
				$query37 = mysql_query("Select * FROM tbl_finalgrade")
					or die(mysql_error());
				while($row = mysql_fetch_array($query37))
				{
					$a = $row['class_class_id'];
					$b = $row['grade'];
					$c = $row['gpa'];
					
					$query38 = mysql_query("INSERT INTO tbl_archive_finalgrade(class_class_id,grade,gpa,sy) 
					VALUES('$a','$b','$c','$sy1')")
					or die(mysql_error());
				}
				$query39 = mysql_query("TRUNCATE TABLE tbl_finalgrade") or die(mysql_error());
				//---end of final grade
				
				//---grades
				$query40 = mysql_query("Select * FROM tbl_grades")
					or die(mysql_error());
				while($row = mysql_fetch_array($query40))
				{
					$a = $row['dated'];
					$b = $row['noOfItems'];
					$c = $row['score'];
					$d = $row['component'];
					$e = $row['category'];
					$f = $row['class_class_id'];
					
					$query41 = mysql_query("INSERT INTO tbl_archive_grades(dated,noOfItems,score,component,category,class_class_id,sy) 
					VALUES('$a','$b','$c','$d','$e','$f','$sy1')")
					or die(mysql_error());
				}
				$query42 = mysql_query("TRUNCATE TABLE tbl_grades") or die(mysql_error());
				//---end of grades
				
				//---request
				$query43 = mysql_query("Select * FROM tbl_request")
					or die(mysql_error());
				while($row = mysql_fetch_array($query43))
				{
					$a = $row['class_class_id'];
					$b = $row['request_date'];
					$c = $row['request_time'];
					$d = $row['status'];
					
					$query44 = mysql_query("INSERT INTO tbl_archive_request(class_class_id,request_date,request_time,status,sy) 
					VALUES('$a','$b','$c','$d','$sy1')")
					or die(mysql_error());
				}
				$query45 = mysql_query("TRUNCATE TABLE tbl_request") or die(mysql_error());
				//---end of request
				
				//---viewing
				$query46 = mysql_query("Select * FROM tbl_viewing")
					or die(mysql_error());
				while($row = mysql_fetch_array($query46))
				{
					$a = $row['class_id'];
					$b = $row['start_day'];
					$c = $row['start_time'];
					$d = $row['end_day'];
					$e = $row['end_time'];
					$f = $row['status'];
					
					$query47 = mysql_query("INSERT INTO tbl_archive_viewing(class_id,start_day,start_time,end_day,end_time,status,sy) 
					VALUES('$a','$b','$c','$d','$e','$f','$sy1')")
					or die(mysql_error());
				}
				$query48 = mysql_query("TRUNCATE TABLE tbl_viewing") or die(mysql_error());
				//---end of viewing
				
				//---achieve top
				$query49 = mysql_query("Select * FROM tbl_achievetop")
					or die(mysql_error());
				while($row = mysql_fetch_array($query49))
				{
					$a = $row['gpa'];
					$b = $row['student_id'];
					$c = $row['first_name'];
					$d = $row['middle_name'];
					$e = $row['last_name'];
					$f = $row['program'];
					$g = $row['status'];
					
					$query50 = mysql_query("INSERT INTO tbl_archive_achievetop(gpa,student_id,first_name,middle_name,last_name,program,status,sy) 
					VALUES('$a','$b','$c','$d','$e','$f','$g','$sy1')")
					or die(mysql_error());
				}
				$query51 = mysql_query("TRUNCATE TABLE tbl_achievetop") or die(mysql_error());
				//---end of achieve top
				
				//---achieve first
				$query52 = mysql_query("Select * FROM tbl_achievefirst")
					or die(mysql_error());
				while($row = mysql_fetch_array($query52))
				{
					$a = $row['cgpa'];
					$b = $row['student_id'];
					$c = $row['first_name'];
					$d = $row['middle_name'];
					$e = $row['last_name'];
					$f = $row['program'];
					$g = $row['status'];
					
					$query53 = mysql_query("INSERT INTO tbl_archive_achievefirst(cgpa,student_id,first_name,middle_name,last_name,program,status,sy) 
					VALUES('$a','$b','$c','$d','$e','$f','$g','$sy1')")
					or die(mysql_error());
				}
				$query54 = mysql_query("TRUNCATE TABLE tbl_achievefirst") or die(mysql_error());
				//---end of achieve first
				
				//---achieve second
				$query55 = mysql_query("Select * FROM tbl_achievesecond")
					or die(mysql_error());
				while($row = mysql_fetch_array($query55))
				{
					$a = $row['cgpa'];
					$b = $row['student_id'];
					$c = $row['first_name'];
					$d = $row['middle_name'];
					$e = $row['last_name'];
					$f = $row['program'];
					$g = $row['status'];
					
					$query56 = mysql_query("INSERT INTO tbl_archive_achievesecond(cgpa,student_id,first_name,middle_name,last_name,program,status,sy) 
					VALUES('$a','$b','$c','$d','$e','$f','$g','$sy1')")
					or die(mysql_error());
				}
				$query57 = mysql_query("TRUNCATE TABLE tbl_achievesecond") or die(mysql_error());
				//---end of achieve second
				
				//---achieve third
				$query58 = mysql_query("Select * FROM tbl_achievethird")
					or die(mysql_error());
				while($row = mysql_fetch_array($query58))
				{
					$a = $row['cgpa'];
					$b = $row['student_id'];
					$c = $row['first_name'];
					$d = $row['middle_name'];
					$e = $row['last_name'];
					$f = $row['program'];
					$g = $row['status'];
					
					$query59 = mysql_query("INSERT INTO tbl_archive_achievethird(cgpa,student_id,first_name,middle_name,last_name,program,status,sy) 
					VALUES('$a','$b','$c','$d','$e','$f','$g','$sy1')")
					or die(mysql_error());
				}
				$query60 = mysql_query("TRUNCATE TABLE tbl_achievethird") or die(mysql_error());
				//---end of achieve third
				
				//---achieve fourth
				$query61 = mysql_query("Select * FROM tbl_achievefourth")
					or die(mysql_error());
				while($row = mysql_fetch_array($query61))
				{
					$a = $row['cgpa'];
					$b = $row['student_id'];
					$c = $row['first_name'];
					$d = $row['middle_name'];
					$e = $row['last_name'];
					$f = $row['program'];
					$g = $row['status'];
					
					$query62 = mysql_query("INSERT INTO tbl_archive_achievefourth(cgpa,student_id,first_name,middle_name,last_name,program,status,sy) 
					VALUES('$a','$b','$c','$d','$e','$f','$g','$sy1')")
					or die(mysql_error());
				}
				$query63 = mysql_query("TRUNCATE TABLE tbl_achievefourth") or die(mysql_error());
				//---end of achieve fourth
		
		
				$insert = mysql_query("INSERT INTO tbl_batch(sy,status) VALUES('$new_sy','1')")
					or die(mysql_error());
					
				$msg = "<script>alert (\"Action successful! You are now ready for a whole new term!\")</script>";
	}
	else{
		$msg = "<script>alert (\"Tables are already truncated!\")</script>";
	}
	
	}
	else{
	date_default_timezone_set('Etc/GMT+8');
	$cur_date = date('Y-m-d');
	list($year, $month, $day) = explode('-',$cur_date);
	$auto = mysql_query("Select month, day FROM tbl_calendar") or die(mysql_error());
	while($row = mysql_fetch_array($auto))
	{
		$m = $row['month'];
		$d = $row['day'];
	}

	if($month == $m && $day == $d)
	{
	$rows1 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_absences'), 0);
	$rows2 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_activity'), 0);
	$rows3 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_activity_grade'), 0);
	$rows4 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_attendance'), 0);
	$rows5 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_calendar'), 0);
	$rows6 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_cgpa'), 0);
	$rows7 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_class'), 0);
	$rows8 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_class_class'), 0);
	$rows9 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_component'), 0);
	$rows10 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_course'), 0);
	$rows11 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_defaultcomponent'), 0);
	$rows12 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_files'), 0);
	$rows13 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_finalgrade'), 0);
	$rows14 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_grades'), 0);
	$rows15 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_request'), 0);
	$rows16 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_viewing'), 0);
	$rows17 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_achievetop'), 0);
	$rows18 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_achievefirst'), 0);
	$rows19 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_achievesecond'), 0);
	$rows20 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_achievethird'), 0);
	$rows21 = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_achievefourth'), 0);
	
	if($rows1||$rows2||$rows3||$rows4||$rows5||$rows6||$rows7||$rows8||$rows9||$rows10||$rows11||$rows12||$rows13||$rows14||$rows15||$rows16||$rows17||$rows18||$rows19||$rows20||$rows21)
	{
		$sql1 = mysql_query("Select sy FROM tbl_batch ORDER BY sy DESC LIMIT 1")
						or die(mysql_error());
					while($row = mysql_fetch_array($sql1)){
						$sy1 = $row['sy'];
					}
				
				$update = mysql_query("UPDATE tbl_batch SET status='0' WHERE sy='$sy1'") or die(mysql_error());
				
				$new_sy = $sy1+1;
				
		//---absences
		$query1 = mysql_query("Select * FROM tbl_absences")
					or die(mysql_error());
				while($row = mysql_fetch_array($query1))
				{
					$a = $row['class_id'];
					$b = $row['percent'];
					$c = $row['allow'];
					
					$query2 = mysql_query("INSERT INTO tbl_archive_absences(class_id,percent,allow,sy) 
					VALUES('$a','$b','$c','$sy1')")
					or die(mysql_error());
				}
				$query3 = mysql_query("TRUNCATE TABLE tbl_absences") or die(mysql_error());
		//---end of absences
		
		//---activity
		$query4 = mysql_query("Select * FROM tbl_activity")
					or die(mysql_error());
				while($row = mysql_fetch_array($query4))
				{
					$b = $row['class_id'];
					$c = $row['title'];
					$d = $row['dated'];
					$o = $row['over'];
					$e = $row['file'];
					$f = $row['filename'];
					$g = $row['allow_size'];
					$h = $row['deadline_date'];
					$i = $row['deadline_time'];
					$j = $row['description'];
					$p = $row['component'];
					$k = $row['category'];
					$l = $row['add_late'];
					$m = $row['status'];
					
					$query5 = mysql_query("INSERT INTO tbl_archive_activity(class_id,title,
					dated,over, file,filename,allow_size,deadline_date,deadline_time,description,component,category,
					add_late,status,sy) VALUES('$b','$c','$d','$o','$e','$f','$g','$h','$i','$j','$p','$k','$l','$m','$sy1')")
					or die(mysql_error());
				}
				$query6 = mysql_query("TRUNCATE TABLE tbl_activity") or die(mysql_error());
		//---end of activity
		
		//---activity grade
				$query7 = mysql_query("Select * FROM tbl_activity_grade")
					or die(mysql_error());
				while($row = mysql_fetch_array($query7))
				{
					$a = $row['class_class_id'];
					$b = $row['activity_id'];
					$c = $row['file'];
					$d = $row['filename'];
					$e = $row['date_submit'];
					$f = $row['time_submit'];
					$h = $row['status'];
					$g = $row['grade_id'];
					
					$query8 = mysql_query("INSERT INTO tbl_archive_activity_grade(class_class_id,activity_id,file,filename,date_submit,time_submit,status,grade_id,sy) 
					VALUES('$a','$b','$c','$d','$e','$f','$h','$g','$sy1')")
					or die(mysql_error());
				}
				$query9 = mysql_query("TRUNCATE TABLE tbl_activity_grade") or die(mysql_error());
				//---activity grade
				
				//---attendance
				$query10 = mysql_query("Select * FROM tbl_attendance")
					or die(mysql_error());
				while($row = mysql_fetch_array($query10))
				{
					$b = $row['calendar_id'];
					$c = $row['class_class_id'];
					$e = $row['number'];
					$d = $row['legend'];
					
					$query11 = mysql_query("INSERT INTO tbl_archive_attendance(calendar_id,class_class_id,number,legend,sy) 
					VALUES('$b','$c','$e','$d','$sy1')")
					or die(mysql_error());
				}
				$query12 = mysql_query("TRUNCATE TABLE tbl_attendance") or die(mysql_error());
				//---end of attendance
				
				$query13 = mysql_query("Select * FROM tbl_calendar")
					or die(mysql_error());
				while($row = mysql_fetch_array($query13))
				{
					$b = $row['month'];
					$c = $row['day'];
					$d = $row['status'];
					
					$query14 = mysql_query("INSERT INTO tbl_archive_calendar(month,day,status,sy) 
					VALUES('$b','$c','$d','$sy1')")
					or die(mysql_error());
				}
				$query15 = mysql_query("TRUNCATE TABLE tbl_calendar") or die(mysql_error());
				//---end of calendar
				
				//---cgpa
				$query16 = mysql_query("Select * FROM tbl_cgpa")
					or die(mysql_error());
				while($row = mysql_fetch_array($query16))
				{
					$a = $row['student_id'];
					$b = $row['cgpa'];
					
					$query17 = mysql_query("INSERT INTO tbl_archive_cgpa(student_id,cgpa,sy) 
					VALUES('$a','$b','$sy1')")
					or die(mysql_error());
				}
				$query18 = mysql_query("TRUNCATE TABLE tbl_cgpa") or die(mysql_error());
				//---end of cgpa
				
				//---class
				$query19 = mysql_query("Select * FROM tbl_class")
					or die(mysql_error());
				while($row = mysql_fetch_array($query19))
				{
					$a = $row['class_id'];
					$b = $row['section'];
					$c = $row['course_code'];
					$d = $row['instructor_id'];
					$e = $row['room'];
					$f = $row['schedule_day'];
					$g = $row['schedule_time'];
					$h = $row['total_hours'];
					$i = $row['day_hours'];
					
					$query20 = mysql_query("INSERT INTO tbl_archive_class(class_id,section,course_code,
					instructor_id,room,schedule_day,schedule_time,total_hours,day_hours,sy) VALUES('$a','$b','$c','$d','$e','$f','$g','$h','$i','$sy1')")
					or die(mysql_error());
				}
				$query21 = mysql_query("TRUNCATE TABLE tbl_class") or die(mysql_error());
				//---end of class
				
				//---class_class
				$query22 = mysql_query("Select * FROM tbl_class_class")
					or die(mysql_error());
				while($row = mysql_fetch_array($query22))
				{
					$b = $row['class_id'];
					$c = $row['student_id'];
					$d = $row['late_status'];
					
					$query23 = mysql_query("INSERT INTO tbl_archive_class_class(class_id,student_id,
					late_status,sy) VALUES('$b','$c','$d','$sy1')")
					or die(mysql_error());
				}
				$query24 = mysql_query("TRUNCATE TABLE tbl_class_class") or die(mysql_error());
				//---end of class_class
				
				//---component
				$query25 = mysql_query("Select * FROM tbl_component")
					or die(mysql_error());
				while($row = mysql_fetch_array($query25))
				{
					$b = $row['name'];
					$c = $row['required_number'];
					$d = $row['percentage'];
					$e = $row['class_id'];
					$f = $row['status'];
					
					$query26 = mysql_query("INSERT INTO tbl_archive_component(name,required_number,
					percentage,class_id,status,sy) VALUES('$b','$c','$d','$e','$f','$sy1')")
					or die(mysql_error());
				}
				$query27 = mysql_query("TRUNCATE TABLE tbl_component") or die(mysql_error());
				//---end of component
				
				//---course
				$query28 = mysql_query("Select * FROM tbl_course")
					or die(mysql_error());
				while($row = mysql_fetch_array($query28))
				{
					$a = $row['course_code'];
					$b = $row['description'];
					$c = $row['unit'];
					
					$query29 = mysql_query("INSERT INTO tbl_archive_course(course_code,description,unit,sy) 
					VALUES('$a','$b','$c','$sy1')")
					or die(mysql_error());
				}
				$query30 = mysql_query("TRUNCATE TABLE tbl_course") or die(mysql_error());
				//---end of course
				
				//---default component
				$query31 = mysql_query("Select * FROM tbl_defaultcomponent")
					or die(mysql_error());
				while($row = mysql_fetch_array($query31))
				{
					$a = $row['name'];
					$b = $row['required_number'];
					$c = $row['percentage'];
					
					$query32 = mysql_query("INSERT INTO tbl_archive_defaultcomponent(name,required_number,percentage,sy) 
					VALUES('$a','$b','$c','$sy1')")
					or die(mysql_error());
				}
				$query33 = mysql_query("TRUNCATE TABLE tbl_defaultcomponent") or die(mysql_error());
				//---end of default component
				
				//---files
				$query34 = mysql_query("Select * FROM tbl_files")
					or die(mysql_error());
				while($row = mysql_fetch_array($query34))
				{
					$a = $row['name'];
					$b = $row['size'];
					$c = $row['type'];
					$d = $row['content'];
					$e = $row['dated'];
					$f = $row['description'];
					$g = $row['status'];
					$h = $row['class_id'];
					
					$query35 = mysql_query("INSERT INTO tbl_archive_files(name,size,type,content,dated,description,status,class_id,sy) 
					VALUES('$a','$b','$c','$d','$e','$f','$g','$h','$sy1')")
					or die(mysql_error());
				}
				$query36 = mysql_query("TRUNCATE TABLE tbl_files") or die(mysql_error());
				//---end of files
				
				//---final grade
				$query37 = mysql_query("Select * FROM tbl_finalgrade")
					or die(mysql_error());
				while($row = mysql_fetch_array($query37))
				{
					$a = $row['class_class_id'];
					$b = $row['grade'];
					$c = $row['gpa'];
					
					$query38 = mysql_query("INSERT INTO tbl_archive_finalgrade(class_class_id,grade,gpa,sy) 
					VALUES('$a','$b','$c','$sy1')")
					or die(mysql_error());
				}
				$query39 = mysql_query("TRUNCATE TABLE tbl_finalgrade") or die(mysql_error());
				//---end of final grade
				
				//---grades
				$query40 = mysql_query("Select * FROM tbl_grades")
					or die(mysql_error());
				while($row = mysql_fetch_array($query40))
				{
					$a = $row['dated'];
					$b = $row['noOfItems'];
					$c = $row['score'];
					$d = $row['component'];
					$e = $row['category'];
					$f = $row['class_class_id'];
					
					$query41 = mysql_query("INSERT INTO tbl_archive_grades(dated,noOfItems,score,component,category,class_class_id,sy) 
					VALUES('$a','$b','$c','$d','$e','$f','$sy1')")
					or die(mysql_error());
				}
				$query42 = mysql_query("TRUNCATE TABLE tbl_grades") or die(mysql_error());
				//---end of grades
				
				//---request
				$query43 = mysql_query("Select * FROM tbl_request")
					or die(mysql_error());
				while($row = mysql_fetch_array($query43))
				{
					$a = $row['class_class_id'];
					$b = $row['request_date'];
					$c = $row['request_time'];
					$d = $row['status'];
					
					$query44 = mysql_query("INSERT INTO tbl_archive_request(class_class_id,request_date,request_time,status,sy) 
					VALUES('$a','$b','$c','$d','$sy1')")
					or die(mysql_error());
				}
				$query45 = mysql_query("TRUNCATE TABLE tbl_request") or die(mysql_error());
				//---end of request
				
				//---viewing
				$query46 = mysql_query("Select * FROM tbl_viewing")
					or die(mysql_error());
				while($row = mysql_fetch_array($query46))
				{
					$a = $row['class_id'];
					$b = $row['start_day'];
					$c = $row['start_time'];
					$d = $row['end_day'];
					$e = $row['end_time'];
					$f = $row['status'];
					
					$query47 = mysql_query("INSERT INTO tbl_archive_viewing(class_id,start_day,start_time,end_day,end_time,status,sy) 
					VALUES('$a','$b','$c','$d','$e','$f','$sy1')")
					or die(mysql_error());
				}
				$query48 = mysql_query("TRUNCATE TABLE tbl_viewing") or die(mysql_error());
				//---end of viewing
				
				//---achieve top
				$query49 = mysql_query("Select * FROM tbl_achievetop")
					or die(mysql_error());
				while($row = mysql_fetch_array($query49))
				{
					$a = $row['gpa'];
					$b = $row['student_id'];
					$c = $row['first_name'];
					$d = $row['middle_name'];
					$e = $row['last_name'];
					$f = $row['program'];
					$g = $row['status'];
					
					$query50 = mysql_query("INSERT INTO tbl_archive_achievetop(gpa,student_id,first_name,middle_name,last_name,program,status,sy) 
					VALUES('$a','$b','$c','$d','$e','$f','$g','$sy1')")
					or die(mysql_error());
				}
				$query51 = mysql_query("TRUNCATE TABLE tbl_achievetop") or die(mysql_error());
				//---end of achieve top
				
				//---achieve first
				$query52 = mysql_query("Select * FROM tbl_achievefirst")
					or die(mysql_error());
				while($row = mysql_fetch_array($query52))
				{
					$a = $row['cgpa'];
					$b = $row['student_id'];
					$c = $row['first_name'];
					$d = $row['middle_name'];
					$e = $row['last_name'];
					$f = $row['program'];
					$g = $row['status'];
					
					$query53 = mysql_query("INSERT INTO tbl_archive_achievefirst(cgpa,student_id,first_name,middle_name,last_name,program,status,sy) 
					VALUES('$a','$b','$c','$d','$e','$f','$g','$sy1')")
					or die(mysql_error());
				}
				$query54 = mysql_query("TRUNCATE TABLE tbl_achievefirst") or die(mysql_error());
				//---end of achieve first
				
				//---achieve second
				$query55 = mysql_query("Select * FROM tbl_achievesecond")
					or die(mysql_error());
				while($row = mysql_fetch_array($query55))
				{
					$a = $row['cgpa'];
					$b = $row['student_id'];
					$c = $row['first_name'];
					$d = $row['middle_name'];
					$e = $row['last_name'];
					$f = $row['program'];
					$g = $row['status'];
					
					$query56 = mysql_query("INSERT INTO tbl_archive_achievesecond(cgpa,student_id,first_name,middle_name,last_name,program,status,sy) 
					VALUES('$a','$b','$c','$d','$e','$f','$g','$sy1')")
					or die(mysql_error());
				}
				$query57 = mysql_query("TRUNCATE TABLE tbl_achievesecond") or die(mysql_error());
				//---end of achieve second
				
				//---achieve third
				$query58 = mysql_query("Select * FROM tbl_achievethird")
					or die(mysql_error());
				while($row = mysql_fetch_array($query58))
				{
					$a = $row['cgpa'];
					$b = $row['student_id'];
					$c = $row['first_name'];
					$d = $row['middle_name'];
					$e = $row['last_name'];
					$f = $row['program'];
					$g = $row['status'];
					
					$query59 = mysql_query("INSERT INTO tbl_archive_achievethird(cgpa,student_id,first_name,middle_name,last_name,program,status,sy) 
					VALUES('$a','$b','$c','$d','$e','$f','$g','$sy1')")
					or die(mysql_error());
				}
				$query60 = mysql_query("TRUNCATE TABLE tbl_achievethird") or die(mysql_error());
				//---end of achieve third
				
				//---achieve fourth
				$query61 = mysql_query("Select * FROM tbl_achievefourth")
					or die(mysql_error());
				while($row = mysql_fetch_array($query61))
				{
					$a = $row['cgpa'];
					$b = $row['student_id'];
					$c = $row['first_name'];
					$d = $row['middle_name'];
					$e = $row['last_name'];
					$f = $row['program'];
					$g = $row['status'];
					
					$query62 = mysql_query("INSERT INTO tbl_archive_achievefourth(cgpa,student_id,first_name,middle_name,last_name,program,status,sy) 
					VALUES('$a','$b','$c','$d','$e','$f','$g','$sy1')")
					or die(mysql_error());
				}
				$query63 = mysql_query("TRUNCATE TABLE tbl_achievefourth") or die(mysql_error());
				//---end of achieve fourth
		
		
				$insert = mysql_query("INSERT INTO tbl_batch(sy,status) VALUES('$new_sy','1')")
					or die(mysql_error());
					
				$msg = "<script>alert (\"Action successful! You are now ready for a whole new term!\")</script>";
				echo $msg;
	}
	}
	}
	
?>
<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Administrator | Adding New Term</title> <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <!-- Bootstrap -->
		<link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="../_public/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
        <link href="../_public/assets/DT_bootstrap.css" rel="stylesheet" media="screen">        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="../_public/http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="../_public/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
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
	                                    <li>Adding Term</li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            	<div class="bs-example">
            
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="top">
					
                <p>                 
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>Adding New Term</h5></div>
                                </div>
                                <div class="block-content collapse in">
								<form method="post" action="">
                                    <table>
										<tr>
											<td>Current Batch: 
											<td><input type="text" value="<?php $sql2 = mysql_query("Select sy FROM tbl_batch WHERE status='1' ORDER BY sy DESC LIMIT 1")
												or die(mysql_error());
												while($row = mysql_fetch_array($sql2)){
													$batch2 = $row['sy'];
												} echo $batch2 ?>" readonly>
										</tr>
										<tr>
											<td>Action:
											<td><button class="btn btn-success btn-mini" name="add"> Add New Term</button>
										</tr>
                                            
                                    </table>
									</form>
									<?php if(isset($_POST['add'])) { echo $msg; }?>
                                </div>
                            </div>
				</p>
                </div>
				
                


              </div>
            </div>
                        </div>
                        <!-- /block -->
                    </div>


                </div>
            </div>
            <hr>
<?php include 'includes/footer.php'; ?>
        </div>
        <!--/.fluid-container-->
        <script src="../_public/vendors/jquery-1.9.1.min.js"></script>
        <script src="../_public/bootstrap/js/bootstrap.min.js"></script>
        <script src="../_public/vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="../_public/assets/scripts.js"></script>
        <script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000});
        });
        </script>
		
		
        <script src="../_public/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<script src="../_public/assets/DT_bootstrap.js"></script>
        
		<script>
        $(function() {
            
        });
        </script>
    </body>

</html>
<?php
}
?>