<?php
		if(isset($_REQUEST['class'])) {
			if($_REQUEST['class']){
			$classID = $_REQUEST['class'];
			}
		}
		else {
			$classID = $_SESSION['classID'];
		}
			$_SESSION['classID']=$classID;
			$insID = $_SESSION['username'];
			
			$sql4 = mysql_query("SELECT * FROM tbl_class  WHERE class_id='$classID'")
						   or die(mysql_error()) ;
						   
			while($row = mysql_fetch_array($sql4))
			{
				$section = $row['section'];
				$course = $row['course_code'];
			}
		
?>