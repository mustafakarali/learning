<?php
				
				$sql = mysql_query("SELECT * FROM tbl_viewing WHERE status=1") or die(mysql_error());
				while($row = mysql_fetch_array($sql)){
					$viewingID = $row['viewing_id'];
					$date = strtotime($row['end_day']);
					$time = strtotime($row['end_time']);
				}
				
						$day = date("Y-m-d");
						$cur_day = strtotime(date("Y-m-d"));
						$cur_time1 = date("H:i:s");
						$cur_time = strtotime($cur_time1);
									
						if(isset($viewingID)) {
							if($date<=$cur_day){
								 if($time<=$cur_time) {
									mysql_query("UPDATE tbl_viewing SET status='0' WHERE viewing_id='$viewingID'");
									}
							}
						}
						
						$notif_req = mysql_result(mysql_query("SELECT count(*) FROM tbl_notification2 WHERE category='request' AND status='1'"),0);
						
						if(isset($_POST['btnSetViewing'])) {
						$date= date('Y-m-d', strtotime(str_replace('-', '/', $_POST['date'])));
						$hr = $_POST['hour'];
						$mn = $_POST['minute'];
						$time = $hr.':'.$mn.':00';
						$date2= date('Y-m-d', strtotime(str_replace('-', '/', $_POST['date2'])));
						$hr2 = $_POST['hour2'];
						$mn2 = $_POST['minute2'];
						$time2 = $hr2.':'.$mn2.':00';
						
						mysql_query("INSERT INTO tbl_viewing(class_id, start_day, start_time, end_day, end_time, status) VALUES('$classID','$date','$time','$date2','$time2','1')") or die(mysql_error());
					}
					
					
					if(isset($_REQUEST['request'])) {
						$reqID = $_REQUEST['request'];
						mysql_query("UPDATE tbl_request SET status='1' WHERE request_id='$reqID'");
						$date = date("Y-m-d");
						$time = date("H:i:s");
						$tom = date('Y-m-d',strtotime($date . "+1 days"));
						mysql_query("INSERT INTO tbl_viewing(class_id, start_day, start_time, end_day, end_time, status) VALUES('$classID','$date','$time','$tom','$time','1')");
					}

?>