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
define('LANG_FILE','');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_core.php');
$core = & new Core;

$m=date('m');
$y=date('Y');
$m=$m+3;
if($m>12){
	$m=$m-12;
	$y++;
}

if($m<10) $m='0'.$m;

$xd="$y-$m-".date('d');
						
$sql="UPDATE care_users SET	password='".md5($n)."', expire_date='$xd'  WHERE login_id='$userid'";
							
if($core->Transact($sql)){
	//echo "ok";
	header("location:my-passw-change.php?sid=$sid&lang=$lang&mode=pwchg");
	exit;
}else{
	echo "$sql<br>$LDDbNoSave";
}

header ("location:my-passw-change.php?sid=$sid&lang=$lang&userid=$userid&keyword=$keyword");
exit;
?>
