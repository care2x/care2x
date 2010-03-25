<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/*** CARE2X Integrated Hospital Information System beta 2.0.1 - 2004-07-04
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','radio.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);

if($mode=='search'&&!empty($sk)){

	if(!isset($db) || !$db) include_once($root_path.'include/core/inc_db_makelink.php');
	if($dblink_ok) {	
		/* Load date formatter */
		include_once($root_path.'include/core/inc_date_format_functions.php');
	}else { echo "$LDDbNoLink<br>"; }
	
	include_once($root_path.'include/care_api_classes/class_encounter.php');
	$enc_obj=new Encounter;
	$result=$enc_obj->searchEncounterBasicInfo($sk);
	
	include_once($root_path.'include/care_api_classes/class_globalconfig.php');
	$GLOBAL_CONFIG=array();
	$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
	$glob_obj->getConfig('patient_%');	
}

?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>

 <style type="text/css" name="s2">
.v12{ font-family:verdana,arial; color:#000000; font-size:12;}
</style>

<script language="javascript">
<!-- 

function demopreview(x)
{
	window.parent.PREVIEWFRAME.location.replace('radiolog-xray-display-film.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=preview');
	window.parent.DIAGNOSISFRAME.location.replace('radiolog-xray-diagnosis.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=preview');
	document.plist.xray_pic[x].checked=true;
}

function hilite_bg(x)
{
}
// -->
</script>
</head>
<body leftmargin=0 marginwidth=0>

<form name="plist">
<table border=0 cellpadding=0 cellspacing=0 width="100%">
  <tr>
    <td class="v12"><b>&nbsp;<?php echo $LDCaseNr ?>.</b></td>
    <td class="v12"><b>&nbsp;<?php echo $LDLastName ?></b></td>
    <td class="v12"><b>&nbsp;<?php echo $LDName ?></b></td>
    <td class="v12"><b>&nbsp;<?php echo $LDBday ?></b></td>
    <td class="v12"><b>&nbsp;<?php echo $LDSelect ?></b></td>
    <td class="v12"><b>&nbsp;<?php echo $LDShootDate ?></b></td>
    <td class="v12"><b>&nbsp;<?php echo $LDFullScreen ?></b></td>
  </tr>
   <tr>
    <td colspan=7 bgcolor="#0000ff"></td>
  </tr>
<?php 
if($mode=='search'&&$enc_obj->record_count)
{
	$i=0;
	$img_arrow=createComIcon($root_path,'bul_arrowblusm.gif','0','absmiddle'); // Load the torse icon image
	$img_torso=createComIcon($root_path,'torso.gif','0'); // Load the torse icon image
	while($pdata=$result->FetchRow())
	{
		echo'
 <tr>
    <td class="v12">&nbsp;';
	switch ($pdata['encounter_class_nr'])
	{
	   	case '1': echo ($pdata['encounter_nr'] + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
	                  break;
		case '2': echo ($pdata['encounter_nr'] + $GLOBAL_CONFIG['patient_outpatient_nr_adder']);
	  				break;
		default: echo ($pdata['encounter_nr'] + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
	}						
	echo '&nbsp;</td>
    <td class="v12">&nbsp;'.$pdata['name_last'].'&nbsp;</td>
    <td class="v12">&nbsp;'.$pdata['name_first'].'&nbsp;</td>
    <td class="v12">&nbsp;'.formatDate2Local($pdata['date_birth'],$date_format).'&nbsp;</td>
    <td class="v12">&nbsp;<a href="javascript:demopreview('.$i.')">'.$LDPreviewReport.' <img '.$img_arrow.'></a><input type="radio" name="xray_pic" value="1" onFocus="demopreview('.$i.')" >&nbsp;</td>
    <td class="v12">&nbsp; demo &nbsp;</td>
    <td class="v12"><a href="javascript:window.top.location.replace(\'sampledicom.htm\')" title="'.$LDFullScreen.'"><img '.$img_torso.'></a></td>
  </tr>
  <tr>
    <td colspan=7 bgcolor="#0000ff"></td>
  </tr>';
  	$i++;
/*	echo '&nbsp;</td>
    <td class="v12">&nbsp;'.$pdata['name_last'].'&nbsp;</td>
    <td class="v12">&nbsp;'.$pdata['name_first'].'&nbsp;</td>
    <td class="v12">&nbsp;'.formatDate2Local($pdata['date_birth'],$date_format).'&nbsp;</td>
    <td class="v12">&nbsp;<a href="javascript:demopreview('.$i.')">'.$LDPreviewReport.' <img '.$img_arrow.'></a><input type="radio" name="xray_pic" value="1" onFocus="demopreview('.$i.')" >&nbsp;</td>
    <td class="v12">&nbsp; demo &nbsp;</td>
    <td class="v12"><a href="javascript:window.top.location.replace(\'radiolog-xray-javastart.php'.URL_REDIRECT_APPEND.'&mode=display1\')" title="'.$LDFullScreen.'"><img '.$img_torso.'></a></td>
  </tr>
  <tr>
    <td colspan=7 bgcolor="#0000ff"></td>
  </tr>';
  	$i++;
*/  }
	echo '<input type="hidden" name="xray_pic" value="">';
}
?>
  </table>
</form>

</body>
</html>
