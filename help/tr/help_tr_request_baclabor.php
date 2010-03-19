<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Bakteriyoloji laboratuvarý tetkik istemi</b></font>
<p>
<font size=2 face="verdana,arial" >

<?php
if(!$src){
?>
<a name="sday"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Hastanýn etiketi eklenmemiþ. Ne yapmalýyým?</b></font>
<ul> 
	<b>Adým 1: </b>Bir hastanýn ad, soyad, veya protokol numarasý bilgisinin tamamýný ya da birkaç harf giriniz.
		<p>Örnek 1: "21000012" veya "12" giriniz.
		<br>Örnek 2: "Potur" veya "pot" giriniz.
		<br>Örnek 3: "Bülent" veya "Bül" giriniz.<p>
	<b>Adým 2: </b>Aramayý baþlatmak için<img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düðmesini týklayýnýz. <p>
	<b>Adým 3: </b> Eðer arama bir sonuç bulur ise, listeden doðru kiþiyi seçmek için 
	 <img <?php echo createLDImgSrc('../','ok_small.gif','0') ?>> düðmesini týklayýnýz.
</ul>
<?php
}else{
?>



<a name="sel"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Tetkik parametresi nasýl seçilir?</b></font>
<ul> 
	<b>Adým: </b>Parametrenin yanýndaki küçük pembe kutuyu týklatýp "karartýnýz".<p>
<img src="../help/tr/img/tr_request_baclabor.png" border=0 width=325 height=134>
</ul>

<a name="usel"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Bir parametre seçimden nasýl çýkarýlýr?</b></font>
<ul> 
	<b>Adým: </b>Parametrenin yanýndaki "karartýlmýþ" kutuya tekrar týklayýp "rengini açabilir" siniz. <br>
</ul>
<a name="send"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Tetkik istemi nasýl gönderilir?</b></font>
<ul> 
	<b>Adým: </b><img <?php echo createLDImgSrc('../','abschic.gif','0') ?>> düðmesini týklayýnýz.
</ul>
<?php
}
?>
