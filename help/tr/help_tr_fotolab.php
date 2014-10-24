<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Fotolab - 
<?php
	switch($src)
	{
	case "init": print "Baþlatýlýyor";
												break;
	case "input": print "Yüklenecek resimler seçiliyor";
												break;
	case "maindata": print "Hasta bilgileri";
												break;
	case "save": print "Fotoðraflar kaydedildi";
												break;

	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="input") : ?>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Giriþ yapýlacak alanlar görüntüleniyor. Resim dosyalarý nasýl seçilecek?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Kaydetmek istediðiniz fotoðrafýn dosyasýný bulmak için  <input type="button" value="Tara..."> düðmesini týklayýnýz.<br>
 	<b>Adým 2: </b>Bir "Dosya seç" penceresi açýlýr. Ýstediðiniz dosyayý seçip "Aç" ý týklayýnýz.<br>
 	<b>Adým 3: </b>Eðer seçtiðiniz geçerli bir grafik dosyasý ise resim ön izleme halinde üst sað köþede izlenebilir. (Sadece MSIE  tarayýcýsýnda) Olmazsa 1. ve 2. adýmý tekrarlayýnýz.<br>
 	<b>Adým 4: </b>Bu fotoðrafýn çekildiði tarihi  "<span style="background-color:yellow" > Çekim tarihi </span>" alanýna giriniz.<p>
 	

	<b>Adým 5: </b>Fotoðraf sayýsýný "<span style="background-color:yellow" > Sayý </span>" alanýna giriniz.<p>
	
 	
</ul>
		<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Fotoðrafýn ön izlemesi nasýl görüntülenir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Fotoðrafýn ilgili <img <?php echo createComIcon('../','lilcamera.gif','0') ?>> düðmesi týklanýr.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yüklenecek resim sayýsý nasýl deðiþtirilir?</b>
</font>
<ul>       	
 	<b>Adým 1:</b> Yüklemek istediðiniz sayýyý  " <input type="text" name="v" size=4 maxlength=4> resim yüklemek istiyorum " alanýna giriniz.<p>
 	<b>Adým 2:</b>"Git" i týklayýnýz.<p>
</ul>

<?php endif ?>	

<?php if($src=="maindata") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hastanýn bilgileri nasýl bulunur?</b>
</font>
<ul>	
	<b>Adým 1: </b>Hastanýn protokol numarasýný "<span style="background-color:yellow" > Protokol numarasý </span>" alanýna giriniz.<br>
 	<b>Adým 2: </b>Hastayý bulmak için <input type="button" value="Ara"> düðmesini týklatýnýz.<br>
 	<b>Adým 3: </b>Hasta bulunduðu zaman ilgili alanlarda temel bilgileri görüntülenir.<br>
 	<b>Adým 4: </b>Fotoðraflarýn hepsi ya da çoðu ayný tarihte çekilmiþ ise, o tarihi  <nobr>"<span style="background-color:yellow" > Çekim tarihi</span>"</nobr> alanýna giriniz.<br>
 	<b>Adým 5: </b>Bu tarihi tüm fotoðraflar için ayarlamak isterseniz  <img <?php echo createComIcon('../','preset-add.gif','0') ?>> düðmesini týklayýnýz. Bu tarih otomatik olarak 
	sol penceredeki  "Çekim tarihi" alanlarýnda görülecektir.<p>
 	<img <?php echo createComIcon('../','warn.gif','0') ?>><b> Uyarý! </b>Fotoðraflardan biri ya da birkaçýnýn farklý çekim tarihleri var ise o tarihi ilgili fotoðrafýn  "Çekim tarihi" alanýna giriniz. Bunu ancak 5. adýmdan sonra yapabilirsiniz.<p>
</ul>
	
	<?php endif ?>	
<?php if($src=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ayný hastanýn baþka fotoðraflarýný da kaydetmek istiyorum. Nasýl yapýlýr?</b>
</font>
<ul>	
	<b>Adým 1: </b>Kaydetmek istediðiniz fotoðraflarýn sayýsýný <nobr>"Ayný hastanýn ek <input type="text" name="g" size=3 maxlength=2> fotoðrafý <span style="background-color:yellow" > . </span>"</nobr> alanýna giriniz.<br>
 	<b>Adým 2: </b><input type="button" value="Git"> düðmesini týklayýnýz.<br>
</ul>

	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir baþka hastanýn resimlerini kaydetmek istiyorum. Nasýl yapýlýr?</b>
</font>
<ul>	
	<b>Adým 1: </b>Kaydetmek istediðiniz fotoðraflarýn sayýsýný bir baþka hastanýn <nobr>" <input type="text" name="g" size=3 maxlength=2> fotoðrafý <span style="background-color:yellow" >  </span>"</nobr> alanýna giriniz.<br>
 	<b>Adým 2: </b> <input type="button" value="Git"> düðmesini týklayýnýz.<br>
</ul>

	<?php endif ?>	
	


	</form>

