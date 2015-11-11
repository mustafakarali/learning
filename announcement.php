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
      <!-- Start: PRODUCT LIST -->

        <div class="container">
          <div class="page-header">
            <h2>Announcements</h2>
          </div>
          
				<?php
					include("include/dbcon.php");
					
					$sql = mysql_query("SELECT * FROM tbl_announcement 
										 ORDER BY dated ") ;
										 
							 while($row = mysql_fetch_object($sql)){
							 $id = $row->announcement_id;
							 $dated = date("M j ", strtotime( $row->dated));
							 $string = strip_tags($row->description);
							 if (strlen($string) > 200) {
								// truncate string
								$stringCut = substr($string, 0, 250);

								// make sure it ends in a word so assassinate doesn't become ass...
								$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... '; 
							}
							
							$title = strip_tags($row->title);
							if (strlen($title) > 100) {
								// truncate string
								$stringCut = substr($title, 0, 70);

								// make sure it ends in a word so assassinate doesn't become ass...
								$title= substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
							}

		
				echo "<div class=\"row bottom-space\">";
          echo"<div class=\"span1 offset1\">";
            echo "<div class=\"circle\">";
              echo "<span class=\"event-date\">". $dated."</span>";
            echo"</div>";
          echo"</div>";
          echo"<div class=\"span9\">";
            echo"<h4>". $title. "</h4>";
            echo"<p>". $string . "<a href=\"view?myVar=$id\" style=\"color:#fff;\"> Read More</a>". "</p>";
          echo"</div>";
        echo"</div>";
		
				}
				?>

		

      <!-- End: PRODUCT LIST -->
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
