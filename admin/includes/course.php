<?php
$file = $_FILES['fileCourse']['tmp_name'];

		if($file == "")
		{
		   $msg  =  "No file selected";
		}

		else
		{
			$error = 0;
			$z=0;
			$x=0;
			$unique[$x]='';
			$check=0;
			if (($getfile = fopen($file, "r")) !== FALSE) {
					 $data = fgetcsv($getfile, 1000, ",");
					 $num = count($data);
					 if($num!=3) {
							echo   'Information is incomplete; course_code, course description, unit';
					}
					else {
				while (($data = fgetcsv($getfile, 1000, ",")) !== FALSE) {
					$num = count($data);
					$x++;
					
					$z++;
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
								$course[$z] = $slice[0];
								$desc[$z] = $slice[1];
								$unit[$z] = $slice[2];
							}
					}
				}
						if($error) {
						break;
					}
						if (in_array($course[$z], $unique)) {
							$duplicate[$y]=$course[$z];
							$y++;
						}
						else {
							$unique[$x] = $course[$z];
						}
				}
				if($error) {
					echo  $msg;
				}
				else if(isset($duplicate)) {
							foreach($duplicate as $key) {
								$msg_key = $key;
								echo  "<br>Duplicate course_code: $course[$z]";
							}
				}
				else {
					for($i=1;$i<=$z;$i++) {
						$check_no = mysql_result(mysql_query("SELECT count(*) FROM tbl_course WHERE course_code='$course[$i]'"),0);
						if($check_no) {
							$check = 1;
							echo  "$course[$i] already exist";
							break;
						}
					}
					if($check==0) {
						for($i=1;$i<=$z;$i++) {
							$query = mysql_query("INSERT INTO tbl_course(course_code, description, unit)
							VALUES('".$course[$i]."','".$desc[$i]."','".$unit[$i]."')") or die(mysql_error());
						}
						echo   "Record of Courses was successfully imported to database!!";
					}
				}
				}
			}
		}
?>