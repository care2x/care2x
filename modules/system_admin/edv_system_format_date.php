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
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

$breakfile='edv-system-admi-welcome.php'.URL_APPEND;
$thisfile=basename(__FILE__);

if(!isset($mode)) $mode='';
if(!isset($date_format)) $date_format='';
if(!isset($validator)) $validator='';

$dbtable='care_config_global'; // Table name for global configurations
$GLOBAL_CONFIG=array();

$new_date_ok=0;

# Create global config object
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
	
if(($mode=='save')&&($date_format!='')&&(stristr($date_format,$validator))){  
	  $new_date_ok=$glob_obj->saveConfigItem('date_format',$date_format);
}else{
	if($glob_obj->getConfig('date_format')) $date_format=$GLOBAL_CONFIG['date_format'];
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
 $smarty->assign('sToolbarTitle',$LDDate);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('date_format_set.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDDate);

 # Buffer page output
 
 ob_start();

?>

<ul>
<FONT  SIZE=+2>
<?php echo $LDSetDateFormat ?> </FONT><FONT class="prompt"><p>
<?php
if(($mode=='save')&&$new_date_ok) echo '<img '.createMascot($root_path,'mascot1_r.gif','0','bottom').'> '.$LDNewDateFormatSaved.'<p>';
echo $LDSelectDateFormat;
?>
</font>

<form action="<?php echo $thisfile ?>" method="get">
<table border=0 cellspacing=1 cellpadding=5>  
<?php 
for($i=0;$i<sizeof($LDDateFormats);$i++)
{
  echo '<tr>
    <td bgcolor="#e9e9e9"><input type="radio" name="date_format" value="'.$LDDateFormats[$i].'"';
  if($date_format==$LDDateFormats[$i]) echo " checked";
  echo '></td>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc"><b>';
  $dfbuffer="LD_".strtr($LDDateFormats[$i],".-/","phs");
  echo $$dfbuffer;
  echo '</b> </FONT></td>
	<td>'.$LDDateFormatsTxt[$i].'<br></td>
	</tr>';
}
?>
</table>
<p>
<input type="image" <?php echo createLDImgSrc($root_path,'apply.gif','0') ?>>&nbsp;&nbsp;
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
<input type="hidden" name="sid" value="<?php echo $sid;?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="validator" value="<?php for($i=0;$i<sizeof($LDDateFormats);$i++) echo $LDDateFormats[$i]."_"; ?>">
</form>

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