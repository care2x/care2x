{{* ward_profile.tpl  Showing ward profile 2004-06-28 Elpidio Latorilla *}}

<ul>
<table>
  <tbody>
    <tr>
      <td class="adm_item">{{$LDStation}}</td>
      <td class="adm_input" colspan="2">{{$name}}</td>
    </tr>
    <tr>
      <td class="adm_item">{{$LDWard_ID}}</td>
      <td class="adm_input" colspan="2">{{$ward_id}}</td>
    </tr>
    <tr>
      <td class="adm_item">{{$LDDept}}</td>
      <td class="adm_input" colspan="2">{{$dept_name}}</td>
    </tr>
    <tr>
      <td class="adm_item">{{$LDDescription}}</td>
      <td class="adm_input" colspan="2">{{$description}}</td>
    </tr>
    <tr>
      <td class="adm_item">{{$LDRoom1Nr}}</td>
      <td class="adm_input" colspan="2">{{$room_nr_start}}</td>
    </tr>
    <tr>
      <td class="adm_item">{{$LDRoom2Nr}}</td>
      <td class="adm_input" colspan="2">{{$room_nr_end}}</td>
    </tr>
    <tr>
      <td class="adm_item">{{$LDRoomPrefix}}</td>
      <td class="adm_input" colspan="2">{{$roomprefix}}</td>
    </tr>
   <tr>
      <td class="adm_item">{{$LDCreatedOn}}</td>
      <td class="adm_input" colspan="2">{{$date_create}}</td>
    </tr>
   <tr>
      <td class="adm_item">{{$LDCreatedBy}}</td>
      <td class="adm_input" colspan="2">{{$create_id}}</td>
    </tr>

  {{if $bShowRooms}}
   <tr>
      <td class="adm_item" colspan="3">&nbsp;</td>
    </tr>
   <tr  class="wardlisttitlerow">
      <td>{{$LDRoom}}</td>
      <td>{{$LDBedNr}}</td>
      <td>{{$LDRoomShortDescription}}</td>
    </tr>
	
	{{$sRoomRows}}
  
  {{/if}}

  </tbody>
</table>
<p>

<table width="100%">
  <tbody>
    <tr valign="top">
      <td>{{$sClose}}</td>
      <td align="right">{{$sWardClosure}}</td>
    </tr>
  </tbody>
</table>

</ul>