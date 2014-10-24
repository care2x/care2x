<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
define('NO_CHAIN',1);
require($root_path.'include/core/inc_environment_global.php');

# Define to true to echo the sql query, for debugging 
define('SHOW_SQLQUERY',FALSE);

$lang_tables[]='search.php';
$lang_tables[]='billing.php';
define('LANG_FILE','aufnahme.php');
$local_user='aufnahme_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'include/core/inc_date_format_functions.php');

$breakfile='billingmenu.php'.URL_APPEND;
$returnfile='billingmenu.php'.URL_APPEND;
//$db->debug=1;

$toggle=0;

 /* Set color values for the search mask */
$searchmask_bgcolor='#f3f3f3';
$searchprompt=$LDEntryPrompt;
$entry_block_bgcolor='#fff3f3';
$entry_border_bgcolor='#6666ee';
$entry_body_bgcolor='#ffffff';

if(!isset($searchkey)) $searchkey='';
if(!isset($mode)) $mode='';

# Initialize page´s control variables
if($mode=='paginate'){
	$searchkey=$_SESSION['sess_searchkey'];
	
	# Check the sort item
	if($oitem=='encounter_nr') $oprep='enc'; 
		else $oprep='reg';
}else{
	# Reset paginator variables
	$pgx=0;
	$totalcount=0;
	$odir='';
	$oitem='name_last';
	$oprep='reg';
}

if(($mode=='search'||$mode=='paginate')&&!empty($searchkey)){

	if($mode!='paginate'){
		# Convert * wildcards
		$suchwort=trim($searchkey);
		$suchwort=strtr($suchwort,'*?','%_');
		$_SESSION['sess_searchkey']=$suchwort;
	}

	# Data to append to url
	$append='&status='.$status.'&target='.$target.'&user_origin='.$user_origin;

	# Paginator object
	include_once($root_path.'include/care_api_classes/class_paginator.php');
	$pagen=new Paginator($pgx,$thisfile,$_SESSION['sess_searchkey'],$root_path);

	include_once($root_path.'include/care_api_classes/class_globalconfig.php');
	$glob_obj=new GlobalConfig($GLOBAL_CONFIG);

	# Get the max nr of rows from global config
	$glob_obj->getConfig('pagin_patient_search_max_block_rows');
	# Last resort, use the default defined at the start of this page
	if(empty($GLOBAL_CONFIG['pagin_patient_search_max_block_rows'])) $pagen->setMaxCount(MAX_BLOCK_ROWS);
	else $pagen->setMaxCount($GLOBAL_CONFIG['pagin_patient_search_max_block_rows']);


	include_once($root_path.'include/care_api_classes/class_globalconfig.php');
	$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
	$glob_obj->getConfig('patient_%');

	$sqlselect="SELECT enc.encounter_nr,enc.encounter_class_nr, enc.is_discharged,  reg.name_last, reg.name_first, reg.date_birth, reg.addr_zip, reg.sex";
	$sqlfrom ="	FROM care_encounter as enc,care_person as reg ";
	$sqlwhere2= " AND enc.pid=reg.pid  
				AND enc.is_discharged NOT IN (1) 
				AND enc.status  IN ('','normal')";
	$orderby = " ORDER BY $oprep.$oitem $odir";
		
	if(is_numeric($suchwort)){
		$suchwort=(int) $suchwort;
		$numeric=1;
		$sqlwhere1=" WHERE enc.encounter_nr='$suchwort' ";
	}else{
		$sqlwhere1="WHERE (reg.name_last $sql_LIKE '".addslashes($suchwort)."%' 
							OR reg.name_first $sql_LIKE '".addslashes($suchwort)."%'";
		// Try converting the keyword to a proper date format
		$DOB=formatDate2STD($suchwort,$date_format);

		if(!empty($DOB) && $DOB!='--') $sqlwhere1.="	OR reg.date_birth $sql_LIKE '$DOB' ";

		$sqlwhere1.=")";

	}
	# Compose final sql query
	$sql=$sqlselect.$sqlfrom.$sqlwhere1.$sqlwhere2.$orderby;

	if($ergebnis=$db->SelectLimit($sql,$pagen->MaxCount(),$pgx)){

		if(defined('SHOW_SQLQUERY')&&SHOW_SQLQUERY) echo $sql;

		if ($linecount=$ergebnis->RecordCount()){
			if(($linecount==1) && $numeric&&(!defined('SHOW_SQLQUERY')||!SHOW_SQLQUERY)){
				$zeile=$ergebnis->FetchRow();
				header('location:patientbill.php'.URL_REDIRECT_APPEND.'&patnum='.$zeile['encounter_nr'].'&update=1&mode='.$mode.'&full_en='.$zeile['encounter_nr']);
				exit;
			}
		}
		$pagen->setTotalBlockCount($linecount);
		# Count total available data
		if(isset($totalcount) && $totalcount){
			$pagen->setTotalDataCount($totalcount);
		}else{
			if($result=$db->Execute("SELECT COUNT(enc.encounter_nr) AS max_nr".$sqlfrom.$sqlwhere1.$sqlwhere2)){
				$row=$result->FetchRow();
				$totalcount=$row['max_nr'];
				$pagen->setTotalDataCount($totalcount);
			}
		}
		$pagen->setSortItem($oitem);
		$pagen->setSortDirection($odir);


	}else{
		echo "<p>".$sql."<p>$LDDbNoRead";
	}
}else{
	$mode='';
}

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');



# Title in toolbar
 $smarty->assign('sToolbarTitle',$LDBilling . ' - ' .$LDSearch);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('billing.php','search-patient')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',$LDIntraEmail);
 ob_start();
?>
<ul>
	<FONT    SIZE=-1  FACE="Arial">
	<table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
		<tr>
			<td>
				<?php include($root_path.'include/core/inc_patient_searchmask.php'); ?>
			</td>
		</tr>
	</table>
	<p> <a href='<?php echo 'billingmenu.php'.URL_APPEND.'&target=search">'; ?>'><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?> /></a>
	<p> 
		<?php
if($mode=='search'||$mode=='paginate'){
	if ($linecount) echo str_replace("~nr~",$totalcount,$LDSearchFound).' '.$LDShowing.' '.$pagen->BlockStartNr().' '.$LDTo.' '.$pagen->BlockEndNr().'.';
		else echo str_replace('~nr~','0',$LDSearchFound); 
		  
	if ($linecount) { 

	# Load the common icons
	$img_options=createComIcon($root_path,'dollarsign.gif','0','',TRUE);
	$img_male=createComIcon($root_path,'spm.gif','0','',TRUE);
	$img_female=createComIcon($root_path,'spf.gif','0','',TRUE);
	$bgimg='tableHeaderbg3.gif';
	$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/'.$bgimg.'"';

	echo '<table border=0 cellpadding=2 cellspacing=1> <tr bgcolor="#0000aa" background="'.createBgSkin($root_path,'tableHeaderbg.gif').'">';
			
?>
	<td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b> <?php echo $pagen->makeSortLink($LDCaseNr,'encounter_nr',$oitem,$odir,$append);  ?></b></td>
	<td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b> <?php echo $pagen->makeSortLink($LDSex,'sex',$oitem,$odir,$append);  ?></b></td>
	<td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b> <?php echo $pagen->makeSortLink($LDLastName,'name_last',$oitem,$odir,$append);  ?></b></td>
	<td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b> <?php echo $pagen->makeSortLink($LDFirstName,'name_first',$oitem,$odir,$append);  ?></b></td>
	<td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b> <?php echo $pagen->makeSortLink($LDBday,'date_birth',$oitem,$odir,$append);  ?></b></td>
	<td <?php echo $tbg; ?> align='center'><FONT  SIZE=-1  FACE="Arial" color="#ffffff"><b> <?php echo $pagen->makeSortLink($LDZipCode,'addr_zip',$oitem,$odir,$append); ?></b></td>
	<td background="<?php echo createBgSkin($root_path,'tableHeaderbg.gif'); ?>" align=center><font face=arial size=2 color="#ffffff"><b><?php echo $LDSelect; ?></td>
	</tr>
	<?php
	while($zeile=$ergebnis->FetchRow()) {

		$full_en=$zeile['encounter_nr'];
		echo " <tr bgcolor=";
		if($toggle) { echo "#efefef>"; $toggle=0;} else {echo "#ffffff>"; $toggle=1;};
		echo"<td><font face=arial size=2>";
		echo '&nbsp;'.$full_en;
		if($zeile['encounter_class_nr']=='2') echo ' <img '.createComIcon($root_path,'redflag.gif').'> <font size=1 color="red">'.$LDAmbulant.'</font>';
		echo "</td>";

		echo '<td>';
		switch($zeile['sex']){
			case 'f': echo '<img '.$img_female.'>'; break;
			case 'm': echo '<img '.$img_male.'>'; break;
			default: echo '&nbsp;'; break;
		}
		echo '</td>
						';	

		echo"<td><font face=arial size=2>";
		echo "&nbsp;".ucfirst($zeile['name_last']);
		echo "</td>";
		echo"<td><font face=arial size=2>";
		echo "&nbsp;".ucfirst($zeile['name_first']);
		echo "</td>";
		echo"<td><font face=arial size=2>";
		echo "&nbsp;".formatDate2Local($zeile['date_birth'],$date_format);
		echo "</td>";
		echo"<td><font face=arial size=2>";
		echo "&nbsp;".$zeile['addr_zip'];
		echo "</td>";

		// Temporarily set to edit-for-all-user mode
		echo '
		<td><font face=arial size=2>&nbsp;
			<a href="patientbill.php'.URL_APPEND.'&patnum='.$zeile['encounter_nr'].'&update=1&mode='.$mode.'&full_en='.$full_en.'">
			<img '.$img_options.' alt="Bill this patient"></a>&nbsp;';
			
		if(!file_exists($root_path.'cache/barcodes/en_'.$full_en.'.png')) {
			echo "<img src='".$root_path."classes/barcode/image.php?code=".$full_en."&style=68&type=I25&width=180&height=50&xres=2&font=5&label=2&form_file=en' border=0 width=0 height=0>";
		}

		echo '</td></tr>';

	}
	echo '
	<tr><td colspan=6><font face=arial size=2>'.$pagen->makePrevLink($LDPrevious,$append).'</td>
	<td align=right><font face=arial size=2>'.$pagen->makeNextLink($LDNext,$append).'</td>
	</tr>
	</table>';
	if($linecount>$pagen->MaxCount()) {
		/* Set the appending nr for the searchform */
		$searchform_count=2;
					?>
	<p>
	<table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
		<tr>
			<td>
				<?php
            include($root_path.'include/core/inc_patient_searchmask.php');
	   ?>
			</td>
		</tr>
	</table>
	<?php
					}
	}
	echo '</td>
			</tr>
		</table>';
}


 $sTemp = ob_get_contents();
 ob_end_clean();

 # Assign to main template object
	$smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

 ?>