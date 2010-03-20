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
define('LANG_FILE','specials.php');
$local_user='ck_fotolab_user';
require_once($root_path.'include/inc_front_chain_lang.php');

/* Load date formatter */
require_once($root_path.'include/inc_date_format_functions.php');
				
if(!isset($maxpic)||!$maxpic) $maxpic=4;

$thisfile=basename(__FILE__);
$breakfile="javascript:window.parent.location.replace('".$root_path."main/spediens.php?sid=$sid&lang=$lang')";

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$LDFotoLab);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('fotolab.php','input','')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDFotoLab);
  
 # Body Onload js
 if(!$same_pat) $smarty->assign('sOnLoadJs','onLoad="window.parent.PREVIEWFRAME.location.replace(\'fotolab-preview.php?sid='.$sid.'&lang='.$lang.'\');"');
	else $smarty->assign('sOnLoadJs','onLoad="window.parent.PREVIEWFRAME.location.replace(\'fotolab-preview.php?sid='.$sid.'&lang='.$lang.'\');" ');

# Collect js code

ob_start();
?>

<script language="javascript">
<!-- 
function chkNumber(n)
{
	var d;
	eval("d=document.srcform.nr"+n);
	if((d.value)&&(!(isNaN(d.value)))) return true;
	else
	{
		x=d.value.toLowerCase();
		if(x=="main")
		{
			d.value=x;
		 	return true;
		}
		else
		{
			d.value="";
			d.focus();
			alert('<?php echo $LDAlertNumberOnly ?>');
	 		return false;
		}
	}

}

function previewpic(fn) {
if(fn=="") return;
//else parent.PREVIEWFRAME.document.location.href="fotolab-preview.php<?php echo URL_REDIRECT_APPEND ?>&picsource="+fn;
else parent.PREVIEWFRAME.document.previewpic.src=fn;

}

function chkform(d)
{
	var maxpix=<?php echo $maxpic ?>;
	var flag=false;
	for(i=0;i<maxpix;i++)
	{
		if((eval("d.sdate"+i+".value!=''"))&&(eval("d.picfile"+i+".value!=''"))) 
		{
			flag=true;
			break;
		}
	}
	if(flag){
		 return true;
	}else{
		alert("<?php echo "$LDAlertPhotoInfo  $LDAlertNoPhotoInfo" ?>");
		return false;
	}
}

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>
// -->
</script>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

?>

<table width=100% border=0 cellspacing=0 >

<!-- Tabs  -->
<tr valign=top >
<td colspan=2 style="border-bottom: 2px solid gray">
<?php 
	if($target=="search") $img='such-b.gif'; //echo '<img '.createLDImgSrc($root_path,'such-b.gif','0').' alt="'.$LDSearch.'">';
		else{ $img='such-gray.gif'; }
	echo '<a href="upload_search_patient.php'.URL_APPEND.'&target=search"><img '.createLDImgSrc($root_path,$img,'0').' alt="'.$LDSearch.'" ';if($cfg['dhtml'])echo'style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; echo '></a>';
?><br>
</td>
</tr>


<tr valign=top >
<td valign=top colspan=2>

<?php 	echo "[$patnum] $lastname, $firstname (".formatDate2Local($bday,$date_format).")<p>"; ?>

<p>
<font size=1 color="#cc0000">
<?php if($nopatdata) echo '
	<img '.createMascot($root_path,'mascot1_r.gif','0','bottom').'> <font size=2>'.$LDAlertNoPatientData.'<br></font>';
//gjergji : new calendar
require_once ('../../js/jscalendar/calendar.php');
$calendar = new DHTML_Calendar('../../js/jscalendar/', $lang, 'calendar-system', true);
$calendar->load_files();
//end : gjergji
?>
<form ENCTYPE="multipart/form-data"  action="fotolab-pic-save.php" method="post"  name="srcform" onSubmit="return chkform(this)">
<INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="2000000">
<?php 
/* Load the common icons*/
$img_cam=createComIcon($root_path,'lilcamera.gif','0');
for ($i=0;$i<$maxpic;$i++) {
	 echo $LDShotDate;
	 //gjergji : new date
	 echo $calendar->show_calendar($calendar,$date_format,'sdate'.$i);	
	 //end : gjergji
	echo '&nbsp;&nbsp;'.$LDNr.' 
	 <input type="text" name="nr'.$i.'" size=4 maxlength=4 onFocus="previewpic(document.srcform.picfile'.$i.'.value)" value="'.($i+1+$lastnr).'" >
	<input type="file" name="picfile'.$i.'" size="30" onFocus="previewpic(this.value)" >  
	<a href="javascript:previewpic(document.srcform.picfile'.$i.'.value)" title="'.$LDPreview.'">
	<img '.$img_cam.'></a>     
	<hr>
	';
}

?>
<input type="hidden" name="patnum" value="<?php echo $patnum ?>">
<input type="hidden" name="lastname" value="<?php echo $lastname ?>">
<input type="hidden" name="firstname" value="<?php echo $firstname ?>">
<input type="hidden" name="bday" value="<?php echo $bday ?>">
<input type="hidden" name="maxpic" value="<?php echo $maxpic ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="submit" value="<?php echo $LDSave ?>">

</form>


<p>
</FONT>

<form action="<?php echo $thisfile ?>" method="post" name="setmaxpic">
<?php echo $LDWantUpload ?> <input type="text" name="maxpic" size=1 maxlength=2 value="<?php echo $maxpic ?>"> <?php echo $LDImage ?> <input type="submit" value="<?php echo $LDGO ?>">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="patnum" value="<?php echo $patnum ?>">
<input type="hidden" name="lastname" value="<?php echo $lastname ?>">
<input type="hidden" name="firstname" value="<?php echo $firstname ?>">
<input type="hidden" name="bday" value="<?php echo $bday ?>">
<input type="hidden" name="lastnr" value="<?php $lastnr='nr'.($maxpic-1); echo $$lastnr; ?>">
<input type="hidden" name="same_pat" value="1">
</form>

</td>
</tr>
</table>
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
