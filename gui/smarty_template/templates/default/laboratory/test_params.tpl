{{* test_params.tpl  Test parameter administration template 2004-06-27 Elpidio Latorilla  *}}

<ul>
<table cellspacing=0 cellpadding=0 class="frame">
  <tbody>
    <tr>
      <td style="color:white; background-color: red; font-weight:bold;">
		&nbsp;
		{{$sParamGroup}}
	  </td>
      <td style="color:white; background-color: red; font-weight:bold;" align="right">
		&nbsp;
		{{$sParamNew}}
	  </td>
    </tr>
    <tr>
      <td colspan=2>
	     <table border="0" cellpadding=2 cellspacing=1>
			<tbody>
				<tr bgcolor="white">
					<td>{{$LDParameter}}</td>
					<td>{{$LDMsrUnit}}</td>
					<td>{{$LDMedian}}</td>
					<td>{{$LDLowerBound}}</td>
					<td>{{$LDUpperBound}}</td>
					<td>{{$LDLowerCritical}}</td>
					<td>{{$LDUpperCritical}}</td>
					<td>{{$LDLowerToxic}}</td>
					<td>{{$LDUpperToxic}}</td>
					<td>&nbsp;</td>
				</tr>
				
				{{$sTestParamsRows}}
			</tbody>
			</table>
	  </td>
    </tr>
  </tbody>
</table>
{{$sShortHelp}}
<form {{$sFormAction}} method=post onSubmit="return chkselect(this)" name="paramselect">
<table>
  <tbody>
    <tr>
      <td colspan="3" class="prompt">{{$LDSelectParamGroup}}</td>
    </tr>
    <tr>
      <td>{{$LDParamGroup}}</td>
      <td>{{$sParamGroupSelect}}</td>
      <td>&nbsp;{{$sSubmitSelect}}</td>
    </tr>
  </tbody>
</table>
</form>
</ul>