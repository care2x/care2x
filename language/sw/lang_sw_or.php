<?php
$LDOr='OP Room';
$LDLOGBOOK='JOURNAL';
$LDOrDocument='OP Room Documentation';
$LDOrDocumentTxt='Documenting the operative services';

/**
*  A tiny dictionary:
*  DOC = doctor on call duty
*  ORNOC = Operating room nurse on call duty
*  OP Room = operating room (surgery room)
*/
$LDDOC='Doctor-on-call';
$LDORNOC='Nurse-on-call';
$LDScheduler='Scheduler';

$LDQuickView='Quickview';
$LDQviewTxtDocs='Quick view of today\'s  Doctor-on-call';
$LDOrLogBook='OP Room nursing journal';
$LDOrLogBookTxt='Documenting the nursing services in OP Room, archive files';
$LDOrProgram='OP Room program';
$LDOrProgramTxt='Show, edit, create, etc. an OP Room program';
$LDQviewTxtNurse='Quick view of today\'s nurses\' on standby duty';
$LDDutyPlanTxt='Show, edit, create OP Room Nurse-on-call';
$LDOnCallDuty='Standby duty';
$LDOnCallDutyTxt='Documenting the work during an On-Call duty';
$LDAnaLogBook='Anesthesia journal';
$LDAnaLogBookTxt='Documenting the anesthesia services, archive files';
$LDQviewTxtAna='Quick view of today\'s Nurse-on-call for anesthesia';
$LDNewDocu='New document';
$LDSearch='Search';
$LDArchive='Archive';
$LDSee='See';
$LDUpdate='Update';
$LDCreate='Create';
$LDCreatePersonList='Create a OP Room Nurses list';
$LDDoctor='Physician/Surgeon';
$LDNursing='Nursing';
$LDAna='Anaesthesia';

$LDClose='Close';
$LDSave='Save';
$LDCancel='Cancel';
$LDReset='Reset';
$LDContinue='Continue...';

$LDHideCat='Hide the cat';
$LDPatientsFound='Several patients found!';
$LDPlsClk1='Please click the right one.';
$LDShowCat='I want to see the cat please!';
$LDResearchArchive='Research in the archives';
$LDSearchDocu='Search a document';

$LDMinor='minor';
$LDMiddle='middle';
$LDMajor='major';
$LDOperation='Operation';

$LDLastName='Family name';
$LDName='Given name';
$LDBday='Birthdate';
$LDPatientNr='Patient nr.';
$LDMatchCode='Matchcode Name';
$LDOpDate='Operation date';
$LDOperator='Surgeon';
$LDStationary='Inpatient';
$LDAmbulant='Outpatient';
$LDInsurance='Insurance';
$LDPrivate='Private';
$LDSelfPay='Self pay';

$LDDiagnosis='Diagnosis/ICD-10';
$LDLocalization='Localization';
$LDTherapy='Therapy';
$LDSpecials='Special notice';
$LDClassification='Classification';

/**
*  A tiny dictionary:
*  OP = operation (surgical operation)
*/
$LDOpStart='OP Start';
$LDOpEnd='OP End';
/**
*  A tiny dictionary:
*  Scrub nurse =  the nurse in sterile clothing assisting the surgeon, in charge of the sterile instruments and surgical materials
*/
$LDScrubNurse='Scrub nurse';
$LDOpRoom='OP room';
$LDResetAll='Erase all entries';
$LDUpdateData='Update data';
$LDStartNewDocu='Create a new document';
$LDSearchKeyword='Search keyword: eg. given name or family name';

$LDSrcListElements=array(
'',
'Family name',
'Given name',
'Birthdate',
'Patient nr.',
'OP Date',
'OR Department',
'OP Nr.'
);
$LDClk2Show='Click to show';
$LDSrcCondition='Search keyword and/or condition';
$LDNewArchiveSearch='New archive research';
$tage=array(
				'Sunday',
				'Monday',
				'Tuesday',
				'Wednesday',
				'Thursday',
				'Friday',
				'Saturday');
$monat=array('',
				'January',
				'February',
				'March',
				'April',
				'May',
				'June',
				'July',
				'august',
				'September',
				'October',
				'November',
				'December');
$LDPrevDay='Previous day';
$LDNextDay='Next day';
$LDChange='Change';
$LDOpMainElements=array(
										nr_date=>'Nr/Date',
										patient=>'Patient',
										diagnosis=>'Diagnosis',
										operator=>'Surgeon/Assistant',
										ana=>'Anästhesie',
										cutclose=>'Cut/Suture',
										therapy=>'Therapy',
										result=>'Result',
										inout=>'Entry/Exit'
										);
$LDOpCut='Cut';
$LDOpClose='Suture';
$LDOpIn='Entry';
$LDOpOut='Exit';
$LDOpInFull='Entry';
$LDOpOutFull='Exit';
$LDEditPatientData='Edit the journal data of ~tagword~';
$LDOpenPatientFolder='Open the nursing folder of ~tagword~';

$tbuf=array('O','A','S','R');
$cbuf=array('Surgeon','Assistant','Scrub nurse','Rotating nurse');

/**
*  A tiny dictionary:
*  rotating nurse =  the nurse in non-sterile clothing assisting the scrub nurse, in charge of the non-sterile instruments and surgical materials
*/
$LDOpPersonElements=array(
											operator=>'Surgeon',
											assist=>'Assistant',
											scrub=>'Scrub nurse',
											rotating=>'Rotating nurse',
											ana=>'Anesthesiologist'
											);

$LDPatientNotFound='Patient not found!';
$LDPlsEnoughData='Please enter enough information.';
$LDOpNr='OP nr.';
$LDDate='Date';
$LDClk2DropMenu='Click to drop down menu';
$LDSaveLatest='Save latest entries';
$LDHelp='Open help window';

$LDSearchPatient='Search patient';
$LDUsedMaterial='Used OP materials';
$LDContainer='Used container/instruments';
$LDDRG='DRG';
$LDShowLogbook='Show journal';

/**
*  A tiny dictionary:
*  ITA = Intra Tracheal Anesthesia
*  ITN = Intratrachele Narkose (german)
*  LA =  Local anesthesia (locally injected or applied)
*  DS = Daemmerschlaf (a local dialect meaning analgesic sedation )
*  AS = Analgesic sedation (german = Analgosidierung)
*  Plexus = Anesthesia on the Plexus nerve 
*/

$LDAnaTypes=array(
					'ITN'=>'ITA',
					'ITN-Jet'=>'ITA-Jet',
					'ITN-Mask'=>'ITA-Mask',
					'LA'=>'LA',
					'DS'=>'DS',
					'AS'=>'AS',
					'Plexus'=>'Plexus',
					'Standby'=>'Standy'
					);

$LDAnaDoc='Anesthesiologist';
$LDAnaPrefix='AN';
$LDEnterPerson='Enter a new ~tagword~';
$LDExtraInfo='Additional information';
$LDFrom='From';
$LDTo='To';
$LDFunction='Function';
$LDCurrentEntries='Current entries';
$LDDeleteEntry='Delete entry';
$LDSearchNewPerson='Search a new ~tagword~';
$LDSorryNotFound='Sorry. I did not find anything. Please try a different keyword.';
$LDSearchPerson='Search ~tagword~';
$LDJobId='Profession';
$LDSearchResult='Search results';
$LDUseData='Enter this person as ~tagword~';
$LDJobIdTag=array(
						nurse=>'Nurse',
						doctor=>'Physician/Surgeon'
						);
$LDQuickSelectList='Quick select list';
$LDTimes='Time';
$LDPlasterCast='Plaster cast';
/**
*  Reposition = repositioning of bone dislocation or fracture
*/
$LDReposition='Reposition';
$LDWaitTime='Idle time';
$LDStart='Start';
$LDEnd='End';
$LDPatNoExist='The patient is not yet entered in the journal. Please close this window and start the journal from the very	beginning. If this problem persists, please notify the EDP department.';
$opts=array('-',
					'Patient arrived late in OP Room',
       				'Anesthesiologists arrived late in OP Room',
       				'OP Room nurses arrived late in OP Room', 
					'Cleaning team finished late',
       				'Special reason');
$LDReason='Reason';
$LDMaterialElements=array(
									'Best.nr.',
    								'Art.name',
    								'&nbsp;',
    								'Generic',
    								'License.Nr.',
    								'No.Pcs.',
    								'&nbsp;'
									);
$LDSearchElements=array(
									'&nbsp;',
									'Art.nr.',
    								'Art.name',
    								'Description',
 									'&nbsp;',
   									'Generic',
    								'License.Nr.'
									);
$LDContainerElements=array(
									'Container nr.',
    								'Name/Description',
									'&nbsp;',
    								'Industry nr.',
    								'Order nr.',
    								'No.pcs.',
    								'&nbsp;'
									);
$LDArticleNr='Article nr.';			
$LDContainerNr='Container nr.';							
$LDArticleNotFound='Article not found!';
$LDNoArticleTxt='The article is either not listed in the databank or you have typed the number incorrectly.';
$LDClk2ManualEntry='To enter the article manually, <b>click here.</b>';
$LDPlsClkArticle='Please click the desired article!';
$LDSelectArticle='Click to select this article';
$LDDbInfo='Info from the databank';
$LDRemoveArticle='Remove article from this list';
$LDArticleNoList='Article not listed in the databank';
$LDPromptSearch='Please enter a search keyword.<br>Like for example a given name, family name, or a birthdate, etc.	(See also "Help")';
$LDKeyword='Keyword';
$LDOtherFunctions='Other functions';
$LDInfoNotFound='The needed information is not found!';
$LDButFf='But the following';
$LDSimilar=' entry is';
$LDSimilarMany=' entries are';
$LDNeededInfo=' similar to the search keyword.';
$LDPatLogbook='The patient is documented in the following journal.';
$LDPatLogbookMany='The patient is documented in the following logbooks.';
$LDDepartment='Department';
$LDRoom='Room';
$LDLastEntry='The following is the last entry in the journal';
$LDLastEntryMany='The following are the last entries in the journal';
$LDFrom='from';
$LDFromMany='from';
$LDYesterday='yesterday';
$LDVorYesterday='2 days ago';
$LDDays='days ago';
$LDChangeDept='Change the department or OP room';

$LDTabElements=array('OR Department',
								 'Standby',
								 'Beeper/Phone',
								 'On Call',
								 'Beeper/Phone',
								 'Duty plan'
								 );
$LDStandbyPerson='Standby';
$LDOnCallPerson='On call';
$LDMonth='Month';
$LDYear='Year';
$LDDutyElements = array('Date','&nbsp;','Family name, Given name','from','to','OP Room','Diagnosis & therapy');
$LDPrint='Print';
$LDAlertNoPrinter='You must print manually. Right click on the window,  then select Print.';
$LDAlertNotSavedYet='The latest entry is not saved yet. Do you want to save first?';
$LDPhone='Phone';
$LDBeeper='Beeper';
$LDOn='on';
$LDNoPersonList='The list of personnel is not yet created. Please create the list first.';
$LDNoEntryFound='No entry in plan found!';
$LDShow='Show';
$LDShowPrevLog='Show the previous log entries';
$LDShowNextLog='Show the next log entries';
$LDShowGuideCal='Show the guide calendar';

$LDPerformance='Performance';
/* 2002-10-13 EL */
$LDPlsSelectPatientFirst='Please find the patient first.';
$LD_ddpMMpyyyy='dd.mm.yyyy';
$LD_yyyyhMMhdd='yyyy-mm-dd';
$LD_MMsddsyyyy='mm/dd/yyyy';
/* 2002-10-15 EL */
$LDStandbyInit='S'; /* S = Standby */
$LDOncallInit='O'; /* O = Oncall */
$LDDutyPlan='Duty plan';
/* 2003-03-18 EL */
$LDSearchInAllDepts='Search in all departments';
$LDAddNurseToList='Add a nurse to list';
$LDNursesList='Nurses\' List';
/* 2003-03-19 EL */
$LDPlsSelectDept='Please select a department.';
$LDSelectORoomNr='...and an OP Room.';
$LDAlertNoDeptSelected=$LDPlsSelectDept;
$LDAlertNoORSelected='Please select an operating room!';
?>
