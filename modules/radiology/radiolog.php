<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/*** CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','radio.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');
// reset all 2nd level lock cookies
require($root_path.'include/core/inc_2level_reset.php');

$thisfile=basename(__FILE__);
$breakfile=$root_path.'main/startframe.php'.URL_APPEND;
$_SESSION['sess_path_referer']=$top_dir.$thisfile;

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

 # Create a helper smarty object without reinitializing the GUI
 $smarty2 = new smarty_care('common', FALSE);

# Added for the common header top block

 $smarty->assign('sToolbarTitle',$LDRadio);

 # Added for the common header top block
 $smarty->assign('pbHelp',"javascript:gethelp('submenu1.php','$LDRadio')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDRadio);

# Collect javascript
ob_start();

?>
<script language="javascript">
<!--
  var urlholder;

  function srcxray(){
<?php
	if($cfg['dhtml'])
	{
	echo 'w=window.parent.screen.width;
			h=window.parent.screen.height;
			';
	}
	else echo 'w=800;
					h=600;
					';
?>
	radiologwin=window.open("radiolog-xray-javastart.php?sid=<?php echo "$sid&lang=$lang" ?>&user=<?php echo $aufnahme_user.'"' ?>,"radiologwin","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60) );
<?php
if($cfg['dhtml']) echo '
window.radiologwin.moveTo(0,0);';
?>
}
//-->
</script>
<script language="javascript" src="<?php echo $root_path; ?>js/dicom.js"></script>

<?php

	$sTemp = ob_get_contents();
 	ob_end_clean();

	# Append javascript to JavaScript block

	$smarty->append('JavaScript',$sTemp);

 # Prepare the submenu icons

 $aSubMenuIcon=array(createComIcon($root_path,'bestell.gif','0'),
										createComIcon($root_path,'waiting.gif','0'),
										createComIcon($root_path,'torso.gif','0'),
										createComIcon($root_path,'torso_br.gif','0'),
										createComIcon($root_path,'eye.gif','0'),
										createComIcon($root_path,'bubble.gif','0')
										);

# Prepare the submenu item descriptions

$aSubMenuText=array($LDTestRequestRadioTxt,
										$LDTestReceptionTxt,
										$LDDicomImagesTxt,
										$LDUploadDicomTxt,
										$LDSelectViewerTxt,
										$LDNewsTxt
										);

# Prepare the submenu item links indexed by their template tags

$aSubMenuItem=array('LDTestRequestRadio' => "<a href=\"".$root_path."modules/laboratory/labor_test_request_pass.php".URL_APPEND."&target=radio&user_origin=lab\">$LDTestRequestRadio</a>",
										'LDTestReception' => "<a href=\"".$root_path."modules/laboratory/labor_test_request_pass.php".URL_APPEND."&target=admin&subtarget=radio&user_origin=lab\" >$LDTestReception</a>",
										'LDDicomImages' => "<a href=\"radio_pass.php".URL_APPEND."&target=view\">$LDDicomImages</a>",
										'LDUploadDicom' => "<a href=\"radio_pass.php".URL_APPEND."&target=upload\">$LDUploadDicom</a>",
										'LDSelectViewer' => "<a href=\"javascript:popSelectDicomViewer('$sid','$lang')\">$LDSelectViewer</a>",
										'LDNews' => "<a href=\"".$root_path."modules/news/newscolumns.php". URL_APPEND."&dept_nr=19\">$LDNews</a>"
										);

# Create the submenu rows

$iRunner = 0;

while(list($x,$v)=each($aSubMenuItem)){
	$sTemp='';
	ob_start();
		if($cfg['icons'] != 'no_icon') $smarty2->assign('sIconImg','<img '.$aSubMenuIcon[$iRunner].'>');
		$smarty2->assign('sSubMenuItem',$v);
		$smarty2->assign('sSubMenuText',$aSubMenuText[$iRunner]);
		$smarty2->display('common/submenu_row.tpl');
 		$sTemp = ob_get_contents();
 	ob_end_clean();
	$iRunner++;
	$smarty->assign($x,$sTemp);
}

# Assign the submenu to the mainframe center block

 $smarty->assign('sMainBlockIncludeFile','radiology/submenu_radiology.tpl');

 /**
 * show Template
 */

 $smarty->display('common/mainframe.tpl');
?>
