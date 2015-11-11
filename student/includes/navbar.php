<?php
$sql = mysql_query("SELECT * FROM tbl_student  WHERE student_id='$studID'")
					   or die(mysql_error()) ;
					   
		while($row = mysql_fetch_array($sql))
		{
			$id = $row['student_id'];
			$fname = $row['first_name'];
			$mname = $row['middle_name'];
			$lname = $row['last_name'];
			$contact = $row['contact'];
			$gender = $row['gender'];
			$program = $row['program'];
			$bday = $row['birthday'];
			$email = $row['email'];
			$pass = preg_replace( '/./', '*', $row['pass']);
			$password = $row['password'];
		}
?>

<div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container-fluid">
			<a href="index.php" class="brand brand-bootbus"><img src="../_public/img/logo.gif" alt="FEU - FERN COLLEGE" /></a>
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>

                    <div class="nav-collapse collapse">
                        <ul class="nav pull-right">
						   <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='profile.php'? 'class="active' : '');?>">
                                <a href="profile.php">Profile</a>
                            </li>
							<li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='classList.php'? 'class="active' : '');?>">
                                <a href="classList.php">Class List</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> Welcome, <?php echo $fname.' '.$lname?> <i class="caret"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="logout.php">Logout</a></li>
                                </ul>
                            </li>
                        </ul>

                    </div>

        </div>
    </div>
</div>
