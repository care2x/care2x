<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
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
require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'include/core/inc_config_color.php');

$thisfile=basename(__FILE__);
$breakfile='spediens-ado.php'.URL_APPEND;

$saal='exclude';
if(!isset($dept_nr)||!$dept_nr) $dept_nr=5;

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
if(!isset($db)||!$db) include($root_path.'include/core/inc_db_makelink.php');
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
require($root_path.'include/core/inc_js_gethelp.php');
require($root_path.'include/core/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<a name="pagetop"></a>

<table width=100% border=0 height=100% cellpadding="0" cellspacing="0">
	<tr valign=top>
		<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="35"><FONT
			COLOR="<?php echo $cfg['top_txtcolor']; ?>" SIZE=+2 FACE="Arial"> <STRONG>
		&nbsp;<?php echo $LDDutyPlanOrg ?></STRONG></FONT></td>
		<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align=right
			height="35"><a href="javascript:history.back();"><img
			<?php echo createLDImgSrc($root_path,'back2.gif','0','absmiddle') ?>
			style="filter: alpha(opacity = 70)" class="fadeOut" /></a><a
			href="javascript:gethelp()"><img
			<?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>
			align="absmiddle" style="filter: alpha(opacity = 70)" class="fadeOut"/></a><a
			href="<?php echo $breakfile ?>"><img
			<?php echo createLDImgSrc($root_path,'close2.gif','0') ?> width=103
			height=24 align="absmiddle" style="filter: alpha(opacity = 70)"
			class="fadeOut"></a></td>
	</tr>
	<tr valign=top>
		<td bgcolor=<?php echo $cfg['body_bgcolor']; ?> valign=top colspan=2>
		<ul>
			<br>
			<p><FONT face="Verdana,Helvetica,Arial" size=4> <img
			<?php echo createComIcon($root_path,'icon_clock.gif','0') ?>> <?php echo $LDBundyMachine ?>
			<p>
			
			</font> <FONT face="Verdana,Helvetica,Arial" size=3> <font size=1><a
				href="spediens-ado-bundy.php?sid=<?php echo "$sid&lang=$lang&month=$month&year=$year" ?>&mondir=-1"><img
				<?php echo createComIcon($root_path,'l-arrowgrnlrg.gif','0') ?>> <?php echo $LDPrevMonth ?></a></font>
			<b>&nbsp;<?php echo $monat[(int)$month]." ".$year; ?>&nbsp;</b> <font
				size=1><a
				href="spediens-ado-bundy.php?sid=<?php echo "$sid&lang=$lang&month=$month&year=$year" ?>&mondir=1"><?php echo $LDNextMonth ?>
			<img
			<?php echo createComIcon($root_path,'bul_arrowgrnlrg.gif','0') ?>></a></font>


			<FONT face="Verdana,Helvetica,Arial" size=2>
			<table border=1>
			<?php
			echo '<tr><td>&nbsp;</td>
	<td> '.$LDEntry.' </td>
	<td> '.$LDExit.' </td>
	<td> '.$LDRemarks.' </td>
	</tr>';  
			if($datafound)
			{
				while($persons=$pers_row->FetchRow())
				{
					echo '
	    <tr>
        <td><FONT face="Verdana,Helvetica,Arial" size=2>
	   ';
					echo ucfirst($persons['name_last']).', '.ucfirst($persons['name_first']).'
	   <br></td>
	   <td>&nbsp;</td>
	   <td>&nbsp;</td>
	   <td>&nbsp;</td>';
					echo '</tr>';
				}
			}
			?>
			</table>


			<p><br>
			<a href="<?php echo $breakfile ?>"><img
			<?php echo createLDImgSrc($root_path,'cancel.gif','0','middle') ?>
				alt="<?php echo $LDCancel ?>"></a>
			
			</FONT>
			<p>
		
		</ul>
		</td>
	</tr>

	<tr>
		<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> height=70 colspan=2><?php
require($root_path.'include/core/inc_load_copyrite.php');
?></td>
	</tr>
</table>
&nbsp;
</FONT>
</BODY>
</HTML>
