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
$lang_tables[]='prompt.php';
define('LANG_FILE','drg.php');

require_once('drg_inc_local_user.php');

require_once($root_path.'include/inc_front_chain_lang.php');
/* Load the date formatter */
require_once($root_path.'include/inc_date_format_functions.php');
require_once($root_path.'include/care_api_classes/class_drg.php');
$enc_obj = new DRG($pn);

//$db->debug=true;

if(isset($mode)&&$mode=='save_group'&&isset($group_nr)&&$group_nr){
	$enc_obj->groupNonGroupedItems($group_nr);
	header("location:$thisfile?sid=$sid&lang=$lang&saveok=1&pn=$pn&opnr=$opnr&group_nr=$group_nr&edit=$edit&is_discharged=$is_discharged&ln=$ln&fn=$fn&dept_nr=$dept_nr&oprm=$oprm&display=$display");
	exit;
}

$toggle=0;
$thisfile=basename(__FILE__);
          
if(isset($mode)&&$mode=='delete'&&$item){
	$buf=$enc_obj->ungroupDiagnoses($group_nr);
	$buf2=$enc_obj->ungroupProcedures($group_nr);
	$enc_obj->deleteEncounterDRGGroup($item);
	header("location:$thisfile?sid=$sid&lang=$lang&pn=$pn&opnr=$opnr&group_nr=0&edit=$edit&is_discharged=$is_discharged&ln=$ln&fn=$fn&dept_nr=$dept_nr&oprm=$oprm&display=$display");
	exit;
}

$non_grouped=false;
if(!isset($group_nr)) $group_nr=0;

# Get the patient`s basic data
if($enc=&$enc_obj->getBasic4Data()){

	$encounter=$enc->FetchRow();

	# Get the internal drg groups for the encounter
	$drg_rows=&$enc_obj->InternDRGGroups();

	# Check for non grouped entries
	if($enc_obj->nongroupedDiagnosisExists()){
		$non_grouped=true; 
	}elseif($enc_obj->nongroupedProcedureExists()){
		$non_grouped=true; 
	}
}

# Preload the icon images 
$img_delete=createComIcon($root_path,'delete2.gif','0','right',TRUE);
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE></TITLE>
 
  <script language="javascript">
<!-- 
function pruf(d)
{
	if((d.keyword.value=="")||(d.keyword.value==" ")) return false;
}
function gethelp(x,s,x1,x2,x3)
{
	if (!x) x="";
	urlholder="help-router.php?lang=<?php echo $lang ?>&helpidx="+x+"&src="+s+"&x1="+x1+"&x2="+x2+"&x3="+x3;
	helpwin=window.open(urlholder,"helpwin","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.helpwin.moveTo(0,0);
}
function openOPSsearch(c)
{
	g=document.ops_intern.group_nr.value;
	urlholder="drg-ops-intern-search.php?sid=<?php echo "$sid&lang=$lang&pn=$pn&edit=$edit&is_discharged=$is_discharged&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept_nr=$dept_nr&oprm=$oprm" ?>&group_nr="+g+"&current="+c;
	drgwin_<?php echo $sid ?>=window.open(urlholder,"drgwin_<?php echo $sid ?>","width=600,height=450,menubar=no,resizable=yes,scrollbars=yes");
	window.drgwin_<?php echo $sid ?>.moveTo(100,100);
}
function deleteItem(i,g)
{
	if(confirm("<?php echo "$LDItemsDegrouped \\n $LDAlertSureDelete" ?>"))
	{
		window.location.href='drg-ops-intern.php?sid=<?php echo "$sid&lang=$lang&mode=delete&pn=$pn&edit=$edit&is_discharged=$is_discharged&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept_nr=$dept_nr&oprm=$oprm&display=$display" ?>&item='+i+'&group_nr='+g;
	}
}
function openQuicklist(t)
{
	urlholder="drg-quicklist.php?sid=<?php echo "$sid&lang=$lang&pn=$pn&edit=$edit&is_discharged=$is_discharged&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept_nr=$dept_nr&oprm=$oprm" ?>&target="+t;
	drgwin_<?php echo $sid ?>=window.open(urlholder,"drgwin_<?php echo $sid ?>","width=600,height=450,menubar=no,resizable=yes,scrollbars=yes");
	//window.drgwin_<?php echo $sid ?>.moveTo(100,100);
}
function openRelatedCodes()
{
<?php if($cfg['dhtml'])
	echo '
			w=window.parent.screen.width-75;
			h=window.parent.screen.height-50;';
	else
	echo '
			w=800;
			h=650;';
?>

	gn=document.ops_intern.group_nr.value;
	if(gn!=0){
		relcodewin_<?php echo $sid ?>=window.open("drg-related-codes.php?sid=<?php echo "$sid&lang=$lang&pn=$pn&edit=$edit&is_discharged=$is_discharged&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept_nr=$dept_nr&oprm=$oprm" ?>&group_nr="+gn,"relcodewin_<?php echo $sid ?>","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60));
		window.relcodewin_<?php echo $sid ?>.moveTo(0,0);
	}
}
function showItems(d,g){
	if(d.checked){
		updateDisplay(g);
/*		document.ops_intern.group_nr.value=g;
		window.parent.ICD.location.replace("drg-icd10.php<?php echo URL_REDIRECT_APPEND.'&display='.$display.'&pn='.$pn.'&group_nr='; ?>"+g);
		window.parent.OPS.location.replace("drg-ops301.php<?php echo URL_REDIRECT_APPEND.'&display='.$display.'&pn='.$pn.'&group_nr='; ?>"+g);
*/	}
}
function updateDisplay(g){
	document.ops_intern.group_nr.value=g;
	window.parent.ICD.location.replace("drg-icd10.php<?php echo URL_REDIRECT_APPEND.'&display='.$display.'&pn='.$pn.'&opnr='.$opnr.'&edit='.$edit.'&is_discharged='.$is_discharged.'&group_nr='; ?>"+g);
	window.parent.OPS.location.replace("drg-ops301.php<?php echo URL_REDIRECT_APPEND.'&display='.$display.'&pn='.$pn.'&opnr='.$opnr.'&edit='.$edit.'&is_discharged='.$is_discharged.'&group_nr='; ?>"+g);
}
function useThisGroup(g){
	document.ops_intern.mode.value="save_group";
	document.ops_intern.group_nr.value=g;
	document.ops_intern.submit();
}
function createNewGroupName()
{
	urlholder="drg-intern-create.php?sid=<?php echo "$sid&lang=$lang&pn=$pn&edit=$edit&is_discharged=$is_discharged&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&dept_nr=$dept_nr&oprm=$oprm&non_grouped=$non_grouped" ?>";
	newgrp_<?php echo $sid ?>=window.open(urlholder,"newgrp_<?php echo $sid ?>","width=790,height=540,menubar=no,resizable=yes,scrollbars=yes");
	window.newgrp_<?php echo $sid ?>.moveTo(100,100);
}
function checkCreateNew(){
	if(confirm("<?php echo "$LDSureToCreateNewGr" ?>")){
		createNewGroupName();
	}
}
// -->
</script>
 
<?php 
require($root_path.'include/inc_css_a_hilitebu.php');
?>
 <?php if($newsave) : ?>
 <script language="javascript" >
 //window.opener.location.href='drg-composite-start.php?sid=<?php echo "$sid&lang=$lang&pn=$pn&opnr=$opnr&edit=$edit&is_discharged=$is_discharged&ln=$ln&fn=$fn&bd=$bd&dept_nr=$dept_nr&oprm=$oprm&y=$y&m=$m&d=$d&display=composite&newsave=1" ?>';
//window.parent.opener.location.href='<?php echo "oploginput.php?sid=$sid&lang=$lang&mode=saveok&enc_nr=$pn&op_nr=$opnr&edit=$edit&is_discharged=$is_discharged&dept_nr=$dept_nr&saal=$oprm&pyear=$y&pmonth=$m&pday=$d" ?>';
</script>
<?php endif; ?>
</HEAD>

<BODY 
<?php if($display=="composite") echo 'topmargin=0 marginheight=0 leftmargin=0 marginwidth=0';
else  echo 'topmargin=2 marginheight=2';
?> 
onLoad="if(window.focus) window.focus();<?php if(isset($saveok)&&$saveok) echo 'updateDisplay(\''.$group_nr.'\');'; ?>" bgcolor="<?php echo $cfg['body_bgcolor']; ?>" 
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>
<form name="ops_intern" action="drg-ops-intern.php" method="post">
<FONT    SIZE=2  FACE="verdana,Arial" >
<?php 
if(isset($is_discharged)&&$is_discharged){
?>
<table border=0 cellspacing=0 cellpadding=1 width="100%">
  <tr>
    <td bgcolor="red">&nbsp;<FONT    SIZE=2  FACE="verdana,Arial" color="#ffffff"><img <?php echo createComIcon($root_path,'warn.gif','0','absmiddle',TRUE); ?>> <b><?php echo $LDPatientIsDischarged; ?></b></font></td>
  </tr>
</table>
<?php
}

//echo "$ln, $fn ".formatDate2Local($bd,$date_format)." - $pn";
//if($opnr) echo" - OP# $opnr"; 
echo $encounter['name_last'].", ".$encounter['name_first']." ".formatDate2Local($encounter['date_birth'],$date_format)." - $pn";
if($opnr) echo" - OP# $opnr - $dept_nr OP $oprm"; 
?>
<?php if($display!="composite") : ?>
<a href="javascript:window.history.back()" ><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?> width=110 height=24 align="right"></a>

<b><?php echo $LDOps301 ?></b></font>&nbsp;
 <input type="button" value="<?php echo $LDSearch4OPS301 ?>" onClick="javascript:openOPSsearch()">&nbsp;
 <input type="button" value="<?php echo $LDQuickList ?>" onClick="javascript:openICDsearch()">
<p>
<?php endif; ?>

<table border=0 width=100%>
  <tr>
    <td width=100% valign="top">
	<table border=0 cellpadding=1 cellspacing=1 width=100%> 
		<tr bgcolor="#990000">
 		<td align="center"><font size=2 color=#ffffff><b><?php echo $LDSelect ?></b></td>
 		<td width="15%"><font size=2 color=#ffffff><b><?php echo $LDOpsIntern ?></b></td>
 		<td ><font size=2 color=#ffffff><b><?php echo $LDOperation ?></b></td>
 		<td><font size=2 color=#ffffff><b><?php echo $LDOptions ?></b></td>
 		<td>&nbsp;</td>
   	</tr>

<?php
if(is_object($drg_rows)){ 
	$i=0;
	while($drg=$drg_rows->FetchRow()){
							
						
		echo '<tr class="';
								
		if($toggle) { echo 'wardlistrow2">'; $toggle=0;} else {echo 'wardlistrow1">'; $toggle=1;};
								
		echo '
				<td align="center"><font size=2><input type="radio" name="grp_nr" onClick="javascript:showItems(this,\''.$drg['group_nr'].'\')" ';
		if($group_nr==$drg['group_nr']) echo 'checked';
		
		echo '>
				</td>
				<td><font size=2>'.$drg['code'].'
				</td>
				<td><font size=2>'.$drg['description'].'
				</td>
				<td><font size=2>';
		if($non_grouped&&$edit) echo '
				<a href="javascript:useThisGroup(\''.$drg['group_nr'].'\')"><img '.createComIcon($root_path,'l_arrowgrnsm.gif','0','',TRUE).'> '.$LDUseToGroupItems.'</a>';
		echo '
				</td>
				<td>';
		if($edit){
			echo '<a href="javascript:deleteItem(\''.$drg['nr'].'\',\''.$drg['group_nr'].'\')"><img '.$img_delete.' alt="'.$LDDeleteEntry.'"></a>';
		}
		echo'</td>
				</tr>';
		$i++;
	}
}
if($non_grouped){
		echo '<tr class="hilite">';
								
		//if($toggle) { echo '#efefef>'; $toggle=0;} else {echo '#ffffff>'; $toggle=1;};
					echo '
					<td align="center"><font size=2><input type="radio" name="grp_nr" onClick="javascript:showItems(this,\'0\')"';
		if(!$group_nr) echo 'checked';
		echo '>
					</td>
					<td><font size=2 color="#ee0000">'.$LDQMarks.'
					</td>
					<td ><font size=2 color="#ee0000">'.$LDNonSpecifiedGroup.'</td>
					<td colspan=2>';
		if($edit) echo '<font size=2>
					<a href="javascript:openOPSsearch(\'1\')"><img '.createComIcon($root_path,'l_arrowgrnsm.gif','0','',TRUE).'> '.$LDSpecifyGroup.'</a> <a href="javascript:createNewGroupName()"><img '.createComIcon($root_path,'l_arrowgrnsm.gif','0','',TRUE).'> '.$LDCreateGroupName.'</a>';
		echo '
					</td>
					';
}


?>
	</table>
	</td>
	<?php if($display!='composite') { ?>   
	 <td valign="top" bgcolor="#990000"><font size=2 color=#ffffff>
	<a href="javascript:window.history.back()" ><img <?php echo createLDImgSrc($root_path,'back2.gif','0') ?> width=110 height=24></a>
	</td>
	<?php }elseif($edit){ ?>
	 <td valign="top" bgcolor="#990000"><font size=2 color=#ffffff>
	<input type="button" value="<?php echo $LDSearch ?>" onClick="javascript:openOPSsearch('0')">&nbsp;
 	<p><input type="button" value="<?php echo $LDQuickList ?>" onClick="javascript:openQuicklist('drg_intern')">
 	<p><input type="button" value="<?php echo $LDConvert2IcdOps ?>" onClick="javascript:openRelatedCodes()"><p>
 	<p><input type="button" value="<?php echo $LDCreateNew ?>" onClick="javascript:checkCreateNew()"><p>
	</td>
	<?php }	 ?>
  </tr>
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<input type="hidden" name="opnr" value="<?php echo $opnr ?>">
<input type="hidden" name="pn" value="<?php echo $pn ?>">
<input type="hidden" name="ln" value="<?php echo $ln ?>">
<input type="hidden" name="fn" value="<?php echo $fn ?>">
<input type="hidden" name="bd" value="<?php echo $bd ?>">
<input type="hidden" name="display" value="<?php echo $display ?>">
<input type="hidden" name="group_nr" value="<?php echo $group_nr ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="is_discharged" value="<?php echo $is_discharged ?>">
<input type="hidden" name="main_code" value="<?php echo $main_code ?>">
<input type="hidden" name="mode" value="">

</form>
</FONT>
</FONT>
</BODY>
</HTML>
