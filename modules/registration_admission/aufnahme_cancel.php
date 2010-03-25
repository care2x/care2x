<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');

//$db->debug=true;

/**
* CARE2X Integrated Hospital Information System beta 2.0.1 - 2004-07-04
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','prompt.php');
$local_user='aufnahme_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
# Do some filtering
if(isset($mode)&&($mode=='cancel')&&isset($encounter_nr)&&$encounter_nr){

	include_once($root_path.'include/care_api_classes/class_access.php');
	# Create user access object
	$user=& new Access($cby,$pw);

	if($user->isKnown()&&$user->hasValidPassword()&&$user->isNotLocked()){
		$is_cancelled=0;
		include_once($root_path.'include/care_api_classes/class_encounter.php');
		$encounter=new Encounter;
		//if($encounter->Cancel($encounter_nr,$cby)){
		if($encounter->Cancel($encounter_nr,$user->Name())){
			header("location:".basename(__FILE__).URL_REDIRECT_APPEND."&is_cancelled=1");
			exit;
		}else{
			echo $LDDbNoSave.'<p>'.$encounter->getLastQuery();
		}
	}else{
		$error_msg=$LDWrongLoginPW;
	}
}elseif(!isset($is_cancelled)||!$is_cancelled){
	header("location:aufnahme_daten_zeigen.php".URL_REDIRECT_APPEND."&encounter_nr=$encounter_nr");
	exit;
}else{
	$error_msg=$LDTellEdpIfPersist;
}
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE></TITLE>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0   bgcolor=<?php echo $cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<?php
if(isset($is_cancelled)&&$is_cancelled){
?>
<table border=0 align=center>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0'); ?>></td>
    <td><font size=4 face="verdana,arial" color="#006600"><?php echo $LDAdmissionCancelled; ?></font></td>
  </tr>
  <tr>
    <td></td>
    <td align=center>
	<form action="aufnahme_start.php" method="post">
	 <input type="hidden" name="sid" value="<?php echo $sid ?>">
 	<input type="hidden" name="lang" value="<?php echo $lang ?>">
	<input type="submit" value="<?php echo $LDOk ?>">
 	</form>
	</td>
  </tr>
</table>

<?php
}else{ # something wrong happened
?>
<table border=0 align=center>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0'); ?>></td>
    <td><font size=4 face="verdana,arial" color="red"><?php echo "$LDCancelError<br>$error_msg"; ?></td>
  </tr>
  <tr>
    <td></td>
    <td align=center>
	<form action="aufnahme_daten_zeigen.php" method="post">
	 <input type="hidden" name="sid" value="<?php echo $sid ?>">
 	<input type="hidden" name="lang" value="<?php echo $lang ?>">
 	<input type="hidden" name="encounter_nr" value="<?php echo $encounter_nr ?>">
	<input type="submit" value="<?php echo $LDOk ?>">
 	</form>
	</td>
  </tr>
</table>

<?php
}
?>
</BODY>
</HTML>
