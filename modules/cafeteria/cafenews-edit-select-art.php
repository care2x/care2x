<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','editor.php');
$local_user='ck_cafenews_user';
require_once($root_path.'include/inc_front_chain_lang.php');
/* Set navigation paths for this page*/
$breakfile=$_SESSION['sess_file_break'].URL_APPEND;
$returnfile='cafenews-edit-select.php'.URL_APPEND;

/* Set the new return file for the suceeding page */
$_SESSION['sess_file_return']=basename(__FILE__);

$title= (isset($title)&&!empty($title)) ? $title : $_SESSION['sess_title']; 
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
<form name="selectform" method="get" action="cafenews-edit.php" onSubmit="return chkForm(this)">
<FONT  SIZE=6 COLOR="#cc6600">
<img <?php echo createComIcon($root_path,'basket.gif','0') ?>> <b><?php echo $title ?></b></FONT>
<hr>
<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0') ?>></td>
    <td colspan=2><FONT  SIZE=5 COLOR="#000066"><?php echo $LDWhereTo ?></font><br>
			<font size=2><?php echo $LDPlsSelect ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="ccffff"><p><br>
		<input type="radio" name="artopt" value="1"> <a href="#" onClick="document.selectform.artopt[0].checked=true"><?php echo $LDArticle1 ?></a><br>
    	<input type="radio" name="artopt" value="2"> <a href="#" onClick="document.selectform.artopt[1].checked=true"><?php echo $LDArticle2 ?></a><br>
    	<input type="radio" name="artopt" value="3"> <a href="#" onClick="document.selectform.artopt[2].checked=true"><?php echo $LDArticle3 ?></a><br>
  </td>
    <td><img <?php echo createComIcon($root_path,'cafenews.jpg','0') ?>></td>
  </tr>
  
      <td >
  </td>
    <td align=right >
 </td>

  
  <tr>
    <td>
	<a href="<?php echo $returnfile ?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>></a>
	</td>
    <td >
<input type="image" <?php echo createLDImgSrc($root_path,'continue.gif','0') ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
  </td>
    <td align=right>&nbsp;
  </td>
  </tr>
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="target" value="<?php echo $target ?>">
<input type="hidden" name="title" value="<?php echo $title ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">

</form>
</body>
</html>
