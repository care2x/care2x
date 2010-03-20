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
$lang_tables=array('indexframe.php');
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');

$breakfile='edv-system-admi-welcome.php'.URL_APPEND;
if($from=='add') $returnfile='edv_system_format_menu_item_add.php'.URL_APPEND.'&from=set';
  else $returnfile=$breakfile;
$thisfile=basename(__FILE__);
$editfile='edv_system_format_menu_item_add.php'.URL_REDIRECT_APPEND.'&mode=edit&from=set&item_no=';
/**
* Load the db routine
*/
$GLOBALCONFIG=array();

require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$gc=new GlobalConfig($GLOBALCONFIG);

if(isset($mode)&&($mode=='save')){
	

/*	$db->Execute("REPLACE INTO care_config_global (type,value) VALUES ('gui_frame_left_nav_resize','$bg_resize')";

	if(!empty($bg_width)){
		$db->Execute("REPLACE INTO care_config_global (type,value) VALUES ('gui_frame_left_nav_width','$bg_width')";
	}
	if(!empty($bg_color)){
		$db->Execute("REPLACE INTO care_config_global (type,value) VALUES ('gui_frame_left_nav_border','$bg_border')";
	}
*/	
	//echo $bg_resize; exit;
	$gc->saveConfigItem('gui_frame_left_nav_border',$bg_border);
	$gc->saveConfigItem('gui_frame_left_nav_width',$bg_width);
	$gc->saveConfigItem('gui_frame_left_nav_bdcolor',$bg_bdcolor);
	$gc->saveConfigItem('language_single',$multilang);
	$gc->saveConfigItem('language_default',$deflang);
		
header('location:'.$thisfile.URL_REDIRECT_APPEND.'&mode=0');
	exit;
}

$gc->getConfig('gui_frame_left_nav_%');
$gc->getConfig('language_%');

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$LDMainMenu);

# href for return button
 $smarty->assign('pbBack',$returnfile);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('system_menudisplay.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDMainMenu);

 if($rows) {
 	$smarty->append('JavaScript','<script language="javascript" src="'.$root_path.'js/check_menu_item_same_item.js"></script>');
}

# Buffer page output

ob_start();

?>
<br>
<form>
<table border=0 cellspacing=1 cellpadding=2>  
<tbody class="submenu">
  <tr>
    <td><FONT  color="#000099" FACE="verdana,arial" size=2></td>
    <td class="wardlisttitlerow"><FONT  color="#000099" FACE="verdana,arial" size=2><b><?php echo $LDFrameResizable; ?></b></td>
    <td>	<input type="radio" name="bg_border" value="1" <?php if($GLOBALCONFIG['gui_frame_left_nav_border']) echo 'checked'; ?>> <?php echo $LDYes; ?> 	<input type="radio" name="bg_border" value="0" 
	<?php if(!$GLOBALCONFIG['gui_frame_left_nav_border']) echo 'checked'; ?>> <?php echo $LDNo; ?>
        </td>
  </tr>
  <tr>
    <td><FONT  color="#000099" FACE="verdana,arial" size=2></td>
    <td class="wardlisttitlerow"><FONT  color="#000099" FACE="verdana,arial" size=2><b><?php echo $LDFrameWidth; ?></b></td>
    <td><input type="text" name="bg_width" size=20 maxlength=20 value="<?php echo $GLOBALCONFIG['gui_frame_left_nav_width']; ?>"></td>
  </tr>
  <tr>
    <td><FONT  color="#000099" FACE="verdana,arial" size=2></td>
    <td class="wardlisttitlerow"><FONT  color="#000099" FACE="verdana,arial" size=2><b><?php echo $LDBorderColor; ?></b></td>
    <td><input type="text" name="bg_bdcolor" size=20 maxlength=20 value="<?php echo $GLOBALCONFIG['gui_frame_left_nav_bdcolor']; ?>"></td>
  </tr>
  <tr>
    <td><FONT  color="#000099" FACE="verdana,arial" size=2></td>
    <td class="wardlisttitlerow"><FONT  color="#000099" FACE="verdana,arial" size=2><b><?php echo $LDAllowMultiLang; ?></b></td>
    <td>	<input type="radio" name="multilang" value="0" <?php if(!$GLOBALCONFIG['language_single']) echo 'checked'; ?>> <?php echo $LDYes; ?> 	<input type="radio" name="multilang" value="1" 
	<?php if($GLOBALCONFIG['language_single']) echo 'checked'; ?>> <?php echo $LDNo; ?>
        </td>
  </tr>
  <tr>
    <td><FONT  color="#000099" FACE="verdana,arial" size=2></td>
    <td class="wardlisttitlerow"><FONT  color="#000099" FACE="verdana,arial" size=2><b><?php echo $LDDefaultLang; ?></b></td>
    <td><select name="deflang">

<?php
require($root_path.'include/care_api_classes/class_language.php');
$lang_obj=new Language;
$langselect= &$lang_obj->createSelectForm($GLOBALCONFIG['language_default']);
echo $langselect;
?>
			
        </select>
        </td>
  </tr>
</tbody>
</table>
<p>
<?php
if($not_trans_id){
?>
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<?php
}
?>
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="save">
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?> border=0>

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
