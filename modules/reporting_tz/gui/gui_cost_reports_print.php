<?php

		/**
		 *
		 * WASSO HOSPITAL REPORT
		 *
		 * Designed by Dennis Mollel,
		 * deemagics@yahoo.com
		 *
		 * August, 2009.
		 *
		 */


error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

define('LANG_FILE','dental.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
// reset all 2nd level lock cookies
require($root_path.'include/inc_2level_reset.php');
include_once($root_path.'include/care_api_classes/class_mini_dental.php');

$obj=new dental;
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<?php
require($root_path.'include/inc_js_gethelp.php');
require($root_path.'include/inc_css_a_hilitebu.php');

// GET TYPE
$type = $_GET['type'];

$dts = cal_to_jd(CAL_GREGORIAN,$_GET['mnth'],1,$_GET['yrs']);

$dts = jdmonthname($dts,1);

$real_dts = $dts.'/'.$_GET['yrs'];

$content = $_GET['mnth']. ':' .$_GET['yrs']. ':' .$_GET['type'].':'.'whiterow'.':'.'colorrow';

?>

</HEAD>

<link href="../../dental/dental_reports.css" rel="stylesheet" type="text/css">

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 onLoad="javascript:window.print();"
<?php if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table width=100% border=0 cellpadding="0" align="center" cellspacing="0">
<tr  valign=bottom>
  <td height="61" colspan="5" class="searchhead">



  <?php	print $LDCostHeader . ' - ' . $real_dts;

		$obj->GetRowsFromCosting($_GET['mnth'],$_GET['yrs'],$_GET['type'],'whiterow','colorrow','main');

		 ?>


  </td>
</tr>
<tr  valign=top>
  <td colspan="5">&nbsp;</td>
</tr>

<tr valign=top>
  <td colspan="5" style="padding:10px; font:normal 12px Tahoma; " >Approved By: ____________________</td>
</tr>


<tr valign=top>
  <td colspan="5" >&nbsp;  </td>
</tr>
<tr  valign=top>
  <td colspan="5"></td>
</tr>
<tr  valign=top>
  <td colspan="5">&nbsp;</td>
</tr>
<tr>
</table>
</body>
</html>

