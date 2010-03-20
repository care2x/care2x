<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('indexframe.php');
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_core.php');
$core = & new Core();

$breakfile='edv-system-admi-welcome.php'.URL_APPEND;
if($from=='add') $returnfile='edv_system_format_menu_item_add.php'.URL_APPEND.'&from=set';
  else $returnfile=$breakfile;
$thisfile=basename(__FILE__);
$editfile='edv_system_format_menu_item_add.php'.URL_REDIRECT_APPEND.'&mode=edit&from=set&item_no=';
/**
* Load the db routine
*/

if(isset($mode)&&($mode=='save')){
	for($i=1;$i<=$max_items;$i++){
		$sort_nr='sort_nr_'.$i;
		$is_visible='hide_it_'.$i;
		$core->sql="UPDATE care_menu_main SET sort_nr=".$$sort_nr.",is_visible='".$$is_visible."',hide_by='' WHERE nr=$i";
		//$sql="UPDATE care_menu_main SET sort_nr=".$$sort_nr.",is_visible='".$$is_visible."',hide_by='' WHERE nr=$i";
		//$db->Execute($sql);
		$core->Transact();
	}
	
	header('location:'.$thisfile.URL_REDIRECT_APPEND.'&mode=0');
	exit;
}
/*
if($result=$db->Execute("SELECT nr,sort_nr,name,LD_var AS \"LD_var\",status,url,hide_by,is_visible FROM care_menu_main  ORDER BY sort_nr")){
	$row=$result->RecordCount();
}
*/
if($result=$db->Execute("SELECT *, LD_var AS \"LD_var\"  FROM care_menu_main   ORDER BY sort_nr")){
	$row=$result->RecordCount();
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$LDMainMenu);

# href for return button
 $smarty->assign('pbBack',$returnfile);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('system_menumain.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDMainMenu);

 if($rows) {
 	$smarty->append('JavaScript','<script language="javascript" src="'.$root_path.'js/check_menu_item_same_item.js"></script>');
}

# Buffer page output

ob_start();

?>

<form>
<table border=0 cellspacing=1 cellpadding=2>  

  <tr class="wardlisttitlerow">
    <td><FONT  color="#000099"></td>
    <td><FONT  color="#000099"><b><?php echo $LDMenuItem; ?></b></td>
    <td><FONT  color="#000099"><b><?php echo $LDOrderNr; ?></b></td>
    <td><FONT  color="#000099"><b><?php echo $LDVisible; ?></b></td>
    <td><FONT  color="#000099"><b><?php echo $LDPath; ?></b></td>
    <td><FONT  color="#000099"><b><?php echo $LDStatus; ?></b></td>
    <td><FONT  color="#000099"><b><?php echo $LDHideBy; ?></b></td>
  </tr>

<?php 
$i=1;
while($menu_item=$result->FetchRow())
{

  echo '<tr class="submenu">
	<td><img '.createComIcon($root_path,'arrow_blueW.gif','0').'></td>
	<td><FONT  color="#0000cc"><b>';
	if(isset($$menu_item['LD_var'])&&!empty($$menu_item['LD_var'])) echo $$menu_item['LD_var'];
		else echo $menu_item['name'];
	echo '</b> </FONT></td>
	<td><FONT  color="#0000cc"><input type="text" name="sort_nr_'.$menu_item['nr'].'" size=2 maxlength=3 value="'.$menu_item['sort_nr'].'"></FONT></td>
	<td align="center"><FONT  color="#0000cc">	<input type="checkbox" name="hide_it_'.$menu_item['nr'].'" value="1" ';
	if($menu_item['is_visible']) echo 'checked';
	echo '><br></FONT></td>
	<td>'.$menu_item['url'].'<br></td>  
	<td class="wardlistrow1">'.$menu_item['status'].'<br></td>
	<td><FONT  color="#0000cc"><b>'.$menu_item['hide_by'].'</b> </FONT></td>
	</tr>';
	$i++;
}
?>
</table>
<?php
if($not_trans_id){
?>
<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<?php
}
?>
<input type="hidden" name="max_items" value="<?php echo ($i-1); ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="save">
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?> border=0>

</form>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign page output to the mainframe template

$smarty->assign('sMainFrameBlockData',$sTemp);
 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
