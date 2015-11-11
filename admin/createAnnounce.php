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
        <title>Administrator | Create Announcement</title>
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
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> <!-- or use local jquery -->
		<script src="../_public/js/jqBootstrapValidation.js"></script>
		<script>
  $(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
</script>
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
	                                        <a href="index.php">Homepage</a> <span class="divider">/</span>	
	                                    </li>
										<li>
	                                        <a href="announce.php">Announcement Board</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li>Create Announcement</li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>				

                     <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Create Announcement</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <form method="post" action="" class="form-horizontal">
                                      <fieldset>
                                        <legend>Announcement Editor</legend>
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">Title </label>
                                          <div class="controls">
                                            <input type="text" class="span6" id="typeahead"  name="title" placeholder="Title" value="<?php
													if(isset($_POST['btnAdd'])){
														echo $_POST['title'];
													}else{
														echo "";
													}
												?>" required>
												<p class="help-block"></p>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="date01">Date </label>
                                          <div class="controls">
                                            <input type="text" name="date" class="input-xlarge datepicker" id="date01" value="<?php
													if(isset($_POST['btnAdd'])){
														echo $_POST['date'];
													}else{
														echo "";
													}
												?>" required>
												<p class="help-block"></p>
                                          </div>
										<div class="controls">
											<?php
												if(isset($_POST['btnAdd']))
												{
													$date = $_POST['date'];
													
													if($date == null)
													{
														echo "<div class='control-group error' style='width:inherited; margin-top:-3%; margin-left:27%; margin-bottom:-5%;'>
															  <div class='controls'>
																<span class='help-inline'>Date is a required field.</span>
															  </div>
															</div>";
													}				
												}
											?>
										</div>										  
                                        </div>

                                        <div class="control-group">
                                          <label class="control-label" for="textarea2">Description</label>
                                          <div class="controls">
                                            <textarea id="tinymce_full" name="content" rows="10"><?php
													if(isset($_POST['btnAdd'])){
														echo $_POST['content'];
													}else{
														echo "";
													}
												?></textarea>
											
                                          </div>
										  <div class="controls">
											<?php
							if(isset($_POST['btnAdd']))
							{
								$content = $_POST['content'];
                            	
								if($content == null)
								{
									echo '<div class="alert alert-error">
					<button class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> Description is a required field.
				</div>';
								}
								
							}
	 ?>
	 </div>
                                        </div>
                                        <div class="form-actions">
                                          <button type="submit" name="btnAdd" class="btn btn-primary">Post Announcement</button>
                                          <button type="reset" class="btn">Cancel</button>
                                        </div>
                                      </fieldset>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
<?php
	if(isset($_POST['btnAdd'])){
	$title = $_POST['title'];
	$date = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['date'])));
	$content = $_POST['content'];

	if(empty($title) || empty($date) || empty($content))
	{
		echo "";
	}
	
	else{
	$title = $_POST['title'];
	$date = date('Y-m-d', strtotime(str_replace('-', '/', $_POST['date'])));
	$content = $_POST['content'];
	
		 $myQuery = mysql_query("INSERT INTO tbl_announcement(title, dated, description) VALUES('$title','$date','$content')") or die(mysql_error()."Can't insert");

	     echo "<div class='alert alert-success' style='width:400px; margin-bottom:3%; margin-top:3%; margin-left:20%;'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Success!</strong> Announcement was created successfully.</div>";
		 
	}
	}
		
?>		

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
		<script type="text/javascript" src="../_public/vendors/tinymce/js/tinymce/tinymce.min.js"></script>

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
				tinymce.init({
		    selector: "#tinymce_full",
		    plugins: [
		        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
		        "searchreplace wordcount visualblocks visualchars code fullscreen",
		        "insertdatetime media nonbreaking save table contextmenu directionality",
		        "emoticons template paste textcolor"
		    ],
		    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
		    toolbar2: "print preview media | forecolor backcolor emoticons",
		    image_advtab: true,
		    templates: [
		        {title: 'Test template 1', content: 'Test 1'},
		        {title: 'Test template 2', content: 'Test 2'}
		    ]
		});
        </script>
    </body>

</html>
<?php
	}
?>