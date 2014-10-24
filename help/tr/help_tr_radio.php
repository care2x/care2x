<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Radyoloji - Röntgen 
<?php

if($src=="search")
{
	print "Bir hastayý ara";	
}

 ?>
 </b>
 </font>
<p><font size=2 face="verana,arial" >
<form action="#" >

<?php if($src=="search") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hasta nasýl aranýr?</b>
</font>
	
	<ul>       	
 	<b>Adým 1: </b>Bir hastanýn protokol numarasý, ad, soyad bilgilerinden tamamýný veya birkaç harfi ilgili alana giriniz. <br>
 	<b>Adým 2: </b>Hastayý aramaya baþlamak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düðmesini týklayýnýz.<p> 
<ul>       	
 	<b>Uyarý: </b>Arama bir sonuç bulur ise, bir liste görüntülenir. <p>
	</ul>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hastanýn röntgen filmi ve tanýsý nasýl izlenir?</b>
</font>
	
	<ul>       	
 	<b>Adým 1: </b>"<span style="background-color:yellow" > <font color="#0000cc">Ön izleme/Taný</font> <input type="radio" name="d" value="a"> </span>" baðlantý ya da düðmesini týklayýnýz.<br>
	Röntgen filminin minik bir kopyasý alt sol pencerede görüntülenir.<br> 
	Röntgen filminin tanýsý alt sað pencerede görüntülenir.<br> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hastanýn röntgen filmi tam büyüklükte nasýl izlenir?</b>
</font>
	<ul>       	
 	<b>Adým 1: </b>Tam ekran görüntüsüne geçmek için hastanýn ilgili   <img <?php echo createComIcon('../','torso.gif','0') ?>> düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Eðer kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.
</ul>
<?php endif ?>


</form>

