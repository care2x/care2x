<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_products_search_result_mod.php",$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/
///$db->debug =  true;
# If smarty object is not available create one
if(!isset($smarty)){
	/**
 * LOAD Smarty
 * param 2 = FALSE = dont initialize
 * param 3 = FALSE = show no copyright
 * param 4 = FALSE = load no javascript code
 */
	include_once($root_path.'gui/smarty_template/smarty_care.class.php');
	$smarty = new smarty_care('common',FALSE,FALSE,FALSE);
	
	# Set a flag to display this page as standalone
	$bShowThisForm=TRUE;
}

if ($bcat)
	$LDMSRCindex [''] = ""; // if parent is order catalog add one empty column at the end ?!?
if($update||($mode=="search")){

	switch ( $cat) {
		case "pharma":
							$imgpath=$root_path."pharma/img/";
							break;
		case "medlager":
							$imgpath=$root_path."med_depot/img/";
							break;
	}

	if ($saveok || (! $update))
		$statik = true;
	
	if ($linecount) {
		 # Assign form elements
		$smarty->assign('LDOrderNr',$LDOrderNr);
		$smarty->assign('LDArticleName',$LDArticleName);
		$smarty->assign('LDGeneric',$LDGeneric);
		$smarty->assign('LDDescription',$LDDescription);
		$smarty->assign('LDPacking',$LDPacking);
		$smarty->assign ( 'LDDoza', $LDDoza );
		$smarty->assign('LDCAVE',$LDCAVE);
		$smarty->assign('LDCategory',$LDCategory);
		$smarty->assign('LDMinOrder',$LDMinOrder);
		$smarty->assign('LDMaxOrder',$LDMaxOrder);
		$smarty->assign('LDPcsProOrder',$LDPcsProOrder);
		$smarty->assign('LDIndustrialNr',$LDIndustrialNr);
		$smarty->assign('LDLicenseNr',$LDLicenseNr);
		$smarty->assign ( 'LDMinPieces', $LDMinPieces );
		$smarty->assign('LDPicFile',$LDPicFile);

		//echo $linecount;
		if ($linecount == 1) {
			$zeile=$ergebnis->FetchRow();
			# Assign the preview picture

			if(($statik||$update)&&($zeile['picfile']!="")){
				$smarty->assign('LDPreview',$LDPreview);
	 			$sTemp = '<img src="'.$imgpath.$zeile['picfile'].'" border=0 name="prevpic" ';
				if (! $update || $statik) {
					if (file_exists ( $imgpath . $zeile ['picfile'] )) {
						$imgsize=GetImageSize($imgpath.$zeile['picfile']);
						$sTemp =$sTemp.$imgsize[3];
					}
				}
				$smarty->assign('sProductImage',$sTemp.'>');
			}else{
				$smarty->assign('sProductImage','<img src="../../gui/img/common/default/pixel.gif" border=0 name="prevpic">');
			}

			# Assign form inputs (or values)


			if ($statik || $update)
				$smarty->assign ( 'sOrderNrInput', $zeile ['bestellnum'] . '</b><input type="hidden" name="bestellnum" value="' . $zeile ['bestellnum'] . '">' ); 
			else
				$smarty->assign ( 'sOrderNrInput', '<input type="text" name="bestellnum" value="' . $zeile ['bestellnum'] . '" size=20 maxlength=20>' );

			if ($statik){
				$smarty->assign('sArticleNameInput',$zeile['artikelname'].'<input type="hidden" name="artname" value="'.$zeile['artikelname'].'">');
				$smarty->assign('sGenericInput',$zeile['generic'].'<input type="hidden" name="generic" value="'.$zeile['generic'].'">');
				$smarty->assign('sDescriptionInput',nl2br($zeile['description']).'<input type="hidden" name="besc" value="'.$zeile['description'].'">');
				$smarty->assign('sPackingInput',$zeile['packing'].'<input type="hidden" name="pack" value="'.$zeile['packing'].'">');
				$smarty->assign ( 'sDoseInput', $zeile ['dose'] . '<input type="hidden" name="dose" value="' . $zeile ['dose'] . '">' );
				$smarty->assign('sCAVEInput',$zeile['cave'].'<input type="hidden" name="caveflag" value="'.$zeile['cave'].'">');
				$smarty->assign('sCategoryInput',$zeile['medgroup'].'<input type="hidden" name="medgroup" value="'.$zeile['medgroup'].'">');
				$smarty->assign('sMinOrderInput',$zeile['minorder'].'<input type="hidden" name="minorder" value="'.$zeile['minorder'].'">');
				$smarty->assign('sMaxOrderInput',$zeile['maxorder'].'<input type="hidden" name="maxorder" value="'.$zeile['maxorder'].'">');
				$smarty->assign('sPcsProOrderInput',$zeile['proorder'].'<input type="hidden" name="proorder" value="'.$zeile['proorder'].'">');
				$smarty->assign('sIndustrialNrInput',$zeile['artikelnum'].'<input type="hidden" name="artnum" value="'.$zeile['artikelnum'].'">');
				$smarty->assign('sLicenseNrInput',$zeile['industrynum'].'<input type="hidden" name="indusnum" value="'.$zeile['industrynum'].'">');
				$smarty->assign ( 'sMinPiecesInput', $zeile ['minpcs'] . '<input type="hidden" name="minpcs" value="' . $zeile ['minpcs'] . '">' );
				$smarty->assign('sPicFileInput',$zeile['picfile'].'<input type="hidden" name="bild" value="'.$zeile['picfile'].'">');
			}else{
				$smarty->assign('sArticleNameInput','<input type="text" name="artname" value="'.$zeile['artikelname'].'" size=40 maxlength=40>');
				$smarty->assign('sGenericInput','<input type="text" name="generic" value="'.$zeile['generic'].'" size=40 maxlength=60>');
				$smarty->assign('sDescriptionInput','<textarea name="besc" cols=35 rows=4>'.$zeile['description'].'</textarea>');
				$smarty->assign('sPackingInput','<input type="text" name="pack" value="'.$zeile['packing'].'"  size=40 maxlength=40>');
				$smarty->assign ( 'sDoseInput', '<input type="text" name="dose" value="' . $zeile ['dose'] . '" size=40 maxlength=80>' );
				$smarty->assign('sCAVEInput','<input type="text" name="caveflag" value="'.$zeile['cave'].'" size=40 maxlength=80>');
				$smarty->assign('sCategoryInput','<input type="text" name="medgroup" value="'.$zeile['medgroup'].'" size=20 maxlength=40>');
				$smarty->assign('sMinOrderInput','<input type="text" name="minorder" value="'.$zeile['minorder'].'" size=20 maxlength=9>');
				$smarty->assign('sMaxOrderInput','<input type="text" name="maxorder" value="'.$zeile['maxorder'].'" size=20 maxlength=9>');
				$smarty->assign('sPcsProOrderInput','<input type="text" name="proorder" value="'.$zeile['proorder'].'" size=20 maxlength=40>');
				$smarty->assign ( 'sIndustrialNrInput', '<input type="text" name="artnum" value="' . $zeile ['artikelnum'] . '" size=20 maxlength=20>' );
				$smarty->assign ( 'sLicenseNrInput', '<input type="text" name="indusnum" value="' . $zeile ['industrynum'] . '" size=20 maxlength=20>' );
				$smarty->assign ( 'sMinPiecesInput', '<input type="text" name="minpcs" value="' . $zeile ['minpcs'] . '" size=20 maxlength=20>' );
				$smarty->assign('sPicFileInput','<input type="file" name="bild" onChange="getfilepath(this)">');
			}
				# If display is forced
			if ($bShowThisForm)
				$smarty->display ( 'products/form.tpl' );

			}else{
				echo "<p>".str_replace("~nr~",$linecount,$LDFoundNrData)."<br>$LDClk2SeeInfo<p>";

					echo "<table border=0 cellpadding=3 cellspacing=1> ";
		
					echo '<tr class="wardlisttitlerow">';

			for($i = 0; $i < sizeof ( $LDMSRCindex ) - 1; $i ++) {
						echo '<td>'.$LDMSRCindex[$i].'</td>';
					}
					echo "</tr>";

					/* Load common icons */
					$img_info=createComIcon($root_path,'info3.gif','0');
					$img_arrow=createComIcon($root_path,'dwnarrowgrnlrg.gif','0');
			while ( $row = $ergebnis->fetchRow ($result) ) {
						echo "<tr class=";
				if ($toggle) {
					echo "wardlistrow2>";
					$toggle = 0;
				} else {
					echo "wardlistrow1>";
					$toggle = 1;
				};
				echo '<td valign="top"><a href="' . $thisfile . URL_APPEND . '&dept_nr=' . $dept_nr . '&keyword=' . $row ['bestellnum'] . '&mode=search&from=multiple&cat=' . $cat . '&userck=' . $userck . '"><img ' . $img_info . ' alt="' . $LDOpenInfo . $row ['artikelname'] . '"></a></td>
						<td valign="top"><font size=1>' . $row ['bestellnum'] . '</td>
						<td valign="top"><font size=1>' . $row ['artikelnum'] . '</td>
						<td valign="top"><font size=1>' . $row ['qty'] . '</td>
						<td valign="top"><a href="' . $thisfile . URL_APPEND . '&dept_nr=' . $dept_nr . '&keyword=' . $row ['bestellnum'] . '&mode=search&from=multiple&cat=' . $cat . '&userck=' . $userck . '"><font size=2 color="#800000"><b>' . $row ['artikelname'] . '</b></font></a></td>
						<td valign="top"><font size=1>' . $row ['generic'] . '</td>
						<td valign="top"><font size=1>' . $row ['description'] . '</td>
									';
						// if parent is order catalog add this option column at the end
				if ($bcat)
					echo '<td valign="top"><a href="' . $thisfile . URL_APPEND . '&dept_nr=' . $dept_nr . '&mode=save&artikelname=' . str_replace ( "&", "%26", strtr ( $row ['artikelname'], " ", "+" ) ) . '&bestellnum=' . $row ['bestellnum'] . '&proorder=' . str_replace ( " ", "+", $row ['proorder'] ) . '&hit=0&cat=' . $cat . '&userck=' . $userck . '"><img ' . $img_arrow . ' alt="' . $LDPut2Catalog . '"></a></td>';
				echo '</tr>';
					}
					echo "</table>";
			if ($linecount > 15) {
				echo '<a href="#pagetop">' . $LDPageTop . '</a>';
					}//end of if $linecount>15


			}//end of else
	}else{
		echo '
			<p><img '.createMascot($root_path,'mascot1_r.gif','0','middle').'>
			'.$LDNoDataFound;
	}
}
?>
