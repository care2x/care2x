<?php
//error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'/include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','tech.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);
$breakfile='technik.php'.URL_APPEND;
$returnfile=$_SESSION['sess_file_return'].URL_APPEND;
$_SESSION['sess_file_return']=basename(__FILE__);

if(!isset($dept)) $dept='';
if(!isset($tech)) $tech='';
if(!isset($mode)) $mode='';
if(!isset($ofset)) $ofset='';

# Load the date formatter
require_once($root_path.'include/inc_date_format_functions.php');

if(isset($mode)&&($mode=='search'))
{
	if(isset($dept)&&empty($dept)&&isset($tech)&&empty($tech)&&isset($sdate)&&empty($sdate)&&isset($edate)&&empty($edate))  $mode='';
	
	if(isset($edate)&&$edate)
	{
  	    $edate=@formatDate2STD($edate,$date_format);
	}
	
	if(isset($sdate)&&$sdate)
	{
	     $sdate=@formatDate2STD($sdate,$date_format);
	}
		
		
	if(!isset($ofset)||!$ofset) $ofset=0;
	if(!isset($nrows)||!$nrows) $nrows=20;
}

# init db parameters
$linecount=0;
$dbtable='care_tech_repair_done';

if($mode=='search') {

	$sql='SELECT * FROM '.$dbtable.' WHERE ';
	
	if($tech) $sql.=" reporter LIKE '$tech%' ";
	
	if($dept)
	{
		if($tech) $sql.=" AND dept LIKE '$dept%' "; else $sql.=" dept LIKE '$dept%' ";
	}
	$buf='';

	if($sdate)
	{
		if($edate) $buf=" tdate>='$sdate' AND tdate<='$edate' ";
		else $buf=" tdate='$sdate' ";
	}
	else
	{
		if($edate) $buf=" tdate<='$edate' ";
	}

	if($buf)
	{
		if(($dept)||($tech)) $sql.=" AND $buf "; else $sql.=$buf;
	}
//echo $sql;
}else{
	$sql='SELECT * FROM '.$dbtable.' WHERE seen=0 ORDER BY tid DESC';
}

if($ergebnis=$db->Execute($sql)){
	$linecount=$ergebnis->RecordCount();
}else{
	echo "<p>".$sql."$LDDbNoRead<br>"; 
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
 $smarty->assign('sToolbarTitle',$LDTechSupport);

 # href for return button
 $smarty->assign('pbBack',$returnfile);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('tech.php','arch')");

 # href for close button
 $smarty->assign('breakfile',$breakfile);

 # Window bar title
 $smarty->assign('sWindowTitle',$LDTechSupport);

 # Collect js code

ob_start();

?>

<script language="javascript" >
<!-- 
function show_order(d,D,t,r,i)
{
	urlholder="technik-report-showcontent.php<?php echo URL_REDIRECT_APPEND; ?>&dept="+d+"&tdate="+D+"&ttime="+t+"&reporter="+r+"&tid="+i;
	//orderlistwin=window.open(urlholder,"orderlistwin","width=700,height=550,menubar=no,resizable=yes,scrollbars=yes");
	window.location.href=urlholder;
}

<?php require($root_path.'include/inc_checkdate_lang.php'); ?>

// -->
</script> 
<?php
//gjergji : new calendar
require_once ('../../js/jscalendar/calendar.php');
$calendar = new DHTML_Calendar('../../js/jscalendar/', $lang, 'calendar-system', true);
$calendar->load_files();
//end : gjergji
$sTemp = ob_get_contents();
ob_end_clean();
$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

?>

<ul>

<p>
  <form action="<?php echo $thisfile?>" method="get" name="suchform">
  <table border=0 cellspacing=2 cellpadding=3>
    <tr bgcolor=#ffffdd>
      <td  colspan=2 class="wardlisttitlerow"><?php echo $LDSearchReport ?>:</td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><?php echo $LDTechnician ?>:</td>
      <td><input type="text" name="tech" size=25 maxlength=40>
          </td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><?php echo $LDDept ?>:</td>
      <td><input type="text" name="dept" size=25 maxlength=40>
          </td>
    </tr>
    <tr bgcolor=#ffffdd>
      <td align=right><?php echo "$LDDate $LDFrom" ?>:</td>
      <td>	
			  <?php   //gjergji : new calendar
					  echo $calendar->show_calendar($calendar,$date_format,'sdate'); 
					  echo $calendar->show_calendar($calendar,$date_format,'edate');
					  //end : gjergji
			  ?>			
         </td>
    </tr>

    <tr >
      <td colspan=2><input type="image" <?php echo createLDImgSrc($root_path,'searchlamp.gif','0'); ?>>
           </td>
    </tr>
  </table>
  <input type="hidden" name="sid" value="<?php echo $sid ?>">
  <input type="hidden" name="lang" value="<?php echo $lang ?>">
    <input type="hidden" name="mode" value="search">
    </form>
  
  
<hr width=80% align=left>
<?php if($linecount>0)
{
	echo '
			
			<p> ';
			if ($linecount>1) echo $LDReportListMany; else echo $LDReportList;
		if($mode!="")
		{
			if ($linecount>1) echo $LDLikeSearchMany; else echo $LDLikeSearch; 
		}
		else
		{ 
			if ($linecount>1) echo $LDNotReadMany; else echo $LDNotRead; 
		}
			echo "<br>$LDClk2Read<br></font><p>";

		$tog=1;
		echo '
				<table border=0 cellspacing=0 cellpadding=0 bgcolor="#666666"><tr><td >
				<table border=0 cellspacing=1 cellpadding=3>
  				<tr>';
		for ($i=0;$i<sizeof($bcatindex);$i++)
		echo '
				<td  class="wardlisttitlerow">'.$bcatindex[$i].'</td>';
		echo '
				</tr>';	

		$i=$ofset+1;
		
		/* Load the common icons */
		$img_uparrow=createComIcon($root_path,'uparrowgrnlrg.gif','0');

		while($content=$ergebnis->FetchRow())
 		{
			if($tog)
			{ echo '<tr class="wardlistrow1">'; $tog=0; }else{ echo '<tr class="wardlistrow2">'; $tog=1; }
			echo'
				<td>'.$i.'</td>
				<td><a href="javascript:show_order(\''.$content['dept'].'\',\''.$content['tdate'].'\',\''.$content['ttime'].'\',\''.$content['reporter'].'\',\''.$content['tid'].'\')">
				<img '.$img_uparrow.' alt="'.$LDClk2Read.'"></a></td>
				 <td>'.$content['reporter'].'</td>
				<td >'.strtoupper($content['dept']).'</td>
				<td>'.@formatDate2Local($content['tdate'],$date_format).'</td>
				 <td>'.@convertTimeToLocal($content['ttime']).'</td>
				<td>';
	if($content['seen']) echo '<img '.createComIcon($root_path,'check-r.gif','0').'>'; else echo "&nbsp;";
	echo '</td>
				</tr>';
			$i++;

 		}
		echo '
			</table>
			</td></tr><tr bgcolor="'.$cfg['body_bgcolor'].'">
			<td>';
		if($ofset) echo '	<form name=back action='.$thisfile.' method=post>
								<input type="hidden" name="keyword" value="'.$keyword.'">
        						<input type="hidden" name="mode" value="search">
        						<input type="hidden" name="such_date" value="'.$such_date.'">
                   				<input type="hidden" name="such_prio" value="'.$such_prio.'">
              					<input type="hidden" name="such_dept" value="'.$such_dept.'">
              					<input type="hidden" name="ofset" value="'.($ofset-$nrows).'">
                   				<input type="hidden" name="nrows" value="'.$nrows.'">
                       			<input type="hidden" name="sid" value="'.$sid.'">           
                       			<input type="hidden" name="lang" value="'.$lang.'">           
								<input type="submit" value="&lt;&lt; Prapa">
								</form>';
		echo "</td><td align=right>";
		
		if(!isset($nrows)) $nrows=0;
		
		if($linecount==$nrows) 
						echo '<form name=forward action='.$thisfile.' method=post>
								<input type="hidden" name="keyword" value="'.$keyword.'">
								<input type="hidden" name="mode" value="search">
        						<input type="hidden" name="such_date" value="'.$such_date.'">
              					<input type="hidden" name="such_dept" value="'.$such_dept.'">
                   				<input type="hidden" name="such_prio" value="'.$such_prio.'">
        						<input type="hidden" name="ofset" value="'.($ofset+$nrows).'">
              					<input type="hidden" name="nrows" value="'.$nrows.'">
                       			<input type="hidden" name="lang" value="'.$lang.'">           
                   				<input type="hidden" name="sid" value="'.$sid.'">     
								<input type="submit" value="Weiter &gt;&gt;">
								</form>';
		echo '
			</td>
			</tr>	
			</table>';                            
}
else
{
if($ofset) echo '	<form name=back action='.$thisfile.' method=post>
								<input type="hidden" name="keyword" value="'.$keyword.'">
        						<input type="hidden" name="mode" value="search">
        						<input type="hidden" name="such_date" value="'.$such_date.'">
                   				<input type="hidden" name="such_prio" value="'.$such_prio.'">
              					<input type="hidden" name="such_dept" value="'.$such_dept.'">
              					<input type="hidden" name="ofset" value="'.($ofset-$nrows).'">
                   				<input type="hidden" name="nrows" value="'.$nrows.'">
                       			<input type="hidden" name="sid" value="'.$sid.'">           
                       			<input type="hidden" name="lang" value="'.$lang.'">           
								<input type="submit" value="&lt;&lt; Prapa">
								</form>';
							
if($mode=='search') echo '
	<table border=0>
   <tr>
     <td><img '.createMascot($root_path,'mascot1_r.gif','0','middle').'></td>
     <td class="warnprompt">'.$LDNoFound.'</td>
   </tr>
 </table>';
 
	
}

?>
<p><br>
 <a> <?php echo'<a href="technik.php'.URL_APPEND.'"><img '.createLDImgSrc($root_path,'back2.gif','0').'>';?></a>
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