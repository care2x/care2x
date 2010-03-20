<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.1 - 2004-07-04
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
///$db->debug=1;
# The language table
define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require($root_path.'include/inc_front_chain_lang.php');

if(empty($target)) $target='search';

switch($origin)
{
    case 'archive': $breakfile='patient_register_archive.php';
	                         break;
    case 'admit': $breakfile='patient.php';
	                         break;
    default : $breakfile='patient.php';
}

$breakfile.=URL_APPEND;
$thisfile=basename(__FILE__);

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Added for the common header top block

 $smarty->assign('sToolbarTitle',$LDPatientRegister." - ".$LDSearch);

 # Added for the common header top block
 $smarty->assign('pbHelp',"javascript:gethelp('submenu1.php','$LDPatientRegister." - ".$LDSearch')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDPatientRegister." - ".$LDSearch);

 $smarty->assign('sOnLoadJs','onLoad="document.searchform.searchkey.select()"');

 $smarty->assign('pbHelp',"javascript:gethelp('person_how2search.php')");

 $smarty->assign('pbBack',FALSE);
 
 #
 # Create the search object
 #
 require_once($root_path.'include/care_api_classes/class_gui_search_person.php');
 $psearch = & new GuiSearchPerson;

# Start buffering the text above  the search block
 ob_start();

/* Load the tabs */
$tab_bot_line='#66ee66'; // Set the horizontal bottom line color
require('./gui_bridge/default/gui_tabs_patreg.php');


/* If the origin is admission link, show the search prompt */
if(isset($origin) && $origin=='pass')
{
?>
<table border=0>
  <tr>
    <td valign="bottom"><img <?php echo createComIcon($root_path,'angle_down_l.gif','0') ?>></td>
    <td class="prompt"><?php echo $LDPlsSelectPatientFirst ?></td>
    <td><img <?php echo createMascot($root_path,'mascot1_l.gif','0','absmiddle') ?>></td>
  </tr>
</table>
<?php 
}

 $sTemp = ob_get_contents();
 ob_end_clean();

# Assign the preceding text
$psearch->pretext=$sTemp;

$psearch->setTargetFile('patient_register_show.php');

$psearch->setCancelFile($breakfile);

$psearch->setPrompt($LDEnterPersonSearchKey);

# Set to TRUE if you want to auto display a single result
//$psearch->auto_show_byalphanumeric =TRUE;
# Set to TRUE if you want to auto display a single result based on a numeric keyword
# usually in the case of barcode scanner data
$psearch->auto_show_bynumeric = TRUE;

# Start buffering the appending post search text
ob_start();

# If the origin is admission link, show a button for creating an empty form
if(isset($origin) && $origin=='pass')
{
?>
<form action="patient_register.php" method=post>
<input type=submit value="<?php echo $LDNewForm ?>">
<input type=hidden name="sid" value=<?php echo $sid; ?>>
<input type=hidden name="lang" value="<?php echo $lang; ?>">
</form>
<?php
}

#  End buffering and assign buffer contents to template

$sTemp = ob_get_contents();
ob_end_clean();

# Assign the appending post search text
$psearch->posttext = $sTemp;

$smarty->assign('sMainDataBlock',$psearch->create());

$smarty->assign('sMainBlockIncludeFile','registration_admission/reg_plain.tpl');

# Show mainframe

$smarty->display('common/mainframe.tpl');

?>
