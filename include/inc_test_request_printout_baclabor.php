<table border="0">
  <tbody>
    <tr>
      <td>

	<table   cellpadding=0 cellspacing=0 border=0 width=745 class="lab">
		
    <tr >
      <td colspan=4 bgcolor="#ffe3e3"  align="center"><font size=3 color="#ee6666" face="verdana,arial"><b> <?php echo $LDCentralLab." - ".$formtitle ?></b></td>
    </tr>

  <tr>
    <td bgcolor="#ee6666"><font size=1 color="#ffffff" face="verdana,arial"><b><?php echo strtoupper($LDMaterial); ?></b></td>
    <td bgcolor="#ee6666"><font size=1 color="#ffffff" face="verdana,arial"><b><?php echo strtoupper($LDRequestedTest); ?></b></td>
    <td bgcolor="#ee6666" align="center"><font size=1 color="#ffffff" face="verdana,arial"><b><?php echo strtoupper($LDLabel); ?></b></td>
    <td bgcolor="<?php echo $bgc1 ?>"></td>
  </tr>

		<tr  valign="top">

      <td bgcolor="<?php echo $bgc1 ?>"><font size=1 color="#990000" face="arial">
	  <table border=0 cellpadding=0 cellspacing=0 class="lab">
    
  
<?php
 while(list($x,$v)=each($LDBacLabMaterialType)){
	   list($x2,$v2)=each($LDBacLabMaterialType); 
	   echo '
	   <tr>
	   <td>'.$v.'&nbsp;&nbsp;&nbsp;</td>
	   <td>'.$v2.'&nbsp;&nbsp;&nbsp;</td>
	   </tr>
	   <tr>
	   <td>';
	   
	   if($edit) echo '<a href="javascript:setM(\''.$x.'\')">';
	   
	   $inp_v='0';
	   if($edit_form || $read_form )
	   {
	      if($stored_param[$x])
		  {
		     echo '<img src="../img/filled_pink_block.gif" ';
			 $inp_v='1';
		  }
		  else
		  {
		    echo '<img src="../img/pink_border.gif" ';
		  }
	   }
	   else
	   {
	     echo '<img src="../img/pink_border.gif" ';
	   }
	   
	   echo 'border=0 width=18 height=6 align="absmiddle" id="'.$x.'">';
	   
	   if($edit) echo '</a><input type="hidden" name="'.$x.'" value="'.$inp_v.'">';
	   echo '
	   </td>
	   <td>';
	   if($edit) echo '<a href="javascript:setM(\''.$x2.'\')">';
	   	   
	   $inp_v='0';
	   if($edit_form || $read_form )
	   {
	      if($stored_param[$x2])
		  {
		     echo '<img src="../img/filled_pink_block.gif" ';
			 $inp_v='1';
		  }
		  else
		  {
		    echo '<img src="../img/pink_border.gif" ';
		  }
	   }
	   else
	   {
	     echo '<img src="../img/pink_border.gif" ';
	   }
	   
	   echo 'border=0 width=18 height=6 align="absmiddle" id="'.$x2.'">';

	   if($edit) echo '</a><input type="hidden" name="'.$x2.'" value="'.$inp_v.'">';
	   echo '
	   </td>
	   </tr>';
	 }

?>		
   </table>

</td>
      <td bgcolor="<?php echo $bgc1 ?>"><font size=1 color="#990000" face="arial">
	  <table border=0 cellpadding=0 cellspacing=0 class="lab">
  
<?php
  while(list($x3,$v3)=each($LDBacLabTestType))
	{
	   list($x4,$v4)=each($LDBacLabTestType);
	   echo '
	   <tr>
	   <td>'.$v3.'&nbsp;&nbsp;&nbsp;</td>
	   <td>'.$v4.'&nbsp;&nbsp;&nbsp;</td>
	   </tr>
	   <tr>
	   <td>';
	   if($edit) echo '<a href="javascript:setM(\''.$x3.'\')">';
	   
	   $inp_v='0';
	   if($edit_form || $read_form )
	   {
	      if($stored_param[$x3])
		  {
		     echo '<img src="../img/filled_pink_block.gif" ';
			 $inp_v='1';
		  }
		  else
		  {
		    echo '<img src="../img/pink_border.gif" ';
		  }
	   }
	   else
	   {
	     echo '<img src="../img/pink_border.gif" ';
	   }
	   
	   echo 'border=0 width=18 height=6 align="absmiddle" id="'.$x3.'">';
	   
	   if($edit) echo '</a><input type="hidden" name="'.$x3.'" value="'.$inp_v.'">';
	   echo '
	   </td>
	   <td>';
	   if($edit) echo '<a href="javascript:setM(\''.$x4.'\')">';
	   
	   $inp_v='0';
	   if($edit_form || $read_form )
	   {
	      if($stored_param[$x4])
		  {
		     echo '<img src="../img/filled_pink_block.gif" ';
			 $inp_v='1';
		  }
		  else
		  {
		    echo '<img src="../img/pink_border.gif" ';
		  }
	   }
	   else
	   {
	     echo '<img src="../img/pink_border.gif" ';
	   }
	   
	   echo 'border=0 width=18 height=6 align="absmiddle" id="'.$x4.'">';
	   if($edit) echo '</a><input type="hidden" name="'.$x4.'" value="'.$inp_v.'">';
	   echo '
	   </td>
	   </tr>';
	 }

?>		
   </table>

</td>


         <td  bgcolor="<?php echo $bgc1 ?>"  align="right">
		 <table border=0 cellpadding=10 bgcolor="#ee6666">
     <tr>
       <td>
   
<?php

 if($edit || $edit_findings || $read_form || $edit_form)
        {
		   echo '<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid='.$sid.'&lang='.$lang.'&pn='.$result['patnum'].'" width=282 height=178>';
		}

?>
</td>
     </tr>
   </table>

    </td>
	<td align="right" bgcolor="<?php echo $bgc1 ?>">
	
	<!--  Table for the case nr  -->
	   <table border=0 cellspacing=0 cellpadding=0>
<?php
for($n=0;$n<8;$n++)
{
?>
   <tr align="center">
   <?php
	for($i=0;$i<10;$i++)
	   echo 	 "<td><font size=1 face=\"verdana,arial\" color= \"#990000\">".$i."</td>";
	?>
   </tr>
   <tr>
	<?php
	
	for($i=0;$i<10;$i++)
	{
	   echo 	'<td>';
	   if(substr($result['patnum'],$n,1)==$i) echo '<img src="../img/filled_pink_block.gif"';
	     else echo  '<img src="../img/pink_border.gif"';
	   echo ' border=0 width=18 height=6 align="absmiddle"></td>';
	}
	?>
   </tr>
<?php
}
?>

  <tr>
    <td><font size=1>&nbsp;</td>
  </tr>

 </table>
	
	 <!--  Table for the day and month code -->
   <table border=0 cellspacing=0 cellpadding=0>
   <tr align="center">
   <?php
	for($i=1;$i<11;$i++)
	   echo 	 "<td><font size=1 face=\"verdana,arial\" color= \"#990000\">".$i."</td>";
	?>
   <td><font size=1 face="arial" color= "#990000">20</td>

   <td><font size=1 face="arial" color= "#990000">30</td>

   </tr>

   <tr align="center">
   <?php
   
   $day_tens=0;
   $day_ones=0;
   
   if($edit_form || $read_form )
   {
      /* Process the sampling date, isolate the elements from the DATE format */
      list($yearval,$monval,$dayval) = explode("-",$stored_request['sample_date']);
   }
   else
   {
      /* If fresh form, assume today */
      $yearval=(int)date('Y');
      $dayval=(int)date('d');
	  $monval=(int)date('m');
   }
   
   /* Process the day of the week, separate the 10's from ones */
   
   if($dayval>29)
   {
     $day_tens=30;
	 $day_ones=$dayval-$day_tens;
   }
   elseif($dayval>19)
   {
     $day_tens=20;
	 $day_ones=$dayval-$day_tens;
   }
   elseif($dayval>10)
   {
     $day_tens=10;
	 $day_ones=$dayval-$day_tens;
   }
   else
   {
    $day_ones=$dayval;
   }
   //echo $day_ones." ".$day_tens;
	for($i=1;$i<10;$i++)
	{
	   echo 	'<td>';
	   if($day_ones==$i) echo '<img src="../img/filled_pink_block.gif"';
	     else echo  '<img src="../img/pink_border.gif"';
	   echo ' border=0 width=18 height=6 align="absmiddle"></td>';
	}
	/* For the 10's */
	
   echo 	'<td>';
	  if($day_tens==10) echo '<img src="../img/filled_pink_block.gif"';
	     else echo  '<img src="../img/pink_border.gif"';
	   echo ' border=0 width=18 height=6 align="absmiddle"></td>';

	   
	/* For the 20's */

	   echo 	'<td>';
	   if($day_tens==20) echo '<img src="../img/filled_pink_block.gif"';
	     else echo  '<img src="../img/pink_border.gif"';
	   echo ' border=0 width=18 height=6 align="absmiddle"></td>';

	   
	/* For the 30's */

	   echo 	'<td>';
	   if($day_tens==30) echo '<img src="../img/filled_pink_block.gif"';
	     else echo  '<img src="../img/pink_border.gif"';
	   echo ' border=0 width=18 height=6 align="absmiddle"></td>';

	?>
   </tr>
   <tr>
   <?php
	for($i=1;$i<13;$i++)
	   echo 	 "<td><font size=1 face=\"arial\" color= \"#990000\">".$LDShortMonth[$i]."&nbsp;</td>";
	?>

   </tr>
   <tr>
	<?php
	
	for($i=1;$i<13;$i++)
	{
	   echo 	'<td>';
	   if($monval==$i) echo '<img src="../img/filled_pink_block.gif"';
	     else echo  '<img src="../img/pink_border.gif"';
	   echo ' border=0 width=18 height=6 align="absmiddle"></td>';
	}
	?>
   </tr>
  <tr>
    <td><font size=1>&nbsp;</td>
  </tr>
   </table>
	
	
    </td>
	</tr>
	
<!--  The red row for batch number -->
	<tr bgcolor="<?php echo $bgc1 ?>">	    
	<td bgcolor="#ee6666" colspan=4><font size=1 color="#ffffff" face="verdana,arial">
	<b><?php echo $LDBatchNumber." ".$batch_nr ?>  </b>
    </td>

	</tr>	
	
	
	
	  <tr bgcolor="#fff3f3"  valign="top">
    <td colspan=3><?php
          echo "<img src='".$root_path."classes/barcode/image.php?code=".$batch_nr."&style=68&type=I25&width=180&height=40&xres=2&font=5' border=0>";
?>	</td>
    <td>&nbsp;</td>
    <td align="right" rowspan=7>
		
	
	
	</td>
    <td></td>
  </tr>
  
	
	  <tr bgcolor="#fff3f3"  valign="top">
    <td align="right"><font size=3 color="#ee6666" face="verdana,arial"><b><?php echo $LDMaterial ?></b></td>
    <td colspan=2><font size=2 color="black" face="verdana,arial">&nbsp;<?php if($edit_form || $read_form || $edit_findings) echo stripslashes($stored_request['material_note']); ?></font></td>
	</td>
  </tr>
  
	  <tr bgcolor="#fff3f3" valign="top">
    <td align="right"><font size=3 color="#ee6666" face="verdana,arial"><b><?php echo $LDDiagnosis ?></b></td>
    <td colspan=2><font size=2 color="black" face="verdana,arial"><?php if($edit_form || $read_form || $edit_findings) echo stripslashes($stored_request['diagnosis_note']); ?></font></td>
  </tr>

	<tr bgcolor="<?php echo $bgc1 ?>" valign="top">	    
	<td align="right" ><font size=1 color="#cc0000" face="verdana,arial">
	<?php echo $LDImmuneSupp ?></td>
	<td colspan=2><?php printRadioButton('immune_supp',1)  ?> <?php echo $LDYes ?>	<?php printRadioButton('immune_supp',0) ?> <?php echo $LDNo ?><br>
    </td>
	</tr>	
		
	  <tr bgcolor="#fff3f3" valign="top">
    <td colspan=3><font size=2 color="#ee6666" face="verdana,arial"><b><?php echo $LDFillLabOnly ?></b></td>
  </tr>
	
	  <tr bgcolor="#fff3f3" valign="top">
    <td><font size=1 color="#ee6666" face="verdana,arial"><?php
	 echo $LDLEN.'&nbsp;';
	 if($edit_findings)
	 {
	    echo '<input type="text" name="entry_nr" size=10 maxlength=10 ';
	    if($stored_findings['entry_nr']) echo 'value="'.$stored_findings['entry_nr'].'">';
		 else echo '>';
	 }
	 else
	 {
	    if($stored_findings['entry_nr']) echo  $stored_findings['entry_nr'];
	  }
	 ?></td>
    <td  colspan=2><font size=1 color="#ee6666" face="verdana,arial"><?php 
	echo $LDDate.'&nbsp;';
    if($edit_findings)
	 {
	    echo '&nbsp;<input type="text" name="rec_date" size=10 maxlength=10 value="';
	    if($stored_findings['rec_date'] && $stored_findings['rec_date']!=DBF_NODATE) echo formatDate2Local($stored_findings['rec_date'],$date_format);
		  else echo formatDate2Local(date('Y-m-d'),$date_format);
		echo '" onBlur="IsValidDate(this,\''.$date_format.'\')">';
	 }
	 else
	 {
	    if($stored_findings['rec_date'] && $stored_findings['rec_date']!=DBF_NODATE) echo  formatDate2Local($stored_findings['rec_date'],$date_format);
	  }
    ?></font></td>
  </tr>

	<tr bgcolor="<?php echo $bgc1 ?>" valign="top">	    
	<td align="right" >&nbsp;</td>	
	<td colspan=2>
	<?php
	       if($edit_findings) echo '
		   <a href="javascript:setM(\'findings_init\')">';
		      if($stored_findings['findings_init'])
	       {
		       echo '<img src="f.gif"';
		       $inp_v=1;
		    }
		    else
		    {
		       echo '<img src="b.gif"';
		       $inp_v=0;
		    }

	       echo ' width=18 height=6';

	       if($edit_findings) echo ' border=0 id="findings_init"></a><input type="hidden" name="findings_init" value="'.$inp_v.'">';
             else echo '>';
		  
		  echo $LDInitFindings.'&nbsp;';
		  
	       if($edit_findings) echo '
		   <a href="javascript:setM(\'findings_current\')">';
		      if($stored_findings['findings_current'])
	       {
		       echo '<img src="f.gif"';
		       $inp_v=1;
		    }
		    else
		    {
		       echo '<img src="b.gif"';
		       $inp_v=0;
		    }

	       echo ' width=18 height=6';

	       if($edit_findings) echo ' border=0 id="findings_current"></a><input type="hidden" name="findings_current" value="'.$inp_v.'">';
             else echo '>';	 
			 
		  echo $LDCurrentFindings.'&nbsp;';
		  
	       if($edit_findings) echo '
		   <a href="javascript:setM(\'findings_final\')">';
		      if($stored_findings['findings_final'])
	       {
		       echo '<img src="f.gif"';
		       $inp_v=1;
		    }
		    else
		    {
		       echo '<img src="b.gif"';
		       $inp_v=0;
		    }

	       echo ' width=18 height=6';

	       if($edit_findings) echo ' border=0 id="findings_final"></a><input type="hidden" name="findings_final" value="'.$inp_v.'">';
             else echo '>';
			 
		echo $LDFinalFindings.'&nbsp;';
		  

	?>
    </td>
	</tr>
	</table>
	
	</td>
    </tr>
  </tbody>
</table>