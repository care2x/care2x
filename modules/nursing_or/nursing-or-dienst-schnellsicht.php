<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/

# To deactivate the cache, set $force_no_cache to true
$force_no_cache=1;

$lang_tables[]='departments.php';
$lang_tables[]='prompt.php';
define('LANG_FILE','or.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

# Create the core object
require_once($root_path.'include/care_api_classes/class_core.php');
$core=new Core;

if (!empty($_SESSION['sess_path_referer'])){
	$breakfile=$_SESSION['sess_path_referer'];
} else {
	/* default startpage */
	$breakfile = $root_path.'main/op-doku.php';
}

$breakfile=$root_path.$breakfile.URL_APPEND;
$thisfile=basename(__FILE__);

//$db->debug=1;

switch($retpath)
{
	case "docs": $breakfile='doctors.php'.URL_APPEND; break;
	case "op": $breakfile='op-doku.php'.URL_APPEND; break;
}


$pday=date(j);
$pmonth=date(n);
$pyear=date(Y);
$abtarr=array();
$abtname=array();
$datum=date("d.m.Y");

#
# Prepare the date. We need to consider the early morning hours or until the NOC_CHANGE_TIME value has passed
#
$plan_yesterday=date('Y-m-d',mktime(0,0,0,date('m'),date('d')-1,date('Y')));

if(date('H.i')<NOC_CHANGE_TIME){
	$plan_date=$plan_yesterday;
	$plan_day=date('d',mktime(0,0,0,date('m'),date('d')-1,date('Y')));
}else{
	$plan_date=date('Y-m-d');
	$plan_day=date('d');

	#
	# If plan date is today, attempt to delete the cached plan of yesterday
	#
	$core->deleteDBCache('NOCS_'.$plan_yesterday);
}

# Get the cached plan

	$cached_plan='';
	$is_cached=$core->getDBCache('NOCS_'.$plan_date,$cached_plan);

if(!$is_cached || ($is_cached && $force_no_cache)){
	if(!$hilitedept){
		if($dept_nr) $hilitedept=$dept_nr;
	}
	# Load the department list with oncall doctors 
	include_once($root_path.'include/care_api_classes/class_department.php');
	$dept_obj=new Department;
	$dept_OC=$dept_obj->getAllActiveWithNOC();
	include_once($root_path.'include/care_api_classes/class_personell.php');
	$pers_obj=new Personell;
	$quicklist=&$pers_obj->getNOCQuicklist($dept_OC,$pyear,$pmonth);
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
 $smarty->assign('sToolbarTitle',"$LDORNOC :: $LDQuickView");

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('op_duty.php','quick')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Body onLoad javascript
 $smarty->assign('sOnLoadJs','onUnload="killchild()"');

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDORNOC :: $LDQuickView");

 # Collect extra javascript

 ob_start();

?>

<script language="javascript">
<!-- 
  var urlholder;
function popinfo(l,d)
{
	urlholder="nursing-or-dienstplan-popinfo.php<?php echo URL_REDIRECT_APPEND ?>&nr="+l+"&dept_nr="+d+"&user=<?php echo $aufnahme_user.'"' ?>;
	
	infowin=window.open(urlholder,"dienstinfo","width=400,height=300,menubar=no,resizable=yes,scrollbars=yes");

}

-->
</script>

<?php 

 $sTemp=ob_get_contents();
 ob_end_clean();
 $smarty->append('JavaScript',$sTemp);
 
 # Buffer page output
 
 ob_start();

?>

	<table  cellpadding="2" cellspacing=0 border="0" >
	<tr class="wardlisttitlerow" align=center>
<?php

for($j=0;$j<sizeof($LDTabElements);$j++)
	echo '<td >&nbsp; '.$LDTabElements[$j].' &nbsp;&nbsp;</td>';
echo '
	</tr>';

if(!$force_no_cache&&$is_cached){

/*	echo '<tr>
	<td colspan=6><font face="verdana,arial" size=2> <img '.createComIcon($root_path,'warn.gif','0').'> <font color=red>'.$LDCachedInfo.'</font> <a href="'.$thisfile.URL_APPEND.'&force_no_cache=1&retpath='.$retpath.'">'.$LDClkNoCache.'</a>
	</td>
	</tr>';
*/
	$cached_plan=str_replace('URLAPPEND',URL_APPEND,$cached_plan);
	$cached_plan=str_replace('IMGALT',$LDShowActualPlan,$cached_plan);
	$cached_plan=str_replace('SHOWBUTTON',$LDShow,$cached_plan);
	echo str_replace('URLREDIRECTAPPEND',URL_REDIRECT_APPEND,$cached_plan);
}else{

	$toggler=0;

	# Start generating the NOC list
	$temp_out='';

	while(list($x,$v)=each($dept_OC)){
	
	if(in_array($v['nr'],$quicklist)){
		if($dutyplan=$pers_obj->getNOCDutyplan($v['nr'],$pyear,$pmonth)){
	
			$a=unserialize($dutyplan['duty_1_txt']);	
			$r=unserialize($dutyplan['duty_2_txt']);
			$ha=unserialize($dutyplan['duty_1_pnr']);
			$hr=unserialize($dutyplan['duty_2_pnr']);	
			if($ha['ha'.($plan_day-1)]) $OC_1=$pers_obj->getPersonellInfo($ha['ha'.($plan_day-1)]);
			if($hr['hr'.($plan_day-1)]) $OC_2=$pers_obj->getPersonellInfo($hr['hr'.($plan_day-1)]);
		}
	
	}else{
		if(isset($a)) unset($a);
		if(isset($r)) unset($r);
		if(isset($ha)) unset($ha);
		if(isset($hr)) unset($hr);
		if(isset($OC_1)) unset($OC_1);
		if(isset($OC_2)) unset($OC_2);
	}

	
	$bold='';
	$boldx='';
	if($hilitedept==$v['nr']) 	{ $temp_out.='<tr class="hilite">'; $bold="<font color=\"red\" size=2><b>";$boldx="</b></font>"; }
	else
		if ($toggler==0) 
			{ $temp_out.='<tr class="wardlistrow1">'; $toggler=1;}
				else { $temp_out.='<tr class="wardlistrow2">'; $toggler=0;}
	$temp_out.='<td ><font size="1" >&nbsp;'.$bold;
				
	//echo '<td ><font face="verdana,arial" size="1" >&nbsp;'.$bold.$v['name_formal'].$boldx.'&nbsp;</td><td >&nbsp;<font face="verdana,arial" size="2" >
	
	if(isset($$v['LD_var'])&&!empty($$v['LD_var'])) $temp_out.=$$v['LD_var'];
	 	else $temp_out.=$v['name_formal'];
	$temp_out.=$boldx.'&nbsp;</td><td >&nbsp;
	<img '.createComIcon($root_path,'mans-gr.gif','0').'>&nbsp;';
	
	//if ($aelems[l]!="") echo $aelems[l].', ';
	//echo $aelems[f].'</b></a></td>';
	if(in_array($v['nr'],$quicklist)&&$OC_1['name_last']){$temp_out.='<a href="javascript:popinfo(\''.$ha['ha'.(date('d')-1)].'\',\''.$v['nr'].'\')" title="Click für mehr Info."><b>'.$OC_1['name_last'].', '.$OC_1['name_first'].'</b></a>'; }
	$temp_out.='</td>
	<td>';
	if ($a['a'.(date('d')-1)]!='') 
	{
		$temp_out.=' <font color=red> '.$OC_1['funk1'].'</font>';
		if($OC_1['inphone1']) $temp_out.=' / '.$OC_1['inphone1'];
	}
	$temp_out.='&nbsp;
	</td><td>
	<img '.createComIcon($root_path,'mans-red.gif','0').'>&nbsp;';
	if(in_array($v['nr'],$quicklist)&&$OC_2['name_last']){$temp_out.='<a href="javascript:popinfo(\''.$hr['hr'.(date('d')-1)].'\',\''.$v['nr'].'\')" title="Click für mehr Info."><b>'.$OC_2['name_last'].', '.$OC_2['name_first'].'</b></a>';}
	$temp_out.='</td>
	<td>';
	if ($r['r'.(date('d')-1)]!='') 
	{
		$temp_out.=' <font color=red> '.$OC_2['funk1'].'</font>';
		if($OC_2['inphone1']) $temp_out.=' / '.$OC_2['inphone1'];
	}

	$temp_out.='&nbsp;
	</td><td >&nbsp; <a href="nursing-or-dienstplan.phpURLAPPEND&dept_nr='.$v['nr'].'&retpath=qview">
	<button onClick="javascript:window.location.href=\'nursing-or-dienstplan.phpURLREDIRECTAPPEND&dept_nr='.$v['nr'].'&retpath=qview\'"><img '.createComIcon($root_path,'new_address.gif','0','absmiddle').' alt="IMGALT" ><font size=1> SHOWBUTTON </font></button></a> </td></tr>';
}

# Save in cache
if(!$force_no_cache || ($force_no_cache && !$is_cached) ) $dept_obj->saveDBCache('NOCS_'.date('Y-m-d'),addslashes($temp_out));

# Display list
$temp_out=str_replace('URLAPPEND',URL_APPEND,$temp_out);
$temp_out=str_replace('IMGALT',$LDShowActualPlan,$temp_out);
$temp_out=str_replace('SHOWBUTTON',$LDShow,$temp_out);
echo str_replace('URLREDIRECTAPPEND',URL_REDIRECT_APPEND,$temp_out);
}
?>
</table>
<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"></a>

<?php

$sTemp = ob_get_contents();
 ob_end_clean();

# Assign the buffer output  to main frame template

$smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
