<?php
	if(isset($_REQUEST['myID'])) {
		$myID = $_REQUEST['myID'];
		if($myID==1) {
			$sql = mysql_query("UPDATE tbl_notification SET status='1' WHERE class_class_id='$enrollID' AND category='sar' AND status='0'");
		}
		else if($myID==2) {
			$sql = mysql_query("UPDATE tbl_notification SET status='1' WHERE class_class_id='$enrollID' AND category='activity' AND status='0'");
		}
		else if($myID==3) {
			$sql = mysql_query("UPDATE tbl_notification SET status='1' WHERE class_class_id='$enrollID' AND category='files' AND status='0'");
		}
		else if($myID==4) {
			$sql = mysql_query("UPDATE tbl_notification SET status='1' WHERE class_class_id='$enrollID' AND category='message' AND status='0'");
		}
	}
?>
<html>
<head>

</head>
<body>

        
                <div class="span3" id="sidebar">
                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                    	
						<li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='classInformation.php'? 'class="active' : '');?>">
                            <a href="classInformation.php"><?php echo $course."-".$section;?></a>
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='records.php'? 'class="active' : '');?>">
                            <a href="records.php?myID=1">Records</a>
                        </li>                    
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='activity.php'? 'class="active' : '');?>">
                            <a href="activity.php?myID=2"><span class="badge badge-info pull-right"><?php
								$count = mysql_result(mysql_query("SELECT count(*) FROM tbl_notification WHERE class_class_id='$enrollID' AND category='activity' AND status='0'"),0);
								echo $count;?></span> Activity</a>
                        </li>
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='files.php'? 'class="active' : '');?>">
                            <a href="files.php?myID=3"><span class="badge badge-info pull-right"><?php
								$count = mysql_result(mysql_query("SELECT count(*) FROM tbl_notification WHERE class_class_id='$enrollID' AND category='files' AND status='0'"),0);
								echo $count;?></span> Files</a>
                        </li>
                        
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='message.php'? 'class="active' : '');?>">
                            <a href="message.php">Messages</a>
                        </li>

                        
                    </ul>

                </div>
                        
       
                
		</body>
</html>                                