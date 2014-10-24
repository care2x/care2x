<?php
$returnfile=$_SESSION['sess_file_return'];

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$page_title);

  # hide back button
 $smarty->assign('pbBack',$returnfile.URL_APPEND.'&pid='.$_SESSION['sess_pid'].'&target='.$target.'&mode=show&type_nr='.$type_nr);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('dicom_upload.php','$rows')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$page_title);

 # Create select viewer button

 $smarty->assign('pbAux1',"javascript:popSelectDicomViewer('$sid','$lang')");
 $smarty->assign('gifAux1',createLDImgSrc($root_path,'select_viewer.gif','0'));

 # Collect extra javascript code

 ob_start();


//$_SESSION['sess_file_return']=$thisfile;

function createTR($ld_text, $input_val, $colspan = 1)
{
    global $toggle, $root_path;
?>

<tr>
<td bgColor="#eeeeee" ><FONT SIZE=-1  FACE="Arial,verdana,sans serif"><?php echo $ld_text ?>:
</td>
<td colspan=<?php echo $colspan; ?> bgcolor="#ffffee"><FONT SIZE=-1  FACE="Arial,verdana,sans serif"><?php echo $input_val; ?>
</td>
</tr>

<?php

$toggle=!$toggle;

}

?>

<script  language="javascript">
<!-- 

<?php require($root_path.'include/core/inc_checkdate_lang.php'); ?>

function popRecordHistory(table,pid) {
	urlholder="./record_history.php<?php echo URL_REDIRECT_APPEND; ?>&table="+table+"&pid="+pid;
	HISTWIN<?php echo $sid ?>=window.open(urlholder,"histwin<?php echo $sid ?>","menubar=no,width=400,height=550,resizable=yes,scrollbars=yes");
}
function chkform(d) {
	var r=false;
	for(i=0; i<<?php echo $maxpic ?>;i++){
		eval("if(d.f"+i+".value!=''){ r=true;}");
	}
	if(r) return true;
		else return false;
}

function popDicom(nr){
<?php
	if($cfg['dhtml'])
	{
	echo 'w=window.parent.screen.width;
			h=window.parent.screen.height;
			';
	}
	else echo 'w=800;
					h=600;
					';
?>
dicomwin<?php echo $sid ?>=window.open("dicom_launch.php<?php echo URL_REDIRECT_APPEND ?>&pop_only=1&saved=1&img_nr="+nr,"dicomwin<?php echo $sid ?>","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60) );
<?php if($cfg['dhtml']) echo '
	window.dicomwin'.$sid.'.moveTo(0,0);'; ?>
	
}

function popDicomSingle(fn){
<?php
	if($cfg['dhtml'])
	{
	echo 'w=window.parent.screen.width;
			h=window.parent.screen.height;
			';
	}
	else echo 'w=800;
					h=600;
					';
?>
dicomwin<?php echo $sid ?>=window.open("dicom_launch_single.php<?php echo URL_REDIRECT_APPEND ?>&pop_only=1&saved=1&pid=<?php echo $pid ?>&img_nr=<?php echo $nr ?>&fn="+fn,"dicomwin<?php echo $sid ?>","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=" + (h-60) );
<?php if($cfg['dhtml']) echo '
	window.dicomwin'.$sid.'.moveTo(0,0);'; ?>
	
}

// -->

</script>

<script language="javascript" src="<?php echo $root_path; ?>js/dicom.js"></script>

<?php 
$sTemp = ob_get_contents();

ob_end_clean();

$smarty->append('JavaScript',$sTemp);

ob_start();

?>

<table width=100% border=0 cellspacing="0"  cellpadding=0 >

	<form method="post" name="entryform"  ENCTYPE="multipart/form-data"  action="<?php echo $thisfile; ?>" onSubmit="return chkform(this)">

<?php
/* Create the tabs */

require('./gui_bridge/default/gui_tabs_upload.php');

?>
	<tr>
		<td colspan=3   bgcolor="<?php echo $cfg['body_bgcolor']; ?>">

			<table border=0 cellspacing=1 cellpadding=0>
				<tr bgcolor="#ffffff">
				<td colspan=3 valign="top">
<?php

$smarty->assign('sClassItem','class="reg_item"');
$smarty->assign('sClassInput','class="reg_input"');

$smarty->assign('LDCaseNr',$LDPID);

$smarty->assign('sEncNrPID',$pid);

$smarty->assign('img_source',"<img $img_source>");

$smarty->assign('LDTitle',$LDTitle);
$smarty->assign('title',$title);
$smarty->assign('LDLastName',$LDLastName);
$smarty->assign('name_last',$name_last);
$smarty->assign('LDFirstName',$LDFirstName);
$smarty->assign('name_first',$name_first);

# If person is dead show a black cross and assign death date

if($death_date && $death_date != DBF_NODATE){
	$smarty->assign('sCrossImg','<img '.createComIcon($root_path,'blackcross_sm.gif','0').'>');
	$smarty->assign('sDeathDate',@formatDate2Local($death_date,$date_format));
}

	# Set a row span counter, initialize with 7
	$iRowSpan = 7;

	if($GLOBAL_CONFIG['patient_name_2_show']&&$name_2){
		$smarty->assign('LDName2',$LDName2);
		$smarty->assign('name_2',$name_2);
		$iRowSpan++;
	}

	if($GLOBAL_CONFIG['patient_name_3_show']&&$name_3){
		$smarty->assign('LDName3',$LDName3);
		$smarty->assign('name_3',$name_3);
		$iRowSpan++;
	}

	if($GLOBAL_CONFIG['patient_name_middle_show']&&$name_middle){
		$smarty->assign('LDNameMid',$LDNameMid);
		$smarty->assign('name_middle',$name_middle);
		$iRowSpan++;
	}

$smarty->assign('sRowSpan',"rowspan=\"$iRowSpan\"");

$smarty->assign('LDBday',$LDBday);
$smarty->assign('sBdayDate',@formatDate2Local($date_birth,$date_format));

$smarty->assign('LDSex',$LDSex);
if($sex=='m') $smarty->assign('sSexType',$LDMale);
	elseif($sex=='f') $smarty->assign('sSexType',$LDFemale);

$smarty->assign('LDBloodGroup',$LDBloodGroup);
if($blood_group){
	$buf='LD'.$blood_group;
	$smarty->assign('blood_group',$$buf);
}

$smarty->display('registration_admission/basic_data.tpl');
?>

					<table border=0 width=100% cellspacing=1 cellpadding=3>



<?php
# Show input elements for additional info
if($mode=='new'){
?>
<tr>
<td colspan=3><img <?php  echo createComIcon($root_path,'warn.gif','0') ?>> &nbsp;<FONT SIZE=-1  FACE="Arial"><?php  echo $LDEnterRelatedInfo ?>: 
</td>
</tr>
<tr>
<td bgColor="#eeeeee" ><FONT SIZE=-1  FACE="Arial"><nobr><?php  echo $LDRelatedEncNr ?>:</nobr>
</td>
<td bgcolor="#ffffee"  colspan=2><input type="text" name="encounter_nr" size=11 maxlength=11>
</td>
</tr>
<tr>
<td bgColor="#eeeeee" ><FONT SIZE=-1  FACE="Arial"><nobr><?php  echo $LDRelatedDocsIds ?>:</nobr><br><FONT SIZE=1  FACE="Arial"><?php  echo $LDSeparateComma ?></font><br>
</td>
<td bgcolor="#ffffee" colspan=2><input type="text" name="doc_ref_ids" size=40 maxlength=40>
</td>
</tr>
<tr>
<td bgColor="#eeeeee" ><FONT SIZE=-1  FACE="Arial"><nobr><?php  echo $LDNotes ?>:</nobr><br>
</td>
<td bgcolor="#ffffee" colspan=2>
<textarea name="notes" cols=40 rows=3></textarea>
</td>
</tr>
<?php
}
?>
</table>


<?php
if($mode=='show'){
	if($rows){
		$bgimg='tableHeaderbg3.gif';
		//$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/'.$bgimg.'"';
		$tbg='class="adm_list_titlebar"';
		$img_arrow=createComIcon($root_path,'bul_arrowblusm.gif','0','absmiddle'); // Load the torse icon image
		$img_download=createComIcon($root_path,'dwnarrowgrnlrg.gif','0'); // Load the download icon image
		if(!$pop_only) $img_torso=createComIcon($root_path,'torso.gif','0'); // Load the torse icon image
		$img_torsowin=createComIcon($root_path,'torso_win.gif','0'); // Load the torse icon image
		$img_pix=createComIcon($root_path,'pixel.gif','0'); // Load the torse icon image
?>

<table border=0 cellpadding=4 cellspacing=1 width=100%>
  <tr bgcolor="#f6f6f6">
    <td  colspan=5><FONT class="prompt"><nobr><?php echo $LDImageGroupNr; ?><?php echo $nr ?>&nbsp;
<?php 
		if(!$pop_only){
?>
	<a href="<?php echo "dicom_launch.php".URL_APPEND."&saved=1&img_nr=$nr" ?>" title="<?php echo "$LDViewImage ($LDViewInFrame)" ?>"><img <?php echo $img_torso ?>></a> &nbsp;
<?php 
		}
?>
	<a href="javascript:popDicom('<?php echo $nr ?>')" title="<?php echo "$LDViewInWindow ($LDFullScreen)" ?>"><img <?php echo $img_torsowin ?>></a></nobr></td>
  </tr>
  <tr bgcolor="#f6f6f6">
    <td <?php echo $tbg; ?>><nobr><?php echo $LDImgNumber; ?></nobr></td>
    <td <?php echo $tbg; ?>><nobr><?php echo $LDNewFileName; ?></nobr></td>
    <td <?php echo $tbg; ?>><nobr><?php echo $LDDownload ?></nobr></td>
<?php 
		if(!$pop_only){
?>
    <td <?php echo $tbg; ?>><nobr><?php echo "$LDViewImage ($LDSingleImage)" ?></nobr></td>
<?php 
		}
?>
    <td <?php echo $tbg; ?>><nobr><?php echo "$LDViewInWindow ($LDSingleImage)" ?></nobr></td>
  </tr>
<?php

		$i=1;

		while(list($x,$v)=each($files)){

			echo'
		 		<tr>
    			<td class="v12" align=center>&nbsp;'.$i.'&nbsp;</td>
    			<td class="v12">&nbsp;'.$v.'&nbsp;</td>
				<td class="v12" align=center><a href="'.$root_path.'uploads/radiology/dicom_img/'.$pid.'/'.$nr.'/'.$v.'" title="'.$LDDownload.'"><img '.$img_download.'></a></td>';
			if(!$pop_only) echo '
    			<td class="v12" align=center><a href="dicom_launch_single.php'.URL_APPEND.'&pid='.$pid.'&img_nr='.$nr.'&fn='.$v.'" title="'.$LDViewInFrame.'"><img '.$img_torso.'></a></td>';
			echo '
    			<td class="v12" align=center><a href="javascript:popDicomSingle(\''.$v.'\')" title="'.$LDFullScreen.'"><img '.$img_torsowin.'></a></td>
  			</tr>
  			';
  			$i++;
		}
?>
</table>

<?php	
	}else{
?>

<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot2_r.gif','0','absmiddle') ?>></td>
    <td><font class="warnprompt">
	<?php 
		echo $LDNoImageSaved;
	?></font></td>
  </tr>
</table>
<?php
	}
}elseif($mode=='details'){


# Create a new form
}else {
?>

<INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="8000000">

<table border=0>
  <tr>
    <td><FONT class="vi_data"><?php echo $LDImgNumber; ?></td>
    <td></td>
    <td></td>
  </tr>

 <?php

for($i=0;$i<$maxpic;$i++){
	echo  '<tr><td align=center>'.($i+1).'
				</td><td><input type="file" name="f'.$i.'" size=40></td>
			    <td></td>
			  </tr>';
}
?>
   
    
</table>

<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="maxpic" value="<?php echo $maxpic; ?>">
<input type="hidden" name="pid" value="<?php echo $_SESSION['sess_pid']; ?>">
<!-- <input type="hidden" name="modify_id" value="<?php echo $_SESSION['sess_user_name']; ?>">
<input type="hidden" name="create_id" value="<?php echo $_SESSION['sess_user_name']; ?>">
<input type="hidden" name="create_time" value="null">
 -->
 <input type="hidden" name="mode" value="create">
<input type="hidden" name="target" value="<?php echo $target; ?>">
<input type="hidden" name="edit" value="<?php echo $edit; ?>">

<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>>


<!-- <input type="hidden" name="is_discharged" value="<?php echo $is_discharged; ?>">
<input type="hidden" name="history" value="Created: <?php echo date('Y-m-d H:i:s'); ?> : <?php echo $_SESSION['sess_user_name']."\n"; ?>">
 -->
<?php
} 


?>
</td>
<!-- Load the options table  -->
<td rowspan=2  valign="top">
&nbsp;
</td>
</tr>

</table>
<p>

<?php 
if($parent_admit) {
	include('./include/bottom_controls_admission_options.inc.php');
}else{
	include('./include/bottom_controls_registration_options.inc.php');
}
?>

<p>
</ul>

</form>

<form>
&nbsp;<?php echo $LDUploadNew; ?>&nbsp;
<input type="text" name="maxpic" size=3 maxlength=2 value="<?php echo $maxpic; ?>">
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="pid" value="<?php echo $pid; ?>"> <?php echo $LDNewImageFiles; ?>.
<input type="submit" value="Go">

</form>

<p>
</td>
</tr>
</table>       

<p>
&nbsp;
<p>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign to page template object
$smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

 ?>
