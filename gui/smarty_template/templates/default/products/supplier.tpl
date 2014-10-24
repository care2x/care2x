{{* form.tpl  Form template for products module (pharmacy & meddepot) 2004-07-04 Elpidio Latorilla *}}

<font class="prompt">{{$sSaveFeedBack}}</font>
<font class="warnprompt">{{$sMascotImg}} {{$LDOrderNrExists}} <br> {{$sNoSave}}</font>

{{$sFormStart}}

	{{* NOTE:::  The following table  block must be inside the $sFormStart and $sFormEnd tags !!! *}}

	<table border=0 cellspacing=1 cellpadding=3>
	<tbody class="submenu">
		<tr>
		<td align=right width=140 class="prompt">{{$LDSupplier}}</td>
		<td>{{$sSupplier}}</td>
		<tr>
		<td align=right width=140>{{$LDAddress}}</td>
		<td>{{$sAddress}}</td>
		</tr>
		<tr>
		<td align=right width=140>{{$LDTelephone}}</td>
		<td>{{$sTelephone}}</td>
		</tr>
		<tr>
		<td align=right width=140>{{$LDFax}}</td>
		<td>{{$sFax}}</td>
		</tr>
		<tr>
		<td align=right width=140>{{$LDKodiPostar}}</td>
		<td>{{$sKodiPostar}}</td>
		</tr>
		<tr>
		<td align=right width=140>{{$LDRepresentative}}</td>
		<td>{{$sRepresentative}}</td>
		</tr>
		<tr>
		<td align=right width=140>{{$LDReset}}</td>
		<td align=right>{{$LDSave}} {{$sUpdateButton}}</td>
		</tr>
	</tbody>
	</table>

	{{* Do not move $sHiddenInputs outside the form block*}}
	{{$sHiddenInputs}}
	
	{{$sNewSupplier}}

{{$sFormEnd}}

{{$sBreakButton}}
