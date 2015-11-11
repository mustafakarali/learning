<?php
	session_start();
	//error_reporting(0);
	include("../include/dbcon.php");
	date_default_timezone_set('Etc/GMT+8'); 
	
	if(!($_SESSION['login'])) {
		header("Location: ../instructor.php");
	}
	else {
		$insID  = $_SESSION['username'];
		include("includes/classMenu.php");
		
		$query_start = mysql_query("SELECT month, day FROM tbl_calendar ORDER BY calendar_id ASC LIMIT 1") or die(mysql_error());
		while($row = mysql_fetch_array($query_start))
		{
			$query_Smonth = $row['month'];
			$query_Sday = $row['day'];
		}
		
		$query_end = mysql_query("SELECT month, day FROM tbl_calendar ORDER BY calendar_id DESC LIMIT 1") or die(mysql_error());
		while($row = mysql_fetch_array($query_end))
		{
			$query_Emonth = $row['month'];
			$query_Eday = $row['day'];
		}
		
		$cur_year = date("Y");
		$term_start = strtotime($cur_year.'-'.$query_Smonth.'-'.$query_Sday);
		$term_end = strtotime($cur_year.'-'.$query_Emonth.'-'.$query_Eday);
		
		if(isset($_POST['btnAdd'])) {
		
			$over = $_POST['over'];
			$allow = $_POST['size'];
			$date2 = date('Y-m-d');
			$category = $_POST['category'];
			list($comp, $num) = explode('-', $category);
			
			
			$late = $_POST['late'];
			$title = $_POST['title'];
			$desc = $_POST['desc'];
			$late = $_POST['late'];
			$date = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['date'])));
			
			$minute = $_POST['minute'];
			$hour = $_POST['hour'];
			$time = $hour.':'.$minute.':00';
			
			$cur_date = strtotime($date2);
			$cur_time = strtotime(date('H:i:s'));
			$set_date = strtotime($date);
			$set_time = strtotime($time);
			
			$fileName = $_FILES['userfile']['name'];
			$tmpName  = $_FILES['userfile']['tmp_name'];
			$fileSize = $_FILES['userfile']['size'];
			$fileType = $_FILES['userfile']['type'];
			
			if($fileName=='') {
			 			if($title=='' && $over=='' && $desc=='') {
							$msg = "<div class='control-group error' style='width:inherited; margin-top:2%; margin-left:45%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Content is a required field.</span>
                                          </div>
                                        </div>";
						}
						else {
							$msg = "<div class='control-group error' style='width:inherited; margin-top:2%; margin-left:45%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>No File Selected.</span>
                                          </div>
                                        </div>";
						}
			}
			else{
				if($fileType!='application/pdf') {
					$msg = "<div class='control-group error' style='width:inherited; margin-top:2%; margin-left:45%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Invalid file type. Only PDF file can be uploaded.</span>
                                          </div>
                                        </div>";
				}
				else {
					if($title=='')
					{
						$msg = "<div class='control-group error' style='width:inherited; margin-top:2%; margin-left:45%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Activity Title is a required field.</span>
                                          </div>
                                        </div>";
					}
					else if($desc=='')
					{
						$msg = "<div class='control-group error' style='width:inherited; margin-top:2%; margin-left:45%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Give description to your activity.</span>
                                          </div>
                                        </div>";
					}
					else if($category=='')
					{
						$msg = "<div class='control-group error' style='width:inherited; margin-top:2%; margin-left:45%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Category.</span>
                                          </div>
                                        </div>";
					}
					else if($size='') {
						$msg = "<div class='control-group error' style='width:inherited; margin-top:2%; margin-left:45%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Set the maximum file size to be uploaded.</span>
                                          </div>
                                        </div>";
					}
					else if($date=='')
					{
						$msg = "<div class='control-group error' style='width:inherited; margin-top:2%; margin-left:45%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Deadline should be provided.</span>
                                          </div>
                                        </div>";
					}
					else if($minute==''||$hour=='')
					{
						$msg = "<div class='control-group error' style='width:inherited; margin-top:2%; margin-left:45%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Time of deadline should be provided.</span>
                                          </div>
                                        </div>";
					}
					else if($set_date<$term_start && $term_end>$set_date) {
						$msg = "<div class='control-group error' style='width:inherited; margin-top:2%; margin-left:45%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>The selected date is before/after the term.</span>
                                          </div>
                                        </div>";
					}
					else if($set_date<$cur_date) {
						$msg = "<div class='control-group error' style='width:inherited; margin-top:2%; margin-left:45%;'>
                                          <div class='controls'>Invalid selection of date.</span>
                                          </div>
                                        </div>";
					}
					else if($set_date==$cur_date && $set_time<=$cur_time) {
						$msg = "<div class='control-group error' style='width:inherited; margin-top:2%; margin-left:45%;'>
                                          <div class='controls'>
                                            <span class='help-inline'>Invalid selection of time.</span>
                                          </div>
                                        </div>";
					}
					else {
						$fp      = fopen($tmpName, 'r');
						$content = fread($fp, filesize($tmpName));
						$content2 = addslashes($content);
						fclose($fp);

						if(!get_magic_quotes_gpc())
						{
							$fileName = addslashes($fileName);
						}
						
						$sql = mysql_query("SELECT * FROM tbl_class_class WHERE class_id='$classID'") or die(mysql_error());
						while($row = mysql_fetch_array($sql)){	
							$enrollID = $row['class_class_id'];
							mysql_query("INSERT INTO tbl_notification(class_class_id, category, status) VALUES('$enrollID','activity','0')") or die(mysql_error());
						}
						
						mysql_query("INSERT INTO tbl_activity (class_id, title, over, dated, file, filename, allow_size, deadline_date, deadline_time, description, component, category, add_late, status) VALUES ('$classID', '$title', '$over', '$date2', '$content2', '$fileName', '$allow', '$date', '$time', '$desc', '$comp', '$num','$late','1')") or die(mysql_error());
						
							header("Location: activity.php");
						}
						}
				}
		}
		
?>

<!DOCTYPE html>
<html>
    
<head>
        <title>Instructor | Create Activity</title>
                    <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <!-- Bootstrap --> <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen"> <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="vendors/flot/excanvas.min.js"></script><![endif]-->
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
<?php include 'includes/classbar.php'; ?>
                <!--/span-->
                <div class="span9" id="content">
                    <div class="row-fluid">
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href="classlist.php">Class List</a> <span class="divider">/</span>	
	                                    </li>
										<li>
	                                        <a href="activity.php">Activity</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li>Create Activity</li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>				

                     <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Create Activity</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="">
                                      <fieldset>
                                        <legend>Activity Editor</legend>
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">Title </label>
                                          <div class="controls">
                                            <input type="text" class="span6" id="typeahead" name="title" value="<?php if(isset($_POST['btnAdd'])) { echo $title; }?>" data-provide="typeahead" data-items="4" placeholder="Title">
                                          </div>
                                        </div>
										<div class="control-group">
                                        <div class="control-group">
										<label class="control-label" for="fileInput">Upload File</label>
                                          <div class="controls">
                                            <input class="input-file uniform_on" name="userfile" type="file" id="userfile">
										  </div>
										</div>
                                        <div class="control-group">
										<label class="control-label" for="fileInput">Category</label>
										 <div class="controls">
                                            <select name="category">
												<?php $sql = mysql_query("SELECT * FROM tbl_defaultcomponent WHERE name!='Attendance'");
														while($row=mysql_fetch_array($sql)) {
															$name = $row['name'];
															$no = $row['required_number'];
															$we = $name.'-'.$no;
															for($i=1;$i<=$no;$i++) {
															?>
																	<option value='<?php echo $row['name'].'-'.$i;?>'<?php if(isset($_POST['btnAdd'])) { if($_POST['category'] =="$we"): ?> selected="selected"<?php endif; }?>><?php echo $row['name'].'-'.$i;?>
															<?php		
															}
														}?>
											</select>
                                          </div>
										</div>
										<div class="control-group">
                                          <label class="control-label" for="typeahead">No. Of Items</label>
                                          <div class="controls">
                                            <input type="text" class="span6" id="typeahead" name="over" value="<?php if(isset($_POST['btnAdd'])) { echo $over; }?>" data-provide="typeahead" data-items="4" placeholder="Number of Items">
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="textarea2">Instruction</label>
                                          <div class="controls">
                                            <textarea class="input-xlarge textarea" placeholder="Enter text ..." style="width: 500px; height: 200px" name="desc"><?php if(isset($_POST['btnAdd'])) { echo $desc; }?></textarea>
                                          </div>
                                        </div>
										<div class="control-group">
                                          <label class="control-label" for="textarea2">Allow Late Submission</label>
										 <div class="controls">
                                            <input type="radio" name="late" value="1"  <?php if(isset($_POST['btnAdd'])) { echo ($_POST['late'] == "1") ? 'checked="checked"' : ''; }else { echo  'checked="checked"'; }?> />Yes</input>
											<input type="radio" name="late" value="0"  <?php if(isset($_POST['btnAdd'])) { echo ($_POST['late'] == "0") ? 'checked="checked"' : ''; }?>/>No</input>
                                          </div>
										</div> 
										<div class="control-group">
											<label class="control-label" for="textarea2">Allowable size (MB):</label>
											<div class="controls">
												<select name="size">
													<?php for($i=5;$i<=100;$i++) {
															if(!($i%5)) {?>
															<option value='<?php echo $i;?>'<?php if(isset($_POST['btnAdd'])) { if($_POST['size'] =="$i"): ?> selected="selected"<?php endif; }?>><?php echo $i;?>
													<?php } }?>
												</select>
											 </div>
										</div>
                                        <div class="control-group">
                                          <label class="control-label" for="date01">Deadline </label>
                                          <div class="controls">
                                            <input type="text" class="input-xlarge datepicker" id="date01" value="<?php if(isset($_POST['btnAdd'])) { echo $date; }?>" name="date">
                                          </div>
										 </div>
										  <div class="controls">
                                            <select name="hour">
												<?php for($i=1;$i<=24;$i++) {?>
													<option value='<?php echo $i;?>'<?php if(isset($_POST['btnAdd'])) { if($_POST['hour'] =="$i"): ?> selected="selected"<?php endif; }?>><?php echo $i;?>
												<?php } ?>
											</select>
                                          </div>
										  <div class="controls">
                                            <select name="minute">
												<?php for($i=0;$i<=59;$i++) {
														$i = sprintf("%02s", $i);?>
													<option value='<?php echo $i;?>'<?php if(isset($_POST['btnAdd'])) { if($_POST['minute'] =="$i"): ?> selected="selected"<?php endif; }?>><?php echo $i;?>
												<?php } ?>
											</select>
                                          </div>
                                        </div>

                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-primary" name="btnAdd">Add Activity</button>
                                          <button type="reset" class="btn">Cancel</button>
                                        </div>
                                      </fieldset>
                                    </form>

                                </div>
								<?php if(isset($_POST['btnAdd'])) {
										echo $msg;
									}
								?>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>


                </div>
            </div>
     
	        <hr class="footer-divider">
			<p>&copy; 2013 FEU-FERN COLLEGE</p>

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