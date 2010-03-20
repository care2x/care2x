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
$local_user='ck_prod_arch_user';
require_once($root_path.'include/inc_front_chain_lang.php');

/*if(!isset($dept)||!$dept)
{
	if(isset($_COOKIE['ck_thispc_dept'])&&!empty($_COOKIE['ck_thispc_dept'])) $dept=$_COOKIE['ck_thispc_dept'];
	 else $dept='plop';//default is plop dept
}
*/
$thisfile='products-archive-orderlist-showcontent.php';
$searchfile='products-archive.php';
$returnfile="products-archive.php?sid=$sid&lang=$lang&cat=$cat&userck=$userck";

switch($cat) {
	case 'pharma':
							$title=$LDPharmacy;
							$dbtable='care_pharma_orderlist';
		$dbtableSub='care_pharma_orderlist_sub';
							$breakfile=$root_path.'modules/pharmacy/apotheke.php?sid='.$sid.'&lang='.$lang;
							break;
	case 'medlager':
							$title=$LDMedDepot;
							$dbtable='care_med_orderlist';
		$dbtableSub='care_med_orderlist_sub';
							$breakfile=$root_path.'modules/med_depot/medlager.php?sid='.$sid.'&lang='.$lang;
							break;
	default:  {header('Location:'.$root_path.'language/'.$lang.'/lang_'.$lang.'_invalid-access-warning.php'); exit;}; 
}

// the value of dept comes from the calling page

// define the content array
$rows=0;
$count=0;
//echo $sql;

/* Load the common icon images */
$img_info=createComIcon($root_path,'info3.gif','0');

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

 # Title in the title bar
 $smarty->assign('sToolbarTitle',$title);

 # href for the back button
// $smarty->assign('pbBack',$returnfile);

 # href for the help button
 $smarty->assign('pbHelp',"javascript:gethelp('products.php','archshow','','$cat')");

 # href for the close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$title);

 # Assign Body Onload javascript code
 $smarty->assign('sOnLoadJs','onLoad="document.suchform.keyword.focus()"');

 # Collect javascript code
 ob_start()

?>

<script language="javascript" >
<!-- 
function pruf(d) {
	kw=d.keyword;
	var k=kw.value; 
	//if(k=="") return false;
	if((k=="")||(k==" ")||(!(k.indexOf('%')))||(!(k.indexOf('_')))) {
		kw.value="";
		kw.focus();
		return false;
	}
	return true;
}

function popinfo(b) {
	urlholder="products-bestellkatalog-popinfo.php<?php echo URL_REDIRECT_APPEND; ?>&cat=<?php echo $cat ?>&keyword="+b+"&mode=search";
	ordercatwin=window.open(urlholder,"ordercat","width=850,height=550,menubar=no,resizable=yes,scrollbars=yes");
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

<ul>
	<p><?php 
require($root_path.'include/inc_products_archive_search_form.php');

$rows=0;

/* Load the date formatter */
include_once($root_path.'include/inc_date_format_functions.php');

	$sql="SELECT * FROM $dbtable
	INNER JOIN $dbtableSub ON ($dbtable.order_nr =
	$dbtableSub.order_nr_sub)
	WHERE order_nr='$order_nr'";

	if($ergebnis=$db->Execute($sql)) {
	$rows=$ergebnis->RecordCount();
}else {
	echo "$LDDbNoRead<br>";
}

if($rows>0){

	# Create the department object
	include_once($root_path.'include/care_api_classes/class_department.php');
	$dept_obj=new Department;
	if($depts=&$dept_obj->getAllActiveObject()){
		while($buf=$depts->FetchRow()){
			$dept[$buf['nr']]=$buf;
		}
	}

//++++++++++++++++++++++++ show general info about the list +++++++++++++++++++++++++++
	$tog=1;
	$content=$ergebnis->FetchRow();
	echo '
			<table cellpadding=0 cellspacing=0 border=0 class="frame">
			<tr>
			<td>
			<table border=0 cellspacing=1 cellpadding=3>
			<tr class="wardlisttitlerow">';
	for ($i=0;$i<sizeof($LDArchValindex);$i++)
	echo '
		<td>'.$LDArchValindex[$i].'</td>';

	echo '</tr>
			<tr class="wardlistrow1">
			<td>';

	$buffer=$dept[$content['dept_nr']]['LD_var'];

	if(isset($$buffer)&&!empty($$buffer)) 	echo $$buffer;
		else echo $dept[$content['dept_nr']]['name_formal'];

	echo '</td>
		<td>'.formatDate2Local($content['order_date'],$date_format).'</td>
		<td >'.convertTimeToLocal($content['order_time']).'</td>
		<td>'.$content['create_id'].'</td>
		<td>'.$content['validator'].'</td>
		<td>'.formatDate2Local($content['sent_datetime'],$date_format).'</td>
		<td>'.convertTimeToLocal(formatDate2Local($content['sent_datetime'],$date_format,0,1)).'</td>
		<td>'.$content['priority'].'</td>
		</tr>
		</table>
		</td>
		</tr>
		</table>';

	//++++++++++++++++++++++++ show the actual list +++++++++++++++++++++++++++
	$tog=1;

	echo '<form name=actlist>
			<font size=2 color="#800000">';
		if (sizeof($content)==1) echo $LDOrderedArticle; else echo  $LDOrderedArticleMany;

	$LDFinindex[]='';
	echo '</font>
			<table border=0 cellspacing=1 cellpadding=3>
			<tr class="wardlisttitlerow">';
	for ($i=0;$i<sizeof($LDFinindex);$i++){
		echo '
			<td>'.$LDFinindex[$i].'</td>';
	}
	echo '</tr>';

	$i=1;
		for($n=0;$n<sizeof($content);$n++){
		if($tog){
			echo '<tr class="wardlistrow2">'; $tog=0;
		}else{
			echo '<tr class="wardlistrow2">'; $tog=1;
		}
		echo '
					<td><font color="#000080">'.$i.'</td>
					<td>'.$content['artikelname'].'</td>
					<td>'.$content['pcs'].'</td>
					<td ><nobr>X '.$content['proorder'].'</nobr></td>
					<td>'.$content['dose'].'</td>
					<td>'.$content['unit'].'</td>		
					<td>'.$content['price'].'</td>		
					<td>'.$content['price'] * $content['pcs'].'</td>	
					<td>'.$content['expiry'] .'</td>
					<td>'.$content['bestellnum'].'</td>';		
			echo '<td><a href="javascript:popinfo(\''.$content['bestellnum'].'\')" ><img '.$img_info.' alt="'.$LDOpenInfo.$content['artikelname'].'"></a></td>
				</tr>';
		$i++;
			$content=$ergebnis->FetchRow();
 	}
	echo '</table>
			</form>
			';
}
	?> <a href="<?php echo $returnfile; ?>"><img
	<?php echo createLDImgSrc($root_path,'back2.gif','0') ?>></a>
	
	
</table>
	
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
