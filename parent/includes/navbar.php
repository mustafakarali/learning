<?php
$sql = mysql_query("SELECT p.parent_id, p.child_id, s.first_name, s.last_name, s.parent_number, s.parent_email, p.pass, p.password FROM tbl_parent p, tbl_student s WHERE p.username='$parent_username' AND p.child_id=s.student_id")
					   or die(mysql_error()) ;
					   
		while($row = mysql_fetch_array($sql))
		{
			$parentID = $row['parent_id'];
			$studID = $row['child_id'];
			$fname = $row['first_name'];
			$lname = $row['last_name'];
			$email = $row['parent_email'];
			$contact = $row['parent_number'];
			$pass = preg_replace( '/./', '*', $row['pass']);
			$password = $row['password'];
		}
		$_SESSION['studID'] = $studID;
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
						   
							<li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='classList.php'? 'class="active' : '');?>">
                                <a href="classList">Class List</a>
                            </li>
                            <li class="dropdown">
                                <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> Welcome Parent of <?php echo $fname.' '.$lname?> <i class="caret"></i></a>
                                <ul class="dropdown-menu">
                                    <li><a tabindex="-1" href="logout">Logout</a></li>
                                </ul>
                            </li>
                        </ul>

                    </div>

        </div>
    </div>
</div>
