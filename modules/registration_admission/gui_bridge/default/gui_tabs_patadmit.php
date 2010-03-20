<?php
/* Creates the tabs for the patient registration module  */
if(!isset($notabs)||!$notabs){

	$smarty->assign('bShowTabs',TRUE);

	#
	# Starting at version 2.0.2, the "new patient" button is hidden. It can be shown by defining the ADMISSION_EXT_TABS constant to TRUE
	# at the /include/inc_enviroment_global.php script
	#
	if(defined('ADMISSION_EXT_TABS') && ADMISSION_EXT_TABS){
		if($target=="entry") $img='admit-blue.gif';
									else{ $img='admit-gray.gif';}
		$pbBuffer='<a href="aufnahme_start.php'.URL_APPEND.'&target=entry"><img '.createLDImgSrc($root_path,$img,'0').' alt="'.$LDAdmit.'"  title="'.$LDAdmit.'"';
		if($cfg['dhtml']) $pbBuffer.='style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)';
		$pbBuffer.=' align=middle></a>';
		$smarty->assign('pbNew',$pbBuffer);
		#
		# User "register new person" button
		#
		$sNewPersonButton ='register_gray.gif';
	}else{
		$sNewPersonButton ='admit-gray.gif';
	}

	
	if($target=="search") $img='such-b.gif'; //echo '<img '.createLDImgSrc($root_path,'search_green.gif','0').' alt="'.$LDSearch.'">';
								else{ $img='such-gray.gif';}
	$pbBuffer='<a href="aufnahme_daten_such.php'.URL_APPEND.'&target=search"><img '.createLDImgSrc($root_path,$img,'0').' alt="'.$LDSearch.'" title="'.$LDSearch.'"';
	if($cfg['dhtml']) $pbBuffer.='style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)';
	$pbBuffer.=' align=middle></a>';
	$smarty->assign('pbSearch',$pbBuffer);

	if($target=="archiv") $img='arch-blu.gif'; //echo '<img '.createLDImgSrc($root_path,'archive_green.gif','0').'  alt="'.$LDArchive.'">';
								else{$img='arch-gray.gif'; }
	$pbBuffer='<a href="aufnahme_list.php'.URL_APPEND.'&target=archiv"><img '.createLDImgSrc($root_path,$img,'0').' alt="'.$LDArchive.'" title="'.$LDArchive.'" ';
	if($cfg['dhtml']) $pbBuffer.='style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)';
	$pbBuffer.=' align=middle></a>';
	$smarty->assign('pbAdvSearch',$pbBuffer);

	$smarty->assign('sHSpacer','<img src="'.$root_path.'gui/img/common/default/pixel.gif" height=1 width=25>');
//	$pbBuffer='<a href="patient_register.php'.URL_APPEND.'&target=entry"><img '.createLDImgSrc($root_path,'register_gray.gif','0').' alt="'.$LDRegisterNewPerson.'"  title="'.$LDRegisterNewPerson.'" ';
	$pbBuffer='<a href="patient_register.php'.URL_APPEND.'&target=entry"><img '.createLDImgSrc($root_path,$sNewPersonButton,'0').' alt="'.$LDRegisterNewPerson.'"  title="'.$LDRegisterNewPerson.'" ';
	if($cfg['dhtml']) $pbBuffer.='style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)';
	$pbBuffer.=' align=middle></a>';
	$smarty->assign('pbSwitchMode',$pbBuffer);
}

#  Horizontal  line below the tabs

//if($tab_bot_line) $sDivClass = $tab_bot_line; else $sDivClass = '#333399';

if($parent_admit) $sDivClass =  'class="adm_div"'; else $sDivClass = 'class="reg_div"';

$smarty->assign('sRegDividerClass',$sDivClass);

if(!empty($subtitle)) $smarty->assign('sSubTitle',":: $subtitle");

?>

