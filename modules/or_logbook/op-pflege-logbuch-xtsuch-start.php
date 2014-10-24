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

$lang_tables[]='search.php';
define('LANG_FILE','or.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');

if (!$internok&&!$_COOKIE['ck_op_pflegelogbuch_user'.$sid]) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

require_once($root_path.'include/core/inc_config_color.php');

# Initialization
$thisfile=basename(__FILE__);
$breakfile='javascript:window.close()';

# Workaround: Resolve the search key variables
if(empty($srcword)&&!empty($searchkey)) $srcword=$searchkey;

if($srcword!=''||$mode=='paginate'){
	
    # Load the date formatter
    include_once($root_path.'include/core/inc_date_format_functions.php');


	//$db->debug=1;


	# Initialize page´s control variables
	if($mode=='paginate'){
		$sql2=$_SESSION['sess_searchkey'];
	}else{
		# Reset paginator variables
		$pgx=0;
		$totalcount=0;
		$odir='ASC';
		$oitem='name_last';
		
		if(is_numeric($srcword)){
			$srcword=(int) $srcword;
		}else{
			# Convert other wildcards
			$srcword=strtr($srcword,'*&','%_');
		}
		
		# Try converting keyword to DOB
		$DOB = formatDate2STD($srcword,$date_format);
		
		$select="SELECT  o.*,
								e.encounter_class_nr,
								p.pid,
								 p.name_last,
								 p.name_first,
								 p.date_birth,
								 p.addr_str,
								 p.addr_str_nr,
								 p.sex,
								 p.addr_zip,
								 t.name AS citytown_name,
								 d.name_formal,
								 d.LD_var AS \"LD_var\" ";


		// Old mysql query
		/*
				$selectfrom.=" FROM  ( care_encounter_op AS o,
								 care_encounter AS e,
								care_person AS p )
								LEFT JOIN care_address_citytown AS t ON t.nr=p.addr_citytown_nr
								LEFT JOIN care_department AS d ON d.nr= o.dept_nr";
		*/
		$selectfrom= " FROM  care_encounter_op AS o LEFT JOIN care_department AS d ON d.nr= o.dept_nr
								 LEFT JOIN care_encounter AS e ON e.encounter_nr = o.encounter_nr
								LEFT JOIN care_person AS p ON p.pid = e.pid
								LEFT JOIN care_address_citytown AS t ON t.nr=p.addr_citytown_nr";

		# If the search is directed to a single patient
		if($mode=='get'||$mode=='getbypid'||$mode=='getbyenc'){
			if($mode=='get'){
				$sql2=$selectfrom."	WHERE  o.nr='$nr'
								AND  o.encounter_nr=e.encounter_nr
								AND e.pid=p.pid ";
			}elseif($mode=='getbypid'){
				$sql2=$selectfrom."	WHERE p.pid='$nr'
								AND  o.encounter_nr=e.encounter_nr
								AND e.pid=p.pid ";
			}else{
				$sql2=$selectfrom."	WHERE o.encounter_nr='$nr'
								AND  o.encounter_nr=e.encounter_nr
								AND e.pid=p.pid ";
			}
		}else{

			$sql2=$selectfrom."	WHERE o.encounter_nr=e.encounter_nr
											AND e.pid=p.pid 
											AND (p.name_last = '$srcword'
											OR p.name_first = '$srcword'";
			if($DOB) $sql2.=" OR p.date_birth = '$srcword' ";
			if(is_numeric($srcword)){
				 $sql2.=" OR o.op_nr = $srcword OR e.encounter_nr = $srcword";
			 }
			$sql2.=")";
		}
	}
	#Load and create paginator object
	include_once($root_path.'include/care_api_classes/class_paginator.php');
	$pagen=& new Paginator($pgx,$thisfile,$_SESSION['sess_searchkey'],$root_path);

	$GLOBAL_CONFIG=array();
	include_once($root_path.'include/care_api_classes/class_globalconfig.php');
	$glob_obj=new GlobalConfig($GLOBAL_CONFIG);	
	# Get the max nr of rows from global config
	$glob_obj->getConfig('pagin_patient_search_max_block_rows');
	if(empty($GLOBAL_CONFIG['pagin_patient_search_max_block_rows'])) $pagen->setMaxCount(MAX_BLOCK_ROWS); # Last resort, use the default defined at the start of this page
		else $pagen->setMaxCount($GLOBAL_CONFIG['pagin_patient_search_max_block_rows']);

	# Detect what type of sort item
	if($oitem=='encounter_nr') $tab='e';
		elseif(stristr($oitem,'op_')) $tab='o';
			else $tab='p';

	# If the search is directed to a single patient
	if($mode=='get'||$mode=='getbypid'||$mode=='getbyenc'){
	
		$sql=$select.$sql2."ORDER BY o.op_date DESC";

		if($ergebnis=$db->Execute($sql)){
			if($rows=$ergebnis->RecordCount()){
				$datafound=1;
			}else { 
				echo "$LDDbNoRead<br>$sql"; 
			}
		}
	}else{
		
		#  Start searching 
		$sql=$select.$sql2." ORDER BY $tab.$oitem $odir";
					
		if($ergebnis=$db->SelectLimit($sql,$pagen->MaxCount(),$pgx)){
			if($rows=$ergebnis->RecordCount()){
				if($rows==1) $datafound=1;
						
				$_SESSION['sess_searchkey']=$select.$sql2;

			}else{
				$select="SELECT o.nr,o.op_nr,o.dept_nr,o.op_room,o.op_date, e.encounter_nr, p.pid, p.name_last, p.name_first, p.date_birth, p.sex";
				$sql2 =" FROM
									care_encounter_op AS o,
									care_encounter AS e,
									care_person AS p
								WHERE o.encounter_nr=e.encounter_nr
									AND e.pid=p.pid
									AND ( p.name_last $sql_LIKE '$srcword%'
									OR p.name_first $sql_LIKE '$srcword%'";
				if(is_numeric($srcword)) $sql2.=" OR  o.op_nr $sql_LIKE '$srcword%' OR e.encounter_nr $sql_LIKE '$srcword%'";
				if($DOB) $sql2.=" OR p.date_birth $sql_LIKE '$srcword%'";
				$sql2.=")";

				$sql=$select.$sql2." ORDER BY $tab.$oitem $odir";
				
				if($ergebnis=$db->SelectLimit($sql,$pagen->MaxCount(),$pgx)){
					$rows=$ergebnis->RecordCount();
					$_SESSION['sess_searchkey']=$select.$sql2;
	           	}else{ echo "$LDDbNoRead<br>$sql"; }
			}
		}else{
			echo "$LDDbNoRead<br>$sql";
		}
		
		if($rows){
			$pagen->setTotalBlockCount($rows);
			
			# If count more than the max row count
			if($rows>1){
				# Count per sql
				if(isset($totalcount) && $totalcount){
					$pagen->setTotalDataCount($totalcount);
				}else{
					# Count total available data
					//$sql="$sql $tab.$oitem $odir";
					$sql = "SELECT COUNT(o.nr) AS maxcount ".$sql2;
					if($result=$db->Execute($sql)){
						//$totalcount=$result->RecordCount();
						$row = $result->FetchRow();
						$totalcount = $row['maxcount'];
					}
					$pagen->setTotalDataCount($totalcount);
				}
			}else{
				$totalcount=1;
				$pagen->setTotalDataCount(1);
			}
			# Set the sort parameters
			$pagen->setSortItem($oitem);
			$pagen->setSortDirection($odir);
		}
	
	} # end of else if mode== get
} # end of if (srcword!="")

//echo $sql;

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

# Title in toolbar
 $smarty->assign('sToolbarTitle',"$LDOrLogBook - $LDSearch");

 # hide return button
 $smarty->assign('pbBack',FALSE);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('oplog.php','search','$mode','$rows','$datafound')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',"$LDOrLogBook - $LDSearch");

 # Body Onload js
 $smarty->assign('sOnLoadJs','onLoad="if (window.focus) window.focus();document.suchform.srcword.select();"');

 # Body OnUnload js
 $smarty->assign('sOnUnloadJs','onUnload="if (wwin) wwin.close();"');

# Collect js code

ob_start();
?>

<script  language="javascript">
<!--

var wwin;
var lock=true;
var nodept=false;

function pruf(f)
{
 d=f.srcword.value;
 if(d=="") return false;
 else return true;
}

function open_such_editwin(filename,y,m,d,dp,sl)
{
	url="op-pflege-logbuch-arch-edit.php?mode=edit&fileid="+filename+"&sid=<?php echo "$sid&lang=$lang"; ?>&user=<?php echo str_replace(" ","+",$user); ?>&pyear="+y+"&pmonth="+m+"&pday="+d+"&dept_nr="+dp+"&saal="+sl;
<?php if($cfg['dhtml'])
	echo '
			w=window.parent.screen.width;
			h=window.parent.screen.height;';
	else
	echo '
			w=800;';
?>
	sucheditwin=window.open(url,"sucheditwin","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=400");
	window.sucheditwin.moveTo(0,0);
}

function waitwin()
{
	wwin=window.open("waitwin.htm","wait","menubar=no,resizable=no,scrollbars=no,width=400,height=200");
}
function getinfo(pid,dept,pdata){
	urlholder="<?php echo $root_path; ?>modules/nursing/nursing-station-patientdaten.php<?php echo URL_REDIRECT_APPEND; ?>&pn="+pid+"&patient=" + pdata + "&station="+dept+"&op_shortcut=<?php echo strtr($ck_op_pflegelogbuch_user," ","+") ?>";
	patientwin=window.open(urlholder,pid,"width=700,height=450,menubar=no,resizable=yes,scrollbars=yes");
}
// -->
</script>

<?php

$sTemp = ob_get_contents();
ob_end_clean();
$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

if((($mode=='get')||($datafound)) && $rows){

	if($rows>1) echo $LDPatLogbookMany;
		else echo $LDPatLogbook;

	echo '
		<table cellpadding="0" cellspacing="0" border="0" bgcolor="#999999" width="100%">
		<tr><td>
		<table  cellpadding="3" cellspacing="1" border="0" width="100%">
		';	
	echo '
		<tr class="wardlisttitlerow">';
	while(list($x,$v)=each($LDOpMainElements))
	{
		echo '
		<td>'.$v.'</td>';
	}
	echo '
		</tr>';
		
	$img_arrow=createComIcon($root_path,'bul_arrowgrnlrg.gif','0','middle'); // Loads the arrow icon image
	$img_info=createComIcon($root_path,'info2.gif','0','middle'); // Loads the arrow icon image
		
		
	while($pdata=$ergebnis->FetchRow()){
		echo '
				<tr class="submenu">
				<td colspan=9>&nbsp;
				<font color="#000033">';
				$buffer=$pdata['LD_var'];
				if(isset($$buffer)&&!empty($$buffer)) echo $$buffer;
					else echo $pdata['name_formal'];
				echo ' :: '.strtoupper($pdata[op_room]).'</font></font>
				</td></tr>';

	if ($toggler==0) 
		{ echo '<tr bgcolor="#fdfdfd">'; $toggler=1;} 
		else { echo '<tr bgcolor="#eeeeee">'; $toggler=0;}
	echo '
			<a name="'.$pdata['encounter_nr'].'"></a>';
			
	list($iyear,$imonth,$iday)=explode('-',$pdata['op_date']);

	echo '
			<td valign=top><font size="1" ><font size=2 color=red><b>'.$pdata['op_nr'].'</b></font><hr>'.formatDate2Local($pdata['op_date'],$date_format).'<br>
			'.$tage[date("w",mktime(0,0,0,$imonth,$iday,$iyear))].'<br>
			<a href="op-pflege-logbuch-start.php?sid='.$sid.'&lang='.$lang.'&mode=saveok&enc_nr='.$pdata['encounter_nr'].'&op_nr='.$pdata[op_nr].'&dept_nr='.$pdata[dept_nr].'&saal='.$pdata[op_room].'&thisday='.$pdata['op_date'].'">
			<img '.$img_arrow.' alt="'.str_replace("~tagword~",$pdata['name_last'],$LDEditPatientData).'"></a>
			</td>';
	
	echo '
			<td valign=top><nobr><font size="1" color=blue>
			<a href="javascript:getinfo(\''.$pdata[encounter_nr].'\',\''.$pdata[dept_nr].'\')">
			<img '.$img_info.' alt="'.str_replace("~tagword~",$pdata['name_last'],$LDOpenPatientFolder).'"></a>&nbsp; ';

	echo ($pdata['encounter_class_nr']==1)?($pdata['encounter_nr']+$GLOBAL_CONFIG['patient_inpatient_nr_adder']) : ($pdata['encounter_nr']+$GLOBAL_CONFIG['patient_outpatient_nr_adder']);
			
	echo '<br>
			<font color=black><b>'.$pdata['name_last'].', '.$pdata['name_first'].'</b><br>'.formatDate2Local($pdata['date_birth'],$date_format).'<p>
			<font color="#000000">'.$pdata['addr_str'].' '.$pdata['addr_str_nr'].'<br>'.$pdata['addr_zip'].' '.$pdata['citytown_name'].'</font><br></td>';
			
	echo '
			<td valign=top><font size="1" >';
	echo '
	<font color="#cc0000">'.$LDOpMainElements[diagnosis].':</font><br>';
	echo nl2br($pdata['diagnosis']);
	echo '
			</td><td valign=top><font size="1" ><nobr>';
			
	$ebuf=array('operator','assistant','scrub_nurse','rotating_nurse');
	//$tbuf=array("O","A","I","S");
	//$cbuf=array("Operateur","Assistent","Instrumenteur","Springer");
	for($n=0;$n<sizeof($ebuf);$n++){
	
		if(!$pdata[$ebuf[$n]]) continue;
		echo '<font color="#cc0000">'.$cbuf[$n].'</font><br>';
		$dbuf=explode("~",$pdata[$ebuf[$n]]);
		for($i=0;$i<sizeof($dbuf);$i++)
		{
			parse_str(trim($dbuf[$i]),$elems);
			if($elems[n]=="") continue;
			else echo '&nbsp;'.$elems[n]." ".$tbuf[$n].$elems[x]."<br>";
		}
	}	
	echo '
	</td>
	<td valign=top><font size="1" >'.$LDAnaTypes[$pdata['anesthesia']].'<p>';
	if($pdata[an_doctor])
		{ 
			echo '<font color="#cc0000">'.$LDAnaDoc.'</font><br><font color="#000000">';
			$dbuf=explode("~",$pdata[an_doctor]);
			for($i=0;$i<sizeof($dbuf);$i++)
			{
				parse_str(trim($dbuf[$i]),$elems);
				if($elems[n]=="") continue;
				else echo '&nbsp;'.$elems[n].' '.$LDAnaPrefix.$elems[x].'<br>';
			}
			echo '</font>';
		}
			
	 $eo=explode("~",$pdata[entry_out]);
	for($i=0;$i<sizeof($eo);$i++)
	{
	parse_str($eo[$i],$eobuf);
	if(trim($eobuf[s])) break;
	}
	 $cc=explode("~",$pdata[cut_close]);
	for($i=0;$i<sizeof($cc);$i++)
	{
	parse_str($cc[$i],$ccbuf);
	if(trim($ccbuf[s])) break;
	}

			
	echo '
	</td>
	<td valign=top><font size="1" >';
	echo '<font size="1" color="#cc0000">'.$LDOpCut.':</font><br>'.convertTimeToLocal($ccbuf[s]).'<p>
	<font size="1" color="#cc0000">'.$LDOpClose.':</font><br>'.convertTimeToLocal($ccbuf[e]).'</td>';
	echo '
	<td valign=top><font size="1" color="#cc0000">'.$LDOpMainElements[therapy].':<font color=black><br>'.nl2br($pdata['op_therapy']).'</td>';
	echo '
	<td valign=top><nobr><font size="1" color="#cc0000">'.$LDOpMainElements[result].':<br>';
	echo '<font color=black>'.nl2br($pdata['result_info']).'</td>';
	echo '
	<td valign=top><font size="1" >';
	echo '<font size="1" color="#cc0000">'.$LDOpIn.':</font><br>'.convertTimeToLocal($eobuf[s]).'<p>
	<font size="1" color="#cc0000">'.$LDOpOut.':</font><br>'.convertTimeToLocal($eobuf[e]).'</td>';
	echo '
	</tr>';

	}

echo '
		</table>
		</td>
		</tr>
		</table>
		';
		
}elseif($mode=='search'||$mode=='paginate'){
	
	echo '
			<ul>
				<table cellpadding=0 cellspacing=0 border=0>';

	if($rows) echo'
				<tr>
				<td valign="middle" class="prompt">
				'.$LDPatientsFound.'
				</td>
				<td>
					<img '.createMascot($root_path,'mascot1_l.gif','0','middle').'>
				</td>
				</tr>';
	echo '
				<tr>
				<td valign=top colspan=2>';

	if ($rows) echo str_replace("~nr~",$totalcount,$LDSearchFound).' '.$LDShowing.' '.$pagen->BlockStartNr().' '.$LDTo.' '.$pagen->BlockEndNr().'.';
		else echo str_replace('~nr~','0',$LDSearchFound);
				
				
	echo'
				<table cellpadding=0 cellspacing=0 border=0 >
				<tr>
				<td bgcolor=#999999>
				<table cellpadding=2 cellspacing=1 border=0 >
				';
				
	if($rows){
	
		echo '<tr ><td colspan=8 bgcolor=#eeeee0><p>';
		if($rows==1) echo " $LDSimilar ";
			else echo $LDPlsClk1;
		echo '</td></tr>';
		# Loads the arrow icon image
		$img_src='<img '.createComIcon($root_path,'arrow.gif','0','middle').'>';
		# Load the background image
		//$bgc='background="'.$root_path.'gui/img/skin/default/tableHeaderbg3.gif"';
		$img_male=createComIcon($root_path,'spm.gif','0');
		$img_female=createComIcon($root_path,'spf.gif','0');
		
		$append="&srcword=$srcword";
		
?>
	<tr class="wardlisttitlerow">
     <td><b>
	  <?php echo $pagen->makeSortLink($LDSex,'sex',$oitem,$odir,$append);  ?></b></td>
     <td><b>
	  <?php echo $pagen->makeSortLink($LDLastName,'name_last',$oitem,$odir,$append);  ?></b></td>
     <td><b>
	  <?php echo $pagen->makeSortLink($LDName,'name_first',$oitem,$odir,$append);  ?></b></td>
     <td><b>
	  <?php echo $pagen->makeSortLink($LDBday,'date_birth',$oitem,$odir,$append);  ?></b></td>
     <td><b>
	  <?php echo $pagen->makeSortLink($LDOpRoom,'op_room',$oitem,$odir,$append);  ?></b></td>
     <td><b>
	  <?php echo $pagen->makeSortLink($LDSrcListElements[5],'op_date',$oitem,$odir,$append);  ?></b></td>
     <td><b>
	  <?php echo $pagen->makeSortLink($LDOpNr,'op_nr',$oitem,$odir,$append);  ?></b></td>
	<td><b>
	  <?php echo $pagen->makeSortLink($LDPatientNr,'encounter_nr',$oitem,$odir,$append);  ?></b></td>
</tr>


<?php

		while($pdata=$ergebnis->FetchRow()){
				//echo "
				//		<a href=\"op-pflege-logbuch-xtsuch-start.php?sid=$sid&lang=$lang&mode=get&dept_nr=$pdata[dept_nr]&op_nr=$pdata[op_nr]&srcword=".strtr($srcword," ","+")."\">";
				echo '
						<tr class="submenu"><td>';
				
				switch($pdata['sex']){
					case 'f': echo '<img '.$img_female.'>'; break;
					case 'm': echo '<img '.$img_male.'>'; break;
					default: echo '&nbsp;'; break;
				}				
				
				echo "</td>
						<td>
						<a href=\"op-pflege-logbuch-xtsuch-start.php?sid=$sid&lang=$lang&mode=getbypid&nr=".$pdata['pid']."&dept_nr=$dept_nr&saal=$saal&srcword=".strtr($srcword," ","+")."\">&nbsp;";
				
				//echo $img_src;
				
				if($srcword&&stristr($pdata['name_last'],$srcword)) echo '<b><span style="background:yellow">'.$pdata['name_last'].'</span></b>';
 					else echo $pdata['name_last'];			
						
 				echo '</a></td>
				<td>&nbsp;';
				
				if($srcword&&stristr($pdata['name_first'],$srcword)) echo '<b><span style="background:yellow">'.$pdata['name_first'].'</span></b>';
 					else echo $pdata['name_first'];		
							
 				echo '</td>
				<td align="center" >';
				
				if($srcword&&stristr($pdata['date_birth'],$srcword)) echo '<b><span style="background:yellow">'.formatDate2Local($pdata['date_birth'],$date_format).'</span></b>';
 					else echo formatDate2Local($pdata['date_birth'],$date_format);				
 				echo '
				</td>
				<td align="center">';
						
				echo "<a href=\"op-pflege-logbuch-xtsuch-start.php?sid=$sid&lang=$lang&mode=get&nr=".$pdata['nr']."&dept_nr=$dept_nr&saal=$saal&srcword=".strtr($srcword," ","+")."\">&nbsp;";
				
				echo '<b>'.$pdata[op_room].'</b></a></td>
				<td align="center" ><b>'.formatDate2Local($pdata['op_date'],$date_format).'</b> </td>
				<td align="center" >';
				echo "<a href=\"op-pflege-logbuch-xtsuch-start.php?sid=$sid&lang=$lang&mode=get&nr=".$pdata['nr']."&dept_nr=$dept_nr&saal=$saal&srcword=".strtr($srcword," ","+")."\">&nbsp;";		
				echo $pdata['op_nr'];
				echo '</a>
				</td>
				<td align="center" >';
				echo "<a href=\"op-pflege-logbuch-xtsuch-start.php?sid=$sid&lang=$lang&mode=getbyenc&nr=".$pdata['encounter_nr']."&dept_nr=$dept_nr&saal=$saal&srcword=".strtr($srcword," ","+")."\">&nbsp;";		
				echo $pdata['encounter_nr'];
				echo '</a>
				</td>
				</tr>';	
			}	
		
	}
	if($totalcount>$pagen->MaxCount())	echo '
			<tr bgcolor="#eeeeee"><td colspan=2>'.$pagen->makePrevLink($LDPrevious,$append).'</td>
			<td colspan=4>&nbsp;</td>
			<td align=right colspan=2>'.$pagen->makeNextLink($LDNext,$append).'</td>
			</tr>';
	echo '	
				</table>
				</td>
				</tr>
				</table>
			</td>
			</tr>
			</table>
			</ul>
			';
}
?>

<ul>
<?php echo $LDPromptSearch ?>

<form action="<?php echo $thisfile; ?>" method=post name=suchform onSubmit="return pruf(this)">
<table border=0 cellspacing=0 cellpadding=1 bgcolor=#999999>
  <tr>
    <td>
		<table border=0 cellspacing=0 cellpadding=5 bgcolor=#eeeeee>
    <tr>
      <td>	<font color=maroon size=2><b><?php echo $LDKeyword ?>:</b></font><br>
          		<input type="text" name="srcword" size=40 maxlength=100 value="<?php echo $srcword; ?>">
				<input type="hidden" name="sid" value="<?php echo $sid; ?>"> 
				<input type="hidden" name="lang" value="<?php echo $lang; ?>"> 
				<input type="hidden" name="dept_nr" value="<?php echo $dept_nr; ?>"> 
				<input type="hidden" name="saal" value="<?php echo $saal; ?>">
				<input type="hidden" name="child" value="<?php echo $child; ?>"> 
				<input type="hidden" name="user" value="<?php echo str_replace(" ","+",$_COOKIE['ck_op_pflegelogbuch_user'.$sid]); ?>">
    			<input type="hidden" name="mode" value="search">
       
           	</td>
	   </tr>
  			   <tr>
      <td>	
		<input type="submit" value="<?php echo $LDSearch ?>" align="right">
              	</td>
	   </tr>

  </table>

	</td>
  </tr>
</table>
  	</form>


<p>

<b><?php echo $LDOtherFunctions ?>:</b><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="op-pflege-logbuch-arch-start.php?sid=<?php echo "$sid&lang=$lang&dept_nr=$dept_nr&saal=$saal&child=$child" ?>"><?php echo "$LDResearchArchive [$LDOrLogBook]" ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="op-pflege-logbuch-start.php?sid=<?php echo "$sid&lang=$lang&mode=fresh&dept_nr=$dept_nr&saal=$saal" ?>" <?php if ($child) echo "target=\"_parent\""; ?>><?php echo "$LDStartNewDocu [$LDOrLogBook]" ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="javascript:gethelp('oplog.php','search','<?php echo $mode ?>','<?php echo $rows ?>','<?php echo $datafound ?>')"><?php echo "$LDHelp" ?></a><br>

</ul>

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
