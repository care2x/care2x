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
$lang_tables=array('indexframe.php');
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

$breakfile='edv-system-admi-welcome.php'.URL_APPEND;
if($from=='add') $returnfile='edv_system_format_menu_item_add.php'.URL_APPEND.'&from=set';
  else $returnfile=$breakfile;
$thisfile=basename(__FILE__);
$editfile='edv_system_format_menu_item_add.php'.URL_REDIRECT_APPEND.'&mode=edit&from=set&item_no=';
/**
* Load the db routine
*/

if(!isset($GCONFIG)) $GCONFIG=array();
include_once($root_path.'include/care_api_classes/class_globalconfig.php');
$gc=new GlobalConfig($GCONFIG);

if(isset($mode)&&($mode=='save')&&!empty($max_items)){
	
	for($i=1;$i<=$max_items;$i++){
		if(empty($_POST["value$i"])) $_POST["value$i"]='0';
		//echo $_POST["index$i"].'==>'.$_POST["value$i"].'<br>';
		$gc->saveConfigItem($_POST["index$i"],$_POST["value$i"]);
	}
	header('location:'.$thisfile.URL_REDIRECT_APPEND.'&mode=0');
	exit;
}else{
	$gc->getConfig('person_%_hide');
	$gc->getConfig('patient_%_hide');
	$gc->getConfig('patient_%_show');
	$gc->getConfig('show_billable_items');
	$gc->getConfig('show_doctors_list');
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
 $smarty->assign('sToolbarTitle',$LDDataEntryForms);

# href for return button
 $smarty->assign('pbBack',$returnfile);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('system_forms_set.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDDataEntryForms);

 if($rows) {
 	$smarty->append('JavaScript','<script language="javascript" src="'.$root_path.'js/check_menu_item_same_item.js"></script>');
}

# Buffer page output

ob_start();

?>
<ul>
<form method="post">
<table border=0 cellspacing=1 cellpadding=2>  
<tbody class="submenu">
  <tr class="wardlisttitlerow">
    <td><FONT  color="#000099"><b></b></td>
    <td><FONT  color="#000099"><b><?php echo $LDItem; ?></b></td>
   <td><FONT  color="#000099"><b><?php echo $LDStatus; ?></b></td>
  </tr>

<?php 
$i=1;
while(list($x,$v)=each($GCONFIG))
{
  echo '<tr>
	<td><img '.createComIcon($root_path,'post_discussion.gif','0').'></td>
	<td><FONT  color="#0000cc"><b>'.strtr($x,'_',' ').'</b> </FONT></td>
	<td align="center"><input type="checkbox" name="value'.$i.'" value="1" ';
	if($v) echo 'checked';
	echo '><input type="hidden" name="index'.$i.'" value="'.$x.'">
       </td>  
	</tr>';
	
	$i++;
}
?>
</tbody>
</table>
<?php
if($not_trans_id){
?>
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<?php
}
?>
<input type="hidden" name="max_items" value="<?php echo ($i-1); ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="save">
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?> border=0>

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
