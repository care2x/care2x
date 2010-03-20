<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');

switch($winid)
{
	case "dayback": $title=$LDStartDate;
							$dayback=0;
							break;
	case "dayfwd": $title=$LDEndDate;
							$dayback=6;
							break;
}

$dy=date(d);
$mo=date(m);
$yr=date(Y);

?>

<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
<TITLE><?php echo $title ?></TITLE>

<script language="javascript">
<!-- 


 function parentrefresh(d)
{
	window.opener.location.replace("nursing-station-patientdaten-kurve.php?sid=<?php echo $sid ?>&lang=<?php echo $lang ?>&edit=<?php echo $edit ?>&station=<?php echo $station ?>&pn=<?php echo $pn."&tag=\"+d.day.value+\"&kmonat=\"+d.month.value+\"&jahr=\"+d.year.value+\"&tagname=$tagname&dayback=$dayback\")"; ?>;
	window.close();
	return false;
}

-->
</script>

<STYLE type=text/css>
div.box { border: double; border-width: thin; width: 100%; border-color: black; }
.va12_b { font-family:verdana,arial;font-size:12;color:#000000 }
</style>

</HEAD>
<BODY  bgcolor="#dfdfdf" TEXT="#000000" LINK="#0000FF" VLINK="#800080" 
onLoad="<?php if($saved) echo "parentrefresh();"; ?>if (window.focus) window.focus(); window.focus();" >

<font face=verdana,arial size=3 color=maroon>

<?php 
	echo "$LDShowCurveDate <br><b>$title</b>";	
?>

</font>
<p>


<font face=verdana,arial size=3 >
<form name="setdateform" action="<?php echo $thisfile ?>" method="post" onSubmit="return parentrefresh(this);">
<font face=verdana,arial size=2 >
<table border=0>
  <tr>
    <td class="va12_b"><?php echo $LDDay ?></td>
    <td class="va12_b"><?php echo $LDMonth ?></td>
    <td class="va12_b"><?php echo $LDYear ?></td>
  </tr>
  <tr>
    <td><select name="day">
	<?php for($i=1;$i<32;$i++)
		{
			echo '
        		<option value="'.$i.'" ';
		 	if($dy==$i) echo "selected"; 
		 	echo '> '.$i.'</option>';
		 }
	?>
        </select>
        </td>
    <td><select name="month">
 	<?php for($i=1;$i<13;$i++)
		{
			echo '
        		<option value="'.$i.'" ';
		 	if($mo==$i) echo "selected"; 
		 	echo '> '.$monat[$i-1].'</option>';
		 }
	?>

        </select>
        </td>
    <td><select name="year">
 	<?php for($i=1999;$i<2011;$i++)
		{
			echo '
        		<option value="'.$i.'" ';
		 	if($yr==$i) echo "selected"; 
		 	echo '> '.$i.'</option>';
		 }
	?>
        </select>&nbsp;
<input type="submit" value="<?php echo "$LDGo" ?>">
        </td>
  </tr>
</table>

</form>
<p>
<br>
&nbsp;<p>
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'cancel.gif','0') ?>" border="0" alt="<?php echo $LDClose ?>">
</a>


</BODY>

</HTML>
