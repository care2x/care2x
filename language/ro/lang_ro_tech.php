<?php
/**
* IMPORTANT NOTICE: Do not replace the words or characters enclosed in ~ ~ .
*/
$LDClose='Inchide';
$LDTech='Technic';
$LDTechRepair='Reparatie';
$LDTechMaint='Intretinere';
$LDTechSupport='Suport tehnic';
$LDTechInfo='Informatii tehnice';

$LDReRepair='Cerere interventie/ajutor';
$LDReRepairTxt='Raport reparatie, creare si trimitere cerere interventie';
#'Report damage, compose & send request for a repair service.';
$LDRepabotActivate='Activare Repabot';
$LDRepabotActivateTxt='Sistem de receptie automata a cererilor de interventie';
#'A robot for automatic reception of repair job requests.';
$LDRepairReport='Raport reparatie';
$LDRepairReportTxt='Report final reparatie.';
$LDReportsArchive='Arhiva repoarte';
$LDReportsArchiveTxt='Cautare in arhiva repoarte tehnice';
#'Research in the technical reports archives';
$LDQuestions='Cereri , Intrebari';
#'Inquiry, Questions';
$LDQuestionsTxt='Creare, citire, trimitere cereri si intrebari';
#'Compose, read, and send questions or inquiries';
$LDQBotActivate='Activare Q-Bot';
$LDQBotActivateTxt='Sistem de receptie automata a cererilor de interventie';
#'A robot for automatic reception of question or inquiries.';
$LDInfo='Informatii';
$LDInfoTxt='Cautare informatii tehnice';
#'Browse for information of technical nature.';
$LDSendRequest='Trimite cerere';
$LDSendReport='Trimite raport';
$LDSendInquiry='Trimite intrebare';
$LDReset='Reset';
$LDRepairArea='Localizarea defectului';
#'Localization of the damage';
$LDReporter='Cerut de';
$LDPersonnelNr='ID persoana';
$LDPhoneNr='Nr telefon <font size=1>(pentru eventuale lamuriri)</font>';
$LDPlsDescribe='Descrieti natura defectului';

$LDAlertName='Numele dvs. va rog.';
$LDAlertDept='Introduceti va rog departamentul sau localizarea defectului';
#'Please enter your department or localisation of the damage.';
$LDAlertDeptOnly='Departamentul dvs. va rog.';
$LDAlertPNr='ID-ul dvs. va rog.';
#'Please enter your personnel number.';
$LDAck='Aprobare';
#'Acknowledgement';
$LDYour='Al dvs.';
$LDReceived='a fost primit pe';
#'was received on';
$LDAt='la';
$LDAtTech='. Multumesc. <i>Al dvs.</i>';
$LDRequest='cerere';
$LDReport='raport';
$LDThanksSir='Multumesc Domnule/Doamna';
$LDPlsTypeReport='Descrieti va rog rteparatia efectuata';
#'Please describe the repair job you have done.';
$LDJobIdNr='Fisa nr.';
$LDTechnician='Tehnician';
$LDPlsDoneOnly='(Raportati va rog NUMAI dupa terminarea reparatiei';
#'(Please report only finished repair jobs.)';
$LDName='Nume';
$LDDept='Departament';
$LDEnterQuestion='Scrieti intrebarea va rog';
#'Please type your question';
$LDLogIn='Acces';
$LDPlsNoRequest='(Nu faceti dereri de reparatii aici. Daca vreti sa raportati o defectiune, va rog apasati aici.';
#'(Do not type requests for repair here. If you want to report a damage and need a repair pls click this.';
$LDLastQuestions='Ultima(ele) ~tagword~ intrebare(i) sau raspuns(uri)';
$LDFrom='de la';
$LDTo='la';
$LDAlertQuestion='Nu ati intrebat nimic.';
$LDOn='pe';
$LDOClock='fix';
$LDInquiry='Cerere';
$LDReply='Raspuns (reply)';
$LDSearch='CAUTARE';
$LDSearchReport='Cautare rapoarte';
$LDDate='Data';
$LDReportListMany='Urmeaza rapoartele';
$LDNotReadMany=' nu a fost inca citit sau tiparit.';
#' that have not been read or printed yet.'; 
$LDReportList='Urmeaza raportul';
#'Following is the report';
$LDNotRead=' nu a fost inca citit sau tiparit.';
#' that has not been read or printed yet.';
$LDClk2Read='Apasati butonul sageata pentru a citi continutul';
#'Click the arrow button to read the content.';
$LDLikeSearch=' care corespunde cheilor de cautare';
#' that corresponds to the search keywords.';
$LDLikeSearchMany=' care corespunde cheilor de cautare';
#' that correspond to the search keywords.';

$LDTelephoneNr='Nr. tel.';

$bcatindex=array('&nbsp;','&nbsp;',$LDTechnician,$LDDept,'Primit pe',$LDAt,'&nbsp;');
$blistindex=array("Report $LDFrom",$LDOn,$LDAt,$LDDept,$LDJobIdNr);
$reportindex=array('&nbsp;','&nbsp;',"$LDRequest $LDFrom:",'Primit la:',$LDAt,'&nbsp;');
$requestindex=array("$LDRequest $LDFrom:",$LDAt,$LDOn,$LDDept,$LDTelephoneNr,$LDJobIdNr);
$queryindex=array('&nbsp;','&nbsp;',"$LDInquiry $LDFrom:",$LDDept,'Primit $LDOn:',$LDAt,'&nbsp;');

$LDMarkRead='Marcat ca \'Citit\'.';
$LDPrint='Listare';
$LDGoBack='Inapoi';
$LDImRepabot='Sunt repabot';
$LDImQBot='Sunt Q-Bot';
$LDNewReport='Urmatoarea este noua cerere de reparatie';
#'The following is the newly arrived request for repair.';
$LDNewReportMany='Urmatoarele sunt noile cereri de reparatie';
#'The following are the newly arrived requests for repair.';
$LDReportArrived='Ati primit o cerere de reparatie';
#'A request for repair has arrived!';
$LDShowRequest='Arata cererea';
$LDNoDataFound='Nu s-au gasit date. Undeva a aparut o eroare. Apasati va rog butonul [Inchidere] si incercati sa deschideti din nou lista de cereri. Daca eroarea persista, informati va rog departamentul tehnic';
#'No data found. An error occured somewhere. Please click the [Close] button and try to open the list of requests again.
#If this problem persists despite several attempts, please inform the EDP and the Tech support departments.';
$LDAckPrint='Acceptare si listare cerere';
#'Acknowledge and print request';
$LDPrintRequest='Listare cerere';
$LDArchiveRequest='Arhiveaza cererea';
$LDAckBy='Acceptat de';
$LDAlertEnterName='Introduceti va rog numele in campul [Acceptat de].';
#'Please enter your name in the field [Acknowledged by].';
$LDYourReply='Raspunsul dvs.';
$LDNewInquiry='Ultima intrebare sosita';
#'The following is the newly arrived inquiry.';
$LDNewInquiryMany='Ultimele intrebari sosite';
#'The following are the newly arrived inquiries.';
$LDClk2Reply='Apasati butonul cu sageata pentru a citi si/sau raspunde';
#'Click the arrow button to read and/or reply';
$LDSendReply='Trimite raspuns';
$LDMove2Archive='Muta in arhive';
$LDShow='Arata';
$LDShowInquiry='Arata intrebare';
$LDInquiryArrived='A sosit o noua intrebare!';
$LDSearchWordPrompt='Introduceti cheia de cautare';
$LDInfoCat=array(
						'Cerere de reparare',
						'Raport avarie',
						'Incalzire',
						'Reziduri',
						'EDP',
						'Adresa IP a calc.',
						'Listare, Imprimanta',
						'Servicii de mediu si conducere, Intretinere',
						'Curatenie',
						'Electricitate',
						'Sistemul telefonic',
						'Apa, Auxiliare'
						);
$LDNoFound='Nu am gasit nimic corespunzator cheii de cautare. <br>Incercati va rog din nou introducand mai multa informatie.';
#'I found nothing that corresponds to the search keyword. <br>Please try it again and enter some more information.';
/* 2003-02-11*/
$LDCancel='Abandon';
?>
