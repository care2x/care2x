<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');

$lang_tables[]='products.php';
define('LANG_FILE','products.php');
$local_user='ck_supply_db_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

require_once($root_path.'include/care_api_classes/class_product.php');
$product_obj=new Product;

require_once($root_path.'include/care_api_classes/class_supplier.php');
$supplier_obj=new Supplier;
# Load date formatter
require_once($root_path.'include/core/inc_date_format_functions.php');
$thisfile=basename(__FILE__);

//$db->debug=1;

$dbtable='care_supply';

if(($mode=='search')&&($keyword!='')&&($keyword!='%')){
 	if($keyword=="*%*") $keyword="%";
 	 include('includes/inc_products_search_mod.php');
}elseif(($mode=='save')&&($bestellnum!='')&&($artikelname!='')){ 		
	$saveok=$product_obj->SaveCatalogItemSupply($_GET,$cat);
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
function popinfo(b){
	urlholder="supplier-bestellkatalog-popinfo.php<?php echo URL_REDIRECT_APPEND; ?>&keyword="+b+"&mode=search&cat=<?php echo $cat; ?>";
	ordercatwin=window.open(urlholder,"ordercat","width=850,height=550,menubar=no,resizable=yes,scrollbars=yes");
}

function add2basket(b,i){
	if(eval("document.curcatform.p"+i+".value")=="0")	{
		eval("document.curcatform.p"+i+".value=''");
		eval("document.curcatform.p"+i+".focus()");
		return;
	}
	
	var n;
	var nc;
	var nv;
	var ns;
	if(eval("document.curcatform.p"+i+".value")=="") { 
		n=1;
	}else{
		n=eval("document.curcatform.p"+i+".value");
	}
	
	nc=eval("document.curcatform.c"+i+".value");
	if(nc=='') {alert('Nuk eshte dhene vlera e cmimit');exit();}; 
	nv=eval("document.curcatform.v"+i+".value");
	if(nv=='') {alert('Nuk eshte dhene vlera ');exit();}; 
	ns=eval("document.curcatform.s"+i+".value");
	if(ns=='') {alert('Nuk eshte dhene vlera per daten e skadences');exit();}; 
	window.parent.BESTELLKORB.location.href="supply-bestellkorb.php<?php echo URL_REDIRECT_APPEND."&userck=$userck" ?>&supplier_nr=<?php echo $supplier_nr; ?>&idcare_supply=<?php echo $idcare_supply; ?>&mode=add&cat=<?php echo $cat; ?>&maxcount=1&order1=1&bestellnum1="+b+"&p1="+n+"&c1="+nc+"&v1="+nv+"&s1="+ns;
}

function add_update(b,i){
	
	var nc;
	var nv;
	var ns;
	nc=eval("document.vogel.c"+i+".value");	 
	nv=eval("document.vogel.v"+i+".value");
	ns=eval("document.vogel.s"+i+".value");
	window.parent.BESTELLKORB.location.href="supply-bestellkorb.php<?php echo URL_REDIRECT_APPEND."&userck=$userck" ?>&supplier_nr=<?php echo $supplier_nr; ?>&idcare_supply=<?php echo $idcare_supply; ?>&mode=add&cat=<?php echo $cat; ?>&maxcount=1&order1=1&bestellnum1="+b+"&p1=1"+"&c1="+nc+"&v1="+nv+"&s1="+ns;
}

function checkform(d){

	for (i=1;i<=d.maxcount.value;i++) {
		if (eval("d.order"+i+".checked")) { 
			nc=eval("document.curcatform.c"+i+".value");
			if(nc=='') {alert('Nuk eshte dhene vlera e cmimit');return false;}; 
			nv=eval("document.curcatform.v"+i+".value");
			if(nv=='') {alert('Nuk eshte dhene vlera ');return false;}; 
			ns=eval("document.curcatform.s"+i+".value");
			if(ns=='') {alert('Nuk eshte dhene vlera per daten e skadences');return false;}; 
			return true;
		}
	}
	return false;
}

function llogaritVleren(i) {
	var value = eval("document.curcatform.v"+i);
	value.value = eval("document.curcatform.c"+i+".value") * eval("document.curcatform.p"+i+".value");
}

function resize() {
	parent.document.getElementById("products").cols = "10%,70%";
}
</script>

<script language="javascript" src="<?php echo $root_path; ?>js/products_validate_order_num.js"></script>
<?php 
require($root_path.'include/core/inc_js_gethelp.php');
require($root_path.'include/core/inc_css_a_hilitebu.php');
?>
</head>
<BODY  topmargin=5 leftmargin=10  marginwidth=10 marginheight=5 onLoad="document.smed.keyword.focus()"
<?php echo "bgcolor=".$cfg['body_bgcolor'];  if (!$cfg['dhtml']){ echo ' link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } ?>>
<?php //foreach($argv as $v) echo "$v<br>"; ?>

<table><tr><td>
<a href="javascript:resize()"><img <?php echo $img_leftarrow ?> alt="Zgjero"></a>
</td><td>
<a href="javascript:gethelp('products.php','catalog','','<?php echo $cat ?>')"><img <?php echo createComIcon($root_path,'frage.gif','0','right') ?> alt="<?php echo 
$LDOpenHelp ?>"></a>
</td></tr></table>
<form action="<?php echo $thisfile; ?>" method="get" name="smed">
<font face="Verdana, Arial" size=1 color=#800000><?php echo $LDSearchKey ?>:
<br>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang?>">
<input type="hidden" name="mode" value="search">
<input type="text" name="keyword" size=20 maxlength=40>
<input type="hidden" name="idcare_supply" value="<?php echo $idcare_supply?>">
<input type="hidden" name="supplier_nr" value="<?php echo $supplier_nr?>">
<input type="hidden" name="cat" value="<?php echo $cat?>">
<input type="hidden" name="userck" value="<?php echo $userck?>">
<input type="submit" value="<?php echo $LDSearchArticle ?>">
</font>
</form>

<?php 
$searchvar=1;
if (isset($mode)&&($mode=='search')&&($keyword!='')) {
	if($linecount)	{
	//set order catalog flag
	/**
	* The following routine displays the search results
	*/			
				echo "<p><font size=1>".str_replace("~nr~",$linecount,$LDFoundNrData)."<br>
						$LDClk2SeeInfo</font><br>";

					$ergebnis->MoveFirst();
					echo '<form name="vogel"><table border=0 cellpadding=3 cellspacing=1> 
					  		<tr class="wardlisttitlerow">';
					for ($i=0;$i<sizeof($LDGenindexSupply);$i++)
					echo '
							<td><font color="#000080">'.$LDGenindexSupply[$i].'</font></td>';
					echo '</tr>';	

					while($zeile=$ergebnis->FetchRow()){
						echo '<tr class="';
						if($toggle) { echo 'wardlistrow2">'; $toggle=0;} else {echo 'wardlistrow1">'; $toggle=1;};
						echo '
									<td valign="top"><!--<a href="'.$thisfile.URL_APPEND.'&idcare_supply='.$idcare_supply.'&supplier_nr='.$supplier_nr.'&mode=save&cat='.$cat.'&artikelname='.str_replace("&","%26",strtr($zeile['artikelname']," ","+")).'&bestellnum='.$zeile['bestellnum'].'&minorder='.$zeile['minorder'].'&maxorder='.$zeile['maxorder'].'&proorder='.str_replace(" ","+",$zeile['proorder']).'&hit=0&userck='.$userck.'" onClick="add_update(\''.$zeile['bestellnum'].'\',\''.$searchvar.'\')"><img '.$img_leftarrow.' alt="'.$LDPut2BasketAway.'"></a>--></td>		
									<td valign="top"><a href="'.$thisfile.URL_APPEND.'&idcare_supply='.$idcare_supply.'&supplier_nr='.$supplier_nr.'&mode=save&cat='.$cat.'&artikelname='.str_replace("&","%26",strtr($zeile['artikelname']," ","+")).'&bestellnum='.$zeile['bestellnum'].'&minorder='.$zeile['minorder'].'&maxorder='.$zeile['maxorder'].'&proorder='.str_replace(" ","+",$zeile[proorder]).'&hit=0&userck='.$userck.'"><img '.$img_dwnarrow.' alt="'.$LDPut2Catalog.'"></a></td>		
									<td valign="top"><a href="javascript:popinfo(\''.$zeile['bestellnum'].'\')" ><img '.$img_info.' alt="'.$complete_info.$zeile['artikelname'].' - '.$LDClk2See.'"></a></td>
									<td valign="top"><a href="javascript:popinfo(\''.$zeile['bestellnum'].'\')" ><font color="#800000">'.$zeile['artikelname'].' - '.$zeile['dose']. ' - ' .$zeile['packing'] . '</font></a></td>
									<td valign="top"><font size=1>'.$zeile['generic'].'</font></td>
									<td valign="top"><font size=1>';
						if(strlen($zeile['description'])>40) echo substr($zeile['description'],0,40)."...";
							else echo $zeile['description'];
						echo '
									</font></td>'; 
						echo    '
									</tr>';
					$searchvar++;
					}
					echo "</table></form>";
	}
	else
		echo "
			<p>$LDNoDataFound";
echo '<p>';
}

# get the actual order catalog

$ergebnis=&$product_obj->ActualOrderCatalogSupply($supplier_nr,$cat); 
$rows= $product_obj->LastRecordCount();
# show catalog
if($rows){
	echo'
			<form name="curcatform" onSubmit="return checkform(this)">';
$tog=1;
echo '
		<font color="#800000">'.$LDCatalogSupplier.' :: ';
		echo $supplier_obj->FormalName($supplier_nr);
		echo '</font>
		<table border=0 cellspacing=1 cellpadding=3 width="100%">
  		<tr class="wardlisttitlerow">';
	for ($i=0;$i<sizeof($LDCindexSupplier);$i++)
	echo '
		<td><font color="#000080">'.$LDCindexSupplier[$i].'</font></td>';

$i=$searchvar;
$mi=2;
$mx=10;


# The following routine displays the contents of the current catalog

$tog=1;
require_once ('../../js/jscalendar/calendar.php');
$calendar = new DHTML_Calendar('../../js/jscalendar/', $lang, 'calendar-system', true);
$calendar->load_files();

while($content=$ergebnis->FetchRow()){
	if($tog) { echo '<tr class="wardlistrow1">'; $tog=0; }else{ echo '<tr class="wardlistrow2">'; $tog=1; }
	echo'
    			<td><a href="javascript:add2basket(\''.$content['bestellnum'].'\',\''.$i.'\')"><img '.$img_leftarrow.' alt="'.$LDPut2BasketAwayF.'"></a></td>
  				 <td><input type="checkbox" name="order'.$i.'" value="1">
				 		<input type="hidden" name="bestellnum'.$i.'" value="'.$content['bestellnum'].'"></td>		
				<td><font size=1>'.$content['artikelname'].'</font></td>
				<td><input type="text" name="p'.$i.'" size=6 maxlength=6 ';
	$o="order".$i;
	$pc="p".$i;
	if(($$o) &&($$pc=='')) $$pc=$mi;			 
	if($$pc!='') echo ' value="'.$$pc.'">'; else
	{
	  echo 'value="';
	  if($content['minorder']) echo $content['minorder']; else echo '1';
	  echo '">';
	}
	echo '
				</td>';				
	echo		'<td ><font size=1><nobr>&nbsp;X '.$content['proorder'].'</nobr></font></td>
				<td><input type="text" name="c'.$i.'" size="6" maxlength="6" value="" onBlur="llogaritVleren('.$i.')"></td>
				<td><input type="text" name="v'.$i.'" size="12" maxlength="10" value=""></td>
				<td>';
	$fieldName = 's' . $i;
	echo $calendar->show_calendar($calendar,$date_format,$fieldName);			
	echo		'</td>
				<td><font size=1>'.$content['bestellnum'].'</font></td>
				<td><a href="javascript:popinfo(\''.$content['bestellnum'].'\')" ><img '.$img_info.' alt="'.$complete_info.$content['artikelname'].'"></a></td>
				<td><a href="'.$thisfile.URL_APPEND.'&supplier_nr='.$supplier_nr.'&idcare_supply='.$idcare_supply.'&mode=delete&cat='.$cat.'&keyword='.$content['item_no'].'&userck='.$userck.'" ><img '.$img_delete.' alt="'.$LDRemoveArticle.'"></a></td>
				</tr>';

	$i++;
	$searchvar=$i;
}
	echo '
			</table>';
			
	echo '
			<p>
			<input type="hidden" name="maxcount" value="'.$rows.'">
			<input type="hidden" name="sid" value="'.$sid.'">
			<input type="hidden" name="lang" value="'.$lang.'">
			<input type="hidden" name="cat" value="'.$cat.'">
			<input type="hidden" name="idcare_supply" value="'.$idcare_supply.'">
			<input type="hidden" name="supplier_nr" value="'.$supplier_nr.'">
			<input type="hidden" name="mode" value="multiadd">
			<input type="hidden" name="userck" value="'.$userck.'">
			<input type="submit" value="'.$LDPutNBasketF.'">
			</form>';
}


if(isset($mode)&&($mode=="multiadd"))
{
 	echo '
			<script language="javascript">
			window.parent.BESTELLKORB.location.href="supply-bestellkorb.php'.URL_REDIRECT_APPEND.'&supplier_nr='.$supplier_nr.'&idcare_supply='.$idcare_supply.'&mode=add&cat='.$cat.'&maxcount='.$maxcount.'&userck='.$userck;
	for($i=1;$i<=$maxcount;$i++)
	{
		$o="order".$i;
		$pc="p".$i;
		$c="c".$i; 
		$v="v".$i;
		$s="s".$i;
		if((!$$o)||($$pc=="0")) continue;
		$b="bestellnum".$i;
		if($$pc=="") $$pc=1;
		echo '&order'.$i.'='.$$o.'&bestellnum'.$i.'='.$$b.'&p'.$i.'='.$$pc.'&c'.$i.'='.$$c.'&v'.$i.'='.$$v.'&s'.$i.'='.$$s;
	}
	echo'"
			</script>';
}		
?>
</body>
</html>
