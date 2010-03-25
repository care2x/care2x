<center>
<table border="0" width="80%" bordercolor="#000000">
	<tr>
		<td colspan=5 valign="top" height=30 bordercolor="#FFFFFF"><b>{{$LDGeneralInfo}}</b></td>
	</tr>
	<tr bgColor="#eeeeee">
		<td valign=top width="20%">{{$LDPatientName}}</td>
		<td valign=top width="20%" align="right">{{$LDPatientNameData}}</td>
		<td valign=top width="20%">&nbsp;</td>
		<td valign=top width="10%">{{$LDReceiptNumber}}</td>
		<td valign=top width="30%" align="right"><strong>{{$LDReceiptNumberData}}</strong></td>
	</tr>
	<tr>
		<td valign=top width="20%">{{$LDPatientAddress}}</td>
		<td valign=top width="20%" align="right">{{$LDPatientAddressData}}</td>
		<td valign=top width="20%">&nbsp;</td>
		<td valign=top width="10%">{{$LDPaymentDate}}</td>
		<td valign=top width="30%" align="right"><strong>{{$LDPaymentDateData}}</strong></td>
	</tr>
	<tr bgColor="#eeeeee">
		<td valign=top width="20%">{{$LDPatientType}}</td>
		<td valign=top width="20%" align="right">{{$LDPatientTypeData}}</td>
		<td valign=top width="20%">&nbsp;</td>
		<td valign=top width="10%">&nbsp;</td>
		<td valign=top width="30%">&nbsp;</td>
	</tr>
	<tr>
		<td valign=top width="20%">{{$LDDateofBirth}}</td>
		<td valign=top width="20%" align="right">{{$LDDateofBirthData}}</td>
		<td valign=top width="20%">&nbsp;</td>
		<td valign=top width="10%">&nbsp;</td>
		<td valign=top width="30%">&nbsp;</td>
	</tr>
	<tr bgColor="#eeeeee">
		<td valign=top width="20%">{{$LDSex}}</td>
		<td valign=top width="20%" align="right">{{$LDSexData}}</td>
		<td valign=top width="20%">&nbsp;</td>
		<td valign=top width="10%">&nbsp;</td>
		<td valign=top width="30%">&nbsp;</td>
	</tr>
	<tr>
		<td valign=top width="20%">{{$LDPatientNumber}}</td>
		<td valign=top width="20%" align="right">{{$LDPatientNumberData}}</td>
		<td valign=top width="20%">&nbsp;</td>
		<td valign=top width="10%">&nbsp;</td>
		<td valign=top width="30%">&nbsp;</td>
	</tr>
	<tr bgColor="#eeeeee">
		<td valign=top width="20%">{{$LDDateofAdmission}}</td>
		<td valign=top width="20%" align="right">{{$LDDateofAdmissionData}}</td>
		<td valign=top width="20%">&nbsp;</td>
		<td valign=top width="10%">&nbsp;</td>
		<td valign=top width="30%">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5" bordercolor="#FFFFFF">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5" bordercolor="#FFFFFF">
			<p><b>{{$LDPaymentInformation}}</b></p>
		</td>
	</tr>
<!-- payment listing section  -->
{{if $LDPaymentList}}	
	<tr>
		<td colspan="5" bordercolor="#FFFFFF">&nbsp;</td>
	</tr>
	<tr>
			<td align="left" bgColor="#eeeeee">{{$LDModeofPayment}}</td>
			<td align="right" bgColor="#eeeeee">{{$LDModeofPaymentData}}</td>					
			<td colspan="3"></td>
	</tr>
	<tr>
			<td align="left" bgColor="#eeeeee">{{$LDAmount}}</td>
			<td align="right" bgColor="#eeeeee">{{$LDAmountData}}</td>					
			<td colspan="3"></td>
	</tr>
{{/if}}	
<!-- bills listing section  -->
{{if $LDBillList}}	
	<tr>
		<td colspan="5">
			<table border="0" width="100%" bordercolor="#000000" cellspacing="1">
				<tr>
					<th width="30%" valign="middle" align="left" bgcolor="#CCCCCC">{{$LDDescription}}</th>
					<th width="15%" valign="middle" align="center" bgcolor="#CCCCCC">{{$LDCostPerUnit}}</th>
					<th width="3%" valign="middle" align="center"  bgcolor="#CCCCCC">{{$LDUnits}}</th>
					<th width="20%" valign="middle" align="center" bgcolor="#CCCCCC">{{$LDTotalCost}}</th>
					<th width="25%" valign="middle" align="center" bgcolor="#CCCCCC">{{$LDItemType}}</th>
				</tr>
				
				{{$ItemLine}}
			
				<tr><td colspan="5" bgcolor="#cccccc"></td></tr>
				<tr>
					<td colspan="4"><strong>{{$LDTotalBillAmount}}</strong></td>
					<td><strong>{{$LDTotalBillAmountData}}</strong></td>				
				</tr>
				<tr>
					<td colspan="4"><strong>{{$LDOutstandingAmount}}</strong></td>
					<td><strong>{{$LDOutstandingAmountData}}</strong></td>				
				</tr>
				<tr>
					<td colspan="4"><strong>{{$LDAmountDue}}</strong></td>
					<td><strong>{{$LDAmountDueData}}</strong></td>				
				</tr>
			</table>	
		</td>
	</tr>
{{/if}}
{{$sFormTag}}
<!-- payment method listing -->
{{if $LDEnterPayment}}
	<tr>
		<td colspan="5">
			{{include file="ecombill/bill_payment_header_payment.tpl"}}
		</td>
	</tr>
{{/if}}	
<!--  show selected payment -->
{{if $LDShowPayment}}
	<tr>
		<td colspan="5">
		{{if $PaymentCash}}
			{{include file="ecombill/bill_payment_header_payment_cash.tpl"}}
		{{/if}}

		{{if $PaymentCreditCard}}
			{{include file="ecombill/bill_payment_header_payment_creditcard.tpl"}}
		{{/if}}		
		
		{{if $PaymentCheck}}
			{{include file="ecombill/bill_payment_header_payment_check.tpl"}}
		{{/if}}		
		</td>
	</tr>
{{/if}}
{{if $LDFinalBillShow}}
	<tr>
		<td colspan="5" bordercolor="#FFFFFF">&nbsp;</td>
	</tr>
	<tr bgcolor="#eeeeee">
		<td colspan="3" align="left">
			{{$LDTotal}}
		</td>
		<td colspan="2" align="right">
			{{$totalbill}}
		</td>
	</tr>
	<tr>
		<td colspan="3" align="left">
			{{$LDDiscountonTotalAmount}}
		</td>
		<td colspan="2" align="right">
			<input type="text" name="discount" size="5">
		</td>
	</tr>
	<tr bgcolor="#eeeeee">
		<td colspan="3" align="left">
			{{$LDAmountAfterDiscount}}
		</td>
		<td colspan="2" align="right">
			{{$totpayment}}
		</td>
	</tr>
{{/if}}
{{if $LDConfirmBill}}
	<tr>
		<td colspan="5" bordercolor="#FFFFFF">&nbsp;</td>
	</tr>
	<tr bgcolor="#eeeeee">
		<td colspan="3" align="left">
			{{$LDTotal}}
		</td>
		<td colspan="2" align="right">
			{{$totalbill}}
		</td>
	</tr>
	<tr>
		<td colspan="3" align="left">
			{{$LDDiscountonTotalAmount}}
		</td>
		<td colspan="2" align="right">
			{{$discount}}
		</td>
	</tr>
	<tr bgcolor="#eeeeee">
		<td colspan="3" align="left">
			{{$LDAmountAfterDiscount}}
		</td>
		<td colspan="2" align="right">
			{{$totpayment}}
		</td>
	</tr>
	<tr>
		<td colspan="3" align="left">
			{{$LDAmountPreviouslyReceived}}
		</td>
		<td colspan="2" align="right">
			{{$paidamt}}
		</td>
	</tr>
	<tr bgcolor="#eeeeee">
		<td colspan="3" align="left">
			{{$LDAmountDue}}
		</td>
		<td colspan="2" align="right">
			{{$amtdue}}
		</td>
	</tr>
	<tr>
		<td colspan="3" align="left">
			{{$LDCurrentPaidAmount}}
		</td>
		<td colspan="2" align="right">
			<input type="text" name="currentamt" size=5>
		</td>
	</tr>
{{/if}}
</table>
<p>
{{$sHiddenInputs}}
</form>
<p>
{{$pbSubmit}} {{$pbCancel}}
</center>