<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php "Laboratory - $x3" ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Come inserire il grafico dei parametri di test</b>
</font>
<ul>      
 	<b>1: </b>Selezionare la casella <input type="checkbox" name="s" value="s" checked> che corrisponde al parametro desiderato per sceglierlo.<br>
		<b>2: </b>Per visualizzare più di un parametro per volta, selezionare le caselle corrispondenti.<br>
		<b>3: </b>Selezionare l'icona <img src="../img/chart.gif" width=16 height=17 border=0> per visualizzare il grafico.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
C'è un modo rapido per selezionare tutti i parametri?</b>
</font>
<ul>      
		<b>Sì!</b><br>
		<b>1: </b>Selezionare il bottone <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?> border=0> per scegliere tutti i parametri.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
E per deselezionare tutti i parametri??</b>
</font>
<ul>      
		<b>1: </b>Selezionare il bottone <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?> border=0> di nuovo. Questo deselezionerà tutti i parametri.<br>
</ul>
<?php endif;?>
<?php if($src=="graph") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>Come si fa a tornare ai test senza grafici? </b></font>
<ul> <b>Nota: </b>Per tornare indietro, selezionare il bottone <img <?php echo createLDImgSrc('../','back2.gif','0','absmiddle') ?>>.</ul>
<?php endif;?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>How to close the laboratory <?php $x3 ?>? </b></font>
<ul> <b>Nota: </b>Per chiudere, selezionare il bottone <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle">.</ul>
</form>
