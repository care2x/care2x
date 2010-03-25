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
$lang_tables=array('departments.php');
define('LANG_FILE','stdpass.php');
define('NO_2LEVEL_CHK',1);
require_once($root_path.'include/core/inc_front_chain_lang.php');

/*if ($pdaten=="ja") setcookie(pdatencookie,"ja");*/

require_once($root_path.'global_conf/areas_allow.php');

/* Set the allowed area basing on the target */
if($target=='admin') $allowedarea=&$allow_area['test_receive'];
 else $allowedarea=&$allow_area['test_order'];

if(!isset($target)||!$target) $target='chemlabor';

# Set the origin
if(!isset($user_origin)||empty($user_origin)) $user_origin='lab';

/* Set the default file forward */
$fileforward=$root_path."modules/nursing/nursing-station-patientdaten-doconsil-".$target.".php".URL_REDIRECT_APPEND."&noresize=1&user_origin=".$user_origin."&target=".$target;

$thisfile='labor_test_request_pass.php';

# Set the breakfile
switch($user_origin){
	case 'lab':$breakfile="labor.php".URL_APPEND; break;
	case 'amb': $breakfile=$root_path."modules/ambulatory/ambulatory.php".URL_APPEND; break;
}

$test_pass_logo='micros.gif';

$userck='ck_lab_user';


# If target is generic, Filter the cheblab, patho, bactlab,bloodbank and radiology tests
if($target=='generic'){
	switch($subtarget){
		case 8 : $target='admin'; $subtarget='patho';break; # 8 = pathology
		case 19: $target='admin'; $subtarget='radio'; break; # 19 = radiology
		case 22: $target='admin'; $subtarget='chemlabor'; break; # 22 = central lab
		case 23: $target='admin'; $subtarget='chemlabor'; break; # 23 = serological lab
		case 24: $target='admin'; $subtarget='chemlabor'; break; # 24 = chemical lab
		case 25: $target='admin'; $subtarget='baclabor'; break; # 25 = bacteriological lab
		case 41: $target='admin'; $subtarget='blood';  break; # 41 = blood bank
	}
}

//echo "$target $subtarget";

# Refilter
switch($target)
{

  case 'blood':  $title=$LDBloodOrder;
                      break;
					  
  case 'radio':  $title=$LDTestRequest." - ".$LDTestType[$target];
		              $breakfile=$root_path."modules/radiology/radiolog.php".URL_APPEND;
					   $test_pass_logo='thorax_sm.jpg';
                      break;
					  
  case 'admin':  $title=$LDPendingRequest." - ".$LDTestType[$subtarget];
                       if($subtarget=='radio'){  $breakfile=$root_path."modules/radiology/radiolog.php".URL_APPEND;
					       $test_pass_logo="thorax_sm.jpg";
					   }
                       $fileforward="labor_test_request_admin_".$subtarget.".php".URL_REDIRECT_APPEND."&target=".$target."&subtarget=".$subtarget."&noresize=1&&user_origin=".$user_origin;                      
					   break;
					   
  case 'generic': 
  						include_once($root_path.'include/care_api_classes/class_department.php');
						$dept_obj=new Department;
						if($dept_obj->preloadDept($subtarget)){
							$buffer=$dept_obj->LDvar();
							if(isset($$buffer)&&!empty($$buffer)) $title=$LDPendingRequest." - ".$$buffer;
								else $title=$LDPendingRequest." - ".$dept_obj->FormalName();
						}
                        $fileforward="labor_test_request_admin_generic.php".URL_REDIRECT_APPEND."&target=".$target."&subtarget=".$subtarget."&noresize=1&&user_origin=".$user_origin;     
						if($user_origin=='amb')
						{
						   $userck='ck_amb_user';
						   $breakfile=$root_path.'modules/ambulatory/ambulatory.php'.URL_APPEND;
						}
						else
						{                 
						   $userck='ck_lab_user';
					       $breakfile=$root_path."modules/doctors/doctors.php".URL_APPEND;
					     }
					    break;
						
        default : $title=$LDTestRequest." - ".$LDTestType[$target];
}
					  
$lognote="$title ok";

//reset cookie;
// reset all 2nd level lock cookies
setcookie($userck.$sid,'');
require($root_path.'include/core/inc_2level_reset.php'); setcookie('ck_2level_sid'.$sid,'');
require($root_path.'include/core/inc_passcheck_internchk.php');
if ($pass=='check') 	
	include($root_path.'include/core/inc_passcheck.php');

$errbuf=$title;
$minimal=1;
require_once($root_path.'include/core/inc_config_color.php');
require($root_path.'include/core/inc_passcheck_head.php');
?>

<BODY onLoad="if (window.focus) window.focus(); document.passwindow.userid.focus();">


<FONT    SIZE=-1  FACE="Arial">

<P>

<img <?php echo createComIcon($root_path,$test_pass_logo,'0','absmiddle') ?>><FONT  COLOR="<?php echo $cfg[top_txtcolor] ?>"  size=5 FACE="verdana"> <b><?php echo $title;  ?></b></font>
<p>
<table width=100% border=0 cellpadding="0" cellspacing="0"> 

<?php require($root_path.'include/core/inc_passcheck_mask.php') ?>  

<p>

<?php
require($root_path.'include/core/inc_load_copyrite.php');
?>
</FONT>

</BODY>
</HTML>
