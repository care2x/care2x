<?php

/*------begin------ 
* This protection code was suggested by Luki R. luki@karet.org 
*/
if (stristr('inc_access.php',$PHP_SELF)) die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

//include('./class/class_xmlrpcaccess.php');
include($root_path.'include/care_api_classes/class_access.php');
$access = & new Access();
//$permitarea='System_Admin';
//$permitarea='_a_1_techreception';

$permitarea='_a_1_hxpserver';

$error=array();

function checkAccess($data){

	global $access,$error,$permitarea;
	if(!is_array($data)) {
		$error['code']=1000;
		$error['msg']='_ERROR_AUTH_BADHEADER';
		return FALSE;
		return new IXR_Error(1000,'_ERROR_AUTH_BADHEADER');
	}
	$access->loadAccess($data['usr'],$data['pw']);
	
	if($access->isKnown()){
		if($access->hasValidPassword()){
			if($access->isNotLocked()){
				if($access->isPermitted($permitarea)){
					$error['code']=FALSE;
					return TRUE;
				}else{
					$error['code']=1003;
					$error['msg']='_ERROR_AUTH_AREA';
					return FALSE;
				}
			}else{
				$error['code']=1004;
				$error['msg']='_ERROR_AUTH_LOCKED';
				return FALSE;
			}
		}else{
			$error['code']=1002;
			$error['msg']='_ERROR_AUTH_PW';
			return FALSE;
		}
	}else{
		$error['code']=1001;
		$error['msg']='_ERROR_AUTH_USER';
		return FALSE;
	}
}
?>
