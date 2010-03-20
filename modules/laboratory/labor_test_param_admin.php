<?php

define('ROW_MAX',15); # define here the maximum number of rows for displaying the parameters

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
//$lang_tables=array('chemlab_groups.php','chemlab_params.php');
define('LANG_FILE','lab.php');
$local_user='ck_lab_user';
require_once($root_path.'include/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);

///$db->debug=true;

# Create lab object
require_once($root_path.'include/care_api_classes/class_lab.php');
$lab_obj=new Lab();

if(!isset($parameterselect)||$parameterselect=='') $parameterselect='priority';

$pitems=array('msr_unit','median','lo_bound','hi_bound','lo_critical','hi_critical','lo_toxic','hi_toxic');

# Load the date formatter */
include_once($root_path.'include/inc_date_format_functions.php');
    
# Get the test test groups
$tgroups=&$lab_obj->TestActiveGroups();

# Get the test parameter values
$tparams=&$lab_obj->TestParamsAdmin($parameterselect);
$breakfile="labor.php".URL_APPEND;

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$LDTestParameters);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('lab_param_config.php')");

 # hide return  button
 $smarty->assign('pbBack',FALSE);

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDTestParameters);

 # collect extra javascript code
 ob_start();
?>

<script language="javascript" name="j1">
<!--        
function chkselect(d)
{
 	if(d.parameterselect.value=="<?php echo $parameterselect ?>"){
		return false;
	}
}

function editParam(nr)
{
	urlholder="<?php echo $root_path ?>modules/laboratory/labor_test_param_edit.php?sid=<?php echo "$sid&lang=$lang" ?>&nr="+nr;
	editparam_<?php echo $sid ?>=window.open(urlholder,"editparam_<?php echo $sid ?>","width=510,height=390,menubar=no,resizable=yes,scrollbars=yes");
}

function newParam()
{
	urlholder="<?php echo $root_path ?>modules/laboratory/labor_test_param_edit.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=new";
	editparam_<?php echo $sid ?>=window.open(urlholder,"editparam_<?php echo $sid ?>","width=510,height=390,menubar=no,resizable=yes,scrollbars=yes");
}
// -->
</script>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

$sTempNew = '<a href="javascript:newParam()"><img '.createLDImgSrc($root_path,'newplan.gif','0').'></a>';	
$paramName = &$lab_obj->getGroupName($parameterselect);
if(isset($paramName) && !empty($paramName)) {
	$paramName = $paramName->fetchRow();
}
# Assign elements
$smarty->assign('sParamNew',$sTempNew);
$smarty->assign('sParamGroup',$sTemp. $paramName['name'] );
$smarty->assign('LDParameter',$LDParameter);
$smarty->assign('LDMsrUnit',$LDMsrUnit);
$smarty->assign('LDMedian',$LDMedian);
$smarty->assign('LDLowerBound',$LDLowerBound);
$smarty->assign('LDUpperBound',$LDUpperBound);
$smarty->assign('LDLowerCritical',$LDLowerCritical);
$smarty->assign('LDUpperCritical',$LDUpperCritical);
$smarty->assign('LDLowerToxic',$LDLowerToxic);
$smarty->assign('LDUpperToxic',$LDUpperToxic);

$smarty->assign('sFormAction',$thisfile);
$smarty->assign('LDSelectParamGroup',$LDSelectParamGroup);
$smarty->assign('LDParamGroup',$LDParamGroup);

# Generate and buffer parameter rows

ob_start();

$toggle=0;

if(is_object($tparams)){
 while($tp=$tparams->FetchRow()){

	//if($toggle) $bgc='#ffffee'; else $bgc='#efefef';
	if($toggle) $bgc='wardlistrow1'; else $bgc='wardlistrow2';
	$toggle=!$toggle;
	if($tp['status']=='hidden') {
		echo '
		<tr bgcolor="green">
		<td ><nobr>&nbsp;';		
	} elseif($tp['status']=='deleted') {
		echo '
		<tr bgcolor="red">
		<td ><nobr>&nbsp;';	
	} else {
		echo '
		<tr class="'.$bgc.'">
		<td ><nobr>&nbsp;';	
	}

	
	if(isset($parameters[$tp['id']])&&!empty($parameters[$tp['id']])) echo $parameters[$tp['id']];
		else echo $tp['name'];
	
	echo '&nbsp;</nobr></td>';

	while(list($x,$v)=each($pitems)){
		echo '
			<td>';
		if($x){
			if($tp[$v]>0) echo $tp[$v];
		}else{
			echo $tp[$v];
		}
		echo '&nbsp;
			</td>';
	}
	reset($pitems);
	
	echo '
			<td>
			<a href="javascript:editParam('.$tp['nr'].')"><img '.createLDImgSrc($root_path,'edit_sm.gif','0').'></a>
			</td>';
	echo '
		</tr>';
 }
}

$sTemp = ob_get_contents();

ob_end_clean();
$sShortHelp = $sShortHelp.  "<font color=\"green\">$LDHiddenParams</font><br>";
$sShortHelp = $sShortHelp.   "<font color=\"red\">$LDDeletedParams</font><br>";
$smarty->assign('sTestParamsRows',$sTemp);
$smarty->assign('sShortHelp',$sShortHelp);
# Create the parameter group select

$sTemp = '<select name="parameterselect" size=1>';

while($tg=$tgroups->FetchRow()){
	$sTemp = $sTemp.'<option value="'.$tg['id'].'"';
	if($parameterselect==$tg['id']) $sTemp = $sTemp.' selected';
	$sTemp = $sTemp.'>';
	if(isset($parametergruppe[$tg['id']])&&!empty($parametergruppe[$tg['group_id']])) $sTemp = $sTemp.$parametergruppe[$tg['id']];
		else $sTemp = $sTemp.$tg['name'];
	$sTemp = $sTemp.'</option>';
	$sTemp = $sTemp."\n";
}
$sTemp = $sTemp.'</select>';

$smarty->assign('sParamGroupSelect',$sTemp);

# Assign the parameter group hidden and submit inputs


$smarty->assign('sSubmitSelect','<input type=hidden name="sid" value="'.$sid.'">
	<input type=hidden name="lang" value="'.$lang.'">
	<input  type="image" '.createLDImgSrc($root_path,'auswahl2.gif','0').'>');

 $smarty->assign('sMainBlockIncludeFile','laboratory/test_params.tpl');

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
