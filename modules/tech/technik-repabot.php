<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
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

$dbtable='care_tech_repair_job';

    /* Load the date formatter */
    include_once($root_path.'include/inc_date_format_functions.php');
    	
    /* Load editor functions for time format converter */
    //include_once('../include/inc_editor_fx.php');

    $sql='SELECT * FROM '.$dbtable.' WHERE archive=0  ORDER BY tid DESC';
    if($ergebnis=$db->Execute($sql)) {
        $rows=$ergebnis->RecordCount();
    }else {echo "<p>$sq $LDDbNoRead<br>"; };

?>

<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<meta http-equiv="refresh" content="15, url: technik-repabot.php?<?php echo "sid=$sid&lang=$lang" ?>">
<title><?php echo $LDRepabotActivate ?></title>
<script language=javascript>
function goactive()
	{
<?php
if ($nofocus=='') echo "	
 	if(window.focus) window.focus();
 	";
?>
	window.resizeTo(800,600);
	}
	
function show_order(d,o,s,t)
{
	url="technik-repabot-print.php<?php echo URL_REDIRECT_APPEND; ?>&dept="+d+"&tdate="+o+"&ttime="+s+"&tid="+t;
	repaechowin=window.open(url,"repaprintwin","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
}
</script>

</head>
<body <?php 	if($rows && !$nofocus) echo " bgcolor=#ffffee  onLoad=goactive() "; ?>>
<?php
//echo "$rows <br>";
if($rows)
{
	if($showlist)
	{
	echo '<center>
			<font face=Verdana,Arial size=2>
			<p>';
			if ($rows>1) echo $LDNewReportMany; else echo $LDNewReport;
			echo '<br>'.$LDClk2Read.'<br></font><p>';

		$tog=1;
		echo '
				<table border=0 cellspacing=0 cellpadding=0 bgcolor="#666666"><tr><td>
				<table border=0 cellspacing=1 cellpadding=3>
  				<tr bgcolor="#ffffff">';
		for ($i=0;$i<sizeof($reportindex);$i++)
		echo '
				<td><font face=Verdana,Arial size=2 color="#000080">'.$reportindex[$i].'</td>';
		echo '
				</tr>';	

		$i=$rows;

		while($content=$ergebnis->FetchRow())
 		{
			if($tog)
			{ echo '<tr bgcolor="#dddddd">'; $tog=0; }else{ echo '<tr bgcolor="#efefff">'; $tog=1; }
			echo'
				<td><font face=Verdana,Arial size=2>'.$i.'</td>
				<td><a href="javascript:show_order(\''.$content[dept].'\',\''.$content[tdate].'\',\''.$content[ttime].'\',\''.$content[tid].'\')">
						<img '.createComIcon($root_path,'uparrowgrnlrg.gif','0').' alt="'.$LDShowReport.'"></a></td>
				<td ><font face=Verdana,Arial size=2>'.strtoupper($content['dept']).'</td>
				<td><font face=Verdana,Arial size=2>';
				
			echo formatDate2Local($content['tdate'],$date_format);
			
			echo '</td>
				 <td><font face=Verdana,Arial size=2>'.convertTimeToLocal(str_replace('24','00',$content['ttime'])).'</td>
				<td align="center">';
				
			if($content['seen'])
				{
					 echo '<img '.createComIcon($root_path,'check2.gif','0').' alt="OK">';
				}

			echo '
					</td>
				</tr>';
			$i--;

 		}
		echo '
			</table>
			</td></tr></table>
			</center>';
	}
	else 
	{
 	echo '<center><img '.createMascot($root_path,'mascot2_r.gif','0','middle').'>
			<font face="Verdana, Arial" size=3 color=#ff0000>
			&nbsp;<b>'.$LDReportArrived.'</b><p>
			<form name=ack>
			<input type="hidden" name="showlist" value="1">
			<input type="hidden" name="sid" value="'.$sid.'">
			<input type="hidden" name="lang" value="'.$lang.'">
			<input type="submit" value="'.$LDShowRequest.'">
    		</form>
			</center>'; 
	}
	

}
else if($showlist) 
	{	
		$showlist=0;
		echo '
				<script language=javascript>
				self.resizeTo(300,150);
				</script>';
	}
	else
	{
	    echo '<img '.createComIcon($root_path,'butft2_d.gif').'>';
?>

<font face="Verdana, Arial" size=2 color=#800000>
<MARQUEE dir=ltr scrollAmount=3 scrollDelay=120 width=150
      height=10 align="middle"><b><?php echo $LDImRepabot ?>...</b></MARQUEE></font>
<p>

<?php

}
?>
</body>
</html>
