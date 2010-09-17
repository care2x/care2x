<?php
/*
	Translated to Serbian - Latin by Djape: www.djape.com
	March - June 2004
*/
	error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
	require('./roots.php');
	require($root_path.'include/core/inc_environment_global.php');
	require_once($root_path.'include/inc_img_fx.php');
?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 3.0//EN" "html.dtd">
<?php html_rtl($lang); ?>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1250">
		<title>Upozorenje - Nedozvoljen pristup</title>
	</head>
	<body bgcolor="#ffffff">
		<table width=100% border=1>
			<tr>
				<td bgcolor="navy">
					<font color="white"  size=+3  face="Arial"><strong>&nbsp;Nedozvoljen pristup strani</strong></font>
				</td>
			</tr>
			<tr>
				<td >
					<p>
					<br>
					<center>
						<font size=3 color=red  face="Arial">
							<b>Ne posedujete korisni�ko pravo za otvaranje ovog dokumenta!</b>
						</font>
						<p>
						<form>
							<input type="button"  value="U redu"  onClick="<?php if ($mode=="close") print 'window.close()'; else print 'history.back()'; ?>">
						</form>
						<p>
					</center>
					<p>
					<ul>
						<font size=3 face="verdana,arial">
							Verovatan uzrok problema:
						</font>
						<p>
						<font size=2 face="verdana,arial">
							<img <?php echo createComIcon('../../','achtung.gif') ?>>
								Mo�da ste koristili standardnu "Nazad" ili "Napred" funkciju va�eg web �ita�a.
								Izbegavajte kori��enje ovih dugmadi.<br>
								<img <?php echo createComIcon('../../','achtung.gif') ?>>
								Mo�da ste odbili cookie. Program je ovisan o cookie-jima da bi ispravno radio. Zato vas molimo da 
								omogu�ite prijem cookie-ja .
								<br>
								<img <?php echo createComIcon('../../','achtung.gif') ?>>
								Va� web �ita� mo�da ne prima cookie-je. Molimo vas da podesite va� web �ita� nna automatsko primanje cookie-ja.
								<br>
								<img <?php echo createComIcon('../../','achtung.gif') ?>>
								Va� web �ita� mo�da nije u mogu�nosti interpretacije javascripta ili mu je izvr�avanje javascripta onemogu�eno. Molimo vas da omogu�ite izvr�avanje javascripta u va�em web �ita�u.
								<br>
								<img <?php echo createComIcon('../../','achtung.gif') ?>>
								U retkim slu�ajevima dolazi do gre�ke u prenosu podataka. Za ispravku ove situacije samo pritisnite
								"osve�i" dugme va�eg web �ita�a.
								<p>
						</font>
						<p>
					</ul>
				</td>
			</tr>
		</table>
		<p>
		<?php
		require($root_path.'include/inc_load_copyrite.php'); 
		?>
	</body>
</html>
