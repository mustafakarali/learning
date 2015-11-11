<?php
		$file = $_FILES['fileInstructor']['tmp_name'];

			if($file == "")
		{
		   echo "No file selected";
		}
		else {	
			$numrow=0;
			$x = 0;
			$y=1;
			$z=0;
			$b=0;
			$c=0;
			$d=0;
			$e=0;
			$error=0;
							$check = 0;
			$unique[$x]='';
			$u_email[$x]='';
			$u_no[$x]='';
			$valid = mysql_result(mysql_query("SELECT count(*) from tbl_instructor"),0);
			
			
				if (($getfile = fopen($file, "r")) !== FALSE) {
						 $data = fgetcsv($getfile, 1000, ",");
						 $num = count($data);
					if($num!=7) {
							echo   'Information is incomplete; Employee Number, First Name,  Middle Name (Optional),
								Last Name, Gender, Contact,  Email Adress';
					}
					else {
					while (($data = fgetcsv($getfile, 1000, ",")) !== FALSE) {
						$d++;
						$e++;
						$x++;
						$z++;
						for ($c=0; $c < $num; $c++) {
							$result = $data;
							$str = implode(",", $result);
							$slice = explode(",", $str);
							
							if($slice[0]=='') {
								$error = 1;
								echo  "Employee Number is empty in $x entry";
								break;
							}
							else {
								$a=-1;
								foreach($slice as $name) {
										$a++;
									if($name=='') {
										if($a==2) {
										}
										else {
											$error=1;
											echo  "$slice[0] has incomplete information";
											break;
										}
									}
									else {
										$empID[$z] = $slice[0];
										$fname[$z] = $slice[1];
										$mname[$z] = $slice[2];
										$lname[$z] = $slice[3];
										$gender[$z] = $slice[4];
										$contact[$z] = $slice[5];
										$email[$z] = $slice[6];
										
										if(!is_numeric($empID[$z]))
										{	$error=1;
											echo  "Invalid Employee Number - $empID[$z]";
											break;
										}
										/*else if(filter_var($email[$z], FILTER_VALIDATE_EMAIL))
										{	$error=1;
											echo  "Invalid Email Address - $email[$z]";
											break;
										}*/
										else if (!preg_match('/^[A-Z][a-zA-Z -]+$/',$fname[$z]))
										{	$error=1;
											echo  "Invalid First Name - $fname[$z]";
											break;
										}
										else if($mname[$z] != null)
										{
											if (!preg_match('/^[A-Z][a-zA-Z -]+$/',$mname[$z]))
											{	$error=1;
												echo  "Invalid Middle Name - $mname[$z]";
												break;
											}
										}
										
										else if (!preg_match('/^[A-Z][a-zA-Z -]+$/',$lname[$z]))
										{	$error=1;
											echo  "Invalid Last Name - $lname[$z]";
											break;
										}
										else if ($gender[$z]!='Female' || $gender[$z]!='Male')
										{	$error=1;
											echo  "$studID[$z] has invalid gender - $lname[$z]";
											break;
										}
										else if(!preg_match('/^[0-9\s]+$/',$contact[$z]))
										{	$error=1;
											echo  "Invalid Contact Number - $contact[$z]";
											break;
										}
									}
								}
							}
						}
						if($error) {
							break;
						}
						if (in_array($empID[$z], $unique)) {
							$duplicate[$y]=$empID[$z];
							$y++;
						}
						else {
							$unique[$x] = $empID[$z];
						}
						if (in_array($contact[$z], $u_no)) {
							$dup_no[$b]=$contact[$z];
							$b++;
						}
						else {
							$u_no[$d] = $contact[$z];
						}
						
						if (in_array($email[$z], $u_email)) {
							$dup_email[$c]=$email[$z];
							$c++;
						}
						else {
							$u_email[$e] = $email[$z];
						}
					}
						
						if($error) {
							echo   $msg;
						}
						else if(isset($duplicate)) {
							foreach($duplicate as $key) {
								$msg_key = $key;
							}
							echo  '<br>Duplicate Employee Number';
						}
						else if(isset($dup_no)) {
							foreach($dup_no as $key) {
								$msg_key = $key;
							}
							echo '<br>Duplicate Contact Number';
						}
						else if(isset($dup_email)) {
							foreach($dup_email as $key) {
								$msg_key = $key;
							}
							echo  '<br>Duplicate Email Address';
						}
						else {
							for($i=1;$i<=$z;$i++) {
								$check_empID = mysql_result(mysql_query("SELECT count(instructor_id) FROM tbl_instructor WHERE instructor_id='$empID[$i]'"),0);
								if($check_empID) {
									$check = 1;
									echo  "Employee Number - $empID[$i] already exists!";
									break;
								}
								$check_no = mysql_result(mysql_query("SELECT count(contact) FROM tbl_instructor WHERE instructor_id='$empID[$i]'"),0);
								if($check_no) {
									$check = 1;
									echo  "Contact Number - $contact[$i] already exists!";
									break;
								}
								$check_email = mysql_result(mysql_query("SELECT count(email) FROM tbl_instructor WHERE instructor_id='$empID[$i]'"),0);
								if($check_email) {
									$check = 1;
									echo  "Email Address - $email[$i] already exists!";
									break;
								}
							}
							
							if($check==0) {
								$pass = 'IamATeacher';
								$password = md5($pass);
								for($i=1;$i<=$z;$i++) {
								
								$query = mysql_query("INSERT INTO tbl_instructor(instructor_id, first_name, middle_name, last_name, gender, contact, email, pass, password, status)
								VALUES('".$empID[$i]."','".$fname[$i]."','".$mname[$i]."','".$lname[$i]."','".$gender[$i]."','".$contact[$i]."','".$email[$i]."','".$pass."','".$password."','0')") or die(mysql_error());
										 
								
								}
								echo "Records Successfully imported";
							}
						}
					}
				}
			}
?>