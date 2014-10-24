<?php
/*------begin------ This protection code was suggested by Luki R. luki@karet.org ---- */
if (stristr($_SERVER['SCRIPT_NAME'],'inc_drg_entry_save.php')) 
	die('<meta http-equiv="refresh" content="0; url=../">');
/*------end------*/

require_once($root_path.'include/care_api_classes/class_drg.php');

# Bug patch 2003-06-19
if(is_object($DRG_obj)) unset($DRG_obj);

$multiple_save=true;
$saveok=0;

if(!isset($group_nr)) $group_nr=0;
if(!isset($opnr)) $opnr=0;

# Bug patch 2003-06-19
$DRG_obj=new DRG($pn); // Create a drg object

# Prepare the common data
$data['encounter_nr']=$pn;
$data['date']=date('Y-m-d H:i:s');
$data['op_nr']=$opnr;
$data['group_nr']=$group_nr;
$data['category_nr']=99; // This is a dummy entry to force the new entries to appear below the current entries in the table
$data['history']="Create ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n";
$data['modify_id']=$_SESSION['sess_user_name'];
$data['create_id']=$_SESSION['sess_user_name'];
$data['create_time']=date('YmdHis');

switch($element)
{
	case 'icd_code': 
	{	
		$data['code_version']=$DRG_obj->ICDVersion();
		$data['diagnosing_clinician']=$_SESSION['sess_user_name'];
		$data['diagnosing_dept_nr']=$dept_nr;
		$DRG_obj->useDiagnosis();
		$qlist_type='diagnosis';
		break;
	}
	case 'ops_code':
	{
		$data['code_version']=$DRG_obj->OPSVersion();
		$data['responsible_clinician']=$_SESSION['sess_user_name'];
		$data['responsible_dept_nr']=$dept_nr;
		$DRG_obj->useProcedure();
		$qlist_type='procedure';
		break;
	}
	case 'ops_intern_code':
	{
		$DRG_obj->useInternalDRG();
		$qlist_type='drg_intern';
		if(isset($current) && $current){
			if(!$DRG_obj->EncounterDRGGroupExists($sel)){
				$data['group_nr']=$sel;
				# pass the variable as reference
				$DRG_obj->setDataArray($data);
				# Now insert the data
				$DRG_obj->insertDataFromInternalArray();
				# Set all non-grouped diagnoses and procedures to this group number
				$DRG_obj->groupNonGroupedItems($sel);
				$saveok=1;
				$multiple_save=false;
				$group_nr=$sel;
				//echo $thisfile;
			}
		}
	}
}

if($multiple_save){
	for($i=0;$i<$lastindex;$i++){
		$selx="$itemselector$i";
		$hidx="$hidselector$i";
		if($$selx=='') continue;
		if($element=='ops_intern_code'){
			if($DRG_obj->EncounterDRGGroupExists($$selx)) continue;
				else $data['group_nr']=$$selx;
		}
		$data['code']=$$selx;
		$data['code_parent']=$$hidx;
			
		# pass the variable as reference
		$DRG_obj->setDataArray($data);
		# Now insert the data
		$DRG_obj->insertDataFromInternalArray();
		//echo $DRG_obj->getLastQuery()."<p>";

		$data['qlist_type']=$qlist_type;
		$data['code_type']=$qlist_type;
		$data['dept_nr']=$dept_nr;
		
		# Update quick list table
		$DRG_obj->addQuickCode($data);
		//echo $DRG_obj->getLastQuery()."<br>";
		# Update related code table
		$DRG_obj->addDRGRelatedCode($data);
		//echo $DRG_obj->getLastQuery()."<br>";
	}
	$saveok=1;
}
// Redirect and exit 
$buf="location:$thisfile?sid=$sid&lang=$lang&saveok=$saveok&pn=$pn&opnr=$opnr&group_nr=$group_nr&edit=$edit&ln=$ln&fn=$fn&bd=$bd&dept_nr=$dept_nr&oprm=$oprm&y=$y&m=$m&d=$d&display=$display&target=$target";
//echo $buf;
if(!$noheader){
	header($buf);
	exit;
}
?>
