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

if(!isset($GCONFIG)) $GCONFIG=array();
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$gc=new GlobalConfig($GCONFIG);

if(isset($mode)&&($mode=='save')&&!empty($max_items)){
	
	$gc->saveConfigItem('theme_control_buttons',$_POST['theme_control_buttons']);
	header('location:'.$thisfile.URL_REDIRECT_APPEND.'&mode=0');
	exit;
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
 $smarty->assign('sToolbarTitle',$LDTheme);

# href for return button
 $smarty->assign('pbBack',$returnfile);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('system_theme.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDTheme);

 if($rows) {
 	$smarty->append('JavaScript','<script language="javascript" src="'.$root_path.'js/check_menu_item_same_item.js"></script>');
}

# Buffer page output

ob_start();

?>

<FONT  color="#000066" size=4><?php echo $LDControlButImg; ?></font>
<form method="post">
<table border=0 cellspacing=1 cellpadding=2>  

  <tr background="../../gui/img/common/default/tableHeaderbg3.gif">
    <td><FONT  color="#000099"><b></b></td>
    <td><FONT  color="#000099"><b></b></td>
   <td><FONT  color="#000099"><b><?php echo $LDStatus; ?></b></td>
  </tr>

<?php 
	$gc->getConfig('theme_control_%');

  echo '<tr>
	<td bgcolor="#e9e9e9"><img '.createComIcon($root_path,'arrow_blueW.gif','0').'></td>
	<td bgcolor="#e9e9e9"><FONT  color="#0000cc"><b>'.$LDControlButImg.'</b> </FONT></td>';
	echo '
	<td bgcolor="#e9e9e9" >
	<select name="theme_control_buttons">';
	
	$tlist=explode(',',$GCONFIG['theme_control_theme_list']);
	while(list($x,$v)=each($tlist)){
		echo '<option value="'.$v.'"';
		if($GCONFIG['theme_control_buttons']==$v) echo ' selected';
		echo '>
		'.$v.'
		</option>';
	}
	echo '</select><input type="hidden" name="index'.$i.'" value="'.$x.'">
       </td>  
	</tr>';

?>
  <tr >
    <td colspan=3><input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?> border=0></td>
  </tr>
  <tr >
    <td colspan=3>&nbsp;</td>
  </tr>
  
  <tr bgcolor="#e9e9e9" background="../../gui/img/common/default/tableHeaderbg3.gif">
    <td><FONT  color="#000099"><b></b></td>
    <td><FONT  color="#000099"><b><?php echo $LDTheme; ?></b></td>
   <td><FONT  color="#000099"><b><?php echo $LDSampleButtons; ?></b></td>
  </tr>
<?php
reset($tlist);
while(list($x,$v)=each($tlist)){
?>
  <tr  bgcolor="#e9e9e9" >
    <td><FONT  color="#000099"><b></b></td>
    <td><b><?php echo $v; ?></b></td>
   <td><img src="<?php echo $root_path; ?>gui/img/control/<?php echo $v; ?>/<?php echo $lang; ?>/<?php echo $lang; ?>_back2.gif" border=0>
   			<img src="<?php echo $root_path; ?>gui/img/control/<?php echo $v; ?>/<?php echo $lang; ?>/<?php echo $lang; ?>_hilfe-r.gif" border=0>
   			<img src="<?php echo $root_path; ?>gui/img/control/<?php echo $v; ?>/<?php echo $lang; ?>/<?php echo $lang; ?>_cancel.gif" border=0></td>
  </tr>
<?php
}
?>
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
</form>

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
