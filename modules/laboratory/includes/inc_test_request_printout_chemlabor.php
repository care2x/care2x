
<!-- outermost table for the form -->
<table border=0 cellpadding=1 cellspacing=0 bgcolor="#606060">
  <tr>
    <td>
	
	<!-- table for the form simulating the border -->
	<table border=0 cellspacing=0 cellpadding=0 bgcolor="white">
   <tr>
     <td>
	 
	 <!-- Here begins the table for the form  -->
	 
		<table   cellpadding=0 cellspacing=0 border=0 width=745>
	<tr  valign="top">

      <td bgcolor="<?php echo $bgc1 ?>">
	  <div class="lmargin">
	  <font size=3 color="#990000" face="arial">
       <?php echo $LDHospitalName ?><br>
       <?php echo $LDCentralLab ?><p><font size=2>
	   <?php echo $LDRoomNr ?>

	    <?php 
		   if($read_form) echo stripslashes($stored_request['room_nr']);

		?>
	   <p>
	    <!--  Table for the day and month code -->
   <table border=0 cellspacing=0 cellpadding=0>
   <!-- Sampling time, day, minutes row -->
   <tr align="center">
   <td colspan=4><font size=1 face="arial" color= "purple"><?php echo $LDSamplingTime ?></td>
   <td colspan=3><font size=1 face="arial" color= "purple"><?php echo $LDDay ?></td>
   <td bgcolor= "#990000"><img src="p.gif" border=0 width=1 height=1></td>
   <td colspan=3><font size=1 face="arial" color= "purple"><?php echo $LDMinutes ?></td>

   </tr>
   <!-- Day row  -->
   <tr align="center">
   <?php 
	for($i=1;$i<8;$i++)
	   echo 	 "<td><font size=1 face=\"verdana,arial\" color= \"#990000\">".$LDShortDay[$i]."</td>";
	?>
   <td bgcolor= "#990000"><img src="p.gif" border=0 width=1 height=1></td>
   <td><font size=1 face="verdana,arial" color= "#990000">15</td>
   <td><font size=1 face="verdana,arial" color= "#990000">30</td>
   <td><font size=1 face="verdana,arial" color= "#990000">45</td>

   </tr>

   <tr align="center">
   <?php
 
    if(($read_form))  $day_names=(int)$stored_request['sample_weekday'];
      else   $day_names=(int)date('w');
	  
    if(!$day_names) $day_names=7;
	
	for($i=1;$i<8;$i++)
	{
	   echo 	'
	   <td>';
	   if($day_names==$i)
	   {
	     echo '<img src="f.gif"';
		 $v="1";
	   }
	     else
	   {
	  	  echo  '<img src="b.gif"';
		  $v="0";
	    }
	   echo ' width=18 height=6>';
	   echo '</td>';
	}
	/* Divide line */
	echo  ' <td bgcolor= "#990000"><img src="p.gif" border=0 width=1 height=1></td>';
	
   if(($read_form)&&$stored_request['sample_time'])
   {
      list($hour,$quarter_mins)=explode(":",$stored_request['sample_time']);
    }

	/* Get the quarter minutes*/
    if(!$edit_form&&!$read_form)
	{
	  $quarter_mins=(int)date('i');
	}
	 
   if($quarter_mins>44)
   {
     $quarter_mins=45;
   }
   elseif($quarter_mins>29)
   {
     $quarter_mins=30;
   }
   elseif($quarter_mins>14)
   {
     $quarter_mins=15;
   }
   else $quarter_mins=0;

	/* For the 10's */
	
      echo 	'<td>';
	  if($quarter_mins==15)
	   {
	     echo '<img src="f.gif"';
		 $v="1";
	   }
	     else
	   {
	  	  echo  '<img src="b.gif"';
		  $v="0";
	    }
	   echo ' border=0 width=18 height=6>';
	   echo '</td>';

	   
	/* For the 30's */

	   echo 	'<td>';
	   if($quarter_mins==30)
      {
	     echo '<img src="f.gif"';
		 $v="1";
	   }
	     else
	   {
	  	  echo  '<img src="b.gif"';
		  $v="0";
	    }

	   echo ' border=0 width=18 height=6>';
	   echo '</td>';
	   
	/* For the 45's */

	   echo 	'<td>';
	   if($quarter_mins==45) 
	   {
	     echo '<img src="f.gif"';
		 $v="1";
	   }
	     else
	   {
	  	  echo  '<img src="b.gif"';
		  $v="0";
	    }
	   echo ' border=0 width=18 height=6>';
	   echo '</td>';
	?>
   </tr>
   <!-- 10, 20 Time row -->
      <tr align="center">
   <td ><font size=1 face="arial" >&nbsp;</td>
   <td ><font size=1 face="verdana,arial" color= "#990000">10</td>
   <td><font size=1 face="verdana,arial" color= "#990000">20</td>
   <td colspan=8><font size=1 face="arial" color= "purple">&nbsp;</td>
   </tr>
   <!-- Input blocks for 10, 20 Time row -->
      <tr align="center">
   <td ><font size=1 face="arial" color= "purple"></td>
   <?php
   
   $hour_tens=0;
   $hour_ones=0;

    if(!$edit_form&&!$read_form)
	{
       $hour=(int)date('H');
	}
	
   if($hour>19)
   {
     $hour_tens=20;
	 $hour_ones=$hour-$hour_tens;
   }
   elseif($hour>9)
   {
     $hour_tens=10;
	 $hour_ones=$hour-$hour_tens;
   }
   else
   {
    $hour_ones=$hour;
   }	  
	   echo '
	   <td>';
	   if($hour_tens==10)
	   {
	     echo '<img src="f.gif"';
		 $v="1";
	   }
	     else
	   {
	  	  echo  '<img src="b.gif"';
		  $v="0";
	    }
	   echo ' border=0 width=18 height=6>';
	   echo '</td>';

	   echo '
	   <td>';
	   if($hour_tens==20)
	   {
	     echo '<img src="f.gif"';
		 $v="1";
	   }
	     else
	   {
	  	  echo  '<img src="b.gif"';
		  $v="0";
	    }
	   echo ' border=0 width=18 height=6>';
	   echo '</td>';
   ?>
   <td colspan=8><font size=1 face="arial" color= "purple"></td>

   </tr>
   
   <tr align="center">
   <?php
	for($i=0;$i<7;$i++)
	   echo 	 "<td><font size=1 face=\"verdana,arial\" color= \"#990000\">".$i."</td>";
	?>
   <td></td>
   <?php
	for($i=7;$i<10;$i++)
	   echo 	 "<td><font size=1 face=\"verdana,arial\" color= \"#990000\">".$i."</td>";
	?>
   </tr>
   <tr>
	<?php
   
	for($i=0;$i<7;$i++)
	{
	   echo 	'
	   <td>';
	   if($hour_ones==$i)
	   {
	     echo '<img src="f.gif"';
		 $v="1";
	   }
	     else
	   {
	  	  echo  '<img src="b.gif"';
		  $v="0";
	    }
	   echo ' border=0 width=18 height=6>';
	   echo '</td>';
	}
	?>
   <td></td>
	<?php
	for($i=7;$i<10;$i++)
	{
	   echo 	'
	   <td>';
	   if($hour_ones==$i)
	   {
	     echo '<img src="f.gif"';
		 $v="1";
	   }
	     else
	   {
	  	  echo  '<img src="b.gif"';
		  $v="0";
	    }
	   echo ' border=0 width=18 height=6>';
	   echo '</td>';
	}
	?>
   </tr>
  <!-- urgjente -->   
<tr align="center"  colspan=4>
   <td ><font size=1 face="arial" >&nbsp;</td>
   <td colspan="3"><font size=1 face="verdana,arial" color= "#990000">Urgjente</td>
   <td><font size=1 face="arial" color= "purple">&nbsp;</td>
   <td ><font size=1 face="arial" color= "purple"></td>
   <?php 
			echo '
			          <td '.$tdbgcolor.'>';
			if($edit) echo '<a href="javascript:setM(\'urgent\')">';
			if($edit_form||$read_form)
			{
			   if($stored_request['urgent'])
			   {
			      echo '<img src="f.gif"';
				  $inp_v=1;
				}
				else
				{
				  echo '<img src="b.gif"';
				}
			}
			else
			{
			   echo '<img src="b.gif"';
			}
			
			echo ' border=0 width=18 height=6 id="urgent">';

			if($edit) echo '</a><input type="hidden" name="urgent" value="'.$stored_request['urgent'].'">';	
			'</td>';

   ?>
   <td colspan=8><font size=1 face="arial" color= "purple"></td>
 </tr>   
<!-- end urgjente   -->   
 </table>
 </div>
</td>

<!-- Middle block of first row -->
      <td bgcolor="<?php echo $bgc1 ?>">
		 <table border=0 cellpadding=10 bgcolor="#ee6666">
     <tr>
       <td>
   
<?php

/* Patient label */

 if($read_form)
{
    echo '<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid=$sid&lang=$lang&fen='.$full_en.'&en='.$pn.'" width=282 height=178>';
}

?>
</td>
     </tr>
   </table>
</td>


         <td  bgcolor="<?php echo $bgc1 ?>"  align="right">
<!--  Block for the casenumber codes -->  
 <table border=0 cellspacing=0 cellpadding=0>
<?php
for($n=0;$n<8;$n++)
{

	if($n==2)
	{
	   echo '<tr><td colspan=10><img src="p.gif" width=1 height=2></td></tr>
	           <tr><td bgcolor="#ffcccc" colspan=10><img src="p.gif" width=1 height=1></td></tr>';
	 }
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
	   echo ' width=18 height=6></td>';
	}
	?>
   </tr>
<?php
}
?>

  <tr>
    <td colspan=10 align="right">
	<?php
	
	/* Barcode for the batch nr */
	
		    echo '<font size=1 color="#990000" face="verdana,arial">'.$batch_nr.'</font>&nbsp;&nbsp;<br>';
    /**
	*  The barcode image is first searched in the cache. If present, it will be displayed.
	*  Otherwise an image will be generated, stored in the cache and displayed.
	*/
	$in_cache=1;
	
	if(!file_exists($root_path.'cache/barcodes/form_'.$batch_nr.'.png'))
	{
          echo "<img src='".$root_path."classes/barcode/image.php?code=".$batch_nr."&style=68&type=I25&width=145&height=40&xres=2&font=5&label=1&form_file=1' border=0 width=0 height=0>";
	      if(!file_exists($root_path.'cache/barcodes/form_'.$batch_nr.'.png'))
	     {
             echo "<img src='".$root_path."classes/barcode/image.php?code=".$batch_nr."&style=68&type=I25&width=145&height=40&xres=2&font=5' border=0>";
			 $in_cache=0;
		 }
	}

    if($in_cache)   echo '<img src="'.$root_path.'cache/barcodes/form_'.$batch_nr.'.png"  border=0>';
	
	/* Prepare the narrow batch nr barcode for specimen labels */
	if(!file_exists($root_path.'cache/barcodes/lab_'.$batch_nr.'.png'))
	{
          echo "<img src='".$root_path."classes/barcode/image.php?code=".$batch_nr."&style=68&type=I25&width=145&height=60&xres=1&font=5&label=1&form_file=lab' border=0 width=0 height=0>";
	}
	
?>	
	</td>
  </tr>

 </table>

    </td>

	</tr>
<!--  The  row for batch number -->
	<tr bgcolor="<?php echo $bgc1 ?>">	    
	<td align="right"  colspan=3>
	<font size=1 color="purple" face="verdana,arial"><?php echo $LDBatchNumber ?><font color="#000000" size=2> <?php echo $batch_nr ?>
	<?php
	for($i=0;$i<30;$i++)
	{
	   if(substr($result['patnum'],$n,1)==$i) echo '<img src="f.gif"';
	     else echo  '<img src="b.gif"';
	   echo ' width=18 height=6>';
	}
	?>
    </td>

	</tr>	
	
	</table>
	
<!--  The test parameters begin  -->
	
<table border=0 cellpadding=0 cellspacing=0 width=745 bgcolor="<?php echo $bgc1 ?>">
 <?php
# Start buffering output
ob_start();
for($i=0;$i<=$max_row;$i++) {
	echo '<tr class="lab">';
	for($j=0;$j<=$column;$j++) {
			if($LD_Elements[$j][$i]['type']=='top') {
				echo '<td bgcolor="#ee6666" colspan="2"><font color="white">&nbsp;<b>'.$LD_Elements[$j][$i]['value'].'</b></font></td>';
			} else {
				if($LD_Elements[$j][$i]['value']) {
					echo '<td>';
					if($edit) {
						if( isset($stored_param[$LD_Elements[$j][$i]['id']]) && !empty($stored_param[$LD_Elements[$j][$i]['id']])) {
							echo '<input type="hidden" name="'.$LD_Elements[$j][$i]['id'].'" value="1">
							<a href="javascript:setM(\''.$LD_Elements[$j][$i]['id'].'\')">';
						} else {
							echo '<input type="hidden" name="'.$LD_Elements[$j][$i]['id'].'" value="0">
							<a href="javascript:setM(\''.$LD_Elements[$j][$i]['id'].'\')">';
						}
					}
					if( isset($stored_param[$LD_Elements[$j][$i]['id']]) && !empty($stored_param[$LD_Elements[$j][$i]['id']])) {
						echo '<img src="f.gif" border=0 width=18 height=6 id="'.$LD_Elements[$j][$i]['id'].'">';
					} else {
						echo '<img src="b.gif" border=0 width=18 height=6 id="'.$LD_Elements[$j][$i]['id'].'">';
					} 
					if($edit) {
						echo '</a>';
					}
					echo '</td><td>';
					if($edit) echo '<a href="javascript:setM(\''.$LD_Elements[$j][$i]['id'].'\')">'.$LD_Elements[$j][$i]['value'].'</a>';
					else echo $LD_Elements[$j][$i]['value'];
					echo '</td>';
				} else {
					echo '<td colspan=2>&nbsp;</td>';
				}
			}
	}
	echo '</tr><tr>';
	if($i<$max_row) {
	  	for($k=0;$k<=$column;$k++) {
	  		echo '<td width=2></td><td bgcolor="#ffcccc"><img src="p.gif"  width=1 height=1></td>';
	  	}
  	echo '</tr>';
	}
}

//$sTemp=ob_get_contents();
ob_end_flush();
?>
  <tr>
    <td colspan=9>&nbsp;<font size=2 face="verdana,arial" color="black"><?php if($stored_request['doctor_sign']) echo stripslashes($stored_request['doctor_sign']); ?></td>
    <td colspan=11&nbsp;><font size=2 face="verdana,arial" color="black"><?php if($stored_request['notes']) echo stripslashes($stored_request['notes']); ?></td>
  </tr>
  <tr>
    <td colspan=20><font size=2 face="verdana,arial" color="purple">&nbsp;<?php echo $LDEmergencyProgram.' &nbsp;&nbsp;&nbsp;<img '.createComIcon($root_path,'violet_phone.gif','0','absmiddle',TRUE).'> '.$LDPhoneOrder ?></td>
  </tr>

</table><!-- End of the main table holding the form -->
 
 	 </td>
   </tr>
 </table><!-- End of table simulating the border -->
 
	</td>
  </tr>
</table><!--  End of the outermost table bordering the form -->
