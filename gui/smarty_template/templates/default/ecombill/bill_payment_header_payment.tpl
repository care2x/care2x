	<table border="0" width="80%" bordercolor="#000000">
		<tr bgcolor="#ffffff">
			<td align="left" colspan="3">{{$LDSelecttheModeofCurrentPayment}}</td>
		</tr>
		<tr bgcolor="#eeeeee">
			<td align="left">
				<label for="c6"><strong>{{$LDCash}}</strong></label>
				<input type="checkbox" name="C6" id="c6" value="ON" />
			</td>
			<td align="left" colspan="2">
				<label for="amtcash">{{$LDAmount}}</label>
				<input type="text" name="amtcash" id="amtcash" size="7" />
			</td>
		</tr>
		<tr bgcolor="#ffffff">
			<td align="left">
				<label for="C7"><strong>{{$LDCreditCard}}</strong></label>
				<input type="checkbox" name="C7" id="C7" value="ON" />
			</td>				
			<td align="left">
				 <label for="cdno">{{$LDCardNumber}}</label>
				<input type="text" name="cdno" id="cdno" size="12" />
			</td>				
			<td align="left">
				<label for="amtcc">{{$LDAmount}}</label>
				<input type="text" name="amtcc" id="amtcc" size="7" />
			</td>				
		</tr>
		<tr bgcolor="#ffffff">
			<td align="left">
				{{$LDCCType}}
			</td>
			<td align="left">
				<label for="V5">Mastercard</label>
				<input type="radio" checked="checked" name="R1" value="V5" id="V5"/>
				<label for="V6">Visa</label>
				<input type="radio" name="R1" value="V6" id="V6"/>							
			</td>
			<td align="left">
				<label for="V7">American Express</label>
				<input type="radio" name="R1" value="V7" id="V7"/>				
			</td>
		</tr>
		<tr bgcolor="#eeeeee">		
			<td align="left">
				<label for="C8"><strong>{{$LDCheck}}</strong></label>
				<input type="checkbox" name="C8" value="ON" id="C8" />
			</td>				
			<td align="left">				
				<label for="chkno">{{$LDCheckNumber}}</label>
				<input type="text" name="chkno" id="chkno" size="12" />
			</td>				
			<td align="left">				
				<label for="amtcheque">{{$LDAmount}}</label>
				<input type="text" name="amtcheque" id="amtcheque" size="7" />
			</td>
		</tr>
	</table>