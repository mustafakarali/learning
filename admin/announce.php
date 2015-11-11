<?php
session_start();
if(!($_SESSION['login'])) {
		header("Location: index.php");
	}
	else {													
?>
<!DOCTYPE html>
<html>
    
    <head>
        <title>Announcement Board</title>
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
	                                    <li>Announcement Board</li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>				
                    <div class="row-fluid">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Announcement Board</div>
                                    <div class="pull-right"><a href="createAnnounce.php">
                                      <button class="btn" style="margin-bottom:5px;"> Create Announcement</button>
                                    </a>
                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Date</th>
                                                <th>Description</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
											include ("includes/dbcon.php");
							$sql = mysql_query("SELECT * FROM tbl_announcement");
							while($row = mysql_fetch_object($sql))
							{
							
							$string = strip_tags($row->description);
							if (strlen($string) > 60) {
								// truncate string
								$stringCut = substr($string, 0, 60);

								// make sure it ends in a word so assassinate doesn't become ass...
								$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
							}
							
							$title = strip_tags($row->title);
							if (strlen($title) > 30) {
								// truncate string
								$stringCut = substr($title, 0, 25);

								// make sure it ends in a word so assassinate doesn't become ass...
								$title= substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
							}
								
								echo "<tr>";
								echo "<td>" . $row->announcement_id. "</td>";
								echo "<td>" . $title . "</td>";
								echo "<td>" . $row->dated . "</td>";
								echo "<td>" . $string . "</td>";
								echo "<td><a href=\"editAnnouncement.php?myVar=$row->announcement_id\">
										   <button class=\"btn btn-primary\"><i class=\"icon-pencil icon-white\"></i> Edit</button></a></td>";
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
<?php include 'includes/footer.php'; ?>		
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