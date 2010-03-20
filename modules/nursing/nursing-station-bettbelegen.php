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
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');

/* Load date formatter */
require_once($root_path.'include/inc_date_format_functions.php');

$datum=date('Y-m-d');
$zeit=date('H:m:s');
$toggler=0;

// init sql dbase 

$dbtable='care_admission_patient';

$fieldname=array($LDPatListElements[4],$LDLastName,$LDName,$LDBirthDate);

if(!isset($searchkey)) $searchkey='';
if(!isset($mode)) $mode='';

if(isset($mode)&&$mode=='search'&&!empty($searchkey)){
	include_once($root_path.'include/care_api_classes/class_encounter.php');
	$enc_obj= new Encounter;
	$admission=$enc_obj->searchInpatientNotInWardBasicInfo($searchkey);
	include_once($root_path.'include/care_api_classes/class_globalconfig.php');
	$GLOBAL_CONFIG=array();
	$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
	$glob_obj->getConfig('patient_%');	
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

# Title in toolbar
 $smarty->assign('sToolbarTitle',"$LDAssignOcc $s");

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('nursing_station.php','assign','','$s','$LDAssignOcc')");

 # href for close button
 $smarty->assign('breakfile',"javascript:window.close();");

 # OnLoad Javascript code
 $smarty->assign('sOnLoadJs','onLoad="if (window.focus) window.focus(); document.psearch.searchkey.select();"');

 # Window bar title
 $smarty->assign('title',"$LDAssignOcc $s");
 
 # Hide Copyright footer
 $smarty->assign('bHideCopyright',TRUE);

 # Collect extra javascript code

 ob_start();
?>

<script language="javascript">
<!-- 
var urlholder;

function initwindow(){
	 	if (window.focus) window.focus();
		window.resizeTo(700,450);
}

function enlargewin(){
	//window.moveTo(0,0);
	 window.resizeTo(700,600);
}

function belegen(anum){
		if((anum=="lock")&&(!confirm("<?php echo $LDConfirmLock ?>")))  return;

             <?php
            echo '
	          urlholder="nursing-station.php?mode=newdata&sid='.$sid.'&lang='.$lang.'&rm='.$rm.'&bd='.$bd.'&pyear='.$py.'&pmonth='.$pm.'&pday='.$pd.'&pn="+anum+"&station='.$s.'&ward_nr='.$wnr.'";
			  ';
             ?>
	          window.opener.location.replace(urlholder);
	          window.close();
}
	
function pruf(d){
		if (d.searchkey.value=="") return false;
}

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>

// -->
</script>
<?php 

$sTemp = ob_get_contents();

ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

?>

<table width=100% border=0 cellpadding="5" cellspacing=0 >

<tr>
<td>
<font face=verdana,arial ><?php echo $LDPatListElements[0] ?>: <b><?php echo $rm; ?></b> &nbsp;<?php echo $LDPatListElements[1] ?>: <b><?php echo $bd; ?></b>&nbsp;
<a href="javascript:belegen('lock')" title="<?php echo $LDClk2LockBed ?>"><img <?php echo createComIcon($root_path,'delete2.gif','0','absmiddle',TRUE) ?> alt="<?php echo $LDClk2LockBed ?>"> <?php echo $LDLockThisBed ?></a>
<p>
 <ul>
 
 <form action="nursing-station-bettbelegen.php" method="post" name="psearch" onSubmit="return pruf(this)">
 <div class="prompt"><?php echo $LDSearchPatient; ?></div>
 <table border=0 cellspacing=0 cellpadding=1>
   <tr>
     <td bgcolor=#0>
	 
	 <table border=0 bgcolor=#ffffcc cellspacing=0 cellpadding=10>
		<tr>
		    <td colspan=2><font face=verdana,arial size=2><?php echo $LDSearchPrompt ?></td>
		</tr>
		<tr>
			<td><input type="text" name="searchkey" size=40 maxlength=40 value=<?php echo $searchkey; ?>></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td><input type="image" <?php echo createLDImgSrc($root_path,'searchlamp.gif','0','absmiddle') ?> alt="<?php echo $LDSearchPatient ?>" > </td>
			<td> <a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a></td>
		</tr>
	</table>
	
	</td>
   </tr>
 </table>
  
 <input type="hidden" name="sid" value="<?php echo $sid; ?>">
 <input type="hidden" name="lang" value="<?php echo $lang; ?>">
 <input type="hidden" name="tb" value="<?php echo $tb; ?>">
 <input type="hidden" name="tt" value="<?php echo $tt; ?>">
 <input type="hidden" name="bb" value="<?php echo $bb; ?>">
 <input type="hidden" name="s" value="<?php echo $s; ?>">
 <input type="hidden" name="rm" value="<?php echo $rm; ?>">
 <input type="hidden" name="bd" value="<?php echo $bd; ?>">
 <input type="hidden" name="py" value="<?php echo $py; ?>">
 <input type="hidden" name="pm" value="<?php echo $pm; ?>">
 <input type="hidden" name="pd" value="<?php echo $pd; ?>">
 <input type="hidden" name="d" value="<?php echo $d; ?>">                                                      
 <input type="hidden" name="wnr" value="<?php echo $wnr; ?>">                                                      
 <input type="hidden" name="mode" value="search">
  <p>
</FONT>


</form>
</ul>

<?php
/**
* Function to fetch the actual occupancy list of the station in a given day
* Used to check whether the patient is already checked-in in the station or not
* globals:  $s = station, $py = year, $pm = month, $pd = day, $LDDbNoLink = no db link error message
* $ergebnis = the resulting array from db table care_admission_patient search
* $new_zeile = buffer for filtered arrays
* db table used = nursing_station_patients
*/
function f_checkBedOccupancy(){

  global $link, $s, $py, $pm, $pd, $LDDbNoLink, $ergebnis, $new_zeile, $linecount, $lang;
  
  $sql="SELECT bed_patient FROM care_nursing_station_patients WHERE station='".$s."' AND s_date='".$py."-".$pm."-".$pd."' AND lang='".$lang."'";
  if($result=$db->Execute($sql))
  {
  	$rows=$result->RecordCount();
    if($rows==1) 
	{
	   $bed_occ=$result->FetchRow();
	     $pat_count=0;
		  while($row=$ergebnis->FetchRow())
		  {
		    if(eregi($row['patnum'],$bed_occ['bed_patient'])) continue;
			else
			 {
				 $new_zeile[]=$row;
				 $pat_count++;
			 }
		   }
	       return $pat_count;
	 }
	  elseif($rows>1) die ($LDErrorDuplicateBed);
        else 
		{
		  while($new_zeile[]=$ergebnis->FetchRow())
				 $pat_count++;
		  return $pat_count;
		}
  }
  else 
  {
    echo $LDDbNoLink."<p>";
	return 0;
  }
}
	
/**
* Here begins the search routine
*/


if($mode=='search'){
	if(!$enc_obj->record_count) $linecount=0; 
		else $linecount=$enc_obj->record_count;
		
	echo '<p>'.str_replace("~nr~",$linecount,$LDSearchFound).'<p>';
		  
	if ($linecount) { 

	/* Load the common icons */
	$img_options=createLDImgSrc($root_path,'ok_small.gif','0');

	echo '
			<table border=0 cellpadding=2 cellspacing=1> <tr bgcolor="#0000aa" background="'.createBgSkin($root_path,'tableHeaderbg.gif').'">';
			
?>

    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDCaseNr; ?></b></td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDLastName; ?></td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDName; ?></td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDBirthDate; ?></td>
    <td><font face=arial size=2 color="#ffffff"><b><?php echo $LDOptions; ?></td>

<?php
			
					echo"</tr>";

					while($row=$admission->FetchRow())
					{
						$full_en = ($row['encounter_nr'] + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
						echo "
							<tr bgcolor=";
						if($toggle) { echo "#efefef>"; $toggle=0;} else {echo "#ffffff>"; $toggle=1;};
						echo"<td><font face=arial size=2>";
                        echo '&nbsp;'.$full_en;
						if($row['encounter_class_nr']=='amb') echo ' <img '.createComIcon($root_path,'redflag.gif','0','',TRUE).'> <font size=1 color="red">'.$LDAmbulant.'</font>';
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".ucfirst($row['name_last']);
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".ucfirst($row['name_first']);
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".formatDate2Local($row['date_birth'],$date_format);
                        echo "</td>";	

					    if($_COOKIE[$local_user.$sid]) echo '
						<td><font face=arial size=2>&nbsp;
							<a href="javascript:belegen(\''.$row['encounter_nr'].'\')">
							<img '.$img_options.' alt="'.$LDShowData.'"></a>&nbsp;';
							
                       if(!file_exists($root_path.'cache/barcodes/en_'.$full_en.'.png'))
	      		       {
			               echo "<img src='".$root_path."classes/barcode/image.php?code=".$full_en."&style=68&type=I25&width=180&height=50&xres=2&font=5&label=2&form_file=en' border=0 width=0 height=0>";
		               }
						echo '</td></tr>';

					}
					echo "
						</table>
						<script language='javascript'>
						window.resizeTo(700,600);</script>";
					
	} // end of if($linecount)
	 	else  echo "<hr><ul><img ".createMascot($root_path,'mascot1_r.gif','0','absmiddle')."><font face=arial size=2>".$LDNoFound."<br>\r\n";
}

?>

</td>
</tr>
</table>        

<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign the page output to the mainframe center block

 $smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

 ?>
