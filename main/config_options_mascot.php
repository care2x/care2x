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
$lang_tables=array('stdpass.php');
define('LANG_FILE','specials.php');
//$local_user='ck_edv_user';
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');

$breakfile='config_options.php'.URL_APPEND;

$thisfile=basename(__FILE__);

if(isset($mode)&&$mode=='save'){
	// Save to user config table

	$config_new['mascot']=$mascot;
	
	include_once($root_path.'include/care_api_classes/class_userconfig.php');
	
	$user=new UserConfig;

	if($user->getConfig($_COOKIE['ck_config'])){

		$config=&$user->getConfigData();
	
		$config=array_merge($config,$config_new);

		if($user->saveConfig($_COOKIE['ck_config'],$config)){
			header('location:'.basename(__FILE__).URL_REDIRECT_APPEND.'&saved=1');
			exit;
		}
	}

}elseif(!isset($cfg['mascot'])||empty($cfg['mascot'])){
	if(!isset($GLOBAL_CONFIG)) $GLOBAL_CONFIG=array();
	include_once($root_path.'include/care_api_classes/class_globalconfig.php');
	$gc=new GlobalConfig($GLOBAL_CONFIG);
	$gc->getConfig('theme_mascot');
	$cfg['mascot']=$GLOBAL_CONFIG['theme_mascot'];
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
 $smarty->assign('sToolbarTitle',$LDUserConfigOpt);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('config_mascot.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDUserConfigOpt);

 if($rows) {
	$smarty->append('JavaScript','<script language="javascript" src="'.$root_path.'js/check_menu_item_same_item.js"></script>');
}

# Buffer page output

ob_start();

?>

<FONT  color="#000066" size=4><?php echo $LDMascotOpt; ?></font>
<br>

<form method="post">
<?php if (isset($saved)&&$saved) { 
	echo '<img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'>';	
?>
<FONT  class="prompt"><?php echo $LDChangeSaved ?></font><br>
<?php } ?>

<table border=0 cellspacing=1 cellpadding=2>  

  <tr >
    <td colspan=3>&nbsp;</td>
  </tr>
  
  <tr class="wardlisttitlerow">
    <td><b></b></td>
    <td><b><?php echo $LDMascot; ?></b></td>
   <td><b><?php echo $LDSampleMascot; ?></b></td>
  </tr>
  
<?php

$handle=opendir($root_path.'gui/img/mascot/.');  // Modify this path if you have placed the mascot directories somewhere else
$dirs=array();
while (false!==($theme = readdir($handle))) { 
    if ($theme != '.' && $theme != '..') {
		if(is_dir($root_path.'gui/img/mascot/'.$theme)&&file_exists($root_path.'gui/img/mascot/'.$theme.'/tags.php')){
			@include($root_path.'gui/img/mascot/'.$theme.'/tags.php');			
/*			
			if($theme==$mascot_theme) $dirs[$mascot_theme]=$mascot_name;
*/		
			$dirs[$theme]=$mascot_name;
		}
	} 
}


@asort($dirs,SORT_STRING); // sort the array 
while(list($x,$v)=each($dirs)){
?>
  <tr class="submenu">
    <td> <input type="radio" name="mascot" value="<?php echo $x; ?>" <?php	if($cfg['mascot']==$x) echo 'checked';	?>>
		</td>
    <td><b><?php echo $v; ?></b></td>
   <td><img src="<?php echo $root_path; ?>gui/img/mascot/<?php echo $x; ?>/mascot1_l.gif" border=0>
   			<img src="<?php echo $root_path; ?>gui/img/mascot/<?php echo $x; ?>/mascot1_r.gif" border=0>
   			<img src="<?php echo $root_path; ?>gui/img/mascot/<?php echo $x; ?>/mascot2_l.gif" border=0>
   			<img src="<?php echo $root_path; ?>gui/img/mascot/<?php echo $x; ?>/mascot2_r.gif" border=0></td>
  </tr>

  
  <?php
}
?>
  <tr >
    <td colspan=3><br><input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?> border=0></td>
  </tr>
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
