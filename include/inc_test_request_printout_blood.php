<table   cellpadding=0 cellspacing=0 border=0 width=745>
		
	<!-- First row -->	 
        <tr bgcolor="<?php echo $bgc1 ?>" valign="top">
		<!-- <td rowspan=3><img src="../img/de/de_blood_wardfill.gif" border=0 width=27 height=492 align="absmiddle"></td> -->
        <td rowspan=3><img src="<?php echo $root_path; ?>main/imgcreator/blood_lab_leftbar.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>" border=0 width=27 height=492 align="absmiddle"></td>
		<td width=50% bgcolor="<?php echo $bgc1 ?>"  class=fva2_ml10><div   class=fva2_ml10><?php echo $LDToBloodBank."</b></font><br>".$LDTelephone ?><br>
<?php
	  echo '<font size=1 color="#000099" face="verdana,arial">'.$batch_nr.'</font>&nbsp;<br>';
          echo "<img src='".$root_path."classes/barcode/image.php?code=$batch_nr&style=68&type=I25&width=145&height=40&xres=2&font=5' border=0>";
?>
      </td>
		<td class=fva2_ml10><div   class=fva2_ml10><font size=3 color="#0000ff"><b><?php echo $LDRequestOf.$formtitle ?></b></font>
		<br>
		<?php 
		 
		 echo $LDWithMatchTest." ".$LDByBloodBank;
		 echo '<br>'.$LDYes.'&nbsp;';
		 
         printRadioButton('match_sample',1); 
		 
		 echo '&nbsp;'.$LDNo.'&nbsp;';
		
         printRadioButton('match_sample',0);
		
        ?>
	  </td>
    </tr>
  
		
		<tr  valign="top" bgcolor="<?php echo $bgc1 ?>" >
        <td valign="bottom" align="right">
		
		<!-- Block for bloodgroup, Rh-factor, Kell  -->
		<table border=0 cellspacing=0 cellpadding=2 bgcolor="#000000" width=100%>
        <tr>
          <td>
		     <table border=0 bgcolor="<?php echo $bgc1 ?>" cellpadding=4 width=100%>
             <tr  class=fva2_ml10>
              <td><?php echo $LDBloodGroup ?><br>
			  <font  size=2 color="#ff0000"><b><?php  if($stored_request['blood_group']) echo $stored_request['blood_group']; ?></b></font></td>
			   <td><?php echo $LDRhFactor ?><br>
			   <font  size=2 color="#ff0000"><b><?php  if($stored_request['rh_factor']) echo $stored_request['rh_factor']; ?></b></font></td>
			   <td><?php echo $LDKell ?><br>
			   <font  size=2 color="#ff0000"><b><?php  if($stored_request['kell']) echo $stored_request['kell']; ?></b></font></td>
              </tr>
              <tr class=fva0_ml10>
              <td colspan=3><?php echo $LDDateProtNumber ?><br>
			  <font  size=2 color="#0000ff"><?php  if($stored_request['date_protoc_nr']) echo $stored_request['date_protoc_nr']; ?></font></td>
            </tr>
            </table>
	      </td>
        </tr>
        </table>
  
		
		</td>
         <td  bgcolor="<?php echo $bgc1 ?>" valign="top"><div class=fva2b_ml10>
<?php

if($edit  || $read_form)
        {
		   echo '<img src="'.$root_path.'main/imgcreator/barcode_label_single_large.php?sid='.$sid.'&lang='.$lang.'&fen='.$full_en.'&en='.$pn.'" width=282 height=178>';
		}

		?>
    </div></td>
	</tr>
	
	<!-- Second row -->
		<tr  valign="top" bgcolor="<?php echo $bgc1 ?>" >
        <td>
		
		<!-- Block Specimen  -->
		<table border=0 cellspacing=0 cellpadding=1 bgcolor="#000000" width=100% height=100%>
        <tr>
          <td>
		     <table border=0 cellpadding=1 cellspacing=1 width=100% height=100%>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td><b>&nbsp;<?php echo $LDBloodSpecimen ?></b></td>
			   <td><?php echo $LDCount ?></td>
              </tr>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td>&nbsp;<?php echo $LDPureBlood ?></td>
			   <td><font  size=2 color="#0000ff"><?php  if($stored_request['pure_blood']) echo $stored_request['pure_blood']; ?></td>
              </tr>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td>&nbsp;<?php echo $LDRedBloodCon ?></td>
			   <td><font  size=2 color="#0000ff"><?php  if($stored_request['red_blood']) echo $stored_request['red_blood']; ?></font></td>
              </tr>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td>&nbsp;<?php echo $LDLeukoLessRedBlood ?></td>
			   <td><font  size=2 color="#0000ff"><?php  if($stored_request['leukoless_blood']) echo $stored_request['leukoless_blood']; ?></font></td>
              </tr>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td>&nbsp;<?php echo $LDWashedRedBlood ?></td>
			   <td><font  size=2 color="#0000ff"><?php  if($stored_request['washed_blood']) echo $stored_request['washed_blood']; ?></font></td>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td>&nbsp;<?php echo $LDPRP ?></td>
			   <td><font  size=2 color="#0000ff"><?php  if($stored_request['prp_blood']) echo $stored_request['prp_blood']; ?></font></td>
              </tr>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td>&nbsp;<?php echo $LDThromboCon ?></td>
			   <td><font  size=2 color="#0000ff"><?php  if($stored_request['thrombo_con']) echo $stored_request['thrombo_con']; ?></font></td>
              </tr>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td>&nbsp;<?php echo $LDFFP ?></td>
			   <td ><font  size=2 color="#0000ff"><?php  if($stored_request['ffp_plasma']) echo $stored_request['ffp_plasma']; ?></font></td>
              </tr>
             <tr bgcolor="<?php echo $bgc1 ?>" >
              <td colspan=2  class=fva2_ml10 >&nbsp;</td>
              </tr>
             <tr  class=fva2_ml10 bgcolor="<?php echo $bgc1 ?>" >
              <td>&nbsp;<?php echo $LDTransfusionDevice ?></td>
			   <td><font  size=2 color="#0000ff"><?php  if($stored_request['transfusion_dev']) echo $stored_request['transfusion_dev']; ?></font></td>
              </tr>
            </table>
	      </td>
        </tr>
        </table>
  
		
		</td>
         <td  bgcolor="<?php echo $bgc1 ?>" >
		 
		 <!--  Block for diagnosis, doctors, -->
		 <table border=0 cellspacing cellpadding=0>
     <tr>
       <td colspan=2 bgcolor="#000000"><img src="<?php echo $root_path ?>gui/img/common/default/pixel.gif" border=0 width=1 height=2 align="absmiddle"></td>
     </tr>
     <tr>
       <td><div class=fva2b_ml10><font size=1><?php echo $LDTransfusionDate ?></font></div></td>
       <td><font face="arial" size=2 color="#0000ff"><?php  if($stored_request['transfusion_date'] && $stored_request['transfusion_date']!=DBF_NODATE) echo formatDate2Local($stored_request['transfusion_date'],$date_format); ?></font></td>
     </tr>
     <tr>
       <td colspan=2><div class=fva2b_ml10><b><?php echo $LDDiagnosis ?></b><br><img src="<?php echo $root_path ?>gui/img/common/default/pixel.gif" border=0 width=10 height=30 align="left">
	   <font face="arial" size=2 color="#0000ff"><?php  if($stored_request['diagnosis']) echo stripslashes($stored_request['diagnosis']); ?></font></div></td>
     </tr>
     <tr>
       <td colspan=2> <div class=fva2b_ml10><font size=1><?php echo $LDNotesRequests ?></font><br><img src="<?php echo $root_path ?>gui/img/common/default/pixel.gif" border=0 width=10 height=30 align="left">
	   <font face="arial" size=2 color="#0000ff"><?php  if($stored_request['notes']) echo stripslashes($stored_request['notes']); ?></font></div></td>
       <td></td>
     </tr>
     <tr>
       <td align="right"><div class=fva2b_ml10><font size=1><?php echo $LDDate ?>:&nbsp;</font></div></td>
       <td><font face="arial" size=2 color="#0000ff"><?php   echo formatDate2Local($stored_request['send_date'],$date_format);  ?></font></td>
     </tr>
     <tr>
       <td align="right"><div class=fva2b_ml10><font size=1><?php echo $LDDoctor ?>:&nbsp;</font></div></td>
       <td><font face="arial" size=2 color="#0000ff"><?php  if($stored_request['doctor']) echo $stored_request['doctor']; ?></font></td>
     </tr>
     <tr>
       <td align="right"><div class=fva2b_ml10><font size=1><?php echo $LDTelephone ?>:&nbsp;</font></div></td>
       <td><font face="arial" size=2 color="#0000ff"><?php  if($stored_request['phone_nr']) echo $stored_request['phone_nr']; ?></font></td>
     </tr>
     <tr>
       <td colspan=2><div class=fva2b_ml10><font size=1 face="arial">&nbsp;<br><?php echo $LDDoctorNotice ?></font></div></td>
     </tr>
   </table>
    </td>
	</tr>
	
	<tr>
        <td bgcolor="#000000" colspan=3><img src="<?php echo $root_path ?>gui/img/common/default/pixel_blk.gif" border=0 width=745 height=3 align="absmiddle"><br>
    </td>
	</tr>

	<tr bgcolor="<?php echo $bgc1 ?>">
        <td bgcolor="#000000" valign="top" colspan=3>
	
	<!--  Table container for the lower part of the form  -->
	
	      <table border=0 cellspacing=1 width=100% height=100% align="left" cellpadding=0>
         <tr bgcolor="<?php echo $bgc1 ?>">
        <td  bgcolor="<?php echo $bgc1 ?>" rowspan=20 width=27>
		<img src="<?php echo $root_path; ?>main/imgcreator/blood_lab_leftbar.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&form_bottom=1" border=0 width=27 height=492><br></td>
           <td width=100 align="center"><font size=2 face="arial"><?php echo $LDPB ?><br><?php echo $LD350 ?></font></td>
           <td  colspan=7>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['blood_pb']) echo $stored_request['blood_pb']; ?></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td width=100 align="center"><font size=2 face="arial"><?php echo $LDRB ?></font></td>
           <td  colspan=7>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['blood_rb']) echo $stored_request['blood_rb']; ?></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td width=100 align="center"><font size=2 face="arial"><?php echo $LDLLRB ?></font></td>
           <td  colspan=7>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['blood_llrb']) echo $stored_request['blood_llrb']; ?></td>
        </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td width=100 align="center"><font size=2 face="arial"><?php echo $LDWRB ?></font></td>
           <td  colspan=7>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['blood_wrb']) echo $stored_request['blood_wrb']; ?></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td width=100 align="center"><font size=2 face="arial"><?php echo $LDPRP_Initial ?></font></td>
           <td  colspan=7>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['blood_prp']) echo $stored_request['blood_prp']; ?></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td width=100 align="center"><font size=2 face="arial"><?php echo $LDTC ?></font></td>
           <td  colspan=7>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['blood_tc']) echo $stored_request['blood_tc']; ?></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td width=100 align="center"><font size=2 face="arial"><?php echo $LDFFP_Initial ?></font></td>
           <td  colspan=7>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['blood_ffp']) echo $stored_request['blood_ffp']; ?></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>" valign="top">
           <td colspan=4>&nbsp;<font size=2 face="verdana,arial"><b><?php echo $LDLabServices ?></b></font></td>
           <td colspan=4 rowspan=4 width=50%>&nbsp;<font size=1 face="arial"><?php echo $LDLabTimeStamp ?></font><br>
		   &nbsp;<font size=2 face="verdana,arial"><?php 

		   if($stored_request['lab_stamp'] && $stored_request['lab_stamp'] != DBF_NODATETIME ) echo formatDate2Local($stored_request['lab_stamp'],$date_format).' '.convertTimeToLocal(formatDate2Local($stored_request['lab_stamp'],$date_format,0,1));
			 else echo formatDate2Local(date('Y-m-d H:i:s'),$date_format).' '.convertTimeToLocal(formatDate2Local(date('Y-m-d H:i:s'),$date_format,0,1));
			 
			 ?>
			 </font>
   
		   </td>

         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;<font size=1 face="arial"><nobr><?php echo $LDServiceCode ?></nobr></font></td>
           <td width=30%>&nbsp;</td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDCount ?></font></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDPrice ?></font></td>

         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDBloodGroupCode ?></font></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDBloodGroup ?></font></td>
           <td>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['b_group_count']) echo $stored_request['b_group_count']; ?></font></td>
           <td>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['b_group_price']!="0.00") echo $stored_request['b_group_price']; ?></font></td>

         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDA_SubgroupCode ?></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDA_Subgroup ?></td>
           <td>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['a_subgroup_count']) echo $stored_request['a_subgroup_count']; ?></font></td>
           <td>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['a_subgroup_price']!="0.00")  echo $stored_request['a_subgroup_price']; ?></font></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>" valign="top">
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDExtraBGFactorsCode ?></font></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDExtraBGFactors ?></font></td>
           <td>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['extra_factors_count']) echo $stored_request['extra_factors_count']; ?></font></td>
           <td>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['extra_factors_price']!="0.00") echo $stored_request['extra_factors_price']; ?></font></td>
           <td colspan=2 rowspan=4>&nbsp;<font size=1 face="arial"><?php echo $LDReleaseVia ?><br>
		   &nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['release_via']) echo $stored_request['release_via']; ?></font></td>
           <td colspan=2 rowspan=4>&nbsp;<font size=1 face="arial"><?php echo $LDReceiptAck ?></font><br>
		   &nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['receipt_ack']) echo $stored_request['receipt_ack']; ?></font></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDCoombsTestCode ?></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDCoombsTest ?></td>
           <td>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['coombs_count']) echo $stored_request['coombs_count']; ?></font></td>
           <td>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['coombs_price']!="0.00")  echo $stored_request['coombs_price']; ?></font></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDAntibodyTestCode ?></font></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDAntibodyTest ?></font></td>
           <td>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['ab_test_count']) echo $stored_request['ab_test_count']; ?></font></td>
           <td>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['ab_test_price']!="0.00") echo $stored_request['ab_test_price']; ?></font></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDCrossTestCode ?></font></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDCrossTest ?></font></td>
           <td>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['crosstest_count']) echo $stored_request['crosstest_count']; ?></font></td>
           <td>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['crosstest_price']!="0.00") echo $stored_request['crosstest_price']; ?></font></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDAntibodyDiffCode ?></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDAntibodyDiff ?></td>
           <td>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['ab_diff_count']) echo $stored_request['ab_diff_count']; ?></font></td>
           <td>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['ab_diff_price']!="0.00") echo $stored_request['ab_diff_price']; ?></font></td>
           <td colspan=2>&nbsp;<font size=1 face="arial"><?php echo $LDSignature ?></font></td>
           <td colspan=2>&nbsp;<font size=1 face="arial"><?php echo $LDSignature ?></font></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;<font face="arial" size=1 color="#000000"><?php  if($stored_request['x_test_1_code']) echo $stored_request['x_test_1_code']; ?></font></td>
           <td>&nbsp;<font face="arial" size=1 color="#000000"><?php  if($stored_request['x_test_1_name']) echo $stored_request['x_test_1_name']; ?></font></td>
           <td>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['x_test_1_count']) echo $stored_request['x_test_1_count']; ?></font></td>
           <td>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['x_test_1_price']!="0.00") echo $stored_request['x_test_1_price']; ?></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDLabLogBook ?></font></td>
           <td>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['mainlog_nr']) echo $stored_request['mainlog_nr']; else echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; ?></font></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDLabNumber ?></font></td>
           <td>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['lab_nr']) echo $stored_request['lab_nr']; else echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; ?></font></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;<font face="arial" size=1 color="#000000"><?php  if($stored_request['x_test_2_code']) echo $stored_request['x_test_2_code']; ?></font></td>
           <td>&nbsp;<font face="arial" size=1 color="#000000"><?php  if($stored_request['x_test_2_name']) echo $stored_request['x_test_2_name']; ?></font></td>
           <td>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['x_test_2_count']) echo $stored_request['x_test_2_count']; ?></font></td>
           <td>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['x_test_2_price']!="0.00") echo $stored_request['x_test_2_price']; ?></font></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDBookedOn ?></font></td>
           <td>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['mainlog_date']!=DBF_NODATE) echo formatDate2Local($stored_request['mainlog_date'],$date_format); else echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; ?></font></td>
           <td>&nbsp;<font size=1 face="arial"><?php echo $LDDate ?></font></td>
           <td>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['lab_date']!=DBF_NODATE) echo formatDate2Local($stored_request['lab_date'],$date_format); else echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'; ?></font></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
           <td>&nbsp;<font face="arial" size=1 color="#000000"><?php  if($stored_request['x_test_3_code']) echo $stored_request['x_test_3_code']; ?></font></td>
           <td>&nbsp;<font face="arial" size=1 color="#000000"><?php  if($stored_request['x_test_3_name']) echo $stored_request['x_test_3_name']; ?></font></td>
           <td>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['x_test_3_count']) echo $stored_request['x_test_3_count']; ?></font></td>
           <td>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['x_test_3_price']!="0.00") echo $stored_request['x_test_3_price']; ?></td>
           <td colspan=2>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['mainlog_sign']) echo $stored_request['mainlog_sign']; ?></font></td>
           <td colspan=2>&nbsp;<font face="arial" size=2 color="#000000"><?php  if($stored_request['lab_sign']) echo $stored_request['lab_sign']; ?></font></td>
         </tr>
         <tr bgcolor="<?php echo $bgc1 ?>">
             <td colspan=3>&nbsp;<font size=1 face="arial"><?php echo $LDTotalAmount ?></td>
           <td>&nbsp;<font face="arial" size=2 color="#000000"><?php   
		   $totalamount=($stored_request['b_group_price']+$stored_request['a_subgroup_price']+$stored_request['extra_factors_price']+$stored_request['coombs_price']+$stored_request['ab_test_price']+$stored_request['crosstest_price']+$stored_request['ab_diff_price']+$stored_request['x_test_1_price']+$stored_request['x_test_2_price']+$stored_request['x_test_3_price']);
		   if ($totalamount) echo $totalamount; ?></td>
           <td colspan=2>&nbsp;<font size=1 face="arial"><?php echo $LDSignature ?></td>
           <td colspan=2>&nbsp;<font size=1 face="arial"><?php echo $LDSignature ?></td>
         </tr>

       </table>
       
	
		</td>
  </tr>

		</table>	
       	
	

