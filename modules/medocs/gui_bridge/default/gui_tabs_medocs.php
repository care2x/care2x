<?php
if(!isset($notabs)||!$notabs){
	
	if($target=="entry")  $img='document-blue.gif'; //echo '<img '.createLDImgSrc($root_path,'admit-blue.gif','0').' alt="'.$LDAdmit.'">';
		else{ $img='document-gray.gif';}

	$smarty->assign('pbNew','<a href="medocs_start.php'.URL_APPEND.'&target=entry"><img '.createLDImgSrc($root_path,$img,'0').' title="'.$LDAdmit.'" style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a>');

	if($target=="search") $img='such-b.gif';
		else{ $img='such-gray.gif'; }

	$smarty->assign('pbSearch','<a href="medocs_data_search.php'.URL_APPEND.'&target=search"><img '.createLDImgSrc($root_path,$img,'0').' title="'.$LDSearch.'"  style=filter:alpha(opacity=70) onMouseover=hilite(this,1) onMouseOut=hilite(this,0)></a>');

}

if(!empty($subtitle)) $smarty->assign('subtitle','<font color="#fefefe" SIZE=3  FACE="verdana,Arial"><b>:: '.$subtitle);
?>