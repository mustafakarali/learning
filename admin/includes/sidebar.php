<html>
<head>

</head>
<body>

                <div class="span3" id="sidebar">
                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='dashboard.php'? 'class="active' : '');?>">
                            <a href="dashboard.php"></i> Dashboard</a>
                        </li>
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='user.php'? 'class="active' : '');?>">
                            <a href="user.php"><i class="icon-chevron-right"></i> User Account Manager</a>
                        </li>
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='achieve.php'? 'class="active' : '');?>">
                            <a href="achieve.php"> Achievement Board</a>
                        </li>
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='announce.php'? 'class="active' : '');?>">
                            <a href="announce.php"> Announcement Board</a>
                        </li>
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='component.php'? 'class="active' : '');?>">
                            <a href="component.php"><i class="icon-chevron-right"></i> Grade Component & Attendance Editor</a>
                        </li>
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='report.php'? 'class="active' : '');?>">
                            <a href="report.php"> Report Generator</a>
                        </li>
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='content.php'? 'class="active' : '');?>">
                            <a href="content.php"> Manage Page</a>
                        </li>                        
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='addTerm.php'? 'class="active' : '');?>">
                            <a href="addTerm.php"> Add Term</a>
                        </li>
						<li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='archive.php'? 'class="active' : '');?>">
                            <a href="archive.php"> Archive of Grades</a>
                        </li>							
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='upload.php'? 'class="active' : '');?>">
                            <a href="upload.php"> Upload CSV</a>
                        </li>						
                    </ul>
                </div>
		</body>
</html>