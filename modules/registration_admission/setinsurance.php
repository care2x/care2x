<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');

$sql='Select * from care_insurance_firm';

if($result=$db->Execute($sql)) {
    if($result->RecordCount()) {
	     $c=1;
	     while($row=$result->FetchRow()){
		     $sql='update care_insurance_firm set firm_id='.$c.' where name="'.$row['name'].'"';
			 $db->Execute($sql);
			 echo $sql.'<br>';
			 $c++;
		}
	}
}

?>
