<?php
		session_start();
		include("include/dbcon.php");
		$id = $_REQUEST['myVar'];
		$myQuery = mysql_query("SELECT * FROM tbl_announcement WHERE announcement_id='$id'");
				while($row = mysql_fetch_array($myQuery)){
			$date = $row['dated'];
			$title = $row['title'];
			$desc = $row['description'];
		}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bootbusiness | Short description about company">
    <meta name="author" content="Your name">
    <link rel="shortcut icon" href="_public/img/favicon.ico" />
    <title>FEU Diliman | Announcements</title>
    <!-- Bootstrap -->
    <link href="_public/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap responsive -->
    <link href="_public/css/bootstrap-responsive.min.css" rel="stylesheet">
    <!-- Font awesome - iconic font with IE7 support --> 
    <link href="_public/css/font-awesome.css" rel="stylesheet">
    <link href="_public/css/font-awesome-ie7.css" rel="stylesheet">
    <!-- Bootbusiness theme -->
    <link href="_public/css/boot-business.css" rel="stylesheet">
  </head>
  <body>
    <!-- Start: HEADER -->
    <header>
      <!-- Start: Navigation wrapper -->
    <?php include 'include/header.php'; ?>
      <!-- End: Navigation wrapper -->   
    </header>
    <!-- End: HEADER -->
    <!-- Start: MAIN CONTENT -->
    <div class="content">
        <div class="container">
          <div class="page-header">
            <h2>Announcements</h2>
        </div>
      <!-- Start: ANNOUNCEMENTS -->		
		<div class="row-fluid">
            <div class="span9">
                    <h3> <?php echo $title; ?> </h3>
                    <p><?php echo $date; ?></p>
					<p><?php echo $desc; ?></p>
			</div>
		</div>
      <!-- End: ANNOUNCEMENTS -->		
        </div>
    </div>
    <!-- End: MAIN CONTENT -->
    <!-- Start: FOOTER -->
       <?php include 'include/footer.php'; ?>
    <!-- End: FOOTER -->
    <script type="text/javascript" src="_public/js/jquery.min.js"></script>
    <script type="text/javascript" src="_public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="_public/js/boot-business.js"></script>
  </body>
</html>
