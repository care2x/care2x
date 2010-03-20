<?php

$LDDiagnosticTest='Richiesta di test diagnostico';
$LDHospitalName='Hospedale';
$LDCentralLab='Laboratorio';
$LDLabel='Etichetta';
$LDRoomNr='Stanza.';
$LDSamplingTime='Ora campione';
$LDDay='Giorno';
$LDMinutes='Minuti';
$LDHours='Ore';
$LDBatchNr='Progressivo';
$LDCaseNr='N. caso';
$LDHouse='Casa';
$LDHematology='Ematologia';
$LDCoagualtion='Coagulazione';
$LDUrine='Urine';
$LDSerum='Siero';
$LDGlucose='Glucosio';
$LD9Hour='9.00';
$LD15Hour='15.00';
$LDSober='Sobrio';
$LDBloodSugar='BLS'; /* BLS = Blood sugar */
$LDBLoodSugar1='BLS1';
$LDBloodPlasma='BLP';
$LDDoctorSignature='Firma del medico';
$LDLifeRisk='Rischio di vita';
$LDRarity='Raro';
$LDSpecTest='Test speciali';
$LDClinicalInfo='Informazioni cliniche';
$LDShortMonth=array('',
                	'Gen',
                	'Feb',
                    'Mar',
                    'Apr',
                    'Mag',
                    'Giu',
                    'Lug',
                    'Ago',
                    'Set',
                    'Ott',
                    'Nov',
                    'Dic');

$LDShortDay=array('Do','Lu','Ma','Me','Gi','Ve','Sa','Do');

$LDBatchNumber='N. batch';
$LDMaterial='Material:';
$LDEmergencyProgram='Il campo in viola appartiene alla routine urgente';
$LDPhoneOrder=' = solo dopo conferma telefonica';
/* 2002-09-03 EL */
$LDSearchPatient='Ricerca paziente';
$LDPlsSelectPatientFirst='Prima cercare un paziente.';
/* 2002-09-11 EL */
$LDPendingTestRequest='Richiesta test accodata';
/* 2002-10-14 EL */
$LDDone='Archivia il modulo';


//gjergji
//used to calculate the max_rows per column
$SQLStatementNum = "SELECT id,name,status FROM care_test_param WHERE status NOT IN ('deleted','hidden') ORDER BY name"; 
$rowNum = $db->Execute($SQLStatementNum);
$numRows = $rowNum->numRows();
$max_row = round($numRows / 7);


//gjergji : thanx to Robert Mengle for the idea...a for the code also :)
$SQLStatement = "SELECT id , name FROM care_test_param WHERE group_id = -1 AND status NOT IN ('deleted','hidden') ORDER BY sort_nr";
$top_rs = $db->Execute($SQLStatement);

if(!empty($top_rs) && isset($top_rs)) {
	$column=0;
	$row=-1;
	while ($categories = $top_rs->FetchRow()) {
		$row++;
		if($row>=$max_row) {
			$column++;
			$row=0;
		}
		$LD_Elements[$column][$row]['type'] = 'top';
		$LD_Elements[$column][$row]['value'] = strtoupper($categories['name']);
		$LD_Elements[$column][$row]['id'] = $categories['id'];
		$SQLStatementParam = "SELECT id,name,status FROM care_test_param WHERE group_id = '".$categories['id']."' AND status NOT IN ('deleted','hidden') ORDER BY name"; 
		$row_rs = $db->Execute($SQLStatementParam);
		if(!empty($row_rs) && isset($row_rs)) {
			while ($parameters = $row_rs->FetchRow()) {
				$row++;
				if($row>=$max_row) {
					$column++;
					$row=0;
				}
			$LD_Elements[$column][$row]['type'] = 'normal';
			$LD_Elements[$column][$row]['value'] = $parameters['name'];
			$LD_Elements[$column][$row]['id'] = $parameters['id'];
			}
		}
	}
}
?>







