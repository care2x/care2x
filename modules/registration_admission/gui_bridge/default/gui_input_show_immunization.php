<?php
include_once($root_path.'include/care_api_classes/class_immunization.php');
if(!isset($imm_obj)) $imm_obj=new Immunization;
$imm_types=$imm_obj->getAppTypes();
?>
<script language="JavaScript">
<!-- Script Begin
function chkform(d) {
	if(d.date.value==""){
		alert("<?php echo $LDPlsEnterDate; ?>");
		d.date.focus();
		return false;
	}else if(d.type.value==""){
		alert("<?php echo $LDPlsEnterMedType; ?>");
		d.type.focus();
		return false;
	}else if(d.medicine.value==""){
		alert("<?php echo $LDPlsEnterMedicine; ?>");
		d.medicine.focus();
		return false;
	}else if(d.dosage.value==""){
		alert("<?php echo $LDPlsEnterDosage; ?>");
		d.dosage.focus();
		return false;
	}else if(d.application_type_nr.value==""){
		alert("<?php echo $LDPlsSelectAppType; ?>");
		d.application_type_nr.focus();
		return false;
	}else if(d.application_by.value==""){
		alert("<?php echo $LDPlsEnterFullName; ?>");
		d.application_by.focus();
		return false;
	}else{
		return true;
	}
}

function popSearchWin(target,obj_val,obj_name){
	urlholder="./data_search.php<?php echo URL_REDIRECT_APPEND; ?>&target="+target+"&obj_val="+obj_val+"&obj_name="+obj_name;
	DSWIN<?php echo $sid ?>=window.open(urlholder,"wblabel<?php echo $sid ?>","menubar=no,width=400,height=550,resizable=yes,scrollbars=yes");
}

//  Script End -->
</script>

<form method="post" name="reportform" onSubmit="return chkform(this)">
 <table border=0 cellpadding=2 width=100%>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDate; ?></td>
     <td>
	 	 <?php
			//gjergji : new calendar
			require_once ('../../js/jscalendar/calendar.php');
			$calendar = new DHTML_Calendar('../../js/jscalendar/', $lang, 'calendar-system', true);
			$calendar->load_files();
			
			echo $calendar->show_calendar($calendar,$date_format,'date',$date);
		?> 	
	</td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDType; ?></td>
     <td><input type="text" name="type" size=40 maxlength=60 alue="<?php echo $type; ?>" >
	     	<a href="javascript:popSearchWin('immunization','reportform.nr','reportform.type')"><img <?php echo createComIcon($root_path,'b-write_addr.gif','0','',TRUE) ?>></a></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDMedicine; ?></td>
     <td><input type="text" name="medicine" size=50 maxlength=60></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDDosage; ?></td>
     <td><input type="text" name="dosage" size=50 maxlength=60></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDTiter; ?></td>
     <td><input type="text" name="titer" size=10 maxlength=10></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDRefreshDate; ?></td>
     <td>
	 	 <?php
			//gjergji : new calendar			
			echo $calendar->show_calendar($calendar,$date_format,'refresh_date');
			//gjergji : end
		?> 	 
	 </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDAppType; ?></td>
     <td><select name="application_type_nr">
         	<option value=""></option>
		<?php
			while(list($x,$v)=each($imm_types)){
				echo '<option value="'.$v['nr'].'">';
				if(isset($$v['LD_var'])&&!empty($$v['LD_var'])) echo $$v['LD_var'];
					else echo $v['name'];
				echo '</option>
				';
			}
		?>
         </select>
         </td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDAppBy; ?></td>
     <td><input type="text" name="application_by" size=50 maxlength=60 value="<?php echo $_SESSION['sess_user_name']; ?>" readonly></td>
   </tr>
   <tr bgcolor="#f6f6f6">
     <td><FONT SIZE=-1  FACE="Arial" color="#000066"><?php echo $LDNotes; ?></td>
     <td><textarea name="notes" cols=40 rows=3 wrap="physical"></textarea>
         </td>
   </tr>
 </table>
<input type="hidden" name="encounter_nr" value="<?php echo $_SESSION['sess_en']; ?>">
<input type="hidden" name="pid" value="<?php echo $_SESSION['sess_pid']; ?>">
<input type="hidden" name="modify_id" value="<?php echo $_SESSION['sess_user_name']; ?>">
<input type="hidden" name="create_id" value="<?php echo $_SESSION['sess_user_name']; ?>">
<input type="hidden" name="create_time" value="null">
<input type="hidden" name="mode" value="create">
<input type="hidden" name="target" value="<?php echo $target; ?>">
<input type="hidden" name="history" value="Created: <?php echo date('Y-m-d H:i:s'); ?> : <?php echo $_SESSION['sess_user_name']."\n"; ?>">
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>>

</form>
