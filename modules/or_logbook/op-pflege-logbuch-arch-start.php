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
$lang_tables=array('departments.php');
define('LANG_FILE','or.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');

if (!$internok&&!$_COOKIE['ck_op_pflegelogbuch_user'.$sid]) {header("Location:".$root_path."language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

//$db->debug=1;

/* Load the date formatter */
require_once($root_path.'include/core/inc_date_format_functions.php');

//gjergji : new calendar
require_once ('../../js/jscalendar/calendar.php');
$calendar = new DHTML_Calendar('../../js/jscalendar/', $lang, 'calendar-system', true);
$calendar->load_files();
//end : gjergji

# Check the calendar date
if(isset($sdate)&&!empty($sdate)){
	$thisday=formatDate2STD($sdate,$date_format);
}elseif(!isset($thisday)||empty($thisday)){
	# Set default date to today
	$thisday=date('Y-m-d');
}
# Load date shifter class 
require_once($root_path.'classes/datetimemanager/class.dateTimeManager.php');
# Create new dateTimeManager object */
$tshifter = new dateTimeManager;
# Shift time back 1 day 
$yesday = $tshifter->shift_dates($thisday, '1', 'd');
# Shift time forward 1 day 
$tomorow = $tshifter->shift_dates($thisday, '-1', 'd');
# Todays date
$today=date('Y-m-d');

$opabt=get_meta_tags($root_path.'global_conf/'.$lang.'/op_tag_dept.pid');
//setcookie(op_pflegelogbuch_user,$user);
$thisfile=basename(__FILE__);
$breakfile='javascript:window.close()';

if(!isset($saal)||!$saal) $saal=1;  //default or room

$pdata=array();
$filetitles=array();
$template=array();
$datafound=false;

require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
$dept_obj->preloadDept($dept_nr);
/* Load all operative departments */
$surgery_arr=&$dept_obj->getAllActiveWithSurgery();
/* Get list of all active OR numbers */
$ORNrs=&$dept_obj->getAllActiveORNrs();


function yesterday(&$fd,&$fm,&$fy,$minyr)
{
	if ($fd<2)
		{
			if ($fm<2)
				{
					if($fy<$minyr) //minimum year allowed is minyr - 1
						{
							return false;
						}
						else	
							{
								$fy=$fy-1; $fm=12; $fd=31;
							}
	 			}
	 			else	
	 				{
						$fm=$fm-1;
						$fd=date("t",mktime(0,0,0,$fm,1,$fy)) ;
					}
		}
		else 
			{
				$fd=$fd-1;
			}
	if (strlen($fd)==1) $fd="0".$fd; 
	if (strlen($fm)==1) $fm="0".$fm;
	return true;
}

function tomorrow(&$fd,&$fm,&$fy,$maxyr)
{
	if($fd<(date("t",mktime(0,0,0,$fm,1,$fy))))
	{
		$fd++;
	}
	else
	{
		if($fm<12)
		{
			$fm++;
			$fd="01";
		}
		else 
		{
			$fy++;
			$fm="01";
			$fd="01";
		}
	}
	/*
	if (checkdate($fm,$fd+1,$fy))
	{
		$fd=$fd+1;
	}
	else
	{
		$fd=1;
			if ($fm<12){ $fm=$fm+1;}
				else {
							if($fy<$maxyr)
							{
								$fm=1;
								$fy=$fy+1;
							}
							else return false;
						}
	}
	*/
	if (strlen($fd)==1) $fd="0".$fd; 
	if (strlen($fm)==1) $fm="0".$fm;
	return true;
}
	
	
$md=$pday;
if (strlen($md)==1) $md="0".$md; 


setcookie(firstentry,'1');

$dbtable='care_encounter_op';

$selectfrom="SELECT o.*,
								e.encounter_class_nr,
								 p.name_last, 
								 p.name_first, 
								 p.date_birth, 
								 p.addr_str,
								 p.addr_str_nr,
								 p.addr_zip,
								 t.name AS citytown_name,
								 d.name_formal,
								 d.LD_var";
			/*
					FROM  (care_encounter_op AS o,
								care_encounter AS e,
								care_person AS p)
								LEFT JOIN care_address_citytown AS t ON t.nr=p.addr_citytown_nr
								LEFT JOIN care_department AS d ON d.nr=o.dept_nr";
			*/
$selectfrom  = $selectfrom . " FROM  care_encounter_op AS o LEFT JOIN care_department AS d ON d.nr= o.dept_nr
								 LEFT JOIN care_encounter AS e ON e.encounter_nr = o.encounter_nr
								LEFT JOIN care_person AS p ON p.pid = e.pid
								LEFT JOIN care_address_citytown AS t ON t.nr=p.addr_citytown_nr";

$sql=$selectfrom."	WHERE  o.dept_nr='$dept_nr'
								AND o.op_room='$saal'
								AND op_date='$thisday' 								
								AND o.encounter_nr=e.encounter_nr
								AND e.pid=p.pid
					ORDER BY o.create_time DESC";

if($ergebnis=$db->Execute($sql)){
	if($maxelem=$ergebnis->RecordCount()){
		$datafound=true;
				//echo $sql."<br>";
	}
}else{
	echo "<p>".$sql."<p>$LDDbNoRead";
}

$validyr=true;

# Prepate title
$sTitle = "$LDOrLogBook::$LDArchive - ";
$buffer=$dept_obj->LDvar();
if(isset($$buffer)&&!empty($$buffer)) $sTitle = $sTitle.$$buffer;
	else $sTitle = $sTitle.$dept_obj->FormalName();
$sTitle = $sTitle." $LDRoom $saal";

# Start Smarty templating here
 /**
 * LOAD Smarty
 */
 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

# Title in toolbar
 $smarty->assign('sToolbarTitle',$sTitle);

 # hide return button
 $smarty->assign('pbBack',FALSE);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('oplog.php','arch','$dif','$lastlog','$datafound')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$sTitle);

 # Body Onload js
 if(!$nofocus) $smarty->assign('sOnLoadJs','onLoad="if (window.focus) window.focus();"');

# Collect js code

ob_start();

?>

<script  language="javascript">
<!--
function pruf(d)
{
	if((d.dept_nr.value=="<?php echo $dept_nr;?>")&&(d.saal.value=="<?php echo $saal;?>")&&(d.sdate.value=="<?php echo formatDate2Local($thisday,$date_format);?>")){
		return false;
	}else{
		return true;
	}
}
<?php if ($datafound) { ?>
function openeditwin(filename,y,m,d)
{
	url="op-pflege-logbuch-arch-edit.php?mode=edit&fileid="+filename+"&sid=<?php echo $sid; ?>&user=<?php echo str_replace(" ","+",$user); ?>&pyear="+y+"&pmonth="+m+"&pday="+d+"&dept_nr=<?php echo $dept_nr;?>&saal=<?php echo $saal;?>";
	
	w=window.parent.screen.width;
	h=window.parent.screen.height;
	archeditwin=window.open(url,"editwin","menubar=no,resizable=yes,scrollbars=yes, width=" + (w-15) + ", height=400");
	window.archeditwin.moveTo(0,0);
}

function getinfo(pid,pdata){
	urlholder="<?php echo $root_path; ?>modules/nursing/nursing-station-patientdaten.php<?php echo URL_REDIRECT_APPEND; ?>&pn="+pid+"&patient=" + pdata + "&station=<?php echo "$dept_nr&dept_nr=$dept_nr&pday=$pday&pmonth=$pmonth&pyear=$pyear&op_shortcut=".$_COOKIE['ck_op_pflegelogbuch_user'.$sid]; ?>";
	patientwin=window.open(urlholder,pid,"width=700,height=450,menubar=no,resizable=yes,scrollbars=yes");
	}
	
<?php } ?>	

<?php require($root_path.'include/core/inc_checkdate_lang.php'); ?>
// -->
</script>

<STYLE TYPE="text/css">
div.cats{
	position: absolute;
	right: 10;
	top: 80;
}
</style>

<?php

$sTemp = ob_get_contents();
ob_end_clean();
$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

echo '
		<table cellpadding=0 cellspacing=0 border=0 bgcolor="#999999" width="100%">
		<tr><td>
		<table  cellpadding="3" cellspacing="1" border="0" width="100%">';	
echo '
		<tr class="wardlisttitlerow"><td colspan=2   ><nobr>';
 	
echo '
			<a href="op-pflege-logbuch-arch-start.php?sid='.$sid.'&lang='.$lang.'&nogetlast=1&dept_nr='.$dept_nr.'&saal='.$saal.'&thisday='.$yesday.'&noseek=1" 
			title="'.formatDate2Local($yesday,$date_format).'">
			&lt;&lt; '.$LDPrevDay.'</a>';

echo '				
		</td><td colspan=5 align=center ><FONT  SIZE=4>
		<b>';
		
list($ty,$tm,$td)=explode('-',$thisday);

echo $tage[(date("w",mktime(0,0,0,$tm,$td,$ty)))].' ('.formatDate2Local($thisday,$date_format).')</b> </td>
		<td colspan=2 align=right >';

if($thisday!=$today) echo '
					<a href="op-pflege-logbuch-arch-start.php?sid='.$sid.'&lang='.$lang.'&nogetlast=1&dept_nr='.$dept_nr.'&saal='.$saal.'&thisday='.$tomorow.'&noseek=1" 
					title="'.formatDate2Local($tomorow,$date_format).'">
					<nobr>'.$LDNextDay.' &gt;&gt;</a></td></tr>';
echo '
		<tr bgcolor="#f9f9f9" >';
	while(list($x,$v)=each($LDOpMainElements))
	{
		echo '
		<td class="wardlisttitlerow">'.$v.'</td>';
	}
echo '
		</tr>';

if($datafound)
{

  while($pdata=$ergebnis->FetchRow())
  {
	if ($toggler==0) { echo '<tr bgcolor="#fdfdfd">'; $toggler=1;} 
		else { echo '<tr bgcolor="#dddddd">'; $toggler=0;}
		
	echo '
			<a name="'.$pdata['encounter_nr'].'"></a>';
			
	list($iyear,$imonth,$iday)=explode('-',$pdata['op_date']);
	
	echo '
			<td valign=top><font size="1" ><font size=2 color=red><b>'.$pdata['op_nr'].'</b></font><hr>'.formatDate2Local($pdata['op_date'],$date_format).'<br>
			'.$tage[date("w",mktime(0,0,0,$imonth,$iday,$iyear))].'<br>
			<a href="op-pflege-logbuch-start.php?sid='.$sid.'&lang='.$lang.'&mode=saveok&enc_nr='.$pdata['encounter_nr'].'&op_nr='.$pdata['op_nr'].'&dept_nr='.$pdata['dept_nr'].'&saal='.$pdata['op_room'].'&thisday='.$pdata['op_date'].'" ';
	
	if ($child) echo 'target="_parent"';		
	
	echo '>
			<img '.createComIcon($root_path,'bul_arrowgrnlrg.gif','0').' alt="'.str_replace("~tagword~",$pdata['name_last'],$LDEditPatientData).'"></a>
			</td>';
	echo '
			<td valign=top><nobr><font size="1" color=blue>
			<a href="javascript:getinfo(\''.$pdata[encounter_nr].'\',\''.$pdata[dept_nr].'\')">
			<img '.createComIcon($root_path,'info2.gif','0').' alt="'.str_replace("~tagword~",$pdata['name_last'],$LDOpenPatientFolder).'"></a>&nbsp; ';

	echo ($pdata['encounter_class_nr']==1)?($pdata['encounter_nr']+$GLOBAL_CONFIG['patient_inpatient_nr_adder']) : ($pdata['encounter_nr']+$GLOBAL_CONFIG['patient_outpatient_nr_adder']);
	echo '<br>
			<font color=black><b>'.$pdata['name_last'].', '.$pdata['name_first'].'</b><br>'.formatDate2Local($pdata['date_birth'],$date_format).'<p>
			<font color="#000000">'.$pdata['addr_str'].' '.$pdata['addr_str_nr'].'<br>'.$pdata['addr_zip'].' '.$pdata['citytown_name'].'</font><br></td>';
	echo '
			<td valign=top><font size="1" >';
	echo '
			<font color="#cc0000">Diagnose:</font><br>';
	echo nl2br($pdata['diagnosis']);
	echo '
			</td>
			<td valign=top><font size="1" ><nobr>';
	
	$ebuf=array('operator','assistant','scrub_nurse','rotating_nurse');
	//$tbuf=array("O","A","I","S");
	//$cbuf=array("Operateur","Assistent","Instrumenteur","Springer");
	for($n=0;$n<sizeof($ebuf);$n++)
	{
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
		
	echo '</td>';
	
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
/*
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
*/
			
	echo '
	</td>
	<td valign=top><font size="1" >';

	 $cc=explode("~",$pdata['cut_close']);
	for($i=0;$i<sizeof($cc);$i++)
	{
		$xbug=trim($cc[$i]);
		if(empty($xbug)) continue;
		parse_str($cc[$i],$ccbuf);
		echo '<font size="1" color="#cc0000">'.$LDOpCut.':</font><br>'.strtr($ccbuf['s'],'.',':').'<br>
		<font size="1" color="#cc0000">'.$LDOpClose.':</font><br>'.strtr($ccbuf['e'],'.',':').'<br>';
		if(trim($ccbuf['s'])=='') break;
	}
/*
	echo '<font size="1" color="#cc0000">'.$LDOpCut.':</font><br>'.convertTimeToLocal($ccbuf[s]).'<p>
	<font size="1" color="#cc0000">'.$LDOpClose.':</font><br>'.convertTimeToLocal($ccbuf[e]).'</td>';
*/
	echo '
	<td valign=top><font size="1" color="#cc0000">'.$LDOpMainElements[therapy].':<font color=black><br>'.nl2br($pdata['op_therapy']).'</td>';
	
	echo '
	<td valign=top><nobr><font size="1" color="#cc0000">'.$LDOpMainElements[result].':<br>';
	
	echo '<font color=black>'.nl2br($pdata['result_info']).'</td>';
	
	echo '
	<td valign=top><font size="1" >';

	 $eo=explode("~",$pdata['entry_out']);
	for($i=0;$i<sizeof($eo);$i++)
	{
		$xbug=trim($eo[$i]);
		if(empty($xbug)) continue;
		parse_str($eo[$i],$eobuf);
		echo '<font size="1" color="#cc0000">'.$LDOpIn.':</font><br>'.strtr($eobuf['s'],'.',':').'<br>
		<font size="1" color="#cc0000">'.$LDOpOut.':</font><br>'.strtr($eobuf['e'],'.',':').'<br>';
		if(trim($eobuf['s'])=='') break;
	}

	/*
	echo '<font size="1" color="#cc0000">'.$LDOpIn.':</font><br>'.convertTimeToLocal($eobuf[s]).'<p>
	<font size="1" color="#cc0000">'.$LDOpOut.':</font><br>'.convertTimeToLocal($eobuf[e]).'</td>';
*/
	echo '
	</tr>';

	}

}else{
		echo '
		<tr><td colspan=9 bgcolor="#fcfcfc">';

		echo '<p><br><center>';
		if ($thisday != $today)
		{
			echo '
			<MAP NAME="catcom">
			<AREA SHAPE="RECT" COORDS="158,90,230,110"  HREF="op-pflege-logbuch-xtsuch-start.php?sid='.$sid.'&lang='.$lang.'&mode=fresh&dept_nr='.$dept_nr.'&saal='.$saal.'"   title="'.$LDSearchPatient.' ['.$LDOrLogBook.']" >
			</MAP><img ismap usemap="#catcom" '.createLDImgSrc($root_path,'cat-com2.gif','0').'>
			<DIV id=dLogoTable style=" VISIBILITY: hidden; POSITION: relative">
			<table border=0 bgcolor="#33333" cellspacing=0 cellpadding=1>
     		<tr>
       		<td>
				<table border=0 bgcolor="#ffffee" >
     				<tr>
       				<td><font size=2>
						&nbsp;<a href="#" onmouseover=clearTimeout(timer) onmouseout="timer=setTimeout(\'hsm()\',500)" ><img '.createComIcon($root_path,'redpfeil.gif','0').'> '.$LDShowPrevLog.'</a>&nbsp;<br>
						&nbsp;<a href="#" onmouseover=clearTimeout(timer) onmouseout="timer=setTimeout(\'hsm()\',500)" ><img '.createComIcon($root_path,'redpfeil.gif','0').'> '.$LDShowNextLog.'</a>&nbsp;<br>
						&nbsp;<a href="#" onmouseover=clearTimeout(timer) onmouseout="timer=setTimeout(\'hsm()\',500)" ><img '.createComIcon($root_path,'redpfeil.gif','0').'> '.$LDShowGuideCal.'</a>&nbsp;<br></font>
	   				</td>
     				</tr>
  		 </table>
	
	   		</td>
     		</tr>
  		 </table>
		 </DIV>';
		}
		else
			{ 
				$buffy=str_replace(" ","+",$_COOKIE['ck_op_pflegelogbuch_user'.$sid]);
				echo '<img src="'.$root_path.'main/imgcreator/catcom.php?person='.$buffy.'&rnd='.$r.'">';
				if($nofile) echo '<p><b><font color="#800000" size=4>'.$LDPatNoExist.'</b>';
			}
		//echo '
			//<br><p>
			//<b>Heute ist der '.date(d).'.'.date(m).'.'.date(Y).'</b></center>';
		echo '</center>';
		echo '
		</td></tr>';}
echo '
		</table>
		</td>
		</tr>
		</table>
		';
		
?>

<p>
        
<ul>

<form action="op-pflege-logbuch-arch-start.php" method="post" name="chgdept" onSubmit="return pruf(this)">

<input type="hidden" name="sid" value="<?php echo $sid; ?>">
<input type="hidden" name="lang" value="<?php echo $lang; ?>">
<input type="hidden" name="user" value="<?php echo $user; ?>">
<input type="hidden" name="child" value="<?php echo $child; ?>">

<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> 
<nobr>
<?php echo $LDChangeDept ?><br>
				<select name="dept_nr" size=1>
				<?php
                   while(list($x,$v)=each($surgery_arr))
					{
						if($x==42) continue;
						echo'
					<option value="'.$v['nr'].'"';
						if ($dept_nr==$v['nr']) echo ' selected';
						echo '>';
						$buffer=$v['LD_var'];
						if(isset($$buffer)&&!empty($$buffer)) echo $$buffer;
							else echo $v['name_formal'];
						echo '</option>';
					}
				?>
					
				</select>
			<select name="saal" size=1>
				<?php
				if(is_object($ORNrs)){
                    while($ORnr=$ORNrs->FetchRow())
					{
						echo'
					<option value="'.$ORnr['room_nr'].'"';
						if ($saal==$ORnr['room_nr']) echo ' selected';
						echo '> '.$ORnr['room_nr'].'</option>';
					}
				}
				?>
			</select>
			<?php
			//gjergji : new calendar 
			echo $calendar->show_calendar($calendar,$date_format,'sdate',$thisday);	
			//end : gjergji
			?>   
			</nobr>
<input type="submit" value="<?php echo $LDChange ?>">

</form><p>
<b><?php echo $LDOtherFunctions ?>:</b><br>

<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="op-pflege-logbuch-xtsuch-start.php?sid=<?php echo "$sid&lang=$lang&mode=fresh&dept_nr=$dept_nr&saal=$saal&child=$child" ?>"><?php echo "$LDSearchPatient [$LDOrLogBook]" ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="op-pflege-logbuch-start.php?sid=<?php echo "$sid&lang=$lang&mode=fresh&dept_nr=$dept_nr&saal=$saal" ?>" <?php if ($child) echo "target=\"_parent\""; ?>><?php echo "$LDStartNewDocu [$opabt[$dept_nr] $LDRoom $saal]" ?></a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="javascript:gethelp('oplog.php','arch','<?php echo $dif ?>','<?php echo $lastlog ?>','<?php echo $datafound ?>')"><?php echo "$LDHelp" ?></a><br>
<!-- 
<p>
<a href="javascript:window.close();"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>  alt="<?php echo $LDCancel ?>"></a>
 --></ul>

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
