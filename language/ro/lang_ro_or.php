<?php
$LDOr='Sala de operatii';
$LDLOGBOOK='JURNAL';
$LDOrDocument='Documentatia salii de operatie';
$LDOrDocumentTxt='Documentatia serviciului operativ';

/**
*  Mic dictionar:
*  DOC = doctor de serviciu
*  ORNOC = Asistenta de servici la sala de operatii
*  OP Room = sala de operatii (sala de chirurgie)
*/
$LDDOC='Doctor de serviciu';
$LDORNOC='Asistenta de serviciu';
$LDScheduler='Programator';

$LDQuickView='Vedere rapida';
$LDQviewTxtDocs='Vedere rapida a doctorilor de serviciu de astazi';
$LDOrLogBook='Jurnalul asistentelor de la sala de operatii';
$LDOrLogBookTxt='Documentatia asistentelor de la sala de operatii, fisiere de arhiva';
$LDOrProgram='Programul salii de operatii';
$LDOrProgramTxt='Arata, editeaza, creaza, etc. in programul salii de operatii';
$LDQviewTxtNurse='Vedere rapida a asistentelor de serviciu care sunt in asteptare astazi';
$LDDutyPlanTxt='Arata, editeaza, creaza lista asistentelor de serviciu la sala de operatii';
$LDOnCallDuty='Tura in asteptare';
$LDOnCallDutyTxt='Documentatia muncii in timpul turei de garda';
$LDAnaLogBook='Jurnalul anesteziei';
$LDAnaLogBookTxt='Documentatia serviciului de anestezie, fisiere de arhiva';
$LDQviewTxtAna='Vedere rapida a asistentelor de servici la anestezie';
$LDNewDocu='Document nou';
$LDSearch='Cauta';
$LDArchive='Arhiva';
$LDSee='Vezi';
$LDUpdate='Innoieste';
$LDCreate='Creaza';
$LDCreatePersonList='Creaza o lista a asistentelor de la sala de operatii';
$LDDoctor='Doctor/Chirurg';
$LDNursing='Ingrijiri';
$LDAna='Anestezia';

$LDClose='Inchide';
$LDSave='Salveaza';
$LDCancel='Anuleaza';
$LDReset='Reseteaza';
$LDContinue='Continua...';

$LDHideCat='Ascunde CAT';
$LDPatientsFound='Cativa pacienti au fost gasiti!';
$LDPlsClk1='Va rugam apasati pe cea din dreapta.';
$LDShowCat='Vreau sa vad pisica va rog!';
$LDResearchArchive='Cauta in arhive';
$LDSearchDocu='Cauta documentul';

$LDMinor='minor';
$LDMiddle='mijloc';
$LDMajor='major';
$LDOperation='Operatie';

$LDLastName='Nume';
$LDName='Prenume';
$LDBday='Data nasterii';
$LDPatientNr='Nr. pacientului';
$LDMatchCode='Parola';
$LDOpDate='Data operatiei';
$LDOperator='Chirurg';
$LDStationary='Internat';
$LDAmbulant='Ambulator';
$LDInsurance='Asigurare';
$LDPrivate='Privat';
$LDSelfPay='Isi plateste';

$LDDiagnosis='Diagnostic/ICD-10';
$LDLocalization='Localizare';
$LDTherapy='Terapie';
$LDSpecials='Note speciale';
$LDClassification='Clasificare';

/**
*  Mic dictionar:
*  OP = operatie (operatie chirurgicala)
*/
$LDOpStart='Start OP';
$LDOpEnd='Sfarsit OP';
/**
*  Mic dictionar:
*  Asistenta sterila =  asistenta imbracata in haine sterile care asista la o operatie, insarcinata cu instrumente sterile si materiale chirurgicale
*/
$LDScrubNurse='Asistenta sterila';
$LDOpRoom='Sala de operatii';
$LDResetAll='Sterge toate intrarile';
$LDUpdateData='Innoieste datele';
$LDStartNewDocu='Creaza un nou document';
$LDSearchKeyword='Parola de cautare: eg. prenume or nume';

$LDSrcListElements=array(
'',
'Nume',
'Prenume',
'Data nasterii',
'Pacient nr.',
'Data operatiei',
'OR Department',
'OP Nr.'
);
$LDClk2Show='Apasa sa vezi';
$LDSrcCondition='Cauta parola si/sau conditia';
$LDNewArchiveSearch='Noua cautare in arhiva';
$tage=array(
				'Duminica',
				'Luni',
				'Marti',
				'Miercuri',
				'Joi',
				'Vineri',
				'Sambata');
$monat=array('',
				'Ianuarie',
				'Februarie',
				'Martie',
				'Aprilie',
				'Mai',
				'Iunie',
				'Iulie',
				'August',
				'Septembrie',
				'Octombrie',
				'Noiembrie',
				'Decembrie');
$LDPrevDay='Ziua anterioara';
$LDNextDay='Ziua urmatoare';
$LDChange='Schimba';
$LDOpMainElements=array(
										nr_date=>'Nr/Data',
										patient=>'Pacient',
										diagnosis=>'Diagnostic',
										operator=>'Chirurg/Asistent',
										ana=>'Anestezie',
										cutclose=>'Taietura/Cusatura',
										therapy=>'Terapie',
										result=>'Resultat',
										inout=>'Intrare/Iesire'
										);
$LDOpCut='Taietura';
$LDOpClose='Cusatura';
$LDOpIn='Intrare';
$LDOpOut='Iesire';
$LDOpInFull='Intrare';
$LDOpOutFull='Iesire';
$LDEditPatientData='Editeaza jurnalul tintei';
$LDOpenPatientFolder='Deschide fisierul asistentelor al tintei';

$tbuf=array('O','A','S','R');
$cbuf=array('Chirurg','Asistent','Asistenta sterila','Asistenta de schimb');

/**
*  Mic dictionar:
*  Asistenta de schimb =  asistenta in haine nesterile care o asista pe asistenta sterila, insarcinata cu instrumentarul nesteril si materiale chirurgicalegical materials
*/
$LDOpPersonElements=array(
											operator=>'Chirurg',
											assist=>'Asistent',
											scrub=>'Asistenta sterila',
											rotating=>'Asistenta de schimb',
											ana=>'Anestezist'
											);

$LDPatientNotFound='Pacientul nu a fost gasit!';
$LDPlsEnoughData='Va rugam introduceti destule date.';
$LDOpNr='OP nr.';
$LDDate='Data';
$LDClk2DropMenu='Apasa sa ti se afiseze meniul';
$LDSaveLatest='Salveaza intrarile tarzii';
$LDHelp='Deschide fereastra de ajutor';

$LDSearchPatient='Cauta pacient';
$LDUsedMaterial='Foloseste materialele OP';
$LDContainer='Foloseste containerul/instrumente';
$LDDRG='DRG';
$LDShowLogbook='Arata jurnalul';

/**
*  Mic dictionar:
*  ITA = Anestezie intratraheala
*  ITN = Intratrachele Narkose (german)
*  LA =  Anestezie locala (injectata sau aplicata local)
*  DS = Daemmerschlaf (a local dialect meaning analgesic sedation )
*  AS = Sedare cu analgezice (german = Analgosidierung)
*  Plexus = Anestezie in plexul nervos 
*/

$LDAnaTypes=array(
					'ITN'=>'ITA',
					'ITN-Jet'=>'ITA-Jet',
					'ITN-Mask'=>'ITA-Mask',
					'LA'=>'LA',
					'DS'=>'DS',
					'AS'=>'AS',
					'Plexus'=>'Plex',
					'Standby'=>'In asteptare'
					);

$LDAnaDoc='Anestezist';
$LDAnaPrefix='AN';
$LDEnterPerson='Introdu o noua ~tinta~';
$LDExtraInfo='Informatii aditionale';
$LDFrom='De la';
$LDTo='Catre';
$LDFunction='Functie';
$LDCurrentEntries='Intrari curente';
$LDDeleteEntry='Sterge intrarea';
$LDSearchNewPerson='Cauta o noua ~tinta~';
$LDSorryNotFound='Imi pare rau. Nu am gasit nimic. Va rugam incercati o alta cheie de cautare.';
$LDSearchPerson='Cauta ~tinta~';
$LDJobId='Profesie';
$LDSearchResult='Cauta rezultate';
$LDUseData='Introdu aceasta persoana ca ~tinta~';
$LDJobIdTag=array(
						nurse=>'Asistenta',
						doctor=>'Fizician/Chirurg'
						);
$LDQuickSelectList='Selectare rapida a listei';
$LDTimes='Timp';
$LDPlasterCast='Plaster cast';
/**
*  Repozitionare = repozitionarea unui os doslocat sau fracturat
*/
$LDReposition='Repozitionare';
$LDWaitTime='Timp de identificare';
$LDStart='Start';
$LDEnd='Sfarsit';
$LDPatNoExist='Pacientul nu este inca introdus in jurnal. Va rugam alegeti aceasta fereastra si incepeti jurnalul de la inceput. Daca aceasta problema persista, va rugam anuntati departamentul EDP.';
$opts=array('-',
					'Pacientul a ajuns tarziu in sala de operatii',
       				'Anestezistul a ajuns tarziu in sala de operatii',
       				'Asistenta de la sala a ajuns tarziu in sala de operatii', 
					'Echipa de curatenie a ajuns tarziu',
       				'Motiv special');
$LDReason='Motiv';
$LDMaterialElements=array(
									'Nr. cel mai bun.',
    								'Numele articolului',
    								'&nbsp;',
    								'Generic',
    								'Nr. liceentei',
    								'No.Pcs.',
    								'&nbsp;'
									);
$LDSearchElements=array(
									'&nbsp;',
									'Art.nr.',
    								'Numele articolului',
    								'Descriere',
 									'&nbsp;',
   									'Generic',
    								'Nr. liceentei.'
									);
$LDContainerElements=array(
									'Nr. containerului',
    								'Nume/Descrere',
									'&nbsp;',
    								'nr. industrial',
    								'nr. de ordine',
    								'Nr.pcs.',
    								'&nbsp;'
									);
$LDArticleNr='Articol nr.';			
$LDContainerNr='Container nr.';							
$LDArticleNotFound='Articolul nu a fost gasit!';
$LDNoArticleTxt='Articolul ori nu a fost listat in baza de date ori ati tastat numarul incorect.';
$LDClk2ManualEntry='Pentru a introduce articolul manual, <b>Apasa aici.</b>';
$LDPlsClkArticle='Va rugam introduceti articolul dorit!';
$LDSelectArticle='Apasati pentru a selecta acest articol';
$LDDbInfo='Info de la baza de date';
$LDRemoveArticle='Muta articolul din aceasta lista';
$LDArticleNoList='Articolul nu a fost listat in baza de date';
$LDPromptSearch='Va rugam introduceti o cheie de cautare.<br>Ca de exemplu prenume, nume, sau data nasterii, etc.	(Vezi de asemenea "Ajutor")';
$LDKeyword='Cuvant cheie';
$LDOtherFunctions='Alte functii';
$LDInfoNotFound='Informatia ceruta nu este gasita!';
$LDButFf='Dar urmatoarele';
$LDSimilar=' intrarea este';
$LDSimilarMany=' intrarile sunt';
$LDNeededInfo=' asemanator cu cheia de cautare.';
$LDPatLogbook='Pacientul este documentat in urmatorul jurnal.';
$LDPatLogbookMany='Pacientul este documentat in urmatoarea carte.';
$LDDepartment='Departament';
$LDRoom='Camera';
$LDLastEntry='Urmatoarea este ultima intrare in jurnal';
$LDLastEntryMany='Urmatoarele sunt ultimele intrari in jurnal';
$LDFrom='de la';
$LDFromMany='de la';
$LDYesterday='ieri';
$LDVorYesterday='2 zile in urma';
$LDDays='zile in urma';
$LDChangeDept='Schimba departamenul sau sala de operatii';

$LDTabElements=array('OR Department',
								 'in asteptare',
								 'Pager/Telefon',
								 'La telefon',
								 'Pager/Telefon',
								 'Plan de sarcini'
								 );
$LDStandbyPerson='In asteptare';
$LDOnCallPerson='La telefon';
$LDMonth='Luna';
$LDYear='An';
$LDDutyElements = array('Data','&nbsp;','Nume, Prenume','de la','catre','sala de operatii','Diagnostic & terapie');
$LDPrint='Imprima';
$LDAlertNoPrinter='Trebuie sa imprimi manual. Apasa dreapta pe fereastra, apoi selecteaza Print.';
$LDAlertNotSavedYet='Ultimele intrari nu au fost inca salvate. Vrei sa salvezi intai?';
$LDPhone='Telefon';
$LDBeeper='Pager';
$LDOn='pornit';
$LDNoPersonList='Lista personalului nu este inca creata. Va rugam creati intai lista.';
$LDNoEntryFound='Nici o intrare in plan nu a fost gasita!';
$LDShow='Arata';
$LDShowPrevLog='Arata intrarea de legatura anterioara';
$LDShowNextLog='Arata urmatoarea intrare de legatura';
$LDShowGuideCal='Arata calendarul de ghidare';

$LDPerformance='Performante';
/* 2002-10-13 EL */
$LDPlsSelectPatientFirst='Va rugam gasiti intai pacientul.';
$LD_ddpMMpyyyy='zz.ll.aaaa';
$LD_yyyyhMMhdd='aaaa-ll-zz';
$LD_MMsddsyyyy='ll/zz/aaaa';
/* 2002-10-15 EL */
$LDStandbyInit='S'; /* S = In asteptare */
$LDOncallInit='O'; /* O = La telefon */
$LDDutyPlan='Plan de sarcini';
/* 2003-03-18 EL */
$LDSearchInAllDepts='Cauta in toate departamentele';
$LDAddNurseToList='Adauga la lista asistentelor';
$LDNursesList='Asistente\' Lista';
/* 2003-03-19 EL */
$LDPlsSelectDept='Va rugam selectati un departament.';
$LDSelectORoomNr='...si o sala de operatii.';
$LDAlertNoDeptSelected=$LDPlsSelectDept;
$LDAlertNoORSelected='Va rugam selectati o sala de operatii!';
?>
