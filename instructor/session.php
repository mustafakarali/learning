<?php
	
	if(isset($_POST['leslie'])) {
		echo $_SESSION['no'];
	}
?>
<form action="" method="post">
	<input type="submit" name="leslie" value="Click"></input>
	
<?php
	
	$no = 2;
	$_SESSION['no']=$no;
	
?>

</form>

