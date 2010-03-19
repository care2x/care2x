<?php
/*$abtname=get_meta_tags($root_path."global_conf/$lang/konsil_tag_dept.pid");
$formtitle=$abtname[$stored_request['testing_dept']]; 
*/?>
	<!-- Start of the form  -->	
		<table   cellpadding=0 cellspacing=0 border="0" width=700>
		<tr  valign="top">
		<td bgcolor="<?php echo $bgc1 ?>"  class=fva2_ml10><div   class=fva2_ml10>
       <?php echo $LDRequestTo ?><br>
       
<?php echo $formtitle.'&nbsp;'.$LDDepartment ?>
   <p>
	<?php printCheckBox('visit'); echo '&nbsp;'.$LDVisitRequested; ?><p>
<?php printCheckBox('order_patient'); echo '&nbsp;'.$LDPatCanBeOrdered; ?><p>
<?php
	  echo '<font size=1 color="#000099" face="verdana,arial">'.$batch_nr.'</font>&nbsp;<br>';
          echo "<img src='".$root_path."classes/barcode/image.php?code=$batch_nr&style=68&type=I25&width=145&height=40&xres=2&font=5' border=0>";
?>		

</td>
         <td  bgcolor="<?php echo $bgc1 ?>"  align="right"><div class=fva2b_ml10>
<?php

  echo '<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid='.$sid.'&lang='.$lang.'&fen='.$full_en.'&en='.$pn.'" width=282 height=178>';

?>
		</div></td>
	</tr>
	
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td colspan=2><div class=fva2_ml10><?php echo $LDDiagnosesInquiries ?><br>
		<img src="<?php echo $bgc1 ?>gui/img/common/default/pixel.gif" border=0 width=1 height=60 align="left">
		  <font face="verdana,arial,courier" size=2 color="#000000">
		  <blockquote><?php if($stored_request['diagnosis_quiry']) echo nl2br(stripslashes($stored_request['diagnosis_quiry'])) ?></blockquote><p>
		  </font>
		</td>
	</tr>	

	<tr bgcolor="<?php echo $bgc1 ?>" valign="top">
		<td ><div class=fva2_ml10><font color="#000099">
		 <?php echo $LDDate ?>:
		  <font face="verdana,arial,courier" size=2 color="#000000">
		<?php if($edit_form || $read_form) echo formatDate2Local($stored_request['send_date'],$date_format); ?>
		</font>
  </div></td>
		<td align="right"><div class=fva2_ml10><font color="#000099">
		<?php echo $LDDoctor ?>
		  <font face="verdana,arial,courier" size=2 color="#000000">
		<?php if($edit_form || $read_form) echo stripslashes($stored_request['send_doctor']) ?>&nbsp;&nbsp;&nbsp;&nbsp;
		</font>
  </div></td>
</tr>

	<tr bgcolor="<?php echo $bgc1 ?>">
		<td colspan=2><div class=fva2_ml10>&nbsp;<br>&nbsp;<p><font color="#000099"><?php echo $LDDeptReport ?><br>
		<img src="<?php echo $bgc1 ?>gui/img/common/default/pixel.gif" border=0 width=1 height=200 align="left">
		  <font face="verdana,arial,courier" size=2 color="#000000">
		<blockquote><?php if($stored_request['result']) echo nl2br(stripslashes($stored_request['result'])) ?></blockquote>
		</font>
		</div><br>
				</td>
		</tr>	

	<tr bgcolor="<?php echo $bgc1 ?>">
		<td ><div class=fva2_ml10><font color="#000099">
		 <?php echo $LDDate ?>:
		  <font face="verdana,arial,courier" size=2 color="#000000">
		<?php if($stored_request['result_date'] != DBF_NODATE) echo formatDate2Local($stored_request['result_date'],$date_format); ?>
		</font>
  </div></td>
			<td align="right"><div class=fva2_ml10><font color="#000099">
		<?php echo $LDDoctor ?>
		  <font face="verdana,arial,courier" size=2 color="#000000">
		<?php if($stored_request['result_doctor']) echo stripslashes($stored_request['result_doctor']) ?>&nbsp;&nbsp;&nbsp;&nbsp;
		</font>
  </div></td>
</tr>
		

		</table>
	<!-- End of form  -->
       	


