<html>
<head>

</head>
<body>
<?php
	if((isset($_SESSION['jquery_popup'])))  { unset($_SESSION['jquery_popup']); } //uncomment for testing
	
			
			
			$maintain_comp = mysql_result(mysql_query("SELECT component FROM tbl_grades WHERE class_class_id='$classID' AND category='AVG' AND score!='' ORDER BY grade_id DESC LIMIT 1"),0);
			$comp_ave = mysql_result(mysql_query("SELECT score FROM tbl_grades WHERE class_class_id='$classID' AND category='AVG' AND component='$maintain_comp'"),0);
			
			$check = mysql_result(mysql_query("SELECT count(*) FROM tbl_grades WHERE component='$maintain_comp' AND score='' AND class_class_id='$enrollID'"),0);
			if($check) { 
				$total = 0;
				$count = 0;
				$sql = mysql_query("SELECT * FROM tbl_grades WHERE component='$maintain_comp' AND category!='AVG' AND class_class_id='$enrollID'");
				while($row = mysql_fetch_array($sql)) {
					if($row['score']!='') {
						$total += ($row['score']/$row['noOfItems']) * 100;
						$count++;
					}
				}
				$aim = (70 * ($count+1)) - $total; 
				$aim = number_format($aim, 2, '.', '');
			}
			else {
				$percent =0;
				$ave2 = mysql_result(mysql_query("SELECT score FROM tbl_grades WHERE component='$maintain_comp' AND category='AVG' AND class_class_id='$enrollID'"),0);
				$sql = mysql_query("SELECT * FROM tbl_defaultcomponent");
				while($row = mysql_fetch_array($sql)) {
					if($row['name']==$maintain_comp) {
							$ave3 = $ave2 * ($row['percentage']/100);
							$percent = $row['percentage'];
						$next = $row['default_id'];
					}
					else if($row['default_id']==($next+1)) {
						$percent += $row['percentage'];
						if($row['required_number']>1) {
							$nameID = $row['name'].'-1';	
						}
						else {$nameID = $row['name'];	 }
						
						$aim = (($percent*0.7) - $ave3)/($row['percentage']/100);
						$aim = number_format($aim, 2, '.', '');
						break;
					}
				}
			}
			if($nameID) {}
			
			else {
			
			?>
     
                <div class="span3" id="sidebar">
                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                    	
			<li>
                            <a href=""><?php echo '<b>'.$maintain_comp.'</b><br> AVERAGE= '; if($comp_ave<70) { echo '<font color="red">'.$comp_ave.'</font> NEED: '.$aim .'for'. $maintain_comp.'<br>'; } else { echo "$comp_ave";?></a></li>
                            <li>
                            <a href=""> <?php echo" MAINTAIN: $aim<br>"; } } ?></a> </li>
                       <li>
                            <a href=""> <?php $m_final = mysql_result(mysql_query("SELECT grade FROM tbl_finalgrade WHERE class_class_id='$classID'"),0);
			echo "<b>Final Grade:</b> $m_final";
			if($nameID) { echo $nameID.' AVERAGE = '; if($ave3<70) { echo '<font color="red">'.$ave3.'</font> NEED:'.$aim.' for '.$nameID; } else { echo "$ave3 MAINTAIN: $aim"; } } ?></a>
                        </li>

                    </ul>
                </div>
		</body>
</html>                                