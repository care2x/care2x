<?php

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Title in the toolbar
 $smarty->assign('sToolbarTitle',$headframe_title);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('medocs_start.php')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$headframe_title);

 if(!isset($encounter_nr) && !isset($pid)){
	$onLoadJs='onLoad="if(document.searchform.searchkey.focus) document.searchform.searchkey.focus();"';
}

 if(defined('MASCOT_SHOW') && MASCOT_SHOW==1){
	$onLoadJs='onLoad="if (window.focus) window.focus();"';
}

 # Onload Javascript code
 $smarty->assign('sOnLoadJs',$onLoadJs);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('medocs_entry.php')");

  # hide return button
 $smarty->assign('pbBack',FALSE);

# Load tabs

$target='search';
require('./gui_bridge/default/gui_tabs_medocs.php');

# Buffer page output

ob_start();

?>

<script  language="javascript">
<!-- 
function setsex(d)
{
	s=d.selectedIndex;
	t=d.options[s].text;
	if(t.indexOf("Frau")!=-1) document.aufnahmeform.sex[1].checked=true;
	if(t.indexOf("Herr")!=-1) document.aufnahmeform.sex[0].checked=true;
	if(t.indexOf("-")!=-1){ document.aufnahmeform.sex[0].checked=false;document.aufnahmeform.sex[1].checked=false;}
}

function settitle(d)
{
	if(d.value=="m") document.aufnahmeform.anrede.selectedIndex=2;
	else document.aufnahmeform.anrede.selectedIndex=1;
}

<?php require($root_path.'include/core/inc_checkdate_lang.php'); ?>

-->
</script>
<?php 

$sTemp = ob_get_contents();
ob_end_clean();
$smarty->append('JavaScript',$sTemp);

#Load tabs

$target='entry';
include('./gui_bridge/default/gui_tabs_medocs.php');

# Buffer the page output

ob_start();

?>

<ul>

<?php 
/* If the origin is admission link, show the search prompt */
if(!isset($pid) || !$pid)
{
/* Set color values for the search mask */

$searchmask_bgcolor="#f3f3f3";
$searchprompt=$LDEntryPrompt;
$entry_block_bgcolor='#fff3f3';
$entry_border_bgcolor='#6666ee';
$entry_body_bgcolor='#ffffff';

?>
<table border=0>
  <tr>
    <td valign="bottom"><img <?php echo createComIcon($root_path,'angle_down_l.gif','0') ?>></td>
    <td><font color="#000099" SIZE=3  FACE="verdana,Arial"> <b><?php echo $LDPlsSelectPatientFirst ?></b></font></td>
    <td><img <?php echo createMascot($root_path,'mascot1_l.gif','0','absmiddle') ?>></td>
  </tr>
</table>

 <table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php
	        /* set the script for searching */
	       $search_script='medocs_data_search.php';
		   $user_origin='admit';
		   
            include($root_path.'include/core/inc_patient_searchmask.php');
       
	   ?>
	</td>
     </tr>
   </table>

<?php 
}
?>

<p>
<a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDCancelClose ?>"></a>
</ul>
<p>

<?php

$sTemp = ob_get_contents();
$smarty->assign('sMainDataBlock',$sTemp);

ob_end_clean();

$smarty->assign('sMainBlockIncludeFile','medocs/main_plain.tpl');

$smarty->display('common/mainframe.tpl');

?>