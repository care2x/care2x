<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 2.0.1 - 2004-07-04
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/

# Default value for the maximum nr of rows per block displayed, define this to the value you wish
# In normal cases this value is derived from the db table "care_config_global" using the "pagin_insurance_list_max_block_rows" element.
define('MAX_BLOCK_ROWS',30); 
define('SHOW_SEARCH_QUERY',1); # Set to 1 if you want to display the query conditions, 0 to hide

define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_date_format_functions.php');

$thisfile=basename(__FILE__);
$breakfile='patient.php'.URL_APPEND;

$newdata=1;

$dbtable='care_person';

$target='archiv';

$error=0;

# Initialize page�s control variables
if($mode=='paginate'){
	$searchkey=$_SESSION['sess_searchkey'];
	//$searchkey='USE_SESSION_SEARCHKEY';
	//$mode='search';
}else{
	# Reset paginator variables
	$pgx=0;
	$totalcount=0;
	$odir='';
	$oitem='';
}
require_once($root_path.'include/care_api_classes/class_paginator.php');

$pagen=new Paginator($pgx,$thisfile,$_SESSION['sess_searchkey'],$root_path);


require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('person%');

# Get the max nr of rows from global config
$glob_obj->getConfig('pagin_person_search_max_block_rows');
if(empty($GLOBAL_CONFIG['pagin_person_search_max_block_rows'])) $pagen->setMaxCount(MAX_BLOCK_ROWS); # Last resort, use the default defined at the start of this page
	else $pagen->setMaxCount($GLOBAL_CONFIG['pagin_person_search_max_block_rows']);

	
if (isset($mode) && ($mode=='search'||$mode=='paginate')){

	//if(empty($oitem)) $oitem='name_last';			
	//if(empty($odir)) $odir='ASC'; # default, ascending alphabetic
	# Set the sort parameters
	$pagen->setSortItem($oitem);
	$pagen->setSortDirection($odir);

	if($mode=='paginate'){
		if(isset($oitem)&&!empty($oitem))	$sql=$_SESSION['sess_searchkey']." ORDER BY $oitem $odir";
			else $sql=$_SESSION['sess_searchkey'];
		$s2=$sql; # Dummy  to force the sql query to be executed
	}else{
	
		# convert * and ? to % and &
		$searchkey=strtr($searchkey,'*?','%_');

		$sql="SELECT pid, date_reg, name_last, name_first, date_birth, addr_zip, sex, death_date, status FROM $dbtable WHERE ";
		$s2='';
							
							if(isset($pid)&&$pid)
							{
						         if($pid < $GLOBAL_CONFIG['person_id_nr_adder'])
								 {
								 		$s2.=" pid $sql_LIKE '%$pid'";
								 }
								 else
								 {
								       $s2.=" pid = ".$pid;
								}
							}
						
							
							if(isset($name_last)&&$name_last)
							{
							     if($s2) $s2.=" AND name_last $sql_LIKE '$name_last%'"; else $s2.=" name_last $sql_LIKE '$name_last%'";
							}
							
							if(!isset($date_start)) $date_start='';
							if(!isset($date_end)) $date_end='';
							
							if($date_start){
								    $date_start=@formatDate2STD($date_start,$date_format);
  								}
							if($date_end){
								    $date_end=@formatDate2STD($date_end,$date_format);
							   }

							$buffer='';
							if(($date_start)&&($date_end))
								{
									$buffer=" date_reg >= '$date_start 00:00:00' AND date_reg <= '$date_end 23:59:59'";
								}
								elseif($date_start)
								{
									$buffer=" date_reg $sql_LIKE '$date_start%'";
									//if($s2) $s2.=" AND date_reg $sql_LIKE '$date_start %'"; else $s2.=" date_reg $sql_LIKE '$date_start %'";
								}
								elseif($date_end)
								{
									$buffer=" (date_reg <= '$date_end')";
									//if($s2) $s2.=" AND (date_reg $sql_LIKE '$date_end %' OR date_reg $sql_LIKE '$date_end %')"; else $s2.=" date_reg $sql_LIKE '$date_end %'";
								}
								if($buffer){
									if($s2) $s2.=" AND $buffer";
										else $s2=$buffer;
								}
									
							if(isset($user_id)&&$user_id)
								if($s2) $s2.=" AND modify_id $sql_LIKE '$user_id%'"; else $s2.=" modify_id $sql_LIKE '$user_id%'";
								
								
							if(isset($name_first)&&$name_first)
								if($s2) $s2.=" AND name_first $sql_LIKE '$name_first%'"; else $s2.=" name_first $sql_LIKE '$name_first%'";
							if(isset($name_2)&&$name_2)
								if($s2) $s2.=" AND name_2 $sql_LIKE '$name_2%'"; else $s2.=" name_2 $sql_LIKE '$name_2%'";
								
							if(isset($name_3)&&$name_3)
								if($s2) $s2.=" AND name_3 $sql_LIKE '$name_3%'"; else $s2.=" name_3 $sql_LIKE '$name_3%'";
							if(isset($name_middle)&&$name_middle)
								if($s2) $s2.=" AND name_middle $sql_LIKE '$name_middle%'"; else $s2.=" name_middle $sql_LIKE '$name_middle%'";
							if(isset($name_maiden)&&$name_maiden)
								if($s2) $s2.=" AND name_maiden $sql_LIKE '$name_maiden%'"; else $s2.=" name_maiden $sql_LIKE '$name_maiden%'";
							if(isset($name_others)&&$name_others)
								if($s2) $s2.=" AND name_others $sql_LIKE '$name_others%'"; else $s2.=" name_others $sql_LIKE '$name_others%'";

							if(isset($date_birth)&&$date_birth)
							  {
							    $date_birth=@formatDate2STD($date_birth,$date_format);
								
								if($s2) $s2.=" AND date_birth='$date_birth'"; else $s2.=" date_birth='$date_birth'";
							  }
							  
							if(isset($addr_str)&&$addr_str)
								if($s2) $s2.=" AND addr_str $sql_LIKE '%$addr_str%'"; else $s2.=" addr_str $sql_LIKE '%$addr_str%'";

							if(isset($addr_str_nr)&&$addr_str_nr)
								if($s2) $s2.=" AND addr_str_nr $sql_LIKE '%$addr_str_nr%'"; else $s2.=" addr_str_nr $sql_LIKE '%$addr_str_nr%'";
							if(isset($addr_citytown_nr)&&$addr_citytown_nr)
								if($s2) $s2.=" AND addr_citytown_nr $sql_LIKE '$addr_citytown_nr'"; else $s2.=" addr_citytown_nr $sql_LIKE '$addr_citytown_nr'";
							if(isset($addr_zip)&&$addr_zip)
								if($s2) $s2.=" AND addr_zip $sql_LIKE '%$addr_zip%'"; else $s2.=" addr_zip $sql_LIKE '%$addr_zip%'";
								
							if(isset($sex)&&$sex)
								if($s2) $s2.=" AND sex = '$sex'"; else $s2.=" sex = '$sex'";
							if(isset($civil_status)&&$civil_status)
								if($s2) $s2.=" AND civil_status = '$civil_status'"; else $s2.=" civil_status = '$civil_status'";
							if(isset($phone_1)&&$phone_1)
								if($s2) $s2.=" AND phone_1_nr $sql_LIKE '$phone_1%'"; else $s2.=" phone_1_nr $sql_LIKE '$phone_1%'";
							if(isset($phone_2)&&$phone_2)
								if($s2) $s2.=" AND phone_2_nr $sql_LIKE '$phone_2%'"; else $s2.=" phone_2_nr $sql_LIKE '$phone_2%'";
							if(isset($cellphone_1)&&$cellphone_1)
								if($s2) $s2.=" AND cellphone_1_nr $sql_LIKE '$cellphone_1%'"; else $s2.=" cellphone_1_nr $sql_LIKE '$cellphone_1%'";
							if(isset($cellphone_2)&&$cellphone_2)
								if($s2) $s2.=" AND cellphone_2_nr $sql_LIKE '$cellphone_2%'"; else $s2.=" cellphone_2_nr $sql_LIKE '$cellphone_2%'";
								
							if(isset($fax)&&$fax)
								if($s2) $s2.=" AND fax $sql_LIKE '$fax%'"; else $s2.=" fax $sql_LIKE '$fax%'";
							if(isset($email)&&$email)
								if($s2) $s2.=" AND email $sql_LIKE '%$email%'"; else $s2.=" email $sql_LIKE '%$email%'";
							if(isset($sss_nr)&&$sss_nr)
								if($s2) $s2.=" AND sss_nr $sql_LIKE '$sss_nr%'"; else $s2.=" sss_nr $sql_LIKE '$sss_nr%'";
							if(isset($nat_id_nr)&&$nat_id_nr)
								if($s2) $s2.=" AND nat_id_nr $sql_LIKE '$nat_id_nr%'"; else $s2.=" nat_id_nr $sql_LIKE '$nat_id_nr%'";
							if(isset($religion)&&$religion)
								if($s2) $s2.=" AND religion $sql_LIKE '$religion%'"; else $s2.=" religion $sql_LIKE '$religion%'";
							if(isset($ethnic_orig)&&$ethnic_orig)
								if($s2) $s2.=" AND ethnic_orig $sql_LIKE '$ethnic_orig%'"; else $s2.=" ethnic_orig $sql_LIKE '$ethnic_orig%'";
								
		
		$_SESSION['sess_searchkey']=$sql.$s2;
		
		if(isset($oitem)&&!empty($oitem))	$sql=$sql.$s2." ORDER BY $oitem $odir";
			else $sql=$sql.$s2;
		//echo $sql;
	}
							
	if($s2!=''){
		//echo $sql;
			//if($ergebnis=$db->Execute($sql)) 
		if($ergebnis=$db->SelectLimit($sql,$pagen->MaxCount(),$pagen->BlockStartIndex())){			
		
			$rows=$ergebnis->RecordCount();
									
			if($rows==1&&$searchkey!='USE_SESSION_SEARCHKEY'){
				//* If result is single item, display the data immediately */
				$result=$ergebnis->FetchRow();
				header("Location:patient_register_show.php".URL_REDIRECT_APPEND."&target=archiv&origin=archiv&pid=".$result['pid']);
				exit;
			}else{

				$pagen->setTotalBlockCount($rows);
					
				# If more than one count all available
				if(isset($totalcount)&&$totalcount){
					$pagen->setTotalDataCount($totalcount);
				}else{
					$sql="SELECT COUNT(pid) AS maxnr FROM $dbtable WHERE ".$s2;
			 		if($result=$db->Execute($sql)){
						@$maxres=$result->FetchRow();
						$totalcount=$maxres['maxnr'];
						$pagen->setTotalDataCount($totalcount);
					}
				}
			}
		}else{
			echo "$LDDbNoRead<p> $sql <p>";
		}
	}
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Added for the common header top block

 $smarty->assign('sToolbarTitle',$LDPatientRegister.' - '.$LDAdvancedSearch);

 # Added for the common header top block
 $smarty->assign('pbHelp',"javascript:gethelp('submenu1.php','$LDPatientRegister.' - '.$LDAdvancedSearch')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$$LDPatientRegister.' - '.$LDAdvancedSearch);

 $smarty->assign('sOnLoadJs','onLoad="if (window.focus) window.focus();"');

 $smarty->assign('pbHelp',"javascript:gethelp('person_archive.php')");

 $smarty->assign('pbBack',FALSE);

# Load GUI page
require('./gui_bridge/default/gui_person_reg_archive.php');

?>
