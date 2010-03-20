<?php
#  Creates the tabs for the patient registration module
if(!isset($notabs)||!$notabs){

	$smarty->assign('bShowTabs',TRUE);

	#
	# Starting at version 2.0.2, the button is named "new patient"
	# It can be reverted to "new person" by defining the ADMISSION_EXT_TABS constant to TRUE
	# at the /include/inc_enviroment_global.php script
	#
	if(defined('ADMISSION_EXT_TABS') && ADMISSION_EXT_TABS){
		#
		# User "register new person" button
		#
		$sNewPatientButton ='register_green.gif';
		$sNewPatientButtonGray ='register_gray.gif';
	}else{
		$sNewPatientButton ='new_patient_green.gif';
		$sNewPatientButtonGray ='admit-gray.gif';
	}

	if($target=="entry") $img=$sNewPatientButton; //echo '<img '.createLDImgSrc($root_path,'register_green.gif','0').' alt="'.$LDAdmit.'">';
								else{ $img=$sNewPatientButtonGray;}
	$pbBuffer='<a href="patient_register.php'.URL_APPEND.'&target=entry"><img '.createLDImgSrc($root_path,$img,'0').' alt="'.$LDRegisterNewPerson.'"  title="'.$LDRegisterNewPerson.'"';
	if($cfg['dhtml']) $pbBuffer.='style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)';
	$pbBuffer.=' align=middle></a>';
	$smarty->assign('pbNew',$pbBuffer);

	if($target=="search") $img='search_green.gif'; //echo '<img '.createLDImgSrc($root_path,'search_green.gif','0').' alt="'.$LDSearch.'">';
								else{ $img='such-gray.gif';}
	$pbBuffer='<a href="patient_register_search.php'.URL_APPEND.'&target=search"><img '.createLDImgSrc($root_path,$img,'0').' alt="'.$LDSearch.'" title="'.$LDSearch.'"';
	if($cfg['dhtml']) $pbBuffer.='style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)';
	$pbBuffer.=' align=middle></a>';
	$smarty->assign('pbSearch',$pbBuffer);

	if($target=="archiv") $img='advsearch_green.gif'; //echo '<img '.createLDImgSrc($root_path,'archive_green.gif','0').'  alt="'.$LDArchive.'">';
								else{$img='advsearch_gray.gif'; }
	$pbBuffer='<a href="patient_register_archive.php'.URL_APPEND.'&target=archiv"><img '.createLDImgSrc($root_path,$img,'0').' alt="'.$LDAdvancedSearch.'" title="'.$LDAdvancedSearch.'" ';
	if($cfg['dhtml']) $pbBuffer.='style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)'; 
	$pbBuffer.=' align=middle></a>';
	$smarty->assign('pbAdvSearch',$pbBuffer);

	$smarty->assign('sHSpacer','<img src="'.$root_path.'gui/img/common/default/pixel.gif" height=1 width=25>');

	#
	# Starting at version 2.0.2, the button is named  "admission" and links to search admission page
	#
	//$pbBuffer='<a href="aufnahme_start.php'.URL_APPEND.'&target=entry"><img '.createLDImgSrc($root_path,'admit-gray.gif','0').' alt="'.$LDAdmit.'"  title="'.$LDAdmit.'" ';
	$pbBuffer='<a href="aufnahme_daten_such.php'.URL_APPEND.'&target=search"><img '.createLDImgSrc($root_path,'ein-gray.gif','0').' alt="'.$LDAdmit.'"  title="'.$LDAdmit.'" ';
	if($cfg['dhtml']) $pbBuffer.='style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)';
	$pbBuffer.=' align=middle></a>';
	$smarty->assign('pbSwitchMode',$pbBuffer);
}

#  Horizontal  line below the tabs

//if($tab_bot_line) $sDivClass = $tab_bot_line; else $sDivClass = '#333399';

if($tab_bot_line) $sDivClass = 'class="reg_div"'; else $sDivClass =  'class="adm_div"';

$smarty->assign('sRegDividerClass',$sDivClass);

if(!empty($subtitle)) $smarty->assign('sSubTitle','<font color="#000099" SIZE=3  FACE="verdana,Arial"><b>:: '.$subtitle.'</b></font>');

if(isset($current_encounter)&&$current_encounter) $smarty->assign('sWarnText','<font size=2 FACE="verdana,Arial"> <img '.createComIcon($root_path,'warn.gif','0','absmiddle').'> '.$LDPersonIsAdmitted.'</font>');
?>
