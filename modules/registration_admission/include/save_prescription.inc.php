<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr('save_prescription.inc.php',$_SERVER['SCRIPT_NAME'])) 
	die('<meta http-equiv="refresh" content="0; url=../">');	

global $db;

switch($mode){	
		case 'create':
			//prescription 
			$prescription = array(
				'encounter_nr' => $_POST['encounter_nr'],
				'prescribe_date'=> $_POST['prescribe_date'],
				'status' => $_POST['status'],
				'prescriber' => $_POST['prescriber'],
				'history' => $_POST['history'],
				'modify_id' => $_POST['modify_id'],
				'modify_time' => $_POST['modify_time'],
				'create_id' => $_POST['create_id'],
				'create_time' => $_POST['create_time']
			);
			$obj->insertDataFromArray($prescription);
			
			//prescriptio sub
			$obj->usePrescription('prescription_sub');
			$pk =  $db->Insert_ID();
			$prescription_sub = array(
				'prescription_nr' => $obj->LastInsertPK('nr',$pk),
				'prescription_type_nr' => $_POST['prescription_type_nr'],
				'article' => $_POST['article'],
				'drug_class' => $_POST['drug_class'],
				'dosage' => $_POST['dosage'],
				'application_type_nr' => $_POST['application_type_nr'],
				'notes' => $_POST['notes'],
				'color_marker' => $_POST['color_marker'],
				'is_stopped' => $_POST['is_stopped'],
				'stop_date' => $_POST['stop_date'],
				'status' => $_POST['status']
			);
			$obj->insertDataFromArray($prescription_sub);					
			if(!$no_redirect){
				header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&pid=".$_SESSION['sess_pid']);
				//echo "$obj->getLastQuery<br>$LDDbNoSave";
				exit;
			}
			/*	do i really need it ? booh 
				gjergji
				} else{
		           echo "$obj->getLastQuery<br>$LDDbNoSave";
		           $error=TRUE;
		        }*/
			break;
		case 'update': 
						$obj->where=' nr='.$nr;
						if($obj->updateDataFromInternalArray($nr)) {
							if(!$no_redirect){
								header("location:".$thisfile.URL_REDIRECT_APPEND."&target=$target&type_nr=$type_nr&allow_update=1&pid=".$_SESSION['sess_pid']);
								//echo "$obj->sql<br>$LDDbNoUpdate";
								exit;
							}
						} else{
                          echo "$obj->getLastQuery<br>$LDDbNoUpdate";
                          $error=TRUE;
                        }
						break;
}// end of switch

?>