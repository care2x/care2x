<?php

define('LAB_MAX_DAY_DISPLAY',7); # define the max number or days displayed at one time

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
///$db->debug=1;
$lang_tables=array('chemlab_groups.php','chemlab_params.php');
define('LANG_FILE','lab.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');

if($user_origin=='lab'||$user_origin=='lab_mgmt'){
	$local_user='ck_lab_user';
  	if(isset($from)&&$from=='input') $breakfile=$root_path.'modules/laboratory/labor_datalist_noedit.php'.URL_APPEND.'&encounter_nr='.$encounter_nr.'&job_id='.$job_id.'&parameterselect='.$parameterselect.'&allow_update='.$allow_update.'&user_origin='.$user_origin.'&from=input';
		else $breakfile=$root_path.'modules/laboratory/labor_datalist_noedit.php'.URL_APPEND.'&encounter_nr='.$encounter_nr.'&user_origin='.$user_origin;
}else{
  	$local_user='ck_pflege_user';
  	$breakfile=$root_path.'modules/laboratory/labor_datalist_noedit.php'.URL_APPEND.'&pn='.$encounter_nr.'&user_origin='.$user_origin.'&edit='.$edit;
}

if(!$_COOKIE[$local_user.$sid]) {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

if(!$encounter_nr) header("location:".$root_path."modules/laboratory/labor_data_patient_such.php?sid=$sid&lang=$lang");
require_once($root_path.'include/core/inc_config_color.php');

$thisfile=basename(__FILE__);

/* Create encounter object */
require_once($root_path.'include/care_api_classes/class_lab.php');
$enc_obj= new Encounter($encounter_nr);
$lab_obj=new Lab($encounter_nr);

//gjergji :
//diff for the date of birth
function dateDiff($dformat, $endDate, $beginDate){
	$date_parts1=explode($dformat, $beginDate);
	$date_parts2=explode($dformat, $endDate);
	$start_date=gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
	$end_date=gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
	return $end_date - $start_date;
}
//gjergji 
//display the median values
function medianValue($paramValue,$pName){
	global $patient;
	$txt = '';
	$diff = dateDiff("-", date("Y-m-d"), $patient['date_birth']);
	switch ($diff) {
		case ( ($diff >= 1) and ($diff <= 30 ) ) :
			if($pName['lo_bound_n']!=null&&$pName['hi_bound_n']!=null) $txt.=htmlspecialchars($pName['hi_bound_n'])."<p><br>".htmlspecialchars($pName['lo_bound_n']);
			break;
		case ( ($diff >= 31) and ($diff <= 360 ) ) :
			if($pName['lo_bound__y']&&$pName['hi_bound_y']) $txt.=htmlspecialchars($pName['hi_bound_y'])."<p><br>".htmlspecialchars($pName['lo_bound_y']);
			break;
		case ( $diff >= 361) and ($diff <= 5040 ) :
			if($pName['lo_bound_c']&&$pName['hi_bound_c']) $txt.=htmlspecialchars($pName['hi_bound_c'])."<p><br>".htmlspecialchars($pName['lo_bound_c']);
			break;
		case $diff > 5040 :
			if($patient['sex']=='m')
				if($pName['lo_bound']&&$pName['hi_bound']) $txt.=htmlspecialchars($pName['hi_bound'])."<p><br>".htmlspecialchars($pName['lo_bound']);
			elseif($patient['sex']=='f')
				if($pName['lo_bound_f']&&$pName['hi_bound_f']) $txt.=htmlspecialchars($pName['hi_bound_f'])."<p><br>".htmlspecialchars($pName['lo_bound_f']);	
			break;
	}
	return $txt;
}

//gjergji
//draw the graphs
function doGraph($paramValue,$pName,$valueBuff,$cols=1){
	global $patient,$root_path,$sid,$lang,$sessbuf;
	$txt = '';
	$diff = dateDiff("-", date("Y-m-d"), $patient['date_birth']);
	switch ($diff) {
		case ( ($diff >= 1) and ($diff <= 30 ) ) :
			echo $txt.'<img src="'.$root_path.'main/imgcreator/labor-datacurve.php?sid='.$sid.'&lang='.$lang.'&cols='.$cols.'&lo='.$pName['lo_bound_n'].'&hi='.$pName['hi_bound_n'].'&d='.$valueBuff.'" border=0>';
			break;
		case ( ($diff >= 31) and ($diff <= 360 ) ) :
			echo $txt.'<img src="'.$root_path.'main/imgcreator/labor-datacurve.php?sid='.$sid.'&lang='.$lang.'&cols='.$cols.'&lo='.$pName['lo_bound_y'].'&hi='.$pName['hi_bound_y'].'&d='.$valueBuff.'" border=0>';
			break;
		case ( $diff >= 361) and ($diff <= 5040 ) :
			echo $txt.'<img src="'.$root_path.'main/imgcreator/labor-datacurve.php?sid='.$sid.'&lang='.$lang.'&cols='.$cols.'&lo='.$pName['lo_bound_c'].'&hi='.$pName['hi_bound_c'].'&d='.$valueBuff.'" border=0>';
			break;
		case $diff > 5040 :
			if($patient['sex']=='m')
				echo $txt.'<img src="'.$root_path.'main/imgcreator/labor-datacurve.php?sid='.$sid.'&lang='.$lang.'&cols='.$cols.'&lo='.$pName['lo_bound'].'&hi='.$pName['hi_bound'].'&d='.$valueBuff.'" border=0>';
			elseif($patient['sex']=='f')
				echo $txt.'<img src="'.$root_path.'main/imgcreator/labor-datacurve.php?sid='.$sid.'&lang='.$lang.'&cols='.$cols.'&lo='.$pName['lo_bound_f'].'&hi='.$pName['hi_bound_f'].'&d='.$valueBuff.'" border=0>';
			break;
	}
	return $txt;	
}

if($nostat) $ret=$root_path."modules/laboratory/labor_data_patient_such.php?sid=$sid&lang=$lang&versand=1&keyword=$pn";
	else $ret=$root_path."modules/nursing/nursing-station-patientdaten.php?sid=$sid&lang=$lang&station=$station&pn=$pn";
	
# Load the date formatter
require_once($root_path.'include/core/inc_date_format_functions.php');

$enc_obj->setWhereCondition("encounter_nr='$encounter_nr'");

if($encounter=$enc_obj->getBasic4Data($encounter_nr)) {

	$patient=$encounter->FetchRow();

	$recs=&$lab_obj->getAllResults($encounter_nr);
	
	if ($rows=$lab_obj->LastRecordCount()){
		# Merge the records to common date key
		$records=array();
		$dt=array();
		while($buffer=$recs->FetchRow()){
			$tmp = array($buffer['paramater_name'] => $buffer['parameter_value']);
			$records[$buffer['job_id']][] = $tmp;
			$tdate[$buffer['job_id']]=&$buffer['test_date'];
			$ttime[$buffer['job_id']]=&$buffer['test_time'];
		}
		//gjergji :
		//reverse date from past to current
		//had to use $tdatePrint for the array_reverse() to work...
		$tdatePrint = array_reverse($tdate,true);
		$tdate = array_reverse($tdate);
		$ttime = array_reverse($ttime);
		$records = array_reverse($records,true);
	}else{
		if($nostat) header("location:".$root_path."modules/laboratory/labor-nodatafound.php?sid=$sid&lang=$lang&patnum=$pn&ln=$result[name]&fn=$result[vorname]&nodoc=labor");
		 	else header("location:".$root_path."modules/nursing/nursing-station-patientdaten-nolabreport.php?sid=$sid&lang=$lang&edit=$edit&station=$station&pn=$pn&nodoc=labor&user_origin=$user_origin");
			exit;
	}
}else{
	echo "<p>".$lab_obj->getLastQuery()."sql$LDDbNoRead";
	exit;
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Title in toolbar
 $smarty->assign('sToolbarTitle',"$LDLabReport - $LDGraph");

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('lab_list.php','graph','','','$LDGraph')");

 # hide return  button
 $smarty->assign('pbBack',FALSE);

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDLabReport - $LDGraph");

 # collect extra javascript code
 ob_start();
?>

<style type="text/css" name="1">
.va12_n{font-family:verdana,arial; font-size:12; color:#000099}
.a10_b{font-family:arial; font-size:10; color:#000000}
.a10_n{font-family:arial; font-size:10; color:#000099}
.a12_b{font-family:arial; font-size:12; color:#000000}
.j{font-family:verdana; font-size:12; color:#000000}
</style>

<?php 

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Assign patient basic elements
$smarty->assign('LDCaseNr',$LDCaseNr);
$smarty->assign('LDLastName',$LDLastName);
$smarty->assign('LDName',$LDName);
$smarty->assign('LDBday',LDBday);

# Assign patient basic data
$smarty->assign('encounter_nr',$encounter_nr);
$smarty->assign('sLastName',$patient['name_last']);
$smarty->assign('sName',$patient['name_first']);
$smarty->assign('sBday',formatDate2Local($patient['date_birth'],$date_format));
# Buffer page output

ob_start();

echo '
<form action="labor-data-makegraph.php" method="post" name="labdata">
<table border=0 cellpadding=0 cellspacing=1 class="frame">';

# Get the number of colums
$cols=sizeof($tdate);
echo'
   <tr bgcolor="#dd0000" >
     <td class="va12_n"><font color="#ffffff"> &nbsp;<b>'.$LDParameter.'</b>
	</td>
	<td  class="j"><font color="#ffffff">&nbsp;<b>'.$LDNormalValue.'</b>&nbsp;</td>
	<td  class="j"><font color="#ffffff">&nbsp;<b>'.$LDMsrUnit.'</b>&nbsp;</td>';
	while(list($x,$v)=each($tdatePrint))
	echo '
	<td class="a12_b"><font color="#ffffff" width="100px">&nbsp;<b>'.formatDate2Local($v,$date_format).'<br> '.$x.'</b>&nbsp;</td>';
	reset($tdate);
	
	
	echo '</tr>';
echo'
   <tr bgcolor="#ffddee" >
     <td class="va12_n"><font color="#ffffff">&nbsp;</td>
     <td class="va12_n"><font color="#ffffff">&nbsp;</td>
	 <td class="j"><font color="#ffffff">&nbsp;</td>';


	while(list($x,$v)=each($ttime))
	echo '
	<td class="a12_b" width="100px"><font color="#0000cc">&nbsp;<b>'.convertTimeToLocal($v).'</b> '.$LDOClock.'&nbsp;</td>';

	# Reset array
	reset($ttime);
	

# Prepare the graph values
$tparam=explode('~',$_POST['params']);
//order the values
$requestData=array();	
reset($records);
$jIDArray = array();
while (list($job_id,$paramgroupvalue)=each($records)) {
		$jIDArray[] = $job_id;
		foreach($paramgroupvalue as $paramgroup_a => $paramvalue_a) {
			foreach($paramvalue_a as $paramgroup => $paramvalue) {
				$ext = substr(stristr($paramgroup, '__'), 2);
				$requestData[$ext][$paramgroup][$job_id] = $paramvalue;
			}
		}
}

//display the values
$class='wardlistrow1';
$columns=0;
$ptrack=0;
$temp = '';
while (list($groupId,$paramEnc)=each($requestData)) {
	$valueBuff = '';
	$gName = $lab_obj->getGroupName($groupId) ;
	echo "<tr><td  class=\"va12_n\" colspan=\"".($cols + 3)."\"><b>" .$gName->fields['name'] . "</b></td></tr>";
	while (list($paramId,$encounterNr)=each($paramEnc)) {
		$pName = $lab_obj->TestParamsDetails($paramId);
		echo "<tr>";
		echo "<td class=\"" . $class ."\">" . $pName['name'] . "</td>";
		echo "<td class=\"" . $class ."\">" . medianValue($paramValue,$pName) . "</td>";
		echo "<td class=\"" . $class ."\">" . $pName['msr_unit'] . "</td>";
		for($i=0;$i<count($jIDArray);$i++) {		
			if(array_key_exists($jIDArray[$i],$encounterNr)) {
				$valueBuff == '' ? ($valueBuff = $encounterNr[$jIDArray[$i]]) : ($valueBuff .= '~' . $encounterNr[$jIDArray[$i]]);
				$ptrack++;
				$columns++;
			} else {
				$valueBuff == '' ? ($valueBuff = '0') : ($valueBuff .= '~'.'0');
				$ptrack++;
				$columns++;			
			}
		}
		if($cols != $columns)
			echo "<td align=\"right\" colspan=\"". ($cols - $columns) ."\" class=\"" . $class ."\">&nbsp;</td>";
		echo "<td align=\"right\" colspan=\"". $columns ."\" class=\"" . $class ."\">";
		echo doGraph($paramValue,$pName,$valueBuff,$columns)."</td>";	
		$valueBuff = '';
		echo "</tr>";
		$class=='wardlistrow1' ? $class='wardlistrow2' : $class='wardlistrow1';	
		$columns=0;	
	}
}
echo '
</table>
</form>';

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->assign('sLabResultsGraphTable',$sTemp);

$smarty->assign('sClose','<a href="'.$breakfile.'"><img '.createLDImgSrc($root_path,'close2.gif','0','absmiddle').' alt="'.$LDClose.'"></a>');

# Assign the include file to main frame template

 $smarty->assign('sMainBlockIncludeFile','laboratory/chemlab_data_results_graph.tpl');

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
