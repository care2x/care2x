<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (eregi("inc_labor_param_group.php",$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/


/**
* The test parameters for each group are in the /language/?/lang_?_chemlab_params.php file
*/
						
$paralistarray=array(
	'priority'=>$top_param,
	'clinical_chem'=>$klinichemie_list0,
	'liquor'=>$liquor_list1,
	'coagulation'=>$gerinnung_list2,
	'hematology'=>$haematologie_list3,
	'blood_sugar'=>$blutzucker_list4,
	'neonate'=>$saeugling_list5,
	'proteins'=>$proteine_list6,
	'thyroid'=>$schilddruse_list7,
	'hormones'=>$hormone_list8,
	'tumor_marker'=>$tumormarker_list9,
	'tissue_antibody'=>$gewebeak_list10,
	'rheuma_factor'=>$rheumafakt_list11,
	'hepatitis'=>$hepatitis_list12,
	'biopsy'=>$punktate_list13,
	'infection_serology'=>$infektion_list14,
	'medicines'=>$medikamente_list15,
	'prenatal'=>$muttersch_list16,
	'stool'=>$stuhl_list17,
	'rare'=>$raritaeten_list18,
	'urine'=>$urin_list19,
	'total_urine'=>$sammelurin_list20,
	'special_params'=>$sonstiges_list21);

?>
