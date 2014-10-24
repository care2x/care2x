<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Kan ürünleri istemi</b></font>
<p>
<font size=2 face="verdana,arial" >

<?php
if(!$src){
?>
<a name="sday"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Hasta etiketi eklenmemiþ. Ne yapmalýyým?</b></font>
<ul> 
	<b>Adým 1: </b>Hastanýn ad soyad veya protokol numarasý bilgisinin tamamýný ya da bir kaç harfini  giriniz.
		<p>Örnek 1: "21000012" veya "12" giriniz.
		<br>Örnek 2: "Potur" veya "pot" giriniz.
		<br>Örnek 3: "Bülent" veya "Bül" giriniz.<p>
	<b>Adým 2: </b>  Aramaya baþlamak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> simgesini týklayýnýz. <p>
	<b>Adým 3: </b> Arama bir sonuç bulur ise listeden doðru kiþiyi
	 <img <?php echo createLDImgSrc('../','ok_small.gif','0') ?>> düðmesini týklayarak seçiniz.
</ul>
<?php
}else{
?>

<a name="stime"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Ýstem formuna ne doldurmalý?</b></font>
<ul> 
	<b>Doldurulmasý zorunlu alanlar:</b> 
<ul> 
	<li>Kan grubu
	<li>Rh faktörü
	<li>Kell
	<li>Ýstenen ürünün ünite sayýsý
	<li>Transfüzyon tarihi
	<li>Ýstem tarihi
	<li>Ýstemden sorumlu doktorun adý.
</ul>
</ul>

<a name="send"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Bazý deðerler henüz yok. Bunlar olmadan da istemi yine de gönderebilir miyim?</b></font>
<ul> 
	<b>Uyarý: </b>Deðerleri henüz bulunmayan aþaðýdaki alanlara suru iþareti "?" girebilirsiniz:
<ul> 
	<li>Kan grubu
	<li>Rh faktörü
	<li>Kell 
</ul>
</ul>

<a name="send"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Tetkik istemi nasýl gönderilir?</b></font>
<ul> 
	<b>Adým: </b> <img <?php echo createLDImgSrc('../','abschic.gif','0') ?>> düðmesini týklayýnýz.
</ul>

<?php
}
?>
