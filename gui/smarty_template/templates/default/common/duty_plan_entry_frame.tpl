{{* duty_plan_entry_frame.tpl  Common frame template for duty plan form 2004-06-26 Elpidio Latorilla *}}

<form name="dienstplan" {{$sFormAction}} method="post">

<ul>

<font size=4>
{{$LDMonth}} {{$sMonthSelect}} &nbsp; {{$LDYear}} {{$sYearSelect}}
</font>

<table border="0">
  <tbody>
    <tr>
      <td colspan="3" valign="top">
        
		<table border=0 cellpadding=0 cellspacing=1 width="100%" class="frame">
        <tbody>
          <tr class="submenu2_titlebar" style="font-size:16px">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td colspan="2">{{$LDStandbyPerson}}</td>
			 <td colspan="2">{{$LDOnCall}}</td>
          </tr>
		  
		  {{$sDutyRows}}

        </tbody>
        </table>

	  </td>
      <td valign="top">
        {{$sSave}}
		<p>
		{{$sClose}}
      </td>
    </tr>
    <tr>
      <td colspan="3">{{$sSave}}&nbsp;&nbsp;&nbsp;{{$sClose}}</td>
      <td>&nbsp;</td>
    </tr>  
  </tbody>
</table>
</ul>

{{$sHiddenInputs}}

</form>