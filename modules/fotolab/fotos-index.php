<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','nursing.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

$breakfile=$root_path."modules/nursing/nursing-station-patientdaten.php".URL_REDIRECT_APPEND."&edit=$edit&station=$station&pn=$pn";

require($root_path.'global_conf/inc_remoteservers_conf.php');

if($disc_pix_mode){
	$final_path="$root_path$fotoserver_localpath$pn/";
}else{
	$final_path="$fotoserver_http$pn/";
}

//$db->debug=1;

/* Load date formatter */
include_once($root_path.'include/inc_date_format_functions.php');

/* Create encounter object */
require_once($root_path.'include/care_api_classes/class_encounter.php');
$encounter= new Encounter;
$encounter->loadEncounterData($pn);
/* Create image object */
require_once($root_path.'include/care_api_classes/class_image.php');
$img=new Image();
$all_image=$img->getAllImageData($pn);

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing',TRUE,FALSE);

# Title in toolbar
 $smarty->assign('sToolbarTitle',$LDPhotos);

 # hide return button
 $smarty->assign('pbBack',FALSE);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('encounter_photos.php','fotos','','$station','$LDPhotos')");

 # href for close button
 $smarty->assign('breakfile',"javascript:window.parent.location.replace('$breakfile');");

 # Window bar title
 $smarty->assign('sWindowTitle',$LDPhotos);

 # Body Onload js
 $smarty->assign('sOnLoadJs','onLoad="if (window.focus) window.focus(); window.resizeTo(1000,740);"');

# Collect js code

ob_start();

?>

<style type="text/css">
	.a12_w {font-family: arial; color: navy; font-size:12; background-color:#ffffff}
	.a12_gry {font-family: arial; color: navy; font-size:12; background-color:#000000}
</style>

<script language="javascript">

var x=-1;

function showfoto(srcimg)
{
	if (document.images) document.images.foto.src=srcimg;
	x=-2;
}

function preview(n)
{
	window.parent.FOTOS_PREVIEW.location.href="fotos-preview.php<?php echo URL_REDIRECT_APPEND; ?>&pn=<?php echo $pn ?>&nr="+n;
}
</script>
<?php

$sTemp = ob_get_contents();
ob_end_clean();
$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

?>

<p>
<ul>
<font class="prompt">
<?php

echo $pn;

if(is_object($encounter)){
	$fn=$encounter->PhotoFilename();
	if(!empty($fn)&&file_exists($root_path.'fotos/registration/'.$fn)){
		# If main photo ID exists, show it
		echo '<br><a href="'.$root_path.'main/pop_reg_pic.php'.URL_APPEND.'&pid='.$encounter->PID().'&fn='.$fn.'" target="FOTOS_PREVIEW" title="'.$LDClk2Preview.'">
	 		<img src="';
		echo $root_path.'main/imgcreator/thumbnail.php?mx=80&my=100&imgfile=fotos/registration/'.$fn;
				
		echo '" border=0></a>';

	}
	echo "<br></font>".ucfirst($encounter->LastName()).", ".ucfirst($encounter->FirstName())." (";
	echo formatDate2Local($encounter->BirthDate(),$date_format).')<br>';
	echo "</font>";
}
?>

<table border=0>
<tr>
<td>
<nobr>

<?php 

echo "<b>$LDPhotos";
if(is_object($all_image)) echo " ".$all_image->RecordCount()." $LDPicShots";
echo '</b><br>
	<table border=0>';

if(is_object($all_image)){
	while($image=$all_image->FetchRow()){

		if(file_exists($final_path.$image['nr'].'.'.$image['mime_type'])){
	
			echo '<tr>
     		<td class="a12_w">'.formatDate2Local($image['shot_date'],$date_format);
			echo ' <font color=red size="1">Foto '.$image['shot_nr'].'</font>';
 
     		echo '</td>
	 		<td class="a12_gry"><a href="javascript:preview(\''.$image['nr'].'\')" title="'.$LDClk2Preview.'">
	 		<img src="';
			if(stristr($image['mime_type'],'gif')){
				echo $final_path.$image['nr'].'.'.$image['mime_type'].'" border=0  width=80></a> </td>
   				</tr>';
			}else{
				echo  $root_path.'main/imgcreator/thumbnail.php?mx=80&my=100&imgfile='.$fotoserver_localpath.$pn.'/'.$image['nr'].'.'.$image['mime_type'].'" border=0></a> </td>
   				</tr>';
			}
   		}
	}
}

 ?>
 </table>
<p>
<a href="javascript:window.parent.location.replace('<?php echo $breakfile ?>');"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>></a>

</nobr>
</td>
<td>
<img src="<?php echo $root_path ?>gui/img/common/default/pixel.gif" width=50 border="0">

</td>
<td>
<img src="<?php echo $root_path ?>gui/img/common/default/pixel.gif" border="0" name="foto">

</td>
</tr>
</table>

<p>
</ul>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign page output to the mainframe template

$smarty->assign('sMainFrameBlockData',$sTemp);
 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
