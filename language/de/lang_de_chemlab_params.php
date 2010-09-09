<?php
/**
* This are the chemical lab test groups and parameters. If you are not sure of their exact translation please leave it in the original form
*/

$top_param=array(
	'00q'=>'Quick',
	'00ptt'=>'PTT',
	'00hb'=>'Hb',
	'00hc'=>'Hk',
	'00pla'=>'Thromboyzten',
	'00rbc'=>'Erythrozyten',
	'00wbc'=>'Leukozyten',
	'00ca'=>'Calcium',
	'00na'=>'Natrium',
	'00k'=>'Kalium',
	'00sug'=>'Blutzucker');

// Klinische Chemie parameter
$klinichemie_list0=array(	
	'0aph'=>'Alk. Ph.',
	'0agt'=>'Alpha GT',
	'0amm'=>'Ammoniak',
	'0amy'=>'Amylase',
	'0bit'=>'Billi gesamt',
	'0bid'=>'Billi direkt',
	'0ca'=>'Calcium',
	'0chl'=>'Chlorid',
	'0cho'=>'Chol',
	'0chol'=>'Cholinesterase',
	'0ccmb'=>'CKMB',
	'0cpc'=>'CPK',
	'0crp'=>'CRP',
	'0fe'=>'Eisen',
	'0rbc'=>'Erythrocyten',
	'0fhb'=>'freies Hb',
	'0gldh'=>'GLDH',
	'0got'=>'GOT',
	'0gpt'=>'GPT',
	'0ucid'=>'Harnsäure',
	'0urea'=>'Harnstoff',
	'0hbdh'=>'HBDH',
	'0hdlc'=>'HDL Chol',
	'0pot'=>'Kalium',
	'0cre'=>'Krea',
	'0co'=>'Kupfer',
	'0lac'=>'Lactat i.P.',
	'0ldh'=>'LDH',
	'0ldlc'=>'LDL Chol',
	'0lip'=>'Lipase',
	'0lpid'=>'Lipid Elpho',
	'0mg'=>'Magnesium',
	'0myo'=>'Myoglobin',
	'0na'=>'Natrium',
	'0osm'=>'Osmolal.',
	'0pho'=>'Phosphor',
	'0glo'=>'Serumzucker',
	'0tri'=>'Tri',
	'0tro'=>'Troponin T' );

// Liquor parameter
$liquor_list1=array(
	'1stat'=>'Liquorstatus',
	'1elp'=>'Liquorelpho',
	'1oli'=>'Oligoklonales IgG',
	'1sch'=>'Reiber Schema',
	'1a1'=>'A1');

// Gerinnung parameter
$gerinnung_list2=array(
	'2fiby'=>'Fibrinolyse',
	'2q'=>'Quick',
	'2ptt'=>'PTT',
	'2ptz'=>'PTZ',
	'2fibg'=>'Fibrinogen',
	'2fibs'=>'Lösl.Fibr.mon.',
	'2fsp'=>'FSP dimer',
	'2coag'=>'Thr.Coag.',
	'2at3'=>'AT III',
	'2f8'=>'Faktor VII',
	'2apc'=>'APC Resistenz',
	'2prc'=>'Protein C',
	'2prs'=>'Protein S',
	'2bt'=>'Blutungszeit');

//H�matologie parameter
$haematologie_list3=array(
	'3ret'=>'Retikulozyten',
	'3mal'=>'Malaria',
	'3hbe'=>'Hb Elpho',
	'3hla'=>'HLA B 27',
	'3tab'=>'Thrombo AK',
	'3wbp'=>'Leukocyten Phosp.');

// Blutzucker parameter
$blutzucker_list4=array(
	'4bsf'=>'Blutzucker_n�_',
	'4bs9'=>'Blutzucker_9_00',
	'4bsp'=>'Blutzucker_p_p_',
	'4bs15'=>'Blutzucker_15_00',
	'4bs1'=>'Blutzucker_ohne_Zeit_1',
	'4bs2'=>'Blutzucker_ohne_Zeit_2',
	'4glo'=>'Glucose Bel_',
	'4lac'=>'Lactose Bel_',
	'4hba'=>'HBA 1c',
	'4fru'=>'Fructosamine');

// S�ugling parameter
$saeugling_list5=array(
	'5bil'=>'Säugling Bilirubin',
	'5bilc'=>'Nabelbilirubin',
	'5bild'=>'Bilirubin direkt',
	'5glo1'=>'Säuglingszucker 1',
	'5glo2'=>'Säuglingszucker 2',
	'5ret'=>'Retikulozyten',
	'5b1'=>'B1');

// Proteine parameter
$proteine_list6=array(
	'6tot'=>'Ges. Eiweiss',
	'6alb'=>'Albumin',
	'6elp'=>'Elpho',
	'6imm'=>'Immunfixation',
	'6b2'=>'Beta2 Mikroglobulin.i.S',
	'6img'=>'Immunglobulinquant.',
	'6ige'=>'IgE',
	'6hap'=>'Haptoglobin',
	'6tra'=>'Transferrin',
	'6fer'=>'Ferritin',
	'6coe'=>'Coeruloplasmin',
	'6alp'=>'Alpha 1 Antitrypsin',
	'6afp'=>'AFP Grav.',
	'6ssw'=>'SSW:',
	'6mic'=>'Alpha 1 Mikroglobulin');

// Schilddr�se parameter
$schilddruse_list7=array(
	'7t3'=>'T3',
	'7t4'=>'Thyroxin/T4',
	'7tshb'=>'TSH Basal',
	'7tshs'=>'TSH stim.',
	'7tab'=>'TAK',
	'7mab'=>'MAK',
	'7trab'=>'TRAK',
	'7glob'=>'Thyreoglobulin',
	'7thx'=>'Thyroxinbind.Glob.',
	'7ft3'=>'freies T3',
	'7ft4'=>'freies T4');

// Hormone parameter
$hormone_list8=array(
	'8acth'=>'ACTH',
	'8ald'=>'Aldosteron',
	'8cal'=>'Calcitonin',
	'8cor'=>'Cortisol',
	'8dcor'=>'Cortisol Tagespr.',
	'8fsh'=>'FSH',
	'8gas'=>'Gastrin',
	'8hcg'=>'HCG',
	'8ins'=>'Insulin',
	'8cat'=>'Katecholam.i.P.',
	'8lh'=>'LH',
	'8osd'=>'Oestradiol',
	'8osd'=>'Oestriol',
	'8ssw'=>'SSW:',
	'8par'=>'Parathormon',
	'8prg'=>'Progesteron',
	'8pr1'=>'Prolactin I',
	'8pr2'=>'Prolactin II',
	'8ren'=>'Renin',
	'8ser'=>'Serotonin',
	'8som'=>'Somatomedin C',
	'8tes'=>'Testosteron',
	'8c1'=>'C1');

// Tumormarker parameter
$tumormarker_list9=array(
	'9afp'=>'AFP',
	'9c153'=>'CA. 15 3',
	'9c199'=>'CA. 19 9',
	'9c125'=>'CA. 125',
	'9cea'=>'CEA',
	'9c212'=>'Cyfra. 21 2',
	'9hcg'=>'HCG',
	'9nse'=>'NSE',
	'9psa'=>'PSA',
	'9scc'=>'SCC',
	'9tpa'=>'TPA');

// Gewebe AK parameter
$gewebeak_list10=array(
	'10ana'=>'ANA',
	'10ama'=>'AMA',
	'10dnsab'=>'DNS AK',
	'10asm'=>'ASMA',
	'10ena'=>'ENA',
	'10anc'=>'ANCA');

// Rheumafakt~
$rheumafakt_list11=array(
	'11ast'=>'Anti Strepto Titer',
	'11lrf'=>'Lat. RF',
	'11stz'=>'Streptozyme',
	'11waa'=>'Waaler Rose');

// Hepatitis parameter
$hepatitis_list12=array(
	'12hav'=>'Anti HAV',
	'12hai'=>'Anti HAV IgM',
	'12hba'=>'Hbs Antigen',
	'12hbt'=>'Anti HBs Titer',
	'12hbe'=>'Anti HBe',
	'12hbc'=>'Anti HBc',
	'12hci'=>'Anti HBc.IgM',
	'12hcv'=>'Anti HCV',
	'12hda'=>'Hep.D Delta A.',
	'12hev'=>'Anti HEV');

// Punktate parameter
$punktate_list13=array(
	'13pro'=>'Eiweiss i.Punktat',
	'13ldh'=>'LDH i.Punktat',
	'13cho'=>'Chol.i.Punktat',
	'13cea'=>'CEA i.Punktat',
	'13afp'=>'AFP i.Punktat',
	'13ure'=>'Harns.i.Punktat',
	'13rhe'=>'Rheumafakt.i.Punktat',
	'13d1'=>'D1',
	'13d2'=>'D2');

// Infektionsserologie
$infektion_list14=array(
	'14stap'=>'Antistaph.Titer',
	'14ade'=>'Adenovirus AK',
	'14bor'=>'Borrelien AK',
	'14bori'=>'Borr.Immunoblot',
	'14bru'=>'Brucellen AK',
	'14cam'=>'Campylob. AK',
	'14can'=>'Candida AK',
	'14car'=>'Cardiotr.Viren',
	'14chl'=>'Chlamydien AK',
	'14psi'=>'C.psittaci AK',
	'14cox'=>'Coxsack. AK',
	'14qf'=>'Cox.burn. AK(Q Fieber)',
	'14cyt'=>'Cytomegalie AK',
	'14ebv'=>'EBV AK',
	'14ecc'=>'Echinococcus AK',
	'14ecv'=>'Echo Viren AK',
	'14fsme'=>'FSME AK',
	'14hs1'=>'Herpes simp. I AK',
	'14hs2'=>'Herpes simp. II AK',
	'14hiv'=>'HIV1/HIV2 AK',
	'14ina'=>'Influenza A AK',
	'14inb'=>'Influenza B AK',
	'14lcm'=>'LCM AK',
	'14leg'=>'Leg.pneum AK',
	'14lep'=>'Leptospiren AK',
	'14lis'=>'Listerien AK',
	'14mas'=>'Masern AK',
	'14mon'=>'Mononucleose',
	'14mum'=>'Mumps AK',
	'14myc'=>'Mycoplas.pneum AK',
	'14neu'=>'Neutrope Viren AK',
	'14pi2'=>'Parainfluenza II AK',
	'14pi3'=>'Parainfluenza III AK',
	'14pic'=>'Picorna Virus AK',
	'14ric'=>'Rickettsien AK',
	'14rot'=>'R�teln AK',
	'14roi'=>'R�teln Immunstatus',
	'14rsv'=>'RS Virus AK',
	'14shi'=>'Shigellen/Salm AK',
	'14tox'=>'Toxoplasma AK',
	'14tpha'=>'TPHA',
	'14vrc'=>'Varicella AK',
	'14yer'=>'Yersinien AK',
	'14e1'=>'E1',
	'14e2'=>'E2',
	'14e3'=>'E3',
	'14e4'=>'E4');

// Medikamente 
$medikamente_list15=array(
	'15ami'=>'Amiodaron',
	'15bar'=>'Barbiturate.i.S.',
	'15ben'=>'Benzodiazep.i.S.',
	'15car'=>'Carbamazepin',
	'15clo'=>'Clonazepam',
	'15dig'=>'Digitoxin',
	'15dgo'=>'Digoxin',
	'15gen'=>'Gentamycin',
	'15lit'=>'Lithium',
	'15phe'=>'Phenobarbital',
	'15pny'=>'Phenytoin',
	'15pri'=>'Primidon',
	'15sal'=>'Salizyls�ure',
	'15the'=>'Theophyllin',
	'15tob'=>'Tobramycin',
	'15val'=>'Valproins�ure',
	'15van'=>'Vancomycin',
	'15amp'=>'Amphetamine.i.U.',
	'15ant'=>'Antidepressiva.i.U.',
	'15bau'=>'Barbiturate.i.U.',
	'15beu'=>'Benzodiazep.i.U.',
	'15can'=>'Cannabinol.i.U.',
	'15coc'=>'Kokain.i.U',
	'15met'=>'Methadon.i.U.',
	'15opi'=>'Opiate.i.U.');

// Muttersch~ Vorsorge
$muttersch_list16=array(
	'16chl'=>'Chlamyd.Abstr./SSW',
	'16ssw'=>'SSW:',
	'16dow'=>'Down Screening',
	'16stb'=>'Strep B Schnelltest',
	'16tpha'=>'TPHA',
	'16hbs'=>'HBs Ag',
	'16hiv'=>'HIV1/HIV2 AK' );

// Stuhl
$stuhl_list17=array(
	'17chy'=>'Chymotrypsin',
	'17ob1'=>'Stuhl auf Blut 1',
	'17ob2'=>'Stuhl auf Blut 2',
	'17ob3'=>'Stuhl auf Blut 3');

// Rarit�ten
$raritaeten_list18=array(
	'18rh'=>'Rarit�t H.',
	'18re'=>'Rarit�t E.',
	'18rs'=>'Rarit�t S.',
	'18uri'=>'Urinrarit�t',
	'18f1'=>'F1',
	'18f2'=>'F2',
	'18f3'=>'F3');

// Urin / Spontanurin
$urin_list19=array(
	'19amy'=>'Urinamylase',
	'19sug'=>'Urinzucker',
	'19pro'=>'Eiweiss.i.U.',
	'19alb'=>'Albumin.i.U.',
	'19osm'=>'Osmol.i.U.',
	'19pre'=>'Schwangerschaftst.',
	'19cym'=>'Cytomeg.i.Urin',
	'19cyt'=>'Urincytologie',
	'19bj'=>'Bence Jones',
	'19elp'=>'Urin Elpho',
	'19bm2'=>'Beta2 Mikroglobulin.i.U.');

// Sammelurin
$sammelurin_list20=array(
	'20adc'=>'Addis Count',
	'20na'=>'Na i.U.','K i.U.',
	'20ca'=>'Ca i.U.',
	'20pho'=>'Phospor i.U.',
	'20ura'=>'Harns�ure i.U.',
	'20cre'=>'Kreatinin i.U.',
	'20por'=>'Porphyrine i.U.',
	'20cor'=>'Cortisol i.U.',
	'20hyd'=>'Hydroxyprolin i.U.',
	'20cat'=>'Katecholamine i.U.',
	'20pan'=>'Pankreol.',
	'20gam'=>'Gamma Aminol�bulinsre.i.U.');

// Sonstiges
$sonstiges_list21=array(
	'21bal'=>'Blutalkohol',
	'21cdt'=>'CDT',
	'21vb12'=>'Vitamin B12',
	'21fol'=>'Fols�ure',
	'21inab'=>'Insulin AK',
	'21iab'=>'Intrinsic AK',
	'21sto'=>'Steinanalyse',
	'21ace'=>'ACE',
	'21g1'=>'G1',
	'21g2'=>'G2',
	'21g3'=>'G3',
	'21g4'=>'G4',
	'21g5'=>'G5',
	'21g6'=>'G6',
	'21g7'=>'G7',
	'21g8'=>'G8',
	'21g9'=>'G9',
	'21g10'=>'G10');

?>
