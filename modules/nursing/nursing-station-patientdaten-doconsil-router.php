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
define('LANG_FILE','nursing.php');
$local_user='ck_pflege_user';
require_once($root_path.'include/core/inc_front_chain_lang.php');
if($edit&&!$_COOKIE[$local_user.$sid]) {header('Location:'.$root_path.'language/'.$lang.'/lang_'.$lang.'_invalid-access-warning.php'); exit;}; 
require_once($root_path.'include/core/inc_config_color.php'); // load color preferences
$target='';

# The mapping of department id´s with the forms´ id´s must be done here
# The department id is forwarded to this script in   the format  "nr~string" or e.g "12~pediatrics"

$nrbuf=explode('~',$dept_id);

switch($nrbuf[1])
{
	case 'pathology': $target='patho';
				break;
	case 'radiology': $target='radio';
				break;
	case 'chemical_lab': $target='chemlabor';
				break;
	case 'central_lab': $target='chemlabor';
				break;
	case 'serological_lab': $target='chemlabor';
				break;
	case 'bacteriological_lab': $target='baclabor';
				break;
	case 'blood_bank': $target='blood';
				break;
	default: 
				# By default, assume the generic form and use the prepended department number
				$target='generic';
				$dept_nr = $nrbuf[0];
}
/*
switch($dept_nr)
{
	case 8: $target='patho';
				break;
	case 19: $target='radio';
				break;
	case 22: $target='chemlabor';
				break;
	case 23: $target='chemlabor';
				break;
	case 24: $target='chemlabor';
				break;
	case 25: $target='baclabor';
				break;
	case 43: $target='blood';
				break;
	case 41: $target='blood';
				break;
	default: $target='generic';
}
*/

header('Location:'.$root_path.'modules/nursing/nursing-station-patientdaten-doconsil-'.$target.'.php'.URL_REDIRECT_APPEND."&edit=$edit&station=$station&pn=$pn&konsil=$type&dept_nr=$dept_nr&target=$target");
exit;
?>
