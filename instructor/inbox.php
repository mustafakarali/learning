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
		
?>

<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Instructor | Achievement Board</title>
        <link rel="shortcut icon" href="../_public/img/favicon.ico" />
        <!-- Bootstrap --> <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen"> <link href="../_public/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen"> <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
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
                
                <!--/span-->
                <div class="span12" id="content">
                    <div class="row-fluid">
                        <div class="span12">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">
                                          <div class="controls">
                                            <select id="select01" class="chzn-select">
                                              <option>Inbox(0)</option>
                                              <option>Unread</option>
                                            </select>
                                          </div>
									</div>
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
		count(m2.id) as reps, tbl_student.student_id as userid, 
		tbl_student.student_id 
		from tbl_pm as m1, tbl_pm as m2,tbl_student
		where ((m1.user1="'.$_SESSION['username'].'" 
		and m1.user1read="no" 
		and tbl_student.student_id=m1.user2)
		or (m1.user2="'.$_SESSION['username'].'"
		and m1.user2read="no" and
		tbl_student.student_id=m1.user1)) 
		and m1.id2="1" 
		and m2.id=m1.id group by m1.id order by m1.timestamp desc');
$req2 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, 
		tbl_student.student_id as userid, tbl_student.student_id
		from tbl_pm as m1, tbl_pm as m2, tbl_student 
		where ((m1.user1="'.$_SESSION['username'].'" 
		and m1.user1read="yes" and tbl_student.student_id=m1.user2) 
		or (m1.user2="'.$_SESSION['username'].'"
		and m1.user2read="yes" and tbl_student.student_id=m1.user1)) 
		and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.timestamp desc');	
$req3 = mysql_query('select m1.id, m1.title, m1.timestamp, 
		count(m2.id) as reps, tbl_parent.username as userid, 
		tbl_parent.username 
		from tbl_pm as m1, tbl_pm as m2,tbl_parent
		where ((m1.user1="'.$_SESSION['username'].'" 
		and m1.user1read="no" 
		and tbl_parent.username=m1.user2)
		or (m1.user2="'.$_SESSION['username'].'"
		and m1.user2read="no" and
		tbl_parent.username=m1.user1)) 
		and m1.id2="1" 
		and m2.id=m1.id group by m1.id order by m1.timestamp desc');
$req4 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, 
		tbl_parent.username as userid, tbl_parent.username
		from tbl_pm as m1, tbl_pm as m2, tbl_parent 
		where ((m1.user1="'.$_SESSION['username'].'" 
		and m1.user1read="yes" and tbl_parent.username=m1.user2) 
		or (m1.user2="'.$_SESSION['username'].'"
		and m1.user2read="yes" and tbl_parent.username=m1.user1)) 
		and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.timestamp desc');			
	$unread = intval(mysql_num_rows($req1)) + intval(mysql_num_rows($req3));
	$read = intval(mysql_num_rows($req2)) + intval(mysql_num_rows($req4));
?>                              


<div class="block-content collapse in">
								<h3>Unread Messages(<?php echo $unread; ?>):</h3>
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
while($dn1 = mysql_fetch_array($req1) or $dn3 = mysql_fetch_array($req3))
{
?>

                                            <tr data-href="message.php?id=<?php if($dn1['userid']) echo $dn1['id'];
											else if($dn3['userid']) echo $dn3['id'];?>">
												<td><?php if($dn1['userid']) echo $dn1['reps']-1;
											else if($dn3['userid']) echo $dn3['reps']-1;?></td>
                                                <td><?php if($dn1['userid']) echo htmlentities($dn1['userid'], ENT_QUOTES, 'UTF-8');
											else if($dn3['userid']) echo htmlentities($dn3['userid'], ENT_QUOTES, 'UTF-8');?></td>
                                                <td><?php if($dn1['userid']) echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8');
											else if($dn3['userid']) echo htmlentities($dn3['title'], ENT_QUOTES, 'UTF-8');?></td>                                        
                                                <td><?php if($dn1['userid']) echo date('Y/m/d H:i:s' ,$dn1['timestamp']);
											else if($dn3['userid']) echo date('Y/m/d H:i:s' ,$dn3['timestamp']);?></td>
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
<h3>Inbox(<?php echo $read; ?>):</h3>
									
									
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
while($dn2 = mysql_fetch_array($req2) or $dn4 = mysql_fetch_array($req4))
{
?>

                                            <tr data-href="message.php?id=<?php if($dn2['userid'])echo $dn2['id']; else if($dn4['userid'])echo $dn4['id'];?>">
												<td><?php if($dn2['userid'])
												echo $dn2['reps']-1;
												else if($dn4['userid']) echo $dn4['reps']-1; ?></td>
                                                <td><?php if($dn2['userid']) echo htmlentities($dn2['userid'], ENT_QUOTES, 'UTF-8'); 
												else if($dn4['userid']) echo htmlentities($dn4['userid'], ENT_QUOTES, 'UTF-8');?></td>
                                                <td><?php if($dn2['userid']) echo htmlentities($dn2['title'], ENT_QUOTES, 'UTF-8'); 
												else if($dn4['userid']) echo htmlentities($dn4['title'], ENT_QUOTES, 'UTF-8');?></td>                                      
                                                <td><?php if($dn2['userid']) echo date('Y/m/d H:i:s' ,$dn2['timestamp']); 
												else if($dn4['userid']) echo date('Y/m/d H:i:s' ,$dn4['timestamp']);?></td>
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

        <!--/.fluid-container-->
        <script src="../_public/vendors/jquery-1.9.1.min.js"></script>
        <script src="../_public/bootstrap/js/bootstrap.min.js"></script>
        <script src="../_public/vendors/easypiechart/jquery.easy-pie-chart.js"></script>
        <script src="../_public/assets/scripts.js"></script>
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