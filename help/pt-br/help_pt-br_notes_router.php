<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php echo $x1 ?></b></font>

<p><font size=2 face="verdana,arial" >

<?php

if($x2=='show'||$src=='sickness'){
	if($x3){
	
	}else{

		if($src=='sickness'){	
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>How to change the department?</b></font>
<ul> 
<b>Passo 1: </b> Selecione o departamento da caixa seletora com o nome de " <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> Crie um formulário para".<p>
<b>Passo 2: </b> Clique "OK".<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Como salvar a confirmação?</b></font>
<ul> 
<b>Passo: </b> Clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> .<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Como imprimir a confirmação?</b></font>
<ul> 
<b>Passo: </b> Clique no botão <img <?php echo createLDImgSrc('../','printout.gif','0') ?>> .<p>
</ul>

<?php
		}elseif($src=='diagnostics'){
?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Não há dados disponíveis ainda. Como entrar com dados novos?</b></font>
<ul> 
<b>Nota: </b> Novos resultados de diagnósticos ou relatórios somente podem ser entrados via os módulos apropriados de laboratório ou diagnóstico. O módulo de admissão tem o modo de  "somente leitura" .<p>
</ul>
<?php
		}elseif($src=='notes'){
?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Não há dados disponíveis ainda. Como entrar com dados novos?</b></font>
<ul> 
<b>Passo: </b> Clique no link " <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> <font color=#0000ff><b>Entre novo registro</b></font>" .<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Como exibir de volta o menu de opções?</b></font>
<ul> 
<b>Passo: </b> Clique no link " <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> <font color=#0000ff><b>Voltar para opções</b></font>" .<p>
</ul>

<?php
		}else{
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Não há dados disponíveis ainda. Como entrar com dados novos?</b></font>
<ul> 
<b>Passo: </b> Clique no link " <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> <font color=#0000ff>Entre novo registro</font>" .<p>
</ul>

<?php 
		}
	}
}else{
?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Como criar o registro?</b></font>

<ul> 
<b>Passo: </b> Entre a  informação, então clique no botão <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> .
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Como entrar com a data?</b></font>
<ul> 
<b>Passo 1: </b> Clique no ícone <img <?php echo createComIcon('../','show-calendar.gif','0') ?>>  e um mini-calendário aparecerá.<p>
<img src="../help/en/img/en_date_select.png"><p>
<b>Passo 2: </b> Clique a data no mini-calendário.<p>
<img src="../help/en/img/en_mini_calendar.png"><p>
<b>OR: </b> Para entrar a data de "hoje" , digite "t" ou "T" no campo de entrada de data. A data de hoje será inserida automaticamente no formato local.<p>
<b>OR: </b> Para entrar a data de "ontem" , digite "y" ou "Y" no campo de entrada de data. A data de ontem será inserida automaticamente no formato local.<p>

</ul>
<?php 
}
?>
