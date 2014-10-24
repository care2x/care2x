<?php

if($_SESSION['sess_user_origin']=='admission') {
	$breakfile=$root_path.'modules/registration_admission/aufnahme_daten_zeigen.php'.URL_APPEND.'&encounter_nr='.$_SESSION['sess_en'];
	$local_user='aufnahme_user';
}elseif($_SESSION['sess_user_origin']=='registration'){
	$breakfile=$root_path.'modules/registration_admission/patient_register_show.php'.URL_APPEND.'&pid='.$_SESSION['sess_pid'];
	$local_user='aufnahme_user';
}else{
	$breakfile='medocs_pass.php';
	$local_user='medocs_user';
}
?>
