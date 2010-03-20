<?php

//error_reporting(E_ALL);
$LDInitFindings='Hallazgos iniciales';
$LDCurrentFindings='Hallazgos actuales';
$LDFinalFindings='Hallazgo definitivo';

$LDFillLabOnly='Solamente para uso del laboratorio';
$LDLEN='NRL';  /* Lab entry number: Número de registro de laboratorio */
$LDDate='Date';
$LDEye='Ojo';
$LDBac_1='Bact.1'; /* Nota: Bact. significa bacteria o patógeno */
$LDBac_2='Bact.2';
$LDBac_3='Bact.3';
$LDBac_I='Patóg.I';
$LDBac_II='Patóg.II';
$LDBac_III='Patóg.III';
$LDFungi='Hongo';
$LDResistanceTestAnaerob='Prueba de resistencia anaerobio';				
$LDResistanceTestAerob='Prueba de resistencia aerobio';
$LDTestFindings='Resultados/Hallazgos de las pruebas';
$LDMarkStreptocResistance='marcar resistencia a Streptococcus';
$LDBlockerNeg='Blocker negativo';
$LDBlockerPos='Blocker positivo';
$LDBacNr_GT='Cnt.Bact.>10^5';
$LDBacNr_LT='Cnt.Bact.<10^5';
$LDBacNrNeg='Cnt.Bact.neg';
$LDSMR=array('S','M','R');

/* 2002-09-19 EL */
$LDBAC=array('Patóg. I', 'Patóg. II', 'Patóg. III');

/* Note: the following arrays use strict medical terminology.
*  If you are not sure about their translation, please leave the 
*  english word untranslated
*/
$lab_TestType = array('_lab_culture_aerob_' => 'C.aer.',
								 '_lab_subcult_aerob_1_' => 'S.aer.',
								 '_lab_subcult_aerob_2_' => 'S.aer.',
								 '_lab_subcult_aerob_3_' => 'S.aer.',
								 '_lab_subcult_aerob_4_' => 'S.aer.',
								 '_lab_subcult_aerob_5_' => 'S.aer.',
								 '_lab_optochin_1_' => 'OPTOCHIN',
								 '_lab_cooked_blood_1_' => 'Sangre cocida',
								 '_lab_bacitracin_1_' => 'BACITRACINA',
								 '_lab_campylocbacter_1_' => 'CAMPYBCTR',
								 
                                 '_lab_culture_anaerob_' => 'C.ana',
								 '_lab_subcult_anaerob_' => 'S.ana.',
								 '_lab_subcult_anaerob_2_' => 'S.anaer.',
								 '_lab_subcult_anaerob_3_' => 'S.anaer.',
								 '_lab_subcult_anaerob_4_' => 'S.anaer.',
								 '_lab_subcult_anaerob_5_' => 'S.anaer.',
								 '_lab_optochin_2_' => 'OPTOCHIN',
								 '_lab_cooked_blood_2_' => 'Sangre cocida',
								 '_lab_bacitracin_2_' => 'BACITRACINA',
								 '_lab_campylocbacter_2_' => 'CAMPYBCTR',
								 
								 '_lab_culture_fungal_1_' => 'Cult.hongo',
								 '_lab_culture_fungal_2_' => 'Cult.hongo',
								 '_lab_bac_tube_1_' => 'Path.T.',
								 '_lab_bac_tube_2_' => 'Path.T.',
								 '_lab_api_candida_1_' => 'API.Candd',
								 '_lab_api_candida_2_' => 'API.Candd',
								 '_lab_special_fungi_1_' => 'Hongo.esp',
								 '_lab_special_fungi_2_' => 'Hongo.esp',
								 '_lab_candida_id_1_' => 'Candd-ID',
								 '_lab_candida_id_2_' => 'Candd-ID',
								 
								 '_lab_culture_stool_' => 'Cult.heces',
								 '_lab_culture_blood_' => 'Cult.sangr',
								 '_lab_liquor_cult_vial' => 'KF.LCR (por confirmar término)',
								 '_lab_laal_' => 'LAAL',
								 '_lab_own_blood_' => 'Sangre propia',
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
								 '_lab_mobility_' => 'MOVILIDAD',
								 
								 '_lab_methylen_blue' => 'Azul metil',
								 '_lab_acrid_orange_' => 'Acr.naranja.',
								 '_lab_ziehl_neelsen_' => 'Ziel-Neel.',
								 '_lab_koh_' => 'KOH',
								 '_lab_novobiocin_1_' => 'NOVOBCN.1',
								 '_lab_novobiocin_2_' => 'NOVOBCN.2',
								 '_extra_5_' => ' ',
								 '_extra_6_' => ' ',
								 '_extra_7_' => ' ',
								 '_extra_8_' => ' ',
								 
								 '_lab_streptex_1_' => 'STPX.1',
								 '_lab_plasma_coag_1_' => 'PK.1',
								 '_lab_catalase_1_' => 'CTLS.1',
								 '_lab_indol_1_' => 'Ndol.1',
								 '_lab_oxidase_1_' => 'OXDS.1',
								 '_lab_enterotube_1_' => 'ENTB.1',
								 '_lab_bbl_1_' => 'BBL 1',
								 '_lab_api_1_' => 'API 1',
								 '_lab_api_anaerob_1_' => 'APIa.1',
								 '_lab_gram_dye_1_' => 'Gram.1',
								 
								 '_lab_streptex_2_' => 'STPX.2',
								 '_lab_plasma_coag_2_' => 'PK.2',
								 '_lab_catalase_2_' => 'CTLS.2',
								 '_lab_indol_2_' => 'Ndol.2',
								 '_lab_oxidase_2_' => 'OXDS.2',
								 '_lab_enterotube_2_' => 'ENTB.2',
								 '_lab_bbl_2_' => 'BBL 2',
								 '_lab_api_2_' => 'API 2',
								 '_lab_api_anaerob_2_' => 'APIa.2',
								 '_lab_gram_dye_2_' => 'Gram.2',
								 
								 
								 '_lab_streptex_3_' => 'STPX.3',
								 '_lab_plasma_coag_3_' => 'PK.3',
								 '_lab_catalase_3_' => 'CTLS.3',
								 '_lab_indol_3_' => 'Ndol.3',
								 '_lab_oxidase_3_' => 'OXDS.3',
								 '_lab_enterotube_3_' => 'ENTB.3',
								 '_lab_bbl_3_' => 'BBL 3',
								 '_lab_api_3_' => 'API 3',
								 '_lab_api_anaerob_3_' => 'APIa.3',
								 '_lab_gram_dye_3_' => 'Gram.3'
								 );

/*$lab_TestType = array('_lab_culture_aerob_' => 'Cultivo aerob',
								 '_lab_subcult_aerob_1_' => 'Subcultivo aerob',
								 '_lab_subcult_aerob_2_' => 'Subcultivo aerob',
								 '_lab_subcult_aerob_3_' => 'Subcultivo aerob',
								 '_lab_subcult_aerob_4_' => 'Subcultivo aerob',
								 '_lab_subcult_aerob_5_' => 'Subcultivo aerob',
								 '_lab_optochin_1_' => 'Optochin',
								 '_lab_cooked_blood_1_' => 'Sangre cocida',
								 '_lab_bacitracin_1_' => 'Bacitracina',
								 '_lab_campylocbacter_1_' => 'Campylobacter',
								 
                                 '_lab_culture_anaerob_' => 'Kultur anaerob',
								 '_lab_subcult_anaerob_' => 'Subcultivo anaerob',
								 '_lab_subcult_anaerob_2_' => 'Subcultivo anaerob',
								 '_lab_subcult_anaerob_3_' => 'Subcultivo anaerob',
								 '_lab_subcult_anaerob_4_' => 'Subcultivo anaerob',
								 '_lab_subcult_anaerob_5_' => 'Subcultivo anaerob',
								 '_lab_optochin_2_' => 'Optochin',
								 '_lab_cooked_blood_2_' => 'Sangre cocida',
								 '_lab_bacitracin_2_' => 'Bacitracina',
								 '_lab_campylocbacter_2_' => 'Subcultivo Campylo.',
								 
								 '_lab_culture_fungal_1_' => 'Cult.hongos',
								 '_lab_culture_fungal_2_' => 'Cult.hongos',
								 '_lab_bac_tube_1_' => 'Keimschlauch',
								 '_lab_bac_tube_2_' => 'Keimschlauch',
								 '_lab_api_candida_1_' => 'API Candida',
								 '_lab_api_candida_2_' => 'API Candida',
								 '_lab_special_fungi_1_' => 'Hongo.especial',
								 '_lab_special_fungi_2_' => 'Hongo.especial',
								 '_lab_candida_id_1_' => 'Candida-ID',
								 '_lab_candida_id_2_' => 'Candida-ID',
								 
								 '_lab_culture_stool_' => 'Cult.heces',
								 '_lab_culture_blood_' => 'Cult.sangre',
								 '_lab_liquor_cult_vial' => 'Cult.Fco.LCR (por confirmar término)',
								 '_lab_laal_' => 'LAAL',
								 '_lab_own_blood_' => 'Sangre propia',
								 '_extra_1_' => ' ',
								 '_extra_2_' => ' ',
								 '_extra_3_' => ' ',
								 '_lab_kligler_' => 'Kligler',
								 '_extra_4_' => ' ',
							 
								 '_lab_agglut_1x_1_' => 'Agglut.1x',
								 '_lab_agglut_1x_2_' => 'Agglut.1x',
								 '_lab_aggult_1x_3_' => 'Agglut.1x',
								 '_lab_agglut_4x_' => 'Agglut.4x',
								 '_lab_agglut_8x_' => 'Agglut.8x',
								 '_lab_agglut_str_pneu_1_' => 'Aggl.str.pneu 1',
								 '_lab_agglut_str_pneu_2_' => 'Aggl.str.pneu 2',
								 '_lab_agglut_dyspepsy_' => 'Aggl.Dyspepsie',
								 '_lab_ehec_' => 'EHEC',
								 '_lab_mobility_' => 'Beweglichkeit',
								 
								 '_lab_methylen_blue' => 'Azul.metilen.',
								 '_lab_acrid_orange_' => 'Acrid.orange',
								 '_lab_ziehl_neelsen_' => 'Ziehl-Neelsen',
								 '_lab_koh_' => 'KOH',
								 '_lab_novobiocin_1_' => 'Novobiocina 1',
								 '_lab_novobiocin_2_' => 'Novobiocina 2',
								 '_extra_5_' => ' ',
								 '_extra_6_' => ' ',
								 '_extra_7_' => ' ',
								 '_extra_8_' => ' ',
								 
								 '_lab_streptex_1_' => 'Streptex 1',
								 '_lab_plasma_coag_1_' => 'Plasmacoag.1',
								 '_lab_catalase_1_' => 'Catalasa 1',
								 '_lab_indol_1_' => 'Indol 1',
								 '_lab_oxidase_1_' => 'Oxidasa 1',
								 '_lab_enterotube_1_' => 'Tubo Enter. 1',
								 '_lab_bbl_1_' => 'BBL 1',
								 '_lab_api_1_' => 'API 1',
								 '_lab_api_anaerob_1_' => 'API aner.1',
								 '_lab_gram_dye_1_' => 'Tinción Gram.1',
								 
								 '_lab_streptex_2_' => 'Streptex 2',
								 '_lab_plasma_coag_2_' => 'Plasmacoag.2',
								 '_lab_catalase_2_' => 'Catalasa 2',
								 '_lab_indol_2_' => 'Indol 2',
								 '_lab_oxidase_2_' => 'Oxidasa 2',
								 '_lab_enterotube_2_' => 'Tubo Enter. 2',
								 '_lab_bbl_2_' => 'BBL 2',
								 '_lab_api_2_' => 'API 2',
								 '_lab_api_anaerob_2_' => 'API aner.2',
								 '_lab_gram_dye_2_' => 'Tinción Gram.2',
								 
								 
								 '_lab_streptex_3_' => 'Streptex 3',
								 '_lab_plasma_coag_3_' => 'Plasmacoag.3',
								 '_lab_catalase_3_' => 'Catalase 3',
								 '_lab_indol_3_' => 'Indol 3',
								 '_lab_oxidase_3_' => 'Oxidasa 3',
								 '_lab_enterotube_3_' => 'Tubo Enter. 3',
								 '_lab_bbl_3_' => 'BBL 3',
								 '_lab_api_3_' => 'API 3',
								 '_lab_api_anaerob_3_' => 'API aner.3',
								 '_lab_gram_dye_3_' => 'Tinción Gram.3'
								 );*/
$lab_ResistANaerobAcro=array('PEN','AMO','AMC','MZL','PIC','IMI','CTX','CMP','TET','CLI','MTR','ERY','TEC','VAN','');
									
$lab_ResistAerobAcro=array('P','AMX','AMC','CC','MZ','PIP','GM','AN','CZ',
                                           'CXM','CRO','MER','OFX','SXT','U','AZ',
										   'VA','NN','IPM','CTX','CAZ','FEP','TEC',
										   'FF','25','E','OX','CIP','CFS','30','31','ßLac.');
										   
$lab_ResistAerobExtra=array('AB','MIC','NY','AC','KET','6','','',
                                            'C','NE','GM','D','OFX','K','','',
											'C','NE','GM','D','OFX','K','','',
											'C','NE','GM','D','OFX','K');
					
									  
$lab_TestResultId_1=array('Staph.aureus', 'E.coli', 'enterob.aerogenes',
                                     'Staph.epiderm', 'E.coli hem.', 'Morganel.morganii',
									 'Streptococc.', 'E.coli muc.', 'Haemophilus sp.',
									 'hem.Streptoc.', 'Proteus', 'Salmonella',
									 'verg.Streptoc.', 'Proteus indol pos.', 'Shigella',
									 'Grupo A', 'Proteus indol neg.', 'aerobio form. esporas',
									 'Grupo B', 'Pseudomonas', 'apath.Coryne',
									 'Grupo C', 'Ps.aeruginosa', 'Bact.frag.',
									 'Grupo D', 'Klebsiel.species', 'Prevotella',
									 'Grupo F', 'Enterob.cloacae', 'Candida albic.',
									 'Grupo G', 'Enterob.agglomerans', 'Candid.sp.',
									 'Packetcocci', 'Citrobac.freundii', 'Candid.tropicalis',
									 'Neiss.sp.', 'Klebs.pneumon.', 'Candid.glabr.',
									 'Pato raro', 'Klebs.oxytoca', 'Aspergillus',
									 'Pato raro', 'Campylobactr', 'Salmon.enteritid.',
									 'Acinetob.Iwoffi', 'Hafnia alvei', 'Lactobacil.sp.',
									 'Acinetob. Baumannii', 'Serrat.liquefac.', 'Stentrop.maltophl.');

/*$lab_TestResultId_1=array('Staph.aureus', 'E.coli', 'enterobac aerogenes',
                                     'Staph.epiderm', 'E.coli hem.', 'Morganella morganii',
									 'Streptococc.', 'E. coli muc.', 'Haemophilus sp.',
									 'Streptoc. hem.', 'Proteus', 'Salmonella',
									 'verg.Streptoc.', 'Proteus indol pos.', 'Shigella',
									 'Grupo A', 'Proteus indol neg.', 'aerobio form. esporas',
									 'Grupo B', 'Pseudomonas', 'apath.Coryne',
									 'Grupo C', 'Ps. aeruginosa', 'Bacter frag.',
									 'Grupo D', 'Klebsiella species', 'Prevotella',
									 'Grupo F', 'Enterob.cloacae', 'Candida albicans',
									 'Grupo G', 'Enterob.agglomerans', 'Candida sp.',
									 'Paketkokken', 'Citrobact.freundii', 'Candida tropicalis',
									 'Neiss.spezies', 'Klebsiella pneumon.', 'Candida glabr.',
									 'seltener Bact.', 'Klebsiella oxytoca', 'Aspergillus',
									 'selterner Bact.', 'Campylobacter', 'Salmonella enteritidis',
									 'Acinetobacter Iwoffi', 'Hafnia alvei', 'Lactobacillus sp.',
									 'Acinetobacter Baumannii', 'Serratia liquefaciens', 'Stenotrophomonas maltophilia');
									 
*/									 
$lab_TestResultId_2 = array('Sin crecimiento luego de 48 horas', 'Crecim. tipo aerobios', 'Negativo para amebas en heces',
                                           'Sin crecimiento luego de 5 días', '', 'Negativo para Lamblia en heces',
										   'Sin crecimiento luego de 9 días', 'Sin evidencia de Diplococ. gramneg.', 'Neg. para huevos de nematodos en heces',
										   'No Bact. del grupo TPE', 'Cultivo GO negativo', 'Sin crecimiento de E coli',
										   'cultivo neg. Campylobacter.', '', 'Liquorantígeno (¿Ag. LCR?) negativo',
										   'NoG. Campylobacter pylori', 'Sin evid.microscp.acid.Cilind.', 'EHEC negativo',
										   'Sin evid.serolog.dispepsia.coli', 'Sin crecimiento luego de 7 días', '',
										   'Evid. esporas de hongos', '' ,'',
										   'Cultivo hongos negativo', '', '',
										   'Cocos flora mixta', '', '',
										   'Cocos.Cilindros.flora mixta','', '',
										   'Sin evid.Bacteria microscop.', '', '',
										   'NoG.oxacil.resist.Staphyloc.', '', '');
?>
