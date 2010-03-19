<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR),

### The following arrays are the "role" levels each containing an access point or groups of access points

$all='_a_0_all';
$sysadmin='System_Admin';

$allow_area=array(

'admit'=>array('_a_1_admissionwrite','_a_1_medocswrite'),

'cafe'=>array('_a_1_newsallwrite', '_a_1_newscafewrite'),

'medocs'=>array('_a_1_medocswrite'),

'phonedir'=>array('$all, $sysadmin'),

'doctors'=>array('_a_1_opdoctorallwrite', '_a_1_doctorsdutyplanwrite'),

'wards'=>array('_a_1_doctorsdutyplanwrite', '_a_1_opdoctorallwrite', '_a_1_nursingstationallwrite',  $all, $sysadmin),

'op_room'=>array('_a_1_opdoctorallwrite', '_a_1_opnursedutyplanwrite', '_a_2_opnurseallwrite'),

'tech'=>array('_a_1_techreception'),

'lab_r'=>array('_a_1_labresultswrite', '_a_2_labresultsread'),

'lab_w'=>array('_a_1_labresultswrite'),

'lab_all'=>array('_a_1_laball'),

'radio'=>array('_a_1_radiowrite', '_a_1_opdoctorallwrite', '_a_2_opnurseallwrite'),

'pharma_db'=>array('_a_1_pharmadbadmin'),

'pharma_receive'=>array('_a_1_pharmadbadmin', '_a_2_pharmareception'),

'pharma'=>array('_a_1_pharmadbadmin', '_a_2_pharmareception',  '_a_3_pharmaorder'),

'depot_db'=>array('_a_1_meddepotdbadmin'),

'depot_receive'=>array('_a_1_meddepotdbadmin', '_a_2_meddepotreception'),

'depot'=>array('_a_1_meddepotdbadmin', '_a_2_meddepotreception', '_a_3_meddepotorder'),

'edp'=>array('no_allow_type_all',),

'news'=>array('_a_1_newsallwrite'),

'cafenews'=>array('_a_1_newsallwrite', '_a_2_newscafewrite'),

'op_docs'=>array('_a_1_opdoctorallwrite'),

'duty_op'=>array('_a_1_opnursedutyplanwrite'),

'fotolab'=>array('_a_1_photowrite'),

'test_diagnose'=>array('_a_1_diagnosticsresultwrite', '_a_1_labresultswrite'),

'test_receive'=>array('_a_1_diagnosticsresultwrite', '_a_1_labresultswrite', '_a_2_diagnosticsreceptionwrite'),

'test_order'=>array('_a_1_diagnosticsresultwrite', '_a_1_labresultswrite', '_a_2_diagnosticsreceptionwrite',   '_a_3_diagnosticsrequest')
)

?>
