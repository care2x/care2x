<?php
#------begin------ This protection code was suggested by Luki R. luki@karet.org
if (eregi('inc_mozillapatch_redirect.php',$PHP_SELF)) 
	die('<meta http-equiv="refresh" content="0; url=../">');
#------end-----
?>
<html>
<head>
<?php echo setCharSet(); ?>
<title></title>
</head>
<body>

<table border=0>
  <tr>
    <td><img <?php echo createMascot($root_path,'mascot1_r.gif','0','bottom') ?> align="absmiddle"></td>

	<td colspan=4><center>
	<font face=arial color="#990000" size=4>
	<?php 
		echo "<a href=\"select_dept.php".URL_REDIRECT_APPEND."&cat=$cat&target=entry&retpath=$retpath\">$LDClickSelectDept</a>";
	?>
	</center>
</td>

  </tr>
</table>
</body>
</html>
