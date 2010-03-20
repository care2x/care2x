<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','products.php');
$local_user='ck_prod_db_user';
require_once($root_path.'include/inc_front_chain_lang.php');
# Create products object
require_once($root_path.'include/care_api_classes/class_product.php');
$product_obj=new Product;

$thisfile=basename(__FILE__);

if(!isset($mode)) $mode="";
if(!isset($cat)) $cat="";
if(!isset($linecount)) $linecount="";
switch($cat)
{
	case "pharma":	
							$title=$LDPharmacy;
							$breakfile=$root_path."modules/pharmacy/apotheke-datenbank-functions.php".URL_APPEND."&userck=$userck";
							$imgpath=$root_path."pharma/img/";
							break;
	case "medlager":
							$title=$LDMedDepot;
							$breakfile=$root_path."modules/med_depot/medlager-datenbank-functions.php".URL_APPEND."&userck=$userck";
							$imgpath=$root_path."med_depot/img/";
							break;
	default:  {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

}

if($mode=='save')
{
	include($root_path.'include/inc_products_db_save_mod.php');
}

if(!empty($mode)) include($root_path.'include/inc_products_search_mod_datenbank.php');

if($linecount==1) {  $from='multiple'; }

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

 # Title in the title bar
 $smarty->assign('sToolbarTitle',"$title $LDPharmaDb $LDManage");

 # href for the back button
// $smarty->assign('pbBack',$returnfile);

 # href for the help button
 $smarty->assign('pbHelp',"javascript:gethelp('products_db.php','mng','$from','$cat','$update')");

 # href for the close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$title $LDPharmaDb $LDManage");

 # Assign Body Onload javascript code
 $smarty->assign('sOnLoadJs','onLoad="document.suchform.keyword.select()"');

 # Collect javascript code
 ob_start()

?>

<script language="javascript" >
<!--

function pruf(d)
{
	if(d.keyword.value=="")
	{
		d.keyword.focus();
		 return false;
	}
	return true;
}

// -->
</script>

<?php

# Javascript validator
require($root_path.'include/inc_js_products.php');

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

?>

<a name="pagetop"></a>

<ul>

<p>
<br>

<?php if($from=="deleteok") echo'
	<FONT class="prompt">'.$LDDataRemoved.'</font>
	<hr>';
?>

<form action="<?php echo $thisfile?>" method="get" name="suchform" onSubmit="return pruf(this)">
	<table border=0 cellspacing=2 cellpadding=3>
		<tr bgcolor=#ffffdd>
			<td colspan=2>
				<?php echo $LDSearchWordPrompt ?>
				<br><p>
			</td>
		</tr>
		<tr bgcolor=#ffffdd>
			<td align=right>
				<?php echo $LDSearchKey ?>:
			</td>
			<td>
				<input type="text" name="keyword" size=40 maxlength=40 value="<?php echo $keyword ?>">
			</td>
		</tr>
		<tr>
			<td>&nbsp;
			</td>
			<td align="right"><input type="submit" value="<?php echo $LDSearch ?>" >
			</td>
		 </tr>
	</table>
		
	<input type="hidden" name="sid" value="<?php echo $sid?>">
	<input type="hidden" name="lang" value="<?php echo $lang?>">
	<input type="hidden" name="cat" value="<?php echo $cat?>">
	<input type="hidden" name="userck" value="<?php echo $userck?>">
	<input type="hidden" name="mode" value="search">

</form>

<?php

if($linecount==1) echo '
				<form ENCTYPE="multipart/form-data" action="'.$thisfile.'" method="post" name="inputform" onSubmit="return prufform(this)">';

if($mode=='save'){
	if($saveok) {
		$smarty->assign('sMascotImg','<img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'>');
		$smarty->assign('sSaveFeedBack',$LDDataSaved);
	}else{
		echo $sql.'<p>';
		$smarty->assign('sNoSave',$LDDataNoSaved.'<br><a href="products-datenbank-functions-eingabe.php'.URL_APPEND.'">
			<u>'.$LDClk2EnterNew.'</u></a>');
	}
}

# Workaround to force display of the form template
$bShowThisForm = TRUE;

# Load the form GUI
require($root_path."include/inc_products_search_result_mod.php");

if($linecount==1){
	//<input type="hidden" name="picfilename" value="'.$zeile[picfile].'"> 

	echo '
	<input type="hidden" name="encoder" value="'.strtr($_COOKIE[$local_user.$sid]," ","+").'">
	<input type="hidden" name="dstamp" value="'.str_replace("_",".",date(Y_m_d)).'">
	<input type="hidden" name="tstamp" value="'.str_replace("_",".",date(H_i)).'">
	<input type="hidden" name="lock_flag" value="">
	<input type="hidden" name="sid" value="'.$sid.'">
	<input type="hidden" name="lang" value="'.$lang.'">
	<input type="hidden" name="cat" value="'.$cat.'">
	<input type="hidden" name="userck" value="'.$userck.'">
	<input type="hidden" name="keyword" value="'.$zeile[bestellnum].'">
	<input type="hidden" name="update" value="1">
	<INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="2000000">
	';

	if($mode=='search'){
		echo'
	  <input type="hidden" name="ref_bnum" value="'.$zeile[bestellnum].'">
	  <input type="hidden" name="ref_artnum" value="'.$zeile[artikelnum].'">
 	 <input type="hidden" name="ref_indusnum" value="'.$zeile[industrynum].'">
 	 <input type="hidden" name="ref_artname" value="'.$zeile[artikelname].'">
 	 ';
	}else{ 
		echo'
 	 <input type="hidden" name="ref_bnum" value="'.$ref_bnum.'">
	  <input type="hidden" name="ref_artnum" value="'.$ref_artnum.'">
 	 <input type="hidden" name="ref_indusnum" value="'.$ref_indusnum.'">
 	 <input type="hidden" name="ref_artname" value="'.$ref_artname.'">
	  ';
	}
	
	if($update&&(!$saveok)){
		echo'
 		<input type="hidden" name="mode" value="save">
		<input type="hidden" name="picref" value="'.$zeile[picfile].'">
  		<input type="submit" value="'.$LDSave.'">
		</form>';
	}else{
		echo'
		<input type="hidden" name="mode" value="search">
		<input type="submit" value="'.$LDUpdateData.'">
		</form>';

		echo'
		<form action="products-datenbank-functions-datadelete.php" method="get" name="delform">
  		<input type="hidden" name="sid" value="'.$sid.'">
		<input type="hidden" name="lang" value="'.$lang.'">
		<input type="hidden" name="userck" value="'.$userck.'">
		<input type="hidden" name="cat" value="'.$cat.'">';
		if($zeile[bestellnum]!="") echo '
  		<input type="hidden" name="keyword" value="'.$zeile[bestellnum].'">
		<input type="hidden" name="keytype" value="bestellnum">';
		else if($zeile[artikelnum]!="") echo '
  				<input type="hidden" name="keyword" value="'.$zeile[artikelnum].'">
				<input type="hidden" name="keytype" value="artikelnum">';
		else if($zeile[industrynum]!="") echo '
  				<input type="hidden" name="keyword" value="'.$zeile[industrynum].'">
				<input type="hidden" name="keytype" value="industrynum">';
		else if($zeile[artikelname]!="") echo '
  				<input type="hidden" name="keyword" value="'.$zeile[artikelname].'">
				<input type="hidden" name="keytype" value="artikelname">';
		else if($zeile[generic]!="") echo '
  				<input type="hidden" name="keyword" value="'.$zeile[generic].'">
				<input type="hidden" name="keytype" value="generic">';
		echo'
  		<input type="hidden" name="mode" value="delete">
		<input type="hidden" name="sure" value="0">
		<input type="hidden" name="cat" value="'.$cat.'">
  		<input type="submit" value="'.$LDRemoveFromDb.'">
       	</form>
		';
	}
}
?>
<p>

<?php if ($from=="multiple")
echo '
<a href="products-datenbank-functions-manage.php'.URL_APPEND.'&cat='.$cat.'"><img '.createLDImgSrc($root_path,'back2.gif','0','absmiddle').' alt="'.$LDBack.'"></a>
';
?>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
</ul>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign the form template to mainframe

 $smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');
?>
