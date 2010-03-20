<?php

/**
* Correcciones: Dr. med. Daniel Hinostroza C.
*Revision Dr. JR
*/

$LDDiagnosticTest='Orden de prueba diagnóstica';
$LDHospitalName='CARE 2X';
$LDCentralLab='Laboratorio central';
$LDLabel='Etiqueta';
$LDRoomNr='Número de habitación';
$LDSamplingTime='Hora en que se tomó la muestra';
$LDDay='Día';
$LDMinutes='Minutos';
$LDHours='Horas';
$LDBatchNr='Número de lote';
$LDCaseNr='Número de caso';
$LDHouse='Casa';
$LDHematology='Hematología';
$LDCoagulation='Coagulación';
$LDUrine='Orina';
$LDSerum='Suero';
$LDGlucose='Glucosa';
$LD9Hour='9.00';
$LD15Hour='15.00';
$LDSober='sobrio';
$LDBloodSugar='Glucemia';
$LDBLoodSugar1='Glucemia1';
$LDBloodPlasma='Plasma en sangre';
$LDDoctorSignature='Firma del médico';
$LDLifeRisk='Riesgo hacia la vida';
$LDRarity='Rareza';
$LDSpecTest='Pruebas especiales';
$LDClinicalInfo='Información clínica';
$LDShortMonth=array('',
                                   'Ene',
								   'Feb',
								   'Mar',
								   'Abr',
								   'May',
								   'Jun',
								   'Jul',
								   'Ago',
								   'Sep',
								   'Oct',
								   'Nov',
								   'Dic');
								   
$LDShortDay=array('Do','Lu','Ma','Mi','Ju','Vi','Sa','Do');
				
$LDBatchNumber='Número de lote';
$LDMaterial='Material:';
$LDEmergencyProgram='Los campos con sombras violetas corresponden al programa de emergencias';
$LDPhoneOrder=' = debe ser confirmado por teléfono';
/* 2002-09-03 EL */							  
$LDSearchPatient='Buscar paciente';
$LDPlsSelectPatientFirst='Por favor busque al paciente primero.';
/* 2002-09-11 EL */
$LDPendingTestRequest='Pruebas pendientes solicitadas';
/* 2002-10-14 EL */
$LDDone='¡Hecho! Ya puede mover el formulario al archivo';

/* Note: the following array uses strict medical terminology.
*  If you are not sure about their translation, please leave the 
*  english word untranslated
*/
$LD_Elements = array('tx_1'=>'Química clínica',
                                  'tx_2'=> 'Coagulación',
								  'tx_3'=> 'Proteínas',
								  'tx_4'=>'Marcador tumoral',
								  'tx_5'=>'Serología infecc.',
								  'tx_6'=>'Medicina',
								  'tx_7'=>'Orina/O. espont.',
								  
                                  '_iof__x__iof_2_' => 'IOF',
                                  '_marcumar_therapy_' => 'Marcumar-Ther.',
								  '_emx_protein_total_' => 'Proteína total',
								  '_afp_' => 'AFP',
								  'tx_8' => 'LCR (por confirmar término) - Suero',
								  '_amiodaron_' => 'Amiodarona',
								  '_emx_urin_status_' => 'Estado actual de la orina',
								  
								  '_aof_'=>'AOF',
								  '_heparin_therapy_'=>'Terapia con heparina',
								  '_albumin_'=>'Albúmina',
								  '_ca_15_3_'=>'CA 15-3',
								  '_antisstaph_titer_'=>'Titulación Antiestafil.',
								  '_barbiturates_i_s_'=>'Barbitúricos en suero',
								  '_emx_urin_amilase_'=>'Amilasa en orina',
								  
								  '_preop_'=>'preoper',
								  '_fibrinolysis_'=>'Fibrinolisis',
								  '_elpho_'=>'Elpho',
								  '_ca_19_9_'=>'CA 19-9',
								  '_adenovirus_antibody_'=>'Adenovirus-AB',
								  '_benzodiazepam_i_s_'=>'Benzodiacep.i.S.',
								  '_urin_sugar_'=>'Glucosa en orina',
								  
								  '_postop_'=>'postoper',
								  '_emx_quick_'=>'Quick',
								  '_immune_fixation_'=>'Fijación inmune',
								  '_ca_125_'=>'CA 125',
								  '_borrelias_antibody__x__borrelias_antibody_2_'=>'Borrelien-AB',
								  '_carbmazepin_'=>'Carbamacepina',
								  '_proten_in_urine_'=>'Proteína en orina',
								  
								  '_emx_serum_sugar_'=>'Glucosa sérica',
								  '_emx_ptt_'=>'TTP',
								  '_beta2_microglobulin_i_s_'=>'beta2-Microglob. en suero',
								  '_cea_'=>'CEA',
								  '_borrelias_immunoblot__x__borrelias_immunoblot_2_'=>'Borrelia Inmunoblot',
								  '_clonazepam_'=>'Clonazepam',
								  '_albumin_in_urine_'=>'Albúmina en orina',
								  
								  '_emx_bilirubin_total_'=>'Bilirrubina total',
								  '_emx_ptz_'=>'PTZ',
								  '_immunglobulin_quantity_'=>'Cant. inmunoglobulinas',
								  '_cyfra_21_1_'=>'Cyfra 21-1',
								  '_brucellia_antibody_'=>'Anticuerpos Brucella',
								  '_emx_digitoxin_'=>'Digitoxina',
								  '_emx_osmol_in_urine_'=>'Osmol. en orina',
								  
								  '_bilirubin_direct_'=>'Bilirrubina directa',
								  '_emx_fibrinogen_'=>'Fibrinógeno',
								  '_ige_'=>'IgE',
								  '_hcg_'=>'HCG',
								  '_campylob_antibody_'=>'Anticuerpos Campylobacter',
								  '_emx_digoxin_'=>'Digoxina',
								  '_emx_pregnancy_'=>'Embarazo',
								  
								  '_emx_got_'=>'GOT',
								  '_emx_soluble_fibrinogen_mon_'=>'Fibrinógeno soluble mon.',
								  '_haptoglobin_'=>'Haptoglobina',
								  '_nse_'=>'NSE',
								  '_candida_antibody_'=>'Anticuerpos Candida',
								  '_gentamycin_'=>'Gentamicina',
								  '_cytomegaly_in_urine_'=>'Citomegal. en orina',
								  
								  '_emx_gpt_'=>'GPT',
								  '_emx_fsp_dimer_'=>'FSP-dímero',
								  '_transferrin_'=>'Transferrina',
								  '_psa_'=>'Antígeno prostático específico',
								  '_cardiotr_virus_'=>'Virus cardiotr.',
								  '_lithium_'=>'Litio',
								  '_urine_cytology_'=>'Citología en orina',
								  
								  '_gamma_gt_'=>'gamma GT',
								  '_emx_thrombos_coagulation_'=>'Coag. Trombos.',
								  '_ferritin_'=>'Ferritina',
								  '_scc_'=>'SCC',
								  '_chamydia_smear_'=>'Chalmy-Smear.',
								  '_phenobarbital_'=>'Fenobarbital',
								  '_bence_jones_'=>'Bence Jones',
								  
								  '_alkalic_ph_'=>'Fos. alcalina',
								  '_emx_at_3_'=>'AT III',
								  '_coeroplasmin_'=>'Cer(ul)oplasmina',
								  '_tpa_'=>'TPA',
								  '_chlamydia_antibody_'=>'Ac. Chlamydia',
								  '_phenytoin_'=>'Fenitoína',
								  '_urine_elpho_'=>'Orina-Elpho',
								  
								  '_ldh_'=>'LDH',
								  '_factor_8_'=>'Factor VIII',
								  '_alpha_1_antitrypsin_'=>'a-1 antitripsina',
								  'tx_9'=>'Anticuerpos tisulares',
								  '_c_psitacci_antibody_'=>'Anticuerpos Chlamydia psitacci',
								  '_primidon_'=>'Primidon',
								  '_beta_2_microglobulin_in_urine_'=>'beta2 Microglob. en orina',
								  
								  '_hbdh_'=>'HBDH',
								  '_apc_resistance_telx_'=>'APC-Resisten.',
								  '_afp_gravida_'=>'Alfafetoprot. grávida',
								  '_ana_'=>'ANA',
								  '_coxsacky_antibody_'=>'Anticuerpos Coxsack.',
								  '_salicylic_acid_'=>'Ácido salicílico',
								  'tx_10'=>'Colecc. orina',
								  
								  'emx_cpk_'=>'CPK',
								  '_protein_c_telx_'=>'Proteína C',
								  '_ssw_'=>'Embarazo',
								  '_ama_'=>'AMA',
								  '_q_fever_antibody_'=>'Anticuerpos fiebre Q',
								  '_theophyllin_'=>'Teofilina',
								  '_urine_collected_'=>'Sammel-',
								  
								  '_emx_ckmb_'=>'CKMB',
								  '_protein_s_telx_'=>'Proteína S',
								  '_alpha_1_microglobulin_'=>'alfa1 microglobulina',
								  '_dns_antibody_'=>'Anticuerpos DNS',
								  '_cytomegaly_antibody_'=>'Ac. Citomegal.',
								  '_tobramycin_'=>'Tobramicina',
								  '_urine_volume_'=>'Vol. orina: ml',
								  
								  '_emx_myoglobin_'=>'Mioglobina',
								  '_bleeding_time_telx_'=>'Tiempo de sangrado',
								  'tx_11'=>'Glándula tiroides',
								  '_asma_'=>'ASMA',
								  '_ebv_antibody__x__ebv_antibody_2_'=>'EBV-AB',
								  '_valproin_acid_'=>'Ácido valproico',
								  '_addis_count_'=>'Contaje Addis.',
								  
								  '_emx_troponin_t_'=>'Troponina-T',
								  'tx_12'=>'Hematología',
								  '_t3_'=>'T3',
								  '_ena_'=>'ENA',
								  '_echinococcus_antibody_'=>'Anticuerpos Echinococcus',
								  '_vancomycin_'=>'Vancomicina',
								  '_sodium_in_urine_'=>'Sodio en orina',
								  
								  '_emx_cholinesterase_'=>'Colinesterasa',
								  '_emx_minor_blood_test_'=>'Kl. BB',
								  '_thyroxin_T4_'=>'Tiroxina/T4',
								  '_anca_'=>'ANCA',
								  '_echo_virus_antibody_'=>'Anticuerpos Echo-virus',
								  '_empty_'=>'',
								  '_kalium_in_urine_'=>'Potasio en orina',
								  
								  '_gldh_'=>'GLDH',
								  '_diff_minor_blood_test_'=>'Diff.+ kl.BB',
								  '_tsh_basal_'=>'TSH-basal',
								  'tx_13'=>'Factores reuma.',
								  '_fsme_antibody__x__fsme_antibody_2_'=>'Anticuerpos FSME',
								  '_emx_drugscreen_in_urine_'=>'Tamizaje de fármacos en orina',
								  '_calcium_in_urine_'=>'Calcio en orina',
								  
								  '_chol_'=>'Chol',
								  '_reticulocytes_'=>'Reticulocitos',
								  '_tsh_stimulation_'=>'TSH-estim.',
								  '_anti_strepto_titer_'=>'Titulación anti-estrepto',
								  '_herpes_simplex_1_antibody_'=>'Anticuerpos Herpes sim.1',
								  '_amphetamine_in_urine_'=>'Anfetam. en orina',
								  '_phospor_in_urine_'=>'Fosfor en orina',
								  
								  '_tri_'=>'Tri',
								  '_bone_marrow_diff_telx_'=>'Médula ósea+Dif.',
								  '_tak_'=>'TAK',
								  '_lat_rf_'=>'FR Lat.',
								  '_herpes_simplex_2_antibody_'=>'Herpes sim.2-AB',
								  '_antidepressant_in_urine_'=>'Antidepresivos en orina',
								  '_uric_acid_in_urine_'=>'Ácido úrico en orina',
								  
								  '_hdl_chol_'=>'HDL-Colest',
								  '_malaria_'=>'Malaria',
								  '_mak_'=>'MAK',
								  '_streptocyme_'=>'Streptozima',
								  '_hiv1_hiv2_antibody_'=>'HIV1/HIV2-AB',
								  '_barbiturates_in_urine_'=>'Barbitúricos en orina',
								  '_creatinin_in_urine_'=>'Creatinina en orina',
								  
								  '_ldl_chol_'=>'LDL-Chol',
								  '_hb_elpho_'=>'Hb-Elpho',
								  '_trak_'=>'TRAK',
								  '_waaler_rose_'=>'Waaler Rose',
								  '_influenza_a_antibody_'=>'Ac. Influenza A',
								  '_benzodiazepam_in_urine_'=>'Benzodiazep. en orina',
								  '_porphyrine_in_urine_'=>'Porfirina en orina',
								  
								  '_lipid_elpho_'=>'Lipid-Elpho',
								  '_hla_b_27_telx_'=>'HLA-B 27',
								  '_thyreoglobulin_'=>'Tiroglobulina',
								  'tx_14'=>'Hepatitis',
								  '_influenza_b_antibody_'=>'Ac. Influenza B',
								  '_cannabinol_in_urine_'=>'Cannabinol en orina',
								  '_cortisol_in_urine_'=>'Cortisol en orina',
								  
								  '_lipase_'=>'Lipasa',
								  '_thrombo_antibody_telx_'=>'Thrombo-AB',
								  '_thyroxinbinding_globulin_'=>'Glob. ligadora de tiroxin.',
								  '_anti_hav_'=>'Anti-HAV',
								  '_lcm_antibody_'=>'LCM-AB',
								  '_cocain_in_urine_'=>'Cocaína en orina',
								  '_vms_in_urine_'=>'VMS en orina',
								  
								  '_emx_amylase_'=>'Amilasa',
								  '_leukocytes_phosphate_telx_'=>'Leucocitos-fosfato',
								 'tx_15'=>'Hormonas',
								 '_anti_hav_igm_'=>'Anti-HAV-IgM',
								 '_leg_pneum_antibody_'=>'Ac. Legionella pneum',
								 '_methadon_in_urine_'=>'Metadona en orina',
								 '_5_hies_in_urine_'=>'5.-Hies en orina',
								 
								 '_uric_material_'=>'Material vejiga urin.',
								 'tx_16'=>'Glucemia',
								 '_acth_telx_'=>'ACTH',
								 '_hbs_antigen_'=>'Antígeno HBs',
								 '_leptospiria_antibody_'=>'Ac. Leptospira',
								 '_opiates_in_urine_'=>'Opiáceos en orina',
								 '_hydroxyprolin_in_urine_'=>'Hidroxiprolina en orina',
								 
								 '_uric_acid_'=>'Ácido úrico',
								 '_emx_bloodsugar_sober_'=>'Glucemia sobrio(a)',
								 '_aldosteron_'=>'Aldosterona',
								 '_anti_hbs_titer_'=>'Titulación Anti-HBs',
								 '_listeria_antibody_'=>'Ac. Listeria',
								 'tx_17'=>'Prenatal',
								 '_cathecholamines_in_urine_'=>'Catecolam. en orina',
								 
								 '_emx_krea_'=>'Crea',
								 '_emx_bloodsugar_9_00_'=>'Glucemia 9.00',
								 '_calcitonin_'=>'Calcitonina',
								 '_hbe_antigen_'=>'Antígeno HBe',
								 '_masern_antibody_'=>'Anticuerpo Masern',
								 '_chlamydia_smear_pregnancy_'=>'Chlamy. smear. embarazo',
								 '_pankreol_'=>'Pancreol.',
								 
								 '_emx_sodium_'=>'Sodio',
								 '_emx_bloodsugar_pp_'=>'Glucemia p.prand.',
								 '_cortisol_'=>'Cortisol',
								 '_anti_hbe_'=>'Anti-HBe',
								 '_mononucleosis_'=>'Mononucleosis',
								 '_first_serology_'=>'Primera serología',
								 '_aminolevulin_in_urine_'=>'Aminolevulina en orina',
								 
								 '_emx_kalium_'=>'Potasio',
								 '_emx_bloodsugar_15_00_'=>'Glucemia 15.00',
								 '_cortisol_day_program_'=>'Cortisol programa diario',
								 '_anti_hbc_'=>'Anti_HBc',
								 '_mumps_antibody_'=>'Ac. Paperas',
								 '_pregnancy_'=>'SSW: (embarazo)',
								 'tx_18'=>'Especiales',
								 
								 '_emx_calcium_'=>'Calcio',
								 '_emx_bloodsugar_notime_'=>'Glucemia noTime',
								 '_fsh_'=>'FSH',
								 '_anti_hbc_igm_'=>'Anti-HBc IgM',
								 '_mycoplas_pneum_'=>'Anticuerpos Mycoplasma pneumoniae',
								 '_down_screening_'=>'Tamizaje Down',
								 '_emx_blood_alcohol_'=>'Alcoholemia',
								 
								 '_chloride_'=>'Cloro',
								 '_emx_bloodsugar_notime_2_'=>'Glucemia noTime2',
								 '_gastrin_'=>'Gastrina',
								 '_anti_hcv_'=>'Anti_HCV',
								 '_neurotrope_virus__x__neurotrope_virus_2_'=>'Virus neurotrop.',
								 '_strep_b_quicktest_'=>'Prueba rápida Estrep-B',
								 '_cdt_'=>'CDT',
								 
								 '_phospor_'=>'Fósforo',
								 '_glucose_proof_'=>'Glucosa (proof)',
								 '_hormone_hcg_'=>'HCG',
								 '_hepatitis_d_delta_a_'=>'Hepatitis D delta A',
								 '_parainfluenza_2_antibody_'=>'Anticuerpos Parainfluenz.2',
								 '_tpha_'=>'TPHA',
								 '_vitamin_b12_'=>'Vitamina B12',
								 
								 '_magnesium_'=>'Magnesio',
								 '_lactose_proof_'=>'Lactosa (proof)',
								 '_insulin_'=>'Insulina',
								 '_anti_hev_'=>'Anti-HEV',
								 '_parainfluenza_3_antibody_'=>'Anticuerpos Parainfluenz.3',
								 '_hbs_ag_'=>'HBs-Ag',
								 '_folic_acid_'=>'Ácido fólico',
								 
								 '_iron_'=>'Hierro',
								 '_hba_1c_'=>'HBA 1c',
								 '_cathecholamines_in_p_'=>'Catecolaminas en plasma',
								 'tx_19'=>'Punción biopsia',
								 '_picoma_virus_antibody_'=>'Anticuerpos Picoma-Virus',
								 '_pregnancy_hiv1_hiv2_antibody_'=>'HIV1/HIV2-AB',
								 '_insulin_antibody_'=>'Anticuerpos insulina',
								 
								 '_copper_'=>'Cobre',
								 '_fructosamine_'=>'Fructosamina',
								 '_lh_'=>'LH',
								 '_punctat_cytology_'=>'Citología Punción biopsia',
								 '_rickettsia_antibody_'=>'Anticuerpos Rickettsia',
								 'tx_20'=>'Stuhl (deposición?)',
								 '_intrinsic_antibody_'=>'Intrínseco',
								 
								 '_emx_osmolal_'=>'Osmolal.',
								 '_capillary_blood_sample_'=>'Muestra de sangre capilar',
								 '_oestradiol_'=>'Estradiol',
								 '_protein_in_punctat_'=>'Proteína en punción biopsia',
								 '_reoteln_antibody_'=>'Anticuerpos Reoteln',
								 '_chymotrypsin_'=>'Quimiotripsina',
								 '_stone_analysis_'=>'Análisis de Stone',
								 
								 '_emx_lactat_in_p_'=>'Lactato en plasma',
								 '_capillary_blood_sample_2_'=>'Muestra de sangre capilar 2',
								 '_oestriol_'=>'Estriol',
								 '_ldh_in_punctat_'=>'LDH en punción biopsia',
								 '_roeteln_immune_status_'=>'Estado inmunitario Roeteln',
								 '_blood_in_stool_'=>'Sangre en heces',
								 '_ace_'=>'ACE',
								 
								 '_ammoniac_'=>'Amoníaco',
								 'tx_21'=>'Infante',
								 '_pregnancy_ssw_'=>'SSW: (embarazo)',
								 '_chol_in_punctat_'=>'Colest. en punción biopsia',
								 '_rs_virus_antibody_'=>'Anticuerpos RS virus',
								 '_blood_in_stool_2_'=>'Sangre en heces 2',
								 '_g1_'=>'G1',
								 
								 '_emx_free_hb_'=>'Hb libre',
								 '_emx_infant_bilirubin_'=>'Bilirubina infant.',
								 '_parathormone_'=>'Paratohormona',
								 '_cea_in_punctat_'=>'CEA en punción biopsia',
								 '_shigella_salmonella_antibody_'=>'Anticuerpos Shigella/Salmonella',
								 '_blood_in_stool_3_'=>'Sangre en heces',
								 '_g2_'=>'G2',
								 
								 '_emx_crp_'=>'CRP',
								 '_emx_cord_bilirubin_'=>'Bilirrubina en cordón umbilical',
								 '_progesteron_'=>'Progesterona',
								 '_afp_in_punctat_'=>'Alfafetoprot. en punción biopsia',
								 '_toxoplasma_antibody__x__toxoplasma_antibody_2_'=>'Anticuerpos Toxoplasma',
								 'tx_22'=>'Rareza',
								 '_g3_'=>'G3',
								 
								 'tx_23'=>'LCR (por confirmar término)',
								 '_emx_infant_bilirubin_direct_'=>'Bilirrubina directa',
								 '_prolactin_1_'=>'Prolactina 1',
								 '_uric_material_in_punctat_'=>'Material vejiga urin. en punción biopsia',
								 '_infection_tpha__x__infection_tpha_2_'=>'TPHA',
								 '_rarity_h_'=>'Rareza H',
								 '_g4_'=>'G4',
								 
								 '_emx_liquor_status_'=>'Estado actual LCR (por confirmar término)',
								 '_emx_infant_sugar_'=>'Glucosa infant.',
								 '_prolactin_2_'=>'Prolactina 2',
								 '_rheumafactor_in_punctat_'=>'Factor reumat. en punción biopsia',
								 '_varicella_antibody_'=>'Anticuerpos Varicella',
								 '_rarity_e_'=>'Rareza E',
								 '_g5_'=>'G5',
								 
								 '_liquor_elpho_'=>'Licor elpho',
								 '_emx_infant_sugar_2_'=>'Glucosa infant. 2',
								 '_renin_'=>'Renina',
								 '_material_'=>'Material:',
								 '_yersinia_antibody_'=>'Anticuerpos Yersinia',
								 '_rarity_s_'=>'Rareza S',
								 '_g6_'=>'G6',
								 
								 '_liquor_cytology_'=>'Licor citología',
								 '_emx_infant_minor_blood_test_'=>'Kl. BB',
								 '_serotonin_telx_'=>'Serotonina',
								 'blankline'=>'',
								 '_e1_'=>'E1',
								 '_urine_rarity_'=>'Rareza en orina',
								 '_g7_'=>'G7',
								 
								 '_oligoklonal_igg_'=>'IgG Oligoclonal',
								 '_infant_diff_minor_blood_test_'=>'Dif.+kl. BB',
								 '_somatomedin_c_'=>'Somatomedina C',
								 'blankline2'=>'',
								 '_e2_'=>'E2',
								 '_f1_'=>'F1',
								 '_g8_'=>'G8',
								 
								 '_reiber_schema_'=>'Esquema Reiber',
								 '_infant_reticulocytes_'=>'Reticulocitos',
								 '_testosteron_'=>'Testosterona',
								 '_d1_'=>'D1',
								 '_e3_'=>'E3',
								 '_f2_'=>'F2',
								 '_g9_'=>'G9',
								 
								 '_a1_'=>'A1',
								 '_b1_'=>'B1',
								 '_c1_'=>'C1',
								 '_d2_'=>'D2',
								 '_e4_'=>'E4',
								 '_f3_'=>'F3',
								 '_g10_'=>'G10',
								
								 'tx_24'=>'Signo clínico',
								 'tx_25'=>'Alto riesgo >>',
								 '_highrisk_'=>'<< Alto riesgo',
								 'tx_26'=>'Rareza:',
								 'tx_27'=>'Prueba especial',
								 'tx_28'=>'',
								 'tx_29'=>'Información clínica',
								  );
?>
