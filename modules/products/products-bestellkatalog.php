<?php
//gjergji : full rewriting of the medicaments management
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
$lang_tables[]='departments.php';
define('LANG_FILE','products.php');
$local_user='ck_prod_order_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

require_once($root_path.'include/care_api_classes/class_product.php');
$product_obj=new Product;
$product_obj_sub = new Product();
require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
$pharma_nr = $dept_obj->getPharmaOfDept($dept_nr);
$thisfile=basename(__FILE__);

//build the waiting list
//only if i'm calling form the pharmacy
//use it to temporary fill care_pharma_ordercatalog
if($cat=='pharma')
	$waitingList = $product_obj->getWaitingDeptOrders($dept_nr);

if($cat=='pharma') {
 	$dbtable='care_pharma_orderlist';
	$title='Farmaci';
}else{
 	$dbtable='care_med_orderlist';
	$title='Depo Mjekesore';
}

if(($mode=='search')&&($keyword!='')&&($keyword!='%')){
 	if($keyword=="*%*") $keyword="%";
 	 include('includes/inc_products_search_mod.php');
}elseif(($mode=='save')&&($bestellnum!='')&&($artikelname!='')){
	$saveok=$product_obj->SaveCatalogItem($_GET,$cat);
}

if(($mode=='delete')&&($keyword!='')) {
	$delete_ok=$product_obj->DeleteCatalogItem($keyword,$cat);
}

/* Load common icon images */	 
$img_leftarrow=createComIcon($root_path,'l-arrowgrnlrg.gif','0');	
$img_uparrow=createComIcon($root_path,'uparrowgrnlrg.gif','0');
$img_dwnarrow=createComIcon($root_path,'dwnarrowgrnlrg.gif','0');
$img_info=createComIcon($root_path,'info3.gif','0');
$img_delete=createComIcon($root_path,'delete2.gif','0');

?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>

<script language=javascript>
function popinfo(b) {
	urlholder="products-bestellkatalog-popinfo.php<?php echo URL_REDIRECT_APPEND; ?>&keyword="+b+"&mode=search&cat=<?php echo $cat; ?>";
	ordercatwin=window.open(urlholder,"ordercat","width=850,height=550,menubar=no,resizable=yes,scrollbars=yes");
}

function add2basket(b,i,id,art){
	if(eval("document.curcatform.p"+i+".value")=="0") {
		eval("document.curcatform.p"+i+".value=''");
		eval("document.curcatform.p"+i+".focus()");
		return;
	}
	var n;
	if(eval("document.curcatform.p"+i+".value")=="") n=1;
	else n=eval("document.curcatform.p"+i+".value")
	
	window.parent.BESTELLKORB.location.href="products-bestellkorb.php<?php echo URL_REDIRECT_APPEND."&userck=$userck" ?>&dept_nr=<?php echo $dept_nr; ?>&order_nr=<?php echo $order_nr; ?>&mode=add&cat=<?php echo $cat; ?>&maxcount=1&order1=1&bestellnum1="+b+"&p1="+n+"&idsub1="+id+"&art1="+art;
}

function add_update(b) {
	window.parent.BESTELLKORB.location.href="products-bestellkorb.php<?php echo URL_REDIRECT_APPEND."&userck=$userck" ?>&dept_nr=<?php echo $dept_nr; ?>&order_nr=<?php echo $order_nr; ?>&mode=add&cat=<?php echo $cat; ?>&maxcount=1&order1=1&bestellnum1="+b+"&p1=1";
}

function checkform(d) {
	for (i=1;i<=d.maxcount.value;i++)
		if (eval("d.order"+i+".checked")) return true;
	return false;
}

function resize() {
	parent.document.getElementById("products").cols = "20%,60%";
}
</script>

<script language="javascript"
	src="<?php echo $root_path; ?>js/products_validate_order_num.js"></script>
<?php 
require($root_path.'include/core/inc_js_gethelp.php');
require($root_path.'include/core/inc_css_a_hilitebu.php');
?>
</head>
<BODY topmargin=5 leftmargin=10 marginwidth=10 marginheight=5
	onLoad="document.smed.keyword.focus()"
	<?php echo "bgcolor=".$cfg['body_bgcolor'];  if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<table>
	<tr>
		<td><a href="javascript:resize()"><img <?php echo $img_leftarrow ?>
			alt="Enlarge"></a></td>
		<td><a
			href="javascript:gethelp('products.php','catalog','','<?php echo $cat ?>')"><img
			<?php echo createComIcon($root_path,'frage.gif','0','right') ?>
			alt="<?php echo 
$LDOpenHelp ?>"></a></td>
	</tr>
</table>
<form action="<?php echo $thisfile; ?>" method="get" name="smed"><font
	face="Verdana, Arial" size=1 color=#800000><?php echo $LDSearchKey ?>: 
    <br>
<input type="hidden" name="sid" value="<?php echo $sid ?>"> <input
	type="hidden" name="lang" value="<?php echo $lang?>"> <input
	type="hidden" name="mode" value="search"> <input type="text"
	name="keyword" size=20 maxlength=40> <input type="hidden"
	name="order_nr" value="<?php echo $order_nr?>"> <input type="hidden"
	name="dept_nr" value="<?php echo $dept_nr?>"> <input type="hidden"
	name="cat" value="<?php echo $cat?>"> <input type="hidden"
	name="userck" value="<?php echo $userck?>"> <input type="submit"
	value="<?php echo $LDSearchArticle ?>"> </font></form>

<?php 
if (isset($mode)&&($mode=='search')&&($keyword!='')) {
		if($linecount) {
    	// The following routine displays the search results	
    	echo "<p><font size=1>".str_replace("~nr~",$linecount,$LDFoundNrData)."<br>$LDClk2SeeInfo</font><br>";
    
    		$ergebnis->MoveFirst();
    		echo '<table border=0 cellpadding=3 cellspacing=1> 
    		  		<tr class="wardlisttitlerow">';
    		for ($i=0;$i<sizeof($LDGenindex);$i++)
    		echo '
    				<td><font color="#000080">'.$LDGenindex[$i].'</font></td>';
    		echo '</tr>';	
    
    		while($zeile=$ergebnis->FetchRow()) {
    			echo '<tr class=wardlistrow2">';
    			echo '	<td valign="top"><a href="'.$thisfile.URL_APPEND.'&order_nr='.$order_nr.'&dept_nr='.$dept_nr.'&mode=save&cat='.$cat.'&artikelname='.str_replace("&","%26",strtr($zeile['artikelname']," ","+")).'&dose='.$zeile['dose'].'&packing='.$zeile['packing'].'&bestellnum='.$zeile['bestellnum'].'&minorder='.$zeile['minorder'].'&maxorder='.$zeile['maxorder'].'&proorder='.str_replace(" ","+",$zeile['proorder']).'&hit=0&userck='.$userck.'" onClick="add_update(\''.$zeile['bestellnum'].'\')"><img '.$img_leftarrow.' alt="'.$LDPut2BasketAway.'"></a></td>
    					<td valign="top"><a href="'.$thisfile.URL_APPEND.'&order_nr='.$order_nr.'&dept_nr='.$dept_nr.'&mode=save&cat='.$cat.'&artikelname='.str_replace("&","%26",strtr($zeile['artikelname']," ","+")).'&dose='.$zeile['dose'].'&packing='.$zeile['packing'].'&bestellnum='.$zeile['bestellnum'].'&minorder='.$zeile['minorder'].'&maxorder='.$zeile['maxorder'].'&proorder='.str_replace(" ","+",$zeile['proorder']).'&hit=0&userck='.$userck.'"><img '.$img_dwnarrow.' alt="'.$LDPut2Catalog.'"></a></td>		
    					<td valign="top"><a href="javascript:popinfo(\''.$zeile['bestellnum'].'\')" ><img '.$img_info.' alt="'.$complete_info.$zeile['artikelname'].' - '.$LDClk2See.'"></a></td>
    					<td valign="top"><a href="javascript:popinfo(\''.$zeile['bestellnum'].'\')" ><font color="#800000">'.$zeile['artikelname'].' - '.$zeile['dose']. ' - ' .$zeile['packing'] . '</font></a></td>
    					<td valign="top"><font size=1>'.$zeile['generic'].'</td>
    					<td valign="top"><font size=1>';
    			if(strlen($zeile['description'])>40) echo substr($zeile['description'],0,40)."...";
    				else echo $zeile['description'];
    			echo '</font></td><td valign="top"><font size=1>'.$zeile['bestellnum'].'</font></td>';
    			echo '</tr>';
    		}
    		echo "</table>";
    	} else
    		echo "<p>$LDNoDataFound";
    	echo '<p>';
    }
    
    // get the actual order catalog
    $ergebnis=&$product_obj->ActualOrderCatalog($dept_nr,$cat);
    $rows=$product_obj->LastRecordCount();
    // show catalog
    
if($rows){
    
	echo'<form name="curcatform" onSubmit="return checkform(this)">';
    echo '<font color="#800000">'.$LDCatalog.' :: ';
    
    $buff=$dept_obj->LDvar($dept_nr);
    		
	if(isset($$buff)&&!empty($$buff)) echo $$buff;
	else echo $dept_obj->FormalName($dept_nr);

	echo '</font>
	<table border=0 cellspacing=1 cellpadding=3 width="100%">
	<tr class="wardlisttitlerow">';
	for ($i=0;$i<sizeof($LDCindex);$i++)
		echo '<td><font color="#000080">'.$LDCindex[$i].'</font></td>';
    
    $i=1;
    $mi=2;
    $ergebnis->MoveFirst();		
    while($content=$ergebnis->FetchRow()) {
    	echo '<tr class="wardlistrow2">';
    	echo'
    		<td>&nbsp;</td><td><b>'.$content['quantity'].'</b>&nbsp;'.$content['packing'] .'</td>		
    		<td><font size=1>'.$content['artikelname'].' - '.$content['dose']. ' - ' .$content['packing'] .'</font></td>
    		</td>
    		<td ><font size=1><nobr>&nbsp;X '.$content['proorder'].'</nobr></font></td>
    		<td><font size=1>'.$content['bestellnum'].'</font></td>
    		<td><a href="javascript:popinfo(\''.$content['bestellnum'].'\')" ><img '.$img_info.' alt="'.$complete_info.$content['artikelname'].'"></a></td>
    		<td><a href="'.$thisfile.URL_APPEND.'&dept_nr='.$dept_nr.'&order_nr='.$order_nr.'&mode=delete&cat='.$cat.'&keyword='.$content['item_no'].'&userck='.$userck.'" ><img '.$img_delete.' alt="'.$LDRemoveArticle.'"></a></td>
    		</tr>';
    		//gjergji:get how many of this product do i have in the care_med/pharma_producs_main_sub
    		if($cat=='medlager'){
    			$ergebnis_sub=&$product_obj_sub->ActualOrderCatalogProducts('medsub',$content['bestellnum']);
    		}else{
    			$ergebnis_sub=&$product_obj_sub->ActualOrderCatalogPharma('pharmasub',$content['bestellnum'],$pharma_nr['pharma_dept_nr']);
    		}
    		$rows_sub=$product_obj_sub->LastRecordCount();
    		if($rows_sub) {
    			while($content_sub=$ergebnis_sub->FetchRow()) {
    				echo '
    				 <td><a href="javascript:add2basket(\''.$content['bestellnum'].'\',\''.$i.'\',\''.$content_sub['id'].'\',\''.$content['artikelname'].'\')"><img '.$img_leftarrow.' alt="'.$LDPut2BasketAway.'"></a></td>
      				 <td><input type="checkbox" name="order'.$i.'" value="1">
    				 <td align="right"><input type="text" onKeyUp="validate_value(this,1,'.$content_sub['pcs'].')" name="p'.$i.'" size=5 maxlength=5 ';
    				$o="order".$i;
    				$pc="p".$i;
    				if(($$o) &&($$pc=='')) $$pc=$mi;			 
    				if($$pc!='') echo ' value="'.$$pc.'">'; 
    				else {
    					  echo 'value="">';
    				} 
    				echo '<input type="hidden" name="bestellnum'.$i.'" value="'.$content['bestellnum'].'">';
    				echo '<input type="hidden" name="art'.$i.'" value="'.$content['artikelname'].'">'; 				 
    				echo '<input type="hidden" name="idsub'.$i.'" value="'.$content_sub['id'].'">'; 				 
    				echo '<td align="right">'.$content_sub['pcs'].'</td><td align="right">'.$content_sub['expiry_date'].'</td><tr>';
    				//gjergji:had to put it here to correctly generate p+i on the input boxes
    				$i++;
    			}
    		}
    }
    echo '</table>';
    	echo '<p>
    		<input type="hidden" name="maxcount" value="'.($i-1).'">
    		<input type="hidden" name="sid" value="'.$sid.'">
    		<input type="hidden" name="lang" value="'.$lang.'">
    		<input type="hidden" name="cat" value="'.$cat.'">
    		<input type="hidden" name="order_nr" value="'.$order_nr.'">
    		<input type="hidden" name="dept_nr" value="'.$dept_nr.'">
    		<input type="hidden" name="mode" value="multiadd">
    		<input type="hidden" name="userck" value="'.$userck.'">';
    	if($rows > 1) echo '<input type="submit" value="'.$LDPutNBasket.'">';
    	echo '</form>';
}
    
    if(isset($mode)&&($mode=="multiadd")) {
     	echo '<script language="javascript">window.parent.BESTELLKORB.location.href="products-bestellkorb.php'.URL_REDIRECT_APPEND.'&dept_nr='.$dept_nr.'&order_nr='.$order_nr.'&mode=multiadd&cat='.$cat.'&maxcount='.$maxcount.'&userck='.$userck;
    	for($i=1;$i<=$maxcount;$i++) {
    		$o="order".$i;
    		$pc="p".$i;
    		$art="art".$i;
    		$idsub="idsub".$i;
    		if((!$$o)||($$pc=="0")) continue;
    		$b="bestellnum".$i;
    		if($$pc=="") $$pc=1; // what ?!
    		echo '&bestellnum'.$i.'='.$$b.'&pcs'.$i.'='.$$pc.'&art'.$i.'='.$$art.'&idsub'.$i.'='.$$idsub;
    	}
    	echo'"</script>';
	}
?>
</body>
</html>
