<?php
//reset cookie;
setcookie(currentuser,"");
?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<?php echo setCharSet(); ?>
 <TITLE>OP Pflege</TITLE>

<style type="text/css">
	A:link  {text-decoration: none; }
	A:hover {text-decoration: underline; color: red; }

	A:visited {text-decoration: none;}
</style>

<script language="JavaScript">
<!-- 
	function bdienstwin(){
 	meinfens=window.open("spediens-bdienst-zeit-erfassung.php","meinfens","width=800,height=600,locationbar=no,menubar=no,status=no,scrollbars=yes,resizable=yes,copyhistory=yes" );
}
-->
</script>

</HEAD>

<BODY  bgcolor="silver" topmargin=0 leftmargin=0 marginwidth=0 marginheight=0>


<table width=100% border=0 cellspacing=0 height=100%>
<tr valign="top">
<td bgcolor="navy" height="45">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp; OP Pflege</STRONG></FONT>
</td>
<td bgcolor="navy" height="10" align=right><a href="#" onClick=window.history.back()><img src="../img/zuruck.gif" border=0></a><a href="#"><img src="../img/hilfe.gif" border=0></a><a href="startframe.php"><img src="../img/fenszu.gif" border=0></a></td></tr>

<tr>
<td valign=top bgcolor=#cde1ec colspan=2><p><br>
<ul>
<FONT    SIZE=-1  FACE="Arial">
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="op-pflege-dienst-schnellsicht.php">Schnellübersicht über die gegenwärtige diensthabende OP Pfleger</a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="op-pflege-logbuch-pass.php">OP Logbuch</a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="#" ONCLICK="bdienstwin()">Bereitschaftsdienst - Zeiterfassung</a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="#">Dienstplan</a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="#">Nachrichten</a><br>
<img <?php echo createComIcon($root_path,'varrow.gif','0') ?>> <a href="#">Rundbrief</a><br>
<p>
<FORM action="startframe.php" >
<INPUT type="submit"  value="Schliessen"></font></FORM>
<p>
</ul>

</FONT>
<p>
</td>
</tr>
<tr>
<td bgcolor=silver valign="top" height="70" colspan="2">
<FONT    SIZE=1  FACE="Arial">
Copyright © 2000 by Elpidio Latorilla<p>
All programs and scripts are not to be copied nor modified without permission from Elpidio Latorilla.<br>
If you want to use the scripts or some of the scripts used here for your own purposes
please contact Elpidio Latorilla at <a href=mailto:elpidio@care2x.org, >elpidio@care2x.org, </a>.
</FONT>
</td>
</tr>
</table>        
&nbsp;




</BODY>
</HTML>
