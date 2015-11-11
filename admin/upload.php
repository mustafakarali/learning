<?php
	session_start();
	include("includes/dbcon.php");
	
	if(!($_SESSION['login'])) {
		header("Location: index.php");
	}
	else {
	
	if(isset($_REQUEST['dl'])) {
					$dl = $_REQUEST['dl'];
					$dl2 = $dl.'.csv';
					
					if($dl='student' || $dl='instructor' || $dl='course' || $dl='class' || $dl='enroll') {
						ob_start();   
						$query = "SELECT name, type, content FROM tbl_csv WHERE name='$dl2'";

						$result = mysql_query($query) or die (mysql_error());
						list($name, $type, $content) = mysql_fetch_array($result);
						var_dump($content);   
						ob_end_clean();
							  
						header("Accept-Ranges: bytes");
						header("Keep-Alive: timeout=15, max=100");
						header("Content-Disposition: attachment; filename='$name'");
						header("Content-type: '$type'");
						header("Content-Transfer-Encoding: binary");
						header( "Content-Description: File Transfer");
						echo $content;
						exit(0);
					}
					
				}
		
?>
<!DOCTYPE html>
<html>
    
    <head>
        <title>Administrator | Import CSV</title>
         <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <!-- Bootstrap --> <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
        <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen"> 
        <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
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
<?php include 'includes/sidebar.php'; ?>
                <!--/span-->
				
                <div class="span9" id="content">
                      <!-- morris stacked chart -->

					  

                     <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Import CSV File</div>
                            </div>
                            <div class="block-content collapse in">
							<ul class="nav nav-tabs" style="margin-bottom: 15px; margin-top:50px;">
                <li class="active"><a href="#student" data-toggle="tab">Student</a></li>
                <li><a href="#instructor" data-toggle="tab">Instructor</a></li>
                <li><a href="#course" data-toggle="tab">Course</a></li>
                <li><a href="#class" data-toggle="tab">Class</a></li> 
                <li><a href="#enroll" data-toggle="tab">Enroll</a></li>
			</ul>
			<div id="myTabContent" class="tab-content">
               <div class="tab-pane fade active in" id="student"> 
					
                <p>
				<?php
				if(isset($_POST['importStudent']))
				{
						include("includes/student.php");
				}
				?>
							<div class="span9">
                                     <div class="pull-right"><a href="upload.php?dl=student">
										<button class="btn btn-success" style="margin-bottom:5px;"><i class=" icon-download icon-white"></i> Download Template</button>
										</a>
										</div>
										<form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                                     <fieldset>
                                        <legend>Import CSV File</legend>
										
                                        <div class="control-group">
                                          <label class="control-label" for="fileInput">Student's Records</label>
                                          <div class="controls">
                                            <input class="input-file uniform_on" id="fileInput" type="file" name="fileStudent">
                                          </div>
                                        </div>

                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-primary" name="importStudent">Import</button>
                                          <button type="reset" class="btn">Cancel</button>
                                        </div>
                                      </fieldset>
                                    </form>
									</div>
								
				</p>
				</div>
			
			<!-- ins --> 
			<div class="tab-pane fade" id="instructor">
					
                <p>
				<?php
			if(isset($_POST['importInstructor']))
			{
						include("includes/instructor.php");
			}
			?>
							<div class="span9"><div class="pull-right"><a href="upload.php?dl=instructor">
										<button class="btn btn-success" style="margin-bottom:5px;"><i class=" icon-download icon-white"></i> Download Template</button>
										</a>
										</div>
                                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                                      <fieldset>
                                        <legend>Import CSV File</legend>

                                        <div class="control-group">
                                          <label class="control-label" for="fileInput">Instructor's Records</label>
                                          <div class="controls">
                                            <input class="input-file uniform_on" id="fileInput" type="file" name="fileInstructor">
                                          </div>
                                        </div>

                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-primary" name="importInstructor">Import</button>
                                          <button type="reset" class="btn">Cancel</button>
                                        </div>
                                      </fieldset>
                                    </form>  </div>
	
				</p>
				</div>
			<!-- ins -->
			
			<!-- course -->
			<div class="tab-pane fade" id="course"> 
					
                <p>
				<?php
				if(isset($_POST['importCourse']))
				{
						include("includes/course.php");
				}
				?>
							<div class="span9"><div class="pull-right"><a href="upload.php?dl=course">
										<button class="btn btn-success" style="margin-bottom:5px;"><i class=" icon-download icon-white"></i> Download Template</button>
										</a>
										</div>
                                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                                      <fieldset>
                                        <legend>Import CSV File</legend>

                                        <div class="control-group">
                                          <label class="control-label" for="fileInput">Courses</label>
                                          <div class="controls">
                                            <input class="input-file uniform_on" id="fileInput" type="file" name="fileCourse">
                                          </div>
                                        </div>

                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-primary" name="importCourse">Import</button>
                                          <button type="reset" class="btn">Cancel</button>
                                        </div>
                                      </fieldset>
                                    </form>
									</div>
								
				</p>
				</div>
			<!-- course -->
			
			<!-- class -->
               
	 <div class="tab-pane fade" id="class">
					
                <p>
				<?php
				if(isset($_POST['importClass']))
				{
					include("includes/class.php");
				}
				?>
						<div class="span9">
						<div class="pull-right"><a href="upload.php?dl=class">
										<button class="btn btn-success" style="margin-bottom:5px;"><i class=" icon-download icon-white"></i> Download Template</button>
										</a>
										</div>
                                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                                      <fieldset>
                                        <legend>Import CSV File</legend>

                                        <div class="control-group">
                                          <label class="control-label" for="fileInput">Import CSV File</label>
                                          <div class="controls">
                                            <input class="input-file uniform_on" id="fileInput" type="file" name="fileClass">
                                          </div>
                                        </div>

                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-primary" name="importClass">Import</button>
                                          <button type="reset" class="btn">Cancel</button>
                                        </div>
                                      </fieldset>
                                    </form>
									</div>
						</p>
				</div>
			<!-- class -->
			
			<!-- enroll -->
               
	 <div class="tab-pane fade" id="enroll">
					
                <p>
				<?php
				if(isset($_POST['importEnroll']))
				{
						include("includes/enroll.php");
				}
				?>
							<div class="span9">
							<div class="pull-right"><a href="upload.php?dl=enroll">
										<button class="btn btn-success" style="margin-bottom:5px;"><i class=" icon-download icon-white"></i> Download Template</button>
										</a>
										</div>
                                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                                      <fieldset>
                                        <legend>Import CSV File</legend>

                                        <div class="control-group">
                                          <label class="control-label" for="fileInput">Import CSV File</label>
                                          <div class="controls">
                                            <input class="input-file uniform_on" id="fileInput" type="file" name="fileEnroll">
                                          </div>
                                        </div>

                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-primary" name="importEnroll">Import</button>
                                          <button type="reset" class="btn">Cancel</button>
                                        </div>
                                      </fieldset>
                                    </form>
									</div>
	
				</p>
				</div>
			<!-- enroll -->
			
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