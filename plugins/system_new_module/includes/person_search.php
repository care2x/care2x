<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
echo $pat_bez;
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE 2X Integrated Hospital Information System version deployment 1.1 (mysql) 2004-01-11
* GNU General Public License
* Copyright 2002,2003,2004 Elpidio Latorilla
* elpidio@care2x.net, elpidio@care2x.org
*
* See the file "copy_notice.txt" for the licence notice
*/

# Default value for the maximum nr of rows per block displayed, define this to the value you wish
# In normal cases this value is derived from the db table "care_config_global" using the "pagin_insurance_list_max_block_rows" element.
define('MAX_BLOCK_ROWS',30); 

# Define to TRUE if you want to show the option to select  inclusion of the first name in universal searches
# This would give the user a chance to shut the search for first names and makes the search faster, but the user has one element more to consider
# If defined to FALSE the option will be hidden and both last name and first names will be searched, resulting to slower search
define('SHOW_FIRSTNAME_CONTROLLER',TRUE);

# Define to TRUE if you want the sql query to be displayed at the top of the page.
# Useful for debugging or optimizing the query
define('SHOW_SQLQUERY',0);


$lang_tables[]='actions.php';
$lang_tables[]='prompt.php';
$lang_tables[]='aufnahme.php';
define('LANG_FILE','radio.php');
# Resolve the local user based on the origin of the script

//require_once('include/inc_local_user.php');
//define('NO_2LEVEL_CHK',1);
$local_user='ck_#Modulname#_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
require_once($root_path.'include/core/inc_date_format_functions.php');

# Set break file
//require('include/inc_breakfile.php');
$breakfile=$root_path."main/startframe.php?sid=$sid&lang=$lang";


$thisfile=basename(__FILE__);

$_SESSION['sess_file_return']=$thisfile;

if(!isset($searchkey)) 	$searchkey='';
if(!isset($mode)) $mode='';


$toggle=0;

 /* Set color values for the search mask */
$searchmask_bgcolor='#f3f3f3';
$searchprompt=$LDPlsFindPersonFirst;
$entry_block_bgcolor='#fff3f3';
//$entry_border_bgcolor='#6666ee';
$entry_border_bgcolor='#66ee66';
$entry_body_bgcolor='#ffffff';

/*
if(($mode=='search')&&($searchkey))
{
    include_once($root_path.'include/care_api_classes/class_person.php');
	$obj=new Person;
	$pers_obj=&$obj->Persons($searchkey);
	$pers_count=$obj->LastRecordCount();
}
else $mode='';*/


$dbtable='care_person';
$toggle=0;

if(empty($target)) $target='search';


$GLOBAL_CONFIG=array();

# Initialize page's control variables
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
#Load and create paginator object
require_once($root_path.'include/care_api_classes/class_paginator.php');
$pagen=new Paginator($pgx,$thisfile,$_SESSION['sess_searchkey'],$root_path);

require_once($root_path.'include/care_api_classes/class_globalconfig.php');
$glob_obj=new GlobalConfig($GLOBAL_CONFIG);
$glob_obj->getConfig('person_id_%');

# Get the max nr of rows from global config
$glob_obj->getConfig('pagin_person_search_max_block_rows');
if(empty($GLOBAL_CONFIG['pagin_person_search_max_block_rows'])) $pagen->setMaxCount(MAX_BLOCK_ROWS); # Last resort, use the default defined at the start of this page
	else $pagen->setMaxCount($GLOBAL_CONFIG['pagin_person_search_max_block_rows']);


if(isset($mode)&&($mode=='search'||$mode=='paginate')&&isset($searchkey)&&($searchkey)){
	
	include_once($root_path.'include/core/inc_date_format_functions.php');

	if($mode=='paginate'){
		$fromwhere=$_SESSION['sess_searchkey'];
	}else{
		# convert * and ? to % and &
		$searchkey=strtr($searchkey,'*?','%_');
            
		
	   	$searchkey=trim($searchkey);
		$suchwort=$searchkey;
		
		if(is_numeric($suchwort)) {
            $suchwort=(int) $suchwort;
			$numeric=1;
			if($suchwort<$GLOBAL_CONFIG['person_id_nr_adder']){
				   $suchbuffer=(int) ($suchwort + $GLOBAL_CONFIG['person_id_nr_adder']) ; 
			}
			
			if(empty($oitem)) $oitem='pid';			
			if(empty($odir)) $odir='DESC'; # default, latest pid at top
			
			$sql2='	WHERE pid="'.$suchwort.'" OR pid = "'.$suchbuffer.'" ';
			
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
			# Check the size of the comp
			if(sizeof($comp)>1){
				$sql2='	WHERE (name_last LIKE "'.strtr($ln,'+',' ').'%" AND name_first LIKE "'.strtr($fn,'+',' ').'%") ';
				if(!empty($bd)){ 
					$DOB=formatDate2STD($bd,$date_format);
				echo $DOB;
					if($DOB=='') {
						$sql2.=' AND date_birth LIKE "'.$bd.'%" ';
					}else{
						$sql2.=' AND date_birth = "'.$DOB.'" ';
					}
				}
					
				//if(empty($oitem)) $oitem='name_last';			
				//if(empty($odir)) $odir='ASC'; # default, ascending alphabetic
		
			}else{
				# Check if * or %
				if($suchwort=='%'||$suchwort=='%%'){
					$sql2=' WHERE 1';
				}else{
					# Check if it is a complete DOB
					$DOB=formatDate2STD($suchwort,$date_format);
					echo $DOB;
					if($DOB=='') {
						if(defined('SHOW_FIRSTNAME_CONTROLLER')&&SHOW_FIRSTNAME_CONTROLLER){
							if(isset($_POST['firstname_too']) && $_POST['firstname_too']){
								$sql2='	WHERE name_last LIKE "'.strtr($suchwort,'+',' ').'%" OR name_first LIKE "'.strtr($suchwort,'+',' ').'%"';
								$firstname_too=1;
							}else{
								$sql2='	WHERE name_last LIKE "'.strtr($suchwort,'+',' ').'%" ';
								$firstname_too=0;
							}
						}else{
							$sql2='	WHERE name_last LIKE "'.strtr($suchwort,'+',' ').'%" OR name_first LIKE "'.strtr($suchwort,'+',' ').'%"';
							$firstname_too=1;
						}
					}else{
						$sql2='	WHERE date_birth = "'.$DOB.'"';
					}
				}
									
				//if(empty($oitem)) $oitem='name_last';			
				//if(empty($odir)) $odir='ASC'; # default, ascending alphabetic
			}
		 }
			$fromwhere=$dbtable.$sql2;
			# Save the query for pagination
			$_SESSION['sess_searchkey']=$fromwhere;
		}
			 
			//$sql2.=' AND status NOT IN ("void","hidden","deleted","inactive")  ORDER BY '.$oitem.' '.$odir;

			# Set the sorting directive
			if(isset($oitem)&&!empty($oitem)) $sql3 =" ORDER BY $oitem $odir";
			
						
			//$sql='SELECT * FROM '.$dbtable.$sql2;

			$sql='SELECT pid, name_last, name_first, date_birth, addr_zip, sex, death_date, status FROM '.$fromwhere.$sql3;
			
			if($ergebnis=$db->SelectLimit($sql,$pagen->MaxCount(),$pagen->BlockStartIndex()))
       		{
				if ($linecount=$ergebnis->RecordCount()) 
				{ 
					if(($linecount==1) && $numeric)
					{
						$zeile=$ergebnis->FetchRow();
						header("location:patient_register_show.php?sid=".$sid."&lang=".$lang."&pid=".$zeile['pid']."&edit=1&status=".$status."&user_origin=".$user_origin."&noresize=1&mode=&target=search");
						exit;
					}
					
					$pagen->setTotalBlockCount($linecount);
					
					# If more than one count all available
					if(isset($totalcount) && $totalcount){
						$pagen->setTotalDataCount($totalcount);
					}else{
						# Count total available data
						$sql='SELECT COUNT(pid) AS maxnr FROM '.$fromwhere;
						
						if($result=$db->Execute($sql)){
							if ($result->RecordCount()) {
								$rescount=$result->FetchRow();
    								$totalcount=$rescount['maxnr'];
    						}
						}
						$pagen->setTotalDataCount($totalcount);
					}
					# Set the sort parameters
					$pagen->setSortItem($oitem);
					$pagen->setSortDirection($odir);
				}
				
				if(defined('SHOW_SQLQUERY')&&SHOW_SQLQUERY) echo $sql;
				
			}
			 else {echo "<p>".$sql."<p>$LDDbNoRead";};
} else { 
    $mode='';
}
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE></TITLE>
 
<?php
require($root_path.'include/core/inc_js_gethelp.php');
require($root_path.'include/core/inc_css_a_hilitebu.php');
?>
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0  onLoad="document.searchform.searchkey.select()" bgcolor=<?php echo $cfg['body_bgcolor']; 
 if (!$cfg['dhtml']){ echo ' link='.$cfg['idx_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['idx_txtcolor']; } ?>>

<table width=100% border=0 cellspacing="0" cellpadding=0>

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>">
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;<?php echo "Patient auswählen";//$LDUploadDicom :: $LDSearch?></STRONG></FONT> 
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" align="right">
<a href="javascript:gethelp('patient_search.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'class="fadeOut" >';?></a><a href="<?php 
echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?> alt="<?php echo $LDCloseWin ?>"   <?php if($cfg['dhtml'])echo'class="fadeOut" >';?></a>
</td>
</tr>

</table>
<ul>

<FONT    SIZE=-1  FACE="Arial">


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
<a href="<?php echo $breakfile; ?>"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>></a>
<p>

<?php

# Create append data
$append='';

$bgimg='tableHeader_gr.gif';
$tbg= 'background="'.$root_path.'gui/img/common/'.$theme_com_icon.'/'.$bgimg.'"';

if($mode=='search'||$mode=='paginate'){
	if ($linecount) echo '<hr width=80% align=left>'.str_replace("~nr~",$totalcount,$LDSearchFound).' '.$LDShowing.' '.$pagen->BlockStartNr().' '.$LDTo.' '.$pagen->BlockEndNr().'.';
		else echo str_replace('~nr~','0',$LDSearchFound); 
}

if ($linecount){

	$img_male=createComIcon($root_path,'spm.gif','0');
	$img_female=createComIcon($root_path,'spf.gif','0');
 
	echo '<p>
		<table border=0 cellpadding=2 cellspacing=1> 
		
		<tr bgcolor="#66ee66" background="'.$root_path.'gui/img/common/default/tableHeaderbg.gif">';
?>
      <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
	  <?php 
		echo $pagen->makeSortLink($LDRegistryNr,'pid',$oitem,$odir,$append); 
			 ?></b></td>
      <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
	  <?php 
		echo $pagen->makeSortLink($LDSex,'sex',$oitem,$odir,$append); 
			 ?></b></td>
      <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
	  <?php 
		echo $pagen->makeSortLink($LDLastName,'name_last',$oitem,$odir,$append); 
			 ?></b></td>
      <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
	  <?php 
		echo $pagen->makeSortLink($LDFirstName,'name_first',$oitem,$odir,$append); 
			 ?></b></td>
      <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
	  <?php 
		echo $pagen->makeSortLink($LDBday,'date_birth',$oitem,$odir,$append); 
			 ?></b></td>
      <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>
	  <?php 
		 echo $pagen->makeSortLink($LDZipCode,'addr_zip',$oitem,$odir,$append); 
		 	
		?></b></td>
      <td <?php echo $tbg; ?>><FONT  SIZE=-1  FACE="Arial" color="#000066"><b>&nbsp;&nbsp;<?php echo $LDOptions; ?></b></td>
<?php						
				echo"</tr>";

				while($zeile=$ergebnis->FetchRow())
				{
						
					if($zeile['status']==''||$zeile['status']=='normal'){
						echo "
							<tr bgcolor=";
						if($toggle) { echo "#efefef>"; $toggle=0;} else {echo "#ffffff>"; $toggle=1;};
						echo '<td align="right"><font face=arial size=2>';
						echo "&nbsp;".$zeile['pid'];
                        echo "&nbsp;</td>";	
						
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
						# If person is dead show a black cross
						if($zeile['death_date']&&$zeile['death_date']!='0000-00-00') echo '&nbsp;<img '.createComIcon($root_path,'blackcross_sm.gif','0','absmiddle').'>';
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".formatDate2Local($zeile['date_birth'],$date_format);
                        echo "</td>";	
						echo"<td><font face=arial size=2>";
						echo "&nbsp;".$zeile['addr_zip'];
                        echo "</td>";	

					    if($_COOKIE[$local_user.$sid]) echo '
						<td><font face=arial size=2>&nbsp;';
						$pname=$zeile['name_last'].", ".$zeile['name_first'];
//						echo '<a href="test.php'.URL_APPEND.'&pid='.$zeile['pid'].'&mode=new">';
						echo '<a href="#Modulname#_dbform.php'.URL_APPEND.'&pid='.$zeile['pid'].'&pname='.$pname.'">';
						
						echo '<img '.createLDImgSrc($root_path,'ok_small.gif','0').' alt="'.$LDTestThisPatient.'"></a>&nbsp;';
							
                       if(!file_exists($root_path.'cache/barcodes/pn_'.$zeile['pid'].'.png'))
	      		       {
			               echo "<img src='".$root_path."classes/barcode/image.php?code=".$zeile['pid']."&style=68&type=I25&width=145&height=50&xres=2&font=5&label=2' border=0 width=0 height=0>";
		               }
						echo '</td></tr>';
					}

				}
				echo '
						<tr><td colspan=6><font face=arial size=2>'.$pagen->makePrevLink($LDPrevious,$append).'</td>
						<td align=right><font face=arial size=2>'.$pagen->makeNextLink($LDNext,$append).'</td>
						</tr>
						</table>';
					if($linecount>$pagen->MaxCount())
					{
?>
         <p>
		 <table border=0 cellpadding=10 bgcolor="<?php echo $entry_border_bgcolor ?>">
     <tr>
       <td>
	   <?php
	     $searchform_count=2;
       include($root_path.'include/core/inc_patient_searchmask.php');
     ?>
</td>
     </tr>
   </table>
<?php
					}
}

?>
<p>
</ul>
&nbsp;
</FONT>
<p>
</ul>
<p>
<?php
require($root_path.'include/core/inc_load_copyrite.php');
?>
</FONT>
</BODY>
</HTML>
