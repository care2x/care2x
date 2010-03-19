<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi('inc_passcheck_mask.php',$PHP_SELF))
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

$bShowThisPage = FALSE;

#
# Create a smarty object if it is not yet available, without initializing the gui
#
if(!isset($smarty) || !is_object($smarty)){
	$bShowThisPage = TRUE;
	require_once($root_path.'gui/smarty_template/smarty_care.class.php');
	$smarty = new smarty_care('common',FALSE);
}

#
# If authentication error, show prompt
#
if (isset($pass)&&($pass=='check')&&($passtag)){

	switch($passtag){
		case 1:$errbuf="$errbuf $LDWrongEntry";
					$err_msg="<div class=\"warnprompt\">$LDWrongEntry</div><br>$LDPlsTryAgain";
					//echo '<img '.createLDImgSrc($root_path,'cat-fe.gif','0','left').'>';
					break;
		case 2:$errbuf="$errbuf $LDNoAuth";
					$err_msg="<div class=\"warnprompt\">$LDNoAuth</div><br>$LDPlsContactEDP";
					//echo '<img '.createLDImgSrc($root_path,'cat-noacc.gif','0','left').'>';
					break;
		default:$errbuf="$errbuf $LDAuthLocked";
					$err_msg="<div class=\"warnprompt\">$LDAuthLocked</div><br>$LDPlsContactEDP";
					//echo '<img '.createLDImgSrc($root_path,'cat-sperr.gif','0','left').'>';
	}
	#
	# Log auth attempt
	#
	$logs->writeline(date('Y-m-d').'/'.date('H:i'),$REMOTE_ADDR,$errbuf,$userid,'',$keyword,$thisfile,$fileforward,'0');
	
	$smarty->assign('bShowErrorPrompt',TRUE);

	$smarty->assign('sMascotImg','<img '.createMascot($root_path,'mascot1_r.gif','0').'>');
	$smarty->assign('sErrorMsg',$err_msg);
}

if(!$passtag) $smarty->assign('sMascotColumn','<td><img '.createMascot($root_path,'mascot3_r.gif','0').'></td>');

#
# Prepare the auth entry form elements
#
$smarty->assign('sPassFormParams','action="'.$thisfile.'" method="post" name="passwindow" onSubmit="return pruf(this);"');
$smarty->assign('LDPwNeeded',$LDPwNeeded);
$smarty->assign('LDUserPrompt',$LDUserPrompt);
$smarty->assign('LDPwPrompt',$LDPwPrompt);

#
# Prepare the hidden inputs
#
$sHiddenTemp = '<input type=hidden name=direction value="'.$direction.'">
<input type=hidden name="pass" value="check">
<input type="hidden" name="nointern" value="1">
<input type="hidden" name="lang" value="'.$lang.'">
<input type="hidden" name="mode" value="'.$mode.'">
<input type="hidden" name="target" value="'.$target.'">
<input type="hidden" name="subtarget" value="'.$subtarget.'">
<input type="hidden" name="user_origin" value="'.$user_origin.'">
<input type="hidden" name="title" value="'.$title.'">
<input type="hidden" name="fwd_nr" value="'.$fwd_nr.'">';

if($not_trans_id) {
	$sHiddenTemp = $sHiddenTemp.'<input type="hidden" name="sid" value="'.$sid.'">';
} 

if(!isset($minimal) || !$minimal) { 

	$sHiddenTemp = $sHiddenTemp.'
	<input type="hidden" name="dept" value="'.$dept.'">
	<input type="hidden" name="dept_nr" value="'.$dept_nr.'">
	<input type="hidden" name="retpath" value="'.$retpath.'">
	<input type="hidden" name="edit" value="'.$edit.'">
	<input type="hidden" name="pmonth" value="'.$pmonth.'">
	<input type="hidden" name="pyear" value="'.$pyear.'">
	<input type="hidden" name="pday" value="'.$pday.'">
	<input type="hidden" name="station" value="'.$station.'">
	<input type="hidden" name="ward_nr" value="'.$ward_nr.'">
	<input type="hidden" name="ipath" value="'.$ipath.'">';
}

if(isset($c_flag)&&$c_flag) {
	$sHiddenTemp = $sHiddenTemp.'
	<input type="hidden" name="cmonth" value="'.$cmonth.'">
	<input type="hidden" name="cyear" value="'.$cyear.'">
	<input type="hidden" name="cday" value="'.$cday.'">';
}

$smarty->assign('sPassHiddenInputs',$sHiddenTemp);

$smarty->assign('sPassSubmitButton','<INPUT type="image"  '.createLDImgSrc($root_path,'continue.gif','0').'>');
$smarty->assign('sCancelButton','<a href="'.$breakfile.'"><img '.createLDImgSrc($root_path,'cancel.gif','0').'></a>');

#
# Display this page if necessary
#
if($bShowThisPage) $smarty->display('main/passcheck_entry_mask.tpl');
?>