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

if(!isset($_SESSION['sess_user_origin'])) $_SESSION['sess_user_origin'] = "";
if(!isset($_SESSION['sess_dept_nr'])) $_SESSION['sess_dept_nr'] = "";

/* Start creating this page */
$lang_tables=array('departments.php');
define('LANG_FILE','specials.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');

/* Resolve the department number
* If no dept nr available, redirect to dept selector page
*/
$_SESSION['sess_user_origin']='calendar_opt'; // set the origin
if(!isset($forceback)||empty($forceback)){
	if(!isset($dept_nr)||empty($dept_nr)){
		if(isset($_SESSION['sess_dept_nr']) && $_SESSION['sess_dept_nr']){
			$dept_nr=$_SESSION['sess_dept_nr'];
		}elseif(isset($cfg['thispc_dept_nr']) && $cfg['thispc_dept_nr']){
			$dept_nr=$cfg['thispc_dept_nr'];
		}else{
			header("Location:".$root_path."modules/nursing_or/nursing-or-select-dept.php".URL_REDIRECT_APPEND."&target=calendar_opt&retpath=$retpath&year=$year&month=$month&day=$day");
			exit;
		}
	}
}
require_once($root_path.'include/core/inc_date_format_functions.php');

$_SESSION['sess_path_referer']=$top_dir.basename(__FILE__);

if(!isset($_SESSION['sess_date_process'])) $_SESSION['sess_date_process'] = "";

/* Filter the date */
if(empty($month)||empty($day)||empty($year)){
	if(isset($_SESSION['sess_date_process'])&&!empty($_SESSION['sess_date_process'])){
		list($year,$month,$day)=explode('-',$_SESSION['sess_date_process']);
	}else{
		$no_date=true;
	}
}else{
	$no_date=false;
	if(($month<10)&&(strlen($month)<2)) $month="0".$month;
	if(($day<10)&&(strlen($day)<2)) $day="0".$day;

	$_SESSION['sess_date_process']=$year.'-'.$month.'-'.$day; // store the date used in the current process
}

$i_date=$year.'-'.$month.'-'.$day;

/* Check if the dept nr is available, if not, try using the config data */
if(!isset($dept_nr)||empty($dept_nr)){
	if(isset($cfg['thispc_dept_nr'])&&!empty($cfg['thispc_dept_nr'])){
		$dept_nr=$cfg['thispc_dept_nr'];
	}else{
		$dept_nr=0;
		$dept_name='';
	}
}

/* If dept number is available, get the formal dept name */
if($dept_nr){
	include_once($root_path.'include/care_api_classes/class_department.php');
	$dept_obj=new Department;
	/* Resolve the departments name, "language dependent" */
	$dept_ldvar=$dept_obj->LDvar($dept_nr);
	if(isset($$dept_ldvar)&&!empty($$dept_ldvar)) $dept_name=$$dept_ldvar;
		else $dept_name=$dept_obj->FormalName($dept_nr);
	
	$_SESSION['sess_dept_nr']=$dept_nr;
}


?>
<?php html_rtl($lang); ?>
<head>
<?php echo setCharSet(); ?>
<title><?php echo "$LDCalendar - $LDOptions" ?></title>

</head>
<body onLoad="window.resizeTo(500,400);<?php if(!$nofocus) echo 'if(window.focus) window.focus();'; ?>" vlink="#0000ff" alink="#0000ff" link="#0000ff" >
<font face="Verdana, Arial" size=2>

<?php 
if(isset($_COOKIE['ck_login_logged'.$sid])&&($_SESSION['sess_login_username'])) { 
?>
<!-- 
<b> <?php echo "$LDOptions $LDFor ".$_SESSION['sess_login_username']." ".$LDOn." ".formatDate2Local($i_date,$date_format) ?></b>
<ul>
<li><a href="#"><?php echo $LDShowMyCalendar ?></a></li>
<li><a href="#"><?php echo $LDShowMySched ?></a></li>
<li><a href="#"><?php echo $LDShowMyOvertime ?></a></li>
<li><a href="#"><?php echo $LDShowMyWorkTime ?></a></li>
	<?php
	 if($i_date>=date('Y-m-d'))
		{ echo '
				<li><a href="#">'.$LDPlanSched.'</a></li>
				<li><a href="#">'.$LDPlanDuty.'</a></li>';
		}
	?>
</ul>
<p>
 -->
<?php 
}elseif($forceback){
?>
<script language="javascript">
window.close();
</script>
<?php
}
 ?>

<?php if($dept_nr) { ?>
<p>
<b><?php echo "$LDOptions $LDFor ".$dept_name." (".formatDate2Local($i_date,$date_format).")"; ?></b>
<ul>
<!-- 
<li><a href="#"><?php echo $LDORProgram ?></a></li>
 -->
 <li><a href="<?php echo $root_path ?>modules/nursing_or/nursing-or-dienstplan-day.php<?php echo URL_APPEND."&dept_nr=$dept_nr&pday=$day&pmonth=$month&pyear=$year" ?>&retpath=calendar_opt"><?php echo "$LDDutyPerson $LDOn (".formatDate2Local($i_date,$date_format).")" ?></a></li>
<!--
 <li><a href="<?php echo $root_path ?>modules/nursing_or/nursing-or-dienstplan.php<?php echo URL_APPEND."&dept_nr=$dept_nr&cday=$day&cmonth=$month&cyear=$year&pmonth=".((int)$month)."&pyear=".((int)$year) ?>&noedit=1&retpath=calendar_opt" onClick="window.resizeTo(600,700)"><?php echo "$LDDutyPerson ($LDMonth)" ?></a></li>
<li><a href="<?php echo $root_path ?>modules/doctors/doctors-dienstplan.php<?php echo URL_APPEND."&dept_nr=$dept_nr&cday=$day&cmonth=$month&cyear=$year&pmonth=".((int)$month)."&pyear=".((int)$year) ?>&noedit=1&retpath=calendar_opt" onClick="window.resizeTo(600,700)"><?php echo "$LDDocsOnDuty (".formatDate2Local($i_date,$date_format).")" ?></a></li>
 -->
 <?php if($i_date==date('Y-m-d'))
		{ echo '
		<li><a href="'.$root_path.'modules/or_logbook/op-pflege-logbuch-pass.php'.URL_APPEND;
			echo "&target=entry&lang=$lang&pday=$day&pmonth=$month&pyear=$year&dept_nr=$dept_nr";
			echo '&retpath=calendar_opt">'.$LDORLogbook.'</a></li>
		';
		}
	?>
<li><a href="<?php echo $root_path ?>modules/or_logbook/op-pflege-logbuch-pass.php<?php echo URL_APPEND."&target=search&lang=$lang&pday=$day&pmonth=$month&pyear=$year&dept=$dept" ?>&retpath=calendar_opt"><?php echo $LDORLogbookSearch ?></a></li>
	<?php if($i_date<=date('Y-m-d'))
		{ echo '
			<li><a href="'.$root_path.'modules/or_logbook/op-pflege-logbuch-pass.php'.URL_APPEND;
			echo "&target=archiv&pday=$day&pmonth=$month&pyear=$year&dept_nr=$dept_nr";
			echo '&retpath=calendar_opt">'.$LDORLogbookArch.'</a></li>';
		}
	?>
</ul>

<img <?php echo createComIcon($root_path,'r_arrowgrnsm.gif','0','absmiddle'); ?>><a href="<?php echo $root_path."modules/nursing_or/nursing-or-select-dept.php".URL_REDIRECT_APPEND."&target=calendar_opt&retpath=$retpath&year=$year&month=$month&day=$day" ?>"><b> <?php echo $LDSelectDept ?></b></a>

<?php } ?>

</font>

<p><br>
<a href="javascript:window.close()"><img <?php echo createLDImgSrc($root_path,'close2.gif','0','absmiddle') ?> onClick="window.opener.focus()"></a>
</body>
</html>
