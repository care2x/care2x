<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
define('LANG_FILE','or.php');
define("NO_CHAIN",1);
require_once($root_path.'include/inc_front_chain_lang.php');

/*if(!session_is_registered('sess_opfclic_rt')) session_register('sess_opfclic_rt');
if(!session_is_registered('sess_opfclic_filename')) session_register('sess_opfclic_filename');
*/
if(!session_is_registered('sess_comdat')) session_register('sess_comdat');

$template=array();

//setcookie(opfclic_rt,"timebar");
//setcookie(opfclic_filename,$filename);
$imgsrc=$root_path."main/imgcreator/log-timebar.php?sid=$sid&lang=$lang&winid=$winid&enc_nr=$enc_nr&op_nr=$op_nr&dept_nr=$dept_nr&saal=$saal&pyear=$pyear&pmonth=$pmonth&pday=$pday";
//setcookie(ck_comdat,"enc_nr=$enc_nr&op_nr=$op_nr&dept_nr=$dept_nr&saal=$saal&pyear=$pyear&pmonth=$pmonth&pday=$pday");

/*$_SESSION['sess_opfclic_rt']='timebar';
$_SESSION['sess_opfclic_filename']=$filename;
*/
$_SESSION['sess_comdat']="&enc_nr=$enc_nr&op_nr=$op_nr&dept_nr=$dept_nr&saal=$saal&thisday=$pyear-$pmonth-$pday&pyear=$pyear&pmonth=$pmonth&pday=$pday";

$hi=90;
$wid=3000;
$min=($wid*100)/(24*12);
$min2= $min/2;

$min=(int) $min;
$min2=(int) $min2;
$min/=100;
$min2/=100;

$tabrows=$hi/6;
$tabrows=$tabrows*100;
$tabrows=(int) $tabrows;
$tabrows/=100;


$i=$min2;

$hr="00";
$minute="05";

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<script language="javascript">
function refreshparent()
{
	window.top.LOGINPUT.location.replace("<?php echo "oploginput.php?sid=$sid&lang=$lang&enc_nr=$enc_nr&mode=notimereset".$_SESSION['sess_comdat']; ?>");
	window.top.OPLOGMAIN.location.replace("<?php echo "oplogmain.php?sid=$sid&lang=$lang&gotoid=$enc_nr".$_SESSION['sess_comdat']; ?>");
}
function pruf(t)
{
	alert("hello");
	//window.location.replace("opfclic.php?v='.$hr.'.'.$minute.'&g='.$group[$m]
}

function scroll2input(d)
{
 	tb=125;
	hr=d*tb;
	xtab=tb*2;
	scroll(hr-xtab,0);
}

function scroll2time()
{
 	zeit=new Date();
	hr=zeit.getHours()*125;
	xtab=250;
	scroll(hr-xtab,0);
}

function s(h,m,x)
{
	switch (x)
	{
		case "e": group="entry_out";
						break;
		case "c": group="cut_close";
						break;
		case "w": group="wait_time";
						break;
		case "b": group="bandage_time";
						break;
		case "r": group="repos_time";
						break;
	}
	window.location.href="opfclic.php?<?php echo "sid=$sid&lang=$lang" ?>&time="+h+"."+m+"&group="+group;
}
</script>
 
</HEAD>

<BODY  topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor=#cde1ec alink="navy" vlink="navy" 
onLoad="
<?php
if($resetmainput) echo 'refreshparent();'; 
	if($scrolltab) echo 'scroll2input(\''.$scrolltab.'\');setTimeout(\'scroll2time()\',30000);';
	 else echo 'scroll2time();';
?>setInterval('scroll2time()',900000);">

<table cellpadding="0" cellspacing="0" border=0 width=100%> 
<tr>
<td >
<map name="timebar">
<?php
$clas=array("$LDOpIn/$LDOpOut","$LDOpCut/$LDOpClose",$LDWaitTime,$LDPlasterCast,$LDReposition);

/*
$group=array("entry_out","cut_close","wait_time","bandage_time","repos_time");
for($n=$tabrows,$m=0;$n<$hi;$n+=$tabrows,$m++)
{
	echo '<AREA SHAPE="RECT" COORDS="0,'.$n.','.($min2-1).','.($n+$tabrows-1).'" href="opfclic.php?lang='.$lang.'&v='.$hr.'.0&g='.$group[$m].'"  alt="'.$hr.'.00 ('.$clas[$m].')" >';
	echo "\r\n";
	while($i<$wid)
	{
		$line='<AREA SHAPE="RECT" COORDS="'.$i.','.$n.','.(($i+$min)-1).','.($n+$tabrows-1).'" href="opfclic.php?lang='.$lang.'&v='.$hr.'.'.$minute.'&g='.$group[$m].'" alt="'.$hr.'.'.$minute.' ('.$clas[$m].')" >';

		echo $line;
		echo "\n";
		$i+=$min;
		if($minute==55) {$minute=0; $hr++;} else {$minute+=5;}
		if ($minute<10) $minute="0".$minute;
	}
	$i=$min2;
	$hr="00";
	$minute="05";
}
*/

$group=array("e","c","w","b","r");

for($n=$tabrows,$m=0;$n<$hi;$n+=$tabrows,$m++)
{
	echo '<AREA SHAPE="RECT" COORDS="0,'.$n.','.($min2-1).','.($n+$tabrows-1).'" title="'.$hr.':'.$minute.'" href="javascript:s(\''.$hr.'\',\'0\',\''.$group[$m].'\')">';
	echo "\r\n";
	while($i<$wid)
	{
		$line='<AREA SHAPE="RECT" COORDS="'.$i.','.$n.','.(($i+$min)-1).','.($n+$tabrows-1).'" title="'.$hr.':'.$minute.'" href="javascript:s(\''.$hr.'\',\''.$minute.'\',\''.$group[$m].'\')">';

		echo $line;
		echo "\n";
		$i+=$min;
		if($minute==55) {$minute=0; $hr++;} else {$minute+=5;}
		if ($minute<10) $minute="0".$minute;
	}
	$i=$min2;
	$hr="00";
	$minute="05";
}



?>
</map><img ismap usemap="#timebar" src="<?php echo $imgsrc; ?>" border=0>
</td>
</tr>

</table>


</BODY>
</HTML>
