<?php
		if(isset($_REQUEST['class'])){
		$classID = $_REQUEST['class'];
		}
		else {
		$classID = $_SESSION['classID'];
		}
		$_SESSION['classID']=$classID;
		$studID = $_SESSION['username'];
		
		$sql4 = mysql_query("SELECT  c.section as section, c.course_code as course, d.class_class_id as enrollid FROM tbl_class c, tbl_class_class d  WHERE c.class_id='$classID' AND d.class_id='$classID' AND d.student_id='$studID'")
					   or die(mysql_error()) ;
					   
		while($row = mysql_fetch_array($sql4))
		{
			$section = $row['section'];
			$course = $row['course'];
			$enrollID = $row['enrollid'];
		}
?>