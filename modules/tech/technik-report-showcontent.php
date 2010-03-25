<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'/include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','tech.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');
# Load the date formatter
require_once($root_path.'include/core/inc_date_format_functions.php');

$thisfile=basename(__FILE__);
$breakfile='technik-report-arch.php'.URL_APPEND;
$returnfile=$breakfile;

#init db parameters
$dbtable='care_tech_repair_done';

# define the content array
$rows=0;
$count=0;

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$LDTechSupport);

 # href for return button
 $smarty->assign('pbBack',$breakfile);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('tech.php','showarch')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDTechSupport);

 # Buffer page output

ob_start();

?>

<ul>

<p><br>
  <?php
$rows=0;

    if(isset($markseen)&&$markseen) {
	
		include_once($root_path.'include/care_api_classes/class_core.php');
		$core = & new Core;

					$sql="UPDATE $dbtable SET seen=1
							WHERE dept='$dept'
								AND reporter='$reporter'
								AND tdate='$tdate'
								AND ttime='$ttime'
								AND tid='$tid'";
					if($core->Transact($sql))
					{
						if(isset($job_id)&&$job_id)
						{
							$sql="UPDATE care_tech_repair_job SET done=1 WHERE  tid='$job_id'";
    						if(!$core->Transact($sql))	 {echo "<p>".$sql."$LDDbNoSave<br>"; }
						}
					}
					else echo "$sql $db_sqlquery_fail<br>";
				}
				$sql="SELECT * FROM $dbtable
							WHERE dept='$dept'
								AND reporter='$reporter'
								AND tdate='$tdate'
								AND ttime='$ttime'
								AND tid='$tid'";
        		if($ergebnis=$db->Execute($sql))
				{
					//count rows=linecount
					$rows=$ergebnis->RecordCount();					
				}else {
					echo "<p>".$sql."$LDDbNoRead<br>"; 
				}

if($rows)
{
//++++++++++++++++++++++++ show general info about the list +++++++++++++++++++++++++++
$tog=1;
$content=$ergebnis->FetchRow();
echo '
		<table cellpadding=0 cellspacing=0 border=0 bgcolor="#666666">
		<tr>
		<td>
		<table border=0 cellspacing=1 cellpadding=3>
  		<tr class="wardlisttitlerow">';
	for ($i=0;$i<sizeof($blistindex);$i++)
	echo '
		<td>'.$blistindex[$i].'</td>';
	echo '</tr>
			<tr bgcolor=#f6f6f6>
				 <td>'.$content['reporter'].'</td>
				<td >'.formatDate2Local($content['tdate'],$date_format).'</td>
				<td>'.convertTimeToLocal($content['ttime'],$lang).'</td>
				<td>'.$content['dept'].'</td>
				<td>';
	if(isset($content['job_id'])&&$content['job_id']) echo $content['job_id']; else echo "&nbsp;";
	echo '</td>
				</tr>
			<tr bgcolor=#ffffff>
				 <td colspan=5><p><br><ul><i>" '.nl2br($content['job']).' "</i></ul></td>
				</tr>
				</table>
				</td></tr>
				</table>';

//++++++++++++++++++++++++ show the actual list +++++++++++++++++++++++++++

}
if(!isset($content['seen'])||!$content['seen']){

echo '
  <form action="'.$thisfile.'" method="post">
<input type="hidden" name="sid" value="'.$sid.'">
<input type="hidden" name="lang" value="'.$lang.'">
<input type="hidden" name="markseen" value="1">
<input type="hidden" name="dept" value="'.$content['dept'].'">
<input type="hidden" name="reporter" value="'.$content['reporter'].'">
<input type="hidden" name="tdate" value="'.$content['tdate'].'">
<input type="hidden" name="ttime" value="'.$content['ttime'].'">
<input type="hidden" name="tid" value="'.$content['tid'].'">
<input type="hidden" name="job_id" value="'.$content['job_id'].'">
<a href="'.$breakfile.'"><img '.createLDImgSrc($root_path,'back2.gif','0','absmiddle').'</a>&nbsp;&nbsp;&nbsp;
<input type="submit" value="'.$LDMarkRead.'">&nbsp;&nbsp;&nbsp;
<input type="button" value="'.$LDPrint.'" onClick="javascript:window.print()"><a>

</form>
';
}else{
	echo '<p><a href="'.$breakfile.'"><img '.createLDImgSrc($root_path,'back2.gif','0','absmiddle').'</a>&nbsp;&nbsp;&nbsp;';
}
 ?>

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
