<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr('inc_test_findings_form_baclabor.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/
if(file_exists($root_path.'language/'.$lang.'/lang_'.$lang.'_konsil_baclabor.php')) include_once($root_path.'language/'.$lang.'/lang_'.$lang.'_konsil_baclabor.php');
  else include_once($root_path.'language/'.LANG_DEFAULT.'/lang_'.LANG_DEFAULT.'_konsil_baclabor.php');
  ?>

<table>
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
  while(list($x,$v)=each($LDBacLabMaterialType))
	{
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
	      if($stored_material[$x])
		  {
		     echo '<img src="f.gif" ';
			 $inp_v='1';
		  }
		  else
		  {
		    echo '<img src="b.gif" ';
		  }
	   }
	   else
	   {
	     echo '<img src="b.gif" ';
	   }
	   
	   echo 'border=0 width=18 height=6 align="absmiddle" id="'.$x.'">';
	   if($edit) echo '</a><input type="hidden" name="'.$x.'" value="'.$inp_v.'">';
	   echo '</td>
	   <td>';
	   if($edit) echo '<a href="javascript:setM(\''.$x2.'\')">';
	   	   
	   $inp_v='0';
	   if($edit_form || $read_form )
	   {
	      if($stored_material[$x2])
		  {
		     echo '<img src="f.gif" ';
			 $inp_v='1';
		  }
		  else
		  {
		    echo '<img src="b.gif" ';
		  }
	   }
	   else
	   {
	     echo '<img src="b.gif" ';
	   }
	   
	   echo 'border=0 width=18 height=6 align="absmiddle" id="'.$x2.'">';

	   if($edit) echo '</a><input type="hidden" name="'.$x2.'" value="'.$inp_v.'">';
	   echo '</td>
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
	      if($stored_test_type[$x3])
		  {
		     echo '<img src="f.gif" ';
			 $inp_v='1';
		  }
		  else
		  {
		    echo '<img src="b.gif" ';
		  }
	   }
	   else
	   {
	     echo '<img src="b.gif" ';
	   }
	   
	   echo 'border=0 width=18 height=6 align="absmiddle" id="'.$x3.'">';
	   
	   if($edit) echo '</a><input type="hidden" name="'.$x3.'" value="'.$inp_v.'">';
	   echo '</td>
	   <td>';
	   if($edit) echo '<a href="javascript:setM(\''.$x4.'\')">';
	   
	   $inp_v='0';
	   if($edit_form || $read_form )
	   {
	      if($stored_test_type[$x4])
		  {
		     echo '<img src="f.gif" ';
			 $inp_v='1';
		  }
		  else
		  {
		    echo '<img src="b.gif" ';
		  }
	   }
	   else
	   {
	     echo '<img src="b.gif" ';
	   }
	   echo 'border=0 width=18 height=6 align="absmiddle" id="'.$x4.'">';
	   if($edit) echo '</a><input type="hidden" name="'.$x4.'" value="'.$inp_v.'">';
	   echo '</td>
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
          /* The patient label */
 if($edit || $edit_findings || $read_form || $edit_form)
        {
		   echo '<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php'.URL_REDIRECT_APPEND.'&fen='.$full_en.'&en='.$pn.'" width=282 height=178>';
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
	   if(substr($full_en,$n,1)==$i) echo '<img src="f.gif"';
	     else echo  '<img src="b.gif"';
	   echo ' border=0 width=18 height=6 align="absmiddle"></td>';
	}
	?>
   </tr>
<?php
}
?>


 </table>
	<!--  Barcode for the batch nr.  -->
	<?php
    /**
	*  The barcode image is first searched in the cache. If present, it will be displayed.
	*  Otherwise an image will be generated, stored in the cache and displayed.
	*/
	$in_cache=1;
	
	if(!file_exists('../cache/barcodes/form_'.$batch_nr.'.png'))
	{
          echo "<img src='".$root_path."classes/barcode/image.php?code=".$batch_nr."&style=68&type=I25&width=145&height=40&xres=2&font=5&label=1&form_file=1' border=0 width=0 height=0>";
	      if(!file_exists('../cache/barcodes/form_'.$batch_nr.'.png'))
	     {
             echo "<img src='".$root_path."classes/barcode/image.php?code=".$batch_nr."&style=68&type=I25&width=145&height=40&xres=2&font=5' border=0>";
			 $in_cache=0;
		 }
	}

    if($in_cache)   echo '<img src="../cache/barcodes/form_'.$batch_nr.'.png"  border=0>';
	
?>
	
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
	   if($day_ones==$i) echo '<img src="f.gif"';
	     else echo  '<img src="b.gif"';
	   echo ' border=0 width=18 height=6 align="absmiddle"></td>';
	}
	/* For the 10's */
	
   echo 	'<td>';
	  if($day_tens==10) echo '<img src="f.gif"';
	     else echo  '<img src="b.gif"';
	   echo ' border=0 width=18 height=6 align="absmiddle"></td>';

	   
	/* For the 20's */

	   echo 	'<td>';
	   if($day_tens==20) echo '<img src="f.gif"';
	     else echo  '<img src="b.gif"';
	   echo ' border=0 width=18 height=6 align="absmiddle"></td>';

	   
	/* For the 30's */

	   echo 	'<td>';
	   if($day_tens==30) echo '<img src="f.gif"';
	     else echo  '<img src="b.gif"';
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
	   if($monval==$i) echo '<img src="f.gif"';
	     else echo  '<img src="b.gif"';
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
	
	</table>

<!--  The middle part for test types  -->
	
<table border=0 width=745 class="lab" cellspacing=0 cellpadding=0>
<!--  The red row for batch number -->
	<tr bgcolor="<?php echo $bgc1 ?>">	    
	<td bgcolor="#ee6666" colspan=5><font size=1 color="#ffffff" face="verdana,arial">
	<b><?php echo $LDBatchNumber." ".$batch_nr ?>  </b>
    </td>
	</tr>	
	
	
	
	  <tr bgcolor="#fff3f3"  valign="top">
    <td align="right"><font size=3 color="#ee6666" face="verdana,arial"><b><?php echo $LDMaterial ?></b></td>
    <td colspan=2><font size=2 color="black" face="verdana,arial">&nbsp;<?php if($edit_form || $read_form || $edit_findings) echo stripslashes($stored_request['material_note']); ?></font></td>
	</td>
    <td  rowspan=8>	 
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
		
		/* The text area input */  

		
	     echo '<br>'.$LDFillLabOnly.'<br>';
	     if($edit_findings) 
		 {
		    echo '
                      <textarea name="notes" cols=25 rows=12 wrap="physical" >';
			if($stored_findings['notes']) echo stripslashes($stored_findings['notes']);
			echo '</textarea>';
		 }
		 elseif($stored_findings['notes']) echo '<font face="verdana,arial" color="#000000" size=2>'.nl2br(chunk_split(stripslashes($stored_findings['notes']),35));
            
	   ?>

	</td>
    <td align="right" rowspan=8>
	
	<!-- Container for the resistance test anaerobes  -->
	<table border=0 cellpadding=0 cellspacing=0>
   <tr>
     <td>
	 
	 	  <table border=0 class="lab" cellpadding=0 cellspacing=0 bgcolor="<?php echo $bgc1 ?>"> 	
<?php
   /* The first column group of resistance test ANaerobes*/
    
   
   	while(list($x,$v)=each($lab_ResistANaerobAcro))
	{
	  echo '
	         <tr>';
	   echo '
               <td>';
	   echo $v;
	   echo '   
			   </td>';	   
	   echo '
               <td><nobr>&nbsp;S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R<br>';

       for($n=0;$n<2;$n++)
	   {			

	       list($x2,$v2)=each($lab_ResistANaerob_1);
	       if($edit_findings) echo '
		   <a href="javascript:setM(\''.$v2.'\')">';
	       if($parsed_resist_anaerob[$v2])
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

	       if($edit_findings) echo ' border=0 id="'.$v2.'"></a><input type="hidden" name="'.$v2.'" value="'.$inp_v.'">';
             else echo '>';
	
	   }
  
	   echo '</td>';
      echo '
	         </tr>';
    }
   
   reset($lab_ResistANaerobAcro);
   ?>	
 </table>	 
 
	 </td>
	 
     <td>
	 
	 	  <table border=0 class="lab" cellpadding=0 cellspacing=0 bgcolor="<?php echo $bgc1 ?>"> 	
<?php
   /* The 2nd column group of resistance test Anaerobes*/
   	while(list($x,$v)=each($lab_ResistANaerobAcro))
	{
	  echo '
	         <tr>';
	   echo '
               <td><nobr>&nbsp;S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R<br>';
			   
       for($n=0;$n<2;$n++)
	   {			

	       list($x2,$v2)=each($lab_ResistANaerob_2);
	       if($edit_findings) echo '
		   <a href="javascript:setM(\''.$v2.'\')">';
	       if($parsed_resist_anaerob[$v2])
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

	       if($edit_findings) echo ' border=0 id="'.$v2.'"></a><input type="hidden" name="'.$v2.'" value="'.$inp_v.'">';
             else echo '>';
	
	   }
	   
	   echo '</td>';
      echo '
	         </tr>';
    }
   
   reset($lab_ResistANaerobAcro);
   ?>	
 </table>	 
 
	 </td>
	 
     <td>
	 
	 	  <table border=0 class="lab" cellpadding=0 cellspacing=0 bgcolor="<?php echo $bgc1 ?>"> 	
<?php
   /* The 3rd column group of resistance test Anaerobes*/
   	while(list($x,$v)=each($lab_ResistANaerobAcro))
	{
	  echo '
	         <tr>';
	   echo '
               <td><nobr>&nbsp;S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;R<br>';
			   
       for($n=0;$n<2;$n++)
	   {			

	       list($x2,$v2)=each($lab_ResistANaerob_3);
	       if($edit_findings) echo '
		   <a href="javascript:setM(\''.$v2.'\')">';
	       if($parsed_resist_anaerob[$v2])
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

	       if($edit_findings) echo ' border=0 id="'.$v2.'"></a><input type="hidden" name="'.$v2.'" value="'.$inp_v.'">';
             else echo '>';
	   }
	   
	   echo '</td>';
      echo '
	         </tr>';
    }
   
   reset($lab_ResistANaerobAcro);
   ?>	
 </table>	 
 
	 </td>
   </tr>
 </table>
 
	
	</td>
  </tr>
  
	
	  <tr bgcolor="#fff3f3"  valign="top">
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
	    if($stored_findings['rec_date'] && $stored_findings['rec_date']!='0000-00-00')  //#147
	    	$dateRec = $stored_findings['rec_date'];
		else 
			$dateRec = date('Y-m-d');
		//gjergji : new calendar
		require_once ('../../js/jscalendar/calendar.php');
		$calendar = new DHTML_Calendar('../../js/jscalendar/', $lang, 'calendar-system', true);
		$calendar->load_files();

		echo $calendar->show_calendar($calendar,$date_format,'rec_date',$dateRec);
		//end gjergji
	 } else { 
	    if($stored_findings['rec_date']) echo  formatDate2Local($stored_findings['rec_date'],$date_format);
	  }
    ?></font></td>
  </tr>

	
	<tr bgcolor="<?php echo $bgc1 ?>" valign="top">	    
	<td colspan=3>
		<table border=0 class="lab" cellpadding=0 cellspacing=0 >
   <tr valign="top" bgcolor="<?php echo $bgc1 ?>">
   	<?php
	
	   /* The test types for lab intern */
   $tr_tracker=0;
   
   	while(list($x,$v)=each($lab_TestType))
	{
	   if(!$tr_tracker) echo '
	         <td>&nbsp;';
	   echo '&nbsp;'.$v.'<br>';

       if($edit_findings) echo '
		   <a href="javascript:setM(\''.$x.'\')">';
	   if($parsed_type[$x])
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

	       if($edit_findings) echo ' border=0 id="'.$x.'"></a><input type="hidden" name="'.$x.'" value="'.$inp_v.'">';
             else echo '>';
			 
	   echo '<br>
	   ';

	  $tr_tracker++;
	  
	   if($tr_tracker>9)
	   { 
	      echo '
	         </td>';
		   $tr_tracker=0;
	   }
		
    }
	  
   ?>	

   </tr>
 </table>
	
	</td>
	</tr>	
	</table>




<!-- The lower form for findings -->
<table border=0 cellpadding=0 cellspacing=0 align="left" bgcolor="<?php echo $bgc1 ?>" width=745>
  <tr bgcolor="#ee6666">
    <td><font face="verdana,arial" color="white" size=1><b><?php echo $LDTestFindings ?></b></td>
    <td><font face="verdana,arial" color="white" size=1><b><?php echo $LDResistanceTestAerob ?></b></td>
  </tr>

  <tr valign="top">
  <!-- left block for the test findings general -->
    <td>
	
	<table border=0 class="lab" cellpadding=0 cellspacing=0>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;<br><?php
	 	 if($edit_findings) echo '
		   <a href="javascript:setM(\'_tr_blocker_pos\')">';
		      if($parsed_findings['_tr_blocker_pos'])
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

	       if($edit_findings) echo ' border=0 id="_tr_blocker_pos"></a><input type="hidden" name="_tr_blocker_pos" value="'.$inp_v.'">';
             else echo '>';

		   echo $LDBlockerPos.'<br>';
        ?>
		</td>
     <td>&nbsp;<br><?php	  
	 	 if($edit_findings) echo '
		   <a href="javascript:setM(\'_tr_blocker_neg\')">';
		      if($parsed_findings['_tr_blocker_neg'])
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

	       if($edit_findings) echo ' border=0 id="_tr_blocker_neg"></a><input type="hidden" name="_tr_blocker_neg" value="'.$inp_v.'">';
             else echo '>';
	 
	   echo $LDBlockerNeg.'<br>';
		?>
		</td>
      <td>&nbsp;</td>
   </tr>
   
   <tr>
     <td>&nbsp;<br><?php	  
	 	 if($edit_findings) echo '
		   <a href="javascript:setM(\'_tr_mark_streptococcus\')">';
		      if($parsed_findings['_tr_mark_streptococcus'])
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

	       if($edit_findings) echo ' border=0 id="_tr_mark_streptococcus"></a><input type="hidden" name="_tr_mark_streptococcus" value="'.$inp_v.'">';
             else echo '>';
 
 	   echo $LDMarkStreptocResistance.'<br>';
		?>	 
     </td> 
     <td>&nbsp;<br><?php	
	 
	 	 if($edit_findings) echo '
		   <a href="javascript:setM(\'_tr_pathogenmore\')">';
		      if($parsed_findings['_tr_pathogenmore'])
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

	       if($edit_findings) echo ' border=0 id="_tr_pathogenmore"></a><input type="hidden" name="_tr_pathogenmore" value="'.$inp_v.'">';
             else echo '>';

		   echo $LDBacNr_GT.'<br>';
		?>	 
		</td>
     <td>&nbsp;<br><?php	
	 
	 	 if($edit_findings) echo '
		   <a href="javascript:setM(\'_tr_pathogenless\')">';
		      if($parsed_findings['_tr_pathogenless'])
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

	       if($edit_findings) echo ' border=0 id="_tr_pathogenless"></a><input type="hidden" name="_tr_pathogenless" value="'.$inp_v.'">';
             else echo '>';

		   echo $LDBacNr_LT.'<br>';
		?>
		</td>
     <td>&nbsp;<br><?php
	 
	 	 if($edit_findings) echo '
		   <a href="javascript:setM(\'_tr_patho_neg\')">';
		      if($parsed_findings['_tr_patho_neg'])
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

	       if($edit_findings) echo ' border=0 id="_tr_patho_neg"></a><input type="hidden" name="_tr_patho_neg" value="'.$inp_v.'">';
             else echo '>';

		   echo $LDBacNrNeg.'<br>';
		?>
		</td>
   </tr>
 </table>
 
	
	<table border=0 class="lab" cellpadding=0 cellspacing=0>
	
	<?php
	
	/* First group for test findings */
	
	$tr_tracker=0;
	while(list($x,$v)=each($lab_TestResultId_1))
	{
	   if(!$tr_tracker) echo '
	         <tr>';
	   echo '
               <td><br>';

       for($n=0;$n<3;$n++)
	   {			

	       list($x2,$v2)=each($lab_TestResult_1);
	       if($edit_findings) echo '<a href="javascript:setM(\''.$v2.'\')">';
	       if($parsed_findings[$v2])
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

	       if($edit_findings) echo ' border=0 id="'.$v2.'"></a><input type="hidden" name="'.$v2.'" value="'.$inp_v.'">';
             else echo '>';
	
	   }

	   echo $v;
	   
	   echo '</td>';
	   if($tr_tracker>1) $tr_tracker=0;
	     else $tr_tracker++;
	  
	   if(!$tr_tracker) echo '
	   </tr>';
    }
   
   /* The second group of test findings*/
   
   	while(list($x,$v)=each($lab_TestResultId_2))
	{
	   if(!$tr_tracker) echo '
	         <tr>';
	   echo '
	   <td><br>';

	       list($x2,$v2)=each($lab_TestResult_2);
	       if($edit_findings) echo '<a href="javascript:setM(\''.$v2.'\')">';
	       if($parsed_findings[$v2])
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

	       if($edit_findings) echo ' border=0 id="'.$v2.'"></a><input type="hidden" name="'.$v2.'" value="'.$inp_v.'">';
             else echo '>';

       echo $v;
	   
	   echo '</td>';
	   if($tr_tracker>1) $tr_tracker=0;
	     else $tr_tracker++;
	  
	   if(!$tr_tracker) echo '
	         </tr>';
    }
	  
   ?>	 
 </table>
 
	</td>
    <!-- right block for the aerobes resistance -->
	<td align="right">
 <table border=0 cellpadding=0 cellspacing=0>
   <tr valign="top">
      <td bgcolor="#ee6666">
	 <img src="../img/pixel.gif" border=0 width=1 height=1>
	 </td>   
    <td>

  <table border=0 class="lab" cellpadding=0 cellspacing=0> 	
   <tr>
      <td>&nbsp;
	 </td>  
      <td>
	 <?php
	       if($edit_findings) echo '<a href="javascript:setM(\'_rx_pathogen_1_\')">';
	       if($parsed_resist_aerob['_rx_pathogen_1_'])
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

	       if($edit_findings) echo ' border=0 id="_rx_pathogen_1_"></a><input type="hidden" name="_rx_pathogen_1_" value="'.$inp_v.'">';
             else echo '>';	 
			 echo $LDBAC[0];
			 ?> 
			 
	 </td>   
	</tr>
  
<?php
   /* The first column group of resistance test aerobes*/
   	while(list($x,$v)=each($lab_ResistAerobAcro))
	{
	  echo '
	         <tr>';
	   echo '
               <td>';
	   echo $v;
	   echo '</td>';	   
	   echo '
               <td>&nbsp;S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;M&nbsp;&nbsp;&nbsp;&nbsp;R<br>';

       for($n=0;$n<3;$n++)
	   {			

	       list($x2,$v2)=each($lab_ResistAerob_1);
	       if($edit_findings) echo '<a href="javascript:setM(\''.$v2.'\')">';
	       if($parsed_resist_aerob[$v2])
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

	       if($edit_findings) echo ' border=0 id="'.$v2.'"></a><input type="hidden" name="'.$v2.'" value="'.$inp_v.'">';
             else echo '>';
	
	   }
   
	   echo '
	   </td>';
      echo '
	         </tr>';
    }
   
   reset($lab_ResistAerobAcro);
   ?>	
 </table>	 
 
	 </td>
     <td bgcolor="#ee6666">
	 <img src="../img/pixel.gif" border=0 width=1 height=1>
	 </td>   
	   <td>
	 
	   <table border=0 class="lab" cellpadding=0 cellspacing=0> 	
	      <tr>
      <td>
	 <?php
	       if($edit_findings) echo '<a href="javascript:setM(\'_rx_pathogen_2_\')">';
	       if($parsed_resist_aerob['_rx_pathogen_2_'])
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

	       if($edit_findings) echo ' border=0 id="_rx_pathogen_2_"></a><input type="hidden" name="_rx_pathogen_2_" value="'.$inp_v.'">';
             else echo '>';	 
			 echo $LDBAC[1];
			 ?> 
			 
	 </td>   
	</tr>

<?php
   /* The 2nd column group of resistance test aerobes*/
   	while(list($x,$v)=each($lab_ResistAerobAcro))
	{
	  echo '
	         <tr>';
	   echo '
               <td>&nbsp;S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;M&nbsp;&nbsp;&nbsp;&nbsp;R<br>';
       for($n=0;$n<3;$n++)
	   {			

	       list($x2,$v2)=each($lab_ResistAerob_2);
	       if($edit_findings) echo '<a href="javascript:setM(\''.$v2.'\')">';
	       if($parsed_resist_aerob[$v2])
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

	       if($edit_findings) echo ' border=0 id="'.$v2.'"></a><input type="hidden" name="'.$v2.'" value="'.$inp_v.'">';
             else echo '>';
	
	   }
   
	   echo '   
			   </td>';
      echo '
	         </tr>';
    }
	
   reset($lab_ResistAerobAcro);
   
   ?>	
 </table>
	 
	 
	 </td>
     <td bgcolor="#ee6666">
	 <img src="../img/pixel.gif" border=0 width=1 height=1>
	 </td>   
     <td>
	
		   <table border=0 class="lab" cellpadding=0 cellspacing=0> 	
   <tr>
      <td>
	 <?php
	       if($edit_findings) echo '<a href="javascript:setM(\'_rx_pathogen_3_\')">';
	       if($parsed_resist_aerob['_rx_pathogen_3_'])
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

	       if($edit_findings) echo ' border=0 id="_rx_pathogen_3_"></a><input type="hidden" name="_rx_pathogen_3_" value="'.$inp_v.'">';
             else echo '>';	 
			 echo $LDBAC[2];
			 ?> 
			 
	 </td>   
	</tr>
		   
<?php
   /* The 3rd column group of resistance test aerobes*/
   	while(list($x,$v)=each($lab_ResistAerobAcro))
	{
	  echo '
	         <tr>';
	   echo '
               <td>&nbsp;S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;M&nbsp;&nbsp;&nbsp;&nbsp;R<br>';
       for($n=0;$n<3;$n++)
	   {			

	       list($x2,$v2)=each($lab_ResistAerob_3);
	       if($edit_findings) echo '<a href="javascript:setM(\''.$v2.'\')">';
	       if($parsed_resist_aerob[$v2])
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

	       if($edit_findings) echo ' border=0 id="'.$v2.'"></a><input type="hidden" name="'.$v2.'" value="'.$inp_v.'">';
             else echo '>';
	
	   }
   
	   echo '   
			   </td>';
      echo '
	         </tr>';
    }
   
   ?>	
 </table>
 
	 
	 </td>
     <td bgcolor="#ee6666">
	 <img src="../img/pixel.gif" border=0 width=1 height=1>
	 </td>   
	      <td>

  <table border=0 class="lab" cellpadding=0 cellspacing=0> 	
   <tr>
      <td>&nbsp;
	 </td>  
      <td>
	 <?php
	       if($edit_findings) echo '<a href="javascript:setM(\'_rx_fungus_\')">';
	       if($parsed_resist_aerob['_rx_fungus_'])
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

	       if($edit_findings) echo ' border=0 id="_rx_fungus_"></a><input type="hidden" name="_rx_fungus_" value="'.$inp_v.'">';
             else echo '>';	 
			 echo $LDFungi;
			 ?> 
			 
	 </td>   
	</tr>
<?php
   /* The 4th column group of resistance test aerobes*/
   
   $tr_tracker=0;
   $rx_tracker=0;
   
   	while(list($x,$v)=each($lab_ResistAerobExtra))
	{
	  echo '
	         <tr>';
	   echo '
               <td>';
	   if($tr_tracker>5) echo '&nbsp;';
	     else  echo $v;
	   echo '   
			   </td>';	   
	   echo '
               <td>';
	   if($tr_tracker==6)
	   {
	       echo $LDEye.'<br>';
		   
	       if($edit_findings) echo '<a href="javascript:setM(\'_rx_eye_'.$rx_tracker.'\')">';
	       if($parsed_resist_aerob['_rx_eye_'.$rx_tracker])
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

	       if($edit_findings) echo ' border=0 id="_rx_eye_'.$rx_tracker.'"></a><input type="hidden" name="_rx_eye_'.$rx_tracker.'" value="'.$inp_v.'">';
             else echo '>';

	       $tr_tracker++;
	   }
	   elseif($tr_tracker==7)
	   {
	       echo $LDBAC[$rx_tracker].'<br>';

	       if($edit_findings) echo '<a href="javascript:setM(\'_rx_bac_'.$rx_tracker.'\')">';
	       if($parsed_resist_aerob['_rx_bac_'.$rx_tracker])
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

	       if($edit_findings) echo ' border=0 id="_rx_bac_'.$rx_tracker.'"></a><input type="hidden" name="_rx_bac_'.$rx_tracker.'" value="'.$inp_v.'">';
             else echo '>';

	       $tr_tracker=0;
	       $rx_tracker++;
	   }
	   else
	   {	  
	   echo '&nbsp;S&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;M&nbsp;&nbsp;&nbsp;&nbsp;R<br>';

       for($n=0;$n<3;$n++)
	   {			

	       list($x2,$v2)=each($lab_ResistAerobExtra_1);
	       if($edit_findings) echo '<a href="javascript:setM(\''.$v2.'\')">';
	       if($parsed_resist_aerob[$v2])
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

	       if($edit_findings) echo ' border=0 id="'.$v2.'"></a><input type="hidden" name="'.$v2.'" value="'.$inp_v.'">';
             else echo '>';
	
	   }
			    
	   $tr_tracker++;
	   }
	   echo '   
			   </td>';
      echo '
	         </tr>';
    }
   
   reset($lab_ResistAerobExtra);
   ?>	
 </table>	 
 
	 </td>
   </tr>
 </table>

 </td>
  </tr>
</table>

  </td>
    </tr>
  </tbody>
</table>
