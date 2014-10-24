<table border="0" width="80%" bordercolor="#000000">
	<tr bgColor="#eeeeee">
		<td align="left" colspan="4">{{$LDModeofPayment}}</td>
	</tr>
	<tr bgColor="#eeeeee">
		<td align="left">
			{{$LDCreditCard}} 		
			<input type="hidden" name="cdno" value="{{$cdno}}">
			<input type="hidden" name="amtcc" value="{{$amtcc}}">
		<td align="right">
			{{$LDCardNumber}}
		</td>
		<td align="right">
			{{$LDAmount}}
		</td>
	</tr>
	<tr>
		<td colspan="2" align="right">
			{{$LDCardNumberData}}
		</td>
		<td align="right">
			{{$LDAmountData}}
		</td>
	</tr>
</table>