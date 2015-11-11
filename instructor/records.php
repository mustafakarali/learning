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
		$componentNames = $_REQUEST['component'];
		$totals = mysql_result(mysql_query("SELECT required_number FROM tbl_component WHERE class_id='$classID' and name='$componentNames'"),0);
							
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title><?php echo $course."-".$section;?> | Grades</title>
                <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <!-- Bootstrap -->
        <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
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
					
					for (var i=1;i<=total;i++)
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
							string += '&no'+x+'='+arr[i];
						}
						else if(i==count) {
							string += '&no'+x+'='+arr[i];
						}
						else {
							string += '&no'+x+'='+arr[i];
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
	                                    <li><a href="classlist.php">Class List</a> <span class="divider">/</span>	</li>
										<li><a href="classInformation.php">Class Information</a> <span class="divider">/</span></li> 
										<li><a href="records.php">Student Academic Record</a> <span class="divider">/</span></li>
										<li>Records</li>

	                                </ul>
                            	</div>
                        	</div>
                    	</div>
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
    	<div class="bs-example">
            <ul class="nav nav-tabs" style="margin-bottom: 15px; margin-top:50px;">
                <li class="active"><a href="#grade" data-toggle="tab">Grades</a></li>
                <li><a href="#viewing" data-toggle="tab">Viewing</a></li>
			</ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="grade">
					
                <p>        
					
					<?php
						$count = mysql_result(mysql_query("SELECT COUNT(*) FROM tbl_class_class  WHERE class_id='$classID'"),0);
						if(!($count)){
							echo 'No student for this class';
						}
						else {
					?>
					<!--Grade Component-->
					<?php
						
						if(isset($_REQUEST['component'])) {
							if($_REQUEST['component']){  
							
									$componentName = $_REQUEST['component'];
									$componentName2 = str_replace("_", " ", strtolower($componentName));
									$componentName2 = ucwords($componentName2);
									
									
								if(isset($_REQUEST['sub'])) { 
									if(isset($_POST['btnGo'])) {
										$gogo = $_POST['gogo'];
										$sql = mysql_query("SELECT * FROM tbl_class_class WHERE class_id='$classID'") or die(mysql_error());
										while($row = mysql_fetch_array($sql))
										{	
											$enrollID = $row['class_class_id'];
											mysql_query("INSERT INTO tbl_grades(component, category, class_class_id) VALUES('$componentName', '$gogo','$enrollID')");
										}
										mysql_query("INSERT INTO tbl_subcomponent(class_id, component, category) VALUES('$classID','$componentName', '$gogo')");
									}?>
									<div class="navbar navbar-inner block-header">
										<div class="muted pull-left">Create Sub-Component <?php echo $componentName2;?></div>
									</div>
									<form action="" method="post">
									<div class="block-content collapse in">
										<div class="control-group">
										<label class="control-label"><?php echo $componentName2;?></label>
                                          <div class="controls">
                                           <select name="gogo">
												<?php 
												$abc = mysql_result(mysql_query("SELECT required_number FROM tbl_defaultcomponent WHERE name='$componentName'"),0);
														for($i=1;$i<=$abc;$i++) {?>
													<option value='<?php echo $i;?>'><?php echo $i;?>
												<?php } ?>
											</select>
										  </div>
										</div>
                                          <button type="submit" class="btn btn-primary" name="btnGo">Go</button>
									</div>
									</form>
								<?php }
								else {								
								
									$total = 0;
									$sql4 = mysql_query("SELECT * FROM tbl_component WHERE class_id='$classID' AND name='$componentName'")
										or die(mysql_error()) ;
							   
									while($row = mysql_fetch_array($sql4))
									{
											$number = $row['required_number'];
											$name =  $row['name'];
											$name2 = str_replace("_", " ", strtolower($name));
											$name2 = ucwords($name2);
											$total += $row['required_number'];
									}
									$component = count($name);
									$total =  $total + $component;
									$_SESSION['total']=$total;
									
									?>
									 <div class="navbar navbar-inner block-header">
											<div class="muted pull-left">GRADES -  </div>
											<div class="muted pull-left"><?php echo " ".$componentName2;?></div>
											<div class="pull-right"><a href="records.php?component=<?php echo $componentName2;?>&sub">
											 <!-- <button class="btn" style="margin-bottom:5px;">Add Sub Component</button> -->
											</a></div>
										</div>
										<div class="block-content collapse in">
										<?php
											if(isset($_POST['btnSave'])) {
												include("includes/savegrade.php");
											}
										?>
										<form action="" method="post">
											<table class="table table-striped">
												<thead>
													<tr>
														<th><?php ?></th>
														<?php
															for($x=1;$x<$total;$x++) {
																$sql = mysql_query("SELECT * FROM tbl_subcomponent WHERE class_id='$classID' AND component='$name2' AND category='$x'");
																$Csql = mysql_num_rows($sql);
																	
																	?> <th><?php echo $name2." ".$x;?></th>
																	<?php
																
																if($Csql) {
																	for($i=1;$i<=$Csql;$i++) {
																		while($row = mysql_fetch_array($sql))
																		{
																			?> <th><?php echo $name2." ".$x.".$i";?></th> <?php
																		}
																	}
																}
															}
															echo '<th>AVERAGE</th>';
														?>
													</tr>
													<tr>
														<th>DATE</th>
														<?php
																$sql2 = mysql_query("SELECT * FROM tbl_class_class WHERE class_id='$classID' ORDER BY class_class_id ASC LIMIT 1") or die(mysql_error());
																while($row2 = mysql_fetch_array($sql2))
																{
																	$enrollID = $row2['class_class_id'];
																	for($x=1;$x<$total;$x++) {
																		$th = 1;
																		$sql = mysql_query("SELECT * FROM tbl_grades  WHERE component='$name' AND category='$x' AND class_class_id='$enrollID'")
																				or die(mysql_error()) ;
																		
																		while($row = mysql_fetch_array($sql))
																		{
																			if($row['dated']) {
																				list($year, $month, $day) = explode('-', $row['dated']);
																				$date = $month.'/'.$day.'/'.$year;
																				$gradeID = $row['grade_id'];
																				//$sql3 = mysql_query("SELECT ") or die(mysql_error());
																				$sql2 = mysql_query("SELECT activity_grade_id FROM tbl_activity_grade WHERE grade_id='$gradeID'") or die(mysql_error());
																				$num_rows = mysql_num_rows($sql2);
																				if($num_rows) {
																					?> <td>
																					<input type="text" readonly class="input-xlarge datepicker" id="date01" style="width:80px;" value="<?php echo $date;?>" name="date<?php echo $x;echo $th;?>"></input>
																					</td>
																				  <?php
																				}
																				else {
																					?> <td>
																				<input type="text" class="input-xlarge datepicker" id="date01" style="width:80px;" value="<?php echo  $date;?>" name="date<?php echo $x;echo $th;?>"></input>
																				</td>
																				<?php
																				}
																			}
																			else {
																			?> <td>
																				<input type="text" class="input-xlarge datepicker"  style="width:80px;" id="date01" value="" name="date<?php echo $x;echo $th;?>"></input>
																				</td>
																			  <?php
																			
																			}
																			$th++;
																		}
																	}
																}
																echo '<td><span class="input-mini uneditable-input"></span></td>';
																?>
													</tr>
													<tr>
														<th>NO. OF ITEMS</th>
														<?php
														$sql2 = mysql_query("SELECT * FROM tbl_class_class WHERE class_id='$classID' ORDER BY class_class_id ASC LIMIT 1") or die(mysql_error());
														while($row2 = mysql_fetch_array($sql2))
														{
															$enrollID = $row2['class_class_id'];
															for($x=1;$x<$total;$x++) {
																		$th = 1;
																	$sql = mysql_query("SELECT * FROM tbl_grades  WHERE component='$name' AND category='$x' AND class_class_id='$enrollID'")
																				or die(mysql_error()) ;
																		while($row = mysql_fetch_array($sql))
																		{
																					if(isset($_REQUEST["no$x"])) {
																					$number = $_REQUEST["no$x"];
																					?> <td><input onKeyUp="getNumber();" class="input-mini focused" id="focusedInput" type="text" value="<?php echo $number;?>" name="noOfItems<?php echo $x;echo $th;?>"></input></td>
																					<?php
																					}
																					else {
																					if($row['noOfItems']) {
																						$gradeID = $row['grade_id'];
																						$sql2 = mysql_query("SELECT activity_grade_id FROM tbl_activity_grade WHERE grade_id='$gradeID'")or die(mysql_error());
																						$num_rows = mysql_num_rows($sql2);
																						if($num_rows) {
																								?> <td><input onKeyUp="getNumber();" class="input-mini focused" id="focusedInput" type="text" value="<?php echo $row['noOfItems']; ?>" name="noOfItems<?php echo $x;echo $th;?>"></input></td>
																							<?php
																						}
																						else {
																						?> <td><input onKeyUp="getNumber();" class="input-mini focused" id="focusedInput" type="text" value="<?php echo $row['noOfItems']; ?>" name="noOfItems<?php echo $x;echo $th;?>"></input></td>
																						<?php
																						}
																					}
																					else {
																						?> <td><input onKeyUp="getNumber();" class="input-mini focused" id="focusedInput" type="text" value="<?php echo $row['noOfItems']; ?>" name="noOfItems<?php echo $x;echo $th;?>"></input></td>
																						<?php
																					}
																				}
																			$th++;
																		}
																}
															}
																echo '<td><span class="input-mini uneditable-input"></span></td>';
																?>
													</tr>
													<tr>
														<th>STUDENTS</th>
														<td colspan="<?php echo $total;?>"></td>
													</tr>
												</thead>
												<tbody>
												<?php
													$y=1;
													$sql3 = mysql_query("SELECT * FROM tbl_class_class WHERE class_id='$classID'")
																   or die(mysql_error()) ;
																   
													while($row3 = mysql_fetch_array($sql3))
													{
																	$studID[$y] = $row3['student_id'];
																	$enrollID = $row3['class_class_id'];
															
																$sql2 = mysql_query("SELECT first_name, last_name, middle_name FROM tbl_student WHERE student_id=$studID[$y]")
																			   or die(mysql_error()) ;
																			   
																while($row = mysql_fetch_array($sql2))
																{
																?> <tr>
																	<td><?php echo $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] ?></td>
																<?php
																	for($x=1;$x<$total;$x++) {
																		$rx=1;
																		$sql = mysql_query("SELECT * FROM tbl_grades WHERE component='$name' AND class_class_id='$enrollID' AND category='$x'")
																		   or die(mysql_error()) ;
																		$num_rows = mysql_num_rows($sql);

																		if($num_rows > 0){
																			$rs= 1;
																			while($row2 = mysql_fetch_array($sql))
																			{	
																				if(isset($_REQUEST["no$x"])) {
																					$number = $_REQUEST["no$x"];
																				?>
																						<td><select name="score<?php echo $y; echo $x; echo $rs;?>">
																						<option value="">
																						<?php for($i=0;$i<=$number;$i++) {?>
																						<option value="<?php echo $i;?>" <?php echo ($row2['score'] == $i) ? 'selected="selected"' : ''; ?>><?php echo $i;?>
																						<?php } ?>
																						</select></td>
																				<?php 
																				}
																				else {
																					$number = mysql_result(mysql_query("SELECT distinct(g.noOfItems) FROM tbl_grades g, tbl_class_class cc WHERE g.component='$name' AND g.category='$x' AND g.class_class_id=cc.class_class_id AND cc.class_id='$classID' AND noOfItems!=''"),0);
																					if($number!='') {
																						?> 
																						<td><select name="score<?php echo $y; echo $x; echo $rs;?>">
																						<option value="">
																						<?php for($i=0;$i<=$number;$i++) {?>
																						<option value="<?php echo $i;?>" <?php echo ($row2['score'] == $i) ? 'selected="selected"' : ''; ?>><?php echo $i;?>
																						<?php } ?>
																						</select></td>
																						<?php	
																					}else { ?>
																					<td><input class="input-mini focused" id="focusedInput" type="text" value="<?php echo $row2['score'];?>" name="score<?php echo $y; echo $x;echo$rx;?>"></input></td>
																					<?php 
																					}
																				}
																					$rs++;
																			}
																		}
																		else {
																				
																				?> <td><input class="input-mini focused" id="focusedInput" type="text" value="" name="score<?php echo $y; echo $x;echo$rx;?>"></input></td>
																				<?php
																		}
																		
																	}
																	$sql = mysql_query("SELECT * FROM tbl_grades WHERE component='$name' AND class_class_id='$enrollID' AND category='AVG'")
																		   or die(mysql_error()) ;
																		$num_rows = mysql_num_rows($sql);

																		if($num_rows > 0){
																			while($row2 = mysql_fetch_array($sql))
																			{
																				$average = $row2['score'];
																				echo "<td><span class=\"input-mini uneditable-input\">$average</span></td>";
																			}
																		}
																		else {
																			echo "<td><span class=\"input-mini uneditable-input\"></span></td>";
																		}
																		
																	
																}
															$y++;
													}
													$_SESSION['y'] =$y;
												?>
													<tr>
														<td></td>
														<td colspan="<?php echo $total?>"><p align="right"><input type="submit" value="Save" name="btnSave" style="width:150px"></input></p></td>
												   </tr>
												   <tr>
														<td  colspan="<?php echo $total?>" align="center"><br><?php if(isset($_POST['btnSave'])) { echo $msg;}?></td>
												   </tr>
												</tbody>
											</table>
											</form>
								<?php
								}
							}
						}
						else {
							
							$i = 1;
							$total = 0;
							$sql4 = mysql_query("SELECT * FROM tbl_component WHERE class_id='$classID'")
										   or die(mysql_error()) ;
										   
							while($row = mysql_fetch_array($sql4))
							{
									$number[$i] = $row['required_number'];
									$name[$i] =  $row['name'];
									$name2[$i] = str_replace("_", " ", strtolower($name[$i]));
									$name2[$i] = ucwords($name2[$i]);
									$total += $row['required_number'];
									$i++;
									
							}
							$component = count($name);
							$total =  $total + $component;
					?>
								
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Grades</div>
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
											<tr>
												<th>COMPONENTS</th>
												<?php
													echo '<th align="center" width="">GRADE</a></th>';
													echo '<th align="center" width="">GRADE</a></th>';
													for($x=1;$x<=$component;$x++) {
														if($name2[$x]=='Attendance') {
														?> <th align="center" width=""><a href="attendance.php"><?php echo $name2[$x]?></a></th>
														<?php
														}
														else {
														?> <th align="center" width=""><a href="records.php?component=<?php echo $name[$x]?>"><?php echo $name2[$x]?></a></th>
														<?php
														}
													}
												?>
											</tr>
                                            <tr>
                                                <th>STUDENTS</th>
												<td align="center" width="" colspan="<?php echo $total;?>"></td>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
											$y=0;
											$sql3 = mysql_query("SELECT * FROM tbl_class_class WHERE class_id='$classID'")
														   or die(mysql_error()) ;
														   
											while($row = mysql_fetch_array($sql3))
											{
													$studID[$y] = $row['student_id'];
													$enrollID = $row['class_class_id'];
													
														$z=0;
														$sql2 = mysql_query("SELECT first_name, last_name, middle_name FROM tbl_student WHERE student_id=$studID[$y]")
																	   or die(mysql_error()) ;
																	   
														while($row = mysql_fetch_array($sql2))
														{
														?> <tr>
															<td width="" align="center"><?php echo $row['last_name'] . ", " . $row['first_name'] . " " . $row['middle_name'] ?></td>
														<?php
														}
															for($x=0;$x<=$component;$x++) {
																
																if($x!=0) {
																	$Cname = $name[$x];
																	$sql7 = mysql_query("SELECT * FROM tbl_grades WHERE class_class_id='$enrollID' and component='$Cname' AND category='AVG'")
																		or die(mysql_error()) ;
																	$num_rows2 = mysql_num_rows($sql7);

																	if($num_rows2 > 0){
																		while($row7 = mysql_fetch_array($sql7))
																		{	 
																			?> <td align="center" width=""><span class="input-mini uneditable-input"><?php echo $row7['score'];?></span></td>
																		<?php
																		}
																	}
																	else {
																			?> <td align="center" width=""><span class="input-mini uneditable-input"></span></td>
																			<?php
																		}
																}
																else { 
																		
																	$sql = mysql_query("SELECT * FROM tbl_finalgrade WHERE class_class_id='$enrollID'")
																		or die(mysql_error()) ;
																	
																	$num_rows = mysql_num_rows($sql);

																	if($num_rows > 0){
																		while($row = mysql_fetch_array($sql))
																			{
																			?> <td align="center" width=""><span class="input-mini uneditable-input"><?php echo $row['grade'];?></span></td>
																				<td align="center" width=""><span class="input-mini uneditable-input"><?php echo $row['gpa'];?></span></td>
																			<?php	
																		}
																	}
																	else {
																		?>	<td align="center" width=""><span class="input-mini uneditable-input"><?php echo $row['grade'];?></span></td>
																			 <td align="center" width=""><span class="input-mini uneditable-input"><?php echo $row['gpa'];?></span></td>
																		<?php	
																	}
																	
																}
															} 
														
													$y++;
											}
										?>
                                           
                                        </tbody>
                                    </table>
									
					<?php	} 
					}?>
									
								</p>
				
					</div>	  
                </div>
				<!--End of Grade Component-->
				<?php
				include("includes/viewing.php");
				?>
				<div class="tab-pane fade" id="viewing">
					
					<p> 
							<div class="block-content collapse in">
									<tr>
										<td>
                    <div class="row-fluid">
					<?php
                        echo"<div class=\"span6\">";
                            echo"<div class=\"block\">";
                                echo"<div class=\"navbar navbar-inner block-header\">";
                                    echo"<div class=\"muted pull-left\"><h4>Request(s) for Viewing</h4></div>";
                                    echo"<div class=\"pull-right\"><span class=\"badge badge-info\">$notif_req</span>";

                                    echo"</div>";
                                echo"</div>";
                                echo"<div class=\"block-content collapse in\">";
                                    echo"<table class=\"table table-striped\">";
					$sql = mysql_query("SELECT s.first_name, s.last_name, c.class_id, r.request_date, r.request_time, r.status, r.request_id FROM tbl_request r, tbl_class_class cc, tbl_class c, tbl_student s WHERE r.class_class_id=cc.class_class_id AND c.class_id='$classID' AND cc.student_id=s.student_id")or die(mysql_error());
					$count = mysql_num_rows($sql);
					if($count) {
					echo"<thead>";
                                            echo"<tr>";
                                                echo"<th>Name</th>";
                                                echo"<th>Time</th>";
												echo"<th>Action</th>";
                                            echo"</tr>";
                                        echo"</thead>";
						while($row = mysql_fetch_array($sql)) {
							$reqID = $row['request_id'];
									
                                        
                                        echo"<tbody>";
                                            echo"<tr>";
                                                echo"<td>".$row['last_name'].', '.$row['first_name'].' '."</td>";
                                                echo"<td>".$row['request_date'].' | '. $row['request_time']."</td>";
												if($row['status']==0) {
                                                echo"<td>"."<a href='records.php?class=".$classID."&request=".$reqID."'><button class='btn btn-success btn-mini'>Allow</button></a>"."</td>";												
												}
												else {
                                                echo"<td>Allowed</td>";												
												}
                                            echo"</tr>";
					
						}
					}
					else {
                                            echo"<tr>";
                                                echo"<td colspan=\"3\">No Request(s)</td>";
                                            echo"</tr>";
					
					}					
                                        echo"</tbody>";
                                    echo"</table>";
                                echo"</div>";
                            echo"</div>";
                        echo"</div>";
                        echo "<div class=\"span6\">";
                            echo "<div class=\"block\">";
                                echo "<div class=\"navbar navbar-inner block-header\">";
                                    echo "<div class=\"muted pull-left\"><h4>History of Viewing</h4></div>";
                                echo "</div>";
                                echo "<div class=\"block-content collapse in\">";
                                    echo"<table class=\"table table-striped\">";
											$sql = mysql_query("SELECT * FROM tbl_viewing WHERE class_id='$classID'")or die(mysql_error());
											$count = mysql_num_rows($sql);
											if($count) {
										echo"<thead>"; echo"<tr>";
                                                echo"<th colspan=\"2\">Available From</th>";
                                                echo"<th colspan=\"2\">Available Until</th>";
												echo"<th>Status</th>";
                                            echo"</tr>";
                                        echo"</thead>";
										while($row = mysql_fetch_array($sql)) {
                                           
                                        echo"<tbody>";
                                            echo"<tr>";
                                                echo"<td>".$row['start_day']."</td>";
                                                echo"<td>".$row['start_time']."</td>";
                                                echo"<td>".$row['end_day']."</td>";
                                                echo"<td>".$row['end_time']."</td>";
													if($row['status']==1) {
                                                echo"<td>".'Available'."</td>";												
													}
													else {
                                                echo"<td>".'Expired'."</td>";												
													}
												}
											echo"</tr>";	
											}												
                                            
											else {
												echo"<tr>";
                                                echo"<td colspan=\"5\">No History of Viewing</td>";
												echo"</tr>";
											}
                                        echo"</tbody>";
                                    echo"</table>";
                                echo"</div>";
                            echo"</div>";
                        echo"</div>";
											
											?>
											
					
                    </div>
					</td>
									</tr>
							<tr>
							<td>
												<div class="row-fluid">
							<div class="block">
							<div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Set Viewing</div>
                            </div>
							                            <div class="block-content collapse in">												
						<div class="span12">

								<form action="" method="post" class="form-horizontal" style="overflow:auto;">							
								<?php 
												if(isset($_POST['btnSet'])) { 
													 ?>
													<div class="control-group">
													  <label class="control-label" for="date01">Available from</label>
													  <div class="controls">
														<input type="text" class="input-xlarge datepicker" id="date01" value="<?php if(isset($_POST['btnSetViewing'])) { echo $date; }?>" name="date">
													  </div>
													 </div>
													<div class="control-group"> 
													  <label class="control-label" for="date01">Hour</label>													
													  <div class="controls">
														<select name="hour">
															<?php for($i=1;$i<=24;$i++) {
																$i = sprintf("%02s", $i);?>
																<option value='<?php echo $i;?>'<?php if(isset($_POST['btnSetViewing'])) { if($_POST['hour'] =="$i"): ?> selected="selected"<?php endif; }?>><?php echo $i;?>
															<?php } ?>
														</select>
													  </div>
													  </div>
													  <div class="control-group">
													  <label class="control-label" for="date01">Minute</label>													  
													  <div class="controls">
														<select name="minute">
															<?php for($i=0;$i<=59;$i++) {
																	$i = sprintf("%02s", $i);?>
																<option value='<?php echo $i;?>'<?php if(isset($_POST['btnSetViewing'])) { if($_POST['minute'] =="$i"): ?> selected="selected"<?php endif; }?>><?php echo $i;?>
															<?php } ?>
														</select>
													  </div>
													  </div>
													<div class="control-group">
													  <label class="control-label" for="date01">Available Until:</label>
													  <div class="controls">
														<input type="text" class="input-xlarge datepicker" id="date01" value="<?php if(isset($_POST['btnSetViewing'])) { echo $date; }?>" name="date2">
													  </div>
													 </div>
													<div class="control-group"> 
													  <label class="control-label" for="date01">Hour</label>													
													  <div class="controls">
														<select name="hour2">
															<?php for($i=1;$i<=24;$i++) {
																$i = sprintf("%02s", $i);?>
																<option value='<?php echo $i;?>'<?php if(isset($_POST['btnSetViewing'])) { if($_POST['hour'] =="$i"): ?> selected="selected"<?php endif; }?>><?php echo $i;?>
															<?php } ?>
														</select>
													  </div>
													  </div>
													<div class="control-group">  
													  <label class="control-label" for="date01">Minute</label>													
													  <div class="controls">
														<select name="minute2">
															<?php for($i=0;$i<=59;$i++) {
																	$i = sprintf("%02s", $i);?>
																<option value='<?php echo $i;?>'<?php if(isset($_POST['btnSetViewing'])) { if($_POST['minute'] =="$i"): ?> selected="selected"<?php endif; }?>><?php echo $i;?>
															<?php } ?>
														</select>
													  </div>
													  </div>
													  <input type="submit" value="Set Viewing" class="btn btn-primary" name="btnSetViewing"></input>
												<?php	}
												else {
													echo "<input type=\"submit\" value=\"Set Viewing\" class=\"btn btn-primary\" name=\"btnSet\"></input>";
												}
											?>
										</form>
								</div>			
							</div>
						</div>
					</div>
							</td>
							
							</tr>	
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
    </body>

</html>

<?php
}
?>