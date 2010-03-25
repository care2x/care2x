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
$lang_tables[]='departments.php';
$lang_tables[] = 'actions.php';
define('LANG_FILE','or.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');

if (!$internok&&!$_COOKIE['ck_op_pflegelogbuch_user'.$sid]) {header("Location:../language/".$lang."/lang_".$lang."_invalid-access-warning.php"); exit;}; 

# Load date shifter class 
require_once($root_path.'classes/datetimemanager/class.dateTimeManager.php');
# Create new dateTimeManager object */
$tshifter = new dateTimeManager;
# Set default date to today
if(!isset($thisday)) $thisday=date('Y-m-d');
# Shift time back 1 day 
$yesday = $tshifter->shift_dates($thisday, '1', 'd');
# Shift time forward 1 day 
$tomorow = $tshifter->shift_dates($thisday, '-1', 'd');
# Todays date
$today=date('Y-m-d');

$toggler=0;

$pdata=array();
$template=array();

# Default is op room #1
if(!isset($saal)||empty($saal)) $saal=1; 
# Set first entry flag
setcookie(firstentry,'1');

require_once($root_path.'include/care_api_classes/class_department.php');
$dept_obj=new Department;
# Preload the deparment info 
$dept_obj->preloadDept($dept_nr);
# Get list of all the OR room numbers 
$ORNrs=&$dept_obj->getAllActiveORNrs();

$surgery_arr=&$dept_obj->getAllActiveWithSurgery();

# Load the date formatter 
require_once($root_path.'include/core/inc_date_format_functions.php');
	
$dbtable='care_encounter_op';
			
$sql="SELECT o.*,e.encounter_class_nr, p.name_last, p.name_first, p.date_birth, p.addr_str, p.addr_str_nr, p.addr_zip, t.name AS citytown_name
			FROM $dbtable AS o, care_encounter AS e, care_person AS p
				LEFT JOIN care_address_citytown AS t ON p.addr_citytown_nr=t.nr
			WHERE o.dept_nr='$dept_nr'
						AND o.op_room='$saal'
						AND o.op_date='$thisday'
						AND o.encounter_nr=e.encounter_nr
						AND e.pid=p.pid
						ORDER BY o.nr
						";

if($ergebnis=$db->Execute($sql)){
	if($rows=$ergebnis->RecordCount()){
		$datafound=1;
	}
}else{
	echo "$LDDbNoRead<br>$sql"; 
} 
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 
 <script language=javascript src="<?php echo $root_path; ?>js/syncdeptsaal.js"></script>
 
 <script language=javascript>
 <!-- 
 function pruf(d)
{
 	if((d.dept_nr.value=='<?php echo $dept_nr; ?>')&&(d.saal.value=='<?php echo $saal;?>')) return false;
	window.top.LOGINPUT.location.replace('oploginput.php?sid=<?php echo "$sid&lang=$lang" ?>&mode=chgdept&dept_nr='+d.dept_nr.value+'&saal='+d.saal.value);
	return true;
}
function getinfo(pid,pdata){
	urlholder="<?php echo $root_path; ?>modules/nursing/nursing-station-patientdaten.php<?php echo URL_REDIRECT_APPEND; ?>&pn="+pid+"&patient=" + pdata + "&dept_nr=<?php echo "$dept_nr&pday=$pday&pmonth=$pmonth&pyear=$pyear&op_shortcut=".$_COOKIE['ck_op_pflegelogbuch_user'.$sid]; ?>";
	patientwin=window.open(urlholder,pid,"width=700,height=450,menubar=no,resizable=yes,scrollbars=yes");
	}
 function initall(){
	d=window.parent.LOGINPUT.document.oppflegepatinfo.xx2;
	if(d) d.value="";
	}
 // -->
 </script>
 <?php
require($root_path.'include/core/inc_js_gethelp.php');
require($root_path.'include/core/inc_css_a_hilitebu.php');
?>
 <?php if(!$datafound) { ?>
<script language="javascript" src="<?php echo $root_path; ?>js/showhide-div.js"></script>
<?php } ?>
</HEAD>

<BODY bgcolor=#666666 topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 bgcolor="silver" alink="navy" vlink="navy"
onLoad="window.location.replace('#<?php if ($gotoid) echo $gotoid; else echo 'bot'; ?>');">

<CENTER>
<?php
	
$opabt=get_meta_tags($root_path.'global_conf/'.$lang.'/op_tag_dept.pid');


echo '
<table  cellpadding="3" cellspacing="1" border="0" width="100%">';	
		
echo '
		<tr class="wardlisttitlerow"><td colspan=2><nobr>
		<a href="oplogmain.php?sid='.$sid.'&lang='.$lang.'&internok='.$internok.'&thisday='.$yesday.'&dept_nr='.$dept_nr.'&saal='.$saal.'" title="'.formatDate2Local($yesday,$date_format).'">
		&lt;&lt; '.$LDPrevDay.'</a></td>
		<td colspan=3 align=center><FONT  SIZE=+1>
		<b>';
		$buffer=$dept_obj->LDvar();
		if(isset($$buffer)&&!empty($$buffer)) echo $$buffer;
			else echo $dept_obj->FormalName();
		echo ' '.$LDRoom.'-'.strtoupper($saal).' ('.formatDate2Local($thisday,$date_format).')</b></td>';
?>
		<td colspan=2>
		<nobr>
			<table cellpadding=0 cellspacing=0 border=0>	
			<form action="oplogmain.php" method="post" name="chgdept" onSubmit="return pruf(this)">
			<tr>
			<td>
				<input type="hidden" name="thisday" value="<?php  echo $thisday; ?>">
    			<input type="hidden" name="sid" value="<?php echo $sid; ?>">
    			<input type="hidden" name="lang" value="<?php echo $lang; ?>">
    
				<!-- <select name="dept_nr" size=1 onChange="syncDept(this,document.chgdept.saal)"> -->
				<select name="dept_nr" size=1>
				<?php
                   while(list($x,$v)=each($surgery_arr))
					{
						if($x==42) continue;
						echo'
					<option value="'.$v['nr'].'"';
						if ($dept_nr==$v['nr']) echo " selected";
						echo '>';
						$buffer=$v['LD_var'];
						if(isset($$buffer)&&!empty($$buffer)) echo $$buffer;
							else echo $v['name_formal'];
						echo '</option>';
					}
				?>
					
				</select>
			</td>
			<td>
				<!-- <select name="saal" size=1 onChange="syncSaal(this,document.chgdept.dept)"> -->
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
			</td>
			<td>&nbsp;
			<input type="submit" value="<?php echo $LDChange ?>" >
   			</td>
			</tr></form>
			</table>
			</nobr>
<?php
	echo '
			</td>
			<td colspan=1 align=middle>
			<form>
			<a href="javascript:gethelp(\'oplog.php\',\'create\',\'logmain\')"><img '.createComIcon($root_path,'frage.gif','0','absmiddle').' alt="'.$LDHelp.'"></a>
			<input type="button" value="'.$LDRefreshWindow.'" title="'.$LDRefreshWindow.'" onclick="window.location.reload()"></form>
			</td>
			<td colspan=1 align=right>';

if($thisday!=$today){
	echo '
		<a href="oplogmain.php?sid='.$sid.'&lang='.$lang.'&internok='.$internok.'&thisday='.$tomorow.'&dept_nr='.$dept_nr.'&saal='.$saal.'" title="'.formatDate2Local($tomorow,$date_format).'"><nobr>'.$LDNextDay.' &gt;&gt;</a>';
}

echo '
		</td></tr>';

if($datafound){
echo '
<tr bgcolor="#f9f9f9" >';
while(list($x,$v)=each($LDOpMainElements))
	echo '
		<td><font face="verdana,arial" size="1"><b>&nbsp;'.$v.'</b></td>';

echo '
</tr>';
}

while($pdata=$ergebnis->FetchRow())
	{
	if ($toggler==0) 
		{ echo '
		<tr bgcolor="#fdfdfd">'; $toggler=1;} 
		else { echo '
		<tr bgcolor="#fdfdfd">'; $toggler=0;}
	echo '<a name="'.$pdata['op_nr'].'"></a>
	<td valign=top><font face="verdana,arial" size="1" ><font size=2 color=red><b>'.$pdata['op_nr'].'</b></font>
	<hr>'.formatDate2Local($pdata['op_date'],$date_format).'<br>';
	
	list($pyear,$pmonth,$pday)=explode('-',$pdata['op_date']);
	
	echo $tage[date(w,mktime(0,0,0,$pmonth,$pday,$pyear))].'<br>
	<a href="oploginput.php?sid='.$sid.'&lang='.$lang.'&internok='.$internok.'&mode=edit&enc_nr='.$pdata['encounter_nr'].'&dept_nr='.$dept_nr.'&saal='.$saal.'&op_nr='.$pdata['op_nr'].'&thisday='.$pdata['op_date'].'" target="LOGINPUT" >
	<img '.createComIcon($root_path,'dwnarrowgrnlrg.gif','0').' alt="'.str_replace("~tagword~",$pdata['lastname'],$LDEditPatientData).'"></a>
	</td>';
/*	echo $tage[date(w,mktime(0,0,0,$pmonth,$pday,$pyear))].'<br>
	<a href="oploginput.php?sid='.$sid.'&lang='.$lang.'&internok='.$internok.'&mode=edit&enc_nr='.$pdata['encounter_nr'].'&dept_nr='.$dept_nr.'&saal='.$saal.'&op_nr='.$pdata['op_nr'].'&pyear='.$pyear.'&pmonth='.$pmonth.'&pday='.$pday.'" target="LOGINPUT" >
	<img '.createComIcon($root_path,'dwnarrowgrnlrg.gif','0').' alt="'.str_replace("~tagword~",$pdata['lastname'],$LDEditPatientData).'"></a>
	</td>';
*/	echo '
	<td valign=top><nobr><font face="verdana,arial" size="1" color=blue>
	<a href="javascript:getinfo(\''.$pdata['encounter_nr'].'\')">
	<img '.createComIcon($root_path,'info2.gif','0').' alt="'.str_replace("~tagword~",$pdata['lastname'],$LDOpenPatientFolder).'"></a> ';
	
	//echo ($pdata['encounter_class_nr']==1)?($pdata['encounter_nr']+$GLOBAL_CONFIG['patient_inpatient_nr_adder']) : ($pdata['encounter_nr']+$GLOBAL_CONFIG['patient_outpatient_nr_adder']);

	echo $pdata['encounter_nr'];
	echo '<br>
	<font color=black><b>'.$pdata['name_last'].', '.$pdata['name_first'].'</b><br>'.formatDate2Local($pdata['date_birth'],$date_format).'<p>
			<font color="#000000">'.$pdata['addr_str'].' '.$pdata['addr_str_nr'].'<br>'.$pdata['addr_zip'].' '.$pdata['citytown_name'].'</font><br></td>';
	echo '
	<td valign=top width=150><font face="verdana,arial" size="1" >';
	echo '
	<font color="#cc0000">'.$LDOpMainElements['diagnosis'].':</font><br>';
	echo nl2br($pdata['diagnosis']);
	echo '
	</td><td valign=top><font face="verdana,arial" size="1" ><nobr>';
	
	$ebuf=array("operator","assistant","scrub_nurse","rotating_nurse");
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
		
	echo '
	</td>
	<td valign=top><font face="verdana,arial" size="1" >'.$LDAnaTypes[$pdata['anesthesia']].'<p>';
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

	echo '
	</td>
	<td valign=top><font face="verdana,arial" size="1" >';

	 $cc=explode("~",$pdata['cut_close']);
	for($i=0;$i<sizeof($cc);$i++)
	{
		parse_str($cc[$i],$ccbuf);
		echo '<font face="verdana,arial" size="1" color="#cc0000">'.$LDOpCut.':</font><br>'.strtr($ccbuf['s'],'.',':').'<br>
		<font face="verdana,arial" size="1" color="#cc0000">'.$LDOpClose.':</font><br>'.strtr($ccbuf['e'],'.',':').'<br>';
		if(trim($ccbuf['s'])=='') break;
	}
	echo '
	</td>
	<td valign=top><font face="verdana,arial" size="1" color="#cc0000">'.$LDOpMainElements['therapy'].':<font color=black><br>'.nl2br($pdata['op_therapy']).'</td>';
	echo '
	<td valign=top><nobr><font face="verdana,arial" size="1" color="#cc0000">'.$LDOpMainElements[result].':<br>';
	echo '<font color=black>'.nl2br($pdata['result_info']).'</td>';
	echo '
	<td valign=top><font face="verdana,arial" size="1" >';
	
	 $eo=explode("~",$pdata['entry_out']);
	for($i=0;$i<sizeof($eo);$i++)
	{
		parse_str($eo[$i],$eobuf);
		echo '<font face="verdana,arial" size="1" color="#cc0000">'.$LDOpIn.':</font><br>'.strtr($eobuf['s'],'.',':').'<br>
		<font face="verdana,arial" size="1" color="#cc0000">'.$LDOpOut.':</font><br>'.strtr($eobuf['e'],'.',':').'<br>';
		if(trim($eobuf['s'])=='') break;
	}

	echo '
	</td>
	</tr>';

	}

echo '
</table>';

if(!$datafound)
{
	echo '<p>';
	if ($thisday != $today)
	{
	echo '
			<MAP NAME="catcom">
			<AREA SHAPE="RECT" COORDS="158,90,230,110" HREF="op-pflege-logbuch-xtsuch-start.php?sid='.$sid.'&lang='.$lang.'&mode=fresh&dept_nr='.$dept_nr.'&saal='.$saal.'&child=1"  target="_parent"  title="'.$LDSearchPatient.' ['.$LDOrLogBook.']" >
			</MAP><img ismap usemap="#catcom" '.createLDImgSrc($root_path,'cat-com2.gif','0').'>';
?>
			<DIV id=dLogoTable style=" VISIBILITY: hidden; POSITION: relative">
			<table border=0 bgcolor="#33333" cellspacing=0 cellpadding=1>
     		<tr>
       		<td>
				<table border=0 bgcolor="#ffffee" >
     				<tr>
       				<td><font size=2 face="verdana,arial">
						&nbsp;<a href="#" onmouseover=clearTimeout(timer) onmouseout="timer=setTimeout('hsm()',500)" ><img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <?php echo $LDShowPrevLog ?></a>&nbsp;<br>
						&nbsp;<a href="#" onmouseover=clearTimeout(timer) onmouseout="timer=setTimeout('hsm()',500)" ><img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <?php echo $LDShowNextLog ?></a>&nbsp;<br>
						&nbsp;<a href="#" onmouseover=clearTimeout(timer) onmouseout="timer=setTimeout('hsm()',500)" ><img <?php echo createComIcon($root_path,'redpfeil.gif','0','absmiddle') ?>> <?php echo $LDShowGuideCal ?></a>&nbsp;<br></font>
	   				</td>
     				</tr>
  		 </table>
	
	   		</td>
     		</tr>
  		 </table>
		 </DIV>
<?php
		/*echo '<img src="../img/'.$lang.'/'.$lang.'_cat-com2.gif">';*/
	}elseif(!$firstentry){
	
		$buffy=str_replace(" ","+",$_SESSION['sess_user_name']); 
		 echo '<img src="'.$root_path.'main/imgcreator/catcom.php?lang='.$lang.'&person='.$buffy.'">';
	}
}
?>

<a name="bot"></a>
</BODY>
</HTML>
