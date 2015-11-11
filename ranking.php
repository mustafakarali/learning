<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bootbusiness | Short description about company">
    <meta name="author" content="Your name">
    <link rel="shortcut icon" href="_public/img/favicon.ico" />
    <title>FEU Diliman | Ranking</title>
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
          
		<div class="row-fluid">                <!-- Start: PRODUCT LIST -->
				<?php
					include("include/dbcon.php");
					$btnactive = "<button class='btn btn-success btn-mini'><name='view'> View</button>";
				?>
				<div class="block">
                    <div class="bs-example">
						<ul class="nav nav-tabs" style="margin-bottom: 15px; margin-top:50px;">
							<li class="active"><a href="#top" data-toggle="tab">Overall Ranking</a></li>
							<li><a href="#over" data-toggle="tab">Top Students</a></li>
						</ul>
				<div id="myTabContent" class="tab-content">
					<div class="tab-pane fade active in" id="top">
					
						<p>                 
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>Overall Ranking</h5></div>
                                </div>
                                <div class="block-content collapse in">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="">
                                        <thead>
                                            <tr>
                                                <th>Year Level</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>First Year</td>
												<td><a href="rankingOFirst.php"><button class='btn btn-success btn-mini' name='view'> View</button></a></td>
                                            </tr>
                                            <tr>
                                                <td>Second Year</td>
												<td><a href="rankingOSecond.php"><button class='btn btn-success btn-mini' name='view'> View</button></a></td>
                                            </tr>
                                            <tr>
                                                <td>Third Year</td>
												<td><a href="rankingOThird.php"><button class='btn btn-success btn-mini' name='view'> View</button></a></td>
                                            </tr>
											<tr>
                                                <td>Fourth Year</td>
												<td><a href="rankingOFourth.php"><button class='btn btn-success btn-mini' name='view'> View</button></a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
						</p>
					</div>
				
                <div class="tab-pane fade" id="over">				
                  <p>
					<div class="row-fluid">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>Top Students</h5></div>
                                </div>
                                <div class="block-content collapse in">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example1">
                                        <thead>
                                            <tr>
                                                <th>Course Code</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
													$sql = mysql_query("SELECT DISTINCT c.course_code, d.description
													FROM tbl_class c
													JOIN tbl_course d ON d.course_code = c.course_code");
													while($row = mysql_fetch_object($sql))
													{
														echo "<tr>";
														echo "<td>" . $row->course_code . "</td>";
														echo "<td>" . $row->description . "</td>";
														echo "<td>" . "<a href=\"rankingTop.php?myVar=$row->course_code\">". $btnactive."</td>";
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
            </div>							<!-- Start: tabcontent -->
                    </div>       	<!-- Start: example -->
				</div>			<!-- Start: BLOCK -->
			</div>       <!-- End: ROW-FLUID -->				
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
