<?php
/**
* This is the default menu tree file.
* This file is included by the /main/gui_bridge/gui_indexframe.php script. This will not run alone.
* Revision for version > 2.0.1 to accomodate the alternative menu tree system
* Elpidio Latorilla 2004-07-29
* Modified by Daniele Palmas and Guido Porruvecchio 15/6/2006
*/
///$db->debug=1;
//set the css style for a links
require($root_path.'include/core/inc_css_a_sublinker_d.php');
// Code for checking menu's voices' permissions added by Daniele Palmas and Guido Porruvecchio
require_once($root_path."include/care_api_classes/MenuVisibility.php");
require_once($root_path."include/care_api_classes/StringPermissionParser.php");

$sqlPermissions = "SELECT permission FROM care_users WHERE login_id = '".$_SESSION['sess_login_username']."'";
$resultPermissions = $db->Execute($sqlPermissions);
if ($resultPermissions->RecordCount()==0) {
	$sqlPermissions = "SELECT permission FROM care_users WHERE name = '".$_SESSION['sess_login_username']."'";
	$resultPermissions = $db->Execute($sqlPermissions);
}
$permissionRow = $resultPermissions->FetchRow();
$permissionString = $permissionRow['permission'];
$mv = new MenuVisibility($permissionString);
//

#
# Get the menu items
#
$sql="SELECT nr,sort_nr,name,LD_var AS \"LD_var\",url,is_visible FROM care_menu_main WHERE is_visible=1 OR LD_var='LDEDP' OR LD_var='LDLogin' ORDER by sort_nr";

$result=$db->Execute($sql);

if($result){
	echo '<table CELLPADDING=0 CELLSPACING=0 border=0>';
	$gui='';
	$TP_img1= '<img '.createComIcon($root_path,'blue_bullet.gif','0','middle').'>';
	$TP_com_img_path=$root_path.'gui/img/common';
	$buf='';
	# Load the menu item template
	$tp =&$TP_obj->load('tp_main_index_menu_item.htm');
	while($menu=$result->FetchRow()){
		if (stristr('LDLogin',$menu['LD_var'])){
			if ($_COOKIE['ck_login_logged'.$sid]=='true'){
				$menu['url']='main/logout_confirm.php';
				$menu['LD_var']='LDLogout';
			}
		}
		$TP_menu_item='<a href="'.$root_path.$menu['url'].URL_APPEND.'" TARGET="CONTENTS" REL="child">';
		if(isset($$menu['LD_var'])&&!empty($$menu['LD_var'])) $TP_menu_item.=$$menu['LD_var'];
			else $TP_menu_item.=$menu['name'];
		$TP_menu_item.='</A>';
		// Modified the following line
		if ($mv->isAllowed($menu['name'])||$menu['name']=='Login'||$menu['name']=='Home')	eval("echo $tp;");
	}
	echo $gui;
	
	echo '</table>';
}
?>

