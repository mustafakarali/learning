<?php
	session_start();
	include("includes/dbcon.php");
	if(!($_SESSION['login'])) {
		header("Location: index.php");
	}
	else {												
$btnactive = "<button class='btn btn-success btn-mini'><name='view'> View</button>";

?>
<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Administrator | Archive of Grades</title>
                    <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <!-- Bootstrap -->
		<link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="../_public/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
        <link href="../_public/assets/DT_bootstrap.css" rel="stylesheet" media="screen">        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
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
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href="dashboard.php">Dashboard</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li>Archive of Grades</li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            	<div class="bs-example">
              <div id="myTabContent" class="tab-content">
				
                <div class="tab-pane fade active in" id="over">				
                  <p>
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>Previous Batches</h5></div>
                                </div>
                                <div class="block-content collapse in">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example1">
                                        <thead>
                                            <tr>
                                                <th>Number of Batch</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
													$sql = mysql_query("SELECT sy FROM tbl_batch where status='0'");
													while($row = mysql_fetch_object($sql))
													{
														echo "<tr>";
														echo "<td>" . $row->sy . "</td>";
														echo "<td>" . "<a href=\"archiveGrades.php?myVar=$row->sy\">". $btnactive."</td>";
														echo "</tr>";
													}
												?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>				  
				  </p>
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
		
		
        <script src="../_public/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<script src="../_public/assets/DT_bootstrap.js"></script>
        
		<script>
        $(function() {
            
        });
        </script>
    </body>

</html>
<?php 
}
?>