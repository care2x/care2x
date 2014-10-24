<table border=0 cellpadding=4 cellspacing=1 width=100%>
<?php
while($row=$result->FetchRow()){

	# Prepare the category value
	if(isset($$row['cat_LD_var'])&&!empty($$row['cat_LD_var']))  $cat_name=$$row['cat_LD_var'];
		else $cat_name=$row['cat_name'];

	# Prepare the localization value
	if(isset($$row['loc_LD_var'])&&!empty($$row['loc_LD_var']))  $loc_name=$$row['loc_LD_var'];
		else $loc_name=$row['loc_name'];

?>

  <tr bgcolor="#fefefe">
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['encounter_nr'] ?></td>
    <td><FONT SIZE=-1  FACE="Arial" color="#006600"><b><?php echo $row['code']; ?></b></td>
    <td rowspan=2 valign="top"><FONT SIZE=-1  FACE="Arial"><?php echo '<i>'.$row['parent_desc'].'</i><br>';echo $row['description']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $cat_name; ?></td>
  </tr>
  <tr bgcolor="#fefefe">
    <td><FONT SIZE=-1  FACE="Arial"><?php echo @formatDate2Local($row['date'],$date_format); ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['code_version']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $loc_name; ?></td>
  </tr>
<!--   <tr bgcolor="#fefefe">
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['responsible_dept_nr']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['localcode']; ?></td>
    <td><FONT SIZE=-1  FACE="Arial"><?php echo $row['responsible_clinician']; ?></td>
 </tr>
 --> 
<?php
}
?>
</table>
