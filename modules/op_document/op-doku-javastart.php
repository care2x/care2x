<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');
 ?>


<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>

<script language="javascript">
<!-- 

function startwindow(){
	w=window.parent.screen.width;
	h=window.parent.screen.height;
	opdokuwin=window.open("<?php switch($target)
											{
												case 'entry': echo "op-doku-start.php"; break;
												case 'search': echo "op-doku-search.php";break;
												case 'archiv': echo "op-doku-archiv.php";
											}
										?>?sid=<?php echo "$sid&lang=$lang&user=$opdoku_user"; ?>","opdokuwin","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60) );
	window.opdokuwin.moveTo(0,0);
	window.location.replace("op-doku.php?sid=<?php echo "$sid&lang=$lang" ?>");
	}
-->
</script>


</HEAD>
<BODY BGCOLOR="#FFFFFF" TEXT="#000000" LINK="#0000FF" VLINK="#800080" onLoad="startwindow()">


</BODY>
</HTML>

