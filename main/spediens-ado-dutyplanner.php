<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.0 - 2004-05-16
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.org, elpidio@care2x.net
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','specials.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_config_color.php');

$thisfile='spediens-ado-dutyplanner.php';
$breakfile='spediens-ado.php'.URL_APPEND;
/*
if ($dept=="")
	if($ck_thispc_dept) $dept=$ck_thispc_dept;
		else $dept='plop';*/
if(!isset($dept_nr)||!$dept_nr) $dept_nr=5;
$saal='exclude';
require($root_path.'include/inc_resolve_opr_dept.php');

		
if(($mondir)&&($month))
{
	if($mondir<0)
	{
		if($month==1)
		{
			 $month=12;
			 $year--;
		}
		else $month--;
	}
	elseif($mondir==1)
	{
		if($month==12)
		{
			 $month=1;
			 $year++;
		}
		else $month++;
    }
}
else
{
if($year=="") $year=date(Y);
if(!$month) $month=date(m);
//if(!$day) $day=date(d);
}

/* Establish db connection */
if(!isset($db)||!$db) include($root_path.'include/inc_db_makelink.php');
if($dblink_ok){	
	include_once($root_path.'include/care_api_classes/class_personell.php');
	$pers_obj=new Personell();
	if($pers_row=$pers_obj->getNursesOfDept($dept_nr)){
		$datafound=1;
		//echo $sql."<br>";
		//echo $rows;
	}
}else{ echo "$LDDbNoLink<br>$sql"; } 

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<?php 
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');
?></HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<a name="pagetop"></a>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
<tr valign=top>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>"   height="35">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial">
<STRONG> &nbsp;<?php echo $LDDutyPlanOrg ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align=right  height="35"><a href="javascript:history.back();"><img <?php echo createLDImgSrc($root_path,'back2.gif','0','absmiddle') ?> style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="javascript:gethelp()"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0','absmiddle') ?> style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a><a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0','absmiddle') ?> style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a></td>
</tr>
<tr valign=top >
<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
<FONT face="Verdana,Helvetica,Arial" size=4>
<img <?php echo createComIcon($root_path,'icon_pencil.gif','0') ?>> <?php echo $LDDutyPlanner ?><p></font>

<FONT face="Verdana,Helvetica,Arial" size=3>
<font size=1><a href="spediens-ado-dutyplanner.php?sid=<?php echo "$sid&lang=$lang&month=$month&year=$year" ?>&mondir=-1"><img <?php echo createComIcon($root_path,'l-arrowgrnlrg.gif','0') ?>> <?php echo $LDPrevMonth ?></a></font> 
<b>&nbsp;&nbsp;<?php echo $monat[(int)$month]." ".$year; ?>&nbsp;&nbsp;</b> 
<font size=1><a href="spediens-ado-dutyplanner.php?sid=<?php echo "$sid&lang=$lang&month=$month&year=$year" ?>&mondir=1"><?php echo $LDNextMonth ?> <img <?php echo createComIcon($root_path,'bul_arrowgrnlrg.gif','0') ?>></a></font>

<FONT face="Verdana,Helvetica,Arial" size=2>
<table border=0 cellspacing=0 cellpadding=0 bgcolor="#6f6f6f">
  <tr>
    <td>

<table border=0 cellspacing=1 >

<?php 

	
	$daytag=date("w",mktime(0,0,0,$month,1,$year));

	echo '
	  <tr>
    <td bgcolor="#f6f6f6"><FONT face="Verdana,Helvetica,Arial" size=2></td>';
	for ($n=1,$tn=$daytag;$n<32;$n++,$tn++)
	{ 
		if($tn==7) $tn=0;
		if(!checkdate($month,$n,$year)) break;
		echo '
		<td bgcolor=';
		if(!$tn) echo '"#ffffcc"'; else echo '"#f6f6f6"';
		echo '><FONT face="Verdana,Helvetica,Arial" size=2> '.$n;	
		if($n<10) echo '&nbsp;';
		echo '
		</td>';
	}
  echo '</tr>';
  
	echo '
	  <tr>
    <td bgcolor="#f6f6f6"><FONT face="Verdana,Helvetica,Arial" size=2></td>';
	for ($o=1,$tn=$daytag;$o<$n;$o++,$tn++)
	{ 
		if($tn==7) $tn=0;
		//if(!checkdate($month,$n,$year)) break;
		echo '
		<td bgcolor=';
		if(!$tn) echo '"#ffffcc"'; else echo '"#f6f6f6"';
		echo '><FONT face="Verdana,Helvetica,Arial" size=2> '.$tage[$tn];	
		if($n<10) echo '&nbsp;';
		echo '
		</td>';
	}
  echo '</tr>';
  
if($datafound)
{  
while($persons=$pers_row->FetchRow())
{
	echo '<td bgcolor="#f6f6f6"><FONT face="Verdana,Helvetica,Arial" size=2>
	';
	echo ucfirst($persons['name_last']).', '.ucfirst($persons['name_first']).'
	<br></td>';
	for ($p=1,$tn=$daytag;$p<$n;$p++,$tn++)
	{
		//if(!checkdate($month,$n,$year)) break;
	if($tn==7) $tn=0;
		echo '
		<td bgcolor=';
		if(!$tn) echo '"#ffffcc"'; else echo '"#f6f6f6"';
		echo '>&nbsp;</td>';	
 	}
  echo '
  </tr>';
}

	echo '
	  <tr>
    <td bgcolor="#f6f6f6"><FONT face="Verdana,Helvetica,Arial" size=2>&nbsp;</td>';
	for ($q=1,$tn=$daytag;$q<$p;$q++,$tn++)
	{ 
		if($tn==7) $tn=0;
		echo '
		<td bgcolor=';
		if(!$tn) echo '"#ffffcc"'; else echo '"#f6f6f6"';
		echo '>&nbsp;</td>';
	}
  echo '
  </tr>';
}
	echo '
	  <tr>
    <td bgcolor="#f6f6f6" align=right><FONT face="Verdana,Helvetica,Arial" size=2>'.$LDTotal.'</td>';
	for ($q=1,$tn=$daytag;$q<$p;$q++,$tn++)
	{ 
		if($tn==7) $tn=0;
		echo '
		<td bgcolor=';
		if(!$tn) echo '"#ffffcc"'; else echo '"#f6f6f6"';
		echo '><FONT face="Verdana,Helvetica,Arial" size=2>&nbsp;'.$i.'</td>';
	}
  echo '
  </tr>';



  
?>
</table>
</td>
  </tr>
</table>

<p><br>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0','middle') ?> alt="<?php echo $LDCancel ?>"></a>

</FONT>
<p>
</td>
</tr>

<tr>
<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2>

<?php
require($root_path.'include/inc_load_copyrite.php');
?>
</td></tr>
</table>        
&nbsp;
</FONT>
</BODY>
</HTML>
