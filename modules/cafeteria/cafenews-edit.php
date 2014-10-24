<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','editor.php');
$local_user='ck_cafenews_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

/* Set navigation paths for this page*/
$breakfile=$_SESSION['sess_file_break'].URL_APPEND;
/* Set the new return file for the suceeding page */
$_SESSION['sess_file_return']=basename(__FILE__);
$_SESSION['sess_file_return']='cafenews-edit-select-art.php';

$returnfile='cafenews-edit-select-art.php'.URL_APPEND;

/* Load the date formatter */
require_once($root_path.'include/core/inc_date_format_functions.php');

//gjergji : new calendar
require_once ('../../js/jscalendar/calendar.php');
$calendar = new DHTML_Calendar('../../js/jscalendar/', $lang, 'calendar-system', true);
$calendar->load_files();
//end : gjergji

$title=$_SESSION['sess_title'];
?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<title></title>
<script language="javascript">
<!-- 
function showpic(d)
{
	if(d.value) document.images.headpic.src=d.value;
}

<?php 
# Load the javascript editor form checker 
require_once($root_path.'modules/news/includes/inc_js_editor_chkform.php');

# Load the dates js values
require($root_path.'include/core/inc_checkdate_lang.php'); 
?>
<!--  Root path for the html WYSIWYG editor -->
var _editor_url="<?php echo $root_path.'js/html_editor/'; ?>";
// -->
 </script>
<!-- load html editor scripts -->
<script language="javascript"  type="text/javascript" src="<?php echo $root_path.'js/html_editor/'; ?>htmlarea.js"></script>
<script language="javascript"  type="text/javascript" src="<?php echo $root_path.'js/html_editor/'; ?>lang/en.js"></script>
<script language="javascript"  type="text/javascript" src="<?php echo $root_path.'js/html_editor/'; ?>dialog.js"></script>
<style type="text/css">@import url("<?php echo $root_path.'js/html_editor/'; ?>htmlarea.css")</style>

<?php require($root_path.'include/core/inc_css_a_hilitebu.php'); ?>

</head>

<body onLoad="HTMLArea.replace('newsbody')">

<form ENCTYPE="multipart/form-data" name="selectform" method="post" action="cafenews-edit-save.php" onSubmit="return chkForm(this)">
<FONT  SIZE=6 COLOR="#cc6600">
<img <?php echo createComIcon($root_path,'basket.gif','0') ?>> <b><?php echo $title ?></b></FONT>
<hr>
<table border=0>
  <tr >
<?php if($artopt!=2) : ?>
    <td valign=top><img <?php echo createLDImgSrc($root_path,'x-blank.gif','0') ?> id="headpic"><br>
  </td>
<?php endif ?>
    <td class="submenu" colspan=2><FONT color="#0000cc" size=3><b><?php echo $LDTitleTag ?>:</b><br>
	<font size=1><?php echo $LDTitleMaxNote ?><br>
	<input type="text" name="newstitle" size=50 maxlength=255><br>
	<FONT color="#0000cc" size=3><b><?php echo $LDHeader ?>:</b><br>
	<font size=1><?php echo $LDHeaderMaxNote ?><br>
	
	<textarea name="preface" cols=50 rows=5 wrap="physical" id="preface"></textarea><br>
	
	<FONT color="#0000cc" size=3><b><?php echo $LDNews ?>:</b></font><br>
	
	<textarea name="newsbody" cols=50 rows=14 wrap="physical" id="newsbody"></textarea><br>
	
  	<FONT color="#0000cc" size=2><b><?php echo $LDPicFile ?>:</b><br>
	<input type="file" name="pic" onChange="showpic(this)" ><br>
<input type="button" value="<?php echo $LDPreviewPic ?>" onClick="showpic(document.selectform.pic)"><br>
  	<FONT color="#0000cc" size=2><b><?php echo $LDAuthor ?>:</b><br>
	<input type="text" name="author" size=30 maxlength=40><br>
  	<FONT color="#0000cc" size=2><b><?php echo $LDPublishDate ?>:</b><br>
<?php
//gjergji : new calendar
echo $calendar->show_calendar($calendar,$date_format,'publishdate');
//end gjergji
 ?>
</td>
<?php if($artopt==2) : ?>
    <td valign=top><img <?php echo createLDImgSrc($root_path,'x-blank.gif','0') ?> id="headpic" ><br>
  </td>
<?php endif ?>
  </tr>
  <tr>
<?php if($artopt!=2) : ?>
    <td align=right >
	<a href="<?php echo $returnfile ?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>></a>
  </td>
<?php endif ?>
    <td >
<?php if($artopt==2) : ?>
	<a href="<?php echo $returnfile ?>"><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?>></a>
<?php endif ?>
<input type="image" <?php echo createLDImgSrc($root_path,'continue.gif','0') ?>>
  </td>
    <td>
	<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
  </td>
<?php if($artopt==2) : ?>
    <td align=right >&nbsp;
  </td>
<?php endif ?>
  </tr>
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="title" value="<?php echo strtr($title," ","+") ?>">
<input type="hidden" name="artnum" value="<?php echo $artopt ?>">
<input type="hidden" name="mode" value="save">
<INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="1000000">

</form>
</body>
</html>
