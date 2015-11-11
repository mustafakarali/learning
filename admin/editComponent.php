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
	                                        <a href="index.php">Dashboard</a> <span class="divider">/</span>	
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
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>Grade Component Editor</h5></div>
                                </div>
                                <div class="block-content collapse in">
                                    <form class="form-horizontal">
                                      <fieldset>
                                        <legend>Grade Component Editor</legend>
										
										<?php
										  $result = mysql_query("SELECT * FROM tbl_defaultComponent");
										  $x=1;
										  while($row = mysql_fetch_array($result)){
													$n = $row['name'];
													$n = str_replace("_", " ", strtolower($n));
													$n = ucwords($n);
													//echo "<tr><td><input type=\"text\" name=\"name\" value=\"".$n."\"></td><td><input type=\"text\" name=\"req".$x."\" value=\"".$row['required_number']."\"></td><td><input type=\"text\" name=\"".$x."\" value=\"".$row['percentage']."\"></td></tr>";
													?>
												<div class="control-group">
                                          <label class="control-label" for="typeahead"><?php echo $n;?></label>
												  <div class="controls"><input type="text" class="span6" id="typeahead"  name="req<?php echo $x?>"	data-provide="typeahead" data-items="4" placeholder="<?php echo $row['required_number'];?>"></input>
													<input type="text" class="span6" id="typeahead"  name="<?php echo $x?>"		data-provide="typeahead" data-items="4" placeholder="<?php echo $row['percentage'];?>"></input>								
												  </div>
												</div>
											<?php $x++; }
										?>
                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-primary">Save Changes</button>
                                          <button type="reset" class="btn">Cancel</button>
                                        </div>										

                                      </fieldset>
                                    </form>
                                </div>
                            </div>
				</p>
                </div>
				
                <div class="tab-pane fade" id="attendance">				
                  <p>
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>Attendance Editor</h5></div>
									<div class="pull-right"><a href="legend.php">
									  <button class="btn"> Edit Attendance Legend</button>
									</a>                                    </div>
                                </div>
                                <div class="block-content collapse in">
                                    <form class="form-horizontal">
                                      <fieldset>
                                        <legend>Attendance Editor</legend>
                                        <div class="control-group">
                                          <label class="control-label" for="date01">Date input</label>
                                          <div class="controls">
                                            <input type="text" class="input-xlarge datepicker" id="date01" value="02/16/12">
                                            <p class="help-block">In addition to freeform text, any HTML5 text-based input appears like so.</p>
                                          </div>
                                        </div>										
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">Category </label>
                                          <div class="controls">
                                            <input type="text" class="span6" id="typeahead"  data-provide="typeahead" data-items="4" data-source='["Holiday","Class Suspension"]'>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="textarea2">Description</label>
                                          <div class="controls">
                                            <textarea class="input-xlarge textarea" placeholder="Enter text ..." style="width: 500px; height: 200px"></textarea>
                                          </div>
                                        </div>										

                                        <div class="form-actions">
                                          <button type="submit" class="btn btn-primary">Save Changes</button>
                                          <button type="reset" class="btn">Cancel</button>
                                        </div>										

                                      </fieldset>
                                    </form>
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