<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System Deployment 2.2 - 2006-07-10
* GNU General Public License
* Copyright 2002,2003,2004,2005,2006 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables[]='prompt.php';
$lang_tables[]='departments.php';
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/inc_front_chain_lang.php');

require_once($root_path.'include/care_api_classes/class_department.php');
## Load all wards info 
$dept_obj=new Department;
$allmed=&$dept_obj->getAllMedical();
$dept_count=$dept_obj->LastRecordCount();

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('nursing');

# Title in toolbar
 $smarty->assign('sToolbarTitle', $LDTransferPatient);

  # hide back button
 $smarty->assign('pbBack',FALSE);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp('transfer_clinic_select.php')");

 # href for close button
 $smarty->assign('breakfile',"javascript:window.close();");

 # OnLoad Javascript code
 $smarty->assign('sOnLoadJs','onLoad="if (window.focus) window.focus();"');

 # Window bar title
 $smarty->assign('sWindowTitle',$LDTransferPatient);

 # Hide Copyright footer
 $smarty->assign('bHideCopyright',TRUE);

 # Collect extra javascript code

 ob_start();
?>

<script language="javascript">
<!-- 
var urlholder;

function TransferDept(dn){
<?php
echo '
urlholder="amb_clinic_transfer_save.php?mode=transferdept&sid='.$sid.'&lang='.$lang.'&pyear='.$pyear.'&pmonth='.$pmonth.'&pday='.$pday.'&pn='.$pn.'&station='.$station.'&dept_nr='.$dept_nr.'&tgt_nr="+dn;
';
?>
window.opener.location.replace(urlholder);
window.close();
}
// -->
</script>

<STYLE type=text/css>
div.box { border: double; border-width: thin; width: 100%; border-color: black; }
</style>

<?php

$sTemp = ob_get_contents();

ob_end_clean();

$smarty->append('JavaScript',$sTemp);

# Buffer page output

ob_start();

?>

<table border=0>
  <tr>
    <td><img <?php 	echo createMascot($root_path,'mascot2_r.gif','0'); ?>></td>
    <td><FONT class="warnprompt"><?php 	echo $LDWhereToTransfer; ?></td>
  </tr>
</table>

 <table border=0 cellpadding=2 cellspacing=1 width=100%>
  <tr bgcolor="#f6f6f6">
    <td colspan=2>&nbsp;<FONT class="prompt"><?php echo $LDTransferClinic; ?></td>
  </tr>

<?php

# Generate the rows of departments and transfer links

# Note: the $allmed is an array

while(list($x,$v)=each($allmed)){
	if($v['nr']==$dept_nr) continue;
	echo '<tr bgcolor="#f6f6f6"><td>&nbsp;';
	 if(isset($$v['LD_var'])&&!empty($$v['LD_var'])) echo $$v['LD_var'];
	 	else echo $v['name_formal'];
	echo'
	 </td>
	 <td><a href="javascript:TransferDept(\''.$v['nr'].'\')"><img '.createLDImgSrc($root_path,'transfer_sm.gif','0').' alt="'.$LDClkTransfer.'"></a></td>
	 </tr>';
}
?>
  
</table>
<?php

$sTemp = ob_get_contents();
ob_end_clean();

# Assign the page output to the mainframe center block

 $smarty->assign('sMainFrameBlockData',$sTemp);

 /**
 * show Template
 */
 $smarty->display('common/mainframe.tpl');

 ?>
