<?php
	session_start();
	include("../include/dbcon.php");
	
	if(!($_SESSION['login'])) {
		header("Location: ../student.php");
	}
	else {
		$studID  = $_SESSION['username'];
		include("includes/classMenu.php");
		
		if(isset($_REQUEST['myFile'])) {
		ob_start();  
		$id2    = $_REQUEST['myFile'];
		$query = "SELECT name, size, type, content FROM tbl_files WHERE file_id='$id2' ";

		$result = mysql_query($query) or die (mysql_error());
		list($name, $size, $type, $content) = mysql_fetch_array($result);
		var_dump($content);   
		ob_end_clean();
			  
		header("Accept-Ranges: bytes");
		header("Keep-Alive: timeout=15, max=100");
		header("Content-Disposition: attachment; filename='$name'");
		header("Content-type: '$type'");
		header("Content-Transfer-Encoding: binary");
		header( "Content-Description: File Transfer");
		echo $content;
		}	
		
?>
<!DOCTYPE html>
<html>
    
    <head>
        <title>Student | Files</title>
<link rel="shortcut icon" href="../_public/img/favicon.ico" />    
    <!-- Bootstrap -->
        <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
        <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="vendors/flot/excanvas.min.js"></script><![endif]-->
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]> <script src="../_public/http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]--> <script src="../_public/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    
    <body>
<?php include 'includes/navbar.php'; ?>
        <div class="container-fluid">
        <div class="span3" id="sidebar">
        <?php include 'includes/classbar.php'; ?>
        <?php include 'includes/note.php'; ?>
        </div>
            <div class="row-fluid">
                <!--/span-->
                <div class="span9" id="content">
                    <div class="row-fluid">
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href="classList.php">Class List</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li> Files</li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>				
                    <div class="row-fluid">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Files</div>
                                    <div class="pull-right">
                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>File</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php
												$sql2 = mysql_query("SELECT * FROM tbl_files  WHERE class_id='$classID' AND status='1'")
																   or die(mysql_error()) ;
													if(mysql_num_rows($sql2) == 0)
													{?>
														<tr>
															<td><?php  echo '<div class="alert">
										<button class="close" data-dismiss="alert">&times;</button>
										<strong>Warning!</strong> No file has been uploaded.
									</div>'; ?></td>
														</tr><?php
													} 
													else
													{
														while($row=mysql_fetch_array($sql2))
														{
															$id = $row['file_id'];
															$filename = $row['name'];
															echo '<tr>';
															echo '<td>'.$row['dated'].'</td>';
															echo "<td><a href=\"files.php?myFile=$id\">$filename</a></td>";
															echo '<td>'.$row['description'].'</td>';
															?>
															<?php echo '<tr>';
														}
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
           
<?php include 'includes/footer.php'; ?>
        </div>
        <!--/.fluid-container-->
        <link href="../_public/vendors/datepicker.css" rel="stylesheet" media="screen">
        <link href="../_public/vendors/uniform.default.css" rel="stylesheet" media="screen">
        <link href="../_public/vendors/chosen.min.css" rel="stylesheet" media="screen">

        <link href="../_public/vendors/wysiwyg/bootstrap-wysihtml5.css" rel="stylesheet" media="screen"> <script src="../_public/vendors/jquery-1.9.1.js"></script> <script src="../_public/bootstrap/js/bootstrap.min.js"></script> <script src="../_public/vendors/jquery.uniform.min.js"></script> <script src="../_public/vendors/chosen.jquery.min.js"></script> <script src="../_public/vendors/bootstrap-datepicker.js"></script> <script src="../_public/vendors/wysiwyg/wysihtml5-0.3.0.js"></script> <script src="../_public/vendors/wysiwyg/bootstrap-wysihtml5.js"></script> <script src="../_public/vendors/wizard/jquery.bootstrap.wizard.min.js"></script> <script src="../_public/assets/scripts.js"></script>
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