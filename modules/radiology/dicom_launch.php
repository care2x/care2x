<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');

# Switch to the selected dicom viewer module
switch($_SESSION['sess_dicom_viewer']){
	case 'raimjava':
			header("location:raimjava/raimjava_launch.php".URL_REDIRECT_APPEND."&pid=$pid&img_nr=$img_nr&fn=$fn");
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
define('TMPSIZE_IN_MEM',9); # The number of files loaded in memory at once
define('NUM_EQUALS_TMPSIZE',0); # 1 = actual nr. of files equals tmpsize in mem, 0 = the value of TMPSIZE_IN_MEM is used
define('FILE_DISCRIM','.dcm'); # define here the file discrimator string 
define('LANG_FILE','actions.php');
//define('LANG_FILE','radio.php');
//define('NO_2LEVEL_CHK',1);
$local_user='ck_radio_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'global_conf/inc_remoteservers_conf.php');

$thisfile=basename(__FILE__);

$breakfile='patient_search.php'.URL_APPEND;

if(isset($img_nr) && $img_nr){
# Get the dicom image
	include_once($root_path.'include/care_api_classes/class_image.php');
	$img_obj=new Image;
	$dicom=&$img_obj->getDicomImage($img_nr);
	//echo $img_obj->getLastQuery();
	$imgpath=$root_path.'uploads/radiology/dicom_img/'.$dicom['pid'].'/'.$img_nr;
	if($count=$img_obj->LastRecordCount()){
		if($files=&$img_obj->FilesListArray($imgpath,FILE_DISCRIM)){
			$NUM=$img_obj->LastRecordCount();
		}else{
			$nogo=true;
		}
	}else{
		$nogo=true;
	}
}else{
	$nogo=true;
}
# If no go, get out of here
if($nogo||!$NUM){
	header("location:view_person_search.php".URL_REDIRECT_APPEND);
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
<BODY   topmargin=0 leftmargin=0  marginwidth=0 marginheight=0 ><font face="Verdana, Arial" size=1><?php 
if(isset($pop_only) && $pop_only){
?>
<a href="javascript:window.close()"><font size=1>&nbsp;>> <?php echo $LDClose ?> <<</font></a>
<?php
}else{
	if(isset($saved) && $saved){
?>
<a href="upload.php<?php echo URL_APPEND."&saved=1&mode=show&pid=$pid&nr=$img_nr"; ?>"><font size=1>&nbsp;<< <?php echo $LDBack ?></font></a>
<?php
	}else{
?>
<a href="view_person_search.php<?php echo URL_APPEND."&mode=search&searchkey=$searchkey"; ?>"><font size=1>&nbsp;<< <?php echo $LDBack ?></font></a>
<?php
	}
}
?></font>
<br>
<!-- Do not forget to set the variable $main_domain to your site domain in include/core/inc_init_main.php -->
 <APPLET
  CODEBASE = "."
  CODE = "dicomviewer.Viewer.class"
  NAME = "Viewer.java"
  ARCHIVE = "dicomviewer.jar"
  WIDTH = 100%
  HEIGHT = 100%
  HSPACE = 0
  VSPACE = 0
  ALIGN = middle >
<PARAM NAME = "tmpSize" VALUE = "<?php if(defined('NUM_EQUALS_TMPSIZE')&&NUM_EQUALS_TMPSIZE) echo $NUM;  else echo TMPSIZE_IN_MEM;  ?>">
<PARAM NAME = "NUM" VALUE = "<?php  echo $NUM; ?>">
<PARAM NAME = "currentNo" VALUE = "0">
<PARAM NAME = "dicURL" VALUE = "http://<?php echo $main_domain ?>/<?php echo $top_dir ?>dicomviewer/Dicom.dic">
<?php
if($NUM){
	$z=0;
	while(list($x,$v)=each($files)){
		echo '<PARAM NAME = "imgURL'.$z.'" VALUE = "'.$dicom_img_http.$dicom['pid'].'/'.$img_nr.'/'.$v.'">
		';
		$z++;
	}
}
?>

</APPLET>  
</BODY>
</HTML> 
