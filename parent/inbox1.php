<?php
	session_start();
	include("../include/dbcon.php");
	
	if(!($_SESSION['login'])) {
		header("Location: ../l_parent.php");
	}
	else {
		$parent_username  = $_SESSION['username'];
		
?>

<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Parent | Inbox</title>
        <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <!-- Bootstrap -->
        <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="../_public/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]> <script src="../_public/http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]--> <script src="../_public/vendors/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    
    <body>
<?php include 'includes/navbar.php'; ?>
        <div class="container-fluid">
            <div class="row-fluid">
                
                <!--/span-->
                <div class="span12" id="content">
                    <div class="row-fluid">
                        <div class="span12">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">

                                    <div class="pull-right"><a href="compose.php">
                                      <button class="btn btn-primary" style="margin-bottom:5px;"><i class="icon-edit icon-white"></i> Compose</button></a>
                                    </div>
                                </div>
 <?php
//We check if the user is logged
if(isset($_SESSION['username']))
{
//We list his messages in a table
//Two queries are executes, one for the unread messages and another for read messages
$req1 = mysql_query('select m1.id, m1.title, m1.timestamp, 
		count(m2.id) as reps, tbl_instructor.instructor_id as userid, 
		tbl_instructor.instructor_id 
		from tbl_pm as m1, tbl_pm as m2,tbl_instructor
		where ((m1.user1="'.$parent_username.'" 
		and m1.user1read="no" 
		and tbl_instructor.instructor_id=m1.user2)
		or (m1.user2="'.$parent_username.'"
		and m1.user2read="no" and
		tbl_instructor.instructor_id=m1.user1)) 
		and m1.id2="1" 
		and m2.id=m1.id group by m1.id order by m1.timestamp desc');
$req2 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, 
		tbl_instructor.instructor_id as userid, tbl_instructor.instructor_id
		from tbl_pm as m1, tbl_pm as m2, tbl_instructor 
		where ((m1.user1="'.$parent_username.'" 
		and m1.user1read="yes" and tbl_instructor.instructor_id=m1.user2) 
		or (m1.user2="'.$parent_username.'"
		and m1.user2read="yes" and tbl_instructor.instructor_id=m1.user1)) 
		and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.timestamp desc');
?>                              

<div class="block-content collapse in">
								<h3>Unread Messages(<?php echo intval(mysql_num_rows($req1)); ?>):</h3>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th width="10%">Replies</th>												
                                                <th width="10%">To</th>
                                                <th width="15%">Subject</th>
                                                <th width="10%">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
										<?php
//We display the list of unread messages
while($dn1 = mysql_fetch_array($req1))
{
?>

                                            <tr data-href="message.php?id=<?php echo $dn1['id']; ?>">
												<td><?php echo $dn1['reps']-1; ?></td>
                                                <td><?php echo htmlentities($dn1['userid'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?></td>                                        
                                                <td><?php echo date('Y/m/d H:i:s' ,$dn1['timestamp']); ?></td>
                                            </tr>
<?php
}
//If there is no unread message we notice it
if(intval(mysql_num_rows($req1))==0)
{
?>
	<tr>
    	<td colspan="4" class="center">You have no unread message.</td>
    </tr>
<?php
}
?>											
                                        </tbody>
										
                                    </table>
<br />
<h3>Inbox(<?php echo intval(mysql_num_rows($req2)); ?>):</h3>
									
									
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
												 <th width="10%">Replies</th>
                                                <th width="10%">To</th>
                                                <th width="15%">Subject</th>
                                                <th width="10%">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
//We display the list of read messages
while($dn2 = mysql_fetch_array($req2))
{
?>

                                            <tr data-href="message.php?id=<?php echo $dn2['id']; ?>">
												<td><?php echo $dn2['reps']-1; ?></td>
                                                <td><?php echo htmlentities($dn2['userid'], ENT_QUOTES, 'UTF-8'); ?></td>
                                                <td><?php echo htmlentities($dn2['title'], ENT_QUOTES, 'UTF-8'); ?></td>                                      
                                                <td><?php echo date('Y/m/d H:i:s' ,$dn2['timestamp']); ?></td>
                                            </tr><?php
}
//If there is no read message we notice it
if(intval(mysql_num_rows($req2))==0)
{
?>
	<tr>
    	<td colspan="4" class="center">You have no read message.</td>
    </tr>
<?php
}
?>
                                        </tbody>
										
                                    </table>	
<?php
}
else
{
	echo 'You must be logged to access this page.';
}
?>									
                                </div>
                            </div>
                            <!-- /block -->
                        </div>
                    </div>


                </div>
            </div>

        </div>
<?php include 'includes/footer.php'; ?>
        <!--/.fluid-container--> <script src="../_public/vendors/jquery-1.9.1.min.js"></script> <script src="../_public/bootstrap/js/bootstrap.min.js"></script> <script src="../_public/vendors/easypiechart/jquery.easy-pie-chart.js"></script> <script src="../_public/assets/scripts.js"></script>
        <script>
        $(function() {
            // Easy pie charts
            $('.chart').easyPieChart({animate: 1000});
        });
        </script>
    </body>

</html>

<?php
}
?>