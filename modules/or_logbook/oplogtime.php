<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

define('LANG_FILE','or.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
if (!$internok&&!$_COOKIE['ck_op_pflegelogbuch_user'.$sid]) {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

$comdat="?sid=$sid&lang=$lang&enc_nr=$enc_nr&op_nr=$op_nr&dept_nr=$dept_nr&saal=$saal&pday=$pday&pmonth=$pmonth&pyear=$pyear";

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<script language="javascript">

function opentimewin(s)
{
	w=window.parent.screen.width;
	h=window.parent.screen.height;
	ww=550; 
	wh=500;
	if(s=="wait_time") t="op-pflege-graph-getwaittime.php";
		else t="op-pflege-graph-getinfo.php";
	timewin=window.open(t+"<?php echo $comdat ?>&winid="+s,"timewin","menubar=no,resizable=yes,scrollbars=yes, width=" + ww + ", height=" + wh);
	window.timewin.moveTo((w/2)-(ww/2),(h/2)-(wh/2));

}
</script>

<style type="text/css">
	A:link  {text-decoration: none; }
	A:hover {text-decoration: underline; color: red; }
	A:visited {text-decoration: none;}
</style>

</HEAD>

<BODY bgcolor=#cde1ec topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 alink="navy" vlink="navy">


<table cellpadding="0" cellspacing="0" border=0 width=100%> 
<tr>
<td  align=right><font face=verdana,arial size=2><b><?php echo $LDTimes ?>:</b></td>
</tr>
<tr>
<td align=right><font face=arial size=2><nobr><a href="#" onclick=opentimewin('entry_out')><?php echo "$LDOpIn/$LDOpOut" ?>:<img <?php echo createComIcon($root_path,'bul_arrowgrnsm.gif','0','absmiddle') ?>></a></td>

</tr>
<tr>
<td align=right>
<font face=arial size=2><a href="#" onclick=opentimewin('cut_close')><?php echo "$LDOpCut/$LDOpClose" ?>: <img <?php echo createComIcon($root_path,'bul_arrowgrnsm.gif','0','absmiddle') ?>></a></td>

</tr>
<tr><td align=right>
<font face=arial size=2><a href="#" onclick=opentimewin('wait_time')><?php echo $LDWaitTime ?>: <img <?php echo createComIcon($root_path,'bul_arrowgrnsm.gif','0','absmiddle') ?>></a></td>

</tr>
<tr><td align=right>
<font face=arial size=2><a href="#" onclick=opentimewin('bandage_time')><?php echo $LDPlasterCast ?>: <img <?php echo createComIcon($root_path,'bul_arrowgrnsm.gif','0','absmiddle') ?>></a></td>

</tr>
<tr><td align=right>
<font face=arial size=2><a href="#" onclick=opentimewin('repos_time')><?php echo $LDReposition ?>: <img <?php echo createComIcon($root_path,'bul_arrowgrnsm.gif','0','absmiddle') ?>></a></td>

</tr>

</table>


</BODY>
</HTML>
