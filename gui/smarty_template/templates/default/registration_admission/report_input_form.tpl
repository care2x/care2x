{{* Template for the new report entry form *}}

{{if $bSetAsForm}}
<form method="post" name="notes_form" onSubmit="return chkform(this)">
{{/if}}

<table border=0 cellpadding=2 width=100%>
	<tr>
     <td>{{$LDDate}}</td>
     <td>
	 	{{$sDateInput}} {{$sDateMiniCalendar}}
	 </td>
   </tr>

   <tr>
     <td>{{$LDNotes}}</td>
     <td>{{$sNotesInput}}</td>
   </tr>
   <tr>
     <td>{{$LDShortNotes}}</td>
     <td>{{$sShortNotesInput}}</td>
   </tr>
   <tr>
     <td>{{$LDSendCopyTo}}</td>
     <td>{{$sSendCopyInput}}</td>
   </tr>
   <tr>
     <td>{{$LDBy}}</td>
     <td>{{$sAuthorInput}}</td>
   </tr>
 </table>

{{if $bSetAsForm}}
	{{$sHiddenInputs}}
	{{$pbSubmit}}
</form>
{{/if}}