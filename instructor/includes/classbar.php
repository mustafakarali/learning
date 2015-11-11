<?php
	if(isset($_REQUEST['myID'])) {
		$myID = $_REQUEST['myID'];
		 if($myID==1) {
			$sql = mysql_query("UPDATE tbl_notification2 SET status='1' WHERE class_id='$classID' AND category='activity' AND status='0'");
		}
		else if($myID==2) {
			$sql = mysql_query("UPDATE tbl_notification2 SET status='1' WHERE class_id='$classID' AND category='message' AND status='0'");
		}
	}
?>
<html>
<head>

</head>
<body>
                <div class="span3" id="sidebar">
                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                        <li><a href=""><?php echo $course."-".$section;?></a>
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='records.php'? 'class="active' : '');?>">
                            <a href="records.php"><i class="icon-chevron-right"></i> Records</a>
                        </li>
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='attendance2.php'? 'class="active' : '');?>">
                            <a href="attendance.php"><i class="icon-chevron-right"></i> Attendance</a>
                        </li>                                            
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='activity.php'? 'class="active' : '');?>">
                            <a href="activity.php?myID=1"><span class="badge badge-info pull-right"><?php
								$count = mysql_result(mysql_query("SELECT count(*) FROM tbl_notification2 WHERE class_id='$classID' AND category='activity' AND status='0'"),0);
								echo $count;?></span>Activity</a>
                        </li>
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='files.php'? 'class="active' : '');?>">
                            <a href="files.php"><i class="icon-chevron-right"></i> Files</a>
                        </li>
                        
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='members.php'? 'class="active' : '');?>">
                            <a href="members.php"><i class="icon-chevron-right"></i> Students</a>
                        </li>
						
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='summary.php'? 'class="active' : '');?>">
                            <a href="summary.php"><i class="icon-chevron-right"></i> Summary</a>
                        </li>
                        
                    </ul>
                </div>
		</body>
</html>                                