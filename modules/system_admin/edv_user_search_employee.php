<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* , elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('personell.php','edp.php');
define('LANG_FILE','aufnahme.php');
$local_user='ck_edv_user';
require_once($root_path.'include/inc_front_chain_lang.php');
require_once($root_path.'include/inc_date_format_functions.php');

$toggle=0;
$breakfile= 'edv_user_access_edit.php'.URL_APPEND.'&target='.$target;
 /* Set color values for the search mask */
$searchmask_bgcolor='#f3f3f3';
$searchprompt=$LDEntryPrompt;
$entry_block_bgcolor='#fff3f3';
$entry_border_bgcolor='#6666ee';
$entry_body_bgcolor='#ffffff';

if(!isset($searchkey)) $searchkey='';
if(!isset($mode)) $mode='';

//$db->debug=1;

if(($mode=='search')and($searchkey)){	
	/* Load global config */
	$suchwort=trim($searchkey);
	
	if(is_numeric($suchwort)){
		$suchbuffer=(int) $suchwort;
		$numeric=1;
	}else{
		$suchbuffer=$suchwort;
	}
			
/*	$sql="SELECT ps.nr, ps.is_discharged, p.name_last, p.name_first, p.date_birth,u.login_id
		          FROM care_person as p, care_personell as ps
				  	LEFT JOIN care_users AS u ON u.personell_nr=ps.nr ";
	if($numeric) $sql.="WHERE ps.nr $sql_LIKE '%".$suchbuffer."'";
		else $sql.= "WHERE (p.name_last $sql_LIKE '".addslashes($suchwort)."%'
		              OR p.name_first LIKE '".addslashes($suchwort)."%') ";
	$sql.=" AND ps.is_discharged IN ('',0) AND ps.pid=p.pid ORDER BY p.name_last ";*/
	//gjergji
	//changed to search only the users table
	$sql = "SELECT u.* FROM care_users AS u WHERE u.name LIKE '".addslashes($suchwort)."%' OR u.name LIKE '%".addslashes($suchwort)."' ORDER BY u.name ";

	if($ergebnis=$db->Execute($sql)){
			
		if ($linecount=$ergebnis->RecordCount()){ 
			if(($linecount==1)&&$numeric){
				$zeile=$ergebnis->FetchRow();
				if(!empty($zeile['login_id'])){
					$append='&mode=edit&userid='.$zeile['login_id'];
				}else{
						$append='&is_employee=1&personell_nr='.$zeile['nr'].'&username='.strtr(($zeile['name_first'].' '.$zeile['name_last']),' ','+').'&userid='.strtr($zeile['name_last'],' ','_');
				}
				header("location:edv_user_access_edit.php".URL_REDIRECT_APPEND.$append);
				exit;
			}
		}
	}else{echo "<p>".$sql."<p>$LDDbNoRead";};
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
 $smarty = new smarty_care('system_admin');

# Title in toolbar
 $smarty->assign('sToolbarTitle',"$LDPersonellData :: $LDSearch");

 # hide return button
 $smarty->assign('pbBack',FALSE);

# href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('employee_search.php')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDPersonellData :: $LDSearch");

 # Body onLoad Javascript
 $smarty->assign('sOnLoadJs','onLoad="document.searchform.searchkey.select()"');

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
<a href="<?php  echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
<p>

<?php
if($mode=='search'){

	if(!$linecount) $linecount=0;

	echo '<hr width=80% align=left><p>'.str_replace("~nr~",$linecount,$LDSearchFound).'<p>';
		  
	if ($linecount) { 

		/* Load the common icons & images */
		$img_options=createLDImgSrc($root_path,'ok_small.gif','0');
		$img_status=createComIcon($root_path,'redflag.gif');
		$bg_skin=createBgSkin($root_path,'tableHeaderbg.gif');

?>
		<table border=0 cellpadding=2 cellspacing=1>
		<tr class="wardlisttitlerow">
		<td><b><?php echo $LDStatus; ?></b></td>
		<td><b><?php echo $LDPersonellNr; ?></b></td>
		<td><b><?php echo $LDLastName; ?></td>
		<!--//gjergji
		//changed to search only the users table-->
		<!--<td><b><?php echo $LDFirstName; ?></td>-->
		<!--<td><b><?php echo $LDBday; ?></td>-->
		<td><b><?php echo $LDOptions; ?></td>
		</tr>

<?php
		while($zeile=$ergebnis->FetchRow()){

			echo "<tr class=";
			if($toggle) { echo '"wardlistrow2">';} else {echo '"wardlistrow1">';};
			$toggle=!$toggle;

			echo'<td align="center">&nbsp;';
			if(!empty($zeile['login_id'])){
				echo '<img '.$img_status.'>';
				$mode='edit';
				$alt=$LDEdit;
				$append='&mode='.$mode.'&userid='.$zeile['login_id'];
			}else{
				$mode='';
				$alt=$LDCreate;
				$append='&is_employee=1&personell_nr='.$zeile['nr'].'&username='.strtr(($zeile['name'].' '.$zeile['name_last']),' ','+').'&userid='.strtr($zeile['name_last'],' ','_');
			}
			echo "</td>";

			echo"<td>";
			echo '&nbsp;'.($zeile['nr']+$GLOBAL_CONFIG['personell_nr']);
			echo "</td>";
			echo"<td>";
			echo "&nbsp;".ucfirst($zeile['name']);
			echo "</td>";
//gjergji
//changed to search only the users table			
/*			echo"<td>";
			echo "&nbsp;".ucfirst($zeile['name_first']);
			echo "</td>";*/
/*			echo"<td>";
			echo "&nbsp;".@formatDate2Local($zeile['date_birth'],$date_format);
			echo "</td>";*/

			echo '
				<td>&nbsp;
					<a href="edv_user_access_edit.php'.URL_APPEND.$append.'">
					<img '.$img_options.' alt="'.$alt.'"></a>&nbsp;';

			if(!file_exists($root_path.'cache/barcodes/en_'.$full_en.'.png'))
			{
				echo "<img src='".$root_path."classes/barcode/image.php?code=".($zeile['nr']+$GLOBAL_CONFIG['personell_nr_adder'])."&style=68&type=I25&width=180&height=50&xres=2&font=5&label=2&form_file=en' border=0 width=0 height=0>";
			}
			echo '</td></tr>';

		}
		echo "
			</table>";
		if($linecount>15)
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
<?php
		}
	}
}
?>
<p>

</ul>

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