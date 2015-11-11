<?php
	$server = "localhost";
	$user = "root";
	$pass ="";
	$db = "db_feufern";
	
	$dbcon = mysql_connect($server, $user, $pass)
			or die(mysql_error(). "Not connected! database");
			
	$mydb = mysql_select_db($db, $dbcon);
?>