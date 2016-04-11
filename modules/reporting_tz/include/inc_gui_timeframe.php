						    <label><?php echo $LDMonth; ?>
						      <select name="month" size="1">
						        <option <?php if ($ARR_SELECT_MONTH[1]) echo "selected";?> value="1"><?php echo $LDMonthShortName[1]; ?></option>
						        <option <?php if ($ARR_SELECT_MONTH[2]) echo "selected";?> value="2"><?php echo $LDMonthShortName[2]; ?></option>
						        <option <?php if ($ARR_SELECT_MONTH[3]) echo "selected";?> value="3"><?php echo $LDMonthShortName[3]; ?></option>
						        <option <?php if ($ARR_SELECT_MONTH[4]) echo "selected";?> value="4"><?php echo $LDMonthShortName[4]; ?></option>
						        <option <?php if ($ARR_SELECT_MONTH[5]) echo "selected";?> value="5"><?php echo $LDMonthShortName[5]; ?></option>
						        <option <?php if ($ARR_SELECT_MONTH[6]) echo "selected";?> value="6"><?php echo $LDMonthShortName[6]; ?></option>
						        <option <?php if ($ARR_SELECT_MONTH[7]) echo "selected";?> value="7"><?php echo $LDMonthShortName[7]; ?></option>
						        <option <?php if ($ARR_SELECT_MONTH[8]) echo "selected";?> value="8"><?php echo $LDMonthShortName[8]; ?></option>
						        <option <?php if ($ARR_SELECT_MONTH[9]) echo "selected";?> value="9"><?php echo $LDMonthShortName[9]; ?></option>
						        <option <?php if ($ARR_SELECT_MONTH[10]) echo "selected";?> value="10"><?php echo $LDMonthShortName[10]; ?></option>
						        <option <?php if ($ARR_SELECT_MONTH[11]) echo "selected";?> value="11"><?php echo $LDMonthShortName[11]; ?></option>
						        <option <?php if ($ARR_SELECT_MONTH[12]) echo "selected";?> value="12"><?php echo $LDMonthShortName[12]; ?></option>
				                </select>
					        </label>
	                        <label><?php echo $LDYear; ?>
	                        <select name="year">
							<option <?php if ($ARR_SELECT_YEAR[$curr_year]) echo "selected";?> value="<?php echo $ARR_YEAR[$curr_year];?>"> <?php echo $ARR_YEAR[$curr_year];?></option>
							<option <?php if ($ARR_SELECT_YEAR[$curr_year-1]) echo "selected";?> value="<?php echo $ARR_YEAR[$curr_year-1];?>"> <?php echo $ARR_YEAR[$curr_year-1];?></option>
							<option <?php if ($ARR_SELECT_YEAR[$curr_year-2]) echo "selected";?> value="<?php echo $ARR_YEAR[$curr_year-2];?>"> <?php echo $ARR_YEAR[$curr_year-2];?></option>
                            </select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	                        </label>
							<label>
								<input type="submit" name="show" value="<?php echo $LDShow; ?>">
							</label>
