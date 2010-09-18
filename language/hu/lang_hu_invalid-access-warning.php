<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
require('./roots.php');
require($root_path.'include/core/inc_environment_global.php');
require_once($root_path.'include/core/inc_img_fx.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
<HEAD>
<meta http-equiv="Összetevõ Típusa" content="text/html; charset=utf8">
 <TITLE>Nem érvényes hozzáférés figyelmeztetés</TITLE>
</HEAD>

<BODY bgcolor="#ffffff">

<table width=100% border=1>
<tr>
<td bgcolor="navy">
<FONT  COLOR="white"  SIZE=+3  FACE="Arial"><STRONG>&nbsp;Igazolatlan oldal hozzáférés</STRONG></FONT>
</td>
</tr>
<tr>
<td ><p><br>


<center>
<FONT    SIZE=3 color=red  FACE="Arial">
<b>Önnek nincs hozzáférési jogosultsága a dokumentumhoz!</b></font><p>
<FORM >
<INPUT type="button"  value=" OK "  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>"></FORM>
<p>
</font>
</center>
<p>
<ul>
<font size=3 face="verdana,arial">
A problémát okozhatja az alábbiak egyike:
</FONT><p>
<font size=2 face="verdana,arial">
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Használhatja inkább a böngészõ "Vissza (Back)" or "Elõre (Forward)" funkcióját. Kerülje ezeknek a gomboknak a használatát.<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
A "cookie"-k tiltva vannak. A program megfelelõ mûködéséhez elengedhetetlen a "cookie"-k használata, ezért kérjük engedélyezze.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
A böngészõje nem fogadja a "cookie"-kat. Kérjük állítsa be a böngészõben, hogy a "cookie"-k automatikusan fogadásra kerüljenek"
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
A böngészõje valószínûleg nem tudja futtatni a java szkripetet vagy a java szkript futtatása tiltva van. Kérjük engedélyezze a böngészõben a java szkriptek futtatását.
<br>
<img <?php echo createComIcon('../../','achtung.gif') ?>>
Elõrodulthat -ritka esetben-, hogy az adatátvitel nem sikerül. Ilyenkor kérjük nyomja meg a böngészõben a
"Frissítés (reload)" gombot, a probléma kiküszöbölésére.
<p>
</FONT>
<p>
</ul>
</td>
</tr>
</table>        
<p>

<?php
require($root_path.'include/core/inc_load_copyrite.php'); 
?>
</FONT>


</BODY>
</HTML>
