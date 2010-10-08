<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');

# Switch to the selected dicom viewer module

switch($_SESSION['sess_dicom_viewer']){
	case 'raimjava':
			header("location:raimjava/raimjava_launch_single.php".URL_REDIRECT_APPEND."&pid=$pid&img_nr=$img_nr&fn=$fn");
			exit;
	default:
				# Default viewer
}

/*** CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file 'copy_notice.txt' for the licence notice
*/
define('LANG_FILE','actions.php');
//define('LANG_FILE','radio.php');
//define('NO_2LEVEL_CHK',1);
$local_user='ck_radio_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'global_conf/inc_remoteservers_conf.php');

$thisfile=basename(__FILE__);

$breakfile='patient_search.php'.URL_APPEND;

$nogo=false;

if(isset($img_nr) && $img_nr&&isset($pid) && $pid&&isset($fn) && $fn){
	//echo $img_obj->getLastQuery();
	$imgpath=$root_path.$dicom_img_localpath.$pid.'/'.$img_nr.'/'.$fn;
	if(!file_exists($imgpath)){
		$nogo=true;
	}
}else{
	$nogo=true;
}
# If no go, get out of here
if($nogo){
	//echo $imgpath;
	header("location:upload.php".URL_REDIRECT_APPEND."&mode=show&pid=$pid&nr=$img_nr");
	exit;
}
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<TITLE>
<?php echo $LDDicomViewer ?>
</TITLE>
</HEAD>
<BODY topmargin=0 leftmargin=0  marginwidth=0 marginheight=0><font face="Verdana, Arial" size=1><?php 
if(isset($pop_only) && $pop_only){
?>
<a href="javascript:window.close()">&nbsp;>> <?php echo $LDClose ?> <<</a>
<?php
}else{
?>
<a href="upload.php<?php echo URL_APPEND."&saved=1&mode=show&pid=$pid&nr=$img_nr"; ?>"><font size=1>&nbsp;<< <?php echo $LDBack ?></font></a>
<?php
}
?></font>
<br>
<APPLET
  CODEBASE = "."
  CODE = "dicomviewer.Viewer.class"
  NAME = "Viewer.java"
  WIDTH = 100%
  HEIGHT = 100%
  HSPACE = 0
  VSPACE = 0
  ALIGN = middle >
<PARAM NAME = "tmpSize" VALUE = "1">
<PARAM NAME = "NUM" VALUE = "1">
<PARAM NAME = "currentNo" VALUE = "0">
<PARAM NAME = "dicURL" VALUE = "http://<?php echo $main_domain ?>/<?php echo $top_dir ?>dicomviewer/Dicom.dic">
<PARAM NAME = "imgURL0" VALUE = "http://<?php echo "$main_domain/$dicom_img_localpath$pid/$img_nr/$fn" ?>">
</APPLET>  
</BODY>
</HTML> 
