<?php

if(!$death_date || $death_date == DBF_NODATE){

	$smarty->assign('sPromptLink','<div class="warnprompt"><a href="'.$thisfile.URL_APPEND.'&target='.$target.'&mode=new"><img '.createComIcon($root_path,'bul_arrowgrnlrg.gif','0','absmiddle',TRUE).'>&nbsp;'.$LDScheduleNewAppointment.'</font></a></div>');
}

?>
