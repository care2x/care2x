
<p><font size=2 face="verdana,arial" >
<form action="#" >
<b>To update or change data</b>
<ul> If you want to make changes in the information selezionare il bottone <input type="button" value="Aggiorna">.
</ul>
<?php if($src=="search") : ?>
<b>Nuova ricerca</b>
<ul> Per iniziare una nuova ricerca selezionare il bottone <input type="button" value="Tornare alla ricerca">.
</ul>
<?php else : ?>
<b>Per iniziare l'accettazione di un nuovo paziente</b>
<ul> Per iniziare un'accettazione selezionare il bottone <input type="button" value="Tornare all'accettazione">.
</ul>
<?php endif;?>
<b>Note</b>
<ul> Alla fine, selezionare il bottone <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> border=0>.
</ul>
</form>
