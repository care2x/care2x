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
$lang_tables=array('date_time.php');
$lang_tables=array('actions.php');
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');

//$db->debug=true;

$thisfile=basename(__FILE__);

/* Create charts object */
require_once($root_path.'include/care_api_classes/class_charts.php');
$charts_obj= new Charts;

	switch($winid)
	{
		case 'diag_ther': $title=$LDDiagnosisTherapy;
								//$element='diag_ther';
								$notes_type_nr=12;
								break;
		case "lot_mat_etc": $title=$LDExtraNotes;
								//$element="lot_mat_etc";
								$notes_type_nr=11;
								break;
		case "anticoag": $title=$LDAntiCoag;
										$element="anticoag";
										$notes_type_nr=10;
										break;
		case "xdiag_specials": $title=$LDExtraNotes;
								//$element="xdiag_specials";
								$notes_type_nr=14;
								break;
		case "allergy": $title=$LDAllergy;
								//$element="allergy";
								$notes_type_nr=22;
								break;
		case "kg_atg_etc": $title=$LDPtAtgEtcTxt;
								//$element="kg_atg_etc";
								$notes_type_nr=8;
								break;
	}

	if(($mode=='save')&&(trim($notes)!='')){
		$_POST['encounter_nr']=$pn;
		$_POST['personell_name']=$_SESSION['sess_user_name'];
		if($charts_obj->saveChartNotesFromArray($_POST,$notes_type_nr)){
    	  	// Load the visual signalling functions
    		include_once($root_path.'include/inc_visual_signalling_fx.php');	
			// Set the visual signal 
			setEventSignalColor($pn,SIGNAL_COLOR_ANTICOAG);
			header("location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=1&pn=$pn&station=$station&winid=$winid&yr=$yr&mo=$mo&dy=$dy&dystart=$dystart&dyname=$dyname");
		}
	}else{// end of if(mode==save)
 	
		$count=0;
		$chartnotes=$charts_obj->getChartNotes($pn,$notes_type_nr);		
		if(is_object($chartnotes)){
			$count=$chartnotes->RecordCount();
			include_once($root_path.'include/inc_editor_fx.php');
			include_once($root_path.'include/inc_date_format_functions.php');
		}	
	}

?>

<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
<TITLE><?php echo "$title - $LDInputWin" ?></TITLE>
<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');

?>
<script language="javascript">
<!-- 
  function resetinput(){
	document.infoform.reset();
	}

  function pruf(d){
	if(d.notes.value=="") return false;
	else return true
	}
 function parentrefresh(){
	window.opener.location.href="nursing-station-patientdaten-kurve.php?sid=<?php echo "$sid&lang=$lang&edit=$edit&station=$station&pn=$pn&tag=$dystart&monat=$mo&jahr=$yr&tagname=$dyname" ?>&nofocus=1";
	}
	
function sethilite(d){
	d.focus();
	d.value=d.value+"*";
	d.focus();
	}
function endhilite(d){
	d.focus();
	d.value=d.value+"**";
	d.focus();
	}
//-->
</script>

<STYLE type=text/css>
div.box { border: double; border-width: thin; width: 100%; border-color: black; }
</style>

</HEAD>
<BODY  bgcolor="#99ccff" TEXT="#000000" LINK="#0000FF" VLINK="#800080" topmargin="0" marginheight="0" 
onLoad="<?php if($saved) echo "parentrefresh();"; ?>if (window.focus) window.focus(); window.focus();document.infoform.notes.focus();" >

<table border=0 width="100%">
  <tr>
    <td><b><font face=verdana,arial size=5 color=maroon>
<?php 
	echo $title; 
?>
	</font></b>
	</td>
    <td align="right"><a href="javascript:gethelp('nursing_feverchart_xp.php','<?php echo $winid ?>','','','<?php echo $title ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:window.close()" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr>
</td>
  </tr>
</table>

<font face=verdana,arial size=3 >
<form name="infoform" action="<?php echo $thisfile ?>" method="post" onSubmit="return pruf(this)">
<?php
if($count){
	$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/tableHeaderbg3.gif"';
?>
 <table border=0 cellpadding=4 cellspacing=1 width=100%>
  <tr bgcolor="#f6f6f6">
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDCurrentEntry; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDate; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDTime; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDCreatedBy; ?></td>
  </tr>
<?php
	$toggle=0;
	while($row=$chartnotes->FetchRow()){
		if($toggle) $bgc='#efefef';
			else $bgc='#f0f0f0';
		$toggle=!$toggle;
?>


  <tr  bgcolor="<?php echo $bgc; ?>"  valign="top">
    <td><FONT SIZE=-1  FACE="Arial" color="#000033">
	<?php 
		if(!empty($row['notes'])) echo deactivateHotHtml(nl2br($row['notes'])); 
		if(!empty($row['short_notes'])) echo '[ '.deactivateHotHtml($row['short_notes']).' ]';
	?>
	</td>
    <td><FONT SIZE=1  FACE="Arial"><?php if(!empty($row['date'])) echo @formatDate2Local($row['date'],$date_format); ?></td>
    <td><FONT SIZE=1  FACE="Arial"><?php if($row['time']) echo $row['time']; ?></td>
    <td><FONT SIZE=1  FACE="Arial"><?php if($row['personell_name']) echo $row['personell_name']; ?></td>
  </tr>

<?php
	}
?>
</table>
<?php
}
?>

<p>
<font face=verdana,arial size=2 ><b><?php echo $LDEntryPrompt ?>:</b><br></font>
<textarea cols="35" rows="4" name="notes"><?php echo $notes ?></textarea>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="winid" value="<?php echo $winid ?>">
<input type="hidden" name="station" value="<?php echo $station ?>">
<input type="hidden" name="yr" value="<?php echo $yr ?>">
<input type="hidden" name="mo" value="<?php echo $mo ?>">
<input type="hidden" name="dy" value="<?php echo $dy ?>">
<input type="hidden" name="dystart" value="<?php echo $dystart ?>">
<input type="hidden" name="dyname" value="<?php echo $dyname ?>">
<input type="hidden" name="pn" value="<?php echo $pn ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="mode" value="save">
<br>
		 &nbsp;<a href="javascript:sethilite(document.infoform.notes)"><img <?php echo createComIcon($root_path,'hilite-s.gif','0','',TRUE) ?>></a>
		<a href="javascript:sethilite(document.infoform.notes)"><img <?php echo createComIcon($root_path,'hilite-e.gif','0','',TRUE) ?>></a>

<p>
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>>
 &nbsp;&nbsp;
<!-- <a href="javascript:resetinput()"><img <?php echo createLDImgSrc($root_path,'reset.gif','0') ?> alt="<?php echo $LDReset ?>"></a>
 -->&nbsp;&nbsp;
<?php if($saved)  : ?>
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"></a>
<?php else : ?>
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> border="0" alt="<?php echo $LDClose ?>">
</a>
<?php endif ?>
</form>

</BODY>
</HTML>
