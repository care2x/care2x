<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr('inc_passcheck.php',$PHP_SELF))
die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

require_once($root_path.'include/core/access_log.php');
$logs = new AccessLog();
/**
 * CARE 2002 Integrated Hospital Information System
 * GNU General Public License
 * Copyright 2002 Elpidio Latorilla
 * elpidio@care2x.org,
 *
 * See the file "copy_notice.txt" for the licence notice
 */


function validarea(&$zeile2, $permit_type_all = 1){
	global $allowedarea;

	if(ereg('System_Admin', $zeile2)){  // if System_admin return true
		return 1;
	}elseif(in_array('no_allow_type_all', $allowedarea)){ // check if the type "all" is blocked, if so return false
		return 0;
	}elseif($permit_type_all && ereg('_a_0_all', $zeile2)){ // if type "all" , return true
		return 1;
	}else{
		// else scan the permission
		for($j=0;$j<sizeof($allowedarea);$j++){
			if(ereg($allowedarea[$j],$zeile2)) return 1;
		}
	}
	return 0;           // otherwise the user has no access permission in the area, return false
}


/*if(!isset($db) || !$db || !$dblink_ok) include_once($root_path.'include/core/inc_db_makelink.php');

if($dblink_ok)
{*/
$sql='SELECT name, login_id, password, permission, lockflag FROM care_users WHERE login_id=\''.addslashes($userid).'\'';

if($ergebnis=$db->Execute($sql))
{
	$zeile=$ergebnis->FetchRow();

	if(isset($checkintern)&&$checkintern)
	{
		$dec_login = new Crypt_HCEMD5($key_login,'');
		//$keyword = $dec_login->DecodeMimeSelfRand($_COOKIE['ck_login_pw'.$sid]);
		$keyword = $dec_login->DecodeMimeSelfRand($_SESSION['sess_login_pw']);
	}else{
		$checkintern=false;
	}

	if (($zeile['password']==md5($keyword))&&($zeile['login_id']==$userid))
	{
		if (!($zeile['lockflag']))
		{
			if ((isset($screenall)&&$screenall) || validarea($zeile['permission']))
			{
				if(empty($zeile['name'])) $zeile['name']=' ';
					
				if($passtag) $success = 0;
				else $success = 1;
				$logs->writeline(date('Y-m-d').'/'.date('H:i'),$_SERVER['REMOTE_ADDR'],$lognote,$userid,$zeile['name'],'',$thisfile,$fileforward,$success);
				/**
					* Init crypt to use 2nd level key and encrypt the sid.
					* Store to cookie the "$ck_2level_sid.$sid"
					* There is no need to call another include of the inc_init_crypt.php since it is already included at the start
					* of the script that called this script.
					*/
				$enc_2level = new Crypt_HCEMD5($key_2level, makeRand());
				$ciphersid=$enc_2level->encodeMimeSelfRand($sid);
				//setcookie('ck_2level_sid'.$sid,$ciphersid,time()+3600,'/');
				//setcookie($userck.$sid,$zeile['name'],time()+3600,'/');
				setcookie('ck_2level_sid'.$sid,$ciphersid,0,'/');
				setcookie($userck.$sid,$zeile['name'],0,'/');
				//setcookie('ck_2level_sid'.$sid,$ciphersid);
				//setcookie($userck.$sid,$zeile['name']);
				//echo $fileforward;
				$_SESSION['sess_user_name']=$zeile['name'];

				header('Location:'.strtr($fileforward,' ','+').'&checkintern='.$checkintern);
				exit;
			}else {$passtag=2;};
		}else $passtag=3;
	}else {$passtag=1;};
}
else {$passtag=1;};
/*}
 else  print "$LDDbNoLink<br>";*/
?>
