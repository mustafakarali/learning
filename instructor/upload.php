<?php
	session_start();
	error_reporting(0);
	include("../include/dbcon.php");
	
	if(!($_SESSION['login'])) {
		header("Location: ../instructor.php");
	}
	else {
		$insID  = $_SESSION['username'];
		include("includes/classMenu.php");
		
		if(isset($_POST['upload']))
		{
			$desc = $_POST['desc'];
			$status = $_POST['status'];
			$date = date("Y-m-d");
			
			$fileName = $_FILES['userfile']['name'];
			$tmpName  = $_FILES['userfile']['tmp_name'];
			$fileSize = $_FILES['userfile']['size'];
			$fileType = $_FILES['userfile']['type'];
			
			if($fileName=='') {
				$msg = '<i><font color="red">No File Selected.</font></i>';
			}
			else{
				if($fileType!='application/pdf') {
					$msg = '<i><font color="red">Invalid File.Only pdf file can be uploaded.</font></i>';
				}
				else {
					if($desc=='')
					{
						$msg = '<i><font color="red">Give description to your file.</font></i>';
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
							mysql_query("INSERT INTO tbl_notification(class_class_id, category, status) VALUES('$enrollID','files','0')") or die(mysql_error());
						}
						
						 mysql_query("INSERT INTO tbl_files (name, size, type, content, dated, description, status, class_id)
						VALUES ('$fileName', '$fileSize', '$fileType', '$content2', '$date', '$desc', '$status', '$classID')")
					   or die(mysql_error());
					   
						header("Location: files.php");
						}
						}
				}
			}
		
?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>Instructor | Upload New File</title>
        <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <!-- Bootstrap --> 
        <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
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
<?php include 'includes/classbar.php'; ?>
                <!--/span-->
                <div class="span9" id="content">
                      <!-- morris stacked chart -->

					  

                     <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Upload New File</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                                      <fieldset>
                                        <legend>Upload New File</legend>

                                        <div class="control-group">
                                          <label class="control-label" for="fileInput">Up to ...</label>
                                          <div class="controls">
                                            <input class="input-file uniform_on" name="userfile" type="file" id="userfile">
                                          </div><br>
											<label class="control-label" for="fileInput">Description</label>
											<textarea cols="20" rows="5" name="desc"><?php if(isset($_POST['upload'])) { echo $desc; }?></textarea><br><br>
											<label class="control-label" for="fileInput">Status</label>
											<input type="radio" name="status" value="1"  <?php if(isset($_POST['upload'])) { echo ($_POST['status'] == "1") ? 'checked="checked"' : ''; }else { echo  'checked="checked"'; }?> />Available</input>
											<input type="radio" name="status" value="0"  <?php if(isset($_POST['upload'])) { echo ($_POST['status'] == "0") ? 'checked="checked"' : ''; }?>/>Not Available</input><br><br>
                                        </div>

                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-primary" name="upload">Upload</button>
                                          <button type="reset" class="btn">Cancel</button>
                                        </div>
                                      </fieldset>
                                    </form>

                                </div>
								<?php  if(isset($_POST['upload'])) {echo $msg;}?>
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