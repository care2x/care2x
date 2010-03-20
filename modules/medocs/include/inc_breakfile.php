<?php
#------begin------ This protection code was suggested by Luki R. luki@karet.org
if (eregi('inc_drg_entry_save.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../../">');
#------end

if($_SESSION['sess_user_origin']=='admission') {
	$breakfile=$root_path.'modules/registration_admission/aufnahme_daten_zeigen.php'.URL_APPEND.'&encounter_nr='.$_SESSION['sess_en'];
}elseif($_SESSION['sess_user_origin']=='registration'){
	$breakfile=$root_path.'modules/registration_admission/show_medocs.php'.URL_APPEND.'&pid='.$_SESSION['sess_pid'];
}elseif($_COOKIE['ck_login_logged'.$sid]){
	$breakfile=$root_path.'main/startframe.php';
}else{
	$breakfile='medocs_pass.php';
}

# Patch for break urls that have lang param already

if(!stristr($breakfile,'lang=')) $breakfile.=URL_APPEND;
?>
