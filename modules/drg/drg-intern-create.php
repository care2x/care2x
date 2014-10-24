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
define('LANG_FILE','drg.php');

require_once('drg_inc_local_user.php');

if (!$pn) {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php?mode=close"); exit;}; 

require_once($root_path.'include/core/inc_front_chain_lang.php');

//$db->debug=true;

if(!isset($saveok)) $saveok=false;
if(!isset($mode)) $mode='';
if(!isset($non_grouped)) $non_grouped=false;


require_once($root_path.'include/care_api_classes/class_template.php');
$tp_obj = new Template($root_path,$template_path,$template_theme);

require_once($root_path.'include/care_api_classes/class_drg.php');
$DRG_obj = new DRG($pn);

$toggle=0;

$thisfile=basename(__FILE__);

if(isset($mode)){
	/* Prepare the common data */
	$_POST['history']="Create ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n";
	//$_POST['modify_id']=$_SESSION['sess_user_name'];
	$_POST['create_id']=$_SESSION['sess_user_name'];
	$_POST['create_time']=date('YmdHis');

	switch($mode){
	
		case 'save':
		{
			$DRG_obj->useInternalDRGCodes(); // Set the core variables
			$DRG_obj->setDataArray($_POST); // transfer the data
			if($DRG_obj->insertDataFromInternalArray()){
				$oid=$db->Insert_ID(); // Get the insert ID
				$group_nr=$DRG_obj->LastInsertPK('nr',$oid);
				$saveok=true;
				//header("location:$thisfile?sid=$sid&lang=$lang&saveok=1&pn=$pn&opnr=$opnr&group_nr=$group_nr&ln=$ln&fn=$fn&bd=$bd&dept_nr=$dept_nr&oprm=$oprm&y=$y&m=$m&d=$d&display=$display&target=$target");
				//exit;
			}else{
				$saveok=false;
			}
			break;
		}
		case 'linkgroup':
		{
			if(!$DRG_obj->EncounterDRGGroupExists($group_nr)){
				$DRG_obj->useInternalDRG(); // Set the core variables to encounter DRG table
				$_POST['clinician']=$_SESSION['sess_user_name'];
				$_POST['encounter_nr']=$pn;
				$_POST['date']=date('Y-m-d H:i:s');
				$DRG_obj->setDataArray($_POST); // transfer the data
				if($DRG_obj->insertDataFromInternalArray()){
					$DRG_obj->groupNonGroupedItems($group_nr);
					$saveok=true;
				}
				exit;
			}
		}
	}
}

if($saveok&&$mode=='linkgroup'){
?>

    <script language="javascript" >
    window.opener.parent.location.replace('drg-composite-start.php?sid=<?php echo "$sid&lang=$lang&pn=$pn&opnr=$opnr&group_nr=$group_nr&edit=$edit&ln=$ln&fn=$fn&bd=$bd&dept_nr=$dept_nr&oprm=$oprm&y=$y&m=$m&d=$d&display=composite&newsave=1"; ?>');
    //window.opener.parent.INTERN.location.reload();
    window.close();
   </script>
 <?php
	exit; 
}
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE><?php echo $LDCreateInternDRGGroup ?></TITLE>
  <script language="javascript" src="../js/showhide-div.js">
</script>
  <script language="javascript">
<!-- 
function checkform(d)
{
	if(d.code.value==""){
		alert("<?php echo $LDAlertNoCode ?>");
		d.code.focus();
		return false;
	}else if(d.description.value==""){
		alert("<?php echo $LDAlertNoDescription ?>");
		d.description.focus();
		return false;
	}else{
		return true;
	}
}
// -->
</script>
 
  <?php 
require($root_path.'include/core/inc_css_a_hilitebu.php');
?>
 
</HEAD>

<BODY   onLoad="if(window.focus) window.focus();" bgcolor="<?php echo $cfg['body_bgcolor']; ?>"
<?php if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>


<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> align="right"></a>

<FONT    SIZE=3  FACE="Arial" color="maroon">
<b><?php echo $LDCreateInternDRGGroup ?></b>
</FONT>

<ul>

<p>

<form name="new_intern_drg" <?php if(!$saveok) echo 'onSubmit="return checkform(this)"'; ?> method="post">
<?php
if($saveok){
	# Convert new lines to <br>
	$description=nl2br($description);
	$synonyms=nl2br($synonyms);
	$notes=nl2br($notes);
	# Resolve sub-group radio button value to text
	if($sub_level) $TP_radio_value=$LDYes;
		else $TP_radio_value=$LDNo;
	
	if($non_grouped){
		# Create the submit button
		$TP_submit_src=$LDUseToGroupItems;
	}else{
		$TP_submit_src=$LDAddGroupEncounter;
	}
	
	# Load the template
	$tp=&$tp_obj->load('drg/tp_drg_group_create_show.htm');
}else{
	// Create the submit button
	$TP_submit_src=createLDImgSrc($root_path,'savedisc.gif','0');
	# Load the template
	$tp=&$tp_obj->load('drg/tp_drg_group_create.htm');
}
eval("echo $tp;");
?>

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
 
</form>

</ul>

</BODY>
</HTML>
