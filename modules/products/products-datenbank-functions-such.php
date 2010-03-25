<?php
error_reporting ( E_COMPILE_ERROR | E_ERROR | E_CORE_ERROR );
require ('./roots.php');
require ($root_path . 'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define ( 'LANG_FILE', 'products.php' );
$local_user = 'ck_prod_db_user';
require_once ($root_path . 'include/core/inc_front_chain_lang.php');

///$db->debug = 1;

$thisfile = basename ( __FILE__ );

switch ( $cat) {
	case "pharma" :
		$title = $LDPharmacy;
		$breakfile = $root_path . "modules/pharmacy/apotheke-datenbank-functions.php" . URL_APPEND . "&userck=$userck";
		$imgpath = $root_path . "uplodas/pharma/img/";
	break;
	case "medlager" :
		$title = $LDMedDepot;
		$breakfile = $root_path . "modules/med_depot/medlager-datenbank-functions.php" . URL_APPEND . "&userck=$userck";
		$imgpath = $root_path . "uplodas/med_depot/img/";
	break;
	default :
		{
			header ( "Location:" . $root_path . "language/" . $lang . "/lang_" . $lang . "_invalid-access-warning.php" );
			exit ();
		}
		;
}

require ( "includes/inc_products_search_mod_datenbank.php");

# Start Smarty templating here
/**
 * LOAD Smarty
 */

# Note: it is advisable to load this after the inc_front_chain_lang.php so
# that the smarty script can use the user configured template theme

require_once ($root_path . 'gui/smarty_template/smarty_care.class.php');
$smarty = new smarty_care ( 'common' );

# Title in the title bar
$smarty->assign ( 'sToolbarTitle', "$title $LDPharmaDb $LDSearch" );

# href for the back button
// $smarty->assign('pbBack',$returnfile);


# href for the help button
$smarty->assign ( 'pbHelp', "javascript:gethelp('products_db.php','search','$from','$cat')" );

# href for the close button
$smarty->assign ( 'breakfile', $breakfile );

# Window bar title
$smarty->assign ( 'sWindowTitle', "$title $LDPharmaDb $LDSearch" );

# Assign Body Onload javascript code
$smarty->assign ( 'sOnLoadJs', 'onLoad="document.suchform.keyword.select()"' );

# Collect javascript code
ob_start ()?>


<script language="javascript">
<!--

function pruf(d) {
	if(d.keyword.value=="") {
		d.keyword.focus();
		 return false;
	}
	return true;
}

// -->
</script>

<?php

$sTemp = ob_get_contents ();
ob_end_clean ();

$smarty->append ( 'JavaScript', $sTemp );

# Buffer page output


ob_start ();

?>

<a name="pagetop"></a>

<ul>
	<p><br>
	
<form action="<?php echo $thisfile?>" method="get" name="suchform" onSubmit="return pruf(this)">

	<table border=0 cellspacing=2 cellpadding=3>
		<tr bgcolor=#ffffdd>
			<td colspan=2><FONT color="#800000"><?php echo $LDSearchWordPrompt?></font>
			<br>
			<p>
			</td>
		</tr>
		<tr bgcolor=#ffffdd>
			<td align=right><?php echo $LDSearchKey?>:</td>
			<td>
				<input type="text" name="keyword" size=40 maxlength=40 value="<?php echo $keyword?>">
			</td>
		</tr>
		<tr>
			<td>
				<input type="reset" value="<?php echo $LDReset?>" onClick="document.suchform.keyword.focus()">
			</td>
			<td align=right>
				<input type="submit" value="<?php echo $LDSearch?>">
			</td>
		</tr>
	</table>

	<input type="hidden" name="sid" value="<?php echo $sid?>"> 
	<input type="hidden" name="lang" value="<?php echo $lang?>"> 
	<input type="hidden" name="cat" value="<?php echo $cat?>"> 
	<input type="hidden" name="userck" value="<?php echo $userck?>"> 
	<input type="hidden" name="mode" value="search">
	
</form>

	<hr>

<?php
// Workaround to force display of results  form
$bShowThisForm = TRUE;
require ("includes/inc_products_search_result_mod.php");
?>

<form action="<?php echo $breakfile?>" method="post">
	<input type="hidden" name="sid" value="<?php echo $sid?>"> 
	<input type="hidden" name="lang" value="<?php echo $lang?>"> 
	<input type="hidden" name="userck" value="<?php echo $userck?>"> 
	<input type="image" <?php echo createLDImgSrc ( $root_path, 'cancel.gif', '0' )?> border=0 width=103 height=24 alt="<?php echo $LDBack2Menu?>">
</form>
<?php
if ($from == "multiple")
	echo '
<form name=backbut onSubmit="return false">
<input type="hidden" name="sid" value="' . $sid . '">
<input type="hidden" name="lang" value="' . $lang . '">
<input type="hidden" name="userck" value="' . $userck . '">
<input type="submit" value="' . $LDBack . '" onClick="history.back()">
</form>';
?>
</ul>

<?php

$sTemp = ob_get_contents ();
ob_end_clean ();

# Assign the form template to mainframe


$smarty->assign ( 'sMainFrameBlockData', $sTemp );

 /**
 * show Template
 */
$smarty->display('common/mainframe.tpl');
?>
