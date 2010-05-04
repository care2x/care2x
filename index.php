<?php
/*
CARE 2X Integrated Information System for Hospitals and Health Care Organizations and Services
Care 2002, Care2x, Copyright (C) 2002,2003,2004,2005,2006  Elpidio Latorilla

Deployment 2.2 - 2006-07-10
								
This script(s) is(are) free software; you can redistribute it and/or
modify it under the terms of the GNU General Public
License as published by the Free Software Foundation; either
version 2 of the License, or (at your option) any later version.
																  
This software is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
General Public License for more details.
											   
You should have received a copy of the GNU General Public
License along with this script; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
																		 
Copy of GNU General Public License at: http://www.gnu.org/
													 
Source code home page: http://www.care2x.org
Contact author at: elpidio@care2x.org

This notice also applies to other scripts which are integral to the functioning of CARE 2X within this directory and its top level directory
A copy of this notice is also available as file named copy_notice.txt under the top level directory.
*/
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
define('FROM_ROOT',1);

if(!isset($mask)) $mask=false;
if(!isset($cookie)) $cookie=false;
if(!isset($_chg_lang_)) $_chg_lang_=false;
if(!isset($boot)) $boot=false;
if(!isset($sid)) $sid='';

require('./roots.php');
require('./include/core/inc_environment_global.php');

//$db->debug=FALSE;

# Register global session variables
if(!session_is_registered('sess_user_name')) session_register('sess_user_name');
if(!session_is_registered('sess_user_origin')) session_register('sess_user_origin');
if(!session_is_registered('sess_file_forward')) session_register('sess_file_forward');
if(!session_is_registered('sess_file_return')) session_register('sess_file_return');
if(!session_is_registered('sess_file_break')) session_register('sess_file_break');
if(!session_is_registered('sess_path_referer')) session_register('sess_path_referer');
if(!session_is_registered('sess_dept_nr')) session_register('sess_dept_nr');
if(!session_is_registered('sess_title')) session_register('sess_title');
if(!session_is_registered('sess_lang')) session_register('sess_lang');
if(!session_is_registered('sess_user_id')) session_register('sess_user_id');
if(!session_is_registered('sess_cur_page')) session_register('sess_cur_page');
if(!session_is_registered('sess_searchkey')) session_register('sess_searchkey');
if(!session_is_registered('sess_tos')) session_register('sess_tos'); # the session time out start time

$bname='';
$bversion='';
$user_id='';
$ip='';
$cfgid='';
$config_exists=false;

$GLOBALCONFIG=array();
$USERCONFIG=array();

/****************************************************************************
 phpSniff: HTTP_USER_AGENT Client Sniffer for PHP
 Copyright (C) 2001 Roger Raymond ~ epsilon7@users.sourceforge.net

* Check environment : Browser, OS
* @param string $bn  name of browser
* @param string $bv  version of browser
* @param string $f   CFG filename
* @param string $i   IP adress
* @param string $uid new guid (session var)
* @return all parameter using &
* @access public
*
* 02.02.2003 Thomas Wiedmann
****************************************************************************
*/

require_once('./classes/phpSniff/phpSniff.class.php'); # Sniffer for PHP

function configNew(&$bn,&$bv,&$f,$i,&$uid)
{
  global $HTTP_USER_AGENT;
  global $REMOTE_ADDR;

  # We disable the error reporting, because Konqueror 3.0.3 causes a  runtime error output that stops the program.
  #  could be a bug in phpsniff .. hmmm?
  $old_err_rep= error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
  
  # Function rewritten by Thomas Wiedmann to use phpSniff class
  
  # initialize some vars
  if(!isset($UA)) $UA = '';
  if(!isset($cc)) $cc = '';
  if(!isset($dl)) $dl = '';
  if(!isset($am)) $am = '';

  //$timer = new phpTimer();
  //$timer->start('main');
  //$timer->start('client1');
  $sniffer_settings = array('check_cookies'=>$cc,'default_language'=>$dl,'allow_masquerading'=>$am);
  $client = new phpSniff($UA,$sniffer_settings);

  # get phpSniff result
  $i=$client->get_property('ip');
  $bv=$client->get_property('version');
  $bn=$client->get_property('browser');

  # translate some browsernames for "Care2x"
  if ($bn == 'moz') { $bn='mozilla';}
  else if ($bn == 'op') { $bn='opera';}
  else if ($bn == 'ns') { $bn='netscape';}
  else if ($bn == 'ie') { $bn='msie';}

  $uid=uniqid('');
  $f='CFG'.$uid.microtime().'.cfg';

   # Return previous error reporting 
   error_reporting($old_err_rep);
}

/**
* Create simple session id (sid), save a encrpyted  sid to a cookie with a dynamic name 
* consisting of concatenating "ck_sid" and the sid itself.
* For more information about the encryption class, see the proper docs of the pear's "hcemd5.php" class.
*/
//$sid=uniqid('');
$sid=session_id();
$ck_sid_buffer='ck_sid'.$sid;

include('include/core/inc_init_crypt.php'); // initialize crypt
$ciphersid=$enc_hcemd5->encodeMimeSelfRand($sid);
setcookie($ck_sid_buffer,$ciphersid);
$_COOKIE[$ck_sid_buffer]=$ciphersid;


#
# Simple counter, counts all hits including revisits
# Uncomment the following line  if you  like to count the hits, then make sure
# that the path /counter/hits/ and the file /counter/hitcount.txt  are system writeable
#
// include('./counter/count.php');


if((isset($boot)&&$boot)||!isset($_COOKIE['ck_config'])||empty($_COOKIE['ck_config'])) {
    configNew($bname,$bversion,$user_id,$ip,$cfgid);
} else {
    $user_id=$_COOKIE['ck_config'];
}

#
# Load user config API. Get the user config data from db
#
require_once('include/care_api_classes/class_userconfig.php');
$cfg_obj=new UserConfig;

if($cfg_obj->exists($user_id)) {
	$cfg_obj->getConfig($user_id);
	$USERCONFIG=$cfg_obj->buffer;
    $config_exists=true;  // Flag that user config is existing
}else{
	$cfg_obj->_getDefault();
	$USERCONFIG=$cfg_obj->buffer;
}

# Load global configurations API
require_once('include/care_api_classes/class_globalconfig.php');
$glob_cfg=new GlobalConfig($GLOBALCONFIG);

# Get the global config for language usage
$glob_cfg->getConfig('language_%');
# Get the global config for frames 
$glob_cfg->getConfig('gui_frame_left_nav_width');
# Get the global config for lev nav border 
$glob_cfg->getConfig('gui_frame_left_nav_border');

$savelang=0;
/*echo $GLOBALCONFIG['language_non_single'];
while (list($x,$v)=each($GLOBALCONFIG)) echo $x.'==>'.$v.'<br>';
*/
# Start checking language properties 

if(!$GLOBALCONFIG['language_single']) {
    # We get the language code
    if($_chg_lang_&&!empty($lang)) {
		    $savelang=1;
	}else{
		//echo $lang=$USERCONFIG['lang'];
        if(empty($USERCONFIG['lang']) || !isset($USERCONFIG['lang'])) $lang=$USERCONFIG['lang'];
			    else  include('chklang.php');
	 } 
}else{

    # If single language is configured, we get the user configured lang
	if(!empty($USERCONFIG['lang']) && file_exists('language/'.$USERCONFIG['lang'].'/lang_'.$USERCONFIG['lang'].'_startframe.php')) {
	    $lang=$USERCONFIG['lang'];
	} else {
	    # If user config lang is not available, we get the global system lang configuration
	    if(!empty($GLOBALCONFIG['language_default']) && file_exists('language/'.$GLOBALCONFIG['language_default'].'/lang_'.$GLOBALCONFIG['language_default'].'_startframe.php')) {
            $lang=$GLOBALCONFIG['language_default'];
		} else {
	        $lang=LANG_DEFAULT; # Comes from inc_environment_global.php, the last chance, usually set to "en"
	    }	
	}
}

#
# After having a language code check if the critical scripts exist and set warning
#
$installerwarn=file_exists('./installer/install.php');
if($installerwarn){
	#
	# Load necessary language tables
	#
	$lang_tables[]='create_admin.php';
	include_once('./include/inc_load_lang_tables.php');
	include_once('include/inc_charset_fx.php');
	include('./include/inc_installer_warning.php');
	#
	# redirect to the installer page after timeout of 5 seconds 
	#
	die('<meta http-equiv="refresh" content="5; url=./installer/">');
}

#
# Prepare language file path
#
$lang_file='language/'.$lang.'/lang_'.$lang.'_startframe.php';

#
# We check if language table exists, if not, english is used
#
if(file_exists($lang_file)) {
    include($lang_file);
} else {
    include('language/en/lang_en_startframe.php');  # en = english is the default language table
	$lang='en';
}

#
# The language detection is finished, we save it to session
#
$_SESSION['sess_lang']=$lang;

/*$ck_lang_buffer='ck_lang'.$sid;
setcookie($ck_lang_buffer,$lang);*/

/*$_COOKIE[$ck_lang_buffer]=$lang;*/
	 //echo $mask;
if((isset($mask)&&$mask)||!$config_exists||$savelang) {
	if(!$config_exists) {

		//$cfg_obj->getConfig('default');
		//$USERCONFIG=&$cfg_obj->buffer;

		configNew($bname,$bversion,$user_id,$ip,$cfgid);

		$USERCONFIG['bname']=$bname;
		$USERCONFIG['bversion']=$bversion;
		$USERCONFIG['cid']=$cfgid;
	}
	// *****************************
	//save browser info to user config array
	// *****************************
	if(empty($ip)) $USERCONFIG['ip']=$REMOTE_ADDR;
	$USERCONFIG['mask']=$mask;
	$USERCONFIG['lang']=$lang;
	if(((($bname=='msie') ||($bname=='opera')) &&($bversion>4)) ||(($bname=='netscape')&&($bversion>3.5)) ||($bname=='mozilla')) {
		$USERCONFIG['dhtml']=1;
	}
	// *****************************
	// Save config to db
	// *****************************
	$mask=$USERCONFIG['mask']; # save mask before serializing
	$cfg_obj->saveConfig($user_id,$USERCONFIG);
	setcookie('ck_config',$user_id,time()+(3600*24*365)); # expires after 1 year
}

#
# save user_id to session
#
$_SESSION['sess_user_id']=$user_id;
if(empty($_SESSION['sess_user_name'])) $_SESSION['sess_user_name']='default';

#
# set the initial session timeout start value
#
$_SESSION['sess_tos']=date('His');

#
# Load character set fx
#
include_once('include/core/inc_charset_fx.php');

#
# Load image fx
#
require_once('include/core/inc_img_fx.php');

#
# Start smarty templating
#
# Workaround for user config array to work inside the smarty class
#
$cfg = $USERCONFIG;

//while(list($x,$v)=each($cfg)) echo "$x => $v<br>";
require_once($root_path.'gui/smarty_template/smarty_care.class.php');
$smarty = new smarty_care('common');

#
# Window bar title
#
$smarty->assign('sWindowTitle',$LDMainTitle);

#
# Assign the contents frame source
#
$smarty->assign('sContentsFrameSource',"src = \"blank.php?lang=$lang&sid=$sid\"");

#
# Load the gui template
#
//require('gui/html_template/default/tp_index.php');
#
# If the floating menu window is selected
#
if($mask == 2){

	if($lang=='ar'||$lang=='fa') $smarty->assign('sBaseFramesetTemplate','common/frameset_floatingmenu_rtl.tpl');
		else $smarty->assign('sBaseFramesetTemplate','common/frameset_floatingmenu_ltr.tpl');
	
	$smarty->assign('sMenuFrameSource','src="main/menubar2.php"');
	$smarty->assign('sStartFrameSource',"src=\"main/indexframe.php?boot=1&lang=$lang&egal=$egal&cookie=$cookie&sid=$sid&mask=2\"");

}else{
	$smarty->assign('sStartFrameSource',"src = \"main/indexframe.php?boot=1&mask=$mask&lang=$lang&cookie=$cookie&sid=$sid\"");
	
	#
	# Assign frame dimensions
	#
	$smarty->assign('gui_frame_left_nav_width',$GLOBALCONFIG['gui_frame_left_nav_width']);
	$smarty->assign('gui_frame_left_nav_border',$GLOBALCONFIG['gui_frame_left_nav_border']);

	if($lang=='ar'||$lang=='fa') {
		$smarty->assign('sBaseFramesetTemplate','common/frameset_rtl.tpl');
		//require('gui/html_template/righttoliftdefault/tp_index.php');
	} else{
		#
		# Else use normal frameset design
		#
		$smarty->assign('sBaseFramesetTemplate','common/frameset_ltr.tpl');
	}
}

#
# Display the frame page
#
$smarty->display('common/baseframe.tpl');

?>
