<table border="0" width="80%" bordercolor="#000000">
	<tr bgColor="#eeeeee">
		<td align="left" colspan="2">{{$LDModeofPayment}}</td>
	</tr>
	<tr bgColor="#eeeeee">
		<td align="left">
			{{$LDCheck}} 
			<input type="hidden" name="chkno" value="{{$chkno}}">
			<input type="hidden" name="amtcheque" value="{{$amtcheque}}">
		</td>
		<td align="right">
			{{$LDCheckNumber}}
		</td>
		<td align="right">
			{{$checkAmount}}
		</td>
	</tr>
	<tr>
		<td colspan="2" align="right">
			{{$LDCheckNumberData}}
		</td>
		<td align="right">
			{{$checkAmountData}}
		</td>
	</tr>	
</table>