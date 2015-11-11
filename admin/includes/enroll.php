<?php
$file = $_FILES['fileEnroll']['tmp_name'];

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
							echo   'Information is incomplete; Employee Number, First Name,  Middle Name (Optional),
								Last Name, Gender, Contact,  Email Adress';
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
								$section[$z] = $slice[0];
								$course[$z] = $slice[1];
								$studID[$z] = $slice[2];
								$abc[$z] = $course[$z].'-'.$section[$z].'-'.$studID[$z];
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
								echo  '<br>$studID[$Z] is already part of $section[$z] - $course[$z] Class';
							}
				}
				else {
					for($i=1;$i<=$z;$i++) {
						$check_class = mysql_result(mysql_query("SELECT count(*) FROM tbl_class WHERE course_code='$course[$i]' AND section='$section[$i]'"),0);
						if(!$check_class) {
							$check = 1;
							echo  "$section[$i] - $course[$i] Class does not exists";
							break;
						}
						
						$classID = mysql_result(mysql_query("SELECT class_id FROM tbl_class  WHERE section='$section[$i]' AND course_code='$course[$i]'"),0);
						$check_no = mysql_result(mysql_query("SELECT count(*) FROM tbl_class_class  WHERE class_id='$classID' AND student_id='$studID[$i]'"),0);
						if($check_no) {
							$check = 1;
							echo  "$studID[$i] is already part of $section[$i] - $course[$i] Class";
							break;
						}
					}
					if($check==0) {
						for($i=1;$i<=$z;$i++) {
							$classID = mysql_result(mysql_query("SELECT class_id FROM tbl_class WHERE course_code='$course[$i]' AND section='$section[$i]'"),0);
							
							$query = mysql_query("INSERT INTO tbl_class_class(class_id, student_id)
							VALUES('".$classID."','".$studID[$i]."')") or die(mysql_error());
						}
						echo   "Record of Classes was successfully imported to database!!";
					}
				}
				}
			}
		}
?>