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
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');
//$db->debug=true;
$thisfile=basename(__FILE__);
/* Create charts object */
require_once($root_path.'include/care_api_classes/class_charts.php');
$charts_obj= new Charts;

$title=$LDBpTemp;
$maxelement=10;

	/* Load date formatter */
      include_once($root_path.'include/inc_date_format_functions.php');
	// get orig data
	if($mode=='save'){
		$saved=0;
		$data_array=array();
		$data_array['encounter_nr']=$pn;
        $data_array['measured_by']=$_SESSION['sess_user_name'];
		$data_array['unit_nr']=14; // 14 = mmHg unit of measurement , must be set to local standards
		$data_array['msr_date']=date('Y-m-d',mktime(0,0,0,$mo,$dy,$yr)); 
		// Save the blood pressure data
		for($i=0;$i<$maxelement;$i++)
		{
			$tdx="btime".$i;$ddx="bdata".$i;
			if(empty($$tdx) || empty($$ddx)) continue;
			//$bbuf=$bbuf."B".$$tdx."b".$$ddx;
			$data_array['msr_time']=strtr($$tdx,':,;-/_','......');
			$data_array['value']=$$ddx;
			//echo $$ddx.$$tdx;
			if($charts_obj->saveBPFromArray($data_array)) $saved=1;
		}
		$data_array['unit_nr']=15; // 15 = Celsius unit of measurement , must be set to local standards
		// Save the temperature data
		for($i=0;$i<$maxelement;$i++)
		{
			$tdx="ttime".$i;$ddx="tdata".$i;
			if(empty($$tdx) || empty($$ddx)) continue;
			//$bbuf=$bbuf."B".$$tdx."b".$$ddx;
			$data_array['msr_time']=strtr($$tdx,':,;-/_','......');
			$data_array['value']=$$ddx;
			if($charts_obj->saveTemperatureFromArray($data_array)) $saved=1;
		}
		
		if($saved){
			header("location:$thisfile?sid=$sid&lang=$lang&edit=$edit&saved=1&pn=$pn&station=$station&winid=$winid&yr=$yr&mo=$mo&dy=$dy&dyidx=$dyidx&yrstart=$yrstart&monstart=$monstart&dystart=$dystart&dyname=$dyname");
			exit;
		}	
	}else{ // end of if(mode==save)
		include_once($root_path.'include/inc_editor_fx.php');
		include_once($root_path.'include/inc_date_format_functions.php');
		$bpcount=0;
		$tempcount=0;
		$chart_bp=$charts_obj->getDayBP($pn,date('Y-m-d',mktime(0,0,0,$mo,$dy,$yr)));		
		if(is_object($chart_bp)){
			$bpcount=$chart_bp->RecordCount();
		}	
		$chart_temp=$charts_obj->getDayTemperature($pn,date('Y-m-d',mktime(0,0,0,$mo,$dy,$yr)));		
		if(is_object($chart_temp)){
			$tempcount=$chart_temp->RecordCount();
		}	


/*		 	$sql="SELECT * FROM $dbtable WHERE patnum='$pn'";

			if($ergebnis=$db->Execute($sql))
       		{
				if($rows=$ergebnis->RecordCount())
				{
					$result=$ergebnis->FetchRow();
					//echo $sql."<br>";
				}
			}
				else {echo "<p>$sql$LDDbNoRead";}*/
	 }
?>
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
<TITLE><?php echo "$title $LDInputWin" ?></TITLE>
<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');

?>
<script language="javascript" src="<?php echo $root_path; ?>js/setdatetime.js"></script>
<script language="javascript" src="<?php echo $root_path; ?>js/chkValidTime.js"></script>

<script language="javascript">
<!-- 
  function resetinput(){
	document.infoform.reset();
	}

  function pruf(d){
	if(!d.newdata.value) return false;
	else return true
	}
 function parentrefresh(){
	window.opener.location.href="nursing-station-patientdaten-kurve.php?sid=<?php echo "$sid&lang=$lang&edit=$edit&station=$station&pn=$pn&tag=$dystart&monat=$monstart&jahr=$yrstart&tagname=$dyname" ?>&nofocus=1";
	}
//-->
</script>

<STYLE type=text/css>
div.box { border: double; border-width: thin; width: 100%; border-color: black; }
.v12 { font-family:verdana,arial;font-size:12; }
.v12 { font-family:verdana,arial;font-size:13; }
</style>

</HEAD>
<BODY  bgcolor="#99ccff" TEXT="#000000" LINK="#0000FF" VLINK="#800080"   topmargin="0" marginheight="0" 
onLoad="<?php if($saved) echo "parentrefresh();"; ?>if (window.focus) window.focus(); window.focus();" >
<table border=0 width="100%">
  <tr>
    <td><b><font face=verdana,arial size=5 color=maroon>
<?php 
	echo $title.'<br><font size=4>';	
	echo $LDFullDayName[$dyidx].' ('.formatDate2Local(date('Y-m-d',mktime(0,0,0,$mo,$dy,$yr)),$date_format).')</font>';
?>
	</font></b>
	</td>
    <td align="right" valign="top"><a href="javascript:gethelp('nursing_feverchart_xp.php','<?php echo $winid ?>','','','<?php echo $title ?>')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:window.close()" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></nobr>
</td>
  </tr>
</table>

<font face=verdana,arial size=3 >
<form name="infoform" action="<?php echo $thisfile ?>" method="post" onSubmit="return pruf(this)">
<font face=verdana,arial size=2 >


<table border=0 width=100% bgcolor="#6f6f6f" cellspacing=0 cellpadding=0>
  <tr>
    <td>
<table border=0 width=100% cellspacing=1>
<?php
if($bpcount||$tempcount){
	$rcount=($bpcount<$tempcount)?$tempcount:$bpcount;
?>
  <tr>
    <td align=center bgcolor="#ffffff">
	
<?php
	$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/tableHeaderbg3.gif"';
?>
 <table border=0 cellpadding=1 cellspacing=1 width=100%>
  <tr bgcolor="#f6f6f6">
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDTime; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDCurrentEntry; ?></td>
  </tr>
<?php
	$toggle=0;
	$bb=array();
	for($i=0;$i<$rcount;$i++){
		if($bpcount) $bb=$chart_bp->FetchRow();	
		if($toggle) $bgc='#efefef';
			else $bgc='#f0f0f0';
		$toggle=!$toggle;	
?>

  <tr  bgcolor="<?php echo $bgc; ?>"  valign="top">
    <td><FONT SIZE=1  FACE="Arial" color="#000033">
	<?php 
		if(!empty($bb['msr_time'])) echo $bb['msr_time']; 
	?>
	</td>
    <td><FONT SIZE=-1  FACE="Arial"><?php if($bb['value']) echo $bb['value'];else echo '&nbsp;'; ?></td>
  </tr>

<?php
	}
?>
</table>

	</td>
    <td align=center bgcolor="#ffffff" >
	
	<table border=0 cellpadding=1 cellspacing=1 width=100%>
  <tr bgcolor="#f6f6f6">
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDTime; ?></td>
    <td <?php echo $tbg; ?>><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDCurrentEntry; ?></td>
  </tr>
<?php
	$toggle=0;
	$bb=array();
	for($i=0;$i<$rcount;$i++){
		if($tempcount) $bb=$chart_temp->FetchRow();
		if($toggle) $bgc='#efefef';
			else $bgc='#f0f0f0';
		$toggle=!$toggle;
?>

  <tr  bgcolor="<?php echo $bgc; ?>"  valign="top">
    <td><FONT SIZE=1  FACE="Arial" color="#000033">
	<?php 
		if(!empty($bb['msr_time'])) echo $bb['msr_time']; 
	?>
	</td>
    <td><FONT SIZE=-1  FACE="Arial"><?php if($bb['value']) echo $bb['value']; else echo '&nbsp;';?></td>
  </tr>

<?php
	}
?>
</table>
	
	</td>
  </tr>
<?php
}
?>

  <tr>
    <td  align=center bgcolor="#cfcfcf" class="v13"><font color="#ff0000"><?php echo $LDBp ?></td>
    <td  align=center bgcolor="#cfcfcf" class="v13"><font color="#0000ff"><?php echo $LDTemp ?></td>
  </tr>


  <tr>
    <td align=center bgcolor="#ffffff">
	
		<table border=0 border=0 cellspacing=0 cellpadding=0>
			<tr>
   			 <td  align=center class="v12"><?php echo $LDClockTime ?>:</td>
   			 <td  align=center class="v12"><?php echo $LDBp ?>:</td>
		  </tr>
			<?php 
			$bb=array();
			for($i=0;$i<$maxelement;$i++)
			{
				if($bpcount) $bb=$chart_bp->FetchRow();
				echo '
 						 <tr>
   						 <td ><input type="text" name="btime'.$i.'" size=6 maxlength=5 value="'.$bb['msr_time'].'" onKeyUp="isvalidtime(this,\''.$lang.'\')">
        				</td>
   						 <td class="v12"><input type="text" name="bdata'.$i.'" size=8 maxlength=7 value="'.$bb['value'].'">mm/Hg'.$GLOBAL_CONFIG['measure_bp_unit_id'].'</td>
  						</tr>
 						 ';
				}
 			?>
		</table>
	
	</td>
    <td align=center bgcolor="#ffffff">
	
		<table border=0 border=0 cellspacing=0 cellpadding=0>
			<tr>
   			 <td  align=center class="v12"><?php echo $LDClockTime ?>:</td>
   			 <td  align=center class="v12"><?php echo $LDTemp ?>:</td>
		  </tr>
			<?php 
			for($i=0;$i<$maxelement;$i++)
			{
				if($tempcount) $bb=$chart_temp->FetchRow();
				echo '
 						 <tr>
   						 <td><input type="text" name="ttime'.$i.'" size=6 maxlength=5 value="'.$bb['msr_time'].'" onKeyUp="isvalidtime(this,\''.$lang.'\')">
        				</td>
   						 <td class="v12"><input type="text" name="tdata'.$i.'" size=8 maxlength=7 value="'.$bb['value'].'">°C'.$GLOBAL_CONFIG['measure_temp_unit_id'].'</td>
  						</tr>
  						';
			}
 			?>
		</table>
	
	</td>
  </tr>
</table>
</td>
  </tr>
</table>


<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="winid" value="<?php echo $winid ?>">
<input type="hidden" name="station" value="<?php echo $station ?>">
<input type="hidden" name="yr" value="<?php echo $yr ?>">
<input type="hidden" name="mo" value="<?php echo $mo ?>">
<input type="hidden" name="dy" value="<?php echo $dy ?>">
<input type="hidden" name="dyidx" value="<?php echo $dyidx ?>">
<input type="hidden" name="dystart" value="<?php echo $dystart ?>">
<input type="hidden" name="monstart" value="<?php echo $monstart ?>">
<input type="hidden" name="yrstart" value="<?php echo $yrstart ?>">
<input type="hidden" name="dyname" value="<?php echo $dyname ?>">
<input type="hidden" name="pn" value="<?php echo $pn ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<!-- <input type="hidden" name="sformat" value="<?php echo $sformat ?>"> -->
<input type="hidden" name="mode" value="save">

</form>
<p>
<a href="javascript:document.infoform.submit();"><img <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?> alt="<?php echo $LDSave ?>"></a>
&nbsp;&nbsp;
<!-- <a href="javascript:resetinput()"><img <?php echo createLDImgSrc($root_path,'reset.gif','0') ?> alt="<?php echo $LDReset ?>"></a>
 -->&nbsp;&nbsp;
<?php if($saved)  : ?>
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDClose ?>"></a>
<?php else : ?>
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDClose ?>">
</a>
<?php endif ?>

</BODY>

</HTML>