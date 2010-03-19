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
define('LANG_FILE','nursing.php');
if($user_origin=='lab')
{
  $local_user='ck_lab_user';
  $breakfile='labor.php?sid='.$sid.'&lang='.$lang; 
}
else
{
  $local_user='ck_pflege_user';
  $breakfile='pflege-station-patientdaten.php'.$rel_url;
}
require_once($root_path.'include/inc_front_chain_lang.php');
if($edit&&!$_COOKIE[$local_user.$sid]) {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
require_once($root_path.'include/inc_config_color.php'); // load color preferences

$thisfile='diagnostics-report-index.php';
$breakfile="pflege-station-patientdaten.php?sid=$sid&lang=$lang&station=$station&pn=$pn&edit=$edit";

$bgc1='#fefefe'; 

$abtname=get_meta_tags($root_path."global_conf/$lang/konsil_tag_dept.pid");

/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok)
{	
	
       include_once($root_path.'include/inc_date_format_functions.php');

		$dbtable='care_encounter_diagnostics_report';
		
		$sql="SELECT * FROM $dbtable WHERE encounter_nr='$pn' ORDER BY  modify_time  DESC";
		//$sql="SELECT * FROM $dbtable WHERE patnum='$pn' ORDER BY  item_nr DESC";
		
		if($ergebnis=$db->Execute($sql))
       		{
				$rows=$ergebnis->RecordCount();
				if($rows) $report=$ergebnis->FetchRow();
				  else $report['script_call']='diagnostics-report-none.php?pn='.$pn; // If no report is available, load the non-availability page
			}
			else{echo "<p>$sql$LDDbNoRead";}
	}
	else 
		{ echo "$LDDbNoLink<br>$sql<br>"; }

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo $LDReports ?></TITLE>
<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');

?>



<script language="javascript">
<!-- Script Begin
function showInitPage() {

   window.parent.DIAGNOSTICS_REPORT_MAIN_<?php echo $sid.'_'.$pn ?>.location.replace('<?php echo $root_path.'modules/laboratory/'.$report['script_call']; ?>&sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&edit=<?php echo $edit ?>&user_origin=<?php echo $user_origin ?>&show_print_button=1');

}
//  Script End -->
</script>

</HEAD>

<BODY bgcolor="<?php echo $cfg['top_bgcolor']; ?>" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="showInitPage()" 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<font face="verdana,arial" size=2>
<?php 


/* The following routine creates the list of pending diagnostics reports */

if($rows)
{ 

   //mysql_data_seek($ergebnis,0);  //reset the array to the first element

  do{
  //echo $tracker."<br>";

    if($report['report_date']!=$report_date)
    {
       echo "<FONT size=2 color=\"#990000\"><b>".formatDate2Local($report['report_date'],$date_format)."</b></font><br>";
	   $report_date=$report['report_date'];
    } 

    if($report['status']=='pending')
   {
        echo "&nbsp;<img ".createComIcon($root_path,'r_arrowgrnsm.gif','0','absmiddle')."> ";
   }
   else
   {
        echo "&nbsp;<img src=\"../gui/img/common/default/pixel.gif\" border=0 width=4 height=7> ";
   }  
  
   echo " <a href=\"".$root_path."modules/laboratory/".$report['script_call']."&sid=".$sid."&lang=".$lang."&user_origin=".$user_origin."&show_print_button=1\" target=\"DIAGNOSTICS_REPORT_MAIN_".$sid."_".$pn."\">".$report['reporting_dept']."<br>".$report['report_nr']."</a><hr>";

		
   
    /* Check for the barcode png image, if nonexistent create it in the cache */
/*    if(!file_exists($root_path.'cache/barcodes/pn_'.$report['encounter_nr'].'.png'))
    {
	   echo "<img src='".$root_path."classes/barcode/image.php?code=".$report['encounter_nr']."&style=68&type=I25&width=145&height=50&xres=2&font=5&label=2' border=0 width=0 height=0>";
	}
*/  
	} while($report=$ergebnis->FetchRow());
}
?>       
</font>
</BODY>
</HTML>
