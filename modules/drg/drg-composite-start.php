<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
/*
CARE2X Integrated Information System Deployment 2.1 - 2004-10-02 for Hospitals and Health Care Organizations and Services
Copyright (C) 2002,2003,2004,2005  Elpidio Latorilla & Intellin.org	

GNU GPL. For details read file "copy_notice.txt".
*/
define('LANG_FILE','drg.php');

require_once('drg_inc_local_user.php');

require_once($root_path.'include/core/inc_front_chain_lang.php');
/* Load the date formatter */
require_once($root_path.'include/core/inc_date_format_functions.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
 <TITLE>
 <?php 
 	if(!empty($ln) && !empty($fn)) echo "$ln, $fn";
	if(!empty($bd)) echo formatDate2Local($bd,$date_format);
	echo " - $pn";
	if($opnr) echo" - OP# $opnr"; 
	$targetbuf="$sid&lang=$lang&pn=$pn&ln=$ln&fn=$fn&bd=$bd&opnr=$opnr&group_nr=$group_nr&dept_nr=$dept_nr&edit=$edit&is_discharged=$is_discharged&oprm=$oprm&y=$y&m=$m&d=$d&display=$display&newsave=$newsave";
?>	

</TITLE>
</HEAD>

<frameset rows="25%,*">
  <frame name="INTERN" src="drg-ops-intern.php?sid=<?php echo $targetbuf ?>" frameborder="yes">
  
 <frameset rows="52%,*">
  
    <frame name="ICD" src="drg-icd10.php?sid=<?php echo $targetbuf ?>" frameborder="yes">
	
    <frame name="OPS" src="drg-ops301.php?sid=<?php echo $targetbuf ?>" frameborder="yes">
	
  </frameset> 
  
<noframes>
<BODY BACKGROUND="#ffffff" onLoad="if (window.focus) window.focus();">

</body>
</noframes>
</frameset>


</HTML>
