<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/

# Default maximum values for the time out time
$def_max_hours=0; 
$def_max_mins=15; # 15 minutes
$def_max_secs=59; # 59 seconds

$lang_tables[]='startframe.php';
$lang_tables[]='date_time.php';
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

$breakfile='edv-system-admi-welcome.php'.URL_APPEND;
$thisfile=basename(__FILE__);

$GLOBAL_CONFIG=array();
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
# Create object linking our global config array to the object
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);

# Save data if save mode
if(isset($mode) && $mode=='save'){

	# Validate time values
	if(!is_numeric($_POST['thours'])||$_POST['thours']>24) $_POST['thours']=0;
	if(!is_numeric($_POST['tmins'])||$_POST['tmins']>59||$_POST['tmins']<1) $_POST['tmins']=$def_max_mins;
	if(!is_numeric($_POST['tsecs'])||$_POST['tsecs']>59) $_POST['tsecs']=$def_max_tsecs;
	
	# combine the values to final format HoursMinsSecs
	//$_POST['timeout_time']=$_POST['thours'].$_POST['tmins'].$_POST['tsecs'];
	$_POST['timeout_time']=date('His',mktime($_POST['thours'],$_POST['tmins'],$_POST['tsecs'],1,1,1971));
	
	$filter='timeout_'; # The index filter

	$numeric=FALSE; # Values are not strictly numeric
	$addslash=FALSE; # Slashes should be added to the stored values

	# Save the configuration
	$glob_obj->saveConfigArray($_POST,$filter,$numeric,'',$addslash);

	# Loop back to self to get the newly stored values
	header("location:$thisfile".URL_REDIRECT_APPEND."&save_ok=1");
	exit;
# Else get current global data
}else{ 
	$glob_obj->getConfig('timeout_%');
	# Parse the time value to hours mins and secs
	$buffer='000000'.$GLOBAL_CONFIG['timeout_time'];
	$thours=substr($buffer,-6,2);
	$tmins=substr($buffer,-4,2);
	$tsecs=substr($buffer,-2);
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$LDTimeOut);

# href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('timeout.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDTimeOut);

 # Buffer page output

 ob_start();
?>


<ul>
<FONT class="prompt">
<p>
<?php

if(isset($save_ok) && $save_ok) echo '<img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'>'.$LDDataSaved.'<p>';

echo $LDEnterInfo;

?>
</font>
<p>

<form action="<?php echo $thisfile ?>" method="post" name="quickinfo">
<table border=0 cellspacing=1 cellpadding=5>  
<tr valign=top>
	<td class="wardlisttitlerow" align="right"><FONT  color="#0000cc"><b><nobr><?php echo $LDTimeOutActive ?></nobr></b> </FONT></td>
	<td class="wardlistrow1">
		<input type="radio" name="timeout_inactive" value="0" <?php if(!$GLOBAL_CONFIG['timeout_inactive']) echo 'checked' ?>> <nobr><?php echo $LDYes ?>&nbsp;&nbsp;&nbsp;
		<input type="radio" name="timeout_inactive" value="1" <?php if($GLOBAL_CONFIG['timeout_inactive']) echo 'checked' ?>> <?php echo $LDNo ?></nobr>
	</td>  
	<td class="wardlistrow2"><?php echo $LDTimeOutTxt ?></td>
	</tr>
<tr valign=top>
	<td  class="wardlisttitlerow"  align="right"><FONT  color="#0000cc"><b><nobr><?php echo $LDTimeOutTime ?></nobr></b> </FONT></td>
	<td class="wardlistrow1"><nobr>
	<input type="text" name="thours" size=2 maxlength=2 value=<?php echo $thours ?>> <?php echo $LDHours ?>&nbsp;
 	<input type="text" name="tmins" size=2 maxlength=2 value=<?php echo $tmins ?>> <?php echo $LDMinutes ?>&nbsp;
	<input type="text" name="tsecs" size=2 maxlength=2 value=<?php echo $tsecs ?>> <?php echo $LDSeconds ?></nobr>

	</td>  
	<td class="wardlistrow2"><?php echo $LDTimeOutTimeTxt ?></td>
	</tr>
</table>
<p>
<?php if($item_no) $save_button='update.gif'; else $save_button='savedisc.gif'; ?>
<input type="image" <?php echo createLDImgSrc($root_path,$save_button,'0') ?>>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
<?php if($item_no) : ?>
<a href="<?php echo $thisfile.''.URL_APPEND.'&from='.$from ?>"><img <?php echo createLDImgSrc($root_path,'newcurrency.gif','0') ?>></a>
<?php endif ?>
<input type="hidden" name="sid" value="<?php echo $sid;?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="save">
</form>
<p>
</ul>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign page output to the mainframe template

$smarty->assign('sMainFrameBlockData',$sTemp);
 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
