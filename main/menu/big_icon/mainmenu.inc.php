<?php
/**
* This is the "Big Icons"  menu structure  file.
* This file is included by the /main/gui_bridge/gui_indexframe.php script. This will not run alone.
* Revision for version > 2.0.1 to accomodate the alternative menu tree system
* Elpidio Latorilla 2004-07-29
*/

#
# Get the menu items
#
$sql="SELECT nr,sort_nr,name,LD_var AS \"LD_var\",url,is_visible FROM care_menu_main WHERE is_visible=1 OR LD_var='LDEDP' OR LD_var='LDLogin' ORDER by sort_nr";

$result=$db->Execute($sql);

if($result){

	#
	# Load the tags file to get the icon image sources
	#
	include_once($root_path.'main/menu/big_icon/tags.php');

	#
	# Create the framing table
	#
	echo '<table CELLPADDING=0 CELLSPACING=0 border=0 width="100%">';

	#
	# Create the menu structure
	#
	while($menu=$result->FetchRow()){
		echo "<tr><td align=\"center\">\n";
		if (stristr('LDLogin',$menu['LD_var'])){
			if ($_COOKIE['ck_login_logged'.$sid]=='true'){
				$menu['url']='main/logout_confirm.php';
				$menu['LD_var']='LDLogout';
			}
		}
		echo '<font face=verdana size=2><a href="'.$root_path.$menu['url'].URL_APPEND.'" TARGET="CONTENTS" REL="child">';
		#
		# Do intelligent checks to ensure that an icon will be displayed and avoid the broken image symbol
		#
		if(isset($sMenuIcon[$menu['LD_var']]) && !empty($sMenuIcon[$menu['LD_var']]) && file_exists($sIconDirPath.'/'.$sMenuIcon[$menu['LD_var']])){
			echo '<img src="'.$sIconDirPath.'/'.$sMenuIcon[$menu['LD_var']].'" border=0>';
		}else{
			if(file_exists($sIconDirPath.'/'.$sDefaultIcon)){
				echo '<img src="'.$sIconDirPath.'/'.$sDefaultIcon.'" border=0>';
			}else{
				#
				# Last alternative. Show an icon from the system files.
				#
				echo '<img '.createComIcon($root_path,'smiley.gif','0').'>';
			}
		}
		echo '<br>';
		if(isset($$menu['LD_var'])&&!empty($$menu['LD_var'])) echo $$menu['LD_var'];
			else echo $menu['name'];
		echo '</A></font>';
		echo "</td></tr>\n";
	}
	echo '</table>';
}
?>