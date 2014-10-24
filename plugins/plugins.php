<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.0 - 2004-05-16
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.org, elpidio@care2x.net
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','specials.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');
$breakfile=$root_path.'main/spediens.php'.URL_APPEND;
$returnfile=$root_path.'main/spediens.php'.URL_APPEND;
$thisfile=basename(__FILE__);

// reset all 2nd level lock cookies
require($root_path.'include/core/inc_2level_reset.php');

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Toolbar title

 $smarty->assign('sToolbarTitle',$LDPlugins);

 # href for the return button
 $smarty->assign('pbBack',$returnfile);

# href for the  button
 $smarty->assign('pbHelp',"javascript:gethelp('submenu1.php','$LDPlugins')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDPlugins);

 # Buffer page output
 
 ob_start();

	$handle=opendir('./');
	$count=0;
 	while (FALSE!==($file = readdir($handle))) {

     	if ($file != "." && $file != ".." && is_dir($file)){
			
			include("$file/tags.php");
			if($cfg['icons'] != 'no_icon'){
				if(empty($sPluginIconSmall)) $sImgSrc=createComIcon($root_path,'templates.gif','0');
					elseif(file_exists($sPluginIconSmall)) $sImgSrc="src=\"$sPluginIconSmall\"";
						elseif(file_exists("$file/$sPluginIconSmall")) $sImgSrc="src=\"$file/$sPluginIconSmall\"";
							else $sImgSrc=createComIcon($root_path,'templates.gif','0');
			}

			if($count){
				$smarty->display('common/submenu_row_spacer.tpl');
			}else{
				$count++;
			}
			
			if($cfg['icons'] != 'no_icon') $smarty->assign('sIconImg','<img '.$sImgSrc.'>');
			$smarty->assign('sSubMenuItem','<a href="'.$sPluginStartLocator.'">'.$sPluginName.'</a>');
			$smarty->assign('sSubMenuText',$sPluginDescription);
			$smarty->display('common/submenu_row.tpl');
		}
	}
	closedir($handle);

	if(!$count){
		echo $LDNoPluginsPrompt;
	}

	$sTemp = ob_get_contents();
ob_end_clean();

$smarty->assign('sSubMenuRows',$sTemp);

$smarty->assign('sMainBlockIncludeFile','common/submenu_tableframe.tpl');

 /**
 * show Template
 */

 $smarty->display('common/mainframe.tpl');
 // $smarty->display('debug.tpl');
 ?>
