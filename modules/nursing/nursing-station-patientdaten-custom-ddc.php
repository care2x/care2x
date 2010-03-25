<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
if (file_exists($custom_lang_file)) {include "./lang_en_custom.php";}

/**
* CARE2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* , elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('actions.php');
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
if($edit&&!$_COOKIE[$local_user.$sid]) {header('Location:'.$root_path.'language/'.$lang.'/lang_'.$lang.'_invalid-access-warning.php'); exit;}; 
 
$thisfile=basename(__FILE__);
$breakfile="nursing-station-patientdaten.php?sid=$sid&lang=$lang&station=$station&pn=$pn&edit=$edit";

/* Create encounter object */
require_once($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj= new Encounter;
/* Create nursing notes object */
require_once($root_path.'include/care_api_classes/class_notes_nursing.php');
$report_obj= new NursingNotes;
/* Load global configs */
require_once($root_path.'include/care_api_classes/class_globalconfig.php');

/**
Load custom file - note that by default we will assume english
**/

$custom_lang_file = $root_path."language/".$lang.'/lang_'.$lang.'_custom.php';
include($custom_lang_file);

$GLOBAL_CONFIG=array();
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('patient_%');	

/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/core/inc_db_makelink.php');
if($dblink_ok)
{
	/* Load date formatter */
    include_once($root_path.'include/core/inc_date_format_functions.php');
    
       
	if($mode=='save'){
		
		
	
		
		if(($indatetime_date&&$indatetime_time&&$urinesugar&&$acetone&&$bloodsugar) || ($indatetime_date&&$indatetime_time&&$insulin&&$insulinamount)){
			
		if ($_POST['editid'] != "") {
			
		    // Load the editor functions 
			include_once($root_path.'modules/news/includes/inc_editor_fx.php');
		    // Load the visual signalling functions
			include_once($root_path.'include/core/inc_visual_signalling_fx.php');
			// Prepare  the date 
			$indatetime_date=formatDate2STD($indatetime_date,$date_format);
			$indatetime_time=$_POST['indatetime_time'].':00';
			
			$q="update care_encounter_custom_ddc set
			
			indatetime='".$indatetime_date." ".$indatetime_time."',
			createid='".$_SESSION['sess_login_userid']."',
			urinesugar='".$urinesugar."',
			acetone='".$acetone."',
			bloodsugar='".$bloodsugar."',
			tablets='".mysql_escape_string(stripslashes($tablets))."',
			insulin='".$insulin."'
			
			where nr = '".$editid."'
			
			";
			//echo $q;
			mysql_query($q);
			echo mysql_error();
			
			if (mysql_affected_rows()>0) {$saved=true;}
			
		}else{
		
		    // Load the editor functions 
			include_once($root_path.'modules/news/includes/inc_editor_fx.php');
		    // Load the visual signalling functions
			include_once($root_path.'include/core/inc_visual_signalling_fx.php');
			// Prepare  the date 
			$indatetime_date=formatDate2STD($indatetime_date,$date_format);
			$indatetime_time=$_POST['indatetime_time'].':00';
			$q="insert into care_encounter_custom_ddc (encounter_nr,createid,indatetime,urinesugar,acetone,bloodsugar,tablets,insulin) values (
				'".$pn."',
				'".$_SESSION['sess_login_userid']."',
				'".$indatetime_date." ".$indatetime_time."',
				'".$urinesugar."',
				'".$acetone."',
				'".$bloodsugar."',
				'".mysql_escape_string(stripslashes($tablets))."',
				'".$insulin."'
				)";
			//echo $q;
			mysql_query($q);
			echo mysql_error();
			
			if (mysql_insert_id()>0) {$saved=true;}
			
		} // insert of new record
			
		} else {
						$saved=false;
					echo "<p>$report_obj->sql$LDDbNoSave";
		}
		
		
		
		
		
		
		
			if($saved){
					header("location:$thisfile?sid=$sid&lang=$lang&saved=1&pn=$pn&station=$station&edit=$edit");
			} else {
				
				
			}
	
}

}

else{
	echo "$LDDbNoLink<br>$sql<br>";
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
 $smarty->assign('sToolbarTitle',"$DDC_title $station");

 # hide return button
 $smarty->assign('pbBack',FALSE);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('nursing_report.php','','','$station','$DDC_title')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$DDC_title $station");

 # Body Onload JS
 $sOnLoadJs ='onLoad="if (window.focus) window.focus();';
if((($mode=='save')||($saved))&&$edit) $sOnLoadJs =$sOnLoadJs.";window.location.href='#bottom';document.berichtform.urinesugar.focus()";
$smarty->assign('sOnLoadJs',$sOnLoadJs.'"');


# Collect javascript code

ob_start();
?>

<style type="text/css">
div.fva2_ml10 {font-size: 12; margin-left: 10;}
div.fa2_ml10 {font-size: 12; margin-left: 10;}
div.fva2_ml3 {font-size: 12; margin-left: 3; }
div.fa2_ml3 {font-size: 12; margin-left: 3; }
</style>

<script language="javascript">
<!--
  var urlholder;
  var focusflag=0;
  var formsaved=0;
  
function pruf(d){
	if(((d.indatetime_date.value)&&(d.urinesugar.value)&&(d.acetone.value)&&(d.bloodsugar.value)&&(d.tablets.value)&&(d.insulin.value))) return true;
	else 
	{
		alert("<?php echo $LDAlertIncomplete ?>");
		return false;
	}
}

function submitform(){
	document.forms[0].submit();
	}

function closewindow(){
	opener.window.focus();
	window.close();
	}

function resetinput(){
	document.berichtform.reset();
	}

function select_this(formtag){
		document.berichtform.elements[formtag].select();
	}
	
function getinfo(patientID){
	urlholder="nursing-station.php?sid=<?php echo "$sid&lang=$lang" ?>&route=validroute&patient=" + patientID + "&user=<?php echo $_COOKIE[$local_user.$sid].'"' ?>;
	patientwin=window.open(urlholder,patientID,"width=600,height=400,menubar=no,resizable=yes,scrollbars=yes");
	}
function sethilite(d){
	d.focus();
	d.value=d.value+"~";
	d.focus();
	}
function endhilite(d){
	d.focus();
	d.value=d.value+"~~";
	d.focus();
	}

<?php require($root_path.'include/core/inc_checkdate_lang.php'); ?>
-->
</script>
<?php

$sTemp = ob_get_contents();
ob_end_clean();
$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

?>

<form name="berichtform" method="post" action="<?php echo $thisfile ?>" onSubmit="return pruf(this)">
<ul><table   cellpadding="0" cellspacing=1 border="0">
<tr  valign="top">
<td colspan=4 bgcolor="#99ccff"  width="50%">
<?php
/*echo '<div class=fva2_ml10>
		<span style="background:yellow"><b>'.$result[patnum].'</b></span><br>
		<b>'.$result[name].', '.$result[vorname].'</b> <br>
		<font color=maroon>'.formatDate2Local($result[gebdatum],$date_format).'</font><font size=1> <p>
		'.nl2br($result[address]).'<p>
		'.$station.'&nbsp;'.$result[kasse].' '.$result[kassename].'</div>';*/

echo '<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid='.$sid.'&lang='.$lang.'&fen='.$full_en.'&en='.$pn.'" width=282 height=178>';
?>
</td>
<td colspan=4 bgcolor="#99ccff"><div class=fva2_ml10>

<?php

echo '<font size="7">'.$DDC_title.' <p><font size=2>';

?>
</div></td></tr>
<?php


echo '	<tr bgcolor="#99ccff">
		<td><div class=fva2_ml3><b>'.$LDDate.'</b></div></td>
		<td><div class=fva2_ml3><b>'.$LDTime.'</b></div></td>
		<td><div class=fva2_ml3><b>'.$LDUrineSugar.'</b></div></td>
		<td><div class=fva2_ml3><b>'.$LDAcetone.'</b></div></td>
		<td><div class=fva2_ml3><b>'.$LDBloodSugar.'</b></div></td>
		<td><div class=fva2_ml3><b>'.$LDTablets.'</b></div></td>
		<td><div class=fva2_ml3><b>'.$LDInsulin.'</b></div></td>
		<td></td>
		</tr>';	
		
		?>
		
		<script language='JavaScript'>
		
		editcolor='#FFFF00';
		
		function Edit(id) {
		
			document.getElementById('editid').value=id;
			
			document.getElementById('indatetime_date').value=eval("document.getElementById('id_"+id+"_indatetime_date').innerHTML");
			document.getElementById('indatetime_date').style.backgroundColor=editcolor;
			
			document.getElementById('indatetime_time').value=eval("document.getElementById('id_"+id+"_indatetime_time').innerHTML");
			document.getElementById('indatetime_time').style.backgroundColor=editcolor;
			
			document.getElementById('urinesugar').value=eval("document.getElementById('id_"+id+"_urinesugar').innerHTML");
			document.getElementById('urinesugar').style.backgroundColor=editcolor;
			
			document.getElementById('acetone').value=eval("document.getElementById('id_"+id+"_acetone').innerHTML");
			document.getElementById('acetone').style.backgroundColor=editcolor;
			
			document.getElementById('bloodsugar').value=eval("document.getElementById('id_"+id+"_bloodsugar').innerHTML");
			document.getElementById('bloodsugar').style.backgroundColor=editcolor;
			
			document.getElementById('tablets').value=eval("document.getElementById('id_"+id+"_tablets').innerHTML");
			document.getElementById('tablets').style.backgroundColor=editcolor;
			
			document.getElementById('insulin').value=eval("document.getElementById('id_"+id+"_insulin').innerHTML");
			document.getElementById('insulin').style.backgroundColor=editcolor;
			
			
		}
		
		</script>
		
		
		<?
		
$res=mysql_query("select * from care_encounter_custom_ddc where encounter_nr = '".$pn."' order by indatetime asc");

$rows=0;

while ($iod=mysql_fetch_assoc($res)) {
	
	$rows++;

	
		?>

	<tr bgcolor="#99ccff">
		<td><div class=fva2_ml3 id="id_<?php echo $iod['nr']?>_indatetime_date"><?php echo date("d/m/Y",strtotime($iod['indatetime']))?></div></td>
		<td><div class=fva2_ml3 id="id_<?php echo $iod['nr']?>_indatetime_time"><?php echo date("H:i",strtotime($iod['indatetime']))?></div></td>
		<td><div class=fva2_ml3 id="id_<?php echo $iod['nr']?>_urinesugar"><?php echo $iod['urinesugar']?></div></td>
		<td><div class=fva2_ml3 id="id_<?php echo $iod['nr']?>_acetone"><?php echo $iod['acetone']?></div></td>
		<td align=right><div class=fva2_ml3 id="id_<?php echo $iod['nr']?>_bloodsugar"><?php echo $iod['bloodsugar']?></div></td>
		<td><div class=fva2_ml3 id="id_<?php echo $iod['nr']?>_tablets"><?php echo $iod['tablets']?></div></td>
		<td align=right><div class=fva2_ml3 id="id_<?php echo $iod['nr']?>_insulin"><?php echo $iod['insulin']?></div></td>
		<td align=center><div class=fva2_ml3><a href='#' OnClick=Edit('<?php echo $iod['nr']?>')><span style='background-color:#FFFF00'><?php echo $LDEDIT; ?></span></a></div></td>
	</tr>	
	
		<?
	
}

if ($rows<5) {$extrarows=5;} else {$extrarows=2;}

for ($extra=1;$extra<=$extrarows;$extra++) {
	
			?>

	<tr bgcolor="#99ccff">
		<td><div class=fva2_ml3>&nbsp;</div></td>
		<td><div class=fva2_ml3></div></td>
		<td><div class=fva2_ml3></div></td>
		<td><div class=fva2_ml3></div></td>
		<td align=right><div class=fva2_ml3></div></td>
		<td align=right><div class=fva2_ml3></div></td>
		<td><div class=fva2_ml3></div></td>
		<td><div class=fva2_ml3></div></td>
		
	</tr>	
	
		<?
}

		
if($edit) { 
?>
		<tr>
		<td colspan=8 bgcolor="#ffffff">&nbsp;
		</td>
		</tr>
		
		<tr bgcolor="#99ccff">
		
		<input type=hidden name=editid id=editid value="">
	
        <td valign="top"><?php echo $LDDate ?>:<br>
		<?php
			//gjergji : new calendar
			require_once ('../../js/jscalendar/calendar.php');
			$calendar = new DHTML_Calendar('../../js/jscalendar/', $lang, 'calendar-system', true);
			$calendar->load_files();
  			echo $calendar->show_calendar($calendar,$date_format,'indatetime_date');
			//end : gjergji  
 		?>
         </td>
		 
		<td valign="top"><?php echo $LDClockTime ?>:<br>
		<input type=text size=4 maxlength=5 name="indatetime_time" id="indatetime_time"  value="<?php echo date('H:i'); ?>" onKeyUp=setTime(this,'<?php echo $lang ?>') onFocus=this.select()><br>
		</td>
		
		<td valign="top"><?php echo $LDUrineSugar ?>:<br>
		<input type=text size=15 maxlength=35 name="urinesugar"  id="urinesugar" value="<?if (!($saved)) echo $_POST['urinesugar']?>">
		</td>
		<td valign="top"><?php echo $LDAcetone ?>:<br>
		<input type=text size=15 maxlength=35 name="acetone"  id="acetone" value="<?if (!($saved)) echo $_POST['acetone']?>">
		</td>
		<td valign="top"><?php echo $LDBloodSugar ?>:<br>
		<input type=text size=10 maxlength=6 name="bloodsugar"  id="bloodsugar" value="<?if (!($saved)) echo $_POST['bloodsugar']?>">
		</td>
		<td valign="top"><?php echo $LDTablets ?>:<br>
		<input type=text size=15 maxlength=35 name="tablets"  id="tablets" value="<?if (!($saved)) echo $_POST['tablets']?>">
		</td>
		<td valign="top"><?php echo $LDInsulin ?>:<br>
		<input type=text size=10 maxlength=6 name="insulin"  id="insulin" value="<?if (!($saved)) echo $_POST['insulin']?>">
		</td>
	<td align=center><a <?
			
			echo 'href=\'nursing-station-patientdaten-custom-ddc.php'.URL_REDIRECT_APPEND.'&station='.$station.'&pn='.$pn.'&edit='.$edit.'\'';
			
			?>> <span style="background-color:#FFFF00"> <?php echo $LDCLEAR; ?> </span> </a></td>
		</tr>
		
<?php
} 
?>
		</table>

<p>

<table width="650"  cellpadding="0" cellspacing="0">
<tr>
<td>
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?> width=99 height=24 alt="<?php echo $LDSave ?>">  
</td>

<td>



</td>
</tr>
</table>

<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="station" value="<?php echo $station ?>">
<input type="hidden" name="pn" value="<?php echo $pn ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="mode" value="save">
</form>

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
