<?php

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
//$db->debug = true;
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
//gjergji :
//data diff for the dob
function dateDiff($dformat, $endDate, $beginDate){
	$date_parts1=explode($dformat, $beginDate);
	$date_parts2=explode($dformat, $endDate);
	$start_date=gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
	$end_date=gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
	return $end_date - $start_date;
}
//gjergji :
//utility function to print out the arrows depending on age / sex
function checkParamValue($paramValue,$pName) {
	global $root_path,$patient;
	$txt = '';
	$dobDiff = dateDiff("-", date("Y-m-d"), $patient['date_birth']);
	switch ($dobDiff) {
	case ( ($dobDiff >= 1) and ($dobDiff <= 30 ) ) :
			if($pName['hi_bound_n']&&$paramValue>$pName['hi_bound_n']){
				$txt.='<img '.createComIcon($root_path,'arrow_red_up_sm.gif','0','',TRUE).'> <font color="red">'.htmlspecialchars($paramValue).'</font>';
			}elseif($paramValue<$pName['lo_bound_n']){
				$txt.='<img '.createComIcon($root_path,'arrow_red_dwn_sm.gif','0','',TRUE).'> <font color="red">'.htmlspecialchars($paramValue).'</font>';
			}else{
				$txt.=htmlspecialchars($paramValue);
			}
			break;
	case ( ($dobDiff >= 31) and ($dobDiff <= 360 ) ) :
			if($pName['hi_bound_y']&&$paramValue>$pName['hi_bound_y']){
				$txt.='<img '.createComIcon($root_path,'arrow_red_up_sm.gif','0','',TRUE).'> <font color="red">'.htmlspecialchars($paramValue).'</font>';
			}elseif($paramValue<$pName['lo_bound_y']){
				$txt.='<img '.createComIcon($root_path,'arrow_red_dwn_sm.gif','0','',TRUE).'> <font color="red">'.htmlspecialchars($paramValue).'</font>';
			}else{
				$txt.=htmlspecialchars($paramValue);
			}
			break;
	case ( $dobDiff >= 361) and ($dobDiff <= 5040 ) :
			if($pName['hi_bound_c']&&$paramValue>$pName['hi_bound_c']){
				$txt.='<img '.createComIcon($root_path,'arrow_red_up_sm.gif','0','',TRUE).'> <font color="red">'.htmlspecialchars($paramValue).'</font>';
			}elseif($paramValue<$pName['lo_bound_c']){
				$txt.='<img '.createComIcon($root_path,'arrow_red_dwn_sm.gif','0','',TRUE).'> <font color="red">'.htmlspecialchars($paramValue).'</font>';
			}else{
				$txt.=htmlspecialchars($paramValue);
			}
			break;	
	case $dobDiff > 5040 :
		if($patient['sex']=='m')
			if($pName['hi_bound']&&$paramValue>$pName['hi_bound']){
				$txt.='<img '.createComIcon($root_path,'arrow_red_up_sm.gif','0','',TRUE).'> <font color="red">'.htmlspecialchars($paramValue).'</font>';
			}elseif($paramValue<$pName['lo_bound']){
				$txt.='<img '.createComIcon($root_path,'arrow_red_dwn_sm.gif','0','',TRUE).'> <font color="red">'.htmlspecialchars($paramValue).'</font>';
			}else{
				$txt.=htmlspecialchars($paramValue);
			}	
		elseif($patient['sex']=='f')	
			if($pName['hi_bound_f']&&$paramValue>$pName['hi_bound_f']){
				$txt.='<img '.createComIcon($root_path,'arrow_red_up_sm.gif','0','',TRUE).'> <font color="red">'.htmlspecialchars($paramValue).'</font>';
			}elseif($paramValue<$pName['lo_bound_f']){
				$txt.='<img '.createComIcon($root_path,'arrow_red_dwn_sm.gif','0','',TRUE).'> <font color="red">'.htmlspecialchars($paramValue).'</font>';
			}else{
				$txt.=htmlspecialchars($paramValue);
			}																				
			break;
	}
	return $txt;
}

define('LANG_FILE','lab.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');
if(!isset($user_origin)) $user_origin='';

if($user_origin=='lab'||$user_origin=='lab_mgmt'){
  	$local_user='ck_lab_user';
  	if(isset($from) && $from=='input') $breakfile=$root_path.'modules/laboratory/labor_datainput.php'.URL_APPEND.'&encounter_nr='.$encounter_nr.'&job_id='.$job_id.'&parameterselect='.$parameterselect.'&allow_update='.$allow_update.'&user_origin='.$user_origin;
		else $breakfile=$root_path.'modules/laboratory/labor_data_patient_such.php'.URL_APPEND;
}else{
  	$local_user='ck_pflege_user';
  	$breakfile=$root_path.'modules/nursing/nursing-station-patientdaten.php'.URL_APPEND.'&pn='.$pn.'&edit='.$edit;
	$encounter_nr=$pn;
}
if(!$_COOKIE[$local_user.$sid]) {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

if(!$encounter_nr) header("location:".$root_path."modules/laboratory/labor_data_patient_such.php?sid=$sid&lang=$lang");

$thisfile=basename(__FILE__);

///$db->debug=1;

/* Create encounter object */
require_once($root_path.'include/care_api_classes/class_lab.php');
$enc_obj= new Encounter($encounter_nr);
$lab_obj=new Lab($encounter_nr);

$cache='';

if($nostat) $ret=$root_path."modules/laboratory/labor_data_patient_such.php?sid=$sid&lang=$lang&versand=1&keyword=$encounter_nr";
	else $ret=$root_path."modules/nursing/nursing-station-patientdaten.php?sid=$sid&lang=$lang&station=$station&pn=$encounter_nr";
	
# Load the date formatter */
require_once($root_path.'include/core/inc_date_format_functions.php');

$enc_obj->setWhereCondition("encounter_nr='$encounter_nr'");

if($encounter=&$enc_obj->getBasic4Data($encounter_nr)) {

	$patient=$encounter->FetchRow();

	$recs=&$lab_obj->getAllResults($encounter_nr);
	
	if ($rows=$lab_obj->LastRecordCount()){

		# Check if the lab result was recently modified
		$modtime=$lab_obj->getLastModifyTime();

		$lab_obj->getDBCache('chemlabs_result_'.$encounter_nr.'_'.$modtime,$cache);
		# If cache not available, get the lab results and param items
		if(empty($cache)){
			$records=array();
			$dt=array();
			while($buffer=&$recs->FetchRow()){
				# Prepare the values
				$tmp = array($buffer['paramater_name'] => $buffer['parameter_value']);
				$records[$buffer['job_id']][] = $tmp;
				$tdate[$buffer['job_id']]=&$buffer['test_date'];
				$ttime[$buffer['job_id']]=&$buffer['test_time'];		
			}
		}
	}else{
		if($nostat) header("location:".$root_path."modules/laboratory/labor-nodatafound.php".URL_REDIRECT_APPEND."&user_origin=$user_origin&ln=".strtr($patient['name_last'],' ','+')."&fn=".strtr($patient['name_first'],' ','+')."&bd=".formatDate2Local($patient['date_birth'],$date_format)."&encounter_nr=$encounter_nr&nodoc=labor&job_id=$job_id&parameterselect=$parameterselect&allow_update=$allow_update&from=$from");
		 	else header("location:".$root_path."modules/nursing/nursing-station-patientdaten-nolabreport.php?sid=$sid&lang=$lang&edit=$edit&station=$station&pn=$encounter_nr&nodoc=labor&user_origin=$user_origin");
			exit;
	}

}else{
	echo "<p>".$lab_obj->getLastQuery()."sql$LDDbNoRead";exit;
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
 $smarty->assign('sToolbarTitle',"$LDLabReport $station");

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('lab_list.php','','','','$LDLabReport')");

 # hide return  button
 $smarty->assign('pbBack',FALSE);

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDLabReport $station");

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

<script language="javascript">
<!-- Script Begin
var toggle=true;
function selectall(){

	d=document.labdata;
	var t=d.ptk.value;
	if(t == 1){
		if(toggle==true){ 
			d.tk.checked=true;
		}
	}else{
		for(i = 0; i<t; i++){
			if(toggle==true && d.tk[i]){
				d.tk[i].checked=true; 
			}
		}
	}
	if(toggle==false){ 
		d.reset();
	}
	toggle=(!toggle);
}

function prep2submit(){
	d=document.labdata;
	var j=false;
	var t=d.ptk.value;
	var n=false;
	for(i=0; i<t; i++) {
		if(t==1) {
			n=d.tk;
			v=d.tk.value;
		}else if( d.tk[i]){ 
			n=d.tk[i];
			v=d.tk[i].value;
		}
		if(n.checked==true && d.tk[i]){
			if(j){
				d.params.value=d.params.value +"~"+v;
			}else if( d.tk[i]){ 
				d.params.value=v;	
				j=1;
			}
		 }
	}
	if(d.params.value!=''){
		d.submit();
	}else{
		alert('<?php echo $LDCheckParamFirst ?>');
	}
}

function remove(s, t) {
  /*
  **  Remove all occurrences of a token in a string
  **    s  string to be processed
  **    t  token to be removed
  **  returns new string
  */
  i = s.indexOf(t);
  r = "";
  if (i == -1) return s;
  r += s.substring(0,i) + remove(s.substring(i + t.length), t);
  return r;
}

var skipme = '';
function wichOne(nr) {
	
	if( document.getElementById(nr).checked == true ) {
		if( skipme == '' ) skipme = nr;
		else skipme += "-"+nr;
	} else if ( document.getElementById(nr).checked == false ) 
		skipme = remove(skipme,nr);
}
	
	
function openReport() {
	enc = <?php echo $encounter_nr ?>;
	userId = '<?php echo $_SESSION['sess_user_name']; ?>';
	urlholder="<?php echo $root_path ?>modules/pdfmaker/laboratory/report_all.php<?php echo URL_REDIRECT_APPEND; ?>&encounter_nr="+enc+"&skipme="+skipme+"&userId="+userId;
	window.open(urlholder,'<?php echo $LDOpenReport; ?>',"width=700,height=500,menubar=no,resizable=yes,scrollbars=yes");
}
//  Script End -->
</script>

<?php 

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Assign patient basic elements
$smarty->assign('LDCaseNr',$LDCaseNr);
$smarty->assign('LDLastName',$LDLastName);
$smarty->assign('LDName',$LDName);
$smarty->assign('LDBday',$LDBday);

# Assign patient basic data
$smarty->assign('encounter_nr',$encounter_nr);
$smarty->assign('sLastName',$patient['name_last']);
$smarty->assign('sName',$patient['name_first']);
$smarty->assign('sBday',formatDate2Local($patient['date_birth'],$date_format));

# Assign link  to generate graphic display of results
$smarty->assign('sMakeGraphButton', '<img '.createComIcon($root_path,'chart.gif','0','absmiddle').'> '.$LDClk2Graph);
$smarty->assign('sOpenReport', '<img '.createComIcon($root_path,'printer.gif','0','absmiddle').'> '.$LDOpenReport);

# Buffer page output

ob_start();

echo '
<form action="labor-data-makegraph.php" method="post" name="labdata">
<table border=0 cellpadding=0 cellspacing=1>';

if(empty($cache)){

	# Get the number of colums
	$cols=sizeof($records);
	$cache= '
		<tr bgcolor="#dd0000" >
		<td class="va12_n"><font color="#ffffff"> &nbsp;<b>'.$LDParameter.'</b>
		</td>
		<td  class="j"><font color="#ffffff">&nbsp;<b>'.$LDNormalValue.'</b>&nbsp;</td>
		<td  class="j"><font color="#ffffff">&nbsp;<b>'.$LDMsrUnit.'</b>&nbsp;</td>
		';
	while(list($x,$v)=each($tdate)){
		$cache.= '
		<td class="a12_b"><font color="#ffffff">&nbsp;<b>'.formatDate2Local($v,$date_format).'<br>'.$x.'</b>&nbsp;<br><input type="checkbox" name="skipme[]" value="'.$x.'" id="'.$x.'" onclick="wichOne(this.id);"></td>';
	}
	
	$cache.= '
		<td>&nbsp;<a href="javascript:prep2submit()"><img '.createComIcon($root_path,'chart.gif','0','absmiddle',TRUE).' alt="'.$LDClk2Graph.'"></td></a></td></tr>
		<tr bgcolor="#ffddee" >
		<td class="va12_n"><font color="#ffffff"> &nbsp;
		</td>
		<td class="va12_n"><font color="#ffffff"> &nbsp;
		</td>
		<td  class="j"><font color="#ffffff">&nbsp;</td>';


	while(list($x,$v)=each($ttime)){
		$cache.= '
		<td class="a12_b"><font color="#0000cc">&nbsp;<b>'.convertTimeToLocal($v).'</b> '.$LDOClock.'&nbsp;</td>';
	}

	
	$cache.= '
		<td>&nbsp;<a href="javascript:selectall()"><img '.createComIcon($root_path,'dwnarrowgrnlrg.gif','0','absmiddle',TRUE).' alt="'.$LDClk2SelectAll.'"></a>
		</tr>';
//gjergji
//looks much better like this :)
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
while (list($groupId,$paramEnc)=each($requestData)) {
	$gName = $lab_obj->getGroupName($groupId) ;
	$cache .= "<tr><td  class=\"va12_n\" colspan=\"".($cols + 4)."\"><b>" .$gName->fields['name'] . "</b></td></tr>";
	while (list($paramId,$encounterNr)=each($paramEnc)) {
		$pName = $lab_obj->TestParamsDetails($paramId);
		$cache .=  "<tr>";
		$cache .=  "<td class=\"" . $class ."\">" . $pName['name'] . "</td>";
		$cache .=  "<td class=\"" . $class ."\">" . $pName['median'] . "</td>";
		$cache .=  "<td class=\"" . $class ."\">" . $pName['msr_unit'] . "</td>";
		for($i=0;$i<count($jIDArray);$i++) {			
			if(array_key_exists($jIDArray[$i],$encounterNr)) {	
				$cache .= "<td align=\"right\" class=\"" . $class ."\">";
				$cache .= checkParamValue($encounterNr[$jIDArray[$i]],$pName);
				$cache .= "</td>";
				$ptrack++;
				$columns++;
			} else {
				$cache .= "<td align=\"right\" class=\"" . $class ."\">&nbsp;</td>";
				$ptrack++;
				$columns++;
			}
		}
		$cache .= "<td align=\"right\" colspan=\"". ($cols-$columns+1) ."\" class=\"" . $class ."\"><input type=\"checkbox\" name=tk value=\"" . $pName['id'] . "\"></td></tr>";
		$class=='wardlistrow1' ? $class='wardlistrow2' : $class='wardlistrow1';	
		$columns=0;	
	}
}
//end:gjergji
$cache.='
	<input type="hidden" name="colsize" value="'.$cols.'">
	<input type="hidden" name="params" value="">
	<input type="hidden" name="ptk" value="'.$ptrack.'">
	';
# Delete old cache data first
$lab_obj->deleteDBCache('chemlabs_result_'.$encounter_nr.'_%');
# Save new cache data
$lab_obj->saveDBCache('chemlabs_result_'.$encounter_nr.'_'.$modtime,$cache);
}

# Show the lab results table from the cache

echo $cache;

echo '</table>';

echo '
<input type="hidden" name="sid" value="'.$sid.'">
<input type="hidden" name="from" value="'.$from.'">
<input type="hidden" name="encounter_nr" value="'.$encounter_nr.'">
<input type="hidden" name="edit" value="'.$edit.'">
<input type="hidden" name="lang" value="'.$lang.'">';

if($from=='input'){
	echo '
<input type="hidden" name="parameterselect" value="'.$parameterselect.'">
<input type="hidden" name="job_id" value="'.$job_id.'">
<input type="hidden" name="allow_update" value="'.$allow_update.'">';
}

echo '
<input type="hidden" name="user_origin" value="'.$user_origin.'">
</form>';

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->assign('sLabResultsTable',$sTemp);

$smarty->assign('sClose','<a href="'.$breakfile.'"><img '.createLDImgSrc($root_path,'close2.gif','0','absmiddle').' alt="'.$LDClose.'"></a>');

# Assign the include file to main frame template

 $smarty->assign('sMainBlockIncludeFile','laboratory/chemlab_data_results_show.tpl');

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
