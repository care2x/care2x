{{* form.tpl  Form template for products module (pharmacy & meddepot) 2004-07-04 Elpidio Latorilla *}}

<font class="prompt">{{$sSaveFeedBack}}</font>
<font class="warnprompt">{{$sMascotImg}} {{$LDOrderNrExists}} <br> {{$sNoSave}}</font>

{{$sFormStart}}

	{{* NOTE:::  The following table  block must be inside the $sFormStart and $sFormEnd tags !!! *}}

	<table border=0 cellspacing=1 cellpadding=3>
	<tbody class="submenu">
		<tr>
		<td align=right width=140 class="prompt">{{$LDOrderNr}}</td>
		<td>{{$sOrderNrInput}}</td>
		<td rowspan=14 valign=top>{{$LDPreview}} <br> {{$sProductImage}}</td>
		</tr>
		<tr>
		<td align=right width=140>{{$LDArticleName}}</td>
		<td>{{$sArticleNameInput}}</td>
		</tr>
		<tr>
		<td align=right width=140>{{$LDGeneric}}</td>
		<td>{{$sGenericInput}}</td>
		</tr>
		<tr>
		<td align=right width=140>{{$LDDescription}}</td>
		<td>{{$sDescriptionInput}}</td>
		</tr>
		<tr>
		<td align=right width=140>{{$LDPacking}}</td>
		<td>{{$sPackingInput}}</td>
		</tr>
		<tr>
		<td align=right width=140>{{$LDDose}}</td>
		<td>{{$sDoseInput}}</td>
		</tr>			
		<tr>
		<td align=right width=140>{{$LDCAVE}}</td>
		<td>{{$sCAVEInput}}</td>
		</tr>
		<tr>
		<td align=right width=140>{{$LDCategory}}</td>
		<td>{{$sCategoryInput}}</td>
		</tr>
		<tr>
		<td align=right width=140>{{$LDMinOrder}}</td>
		<td>{{$sMinOrderInput}}</td>
		</tr>
		<tr>
		<td align=right width=140>{{$LDMaxOrder}}</td>
		<td>{{$sMaxOrderInput}}</td>
		</tr>
		<tr>
		<td align=right width=140>{{$LDPcsProOrder}}</td>
		<td>{{$sPcsProOrderInput}}</td>
		</tr>
		<tr>
		<td align=right width=140>{{$LDIndustrialNr}}</td>
		<td>{{$sIndustrialNrInput}}</td>
		</tr>
		<tr>
		<td align=right width=140>{{$LDLicenseNr}}</td>
		<td>{{$sLicenseNrInput}}</td>
		</tr>
		<tr>
		<td align=right width=140>{{$LDMinPieces}}</td>
		<td>{{$sMinPiecesInput}}</td>
		</tr>		
		<tr>
		<td align=right width=140>{{$LDPicFile}}</td>
		<td>{{$sPicFileInput}}</td>
		</tr>
		<tr>
		<td align=right width=140>{{$LDReset}}</td>
		<td align=right>{{$LDSave}} {{$sUpdateButton}}</td>
		</tr>
	</tbody>
	</table>

	{{* Do not move $sHiddenInputs outside the form block*}}
	{{$sHiddenInputs}}
	
	{{$sNewProduct}}

{{$sFormEnd}}

{{$sBreakButton}}
