	{{* test_params.tpl  Test group administration template 2004-06-27 Gjergj Sheldija  *}}

<ul>
<table cellspacing=0 cellpadding=0 class="frame">
  <tbody>
    <tr>
    <td style="color:white; background-color: red; font-weight:bold;" align="left">{{$LDGroup}}</td>
      <td style="color:white; background-color: red; font-weight:bold;" align="right">
		&nbsp;
		{{$sGroupNew}}
	  </td>
    </tr>
    <tr>
      <td colspan=2>
	     <table border="0" cellpadding=2 cellspacing=1>
			<tbody>
				{{$sTestGroupsRows}}
			</tbody>
			</table>
	  </td>
    </tr>
  </tbody>
</table>
{{$sShortHelp}}
</ul>