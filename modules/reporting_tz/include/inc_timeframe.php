<?php
$curr_month = date("n", time());
$curr_year = date("Y", time());
 
for ($y=$curr_year; $y>=$curr_year-3; $y--) {

	$ARR_SELECT_YEAR[$y] = FALSE;
	$ARR_YEAR[$y]=$y;


}
echo $ARR_YEAR[$y];

for ($i==1; $i<12 ; $i++)
		$ARR_SELECT_MONTH[$i]=FALSE;

if ($_POST['show']==TRUE) {
	
	$ARR_SELECT_YEAR[$_POST['year']] = TRUE;
	$ARR_SELECT_MONTH[$_POST['month']]=TRUE;
	
	if (($_POST['month'])==-1 || $_POST['year']==-1 ) {
		for ($i==1; $i<12 ; $i++)
			$ARR_SELECT_MONTH[$i]=FALSE;
		
		for ($y=$curr_year; $y>=$curr_year-3; $y--) {
			$ARR_SELECT_YEAR[$y] = FALSE;
			$ARR_YEAR[$y]=$y;
		}
		$ARR_SELECT_YEAR[$curr_year] = TRUE;
		$ARR_SELECT_MONTH[$curr_month]=TRUE;		
	
		$start_month_timestamp = mktime(0,0,0,$curr_month,1,$curr_year);
		$end_month_timestamp = mktime(0,0,0,$curr_month+1,1,$curr_year);
	
		
	} else {
		$start_month_timestamp = mktime(0,0,0,$_POST['month'],1,$_POST['year']);
		$end_month_timestamp = mktime(0,0,0,$_POST['month']+1,1,$_POST['year']);
	}
	
	
} else {
	
	// This is the first call of this page!
	
	$ARR_SELECT_YEAR[$curr_year] = TRUE;
	$ARR_SELECT_MONTH[$curr_month]=TRUE;
	$start_month_timestamp = mktime(0,0,0,$curr_month,1,$curr_year);
	$end_month_timestamp = mktime(0,0,0,$curr_month+1,1,$curr_year);
	
} // end of if ($_POST['show']==TRUE) 
?>
