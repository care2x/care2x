<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');

require_once($root_path.'global_conf/areas_allow.php');

//$allowedarea=&$allow_area['pharma'];
$append=URL_REDIRECT_APPEND.'&cat=pharma&userck=';
switch($mode) {
	case "order": 	$title=$LDPharmaOrder;
						$allowedarea[] = '_a_3_pharmaorder';
						$src="orderpass";
						$mode="order";
						$userck="ck_prod_order_user";
						$fileforward=$root_path."modules/products/products-bestellung.php".$append.$userck."&from=".$src;
						break;
	case "archive":$title=$LDOrderArchive;
						$allowedarea[] = '_a_1_pharmadbadmin';	
						$src="archivepass";
						$userck="ck_prod_arch_user";
						$fileforward=$root_path."modules/products/products-archive.php".$append.$userck."&from=".$src;
						break;
	case "dbank":  $title=$LDPharmaDb;
						$allowedarea[] = '_a_1_pharmadbadmin';	
						$src="dbankpass";
						$userck="ck_prod_db_user";
						$fileforward="apotheke-datenbank-functions.php".$append.$userck."&from=".$src;
						break;
	case "catalog":  $title=$LDOrderCat;
						$allowedarea[] = '_a_1_pharmadbadmin';	
						$src="catalogpass";
						$userck="ck_prod_order_user";
						$fileforward=$root_path."modules/products/products-bestellkatalog-edit.php".$append.$userck."&target=catalog&from=".$src;
						break;
	case "bot":  $title=$LDPharmaOrderBot;
						$allowedarea[] = '_a_1_pharmadbadmin';	
						$src="medibotpass";
						$userck="ck_prod_bot_user";
						$fileforward=$root_path."modules/pharmacy/apotheke-bestellbot-pass.php".URL_APPEND."&mode=bot&user_origin=pharmabot";
						break;
	default: 	{header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 
}

$thisfile=basename(__FILE__);
$breakfile='apotheke.php'.URL_APPEND;
$lognote="$LDPharmacy $title ok";

// reset all 2nd level lock cookies
require($root_path.'include/core/inc_2level_reset.php'); 
setcookie('ck_2level_sid'.$sid,'',0,'/');

require($root_path.'include/core/inc_passcheck_internchk.php');
if ($pass=='check') 
	include($root_path.'include/core/inc_passcheck.php');

$errbuf="$LDPharmacy $title";
$minimal=1;
require($root_path.'include/core/inc_passcheck_head.php');
?>

<BODY  <?php if (!$nofocus) echo 'onLoad="document.passwindow.userid.focus()"'; echo  ' bgcolor='.$cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
?>>

<p>
<FONT SIZE=-1  FACE="Arial">
<P>
<img src="../../gui/img/common/default/lampboard.gif" border=0 align="middle">
<FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  SIZE=5  FACE="verdana"> <b><?php echo "$LDPharmacy :: $title" ?></b></font>
<p>
<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<?php require($root_path.'include/core/inc_passcheck_mask.php') ?>  

<p>
<!-- <img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo "$LDIntro2 $LDPharmacy $title " ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="<?php echo $root_path; ?>main/ucons.php<?php echo URL_APPEND; ?>"><?php echo "$LDWhat2Do $LDPharmacy $title " ?>?</a><br>
 -->
<p>

<?php
require($root_path.'include/core/inc_load_copyrite.php');
?>


</FONT>


</BODY>
</HTML>
