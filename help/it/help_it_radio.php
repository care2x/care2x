<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Radiologia - 
<?php
if($src=="search")
{
	print "Ricerca pazienti";	
}
 ?>
 </b>
 </font>
<p><font size=2 face="verdana,arial" >
<form action="#" >
<?php if($src=="search") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come cercare un paziente?</b>
</font>
	<ul>       	
 	<b>1: </b>Inserire nel campo appropriato il nome, il cognome o il codice del paziente (bastano pochi caratteri).<br>
 	<b>2: </b>Premere il bottone <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> per iniziare la ricerca del paziente.<p> 
<ul>       	
 	<b>Note: </b>Se la ricerca trova più di un risultato, apparirà un elenco. <p>
	</ul>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come vedere l'anteprima delle lastre e relative diagnosi di un pazient?</b>
</font>
	<ul>       	
 	<b>1: </b>Selezionare il link o la casella "<span style="background-color:yellow" > <font color="#0000cc">Anteprima/Diagnosi</font> <input type="radio" name="d" value="a"> </span>".<br>
	Nel riquadro a sinistra appariranno delle piccole immagini delle lastre.<br> 
	In quello a destra, appariranno le relative diagnosi.<br> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come visualizzare una lastra a grandezza normale?</b>
</font>
	<ul>       	
 	<b>1: </b>Premere il bottone <img <?php echo createComIcon('../','torso.gif','0') ?>> corrispondente al paziente di cui si vogliono vedere le lastre.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Nota:</b></font> 
<ul>       	
Per chiudere, premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?>>.
</ul>
<?php endif;?>
</form>
