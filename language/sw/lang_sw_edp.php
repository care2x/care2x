<?php
$LDClose='Close';
$LDCancel='Cancel';
$LDResetEntry='Erase entries';
$LDSave='Save';
$LDReset='Reset';

$LDEnterData='Click to enter data';
$LDClk2See='Click to see data';
$LDFoundPatient='The search found <b>~nr~</b> patients';
$LDWildCards='What are wildcards and how to use them';
$LDNewSearch='New search';
$LDSearch='Search';

$LDOClock='o\'clock';
$LDContinue='Continue';
$LDBack='Go back';

$LDOn='On';
$LDAt='At';
$LDClk2Edit='Click to edit this report';

$LDNew='New';
$LDEdit='Edit';
$LDCreate='Create';
$LDValue='Value';

$LDNews='News';
$LDNewsTxt='Read or write news articles pertaining to sytem administration department';
$LDMemo='Memo';
$LDMemoTxt='Read or write a memo';
$LDSearchPat='Search patient';
$LDCategory='Category';
$LDPast3Days='Past 3 days';
$LDPast3Months='Past 3 months';
$LDPastAll='All';
$LDSelect='Select';

$LDOrderArchive='Archive';



$LDNoDataFound='The search found <font color=red><b>no</b></font> data.';
$LDClk2SeeInfo='Please click the right one to see the complete information';
/********************** Do not erase or replace the ~nr~ *****************************/
$LDFoundNrData='The search found <font color=red><b>~nr~</b></font> data that corresponded to the search keyword.';
$LDOpenInfo='Show complete information about ';

$LDGoodMorning='Good morning';
$LDGoodDay='Hello, nice to see you';
$LDGoodEvening='Good evening';

$LDDate='Date';
$LDDept='Department';
$LDPrio='Priority';
$LDSearchIn='Search after';


$LDPlsEnterMore='Please enter some more information and try it again.';
$LDNoSingleChar='A single character will be ignored.';

$LDPlsInformDept='Please notify the ~tagword~ department and eventually the system admin department. Thank you.';

$LDReports='Reports';
$LDReportsTxt='Create, search, read reports, etc.';
$LDInfo='Information';
$LDInfoTxt='Search and read information pertaining to system admin';
$LDManage='Management';
$LDUpdateOk='Update was <b>successful</b>!';
$LDDataSaved='The following data was successully saved:';
$LDDataNoUpdate='Update  <b>failed</b>. Please check the entries.';
$LDDataNoSaved='Save <b>failed</b>. Please check the entries.';
$LDBack2Menu='Go back to databank menu';
$LDPageTop='Back to top.';
$LDPreview='Preview';
$LDUpdateData='Update or edit';
$LDRemoveFromDb='Remove from the databank';
$LDDataRemoved='The product was removed from the databank!';

$LDConfirmDelete='Do you really want to <b>erase</b> or <b>remove</b> the following data from the databank ?';
$LDAlertDelete='<b>ATTENTION!</b> Delete <b>CANNOT</b> be undone!';
$LDNoDelete='Deletion of the data failed!<br>Please notify the system admin department.';
$LDYesDelete='Yes, I am dead sure. Delete access right.';
$LDNoBack='No. Go back.';
$LDClk2Ack='Click the arrow button to acknowledge and/or print the order list.';
$LDOK='OK';
$LDManageAccess='Access Permissions';
$LDManageAccessTxt='Manage, create, lock, remove, update, or change, etc.';
$LDSqlDb='SQL Databank';
$LDSqlDbTxt='Direct SQL access. <b>ATTENTION</b> only for experts';
$LDSysOpLogin='System Admin';
$LDSysOpLoginTxt='Login as system administrator';
$LDEDP='System admin';
$LDNewAccess='Create new access permission';
$LDListActual='List access permission';
$LDName='Name';
$LDPassword='Password';
$LDUserId='User login ';
$LDArea='Area';
$LDAllowedArea='Allowed areas are:';
$LDActualAccess='Actual access permissions';
$LDAccessDeleted='The access permission was deleted successfully.';
$LDFfActualAccess='Following are the actual access permissions.';

$LDAccessIndex=array(
				'Name',
			 	'Login ',    
			 	'Password', 
				'',
			 	'Allowed areas', 
			 	'Date/Time', 
			 	'Encoder', 
			 	'Option'
			 	);
$LDChange='Change';
$LDInitChange='C';
$LDLock='Lock';
$LDInitLock='L';
$LDUnlock='Unlock';
$LDInitUnlock='U';
$LDDelete='Delete';
$LDInitDelete='D';
$LDUpdateRight='Update access right';
$LDInputError='Your entry is either erroneous or some data are missing. Input fields marked red are to be filled in or the entry to be corrected.';
$LDAccessRight='Access right';
$LDSureLock='Are you sure you want to LOCK this access right?';
$LDSureUnlock='Are you sure you want to UNLOCK this access right?';
$LDSureDelete='Are you sure you want to DELETE this access right?';
$LDYesSure='Yes, I\'m sure.';
$LDKeywordPrompt='Enter a search keyword';
$LDSystemAdmin='System Administrator';
$LDMySQLManage='Manage SQL databank with PHP MySQLAdmin';
$LDSpexFunctions='More configuration options';
$LDWelcome='Welcome';
$LDForeWord='You now have the highest access privileges.<br>The following functions are available without restrictions. <br><b>Please be very careful with what you do.</b>';

$LDSetDateFormat='Set date format';
$LDSelectDateFormat='Please select the needed date format:';

# Date formats
# Add additional date formats as array element.
# Do not forget to add the correspondign sample text in the $LDDateFormatsTxt array.
# Do not translate $LDDateFormats 
$LDDateFormats=array('dd.MM.yyyy','yyyy-MM-dd','MM/dd/yyyy','dd/MM/yyyy');

$LDDateFormatsTxt= array('For example: 01.10.2002 (01 October 2002)',
                                         'For example: 2002-10-01 (2002 October 01)',
										 'For example: 10/01/2002 (October 01, 2002)',
										 'For example: 01/10/2002 (01 October , 2002)'
										 );					 
/**
* The following lines must be modified according to the examples:
* english:
* day = d , month = m, year = y
* result => dd.mm.yyyy
*
* german:
* day = t, month = m, year = j
* result => tt.mm.jjjj
*
* indonesian:
* day = h, month = b, year = t
* result => hh.bb.tttt
* 
* BEGIN */
$LD_ddpMMpyyyy='dd.mm.yyyy';
$LD_yyyyhMMhdd='yyyy-mm-dd';
$LD_MMsddsyyyy='mm/dd/yyyy';
$LD_ddsMMsyyyy='dd/mm/yyyy';
/* END */

$LDNewDateFormatSaved='The new date format is now in effect.';
									
$LDSetCurrency='Set currency';
$LDNewCurrencySet='The new currency is now active.';
$LDPlsSelectCurrency='Please select currency.';
$LDAddCurrency='Add new type of currency';
$LDPlsAddCurrency='Please enter the information about the currency. Then click "Save".';
$LDAddedNewCurrency='The information about the new currency was saved.';
$LDmain='main';
$LDClk2AddCurrency='To enter new currency type, please click here.';
$LDCurrencyShortName='Currency\'s symbolic or short :';
$LDCurrencyLongName='Currency\'s descriptive :';
$LDCurrencyInfo='Additional information:';
$LDClk2SetCurrency='To set the main currency, please click here.';
$LDCurrencyUpdated='The currency information is updated.';
$LDUpdateCurrencyInfo='Edit Currency Information';
$LDPlsEnterUpdate='Please edit the currency information. Then press "Update".';

$LDEditInfo='Edit';
$LDCurrencyAdmin='Currency';


/* 2002-10-22 EL */
$LDUserInfoSaved='The user access was successfully created';
$LDUserInfoNoSave='The access creation failed. Please check the entered information';
$LDNoAreas='You have not selected any area!';
$LDUserDouble='The access creation failed. Please use a different user login .';
$LDEnterNewUser='Create a new user access';
/* 2002-11-22 EL*/
$LDDeleteCurrency='Are you sure, you really want to delete this currency?';
$LDNoMainDelete='You cannot delete a main currency. \nPlease set a different main currency first.';
$LDCurrencyExisting='This currency exists already!';
/* 2003-02-21 EL*/
$LDMenuItem='Menu item';
$LDOrderNr='Sort nr.';
$LDStatus='Status';
$LDHideBy='Hide by:';
$LDPath='Path';
$LDVisible='Visible';
$LDFrameResizable='Frame is resizable';
$LDBorderColor='Border color';
$LDBorderWidth='Border width';
$LDFrameWidth='Frame width';
$LDNo='No';
$LDYes='Yes';
$LDAllowMultiLang='Allow multiple language choice';
$LDDefaultLang='Default language (if multi-language is not allowed)';
/* 2003-02-22 EL*/
$LDMainMenuItems='Main menu items';
$LDMainMenuDisplay='Main menu display';
$LDDataEntryForms='Data entry forms';
$LDControlButImg='Control buttons & images';
$LDSampleButtons='Sample buttons';
$LDTheme='Theme';
$LDItem='Item';
/* 2003-02-26- EL*/
$LDDeptAdmin='Department Administration';
$LDNewDept='Create and configure new departments';
$LDShowDeptInfo ='Department Profiles';
$LDShowDeptInfoTxt='Display profile information of existing active departments';
$LDConfigOptions='Configuration options';
$LDDeptConfigOptions='Configuration, update info, deactivate, activate, hide and unhide departments';
$LDDescription='Description';
/* 2003-023-01 EL*/
$LDFormalName='Formal Name';
$LDInternalID='Internal ID Code';
$LDPlsSelect='Please select one';
$LDTypeDept='Type of Department';
$LDIsSubDept='Is this a sub-department ?';
$LDParentDept='Parent Department';
$LDLangVariable='Language variable';
$LDShortName='Short Name';
$LDAlternateName='Alternate Name';
$LDAdmitsOutpatients='Admits outpatients ?';
$LDAdmitsInpatients='Admits inpatients ?';
$LDBelongsToInst='Belongs to this institution ?';
$LDWorkHrs='Working hours';
$LDConsultationHrs='Consultation Hours';
$LDSigLine='Signature Line';
$LDSigStampTxt='Signature Stamp Text';
$LDDeptLogo='Department\'s Logo';
$LDHidden='Hidden';
$LDNormal='Normal';
$LDInactive='Inactive';
$LDActive='Active';
$LDDeptStatus='Department\'s status';
$LDRecordStatus='Record\'s status';
/* 2003-03-30 EL*/
$LDConfigOptions='Configuration Options';
$LDDoesSurgeryOp='Does operative surgery?';
$LDList='List';
$LDUpdate='Update';
# 2003-08-03 EL
$LDFindEmployee='Find an employee';
#2003-10-27 EL
$LDMainMenu='Main menu';
$LDHideShow='Hide/show';
$LDSortOrder='sort order';
$LDAdminIndex='Admin index';
$LDUsers='Users';
$LDCreateEditLock='Create, edit, lock';
$LDDatabase='Database';
$LDPhpMyAdmin='PhpMyAdmin';
$LDGeneral='General';
$LDQuickInformer='Quick informer';
$LDEnterInfo='Please edit or enter the information. Then click "Save".';
$LDPaginatorMaxRows='Paginator max rows';

#2003-10-28 EL
$LDAddressList='Address list';
$LDAddressListTxt='When the address list is displayed in the  address manager module.';
$LDAddressSearch='Address search';
$LDAddressSearchTxt='When the search for addresses returns a list';
$LDInsuranceList='Insurance companies list';
$LDInsuranceListTxt='When the insurance companies list is displayed in the insurance company module.';
$LDInsuranceSearch='Insurance search';
$LDInsuranceSearchTxt='When the search for insurance company returns a list.';
$LDPersonnelSearch='Employee search';
$LDPersonnelSearchTxt='When the search for an employee returns a list.';
$LDPersonnelList='Employee list';
$LDPersonnelListTxt='When the employees list is displayed in the personnel manager module.';
$LDPersonSearch='Person search';
$LDPersonSearchTxt='When the search for a person returns a list.';
$LDPatientSearch='Patient search';
$LDPatientSearchTxt='When the search for a patient returns a list.';
$LDORPatientSearch='Patient for operation search';
$LDORPatientSearchTxt='When the search for patient for operation returns a list. 
This value is usually less than 10 due to a narrow display space in the OR logbook module';
$LDEnterMaxRows='Please enter the maximum number rows displayed  per page after a successful search.';
#2003-11-01 EL
$LDTimeOut='Time out';
$LDTimeOutActive='Time out active';
$LDTimeOutTxt='Should the password protected modules time out (lock itself) after a set time of inactivity?';
$LDTimeOutTime='Elapsed time';
$LDTimeOutTimeTxt='Elapsed idle time (inactivity) that triggers the time out and locks the module. Note: 
If your entry is invalid, the system will use the default maximum values.';
#2003-11-09 EL
$LDGUI='GUI';
$LDNewsDisplay='News display';
$LDTitleFontSize='Title font size';
$LDTitleFontColor='Title font color';
$LDTitleFont='Title font';
$LDPrefaceFontSize='Lead summary font size';
$LDPrefaceFontColor='Lead summary font color';
$LDPrefaceFont='Lead summary font';
$LDBodyFontSize='News body font size';
$LDBodyFontColor='News body font color';
$LDBodyFont='News body font';
$LDPreviewMaxlen='News preview maximum characters';
$LDTitleFontBold='Title font weight';
$LDPrefaceFontBold='Lead summary font weight';
$LDDisplayWidth='News display width (in pixel or %)';
$LDBold='Bold';
$LDNoteDefault='Note: If you enter an invalid value, the system will just replace it with the default value.';
$LDUseDefault='Use default values';
$LDClkPickColor='Click here to pick up the color';
#2003-11-11 EL
$LDORAdmin='OR administration';
$LDListConfig='List & configure';
$LDOR='OR';
$LDORNr='OR number';
$LDTempClosed='Is temporary closed?';
$LDOwnerWard='Owner ward';
$LDOwnerDept='Owner department';
$LDDateCreation='Date of creation';
$LDDateClose='Date of closure';
$LDOPTableNr='Number of OP table';
$LDORName='OR room name';
$LDORNrExists='OR room number already exists!';
$LDToggle='Toggle';
$LDChange='Change';
$LDClkNextNr='Click to use next available number';
$LDOPTable='OP table';
?>
