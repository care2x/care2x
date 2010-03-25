<?php

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');

$lang_tables=array('departments.php');
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');

require_once($root_path.'include/care_api_classes/class_userconfig.php');
$user=new UserConfig;

//$db->debug=true;
if($user->getConfig($_COOKIE['ck_config'])){
	$config=&$user->getConfigData();
}else{
	$config=array();
}

/* Load the dept object */
require_once($root_path.'include/care_api_classes/class_department.php');
$dept=new Department;
$depts=&$dept->getAllActive();

// Load the ward object and wards info 
require_once($root_path.'include/care_api_classes/class_ward.php');
$ward_obj=new Ward;
$items='nr,ward_id,name, dept_nr'; // set the items to be fetched
$ward_info=&$ward_obj->getAllWardsItemsArray($items);


if(isset($mode)&&($mode=='save')){
	$config['thispc_dept_nr']=$_POST['thispc_dept_nr'];
	$config['thispc_ward_nr']=$_POST['thispc_ward_nr'];
	$config['thispc_room_nr']=$_POST['thispc_room_nr'];
	$config['thispc_phone']=$_POST['thispc_phone'];
	$config['thispc_intercom']=$_POST['thispc_intercom'];
	
	$user->saveConfig($_COOKIE['ck_config'],$config);
	
	header("location: login-pc-config.php?sid=$sid&lang=$lang&saved=1");
	exit;
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Toolbar title

 $smarty->assign('sToolbarTitle',$LDLogin);

 # hide the return button
 $smarty->assign('pbBack',FALSE);

# href for the  help button
 $smarty->assign('pbHelp',"javascript:gethelp('login_config.php')");

 $smarty->assign('breakfile','startframe.php'.URL_APPEND);

 # Window bar title
 $smarty->assign('title',$LDLogin);

 # Body onLoad js code
 $smarty->assign('sOnLoadJs','onLoad="window.parent.STARTPAGE.location.href=\'indexframe.php'.URL_REDIRECT_APPEND.'\'"');

 #
 # Prepare the top message
 #
 $smarty->assign('gifMascot',createMascot($root_path,'mascot1_r.gif','0','bottom'));
 if ($saved){
  	$smarty->assign('sPromptText',$LDChangeSaved);
 }else{
 	$smarty->assign('sPromptText',$LDWelcome);
 	$smarty->assign('sUserName',$_SESSION['sess_login_username']);
 }
 #
 # Prepare the config form block
 #
 $smarty->assign('sFormParams','name="pcids"  method="post" action="login-pc-config.php"');
 $smarty->assign('LDPcID',$LDPcID);

 $smarty->assign('sDeptIcon','<img '.createComIcon($root_path,'home.gif').'>');
 $smarty->assign('LDDept',$LDDept);
	
 $smarty->assign('sWardIcon','<img '.createComIcon($root_path,'statbel2.gif').'>');
 $smarty->assign('LDWard',$LDWard);
	
 $smarty->assign('sWardORIcon','<img '.createComIcon($root_path,'button_info.gif').'>');
 $smarty->assign('sWardORValue',$config['thispc_room_nr']);
 $smarty->assign('LDWardOR',$LDWardOR);

 $smarty->assign('sPhoneNrIcon','<img '.createComIcon($root_path,'profile.gif').'>');
 $smarty->assign('sPhoneNrValue',$config['thispc_phone']);
 $smarty->assign('LDPhoneNr',$LDPhoneNr);

 $smarty->assign('sIntercomNrIcon','<img '.createComIcon($root_path,'listen-sm-legend.gif').'>');
 $smarty->assign('sIntercomNrValue',$config['thispc_intercom']);
 $smarty->assign('LDIntercomNr',$LDIntercomNr);

 $smarty->assign('sIPAddressIcon','<img '.createComIcon($root_path,'lightning.gif').'>');
 $smarty->assign('sIPAddress',$_SERVER['REMOTE_ADDR']);
 $smarty->assign('LDPcIP',$LDPcIP);

#
# Print the user departments
#
//gjergji..new dept's management
$sTemp = '';
if($depts&&is_array($depts))
  while(list($x,$v)=each($depts))
   if(in_array($v['nr'],$_SESSION['department_nr']))
       if(isset($$v['LD_var'])&&$$v['LD_var']) $sTemp = $sTemp . '<b>' . $$v['LD_var'] . '</b><br>';
      	 else $sTemp = $sTemp . '<b>' . $v['name_formal'] . '</b><br>';
      				 
$smarty->assign('sDeptSelect',$sTemp);	
       	 	 
#
# Prepare the ward selector element
#
$sTemp = '';         
if($ward_info&&is_array($ward_info)){
	while(list($x,$v)=each($ward_info)){
  		 if(in_array($v['dept_nr'],$_SESSION['department_nr']))         			 
			$sTemp = $sTemp . '<b>' . $v['name'] . '</b><br>';
  		}
  	}
$smarty->assign('sWardSelect',$sTemp);
//gjergji : end new dept management

#
 # Prepare the submit option buttons
 #

 $smarty->assign('sSubmitFormButton','<input type="submit" value="'.$LDSave.'">');
 $smarty->assign('sNoChangeButton','<input type="button" value="'.$LDNoChange.'" onClick="window.location.href=\'startframe.php'.URL_REDIRECT_APPEND.'\'">');
 $smarty->assign('sCancelButton','<a href="startframe.php'.URL_APPEND.'"><img '.createLDImgSrc($root_path,'close2.gif','0','top').'  alt="'.$LDClose.'"></a>');
 
 #
 # Prepare the hidden inputs
 #
 $smarty->assign('sHiddenInputs','<input type="hidden" name="sid" value="'.$sid.'">
	<input type="hidden" name="lang" value="'.$lang.'">
	<input type="hidden" name="mode" value="save">');		 
 
 $smarty->assign('sMainBlockIncludeFile','main/login_config.tpl');
	 
#
# Prepare the hidden inputs
#
 $smarty->assign('sHiddenInputs','<input type="hidden" name="sid" value="'.$sid.'">
	<input type="hidden" name="lang" value="'.$lang.'">
	<input type="hidden" name="mode" value="save">');

 # Buffer page output

 /**
 * show Template
 */
//$smarty->compile_check = true;
//$smarty->debugging = true;
$smarty->display('common/mainframe.tpl');
//$smarty->display('debug.tpl');
?>