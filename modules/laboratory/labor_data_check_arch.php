<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('chemlab_groups.php');
define('LANG_FILE','lab.php');
$local_user='ck_lab_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_lab.php');

$thisfile='labor_data_check_arch.php';
$breakfile='labor_data_patient_such.php'.URL_APPEND.'&mode=edit';

$toggle=0;

$lab_obj=new Lab();

# Load the date formatter 
require_once($root_path.'include/core/inc_date_format_functions.php');
    
$lab_results=&$lab_obj->createResultsList($encounter_nr);
$linecount=$lab_obj->LastRecordCount();
if (!$linecount) { 		  
					
	switch($mode)
	{
		case 'list': header("location:pflege-station-patientdaten.php".URL_REDIRECT_APPEND."&station=$station&pn=$encounter_nr&nodoc=labor");break;
		default: header("location:labor_datainput.php".URL_REDIRECT_APPEND."&encounter_nr=$encounter_nr&newid=1&mode=$mode");
	}
} 
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE>Labor Check Archive</TITLE>
 <style type="text/css" name="1">
.va12_w{color:#ffffff}
</style>

<?php 
require($root_path.'include/core/inc_js_gethelp.php');
require($root_path.'include/core/inc_css_a_hilitebu.php');
?>

</HEAD>

<BODY BACKGROUND="leinwand.gif">

<img <?php echo createComIcon($root_path,'micros.gif','0','absmiddle') ?>><FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana"> <b><?php echo "$LDLabReport - $LDNewData" ?></b></font>
<table width=100% border=0 cellpadding="0" cellspacing="0">
<tr>
<td colspan=3><img <?php echo createLDImgSrc($root_path,'newdata-b.gif','0') ?>><a href="labor_data_patient_such.php?sid=<?php echo "$sid&lang=$lang&mode=$mode" ?>"><img <?php echo createLDImgSrc($root_path,'such-gray.gif','0') ?>></a></td>
</tr>
<tr >
<td bgcolor=#333399 colspan=3>
<FONT  SIZE=1  FACE="Arial"><STRONG> &nbsp; </STRONG></FONT>
</td>
</tr>
<tr bgcolor="#DDE1EC" >
<td bgcolor=#333399>&nbsp;</td>
<td valign=top><p><br>
<ul>

<?php 
if($linecount>1) echo "<p>$LDReportFoundMany";
	else echo "<p>$LDReportFound";
echo " <font color=red><b>$encounter_nr</b></font>.";
if($linecount>1) echo "<br> $LDIfWantEditMany<p>";
	else echo "<br> $LDIfWantEdit<p>";
					//	$abuf=array(); $last=array();
				
					echo '<table border=0 cellpadding=3 cellspacing=1> <tr bgcolor="#ff0000">';
					
					/* Print the column descriptors */
						echo'
						<td class="va12_w"><b>'.$LDJobIdNr.'</b></td>
						<td class="va12_w"><b>'.$LDParamGroup.'</b></td>
						<td class="va12_w"><b>'.$LDExamDate.'</b></td>
					 <td class="va12_w">&nbsp;<b>'.$LDAt.'</b></td>
					 <td class="va12_w">&nbsp;</td>
					 </tr>';
					 
                    /* Print the list of the stored test results */
					while($zeile=$lab_results->FetchRow())
					{
						$abuf=explode('~',$zeile['encoder']);	
						$abuf=array_pop($abuf);
						parse_str(trim($abuf),$last);
						
					    echo '<tr class=';
						
						if($toggle) { echo "wardlistrow2>"; $toggle=0;} else {echo "wardlistrow1>"; $toggle=1;};
	
	                    $fwd_url = 'labor_datainput.php'.URL_APPEND.'&encounter_nr='.$encounter_nr.'&job_id='.$zeile['job_id'].'&parameterselect='.$zeile['group_id'].'&mode='.$mode.'&update=1';
	                     
						     /* Print the job id or batch nr., test date and time */
							echo'
							<td>
							&nbsp;<a href='.$fwd_url.'>'.$zeile['job_id'].'</a>
							</td>
							<td>
							&nbsp;<a href='.$fwd_url.'>'.$parametergruppe[$zeile['group_id']].'</a>
							</td>
							<td>&nbsp;'.formatDate2Local($zeile['test_date'],$date_format).'
							</td>
							<td>&nbsp;'.convertTimeToLocal($zeile['test_time']).'
							</td>';
						    echo'<td>&nbsp';
						
						    /* Create the link button */
					        echo '<a href='.$fwd_url.'><img 
										'.createComIcon($root_path,'bul_arrowgrnlrg.gif','0').' alt="'.$LDClk2Edit.'"></a>&nbsp;</td></tr>';

					}
					echo "</table>";

?><p>
<form action="labor_datainput.php" method="get"><font size=4>
<b><?php echo $LDNewJob ?></b></font><br>
<?php echo "$LDNew $LDJobIdNr" ?>:<br>
<input type="text" name="job_id" size=15 maxlength=15>
<input type="hidden" name="encounter_nr" value="<?php echo $encounter_nr ?>">
<input type="hidden" name="newid" value="1">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="submit" value="<?php echo $LDCreate ?>">
</form>

<p>
<p>
<hr width=80% align=left>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>>
</a><p>

</ul>
&nbsp;
</FONT>
<p>
</td>
<td bgcolor=#333399>&nbsp;</td>
</tr>
<tr >
<td bgcolor="#333399" colspan=3><font size=1>
&nbsp; 
</td>
</tr>

</table>        
<p>
<?php
require($root_path.'include/core/inc_load_copyrite.php');
?>

</FONT>


</BODY>
</HTML>
