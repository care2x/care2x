<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/

$dept_logos_path='uploads/logos_dept/'; # Define the path to the department logos

$lang_tables[]='departments.php';
$lang_tables[]='phone.php';
$lang_tables[]='doctors.php';
define('LANG_FILE','edp.php');
$local_user='ck_edv_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'include/care_api_classes/class_department.php');
require_once($root_path.'include/care_api_classes/class_comm.php');

$breakfile='dept_list.php'.URL_APPEND;

if(!isset($mode)) $mode='';
# Create department object
$dept_obj=new Department;
#create com object
$comm=new Comm;

//$db->debug=1;

# Validate 3 most important inputs
if(isset($mode)&&!empty($mode)&&$mode!='select'){
	if(empty($_POST['name_formal'])||empty($_POST['id'])||empty($_POST['type'])){
		$inputerror=TRUE; # Set error flag
	}
	//if($mode=='update'&&empty($_POST['id'])) $inputerror=TRUE;
}

if(!empty($mode)&&!$inputerror){

	$is_img=false;
	# If a pic file is uploaded move it to the right dir
	if(is_uploaded_file($_FILES['img']['tmp_name']) && $_FILES['img']['size']){
		$picext=substr($_FILES['img']['name'],strrpos($_FILES['img']['name'],'.')+1);
		if(stristr('jpg,gif,png',$picext)){
			$is_img=true;	
			# Forcibly convert file extension to lower case.
			$_POST['logo_mime_type']=strtolower($picext);
		}
	}
	
	switch($mode)
	{	
		case 'create': 
		{
			$_POST['history']='Create: '.date('Y-m-d H:i:s').' '.$_SESSION['sess_user_name'];
			$_POST['create_id']=$_SESSION['sess_user_name'];
			$_POST['modify_id']=$_SESSION['sess_user_name'];
			$_POST['create_time']=date('YmdHis');
			$_POST['modify_time']=date('YmdHis');
			$dept_obj->setDataArray($_POST);
			if($dept_obj->insertDataFromInternalArray()){
				
				# Get the inserted primary key as department nr.
				$oid=$db->Insert_ID();
				$dept_nr=$dept_obj->LastInsertPK('nr',$oid);

				# If telephone/beeper info available, save into the phone table
				if($_POST['inphone1']
					||$_POST['inphone2']
					||$_POST['inphone3']
					||$_POST['funk1']
					||$_POST['funk2']){
						$_POST['dept_nr']=$dept_nr;
						$_POST['name']=$_POST['name_formal'];
						$_POST['vorname']=$_POST['id'];
						$_POST['is_pharmacy']=$is_pharmacy;
						$comm->setDataArray($_POST);
						if(!@$comm->insertDataFromInternalArray()) echo $comm->getLastQuery()."<br>$LDDbNosave";
				}
							
				# Save the uploaded image
				if($is_img){
				    $picfilename='dept_'.$dept_nr.'.'.$picext;
			       copy($_FILES['img']['tmp_name'],$root_path.$dept_logos_path.$picfilename);
				}
				header("location:dept_info.php".URL_REDIRECT_APPEND."&edit=1&mode=newdata&dept_nr=$dept_nr");
				exit;
			}else{
				echo $dept_obj->getLastQuery."<br>$LDDbNoSave";
			}
			break;
		}	
		case 'update':
		{ 
			$_POST['history']=$dept_obj->ConcatHistory("Update: ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n");
			$_POST['modify_id']=$_SESSION['sess_user_name'];
			$_POST['modify_time']=date('YmdHis');
			$dept_obj->setTable('care_department');
			$dept_obj->setDataArray($_POST);
			$dept_obj->where=' nr='.$dept_nr;
			if($dept_obj->updateDataFromInternalArray($dept_nr)){

				# Update phone data
				if($comm->DeptInfoExists($dept_nr)){
					$_POST['name']=$_POST['name_formal'];
					$_POST['vorname']=$_POST['id'];
					$comm->setDataArray($_POST);
					$comm->setWhereCondition("dept_nr=$dept_nr");
					@$comm->updateDataFromInternalArray($dept_nr);
				}else{
					if($_POST['inphone1']
						||$_POST['inphone2']
						||$_POST['inphone3']
						||$_POST['funk1']
						||$_POST['funk2']){
							$_POST['dept_nr']=$dept_nr;
							$_POST['name']=$_POST['name_formal'];
							$_POST['vorname']=$_POST['id'];
							$_POST['history']="Create: ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n";
							$_POST['create_id']=$_SESSION['sess_user_name'];
							$_POST['create_time']=date('YmdHis');
							$_POST['is_pharmacy']=$is_pharmacy;
							$comm->setDataArray($_POST);
						if(!@$comm->insertDataFromInternalArray()) echo $comm->getLastQuery()."<br>$LDDbNoSave";
					}
				}
				# Save uploaded image
				if($is_img){
				    $picfilename='dept_'.$dept_nr.'.'.$picext;
			        copy($_FILES['img']['tmp_name'],$root_path.$dept_logos_path.$picfilename);
				}
				header("location:dept_info.php".URL_REDIRECT_APPEND."&edit=1&mode=newdata&dept_nr=$dept_nr");
				exit;
			}else{
				echo $dept_obj->getLastQuery."<br>$LDDbNoSave";
			}
			break;
		}
		case 'select':
		{
			# Get department´s information
			$dept=$dept_obj->getDeptAllInfo($dept_nr);
			//while(list($x,$v)=each($dept)) $$x=$v;
			extract($dept);
			
			# Get departments phone info
			if($dept_phone=$comm->DeptInfo($dept_nr)){
				extract($dept_phone);
			}
		}	
	}// end of switch
}

$deptarray=$dept_obj->getAllActiveSort('name_formal');
$depttypes=$dept_obj->getTypes();
$pharmaarray=$dept_obj->getAllPharmacy();

# Prepare title
$sTitle = "$LDDepartment :: ";
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
 $smarty->assign('pbHelp',"javascript:gethelp('dept_create.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$sTitle);

# Buffer page output

ob_start();
?>

<style type="text/css" name="formstyle">

td.pblock{ font-family: verdana,arial; font-size: 12}
div.box { border: solid; border-width: thin; width: 100% }
div.pcont{ margin-left: 3; }

</style>

<script language="javascript">
<!-- 

function chkForm(d){

	if(d.name_formal.value==""){
		alert("<?php echo $LDPlsNameFormal ?>");
		d.name_formal.focus();
		return false;
	}else if(d.id.value==""){
		alert("<?php echo $LDPlsDeptID ?>");
		d.id.focus();
		return false;
	}else if(d.type.value==""){
		alert("<?php echo $LDPlsSelectType ?>");
		d.type.focus();
		return false;
	}else{
		return true;
	}
}

// -->
</script>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

?>

 <ul>

 <?php
 if(isset($inputerror)&&$inputerror){
 	echo "<font color=#ff0000 face='verdana,arial' size=2>$LDInputError</font>";
 }
 ?>
 
<font face="Verdana, Arial" size=-1><?php echo $LDEnterAllFields ?>
<form action="dept_new.php" method="post" name="newstat" ENCTYPE="multipart/form-data" onSubmit="return chkForm(this)">
<table border=0>
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b><?php echo $LDFormalName ?></font>: </td>
    <td class=pblock><input type="text" name="name_formal" size=40 maxlength=40 value="<?php echo $name_formal ?>"><br>
</td>
  </tr> 
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b>
	<?php echo $LDInternalID ?></font>: 
	</td>
    <td class=pblock>
	<?php
		if($mode=='select') { echo '<input type="hidden" name="id"  value="'.$id.'">'.$id; } else {
	?>
	<input type="text" name="id" size=40 maxlength=40 value="<?php echo $id; ?>">
	<?php
	}
	?>
</td>
  </tr> 

<tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b><?php echo $LDTypeDept ?></font>: </td>
    <td class=pblock><select name="type">
	<?php
		
		while(list($x,$v)=each($depttypes)){
			echo '
				<option value="'.$v['nr'].'" ';
			if($v['nr']==$type) echo 'selected';
			echo ' >';
			if(isset($$v['LD_var'])&&$$v['LD_var']) echo $$v['LD_var'];
				else echo $v['name'];
			echo '</option>';
		}
	?>
                     </select>
		<img <?php echo createComIcon($root_path,'l_arrowgrnsm.gif','0') ?>> <?php echo $LDPlsSelect ?>
</td>
  </tr>
  
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDDescription ?>: </td>
    <td class=pblock><textarea name="description" cols=40 rows=4 wrap="physical"><?php echo $description ?></textarea>
</td>
  </tr>
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font><?php echo $LDIsSubDept ?>: </td>
    <td class=pblock>	<input type="radio" name="is_sub_dept" value="1" <?php if($is_sub_dept) echo 'checked'; ?>> <?php echo $LDYes ?> <input type="radio" name="is_sub_dept" value="0" <?php if(!$is_sub_dept) echo 'checked'; ?>> <?php echo $LDNo ?>
</td>
  </tr> 
<tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font><?php echo $LDParentDept; ?>: </td>
    <td class=pblock><select name="parent_dept_nr">
	<option value=""> </option>';
	<?php
		
		while(list($x,$v)=each($deptarray)){
			echo '
				<option value="'.$v['nr'].'" ';
			if($v['nr']==$parent_dept_nr) echo 'selected';
			echo ' >';
			if(isset($$v['LD_var'])&&$$v['LD_var']) echo $$v['LD_var'];
				else echo $v['name_formal'];
			echo '</option>';
		}
	?>
                     </select>
		<img <?php echo createComIcon($root_path,'l_arrowgrnsm.gif','0') ?>> <?php echo $LDPlsSelect ?>
</td>
  </tr>
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee">
	<?php if($mode!='select') echo '<font color=#ff0000><b>*</b></font>'; ?>
	<?php echo $LDLangVariable ?>: 
	</td>
    <td class=pblock>
	<?php
		if($mode=='select'){
			echo $LD_var;
		}else{
	?>
	<input type="text" name="LD_var" size=40 maxlength=40 value="<?php echo $LD_var ?>"><br>
	<?php
		}
	?>
</td>
  </tr> 
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDShortName ?>: </td>
    <td class=pblock><input type="text" name="name_short" size=40 maxlength=40 value="<?php echo $name_short ?>"><br>
</td>
  </tr> 
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDAlternateName ?>: </td>
    <td class=pblock><input type="text" name="name_alternate" size=40 maxlength=40 value="<?php echo $name_alternate ?>"><br>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font><?php echo $LDDoesSurgeryOp ?>: </td>
    <td class=pblock>	<input type="radio" name="does_surgery" value="1" <?php if($does_surgery) echo 'checked'; ?>> <?php echo $LDYes ?> <input type="radio" name="does_surgery" value="0" <?php if(!$does_surgery) echo 'checked'; ?>> <?php echo $LDNo ?>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font><?php echo $LDAdmitsInpatients ?>: </td>
    <td class=pblock>	<input type="radio" name="admit_inpatient" value="1" <?php if($admit_inpatient) echo 'checked'; ?>> <?php echo $LDYes ?> <input type="radio" name="admit_inpatient" value="0" <?php if(!$admit_inpatient) echo 'checked'; ?>> <?php echo $LDNo ?>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font><?php echo $LDAdmitsOutpatients ?>: </td>
    <td class=pblock>	<input type="radio" name="admit_outpatient" value="1" <?php if($admit_outpatient) echo 'checked'; ?>> <?php echo $LDYes ?> <input type="radio" name="admit_outpatient" value="0" <?php if(!$admit_outpatient) echo 'checked'; ?>> <?php echo $LDNo ?>
</td>
  </tr> 

    <tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font><?php echo $LDBelongsToInst ?>: </td>
    <td class=pblock>	<input type="radio" name="this_institution" value="1" <?php if($this_institution) echo 'checked'; ?>> <?php echo $LDYes ?> <input type="radio" name="this_institution" value="0" <?php if(!$this_institution) echo 'checked'; ?>> <?php echo $LDNo ?>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDWorkHrs ?>: </td>
    <td class=pblock><input type="text" name="work_hours" size=40 maxlength=40 value="<?php echo $work_hours ?>"><br>
</td>
  </tr> 

  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDConsultationHrs ?>: </td>
    <td class=pblock><input type="text" name="consult_hours" size=40 maxlength=40 value="<?php echo $consult_hours ?>"><br>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDTelephone ?> 1: </td>
    <td class=pblock><input type="text" name="inphone1" size=40 maxlength=15 value="<?php echo $inphone1 ?>"><br>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDTelephone ?> 2: </td>
    <td class=pblock><input type="text" name="inphone2" size=40 maxlength=15 value="<?php echo $inphone2 ?>"><br>
</td>
  </tr> 
  
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDTelephone ?> 3: </td>
    <td class=pblock><input type="text" name="inphone3" size=40 maxlength=15 value="<?php echo $inphone3 ?>"><br>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo "$LDBeeper ($LDOnCall)" ?> 1: </td>
    <td class=pblock><input type="text" name="funk1" size=40 maxlength=15 value="<?php echo $funk1 ?>"><br>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo "$LDBeeper ($LDOnCall)" ?> 2: </td>
    <td class=pblock><input type="text" name="funk2" size=40 maxlength=15 value="<?php echo $funk2 ?>"><br>
</td>
  </tr> 
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDSigLine ?>: </td>
    <td class=pblock><input type="text" name="sig_line" size=40 maxlength=40 value="<?php echo $sig_line ?>"><br>
</td>
  </tr> 
 
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDSigStampTxt ?>: </td>
    <td class=pblock><textarea name="sig_stamp" cols=40 rows=4 wrap="physical"><?php echo $sig_stamp ?></textarea>
</td>
  </tr>
  
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><?php echo $LDDeptLogo ?>: </td>
    <td class=pblock><input type="file" name="img" ><br>
</td>
  </tr> 
  <tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font><?php echo $LDIsPharmacy ?>: </td>
    <td class=pblock>	<input type="radio" name="is_pharmacy" value="1" <?php if($is_pharmacy) echo 'checked'; ?>> <?php echo $LDYes ?> <input type="radio" name="is_pharmacy" value="0" <?php if(!$is_pharmacy) echo 'checked'; ?>> <?php echo $LDNo ?>
</td>
  </tr>  

<!-- select the pharmacy this department will use -->  
<tr>
    <td class=pblock align=right bgColor="#eeeeee"><font color=#ff0000><b>*</b></font><?php echo $LDPharmacy; ?>: </td>
    <td class=pblock><select name="pharma_dept_nr">
	<option value=""> </option>';
	<?php
		
		while(list($x,$v)=each($pharmaarray)){
			echo '
				<option value="'.$v['nr'].'" ';
			if($v['nr']==$pharma_dept_nr) echo 'selected';
			echo ' >';
			if(isset($$v['LD_var'])&&$$v['LD_var']) echo $$v['LD_var'];
				else echo $v['name_formal'];
			echo '</option>';
		}
	?>
                     </select>
		<img <?php echo createComIcon($root_path,'l_arrowgrnsm.gif','0') ?>> <?php echo $LDPlsSelect ?>
</td>
  </tr>
 
</table>
<INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="1000000">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="edit" value="<?php echo $edit ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<?php
 if($mode=='select') {
?>
<input type="hidden" name="mode" value="update">
<input type="hidden" name="dept_nr" value="<?php echo $nr ?>">
<input type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0'); ?>>
<?php
}
else
{
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
