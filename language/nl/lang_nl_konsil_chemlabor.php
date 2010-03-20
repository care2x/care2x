<?php
$LDDiagnosticTest='Diagnostische Test Opdracht';
$LDHospitalName='CARE 2X';
$LDCentralLab='Centrale Laboratorium';
$LDLabel='Label';
$LDRoomNr='Kamer-Nr.';
$LDSamplingTime='Tijd van proefneming';
$LDDay='Dag';
$LDMinutes='Minuten';
$LDHours='Uren';
$LDBatchNr='Batch Nr.';
$LDCaseNr='Case nummer';
$LDHouse='House';
$LDHematology='Hematology';
$LDCoagulation='Coagulation';
$LDUrine='Urine';
$LDSerum='Serum';
$LDGlucose='Glucose';
$LD9Hour='9.00';
$LD15Hour='15.00';
$LDSober='sober';
$LDBloodSugar='BLS';
$LDBLoodSugar1='BLS1';
$LDBloodPlasma='BLP';
$LDDoctorSignature='Doctor\'s signature';
$LDLifeRisk='Risk to life';
$LDRarity='Rarity';
$LDSpecTest='special Tests';
$LDClinicalInfo='clinical info';
$LDShortMonth=array('',
                                   'Jan',
								   'Feb',
								   'Mar',
								   'Apr',
								   'May',
								   'Jun',
								   'Jul',
								   'Aug',
								   'Sep',
								   'Oct',
								   'Nov',
								   'Dec');
								   
$LDShortDay=array('So','Mo','Tu','We','Th','Fr','Sa','So');
				
$LDBatchNumber='Batch nr.';
$LDMaterial='Material:';
$LDEmergencyProgram='The violet shaded fields belong to emergency program';
$LDPhoneOrder=' = must be confirmed by phone';
/* 2002-09-03 EL */							  
$LDSearchPatient='Search patient';
$LDPlsSelectPatientFirst='Please search for the patient first.';
/* 2002-09-11 EL */
$LDPendingTestRequest='Pending Test Request';
/* 2002-10-14 EL */
$LDDone='It\'s done! Move the form to the archive';

/* Note: the following array uses strict medical terminology.
*  If you are not sure about their translation, please leave the 
*  english word untranslated
*/
$LD_Elements = array('tx_1'=>'Clinical Chem.',
                                  'tx_2'=> 'Coagulation',
								  'tx_3'=> 'Proteins',
								  'tx_4'=>'Tumormarker',
								  'tx_5'=>'Infect.serology',
								  'tx_6'=>'Medicine',
								  'tx_7'=>'Urine/Spont.u.',
								  
                                  '_iof__x__iof_2_' => 'IOF',
                                  '_marcumar_therapy_' => 'Marcumar-Ther.',
								  '_emx_protein_total_' => 'total protein',
								  '_afp_' => 'AFP',
								  'tx_8' => 'Serum - Liquor',
								  '_amiodaron_' => 'Amiodaron',
								  '_emx_urin_status_' => 'Urine status',
								  
								  '_aof_'=>'AOF',
								  '_heparin_therapy_'=>'Heparin ther.',
								  '_albumin_'=>'Albumin',
								  '_ca_15_3_'=>'CA 15-3',
								  '_antisstaph_titer_'=>'Antistaph.Titer',
								  '_barbiturates_i_s_'=>'Barbiturate i.S.',
								  '_emx_urin_amilase_'=>'Urine amylase',
								  
								  '_preop_'=>'preop',
								  '_fibrinolysis_'=>'Fibrinolysis',
								  '_elpho_'=>'Elpho',
								  '_ca_19_9_'=>'CA 19-9',
								  '_adenovirus_antibody_'=>'Adenovirus-AB',
								  '_benzodiazepam_i_s_'=>'Benzodiazep.i.S.',
								  '_urin_sugar_'=>'Urine sugar',
								  
								  '_postop_'=>'postop',
								  '_emx_quick_'=>'Quick',
								  '_immune_fixation_'=>'Immune fixation',
								  '_ca_125_'=>'CA 125',
								  '_borrelias_antibody__x__borrelias_antibody_2_'=>'Borrelia-AB',
								  '_carbmazepin_'=>'Carbamazepin',
								  '_proten_in_urine_'=>'Protein i.U.',
								  
								  '_emx_serum_sugar_'=>'Ser.Glucose',
								  '_emx_ptt_'=>'PTT',
								  '_beta2_microglobulin_i_s_'=>'ß2-µGlob.i.S.',
								  '_cea_'=>'CEA',
								  '_borrelias_immunoblot__x__borrelias_immunoblot_2_'=>'Borr.Immunoblot',
								  '_clonazepam_'=>'Clonazepam',
								  '_albumin_in_urine_'=>'Albumin i.U.',
								  
								  '_emx_bilirubin_total_'=>'Bili total',
								  '_emx_ptz_'=>'PTZ',
								  '_immunglobulin_quantity_'=>'Immu.glob.quant.',
								  '_cyfra_21_1_'=>'Cyfra 21-1',
								  '_brucellia_antibody_'=>'Brucellia-AB',
								  '_emx_digitoxin_'=>'Digitoxin',
								  '_emx_osmol_in_urine_'=>'Osmol i.U.',
								  
								  '_bilirubin_direct_'=>'Bili direct',
								  '_emx_fibrinogen_'=>'Fibrinogen',
								  '_ige_'=>'IgE',
								  '_hcg_'=>'HCG',
								  '_campylob_antibody_'=>'Campylob.-AB',
								  '_emx_digoxin_'=>'Digoxin',
								  '_emx_pregnancy_'=>'Pregnancy',
								  
								  '_emx_got_'=>'GOT',
								  '_emx_soluble_fibrinogen_mon_'=>'Sol.Fibr.mon',
								  '_haptoglobin_'=>'Haptoglobin',
								  '_nse_'=>'NSE',
								  '_candida_antibody_'=>'Candida-AB',
								  '_gentamycin_'=>'Gentamycin',
								  '_cytomegaly_in_urine_'=>'Cytomeg.i.U.',
								  
								  '_emx_gpt_'=>'GPT',
								  '_emx_fsp_dimer_'=>'FSP-dimer',
								  '_transferrin_'=>'Transferrin',
								  '_psa_'=>'PSA',
								  '_cardiotr_virus_'=>'Cardiotr.Virus',
								  '_lithium_'=>'Lithium',
								  '_urine_cytology_'=>'Urine cytology',
								  
								  '_gamma_gt_'=>'gamma GT',
								  '_emx_thrombos_coagulation_'=>'Thr.Coag.',
								  '_ferritin_'=>'Ferritin',
								  '_scc_'=>'SCC',
								  '_chamydia_smear_'=>'Chalmy-Smear.',
								  '_phenobarbital_'=>'Phenobarbital',
								  '_bence_jones_'=>'Bence Jones',
								  
								  '_alkalic_ph_'=>'Alk.Ph.',
								  '_emx_at_3_'=>'AT III',
								  '_coeroplasmin_'=>'Coeroplasmin',
								  '_tpa_'=>'TPA',
								  '_chlamydia_antibody_'=>'Chlamyd.-AB',
								  '_phenytoin_'=>'Phenytoin',
								  '_urine_elpho_'=>'Urine-Elpho',
								  
								  '_ldh_'=>'LDH',
								  '_factor_8_'=>'Faktor VIII',
								  '_alpha_1_antitrypsin_'=>'a-1 Antitrypsin',
								  'tx_9'=>'Tissue-AB',
								  '_c_psitacci_antibody_'=>'C.psitacci-AB',
								  '_primidon_'=>'Primidon',
								  '_beta_2_microglobulin_in_urine_'=>'ß2 Mikroglob.i.U.',
								  
								  '_hbdh_'=>'HBDH',
								  '_apc_resistance_telx_'=>'APC-Resisten.',
								  '_afp_gravida_'=>'AFP Grav.',
								  '_ana_'=>'ANA',
								  '_coxsacky_antibody_'=>'Coxsack.-AB',
								  '_salicylic_acid_'=>'Salycylic acid',
								  'tx_10'=>'Collect.Urine',
								  
								  'emx_cpk_'=>'CPK',
								  '_protein_c_telx_'=>'Protein C',
								  '_ssw_'=>'Pregnancy',
								  '_ama_'=>'AMA',
								  '_q_fever_antibody_'=>'Q-Fever-AB',
								  '_theophyllin_'=>'Theophyllin',
								  '_urine_collected_'=>'Collect-',
								  
								  '_emx_ckmb_'=>'CKMB',
								  '_protein_s_telx_'=>'Protein S',
								  '_alpha_1_microglobulin_'=>'a-1 µglobulin',
								  '_dns_antibody_'=>'DNS-AB',
								  '_cytomegaly_antibody_'=>'Cytomegalie-AB',
								  '_tobramycin_'=>'Tobramycin',
								  '_urine_volume_'=>'Vol:ml.',
								  
								  '_emx_myoglobin_'=>'Myoglobin',
								  '_bleeding_time_telx_'=>'Bleed time',
								  'tx_11'=>'Thyroid glands',
								  '_asma_'=>'ASMA',
								  '_ebv_antibody__x__ebv_antibody_2_'=>'EBV-AB',
								  '_valproin_acid_'=>'Valproin acid',
								  '_addis_count_'=>'Addis-Count',
								  
								  '_emx_troponin_t_'=>'Troponin-T',
								  'tx_12'=>'Hematology',
								  '_t3_'=>'T3',
								  '_ena_'=>'ENA',
								  '_echinococcus_antibody_'=>'Echinococcus-AB',
								  '_vancomycin_'=>'Vancomycin',
								  '_sodium_in_urine_'=>'Sodium i.U.',
								  
								  '_emx_cholinesterase_'=>'Cholinesterase',
								  '_emx_minor_blood_test_'=>'Kl. BB',
								  '_thyroxin_T4_'=>'Thyroxin/T4',
								  '_anca_'=>'ANCA',
								  '_echo_virus_antibody_'=>'Echo-Virus AB',
								  '_empty_'=>'',
								  '_kalium_in_urine_'=>'K i.U.',
								  
								  '_gldh_'=>'GLDH',
								  '_diff_minor_blood_test_'=>'Diff.+ m.BT',
								  '_tsh_basal_'=>'TSH-basal',
								  'tx_13'=>'Rheuma factors',
								  '_fsme_antibody__x__fsme_antibody_2_'=>'FSME-AB',
								  '_emx_drugscreen_in_urine_'=>'Drugscreen i.U.',
								  '_calcium_in_urine_'=>'Ca i.U.',
								  
								  '_chol_'=>'Chol',
								  '_reticulocytes_'=>'Retikulocytes',
								  '_tsh_stimulation_'=>'TSH-stim.',
								  '_anti_strepto_titer_'=>'Anti-Strepto-Titer',
								  '_herpes_simplex_1_antibody_'=>'Herpes sim.1-AB',
								  '_amphetamine_in_urine_'=>'Amphetam. i.U.',
								  '_phospor_in_urine_'=>'Phospor i.U.',
								  
								  '_tri_'=>'Tri',
								  '_bone_marrow_diff_telx_'=>'Bmarrow+Diff.',
								  '_tak_'=>'TAK',
								  '_lat_rf_'=>'Lat.RF',
								  '_herpes_simplex_2_antibody_'=>'Herpes sim.2-AB',
								  '_antidepressant_in_urine_'=>'Antidepresiva i.U.',
								  '_uric_acid_in_urine_'=>'Uric acid i.U.',
								  
								  '_hdl_chol_'=>'HDL-Chol',
								  '_malaria_'=>'Malaria',
								  '_mak_'=>'MAK',
								  '_streptocyme_'=>'Streptozyme',
								  '_hiv1_hiv2_antibody_'=>'HIV1/HIV2-AB',
								  '_barbiturates_in_urine_'=>'Barbiturate i.U.',
								  '_creatinin_in_urine_'=>'Creatinin i.U.',
								  
								  '_ldl_chol_'=>'LDL-Chol',
								  '_hb_elpho_'=>'Hb-Elpho',
								  '_trak_'=>'TRAK',
								  '_waaler_rose_'=>'Waaler Rose',
								  '_influenza_a_antibody_'=>'Influenza A-AB',
								  '_benzodiazepam_in_urine_'=>'Benzodiazep.i.U.',
								  '_porphyrine_in_urine_'=>'Porphyrine i.U.',
								  
								  '_lipid_elpho_'=>'Lipid-Elpho',
								  '_hla_b_27_telx_'=>'HLA-B 27',
								  '_thyreoglobulin_'=>'Thyreoglobulin',
								  'tx_14'=>'Hepatitis',
								  '_influenza_b_antibody_'=>'Influenza B-AB',
								  '_cannabinol_in_urine_'=>'Cannabinol i.U.',
								  '_cortisol_in_urine_'=>'Cortisol i.U.',
								  
								  '_lipase_'=>'Lipase',
								  '_thrombo_antibody_telx_'=>'Thrombo-AB',
								  '_thyroxinbinding_globulin_'=>'Thyroxinbind.Glob.',
								  '_anti_hav_'=>'Anti-HAV',
								  '_lcm_antibody_'=>'LCM-AB',
								  '_cocain_in_urine_'=>'Cocain i.U.',
								  '_vms_in_urine_'=>'VMS i.U.',
								  
								  '_emx_amylase_'=>'Amylase',
								  '_leukocytes_phosphate_telx_'=>'WBC-Phosp.',
								 'tx_15'=>'Hormones',
								 '_anti_hav_igm_'=>'Anti-HAV-IgM',
								 '_leg_pneum_antibody_'=>'Leg.pneum.-AB',
								 '_methadon_in_urine_'=>'Methadon i.U.',
								 '_5_hies_in_urine_'=>'5.-Hies i.U.',
								 
								 '_uric_material_'=>'BUN',
								 'tx_16'=>'Bloodsugar',
								 '_acth_telx_'=>'ACTH',
								 '_hbs_antigen_'=>'HBs-Antigen',
								 '_leptospiria_antibody_'=>'Leptospiria-AB',
								 '_opiates_in_urine_'=>'Opiates i.U.',
								 '_hydroxyprolin_in_urine_'=>'Hydroxyprolin i.U.',
								 
								 '_uric_acid_'=>'Uric acid',
								 '_emx_bloodsugar_sober_'=>'fast Glucose',
								 '_aldosteron_'=>'Aldosteron',
								 '_anti_hbs_titer_'=>'Anti-HBs-Titer',
								 '_listeria_antibody_'=>'Listeria-AB',
								 'tx_17'=>'Prenatal',
								 '_cathecholamines_in_urine_'=>'Catecholam.i.U.',
								 
								 '_emx_krea_'=>'Crea',
								 '_emx_bloodsugar_9_00_'=>'Glucose. 9.00',
								 '_calcitonin_'=>'Calcitonin',
								 '_hbe_antigen_'=>'HBe-Antigen',
								 '_masern_antibody_'=>'Masern-AB',
								 '_chlamydia_smear_pregnancy_'=>'Chlamy.smear.',
								 '_pankreol_'=>'Pancreol.',
								 
								 '_emx_sodium_'=>'Sodium',
								 '_emx_bloodsugar_pp_'=>'Glucose. p.p.',
								 '_cortisol_'=>'Cortisol',
								 '_anti_hbe_'=>'Anti-HBe',
								 '_mononucleosis_'=>'Mononucleosis',
								 '_first_serology_'=>'1st serology',
								 '_aminolevulin_in_urine_'=>'Aminolövulin i.U.',
								 
								 '_emx_kalium_'=>'Potassium',
								 '_emx_bloodsugar_15_00_'=>'Glucose. 15.00',
								 '_cortisol_day_program_'=>'Cortisol dayprog.',
								 '_anti_hbc_'=>'Anti_HBc',
								 '_mumps_antibody_'=>'Mumps-AB',
								 '_pregnancy_'=>'SSW:',
								 'tx_18'=>'Sonstiges',
								 
								 '_emx_calcium_'=>'Calcium',
								 '_emx_bloodsugar_notime_'=>'Glucose.noTime',
								 '_fsh_'=>'FSH',
								 '_anti_hbc_igm_'=>'Anti-HBc IgM',
								 '_mycoplas_pneum_'=>'Mycopl.pneu.AB',
								 '_down_screening_'=>'Down screening',
								 '_emx_blood_alcohol_'=>'Blood alcohol',
								 
								 '_chloride_'=>'Chlorid',
								 '_emx_bloodsugar_notime_2_'=>'Glucose.noTime',
								 '_gastrin_'=>'Gastrin',
								 '_anti_hcv_'=>'Anti_HCV',
								 '_neurotrope_virus__x__neurotrope_virus_2_'=>'Neurotrop-V',
								 '_strep_b_quicktest_'=>'Strep-B-quick.test',
								 '_cdt_'=>'CDT',
								 
								 '_phospor_'=>'Phospor',
								 '_glucose_proof_'=>'Glucose proof',
								 '_hormone_hcg_'=>'HCG',
								 '_hepatitis_d_delta_a_'=>'Hep.D delta A',
								 '_parainfluenza_2_antibody_'=>'Par.influenz.2-AB',
								 '_tpha_'=>'TPHA',
								 '_vitamin_b12_'=>'Vitamin B12',
								 
								 '_magnesium_'=>'Magnesium',
								 '_lactose_proof_'=>'Lactose proof',
								 '_insulin_'=>'Insulin',
								 '_anti_hev_'=>'Anti-HEV',
								 '_parainfluenza_3_antibody_'=>'Par.influenz.3-AB',
								 '_hbs_ag_'=>'HBs-Ag',
								 '_folic_acid_'=>'Folic acid',
								 
								 '_iron_'=>'Iron',
								 '_hba_1c_'=>'HBA 1c',
								 '_cathecholamines_in_p_'=>'Catecholam.i.P.',
								 'tx_19'=>'Biopsies',
								 '_picoma_virus_antibody_'=>'Picoma-Virus-AB',
								 '_pregnancy_hiv1_hiv2_antibody_'=>'HIV1/HIV2-AB',
								 '_insulin_antibody_'=>'Insulin-AB',
								 
								 '_copper_'=>'Copper',
								 '_fructosamine_'=>'Fructosamine',
								 '_lh_'=>'LH',
								 '_punctat_cytology_'=>'Biopsy cytolog.',
								 '_rickettsia_antibody_'=>'Rickettsien-AB',
								 'tx_20'=>'Stuhl',
								 '_intrinsic_antibody_'=>'Intrinsic-AB',
								 
								 '_emx_osmolal_'=>'Osmolal.',
								 '_capillary_blood_sample_'=>'Capill.Blood',
								 '_oestradiol_'=>'Oestradiol',
								 '_protein_in_punctat_'=>'Protein i.Biopsy.',
								 '_reoteln_antibody_'=>'Röteln-AB',
								 '_chymotrypsin_'=>'Chymotrypsin',
								 '_stone_analysis_'=>'Stone analysis',
								 
								 '_emx_lactat_in_p_'=>'Lactat i.P.',
								 '_capillary_blood_sample_2_'=>'Capill.Blood',
								 '_oestriol_'=>'Oestriol',
								 '_ldh_in_punctat_'=>'LDH i.Biopsy',
								 '_roeteln_immune_status_'=>'Röt-Immunstat.',
								 '_blood_in_stool_'=>'Blood i.stool',
								 '_ace_'=>'ACE',
								 
								 '_ammoniac_'=>'Ammonia',
								 'tx_21'=>'Infant',
								 '_pregnancy_ssw_'=>'SSW:',
								 '_chol_in_punctat_'=>'Chol. i.Biopsy',
								 '_rs_virus_antibody_'=>'RS virus-AB',
								 '_blood_in_stool_2_'=>'Blood i.stool',
								 '_g1_'=>'G1',
								 
								 '_emx_free_hb_'=>'free Hb',
								 '_emx_infant_bilirubin_'=>'Infant.bilirubin',
								 '_parathormone_'=>'Parathormone',
								 '_cea_in_punctat_'=>'CEA i.Punctat',
								 '_shigella_salmonella_antibody_'=>'Shigell/Salm-AB',
								 '_blood_in_stool_3_'=>'Blood i.stool',
								 '_g2_'=>'G2',
								 
								 '_emx_crp_'=>'CRP',
								 '_emx_cord_bilirubin_'=>'Cord bili',
								 '_progesteron_'=>'Progesteron',
								 '_afp_in_punctat_'=>'AFP i.Biopsy',
								 '_toxoplasma_antibody__x__toxoplasma_antibody_2_'=>'Toxoplasma-AB',
								 'tx_22'=>'Rarity',
								 '_g3_'=>'G3',
								 
								 'tx_23'=>'Liquor',
								 '_emx_infant_bilirubin_direct_'=>'Bilirubin direct',
								 '_prolactin_1_'=>'Prolactin 1',
								 '_uric_material_in_punctat_'=>'Uricm.i.Biopsy',
								 '_infection_tpha__x__infection_tpha_2_'=>'TPHA',
								 '_rarity_h_'=>'Rarity H',
								 '_g4_'=>'G4',
								 
								 '_emx_liquor_status_'=>'Liquorstatus',
								 '_emx_infant_sugar_'=>'Infant glucose',
								 '_prolactin_2_'=>'Prolactin 2',
								 '_rheumafactor_in_punctat_'=>'Rheumaf.i.Biopsy',
								 '_varicella_antibody_'=>'Varicella-AB',
								 '_rarity_e_'=>'Rarity E',
								 '_g5_'=>'G5',
								 
								 '_liquor_elpho_'=>'Liquorelpho',
								 '_emx_infant_sugar_2_'=>'Infant glucose',
								 '_renin_'=>'Renin',
								 '_material_'=>'Material:',
								 '_yersinia_antibody_'=>'Yersinia-AB',
								 '_rarity_s_'=>'Rarity S',
								 '_g6_'=>'G6',
								 
								 '_liquor_cytology_'=>'Liquor cytology',
								 '_emx_infant_minor_blood_test_'=>'minor. BT',
								 '_serotonin_telx_'=>'Serotonin',
								 'blankline'=>'',
								 '_e1_'=>'E1',
								 '_urine_rarity_'=>'Urine rarity',
								 '_g7_'=>'G7',
								 
								 '_oligoklonal_igg_'=>'Oligoclona.IgG',
								 '_infant_diff_minor_blood_test_'=>'Diff.+m.BT',
								 '_somatomedin_c_'=>'Somatomedin C',
								 'blankline2'=>'',
								 '_e2_'=>'E2',
								 '_f1_'=>'F1',
								 '_g8_'=>'G8',
								 
								 '_reiber_schema_'=>'Reiber-Schema',
								 '_infant_reticulocytes_'=>'Retikulocytes',
								 '_testosteron_'=>'Testosteron',
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
								
								 'tx_24'=>'Doctor\'s sign',
								 'tx_25'=>'High risk >>',
								 '_highrisk_'=>'<< High risk',
								 'tx_26'=>'Rarity:',
								 'tx_27'=>'special Test',
								 'tx_28'=>'',
								 'tx_29'=>'clinical info',
								  );
?>
