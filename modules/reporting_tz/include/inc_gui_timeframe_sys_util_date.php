
							<label><?php echo $LDDate; ?>

							</label>

						      <input name="tarehe" type="text" size=10 maxlength=10 >
							  <a href="javascript:show_calendar('form1.tarehe','<?php echo $date_format ?>')">
			<img <?php echo createComIcon($root_path,'show-calendar.gif','0','absmiddle'); ?>></a>
                         
                                              
			 
			
 

                               <font size=1>[<?php
			$dfbuffer="LD_".strtr($date_format,".-/","phs");
			echo $$dfbuffer;
			?>]			 
                                                       
							<label><?php // echo $LDAdmitType; ?>

                                                <?php //echo '<SELECT name="admission_id">';

                                               // echo '<OPTION selected value="0" >All</OPTION>';
                                                //echo '<OPTION value="2">Outpatient</OPTION>';
                                                //echo '<OPTION value="1">Inpatient</OPTION>';

                                                //echo '</SELECT>';
                                                ?>

                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        </label>
                                                        
                                                        <label>
<label><?php echo 'Dept';
?>
<select name="dept" size="1">
<option value="all">all</option>
<?php
while(list($x,$v)=each($medical_depts)){

?>
<option value="<?php echo $v['nr'];?>"><?php echo $v['name_formal'];?></option>
<?php
}
?>

</select>
</label>

                                               

                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        </label>

                                            
                                                                                                        
                                                      
							<label>
								<input type="submit" name="show" value="<?php echo $LDShow; ?>">
							</label>
				
