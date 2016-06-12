<?php

		/**
		 *
		 * DCMC HOSPITAL REPORT (DENTAL)
		 *
		 * Designed by Dennis Mollel,
		 * deemagics@yahoo.com
		 *
		 * October, 2008.
		 *
		 */


require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
error_reporting($ErrorLevel);

define('LANG_FILE','dental.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');
// reset all 2nd level lock cookies
require($root_path.'include/core/inc_2level_reset.php');
include_once($root_path.'include/care_api_classes/class_mini_dental.php');

$obj=new dental;
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<?php
require($root_path.'include/core/inc_js_gethelp.php');
require($root_path.'include/core/inc_css_a_hilitebu.php');

// GET TYPE
$type = $_GET['type'];

$dts = cal_to_jd(CAL_GREGORIAN,$_GET['mnth'],1,$_GET['yrs']);

$dts = jdmonthname($dts,1);

$real_dts = $dts.'/'.$_GET['yrs'];

$content = $_GET['mnth']. ':' .$_GET['yrs']. ':' .$_GET['type'].':'.'whiterow'.':'.'colorrow';

?>

</HEAD>

<link href="../dental/dental_reports.css" rel="stylesheet" type="text/css">

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 cellpadding="0" cellspacing="0">
<tr valign=top><td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG>&nbsp;&nbsp;&nbsp;<?php echo $LDCostReport; ?></STRONG></FONT></td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align=right>
<?php if($cfg['dhtml'])echo'<a href="javascript:window.history.back()"><img '.createLDImgSrc($root_path,'back2.gif','0').'  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="javascript:gethelp('maternity.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a><a href="<?php echo $breakfile;?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseAlt ?>"  <?php if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)>';?></a></td>
</tr>

<tr align="left" valign=bottom>
    <td colspan="2" bgcolor="<?php echo $cfg['top_bgcolor']; ?>" class="botline">&nbsp;</td>
</tr>

<tr  valign=top>
    <td colspan="5">
	<?php require("gui/gui_cost_billing_search.php"); //style="border:1px solid #ccc; padding:3px; font:normal 12px Tahoma, Monospace; width:150px;" ?>   </td>
  </tr>
<tr  valign=top>
  <td colspan="5" style="border-bottom:3px double darkgreen; margin-top:3px; height:5px; color:white; overflow:hidden; font:normal 6px Tahoma, monospace;">fffff</td>
</tr>
<tr  valign=bottom>
  <td colspan="5" class="searchhead">



  <?php	print $LDCostHeader . ' - ' . $real_dts;

		$obj->GetRowsFromCosting($_GET['mnth'],$_GET['yrs'],$_GET['type'],'whiterow','colorrow','main');

		 ?>


  </td>
</tr>

<tr  valign=top>
  <td colspan="5">&nbsp;</td>
</tr>
<tr  valign=top>
  <td colspan="5">&nbsp;</td>
</tr>


<tr  valign=top>
  <td colspan="5"><div style="margin-left:10px; float:left; width:60%; text-align:right; ">
    <input name="print" type="submit" class="btn" value="Print &raquo;" onClick = "Javascript:window.open('../reporting_tz/gui/gui_cost_reports_print.php?mnth=<?php echo $_GET['mnth']; ?>&yrs=<?php echo $_GET['yrs']; ?>&type=<?php echo $_GET['type']; ?>', 'dentalBilling','width=700, height=500,scrollbars=yes')">
  </div></td>
</tr>
<tr  valign=top>
  <td colspan="5">&nbsp;</td>
</tr>
<tr>


<td bgcolor=<?php echo $cfg['bot_bgcolor']; ?> colspan=2>
<?php
require($root_path.'include/core/inc_load_copyrite.php');
?>
</td>
</tr>
</table>
</table>
</body>
</html>
