						    <label>Month
						      <select name="month" size="1">
						        <option <?php if ($ARR_SELECT_MONTH[1]) echo "selected";?> value="1">Jan</option>
						        <option <?php if ($ARR_SELECT_MONTH[2]) echo "selected";?> value="2">Feb</option>
						        <option <?php if ($ARR_SELECT_MONTH[3]) echo "selected";?> value="3">Mar</option>
						        <option <?php if ($ARR_SELECT_MONTH[4]) echo "selected";?> value="4">Apr</option>
						        <option <?php if ($ARR_SELECT_MONTH[5]) echo "selected";?> value="5">May</option>
						        <option <?php if ($ARR_SELECT_MONTH[6]) echo "selected";?> value="6">Jun</option>
						        <option <?php if ($ARR_SELECT_MONTH[7]) echo "selected";?> value="7">Jul</option>
						        <option <?php if ($ARR_SELECT_MONTH[8]) echo "selected";?> value="8">Aug</option>
						        <option <?php if ($ARR_SELECT_MONTH[9]) echo "selected";?> value="9">Sep</option>
						        <option <?php if ($ARR_SELECT_MONTH[10]) echo "selected";?> value="10">Oct</option>
						        <option <?php if ($ARR_SELECT_MONTH[11]) echo "selected";?> value="11">Nov</option>
						        <option <?php if ($ARR_SELECT_MONTH[12]) echo "selected";?> value="12">Dec</option>
				                </select>
					        </label>
	                        <label>Year
	                        <select name="year">
							<option <?php if ($ARR_SELECT_YEAR[$curr_year]) echo "selected";?> value="<?php echo $ARR_YEAR[$curr_year];?>"> <?php echo $ARR_YEAR[$curr_year];?></option>
							<option <?php if ($ARR_SELECT_YEAR[$curr_year-1]) echo "selected";?> value="<?php echo $ARR_YEAR[$curr_year-1];?>"> <?php echo $ARR_YEAR[$curr_year-1];?></option>
							<option <?php if ($ARR_SELECT_YEAR[$curr_year-2]) echo "selected";?> value="<?php echo $ARR_YEAR[$curr_year-2];?>"> <?php echo $ARR_YEAR[$curr_year-2];?></option>
                            </select> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	                        </label>
							<label>
								<input type="submit" name="show" value="show">
							</label>
	                        	