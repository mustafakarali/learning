<?php
	session_start();
	include("includes/dbcon.php");
	
	if(!($_SESSION['login'])) {
		header("Location: index.php");
	}
	else {
		$id = $_REQUEST['myVar'];
		$myQuery = mysql_query("SELECT * FROM tbl_parent WHERE child_id='$id'");
	
		while($row = mysql_fetch_array($myQuery)){
			$child_id = $row['child_id'];
			$username = $row['username'];
		}

			if(isset($_POST['actiStud']))
				{

					$acsql =	mysql_query("UPDATE tbl_parent SET status='1' WHERE child_id='$id'")
								or die (mysql_error(). "Can't Update :( ");
														
								$msg = "<script>			
					$('.notification').click(function() {
				
					$.jGrowl(\"Parent's Account Activated!\", { sticky: true });
					break;
			});<script>";
				}
				
				if(isset($_POST['deacStud']))
				{

					$acsql =	mysql_query("UPDATE tbl_parent SET status='0' WHERE child_id='$id'")
								or die (mysql_error(). "Can't Update :( ");
														
								$msg = "<script>			
					$('.notification').click(function() {
				
					$.jGrowl(\"Parent's Account Deactivated!\", { sticky: true });
					break;
			});<script>";
				}

		}

		
	
?>  
<!DOCTYPE html>
<html class="no-js">
   <head>
        <title>Administrator | User Account Manager</title>
        <!-- Bootstrap -->
		    <link rel="shortcut icon" href="../_public/img/favicon.ico" />			
		<link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
		<link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen"> 
		<link href="../_public/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
		<link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
		<link href="../_public/vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" media="screen">			
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="../_public/http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <script src="../_public/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script> <link href="../_public/themes/redmond/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" /> <link href="../_public/Scripts/jtable/themes/lightcolor/blue/jtable.css" rel="stylesheet" type="text/css" />
	
	<script src="../_public/scripts/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script src="../_public/scripts/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
    <script src="../_public/Scripts/jtable/jquery.jtable.js" type="text/javascript"></script>

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
	                                        <a href="user.php">Back</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li>User Account Manager</a></li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            	<div class="bs-example">
            <ul class="nav nav-tabs" style="margin-bottom: 15px; margin-top:50px;">
                <li class="active"><a href="#student" data-toggle="tab">Parent</a></li>
			</ul>
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="student">
				
                <p>                 
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><h5>Parent</h5></div>
                                    <div class="pull-right"><a href="createStudent.php">
                                    </a>
                                    </div>
                                </div>
                                <div class="block-content collapse in">
								<form method="post" action="">	
                                 <table>
									<tr>
										<td>Child's Student ID: 
										<td><input type="text" value="<?php echo $child_id ?>" readonly/>
									</tr>
									<tr>
										<td>Username: 
										<td><input type="text" value="<?php echo $username ?>" readonly/>
									</tr>
									<tr>
										<td>Action: 
										<td><button class="btn btn-success btn-mini notification" id="notification-sticky" name="actiStud"> Activate</button>
										<button class="btn btn-danger btn-mini notification" id="notification-header" name="deacStud"> Deactivate</button>
									</tr>
								</table>
								</form>
				<?php if(isset($_POST['actiStud'])) { echo $msg; }?>
				<?php if(isset($_POST['deacStud'])) { echo $msg; }?>
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Table of people',
				actions: {
					listAction: 'PersonActions.php?action=list',
					createAction: 'PersonActions.php?action=create',
					updateAction: 'PersonActions.php?action=update',
					deleteAction: 'PersonActions.php?action=delete'
				},
				fields: {
					PersonId: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
					Name: {
						title: 'Author Name',
						width: '40%'
					},
					Age: {
						title: 'Age',
						width: '20%'
					},
					RecordDate: {
						title: 'Record date',
						width: '30%',
						type: 'date',
						create: false,
						edit: false
					}
				}
			});

			//Load person list from server
			$('#PeopleTableContainer').jtable('load');

		});

	</script>
                                </div>
                            </div>
				</p>
				
                </div>
				
<div class="tab-pane fade" id="instructor">		
	 	                               <div class="block-content collapse in">
                                    <div id="PeopleTableContainer" style="width: 600px;"></div>
	<script type="text/javascript">

		$(document).ready(function () {

		    //Prepare jTable
			$('#PeopleTableContainer').jtable({
				title: 'Table of people',
				actions: {
					listAction: 'PersonActions.php?action=list',
					createAction: 'PersonActions.php?action=create',
					updateAction: 'PersonActions.php?action=update',
					deleteAction: 'PersonActions.php?action=delete'
				},
				fields: {
					PersonId: {
						key: true,
						create: false,
						edit: false,
						list: false
					},
					Name: {
						title: 'Instructors Name',
						width: '40%'
					},
					Age: {
						title: 'Age',
						width: '20%'
					},
					RecordDate: {
						title: 'Record date',
						width: '30%',
						type: 'date',
						create: false,
						edit: false
					}
				}
			});

			//Load person list from server
			$('#PeopleTableContainer').jtable('load');

		});

	</script>
                                </div>
	 
	</div>
				
               
                        <!-- /block -->
                    </div>


                </div>
            </div>
        </div>
                </div>
            </div>
        </div>		
<?php include 'includes/footer.php'; ?>		
        <!--/.fluid-container-->
        <script src="../_public/vendors/jquery-1.9.1.min.js"></script>
        <script src="../_public/bootstrap/js/bootstrap.min.js"></script>
        <script src="../_public/vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="../_public/assets/scripts.js"></script>
        <script src="../_public/vendors/jGrowl/jquery.jgrowl.js"></script>		
        <script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000});
        });
        </script>
 <script>
        $(function() {

			$('.notification').click(function() {
				var $id = $(this).attr('id');
				switch($id) {
					case 'notification-sticky':
						$.jGrowl("Parent's Account Activated!");
					break;

					case 'notification-header':
						$.jGrowl("Parent's Account Deactivated!");
					break;

					default:
						$.jGrowl("Please Update the Parent's Account");
					break;
				}
			});
        });
        </script>	
    </body>

</html>