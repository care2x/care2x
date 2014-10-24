<?php
while($row=$result->FetchRow()){
?>
<table border=0 cellpadding=5 cellspacing=1>
  <tr bgcolor="#fefefe">
    <td><FONT SIZE=-1  FACE="Arial"><?php echo @formatDate2Local($row['date'],$date_format); ?></td>
    <td rowspan=4 valign="top"><FONT SIZE=-1  FACE="Arial"><?php echo $row['purpose']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['urgency']; ?></td>
  </tr>
  <tr bgcolor="#fefefe">
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['time']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['remind_email']; ?></td>
  </tr>
  <tr bgcolor="#fefefe">
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['to_dept_id']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['remind_mail']; ?></td>
  </tr>
  <tr bgcolor="#fefefe">
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['appt_status']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['remind_phone']; ?></td>
  </tr>
</table>
<?php
}
?>
