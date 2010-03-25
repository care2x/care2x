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

	$config_new['mainmenu_tree']=$mainmenu_tree;

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

}elseif(!isset($cfg['mainmenu_tree'])||empty($cfg['mainmenu_tree'])){
	if(!isset($GLOBAL_CONFIG)) $GLOBAL_CONFIG=array();
	include_once($root_path.'include/care_api_classes/class_globalconfig.php');
	$gc=new GlobalConfig($GLOBAL_CONFIG);
	$gc->getConfig('theme_mainmenu_tree');
	if(!empty($GLOBAL_CONFIG['theme_mainmenu_tree'])) $cfg['mainmenu_tree']=$GLOBAL_CONFIG['theme_mainmenu_tree'];
		else $cfg['mainmenu_tree']='default';
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Toolbar title

 $smarty->assign('sToolbarTitle',$LDUserConfigOpt);

# href for the  button
 $smarty->assign('pbHelp',"javascript:gethelp('config_user.php')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDUserConfigOpt);

 # Buffer page output

 ob_start();
?>

<FONT  color="#000066" size=4><?php echo $LDMainMenuTree; ?></font>
<br>

<form method="post">
<?php 
if (isset($saved)&&$saved) {
	echo '<img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'>';
	echo '<div class="prompt">'.$LDChangeSaved.'</div><br>'.$LDRefreshBrowser;
}
?>

<table border=0 cellspacing=1 cellpadding=2>
  <tbody>
  <tr >
    <td colspan=4>&nbsp;</td>
  </tr>
  
  <tr class="adm_list_titlebar">
    <td></td>
    <td><?php echo $LDStyle; ?></td>
   <td><?php echo $LDDescription; ?></td>
   <td><?php echo $LDDevDesigner; ?></td>
   <td><?php echo $LDScreenshot; ?></td>
   </tr>
  
<?php

$filepath=$root_path.'main/menu/';

$handle=opendir($filepath.'.');  // Modify this path if you have placed the icons directories somewhere else
$dirs=array();
while (false!==($theme = readdir($handle))) { 
    if ($theme != '.' 
		&& $theme != '..') {
		if(is_dir($filepath.$theme)&&file_exists($filepath.$theme.'/tags.php')){
			@include($filepath.$theme.'/tags.php');
?>
  
	<tr class="submenu">
		<td>&nbsp;<input type="radio" name="mainmenu_tree" value="<?php echo $theme; ?>" <?php if($cfg['mainmenu_tree'] == $theme) echo 'checked'; ?>></td>
		<td>&nbsp;<b><?php echo $sMainMenuStyleName; ?></b></td>
		<td>&nbsp;
		<?php
			if(isset($sMainMenuStyleDescriptionLang[$lang]) && !empty($sMainMenuStyleDescriptionLang[$lang])) echo $sMainMenuStyleDescriptionLang[$lang];
				else echo $sMainMenuStyleDescription;
			?></td>
		<td>&nbsp;<?php echo $sMainMenuStyleDesigner; ?></td>
		<td>&nbsp;<?php if(!empty($sMainMenuStyleScreenShot)) echo '<a href="'.$sMainMenuStyleScreenShot.'">[*]</a>'; ?></td>
	</tr>

 <?php

		}
	} 
}

?>

  <tr >
    <td colspan=4><br><input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?> border=0></td>
  </tr>
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
</form>

<?php

$sTemp = ob_get_contents();

ob_end_clean();

$smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */

$smarty->display('common/mainframe.tpl');

 ?>
