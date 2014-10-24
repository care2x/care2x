<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.1 - 2004-10-02
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','editor.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');

$dbtable='care_cafe_prices';
$returnfile='cafenews.php'.URL_APPEND;

$sql="SELECT * FROM $dbtable WHERE productgroup<>''";

if(defined('LANG_DEPENDENT') && (LANG_DEPENDENT==1)){
	$sql.="' AND lang='".$lang."'";
}

$sql.=" ORDER BY productgroup";

if($ergebnis=$db->Execute($sql)){
	$rows=$ergebnis->RecordCount();
}

$sql="SELECT short_name, long_name FROM care_currency WHERE status='main'";

if($c_result=$db->Execute($sql)){
	if($c_result->RecordCount()){
		$currency=$c_result->FetchRow();
		$currency_short=$currency['short_name'];
		$currency_long=$currency['long_name'];
	} // else get default from ini file
} // else get default from ini file

?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<title></title>
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

<?php require($root_path.'include/core/inc_css_a_hilitebu.php'); ?>

</head>
<body>
<FONT  SIZE=8 COLOR="#cc6600">
<a href="javascript:editcafe()"><img <?php echo createComIcon($root_path,'basket.gif','0') ?>></a> <b><?php echo $LDCafePrices ?></b></FONT>
<hr>

<?php if($rows) : ?>
<table border=0 cellspacing=0>
  <tr bgcolor="ccffff" >
    <td><b><?php echo $LDProdName ?></b></td>
    <td align=right>&nbsp;
	</td>    
	 <td>&nbsp;<b><?php echo $LDPrice." ".$currency_short." ".$currency_long ?></b></td>
  </tr>
  <?php 

for($i=0;$i<$rows;$i++)
{
	$prod=$ergebnis->FetchRow();
	if($prodg!=$prod[productgroup])
	{
		$prodg=$prod[productgroup];
		echo '
 			<tr bgcolor="ccffff">
    		<td><FONT  color="#0000cc"><b>'.$prod['productgroup'].'</b>
        	</td>
  			</tr>';
	}
echo '
 <tr bgcolor="ccffff" >
    <td>&nbsp;&nbsp;&nbsp;'.$prod['article'].'
        </td>
    <td align=right>&nbsp;
	</td>
    <td>&nbsp;'.$prod['price'].'
 	</td>
  </tr>';
 }

?>
 </table>
<?php else : ?>
<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0') ?>></td>
    <td colspan=2><FONT  SIZE=4 COLOR="#000066"><?php echo $LDNoPrice ?></font><p>
			<?php echo $LDSorry ?>
	</td>
  </tr>
</table>
<?php endif; ?> 

 <p><br><a href="<?php echo $returnfile ?>"><img <?php echo createComIcon($root_path,'l-arrowgrnlrg.gif','0') ?> align=absmiddle> <?php echo $LDBack2CafeNews ?></a>
</body>
</html>
