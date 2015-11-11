<?php
	session_start();
include("includes/dbcon.php");
if(isset($_SESSION['login'])) {
?>
<!DOCTYPE html>
<html>
    
    <head>
        <title>Administrator | Content Management</title>
         <link rel="shortcut icon" href="../_public/img/favicon.ico" />		
        <!-- Bootstrap --> 
		<link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen"> 
		<link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
		<link href="../_public/css/colorpicker.css" rel="stylesheet">
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
	                                    <li>Content Management</a> 	</li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
                    <div class="row-fluid">
					<div class="block">
                            	<div class="bs-example">
            <ul class="nav nav-tabs" style="margin-bottom: 15px; margin-top:50px;">
                <li class="active"><a href="#top" data-toggle="tab">FAQs</a></li>
                <li><a href="#over" data-toggle="tab">Contact Us</a></li>
			</ul>
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="top">
					
                <p>         
                        <!-- block -->
                       <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>FAQs Editor</h5></div>
                                </div>
                                <div class="block-content collapse in">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="">

                                        <thead>
                                            <tr>
												<th>#</th>
                                                <th>Title</th>
                                                <th>Answer</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
											include ("includes/dbcon.php");
							$sql = mysql_query("SELECT * FROM tbl_faq");
							while($row = mysql_fetch_object($sql))
							{
							
							$string = strip_tags($row->title);
							if (strlen($string) > 200) {
								// truncate string
								$stringCut = substr($string, 0, 70);

								// make sure it ends in a word so assassinate doesn't become ass...
								$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
							}
							
							$answer = strip_tags($row->answer);
							if (strlen($answer) > 30) {
								// truncate string
								$stringCut = substr($answer, 0, 25);

								// make sure it ends in a word so assassinate doesn't become ass...
								$answer= substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
							}
								
								echo "<tr>";
								echo "<td>" . $row->faq_id. "</td>";
								echo "<td>" . $string . "</td>";
								echo "<td>" . $answer . "</td>";
								echo "<td><a href=\"editFAQ.php?myVar=$row->faq_id\">
										   <button class=\"btn btn-primary\"><i class=\"icon-pencil icon-white\"></i> Edit</button></a></td>";
								echo "</tr>";
							}
						?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
				</p>
                </div>
				
                <div class="tab-pane fade" id="over">				
                  <p>
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>Top Students</h5></div>
                                </div>
                                <div class="block-content collapse in">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example1">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
											include ("includes/dbcon.php");
							$sql = mysql_query("SELECT * FROM tbl_contact");
							while($row = mysql_fetch_object($sql))
							{
							
								
								echo "<tr>";
								echo "<td>" . $row->contact_id. "</td>";
								echo "<td>" . $row->description . "</td>";
								echo "<td><a href=\"editContact.php?myVar=$row->contact_id\">
										   <button class=\"btn btn-primary\"><i class=\"icon-pencil icon-white\"></i> Edit</button></a></td>";
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
				<script src="../_public/css/colorpicker.css"></script>
		<script src="../_public/js/bootstrap-colorpicker.js"></script>
		<script src="../_public/less/colorpicker.less"></script>		

		


        <script src="../_public/assets/scripts.js"></script>
        <script>
        $(function() {
            $(".datepicker").datepicker();
            $(".uniform_on").uniform();
            $(".chzn-select").chosen();
            $('.textarea').wysihtml5();
			$('.colorpicker').colorpicker();
			
			$('.colorpicker').colorpicker().on('changeColor', function(ev){
			bodyStyle.backgroundColor = ev.color.toHex();
			});
			

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
	}else{
		header("location:index.php");
	}
?>
