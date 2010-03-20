<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','specials.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');

require_once($root_path.'include/inc_config_color.php');

if($retpath=='home') $breakfile=$root_path.'main/startframe.php'.URL_APPEND;
	else $breakfile=$root_path.'main/spediens.php'.URL_APPEND;
	 
$datum=strftime("%d.%m.%Y");
$zeit=strftime("%H.%M");
$toggler=0;

if($pmonth=='') $pmonth=date('n');
if($pyear=='') $pyear=date('Y');

function getmaxdays($mon,$yr)
{
	if ($mon==2){ if (checkdate($mon,29,$yr)) return 29; else return 28;}
	else
	{
		if(checkdate($mon,31,$yr)) return 31; else return 30;
	}
}

$maxdays=getmaxdays($pmonth,$pyear);

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

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$LDCalendar);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('calendar.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDCalendar);

# Buffer page output

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
	var urltarget="calendar.php<?php echo URL_REDIRECT_APPEND; ?>&pmonth="+mbuf+"&pyear="+jbuf;
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
function optionwin(d,m,y)
{
	if (!d) d="";
	urlholder="calendar-options.php?sid=<?php echo "$sid&lang=$lang" ?>&day="+d+"&month="+m+"&year="+y;
	optwin=window.open(urlholder,"optwin","width=500,height=400,menubar=no,resizable=yes,scrollbars=yes");
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

<?php 
echo '<table cellspacing=0 cellpadding=0 border=0>
		<tr><td align=left>';
echo '<a href="calendar.php'.URL_APPEND.'&pmonth=';
if($pmonth<2) echo '12&pyear='.($pyear-1).'" title="'.$LDPrevMonth.'"><FONT  SIZE=4 color=silver><b>&lt;'.$monat[12];
else echo ($pmonth-1).'&pyear='.$pyear.'" title="'.$LDPrevMonth.'"><FONT  SIZE=4 color=silver><b>&lt;'.$monat[$pmonth-1];
echo '</a></td><td  align=center>';
echo '<FONT  SIZE=6 color=navy><b>'.$monat[(int)$pmonth].' '.$pyear.'</b></font>';
echo '</td><td align=right><FONT  SIZE=4 color=silver><b>';
echo '<a href="calendar.php'.URL_APPEND.'&pmonth=';
if($pmonth>11) echo '1&pyear='.($pyear+1).'" title="'.$LDNextMonth.'"><FONT  SIZE=4 color=silver><b>'.$monat[1];
else echo ($pmonth+1).'&pyear='.$pyear.'" title="'.$LDNextMonth.'"><FONT  SIZE=4 color=silver><b>'.$monat[$pmonth+1];
echo '&gt;</a></td></tr><tr><td bgcolor=black colspan=3>';

echo '<table border="0" cellspacing=1 cellpadding=5 width="100%">';

echo '<tr>';
for($n=0;$n<6;$n++)
	{
		echo '<td bgcolor=white><FONT  SIZE=4 ><b>'.$tagename[$n].'</b></td>';
	}
echo '<td bgcolor="#ffffcc"><FONT SIZE=4 color=red ><b>'.$tagename[6].'</b></td>';
echo '</tr>';

$j=0;
for($x=0;$x<6;$x++)
{	echo '<tr>';
	
		for($n=0;$n<6;$n++)
		{
			if($daynumber[$j].$pmonth.$pyear==date(jnY)) echo '<td bgcolor=orange>'; else echo '<td bgcolor=white>';
			echo '<FONT face="times new roman"   SIZE=8  color=navy><b>&nbsp;<a href="javascript:optionwin(\''.$daynumber[$j].'\',\''.$pmonth.'\',\''.$pyear.'\')" title="'.$LDClk4Options.'">'.$daynumber[$j].' </a></b></td>'; $j++;
		}
	if($daynumber[$j].$pmonth.$pyear==date(jnY)) echo '<td bgcolor=orange>'; else echo '<td bgcolor=white>';
	echo '<b>&nbsp;<a href="javascript:optionwin(\''.$daynumber[$j].'\',\''.$pmonth.'\',\''.$pyear.'\')" title="'.$LDClk4Options.'"><FONT  face="times new roman"   SIZE=8  color=red>'.$daynumber[$j].'</a></b></td>'; 	$j++;
	echo '</tr>';
	if($daynumber[$j]=="") break;

}
echo '</table>';
echo '</td></tr></table>';
?>

<br><FONT color=navy>

<form name="direct" method=get onSubmit="return update()" >
<b><?php echo $LDDirectDial ?>:</b>&nbsp;&nbsp;<?php echo $LDMonth ?> <select name="month" size="1"> 

<?php for ($n=1;$n<sizeof($monat);$n++)
{	
	echo '<option ';
	if($n==$pmonth) echo 'selected';
	echo'>'.$monat[$n].'</option>';
}
?>
</select>
<?php echo $LDYear ?> <input type="text" name="jahr" size=4 value="<?php echo $pyear; ?>" >
<?php if($cfg['dhtml'])
echo '
<a href="javascript:cxjahr(\'1\')"><img '.createComIcon($root_path,'varrow-u.gif','0').' alt="'.$LDPlus1Year.'"></a>
<a href="javascript:cxjahr(\'0\')"><img '.createComIcon($root_path,'varrow-d.gif','0').' alt="'.$LDMinus1Year.'"></a>';
else echo'<input  type="button" value="+1" onClick=cxjahr(\'1\')> <input  type="button" value="-1" onClick=cxjahr(\'0\')>';
?>
&nbsp;&nbsp;&nbsp;<input  type="submit" value="<?php echo $LDGO ?>">
<p>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
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
