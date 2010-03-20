<?php if (($station=="")||($rt==NULL)||($rt!="pflege")||($sid==NULL)||($sid!=$$ck_sid_buffer)) 
{ header("location: invalid-access-warning.php?mode=close"); exit;}

/*
$datum=strftime("%d.%m.%Y");
$zeit=strftime("%H.%M");
$toggler=0;
*/


	if(($pyear==NULL)||($pyear=="")) $pyear=date(Y);
	if(($pmonth==NULL)||($pmonth=="")) $pmonth=date(m);
	if(($pday==NULL)||($pday=="")) $pday=date(d);


// if ($statdate=="") $statdate=$pyear.'-'.$pmonth.'-'.$pday;
if ($filename=="") $filename=$pyear.'-'.$pmonth.'-'.$pday.'.bel';

$monat=array("januar","februar","märz","april","mai","juni","juli","august","september","oktober","november","dezember");

//$xchars="!?*#/\&§+-_$;:~";

$filename=$pyear.'-'.$pmonth.'-'.$pday.'.bel';	 
$path="pflege/station/".strtolower($station)."/belegung/".$pyear."/".strtolower($monat[$pmonth-1])."/".strtolower($filename);
$statdata=array();

	//get the file eventually default file and save to current place
if (file_exists($path))
	{
		$statdata=get_meta_tags($path);
		if($mode=="copylast")
		{
			$pyear=date(Y);
			$pmonth=date(m);
			$pday=date(d);
			$filename=$pyear.'-'.$pmonth.'-'.$pday.'.bel';
			$path="pflege/station/".strtolower($station)."/belegung/".$pyear."/".strtolower($monat[$pmonth-1])."/".strtolower($filename);
			//save to file
			if($file=fopen($path,"w+"))
			{
				while(list($x,$v)=each($statdata))
				{
					$line='<meta name="'.$x.'" content="'.$v.'">';
					fwrite($file,$line."\r\n");
				}
				fclose($file);
			}
		}
	}
	else
	{
		 $path2="pflege/station/".$station."/template.bel";
		 $statdata=get_meta_tags($path2);
		 $statdata['stationname']=$station;
		 $statdata['stationid']=$station;	
		 $deffile=true;
	 }


// init color values
$path="../userconfig/".$ck_config; //ck_config is a cookie
if(file_exists($path)) $cfg=get_meta_tags($path);
else
{
	$path="../userconfig/default.cfg";
	$cfg=get_meta_tags($path);

}
//create unique id
$r=uniqid("");

// prevent client from caching
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    // Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate");  // HTTP/1.1
header ("Pragma: no-cache");                          // HTTP/1.0
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE>Stationsbelegung</TITLE>

<script language="javascript">
<!-- 
  var urlholder;

function getinfo(pid,pdata){
	urlholder="nursing-station-patientdaten.php?sid=<?php echo $sid; ?>&patient=" + pdata + "&station=<?php echo $station; ?>";
	patientwin=window.open(urlholder,pid,"width=700,height=450,menubar=no,resizable=yes,scrollbars=yes");
	}
	
function indata(room,bed)
{
	urlholder="nursing-station-bettbelegen.php?sid=<?php echo $sid; ?>&s=<?php echo $station; ?>&rm="+room+"&bd="+bed+"<?php echo "&py=".$pyear."&pm=".$pmonth."&pd=".$pday."&tb=".str_replace("#","",$cfg['top_bgcolor'])."&tt=".str_replace("#","",$cfg['top_txtcolor'])."&bb=".str_replace("#","",$cfg['body_bgcolor'])."&d=".$cfg['dhtml']; ?>";
	indatawin=window.open(urlholder,"bedroom","width=700,height=450,menubar=no,resizable=yes,scrollbars=yes");
}

function unlock(b,r)
{
<?php
	echo '
	urlholder="nursing-station.php?mode=newdata&patnum=unlock&rt=pflege&sid='.$sid.'&station='.$station.'&rm="+r+"&bd="+b+"&pyear='.$pyear.'&pmonth='.$pmonth.'&pday='.$pday.'";
	';
?>
	if(confirm("Die Sperre des Bett "+b+" im Zimmer "+r+"  aufheben:"))
	{
		window.location.replace(urlholder);
	}

}
// -->
</script>

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');

?>

</HEAD>

<BODY bgcolor=<?php echo $cfg['body_bgcolor']; ?> onLoad="if (window.focus) window.focus()" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<table width=100% border=0 cellpadding="0" cellspacing=0>
<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;&nbsp; Pflegestation-Belegung <?php echo strtoupper($station).' ('.$pday.'.'.$pmonth.'.'.$pyear.')'; ?> </STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right>
<a href="#"><img src="../img/hilfe.gif" border=0  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a>
<a href="#" onClick=window.close()><img src="../img/fenszu.gif" border=0  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td></tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
 <ul>
<?php
if($deffile)
		 	{
			 echo'<font face="verdana,arial" size="2"  color=red>Die Belegung für heute ist noch nicht erstellt!</font><br>';
			 }
		
//echo $statdata[$bd.$rm];
echo '<table  cellpadding="2" cellspacing=0 border="0" >';

echo '<tr bgcolor="aqua" align=center><td><font face="verdana,arial" size="2" ><b>Zimmer &nbsp;&nbsp;</b></td>';
echo '<td><font face="verdana,arial" size="2" ><b>Bett &nbsp;</b></td>';
echo '<td ><font face="verdana,arial" size="2" ><b>Name, Vorname &nbsp;</b></td>';
echo '<td><font face="verdana,arial" size="2" > <b>&nbsp; Geburtsdatum &nbsp;</b></td>';
echo '<td><font face="verdana,arial" size="2" > <b>AufnahmeNr. &nbsp;</b></td>';
echo '<td><font face="verdana,arial" size="2" > <b>Kasse &nbsp;</b></td>';
echo '<td><font face="verdana,arial" size="2" > <b>Optionen &nbsp;</b></td>';
echo '</tr>';



/* 
if($cfg['bname']=="netscape")
{
	while(list($x,$v)=each($statdata))
	{
		if($v=="") $statdata[$x]="test";
	}
}
*/
		 
for ($i=$statdata['startnumber'];$i<=$statdata['endnumber'];$i++)
 {
   for($j='a';$j<='b';$j++)
	{
	$buf=explode(" ",$statdata[$j.$i]);
	
	$buf2=str_replace(",","xcx",$statdata[$j.$i]);
	$buf2=str_replace(".","xdx",$buf2);
	$buf2=str_replace(" ","_",$buf2);
	$buf2=str_replace("+","xpx",$buf2);
	
	echo '<tr bgcolor="';
	if ($j=="a") echo '#ffffcc">'; else echo 'silver">';
	
	echo '<td align=center><font face="verdana,arial" size="1" >';
	if($j=="a") echo ($i); else echo "&nbsp;";
	echo '</td><td align=left><font face="verdana,arial" size="1" > '.strtoupper($j).' ';
	$helper=explode(" ",str_replace("-"," ",$buf[1]));
	switch(strtolower($helper[0]))
	{
		case "fr.": echo '<img src="../img/mans-red.gif">';break;
		case "frau": echo '<img src="../img/mans-red.gif">';break;		
		case "hr.": echo '<img src="../img/mans-gr.gif">';break;
		case "herr": echo '<img src="../img/mans-gr.gif">';break;		
		case "gesperrt": echo '<img src="../img/suspend.gif">';break;
		default: echo '<img src="../img/plus2.gif" border=0 alt="Bett ist unbelegt">';break;
	}
	echo "\r\n</td>";
	echo '<td><font face="verdana,arial" size="2" ><a href="#" onClick=';
	if($buf[0]!="!") echo 'getinfo(\''.$buf[0].'\',\''.$buf2.'\') title="Click für mehr Info">';
	else echo 'unlock(\''.strtoupper($j).'\',\''.$i.'\') title="Click für Info bzw. zum Aufheben der Sperre.">'; //$j=bed   $i=room number
	echo str_replace("-"," ",$buf[1]).' <b>'.$buf[2].'</b> '.$buf[3].'</a>';
	echo "\r\n";
	
	echo '</td><td align=center><font face="verdana,arial" size="1" >&nbsp;'.$buf[4].'</td>';
	echo '</td><td align=center><font face="verdana,arial" size="1" >&nbsp;';
	if ($buf[0]!="!") echo $buf[0];
	echo "\r\n";
	echo '</td><td ><font face="verdana,arial" size="1" >&nbsp;';
	if(strchr($buf[5],"P")) echo '<font color=red>';
	echo str_replace("-"," ",$buf[5]).'</td><td><a href="#"><img src="../img/patdata.gif" alt="Patientendaten zeigen" border="0"></a>&nbsp;
	 <img src="../img/email.gif" alt="Email an die Station ">&nbsp;
	 </td></tr>';
	echo "\r\n";
	}
}
	echo '</table>';

?>
<p>
<a href="#" onClick=window.close()><img src="../img/close.gif" border="0"></a>
</FONT>

</ul>

<p>
</td>
</tr>
</table>        
<p>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>

</BODY>
</HTML>
