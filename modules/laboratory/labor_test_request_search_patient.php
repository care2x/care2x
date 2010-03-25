<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
# Default value for the maximum nr of rows per block displayed, define this to the value you wish
# In normal cases this value is derived from the db table "care_config_global" using the "pagin_insurance_list_max_block_rows" element.
define('MAX_BLOCK_ROWS',30); 

$lang_tables[]='search.php';
$lang_tables[]='actions.php';
define('LANG_FILE','lab.php');
$local_user='ck_lab_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

$dbtable='care_admission_patient';

$toggle=0;

$append=URL_APPEND."&target=$target&noresize=1&user_origin=$user_origin";

switch($target)
{
  case 'chemlabor': $entry_block_bgcolor="#fff3f3";
                          $entry_border_bgcolor="#ee6666";
						  $entry_body_bgcolor="#ffffff";
						  $breakfile="nursing-station-patientdaten-doconsil-chemlabor.php$append";
						  break;
  case 'baclabor': $entry_block_bgcolor="#fff3f3";
                          $entry_border_bgcolor="#ee6666";
						  $entry_body_bgcolor="#ffffff";
						  $breakfile="nursing-station-patientdaten-doconsil-baclabor.php$append";
						  break;
  case 'patho': $entry_block_bgcolor="#cde1ec";
                          $entry_border_bgcolor="#cde1ec";
						  $entry_body_bgcolor="#ffffff";
						  $breakfile="nursing-station-patientdaten-doconsil-patho.php$append";
						  break;
  case 'blood': $entry_block_bgcolor="#99ffcc";
                          $entry_border_bgcolor="#99ffcc";
						  $entry_body_bgcolor="#ffffff";
						  $breakfile="nursing-station-patientdaten-doconsil-blood.php$append";
						  break;
  case 'radio': $entry_block_bgcolor="#efefef";
                          $entry_border_bgcolor="#fcfcfc";
						  $entry_body_bgcolor="#ffffff";
						  $breakfile="nursing-station-patientdaten-doconsil-radio.php$append";
						  break;
  default            : $entry_block_bgcolor="#fff3f3";
                          $entry_border_bgcolor="#ee6666";
						  $entry_body_bgcolor="#ffffff";
						  $breakfile="nursing-station-patientdaten-doconsil-baclabor.php$append";
}

$breakfile=$root_path.'modules/nursing/'.$breakfile;
$thisfile=basename(__FILE__);
# Data to append to url
$append='&status='.$status.'&target='.$target.'&user_origin='.$user_origin;

# Initialize page�s control variables
if($mode=='paginate'){
	$searchkey=$_SESSION['sess_searchkey'];
	//$searchkey='USE_SESSION_SEARCHKEY';
	//$mode='search';
}else{
	# Reset paginator variables
	$pgx=0;
	$totalcount=0;
	$odir='ASC';
	$oitem='name_last';
}
# Paginator object
require_once($root_path.'include/care_api_classes/class_paginator.php');
$pagen=new Paginator($pgx,$thisfile,$_SESSION['sess_searchkey'],$root_path);

require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);

# Get the max nr of rows from global config
$glob_obj->getConfig('pagin_patient_search_max_block_rows');
if(empty($GLOBAL_CONFIG['pagin_patient_search_max_block_rows'])) $pagen->setMaxCount(MAX_BLOCK_ROWS); # Last resort, use the default defined at the start of this page
	else $pagen->setMaxCount($GLOBAL_CONFIG['pagin_patient_search_max_block_rows']);


if(($mode=='search'||$mode=='paginate')&&!empty($searchkey)){
	# Convert other wildcards
	$searchkey=strtr($searchkey,'*?','%_');
	# Save the search keyword for eventual pagination routines
	if($mode=='search') $_SESSION['sess_searchkey']=$searchkey;

	include_once($root_path.'include/core/inc_date_format_functions.php');
	include_once($root_path.'include/care_api_classes/class_encounter.php');
	$enc_obj=new Encounter;

	$encounter=& $enc_obj->searchLimitEncounterBasicInfo($searchkey,$pagen->MaxCount(),$pgx,$oitem,$odir);
	//echo $enc_obj->getLastQuery();
	# Get the resulting record count
	$linecount=$enc_obj->LastRecordCount();
	if($linecount==1&&$mode=='search'){
		$row=$encounter->FetchRow();
		header("location:".$root_path."modules/nursing/nursing-station-patientdaten-doconsil-".$target.".php".URL_REDIRECT_APPEND."&pn=".$row['encounter_nr']."&edit=1&status=".$status."&target=".$target."&user_origin=".$user_origin."&noresize=1&mode=");
		exit;
	}
	//$linecount=$address_obj->LastRecordCount();
	$pagen->setTotalBlockCount($linecount);
	# Count total available data
	if(isset($totalcount)&&$totalcount){
		$pagen->setTotalDataCount($totalcount);
	}else{
		@$enc_obj->searchEncounterBasicInfo($searchkey);
		$totalcount=$enc_obj->LastRecordCount();
		$pagen->setTotalDataCount($totalcount);
	}
	$pagen->setSortItem($oitem);
	$pagen->setSortDirection($odir);

}
//echo $target;
# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

# Title in toolbar
 $smarty->assign('sToolbarTitle', $LDTestRequest." - ".$LDSearchPatient);

  # hide back button
 $smarty->assign('pbBack',FALSE);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('request_search.php')");

 # href for close button
 if($_COOKIE["ck_login_logged".$sid]) $smarty->assign('breakfile',$root_path.'main/startframe.php'.URL_APPEND);
	else  $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDTestRequest." - ".$LDSearchPatient);

# Body onload javascript code
$smarty->assign('sOnLoadJs','onLoad="document.searchform.searchkey.select()"');

 # Collect extra javascript code

 ob_start();
?>

<ul>
<FONT  class="prompt"><?php echo $LDTestRequestFor.$LDTestType[$target] ?></font>
<table width=90% border=0 cellpadding="0" cellspacing="0">
<tr bgcolor="<?php echo $entry_block_bgcolor ?>" >
<td ><p><br>
<ul>

		 <table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php
	   
	        $searchmask_bgcolor="#f3f3f3";
            include('includes/inc_test_request_searchmask.php');
       
	   ?>
</td>
     </tr>
   </table>

<p>
<a href="<?php	echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
<p>

<?php
//echo $mode;
if ($linecount) echo '<hr width=80% align=left>'.str_replace("~nr~",$totalcount,$LDSearchFound).' '.$LDShowing.' '.$pagen->BlockStartNr().' '.$LDTo.' '.$pagen->BlockEndNr().'.';
		else echo str_replace('~nr~','0',$LDSearchFound); 
if ($enc_obj->record_count) { 
	# Preload  common icon images
	$img_male=createComIcon($root_path,'spm.gif','0','',TRUE);
	$img_female=createComIcon($root_path,'spf.gif','0','',TRUE);
	$bgimg='tableHeaderbg3.gif';
	//$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/'.$bgimg.'"';
	$tbg= 'class="adm_list_titlebar"';

?>
				<table border=0 cellpadding=2 cellspacing=1> 
				<tr bgcolor="#abcdef">				

     <td <?php echo $tbg; ?>><b>
	  <?php echo $pagen->makeSortLink($LDCaseNr,'encounter_nr',$oitem,$odir,$append);  ?></b></td>
      <td <?php echo $tbg; ?>><b>
	  <?php echo $pagen->makeSortLink($LDSex,'sex',$oitem,$odir,$append);  ?></b></td>
      <td <?php echo $tbg; ?>><b>
	  <?php echo $pagen->makeSortLink($LDLastName,'name_last',$oitem,$odir,$append);  ?></b></td>
      <td <?php echo $tbg; ?>><b>
	  <?php echo $pagen->makeSortLink($LDName,'name_first',$oitem,$odir,$append);  ?></b></td>
      <td <?php echo $tbg; ?>><b>
	  <?php echo $pagen->makeSortLink($LDBday,'date_birth',$oitem,$odir,$append);  ?></b></td>
      <td <?php echo $tbg; ?> align='center'><b>
	  <?php echo $pagen->makeSortLink($LDZipCode,'addr_zip',$oitem,$odir,$append); ?></b></td>
    <td background="<?php echo createBgSkin($root_path,'tableHeaderbg.gif'); ?>" align=center><font color="#ffffff"><b><?php echo $LDSelect; ?></td>
					</tr>
<?php

					while($row=$encounter->FetchRow())
					{
						$full_en=$row['encounter_nr'];
						echo "
							<tr class=";
						if($toggle) { echo '"wardlistrow1">'; $toggle=0;} else {echo '"wardlistrow2">'; $toggle=1;};
						echo"<td>";
						echo "&nbsp;".$full_en;
                        echo '&nbsp;</td><td>';	

						switch($row['sex']){
							case 'f': echo '<img '.$img_female.'>'; break;
							case 'm': echo '<img '.$img_male.'>'; break;
							default: echo '&nbsp;'; break;
						}	
						
						echo'</td><td>';
						echo "&nbsp;".ucfirst($row['name_last']);
                        echo "</td>";	
						echo"<td>";
						echo "&nbsp;".ucfirst($row['name_first']);
                        echo "</td>";	
						echo"<td>";
						echo "&nbsp;".formatDate2Local($row['date_birth'],$date_format);
                        echo "</td>";	
						echo"<td>";
						echo "&nbsp;".$row['addr_zip'];
                        echo "</td>";	

					    if($_COOKIE[$local_user.$sid]) echo '
						<td>&nbsp;';
						echo "
							<a href=\"".$root_path."modules/nursing/nursing-station-patientdaten-doconsil-".$target.".php".URL_APPEND."&pn=".$row['encounter_nr']."&edit=1&status=".$status."&target=".$target."&user_origin=".$user_origin."&noresize=1&mode=\">";
						echo '	
							<img '.createLDImgSrc($root_path,'ok_small.gif','0').' alt="'.$LDTestThisPatient.'"></a>&nbsp;';
							
                       if(!file_exists($root_path."cache/barcodes/en_".$full_en.".png"))
	      		       {
			               echo "<img src='".$root_path."classes/barcode/image.php?code=".$full_en."&style=68&type=I25&width=180&height=50&xres=2&font=5&label=2&form_file=en' border=0 width=0 height=0>";
		               }
						echo '</td></tr>';

					}
					
					echo '
						<tr><td colspan=6>'.$pagen->makePrevLink($LDPrevious,$append).'</td>
						<td align=right>'.$pagen->makeNextLink($LDNext,$append).'</td>
						</tr>
						</table>';
					if($linecount>$pagen->MaxCount())
					{
?>
		 <table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php
	   
	        $searchform_count=2;
            include('includes/inc_test_request_searchmask.php');
       
	   ?>
</td>
     </tr>
   </table>
<?php
					}
				}
?>
</ul>
&nbsp;

<p>
</td>
</tr>
</table>        
</ul>
<p>
<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign to page template object
$smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

 ?>
