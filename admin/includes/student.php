<?php


		
		$file = $_FILES['fileStudent']['tmp_name'];

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
			$valid = mysql_result(mysql_query("SELECT count(*) from tbl_student"),0);
			
			
				if (($getfile = fopen($file, "r")) !== FALSE) {
						 $data = fgetcsv($getfile, 1000, ",");
						$num = count($data);
						
						if($num!=12) {
							echo  'Students Information is incomplete';
						}
						else if($num==12) {
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
								echo "Student Number is empty in $x entry";
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
										$studID[$z] = $slice[0];
										$fname[$z] = $slice[1];
										$mname[$z] = $slice[2];
										$lname[$z] = $slice[3];
										$gender[$z] = $slice[4];
										
										$birthday[$z]= date('Y-m-d', strtotime(str_replace('-', '/', $slice[5])));;
										$password[$z]=md5($birthday[$z]);
										
										$program[$z] = $slice[6];
										$year[$z] = $slice[7];
										$contact[$z] = $slice[8];
										$email[$z] = $slice[9];
										$parent_no[$z] = $slice[10];
										$parent_email[$z] = $slice[11];
										
										if(!preg_match('/^[0-9\s]+$/',$studID[$z]))
										{	$error=1;
											echo  "Invalid Student Number - $studID[$z]";
											break;
										}
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
										else if ($gender[$z]!='Female' && $gender[$z]!='Male')
										{	$error=1;
											echo  "$studID[$z] has invalid gender - $gender[$z]";
											break;
										}
										else if (!preg_match('/^[A-Z][a-zA-Z -]+$/',$program[$z]))
										{	$error=1;
											echo  "Invalid Program - $program[$z]";
											break;
										}
										else if(!preg_match('/^[1-4\s]+$/',$year[$z]))
										{	$error=1;
											echo  "Invalid Year Level - $year[$z]";
											break;
										}
										else if(!preg_match('/^[0-9\s]+$/',$contact[$z]))
										{	$error=1;
											echo  "Invalid Contact Number - $contact[$z]";
											break;
										}
										else if(strlen($contact[$z]) < 11) {
											$error=1;
											echo  "Invalid Contact Number - $contact[$z]";
											break;
										}
										else if(!is_email($email[$z]))
										{	$error=1;
											echo  "Invalid Email Address - $email[$z]";
											break;
										}
									}
								}
							}
						}
						if($error) {
							break;
						}
						if (in_array($studID[$z], $unique)) {
							$duplicate[$y]=$studID[$z];
							$y++;
						}
						else {
							$unique[$x] = $studID[$z];
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
							echo  '<br>Duplicate Student Number';
						}
						else if(isset($dup_no)) {
							foreach($dup_no as $key) {
								$msg_key = $key;
							}
							echo  '<br>Duplicate Contact Number';
						}
						else if(isset($dup_email)) {
							foreach($dup_email as $key) {
								$msg_key = $key;
							}
							echo  '<br>Duplicate Email Address';
						}
						else {
							for($i=1;$i<=$z;$i++) {
								$check_studID = mysql_result(mysql_query("SELECT count(student_id) FROM tbl_student WHERE student_id='$studID[$i]'"),0);
								if($check_studID) {
									$check = 1;
									echo  "Student Number - $studID[$i] already exists!";
									break;
								}
								$check_no = mysql_result(mysql_query("SELECT count(contact) FROM tbl_student WHERE student_id='$studID[$i]'"),0);
								if($check_no) {
									$check = 1;
									echo  "Contact Number - $contact[$i] already exists!";
									break;
								}
								$check_email = mysql_result(mysql_query("SELECT count(email) FROM tbl_student WHERE student_id='$studID[$i]'"),0);
								if($check_email) {
									$check = 1;
									echo  "Email Address - $email[$i] already exists!";
									break;
								}
							}
							
							if($check==0) {
								for($i=1;$i<=$z;$i++) {
								
								 mysql_query("INSERT INTO tbl_student(student_id, first_name, middle_name, last_name, gender, birthday, program, level, contact, email, pass, password, parent_number, parent_email, status, late_status)
								VALUES('".$studID[$i]."','".$fname[$i]."','".$mname[$i]."','".$lname[$i]."','".$gender[$i]."','".$birthday[$i]."','".$program[$i]."','".$year[$i]."','".$contact[$i]."','".$email[$i]."','".$birthday[$i]."','".$password[$i]."','".$parent_no[$i]."','".$parent_email[$i]."','0','0')") or die(mysql_error());
										 
								/*$first = $fname[$i];
								if(isset($mname[$i])) {
									$second = $mname[$i];
								}
								else {
									$second ='';
								}
								$third = $lname[$i];
								
								$f = substr($first, 0, 1);
								$s = substr($second, 0, 1);
								
								$f1 = strtolower($f);
								$s1 = strtolower($s);
								$t1 = strtolower($lname[$i]);
								
								$t2 = preg_replace('/[ ,]+/', '', $t1);
								$username = $f1 . $s1 . $t2;*/
		
								mysql_query("INSERT INTO tbl_parent(username,child_id,pass,password,status) VALUES('".$studID[$i]."','".$studID[$i]."','".$birthday[$i]."','".$password[$i]."','0')") or die(mysql_error());
								
								//email here
		$b = $parent_email[$i];
		$c = $studID[$i];
		$d = $birthday[$i];
		$e = "ivannmagadia@gmail.com";
		$to = $b;

        $subject = "FEU FERN College : Parent's Account Information ";

        $headers = "From: $e \n";
        $headers .= "Reply-To: $e \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        $message = '<html><body>';
        $message .= 'Hi <b>'.'Parent'.'!</b><br>';
        $message .= '<b>Username: </b>'."$c".'<br>';
		$message .= '<b>Password: </b>'."$d".'<br>';
        $message .= "</body></html>";
        
        mail($to, $subject, $message, $headers);
								
								}
								echo "Records Successfully imported";
							}
						}
					}
				}
			}

?>