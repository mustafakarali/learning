<?php
	session_start();
	
	if(!($_SESSION['login'])) {
		header("Location: ../parent.php");
	}
	else {
		header("location: profile.php");
	}	
?>