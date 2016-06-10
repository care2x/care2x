<html>
	<head>

	</head>
</html>
<?php

require('./roots.php');
require($root_path . 'include/core/inc_environment_global.php');
$lang_tables[] = 'date_time.php';
$lang_tables[] = 'reporting.php';
require($root_path . 'include/core/inc_front_chain_lang.php');
require($root_path . 'language/en/lang_en_reporting.php');
require($root_path . 'language/en/lang_en_date_time.php');
require($root_path . 'include/core/inc_date_format_functions.php');
require_once($root_path . 'include/care_api_classes/class_tz_insurance.php');
require_once($root_path.'include/care_api_classes/class_ward.php');
$ward_obj=new Ward;
$items='nr,name';
$TP_SELECT_BLOCK_IN='';
$ward_info=$ward_obj->getAllWardsItemsObject($items);
    $TP_SELECT_BLOCK_IN.='<select name="current_ward_nr" size="1"><option value="all_ipd">all</option>';
					if(!empty($ward_info)&&$ward_info->RecordCount()){
						while($station=$ward_info->FetchRow()){
							$TP_SELECT_BLOCK_IN.='
								<option value="'.$station['nr'].'" ';
							if(isset($current_ward_nr)&&($current_ward_nr==$station['nr'])) $TP_SELECT_BLOCK.='selected';
							$TP_SELECT_BLOCK_IN.='>'.$station['name'].'</option>';
						}
					}
					$TP_SELECT_BLOCK_IN.='</select>';

require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj= new Department;
$medical_depts=$dept_obj->getAllMedical();
$TP_SELECT_BLOCK='<select name="dept_nr" size="1"><option value="all_opd">all</option>';
$later_depts = $medical_depts;

while(list($x,$v)=each($medical_depts)){
	$TP_SELECT_BLOCK.='
	<option value="'.$v['nr'].'">';
	$buffer=$v['LD_var'];
	if(isset(${$buffer})&&!empty(${$buffer})) $TP_SELECT_BLOCK.=${$buffer};
		else $TP_SELECT_BLOCK.=$v['name_formal'];
	$TP_SELECT_BLOCK.='</option>';
}
$TP_SELECT_BLOCK.='</select>';



$insurance_obj = new Insurance_tz;

#Load and create paginator object
require_once($root_path . 'include/care_api_classes/class_tz_reporting.php');
/**
 * getting summary of OPD...
 */
$rep_obj = new selianreport();


//require_once('include/core/inc_timeframe.php');
/**
 * Getting the timeframe...
 */
$debug = FALSE;
$PRINTOUT = FALSE;
$EXPORT = FALSE;

if (empty($_GET['printout']) && empty($_GET['export'])) {




    if (isset($_POST['date_from']) && !empty($_POST['date_from']) && isset($_POST['date_to']) && !empty($_POST['date_to'])) {

        $selected_date_from = @formatDate2STD($_POST['date_from'], $date_format);
        $selected_date_to = @formatDate2STD($_POST['date_to'], $date_format);
    }




}



if ($_GET['printout'] || isset($_GET['printout'])) {
    $PRINTOUT = TRUE;
}

if ($_GET['export'] || isset($_GET['export'])) {
    $EXPORT = TRUE;
}

require_once('gui/gui_DetailedRevenue.php');
?>
