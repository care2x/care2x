<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','nursing.php');

require('./include/inc_admit_station_bridge.php');

require_once($root_path.'include/core/inc_front_chain_lang.php');

require_once($root_path.'modules/news/includes/inc_editor_fx.php'); 
/* Load the data time shifter and create object */
require_once($root_path.'classes/datetimemanager/class.dateTimeManager.php');
$dateshifter=new dateTimeManager();

///$db->debug=true;

$thisfile=basename(__FILE__);
$breakfile="nursing-station-patientdaten.php".URL_APPEND."&station=$station&pn=$pn&edit=$edit";

if(!$kmonat) $kmonat=date('n');

if(!$tag) $tag=date('j');

if(!$jahr) $jahr=date('Y');

if($dayback)
{ 
	if($tag>$dayback)
	{
		$tag-=$dayback;
	}
	else
	{
		for($i=0;$i<$dayback;$i++)
		{
			if($tag>1) $tag--; 
			elseif($kmonat==1)
				{
				$jahr--;
				$kmonat=12;
				$tag=31;
				}
				else
				{
				$kmonat--;
				//$tag=31;
				//while(!checkdate($kmonat,$tag,$jahr)) $tag--;
				$tag=date("t",mktime(0,0,0,$kmonat,1,$jahr));
				}
		//if($tagname) $tagname--; else $tagname=6; 
		}
	}
} else if($dayfwd)
	{
		//if($tagname==7) $tagname=1; else $tagname++;			
	    $tag++;
		if(!checkdate($kmonat,$tag,$jahr))
			{
				$tag=1;
				if($kmonat==12) 
				{
					$kmonat=1; 
					$jahr++;
				}
				else $kmonat++;
			}
 		}
//echo $tagname." day ";
$tagname=date("w",mktime(0,0,0,$kmonat,$tag,$jahr));
$tagnamebuf=$tagname;

$date_start=date('Y-m-d',mktime(0,0,0,$kmonat,$tag,$jahr));
$date_end=$dateshifter->shift_dates($date_start,-6,'d');


	/* Create encounter object */
	include_once($root_path.'include/care_api_classes/class_encounter.php');
	$enc_obj= new Encounter;
	/* Load global configs */
	include_once($root_path.'include/care_api_classes/class_globalconfig.php');
	$GLOBAL_CONFIG=array();
	$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
	$glob_obj->getConfig('patient_%');	

	$enc_obj->where=" encounter_nr=$pn";
	// Preload the patient encounter object
	if( $enc_obj->loadEncounterData($pn)) {
/*		switch ($enc_obj->EncounterClass())
		{
		    case '1': $full_en = ($pn + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
		                   break;
			case '2': $full_en = ($pn + $GLOBAL_CONFIG['patient_outpatient_nr_adder']);
							break;
			default: $full_en = ($pn + $GLOBAL_CONFIG['patient_inpatient_nr_adder']);
		}						
*/
		$full_en=$pn;
		
		if( $enc_obj->is_loaded){
			$result=&$enc_obj->encounter;		
			$rows=$enc_obj->record_count;	
			/* Create charts object */
			include_once($root_path.'include/care_api_classes/class_charts.php');
			$charts_obj= new Charts;
		
			// get Allergy notes  type = 22
			$allergy=&$charts_obj->getChartNotes($pn,22);
			// get Diagnosis notes  type = 12
			$diagnosis=&$charts_obj->getChartNotes($pn,12);
			// get extra diagnosis notes   type = 14
			$x_diagnosis=&$charts_obj->getChartNotes($pn,14);
            // get anticoag notes   type = 10
            $anticoag_notes=&$charts_obj->getChartNotes($pn,10);
			// get additional notes   type = 11
			$lot_mat=&$charts_obj->getChartNotes($pn,11);
			// get daily Diet plans
			$diet=&$charts_obj->getChartDailyDietPlans($pn,$date_start,$date_end);
			// get daily main notes (diag/therapy)
			$main_notes=$charts_obj->getChartDailyMainNotes($pn,$date_start,$date_end);
			// get daily etc notes (pt-atg-etc)
			$daily_etc=$charts_obj->getChartDailyEtcNotes($pn,$date_start,$date_end);
			// get daily anticoag notes (diag/therapy)
			$daily_anticoag=$charts_obj->getChartDailyAnticoagNotes($pn,$date_start,$date_end);
			// get daily iv notes (diag/therapy)
			$daily_iv=$charts_obj->getChartDailyIVNotes($pn,$date_start,$date_end);
			// get all current medicine prescriptions
			$medis=$charts_obj->getAllCurrentPrescription($pn);
			// get daily prescription notes
			$daily_medis=$charts_obj->getChartDailyPrescriptionNotes($pn,$date_start,$date_end);
		}
	}else {echo $enc_obj->getLastQuery()."<p>$LDDbNoRead"; exit;}
	include_once($root_path.'include/core/inc_date_format_functions.php');


function getlatestdata($info,$d,$m,$y)
{
	if(is_object($info)){
		$ok=false;
		$date=date('Y-m-d',mktime(0,0,0,$m,$d,$y));
		while($data=$info->FetchRow()){
			if($data['date']==$date) {
				$ok=true;
				break;
			}
		}
		$info->MoveFirst();
		if($ok){
			 return $data;
		}else{return false;}
	}else{return false;}
}

function getdata($info,$d,$m,$y,$short=0){
	if(is_object($info)){
		$content='';
		$date=date('Y-m-d',mktime(0,0,0,$m,$d,$y));
		while($data=$info->FetchRow()){
			if($data['date']==$date) {
				if($short) $content=$data['short_notes']."\n".$content;
					else $content=$data['notes']."\n".$content;
			}
		}
		$info->MoveFirst();
		return trim($content);
	}else{return false;}
}

function aligndate(&$ad,&$am,&$ay)
{
	if(!checkdate($am,$ad,$ay))
	{
		if($am==12)
		{
			$am=1;
			$ad=1;
			$ay++;
		}
		else
		{
			$am=$am+1;
    		$ad=1;
		}
	}
}

# Prepare title
$sTitle = "$LDFeverCurve $station ($jahr";
if($kmonat==12) if($tag>25) $sTitle = $sTitle." - ".($jahr +1);
$sTitle = $sTitle.")";

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$sTitle);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('nursing_feverchart.php','main','','$station','Fever chart')");

 # hide return button
 $smarty->assign('pbBack',FALSE);

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$sTitle);

 # Body Onload js
 if(!$nofocus) $smarty->assign('sOnLoadJs','onLoad="if (window.focus) window.focus()"');

 # Collect js code

 ob_start();

?>

<style type="text/css" name="2">
.pblock {
	font-family: verdana, arial;
}

div.box {
	border: solid;
	border-width: thin;
	width: 100%
}

div.pcont {
	margin-left: 3;
}

.a12 {
	font-family: verdana, arial;
	font-size: 12;
}

.a10 {
	font-family: arial;
	font-size: 10;
}
</style>

<script language="javascript">
<!-- 
  var urlholder="";
  var infowinflag=0;
  var sw=window.screen.width/2;
  var sh=window.screen.height/2;
  var w600=600;
  var h400=400;
  var h600=600;
function popgetinfowin(winID,patientID,jahrID,monatID,tagID,tagS,tagN)
	{
	urlholder="nursing-popgetinfo.php?sid=<?php echo "$sid&lang=$lang&edit=$edit" ?>&winid=" + winID + "&station=<?php echo $station ?>&pn=" + patientID + "&yr=" + jahrID + "&mo=" + monatID + "&dy="+ tagID+ "&dystart="+ tagS + "&dyname="+ tagN;
	infowin=window.open(urlholder,"kurvendaten","width="+w600+",height="+h400+",menubar=no,resizable=yes,scrollbars=yes");
   	window.infowin.moveTo(sw-(w600/2),sh-(h400/2));
   	infowinflag=1;
	}
function popgetdailyinfo(winID,patientID,jahrID,monatID,tagID,tagIDX,jahrS,monatS,tagS,tagN)
	{
	urlholder="nursing-getdailyinfo.php?sid=<?php echo "$sid&lang=$lang&edit=$edit" ?>&winid=" + winID + "&station=<?php echo $station ?>&pn=" + patientID + "&yr=" + jahrID + "&mo=" + monatID + "&dy="+ tagID + "&dyidx="+ tagIDX+"&yrstart="+jahrS+"&monstart="+monatS+"&dystart="+ tagS + "&dyname="+ tagN ;
	dailywin=window.open(urlholder,"dailydaten","width=600,height=400,menubar=no,resizable=yes,scrollbars=yes");
   	infowinflag=1;
	}
function popgetdailybpt(winID,patientID,jahrID,monatID,tagID,tagIDX,jahrS,monatS,tagS,tagN)
	{
	urlholder="nursing-getdailybp_t.php?sid=<?php echo "$sid&lang=$lang&edit=$edit" ?>&winid=" + winID + "&station=<?php echo $station ?>&pn=" + patientID + "&yr=" + jahrID + "&mo=" + monatID + "&dy="+ tagID + "&dyidx="+ tagIDX +"&yrstart="+jahrS+"&monstart="+monatS+"&dystart="+ tagS + "&dyname="+ tagN ;
	dailybpt=window.open(urlholder,"dailybpt","width="+w600+",height="+h600+",menubar=no,resizable=yes,scrollbars=yes");
   	window.dailybpt.moveTo(sw-(w600/2),sh-(h600/2));
   	infowinflag=1;
	}
function popgetmedx(winID,patientID,tagID)
	{
	w=1000;
	urlholder="nursing-getmedx.php?sid=<?php echo "$sid&lang=$lang&edit=$edit&dept_nr=$dept_nr&" ?>&winid=" + winID + "&station=<?php echo $station ?>&pn=" + patientID + "<?php echo "&yr=$jahr&mo=$kmonat&dystart=$tag&dyname=$tagname&dy="; ?>" + tagID ;
	dailymedx=window.open(urlholder,"medx","width="+w+",height="+h600+",menubar=no,resizable=yes,scrollbars=yes");
   	window.dailymedx.moveTo(sw-(w/2),sh-(h600/2));
   	infowinflag=1;
	}
function popgetdailymedx(winID,patientID,jahrID,monatID,tagID,tagIDX,jahrS,monatS,tagS,tagN)
	{
	urlholder="nursing-getdailymedx.php?sid=<?php echo "$sid&lang=$lang&edit=$edit" ?>&winid=" + winID + "&station=<?php echo $station ?>&pn=" + patientID + "&yr=" + jahrID + "&mo=" + monatID + "&dy="+ tagID + "&dyidx="+ tagIDX+"&yrstart="+jahrS+"&monstart="+monatS+"&dystart="+ tagS + "&dyname="+ tagN ;
	dailymedx=window.open(urlholder,"dailymedx","width="+w600+",height="+h600+",menubar=no,resizable=yes,scrollbars=yes");
   	window.dailymedx.moveTo(sw-(w600/2),sh-(h600/2));
   	infowinflag=1;
	}
	
function setStartDate(winID,patientID,jahrID,monatID,tagID,station,tagN){

<?php
if($cfg['bname']=='msie'){
?>
	if(event.button==2)
		{
		//alert("right click");
		if(winID=="dayback") dayID="<?php echo $LDStartDate ?>";
		if(winID=="dayfwd") dayID="<?php echo $LDEndDate ?>";
		if(confirm("<?php echo $LDConfirmSetDate ?>"))
			{
			urlholder="nursing-station-patientdaten-setstartdate.php?sid=<?php echo "$sid&lang=$lang&edit=$edit" ?>&winid="+winID+"&pn=" + patientID + "&jahr=" + jahrID + "&kmonat=" + monatID + "&tag="+ tagID + "&station="+station+"&tagname="+ tagN ;
			setdatewin=window.open(urlholder,"setdatewin","width=400,height=250,menubar=no,resizable=yes,scrollbars=yes");
   			infowinflag=1;
			}
		}
		else 
<?php
}
?>
		{
		// alert("left click");	
		urlholder="nursing-station-patientdaten-kurve.php?sid=<?php echo "$sid&lang=$lang&edit=$edit" ?>&"+winID+"=1&pn=" + patientID + "&jahr=" + jahrID + "&kmonat=" + monatID + "&tag="+ tagID + "&station="+station+"&tagname="+ tagN ;
 		window.location.replace(urlholder);
   		}
}

function closeifok()
{
	ok=0;
	if (infowinflag){
		if (window.infowin)
		{ if (window.infowin.closed) ok=1;
			else
			{
	 			window.infowin.focus()
				window.infowin.alert("Ein Eingabefenster ist noch nicht abgeschlossen")	
			}
		}
		else ok=1;
	}	
	else ok=1;
	if(ok)
	{
		window.opener.focus();
		window.close();
	}
}	
	
function returnifok(){
	if (infowinflag){
		if(window.infowin.closed)  history.go(-2)
	window.infowin.focus()
	window.infowin.alert("Ein Eingabefenster ist noch nicht abgeschlossen")	
	}
	else history.back()
	}
//-->
</script>

<?php

$sTemp = ob_get_contents();
ob_end_clean();
$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

?>

<script language="">
<!-- Script Begin
var dblclk=0;
//  Script End -->
</script>

<form name="berichtform">
<?php

//****************************** Encounter number ********************************
echo '
		<table   cellpadding="0" cellspacing=1 border="0" >
		<tr  >
		<td bgcolor="aqua" class=pblock><font size="2" ><div class=pcont><b>'.$full_en.'</b></div></td>
		<td bgcolor="white" >';
		
//****************************** Allergy ********************************
		if($edit){
			echo '
			<a href="javascript:popgetinfowin(\'allergy\',\''.$pn.'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$tag.'\',\''.$tagname.'\')">
			<font face="verdana,arial" size="2" color=red >'.$LDAllergy.':
			<img '.createComIcon($root_path,'clip2.gif','0').' alt="'.str_replace("~tagword~",$LDAllergy,$LDClk2Enter).'" ></a>
			';
		}else{
			echo '
			<font face="verdana,arial" size="2" color=red >'.$LDAllergy.':';
		}
		echo '
		</td>';
//****************************** DAy scale ********************************

echo '
		<td colspan="7"> 
		<table cellpadding="0"  cellspacing="0" border="1" width="100%"><tr>';

$actmonat=$kmonat;
$actjahr=$jahr;

for ($i=$tag,$acttag=$tag,$d=0,$tgbuf=$tagname;$i<($tag+7);$i++,$d++,$tgbuf++,$acttag++)
	{
	echo '<td';

	aligndate(&$acttag,&$actmonat,&$actjahr); // function to align the date

	switch($tgbuf) 
		{
			case 0: echo' bgcolor="orange"';break;
			case 6: echo' bgcolor="#ffffcc"';break;
			case 7: echo' bgcolor="orange"'; $tgbuf=0;break;
			default: echo' bgcolor="white"';
		}

	if(!$d) echo' align=left width="98">';else if($d>5) echo' align=right width="98">';else echo' align=center width="98">';
	if(!$d) echo '<a href="#">
		<img '.createComIcon($root_path,'l_arrowgrnsm.gif','0','',TRUE).' alt="'.$LDBackDay.'" onMouseDown="setStartDate(\'dayback\',\''.$pn.'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$station.'\',\''.$tagname.'\');return false;"></a>';
	echo '
	<font face="verdana,arial" size="2" color="#000000" >'.formatShortDate2Local($actmonat,$acttag,$date_format).' . '.$tage[$tgbuf];
	if ($d==6) echo ' <a href="#">
		<img '.createComIcon($root_path,'r_arrowgrnsm.gif','0','',TRUE).' alt="'.$LDFwdDay.'" onMouseDown="setStartDate(\'dayfwd\',\''.$pn.'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$station.'\',\''.$tagname.'\')"></a>';
	
	echo '</td>';
	//$tgbuf++;
	echo "\n";
	}

//$tagname-=7;
$actmonat=$kmonat;
$actjahr=$jahr;

//****************************** daily  diet plan ********************************
echo '</tr><tr>';
for ($i=$tag,$acttag=$tag,$d=0;$i<($tag+7);$i++,$d++,$acttag++)
{

	aligndate(&$acttag,&$actmonat,&$actjahr); // function to align the date
	echo '
	<td bgcolor=white align=center class="a12" width="98">';
	if($edit) echo '
	<a href="javascript:popgetdailyinfo(\'diet\',\''.$pn.'\',\''.$actjahr.'\',\''.$actmonat.'\',\''.$acttag.'\',\''.($d+$tagnamebuf).'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$tagname.'\')" title="'.$LDClk2PlanDiet.'">';
	echo '
	<font face="verdana,arial" size="2" color="#0" >';
	
	if($r=getlatestdata($diet,$i,$kmonat,$jahr))  echo hilite($r['short_notes']);
	 	else  echo $LDDiet;
		
}
//**************** Patient personal data ************************************
	if($edit) echo '</a>';
echo '</td>
		</tr></table> 
		
		</td>
		</tr>
		<tr   valign="top">
		<td bgcolor="#ffffcc" class=pblock width="130"><font size=2>
		<div class=pcont><b>'.ucfirst($result['name_last']).', '.ucfirst($result['name_first']).'</b> <br>
		<font color=maroon>'.formatDate2Local($result['date_birth'],$date_format).'</font> <p>
		<font size=1>'.$result['addr_str'].' '.$result['addr_str_nr'].'<br>'.$result['addr_zip'].' '.$result['citytown_name'].'<p>
		'.strtoupper($station).'&nbsp;'.$result['insurance_class_nr'].'  '.$result['insurance_firm_id'].'</div></td>';

//**************** allergy data ************************************
echo'
		<td bgcolor=white ><font face="verdana,arial" size="2" color=red ><img '.createComIcon($root_path,'scale.gif','0','right').'>';
		if(is_object($allergy)){
			while($buff=$allergy->FetchRow()){
				echo hilite(nl2br($buff['notes'])).'<br>';
			}
		}
		echo '</td>';

//**************** curve graph ************************************
echo '
		<td bgcolor=white colspan="7">';
		if($edit) 
		
$actmonat=$kmonat;
$actjahr=$jahr;

if($edit)
{
	echo '
		<MAP NAME="FrontPageMap">';
	for($i=$tag,$acttag=$tag,$d=0,$x0=0,$x1=99;$i<($tag+7);$i++,$d++,$x0+=100,$x1+=100,$acttag++)
	{
		aligndate(&$acttag,&$actmonat,&$actjahr); // function to align the date
	 echo'
		<AREA SHAPE="RECT" COORDS="'.$x0.',0,'.$x1.',133" HREF="javascript:popgetdailybpt(\'bp_temp\',\''.$pn.'\',\''.$actjahr.'\',\''.$actmonat.'\',\''.$acttag.'\',\''.($d+$tagnamebuf).'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$tagname.'\')" title="'.str_replace("~tagword~",$LDBpTemp,$LDClk2EnterDaily).'" >';
	}
	echo '
		</MAP>';
}
echo '
		<img';
if($edit) echo ' ismap usemap="#FrontPageMap"';
echo ' src="'.$root_path.'main/imgcreator/datacurve.php'.URL_APPEND.'&pn='.$pn.'&max=15&yr='.$jahr.'&mo='.$kmonat.'&dy='.$tag.'" height=135 width=700 border=0 >
		</td>
		</tr>
		<tr   valign="top" >
		<td bgcolor=white colspan="2" height="150">
		<font size=1 face="verdana,arial">';;
		
/******************** Main diagnose Therapy *****************************************/
if($edit){
	echo '
		 <a href="javascript:popgetinfowin(\'diag_ther\',\''.$pn.'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$tag.'\',\''.$tagname.'\')">'.$LDDiagnosisTherapy.'
		<img '.createComIcon($root_path,'clip2.gif','0').' alt="'.str_replace("~tagword~",$LDDiagnosisTherapy,$LDClk2Enter).'" ></a>';
}else{
	echo $LDDiagnosisTherapy;
}
		if(is_object($diagnosis)){
			while($buff=$diagnosis->FetchRow()){
				echo '<br>'.hilite(nl2br($buff['notes']));
			}
		}
		echo '</td>';
		
//********************************** diagnose therapie daily report ****************************
$actmonat=$kmonat;
$actjahr=$jahr;

for ($i=$tag,$acttag=$tag,$d=0;$i<($tag+7);$i++,$d++,$acttag++)
{
	aligndate(&$acttag,&$actmonat,&$actjahr); // function to align the date
	echo '
		<td bgcolor=white  height="150" width="98"><font face="verdana,arial" size="1" color="#000000">';
	if($edit) echo '
		<a href="javascript:popgetdailyinfo(\'diag_ther_dailyreport\',\''.$pn.'\',\''.$actjahr.'\',\''.$actmonat.'\',\''.$acttag.'\',\''.($d+$tagnamebuf).'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$tagname.'\')">';

	if($r=&getdata($main_notes,$i,$kmonat,$jahr))  echo hilite(nl2br($r));
	else 
	  if($edit) echo '<img src="'.$root_path.'gui/img/common/default/pixel.gif" width="97" height="148"  border=0 alt="'.str_replace("~tagword~",$LDDiagnosisTherapy,$LDClk2EnterDaily).'" >';
	if($edit) echo "</a>";
	echo "
	</td>";
	}
	
//************************* extra Diagnoses specials **********************************
echo '
		</tr>
		<tr   valign="top">
		<td bgcolor=white colspan="2" height="50">
<font size=1 face="verdana,arial">';
if($edit){
	echo '
	<a href="javascript:popgetinfowin(\'xdiag_specials\',\''.$pn.'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$tag.'\',\''.$tagname.'\')">'.$LDSpecialsExtra.' <img '.createComIcon($root_path,'clip2.gif','0').' alt="'.str_replace("~tagword~",$LDSpecialsExtra,$LDClk2Enter).'" ></a>';
}else{
	echo $LDSpecialsExtra;
}
		if(is_object($x_diagnosis)){
			while($buff=$x_diagnosis->FetchRow()){
				echo '<br>'.hilite(nl2br($buff['notes']));
			}
		}
echo '</td>';

	//***************************  KG ATG etc .  daily report ***************************
$actmonat=$kmonat;
$actjahr=$jahr;
	
for ($i=$tag,$acttag=$tag,$d=0;$i<($tag+7);$i++,$d++,$acttag++)
{
	aligndate(&$acttag,&$actmonat,&$actjahr); // function to align the date
	echo '
		<td bgcolor=white  height="50"><font face="verdana,arial" size="1" color="#000000">';
	if($edit) echo '
		<a href="javascript:popgetdailyinfo(\'kg_atg_etc\',\''.$pn.'\',\''.$actjahr.'\',\''.$actmonat.'\',\''.$acttag.'\',\''.($d+$tagnamebuf).'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$tagname.'\')" title="'.str_replace("~tagword~",$LDPtAtgEtc,$LDClk2EnterDaily).'">';
	echo $LDPtAtgEtc.':';
	if($edit) echo '</a>';
	echo '<br>';
		$sbuf="";

		if($r=&getdata($daily_etc,$i,$kmonat,$jahr))  echo hilite($r);

	echo "
		</td>";
	}

echo '
		</tr>';

echo '
		<tr   valign="top">';

// ************** anticoag  ************************
if(is_object($anticoag_notes)){
   $reccount=$anticoag_notes->RecordCount();
}else{
   $reccount=FALSE;
}
echo '
		<td bgcolor=';
		if($reccount) echo 'aqua colspan="2">'; else echo '#ffffff colspan="2">';
echo ' <font size=1 face="verdana,arial">';
if($edit){
    echo '<font size=1 face="verdana,arial">
         <a href="javascript:popgetinfowin(\'anticoag\',\''.$pn.'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$tag.'\',\''.$tagname.'\')">'.$LDAntiCoag.'
        <img '.createComIcon($root_path,'clip2.gif','0').' alt="'.str_replace("~tagword~",$LDAntiCoag,$LDClk2Enter).'" ></a>';
}else{
    echo $LDAntiCoag;
}
        if($reccount){
            while($buff=$anticoag_notes->FetchRow()){
                echo ' '.hilite($buff['notes']);
            }
        }
echo '</font></td>';

// ************** anticoag dailydose ************************
$actmonat=$kmonat;
$actjahr=$jahr;
for ($i=$tag,$acttag=$tag,$d=0;$i<($tag+7);$i++,$d++,$acttag++)
{
	aligndate(&$acttag,&$actmonat,&$actjahr); // function to align the date
	$r=&getdata($daily_anticoag,$i,$kmonat,$jahr,1);
	echo '
	<td ';
	if(!empty($r)) echo "bgcolor=aqua"; else echo "bgcolor=white";
	echo '><font face="verdana,arial" size="1" color="#000000">';
	if($edit) echo '
	<a href="javascript:popgetdailyinfo(\'anticoag_dailydose\',\''.$pn.'\',\''.$actjahr.'\',\''.$actmonat.'\',\''.$acttag.'\',\''.($d+$tagnamebuf).'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$tagname.'\')" title="'.str_replace("~tagword~",$LDAntiCoag,$LDClk2EnterDaily).'" >';

	if(!empty($r))
	 echo $r;
	else 
	  if($edit) echo '<img src="p.gif" width="95" height="12"  align="absmiddle"  border=0 alt="'.str_replace("~tagword~",$LDAntiCoag,$LDClk2EnterDaily).'" >';
	if($edit) echo '</a>';
	echo '
	</td>';
	
	}

echo '
		</tr>
		<tr   valign="top">';
// ************** Notes (Angaben) Lot-Mat-Ch.nr ************************
echo '
		<td bgcolor=white valign="top" width="130" class="a10">
		';
if($edit){
	echo ' <a href="javascript:popgetinfowin(\'lot_mat_etc\',\''.$pn.'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$tag.'\',\''.$tagname.'\')">'.$LDExtraNotes.': <img '.createComIcon($root_path,'clip2.gif','0').'  alt="'.str_replace("~tagword~",$LDExtraNotes,$LDClk2Enter).'" ></a>';
}else{
	echo $LDExtraNotes;
}
	if(is_object($lot_mat)){
			while($buff=$lot_mat->FetchRow()){
				echo '<br>'.hilite(nl2br($buff['notes']));
			}
		}

echo '</td>';
		
// ************** medication ************************

if(is_object($medis)){
	$maxmedx=$medis->RecordCount();
}else{
	$maxmedx=10;
}
if(!$maxmedx||$maxmedx<10) $maxmedx=10;

echo '
		<td bgcolor="#ffffff" ><nobr><font size=1 face="verdana,arial" >';
	if($edit) echo '<a href="javascript:popgetmedx(\'medication\',\''.$pn.'\',\''.$tag.'\')" title="'.str_replace("~tagword~",$LDMedication,$LDClk2Enter).'">';
echo $LDMedication;
	if($edit) echo '</a>';
echo ' <font color="#ff3366">'.$LDIvPort.'></font></font></nobr><br>';
echo '
<table border=0 border="0" cellpadding="0"  cellspacing="0" width="100%">
  <tr>
    <td bgcolor="#cfcfcf">
	<table border="0" cellpadding="0"  cellspacing="1" width="100%">';
$toggle=0;
for ($i=0;$i<$maxmedx;$i++){
		$m=$medis->FetchRow();
		if ($toggle) $bgc="#efefef"; else $bgc="#ffffff";
		echo '<tr><td bgcolor="'.$bgc.'" class="a10">';
		if($m['article']) echo substr($m['article'],0,strpos($m['article'], '-')).'/'.$m['admin_time']; else echo '&nbsp;';
		echo '
			</td></tr>';
		echo "\n";
		$toggle=!$toggle;
		}
echo '</table>
</td>
  </tr>
</table>';
echo	'</td>';

// ************** iv zugang dailydose ************************
$actmonat=$kmonat;
$actjahr=$jahr;
for ($i=$tag,$acttag=$tag,$d=0;$i<($tag+7);$i++,$d++,$acttag++) {
	aligndate(&$acttag,&$actmonat,&$actjahr); // function to align the date
	$r=&getdata($daily_iv,$i,$kmonat,$jahr,1);
	echo '
	<td valign="bottom" ';
	if($r) echo "bgcolor=#ff99cc"; else echo "bgcolor=white";
	echo '><font face="verdana,arial" size="1" color="#000000">';

	if($edit) echo '<a href="javascript:popgetdailyinfo(\'iv_needle\',\''.$pn.'\',\''.$actjahr.'\',\''.$actmonat.'\',\''.$acttag.'\',\''.($d+$tagnamebuf).'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$tagname.'\')" title="'.str_replace("~tagword~",$LDIvPort,$LDClk2EnterDaily).'">';

	if($r){
		echo substr($r,0,13);
	}elseif($edit){
		echo '<img src="p.gif" width="95" height="9"  align="absmiddle"  border=0 alt="'.str_replace("~tagword~",$LDIvPort,$LDClk2EnterDaily).'">';
	}
	if($edit) echo '</a></font>';
	
// ************** medication dailydose ************************
	//$dosis=&getdata($daily_medis,$acttag,$actmonat,$actjahr);
	$date=date('Y-m-d',mktime(0,0,0,$kmonat,$i,$jahr));
	$toggle=0;
	$dosis=array();
	echo '
	<table border=0 border="0" cellpadding="0"  cellspacing="0" width="100%">
  <tr>
    <td bgcolor="#cfcfcf">
	<table border="0" cellpadding="0"  cellspacing="1" width="100%">';
	if(is_object($medis)) $medis->MoveFirst(); // reset medication object
	for ($j=0;$j<$maxmedx;$j++){
		if ($toggle) $bgc="#efefef"; else $bgc="#ffffff";
		echo '<tr><td ';
		$ok=false;
		if(is_object($daily_medis)&&is_object($medis)){
			$med=$medis->FetchRow();
			while($dosis=$daily_medis->FetchRow()){
				if(($dosis['date']==$date)&&($dosis['nr']==$med['prescription_nr'])){
				//if(($dosis['date']==$date)){
					$ok=true;
					break;
				}
			}
			$daily_medis->MoveFirst();
		}
		echo ' bgcolor="'.$bgc.'" class="a10">&nbsp;';
		if($edit) echo '<a href="javascript:popgetdailymedx(\'medication\',\''.$pn.'\',\''.$actjahr.'\',\''.$actmonat.'\',\''.$acttag.'\',\''.($d+$tagnamebuf).'\',\''.$jahr.'\',\''.$kmonat.'\',\''.$tag.'\',\''.$tagname.'\')" title="'.str_replace("~tagword~",$LDMedication,$LDClk2PlanDaily).'">';

		if($ok) 
			echo $dosis['short_notes']; 
		else 
			echo'<img src="p.gif" width="90" height="9"  align="absmiddle"  border=0>';
		if($edit) echo '</a>';
		echo '</td></tr>';
		$toggle=!$toggle;	
		echo "\n";
	}
		echo '</table>
		</td>
  </tr>
</table>';

	echo '</td>';
}

echo 
'</tr>
	</table>
';

?>
</form>

<p>
<ul>
	<a href="<?php echo "$breakfile" ?>"><img
		<?php echo createLDImgSrc($root_path,'close2.gif','0') ?>></a>
	</FONT>
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
