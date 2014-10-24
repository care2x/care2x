<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr($_SERVER['SCRIPT_NAME']'save_immunization.inc.php')) 
	die('<meta http-equiv="refresh" content="0; url=../">');

require_once($root_path.'include/care_api_classes/class_immunization.php');
if(!isset($imm_obj)) $imm_obj=new Immunization;

require_once($root_path.'include/core/inc_date_format_functions.php');
# Check date, default is today
if($_POST['date']) $_POST['date']=@formatDate2STD($_POST['date'],$date_format);
	else $_POST['date']=date('Y-m-d');
if($_POST['refresh_date']) $_POST['refresh_date']=@formatDate2STD($_POST['refresh_date'],$date_format);

$imm_obj->setDataArray($_POST);

if($type&&$medicine&&$dosage&&$application_type_nr&&$application_by){

	switch($mode){	
		case 'create': 
								//if($_POST['date') $_POST['date']=@formatDate2STD($_POST['date'],$date_format);
								//if($_POST['refresh_date') $_POST['date']=@formatDate2STD($_POST['refresh_date'],$date_format);
								
								if($imm_obj->insertDataFromInternalArray()) 
									{
										header("location:".$thisfile.URL_REDIRECT_APPEND."&mode=show&target=$target&pid=".$_SESSION['sess_pid']);
										exit;
									}
									else echo "<br>$LDDbNoSave";
								break;
		case 'update': 
								//$_POST['date']=@formatDate2STD($_POST['date'],$date_format);
								//$imm_obj->setDataArray($_POST);
								$imm_obj->setWhereCond("nr=$imm_nr");
								if($imm_obj->updateDataFromInternalArray($dept_nr)) 
									{
										header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&pid=".$_SESSION['sess_pid']);
										exit;
									}
									else echo "$sql<br>$LDDbNoUpdate";
								break;
					
	}// end of switch
} # end of if()

?>
