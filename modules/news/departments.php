<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require_once('./roots.php');
require_once($root_path.'include/core/inc_environment_global.php');
/**
* CARE2X Integrated Hospital Information System beta 1.0.08 - 2003-10-05
* GNU General Public License
* Copyright 2002,2003,2004,2005 Elpidio Latorilla
* elpidio@care2x.org, 
*
* See the file "copy_notice.txt" for the licence notice
*/
$lang_tables=array('departments.php');

define('LANG_FILE','abteilung.php');
define('NO_2LEVEL_CHK',1);

require_once($root_path.'include/core/inc_front_chain_lang.php');

if(!isset($_SESSION['sess_path_referer'])) $_SESSION['sess_path_referer'] = "";

$_SESSION['sess_user_origin']='dept';

$default_url_news='modules/news/newscolumns.php';

$returnfile=$root_path.$_SESSION['sess_path_referer'].URL_APPEND;
$breakfile=$root_path.'main/startframe.php'.URL_APPEND;

$_SESSION['sess_path_referer']=$top_dir.basename(__FILE__);

//$db->debug=1;
/* dept type = 1 = medical */

$sql="SELECT dept.nr, dept.name_formal, dept.LD_var AS \"LD_var\",
	                    dept.work_hours, dept.consult_hours, 
						reg.news_start_script 
						FROM care_department as dept LEFT JOIN care_registry AS reg ON dept.id=reg.registry_id 
						WHERE dept.type=1 AND dept.is_inactive IN ('',0) ORDER BY sort_order";

//$sql='SELECT nr, name_formal, work_hours, consult_hours, url_news FROM care_department WHERE  is_inactive=0 ORDER BY sort_order';
	
if ($result = $db->Execute($sql)) {
	$rows = $result->RecordCount();
}

# Start Smarty templating here
 /**
 * LOAD Smarty
 */

 # Note: it is advisable to load this after the inc_front_chain_lang.php so
 # that the smarty script can use the user configured template theme

 require_once($root_path.'gui/smarty_template/smarty_care.class.php');
 $smarty = new smarty_care('common');

# Toolbar title

 $smarty->assign('sToolbarTitle',$LDPageTitle);

 # href for help button
 $smarty->assign('pbHelp',"javascript:gethelp()");
 # href for close file
 $smarty->assign('breakfile',$breakfile);
 # href for return file
 //$smarty->assign('pbBack',$returnfile);

 # Window title
 $smarty->assign('title',$LDPageTitle);

 # Buffer the page output

 ob_start();

?>

<ul>
	<table border=0 cellspacing=0 cellpadding=0>
		<tr>
			<td bgcolor=#000000>
				<table border=0 cellspacing=1 cellpadding=5>
					<tr bgcolor=#ffffff background="../../gui/img/common/default/tableHeaderbg.gif">
						<td><font face="Verdana,arial" size=2><b><?php echo $LDDeptTxt ?></b></font></td>
						<td>&nbsp;</td>
						<td><font face="Verdana,arial" size=2><b><?php echo $LDOpenHrsTxt ?></b></font></td>
						<td><font face="Verdana,arial" size=2><b><?php echo $LDChkHrsTxt ?></b></font></td>
					</tr>
<?php

$toggle=0;

if($rows) {

    while ($dept=$result->FetchRow()) {
	
	    if (empty($dept['news_start_script'])) $dept['news_start_script']=$default_url_news;
        echo '<tr bgcolor="#ffffff" ';
		
	    if($toggle) {
		    echo ' background="../../gui/img/common/default/tableHeaderbg3.gif"';
		}
		
		$toggle=!$toggle;
		
		echo '><td><font face=verdana,arial size=2><a href="'.$root_path.$dept['news_start_script'].URL_APPEND.'&dept_nr='.$dept['nr'].'"> ';
		
		$buf=$dept['LD_var'];
		if(isset($$buf)&&!empty($$buf)) echo $$buf;
		    else echo $dept['name_formal'];

		echo '</a></td>
		<td><font face=verdana,arial size=2><a href="'.$root_path.$dept['news_start_script'].URL_APPEND.'&dept_nr='.$dept['nr'].'"><img '.createComIcon($root_path,'top_help.gif','0').' alt="'.$LDClk4Info.' '.$dept['name_formal'].'."></a></td>		
		<td><font face=verdana,arial size=2><nobr> '.$dept['work_hours'].'</td>
		<td><font face=verdana,arial size=2><nobr> '.$dept['consult_hours'].'</td></tr>';
		echo "\r\n";
    }
}
?>
				</table>
			</td>
		</tr>
	</table>
<p>
<a href="<?php echo $breakfile ?>"><img <?php echo createLDImgSrc($root_path,'close2.gif','0') ?>  alt="<?php echo $LDClose ?>" align="absmiddle"></a>
<p>
</ul>

<?php

	$sTemp = ob_get_contents();

ob_end_clean();

$smarty->assign('sMainFrameBlockData',$sTemp);

$smarty->display('common/mainframe.tpl');

?>

