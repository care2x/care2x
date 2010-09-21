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

//$db->debug=1;

# Define here the default values to be used if the input is invalid
define('NEWS_TITLE_COLOR','#006600');
define('NEWS_TITLE_FONT','arial,verdana,helvetica,sans serif');
define('NEWS_TITLE_SIZE','5');
define('NEWS_TITLE_BOLD','1');
define('NEWS_PREFACE_COLOR','#000066');
define('NEWS_PREFACE_FONT','arial,verdana,helvetica,sans serif');
define('NEWS_PREFACE_SIZE','2');
define('NEWS_PREFACE_BOLD','1');
define('NEWS_BODY_COLOR','#000000');
define('NEWS_BODY_FONT','arial,verdana,helvetica,sans serif');
define('NEWS_BODY_SIZE','2');
define('NEWS_PREVIEW_MAXLEN','600');
define('NEWS_DISPLAY_WIDTH','100%');

$lang_tables[]='startframe.php';
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

$breakfile='edv-system-admi-welcome.php'.URL_APPEND.'&target=currency_admin';
$thisfile=basename(__FILE__);

$GLOBAL_CONFIG=array();
require_once($root_path.'include/care_api_classes/class_globalconfig.php');
# Create object linking our global config array to the object
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);

# Save data if save mode
if(isset($mode) && $mode=='save'){
	$filter='news_'; # The index filter
	$numeric=FALSE; # Values are not strictly numeric
	$addslash=TRUE; # Slashes should be added to the stored values
	# Validate input data. Invalid data are just replaced with default values
	if(!is_numeric($_POST['news_headline_title_font_size'])) $_POST['news_headline_title_font_size']=NEWS_TITLE_SIZE;
	if(empty($_POST['news_headline_title_font_face'])) $_POST['news_headline_title_font_face']=NEWS_TITLE_FONT;
	if(!is_numeric($_POST['news_headline_preface_font_size'])) $_POST['news_headline_preface_font_size']=NEWS_PREFACE_SIZE;
	if(empty($_POST['news_headline_preface_font_face'])) $_POST['news_headline_preface_font_face']=NEWS_PREFACE_FONT;
	if(!is_numeric($_POST['news_headline_body_font_size'])) $_POST['news_headline_body_font_size']=NEWS_BODY_SIZE;
	if(empty($_POST['news_headline_body_font_face'])) $_POST['news_headline_body_font_face']=NEWS_BODY_FONT;
	if(stristr($_POST['news_normal_display_width'],'%')){
		$buffer=substr($_POST['news_normal_display_width'],0,strlen($_POST['news_normal_display_width'])-1);
		if(!is_numeric($buffer)||$buffer>100) $_POST['news_normal_display_width']=NEWS_DISPLAY_WIDTH;
	}else{
		if(!is_numeric($_POST['news_normal_display_width'])) $_POST['news_normal_display_width']=NEWS_DISPLAY_WIDTH;
	}
	if(!is_numeric($_POST['news_normal_preview_maxlen'])) $_POST['news_normal_preview_maxlen']=NEWS_PREVIEW_MAXLEN;
	
	# Save the configuration
	$glob_obj->saveConfigArray($_POST,$filter,$numeric,'',$addslash);
	# Loop back to self to get the newly stored values
	header("location:$thisfile".URL_REDIRECT_APPEND."&save_ok=1");
	exit;
# Else get current global data
}else{ 
	$glob_obj->getConfig('news_%');
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
 $smarty->assign('sToolbarTitle',$LDNewsDisplay);

# href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('newsdisplay.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDNewsDisplay);

 # Collect javascript code

 ob_start();

?>

<script language="javascript">
<!-- Script Begin
function useDefault() {
	d=document.newsdisplay;
	d.news_headline_title_font_size.value="<?php echo NEWS_TITLE_SIZE; ?>";
	d.news_headline_title_font_face.value="<?php echo NEWS_TITLE_FONT; ?>";
	d.news_headline_title_font_color.value="<?php echo NEWS_TITLE_COLOR; ?>";
	tb="<?php echo NEWS_TITLE_BOLD; ?>";
	if(tb=="1") d.news_headline_title_font_bold[0].checked=true;
		else  d.news_headline_title_font_bold[1].checked=true;
	d.news_headline_preface_font_size.value="<?php echo NEWS_PREFACE_SIZE; ?>";
	d.news_headline_preface_font_face.value="<?php echo NEWS_PREFACE_FONT; ?>";
	d.news_headline_preface_font_color.value="<?php echo NEWS_PREFACE_COLOR; ?>";
	pb="<?php echo NEWS_PREFACE_BOLD; ?>";
	if(pb=="1") d.news_headline_preface_font_bold[0].checked=true;
		else  d.news_headline_preface_font_bold[1].checked=true;
	d.news_headline_body_font_size.value="<?php echo NEWS_BODY_SIZE; ?>";
	d.news_headline_body_font_face.value="<?php echo NEWS_BODY_FONT; ?>";
	d.news_headline_body_font_color.value="<?php echo NEWS_BODY_COLOR; ?>";
	d.news_normal_preview_maxlen.value="<?php echo NEWS_PREVIEW_MAXLEN; ?>";
	d.news_normal_display_width.value="<?php echo NEWS_DISPLAY_WIDTH; ?>";
}
//  Script End -->
</script>
<!-- Link script file to the HTML document in the header -->
<script language=JavaScript src="<?php echo $root_path; ?>js/tigra_colorpicker/picker.js"></script>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

?>

<ul>
<FONT  class="prompt"><p>
<?php

if(isset($save_ok) && $save_ok) echo '<img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'>'.$LDDataSaved.'<p>';

echo $LDEnterInfo;

?>
</font>
<br>
<?php echo $LDNoteDefault ?>
<form action="<?php echo $thisfile ?>" method="post" name="newsdisplay">
<table border=0 cellspacing=1 cellpadding=5>  
<tr>
	<td class="wardlisttitlerow" align="right"><FONT  color="#0000cc"><b><?php echo $LDTitleFontSize ?></b> </FONT></td>
	<td class="submenu">
	 <select name="news_headline_title_font_size">
      	<option value="1" <?php if($GLOBAL_CONFIG['news_headline_title_font_size']==1) echo 'selected'; ?>> 1</option>
      	<option value="2" <?php if($GLOBAL_CONFIG['news_headline_title_font_size']==2) echo 'selected'; ?>> 2</option>
      	<option value="3" <?php if($GLOBAL_CONFIG['news_headline_title_font_size']==3) echo 'selected'; ?>> 3</option>
      	<option value="4" <?php if($GLOBAL_CONFIG['news_headline_title_font_size']==4) echo 'selected'; ?>> 4</option>
      	<option value="5" <?php if($GLOBAL_CONFIG['news_headline_title_font_size']==5) echo 'selected'; ?>> 5</option>
      	<option value="6" <?php if($GLOBAL_CONFIG['news_headline_title_font_size']==6) echo 'selected'; ?>> 6</option>
      	<option value="7" <?php if($GLOBAL_CONFIG['news_headline_title_font_size']==7) echo 'selected'; ?>> 7</option>
      </select>
      
	  
	  </td>  
	</tr>
<tr>
	<td class="wardlisttitlerow" align="right"><FONT  color="#0000cc"><b><?php echo $LDTitleFont ?></b> </FONT></td>
	<td class="submenu"><input type="text" name="news_headline_title_font_face" size=40 maxlength=100 value="<?php echo $GLOBAL_CONFIG['news_headline_title_font_face'] ?>">
      </td>  
	</tr>
<tr>
	<td class="wardlisttitlerow" align="right"><FONT  color="#0000cc"><b><?php echo $LDTitleFontColor ?></b> </FONT></td>
	<td class="submenu"><input type="text" name="news_headline_title_font_color" size=40 maxlength=10 value="<?php echo $GLOBAL_CONFIG['news_headline_title_font_color'] ?>">
     <a href="javascript:TCP.popup(document.forms['newsdisplay'].elements['news_headline_title_font_color'],'','<?php echo $root_path; ?>js/tigra_colorpicker/')"><img width="18" height="18" border="0" alt="<?php echo $LDClkPickColor ?>"  title="<?php echo $LDClkPickColor ?>" <?php echo createComIcon($root_path,'colorcube_s.gif','0'); ?>></a>
	  </td>  
	</tr>
<tr>
	<td class="wardlisttitlerow" align="right"><FONT  color="#0000cc"><b><?php echo $LDTitleFontBold ?></b> </FONT></td>
	<td class="submenu">
		<input type="radio" name="news_headline_title_font_bold" value="1" <?php  if($GLOBAL_CONFIG['news_headline_title_font_bold']) echo 'checked'; ?>><?php echo $LDBold ?> 
		<input type="radio" name="news_headline_title_font_bold" value="0" <?php  if(!$GLOBAL_CONFIG['news_headline_title_font_bold']) echo 'checked'; ?>><?php echo $LDNormal ?>
      </td>  
	</tr>
<tr>
	<td class="wardlisttitlerow" align="right"><FONT  color="#0000cc"><b><?php echo $LDPrefaceFontSize ?></b> </FONT></td>
	<td class="submenu">
		 <select name="news_headline_preface_font_size">
      	<option value="1" <?php if($GLOBAL_CONFIG['news_headline_preface_font_size']==1) echo 'selected'; ?>> 1</option>
      	<option value="2" <?php if($GLOBAL_CONFIG['news_headline_preface_font_size']==2) echo 'selected'; ?>> 2</option>
      	<option value="3" <?php if($GLOBAL_CONFIG['news_headline_preface_font_size']==3) echo 'selected'; ?>> 3</option>
      	<option value="4" <?php if($GLOBAL_CONFIG['news_headline_preface_font_size']==4) echo 'selected'; ?>> 4</option>
      	<option value="5" <?php if($GLOBAL_CONFIG['news_headline_preface_font_size']==5) echo 'selected'; ?>> 5</option>
      	<option value="6" <?php if($GLOBAL_CONFIG['news_headline_preface_font_size']==6) echo 'selected'; ?>> 6</option>
      	<option value="7" <?php if($GLOBAL_CONFIG['news_headline_preface_font_size']==7) echo 'selected'; ?>> 7</option>
      </select>

      </td>  
	</tr>
<tr>
	<td class="wardlisttitlerow" align="right"><FONT  color="#0000cc"><b><?php echo $LDPrefaceFont ?></b> </FONT></td>
	<td class="submenu"><input type="text" name="news_headline_preface_font_face" size=40 maxlength=40 value="<?php echo $GLOBAL_CONFIG['news_headline_preface_font_face'] ?>">
      </td>  
	</tr>
<tr>
	<td class="wardlisttitlerow" align="right"><FONT  color="#0000cc"><b><?php echo $LDPrefaceFontColor ?></b> </FONT></td>
	<td class="submenu"><input type="text" name="news_headline_preface_font_color" size=40 maxlength=40 value="<?php echo $GLOBAL_CONFIG['news_headline_preface_font_color'] ?>">
     <a href="javascript:TCP.popup(document.forms['newsdisplay'].elements['news_headline_preface_font_color'],'','<?php echo $root_path; ?>js/tigra_colorpicker/')"><img width="18" height="18" border="0" alt="<?php echo $LDClkPickColor ?>"  title="<?php echo $LDClkPickColor ?>" <?php echo createComIcon($root_path,'colorcube_s.gif','0'); ?>></a>
      </td>  
	</tr>
<tr>
	<td class="wardlisttitlerow" align="right"><FONT  color="#0000cc"><b><?php echo $LDPrefaceFontBold ?></b> </FONT></td>
	<td class="submenu">
		<input type="radio" name="news_headline_preface_font_bold" value="1" <?php  if($GLOBAL_CONFIG['news_headline_preface_font_bold']) echo 'checked'; ?>><?php echo $LDBold ?> 
		<input type="radio" name="news_headline_preface_font_bold" value="0" <?php  if(!$GLOBAL_CONFIG['news_headline_preface_font_bold']) echo 'checked'; ?>><?php echo $LDNormal ?>
      </td>  
	</tr>
<tr>
	<td class="wardlisttitlerow" align="right"><FONT  color="#0000cc"><b><?php echo $LDBodyFontSize ?></b> </FONT></td>
	<td class="submenu">
	  
		 <select name="news_headline_body_font_size">
      	<option value="1" <?php if($GLOBAL_CONFIG['news_headline_body_font_size']==1) echo 'selected'; ?>> 1</option>
      	<option value="2" <?php if($GLOBAL_CONFIG['news_headline_body_font_size']==2) echo 'selected'; ?>> 2</option>
      	<option value="3" <?php if($GLOBAL_CONFIG['news_headline_body_font_size']==3) echo 'selected'; ?>> 3</option>
      	<option value="4" <?php if($GLOBAL_CONFIG['news_headline_body_font_size']==4) echo 'selected'; ?>> 4</option>
      	<option value="5" <?php if($GLOBAL_CONFIG['news_headline_body_font_size']==5) echo 'selected'; ?>> 5</option>
      	<option value="6" <?php if($GLOBAL_CONFIG['news_headline_body_font_size']==6) echo 'selected'; ?>> 6</option>
      	<option value="7" <?php if($GLOBAL_CONFIG['news_headline_body_font_size']==7) echo 'selected'; ?>> 7</option>
      </select>
	  </td>  
	</tr>
<tr>
	<td class="wardlisttitlerow" align="right"><FONT  color="#0000cc"><b><?php echo $LDBodyFont ?></b> </FONT></td>
	<td class="submenu"><input type="text" name="news_headline_body_font_face" size=40 maxlength=60 value="<?php echo $GLOBAL_CONFIG['news_headline_body_font_face'] ?>">
      </td>  
	</tr>
<tr>
	<td class="wardlisttitlerow" align="right"><FONT  color="#0000cc"><b><?php echo $LDBodyFontColor ?></b> </FONT></td>
	<td class="submenu"><input type="text" name="news_headline_body_font_color" size=40 maxlength=60 value="<?php echo $GLOBAL_CONFIG['news_headline_body_font_color'] ?>">
     <a href="javascript:TCP.popup(document.forms['newsdisplay'].elements['news_headline_body_font_color'],'','<?php echo $root_path; ?>js/tigra_colorpicker/')"><img width="18" height="18" border="0" alt="<?php echo $LDClkPickColor ?>"  title="<?php echo $LDClkPickColor ?>" <?php echo createComIcon($root_path,'colorcube_s.gif','0'); ?>></a>
      </td>  
	</tr>
<tr>
	<td class="wardlisttitlerow" align="right"><FONT  color="#0000cc"><b><?php echo $LDPreviewMaxlen ?></b> </FONT></td>
	<td class="submenu"><input type="text" name="news_normal_preview_maxlen" size=40 maxlength=60 value="<?php echo $GLOBAL_CONFIG['news_normal_preview_maxlen'] ?>">
      </td>  
	</tr>
<tr>
	<td class="wardlisttitlerow" align="right"><FONT  color="#0000cc"><b><?php echo $LDDisplayWidth ?></b> </FONT></td>
	<td class="submenu"><input type="text" name="news_normal_display_width" size=40 maxlength=60 value="<?php echo $GLOBAL_CONFIG['news_normal_display_width'] ?>">
      </td>  
	</tr>
<tr>
	<td class="submenu" align="right">&nbsp;</td>
	<td class="submenu"><input type="button" value="<?php echo $LDUseDefault ?>" onClick="useDefault()">
      </td>  
	</tr>
</table>
<p>
<?php if($item_no) $save_button='update.gif'; else $save_button='savedisc.gif'; ?>
<input type="image" <?php echo createLDImgSrc($root_path,$save_button,'0') ?>>&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
<?php if($item_no) : ?>
<a href="<?php echo $thisfile.''.URL_APPEND.'&from='.$from ?>"><img <?php echo createLDImgSrc($root_path,'newcurrency.gif','0') ?>></a>
<?php endif ?>
<input type="hidden" name="sid" value="<?php echo $sid;?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="mode" value="save">
</form>
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
