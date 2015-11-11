<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bootbusiness | Short description about company">
    <meta name="author" content="Your name">
    <title>FEU Diliman: Transforming Lives.</title>
    <link rel="shortcut icon" href="_public/img/favicon.ico" />
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
      <!-- Start: slider -->
      <div class="slider">
        <div class="container-fluid">
          <div id="heroSlider" class="carousel slide">
            <div class="carousel-inner">
              <div class="active item">
                <div class="hero-unit">
                  <div class="row-fluid">
                    <div class="span12 marketting-info">
							<center><img src="_public/img/1.jpg" class="thumbnail"></center>
                    </div>

                  </div>                  
                </div>
              </div>
              <div class="item">
                <div class="hero-unit">
                  <div class="row-fluid">
                    <div class="span12 marketting-info">
                      <center><img src="_public/img/4.jpg" class="thumbnail"></center>                      
                    </div>
                  </div>                  
                </div>
              </div>
              <div class="item">
                <div class="hero-unit">
                  <div class="row-fluid">
                    <div class="span12 marketting-info">
                      <center><img src="_public/img/6.jpg" class="thumbnail"></center>                                        
                    </div>
                  </div>                  
                </div>
              </div>
              <div class="item">
                <div class="hero-unit">
                  <div class="row-fluid">
                    <div class="span12 marketting-info">
                      <center><img src="_public/img/7.jpg" class="thumbnail"></center>                                       
                    </div>
                  </div>                  
                </div>
              </div>
            </div>
            <a class="left carousel-control" href="#heroSlider" data-slide="prev">‹</a>
            <a class="right carousel-control" href="#heroSlider" data-slide="next">›</a>
          </div>
        </div>
      </div>
      <!-- End: slider -->
      <!-- Start: PRODUCT LIST -->
        <div class="container">
          <div class="row-fluid">
            <ul class="thumbnails">
              <li class="span8">
                <div class="thumbnail">
                  <div class="caption">
					<?php 
							include ("include/dbcon.php");
							$sql = mysql_query("SELECT * FROM tbl_announcement where dated >= now()
							ORDER BY dated DESC LIMIT 1");
							while($row = mysql_fetch_object($sql))
							{
							$id = $row->announcement_id;
							$dated = date("M j ", strtotime( $row->dated));
							$string = strip_tags($row->description);
							if (strlen($string) > 100) {
								// truncate string
								$stringCut = substr($string, 0, 100);

								// make sure it ends in a word so assassinate doesn't become ass...
								$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... '; 
							}
							
							$title = strip_tags($row->title);
							if (strlen($title) > 100) {
								// truncate string
								$stringCut = substr($title, 0, 100);

								// make sure it ends in a word so assassinate doesn't become ass...
								$title= substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
							}
								
							} 
						
        echo"<h3>" ."<a href=\"announcement\" style=\"color:#FBCA36;\">Announcements</a>"."</h3>";					
		echo "<div class=\"row bottom-space\">";
          echo"<div class=\"span1 offset1\">";
            echo "<div class=\"circle\">";
              echo "<span class=\"event-date\">".$dated."</span>";
            echo"</div>";
          echo"</div>";
          echo"<div class=\"span4\" style=\"margin-left:10%;\">";
            echo"<h5>". $title. "</h5>";
            echo"<p>". $string. "<a href=\"view?myVar=$id\" style=\"color:#000;\"> Read More</a>". "</p>";
          echo"</div>";
        echo"</div>";
					?>
                  </div>
                </div>
              </li>
              <li class="span4">
                <div class="thumbnail">
                  <div class="caption">
              
                  </div>
                  <div>
						<a href="../mobile/FEU-FERNCollegeAPMS.apk"><img src="_public/images/f.png"></a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
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