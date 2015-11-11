<?php
	session_start();
include("includes/dbcon.php");
if(isset($_SESSION['login'])) {

?>
<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Administrator | Homepage</title>
                    <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <!-- Bootstrap -->
        <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="../_public/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="../_public/http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="../_public/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    
    <body>
<?php include 'includes/navbar.php'; ?>
        <div class="container-fluid">
            <div class="row-fluid">
<?php include 'includes/sidebar.php'; ?>
                
                <!--/span-->
                <div class="span9" id="content">


                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Homepage</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="row-fluid padd-bottom">
                                  <div class="span3">
                                      <a href="user.php" class="thumbnail">
                                        <img alt="260x180" title="User Account Manager"data-src="../_public/holder.js/260x180"  style="width: 200px; height: 200px;" src="../_public/images/clipboard.png">
                                      </a>
                                  </div>
                                  <div class="span3">
                                      <a href="achieve.php" class="thumbnail">
                                        <img alt="260x180" title="Achievement Board" data-src="../_public/holder.js/260x180"  style="width: 200px; height: 200px;" src="../_public/images/calendar.png">
                                      </a>
                                  </div>
                                  <div class="span3">
                                      <a href="announce.php" class="thumbnail">
                                        <img alt="260x180" title="Announcement Board" data-src="../_public/holder.js/260x180"  style="width: 200px; height: 200px;" src="../_public/images/time.png">
                                      </a>
                                  </div>
                                  <div class="span3">
                                      <a href="component.php" class="thumbnail">
                                        <img alt="260x180" title="Grade Component and Attendance Editor" data-src="../_public/holder.js/260x180"  style="width: 200px; height: 200px;" src="../_public/images/book.png">
                                      </a>
                                  </div>
                                </div>

                                <div class="row-fluid padd-bottom">
                                  <div class="span3">
                                      <a href="report.php" class="thumbnail">
                                        <img alt="260x180" title="Export Data" data-src="../_public/holder.js/260x180"  style="width: 200px; height: 200px;" src="../_public/images/mail.png">
                                      </a>
                                  </div>
                                  <div class="span3">
                                      <a href="content.php" class="thumbnail">
                                        <img alt="260x180" title="Content Management" data-src="../_public/holder.js/260x180"  style="width: 200px; height: 200px;" src="../_public/images/colors.png">
                                      </a>
                                  </div>
                                  <div class="span3">
                                      <a href="class.php" class="thumbnail">
                                        <img alt="260x180" title="Add Class"data-src="../_public/holder.js/260x180"  style="width: 200px; height: 200px;" src="../_public/images/paper.png">
                                      </a>
                                  </div>
                                  <div class="span3">
                                      <a href="upload.php" class="thumbnail">
                                        <img  alt="260x180" title="Upload CSV File"data-src="../_public/holder.js/260x180" style="width: 200px; height: 200px;" src="../_public/images/retina.png">
                                      </a>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
            </div>
        </div>
<?php include 'includes/footer.php'; ?>
        <!--/.fluid-container-->
        <script src="../_public/vendors/jquery-1.9.1.min.js"></script>
        <script src="../_public/bootstrap/js/bootstrap.min.js"></script>
        <script src="../_public/vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="../_public/assets/scripts.js"></script>
        <script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000});
        });
        </script>
    </body>

</html>
<?php
	}else{
		header("location:index.php");
	}
?>
