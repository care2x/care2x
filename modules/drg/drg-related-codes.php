<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','drg.php');

require_once('drg_inc_local_user.php');

require_once($root_path.'include/inc_front_chain_lang.php');
if (!isset($pn)||!$pn) {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php?mode=close"); exit;}; 
//$db->debug=true;
if($saveok) { ?>

 <script language="javascript" >
 window.opener.parent.location.href='<?php echo "drg-composite-start.php?sid=$sid&lang=$lang&pn=$pn&opnr=$opnr&edit=1&ln=$ln&fn=$fn&bd=$bd&group_nr=$group_nr&dept_nr=$dept_nr&oprm=$oprm&y=$y&m=$m&d=$d&display=composite&newsave=1" ?>';
 window.close();
</script>

<?php
	
	exit;
}

require_once($root_path.'include/care_api_classes/class_drg.php');
$DRG_obj=new DRG($pn); // Create a drg object

$toggle=0;

$thisfile='drg-related-codes.php';

if($mode=='save')
{
	$save_related=1;
	# Save first the related diagnosis codes
	$target='icd10';
	$element='icd_code';
	$element_related='related_icd';
	$itemselector='icd';
	$hidselector='icd_px';
	$lastindex=$last_icd_index;
	
	$noheader=true; # Disable the redirect 
	include($root_path.'include/inc_drg_entry_save.php');
	# Save the related procedure codes
	# Clean first not needed data
	unset($qlist);
	if(isset($data)) unset($data);
	$linebuf='';
	
	$noheader=false; # Enable the redirect
	$target='ops301';
	$element='ops_code';
	$element_related='related_ops';
	$itemselector='ops';
	$hidselector='ops_px';
	$lastindex=$last_ops_index;
	include($root_path.'include/inc_drg_entry_save.php');
	if($linebuf=='')
	{
		header("location:$thisfile?sid=$sid&lang=$lang&saveok=1&pn=$pn&opnr=$opnr&ln=$ln&fn=$fn&bd=$bd&group_nr=$group_nr&dept_nr=$dept_nr&oprm=$oprm&y=$y&m=$m&d=$d&display=$display&target=$target");
		exit;
	}
}elseif(isset($group_nr)&&$group_nr){

	/* Load related codes */
	$diag_obj=&$DRG_obj->RelatedDiagnoses($group_nr);
 	$proc_obj=&$DRG_obj->RelatedProcedures($group_nr);

}

# Load the date formatter
include_once($root_path.'include/inc_date_format_functions.php');

# Get the patient`s basic data
if($enc=&$DRG_obj->getBasic4Data()){
	$encounter=$enc->FetchRow();
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo "$LDPossibleCodes" ?></TITLE>
<script language="javascript" src="../js/showhide-div.js"></script>
<script language="javascript">
<!-- 
function subsearch(k)
{
	//window.location.href='drg-icd10-search.php?sid=<?php echo "sid=$sid&lang=$lang&pn=$pn&opnr=$opnr&ln=$ln&fn=$fn&bd=$bd&dept_nr=$dept_nr&oprm=$oprm&display=$display" ?>&keyword='+k;
	document.searchdata.keyword.value=k;
	document.searchdata.submit();
}
function checkselect(d)
{
	var ret=false;
		var x=d.last_icd_index.value;
		for(i=0;i<x;i++)
		if(eval("d.icd"+i+".checked"))
		{
			ret=true;
			break;
		}
		var x=d.last_ops_index.value;
		for(i=0;i<x;i++)
		if(eval("d.ops"+i+".checked"))
		{
			ret=true;
			break;
		}
	return ret;
}
function getRelatedCodes(mc)
{
	window.location.href="drg-related-codes.php?sid=<?php echo "$sid&lang=$lang&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept_nr=$dept_nr&oprm=$oprm" ?>&maincode="+mc;
}
// -->
</script>
 
  <?php 
require($root_path.'include/inc_css_a_hilitebu.php');
?>
 
</HEAD>

<BODY marginheight=2 marginwidth=2 leftmargin=2 topmargin=2  onLoad="if(window.focus) window.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> align="right"></a>
<FONT    SIZE=2  FACE="verdana,Arial" >

<?php 
//echo "$ln, $fn ".formatDate2Local($bd,$date_format)." - $pn";
echo $encounter['name_last'].", ".$encounter['name_first']." ".formatDate2Local($encounter['date_birth'],$date_format)." - $pn";
if($opnr) echo" - OP# $opnr - $dept_nr OP $oprm";
?>

</font><p>
<ul>
<FONT    SIZE=3  FACE="Arial" color="<?php echo $rowcolor ?>">
<b><?php echo "$LDPossibleCodes" ?></b>


<p>

<form name="quicklist" onSubmit="return checkselect(this)" method="post">

<table border=0 cellpadding=0 cellspacing=0 width='100%'> 
<?php 

function drawdata(&$data)
{
	global $toggle,$root_path;
 	global $idx,$keyword,$showonly,$deleter,$selector,$maincode,$hidselector;

	echo '
	<tr bgcolor=';
						
	if($toggle) { echo '#efefef>';} else {echo '#ffffff>'; };
	$toggle=!$toggle;
	echo '
	<td>';
	
	echo '<input type="checkbox" name="'.$selector.$idx.'" value="'.$data['code'].'">
	<input type="hidden" name="'.$hidselector.$idx.'" value="'.$data['code_parent'].'">
	';
	
	$idx++;
						
	echo '
	</td>
	<td><font face=arial size=2><nobr>';
	echo $data['code'].'&nbsp;';
			
	echo '&nbsp;</nobr></td><td>&nbsp;';
	echo '<font face=arial size=2>';
	echo $data['parent_desc'].':<b> '.$data['description'].'</b>&nbsp;';		
						
	echo '</td>';
	echo '
	</tr>';
}

$idx=0;

if(is_object($diag_obj)){
?>
<tr >
<td colspan=8>&nbsp;
</td>
</tr>
<tr bgcolor="#0000aa">
<td width="20">
<img <?php echo createComIcon($root_path,'delete2.gif','0') ?> alt="<?php echo $LDReset ?>" onClick="javascript:document.quicklist.reset()">
</td>
<td><font face=arial size=2 color=#ffffff>&nbsp;<b><nobr><?php echo $LDIcd10 ?></nobr></b>&nbsp;</td>

<td colspan=7><font face=arial size=2 color=#ffffff>&nbsp;&nbsp;&nbsp;<b><?php echo $LDDescription ?></b>
</td>
		
</tr>
<?php
$selector='icd';
$hidselector='icd_px';
$diag_exists=true;
		
	while($diagnosis=$diag_obj->FetchRow()){
		drawdata($diagnosis);
	}
}else{
	$diag_exist=false;
}
?>
<input type="hidden" name="last_icd_index" value="<?php echo $idx ?>">
<?php 

$idx=0;

if(is_object($proc_obj)){
?>
<tr >
<td colspan=8>&nbsp;
</td>
</tr>
<tr bgcolor="#009900">
<td width="20">
<img <?php echo createComIcon($root_path,'delete2.gif','0') ?> alt="<?php echo $LDReset ?>" onClick="javascript:document.quicklist.reset()">
</td>
<td><font face=arial size=2 color=#ffffff>&nbsp;<b><nobr><?php echo $LDOps301 ?></nobr></b>&nbsp;</td>

<td colspan=7><font face=arial size=2 color=#ffffff>&nbsp;&nbsp;&nbsp;<b><?php echo $LDDescription ?></b>
</td>
		
</tr>
<?php

$selector='ops';
$hidselector='ops_px';

/* Draw the procedure codes */
	
	while($procedure=$proc_obj->FetchRow()){
		drawdata($procedure);
	}
	$proc_exists=true;
}else{
?>
<input type="hidden" name="ops0" value="">
<?php
	$proc_exists=false;
}
?>
</table>
<input type="hidden" name="last_ops_index" value="<?php echo $idx ?>">
<?php if($diag_exists||$proc_exists) : ?>
<p>
<input type="submit" value="<?php echo $LDApplySelection ?>">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="pn" value="<?php echo $pn; ?>">
<input type="hidden" name="opnr" value="<?php echo $opnr; ?>">
<input type="hidden" name="ln" value="<?php echo $ln; ?>">
<input type="hidden" name="fn" value="<?php echo $fn; ?>">
<input type="hidden" name="bd" value="<?php echo $bd; ?>">
<input type="hidden" name="dept_nr" value="<?php echo $dept_nr; ?>">
<input type="hidden" name="group_nr" value="<?php echo $group_nr; ?>">
<input type="hidden" name="oprm" value="<?php echo $oprm; ?>">
<input type="hidden" name="display" value="<?php echo $display; ?>">
<input type="hidden" name="target" value="<?php echo $target; ?>">
<input type="hidden" name="mode" value="save">

</form>
<?php else : ?>
<p>
<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="bottom"><?php echo $LDNoQuickList ?> 
<p>
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>></a>
<?php endif ?>

</ul>
&nbsp;
</FONT>


</FONT>


</BODY>
</HTML>
