<?php

function Spacer()
{
/*?>
<TR bgColor=#dddddd height=1>
                <TD colSpan=3><IMG height=1 
                  src="../../gui/img/common/default/pixel.gif" 
                  width=5></TD></TR>
<?php
*/}
?>
<img <?php echo createComIcon($root_path,'angle_left_s.gif',0); ?>>
<br>
<FONT color="#cc0000">
<?php echo $LDOptions4Employee; ?>
</font>

<TABLE cellSpacing=0 cellPadding=0 bgColor=#999999 border=0>
        <TBODY>
        <TR>
          <TD>
            <TABLE cellSpacing=1 cellPadding=2 bgColor=#999999 
            border=0>
              <TBODY>
				  
               <TR bgColor=#eeeeee> <td align=center><img <?php echo createComIcon($root_path,'man-whi.gif','0') ?>></td>
                <TD vAlign=top >

<!-- 				 <a href="javascript:alert('Function not  available yet');"><?php echo $LDAssignDoctorDept; ?></a>
 -->				 <a href="<?php echo $root_path; ?>modules/doctors/doctors-select-dept.php<?php echo URL_APPEND."&target=plist&nr=$personell_nr&user_origin=personell_admin"; ?>"><?php echo $LDAssignDoctorDept; ?></a>
				   </FONT></TD>
                </TR>
			   
           <?php Spacer(); ?>
				  
             <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'nurse.gif','0') ?>></td>
                <TD vAlign=top width=150> 
                   
				<a href="<?php echo $root_path; ?>modules/nursing_or/nursing-or-select-dept.php<?php echo URL_APPEND."&target=plist&nr=$personell_nr&user_origin=personell_admin"; ?>"><?php echo $LDAssignNurseDept; ?></a>
				   </FONT></TD>
                </TR>
			   
           <?php Spacer(); ?>

				  
              <TR bgColor=#eeeeee>  <td align=center><img <?php echo createComIcon($root_path,'violet_phone.gif','0') ?>></td>
                <TD vAlign=top > 
                   
			 <a href="<?php echo $root_path.'modules/phone_directory/phone_edit.php'.URL_APPEND.'&user_origin=pers&nr='.$personell_nr; ?>"><?php echo $LDAddPhoneInfo ?></a>
				   </FONT></TD>
                </TR>				 
			   
<!--  			   
           <?php Spacer(); ?>
				  
               <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'disc_repl.gif','0') ?>></td>
                <TD vAlign=top > 
                   
				  <a href="javascript:alert('Function not  available yet')"><?php echo $LDPayrollOptions ?></a>
				   </FONT></TD>
                </TR>
			   
           <?php Spacer(); ?>
				  
				  <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'document.gif','0') ?>></td>
                <TD vAlign=top > 
                   <nobr>
				 <a href="javascript:alert('Function not  available yet')"><?php echo $LDLegalDocuments ?></a>
				  </nobr> </FONT></TD>
                </TR>
 -->			   
           <?php Spacer(); ?>
				  
				  <TR bgColor=#eeeeee><td align=center><img <?php echo createComIcon($root_path,'bn.gif','0') ?>></td>
                <TD vAlign=top > 
                   <nobr>
				 <a href="<?php echo "person_register_show.php".URL_REDIRECT_APPEND."&pid=$pid&from=$from"; ?>"><?php echo $LDShowPersonalData ?></a>
				  </nobr> </FONT></TD>
                </TR>
    							</TBODY>
		</TABLE>
		</TD></TR>
		</TBODY>
		</TABLE>
