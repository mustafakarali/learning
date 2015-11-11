<?php

		$file = $_FILES['fileClass']['tmp_name'];

		if($file == "")
		{
		  $msg= "No file selected";
		}

		else
		{
			$check =0;
			$z=0;
			$x=0;
			$unique[$x]='';
			$y=0;
			if (($getfile = fopen($file, "r")) !== FALSE) {
					 $data = fgetcsv($getfile, 1000, ",");
					 $num = count($data);
					 if($num!=8) {
							echo   'Information is incomplete; Section, Course, Instructor, Room, Day, Time, Total Hours, Hour/Meeting';
					}
					else {
				while (($data = fgetcsv($getfile, 1000, ",")) !== FALSE) {
					$num = count($data);
					$x++;
					$z++;
					$error=0;
					for ($c=0; $c < $num; $c++) {
						$result = $data;
						$str = implode(",", $result);
						$slice = explode(",", $str);
						
						$a=0;
						foreach($slice as $name) {
								$a++;
							if($name=='') {
								$error=1;
								echo  "Incomplete information in $a entry";
								break;
							}
							else {
								$section[$z] = $slice[0];
								$course[$z] = $slice[1];
								$insID[$z] = $slice[2];
								$room[$z] = $slice[3];
								$day[$z] = $slice[4];
								$time[$z] = $slice[5];
								$total_hr[$z] = $slice[6];
								$hr[$z] = $slice[7];
								$abc[$z] = $course[$z].'-'.$section[$z];
								
								$check_ins = mysql_result(mysql_query("SELECT count(instructor_id) FROM tbl_instructor WHERE instructor_id='$insID[$z]'"),0);
								if(!$check_ins) {
									$error=1;
									echo  "$insID[$z] is invalid Instructor id";
									break;
								}
							}
						}
					}
					if($error) {
						break;
					}
						if (in_array($abc[$z], $unique)) {
							$duplicate[$y]=$abc[$z];
							$y++;
						}
						else {
							$unique[$x] = $abc[$z];
						}
				}
				if($error) {
					echo  $msg;
				}
				else if(isset($duplicate)) {
							foreach($duplicate as $key) {
								$msg_key = $key;
								echo  '<br>Duplicate Class';
							}
				}
				else {
					for($i=1;$i<=$z;$i++) {
						$check_no = mysql_result(mysql_query("SELECT count(*) FROM tbl_class WHERE section='$section[$i]' AND course_code='$course[$i]'"),0);
						if($check_no) {
							$check = 1;
							echo  "$section[$i] - $course[$i] Class already exist";
							break;
						}
					}
					if($check==0) {
						for($i=1;$i<=$z;$i++) {
							$query = mysql_query("INSERT INTO tbl_class(section, course_code, instructor_id, room, schedule_day, schedule_time, total_hours, day_hours)
							VALUES('".$section[$i] ."','".$course[$i]."','".$insID[$i]."','".$room[$i]."','".$day[$i]."','".$time[$i]."','".$total_hr[$i]."','".$hr[$i]."')") or die(mysql_error());
						}
						echo   "Record of Classes was successfully imported to database!!";
					}
				}
			}
		}
		}
?>