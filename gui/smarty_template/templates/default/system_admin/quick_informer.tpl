{{* quick_informer.tpl  Quick informer edit form 2004-06-29 Elpidio Latorila *}}
{{* Note: the input elements are written in raw form here to give you the chance to redimension them. *}}
{{* Note: In redimensioning the input elements, be very careful not to change their names nor value tags. *}}
{{* Note: Never change the "maxlength" value *}}

<ul>
<FONT class="prompt"><p>
{{$sMascotImg}} {{$LDDataSaved}}
<p>
{{$LDEnterInfo}}
</font>
<p>

<form {{$sFormAction}} method="post" name="quickinfo">
<table border=0 cellspacing=1 cellpadding=5>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b>{{$LDPhonePolice}}</b> </FONT></td>
	<td class="adm_input"><input type="text" name="main_info_police_nr" size=40 maxlength=40 value="{{$main_info_police_nr}}">
      </td>
	</tr>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b>{{$LDPhoneFire}}</b> </FONT></td>
	<td class="adm_input"><input type="text" name="main_info_fire_dept_nr" size=40 maxlength=40 value="{{$main_info_fire_dept_nr}}">
      </td>
	</tr>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b>{{$LDAmbulance}}</b> </FONT></td>
	<td class="adm_input"><input type="text" name="main_info_emgcy_nr" size=40 maxlength=40 value="{{$main_info_emgcy_nr}}">
      </td>
	</tr>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b>{{$LDPhone}}</b> </FONT></td>
	<td class="adm_input"><input type="text" name="main_info_phone" size=40 maxlength=40 value="{{$main_info_phone}}">
      </td>
	</tr>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b>{{$LDFax}}</b> </FONT></td>
	<td class="adm_input"><input type="text" name="main_info_fax" size=40 maxlength=40 value="{{$main_info_fax}}">
      </td>
	</tr>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b>{{$LDAddress}}</b> </FONT></td>
	<td class="adm_input"><textarea name="main_info_address" cols=33 rows=5 wrap="physical">{{$main_info_address}}</textarea>

      </td>
	</tr>
<tr>
	<td class="adm_item" align="right"><FONT  color="#0000cc"><b>{{$LDEmail}}</b> </FONT></td>
	<td class="adm_input"><input type="text" name="main_info_email" size=40 maxlength=60 value="{{$main_info_email}}">
      </td>
	</tr>
</table>
<p>
{{$sSave}}&nbsp;&nbsp;&nbsp;&nbsp;{{$sCancel}}
</form>