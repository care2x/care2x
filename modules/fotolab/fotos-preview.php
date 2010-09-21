<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/

#
# Define here the width of the preview image
#
define('PREVIEW_SIZE',400);

#
# The ImageJ applet control panel height
# Microsoft = ~100
# Linux = ~90
#
define('IMAGEJ_PANEL_HEIGHT', 100);
#
# The ImageJ applet control panel height
#
define('IMAGEJ_PANEL_WIDTH_MIN', 250);

$lang_tables=array('images.php');
define('LANG_FILE','nursing.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');
require($root_path.'global_conf/inc_remoteservers_conf.php');
/* Load date formatter */
include_once($root_path.'include/core/inc_date_format_functions.php');

if($disc_pix_mode){
	$final_path="$root_path$fotoserver_localpath$pn/"; 
}else{
	$final_path="$fotoserver_http$pn/";
}
if(isset($pn) && $pn){
	/* Create image object */
	include_once($root_path.'include/care_api_classes/class_image.php');
	$img_obj=new Image();
	//$db->debug=true;
	if(isset($mode) && $mode=='save'){

		//$_POST['history']="CONCAT(history,'Notes ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n')";
		$_POST['history']=$img_obj->ConcatHistory("Notes ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n");
		$_POST['modify_id']=$_SESSION['sess_user_name'];
		$_POST['modify_time']=date('YmdHis');
		//$img_obj->setDataArray($_POST);
		if($img_obj->updateImageNotes($_POST)){
			header('Location:'.basename(__FILE__).URL_REDIRECT_APPEND.'&pn='.$pn.'&nr='.$nr.'&bShowImageJApplet='.$bShowImageJApplet);
			exit;
		}
	}
	
	if($img_data=$img_obj->getImageData($nr)){
		$image=$img_data->FetchRow();
		$sImgFileName = $image['nr'].'.'.$image['mime_type'];
		$picsource=$final_path.$sImgFileName;
	}
}

?>
<?php html_rtl($lang); ?>
<head>
<script language="javascript">
<!-- 

function check(d) {
	if(d.notes.value=="") return false;
		else return true;
}
//-->
</script>
<?php echo setCharSet(); ?>
</head>
<body topmargin=0 marginheight=0>
<form name="picnotes" method="post" onSubmit="return check(this)">
<?php //echo $LDPreview ?>
<?php 
	
if(file_exists($picsource)){
	#
	# If java applet class exists, show link
	#
	if(file_exists($root_path.'modules/fotolab/IJBasicViewer.class') && file_exists($root_path.'modules/fotolab/ij.jar')){
		echo '<font face=arial><a href="'.basename(__FILE__).URL_APPEND.'&pn='.$pn.'&nr='.$nr.'&bShowImageJApplet='.(!$bShowImageJApplet).'">';
		if($bShowImageJApplet) echo $LDHideJavaApplet;
			else echo $LDShowJavaApplet;
		echo '</a>&nbsp;</font>';
	}
	#
	# If ImageJ applet class exists, show link
	#
	if(file_exists($root_path.'modules/fotolab/IJApplet.class') && file_exists($root_path.'modules/fotolab/ij.jar')){
		echo '<font face=arial>
		<a href="ijapplet_launcher.php'.URL_APPEND.'&pn='.$pn.'&img='.$sImgFileName.'&bShowImageJApplet='.(!$bShowImageJApplet).'">'.$LDEditWithImageJ.'</a>
		</font>';
	}
?>
<p>
<table border=0 cellspacing=0 cellpadding=0>
  <tr>
    <td><font size=2 face=arial color=maroon><?php echo $LDShotDate ?>:
</td>
    <td><font size=2 face=arial><?php echo formatDate2Local($image['shot_date'],$date_format); ?></td>
  </tr>
  <tr>
    <td><font size=2 face=arial color=maroon><?php echo $LDShotNr ?>:</td>
    <td><font size=2 face=arial><?php echo $image['shot_nr'] ?></td>
  </tr>
</table>
<?php
if(!isset($preview_size)) $preview_size=0;

list($w,$h,$t,$wh)=getImageSize($picsource); // get the size of the image

if(isset($bShowImageJApplet) && $bShowImageJApplet){
	#
	# Set applet´s dimensions
	#
	$iAppletHeight=$h + IMAGEJ_PANEL_HEIGHT;

	if($w < IMAGEJ_PANEL_WIDTH_MIN ) $iAppletWidth = IMAGEJ_PANEL_WIDTH_MIN;
		else $iAppletWidth = $w;

	echo '<applet codebase="." code="ij.ImageJApplet.class"  archive="ij.jar" width='.$iAppletWidth.' height='.$iAppletHeight.'>
				<param name=url value='.$picsource.'>
		 </applet>';
}else{

	if(PREVIEW_SIZE<$w){
		$toggle_pic=true;
		if($preview_size) $preview_size=0;
			else $preview_size=PREVIEW_SIZE;
	}else{
		$toggle_pic=false;
		$preview_size=$w;
	}

	if($toggle_pic) echo '<a href="'.basename(__FILE__).URL_APPEND.'&pn='.$pn.'&nr='.$nr.'&preview_size='.$preview_size.'">';

	if($t==1){

?>

<img src="<?php	echo $picsource; ?>" <?php if($preview_size) echo 'width="'.$preview_size.'"'; else echo $wh; ?> border=0  name="preview"
<?php 

	}elseif(($toggle_pic&&!$preview_size)||(!$toggle_pic&&$preview_size)){
?>
<img src="<?php	echo $picsource; ?>" <?php if($preview_size) echo 'width="'.$preview_size.'"'; else echo $wh; ?> border=0  name="preview"
<?php
	}else{
?>
<img src="<?php	echo $root_path.'main/imgcreator/thumbnail.php?mx='.$preview_size.'&my='.$preview_size.'&imgfile=/'.$fotoserver_localpath.$pn.'/'.$image['nr'].'.'.$image['mime_type'] ?>" border=0  name="preview"
<?php
	}

	if($toggle_pic){
?>
 alt="<?php if($preview_size) echo $LDTogglePreviewOrig; else echo $LDToggleOrigPreview; ?>" 
  title="<?php  if($preview_size) echo $LDTogglePreviewOrig; else echo $LDToggleOrigPreview; ?>"
<?php
	}
?>>
<?php
	if($toggle_pic) echo '</a>';
}
?>
<br>
<?php
if(!empty($image['notes'])){
	$notes=str_replace('[[','<font size=1 color="#abcdef">',htmlspecialchars($image['notes']));
	$notes=str_replace(']]','</font>',$notes);
?>
<table border=0 width="100%" cellspacing=0 cellpadding=1 bgcolor="#abcdef">
  <tr>
    <td>
		<table border=0 width="100%" cellspacing=0 cellpadding=5 bgcolor="#ffffff">
		  <tr>
		    <td><font size=2 face="arial,verdana,helvetica">
			<?php echo nl2br($notes); ?>
			</td>
		  </tr>
		</table>
	</td>
  </tr>
</table>
<?php
}
?>
<textarea name="notes" cols=40 rows=4 wrap="physical"></textarea><br>
<input type="hidden" name="pn" value="<?php echo $pn ?>">
<input type="hidden" name="nr" value="<?php echo $nr ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="bShowImageJApplet" value="<?php echo $bShowImageJApplet ?>">
<input type="hidden" name="preview_size" value="<?php if(isset($preview_size)) echo $preview_size ?>">
<input type="hidden" name="mode" value="save">
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>>
<?php
}
?>
</form>
</body>
</html>
