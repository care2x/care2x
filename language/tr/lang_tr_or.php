<?php
$LDOr='Ameliyathane';
$LDLOGBOOK='G�NL�K';
$LDOrDocument='Ameliyathane Kay�tlar�';
$LDOrDocumentTxt='Ameliyat hizmetlerinin belgelendirilmesi';

/**
*  A tiny dictionary:
*  DOC = doctor on call duty
*  ORNOC = Operating room nurse on call duty
*  OP Room = operating room (surgery room)
*/
$LDDOC='N�bet�i doktor';
$LDORNOC='N�bet�i hem�ire';
$LDScheduler='N�bet planlama';

$LDQuickView='H�zl� bak��';
$LDQviewTxtDocs='Bug�nk� n�bet�i doktor listesine h�zl� bak��';
$LDOrLogBook='Ameliyathane hem�ire g�nl���';
$LDOrLogBookTxt='Ameliyathane hem�irelik hizmetlerinin belgelendirilmesi, ar�iv dosyalar�';
$LDOrProgram='Ameliyathane program�';
$LDOrProgramTxt='Bir ameliyathane program�n� g�r�nt�leme, d�zeltme, olu�turma, vs.';
$LDQviewTxtNurse='Bug�nk� hem�irelerin icap n�betine h�zl� bak��';
$LDDutyPlanTxt='Ameliyathane n�bet�i hem�ire g�r�nt�leme, d�zeltme, olu�turma';
$LDOnCallDuty='�cap n�beti';
$LDOnCallDutyTxt='N�betteki i�i belgelendirme';
$LDAnaLogBook='Anestezi g�nl���';
$LDAnaLogBookTxt='Anestezi hizmetlerini belgelendirme, ar�iv dosyalar�';
$LDQviewTxtAna='Bug�nk� anestezi teknisyen n�bet�ilerine h�zl� bak��';
$LDNewDocu='Yeni belge';
$LDSearch='Ara';
$LDArchive='Ar�iv';
$LDSee='Bak';
$LDUpdate='G�ncelle';
$LDCreate='Olu�tur';
$LDCreatePersonList='Ameliyathane hem�ire listesi olu�tur';
$LDDoctor='Hekim/Cerrah';
$LDNursing='Hem�irelik';
$LDAna='Anestezi';

$LDClose='Kapat';
$LDSave='Kaydet';
$LDCancel='�ptal';
$LDReset='Ba�a al';
$LDContinue='Devam...';

$LDHideCat='cati gizle';
$LDPatientsFound='Birka� hasta bulundu!';
$LDPlsClk1='L�tfen do�ru olan� t�klay�n�z.';
$LDShowCat='Cati g�rmek istiyorum l�tfen!';
$LDResearchArchive='Ar�ivlerde arama';
$LDSearchDocu='Bir belgeyi arama';

$LDMinor='K���k';
$LDMiddle='Orta';
$LDMajor='B�y�k';
$LDOperation='Ameliyat';

$LDLastName='Soyad';
$LDName='Ad';
$LDBday='Do�um tarihi';
$LDPatientNr='Hasta no.';
$LDMatchCode='Kod ad�';
$LDOpDate='Ameliyat tarihi';
$LDOperator='Cerrah';
$LDStationary='Yatan hasta';
$LDAmbulant='Ayaktan hasta';
$LDInsurance='Sigorta';
$LDPrivate='�zel sigorta';
$LDSelfPay='�cretli';

$LDDiagnosis='Tan�/ICD-10';
$LDLocalization='Yeri';
$LDTherapy='Tedavi';
$LDSpecials='�zel not';
$LDClassification='S�n�fland�rma';

/**
*  A tiny dictionary:
*  OP = operation (surgical operation)
*/
$LDOpStart='Ameliyata Ba�lama';
$LDOpEnd='Ameliyat Biti�i';
/**
*  A tiny dictionary:
*  Scrub nurse =  the nurse in sterile clothing assisting the surgeon, in charge of the sterile instruments and surgical materials
*/
$LDScrubNurse='Ameliyat hem�iresi';
$LDOpRoom='Ameliyathane';
$LDResetAll='T�m girilenleri sil';
$LDUpdateData='Verileri g�ncelle';
$LDStartNewDocu='Yeni bir belge olu�tur';
$LDSearchKeyword='Anahtar s�zc�k ara: �rne�in ad veya soyad';

$LDSrcListElements=array(
'',
'Soyad',
'Ad',
'Do�um tarihi',
'Hasta no.',
'Ameliyat tarihi',
'Ameliyat b�l�m�',
'Amel. No.'
);
$LDClk2Show='G�stermek i�in t�klay�n�z';
$LDSrcCondition='Anhtar s�zc�k ve/veya ko�ul ara';
$LDNewArchiveSearch='Yeni ar�iv arama';
$tage=array(
				'Pazar',
				'Pazartesi',
				'Sal�',
				'�ar�amba',
				'Per�embe',
				'Cuma',
				'Cumartesi');
$monat=array('',
				'Ocak',
				'�ubat',
				'Mart',
				'Nisan',
				'May�s',
				'Haziran',
				'Temmuz',
				'A�ustos',
				'Eyl�l',
				'Ekim',
				'Kas�m',
				'Aral�k');
$LDPrevDay='�nceki g�n';
$LDNextDay='Sonraki g�n';
$LDChange='De�i�tir';
$LDOpMainElements=array(
										nr_date=>'No/Tarih',
										patient=>'Hasta',
										diagnosis=>'Tan�',
										operator=>'Cerrah/Asistan',
										ana=>'Anestezi',
										cutclose=>'Kesi/S�t�r',
										therapy=>'Tedavi',
										result=>'Sonu�',
										inout=>'Giri�/��k��'
										);
$LDOpCut='Kesi';
$LDOpClose='S�t�r';
$LDOpIn='Giri�';
$LDOpOut='��k��';
$LDOpInFull='Giri�';
$LDOpOutFull='��k��';
$LDEditPatientData='~tagword~  g�nl�k verisini d�zenleme';
$LDOpenPatientFolder='~tagword~ hasta dosyas�n� a�ma';

$tbuf=array('O','A','H','P');
$cbuf=array('Operat�r','Asistan','Hem�ire','Personel');

/**
*  A tiny dictionary:
*  rotating nurse =  the nurse in non-sterile clothing assisting the scrub nurse, in charge of the non-sterile instruments and surgical materials
*/
$LDOpPersonElements=array(
											operator=>'Cerrah',
											assist=>'Asistan',
											scrub=>'Hem�ire',
											rotating=>'Personel',
											ana=>'Anestezist'
											);

$LDPatientNotFound='Hasta bulunamad�!';
$LDPlsEnoughData='L�tfen yeterli bilgi giriniz.';
$LDOpNr='Amel. no.';
$LDDate='Tarih';
$LDClk2DropMenu='Men�y� a�mak i�in t�klay�n�z';
$LDSaveLatest='Son girilenleri kaydet';
$LDHelp='Yard�m penceresini a�';

$LDSearchPatient='Hasta arama';
$LDUsedMaterial='Kullan�lan ameliyat malzemeleri';
$LDContainer='Kullan�lm�� kaplar/aletler';
$LDDRG='DRG';
$LDShowLogbook='G�nl��� g�ster';

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
					'Standby'=>'�cap'
					);

$LDAnaDoc='Anestezist';
$LDAnaPrefix='AN';
$LDEnterPerson='Yeni bir ~tagword~ giriniz';
$LDExtraInfo='Ek bilgi';
$LDFrom='den';
$LDTo='ye';
$LDFunction='��lev';
$LDCurrentEntries='�u an girilmi� olanlar';
$LDDeleteEntry='Girileni sil';
$LDSearchNewPerson='Yeni bir ~tagword~ ara';
$LDSorryNotFound='�zg�n�m. hi�bir �ey bulamad�m. L�tfen farkl� bir anahtar s�zc�k deneyiniz.';
$LDSearchPerson=' ~tagword~ ara';
$LDJobId='Meslek';
$LDSearchResult='Arama sonu�lar�';
$LDUseData='Bu ki�iyi  ~tagword~ olarak giriniz';
$LDJobIdTag=array(
						nurse=>'Hem�ire',
						doctor=>'Hekim/Cerrah'
						);
$LDQuickSelectList='H�zl� se�me listesi';
$LDTimes='Zaman';
$LDPlasterCast='Al��';
/**
*  Reposition = repositioning of bone dislocation or fracture
*/
$LDReposition='Repozisyon';
$LDWaitTime='Bo� zaman';
$LDStart='Ba�lang��';
$LDEnd='Biti�';
$LDPatNoExist='Hasta heniz g�nl��e girmedi. L�tfen bu pencereyi kapat�n�z ve en ba�tan ba�lay�n�z. Sorun s�rer ise bilgi i�lem b�l�m�ne haber veriniz.';
$opts=array('-',
					'Hasta ameliyathaneye ge� geldi',
       				'Anestezistler ameliyathaneye ge� geldi',
       				'Ameliyat hem�ireleri ameliyathaneye ge� geldi', 
					'Temizlik ekibi ge� bitirdi',
       				'�zel sebep');
$LDReason='Sebep';
$LDMaterialElements=array(
									'Eniyi.no.',
    								'Malz.ismi',
    								'&nbsp;',
    								'Jenerik',
    								'Lisans.No.',
    								'No.Pcs.',
    								'&nbsp;'
									);
$LDSearchElements=array(
									'&nbsp;',
									'Malz.no.',
    								'Malz.ismi',
    								'Tan�m�',
 									'&nbsp;',
   									'Jenerik',
    								'Lisans.No.'
									);
$LDContainerElements=array(
									'Ambalaj no.',
    								'�smi/Tan�m�',
									'&nbsp;',
    								'End�stri no.',
    								'Sipari� no.',
    								'No.pcs.',
    								'&nbsp;'
									);
$LDArticleNr='Malzeme no.';			
$LDContainerNr='Ambalaj no.';							
$LDArticleNotFound='Malzeme bulunamad�!';
$LDNoArticleTxt='Malzeme ya veritaban�nda yok ya da numaras�n� yanl�� yazd�n�z.';
$LDClk2ManualEntry='Malzemeyi el ile girmek i�in l�tfen , <b>buray� t�klay�n�z.</b>';
$LDPlsClkArticle='L�tfen istenilen malzemeyi t�klay�n�z!';
$LDSelectArticle='Bu malzemeyi se�mek i�in t�klay�n�z';
$LDDbInfo='Veritaban�ndan bilgiler';
$LDRemoveArticle='Malzemeyi bu listeden ��kar';
$LDArticleNoList='Malzeme veritaban�nda yer alm�yor';
$LDPromptSearch='L�tfen aranacak bir anahtar s�zc�k giriniz.<br>Ad, soyad, do�um tarihi, vs, gibi	("Yard�m"a da bak�n�z)';
$LDKeyword='Anahtar s�zc�k';
$LDOtherFunctions='Di�er i�levler';
$LDInfoNotFound='�stenilen bilgi bulunamad�!';
$LDButFf='Fakat izleyen ';
$LDSimilar=' veri';
$LDSimilarMany=' veriler';
$LDNeededInfo=' Aranan anahtar s�zc��e benzer.';
$LDPatLogbook='Hasta izleyen g�nl�kte belgelendirilmi�.';
$LDPatLogbookMany='Hasta izleyen kay�t k�t�klerinde belgelendirilmi�.';
$LDDepartment='B�l�m';
$LDRoom='Oda';
$LDLastEntry='�zleyen kay�t g�nl���n son kayd�d�r';
$LDLastEntryMany='�zleyen kay�tlar g�nl�kteki son kay�tlard�r';
$LDFrom='den';
$LDFromMany='den';
$LDYesterday='d�n';
$LDVorYesterday='2 g�n �nce';
$LDDays='g�n �nce';
$LDChangeDept='B�l�m veya ameliyathaneyi de�i�tir';

$LDTabElements=array('Ameliyathane b�l�m�',
								 '�cap��',
								 '�a�r�/Telefon',
								 'N�bet�i',
								 '�a�r�/telefon',
								 'N�bet plan�'
								 );
$LDStandbyPerson='�cap��';
$LDOnCallPerson='N�bet�i';
$LDMonth='Ay';
$LDYear='Y�l';
$LDDutyElements = array('Tarih','&nbsp;','Soyad', 'Ad','den','ya','Ameliyathane','Tan� ve tedavi');
$LDPrint='Yazd�r';
$LDAlertNoPrinter='El ile yazd�rmal�s�n�z. Pencereyi sa� tu�la t�klay�n, sonra yazd�r � se�iniz.';
$LDAlertNotSavedYet='Son yazd�klar�n�z hen�z kaydedilmedi. �nce kaydetmek ister misiniz?';
$LDPhone='Telefon';
$LDBeeper='�a�r�';
$LDOn='�zerinde';
$LDNoPersonList='Personel listesi hen�z olu�turulmad� L�tfen �nce liste olu�turunuz.';
$LDNoEntryFound='Planda hi�bir kay�t bulunmad�!';
$LDShow='G�ster';
$LDShowPrevLog='�nceki k�t�k kay�tlar�n� g�ster';
$LDShowNextLog='Sonraki k�t�k kay�tlar�n� g�ster';
$LDShowGuideCal='Rehber takvimi g�ster';

$LDPerformance='Performans';
/* 2002-10-13 EL */
$LDPlsSelectPatientFirst='L�tfen �nce hastay� bulunuz.';
$LD_ddpMMpyyyy='gg.aa.yyyy';
$LD_yyyyhMMhdd='yyyy-aa-gg';
$LD_MMsddsyyyy='aa/gg/yyyy';
/* 2002-10-15 EL */
$LDStandbyInit='�'; /* S = �cap�� */
$LDOncallInit='N'; /* N = N�bet�i */
$LDDutyPlan='N�bet plan�';
/* 2003-03-18 EL */
$LDSearchInAllDepts='T�m b�l�mlerde arama';
$LDAddNurseToList='Listeye yeni bir hem�ire ekleme';
$LDNursesList='Hem�ire listesi';
/* 2003-03-19 EL */
$LDPlsSelectDept='L�tfen bir b�l�m se�iniz.';
$LDSelectORoomNr='...ve bir de ameliyathane.';
$LDAlertNoDeptSelected=$LDPlsSelectDept;
$LDAlertNoORSelected='L�tfen bir ameliyathane se�iniz!';
[?][>]