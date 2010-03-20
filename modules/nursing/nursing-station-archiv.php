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
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

if(!$dept) 
	if($_COOKIE[ck_thispc_dept]) $dept=$_COOKIE[ck_thispc_dept];
		else $dept='plop'; // set to default plop = plastic surgery op

$breakfile="nursing.php".URL_APPEND;

$datum=strftime("%d.%m.%Y");
$zeit=strftime("%H.%M");
$toggler=0;
$pmonth=(int)$pmonth;
if($pmonth=="") $pmonth=date("n");
if($pyear=="") $pyear=date("Y");

$maxdays=date("t",mktime(0,0,0,$pmonth,1,$pyear));

function wkdaynum($daynum,$mon,$yr){
		$jd=gregoriantojd($mon,$daynum,$yr);
		switch(JDDayOfWeek($jd,0))
			{
				case 0: return 6;
				case 1: return 0;
				case 2: return 1;
				case 3: return 2;
				case 4: return 3;
				case 5: return 4;
				case 6: return 5;
			}
	}

$daynumber=array();

for ($n=0;$n<wkdaynum(1,$pmonth,$pyear);$n++){
	$daynumber[$n]="";
}
for($i=1;$i<=$maxdays;$i++)
{
	$daynumber[$n]=$i;$n++;
}
while ($n<35) 
{
	$daynumber[$n]="";
	$n++;
}

# Start the smarty templating
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

# Added for the common header top block

 $smarty->assign('sToolbarTitle',"$LDNursingStations - $LDArchive");

 $smarty->assign('pbHelp',"javascript:gethelp('nursing_how2search.php','','','arch')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDNursingStations - $LDArchive");

 /**
 * collect JavaScript for Smarty
 */
 ob_start();
?>

<script language="javascript" >
<!-- 
var urlholder;

function update()
{

	var mbuf=document.direct.month.selectedIndex+1;
	var jbuf=document.direct.jahr.value;
	if(!isNaN(jbuf))
	{
	jbuf=parseInt(jbuf);
	var urltarget="nursing-station-archiv.php<?php echo URL_REDIRECT_APPEND; ?>&pmonth="+mbuf+"&pyear="+jbuf;
	window.location.replace(urltarget);
	}
	else document.direct.jahr.select();
	return false;
}

function cxjahr(offs)
{
	
	var buf=document.direct.jahr.value;
	if(offs<1) buf--; else buf++;
	if(!isNaN(buf)) 
	{
	buf=parseInt(buf);
	document.direct.jahr.value=buf;
	}
	else document.direct.jahr.select();
} 

// -->
</script>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

?>

<ul>
<FONT  class="prompt">
<?php echo $LDClkDate ?>
</font><p>
<?php 
echo '<table cellspacing=0 cellpadding=0 border=0>
		<tr><td align=left>';
echo '<a href="nursing-station-archiv.php'.URL_APPEND.'&pmonth=';
if($pmonth<2) echo '12&pyear='.($pyear-1).'" title="'.$LDLastMonth.'">&lt;'.$monat[11];
else echo ($pmonth-1).'&pyear='.$pyear.'" title="'.$LDLastMonth.'">&lt;'.$monat[$pmonth-2];
echo '</a></td><td  align=center>';
echo '<FONT color=navy><b>'.$monat[$pmonth-1].' '.$pyear.'</b></font>';
echo '</td><td align=right>';
echo '<a href="nursing-station-archiv.php'.URL_APPEND.'&pmonth=';
if($pmonth>11) echo '1&pyear='.($pyear+1).'" title="'.$LDNextMonth.'">'.$monat[0];
else echo ($pmonth+1).'&pyear='.$pyear.'" title="'.$LDNextMonth.'">'.$monat[$pmonth];
echo '&gt;</a></td></tr><tr><td bgcolor=black colspan=3>';

echo '<table border="0" cellspacing=1 cellpadding=5>';

echo '<tr>';
for($n=0;$n<6;$n++)
	{
		echo '<td bgcolor=white><FONT SIZE=4 ><b>'.$tage[$n].'</b></td>';
	}
echo '<td bgcolor="#ffffcc"><FONT SIZE=4 color=red ><b>'.$tage[6].'</b></td>';
echo '</tr>';

$j=0;
for($x=0;$x<6;$x++)
{	echo '<tr>';
	
		for($n=0;$n<6;$n++)
		{
			if($daynumber[$j].$pmonth.$pyear==date(jnY)) echo '
			  <td bgcolor=orange>';
			   else echo '
			   <td bgcolor=white>';
			if($daynumber[$j]<10) $dn="0".$daynumber[$j]; else $dn=$daynumber[$j];
			if($pmonth<10) $mn="0".$pmonth; else $mn=$pmonth;
			echo '<FONT face="times new roman"   SIZE=5 ';
			if($pyear.$mn.$dn>date(Ymd))  echo 'color="#dfdfdf"'; else echo 'color="#000088"';
			echo '><b>&nbsp;';
			if($pyear.$mn.$dn<=date(Ymd))  echo '
			  <a href="nursing-schnellsicht.php'.URL_APPEND.'&from=arch&dept='.$dept.'&edit=0&pday='.$dn.'&pmonth='.$mn.'&pyear='.$pyear.'">';
			echo $daynumber[$j];
			if($pyear.$mn.$dn<=date(Ymd))  echo '</a>';
			echo '</b></td>'; $j++;
		}
	if($daynumber[$j].$pmonth.$pyear==date(jnY)) echo '<td bgcolor=orange>'; else echo '<td bgcolor=white>';
	if($daynumber[$j]<10) $dn="0".$daynumber[$j]; else $dn=$daynumber[$j];
	if($pmonth<10) $mn="0".$pmonth; else $mn=$pmonth;
	echo '
	  <FONT  face="times new roman"   SIZE=5 ';
	if($pyear.$mn.$dn>date(Ymd))  echo 'color="#dfdfdf"'; else echo 'color="#ff0000"';
	echo '><b>&nbsp;';
	if($pyear.$mn.$dn<=date(Ymd))  echo '<a href="nursing-schnellsicht.php'.URL_APPEND.'&from=arch&dept='.$dept.'&edit=0&pday='.$dn.'&pmonth='.$mn.'&pyear='.$pyear.'">';
	echo $daynumber[$j];
	if($pyear.$mn.$dn<=date(Ymd))  echo '</a>';
	echo '</b></td>'; 	$j++;
	echo '</tr>';
	if($daynumber[$j]=="") break;

}
echo '</table>';
echo '</td></tr></table>';
?>

<br><FONT    SIZE=-1  FACE="Arial" color=navy>

<form name="direct" method=post  onSubmit="return update()" >
<b><?php echo $LDDirectSelect ?>:</b>&nbsp;&nbsp;<?php echo $LDMonth ?><select name="month" size="1"> 

<?php for ($i=0,$n=1;$i<sizeof($monat);$i++,$n++)
{	
	echo '<option ';
	if($n==$pmonth) echo 'selected';
	echo'>'.$monat[$i].'</option>';
}
?>
</select>
<?php echo $LDYear ?><input type="text" name="jahr" size=4 value="<?php echo $pyear; ?>" >
<?php if($cfg['dhtml'])
echo '
<a href="#" onclick=cxjahr(\'1\')><img '.createComIcon($root_path,'varrow-u.gif','0').' alt="'.$LDPlusYear.'"></a>
<a href="#" onClick=cxjahr(\'0\')><img '.createComIcon($root_path,'varrow-d.gif','0').' alt="'.$LDMinusYear.'"></a>';
else echo'<input  type="button" value="+1" onClick=cxjahr(\'1\')> <input  type="button" value="-1" onClick=cxjahr(\'0\')>';
?>
&nbsp;&nbsp;&nbsp;<input  type="submit" value="<?php echo $LDGo ?>">
<p>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">

</form>
<p>
<a href="nursing.php<?php echo URL_APPEND; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> alt="<?php echo $LDCancel ?>"></a>

</ul>

<?php

$sTemp = ob_get_contents();
 ob_end_clean();

# Assign the page output to main frame template

 $smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
