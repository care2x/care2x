<?php
error_reporting(E_COMPILE_ERROR|E_ERROR|E_CORE_ERROR);
?>
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "Labor - $x3" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie lasse ich die graphische Kurvendarstellung der Labortestwerte zeigen?</b>
</font>
<ul>      
 	<b>Schritt 1: </b>Klickt den Checkbox <input type="checkbox" name="s" value="s" checked> des Testparameters.<br>
		<b>Schritt 2: </b>Wenn Sie mehrere Testparameter gleichzeitig darstellen lassen möchten, klickt ihre entsprechende Checkboxen an<br>
		<b>Schritt 3: </b>Klickt das Symbol <img src="../img/chart.gif" width=16 height=17 border=0> um die graphische Kurvendarstellung zu zeigen.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ich möchte alle Parameter für die graphische Darstellung auswählen. Gibt es dafür eine schnelle Methode?</b>
</font>
<ul>      
		<b>Ja!</b><br>
		<b>Schritt 1: </b>Klickt den <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?> border=0> Knopf an um alle Parameter gleichzeitig auszuwählen.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Wie kann ich die Auswahl rücksetzen?</b>
</font>
<ul>      
		<b>Schritt 1: </b>Klickt den <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?> border=0> Knopf noch einmal.<br>
</ul>
<?php endif; ?>
<?php if($src=="graph") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>>
 <font color="#990000"><b>Wie komme ich zur Liste von Labortestwerte ohne graphische Darstellung zurück? </b></font>
<ul>Klickt den <img <?php echo createLDImgSrc('../','back2.gif','0','absmiddle') ?>> Knopf an.</ul>
<?php endif; ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>>
 <font color="#990000"><b>Wie schliesse ich den <?php echo $x3 ?>? </b></font>
<ul> Klict den <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> Knopf an.</ul>


</form>

