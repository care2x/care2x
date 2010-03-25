<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
# Default value for the maximum nr of rows per block displayed, define this to the value you wish
# In normal cases this value is derived from the db table "care_config_global" using the "pagin_insurance_list_max_block_rows" element.
define('MAX_BLOCK_ROWS',30); 

$lang_tables[]='actions.php';
$lang_tables[]='search.php';
define('LANG_FILE','specials.php');
$local_user='ck_fotolab_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

$searchkey=trim($searchkey);
$searchkey=strtr($searchkey,"*?","%_");
$toggle=0;
$append=URL_APPEND."&target=$target&noresize=1&user_origin=$user_origin";

 /* Set color values for the search mask */
$searchmask_bgcolor='#f3f3f3';
$searchprompt=$LDKeywordPrompt;
$entry_block_bgcolor='#fff3f3';
$entry_border_bgcolor='#6666ee';
$entry_body_bgcolor='#ffffff';

$breakfile=$root_path."main/spediens.php$append";
$thisfile=basename(__FILE__);
# Data to append to url
$append='&status='.$status.'&target='.$target.'&user_origin='.$user_origin;

# Initialize page´s control variables
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
		$zeile=$encounter->FetchRow();
		header('location:fotolab-dir-select.php'.URL_REDIRECT_APPEND.'&patnum='.$zeile['encounter_nr'].'&lastname='.strtr($zeile['name_last'],' ','+').'&firstname='.strtr($zeile['name_first'],' ','+').'&bday='.$zeile['date_birth'].'&maxpic='.$aux1);
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

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$LDFotoLab);

# Hide return button
 $smarty->assign('pbBack',FALSE);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('fotolab_how2search.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # target for close button
 $smarty->assign('sCloseTarget','target="_parent"');
 
 # Window bar title
 $smarty->assign('sWindowTitle',$LDFotoLab);
 
 # Body Onload js
 $smarty->assign('sOnLoadJs','onLoad="document.searchform.searchkey.select()"');

# Buffer page output

ob_start();

?>

<ul>
	 <table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php
	   
	        $searchmask_bgcolor="#f3f3f3";
            include($root_path.'include/core/inc_patient_searchmask.php');
       
	   ?>
	</td>
     </tr>
   </table>

<p>
<a href="<?php	echo $breakfile; ?>" target='_parent'><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
<p>
</ul>
<?php
if($mode=='search'||$mode=='paginate'){
	if ($linecount) echo str_replace("~nr~",$totalcount,$LDSearchFound).' '.$LDShowing.' '.$pagen->BlockStartNr().' '.$LDTo.' '.$pagen->BlockEndNr().'.';
		else echo str_replace('~nr~','0',$LDSearchFound); 
		  
	if ($linecount) { 

	# Load the common icons
	$img_options=createComIcon($root_path,'l-arrowgrnlrg.gif','0','',TRUE);
	$img_male=createComIcon($root_path,'spm.gif','0','',TRUE);
	$img_female=createComIcon($root_path,'spf.gif','0','',TRUE);
	//$bgimg='tableHeaderbg3.gif';
	//$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/'.$bgimg.'"';

	echo '
			<table border=0 cellpadding=2 cellspacing=1> <tr class="wardlisttitlerow">';
			
?>

     <td><b>
	  <?php echo $pagen->makeSortLink($LDPatientNr,'encounter_nr',$oitem,$odir,$append);  ?></b></td>
      <td><b>
	  <?php echo $pagen->makeSortLink($LDSex,'sex',$oitem,$odir,$append);  ?></b></td>
      <td><b>
	  <?php echo $pagen->makeSortLink($LDLastName,'name_last',$oitem,$odir,$append);  ?></b></td>
      <td><b>
	  <?php echo $pagen->makeSortLink($LDFirstName,'name_first',$oitem,$odir,$append);  ?></b></td>
      <td><b>
	  <?php echo $pagen->makeSortLink($LDBday,'date_birth',$oitem,$odir,$append);  ?></b></td>
<!--       <td align='center'><b>
	  <?php echo $pagen->makeSortLink($LDZipCode,'addr_zip',$oitem,$odir,$append); ?></b></td>
 -->	  
    <td background="<?php echo createBgSkin($root_path,'tableHeaderbg.gif'); ?>" align=center><font color="#ffffff"><b><?php echo $LDSelect; ?></td>

<?php

					
	echo"</tr>";

					while($zeile=$encounter->FetchRow())
					{
						$ahref='<a href="fotolab-dir-select.php'.URL_APPEND.'&patnum='.$zeile['encounter_nr'].'&lastname='.strtr($zeile['name_last'],' ','+').'&firstname='.strtr($zeile['name_first'],' ','+').'&bday='.$zeile['date_birth'].'&maxpic='.$aux1.'">';
						echo '
							<tr class=';
						if($toggle) { echo "wardlistrow2>"; $toggle=0;} else {echo "wardlistrow1>"; $toggle=1;};
						echo '<td>&nbsp;'.$ahref.$zeile['encounter_nr'];
                        echo '</a></td>
						';	
						echo '<td>';
						switch($zeile['sex']){
							case 'f': echo '<img '.$img_female.'>'; break;
							case 'm': echo '<img '.$img_male.'>'; break;
							default: echo '&nbsp;'; break;
						}
						
                        echo '</td>
						';	
						
						echo"<td>";
						echo "&nbsp;".$ahref.ucfirst($zeile['name_last']);
                        echo '</a></td>
						';	
						echo"<td>";
						echo "&nbsp;".$ahref.ucfirst($zeile['name_first']);
                        echo '</a></td>
						';	
						echo"<td>";
						echo "&nbsp;".formatDate2Local($zeile['date_birth'],$date_format);
                        echo "</td>";	
/*						echo"<td>";
						echo "&nbsp;".$zeile['addr_zip'];
                        echo "</td>";	
*/
					    if($_COOKIE[$local_user.$sid]) echo '
						<td>&nbsp;
							<a href="fotolab-dir-select.php'.URL_APPEND.'&patnum='.$zeile['encounter_nr'].'&lastname='.strtr($zeile['name_last'],' ','+').'&firstname='.strtr($zeile['name_first'],' ','+').'&bday='.$zeile['date_birth'].'&maxpic='.$aux1.'">
							<img '.$img_options.' alt="'.$LDSelect.'"></a>&nbsp;
							</td>';
						
						echo '
						</tr>';

					}
					echo '
						<tr><td colspan=5>'.$pagen->makePrevLink($LDPrevious,$append).'</td>
						<td align=right>'.$pagen->makeNextLink($LDNext,$append).'</td>
						</tr>
						</table>';
						
					if($linecount>$pagen->MaxCount())
					{
					    /* Set the appending nr for the searchform */
					    $searchform_count=2;
					?>
		<ul>
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
		<p>
		<a href="<?php	echo $breakfile; ?>" target='_parent'><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
		</ul>
					<?php
					}
	}
}
?>
&nbsp;
<p>
<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign page output to the mainframe template

$smarty->assign('sMainFrameBlockData',$sTemp);
 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

?>
