<?php
require_once($root_path.'global_conf/inc_global_address.php');
if (!isset($subtarget) || !$subtarget) $subtarget=$target;
?>
	   <!--  outermost table creating form border -->
<table border=0 bgcolor="#000000" cellpadding=1 cellspacing=0>
  <tr>
    <td>
	
	<table border=0 bgcolor="#ffffff" cellpadding=0 cellspacing=0>
   <tr>
     <td>
	
	   <table   cellpadding=0 cellspacing=1 border=0 width=700>
   <tr  valign="top">
   <td  bgcolor="<?php echo $bgc1 ?>" rowspan=2>
 <?php
        if($edit || $read_form)
        {
		   echo '<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid='.$sid.'&lang='.$lang.'&fen='.$full_en.'&en='.$pn.'" width=282 height=178>';
		}
		?></td>
      <td bgcolor="<?php echo $bgc1 ?>"  class=fva2_ml10><div   class=fva2_ml10><font size=5 color="#0000ff"><b><?php echo $formtitle ?></b></font>
		 <br><?php echo $global_address[$subtarget].'<br>'.$LDTel.'&nbsp;'.$global_phone[$subtarget]; ?>
		 </td>
		 </tr>
	 <tr>
      <td bgcolor="<?php echo $bgc1 ?>" align="right" valign="bottom">	 
	  <?php
		    echo '<font size=1 color="#990000" face="verdana,arial">'.$batch_nr.'</font>&nbsp;&nbsp;<br>';
			  echo '<img src=\''.$root_path.'classes/barcode/image.php?code='.$batch_nr.'&style=68&type=I25&width=145&height=40&xres=2&font=5\' border=0>';
     ?>
	     </td>
		 </tr>
		 	
		<tr bgcolor="<?php echo $bgc1 ?>">
		<td  valign="top" colspan=2 >
		
		<table border=0 cellpadding=1 cellspacing=1 width=100%>
    <tr>
      <td align="right"><div class=fva2_ml10><?php echo $LDXrayTest ?></td><br>
      <td>&nbsp;<?php printCheckBox('xray'); ?></td>
      <td align="right"><div class=fva2_ml10><?php echo $LDSonograph ?></td>
      <td>&nbsp;<?php printCheckBox('sono'); ?></td>
    </tr>
    <tr>
      <td align="right"><div class=fva2_ml10><?php echo $LDCT ?></td>
      <td>&nbsp;<?php printCheckBox('ct'); ?></td>
      <td align="right"><div class=fva2_ml10><?php echo $LDMammograph ?></td>
      <td>&nbsp;<?php printCheckBox('mammograph'); ?></td>
    </tr>
    <tr>
      <td align="right"><div class=fva2_ml10><?php echo $LDMRT ?></td>
      <td>&nbsp;<?php printCheckBox('mrt'); ?></td>
      <td align="right"><div class=fva2_ml10><?php echo $LDNuclear ?></td>
      <td>&nbsp;<?php printCheckBox('nuclear'); ?></td>
    </tr>
	
    <tr>
      <td colspan=4><hr></td>
    </tr>

    <tr>
      <td align="right"><div class=fva2_ml10><?php echo $LDPatMobile ?> &nbsp;<?php echo $LDYes ?></td>
      <td><font size=2 face="verdana,arial">&nbsp;<?php printRadioButton('if_patmobile',1); ?>&nbsp;<?php echo $LDNo ?>
	  &nbsp;<?php printRadioButton('if_patmobile',0); ?></td>
      <td align="right"><div class=fva2_ml10><?php echo $LDAllergyKnown ?> &nbsp;<?php echo $LDYes ?></td>
      <td><font size=2 face="verdana,arial">&nbsp;<?php printRadioButton('if_allergy',1); ?>&nbsp;<?php echo $LDNo ?>
	  &nbsp;<?php printRadioButton('if_allergy',0); ?></td>
    </tr>
    <tr>
      <td align="right"><div class=fva2_ml10><?php echo $LDHyperthyreosisKnown ?> &nbsp;<?php echo $LDYes ?></td>
      <td><font size=2 face="verdana,arial">&nbsp;<?php printRadioButton('if_hyperten',1); ?>&nbsp;<?php echo $LDNo ?>
	  &nbsp;<?php printRadioButton('if_hyperten',0); ?></td>
      <td align="right"><div class=fva2_ml10><?php echo $LDPregnantPossible ?> &nbsp;<?php echo $LDYes ?></td>
      <td><font size=2 face="verdana,arial">&nbsp;<?php printRadioButton('if_pregnant',1); ?>&nbsp;<?php echo $LDNo ?>
	  &nbsp;<?php printRadioButton('if_pregnant',0); ?>
	  </td>
    </tr>
  </table>
  &nbsp;<br>
		
  </td>
</tr>
		 
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td colspan=2><div class=fva2_ml10><?php echo $LDClinicalInfo ?>:<p><blockquote><img src="<?php echo $root_path ?>gui/img/common/default/pixel.gif" border=0 width=1 height=45 align="left">
		<font face="courier" size=2 color="#000000"><?php echo nl2br(stripslashes($stored_request['clinical_info'])) ?></font></blockquote>
				</td>
		</tr>	
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td colspan=2><div class=fva2_ml10><?php echo $LDReqTest ?>:<p><blockquote><img src="<?php echo $root_path ?>gui/img/common/default/pixel.gif" border=0 width=1 height=45 align="left">
		<font face="courier" size=2 color="#000000"><?php echo  nl2br(stripslashes($stored_request['test_request'])) ?></font></blockquote>
				</td>
		</tr>	


	
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td colspan=2 align="right"><div class=fva2_ml10>
		 <?php echo $LDDate ?>:
		<font face="courier" size=2 color="#000000">&nbsp;<?php 
		
		            
					  echo formatDate2Local($stored_request['send_date'],$date_format); 
					
				  ?></font>&nbsp;
  <?php echo $LDRequestingDoc ?>:
		<font face="courier" size=2 color="#000000">&nbsp;<?php echo $stored_request['send_doctor'] ?></font></div><br>
		</td>
    </tr>
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td  colspan=2 bgcolor="#cccccc"><div class=fva2_ml10><font color="#000099">
		 <?php echo $LDXrayNumber ?><font face="courier" size=2 color="#000000">
        <?php if($printmode && $stored_request['xray_nr']) echo $stored_request['xray_nr']; ?>
		</font>&nbsp;&nbsp;
		<?php echo $LD_r_cm2 ?>
		<font face="courier" size=2 color="#000000">
		<?php if($printmode && $stored_request['r_cm_2']) echo $stored_request['r_cm_2']; ?> 
		</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		 <?php echo $LDXrayTechnician ?>&nbsp;&nbsp;
		 <font face="courier" size=2 color="#000000">
        <?php if($printmode && $stored_request['mtr']) echo $stored_request['mtr']; ?>
		</font>&nbsp;&nbsp;
		<?php echo $LDDate ?>&nbsp;
		<font face="courier" size=2 color="#000000">
        <?php 
		
		            if($printmode && $stored_request['xray_date']!=DBF_NODATE)
					{
					  echo formatDate2Local($stored_request['xray_date'],$date_format); 
					}
				  ?> 
       </font>
	  </div>
    </tr>	
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td colspan=2> 
		 <div class=fva2_ml10>&nbsp;<br><font color="#000099"><?php echo $LDNotesTempReport ?></font><p>
		 <font face="courier" size=2 color="#000000">
         <?php if($printmode && $stored_request['results']) echo nl2br(stripslashes($stored_request['results'])) ?>	
		 </font>&nbsp;<p><br>
		 </td>
		</tr>	
		
	<tr bgcolor="<?php echo $bgc1 ?>">
		<td colspan=2 align="right"><div class=fva2_ml10><font color="#000099">
		 <?php echo $LDDate ?>&nbsp;<font face="courier" size=2 color="#000000">
        <?php 
					 if($stored_request['results_date']!=DBF_NODATE) echo formatDate2Local($stored_request['results_date'],$date_format);
				  ?>&nbsp;&nbsp;
	   </font><font color="#000099">
  <?php echo $LDReportingDoc ?></font>&nbsp;<font color="#000000">
        <?php if($printmode && $stored_request['results_doctor']) echo $stored_request['results_doctor']; ?>
		<br>
		&nbsp;</td>
    </tr>
		</table> 
		

	 </td>
   </tr>
 </table>
	
	</td>
  </tr>
</table>
	
</td>

</tr>
</table>        	


