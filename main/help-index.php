<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','help.php');
define('NO_CHAIN',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');
 // globalize POST, GET, & COOKIE  vars
if(file_exists('../help/'.$lang.'/help_'.$lang.'_index.php')) include ('../help/'.$lang.'/help_'.$lang.'_index.php');
 else  include ('../help/en/help_en_index.php');

#
# Start scanning for plugged local documents
#

$sDirPath = $root_path.'docs/plugins/';

if(file_exists($sDirPath.'.')){
	
	$bShowTitle = FALSE;

	$handle=opendir($sDirPath.'.');

	while (FALSE!==($sDocsDir = readdir($handle))) {
			if ($sDocsDir != '.' && $sDocsDir != '..') {

			if(is_dir($sDirPath.$sDocsDir)&&file_exists($sDirPath.$sDocsDir.'/tags.php')){
				@include($sDirPath.$sDocsDir.'/tags.php');
				
				if(isset($sPluginDocsName) && !empty($sPluginDocsName) && isset($sPluginDocsHref) && !empty($sPluginDocsHref)){
					if(!$bShowTitle){
						echo '<p>Documents:';
						$bShowTitle = TRUE;
					}
					echo "<li><a href=\"$sPluginDocsHref\" target=\"HELPINFOFRAME\">$sPluginDocsName</a></li>";
				}
			}
		}
	}
}
?>
