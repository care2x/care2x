<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
$lang_tables[]='departments.php';
define('LANG_FILE','products.php');
$local_user='ck_prod_order_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
///$db->debug=1;
$thisfile=basename(__FILE__);

if($cat=='pharma'){
 	$dbtable='care_pharma_orderlist';
	$title=$LDPharmacy;
}elseif($cat=='medlager'){
 	$dbtable='care_med_orderlist';
	$title=$LDMedDepot;
}

// Load the date formatter
require_once($root_path.'include/core/inc_date_format_functions.php');
// Create department object
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;

if(!isset($_SESSION['current_order']))
	$_SESSION['current_order'] = "";

switch($mode) {
	case 'add' :
		$_SESSION['current_order'][] = $_GET;
	break;
	case'delete' :
		unset($_SESSION['current_order'][$_GET['delete_id']]);
	break;
	case 'multiadd' :
		for($i=1;$i<$_GET['maxcount']+1;$i++) {
			if(isset($_GET['bestellnum'.$i])) {
				$_SESSION['current_order'][$i]['bestellnum1'] = $_GET['bestellnum'.$i];
				$_SESSION['current_order'][$i]['art1'] = $_GET['art'.$i];
				$_SESSION['current_order'][$i]['p1'] = $_GET['pcs'.$i];
				$_SESSION['current_order'][$i]['idsub1'] = $_GET['idsub'.$i];
			}
		}
	break;
}

// Load common icon images
$img_warn=createComIcon($root_path,'warn.gif','0');	
$img_uparrow=createComIcon($root_path,'uparrowgrnlrg.gif','0');
$img_info=createComIcon($root_path,'info3.gif','0');
$img_delete=createComIcon($root_path,'delete2.gif','0');
?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>

<script language=javascript>
function popinfo(b){
	urlholder="products-bestellkatalog-popinfo.php?sid=<?php echo "$sid&lang=$lang&userck=$userck"; ?>&keyword="+b+"&mode=search&cat=<?php echo $cat ?>";
	ordercatwin=window.open(urlholder,"ordercat","width=850,height=550,menubar=no,resizable=yes,scrollbars=yes");
}

function resize() {
	parent.document.getElementById("products").cols = "60%,20%";
}
</script>

<script language="javascript" src="../js/products_validate_order_num.js"></script>
<?php 
    require($root_path.'include/core/inc_js_gethelp.php');
    require($root_path.'include/core/inc_css_a_hilitebu.php');
?>
</head>
<BODY  topmargin=5 leftmargin=10  marginwidth=10 marginheight=5 <?php echo "bgcolor=".$cfg['body_bgcolor']; if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>

<table><tr><td>
<a href="javascript:gethelp('products.php','catalog','','<?php echo $cat ?>')"><img <?php echo createComIcon($root_path,'frage.gif','0','right') ?> alt="<?php echo $LDOpenHelp ?>"></a>
</td><td>
<a href="javascript:resize()"><img <?php echo createComIcon($root_path,'r_arrowgrnsm.gif','0'); ?> alt="Zgjero"></a>
</td></tr></table>
<font size=2 face="verdana,arial">
<?php 
    $buff=$dept_obj->LDvar($dept_nr);
    if(isset($$buff)&&!empty($$buff)) echo $$buff;
    else echo $dept_obj->FormalName($dept_nr);
?>
</font><br>
<?php
if($_SESSION['current_order']){
	$tog=1;
    echo '<form name="actlist" action="products-orderlist-final.php" method="post">
    	<font size=2 color="#800000">'.$LDActualOrder.':</font>
    	<font size=1> ('.$LDDate.': ' . formatDate2Local(date('d-m-Y'),$date_format) . ' '.$LDTime.': '.str_replace('24','00',convertTimeToLocal(date('H:i:s'))).')</font>
    	<table border=0 cellspacing=1 cellpadding=3 width="100%">
    	<tr class="wardlisttitlerow">';
	for ($i=0;$i<sizeof($LDcatindex);$i++)
	echo '<td>'.$LDcatindex[$i].'</td>';
	echo '</tr>';	
    $i=1;
    foreach ($_SESSION['current_order'] as $orderVals) {
    	$currID = each($_SESSION['current_order']);
    	if($tog) { echo '<tr class="wardlistrow1">'; $tog=0; }
    	else{ echo '<tr class="wardlistrow2">'; $tog=1; }
    	echo'<td>';
    	echo'	
    		<font size=1 color="#000080">'.$i++.'</font></td>
    		<td><font size=1>'.$orderVals['art1'].'</font><input type="hidden" name="art'.$i.'" value="'.$orderVals['art1'].'"></td>
    		<td><font size=1>'.$orderVals['p1'].'</font><input type="hidden" name="p'.$i.'" value="'.$orderVals['p1'].'"></td>
    		<td ><font size=1><nobr>X '.$orderVals['proorder'].'</nobr></font><input type="hidden" name="proorder'.$i.'" value="'.$orderVals['proorder'].'"></td></td>
    		<td><font size=1>'.$orderVals['bestellnum1'].'</font><input type="hidden" name="bestellnum'.$i.'" value="'.$orderVals['bestellnum1'].'"><input type="hidden" name="idsub'.$i.'" value="'.$orderVals['idsub1'].'"></td>
    		<td><a href="javascript:popinfo(\''.$orderVals['bestellnum1'].'\')" ><img '.$img_info.' alt="'.$complete_info.$orderVals['art1'].'"></a></td>
    		<td><a href="'.$thisfile.URL_APPEND.'&mode=delete&cat='.$cat.'&dept_nr='.$dept_nr.'&idx='.$i.'&userck='.$userck.'&delete_id='.$currID['key'].'" ><img '.$img_delete.' alt="'.$LDRemoveArticle.'"></a></td>
    		</tr>';
     }
     echo '</table>
    		<input type="hidden" name="maxnum" value="'.$i.'">
    		<input type="hidden" name="sid" value="'.$sid.'">
    		<input type="hidden" name="lang" value="'.$lang.'">
    		<input type="hidden" name="order_nr" value="'.$order_nr.'">
    		<input type="hidden" name="dept_nr" value="'.$dept_nr.'">
    		<input type="hidden" name="cat" value="'.$cat.'">
    		<input type="hidden" name="userck" value="'.$userck.'">
    		<br><br>
    		<input type="submit" value="'.$LDFinalizeList.'">   
    		</form>	';
}
?>
<a name="bottom"></a>
</body>
</html>
