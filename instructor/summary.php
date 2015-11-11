<?php
	session_start();
	error_reporting(0);
	include("../include/dbcon.php");
	date_default_timezone_set('Etc/GMT'); 
	
	if(!($_SESSION['login'])) {
		header("Location: ../instructor.php");
	}
	else {
		$insID  = $_SESSION['username'];
		include("includes/classMenu.php");			
?>

<!DOCTYPE html>
<html>
    
    <head>

        <title><?php echo $course."-".$section;?> | Grades</title>
                <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <!-- Bootstrap -->
        <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="../_public/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
         <link href="../_public/assets/DT_bootstrap.css" rel="stylesheet" media="screen">        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="vendors/flot/excanvas.min.js"></script><![endif]-->
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="../_public/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>

		<script language="javascript">
			function getNumber(){
					var total = "<?php echo $totals; ?>";
					var arr = [];
					for (var i=1;i<total;i++)
					{ 
						var name = "noOfItems"+i+"1";
						var number = document.getElementsByName(name)[0].value;
						if(number!='') {
							arr.push(number);
						}
					}
					var url = document.URL;
					var range_check = /[?&]component=([^&]+)/i;
					var match = range_check.exec(url);
					if (match != null) {
						range = "component=" + match[1];
					} 
					var count = arr.length-1;
					var string = '';
					var x = 0;
					for(var i=0;i<=count;i++) {
						x++;
						if(i==0) {
							string += '&no'+x+'='+arr[i]+'&';
						}
						else if(i==count) {
							string += '&no'+x+'='+arr[i];
						}
						else {
							string += '&no'+x+'='+arr[i]+'&';
						}
					}
					window.location = "records.php?"+range+string;
			}
		</script>
    </head>
    
    <body>
<?php include 'includes/navbar.php'; ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <!--/span-->
                <div class="span12" id="content">
                    <div class="row-fluid">
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href="classList.php">Class List</a> <span class="divider">/</span>	
	                                    </li>
										<li>
	                                        <a href="classInformation.php">Class Information</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li>Student Academic Record Summary</li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
            <div id="myTabContent" class="tab-content">
                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Student Academic Record Summary</div>
                                    <div class="pull-right">
										<a href="upload.php">
										</a>
                                    </div>
                                </div>
                                <div class="block-content collapse in span12" style="padding-right:.2cm;">
                                     <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example" style="overflow:auto;" >

                                        <thead>
                                            <tr>
                                                <th>Student No.</th>
                                                <th>Name</th>
												<th>Grade</th>
                                                <th>Grade</th>
												<?php
													$sql = mysql_query("SELECT * FROM tbl_defaultcomponent");
													while($row = mysql_fetch_array($sql)) {
														$name = $row['name'];
														$req_num = $row['required_number'];
														
														if($req_num!=1) {
															for($i=1;$i<=$req_num;$i++) {
																echo "<th>$name-$i</th>";
															}
														}
														else {
															echo "<th>$name</th>";
														}
													}
												?>
                                            </tr>
                                        </thead>
											<tbody >
												<?php
													$sql = mysql_query("SELECT * FROM tbl_class_class WHERE class_id='$classID'");
													while($row = mysql_fetch_array($sql)) {
														$stud = $row['student_id'];
														$stud_class_id = $row['class_class_id'];
														
														$sql2 = mysql_query("SELECT * FROM tbl_student WHERE student_id='$stud'");
														while($row2 = mysql_fetch_array($sql2)) {
															$name = $row2['last_name']. ', '.$row2['first_name'];
														}
														
														$sql3 = mysql_query("SELECT * FROM tbl_finalgrade WHERE class_class_id='$stud_class_id'");
														while($row3 = mysql_fetch_array($sql3)) {
															$grade = $row3['grade'];
															$gpa = $row3['gpa'];
														}
														
														echo "<tr>";
															echo "<td>$stud</td>";
															echo "<td>$name</td>";
															if($gpa=="0.0") {
																echo "<td><font color=\"red\">$gpa</font></td>";
																echo "<td><font color=\"red\">$grade</font></td>";
															}
															else {
																echo "<td>$gpa</td>";
																echo "<td>$grade</td>";
															}
														
														$sql4 = mysql_query("SELECT * FROM tbl_defaultcomponent");
														while($row4 = mysql_fetch_array($sql4)) {
															$name = $row4['name'];
															$req_num = $row4['required_number'];
															
															for($i=1;$i<=$req_num;$i++) {
																$sql5 = mysql_query("SELECT * FROM tbl_grades WHERE component='$name' AND category='$i' AND class_class_id='$stud_class_id'");
																while($row5 = mysql_fetch_array($sql5)) {
																	$score = $row5['score'];
																	$noOfItems = $row5['noOfItems'];
																	
																	$check = ($score/$noOfItems)*100;
																	if($check<70) {
																		echo "<td><font color=\"red\">$score</font></td>";
																	}
																	else {
																		echo "<td>$score</td>";
																	}
																}
															}
														}
														echo "</tr>";
														
													}
												?>
											</tbody>
                                    </table>
                                </div>
            </div>
                        
                        <!-- /block -->
                    </div>


                </div>
            </div>
		</div>
        </div>
        <!--/.fluid-container-->
        <link href="../_public/vendors/datepicker.css" rel="stylesheet" media="screen">
        <link href="../_public/vendors/uniform.default.css" rel="stylesheet" media="screen">
        <link href="../_public/vendors/chosen.min.css" rel="stylesheet" media="screen">

        <link href="../_public/vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">

        <script src="../_public/vendors/jquery-1.9.1.js"></script>
        <script src="../_public/bootstrap/js/bootstrap.min.js"></script>
        <script src="../_public/vendors/jquery.uniform.min.js"></script>
        <script src="../_public/vendors/chosen.jquery.min.js"></script>
        <script src="../_public/vendors/bootstrap-datepicker.js"></script>

        <script src="../_public/vendors/wysiwyg/wysihtml5-0.3.0.js"></script>
        <script src="../_public/vendors/wysiwyg/bootstrap-wysihtml5.js"></script>

        <script src="../_public/vendors/wizard/jquery.bootstrap.wizard.min.js"></script>


        <script src="../_public/assets/scripts.js"></script>
        <script>
        $(function() {
            $(".datepicker").datepicker();
            $(".uniform_on").uniform();
            $(".chzn-select").chosen();
            $('.textarea').wysihtml5();

            $('#rootwizard').bootstrapWizard({onTabShow: function(tab, navigation, index) {
                var $total = navigation.find('li').length;
                var $current = index+1;
                var $percent = ($current/$total) * 100;
                $('#rootwizard').find('.bar').css({width:$percent+'%'});
                // If it's the last tab then hide the last button and show the finish instead
                if($current >= $total) {
                    $('#rootwizard').find('.pager .next').hide();
                    $('#rootwizard').find('.pager .finish').show();
                    $('#rootwizard').find('.pager .finish').removeClass('disabled');
                } else {
                    $('#rootwizard').find('.pager .next').show();
                    $('#rootwizard').find('.pager .finish').hide();
                }
            }});
            $('#rootwizard .finish').click(function() {
                alert('Finished!, Starting over!');
                $('#rootwizard').find("a[href*='tab1']").trigger('click');
            });
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