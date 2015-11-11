<?php
	session_start();
include("includes/dbcon.php");
if(isset($_SESSION['login'])) {

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
         <link rel="shortcut icon" href="../_public/img/favicon.ico" />
		
		        <!-- Bootstrap -->
        <link href="../_public/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../_public/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="../_public/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
        <link href="../_public/assets/styles.css" rel="stylesheet" media="screen">
        <link href="../_public/assets/DT_bootstrap.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
		
		<title>Administrator | Report Generator</title>
        <style type="text/css" title="currentStyle">@import "media/css/demo_table.css";</style>
        <script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
        <script type="text/javascript">
 
        // When Page Loads
        var oTable;
        $(document).ready(function()
        {
            // Init DataTable
            oTable = $('#myDataTable').dataTable();
 
            // Handle Btn Clicks
            $('.ExportBtn').click(function() {
                CSVExportDataTable(oTable, $(this).val());
            });
        });
 
        // CSV Export Function
        function CSVExportDataTable(oTable, exportMode)
        {   
            // Init
            var csv = '';
            var headers = [];
            var rows = [];
            var dataSeparator = '|~|';
      
            // Get table header names
            $(oTable).find('thead th').each(function() {
                var text = $(this).text();
                if(text != "") headers.push(text);
            });
            csv += headers.join(dataSeparator) + "\r\n";
      
                // Get table body data
                if (exportMode == 'Full') {
                    var totalRows = oTable.fnSettings().fnRecordsTotal();
                    for (var i = 0; i < totalRows; i++) {
                        var row = oTable.fnGetData(i);
                        rows.push(row.join(dataSeparator));
                    }
                } else {
                    $(oTable._('tr:visible', { })).each(function(index, row) {
                        rows.push(row.join(dataSeparator));
                    });
                }
                csv += rows.join("\r\n");
 
            // Proceed if csv data was loaded
            if (csv.length > 0)
            {
                // Ajax Post CSV Data
                $.ajax({
                    type: "POST",
                    url: 'dt_csv_export.php',
                    data: {
                        action: "generate",
                        csv_type: oTable.attr('id'),
                        csv_data: csv
                    },
                    success: function(download_link) {
                        location.href = download_link;
                    }
                });
            }
        }
 
        </script>
	</head>
	<body>
		
<script type="text/javascript">

(function(){
  var bsa = document.createElement('script');
     bsa.type = 'text/javascript';
     bsa.async = true;
     bsa.src = '//s3.buysellads.com/ac/bsa.js';
  (document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);
})();

</script>


<?php include 'includes/navbar.php'; ?>
        <div class="container-fluid">
            <div class="row-fluid">                
                <!--/span-->
                <div class="span12" id="content">
                    <div class="row-fluid">
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href="dashboard.php">Homepage</a> <span class="divider">/</span>	
	                                    </li>
	                                    <li>
	                                        <a href="report.php">Report Generator</a> <span class="divider">/</span>	
	                                    </li>										
	                                    <li>Subject</a></li>
	                                </ul>
                            	</div>
                        	</div>
                    	</div>
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            	<div class="bs-example">
            <ul class="nav nav-tabs" style="margin-bottom: 15px; margin-top:50px;">
                <li class="active"><a href="#student" data-toggle="tab">Subject</a></li>
			</ul>
              <div id="myTabContent" class="tab-content">
			  
                <div class="tab-pane fade active in" id="student">
					<p>                 
                        <!-- block -->
                            <div class="block">
                                <div class="block-content collapse in">

                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="myDataTable">
                                        <thead>
                                            <tr>
                                               <th>Course Code</th>
                                                <th>Section</th>
												<th>Room</th>
                                                <th>Schedule Day</th>
												<th>Schedule Time</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
											<tbody>
												<?php
													$sql = mysql_query("SELECT * FROM tbl_class");
													$ctr=1;
													while($row = mysql_fetch_array($sql))
													{
													$course_code= $row['course_code'];
													$section= $row['section'];
													if($ctr%2==0){													
													echo "<tr>";
													echo "<td>" . $row['course_code']."</td>";
													echo "<td>" . $row['section'] . "</td>";
													echo "<td>" . $row['room'] . "</td>";
													echo "<td>" . $row['schedule_day'] . "</td>";
													echo "<td>" . $row['schedule_time'] . "</td>";
													echo "<td>" . "<a href=\"report6.php?myVar=$course_code&myVar2=$section\">".'View Class List'."</td>";													
													echo "</tr>";											
													}
													else{
													echo "<tr>";;
													echo "<td>" . $row['course_code'] . "</td>";
													echo "<td>" . $row['section'] . "</td>";
													echo "<td>" . $row['room'] . "</td>";
													echo "<td>" . $row['schedule_day'] . "</td>";
													echo "<td>" . $row['schedule_time'] . "</td>";
													echo "<td>" . "<a href=\"report6.php?myVar=$course_code&myVar2=$section\">".'View Class List'."</td>";
													echo "</tr>";
													}
														$ctr++;
													}
												
											
											?>
												</tbody>
                                    </table>
									<br /><br />
    Export : <input type="button" class="ExportBtn" value="Visible" /> <input class="ExportBtn" type="button" value="Full" />
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
		<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
		try {
		var pageTracker = _gat._getTracker("UA-365466-5");
		pageTracker._trackPageview();
		} catch(err) {}
		</script>
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
		
		
        <script src="../_public/vendors/datatables/js/jquery.dataTables.min.js"></script>
		<script src="../_public/assets/DT_bootstrap.js"></script>
        
		<script>
        $(function() {
            
        });
        </script>		
	</body>
</html>
<?php
	}else{
		header("location:index.php");
	}
?>
