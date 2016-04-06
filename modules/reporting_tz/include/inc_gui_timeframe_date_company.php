
							<label><?php echo $LDDateFrom; ?>

							</label>

						      <input name="date_from" type="text" size=10 maxlength=10 >
							  <a href="javascript:show_calendar('form1.date_from','<?php echo $date_format ?>')">
			<img <?php echo createComIcon($root_path,'show-calendar.gif','0','absmiddle'); ?>></a>
                          
                        <label><?php echo $LDDateTo; ?>

			</label>
                         <input name="date_to" type="text" size=10 maxlength=10 >
			 <a href="javascript:show_calendar('form1.date_to','<?php echo $date_format ?>')">
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
                                                        
                                                        <label><?php echo $LDBillType; ?>

                                                <?php echo '<SELECT name="bill_type">';

                                                //echo '<OPTION selected value="0" >All</OPTION>';
                                                echo '<OPTION value="1">Cash</OPTION>';
                                                echo '<OPTION value="2">Credit</OPTION>';

                                                echo '</SELECT>';
                                                ?>

                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        </label>

                                                <label>
                                            <?php
                                            echo 'DEPT:';
                                           echo '<SELECT name="stockloc">';
                                           $data=array();
                                           $sql_subtore="SELECT loccode, locationname FROM locations";
                                           $substore_result =$db->Execute($sql_subtore);
                                           while($r=$substore_result->FetchRow()){
                                           $data['subtore'][]=$r;
                                           }
                                            echo '<OPTION value="all">ALL</OPTION>';
                                             while(list($x,$v)=each($data['subtore'])){
                                             ?>                                                                                          
                                                    
                                             <option value="<?php echo $v['loccode'];?>"><?php echo $v['locationname'];?></option>
                                             <?php
                                              }
                                              echo '</select>'; 
                                               ?>
                                                
                                                </label>

                                                                                                        
                                                      
							<label>
								<input type="submit" name="show" value="<?php echo $LDShow; ?>">
							</label>
				



























