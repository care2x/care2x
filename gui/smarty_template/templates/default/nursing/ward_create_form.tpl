{{* ward_create_form.tpl  Form template for creating new ward 2004-06-28 Elpidio Latorilla *}}
{{* Note: the input elements are written in raw form here to give you the chance to redimension them. *}}
{{* Note: In redimensioning the input elements, be very careful not to change their names nor value tags. *}}
{{* Note: Never change the "maxlength" value *}}

<ul>
{{$sMascotImg}} {{$sStationExists}} {{$LDEnterAllFields}}
<p>

<form action="nursing-station-new.php" method="post" name="newstat" onSubmit="return check(this)">
<table>
  <tbody>
    <tr>
      <td class="adm_item"><font color="red"><b>*</b>{{$LDStation}}</font></td>
      <td class="adm_input"><input type="text" name="name" size=20 maxlength=40 value="{{$name}}"></td>
    </tr>
    <tr>
      <td class="adm_item"><font color="red"><b>*</b>{{$LDWard_ID}}</font></td>
      <td class="adm_input"><input type="text" name="ward_id" size=20 maxlength=40 value="{{$ward_id}}"> [a-Z,1-0] {{$LDNoSpecChars}}</td>
    </tr>
    <tr>
      <td class="adm_item"><font color="red"><b>*</b>{{$LDDept}}</font></td>
      <td class="adm_input">{{$sDeptSelectBox}} {{$sSelectIcon}} {{$LDPlsSelect}}</td>
    </tr>
    <tr>
      <td class="adm_item"><font color="red"><b>*</b>{{$LDDescription}}</td>
      <td class="adm_input"><textarea name="description" cols=40 rows=8 wrap="physical">{{$description}}</textarea></td>
    </tr>
    <tr>
      <td class="adm_item"><font color="red"><b>*</b>{{$LDRoom1Nr}}</font></td>
      <td class="adm_input"><input type="text" name="room_nr_start" size=4 maxlength=4 value="{{$room_nr_start}}"></td>
    </tr>
    <tr>
      <td class="adm_item"><font color="red"><b>*</b>{{$LDRoom2Nr}}</font></td>
      <td class="adm_input"><input type="text" name="room_nr_end" size=4 maxlength=4 value="{{$room_nr_end}}"></td>
    </tr>
    <tr>
      <td class="adm_item"><font color="red"><b>*</b>{{$LDRoomPrefix}}</font></td>
      <td class="adm_input"><input type="text" name="roomprefix" size=4 maxlength=4 value="{{$roomprefix}}"></td>
    </tr>
  </tbody>
</table>
{{$sSaveButton}}
</form>
<p>
{{$sCancel}}
</p>
</ul>
