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
define('LANG_FILE','specials.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

$breakfile='config_options.php'.URL_APPEND;

$config_new=array();

if(!session_is_registered('sess_serial_buffer')){
	session_register('sess_serial_buffer');
}
if(isset($_SESSION['sess_serial_buffer'])){
	$config_new=unserialize($_SESSION['sess_serial_buffer']);
}	

if ($mode=='change'){
	$color='#'.$color;
	//$$item=$color;
	$config_new[$item]=$color;
	
	$_SESSION['sess_serial_buffer']=serialize($config_new);
	$config_new=array_merge($cfg,$config_new);
	
}elseif((($mode=='ok')||($mode=='remain'))&&isset($_SESSION['sess_serial_buffer'])){

	// Save to user config table

	include_once($root_path.'include/care_api_classes/class_userconfig.php');
	$user=new UserConfig;

	if($user->getConfig($_COOKIE['ck_config'])){

		$config=&$user->getConfigData();
	
		$config=array_merge($config,$config_new);

		if($user->saveConfig($_COOKIE['ck_config'],$config)){
			if($mode=='ok'){
				header("location:spediens.php?sid=$sid&lang=$lang&idxreload=j");
			}
			if($mode=='remain'){
				header("location:colorchg.php?sid=$sid&lang=$lang&idxreload=j");
			}
			exit;
		}
	}else{
    	$config=array(); // just declare the array
    }
}else{	
	// Get  default values
	$config_new=$cfg;
}
// Get the menu items for simulation
$sql="SELECT name,LD_var FROM care_menu_main WHERE is_visible=1 OR LD_var='LDEDP' OR LD_var='LDLogin' ORDER by sort_nr";

$menu_obj=$db->Execute($sql);

require_once($root_path.'include/inc_nocache_headers.php');

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$LDColorOpt);

# Title image
 $smarty->assign('sTitleImage','<img '.createComIcon($root_path,'settings_tree.gif','0').'>');
 
 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('color_opt.php','')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDColorOpt);

 # Body Onload js
  if($idxreload=="j"){
 	$sOnLoadJs = 'onLoad="window.parent.STARTPAGE.location.replace(\'indexframe.php?sid='.$sid.'&lang='.$lang.'\'); ';
 	if($cfg[mask]==2) $sOnLoadJs = $sOnLoadJs.'window.parent.MENUBAR.location.replace(\'menubar2.php?sid='.$sid.'&lang='.$lang.'\');';
 	$sOnLoadJs = $sOnLoadJs.'"';
	$smarty->assign('sOnLoadJs',$sOnLoadJs);
}

# Collect js code

ob_start();
?>

<script language="javascript">
<!-- 
	var urlholder;
  function chgcolor(p){
	winspecs="width=550,height=600,menubar=no,resizable=yes,scrollbars=yes";
<?php 
	echo 'urlholder="chg-color.php?item="+p+"&sid='.$sid.'&lang='.$lang.'&tb='.str_replace('#','',$cfg['top_bgcolor']).'&tt='.str_replace('#','',$cfg['top_txtcolor']).'&bb='.str_replace('#','',$cfg['body_bgcolor']).'&btb='.str_replace('#','',$cfg['bot_bgcolor']).'&d='.$cfg['dhtml'].'";';
?>
	
		colorwin=window.open(urlholder,"colorwin",winspecs);
	}
	
	function ok(){
		location.href="colorchg.php?mode=ok&sid=<?php echo "$sid&lang=$lang"; ?>";
	}
 // -->
</script>

<?php

$sTemp = ob_get_contents();
ob_end_clean();
$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

?>

<p>
<ul>

<table border=1>
  <tr >
    <td rowspan=3 bgcolor="<?php echo $config_new['idx_bgcolor']; ?>" width=100 align=left>
	<center><img <?php echo createLogo($root_path,'care_logo.png','0') ?>></center>

<a href="#" title="<?php echo $LDClk4TxtColor ?>" onClick="chgcolor('idx_txtcolor')">
<FONT    SIZE=1  color="<?php echo $config_new['idx_txtcolor']; ?>">
<?php
if(is_object($menu_obj)){
	while($menu=$menu_obj->FetchRow()){
		if(isset($$menu['LD_var'])&&!empty($$menu['LD_var'])) echo $$menu['LD_var'];
			else echo $menu['name'];
		echo '<br>';
	}
}
?>
<p>
<a href="#" title="<?php echo $LDClk4BgColor ?>" onClick="chgcolor('idx_bgcolor')"><?php echo $LDBgColor ?> <img <?php echo createComIcon($root_path,'settings_tree.gif','0') ?> >
</a>
</td>
    <td bgcolor="<?php echo $config_new['top_bgcolor']; ?>" ><p><FONT    SIZE=1  color="<?php echo $config_new['top_txtcolor']; ?>">
	&nbsp;&nbsp;&nbsp;<a href="#" title="<?php echo $LDClk4TxtColor ?>" onClick="chgcolor('top_txtcolor')"><font size=3 color=<?php echo $config_new['top_txtcolor']; ?>><?php echo $LDTxtColor ?></font></a>&nbsp;&nbsp;&nbsp;
<a href="#" title="<?php echo $LDClk4BgColor ?>" onClick="chgcolor('top_bgcolor')"><?php echo $LDBgColor ?> <img <?php echo createComIcon($root_path,'settings_tree.gif','0') ?> alt="<?php echo $LDClk4BgColor ?>">
</a></td>
  </tr>
  <tr>
  
<td bgcolor="<?php echo $config_new['body_bgcolor']; ?>" width=400 ><p><br>
	<a href="#" onClick="chgcolor('body_txtcolor')"><FONT    SIZE=4 color="<?php echo $config_new['body_txtcolor']; ?>">	<?php echo $LDMainFrame ?></font></a><p><FONT    SIZE=1>	
	<a href="#" title="<?php echo $LDClk4BgColor ?>" onClick="chgcolor('body_bgcolor')"><?php echo $LDBgColor ?> <img <?php echo createComIcon($root_path,'settings_tree.gif','0') ?> alt="<?php echo $LDClk4BgColor ?>">
	</a><p><br>
</td>
  </tr>
  <tr>
 
    <td bgcolor="<?php echo $config_new['bot_bgcolor']; ?>">

<?php
require($root_path.'include/inc_load_copyrite.php');
?>
<p><a href="#" title="<?php echo $LDClk4BgColor ?>" onClick="chgcolor('bot_bgcolor')"><?php echo $LDBgColor ?> <img <?php echo createComIcon($root_path,'settings_tree.gif','0') ?> alt="<?php echo $LDClk4BgColor ?>">
</a>

</td>
  </tr>
</table>

<FORM >
<input type="button" value="<?php echo $LDOK ?>" onClick="ok()">
<INPUT type="button"  value="<?php echo $LDCancel ?>" onClick="location.replace('config_options.php<?php echo URL_REDIRECT_APPEND; ?>')">
<input type="button" value="<?php echo $LDApply ?>" onClick="location.replace('colorchg.php<?php echo URL_REDIRECT_APPEND; ?>&mode=remain')">
<?php if ($cfg['dhtml'])
echo '&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="'.$LDColorOptExt.'" onClick="location.replace(\'excolorchg.php'.URL_REDIRECT_APPEND.'\')">';
?>
</FORM>
<p>
</ul>

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
