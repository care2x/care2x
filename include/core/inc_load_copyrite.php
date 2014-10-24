<table width="100%" border="0" cellspacing="0" cellpadding="1" bgcolor="#cfcfcf">
<tr>
<td align="center">
  <table width="100%" bgcolor="ffffff" cellspacing=0 cellpadding=5 class="copyright">
   <tr>
	<td>
<?php
if(file_exists($root_path.'language/'.$lang.'/'.$lang.'_copyrite.php')) include($root_path.'language/'.$lang.'/'.$lang.'_copyrite.php');
  else include($root_path.'language/en/en_copyrite.php');
?>
<?php
if(defined('USE_PAGE_GEN_TIME')&&USE_PAGE_GEN_TIME){
	$pgt->ende();
	$pgt->ausgabe();
}
?>
     </td>
   <tr>
  </table>
</td>
</tr>
</table>
