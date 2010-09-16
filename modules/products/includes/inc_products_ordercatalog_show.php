<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr("inc_products_ordercatalog_show.php",$_SERVER['SCRIPT_NAME'])) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

if($rows){
	# Load the common icon images 
	$img_info=createComIcon($root_path,'info3.gif','0');
	$img_delete=createComIcon($root_path,'delete2.gif','0');

	$tog=1;
	print '
		<font color="#800000">'.$LDCatalog.':</font>
		<table border=0 cellspacing=1 cellpadding=0>
  		<tr class="wardlisttitlerow">';
	for ($i=0;$i<sizeof($LDMCindex);$i++)
	print '
		<td>&nbsp;'.$LDMCindex[$i].'&nbsp;</td>';
	print '<td></td></tr>';	

	while($content=$ergebnis->FetchRow())
	{
		if($tog){
			print '<tr class="wardlistrow2">'; $tog=0; }else{ print '<tr class="wardlistrow1">'; $tog=1; }
		print'
				<td>&nbsp;<a href="javascript:popinfo(\''.$content['bestellnum'].'\')" ><img '.$img_info.' alt="'.$LDOpenInfo.$content['artikelname'].'"></a>&nbsp;</td>
				<td>&nbsp;'.$content['artikelname'].'&nbsp;</td>
				<td>&nbsp;&nbsp;'.$content['proorder'].'&nbsp;</td>
				<td>&nbsp;'.$content['bestellnum'].'&nbsp;</td>
				<td>&nbsp;<a href="'.$thisfile.URL_APPEND.'&dept_nr='.$dept_nr.'&mode=delete&keyword='.$content['item_no'].'&cat='.$cat.'" ><img '.$img_delete.' alt="'.$LDRemoveArticle.'"></a>&nbsp;</td>
				</tr>
				  <tr>
    			<td colspan=5 class="thinrow_vspacer"><img src="'.$root_path.'gui/img/common/default/pixel.gif" border=0 width=1 height=1 align="absmiddle"></td>
  				</tr>';
	}
	print '
		</table>
		</font>';
}
?>
