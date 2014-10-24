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
if (!$pn) {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php?mode=close"); exit;}; 

if(!isset($saveok)) $saveok=false;

define('LANG_FILE','drg.php');

require_once('drg_inc_local_user.php');

//$db->debug=true;

require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_drg.php');
$DRG_obj= new DRG($pn,$dept_nr);

if($saveok) { 
	switch($target){
		case "drg_intern":
							$openerfile="drg-ops-intern.php";
							break;
		case "diagnosis":
							$openerfile="drg-icd10.php";
							break;
		case "procedure":
							$openerfile="drg-ops301.php";
							break;
		default:{header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php?mode=close"); exit;};
	}
?>
 <script language="javascript" >
 window.opener.location.href='<?php echo "$openerfile?sid=$sid&lang=$lang&pn=$pn&opnr=$opnr&edit=$edit&ln=$ln&fn=$fn&bd=$bd&group_nr=$group_nr&dept_nr=$dept_nr&oprm=$oprm&y=$y&m=$m&d=$d&display=composite&newsave=1" ?>';
 window.close();
</script>
<?php 

	exit;
} 

switch($target){
	case 'drg_intern':
							$title=$LDCode;
							$rowcolor="#990000";
							$element="ops_intern_code";
							$searchfile="drg-ops-intern-search.php";
							break;
	case 'diagnosis':
							$title=$LDIcd10;
							$rowcolor="#0000aa";
							$element="icd_code";
							$searchfile="drg-icd10-search.php";
							$save_related=1;
							$element_related="related_icd";
							$hidselector='icd_px';
							break;
	case 'procedure':
							$title=$LDOps301;
							$rowcolor="#009900";
							$element="ops_code";
							$searchfile="drg-ops301-search.php";
							$save_related=1;
							$element_related="related_ops";
							$hidselector='ops_px';
							break;
	default:{header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php?mode=close"); exit;};
}

$toggle=0;

$thisfile="drg-quicklist.php";

if($mode=='save')
{
	$itemselector='sel';
	include('includes/inc_drg_entry_save.php');
}else{
	if($qlist_obj=$DRG_obj->DeptQuicklist($target,$dept_nr)){
		$linecount=$DRG_obj->LastRecordCount();
	}
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo "$LDQuickList $title" ?></TITLE>
  <script language="javascript" src="../js/showhide-div.js">
</script>
  <script language="javascript">
<!-- 
function pruf(d)
{
	if((d.keyword.value=="")||(d.keyword.value==" ")) return false;
}
function subsearch(k)
{
	//window.location.href='drg-icd10-search.php?sid=<?php echo "sid=$sid&lang=$lang&pn=$pn&opnr=$opnr&edit=$edit&ln=$ln&fn=$fn&bd=$bd&dept=$dept&oprm=$oprm&display=$display" ?>&keyword='+k;
	document.searchdata.keyword.value=k;
	document.searchdata.submit();
}
function checkselect(d)
{
	var ret=false;
	var x=d.lastindex.value;
	for(i=0;i<x;i++)
	if(eval("d.sel"+i+".checked"))
	{
		ret=true;
		break;
	}
	return ret;
}
// -->
</script>
 
  <?php 
require($root_path.'include/core/inc_css_a_hilitebu.php');
?>
 
</HEAD>

<BODY   onLoad="if(window.focus) window.focus();" bgcolor=<?php echo $cfg['body_bgcolor']; ?>
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<FONT    SIZE=3  FACE="Arial" color="<?php echo $rowcolor ?>">
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> align="right"></a>
<b><?php echo "$LDQuickList $title" ?></b>
<ul>

<p>

<form name="quicklist" onSubmit="return checkselect(this)" method="post">

<table border=0 cellpadding=0 cellspacing=0 width='100%'> 
<tr bgcolor="<?php echo $rowcolor ?>">
<td width="20">
<img <?php echo createComIcon($root_path,'delete2.gif','0') ?> alt="<?php echo $LDReset ?>" onClick="javascript:document.quicklist.reset()">
</td>
<td><font face=arial size=2 color=#ffffff>&nbsp;<b><nobr><?php echo $title ?></nobr></b>&nbsp;</td>

<td><font face=arial size=2 color=#ffffff>&nbsp;&nbsp;&nbsp;<b><?php echo $LDDescription ?></b>
</td>
		
</tr>

<?php
function drawdata(&$data)
{
	global $toggle,$LDInclusive,$LDExclusive,$LDNotes,$LDRemarks,$LDExtraCodes,$LDAddCodes;
 	global $idx,$keyword,$showonly,$hidselector;

	echo '
	<tr bgcolor="';
	if($toggle) { echo '#efefef">';} else {echo '#ffffff">'; };
	$toggle=!$toggle;
	echo '
	<td>';
	echo '<input type="checkbox" name="sel'.$idx.'" value="'.$data['nr'].'">
			<input type="hidden" name="'.$hidselector.$idx.'" value="'.$data['code_parent'].'">';
	$idx++;
	
	echo '
	</td>
	<td><font face=arial size=2><nobr>';
	echo $data['code'].'&nbsp;';		
	echo '&nbsp;</nobr></td><td>&nbsp;';
	echo '<font face=arial size=2>';
	echo $data['parent_desc'].':<b>'.$data['description'].'</b>&nbsp;';		
				
	echo '</td>';
	echo '</tr>';
}

if ($linecount) { 
	
	$idx=0;
	while($qlist=$qlist_obj->FetchRow()){
		drawdata($qlist);
		//$idx++;
	}
}
?>

</table>
<?php if($linecount>0) : ?>
<input type="hidden" name="lastindex" value="<?php echo $idx ?>">
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
<input type="hidden" name="edit" value="<?php echo $edit; ?>">
<input type="hidden" name="oprm" value="<?php echo $oprm; ?>">
<input type="hidden" name="display" value="<?php echo $display; ?>">
<input type="hidden" name="target" value="<?php echo $target; ?>">
<input type="hidden" name="mode" value="save">
<input type="hidden" name="quicklist" value="1">

</form>
<?php else : ?>
<p>
<img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="bottom"><?php echo $LDNoQuickList ?> 
<a href="<?php echo "$searchfile?sid=$sid&lang=$lang&pn=$pn&opnr=$opnr&edit=$edit&ln=$ln&fn=$fn&bd=$bd&dept_nr=$dept_nr&oprm=$oprm&display=$display&target=$target" ?>"><u><?php echo $LDClick2Search ?></u></a> 
<p>
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>></a>
<?php endif ?>

</ul>
&nbsp;
</FONT>


</FONT>


</BODY>
</HTML>
