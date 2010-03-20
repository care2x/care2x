<?php
$LDOr='Ameliyathane';
$LDLOGBOOK='GÜNLÜK';
$LDOrDocument='Ameliyathane Kayýtlarý';
$LDOrDocumentTxt='Ameliyat hizmetlerinin belgelendirilmesi';

/**
*  A tiny dictionary:
*  DOC = doctor on call duty
*  ORNOC = Operating room nurse on call duty
*  OP Room = operating room (surgery room)
*/
$LDDOC='Nöbetçi doktor';
$LDORNOC='Nöbetçi hemþire';
$LDScheduler='Nöbet planlama';

$LDQuickView='Hýzlý bakýþ';
$LDQviewTxtDocs='Bugünkü nöbetçi doktor listesine hýzlý bakýþ';
$LDOrLogBook='Ameliyathane hemþire günlüðü';
$LDOrLogBookTxt='Ameliyathane hemþirelik hizmetlerinin belgelendirilmesi, arþiv dosyalarý';
$LDOrProgram='Ameliyathane programý';
$LDOrProgramTxt='Bir ameliyathane programýný görüntüleme, düzeltme, oluþturma, vs.';
$LDQviewTxtNurse='Bugünkü hemþirelerin icap nöbetine hýzlý bakýþ';
$LDDutyPlanTxt='Ameliyathane nöbetçi hemþire görüntüleme, düzeltme, oluþturma';
$LDOnCallDuty='Ýcap nöbeti';
$LDOnCallDutyTxt='Nöbetteki iþi belgelendirme';
$LDAnaLogBook='Anestezi günlüðü';
$LDAnaLogBookTxt='Anestezi hizmetlerini belgelendirme, arþiv dosyalarý';
$LDQviewTxtAna='Bugünkü anestezi teknisyen nöbetçilerine hýzlý bakýþ';
$LDNewDocu='Yeni belge';
$LDSearch='Ara';
$LDArchive='Arþiv';
$LDSee='Bak';
$LDUpdate='Güncelle';
$LDCreate='Oluþtur';
$LDCreatePersonList='Ameliyathane hemþire listesi oluþtur';
$LDDoctor='Hekim/Cerrah';
$LDNursing='Hemþirelik';
$LDAna='Anestezi';

$LDClose='Kapat';
$LDSave='Kaydet';
$LDCancel='Ýptal';
$LDReset='Baþa al';
$LDContinue='Devam...';

$LDHideCat='cati gizle';
$LDPatientsFound='Birkaç hasta bulundu!';
$LDPlsClk1='Lütfen doðru olaný týklayýnýz.';
$LDShowCat='Cati görmek istiyorum lütfen!';
$LDResearchArchive='Arþivlerde arama';
$LDSearchDocu='Bir belgeyi arama';

$LDMinor='Küçük';
$LDMiddle='Orta';
$LDMajor='Büyük';
$LDOperation='Ameliyat';

$LDLastName='Soyad';
$LDName='Ad';
$LDBday='Doðum tarihi';
$LDPatientNr='Hasta no.';
$LDMatchCode='Kod adý';
$LDOpDate='Ameliyat tarihi';
$LDOperator='Cerrah';
$LDStationary='Yatan hasta';
$LDAmbulant='Ayaktan hasta';
$LDInsurance='Sigorta';
$LDPrivate='Özel sigorta';
$LDSelfPay='Ücretli';

$LDDiagnosis='Taný/ICD-10';
$LDLocalization='Yeri';
$LDTherapy='Tedavi';
$LDSpecials='Özel not';
$LDClassification='Sýnýflandýrma';

/**
*  A tiny dictionary:
*  OP = operation (surgical operation)
*/
$LDOpStart='Ameliyata Baþlama';
$LDOpEnd='Ameliyat Bitiþi';
/**
*  A tiny dictionary:
*  Scrub nurse =  the nurse in sterile clothing assisting the surgeon, in charge of the sterile instruments and surgical materials
*/
$LDScrubNurse='Ameliyat hemþiresi';
$LDOpRoom='Ameliyathane';
$LDResetAll='Tüm girilenleri sil';
$LDUpdateData='Verileri güncelle';
$LDStartNewDocu='Yeni bir belge oluþtur';
$LDSearchKeyword='Anahtar sözcük ara: örneðin ad veya soyad';

$LDSrcListElements=array(
'',
'Soyad',
'Ad',
'Doðum tarihi',
'Hasta no.',
'Ameliyat tarihi',
'Ameliyat bölümü',
'Amel. No.'
);
$LDClk2Show='Göstermek için týklayýnýz';
$LDSrcCondition='Anhtar sözcük ve/veya koþul ara';
$LDNewArchiveSearch='Yeni arþiv arama';
$tage=array(
				'Pazar',
				'Pazartesi',
				'Salý',
				'Çarþamba',
				'Perþembe',
				'Cuma',
				'Cumartesi');
$monat=array('',
				'Ocak',
				'Þubat',
				'Mart',
				'Nisan',
				'Mayýs',
				'Haziran',
				'Temmuz',
				'Aðustos',
				'Eylül',
				'Ekim',
				'Kasým',
				'Aralýk');
$LDPrevDay='Önceki gün';
$LDNextDay='Sonraki gün';
$LDChange='Deðiþtir';
$LDOpMainElements=array(
										nr_date=>'No/Tarih',
										patient=>'Hasta',
										diagnosis=>'Taný',
										operator=>'Cerrah/Asistan',
										ana=>'Anestezi',
										cutclose=>'Kesi/Sütür',
										therapy=>'Tedavi',
										result=>'Sonuç',
										inout=>'Giriþ/Çýkýþ'
										);
$LDOpCut='Kesi';
$LDOpClose='Sütür';
$LDOpIn='Giriþ';
$LDOpOut='Çýkýþ';
$LDOpInFull='Giriþ';
$LDOpOutFull='Çýkýþ';
$LDEditPatientData='~tagword~  günlük verisini düzenleme';
$LDOpenPatientFolder='~tagword~ hasta dosyasýný açma';

$tbuf=array('O','A','H','P');
$cbuf=array('Operatör','Asistan','Hemþire','Personel');

/**
*  A tiny dictionary:
*  rotating nurse =  the nurse in non-sterile clothing assisting the scrub nurse, in charge of the non-sterile instruments and surgical materials
*/
$LDOpPersonElements=array(
											operator=>'Cerrah',
											assist=>'Asistan',
											scrub=>'Hemþire',
											rotating=>'Personel',
											ana=>'Anestezist'
											);

$LDPatientNotFound='Hasta bulunamadý!';
$LDPlsEnoughData='Lütfen yeterli bilgi giriniz.';
$LDOpNr='Amel. no.';
$LDDate='Tarih';
$LDClk2DropMenu='Menüyü açmak için týklayýnýz';
$LDSaveLatest='Son girilenleri kaydet';
$LDHelp='Yardým penceresini aç';

$LDSearchPatient='Hasta arama';
$LDUsedMaterial='Kullanýlan ameliyat malzemeleri';
$LDContainer='Kullanýlmýþ kaplar/aletler';
$LDDRG='DRG';
$LDShowLogbook='Günlüðü göster';

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
					'Standby'=>'Ýcap'
					);

$LDAnaDoc='Anestezist';
$LDAnaPrefix='AN';
$LDEnterPerson='Yeni bir ~tagword~ giriniz';
$LDExtraInfo='Ek bilgi';
$LDFrom='den';
$LDTo='ye';
$LDFunction='Ýþlev';
$LDCurrentEntries='Þu an girilmiþ olanlar';
$LDDeleteEntry='Girileni sil';
$LDSearchNewPerson='Yeni bir ~tagword~ ara';
$LDSorryNotFound='Üzgünüm. hiçbir þey bulamadým. Lütfen farklý bir anahtar sözcük deneyiniz.';
$LDSearchPerson=' ~tagword~ ara';
$LDJobId='Meslek';
$LDSearchResult='Arama sonuçlarý';
$LDUseData='Bu kiþiyi  ~tagword~ olarak giriniz';
$LDJobIdTag=array(
						nurse=>'Hemþire',
						doctor=>'Hekim/Cerrah'
						);
$LDQuickSelectList='Hýzlý seçme listesi';
$LDTimes='Zaman';
$LDPlasterCast='Alçý';
/**
*  Reposition = repositioning of bone dislocation or fracture
*/
$LDReposition='Repozisyon';
$LDWaitTime='Boþ zaman';
$LDStart='Baþlangýç';
$LDEnd='Bitiþ';
$LDPatNoExist='Hasta heniz günlüðe girmedi. Lütfen bu pencereyi kapatýnýz ve en baþtan baþlayýnýz. Sorun sürer ise bilgi iþlem bölümüne haber veriniz.';
$opts=array('-',
					'Hasta ameliyathaneye geç geldi',
       				'Anestezistler ameliyathaneye geç geldi',
       				'Ameliyat hemþireleri ameliyathaneye geç geldi', 
					'Temizlik ekibi geç bitirdi',
       				'Özel sebep');
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
    								'Tanýmý',
 									'&nbsp;',
   									'Jenerik',
    								'Lisans.No.'
									);
$LDContainerElements=array(
									'Ambalaj no.',
    								'Ýsmi/Tanýmý',
									'&nbsp;',
    								'Endüstri no.',
    								'Sipariþ no.',
    								'No.pcs.',
    								'&nbsp;'
									);
$LDArticleNr='Malzeme no.';			
$LDContainerNr='Ambalaj no.';							
$LDArticleNotFound='Malzeme bulunamadý!';
$LDNoArticleTxt='Malzeme ya veritabanýnda yok ya da numarasýný yanlýþ yazdýnýz.';
$LDClk2ManualEntry='Malzemeyi el ile girmek için lütfen , <b>burayý týklayýnýz.</b>';
$LDPlsClkArticle='Lütfen istenilen malzemeyi týklayýnýz!';
$LDSelectArticle='Bu malzemeyi seçmek için týklayýnýz';
$LDDbInfo='Veritabanýndan bilgiler';
$LDRemoveArticle='Malzemeyi bu listeden çýkar';
$LDArticleNoList='Malzeme veritabanýnda yer almýyor';
$LDPromptSearch='Lütfen aranacak bir anahtar sözcük giriniz.<br>Ad, soyad, doðum tarihi, vs, gibi	("Yardým"a da bakýnýz)';
$LDKeyword='Anahtar sözcük';
$LDOtherFunctions='Diðer iþlevler';
$LDInfoNotFound='Ýstenilen bilgi bulunamadý!';
$LDButFf='Fakat izleyen ';
$LDSimilar=' veri';
$LDSimilarMany=' veriler';
$LDNeededInfo=' Aranan anahtar sözcüðe benzer.';
$LDPatLogbook='Hasta izleyen günlükte belgelendirilmiþ.';
$LDPatLogbookMany='Hasta izleyen kayýt kütüklerinde belgelendirilmiþ.';
$LDDepartment='Bölüm';
$LDRoom='Oda';
$LDLastEntry='Ýzleyen kayýt günlüðün son kaydýdýr';
$LDLastEntryMany='Ýzleyen kayýtlar günlükteki son kayýtlardýr';
$LDFrom='den';
$LDFromMany='den';
$LDYesterday='dün';
$LDVorYesterday='2 gün önce';
$LDDays='gün önce';
$LDChangeDept='Bölüm veya ameliyathaneyi deðiþtir';

$LDTabElements=array('Ameliyathane bölümü',
								 'Ýcapçý',
								 'Çaðrý/Telefon',
								 'Nöbetçi',
								 'Çaðrý/telefon',
								 'Nöbet planý'
								 );
$LDStandbyPerson='Ýcapçý';
$LDOnCallPerson='Nöbetçi';
$LDMonth='Ay';
$LDYear='Yýl';
$LDDutyElements = array('Tarih','&nbsp;','Soyad', 'Ad','den','ya','Ameliyathane','Taný ve tedavi');
$LDPrint='Yazdýr';
$LDAlertNoPrinter='El ile yazdýrmalýsýnýz. Pencereyi sað tuþla týklayýn, sonra yazdýr ý seçiniz.';
$LDAlertNotSavedYet='Son yazdýklarýnýz henüz kaydedilmedi. Önce kaydetmek ister misiniz?';
$LDPhone='Telefon';
$LDBeeper='Çaðrý';
$LDOn='üzerinde';
$LDNoPersonList='Personel listesi henüz oluþturulmadý Lütfen önce liste oluþturunuz.';
$LDNoEntryFound='Planda hiçbir kayýt bulunmadý!';
$LDShow='Göster';
$LDShowPrevLog='Önceki kütük kayýtlarýný göster';
$LDShowNextLog='Sonraki kütük kayýtlarýný göster';
$LDShowGuideCal='Rehber takvimi göster';

$LDPerformance='Performans';
/* 2002-10-13 EL */
$LDPlsSelectPatientFirst='Lütfen önce hastayý bulunuz.';
$LD_ddpMMpyyyy='gg.aa.yyyy';
$LD_yyyyhMMhdd='yyyy-aa-gg';
$LD_MMsddsyyyy='aa/gg/yyyy';
/* 2002-10-15 EL */
$LDStandbyInit='Ý'; /* S = Ýcapçý */
$LDOncallInit='N'; /* N = Nöbetçi */
$LDDutyPlan='Nöbet planý';
/* 2003-03-18 EL */
$LDSearchInAllDepts='Tüm bölümlerde arama';
$LDAddNurseToList='Listeye yeni bir hemþire ekleme';
$LDNursesList='Hemþire listesi';
/* 2003-03-19 EL */
$LDPlsSelectDept='Lütfen bir bölüm seçiniz.';
$LDSelectORoomNr='...ve bir de ameliyathane.';
$LDAlertNoDeptSelected=$LDPlsSelectDept;
$LDAlertNoORSelected='Lütfen bir ameliyathane seçiniz!';
?>
