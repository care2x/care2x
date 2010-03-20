<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','editor.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/inc_front_chain_lang.php');

$returnfile='cafenews.php'.URL_APPEND;

if(!$week) $week=1;
 $daytag=date("w");
 $day=date("j");
 $month=date("n");
 $year=date("Y");
 
if(!$mday) 
{
	$mday=$day;
	$mmonth=$month;
	$myear=$year;
} 
//echo $daytag.$day.$month.$year."<p>";

 if(($daytag!=1)||($week!=1))
 {
	$JDday=GregorianToJD($month,$day,$year);
	if($daytag=="0") $JDday-=6;
	else $JDday=$JDday-($daytag-1);

	switch ($week)
	{
		case 2: $JDday+=7; break;
		case 3: $JDday+=14; break;
	}

	$datebuf=JDToGregorian($JDday);//echo $datebuf;
	$arraybuf=explode("/",$datebuf);
	$month=$arraybuf[0];
	$day=$arraybuf[1];
	$year=$arraybuf[2];
	$daytag=date("w",mktime(0,0,0,$month,$day,$year));
 }


$dbtable='care_cafe_menu';

include_once($root_path.'include/inc_date_format_functions.php');


$sql="SELECT menu FROM $dbtable WHERE cdate='".formatDate2STD($myear."-".$mmonth."-".$mday,"yyyy-mm-dd")."'";

if(defined('LANG_DEPENDENT') && (LANG_DEPENDENT==1))
{
	$sql.="' AND lang='".$lang."'";
}

//echo $sql;
if($ergebnis=$db->Execute($sql))
{
	$content=$ergebnis->FetchRow();
}
else echo '<p>'.$sql.'<p>$LDDbNoRead';

if(!$content['menu']) $content['menu']=$LDNoMenu;


function aligndate(&$ad,&$am,&$ay)
{
	if(!checkdate($am,$ad,$ay))
	{
		if($am==12)
		{
			$am=1;
			$ad=1;
			$ay++;
		}
		else
		{
			$am=$am+1;
    		$ad=1;
		}
	}
}
?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<title></title>

<style type="text/css" name="s2">
.v18{ font-family:verdana,arial; color:#d6d6d6; font-size:16}
.v18_b{ font-family:verdana,arial; color:#000066; font-size:16}
</style>

<script language="javascript" >
function editcafe()
{

		if(confirm("<?php echo $LDConfirmEdit ?>"))
		{
			window.location.href="cafenews-edit-pass.php?sid=<?php echo "$sid&lang=$lang&title=$LDCafeNews" ?>";
			return false;
		}

}
</script>

<?php require($root_path.'include/inc_css_a_hilitebu.php'); ?>

</head>
<body>
<FONT  SIZE=8 COLOR="#cc6600">
<a href="javascript:editcafe()"><img <?php echo createComIcon($root_path,'basket.gif','0') ?>></a> <b><?php echo $LDCafeMenu ?></b></FONT>
<form action="cafenews-menu.php" method="post">

<table border=0 bgcolor="#000000" cellspacing=0 cellpadding=0>
  <tr>
    <td>

<table border=0 cellspacing=1 cellpadding=3>
  <tr>
    <td colspan=7 bgcolor="#ccffff">
	<FONT  SIZE=3 COLOR="#0000cc"><?php echo $LDThisWeek ?>
</font>
</td>
    <td colspan=7 bgcolor="#ccffff">
	<FONT  SIZE=3 COLOR="#0000cc"><?php echo $LDNextWeek ?>
</font>
</td>  
     <td colspan=7 bgcolor="#ccffff">
	<FONT  SIZE=3 COLOR="#0000cc"><?php echo $LD3rdWeek ?>
</font>
</td> 
</tr>
<tr bgcolor="#ccffff">
  
<?php for ($i=0,$acttag=$day,$dyidx=$daytag-1;$i<21;$i++,$acttag++,$dyidx++)
	{
	$spot=0; if($dyidx==7) $dyidx=0;
	aligndate($acttag,$month,$year);
	if ($mday.$mmonth.$myear==$acttag.$month.$year) 	$spot=1;
	echo ' 
    <td class="v18_b" ';
	if ($spot)  echo ' bgcolor="yellow">';
		else echo ' bgcolor="#ccffff">';
	echo '<a href="';
	if($spot) echo '#"'; else echo 'cafenews-menu.php'.URL_APPEND.'&week='.$week.'&myear='.$year.'&mmonth='.$month.'&mday='.$acttag.'" ';
	echo ' title="'.formatDate2Local($year.'-'.$month.'-'.$acttag,$date_format).'">';
	if($spot) echo '<font color="#0000cc">';else echo '<font color="#d6d6d6">';
	echo '<b>'.$dayname[$dyidx].'</b>';
	if ($spot) echo '</a>';
	echo '</td>
	';
	}
?>

  </tr>
</table>
</td>
  </tr>
</table>



<p>
<table border=0 cellspacing=0 cellpadding=10>
  <tr bgcolor="#ccffff" >
    <td colspan=3><b><?php echo $LDMenu ?></b><p>
<?php echo nl2br($content[menu]) ?>	
 </td>
  </tr>

 <tr>    
 <td colspan=3><p><br>
<a href="<?php echo $returnfile ?>"><img <?php echo createComIcon($root_path,'l-arrowgrnlrg.gif','0') ?>> <?php echo $LDBack2CafeNews ?></a></td>
  </tr>
 </table>
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang?>">
<input type="hidden" name="week" value="<?php echo $week?>">
<input type="hidden" name="myear" value="<?php echo $myear?>">
<input type="hidden" name="mmonth" value="<?php echo $mmonth?>">
<input type="hidden" name="mday" value="<?php echo $mday?>">
</form></body>
</html>
