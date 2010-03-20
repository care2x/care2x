<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/

$dept_logos_path='gui/img/logos_dept/'; # Define the path to the department logos

$lang_tables[]='departments.php';
$lang_tables[]='date_time.php';
$lang_tables[]='prompt.php';
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_department.php');
require_once($root_path.'include/care_api_classes/class_ward.php');
require_once($root_path.'include/care_api_classes/class_oproom.php');

require_once($root_path.'include/inc_date_format_functions.php');

$breakfile=$root_path.'modules/system_admin/edv-system-admi-welcome.php'.URL_APPEND	;

if(!isset($mode)) $mode='';
# Create department object
$dept_obj=& new Department;
# Create the OR object
$OR_obj= & new OPRoom;
# Create the ward object
$ward_obj=& new Ward;

//$db->debug=1;

# Validate 3 most important inputs
if(isset($mode)&&!empty($mode)&&$mode!='select'){
	# format date to standard
	$datebuffer=formatDate2STD($_POST['date_create'],$date_format);
	if(empty($_POST['room_nr'])||empty($datebuffer)||($mode=='update'&&empty($_POST['nr']))){
		$inputerror=TRUE; # Set error flag
		$error_msg=$LDInputError;
	}
	
}

if(!empty($mode)&&!$inputerror){
		
	# Compose the data for storing into history field
	$udata='name='.$_POST['info'].': bed='. $_POST['nr_of_beds'].': ward='.$_POST['ward_nr'].': dept='.$_POST['dept_nr'].': closed='.$_POST['is_temp_closed'];
	
	switch($mode)
	{	
		case 'create': 
		{
			if($OR_obj->ORNrExists($_POST['room_nr'])){
				$error_msg=$LDORNrExists;
				$inputerror=TRUE;
			}else{
					
				# Validate the date creation, if invalid, use today date
				if(empty($datebuffer)) $_POST['date_create']=date('Y-m-d');
					else $_POST['date_create']=$datebuffer;
				
				# Validate number of beds..if invalid use 1
				if(!$_POST['nr_of_beds']) $_POST['nr_of_beds']=1;
				
				$_POST['type_nr']=$OR_obj->ORTypeNr(); # 2 = operating room
				$_POST['history']="Create: ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']." ".$udata."\n";
				$_POST['create_id']=$_SESSION['sess_user_name'];
				//$_POST['modify_id']=$_SESSION['sess_user_name'];
				$_POST['create_time']=date('YmdHis');
				$_POST['modify_time']=date('YmdHis');
				
				$OR_obj->setDataArray($_POST);
				
				if($OR_obj->insertDataFromInternalArray()){
					
					# Get the last insert primary key as op room nr.
				
					$nr=$OR_obj->LastInsertPK('nr',$db->Insert_ID());
							
					header("location:or_info.php".URL_REDIRECT_APPEND."&edit=1&mode=newdata&nr=$nr");
					exit;
				}else{
					echo $OR_obj->getLastQuery."<br>$LDDbNoSave";
					$inputerror=TRUE;
				}
			}	
			break;
		}
		case 'update':
		{ 
			
			$_POST['history']=$OR_obj->ConcatHistory("Update: ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']." $udata\n");
			$_POST['modify_id']=$_SESSION['sess_user_name'];
			$_POST['modify_time']=date('YmdHis');
			
			$OR_obj->setDataArray($_POST);
			$OR_obj->where='nr='.$_POST['nr'];
			
			if($OR_obj->updateDataFromInternalArray($nr)){
				header("location:or_info.php".URL_REDIRECT_APPEND."&edit=1&mode=newdata&nr=".$_POST['nr']."&OR_nr=".$_POST['room_nr']);
				exit;
			}else{
				echo $OR_obj->getLastQuery."<br>$LDDbNoSave";
			}
			break;
		}
		case 'select':
		{
			# Get department´s information
			if(isset($nr)&&$nr){
				$OR_Info=$OR_obj->ORRecordInfo($nr);
			}elseif(isset($OR_nr)&&$OR_nr){
				$OR_Info=$OR_obj->ORInfo($OR_nr);
			}else{
				$mode='';
			}
				
			if(is_object($OR_Info)&&$mode!=''){
				$ORoom=$OR_Info->FetchRow();
				extract($ORoom);
			}
		}
	}// end of switch
}

# Load all active medical departments available
$deptarray=$dept_obj->getAllMedical('name_formal');

# Set ward items for loading
$witem='nr, ward_id, name';

# Load the active wards available
$wardsarray=$ward_obj->getAllWardsItemsArray($witem);

$newORnr=$OR_obj->NewORNr();

# Prepare title
$sTitle = "$LDOR :: ";
if($mode=='select') $sTitle = $sTitle.$LDUpdate;
	else $sTitle = $sTitle.$LDCreate;

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$sTitle);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('or_create.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$sTitle);

 # Collect javascript code
 ob_start();
?>

<script language="javascript">
<!-- 

function chkForm(d){
	
	av="<?php echo $OR_obj->CombinedORNrs(); ?>";
	mode="";
	if(d.room_nr.value==""){
		alert("<?php echo $LDPlsORNr ?>");
		d.room_nr.value="<?php echo $newORnr ?>";
		d.room_nr.focus();
		return false;
	}else if((av.indexOf(d.room_nr.value)!=-1)&& (mode=="<?php echo $mode ?>")){
		alert("<?php echo $LDORNrExists ?>");
		d.room_nr.focus();
		return false;
	}else if((d.date_create.value=="") && (mode=="<?php echo $mode ?>")){
		alert("<?php echo $LDPlsEnterDate ?>");
		d.date_create.focus();
		return false;
	}else{
		return true;
	}
}
function newORnr(){
	document.newstat.room_nr.value="<?php echo $newORnr ?>";
}
<?php require($root_path.'include/inc_checkdate_lang.php'); 

?>

// -->
</script>
<?php

//gjergji : new calendar
require_once ('../../js/jscalendar/calendar.php');
$calendar = new DHTML_Calendar('../../js/jscalendar/', $lang, 'calendar-system', true);
$calendar->load_files();
//end : gjergji

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

?>

<ul>
 
<FONT class="prompt"><p>
 <?php
 if(isset($inputerror)&&$inputerror){
 	echo "$error_msg<p>";
 }elseif(isset($save_ok)&&$save_ok){
 	 echo '<img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'>'.$LDDataSaved.'<p>';
}

echo $LDEnterInfo;
?>
</font>
<p> 
 
<?php echo $LDEnterAllFields ?>

<form action="or_new.php" method="post" name="newstat"  onSubmit="return chkForm(this)">

<table border=0>


  <tr>
    <td align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b>
	<?php echo $LDORNr ?></font>: 
	</td>
    <td bgColor="#f9f9f9">
	<?php
		if($mode=='select'||$mode=='update') { echo '<input type="hidden" name="room_nr"  value="'.$room_nr.'">'.$room_nr; } else {
	?>
	<input type="text" name="room_nr" size=4 maxlength=4 value=<?php echo  $newORnr; ?>> <a href="javascript:newORnr()"><img <?php echo createComIcon($root_path,'l_arrowgrnsm.gif','0') ?>> <?php echo $LDClkNextNr ?></a>
 
	<?php
	}
	?>
</td>
  </tr> 
  <tr>
    <td align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b><?php echo $LDOPTableNr ?></font>: </td>
    <td bgColor="#f9f9f9">
	<select name="nr_of_beds">
 	<option value="1">1</option>
 	<option value="2">2</option>
 	<option value="3">3</option>
 	<option value="4">4</option>
 	<option value="5">5</option>
 	<option value="6">6</option>
 	<option value="0">??</option>
 </select>
 
</td>
  </tr> 
  <tr>
    <td align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b><?php echo $LDDateCreation; ?>: </td>
    <td bgColor="#f9f9f9">
	<?php
		
		if($mode=='select'||$mode=='update'){
			echo '<input type="hidden" name="date_create" value="'.$date_create.'">';
			echo formatDate2Local($date_create,$date_format);
		}else{
		 	if(isset($inputerror) && $inputerror){
				//gjergji : new calendar
		 		echo $calendar->show_calendar($calendar,$date_format,'date_create',$date_create);	
		 		//end : gjergji
			}else{
				//gjergji : new calendar
				echo $calendar->show_calendar($calendar,$date_format,'date_create');	
				//end : gjergji
			}
		?>  </font>
	<?php
	}
	?>
</td>
  </tr> 
  <tr>
    <td align=right bgColor="#eeeeee"><?php echo $LDORName ?>: </td>
    <td bgColor="#f9f9f9"><input type="text" name="info" size=50 maxlength=60 value="<?php echo $info ?>"><br>
</td>
  </tr> 
<tr>
    <td align=right bgColor="#eeeeee"><?php echo $LDOwnerWard; ?>: </td>
    <td bgColor="#f9f9f9">
		<select name="ward_nr">
		<option value=""> </option>';
	<?php
		
		while(list($x,$v)=each($wardsarray)){
			echo '
				<option value="'.$v['nr'].'" ';
			if($v['nr']==$ward_nr) echo 'selected';
			if(defined('SHOW_COMBINE_WARDIDNAME')&&SHOW_COMBINE_WARDIDNAME){
				$buffer= '>['.$v['ward_id'].'] '.$v['name'];
			}else{
				if(defined('SHOW_FULL_WARDNAME')&&SHOW_FULL_WARDNAME) $buffer= ' >'.$v['name'];
					else $buffer= ' >'.$v['ward_id'];
			}
			echo $buffer.'</option>
			';
		}
	?>
        </select>
</td>
  </tr>

<tr>
    <td align=right bgColor="#eeeeee"><?php echo $LDOwnerDept; ?>: </td>
    <td bgColor="#f9f9f9"><select name="dept_nr">
	<option value=""> </option>';
	<?php
		while(list($x,$v)=each($deptarray)){
			echo '
				<option value="'.$v['nr'].'" ';
			if($v['nr']==$dept_nr) echo 'selected';
			echo ' >';
			if(isset($$v['LD_var'])&&$$v['LD_var']) echo $$v['LD_var'];
				else echo $v['name_formal'];
			echo '</option>';
		}
	?>
                     </select>
</td>
  </tr>

  
  <tr>
    <td align=right bgColor="#eeeeee"><?php echo $LDTempClosed ?>: </td>
    <td bgColor="#f9f9f9"><input type="radio" name="is_temp_closed" value="0" <?php if(!$is_temp_closed) echo 'checked'; ?>> <?php echo $LDNo ?> <input type="radio" name="is_temp_closed" value="1" <?php if($is_temp_closed) echo 'checked'; ?>> <?php echo $LDYes ?> 
</td>
  </tr> 
 
</table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<?php
 if($mode=='select') {
?>
<input type="hidden" name="mode" value="update">
<input type="hidden" name="nr" value="<?php echo $nr ?>">
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>>
<?php
}else{
?>
<input type="hidden" name="mode" value="create">
<input type="submit" value="<?php echo $LDCreate ?>">
<?php
}
?>
</form>
<p>

<a href="javascript:history.back()"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> border="0"></a>

</ul>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign page output to the mainframe template

$smarty->assign('sMainFrameBlockData',$sTemp);
 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
