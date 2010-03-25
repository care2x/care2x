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
		
		if(($indatetime_date)){
		
		if ($_POST['editid'] != "") {
			
		    // Load the editor functions 
			include_once($root_path.'modules/news/includes/inc_editor_fx.php');
		    // Load the visual signalling functions
			include_once($root_path.'include/core/inc_visual_signalling_fx.php');
			// Prepare  the date 
			$indatetime_date=formatDate2STD($indatetime_date,$date_format);
			//$indatetime_time=$_POST['indatetime_time'].':00';
			$indatetime_time="00:00:00";
			
			$q="update care_encounter_custom_tc set
	
			indatetime='".$indatetime_date." ".$indatetime_time."',
					
			`time` = '".$_POST['turntime']."',
			`position` = '".$_POST['pos']."',
						createid='".$_SESSION['sess_login_userid']."'
		
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
			//$indatetime_time=$_POST['indatetime_time'].':00';
			$indatetime_time=date("h:i",strtotime($_POST['turntime']));
			// first, check if this date has been added before
			
			
			$q="insert into care_encounter_custom_tc (
				
				encounter_nr,createid,indatetime,time,position				
				) values (
				'".$pn."',
				'".$_SESSION['sess_login_userid']."',
				'".$indatetime_date." ".$indatetime_time."',
				'".$_POST['turntime']."',
				'".$_POST['pos']."'
				)";
				
				mysql_query($q);

				echo mysql_error();
				
				if (mysql_insert_id()>0) {$saved=true;}
				
			
			//echo $q;
			
			echo mysql_error();
			
			
			
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
 $smarty->assign('sToolbarTitle',"$TC_title $station");

 # hide return button
 $smarty->assign('pbBack',FALSE);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('nursing_report.php','','','$station','$TC_title')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$TC_title $station");

 # Body Onload JS
 $sOnLoadJs ='onLoad="if (window.focus) window.focus();';
if((($mode=='save')||($saved))&&$edit) $sOnLoadJs =$sOnLoadJs.";window.location.href='#bottom';document.berichtform.indatetime_date.focus()";
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
	
	if(((d.indatetime_date.value)&&(
		(document.getElementById('6am_supine').checked)||
		(document.getElementById('8am_llat').checked)||
		(document.getElementById('10am_rlat').checked)||
		(document.getElementById('12am_supine').checked)||
		(document.getElementById('2pm_llat').checked)||
		(document.getElementById('4pm_rlat').checked)||
		(document.getElementById('6pm_supine').checked)||
		(document.getElementById('8pm_llat').checked)||
		(document.getElementById('10pm_rlat').checked)||
		(document.getElementById('12pm_supine').checked)||
		(document.getElementById('2am_llat').checked)||
		(document.getElementById('4am_rlat').checked)||
		(document.getElementById('6am_supine').checked)
		))) return true;
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
<table   cellpadding="0" cellspacing=1 border="0">
<tr  valign="top">
<td colspan=4 bgcolor="#99ccff"  width="50%">
<?php
echo '<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid='.$sid.'&lang='.$lang.'&fen='.$full_en.'&en='.$pn.'" width=282 height=178>';
?>
</td>
<td colspan=4 bgcolor="#99ccff"><div class=fva2_ml10>

<?php

echo '<font size="7">'.$TC_title.' <p><font size=2>';

?>
</div></td></tr>
</table>

<script language="JavaScript">

function EditRecord(id,rec) {
	
	editcolor='#FFFF00';
	
	document.getElementById('editid').value=rec;
	
	// prefill date
	
	document.getElementById('indatetime_date').value=eval("document.getElementById('date_'+id).value");
	document.getElementById('indatetime_date').style.backgroundColor=editcolor;
	
	// prefill time
	
	document.getElementById('turntime').value=eval("document.getElementById('time_'+id).innerHTML");
	document.getElementById('turntime').style.backgroundColor=editcolor;

	// prefill turn
	
	thisturn=eval("document.getElementById('pos_"+id+"').innerHTML");
	
	for (i=0;i<document.getElementById('pos_sel').options.length;i++) {
		
		if (document.getElementById('pos_sel').options[i].text == thisturn) {
			
			document.getElementById('pos_sel').options.selectedIndex=i;
		}
		
	}
	
	document.getElementById('pos_sel').style.backgroundColor=editcolor;

}

</script>

<table bgcolor='#99ccff' cellpadding=0 cellspacing=0>
<tr>
<td valign="top">


</td>

<?

// now, loop through all records and then show a column representing each day

$res=mysql_query("select * from care_encounter_custom_tc where encounter_nr = '".$pn."' order by DATE(indatetime),time");

while ($resd=mysql_fetch_assoc($res)) {
	
$thisdate=date("m/d/Y",strtotime($resd['indatetime']));

$alldates[$thisdate][]=$resd['time']."\t".$resd['position']."\t".$resd['nr'];
	
}

foreach ($alldates as $var => $val) {

?>

<td valign="top" bgcolor="#99ccff">
<table width=215 style="font-size:9px" bgcolor="#33ccff" cellpadding=0 cellspacing=0>
<tr>
<td height=20 align=center>
<b><?php echo date("d/m/Y",strtotime($var))?></b>
</td>
</tr>
</table>

<?

$days++;

foreach ($alldates[$var] as $var2 => $val2) {

list($time,$pos,$id)=explode("\t",$val2);

$times++;

if (stristr($LDSUPINE,$pos)) {$color="#0000AA";}
if (stristr($LDLEFTLATERAL,$pos)) {$color="#00AA00";}
if (stristr($LDRIGHTLATERAL,$pos)) {$color="#AA0000";}

$tc++;

?>

<div id="<?php echo $id?>">
<table height=10 width=215 bgcolor="<?php echo $color?>" cellpadding=5 cellspacing=0><tr><td>
<input type=hidden id="date_<?php echo $tc?>" value="<?php echo date("d/m/Y",strtotime($var))?>">
<span style="font-size:9px"><font color=white><b><span id="time_<?php echo $tc?>"><?php echo date("H:i",strtotime($time))?></span> <span><?php echo " (".date("h:i a",strtotime($time)).")"?></span></b> : <span id="pos_<?php echo $tc?>"><?php echo $pos?></span></font></font>
</td><td align=right><span style="background-color:yellow">&nbsp;<a href="javascript:EditRecord('<?php echo $tc?>','<?php echo $id?>')"><?php echo $LDEDIT ?></a>&nbsp;</span></td></tr></table>
</div>
	
<?
	
}

?>

</td>

<?
		
}

?>

</tr>
</table>
<br>
<table bgcolor="#99ccff">
<tr>

<td>

<?php echo $LDDate?><br>
<table><tr><td>
		<?php
			//gjergji : new calendar
			require_once ('../../js/jscalendar/calendar.php');
			$calendar = new DHTML_Calendar('../../js/jscalendar/', $lang, 'calendar-system', true);
			$calendar->load_files();
  			echo $calendar->show_calendar($calendar,$date_format,'indatetime_date');
			//end : gjergji  
 		?>
</td>
</tr></table>

</td>

<td>

<?php echo $LDTime?><br>
<table><tr><td><input size=10 type=text name=turntime id=turntime maxlength=5></td><td>HH:MM (13:00)</td></tr></table>

</td>

<td>
<?php echo $LDPosition ?><br>
<table><tr><td><select name="pos" id="pos_sel">
<option><?php echo $LDSUPINE ?></option>
<option><?php echo $LDLEFTLATERAL ?></option>
<option><?php echo $LDRIGHTLATERAL ?></option>
</select>
</td></tr></table>
</td>

<td>
<a href='nursing-station-patientdaten-custom-tc.php<?php echo URL_REDIRECT_APPEND?>&station=<?php echo $station?>&pn=<?php echo $pn?>&edit=<?php echo $edit?>'><span style="background-color:yellow"><?php echo $LDEDIT ?></span></a>
</td>
</tr></table>

	
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

<input type=hidden name=editid id=editid value="">
	
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
