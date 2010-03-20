<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
/*
CARE2X Integrated Information System Deployment 2.2 - 2006-07-10 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002,2003,2004,2005  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/
define('LANG_FILE','editor.php');
$local_user='ck_editor_user';
require_once($root_path.'include/inc_front_chain_lang.php');

/* Set navigation paths for this page*/
$thisfile=basename(__FILE__);
$breakfile=$root_path.$_SESSION['sess_file_break'].URL_APPEND;

if($_SESSION['sess_file_return']==$thisfile) $returnfile='start_page.php'.URL_APPEND;
    else $returnfile=$root_path.$_SESSION['sess_file_return'].URL_APPEND;
	
/* Set the new return file for the preview page */
$_SESSION['sess_file_return']=$thisfile;

$_SESSION['sess_file_forward']='headline-read.php';

$title= $_SESSION['sess_title']; 
?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<title></title>

<script language="javascript">
function chkForm(d)
{
	if((d.artopt[0].checked)||(d.artopt[1].checked)||(d.artopt[2].checked)) return true;
		else return false;
}
</script>

<?php require($root_path.'include/inc_css_a_hilitebu.php'); ?>

</head>
<body>
<form name="selectform" method="get" action="headline-edit.php" onSubmit="return chkForm(this)">
<FONT  SIZE=6 COLOR="#cc6600">
<b><?php echo $title ?></b></FONT>
<hr>
<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0') ?>></td>
    <td colspan=2><FONT  SIZE=5 COLOR="#000066"><?php echo $LDWhereTo ?></font><p>
			<?php echo $LDPlsSelect ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="ccffff"><p><br>
<!-- 		&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $LDArticle1 ?><br>
		<input type="hidden" name="artopt" value="">
 -->    	
 		<input type="radio" name="artopt" value="1"> <a href="#" onClick="document.selectform.artopt[0].checked=true"><?php echo $LDArticle1 ?></a><br>
 		<input type="radio" name="artopt" value="2"> <a href="#" onClick="document.selectform.artopt[1].checked=true"><?php echo $LDArticle2 ?></a><br>
    	<input type="radio" name="artopt" value="3"> <a href="#" onClick="document.selectform.artopt[2].checked=true"><?php echo $LDArticle3 ?></a><br><p>
  </td>
    <td><img <?php echo createLDImgSrc($root_path,'headline.jpg') ?>></td>
  </tr>
  <tr>
    <td>
		<a href="<?php echo $returnfile ?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>></a>
	</td>
    <td >
<input type="image" <?php echo createLDImgSrc($root_path,'continue.gif','0') ?>>
  </td>
    <td align=right >
		<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
 </td>
  </tr>
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="title" value="<?php echo $title ?>">
<p>
<?php 
require($root_path.'include/inc_load_copyrite.php');
?>
</form>
</body>
</html>
