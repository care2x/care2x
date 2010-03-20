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
require_once($root_path.'include/care_api_classes/class_core.php');
$core = & new Core;

//$db->debug=1;

if(isset($tid)&&$tid&&isset($dept)&&$dept)
{

    $rows=0;
    $stat2seen=false;
    $mov2arc=false;
    $deltodo=false;

        /* Load the date formatter */
        include_once($root_path.'include/inc_date_format_functions.php');
        
	
        /* Load editor functions for time format converter */
        //include_once('../include/inc_editor_fx.php');

		 switch($mode)
		 {
			case 'ack_print':
				{
				$sql="UPDATE care_tech_repair_job SET seen=1, tid='$tid'
							WHERE dept='$dept'
								AND tdate='$tdate'
								AND ttime='$ttime'
								AND tid='$tid'";
								
					if($ergebnis=$core->Transact($sql)) {
						$stat2seen=true;
					} else {echo "<p>".$sql."$LDDbNoUpdate<br>"; };
					break;
				}
				
			case 'archive':
				{
				    $sql="UPDATE care_tech_repair_job SET archive=1, tid='$tid'
							WHERE dept='$dept'
								AND tdate='$tdate'
								AND ttime='$ttime'
								AND tid='$tid'";
								
					if($ergebnis=$core->Transact($sql)) {
						$deltodo=true;
					}
					else {echo "<p>".$sql."$LDDbNoUpdate<br>"; };
					 break;
					}// end of case "archive":
		 		}// end of switch(mode)
				
				$dbtable='care_tech_repair_job';

				$sql="SELECT * FROM $dbtable
										WHERE dept='$dept'
											AND tdate='$tdate'
											AND ttime='$ttime'
											AND tid='$tid'";

							
        		if($ergebnis=$db->Execute($sql)) {
					//count rows=linecount
					//reset result
					$rows=$ergebnis->RecordCount();
				}else {echo "<p>".$sql."$LDDbNoRead<br>"; };
			//echo $sql;
}
?>

<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<title><?php echo "$LDRepabotActivate $LDAck" ?></title>

<script language=javascript>
function ack_print()
{
	window.print()
	window.location.replace("./technik-repabot-print.php<?php echo URL_REDIRECT_APPEND."&mode=ack_print&dept=$dept&tdate=$tdate&ttime=$ttime&tid=$tid"; ?>")
}
function move2arch()
{
	if(document.opt.clerk.value=="")
	{
		alert('<?php echo $LDAlertEnterName ?>');
		return;
	}
	c=document.opt.clerk.value;
	window.location.replace("./technik-repabot-print.php<?php echo URL_REDIRECT_APPEND."&mode=archive&dept=$dept&tdate=$tdate&ttime=$ttime&tid=$tid"; ?>&clerk="+c)
}
function parentref(n)
{
   
     if(n==1) window.opener.location.replace("./technik-repabot.php<?php echo URL_REDIRECT_APPEND."&userck=$userck"?>&cat=<?php echo $cat ?>&nofocus="+n+"&showlist=1");
    else window.opener.location.replace("./technik-repabot.php<?php echo URL_REDIRECT_APPEND."&userck=$userck"?>&cat=<?php echo $cat ?>&showlist=1");
    //
	<?php
	if($statseen || $deltodo)
	{
	?>
	setTimeout("parentref('')",10000);
    <?php
	}
	?>
	return true;
}
</script>

</head>
<body bgcolor=#fefefe onLoad="if(window.focus) window.focus(); if(parentref('1')) 1;" 
>
<p>
<form name="opt">
<?php
//foreach($argv as $v) echo "$v ";

if($rows>0)
{
//++++++++++++++++++++++++ show the actual list +++++++++++++++++++++++++++
    $tog=1;
    $content=$ergebnis->FetchRow();

    echo '</font>
		<table cellpadding=0 cellspacing=0 border=0 bgcolor="#666666" width="100%">
		<tr><td>
		<table border=0 cellspacing=1 cellpadding=3 width="100%">
  		<tr bgcolor="#ffffff" background="../../gui/img/common/default/tableHeaderbg3.gif">';
		
	for ($i=0;$i<sizeof($requestindex);$i++)
	{
	    echo '
		<td><font face=Verdana,Arial size=2 color="#0000ff">'.$requestindex[$i].'</td>';
	}
	
	echo '</tr>
			<tr bgcolor="#f6f6f6">
				 <td><font face=Verdana,Arial size=2>'.$content['reporter'].'</td>
				<td ><font face=Verdana,Arial size=2>'.formatDate2Local($content['tdate'],$date_format).'</td>
				<td><font face=Verdana,Arial size=2>'.convertTimeToLocal($content['ttime']).'</td>
				<td><font face=Verdana,Arial size=2>'.strtoupper($content['dept']).'</td>
				<td><font face=Verdana,Arial size=2>'.$content['tphone'].'</td>
				<td><font face=Verdana,Arial size=2>'.$content['tid'].'</td>
				</tr>
			<tr bgcolor="#ffffff">
				 <td colspan=6><p><br><font face=Verdana,Arial size=2><ul><i>" '.nl2br($content['job']).' "</i></ul></td>
				</tr></table></td></tr>

				</table><font face=Verdana,Arial size=2><p>';

    if(!$deltodo && !$content['seen'])
    {           echo '
									
									<input type="button" value="GO" onClick="ack_print()"> '.$LDAckecho.'<p>';

    }
    elseif(!$content['archive'])
    { 
            echo '<p>
									<input type="button" value="GO" onClick="window.print()"> <b>'.$LDPrintRequest.'</b><p>
									'.$LDAckBy.':<input type="text" name="clerk" size=25 maxlength=40><br>
									<input type="button" value="GO" onClick="move2arch()"> <b>'.$LDArchiveRequest.'</b>
                                    <p>';
	}
} // end of if(rows)
else
{
   echo'<img '.createMascot($root_path,'mascot1_r.gif','0','absmiddle').'>'.$LDNoDataFound;
}
?>
<p align=right><input type="button" value="<?php echo $LDClose ?>" onClick="if(parentref('')) window.close();"></p>
</form>
</font></body>
</html>
