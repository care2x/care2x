
<p><font size=2 face="verana,arial" >
<form action="#" >
<b>Como atualizar ou alterar dados</b>
<ul> Se você quiser fazer mudanças na informação clique no botão <input type="button" value="Atualizar dados">.
</ul>
<?php if($src=="search") : ?>
<b>Nova pesquisa</b>
<ul> Se você quiser iniciar uma nova pesquisa clique no botão <input type="button" value="Voltar à pesquisa">.
</ul>
<?php else : ?>
<b>Para iniciar uma nova admissão de um novo paciente</b>
<ul> Se você quiser iniciar uma nova admissão clique no botão <input type="button" value="Voltar à admissão">.
</ul>
<?php endif;?>
<b>Nota</b>
<ul> Se você tiver terminado, clique no botão <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>>.
		
</ul>


</form>

