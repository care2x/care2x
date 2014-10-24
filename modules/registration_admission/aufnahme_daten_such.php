<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
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
///$db->debug=true;

define('MAX_BLOCK_ROWS',30); 

define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'include/core/inc_date_format_functions.php');

$thisfile=basename(__FILE__);
$toggle=0;

if($_COOKIE['ck_login_logged'.$sid]) $breakfile=$root_path.'main/startframe.php'.URL_APPEND;
	else $breakfile='aufnahme_pass.php'.URL_APPEND.'&target=entry';

# Set value for the search mask
$searchprompt=$LDEntryPrompt;

# Special case for direct access from patient listings
# If forward nr ok, use it as searchkey
if(isset($fwd_nr) && $fwd_nr&&is_numeric($fwd_nr)){
	$searchkey=$fwd_nr;
	$mode='search';
}else{
	if(!isset($searchkey)) $searchkey='';
}

if(!isset($mode)) $mode='';

// Initialize page's control variables
if($mode=='paginate'){
	$searchkey=$_SESSION['sess_searchkey'];
}else{
	# Reset paginator variables
	$pgx=0;
	$totalcount=0;
	$odir='';
	$oitem='';
}
#Load and create paginator object
require_once($root_path.'include/care_api_classes/class_paginator.php');
$pagen=new Paginator($pgx,$thisfile,$_SESSION['sess_searchkey'],$root_path);

if(isset($mode)&&($mode=='search'||$mode=='paginate')&&isset($searchkey)&&($searchkey)){
	
	include_once($root_path.'include/core/inc_date_format_functions.php');

	//$db->debug=true;

	if($mode!='paginate'){
		$_SESSION['sess_searchkey']=$searchkey;
	}	
		# convert * and ? to % and &
		$searchkey=strtr($searchkey,'*?','%_');
		
		$GLOBAL_CONFIG=array();
		include_once($root_path.'include/care_api_classes/class_globalconfig.php');
		$glob_obj=new GlobalConfig($GLOBAL_CONFIG);

		# Get the max nr of rows from global config
		$glob_obj->getConfig('pagin_patient_search_max_block_rows');
		if(empty($GLOBAL_CONFIG['pagin_patient_search_max_block_rows'])) $pagen->setMaxCount(MAX_BLOCK_ROWS); # Last resort, use the default defined at the start of this page
			else $pagen->setMaxCount($GLOBAL_CONFIG['pagin_patient_search_max_block_rows']);
		
	   	$searchkey=trim($searchkey);
		$suchwort=$searchkey;
		
		if(is_numeric($suchwort)) {

            $suchwort=(int) $suchwort;
			$numeric=1;
			
			if(empty($oitem)) $oitem='encounter_nr';			
			if(empty($odir)) $odir='DESC'; # default, latest pid at top
			
			$sql2=" WHERE ( enc.encounter_nr='$suchwort'  OR enc.encounter_nr $sql_LIKE '%.$suchwort' )";
	    } else {
			# Try to detect if searchkey is composite of first name + last name
			if(stristr($searchkey,',')){
				$lastnamefirst=TRUE;
			}else{
				$lastnamefirst=FALSE;
			}
			
			$searchkey=strtr($searchkey,',',' ');
			$cbuffer=explode(' ',$searchkey);

			# Remove empty variables
			for($x=0;$x<sizeof($cbuffer);$x++){
				$cbuffer[$x]=trim($cbuffer[$x]);
				if($cbuffer[$x]!='') $comp[]=$cbuffer[$x];
			}
			
			# Arrange the values, ln= lastname, fn=first name, bd = birthday
			if($lastnamefirst){
				$fn=$comp[1];
				$ln=$comp[0];
				$bd=$comp[2];
			}else{
				$fn=$comp[0];
				$ln=$comp[1];
				$bd=$comp[2];
			}
			
			if(empty($oitem)) $oitem='name_last';						
        			
			# Check the size of the comp
			if(sizeof($comp)>1){
				$sql2=" WHERE ( reg.name_last $sql_LIKE '".strtr($ln,'+',' ')."%'
			                		AND reg.name_first $sql_LIKE '".strtr($fn,'+',' ')."%')";
				if($bd){ 
					$stddate=formatDate2STD($bd,$date_format);
					if(!empty($stddate)){
						$sql2.=" AND (reg.date_birth = '$stddate' OR reg.date_birth $sql_LIKE '%$bd%')";
					}
				}
					
				if(empty($odir)) $odir='DESC'; # default, latest birth at top
		
			}else{
			
				$sql2=" WHERE (reg.name_last $sql_LIKE '".strtr($suchwort,'+',' ')."%'
			                		OR reg.name_first $sql_LIKE '".strtr($suchwort,'+',' ')."%'";
				$bufdate=formatDate2STD($suchwort,$date_format);
				if(!empty($bufdate)){
					$sql2.= " OR reg.date_birth $sql_LIKE '$bufdate'";
				}
				$sql2.=")";
				if(empty($odir)) $odir='ASC'; # default, ascending alphabetic
			}
		}

    	//gjergji - hide patient info of other departements
/*    	if(isset($_SESSION['department_nr']) && $_SESSION['department_nr'] != '' ) {
    		$cond.=" AND ( ";
    		while (list($key, $val) = each($_SESSION['department_nr'])) {
    			$tmp .= "enc.current_dept_nr = " . $val . " OR ";
    
    		}
    		$cond .= substr($tmp,0,-4) ;
    		$cond .= " ) "	;
    	}
		$sql2 .= $cond;*/
		//end : gjergji	
			
			$sql2.=" AND enc.pid=reg.pid
					  AND enc.encounter_status <> 'cancelled'
					  AND enc.is_discharged=0
					  AND enc.status NOT IN ('void','hidden','inactive','deleted')  ORDER BY ";

			# Filter if it is personnel nr
			if($oitem=='encounter_nr') $sql2.='enc.'.$oitem.' '.$odir;
				else $sql2.='reg.'.$oitem.' '.$odir;
				

			$dbtable='FROM care_encounter as enc,care_person as reg ';

			$sql='SELECT enc.encounter_nr, enc.encounter_class_nr, enc.is_discharged,
								reg.name_last, reg.name_first, reg.date_birth, reg.addr_zip,reg.sex '.$dbtable.$sql2;
			//echo $sql;

			if($ergebnis=$db->SelectLimit($sql,$pagen->MaxCount(),$pagen->BlockStartIndex()))
       		{
				if ($linecount=$ergebnis->RecordCount()) 
				{
					if(($linecount==1) && $numeric&&$mode=='search')
					{
						$zeile=$ergebnis->FetchRow();
						header('Location:aufnahme_daten_zeigen.php'.URL_REDIRECT_APPEND.'&from=such&encounter_nr='.$zeile['encounter_nr'].'&target=search');
						exit;
					}
					
					$pagen->setTotalBlockCount($linecount);
					
					# If more than one count all available
					if(isset($totalcount) && $totalcount){
						$pagen->setTotalDataCount($totalcount);
					}else{
						# Count total available data
						if($dbtype=='mysql' ){
							$sql='SELECT COUNT(enc.encounter_nr) AS "count" '.$dbtable.$sql2;
						}else{
							$sql='SELECT * '.$dbtable.$sql2;
						}

						if($result=$db->Execute($sql)){
							if ($totalcount=$result->RecordCount()) {
								if($dbtype=='mysql'){
									$rescount=$result->FetchRow();
    									$totalcount=$rescount['count'];
								}
    							}
						}
						$pagen->setTotalDataCount($totalcount);
					}
					# Set the sort parameters
					$pagen->setSortItem($oitem);
					$pagen->setSortDirection($odir);
				}
				
			}
			 else {echo "<p>".$sql."<p>$LDDbNoRead";};
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Title in the toolbar
 //$smarty->assign('sToolbarTitle',$LDPatientSearch);
 $smarty->assign('sToolbarTitle',"$LDAdmission :: $LDSearch");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDPatientSearch);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('admission_how2search.php','$from')");

  # Onload Javascript code
 $smarty->assign('sOnLoadJs','onLoad="if(window.focus) window.focus();document.searchform.searchkey.select();"');

 # Hide the return button
 $smarty->assign('pbBack',FALSE);

#
# Load the tabs
#
$target='search';
$parent_admit = TRUE;
include('./gui_bridge/default/gui_tabs_patadmit.php');

#
# Prepare the javascript validator
#
if(!isset($searchform_count) || !$searchform_count){
	$smarty->assign('sJSFormCheck','<script language="javascript">
	<!--
		function chkSearch(d){
			if((d.searchkey.value=="") || (d.searchkey.value==" ")){
				d.searchkey.focus();
				return false;
			}else	{
				return true;
			}
		}
	// -->
	</script>');
}

#
# Prepare the form params
#
$sTemp = 'method="post" name="searchform';
if($searchform_count) $sTemp = $sTemp."_".$searchform_count;
$sTemp = $sTemp.'" onSubmit="return chkSearch(this)"';
if(isset($search_script) && $search_script!='') $sTemp = $sTemp.' action="'.$search_script.'"';
$smarty->assign('sFormParams',$sTemp);
$smarty->assign('searchprompt',$searchprompt);

#
# Prepare the hidden inputs
#
$smarty->assign('sHiddenInputs','<input type="image" '.createLDImgSrc($root_path,'searchlamp.gif','0','absmiddle').'>
		<input type="hidden" name="sid" value="'.$sid.'">
		<input type="hidden" name="lang" value="'.$lang.'">
		<input type="hidden" name="noresize" value="'.$noresize.'">
		<input type="hidden" name="target" value="'.$target.'">
		<input type="hidden" name="user_origin" value="'.$user_origin.'">
		<input type="hidden" name="origin" value="'.$origin.'">
		<input type="hidden" name="retpath" value="'.$retpath.'">
		<input type="hidden" name="aux1" value="'.$aux1.'">
		<input type="hidden" name="ipath" value="'.$ipath.'">
		<input type="hidden" name="mode" value="search">');

$smarty->assign('sCancelButton','<a href="patient.php'.URL_APPEND.'&target=search"><img '.createLDImgSrc($root_path,'cancel.gif','0').'></a>');

if($mode=='search'||$mode=='paginate'){
	
	if ($linecount) $smarty->assign('LDSearchFound',str_replace("~nr~",$totalcount,$LDSearchFound).' '.$LDShowing.' '.$pagen->BlockStartNr().' '.$LDTo.' '.$pagen->BlockEndNr().'.');
		else $smarty->assign('LDSearchFound',str_replace('~nr~','0',$LDSearchFound));

	if ($linecount) {

		$smarty->assign('bShowResult',TRUE);

		# Load the common icons and images
		$img_options=createComIcon($root_path,'pdata.gif','0');
		$img_male=createComIcon($root_path,'spm.gif','0');
		$img_female=createComIcon($root_path,'spf.gif','0');

		$smarty->assign('LDCaseNr',$pagen->makeSortLink($LDCaseNr,'encounter_nr',$oitem,$odir,$targetappend));
		$smarty->assign('LDSex',$pagen->makeSortLink($LDSex,'sex',$oitem,$odir,$targetappend));
		$smarty->assign('LDLastName',$pagen->makeSortLink($LDLastName,'name_last',$oitem,$odir,$targetappend));
		$smarty->assign('LDFirstName',$pagen->makeSortLink($LDFirstName,'name_first',$oitem,$odir,$targetappend));
		$smarty->assign('LDBday',$pagen->makeSortLink($LDBday,'date_birth',$oitem,$odir,$targetappend));
		$smarty->assign('LDZipCode',$pagen->makeSortLink($LDZipCode,'addr_zip',$oitem,$odir,$targetappend));
		$smarty->assign('LDOptions',$LDOptions);

		$sTemp = '';
		while($zeile=$ergebnis->FetchRow()){

			$full_en=$zeile['encounter_nr'];

			$smarty->assign('toggle',$toggle);
			$toggle = !$toggle;

			$smarty->assign('sCaseNr',$full_en);

			if($zeile['encounter_class_nr']==2){
				$smarty->assign('sOutpatientIcon','<img '.createComIcon($root_path,'redflag.gif').'>');
				$smarty->assign('LDAmbulant',$LDAmbulant);
			}else{
				$smarty->assign('sOutpatientIcon','');
				$smarty->assign('LDAmbulant','');
			}

			switch(strtolower($zeile['sex'])){
				case 'f': $smarty->assign('sSex','<img '.$img_female.'>'); break;
				case 'm': $smarty->assign('sSex','<img '.$img_male.'>'); break;
				default: $smarty->assign('sSex','&nbsp;'); break;
			}
			$smarty->assign('sLastName',ucfirst($zeile['name_last']));
			$smarty->assign('sFirstName',ucfirst($zeile['name_first']));

			#
			# If person is dead show a black cross
			#
			if($zeile['death_date']&&$zeile['death_date']!=$dbf_nodate) $smarty->assign('sCrossIcon','<img '.createComIcon($root_path,'blackcross_sm.gif','0','absmiddle').'>');
				else $smarty->assign('sCrossIcon','');

			$smarty->assign('sBday',formatDate2Local($zeile['date_birth'],$date_format));

			$smarty->assign('sZipCode',$zeile['addr_zip']);

			$sTarget = "<a href=\"aufnahme_daten_zeigen.php".URL_APPEND."&from=such&encounter_nr=$full_en&target=search\">";
			$sTarget=$sTarget.'<img '.$img_options.' title="'.$LDShowData.'"></a>';
			$smarty->assign('sOptions',$sTarget);

			if(!file_exists($root_path.'cache/barcodes/en_'.$full_en.'.png')){
				$smarty->assign('sHiddenBarcode',"<img src='".$root_path."classes/barcode/image.php?code=".$full_en."&style=68&type=I25&width=180&height=50&xres=2&font=5&label=2' border=0 width=0 height=0>");
			}
			#
			# Generate the row in buffer and append as string
			#
			ob_start();
				$smarty->display('registration_admission/admit_search_list_row.tpl');
				$sTemp = $sTemp.ob_get_contents();
			ob_end_clean();
		}

		#
		# Assign the rows string to template
		#
		$smarty->assign('sResultListRows',$sTemp);

		$smarty->assign('sPreviousPage',$pagen->makePrevLink($LDPrevious));
		$smarty->assign('sNextPage',$pagen->makeNextLink($LDNext));
	}
}
/*
$smarty->assign('sPostText','<a href="aufnahme_start.php'.URL_APPEND.'&mode=?">'.$LDAdmWantEntry.'</a><br>
	<a href="aufnahme_list.php'.URL_APPEND.'">'.$LDAdmWantArchive.'</a>');
*/
$smarty->assign('sPostText','<a href="aufnahme_list.php'.URL_APPEND.'">'.$LDAdmWantArchive.'</a>');

# Stop buffering, assign contents and display template

$smarty->assign('sMainIncludeFile','registration_admission/admit_search_main.tpl');

$smarty->assign('sMainBlockIncludeFile','registration_admission/admit_plain.tpl');

$smarty->display('common/mainframe.tpl');

?>
