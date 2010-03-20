<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
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
define('LANG_FILE','aufnahme.php');
# Resolve the local user based on the origin of the script
require_once('include/inc_local_user.php');
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_date_format_functions.php');

# Set break file
require('include/inc_breakfile.php');

$toggle=0;

 /* Set color values for the search mask */
$searchmask_bgcolor='#f3f3f3';
$searchprompt=$LDEntryPrompt;
$entry_block_bgcolor='#fff3f3';
$entry_border_bgcolor='#6666ee';
$entry_body_bgcolor='#ffffff';

if(!isset($searchkey)) $searchkey='';
if(!isset($mode)) $mode='';

# Initialize page's control variables
if($mode=='paginate'){
	$searchkey=$_SESSION['sess_searchkey'];
}else{
	# Reset paginator variables
	$pgx=0;
	$totalcount=0;
	$odir='ASC';
	$oitem='name_last';
}
#Load and create paginator object
require_once($root_path.'include/care_api_classes/class_paginator.php');
$pagen=new Paginator($pgx,$thisfile,$_SESSION['sess_searchkey'],$root_path);
//$db->debug=true;
if(($mode=='search'||$mode=='paginate')&&($searchkey))
{
	$searchkey=strtr($searchkey,'*?','%_');
	# Save the search keyword for eventual pagination routines
	if($mode=='search') $_SESSION['sess_searchkey']=$searchkey;
	
		include_once($root_path.'include/care_api_classes/class_globalconfig.php');
        $glob_obj=new GlobalConfig($GLOBAL_CONFIG);
        $glob_obj->getConfig('patient_%');

		# Get the max nr of rows from global config
		//$glob_obj->getConfig('pagin_patient_search_max_block_rows');
		if(empty($GLOBAL_CONFIG['pagin_patient_search_max_block_rows'])) $pagen->setMaxCount(MAX_BLOCK_ROWS); # Last resort, use the default defined at the start of this page
			else $pagen->setMaxCount($GLOBAL_CONFIG['pagin_patient_search_max_block_rows']);

			$suchwort=trim($searchkey);
			if(is_numeric($suchwort))
			{
				$suchwort=(int) $suchwort;
				$numeric=1;
				//if($suchwort < $patient_inpatient_nr_adder) $suchbuffer=$suchwort+$patient_inpatient_nr_adder; else $suchbuffer=$suchwort;
				$suchbuffer=$suchwort;
			}
			
			$sql='SELECT enc.encounter_nr,
								enc.encounter_class_nr, 
								enc.is_discharged,
								reg.pid,
								reg.name_last, 
								reg.name_first, 
								reg.date_birth, 
								reg.sex,
								reg.death_date';
			$dbtable ='
			          FROM 	care_encounter AS enc,
					  			care_person AS reg
					  WHERE  ';

			if($numeric) $sql2.=" enc.encounter_nr $sql_LIKE '".addslashes($suchbuffer)."'";
				else $sql2.= "( reg.name_last $sql_LIKE '".addslashes($suchwort)."%'
			              OR reg.name_first $sql_LIKE '".addslashes($suchwort)."%')";
			
			$sql2.="  AND enc.pid=reg.pid
					  AND enc.encounter_status<>'cancelled'
					  AND  enc.is_discharged IN ('',0)
					  AND (enc.in_ward  NOT IN ('',0) OR enc.in_dept NOT IN ('',0))
					  AND enc.status NOT IN ('void','hidden','deleted','inactive') ";
/*			$sql2= '
			          WHERE
					  (
			               reg.name_last LIKE "'.addslashes($suchwort).'%" 
			              OR reg.name_first LIKE "'.addslashes($suchwort).'%"
			              OR reg.date_birth LIKE "'.@formatDate2Std($suchwort,$date_format).'%"
			              OR enc.encounter_nr LIKE "'.addslashes($suchbuffer).'"
					  )
					  AND enc.pid=reg.pid  
					  AND enc.encounter_status<>"cancelled"
					  AND NOT enc.is_discharged
					  AND (enc.in_ward OR enc.in_dept)
					  AND enc.status NOT IN ("void","hidden","deleted","inactive")
			          ORDER BY ';
*/					  
		if($oitem=='encounter_nr') $sql3 =" ORDER BY enc.$oitem $odir";
			else $sql3=" ORDER BY reg.$oitem $odir";
				
		//echo $sql.$dbtable.$sql2;
			  
		if($ergebnis=$db->SelectLimit($sql.$dbtable.$sql2.$sql3,$pagen->MaxCount(),$pagen->BlockStartIndex())){
				
				if ($linecount=$ergebnis->RecordCount())
				{ 
					if(($linecount==1)&&$numeric&&$mode=='search')
					{
						$zeile=$ergebnis->FetchRow();
						header("location:aufnahme_daten_zeigen.php".URL_REDIRECT_APPEND."&from=such&target=search&pid=".$zeile['pid']."&encounter_nr=".$zeile['encounter_nr']."&sem=".(!$zeile['is_discharged']));
						exit;
					}
					
					$pagen->setTotalBlockCount($linecount);
					
					# If more than one count all available
					if(isset($totalcount)&&$totalcount){
						$pagen->setTotalDataCount($totalcount);
					}else{
						# Count total available data
						$sql='SELECT COUNT(enc.encounter_nr) AS maxnr '.$dbtable.$sql2;
						//$sql='SELECT enc.encounter_nr '.$dbtable.$sql2;
						//echo $sql;
						if($result=$db->Execute($sql)){
							if ($result->RecordCount()) {
								$rescount=$result->FetchRow();
    								$totalcount=$rescount['maxnr'];
    							}
							//$totalcount=$result->RecordCount();
						}
						$pagen->setTotalDataCount($totalcount);
						//echo $totalcount;
					}
					# Set the sort parameters
					$pagen->setSortItem($oitem);
					$pagen->setSortDirection($odir);
				}
			}
			 else {echo "<p>".$sql."<p>$LDDbNoRead";};
}else{
	$mode='';
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

if($parent_admit) $sTitleNr= ($_SESSION['sess_full_en']);
	else $sTitleNr = ($_SESSION['sess_full_pid']);

# Title in the toolbar
 $smarty->assign('sToolbarTitle',"$LDMedocs :: $LDSearch ");

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('medocs_search.php')");

 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('title',"Medocs :: $LDSearch ");

 # Onload Javascript code
 $smarty->assign('sOnLoadJs','onLoad="document.searchform.searchkey.select()"');

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('medocs_entry.php')");

  # hide return button
 $smarty->assign('pbBack',FALSE);

# Load tabs

$target='search';
require('./gui_bridge/default/gui_tabs_medocs.php');

# Buffer page output

ob_start();

?>

<ul>
	<table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
		<tr>
			<td>
				<?php
					include($root_path.'include/inc_patient_searchmask.php');
				?>
		</td>
     </tr>
   </table>

<p>
<a href="<?php echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
<p>

<?php
if($mode=='search'||$mode=='paginate'){
	
	if ($linecount) echo '<hr width=80% align=left>'.str_replace("~nr~",$totalcount,$LDSearchFound).' '.$LDShowing.' '.$pagen->BlockStartNr().' '.$LDTo.' '.$pagen->BlockEndNr().'.';
		else echo str_replace('~nr~','0',$LDSearchFound); 
		  
	if ($linecount) { 

		# Load the common icons
		$img_options=createComIcon($root_path,'statbel2.gif','0');
	 	$img_male=createComIcon($root_path,'spm.gif','0');
		$img_female=createComIcon($root_path,'spf.gif','0');
		$bgimg='tableHeaderbg3.gif';
		$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/'.$bgimg.'"';

		echo '
			<table border=0 cellpadding=2 cellspacing=1>
			<tr class="adm_list_titlebar">';
			
?>
     <td><b>
	  <?php echo $pagen->makeSortLink($LDCaseNr,'encounter_nr',$oitem,$odir,$append);  ?></b></td>
     <td><b>
	  <?php echo $pagen->makeSortLink($LDSex,'sex',$oitem,$odir,$append);  ?></b></td>
      <td><b>
	  <?php echo $pagen->makeSortLink($LDLastName,'name_last',$oitem,$odir,$append);  ?></b></td>
      <td><b>
	  <?php echo $pagen->makeSortLink($LDFirstName,'name_first',$oitem,$odir,$append);  ?></b></td>
      <td><b>
	  <?php echo $pagen->makeSortLink($LDBday,'date_birth',$oitem,$odir,$append);  ?></b></td>

     <td ><b><?php echo $LDSelect; ?></b></td>

<?php
					echo"</tr>";

					while($zeile=$ergebnis->FetchRow())
					{
						$full_en=$zeile['encounter_nr'];
						echo "
							<tr bgcolor=";
						if($toggle) { echo "#efefef>"; $toggle=0;} else {echo "#ffffff>"; $toggle=1;};
						echo"<td>";
                        echo '&nbsp;'.$full_en;
						if($zeile['encounter_class_nr']==2) echo ' <img '.createComIcon($root_path,'redflag.gif').'> <font size=1 color="red">'.$LDAmbulant.'</font>';
                        echo "</td><td>";	

						switch($zeile['sex']){
							case 'f': echo '<img '.$img_female.'>'; break;
							case 'm': echo '<img '.$img_male.'>'; break;
							default: echo '&nbsp;'; break;
						}	
						
						echo"</td><td>";
						echo "&nbsp;".ucfirst($zeile['name_last']);
                        echo "</td>";	
						echo"<td>";
						echo "&nbsp;".ucfirst($zeile['name_first']);

						# If person is dead show a black cross
						if($zeile['death_date']&&$zeile['death_date']!=$dbf_nodate) echo '&nbsp;<img '.createComIcon($root_path,'blackcross_sm.gif','0','absmiddle').'>';
						
						
                        echo "</td>";	
						echo"<td>";
						echo "&nbsp;".formatDate2Local($zeile['date_birth'],$date_format);
                        echo "</td>";	

					    if($_COOKIE[$local_user.$sid]) echo '
						<td>&nbsp;
							<a href=show_medocs.php'.URL_APPEND.'&from=such&pid='.$zeile['pid'].'&encounter_nr='.$zeile['encounter_nr'].'&target=entry>
							<img '.$img_options.' alt="'.$LDShowData.'"></a>&nbsp;';
							
                       if(!file_exists($root_path.'cache/barcodes/en_'.$full_en.'.png'))
	      		       {
			               echo "<img src='".$root_path."classes/barcode/image.php?code=".$full_en."&style=68&type=I25&width=180&height=50&xres=2&font=5&label=2&form_file=en' border=0 width=0 height=0>";
		               }
						echo '</td></tr>';

					}
					echo '
						<tr><td colspan=5>'.$pagen->makePrevLink($LDPrevious).'</td>
						<td align=right>'.$pagen->makeNextLink($LDNext).'</td>
						</tr>
						</table>';
					if($linecount>$pagen->MaxCount())
					{
					    /* Set the appending nr for the searchform */
					    $searchform_count=2;
					?>
			<p>
		 <table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php
            include($root_path.'include/inc_patient_searchmask.php');
	   ?>
		</td>
     </tr>
   </table>
  
</ul>
<?php
					}
	}
}

$sTemp = ob_get_contents();
ob_end_clean();

$smarty->assign('sMainDataBlock',$sTemp);

$smarty->assign('sMainBlockIncludeFile','medocs/main_plain.tpl');

$smarty->display('common/mainframe.tpl');
?>
