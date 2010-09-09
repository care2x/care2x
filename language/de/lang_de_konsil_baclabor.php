<?php
//error_reporting(E_ALL);

$LDInitFindings='Vorbefund';
$LDCurrentFindings='Zwischenbefund';
$LDFinalFindings='Endbefund';

$LDFillLabOnly='Nur vom Labor auszufüllen';
$LDLEN='LDN';  /* Lab entry number */

$LDDate='Datum';
$LDEye='Augen';
$LDBac_1='Keim 1';
$LDBac_2='Keim 2';
$LDBac_3='Keim 3';
$LDBac_I='Keim I';
$LDBac_II='Keim II';
$LDBac_III='Keim III';
$LDFungi='Pilze';
$LDResistanceTestAnaerob='Resistenzbest. Anaerobier';				
$LDResistanceTestAerob='Resistenzbestimmung Aerobier';
$LDTestFindings='Untersuchungsergebnis';
$LDMarkStreptocResistance='bei Streptokokkenresistenz markieren';
$LDBlockerNeg='Hemmstoff negativ';
$LDBlockerPos='Hemmstoff positiv';
$LDBacNr_GT='Keimzahl>10^5';
$LDBacNr_LT='Keimzahl<10^5';
$LDBacNrNeg='Keimz. neg';
$LDSMR=array('S','M','R');


/* 2002-09-19 EL */
$LDBAC=array('Keim I', 'Keim II', 'Keim III');

$lab_TestType = array('_lab_culture_aerob_' => 'K.aer.',
								 '_lab_subcult_aerob_1_' => 'S.aer.',
								 '_lab_subcult_aerob_2_' => 'S.aer.',
								 '_lab_subcult_aerob_3_' => 'S.aer.',
								 '_lab_subcult_aerob_4_' => 'S.aer.',
								 '_lab_subcult_aerob_5_' => 'S.aer.',
								 '_lab_optochin_1_' => 'OPTCN',
								 '_lab_cooked_blood_1_' => 'K-blut',
								 '_lab_bacitracin_1_' => 'BCTCN',
								 '_lab_campylocbacter_1_' => 'CPBTR',
								 
                                 '_lab_culture_anaerob_' => 'K.ana',
								 '_lab_subcult_anaerob_' => 'S.ana.',
								 '_lab_subcult_anaerob_2_' => 'S.ana.',
								 '_lab_subcult_anaerob_3_' => 'S.ana.',
								 '_lab_subcult_anaerob_4_' => 'S.ana.',
								 '_lab_subcult_anaerob_5_' => 'S.ana.',
								 '_lab_optochin_2_' => 'OPTCN',
								 '_lab_cooked_blood_2_' => 'K-blut',
								 '_lab_bacitracin_2_' => 'BCTCN',
								 '_lab_campylocbacter_2_' => 'CPBTR',
								 
								 '_lab_culture_fungal_1_' => 'Pilzk.',
								 '_lab_culture_fungal_2_' => 'Pilzk.',
								 '_lab_bac_tube_1_' => 'Keimsc.',
								 '_lab_bac_tube_2_' => 'Keimsc.',
								 '_lab_api_candida_1_' => 'API.Cdd',
								 '_lab_api_candida_2_' => 'API.Cdd',
								 '_lab_special_fungi_1_' => 's.Pilze',
								 '_lab_special_fungi_2_' => 's.Pilze',
								 '_lab_candida_id_1_' => 'Cdd-ID',
								 '_lab_candida_id_2_' => 'Cdd-ID',
								 
								 '_lab_culture_stool_' => 'Stuhlk.',
								 '_lab_culture_blood_' => 'Blutk.',
								 '_lab_liquor_cult_vial' => 'Liq.KF',
								 '_lab_laal_' => 'LAAL',
								 '_lab_own_blood_' => 'E-blut',
								 '_extra_1_' => ' ',
								 '_extra_2_' => ' ',
								 '_extra_3_' => ' ',
								 '_lab_kligler_' => 'Kliglr',
								 '_extra_4_' => ' ',
							 
								 '_lab_agglut_1x_1_' => 'Ag.1x',
								 '_lab_agglut_1x_2_' => 'Ag.1x',
								 '_lab_aggult_1x_3_' => 'Ag.1x',
								 '_lab_agglut_4x_' => 'Ag.4x',
								 '_lab_agglut_8x_' => 'Ag.8x',
								 '_lab_agglut_str_pneu_1_' => 'ASP 1',
								 '_lab_agglut_str_pneu_2_' => 'ASP 2',
								 '_lab_agglut_dyspepsy_' => 'Ag.Dys.',
								 '_lab_ehec_' => 'EHEC',
								 '_lab_mobility_' => 'BWGKT',
								 
								 '_lab_methylen_blue' => 'M-blau',
								 '_lab_acrid_orange_' => 'A.oran.',
								 '_lab_ziehl_neelsen_' => 'Z-Neel.',
								 '_lab_koh_' => 'KOH',
								 '_lab_novobiocin_1_' => 'NBCN.1',
								 '_lab_novobiocin_2_' => 'NBCN.2',
								 '_extra_5_' => ' ',
								 '_extra_6_' => ' ',
								 '_extra_7_' => ' ',
								 '_extra_8_' => ' ',
								 
								 '_lab_streptex_1_' => 'STPX.1',
								 '_lab_plasma_coag_1_' => 'PK.1',
								 '_lab_catalase_1_' => 'KTLS.1',
								 '_lab_indol_1_' => 'Ndol.1',
								 '_lab_oxidase_1_' => 'OXDS.1',
								 '_lab_enterotube_1_' => 'ENTB.1',
								 '_lab_bbl_1_' => 'BBL 1',
								 '_lab_api_1_' => 'API 1',
								 '_lab_api_anaerob_1_' => 'APIa.1',
								 '_lab_gram_dye_1_' => 'Gram.1',
								 
								 '_lab_streptex_2_' => 'STPX.2',
								 '_lab_plasma_coag_2_' => 'PK.2',
								 '_lab_catalase_2_' => 'KTLS.2',
								 '_lab_indol_2_' => 'Ndol.2',
								 '_lab_oxidase_2_' => 'OXDS.2',
								 '_lab_enterotube_2_' => 'ENTB.2',
								 '_lab_bbl_2_' => 'BBL 2',
								 '_lab_api_2_' => 'API 2',
								 '_lab_api_anaerob_2_' => 'APIa.2',
								 '_lab_gram_dye_2_' => 'Gram.2',
								 
								 
								 '_lab_streptex_3_' => 'STPX.3',
								 '_lab_plasma_coag_3_' => 'PK.3',
								 '_lab_catalase_3_' => 'KTLS.3',
								 '_lab_indol_3_' => 'Ndol.3',
								 '_lab_oxidase_3_' => 'OXDS.3',
								 '_lab_enterotube_3_' => 'ENTB.3',
								 '_lab_bbl_3_' => 'BBL 3',
								 '_lab_api_3_' => 'API 3',
								 '_lab_api_anaerob_3_' => 'APIa.3',
								 '_lab_gram_dye_3_' => 'Gram.3'
								 );


$lab_ResistANaerobAcro=array('PEN','AMO','AMC','MZL','PIC','IMI','CTX','CMP','TET','CLI','MTR','ERY','TEC','VAN','');
										
$lab_ResistAerobAcro=array('P','AMX','AMC','CC','MZ','PIP','GM','AN','CZ',
                                           'CXM','CRO','MER','OFX','SXT','U','AZ',
										   'VA','NN','IPM','CTX','CAZ','FEP','TEC',
										   'FF','25','E','OX','CIP','CFS','30','31','�Lac.');
										   
$lab_ResistAerobExtra=array('AB','MIC','NY','AC','KET','6','','',
                                            'C','NE','GM','D','OFX','K','','',
											'C','NE','GM','D','OFX','K','','',
											'C','NE','GM','D','OFX','K');

$lab_TestResultId_1=array('Staph.aureus', 'E.coli', 'enterob.aerogenes',
                                     'Staph.epiderm', 'E.coli h�m.', 'Morganel.morganii',
									 'Streptokokk.', 'E.coli muc.', 'H�mophilus spezies',
									 'h�m.Streptok.', 'Proteus', 'Salmonella',
									 'verg.Streptok.', 'Proteus indol pos.', 'Shigella',
									 'Gruppe A', 'Proteus indol neg.', 'aerob.Sporenbildnr',
									 'Gruppe B', 'Pseudomonas', 'apath.Coryne',
									 'Gruppe C', 'Ps.aeruginosa', 'Bakter.frag.',
									 'Gruppe D', 'Klebsiella spezies', 'Prevotella',
									 'Gruppe F', 'Enterob.cloacae', 'Candida albic.',
									 'Gruppe G', 'Enterob.agglomerans', 'Candid.spezies',
									 'Paketkokken', 'Citrobakt.freundii', 'Candid.tropicalis',
									 'Neiss.spezies', 'Klebs.pneumon.', 'Candid.glabr.',
									 'selt.Keim', 'Klebs.oxytoca', 'Aspergillus',
									 'selt.Keim', 'Campylobactr', 'Salmon.enteritid.',
									 'Acinetob.Iwoffi', 'Hafnia alvei', 'Lactobacil.spez.',
									 'Acinetob. Baumannii', 'Serrat.liquefac.', 'Stentrop.maltophl.');
									 

$lab_TestResultId_2 = array('Kein Wachstum nach 48 Stunden', 'Wachstum wie aerob', 'Stuhl auf Am�ben negativ',
                                           'Kein Wachstum nach 5 Tagen', '' , 'Stuhl auf Lambien negativ',
										   'Kein Wachstum nach 9 Tagen', 'Intrazell.gram.neg.Diplok.nNW.', 'Stuhl auf Wurmeier negativ',
										   'Keine Keime der TPE-Gruppe', 'GO-Kultur negativ', 'Kein Wachstum von E.Coli',
										   'Campylobacter-Kultur negativ', '', 'Liquorantigen.NW.negativ',
										   'KW.v.Campylobactr.pylori', 'mikroskop.s�uref.St�bchn.nNW.', 'EHEC negativ',
										   'Dyspepsie-Coli serolg.nNW.', 'Kein Wachstum nach 7 Tagen', '',
										   'vereinzelt Spro�pilze NW.', '' ,'',
										   'Pilzkultur negativ', '', '',
										   'Kokkenmischflora', '', '',
										   'Kokken-St�bchen-Mischflora','', '',
										   'Mikroskopisch Bakterien nNW.', '', '',
										   'KW.v.oxacil.resist.Staphylok.', '', '');
										   

									  
								  
									   									 
