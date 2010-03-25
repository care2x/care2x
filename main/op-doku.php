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
define('LANG_FILE','or.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);

setcookie(firstentry,''); // The cookie "firsentry" is used for switching the cat image

/* Check the start script as break destination*/
if (!empty($_SESSION['sess_path_referer'])&&($_SESSION['sess_path_referer']!=$top_dir.$thisfile)){
	if(file_exists($root_path.$_SESSION['sess_path_referer'])){
		$breakfile=$_SESSION['sess_path_referer'];
	}else {
		/* default startpage */
		$breakfile = 'main/startframe.php';
	}
} else {
	/* default startpage */
	$breakfile = 'main/startframe.php';
}
$breakfile=$root_path.$breakfile.URL_APPEND;

// reset all 2nd level lock cookies
require($root_path.'include/core/inc_2level_reset.php');

$_SESSION['sess_path_referer']=$top_dir.$thisfile;

# Start Smarty templating here
/**
 * LOAD Smarty
 */

# Note: it is advisable to load this after the inc_front_chain_lang.php so
# that the smarty script can use the user configured template theme

require_once($root_path.'gui/smarty_template/smarty_care.class.php');
$smarty = new smarty_care('common');

# Module title in the toolbar

$smarty->assign('sToolbarTitle',$LDOr);

# Help button href
$smarty->assign('pbHelp',"javascript:gethelp('submenu1.php','$LDOr')");

$smarty->assign('breakfile',$breakfile);

# Window bar title
$smarty->assign('title',$LDOr);

# Append javascript code to javascript block

$smarty->append('JavaScript',$sTemp);

# Create the submenu blocks

# OR Surgeons submenu block

$smarty->assign('LDOrDocs',"<img ".createLDImgSrc($root_path,'arzt2.gif','0','absmiddle')."  alt=\"$LDDoctor\">");
//ALog
$smarty->assign('LDOrDocument',"<a href=\"".$root_path."modules/op_document/op-doku-pass.php".URL_APPEND."\">$LDOrDocument</a>");
$smarty->assign('LDOrDocumentTxt',$LDOrDocumentTxt);
$smarty->assign('LDOrDocumentMenu',
  '<TABLE cellSpacing=1 cellPadding=5 width="100%" bgColor=#dddddd border=0>
			<TR>
				<TD bgColor=#ffffff>
				<font face=arial,verdana size=2>
				» <A href="' . $root_path . 'modules/op_document/op-doku-pass.php' . URL_REDIRECT_APPEND . '&target=entry">' . $LDNewDocu . '</A>
				» <A href="' . $root_path . 'modules/op_document/op-doku-pass.php' . URL_REDIRECT_APPEND . '&target=search">' . $LDSearch . '</A>
				» <A href="' . $root_path . 'modules/op_document/op-doku-pass.php' . URL_REDIRECT_APPEND . '&target=archiv">' . $LDArchive . '</A>
				</font>
				</TD>
			</TR>
	</TABLE>');

$smarty->assign('LDQviewDocs',"<a href=\"".$root_path."modules/doctors/doctors-dienst-schnellsicht.php".URL_APPEND."&retpath=op\">$LDDOC $LDQuickView</a>");
$smarty->assign('LDQviewTxtDocs',$LDQviewTxtDocs);

# OR Nursing submenu block

$smarty->assign('LDOrNursing',"<img ".createLDImgSrc($root_path,'pflege2.gif','0','absmiddle')."  alt=\"$LDNursing\">");
//PLog
$smarty->assign('LDOrLogBook',"<a href=\"".$root_path."modules/or_logbook/op-pflege-logbuch-pass.php".URL_APPEND."\">$LDOrLogBook</a>");
$smarty->assign('LDOrLogBookTxt',$LDOrLogBookTxt);
$smarty->assign('LDOrLogBookMenu',
  		'<TABLE cellSpacing=1 cellPadding=5 width="100%" bgColor=#dddddd border=0>
			<TR>
				<TD bgColor=#ffffff><font face=arial,verdana size=2><nobr> 
				» <A href="' . $root_path . 'modules/or_logbook/op-pflege-logbuch-pass.php' . URL_REDIRECT_APPEND.'&target=entry";>'.  $LDNewDocu .'</A>
				» <A href="'. $root_path .'modules/or_logbook/op-pflege-logbuch-pass.php' .  URL_REDIRECT_APPEND . '&target=search";">' .  $LDSearch . '</A> 
				» <A href="'.  $root_path . 'modules/or_logbook/op-pflege-logbuch-pass.php' .  URL_REDIRECT_APPEND . '&target=archiv";">' .  $LDArchive . '</A>
				</font></TD>
			</TR>
		</TABLE>');
$smarty->assign('LDORNOCQuickView',"<a href=\"".$root_path."modules/nursing_or/nursing-or-dienst-schnellsicht.php".URL_APPEND."\">$LDORNOC $LDQuickView</a>");
$smarty->assign('LDQviewTxtNurse',$LDQviewTxtNurse);
//PDienstplan
$smarty->assign('LDORNOCScheduler',"<a href=\"".$root_path."modules/nursing_or/nursing-or-main-pass.php".URL_APPEND."&retpath=menu&target=dutyplan\">$LDORNOC $LDScheduler </a>");
$smarty->assign('LDDutyPlanTxt',$LDDutyPlanTxt);
$smarty->assign('LDDutyPlanMenu',
  		  		'<TABLE cellSpacing=1 cellPadding=5 width="100%" bgColor=#dddddd border=0>
				<TR>
					<TD bgColor=#ffffff><font face=arial,verdana size=2> 
					» <A href="'.$root_path.'modules/nursing_or/nursing-or-dienstplan.php'. URL_REDIRECT_APPEND.'&retpath=menu">'. $LDSee .'</A> 
					» <A href="'.$root_path.'modules/nursing_or/nursing-or-main-pass.php'.URL_REDIRECT_APPEND.'&retpath=menu&target=dutyplan">'.$LDCreate . '/' . $LDUpdate .'</A> 
					» <A href="'.$root_path.'modules/nursing_or/nursing-or-main-pass.php'. URL_REDIRECT_APPEND.'&target=setpersonal&retpath=menu">' . $LDCreatePersonList .'</A>
					</font></TD>
				</TR>
		</TABLE>');

$smarty->assign('LDOnCallDuty',"<a href=\"spediens-bdienst-zeit-erfassung.php".URL_APPEND."&retpath=op&encoder=".$_COOKIE['ck_login_username'.$sid]."\">$LDOnCallDuty</a>");
$smarty->assign('LDOnCallDutyTxt',$LDOnCallDutyTxt);

# OR Anesthesia submenu block

$smarty->assign('LDORAnesthesia',"<img ".createLDImgSrc($root_path,'anaes.gif','0','absmiddle')."  alt=\"$LDAna\">");

$smarty->assign('LDORAnaQuickView',"<a href=\"".$root_path."modules/nursing_or/nursing-or-dienst-schnellsicht.php".URL_APPEND."&retpath=menu&hilitedept=39\">$LDQuickView</a>");
$smarty->assign('LDQviewTxtAna',$LDQviewTxtAna);
//AnaDienstplan
$smarty->assign('LDORAnaNOCScheduler',"<a href=\"".$root_path."modules/nursing_or/nursing-or-dienstplan.php".URL_APPEND."&dept_nr=39&retpath=menu\" >$LDORNOC $LDScheduler</a>");
$smarty->assign('LDORAnaNOCSchedulerMenu',
  		  		'<TABLE cellSpacing=1 cellPadding=5 width="100%" bgColor=#dddddd border=0>
			<TR>
				<TD bgColor=#ffffff><font face=arial,verdana size=2>
				» <A href="' . $root_path . 'modules/nursing_or/nursing-or-dienstplan.php'.URL_REDIRECT_APPEND.'">'. $LDSee .'</A>
				» <A href="' . $root_path . 'modules/nursing_or/nursing-or-main-pass.php'.URL_REDIRECT_APPEND.'">'. $LDCreate . '/' . $LDUpdate  .'</A>
				</font></TD>
			</TR>
		</TABLE>');

# Collect div codes for  on-mouse-hover pop-up menu windows

$sTemp='';
ob_start();

$sTemp = ob_get_contents();

ob_end_clean();

$smarty->assign('sOnHoverMenu',$sTemp);

# Assign the submenu to the mainframe center block

$smarty->assign('sMainBlockIncludeFile','or/submenu_or.tpl');

/**
 * show  Mainframe Template
 */

$smarty->display('common/mainframe.tpl');
?>