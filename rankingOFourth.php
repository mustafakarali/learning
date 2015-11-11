<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bootbusiness | Short description about company">
    <meta name="author" content="Your name">
    <link rel="shortcut icon" href="_public/img/favicon.ico" />
    <title>FEU Diliman | Overall Ranking Fourth Year</title>
    <!-- Bootstrap -->
    <link href="_public/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap responsive -->
    <link href="_public/css/bootstrap-responsive.min.css" rel="stylesheet">
    <!-- Font awesome - iconic font with IE7 support --> 
    <link href="_public/css/font-awesome.css" rel="stylesheet">
    <link href="_public/css/font-awesome-ie7.css" rel="stylesheet">
    <!-- Bootbusiness theme -->
    <link href="_public/css/boot-business.css" rel="stylesheet">
    <link href="_public/assets/styles.css" rel="stylesheet" media="screen">	
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
            <h2>Ranking</h2>
          </div>
          
        <div class="row-fluid">          
				<?php
					include("include/dbcon.php");
				?>
			<div class="block">
				<a href="ranking.php">Back</a> | Top Students
				 <div class="block-content collapse in">
				<div class="span12">
					<table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">

                                        <thead>
                                            <tr>
												<th>Grade</th>
                                                <th>Student Number</th>
												<th>First Name</th>
                                                <th>Middle Name</th>
												<th>Last Name</th>
												<th>Course</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
													$sql = mysql_query("SELECT DISTINCT s.student_id, s.first_name, s.middle_name, s.last_name, s.program, s.status, c.cgpa
													FROM tbl_achievefourth s
													JOIN tbl_cgpa c ON s.student_id = c.student_id
													WHERE s.status='1' 
													ORDER BY c.cgpa DESC ");
													while($row = mysql_fetch_array($sql))
													{
														echo "<tr>";
														echo "<td>" . $row['cgpa'] . "</td>";
														echo "<td>" . $row['student_id'] . "</td>";
														echo "<td>" . $row['first_name'] . "</td>";
														echo "<td>" . $row['middle_name'] . "</td>";
														echo "<td>" . $row['last_name'] . "</td>";
														echo "<td>" . $row['program'] . "</td>";
														echo "</tr>";
														
														
													}
													
												?>
                                        </tbody>
										
                                    </table>
          
        </div>
		</div>
      <!-- End: PRODUCT LIST -->
	  </div>
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
