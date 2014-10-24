<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="CONTENT-TYPE" content="text/html; charset=windows-1252">
<title>Mandat Ark&euml;timi</title>
<style type="text/css">
<!--
.titulli {font-family: Tahoma;font-weight: bold;font-size: 12pt;}
.sub-title {color: #FFFFFF; font-family: Verdana, Arial, Helvetica, sans-serif; }
.nr-invoice {font-family: Verdana, Arial, Helvetica, sans-serif}
table.head-table {border:thin solid #000000 }
-->
</style>
</head>
<body onload="window.print();">
<table>
	<tr>
		<td valign="top">{{$LogoMinistri}}</td>
		<td valign="top">
			<table width="430" class="head-table" bordercolor="#000000">
				<tr class="head-table">
					<td colspan="2" width="414" height="32" align="center" style="border-bottom:thin solid #000000">
							<span class="nr-invoice">Nr. i Fatur&euml;s</span>: {{$LDReceiptNumberData}}</span>
					</td>
				</tr>
				<tr valign="top" >
					<td width="215" height="32" style="border-right:thin solid #000000">
						<p align="center" class="sub-title" style="margin-bottom: 0in; background: #262626">INSTITUCIONI</p>
						<p>{{$main_info_address}}</p>
					</td>
					<td width="185">
						<p align="center" class="sub-title" style="margin-bottom: 0in; background: #262626">Data</p>
						<p>{{$currentDate}}</p>
					</td>
				</tr>
			</table>
		</td>
		<td valign="top"> 
			<span style="float:left; border: none; background: #dddddd"> 
				Nr serial: {{$LDReceiptNumberData}} 
			</span> 
		</td>
	</tr>
	<tr>
		<td colspan="3" align="right">
			<table width="100%">
				<tr>
					<td colspan="6">
						<p align="center" class="titulli"> 
							<u>Mandat Ark&euml;timi</u> </p>
					</td>
				</tr>
				<tr>
					<td colspan="6">
						<strong>Z.</strong>{{$LDPatientNameData}} i ark&euml;tohet shuma prej					</td>
				<tr>
					<td colspan="6">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;(em&euml;r, at&euml;si	mbiem&euml;r)
					</td>
				</tr>
				<tr>
					<td colspan="6">
						{{$CostPerUnitData}}lekesh, p&euml;r sh&euml;rbimin {{$DescriptionData}},</td>
				</tr>
				<tr>
					<td colspan="6">
						i referuar tek Mjeku {{$DoctorName}}</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>PO</td>
					<td>JO</td>
					<td>&nbsp;</td>
					<td>PO</td>
					<td>JO</td>
				</tr>
				<tr>
					<td>			
						<strong>I siguruar</strong></td>
					<td>
						{{$insuredYes}}	
					</td>
					<td>
						{{$insuredNo}}
					<td>
						<strong>I rekomanduar </strong>					</td>
					<td>{{$referedYes}}</td>
					<td>{{$referedNo}}</td>	
				</tr>
				<tr>
					<td colspan="3">
						Pacienti:______________________________					</td>
					<td colspan="3">
						Ark&euml;tari:______________________________					</td>		
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>