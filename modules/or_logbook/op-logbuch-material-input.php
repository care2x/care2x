<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
define('LANG_FILE','or.php');
$local_user='ck_op_pflegelogbuch_user';
require_once($root_path.'include/inc_front_chain_lang.php');
?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>

<script language="javascript">
<!-- 

function sendnum(d)
{
	d.material_nr.select();
	if(d.material_nr.value==""){
		return false;
	}else{	window.parent.OPMLISTFRAME.location.replace('op-logbuch-material-list.php?sid=<?php echo "$sid&lang=$lang&op_nr=$op_nr&dept_nr=$dept_nr&saal=$saal&enc_nr=$enc_nr&pday=$pday&pmonth=$pmonth&pyear=$pyear"; ?>&mode=search&material_nr='+d.material_nr.value);
		return false;
	}
}
// -->
</script>


</head>
<body onLoad="document.mat_input.material_nr.focus();document.mat_input.material_nr.select()" onFocus="document.mat_input.material_nr.select()" >

<form name="mat_input" onSubmit="return sendnum(this)">
<font face="Verdana, Arial" size=2 color=#800000>
<?php echo $LDArticleNr ?>:<br>
<input type="text" name="material_nr" size=20 maxlength=40 onFocus="this.select()" ><br>
<input type="submit" value="OK">
</font>
</form><p>
<hr>
<p>
<font face="Verdana, Arial" size=2>
<a href="oplogmain.php?sid=<?php  echo "$sid&lang=$lang&enc_nr=$enc_nr&dept_nr=$dept_nr&saal=$saal&pday=$pday&pmonth=$pmonth&pyear=$pyear"; ?>" target="_parent">
<img <?php echo createComIcon($root_path,'manfldr.gif','0','absmiddle') ?>><br> <?php echo $LDShowLogbook ?>
</a>
</body>
</html>
