<?php

error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
define('LANG_FILE','lab.php');
$local_user='ck_lab_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');

$thisfile=basename(__FILE__);

///$db->debug=true;

# Create lab object
require_once($root_path.'include/care_api_classes/class_lab.php');
$lab_obj=new Lab();

# Load the date formatter */
include_once($root_path.'include/core/inc_date_format_functions.php');

if(isset($mode) && !empty($mode)) {
	if($mode=='save'){
		# Save the nr	
		if(empty($_POST['status'])) $_POST['status']=' ';
		$_POST['modify_id']=$_SESSION['sess_user_name'];
		$_POST['id'] = "_" . str_replace(" ","_",strtolower($_POST['name'])) . '__' . strtolower($_POST['group_id']);
		$_POST['id'] = strtolower($_POST['id']);
		$_POST['history']=$lab_obj->ConcatHistory("Update ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n");
		# Set to use the test params
		$lab_obj->useTestParams();
		# Point to the data array
		$lab_obj->setDataArray($_POST);
		
		if($lab_obj->updateDataFromInternalArray($_POST['nr'])){
	?>
		
	<script language="JavaScript">
	<!-- Script Begin
	 window.opener.location.reload();
	 window.close();
	//  Script End -->
	</script>
	
	<?php   
			exit;
		}
		else echo $lab_obj->getLastQuery();
	# end of if(mode==save)
	}
	# begin mode new 	
	if($mode == 'savenew') {
		# Save the nr	
		
		if(empty($_POST['status'])) $_POST['status']=' ';
		//gjergji : used to generate user proof param id's :)
		$_POST['id'] = "_" . str_replace(" ","_",strtolower($_POST['name'])) . "__" . strtolower($_POST['group_id']);
		$_POST['modify_id']=$_SESSION['sess_user_name'];
		$_POST['history']=$lab_obj->ConcatHistory("Created ".date('Y-m-d H:i:s')." ".$_SESSION['sess_user_name']."\n");
		# Set to use the test params
		$lab_obj->useTestParams();
		# Point to the data array
		//print_r($_POST);
		$lab_obj->setDataArray($_POST);	
		if($lab_obj->insertDataFromInternalArray()){
			
	?>
		
	<script language="JavaScript">
	<!-- Script Begin
	window.opener.location.reload();
	window.close();
	//  Script End -->
	</script>
	
	<?php    
			exit;
		}
		else echo $lab_obj->getLastQuery();
	# end of if(mode==new)		
	}
}
//$pnames=array($LDParameter,$LDMsrUnit,$LDMedian,$LDUpperBound,$LDLowerBound,$LDUpperCritical,$LDLowerCritical,$LDUpperToxic,$LDLowerToxic,$LDID,$LDShow);
//$pitems=array('name','msr_unit','median','hi_bound','lo_bound','hi_critical','lo_critical','hi_toxic','lo_toxic','id','status');

# Get the test parameter values
if($tparam=&$lab_obj->getTestParam($nr)){
	$tp=$tparam->FetchRow();
	$parameters=$paralistarray[$tp['group_id']];
}else{
	$tp=false;
}
	
//gjergji : i get the groups here...
$tgroups=&$lab_obj->TestActiveGroups();	
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE>Konfigurimi i Parametrave</TITLE>

<script language="javascript" name="j1">
<!--        
function editParam(nr)
{
	urlholder="labor_test_param_edit?sid=<?php echo "$sid&lang=$lang" ?>&nr="+nr;
	editparam_<?php echo $sid ?>=window.open(urlholder,"editparam_<?php echo $sid ?>","width=500,height=600,menubar=no,resizable=yes,scrollbars=yes");
}
// -->
</script>

<?php 
require($root_path.'include/core/inc_js_gethelp.php'); 
require($root_path.'include/core/inc_css_a_hilitebu.php');
?>
<style type="text/css" name="1">
.va12_n{font-family:verdana,arial; font-size:12; color:#000099}
.a10_b{font-family:arial; font-size:10; color:#000000}
.a12_b{font-family:arial; font-size:12; color:#000000}
.a10_n{font-family:arial; font-size:10; color:#000099}
</style>
<script src="../../js/SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../../js/SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
</HEAD>

<BODY topmargin=0 leftmargin=0 marginwidth=0 marginheight=0 
<?php

/*if($newid) echo ' onLoad="document.datain.test_date.focus();" ';*/
 if (!$cfg['dhtml']){ echo 'link='.$cfg['body_txtcolor'].' alink='.$cfg['body_alink'].' vlink='.$cfg['body_txtcolor']; } 
 ?>>

<table width=100% border=0 cellspacing=0 cellpadding=0>

<tr>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" >
<FONT  COLOR="<?php echo $cfg['top_txtcolor']; ?>"  SIZE=+2  FACE="Arial"><STRONG> &nbsp;
<?php 	
	if(isset($parameters[$tp['id']])&&!empty($parameters[$tp['id']])) echo $parameters[$tp['id']];
		else echo $tp['name'];
 ?>
 </STRONG></FONT>
</td>
<td bgcolor="<?php echo $cfg['top_bgcolor']; ?>" height="10" align=right ><nobr><a href="javascript:gethelp('lab_param_edit.php')"><img <?php echo createLDImgSrc($root_path,'hilfe-r.gif','0') ?>  <?php if($cfg['dhtml'])echo'class="fadeOut" >';?></a><a href="javascript:window.close()" ><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  <?php if($cfg['dhtml'])echo'class="fadeOut" >';?></a></nobr></td>
</tr>
<tr align="center">
<td  bgcolor=#dde1ec colspan=2>

<FONT    SIZE=-1  FACE="Arial">


<table border=0 bgcolor=#ffdddd cellspacing=1 cellpadding=1 width="100%">
<tr>
<td  bgcolor=#ff0000 colspan=2><FONT SIZE=2  FACE="Verdana,Arial" color="#ffffff">
<b>
<?php 

	if(isset($tp['group_id']) && !empty($tp['group_id'])) {
		$paramName = &$lab_obj->getGroupName( $tp['group_id']);
		$paramName = &$paramName->FetchRow();
		echo $paramName['name']; 
	}
?>
</b>
</td>
</tr>
<tr>
<td  colspan=2>

<form action="<?php echo $thisfile; ?>" method="post" name="paramedit">

<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0"><?php echo $LDParameter ?></li>
    <li class="TabbedPanelsTab" tabindex="0"><?php echo $LDMale ?></li>
    <li class="TabbedPanelsTab" tabindex="0"><?php echo $LDFemales ?></li>
    <li class="TabbedPanelsTab" tabindex="0"><?php echo $LD01Moth ?></li>
    <li class="TabbedPanelsTab" tabindex="0"><?php echo $LD112Month ?></li>
    <li class="TabbedPanelsTab" tabindex="0"><?php echo $LD114Years ?></li>
  </ul>
    <div class="TabbedPanelsContentGroup">
<?php 
$toggle=0;
	echo '<div class="TabbedPanelsContent"><table border="0" cellpadding=2 cellspacing=1>	
	<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDParameter.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="name" size=15 maxlength=15 value="'.$tp['name'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDMsrUnit.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="msr_unit" size=15 maxlength=15 value="'.$tp['msr_unit'].'">&nbsp;
			</td></tr>
			';
/*	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDID.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="id" size=15 maxlength=50 value="'.$tp['id'].'">&nbsp;
			</td></tr>
			';	*/
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDMethod.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="method" size=15 maxlength=50 value="'.$tp['method'].'">&nbsp;
			</td></tr>
			';	
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDShowParam.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b">
			<select name="status">
			  <option value="">'.$LDShow.'</option>
			  <option value="hidden"'; 
				 if ($tp['status']=='hidden') echo "selected";
				 echo '>'.$LDHide.'</option>
			  <option value="deleted"';
				 if ($tp['status']=='deleted') echo "selected";
				 echo '>'.$LDDelete.'</option>';
			echo '</select>
			</td></tr>';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDGroup.'</td><td>';	
	echo '<select name="group_id" size=1>';

	while($tg=$tgroups->FetchRow()){
		$sTemp = $sTemp.'<option value="'.$tg['id'].'"';
		if($tp['group_id']==$tg['id']) $sTemp = $sTemp.' selected';
		$sTemp = $sTemp.'>';
		if(isset($parametergruppe[$tg['id']])&&!empty($parametergruppe[$tg['group_id']])) $sTemp = $sTemp.$parametergruppe[$tg['id']];
			else $sTemp = $sTemp.$tg['name'];
		$sTemp = $sTemp.'</option>';
		$sTemp = $sTemp."\n";
	}
	$sTemp = $sTemp.'</select>';
	echo $sTemp;
	echo '</td></tr></table></div>
			';
	//males				 	
	echo '<div class="TabbedPanelsContent"><table border="0" cellpadding=2 cellspacing=1>	
	<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDMedian.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="median" size=15 maxlength=15 value="'.$tp['median'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDUpperBound.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="hi_bound" size=15 maxlength=15 value="'.$tp['hi_bound'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDLowerBound.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="lo_bound" size=15 maxlength=15 value="'.$tp['lo_bound'].'">&nbsp;
			</td></tr>';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDUpperCritical.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="hi_critical" size=15 maxlength=15 value="'.$tp['hi_critical'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDLowerCritical.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="lo_critical" size=15 maxlength=15 value="'.$tp['lo_critical'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDUpperToxic.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="hi_toxic" size=15 maxlength=15 value="'.$tp['hi_toxic'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDLowerToxic.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="lo_toxic" size=15 maxlength=15 value="'.$tp['lo_toxic'].'">&nbsp;
			</td></tr></table></div>
			'; 
	//females				 	
	echo '<div class="TabbedPanelsContent"><table border="0" cellpadding=2 cellspacing=1>	
	<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDMedian.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="median_f" size=15 maxlength=15 value="'.$tp['median_f'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDUpperBound.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="hi_bound_f" size=15 maxlength=15 value="'.$tp['hi_bound_f'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDLowerBound.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="lo_bound_f" size=15 maxlength=15 value="'.$tp['lo_bound_f'].'">&nbsp;
			</td></tr>';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDUpperCritical.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="hi_critical_f" size=15 maxlength=15 value="'.$tp['hi_critical_f'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDLowerCritical.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="lo_critical_f" size=15 maxlength=15 value="'.$tp['lo_critical_f'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDUpperToxic.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="hi_toxic_f" size=15 maxlength=15 value="'.$tp['hi_toxic_f'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDLowerToxic.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="lo_toxic_f" size=15 maxlength=15 value="'.$tp['lo_toxic_f'].'">&nbsp;
			</td></tr></table></div>
			';	
	//from 0 - 1 moth				 	
	echo '<div class="TabbedPanelsContent"><table border="0" cellpadding=2 cellspacing=1>	
	<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDMedian.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="median_n" size=15 maxlength=15 value="'.$tp['median_n'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDUpperBound.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="hi_bound_n" size=15 maxlength=15 value="'.$tp['hi_bound_n'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDLowerBound.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="lo_bound_n" size=15 maxlength=15 value="'.$tp['lo_bound_n'].'">&nbsp;
			</td></tr>';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDUpperCritical.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="hi_critical_n" size=15 maxlength=15 value="'.$tp['hi_critical_n'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDLowerCritical.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="lo_critical_n" size=15 maxlength=15 value="'.$tp['lo_critical_n'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDUpperToxic.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="hi_toxic_n" size=15 maxlength=15 value="'.$tp['hi_toxic_n'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDLowerToxic.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="lo_toxic_n" size=15 maxlength=15 value="'.$tp['lo_toxic_n'].'">&nbsp;
			</td></tr></table></div>
			'; 	
	//from 1 - 12 month				 	
	echo '<div class="TabbedPanelsContent"><table border="0" cellpadding=2 cellspacing=1>	
	<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDMedian.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="median_y" size=15 maxlength=15 value="'.$tp['median_y'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDUpperBound.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="hi_bound_y" size=15 maxlength=15 value="'.$tp['hi_bound_y'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDLowerBound.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="lo_bound_y" size=15 maxlength=15 value="'.$tp['lo_bound_y'].'">&nbsp;
			</td></tr>';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDUpperCritical.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="hi_critical_y" size=15 maxlength=15 value="'.$tp['hi_critical_y'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDLowerCritical.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="lo_critical_y" size=15 maxlength=15 value="'.$tp['lo_critical_n'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDUpperToxic.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="hi_toxic_y" size=15 maxlength=15 value="'.$tp['hi_toxic_y'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDLowerToxic.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="lo_toxic_y" size=15 maxlength=15 value="'.$tp['lo_toxic_y'].'">&nbsp;
			</td></tr></table></div>
			';  	
	//from 1 - 14 years				 	
	echo '<div class="TabbedPanelsContent"><table border="0" cellpadding=2 cellspacing=1>	
	<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDMedian.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="median_c" size=15 maxlength=15 value="'.$tp['median_c'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDUpperBound.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="hi_bound_c" size=15 maxlength=15 value="'.$tp['hi_bound_c'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDLowerBound.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="lo_bound_c" size=15 maxlength=15 value="'.$tp['lo_bound_c'].'">&nbsp;
			</td></tr>';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDUpperCritical.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="hi_critical_c" size=15 maxlength=15 value="'.$tp['hi_critical_c'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDLowerCritical.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="lo_critical_c" size=15 maxlength=15 value="'.$tp['lo_critical_c'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDUpperToxic.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="hi_toxic_c" size=15 maxlength=15 value="'.$tp['hi_toxic_c'].'">&nbsp;
			</td></tr>
			';
	echo '<tr><td  class="a12_b" bgcolor="#fefefe">&nbsp;'.$LDLowerToxic.'</td>
			<td bgcolor="'.$bgc.'"  class="a12_b"><input type="text" name="lo_toxic_c" size=15 maxlength=15 value="'.$tp['lo_toxic_c'].'">&nbsp;
			</td></tr></table></div>
			';  
?>
</div>

<script type="text/javascript">
<?php
echo 'var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");'
?>
</script>

<input type=hidden name="nr" value="<?php echo $nr; ?>">
<input type=hidden name="sid" value="<?php echo $sid; ?>">
<input type=hidden name="lang" value="<?php echo $lang; ?>">
<?php if($mode=='new') { ?>
<input type=hidden name="mode" value="savenew">
<?php } else { ?>
<input type=hidden name="mode" value="save">
<?php } ?>
<input  type="image" <?php echo createLDImgSrc($root_path,'savedisc.gif','0') ?>> 

</td>
</tr>

</table>

</form>

</FONT>
<p>
</td>

</tr>
</table>        

</BODY>
</HTML>
