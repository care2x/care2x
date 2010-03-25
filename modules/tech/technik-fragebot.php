<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'/include/core/inc_environment_global.php');
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
require_once($root_path.'include/core/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);
if(!isset($mode)) $mode='';
$dbtable='care_tech_questions';

//$db->debug=1;

$rows=0;

    /* Load the date formatter */
    include_once($root_path.'include/core/inc_date_format_functions.php');
    include_once($root_path.'include/care_api_classes/class_core.php');
	$core = & new Core;

switch($mode)
	{
        case 'answer':
				{
				$sql="UPDATE $dbtable SET  reply='".htmlspecialchars($reply)."', answered=1, ansby='".htmlspecialchars($von)."',
								astamp='".date('Y-m-d H:i:s')."'
							WHERE dept='$dept'
								AND inquirer='$inquirer'
								AND tdate='$tdate'
								AND ttime='$ttime'
								AND tid='$tid'";

					if($core->Transact($sql))
					{
							$sql="SELECT * FROM $dbtable
							WHERE dept='$dept'
								AND inquirer='$inquirer'
								AND tdate='$tdate'
								AND ttime='$ttime'
								AND tid='$tid'";
								
							if($ergebnis=$db->Execute($sql)) 
							{
								$saved=true; 
								$inhalt=$ergebnis->FetchRow();
							}
							else {echo "<p>".$sql."$LDDbNoRead<br>"; };
					}
					else {echo "<p>".$sql."$LDDbNoUpdate<br>"; };
					break;
				}
			case 'read':
				{
					$sql="SELECT * FROM $dbtable
							WHERE dept='$dept'
								AND inquirer='$inquirer'
								AND tdate='$tdate'
								AND ttime='$ttime'
								AND tid='$tid'";
								
					if($ergebnis=$db->Execute($sql)) 
					{
						$saved=true;
								$inhalt=$ergebnis->FetchRow();
					}
					else {echo "<p>".$sql."$LDDbNoRead<br>"; };
					break;
				}
			case 'archive':
				{
				    $sql="UPDATE $dbtable SET archive=1
							WHERE dept='$dept'
								AND inquirer='$inquirer'
								AND tdate='$tdate'
								AND ttime='$ttime'
								AND tid='$tid'";
					if(!$core->Transact($sql)) {echo "<p>".$sql."$LDDbNoUpdate<br>"; };
					 break;
				}// end of case "archive":

		 	}// end of switch(mode)

				$sql="SELECT * FROM $dbtable WHERE archive<>1 ORDER BY tid DESC";
        		if($ergebnis=$db->Execute($sql))
				{
					$rows=$ergebnis->RecordCount();
				}else {echo "<p>".$sql."$LDDbNoRead<br>"; };
			//echo $sql;
?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<?php if(!isset($mode)||empty($mode)) echo '<meta http-equiv="refresh" content="30, url: technik-fragebot.php">'; ?>
<title><?php echo $LDQBotActivate ?></title>
<script language=javascript>

function chkForm(d)
{
   if(d.reply.value=='' || d.reply.value==' ')
   {
       return false;
   }
   else if(d.von.value=='' || d.von.value==' ')
   {
      alert('<?php echo $LDAlertName ?>');
	  d.von.focus(); 
	  return false;
    }
	else
	{
	   return true;
	}
}

function goactive()
	{
<?php
if (!$nofocus) echo '	
 	self.focus();
 	';
	if($nofocus) $nofocus=0; // toggle it to reset 	
?>
	self.resizeTo(800,600);
	}
	
function show_order(d,o,s,t)
{
	url="technik-fragebot-print.php?sid=<?php echo"$sid&lang=$lang"; ?>&dept="+d+"&tdate="+o+"&ttime="+s+"&tid="+t;
	frageechowin=window.open(url,"frageprintwin","width=800,height=600,menubar=no,resizable=yes,scrollbars=yes");
}
</script>
<style type="text/css" name="s2">
td.vn { font-family:verdana,arial; color:#000088; font-size:12;background-color:#dedede}
</style>

</head>
<body <?php 	if($rows) echo " bgcolor=#ffffee  onLoad=goactive() "; else echo " bgcolor=#ffffff"; ?>>
<?php if(($mode!="")&&($saved))
	{	
		echo '<table cellspacing=0 cellpadding=1 border=0 bgcolor="#999999" align=center>
				<tr>
				<td>
				<table  cellspacing=0 cellpadding=2 >
				<tr><td bgcolor="#999999" >	<FONT  SIZE=2 FACE="verdana,Arial" color=white>';
		echo "<b>$LDInquiry $LDFrom ".$inhalt['inquirer']." ".$LDOn." ".formatDate2Local($inhalt['tdate'],$date_format)." ".$LDAt." ".convertTimeToLocal($inhalt['ttime'])." ".$LDOClock." ".$LDTelephoneNr.": ".$inhalt['tphone']."</b>";
		echo '	</td>
				</tr>
				<tr><td class="vn">';
		echo "	\" ".nl2br($inhalt['query'])." \"</td></tr> ";
		
			echo '	<tr><td bgcolor=#999999 >	<FONT  SIZE=2 FACE="verdana,Arial" color=white>';

		if($inhalt['answered'])	echo "	<b>$LDReply $LDFrom ".$inhalt['ansby']." ".$LDOn." ".formatDate2Local($inhalt['astamp'],$date_format)." ".convertTimeToLocal(formatDate2Local($inhalt['astamp'],$date_format,0,1)).":</b>";
		 	else echo "	<b>$LDYourReply :</b>";
			echo '	</td>
					</tr>
					<tr><td class="vn">';
		if(isset($mode)&&($mode=='read'))
		{
			echo '	<form action="'.$thisfile.'" method="post" name="repform" onSubmit="return chkForm(this)">
						<textarea name="reply" cols=70 rows=10 wrap="physical">'.$inhalt['reply'].'</textarea><br>
						'.$LDAlertName.'<br>
						<input type="text" name="von" size=25 maxlength=40 value="'.$inhalt['ansby'].'"><br>
      					<input type="submit" value="'.$LDSendReply.'">
						<input type="hidden" name="sid" value="'.$sid.'">
						<input type="hidden" name="lang" value="'.$lang.'">
						<input type="hidden" name="mode" value="answer">
						<input type="hidden" name="showlist" value="1">
						<input type="hidden" name="dept" value="'.$inhalt['dept'].'">
 						<input type="hidden" name="inquirer" value="'.$inhalt['inquirer'].'">
						<input type="hidden" name="tdate" value="'.$inhalt['tdate'].'">
						<input type="hidden" name="ttime" value="'.$inhalt['ttime'].'">
						<input type="hidden" name="tid" value="'.$inhalt['tid'].'">
      					</form>';
		}
		else echo '<i>"'.nl2br($inhalt['reply']).'"</i><br>
			<form action="'.$thisfile.'" method="get" name="closer">
			<input type="submit" value="'.$LDClose.'">
			<input type="hidden" name="dept" value="'.$inhalt['dept'].'">
			<input type="hidden" name="sid" value="'.$sid.'">
			<input type="hidden" name="lang" value="'.$lang.'">
			<input type="hidden" name="showlist" value="'.$showlist.'">
			</form>';
			echo '</td> 
				</tr>';

		echo '
				</table>

				</td>
				</tr>
				</table>';
		echo "<hr>";
	}


//echo "$rows <br>";
if($rows)
{
	if($showlist)
	{
	echo '<center><font face=Verdana,Arial size=2>';
			if ($rows>1) echo $LDNewInquiryMany; else echo $LDNewInquiry; 
			echo'.<br> '.$LDClk2Reply.'<br></font><p>';

		$tog=1;
		echo '
				<table border=0 cellspacing=0 cellpadding=0 bgcolor="#666666"><tr><td>
				<table border=0 cellspacing=1 cellpadding=3>
  				<tr bgcolor="#ffffff">';
		for ($i=0;$i<sizeof($queryindex);$i++)
		echo '
				<td><font face=Verdana,Arial size=2 color="#000080">'.$queryindex[$i].'</td>';
		echo '
				</tr>';	

		$i=$rows;

		while($content=$ergebnis->FetchRow())
 		{
			if($tog)
			{ echo '<tr bgcolor="#dddddd">'; $tog=0; }else{ echo '<tr bgcolor="#efefff">'; $tog=1; }
			echo'
				<td><font face=Verdana,Arial size=2>'.$i.'</td>
				<td><a href="technik-fragebot.php'.URL_REDIRECT_APPEND.'&dept='.$content['dept'].'&inquirer='.$content['inquirer'].'&tdate='.$content['tdate'].'&ttime='.$content['ttime'].'&tid='.$content['tid'].'&mode=read&showlist=1">
						<img '.createComIcon($root_path,'uparrowgrnlrg.gif','0').' alt="'.$LDShow.'"></a></td>
				<td ><font face=Verdana,Arial size=2>'.$content['inquirer'].' </td>
				<td ><font face=Verdana,Arial size=2>'.strtoupper($content['dept']).' </td>
				<td><font face=Verdana,Arial size=2>';


			echo formatDate2Local($content['tdate'],$date_format).'</td>
				 <td><font face=Verdana,Arial size=2>'.convertTimeToLocal(str_replace('24','00',$content['ttime'])).'</td>
				<td align="center">';

			if($content['answered'])
				{
					 echo '<a href="technik-fragebot.php'.URL_REDIRECT_APPEND.'&dept='.$content['dept'].'&inquirer='.$content['inquirer'].'&tdate='.$content['tdate'].'&ttime='.$content['ttime'].'&tid='.$content['tid'].'&mode=archive&showlist=1">
					 <img '.createComIcon($root_path,'bul_arrowgrnlrg.gif','0').' alt="'.$LDMove2Archive.'"></a>';
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
			&nbsp;<b>'.$LDInquiryArrived.'</b><p>
			<form name=ack>
			<input type="hidden" name="showlist" value="1">
			<input type="hidden" name="sid" value="'.$sid.'">
			<input type="hidden" name="lang" value="'.$lang.'">
			<input type="submit" value="'.$LDShowInquiry.'">
    		</form>
			</center>'; 
	}
	

}
else if($showlist) 
	{	
		$showlist=0;
		?>
				<script language="javascript">
				self.resizeTo(300,150);	
				</script>
				
		<?php
	}
	else
	{
	    echo '<img '.createComIcon($root_path,'butft2_d.gif').'>';
?>
<font face="Verdana, Arial" size=2 color=#800000>
<MARQUEE dir=ltr scrollAmount=3 scrollDelay=120 width=150
      height=10 align="middle"><b><?php echo $LDImQBot ?>...</b></MARQUEE></font>
<p>

<?php

}
?>
</body>
</html>
