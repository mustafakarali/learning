<?php
	session_start();
	include("includes/dbcon.php");
	
	if(!($_SESSION['login'])) {
		header("Location: index.php");
	}
	else {
?>
<!DOCTYPE html>
<html>
    
    <head>
        <title>Administrator | Grade Component and Attendance Editor</title> <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <!-- Bootstrap --> <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen"> <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="vendors/flot/excanvas.min.js"></script><![endif]-->
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="../_public/http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="../_public/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        	<script src="../_public/https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> <!-- or use local jquery -->
	<script src="../_public/js/jqBootstrapValidation.js"></script>
	<script>
	  $(function () {
	  $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
	</script>
    </head>
    <script type="text/javascript">
    $("#btnAdd").click(function () {
		document.write("Hello");
  $("#container").append('<div class="control-group"><div class="controls"><input type="text" id="typeahead"  name="name<?php echo $i;?>" value="<?php if(isset($_POST['btnSetComp'])) { echo $name[$i]; }?>" 	data-provide="typeahead" data-items="4" placeholder="Component Name"></input><input type="text" id="typeahead"  name="req<?php echo $i;?>"		value="<?php if(isset($_POST['btnSetComp'])) { echo $req[$i]; }?>"	data-provide="typeahead" data-items="4" placeholder="Required Number"></input<input type="text" id="typeahead"  name="percent<?php echo $i;?>"	value="<?php if(isset($_POST['btnSetComp'])) { echo $percent[$i]; }?>"	data-provide="typeahead" data-items="4" placeholder="Percentage"></input></div></div>');
});
</script>
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
	                                        <a href="dashboard.php">Homepage</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li>Grade Component and Attendance Editor</li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            	<div class="bs-example">
            <ul class="nav nav-tabs" style="margin-bottom: 15px; margin-top:50px;">
                <li class="active"><a href="#grade" data-toggle="tab">Grade Component</a></li>
                <li><a href="#attendance" data-toggle="tab">Attendance Editor</a></li>
			</ul>
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="grade">
					
                <p>             
					<?php
						$rows = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_defaultcomponent'), 0); 

						if ($rows) { ?>
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                </div>
                                <div class="block-content collapse in">
                                    <form class="form-horizontal">
                                      <fieldset>
                                        <legend>Grade Component</legend>
									<?php
										  $result = mysql_query("SELECT * FROM tbl_defaultcomponent") or dire(mysql_error());
										  while($row = mysql_fetch_array($result)){
													$n = $row['name'];
													$n = str_replace("_", " ", strtolower($n));
													$n = ucwords($n);
													//echo "<tr align=\"center\"><td width=\"150px\">".$n."</td><td width=\"150px\">".$row['required_number']."</td><td width=\"150px\">".$row['percentage']."</td></tr>";
											?>
											
												<div class="control-group">
												 <label class="control-label" for="typeahead"><?php echo $n;?></label>
												  <div class="controls">	
													<span class="input-mini uneditable-input"><?php echo $row['required_number'];?></span>		
													<span class="input-mini uneditable-input"><?php echo $row['percentage'];?>%</span>									
												  </div> 
												</div>
											<?php
											}
										?>
											<div class="control-group">
												 <label class="control-label" for="typeahead"><b>Total:</b></label>
												  <div class="controls">
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<span class="input-mini uneditable-input">100%</span>									
												  </div> 
												</div>
                                      </fieldset>
                                    </form>
                                </div>
                            </div>
				<?php  }
				else { ?>
				 <div class="block">
                                <div class="block-content collapse in">
                                    <form class="form-horizontal" action="" method="post">
                                      <fieldset>
                                        <legend>Create Grade Component</legend>
										<?php 
					if(isset($_POST['btnSetComp'])) {
						$num = $_POST['number'];
						$percentage = 0;
						$error=0;
						$i=0;
						$count=0;
						$check[$i] = '';
						for($i=1;$i<=$num;$i++) {
							$name[$i] = $_POST["name$i"];
							$req[$i] = $_POST["req$i"];
							$percent[$i] = $_POST["percent$i"];
							
							if($req[$i]!='' || $percent[$i]!='') {
								$count++;
								if($name[$i]=='') {
									$error=1;
									$msg[$i] = '<div class="alert alert-error" style="min-width:30px;margin-right:10%;margin-top:1%;">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Error!</strong> Please fill out this filled.
									</div>';
								}
								else if($percent[$i]=='') {
									$error=1;
									$msg[$i] = '<div class="alert alert-error" style="min-width:30px;margin-right:10%;margin-top:1%;">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Error!</strong> Please fill out this filled.
									</div>';
								}
								else if($req[$i]=='') {
									$error=1;
									$msg[$i] = '<div class="alert alert-error" style="min-width:30px;margin-right:10%;margin-top:1%;">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Error!</strong> Please fill out this filled.
									</div>';
								}
								else {
									if(!preg_match('/^[0-9\s]+$/',$req[$i])) {
										$error=1;
										$msg[$i] = '<div class="alert alert-error" style="min-width:30px;margin-right:10%;margin-top:1%;">>
										<button class="close" data-dismiss="alert" style="min-width:50px;">&times;</button>
										<strong>Error!</strong> Must contain a number.
									</div>';
									}
									else if(!preg_match('/^[0-9\s]+$/',$percent[$i])) {
										$error=1;
										$msg[$i] = '<div class="alert alert-error" style="min-width:30px;margin-right:10%;margin-top:1%;">>
										<button class="close" data-dismiss="alert" style="min-width:50px;">&times;</button>
										<strong>Error!</strong> Must contain a number.
									</div>';
									}
								}
							}
							else if($name[$i]!='') {
								if($req[$i]=='') {
									$error=1;
									$msg[$i] = '<div class="alert alert-error" style="min-width:30px;margin-right:10%;margin-top:1%;">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Error!</strong> Please fill out this filled.
									</div>';
								}
								else if($percent[$i]=='') {
									$error=1;
									$msg[$i] = '<div class="alert alert-error" style="min-width:30px;margin-right:10%;margin-top:1%;">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Error!</strong> Please fill out this filled.
									</div>';
								}
								
							}
								else if($name[$i]=='Attendance') {
									if($req[$i]>1) {
										$error=1;
										$msg[$i] = '<div class="alert alert-error" style="min-width:30px;margin-right:10%;margin-top:1%;">>
										<button class="close" data-dismiss="alert" style="min-width:50px;">&times;</button>
										<strong>Error!</strong> Input is more than one.
									</div>';
									}
								}
							else {
							$percentage += $percent[$i];
							}
							if (in_array($name[$i], $check)) {
								if($name[$i]!='') {
									$error=1;
									$msg[$i] = "<div class=\"alert alert-error\"  style=\"min-width:30px;margin-right:10%;margin-top:1%;\">
										<button class=\"close\" data-dismiss=\"alert\">&times;</button>
										<strong>Error!</strong> Duplicate $name[$i]
									</div>";
								}
							}
							else {
								$check[$i] = $name[$i];
							}
							$pc = intval($percent[$i]);
							$percentage += $pc;
						}
						if($error==0) {
							if($percentage==0) {
								echo '<div class="alert">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Warning!</strong> No component set.
									</div>';
							}
							else if($percentage!=100) {
								echo '<div class="alert">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Warning!</strong> Must be equal to 100.
									</div>';
							} 
							else {
								for($x=1;$x<=$count;$x++) {
									if($name[$x]==''){
										continue;
									} 
									else {
										$sql = mysql_query("SELECT class_id FROM tbl_class");
												while($row = mysql_fetch_array($sql))
												{
													$id = $row['class_id'];
														$number = $req[$x];
														mysql_query("INSERT INTO tbl_component (name, required_number, percentage, class_id) VALUES ('$name[$x]','$req[$x]','$percent[$x]','$id')") or die(mysql_error());
														$sql2 = mysql_query("SELECT class_class_id FROM tbl_class_class WHERE class_id='$id'");
														while($row2 = mysql_fetch_array($sql2))
														{
															$enrollID = $row2['class_class_id'];
															for($i=1;$i<=$number;$i++)  {
																mysql_query("INSERT INTO tbl_grades (component, category, class_class_id) VALUES ('$name[$x]','$i','$enrollID')") or die(mysql_error());
															}
																mysql_query("INSERT INTO tbl_grades (component, category, class_class_id) VALUES ('$name[$x]','AVG','$enrollID')") or die(mysql_error());
														}
												}
										mysql_query("INSERT INTO tbl_defaultcomponent (name, required_number, percentage) VALUES ('$name[$x]','$req[$x]','$percent[$x]')") or die(mysql_error());
									}
									
								}
											
								echo'<script> window.location="component.php"; </script> ';
							}
						}
					}
			?>
									<div class="control-group">
											<div class="controls">
												<input type="text" required id="typeahead"  name="number"	value="<?php if(isset($_POST['btnCon'])) { echo $_POST['number']; }?>" 	data-provide="typeahead" data-items="4" placeholder="Number of Components"></input>
												<input type="submit" name="btnCon" value="Continue"></input>
											</div>
										</div>
										<?php
											if(isset($_POST['btnCon'])) {
												$num = $_POST['number'];
												for($i=1;$i<=$num;$i++) {
											?>
											<div class="control-group">
												<div class="controls">
													<input type="text" required id="typeahead"  name="name<?php echo $i;?>"		value="<?php if(isset($_POST['btnSetComp'])) { echo $name[$i]; }?>" 	data-provide="typeahead" data-items="4" placeholder="Component Name"></input>
													<input type="text" required id="typeahead"  name="req<?php echo $i;?>"		value="<?php if(isset($_POST['btnSetComp'])) { echo $req[$i]; }?>"	data-provide="typeahead" data-items="4" placeholder="Required Number"></input>
													<input type="text" required id="typeahead"  name="percent<?php echo $i;?>"	value="<?php if(isset($_POST['btnSetComp'])) { echo $percent[$i]; }?>"	data-provide="typeahead" data-items="4" placeholder="Percentage"></input>								
													<?php if(isset($_POST['btnSetComp'])) {if(isset($msg[$i])) { echo '<br>'.$msg[$i]; } }?>
													</div>
											</div>
											<?php
												}?>
											
												  <div id="container">
												  </div>
                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-primary" name="btnSetComp">Set Component</button>
                                          <button type="reset" class="btn">Cancel</button>
                                        </div>	
										<div><?php if (isset($_POST['btnSetComp'])) { if(isset($msga)) { echo $msga; } }?></div>
                                      </fieldset>
									 <?php } ?>
                                    </form>
                                </div>
                            </div>	
							<?php } ?>
						</p>
				</div>
				
                 <div class="tab-pane fade" id="attendance">				
                  <p>
                            <!-- block -->
							<?php
								$rows = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_calendar'), 0); 

								if (!$rows) { 
								?>
								
								<div class="block">
									<div class="block-content collapse in">
										<form class="form-horizontal" method="post" action="">
										  <fieldset>
											<legend>Set Term Schedule</legend>
								<?php
									if(isset($_POST['submit'])) {
										$year = date('Y');
										$month = $_POST['month'];
										$montha = $_POST['month'];
										$month2 = $_POST['month2'];
										$day = $_POST['day'];
										$day2 = $_POST['day2'];
										$strj = strtotime('2013-12-23') - strtotime('2013-09-18');
										$strg = strtotime("$year-$month2-$day2") - strtotime("$year-$month-$day");

										if($month==$month2 && $day==$day2) {
											echo "<div class=\"alert alert-error\"  style=\"min-width:30px;margin-right:10%;margin-top:1%;\">
										<button class=\"close\" data-dismiss=\"alert\">&times;</button>
										<strong>Error!</strong>Start Term can't be the same with the End Term Schedule!
									</div>";
										}
										else if(($month=='2' && $day>18) || ($month2=='2' && $day2>18) ) {
											echo "<div class=\"alert alert-error\"  style=\"min-width:30px;margin-right:10%;margin-top:1%;\">
										<button class=\"close\" data-dismiss=\"alert\">&times;</button>
										<strong>Error!</strong>Invalid Date!
									</div>";
										}
										else if($strg>$strj) {
											echo "<div class=\"alert alert-error\"  style=\"min-width:30px;margin-right:10%;margin-top:1%;\">
										<button class=\"close\" data-dismiss=\"alert\">&times;</button>
										<strong>Error!</strong>Exceed the average length of a term!
									</div>"; 
										}
										else {
											for($i=$day;$i<=31;$i++) {
												
												$sunday = date("l", mktime(0, 0, 0, $month, $i, $year));
												if($sunday=='Sunday') {
													$status = 'Sunday';
												}
												else {
													$status='Regular Class';
												}
												
												mysql_query("INSERT INTO tbl_calendar (month, day, status) VALUES ('$month','$i','$status')")  or die (mysql_error() . "Not Connected! Table"); 
												
												if($month==2){
													if($i==28){
														$month++;
														break;
													}
												}
												else if($month==9 || $month==11 || $month==4 || $month==6){
													if($i==30){
														$month++;
														break;
													}
												}
												else {
													if ($i==31){
														if($month==12) {
															$month=1;
															break;
														}
														else {
															$month++;
															break;
														}
													}
												}
											}
											
											while($month!=$month2){
												for($i=1;$i<=31;$i++) {
													
												$sunday = date("l", mktime(0, 0, 0, $month, $i, $year));
												if($sunday=='Sunday') {
													$status = 'Sunday';
												}
												else {
													$status='Regular Class';
												}
												
												mysql_query("INSERT INTO tbl_calendar (month, day, status) VALUES ('$month','$i','$status')")  or die (mysql_error() . "Not Connected! Table"); 
													
												if($month==2){
													if($i==28){
														$month++;
														$i = 0;
														break;
													}
												}
												else if($month==9 || $month==11 || $month==4 || $month==6){
													if($i==30){
														$month++;
														$i = 0;
														break;
													}
												}
												else {
													if ($i==31){
														if($month==12) {
															$month=1;
															$i = 0;
															break;
														}
														else {
															$month++;
															$i = 0;
															break;
														}
													}
												}
											}
										}
										
										 if($month2==$month){
											for($i=1;$i<=$day2;$i++) {
												
												$sunday = date("l", mktime(0, 0, 0, $month, $i, $year));
												if($sunday=='Sunday') {
													$status = 'Sunday';
												}
												else {
													$status='Regular Class';
												}
												
												mysql_query("INSERT INTO tbl_calendar (month, day, status) VALUES ('$month','$i','$status')")  or die (mysql_error()); 
												echo'<script> window.location="component.php"; </script> ';
											}
										}
										
										}
									}?>
											<div class="control-group">
												<label class="control-label" for="typeahead">Start of Term: </label>
												 <div class="controls">
													<select name="month">
														<option value="1" <?php if(isset($_POST['submit'])) { if($montha ==1): ?> selected="selected"<?php endif; }?>>January</option>
														<option value="2" <?php if(isset($_POST['submit'])) { if($montha ==2): ?> selected="selected"<?php endif; }?>>February</option>
														<option value="3" <?php if(isset($_POST['submit'])) { if($montha ==3): ?> selected="selected"<?php endif; }?>>March</option>
														<option value="4" <?php if(isset($_POST['submit'])) { if($montha ==4): ?> selected="selected"<?php endif; }?>>April</option>
														<option value="5" <?php if(isset($_POST['submit'])) { if($montha ==5): ?> selected="selected"<?php endif; }?>>May</option>
														<option value="6" <?php if(isset($_POST['submit'])) { if($montha ==6): ?> selected="selected"<?php endif; }?>>June</option>
														<option value="7" <?php if(isset($_POST['submit'])) { if($montha ==7): ?> selected="selected"<?php endif; }?>>July</option>
														<option value="8" <?php if(isset($_POST['submit'])) { if($montha ==8): ?> selected="selected"<?php endif; }?>>August</option>
														<option value="9" <?php if(isset($_POST['submit'])) { if($montha ==9): ?> selected="selected"<?php endif; }?>>September</option>
														<option value="10" <?php if(isset($_POST['submit'])) { if($montha ==10) : ?> selected="selected"<?php endif; }?>>October</option>
														<option value="11" <?php if(isset($_POST['submit'])) { if($montha ==11): ?> selected="selected"<?php endif; }?>>November</option>
														<option value="12" <?php if(isset($_POST['submit'])) { if($montha ==12): ?> selected="selected"<?php endif; }?>>December</option>
													</select>
													<select name="day">
														<?php for($i=1; $i<=31;$i++) {
														$i = sprintf("%02s", $i)?><option value="<?php echo $i ; ?>" <?php if(isset($_POST['submit'])) { if($day ==$i): ?> selected="selected"<?php endif; }?>><?php echo $i?><?php } 
															?>
													</select>
												 </div>
											</div>	
											
											<div class="control-group">
												<label class="control-label" for="typeahead">End of Term: </label>
												 <div class="controls">
													<select name="month2">
														<option value="1" <?php if(isset($_POST['submit'])) { if($month2 ==1): ?> selected="selected"<?php endif; }?>>January</option>
														<option value="2" <?php if(isset($_POST['submit'])) { if($month2 ==2): ?> selected="selected"<?php endif; }?>>February</option>
														<option value="3" <?php if(isset($_POST['submit'])) { if($month2 ==3): ?> selected="selected"<?php endif; }?>>March</option>
														<option value="4" <?php if(isset($_POST['submit'])) { if($month2 ==4): ?> selected="selected"<?php endif; }?>>April</option>
														<option value="5" <?php if(isset($_POST['submit'])) { if($month2 ==5): ?> selected="selected"<?php endif; }?>>May</option>
														<option value="6" <?php if(isset($_POST['submit'])) { if($month2 ==6): ?> selected="selected"<?php endif; }?>>June</option>
														<option value="7" <?php if(isset($_POST['submit'])) { if($month2 ==7): ?> selected="selected"<?php endif; }?>>July</option>
														<option value="8" <?php if(isset($_POST['submit'])) { if($month2 ==8): ?> selected="selected"<?php endif; }?>>August</option>
														<option value="9" <?php if(isset($_POST['submit'])) { if($month2 ==9): ?> selected="selected"<?php endif; }?>>September</option>
														<option value="10" <?php if(isset($_POST['submit'])) { if($month2 ==10) : ?> selected="selected"<?php endif; }?>>October</option>
														<option value="11" <?php if(isset($_POST['submit'])) { if($month2 ==11): ?> selected="selected"<?php endif; }?>>November</option>
														<option value="12" <?php if(isset($_POST['submit'])) { if($month2 ==12): ?> selected="selected"<?php endif; }?>>December</option>
													</select>
													<select name="day2">
														<?php for($i=1; $i<=31;$i++) {
															$i = sprintf("%02s", $i)?><option value="<?php echo $i ; ?>" <?php if(isset($_POST['submit'])) { if($day2 ==$i): ?> selected="selected"<?php endif; }?>><?php echo $i?><?php } 
															?>
													</select>
												 </div>
											</div>	
                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-primary" name="submit">Set</button>
                                          <button type="reset" class="btn">Cancel</button>
                                        </div>					
                                      </fieldset>
                                    </form>
                                </div>
                            </div>		
								<?php } 
								else {
							?>
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">
										  <?php
											$sql = mysql_query("SELECT * FROM tbl_calendar ORDER BY calendar_id ASC LIMIT 1") ;
																		 
											while($row = mysql_fetch_array($sql)){
												switch($row['month']){ 
													case 1: $start =  "January  " . $row['day']; break;
													case 2: $start = "February " . $row['day']; break;
													case 3: $start = "March " . $row['day']; break;
													case 4: $start = "April " . $row['day']; break;
													case 5: $start = "May " . $row['day']; break;
													case 6: $start = "June " . $row['day']; break;
													case 7: $start = "July " . $row['day']; break;
													case 8: $start = "August " . $row['day']; break;
													case 9: $start = "September " . $row['day']; break;
													case 10: $start = "October " . $row['day']; break;
													case 11: $start = "November " . $row['day']; break;
													case 12: $start = "December " . $row['day']; break;
													default: break;
												}
											}
											
											$sql = mysql_query("SELECT * FROM tbl_calendar ORDER BY calendar_id DESC LIMIT 1") ;
																		 
											while($row = mysql_fetch_array($sql)){
												switch($row['month']){ 
													case 1: $end = " - January " . $row['day']; break;
													case 2: $end = " - February " . $row['day']; break;
													case 3: $end = " - March " . $row['day']; break;
													case 4: $end = " - April " . $row['day']; break;
													case 5: $end = " - May " . $row['day']; break;
													case 6: $end = " - June " . $row['day']; break;
													case 7: $end = " - July " . $row['day']; break;
													case 8: $end = " - August " . $row['day']; break;
													case 9: $end = " - September " . $row['day']; break;
													case 10: $end = " - October " . $row['day']; break;
													case 11: $end = " - November " . $row['day']; break;
													case 12: $end = " - December " . $row['day']; break;
													default: break;
												}
											}
											?>	
										<?php if(isset($_REQUEST['action'])=='holiday') {?> Holiday Editor</h5> <?php } ?>
									</div>
                                    <div class="pull-right">
                                      <?php if(isset($_REQUEST['action'])!='holiday') { ?>
									  <a href="component.php?action=holiday"> <button  class="btn" style="margin-bottom:5px;">Set Holiday</button></a><?php }  ?>
                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <form class="form-horizontal" action="" method="post">
                                      <fieldset>
										<legend>Term Schedule: <?php echo $start.' '.$end;?></legend>
                                         <div class="control-group">
                                          <div class="controls">

										<?php if(isset($_REQUEST['action'])) {
												if($_REQUEST['action']=='holiday'){ 
													if(isset($_POST['btnSetHoliday'])) {
														$year = date("Y");
														$sql = mysql_query("SELECT month, day FROM tbl_calendar LIMIT 1") or die(mysql_error());
														while($row = mysql_fetch_array($sql))
														{ 
															$Smonth  = $row['month'];
															$Sday = $row['day'];
														}
														$start = $year.'-'.$Smonth.'-'.$Sday;
														$sql = mysql_query("SELECT month, day FROM tbl_calendar ORDER BY calendar_id DESC LIMIT 1") or die(mysql_error());
														while($row = mysql_fetch_array($sql))
														{ 
															$Smonth2  = $row['month'];
															$Sday2 = $row['day'];
														}
														$end = $year.'-'.$Smonth2.'-'.$Sday2;
														$date = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['holiday_date'])));
														$month = date("n",strtotime($date));
														$day = date("d",strtotime($date));
														$desc = $_POST['holiday_desc'];
												
														$current = strtotime($date);
														$Sstart = strtotime($start);
														$Send = strtotime($end);
														
														if($date=='1970-01-01') {
															echo 'No Holiday to be set';
														}
														else if(($Sstart < $current) && ($Send < $current)) {
															echo "<div class=\"alert alert-error\"  style=\"min-width:40px;margin-right:1%;margin-top:1%;\">
										<button class=\"close\" data-dismiss=\"alert\">&times;</button>
										<strong>Error!</strong> $date is not part of the term schedule.
									</div>";									
														}
														else if(($Sstart > $current) && ($Send > $current)) {
															echo "<div class=\"alert alert-error\"  style=\"min-width:40px;margin-right:1%;margin-top:1%;\">
										<button class=\"close\" data-dismiss=\"alert\">&times;</button>
										<strong>Error!</strong> $date is not part of the term schedule.
									</div>";
														}
														else if($desc=='') {
															echo '<div class="alert alert-error" style="min-width:30px;margin-right:10%;margin-top:1%;">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Error!</strong> Please fill out this filled.
									</div>';
														}
														else {
															mysql_query("UPDATE tbl_calendar SET status='$desc' WHERE month='$month' AND day='$day'");
															echo'<script> window.location="component.php"; </script> ';
														}
													}													
												?>
													<br><br><br>
													<div class="control-group">
													  <label class="control-label" for="date01">Date:</label>
													  <div class="controls">
														<input type="text" required name="holiday_date" class="input-xlarge datepicker" id="date01" value="<?php if(isset($_POST['btnSetHoliday'])) { echo $_POST['holiday_date']; }?>">
													  </div>
													</div>
													<div class="control-group">
													  <label class="control-label" for="textarea2">Description</label>
													  <div class="controls">
													<input type="text"  required name="holiday_desc" value="<?php if(isset($_POST['btnSetHoliday'])) { echo $_POST['holiday_desc']; }?>" data-provide="typeahead" data-items="4" placeholder="Holiday Description">
													  </div>
													</div>
													<div class="form-actions">
													  <button type="submit" class="btn btn-primary" name="btnSetHoliday">Set Holiday</button>
													  <button type="reset" class="btn">Cancel</button>
													</div>	
													<?php }
														}
													
													else {
														$rows = mysql_result(mysql_query('SELECT COUNT(*) FROM tbl_legend'), 0); 

														if ($rows) { ?>
														<div class="control-group">
														  <label class="control-label" for="date01">Attendance Legend</label>
														  <div class="controls">
															<?php 
															$sql = mysql_query("SELECT * FROM tbl_legend") ;
															while($row = mysql_fetch_array($sql)){ 
															?>
																<div class="control-group">
																  <label class="control-label" for="date01"><?php echo $row['description'];?></label>
																  <div class="controls">
																	<span class="input-mini uneditable-input"><?php echo $row['legend'];?></span>
																  </div>
																</div>
															<?php }  ?> 
															</div>
															</div>
															<?php }
																else {
																	echo '<h1>Set Attendance Legend</h1>';
																}
																$rows = mysql_query("SELECT * FROM tbl_calendar WHERE status!='Regular Class' AND status!='Sunday'"); 
																$count_rows = mysql_num_rows($rows);

																if ($count_rows) { ?>
																
																<div class="control-group">
																  <label class="control-label" for="date01">Holiday</label>
																  <div class="controls">
																		<label class="control-label" for="date01">Date</label>
																		<label class="control-label" for="date01">Description</label>
																	</div>
																</div>
																<?php 
																	$sql = mysql_query("SELECT month, day, status FROM tbl_calendar WHERE status!='Regular Class' and status!='Sunday' ORDER BY month DESC LIMIT 5") ;
																						 
																	while($row = mysql_fetch_array($sql)){ 
																	switch($row['month']){ 
																		case 1: $fmonth = "January"; break;
																		case 2: $fmonth = "February " ; break;
																		case 3: $fmonth = "March " ; break;
																		case 4: $fmonth = "April " ; break;
																		case 5: $fmonth = "May " ; break;
																		case 6: $fmonth = "June " ; break;
																		case 7: $fmonth = "July " ; break;
																		case 8: $fmonth = "August " ; break;
																		case 9: $fmonth = "September "; break;
																		case 10: $fmonth = "October "; break;
																		case 11: $fmonth = "November "; break;
																		case 12: $fmonth = "December "; break;
																		default: break;
																	}
																	?>		<br>
																	<div class="control-group">
	  <div class="controls">
		<label class="control-label" for="date01"><?php echo $fmonth.' '.$row['day'];?></label>
		<label class="control-label input-mini uneditable-input" for="date01" style="width:150px; margin-left:80px;"><?php echo $row['status'];?></label>
	  </div>
	</div>
																	<?php 
																		} ?>
																
															
																
													<?php }
													}?>
                                      </fieldset>
                                    </form>
                                </div>
                            </div>		
						<?php } ?>							
				  </p>
                </div>


              </div>
            </div>
				</div>
                        <!-- /block -->
                    </div>


                </div>
            </div>
          
<?php include 'includes/footer.php'; ?>
        </div>
        <!--/.fluid-container--> <link href="../_public/vendors/datepicker.css" rel="stylesheet" media="screen"> <link href="../_public/vendors/uniform.default.css" rel="stylesheet" media="screen"> <link href="../_public/vendors/chosen.min.css" rel="stylesheet" media="screen"> <link href="../_public/vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen">

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