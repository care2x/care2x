{{* duty_plan.tpl  Common frame template 2004-06-26 Elpidio Latorilla *}}

<ul>
<table border="0" width="80%">
  <tbody>
    <tr style="font-size:18px">
      <td>{{$sPrevMonth}}</td>
      <td>{{$sThisMonth}}</td>
      <td>{{$sNextMonth}}</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" valign="top">
        
		<table border=0 cellpadding=0 cellspacing=1 width="100%" class="frame">
        <tbody>
          <tr class="submenu2_titlebar" style="font-size:16px">
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>{{$LDStandbyPerson}}</td>
            <td>{{$LDOnCall}}</td>
          </tr>
		  
		  {{$sDutyRows}}

        </tbody>
        </table>

	  </td>
      <td valign="top">
        {{$sNewPlan}}
		<p>
		{{$sCancel}}
      </td>
    </tr>
    <tr>
      <td colspan="3">{{$sNewPlan}}&nbsp;&nbsp;&nbsp;{{$sCancel}}</td>
      <td>&nbsp;</td>
    </tr>  
  </tbody>
</table>
</ul>
