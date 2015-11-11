<?php
	if(isset($_REQUEST['myID'])) {
		$myID = $_REQUEST['myID'];
		if($myID==1) {
			$sql = mysql_query("UPDATE tbl_notification3 SET status='1' WHERE class_class_id='$enrollID' AND category='sar' AND status='0'");
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
                            <a href="classInformation"><?php echo $course."-".$section;?></a>
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='records.php'? 'class="active' : '');?>">
                            <a href="records.php?myID=1"><span class="badge badge-info pull-right"><?php
								$count = mysql_result(mysql_query("SELECT count(*) FROM tbl_notification3 WHERE class_class_id='$enrollID' AND category='sar' AND status='0'"),0);
								echo $count;?></span> Records</a>
                        </li> 
                       <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='message.php'? 'class="active' : '');?>">
                            <a href="message.php"> Message</a>
                        </li>

                    </ul>
                </div>
		</body>
</html>                                