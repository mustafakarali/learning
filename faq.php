<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bootbusiness | Short description about company">
    <meta name="author" content="Your name">
        <link rel="shortcut icon" href="_public/img/favicon.ico" />
        <title>FEU Diliman | Frequently Asked Questions</title>
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

          <h1>Frequently asked questions</h1>
        </div> 
				<?php
					include("include/dbcon.php");
					
					$sql = mysql_query("SELECT * FROM tbl_faq 
										 ORDER BY faq_id ASC") ;
										 
							 while($row = mysql_fetch_object($sql)){
							 $id = $row->faq_id;
							 $title = $row->title;
							 $answer = $row->answer;							 
		
        echo "<div class=\"row\">";
          echo "<div class=\"span10 offset1\">";
            echo "<div class=\"accordion\" id=\"faqAccordion\">";
              echo "<div class=\"accordion-group\">";
                echo "<div class=\"accordion-heading\">";
                  echo "<h4>";
                    echo "<a class=\"accordion-toggle\" data-toggle=\"collapse\" data-parent=\"#faqAccordion\" href=\"_public/#$row->faq_id\">";
                      echo "<i class=\"icon-question-sign\" style=\"color:#fff;\">". $title."</i>";
                    echo "</a>";
                  echo"</h4>";
                echo"</div>";
                echo "<div id=\"$row->faq_id\" class=\"accordion-body collapse in\">";
                  echo "<div class=\"accordion-inner\">";
                    echo "<p>".$answer. "</p>";
                  echo "</div>";
                echo "</div>";
              echo "</div>";

            echo "</div>";
          echo "</div>";
        echo "</div>";
		}
	?>	
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