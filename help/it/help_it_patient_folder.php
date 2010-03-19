<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo "Dati paziente - $x3" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>What do these  <img <?php echo createComIcon('../','colorcodebar3.gif','0') ?> > barre colorate mean? </b></font>
<ul> <b>Nota: </b>Ciascuna barra colorata se resa "visibile" indica la disponibilità di informazioni specifiche, prescrizioni, cambiamenti, domande, etc.<br>
			Il significato di un colore è modificabile per ciascun padiglione. <br>
			La serie di barre colorate rosa a destra rappresenta l'orario approssimato in cui è necessario eseguire una prescrizione.<br>
			Ad esempio, la sesta barra rosa significa "Sesta ora" o "18 in punto", la 22a barra indica "22a ora" o "10 di sera in punto".
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Che cosa significano questi bottoni?</b></font>
<ul> <input type="button" value="Grafico andamento febbre">
	<ul>
	Questo apre il grafico giornaliero della temperatura. Da qui è possibile inserire, modificare, o cancellare dati.<br>
	Ci sono anche altri campi modificabili:
	<ul type="disc">
	<li>Allergie<br>
	<li>Dieta giornaliera<br>
	<li>Diagnosi/terapia principale<br>
	<li>Diagnosi/terapia giornaliera<br>
	<li>Annotazioni, diagnosi aggiuntive<br>
	<li>Terapia fisica, ginnastica anti-trombosi, etc.<br>
	<li>Anticoagulanti<br>
	<li>Documentazione giornaliera per gli anticoagulanti<br>
	<li>Medicinali via endovena e fasciature<br>
	<li>Documentazione giornaliera per medicinali via endovena<br>
	<li>Annotazioni<br>
	<li>Medicinali (elenco)<br>
	<li>Documentazione giornaliera e dosaggio medicinali<br>
	</ul>		
	</ul>
<input type="button" value="Referto infermieristico">
	<ul>
	Questo apre il modulo per inserimento di un referto infermieristico. E' possibile documentare la propria
	attività infermieristica e la sua efficacia, osservazioni, domande, raccomandazioni, etc.
	</ul>
	<input type="button" value="Prescrizioni mediche">
	<ul>
	Il medico responsabile inserirà qui prescrizioni, medicinali, dosaggio, risposte alle domande del pers.
	infermieristico, variazioni terapiche, etc.
	</ul>	
	<input type="button" value="Referti di laboratorio">
	<ul>
	Questo accede all'archivio dei report diagnostici che arrivano da vari reparti o reparti di diagnosi.
	</ul>	
	<input type="button" value="Dati fondamentali">
	<ul>
	Qui sono memorizzati i dati fondamentali del paziente, il nome, il cognome, etc.  Qui si trova
	anche la documentazione anamnestica iniziali che serve come base per la preparazione del piano
	di cura individuale.
	</ul>	
	<input type="button" value="Piano di cura">
	<ul>
	Questo è il piano di cura individuale: da qui lo si può creare, modificare o cancellare.
	</ul>	
	<input type="button" value="Report di laboratorio">
	<ul>
	Qui si trovano i report di laboratorio, sia medici che patologici.
	</ul>	
	<input type="button" value="Foto">
	<ul>
	Questo apre il catalogo foto del paziente.
	</ul>	
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Qual'è la funzione del riquadro di selezione </b>	<select name="d"><option value="">Scegliere richiesta di test diagnostici</option></select>?
</font>
<ul><b>Nota: </b>Questo apre il modulo di richiesta per un particolare test diagnostico.<br>
 	<b>1: </b>Selezionare <select name="d"><option value="">Scegliere richiesta di test diagnostici</option></select><br>
	<b>2: </b>Selezionare la clinica, il reparto o il test diagnostico.<br>
	<b>3: </b>A questo punto apparirà il modulo di richiesta.<br>
</ul>
<?php endif;?>
<?php if($src=="labor") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b>Al momento non ci sono report di laboratorio.</b></font>
<ul> Premere il bottone <input type="button" value="OK"> per tornare alla cartella dati paziente.</ul>
<?php else  : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Come fare a: chiudere la cartella dati? </b></font>
<ul> <b>Nota: </b>Per chiudere, premere il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle">.</ul>
<?php endif;?>
</form>
