<?php
$LDEntryDate='Data de entrada';
$LDJournalNumber='Nº do jornal';
$LDBlockNumber='Nº de Blocos';
$LDDeepCuts='Blocos baixos';
$LDSpecialDye='Marcação especial';
$LDImmuneHistoChem='Immune Histo-chemistry';
$LDHormoneReceptors='Hormone receptors';
$LDSpecials='Especial';
$LDSend='Enviar';
$LDSendLater='Enviar depois';
$LDReset='Restaurar';
$LDClose='Fechar';
$LDSpeedTest='Teste urgente.';
$LDDiagnosticTest='Pedir exame de diagóstico';
$LDRelayResult='Remeter diagóstico por telefone/sinalizador';
$LDSpeedCut='Express cut.';
$LDDate='Data';
$LDOpDate='Data de Operação';
$LDDoctor='Médico';
$LDDept='Departamento';
$LDTel='Tel:';
$LDMatType='Tipo de espécime';
$LDPE='Biopse, encisão de exemplo';
$LDSpecimen='Opções de espécime';
$LDShave='Curettage';
$LDCytology='Citologia';
$LDLocalization='Localização';
$LDClinicalQuestions='Clinical Diagnoses, Reports, Queries:';
$LDExtraInfo='Supporting information';
$LDExtraInfoSample='(e.g. important Lab results, after Radiation in excision area, after Chemotherapy)';
$LDForGynTests='For gynecological tests:';
$LDLastPeriod='Último período:';
$LDPeriodType='Period type:';
$LDGravidity='Gravidade:';
$LDMenopauseSince='Menopause since:';
$LDHormoneTherapy='Hormonal therapy:';
$LDContraceptive='Contraceptive:';
$LDIUD='IUD:';
$LDRepeatedTest='For repeated test:';
$LDRepeatedTestPls='please enter the early Journal number with date';
$LDHysterectomy='Hysterectomy:';
$LDClinicalInfo='Informação clínica';
$LDReqTest='Requested diagnostic test';
$LDNotesTempReport='Notes / Initial findings:';
$LDRequestingDoc='Requesting doctor';
$LDReportingDoc='Reporting doctor';
$LDXrayNumber='Nr do raio-X:';
$LD_r_cm2='r cm² :';
$LDXrayTechnician='X-ray tech.';
$LDYes='Yes';
$LDNo='No';
$LDXrayTest='X-ray diagnostics';
$LDMammograph='Mamografia';
$LDSonograph='Sonografia';
$LDCT='Tomografia computadorizada';
$LDNuclear='Medicina nuclear';
$LDMRT='Magnetic Resonance Tomography';

$LDPatMobile='Patient mobile?';
$LDAllergyKnown='Alguma alergia conhecida?';
$LDHyperthyreosisKnown='Hyperthyreosis known?';
$LDPregnantPossible='Pregnancy possible?';

$LDDiagnosesInquiries='Diagnoses / Inquiries:';
$LDDeptReport='Department\'s Report:';
$LDRequestTo='Request to the';
$LDDepartment='department';
$LDVisitRequested='Visit requested';
$LDPatCanBeOrdered='Patient can be ordered';

/* Note: the following arrays use strict medical terminology.
*  If you are not sure about their translation, please leave the 
*  english word untranslated
*/
$LDBacLabMaterialType = array(_mx_k_urin_=>'C.Urin',                                              
                                              _mx_sputum_=>'Sputum',
											  _mx_m_urin_=>'M.Urin',
											  _mx_trachealsecrete_=>'Trac.scrt.',
											  _mx_uricult_=>'Uricult',
											  _mx_bronchiallavage_=>'B.lavage',
											  _mx_wundabstrich_=>'W.smr',
											  _mx_magensaft_=>'Gastrc.j.',
											  _mx_augen_abstrich_right_=>'Ey.s.r.',
											  _mx_secrete_=>'Secrete',
											  _mx_augen_abstrich_left_=>'Ey.s.l.',
											  _mx_exsudat_=>'Exsudat',
											  _mx_ear_abstrich_right_=>'E.s.r.',
											  _mx_punction_=>'Punctat',
											  _mx_ear_abstrich_left_=>'E.s.l.',
											  _mx_pleura_=>'Pleura',
											  _mx_rachen_abstrich_=>'Th.smr',
											  _mx_ascites_=>'Ascetis',
											  _mx_tonsillen_abstrich_=>'Tons.s.',
											  _mx_douglas_=>'Douglas',
											  _mx_nose_abstrich_=>'N.smr',
											  _mx_liquor_=>'Liquor',
											  _mx_vaginal_abstrich_=>'Vag.s.',
											  _mx_blood_culture_=>'Blood.C.');
										  
$LDBacLabTestType=array(_tx_special_body_material_=>'S.body.m.',
                                        _tx_culture_aerob_=>'Aerob.C.',
										_tx_op_material_=>'OP.Mat.',
										_tx_culture_anaerob_=>'Anae.C.',
										_tx_k_point_=>'Cat.tip',
										_tx_fungus_culture_=>'Fungal.C.',
										_tx_tubus_point_=>'Tube.tip',
										_tx_stool_parasite_=>'St.f.paras.',
										_tx_go_culture_=>'GO-Cult.',
										_tx_stool_pathogen_=>'St.f.patho.',
										_tx_hygiene_material_=>'Hygien.Mat.',
										_tx_stool_dyspepsy_=>'St.f.Dysp.',
										_tx_biopsy_material_=>'Biops.Mat.',
										_tx_stool_clost_toxin_=>'St.f.C.Tox.',
										_tx_stool_=>'Stool',
										_tx_tbc_dye_=>'TBC.Stain',
										_tx_stool_yersinia_=>'St.f.Yers.',
										_tx_tbc_culture_=>'TBC.cult.',
										_tx_stool_ehec_=>'St.f.EHEC',
										_tx_liquor_antigen_=>'Liq.antigen',
										_tx_own_blood_=>'Own blood',
										_tx_gram_dye_=>'Gram.stain',
										_tx_pharma_material_=>'Pharm.mat.',
										_tx_go_dye_=>'GO-stain');
										
$LDShortMonth=array('',
                                   'Ja',
								   'Fe',
								   'Ma',
								   'Ap',
								   'My',
								   'Jn',
								   'Jl',
								   'Au',
								   'Se',
								   'Oc',
								   'No',
								   'De');
$LDBatchNumber='Numero do lote';
$LDMaterial='Material:';
$LDDiagnosis='Diagnóstico:';
$LDImmuneSupp='Immune supp.';

$LDRequestedTest='Exame requerido';
$LDLabel='Etique';
$LDCentralLab='Laboratório Central';

$LDRequestOf='Requerido por ';
$LDTelephone='Telefone';
$LDToBloodBank='Para o banco de sangue';
$LDWithMatchTest='with match test sample(s)';
$LDByBloodBank='do banco de sangue:';

$LDBloodGroup='Grupo sanguíneo:';
$LDRhFactor='Fator RH:';
$LDKell='Kell';
$LDDateProtNumber='Date & protocol nr. of test by:';
$LDBloodSpecimen='Specimen';
$LDCount='Count';
$LDPureBlood='Pure blood';
$LDRedBloodCon='Red blood cell concentrate';
$LDLeukoLessRedBlood='Leukocytedepleted red blood cell';
$LDWashedRedBlood='Washed red blood cells';
$LDPRP='Platelet rich plasma';
$LDThromboCon='Platelet concentrate';
$LDFFP='Fresh frozen plasma</font>';
$LDTransfusionDevice='Transfusion devices';
$LDTransfusionDate='Transfusion date:';
$LDNotesRequests='Notes/special orders:';
$LDDoctorNotice='<b>The ordering doctor is responsible for this order!</b><br>For security reasons, only sample tubes with full name & birthdate will be accepted.';

$LDPB='PB'; /* Pure blood */
$LD350='350';
$LDRB='RB'; /* Red blood cells */
$LDLLRB='LRB'; /* Leukocyteless Red blood cells */
$LDWRB='WRB'; /* washed red blood cells */
$LDPRP_Initial='PRP'; /* Platelet rich plasma*/
$LDTC='TC'; /* Platelet - Thrombocytes concentrate*/
$LDFFP_Initial='FFP'; /* Fresh frozen plasma*/
$LDLabServices='Computation of lab services';
$LDServiceCode='S-CODE';
$LDBloodGroupCode='1360';
$LDA_SubgroupCode='1342';
$LDExtraBGFactorsCode='1391';
$LDCoombsTestCode='1343';
$LDAntibodyTestCode='1355';
$LDCrossTestCode='1365';
$LDAntibodyDiffCode='1355';
$LDA_Subgroup='A-subgroup';
$LDExtraBGFactors='other blood group factors';
$LDCoombsTest='Dir. Coombstest';
$LDAntibodyTest='Antibody search test';
$LDCrossTest='Cross test';
$LDAntibodyDiff='Antibody differentiation';
$LDTotalAmount='Total amount';
$LDPrice='Price';
$LDConserveNrPaste='(Paste product number here immediately)';
$LDLabTimeStamp='(Blood bank time stamp)';
$LDReleaseVia='Release via';
$LDReceiptAck='Receipt acknowledgement';
$LDSignature='Signature';
$LDLabLogBook='Journal-nr:';
$LDLabNumber='Lab-Nr.';
$LDBookedOn='booked on';

$LDFillByLab='To be filled up by blood bank only!';
$LDFillByWard='Must be filled up at the ward!';

/* 2002-09-03 EL */
$LDSearchPatient='Procurar um paciente';
$LDPlsSelectPatientFirst='Favor procurar pelo paciente primeiro.';
/* 2002-09-07 EL*/
$LDAlertQuickCut='The quick cut is selected.';
$LDAlertQuickDiagnosis='The quick diagnosis is selected.';
$LDPlsEnterPhone='Favor digitar o telefone ou bepper.';
$LDPlsEnterOpDate='Please enter the op date.';
$LDPlsEnterDoctorName='Favor digitar o nome do médico.';

/* 2002-09-08 EL */
$LDPlsEnterBloodGroup='Favor digitar o grupo sanguíneo.';
$LDPlsEnterRhFactor='Favor digitar o fator RH.';
$LDPlsEnterKell='Please enter the Kell value.';
$LDPlsEnterBloodPcs='Please enter the blood product\'s number of pcs.';
$LDPlsEnterDate='Favor dititar a data.';
/* 2002-09-09 EL */
$LDPlsEnterDiagnosisQuiry='Please enter the diagnoses or inquiries.';
$LDPlsSelectDept='Favor selecionar um departamento.';
$LDPlsSelectDeptShort='pls. selecione um departamento';
/* 2002-12-09 EL */
$LDPendingTestRequest='Pending Test Request';
/* 2002-09-13 EL */
$LDPrevRequest='Requisição anterior';
$LDNextRequest='Próxima requisição';
$LDEnterResult='Write findings/results for this test request';
$LDPrintOut='Imprimir esse formulário';
$LDSaveEntry='Salvar registros';
/* 2002-09-14 EL */
$LDNoPendingRequest='Não existe requisições pendentes.';
/* 2002-09-15 EL */
$LDTestFindings='Test findings';
$LDCaseNr='Case number';
$LDFamilyName='Sobrenome';
$LDName='Primeiro nome';
$LDBDay='Data de nascimento';
/* 2002-09-15 EL */
$LDMACROFindings='Macro findings';
$LDMicroFindings='Micro findings';
$LDAddFindings='Additional notes';
$LDXrayDate='Xray date';
$LDPlsEnterTransfusionDate='Please enter the date of transfusion.';
/* 2002-09-21 EL */
$LDPlsEnterLEN='Please enter the Lab Entry Number (LEN)';
/* 2002-09-28 EL */
$LDHospitalName='Care';

/* 2002-09-29 EL */
$LDHematology='Hematologia';
$LDCoagulation='Coagulação';
$LDUrine='Urina';
$LDSerum='Serum';
$LDNuechtern='sob';
$LDGlucose='Glucose';
$LDBLP='BLP'; /* BLP = Blood plasma */
$LDBS='BLS'; /* BLS = Blood sugar */
$LDBS1='BLS 1';
$LD900='9.00';
$LD1500='15.00';

/* 2002-10-14 EL */
$LDDone='Está feiot! Mover para o formulário';

?>
