<html>
<head>

</head>
<body>
                <div class="span3" id="sidebar">
                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='profile.php'? 'class="active' : '');?>">
                            <a href="profile.php"> Profile</a>
                        </li>
                        <li <?php echo (basename($_SERVER['SCRIPT_FILENAME'])=='classList.php'? 'class="active' : '');?>">
                            <a href="classList.php"><i class="icon-chevron-right"></i> Class List</a>
                        </li> 
						
                    </ul>
                </div>
		</body>
</html>                