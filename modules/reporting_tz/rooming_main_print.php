<?php

	/**
	 *
	 * SEHA HOSPITAL (ARUSHA)
	 *
	 * Designed by Dennis Mollel,
	 * CyberTech & Studios Ltd
	 * deemagics@yahoo.com
	 *
	 * October, 2010.
	 *
	 */


	error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
	require('./roots.php');
	require($root_path.'include/core/inc_environment_global.php');

	define('LANG_FILE','hospital_room.php');
	define('NO_2LEVEL_CHK',1);
	require_once($root_path.'include/core/inc_front_chain_lang.php');
	// reset all 2nd level lock cookies
	require($root_path.'include/core/inc_2level_reset.php');
	include_once($root_path.'include/care_api_classes/class_multi.php');

	$obj=new multi;

	$type = $_GET['type'];

	$dts = cal_to_jd(CAL_GREGORIAN,$_GET['mnth'],1,$_GET['yrs']);

	$dts = jdmonthname($dts,1);

	$real_dts = ($dts)?' of '.$dts.'/'.$_GET['yrs']: '';

	$content = $_GET['mnth']. ':' .$_GET['yrs']. ':' .$_GET['type'].':'.'whiterow'.':'.'colorrow';

	 ?>

	<link href="../dental/dental_reports.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript">
	  window.print();
	</script>
	<div class="searchhead"><?php

	print '<big>&nbsp; &nbsp; '.$LDQualityReport . $real_dts.'</big>';
	print ($dpt)?'<br /><br />&nbsp; &nbsp; Department ID: '.$dpt.'':'';

	?>
	</div>
	<?php $obj->GetRowsFromRooming($_GET,'whiterow','colorrow','main'); ?>
<p align=center style="padding:10px !important;"><br /> Printed: <?php print date('d/m/Y h:i:s')?></p>
