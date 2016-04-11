<?php
	require_once($root_path.'include/care_api_classes/class_ward.php');
	require_once($root_path.'include/care_api_classes/class_department.php');

	$ward_obj = new Ward;
	$dept_obj = new Department;
	$all_meds=&$dept_obj->getAllMedicalObject();

	extract($_GET);

	#$items='nr,name';
	#$ward_info=&$ward_obj->getAllWardsItemsObject($items);

?>
<form name="form1" method="get">
  <table  border="0" cellpadding="5" align="left" cellspacing="0" bgcolor="#D2E7D1" class="searchboda" style="margin-top:10px;height:35px; width:60%; margin-left:10px; overflow:hidden;">
    <tr>
      <td width="40%" height="34" align="center" valign="middle" nowrap>&nbsp;</td>
      <td width="3%" align="center" valign="middle" nowrap>
        <?php
			  //$i=date("Y");
			  echo '<select name="mnth" class="other">';
			  $i=1;
			  do
			  {
				  $mname=cal_to_jd(CAL_GREGORIAN,$i,1,date("Y"));

				   if (intval($i)<10) $i='0'.$i;

				   if ($mname==cal_to_jd(CAL_GREGORIAN,date("m"),1,date("Y")))
					   {
						 echo "<option value=" . $i . " selected>";
						 echo jdmonthname($mname,1);
						 echo "</option>";
						}
					else{
						 echo "<option value=" . $i . ">";
						 echo jdmonthname($mname,1);
						 echo "</option>";
						}
				  $i++;
				}
			  while ($i<13);
			  echo "</select>";
	  ?>&nbsp;
	  </td>
      <td width="3%" align="center" valign="middle" nowrap>
        <?php
			  $i='2010';
			  echo '<select name="yrs"  class="other">';
			  do{
				  if ($i==date("Y")){
					 echo "<option selected>";
					 echo $i;
					 echo "</option>";
					}
				  else{
					 echo "<option>";
					 echo $i;
					 echo "</option>";
				  }
				$i+=1;
			  } while ($i<=(date("Y")));
		echo "</select>";

		?>

      </td>
      <td width="3%" align="center" valign="middle" nowrap>
      	<select name="dpt"  class="other" style="width:200px;"><?php
	        while($deptrow=$all_meds->FetchRow()){
				print ' <option value="'.$deptrow['nr'].'" '.
							(($dpt==$deptrow['nr'])?'selected':'').' >'.
							$deptrow['name_formal'].
						'</option>';
				if ($dpt==$deptrow['nr']) $dept = $deptrow['name_formal'];

	        }


			?>
		</select>
      </td>
      <td width="7%" align="center" valign="middle" nowrap>
      <input type="submit" class="btn" name="Submit" value="Display &raquo;">
      </td>
      <td width="47%" align="center" valign="middle" nowrap>&nbsp;</td>
    </tr>
  </table>
</form>
