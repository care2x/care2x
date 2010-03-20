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
define('LANG_FILE','nursing.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');
///$db->debug = true;
$thisfile=basename(__FILE__);
/* Load the ward object */
require_once($root_path.'include/care_api_classes/class_ward.php');
$ward_obj=new Ward($ward_nr);

$rows=0;

//$db->debug=1;

    /* Load the date formatter */
    include_once($root_path.'include/inc_date_format_functions.php');

	switch($mode){	
		
		case 'show': 
		{
			if($ward=&$ward_obj->getWardInfo($ward_nr)){
				$rooms=&$ward_obj->getAllActiveRoomsInfo();
				$rows=true;
				extract($ward);
				// Get all medical departments
				/* Load the dept object */
/*				if($edit){
					include_once($root_path.'include/care_api_classes/class_department.php');
					$dept=new Department;							
					$depts=&$dept->getAllMedical();
				}
*/							
			}else{
				header('location:nursing-station-info.php'.URL_REDIRECT_APPEND);
				exit;
			}
			$breakfile='nursing-station-info.php'.URL_APPEND;
			break;
		}
		
		case 'update':
		{
			$_POST['nr']=$_POST['ward_nr'];
			if($ward_obj->updateWard($ward_nr,$_POST)){
				header("location:nursing-station-info.php".URL_REDIRECT_APPEND."&edit=0&mode=show&ward_id=$station&ward_nr=$ward_nr");
				exit;
			}else{
				echo $ward_obj->getLastQuery()."<br>$LDDbNoSave";
			}
							
			break;
		}
		
		case 'close_ward':
		{
			if($ward_obj->hasPatient($ward_nr)){
				header("location:nursing-station-noclose.php".URL_REDIRECT_APPEND."&ward_id=$ward_id&ward_nr=$ward_nr");
				exit;
			}else{
				switch($close_type)
				{
					case 'temporary':		
					{
						$ward_obj->closeWardTemporary($ward_nr);
						break;
					}
					
					case 'nonreversible':	
					{
						$ward_obj->closeWardNonReversible($ward_nr);
						break;
					}
					
					case 're_open':	
					{	
						$ward_obj->reOpenWard($ward_nr);
					}
				}
				
				header("location:nursing-station-info.php".URL_REDIRECT_APPEND);
				exit;
			}
		}
							
		default:					
		{
			if($wards=&$ward_obj->getAllActiveWards()){
				# Count wards
				$rows=$wards->RecordCount();

				if($rows==1){
					# If only one ward, fetch the ward
					$ward=$wards->FetchRow();
					# globalize ward values
					extract($ward);
					# Get ward´s active rooms info
					$rooms=&$ward_obj->getAllActiveRoomsInfo($ward['nr']);
				}else{
					$rooms=$ward_obj->countCreatedRooms();
				}
			}else{
			 	//echo $ward_obj->getLastQuery()."<br>$LDDbNoRead";
			}
							
			$breakfile='nursing-station-manage.php?sid='.$sid.'&lang='.$lang;
		}
	} # End of switch($mode)

# Start the smarty templating
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

# Added for the common header top block

 $smarty->assign('sToolbarTitle',"$LDNursing $LDStation - $LDProfile");

 $smarty->assign('pbHelp',"javascript:gethelp('nursing_ward_mng.php','$mode','$edit')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDNursing $LDStation - $LDProfile");

# Buffer page output

ob_start();

?>

<style type="text/css" name="formstyle">

td.pblock{ font-family: verdana,arial; font-size: 12; background-color: #ffffff}
td.pv{ font-family: verdana,arial; font-size: 12; color: #0000cc; background-color: #eeeeee}
div.box { border: solid; border-width: thin; width: 100% }
div.pcont{ margin-left: 3; }

</style>

<script language="javascript">
<!-- 
function check(d){
	if((d.description.value=="")||(d.roomprefix.value=="")){
		alert("<?php echo $LDAlertIncomplete ?>");
		return false;
	}
	if(d.room_nr_start.value>=d.room_nr_end.value){
		alert("<?php echo $LDAlertRoomNr ?>");
		return false;
	}
}
function checkTempClose(){
	if(confirm("<?php echo $LDSureTemporaryClose ?>")) return true;
		else return false;
}
function checkReopen(){
	if(confirm("<?php echo $LDSureReopenWard ?>")) return true;
		else return false;
}
function checkClose(f){
	if(confirm("<?php echo $LDSureIrreversibleClose ?>")){
		f.close_type.value="nonreversible";
		f.submit();
		return true;
	}else{
		return false;
	}
}
// -->
</script>

<?php

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# If one station is available, show its profile

if($rows==1) {

	# Assign table items
	$smarty->assign('LDStation',$LDStation);
	$smarty->assign('LDWard_ID',$LDWard_ID);
	$smarty->assign('LDDept',$LDDept);
	$smarty->assign('LDDescription',$LDDescription);
	$smarty->assign('LDRoom1Nr',$LDRoom1Nr);
	$smarty->assign('LDRoom2Nr',$LDRoom2Nr);
	$smarty->assign('LDRoomPrefix',$LDRoomPrefix);
	$smarty->assign('LDCreatedOn',$LDCreatedOn);
	$smarty->assign('LDCreatedBy',$LDCreatedBy);

	# Assign input values
	$smarty->assign('name',$name);
	$smarty->assign('ward_id',$ward_id);
	$smarty->assign('dept_name',$dept_name);
	$smarty->assign('description',$description);
	$smarty->assign('room_nr_start',$room_nr_start);
	$smarty->assign('room_nr_end',$room_nr_end);
	$smarty->assign('roomprefix',$roomprefix);
	$smarty->assign('date_create',formatDate2Local($date_create,$date_format));
	$smarty->assign('create_id',$create_id);
	
	# If rooms available, create list and show them

	if(is_object($rooms)){

		$smarty->assign('bShowRooms',TRUE);
		$smarty->assign('LDRoom',$LDRoom);
		$smarty->assign('LDBedNr',$LDBedNr);
		$smarty->assign('LDRoomShortDescription',$LDRoomShortDescription);

		$toggle=0;
		$sTemp='';
		while($room=$rooms->FetchRow()){
			if($toggle)	$trc='#dedede';
				else $trc='#efefef';
			$toggle=!$toggle;
			$sTemp=$sTemp.'
				<tr bgcolor="'.$trc.'">
				<td>&nbsp;'.strtoupper($ward['roomprefix']).' '.$room['room_nr'].'&nbsp;
				</td>
				<td class=pv >&nbsp;<font color="#ff0000">&nbsp;'.$room['nr_of_beds'].'</td>
				<td class=pv >&nbsp;'.$room['info'].'</td>
				</tr>';
		}

		$smarty->assign('sRoomRows',$sTemp);
	}

	$smarty->assign('sClose','<a href="'.$breakfile.'"><img '.createLDImgSrc($root_path,'close2.gif','0','absmiddle').' border="0"></a>');

	if($ward['is_temp_closed']){

		ob_start();
?>
		<form name="closer" method="post" action="<?php echo $thisfile ?>" onSubmit="return checkReopen()" onReset="return checkClose(this)">
			<input type="hidden" name="ward_nr" value="<?php echo $ward['nr'] ?>">
			<input type="hidden" name="mode" value="close_ward">
			<input type="hidden" name="close_type" value="re_open">
			<input type="hidden" name="sid" value="<?php echo $sid ?>">
			<input type="hidden" name="lang" value="<?php echo $lang ?>">
			<input type="hidden" name="ward_id" value="<?php echo $ward['ward_id'] ?>">
			<input type="submit" value="<?php echo $LDReopenWard ?>">
			<input type="reset" value="<?php echo $LDIrreversiblyCloseWard ?>">
		</form>
<?php

		$sTemp=ob_get_contents();
		ob_end_clean();

		$smarty->assign('sWardClosure',$sTemp);

	}else{
		ob_start();
?>
			<form name="closer" method="post" action="<?php echo $thisfile ?>" onSubmit="return checkTempClose()" onReset="return checkClose(this)">
				<input type="hidden" name="ward_nr" value="<?php echo $ward['nr'] ?>">
				<input type="hidden" name="mode" value="close_ward">
				<input type="hidden" name="close_type" value="temporary">
				<input type="hidden" name="sid" value="<?php echo $sid ?>">
				<input type="hidden" name="lang" value="<?php echo $lang ?>">
				<input type="hidden" name="ward_id" value="<?php echo $ward['ward_id'] ?>">
				<input type="submit" value="<?php echo $LDTemporaryCloseWard ?>">
				<input type="reset" value="<?php echo $LDIrreversiblyCloseWard ?>">
			</form>
<?php

		$sTemp=ob_get_contents();
		ob_end_clean();

		$smarty->assign('sWardClosure',$sTemp);
	
	}

}elseif($rows){
	
	# If more than one station available, create list and show

	ob_start();

?>
	<ul>
	<font class="prompt"><?php echo $LDExistStations ?></font><p>
	<table border=0 cellpadding=4 cellspacing=1>

<?php 
	echo '<tr class="wardlisttitlerow">
			<td></td>
			<td><font face="verdana,arial" size="2" ><b>&nbsp;'.$LDStation.'</b></td>
			<td><font face="verdana,arial" size="2" ><nobr><b>&nbsp;'.$LDWard_ID.'</b></nobr></td>
			<td><font face="verdana,arial" size="2" ><b>&nbsp;'.$LDDescription.'&nbsp;</b></td>
			<td><font face="verdana,arial" size="2" ><b>&nbsp;'.$LDStatus.'&nbsp;</b></td>
			</tr>';

	$toggle=0;
	$room=array();
	# Align the nr of rooms to their respective ward numbers
	if(is_object($rooms)){
		while($room=$rooms->FetchRow()){
			$wbuf[$room['nr']]=$room['nr_rooms'];
		}
	}
	while($result=$wards->FetchRow()){
		if($toggle)	$trc='wardlistrow2';
			else $trc='wardlistrow1';
		$toggle=!$toggle;
		$buf='nursing-station-info.php'.URL_APPEND.'&mode=show&station='.$result['name'].'&ward_nr='.$result['nr'];
		echo '
	<tr class="'.$trc.'">
    <td>&nbsp;<a href="'.$buf.'"><img '.createComIcon($root_path,'bul_arrowgrnsm.gif','0','absmiddle').'>&nbsp;&nbsp;<font face="Verdana, Arial" size=2>'.strtoupper($result[station]).'</a></td> 
	<td><a href="'.$buf.'">'.ucfirst($result['name']).'</a> &nbsp;</td>
	<td>&nbsp;<a href="'.$buf.'">'.ucfirst($result['ward_id']).'</a> &nbsp;</td>
	<td>'.ucfirst($result['description']).'&nbsp;</td>
	<td>';
	if($result['is_temp_closed']){
		echo '<font  color="red">'.$LDTemporaryClosed.'</font>';
	}elseif(empty($wbuf[$result['nr']])){
		echo $LDRoomNotCreated.'<a href="nursing-station-new-createbeds.php'.URL_APPEND.'&ward_nr='.$result['nr'].'"> '.$LDCreate.'>></a>';
	}else{
		echo $wbuf[$result['nr']].' '.$LDRoom;
	}
	echo '&nbsp;</td>  
	</tr>';
	}
?>
	</table>
	<p>
	<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0','absmiddle') ?> border="0"></a>
	</ul>
<?php

	$sTemp = ob_get_contents();
	ob_end_clean();

}else{

	# If no wards available, prompt no ward
	
	$sTemp = '<p><font size=2 face="verdana,arial,helvetica">'.$LDNoWardsYet.'<br><img '.createComIcon($root_path,'redpfeil.gif','0','absmiddle').'> <a href="nursing-station-new.php'.URL_APPEND.'">'.$LDClk2CreateWard.'</a></font>';

}

if($rows==1){
	$smarty->assign('sMainBlockIncludeFile','nursing/ward_profile.tpl');
}else{
	# Assign the page output to main frame template
	$smarty->assign('sMainFrameBlockData',$sTemp);
}

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
