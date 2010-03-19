<font face="Verdana, Arial" size=3 color="#0000cc">
<b>Patoloji laboratuvarý tetkik istemi</b></font>
<p>
<font size=2 face="verdana,arial" >

<?php
if(!$src){
?>
<a name="sday"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Hastanýn etiketi eklenmemiþ ne yapmalýyým?</b></font>
<ul> 
	<b>Adým 1: </b>Hasta bilgisinden örneðin, ad, soyad, protokol no gibi; ya tam bir bilgi ya da birkaç harf giriniz.
		<p>Örnek 1: "21000012" veya "12" giriniz.
		<br>Örnek 2: "Gürcan" veya "gür" giriniz.
		<br>Örnek 3: "Potur" veya "Pot" giriniz.<p>
	<b>Adým 2: </b>Aramaya baþlamak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düðmesini týklayýnýz. <p>
	<b>Adým 3: </b> Eðer arama bir sonuç bulur ise doðru kiþiyi <img <?php echo createLDImgSrc('../','ok_small.gif','0') ?>> düðmesine týklayarak seçiniz.
</ul>
<?php
}else{
?>

<a name="stime"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Ýstem formunda neler doldurulmalý?</b></font>
<ul> 
	<b>Doldurulmasý ya da iþaretlenmesi zorunlu alanlar:</b> 
<ul> 
	<li>Materyelin tipi
	<li>Materyelin betimlenmesi
	<li>Ameliyat tarihi
	<li>Ýstemden sorumlu doktor veya cerrah
</ul>
</ul>


<a name="send"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Ýstem formu nasýl gönderilir?</b></font>
<ul> 
	<b>Adým: </b><img <?php echo createLDImgSrc('../','abschic.gif','0') ?>> düðmesini týklayýnýz.
</ul>
<?php
}
?>

