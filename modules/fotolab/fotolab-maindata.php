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
define('LANG_FILE','specials.php');
$local_user='ck_fotolab_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

/* Load date formatter */
require_once($root_path.'include/core/inc_date_format_functions.php');
				

if($mode=='search'){

$patnum=(int)$patnum;

include($root_path.'include/care_api_classes/class_encounter.php');
$enc_obj=new Encounter($patnum);
	
// get orig data
$p_obj=&$enc_obj->getBasic4Data($patnum);
if(is_object($p_obj)){
	$pdata=$p_obj->FetchRow();
}else{
	$pdata=array();
}
	
/*	  		$dbtable='care_admission_patient';
		 	$sql="SELECT encounter,name,vorname,gebdatum FROM $dbtable 
					WHERE patnum LIKE '".addslashes($patnum)."'";
			//echo $sql;
			if($ergebnis=$db->Execute($sql))
       		{
				$rows=0;
				if( $pdata=$ergebnis->FetchRow()) $rows++;
				if($rows==1)
				{
					//mysql_data_seek($ergebnis,0); //reset the variable
					$datafound=1;
					//$pdata=$ergebnis->FetchRow();
					//echo $sql."<br>";
					//echo $rows;
				}
				else $pdata=NULL;
				//else echo "<p>".$sql."<p>Multiple entries found pls notify the edv."; 
			}
				else { echo "$LDDbNoLink<br>$sql"; } */

}

?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>





<script language="javascript">
<!-- Script Begin
function setalldate(d)
{
	if(d) 
	{
		for(n=0;n<document.maindata.maxpic.value;n++) eval("window.parent.SELECTFRAME.srcform.sdate"+n+".value=d");
	}
}
function resetall()
{
	d=document.maindata;
	d.patnum.value="";
	d.lastname.value="";
	d.firstname.value="";
	d.bday.value="";
	d.shotdate.value="";
}
<?php require($root_path.'include/core/inc_checkdate_lang.php'); ?>
//  Script End -->
</script>
<?php 
require($root_path.'include/core/inc_js_gethelp.php');
require($root_path.'include/core/inc_css_a_hilitebu.php');
?>
</head>
<body topmargin=3 marginheight=3 onLoad="document.maindata.patnum.select()" onFocus="document.maindata.patnum.select()">
<form name="maindata">
<a href="javascript:gethelp('fotolab.php','maindata','')"><img <?php echo createComIcon($root_path,'frage.gif','0','right') ?>></a>
<table border=0>
  <tr>
    <td><font size=2 color="#cc0000" face="verdana,arial">
<?php echo $LDPatientNr ?>:</td>
    <td><input type="text" name="patnum" size=12 maxlength=18 value="<?php echo $patnum ?>"> <input type="submit" value="<?php echo $LDSearch ?>"></td>
  </tr>
  <tr>
    <td><font size=2 color="#cc0000" face="verdana,arial">
	<?php echo $LDName ?>:
<input type="hidden" name="lastname" value="<?php echo $pdata['name_last'] ?>"></td>
    <td><font color="#000000" size=2 face="verdana,arial"><?php echo $pdata['name_last'] ?></font></td>
  </tr>
  <tr>
    <td><font size=2 color="#cc0000" face="verdana,arial">
	<?php echo $LDFirstName ?>:
<input type="hidden" name="firstname" value="<?php echo $pdata['name_first'] ?>"></td>
    <td><font color="#000000" size=2 face="verdana,arial"><?php echo $pdata['name_first'] ?></font></td>
  </tr>
  <tr>
    <td><font size=2 color="#cc0000" face="verdana,arial">
	<?php echo $LDBday ?>:
<input type="hidden" name="bday" value="<?php echo$pdata['date_birth'] ?>"></td>
    <td><font color="#000000" size=2 face="verdana,arial"><?php if($pdata['date_birth']) echo formatDate2Local($pdata['date_birth'],$date_format) ?></font></td>
  </tr>
  <tr>
    <td><font size=2 color="#cc0000" face="verdana,arial">
	<?php echo $LDShotDate ?>:
</td>
<!--     <td><input type="text" name="shotdate" size=12 maxlength=12   onKeyUp="setDate(this);setalldate(window.document.maindata.shotdate.value);" onFocus=this.select()>
 -->   
    <td><input type="text" name="shotdate" size=12 maxlength=12   onBlur="IsValidDate(this,'<?php echo $date_format ?>')"  onKeyUp="setDate(this,'<?php echo $date_format ?>','<?php echo $lang ?>')">
	<a href="javascript:setalldate(window.document.maindata.shotdate.value)">
<img <?php echo createComIcon($root_path,'preset-add.gif','0') ?> alt="<?php echo $LDSetShotDate ?>"></a></td>
  </tr>
</table>
<input type="hidden" name="maxpic" value="<?php echo $maxpic ?>">
<input type="hidden" name="mode" value="search">
<input type="hidden" name="sid" value="<?php echo $sid ?>">
<input type="hidden" name="lang" value="<?php echo $lang ?>">
<!-- <input type="button" value="<?php echo $LDReset ?>" onClick="resetall()">
 --></form>

<br>
</body>
</html>
