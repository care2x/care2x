<!-- Creates the tabs for the patient registration module  -->
<?php
if(!isset($notabs)||!$notabs){
?>
<!-- Tabs  -->
<tr>
<td colspan=3>
<?php 
	if($target=="search") $img='such-b.gif'; //echo '<img '.createLDImgSrc($root_path,'such-b.gif','0').' alt="'.$LDSearch.'">';
		else{ $img='such-gray.gif'; }
	echo '<a href="upload_person_search.php'.URL_APPEND.'&target=search"><img '.createLDImgSrc($root_path,$img,'0').' alt="'.$LDSearch.'" ';if($cfg['dhtml'])echo'class="fadeOut" '; echo '></a>';
?>
</td>
</tr>
<?php
}
?>
<!--  Horizontal blue line below the tabs -->
<tr>
<td class="wardlisttitlerow"><img src="p.gif" border=0 width=1 height=5></td>
</tr>

