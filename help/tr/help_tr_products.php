<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?php
if($x2=="pharma") print "Eczane - "; else print "Týbbi ambar - ";
	switch($src)
	{
	case "head": if($x2=="pharma") print "Farmasötik ürünlerin istemi"; 
						else print "Ürünlerin istemi";
						break;
	case "catalog": print "Ýstem kataloðu";
						break;
	case "orderlist": print "Ýstem sepeti ( istem listesi )";
						break;
	case "final": print "Son istem listesi";
						break;
	case "maincat": print "Ýstem kataloðu";
						break;
	case "arch": print "Ýstem arþivi";
						break;
	case "archshow": print "Ýstem arþivi";
						break;
	case "db": switch($x3)
					{
						case "input": print "Veri bankasýna yeni ürün giriþi";
						break;
					}
					break;
	case "how2":print "Nasýl istem yapmalý ";
						  if($x2=="pharma") print "farmasötik ürünler"; else print "ürünler";
	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="maincat") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir kalem malzeme istem kataloðuna nasýl eklenir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Önce malzemeyi bulmalýsýnýz.  Malzemenin marka ismi, jenerik ismi, sipariþ numarasý vb bilgisinin ya tamamýný ya da birkaç harfini 
				<nobr><span style="background-color:yellow" >" Bir anahtar sözcük ara: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> alanýna giriniz.<br>
 	<b>Adým 2: </b>Malzemeyi bulmak için  <input type="button" value="Malzemeyi bul"> düðmesini týklayýnýz.<br>
 	<b>Adým 3: </b>Arama sonunda anahtar sözcüðün tam karþýlýðý bulunur ise , malzemenin ayrýntýlý bir tanýmý görüntülenir. <br>
 	<b>Adým 4: </b>Malzemeyi kataloða eklemek için <input type="button" value="Bu malzemeyi kataloða koy"> düðmesini týklayýnýz.<p>
 	<b>Uyarý: </b>Bu malzemeyi kataloða koymak istemez iseniz, bir baþka malzemeyi aramaya devam ediniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Aramaya nasýl devam edilir?</b>
</font>
<ul>       	
 	Yukarýda malzemeyi bulmak için belirtilen yönergeyi izleyiniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Arama benim anahtar sözcüðüme yakýn birkaç sonuç buldu. Ne yapmalýyým?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Arama anahtar sözcüðe yakýn bir veya birkaç malzeme bulur ise, bir liste görüntülenir..<br>
 	<b>Adým 2: </b><img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>> Düðmesini týklayýnýz. Malzeme katalog listesine eklenir.<br>
 	<b>Adým 3: </b>Malzeme hakkýndaki tam bilgiyi görmek ister iseniz, ya ismini veya düðmesini týklayýnýz <img <?php echo createComIcon('../','info3.gif','0') ?>>.<br>
 	<b>Adým 4: </b>Malzemenin tam bilgisi görüntülenir.<br>
 	<b>Adým 5: </b> <input type="button" value="Bu malzemeyi kataloða koy"> düðmesini týklayýnýz.<p>
</ul>
	

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Malzeme hakkýnda daha fazla bilgi görmek istiyorum. Ne yapmalýyým?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Ya malzemenin ismini ya da  <img <?php echo createComIcon('../','info3.gif','0') ?>> düðmesini týklayýnýz.<br>
 	<b>Adým 2: </b>Ürünün tam bilgisi görüntülenir.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir malzeme katalog listesinden nasýl çýkarýlýr?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Malzemenin <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> düðmesini týklayýnýz.<br>
</ul>

<?php endif ?>

<?php if($src=="how2") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
 <?php if($x2=="pharma") print "Farmasötik ürünler"; else print "Týbbi ambardan ürünler"; ?>   nasýl istem yapýlýr?
</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Ýsteme geçmek için menüden  "<span style="background-color:yellow" > <img <?php echo createComIcon('../','bestell.gif','0') ?>> Ýstem </span>" seçeneðini týklayýnýz.<br>
 	<b>Adým 2: </b>Daha önce giriþ yaptý iseniz, istem sepeti ve istem kataloðu görüntülenir. Daha önce giriþ yapmadý iseniz kullanýcý adý ve þifre sorulur.<br>

 	<b>Adým 3: </b>Eðer sorulur ise, kullanýcý adý ve þifrenizi giriniz. <img <?php echo createLDImgSrc('../','continue.gif','0') ?>> düðmesini týklayýnýz.<br>
 	<b>Adým 4: </b>Bir istem listesi oluþturmaya baþlayýnýz. Sað çerçevede bölüm, servis veya ameliyathaneniz için istem kataloðunu göreceksiniz. <p>
 	<b>Adým 5: </b>Gereksiniminiz olan malzeme katalog listesinde ise, sol çerçevedeki sepete (istem listesine) malzemeden <b>bir adet</b> koymak için  <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> düðmesine týklayýnýz.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ýstem sepetine bir malzemeden birden fazla sayýda koymak istiyorum. Nasýl yapýlýr?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Seçmek için ilgili malzemenin <input type="checkbox" name="a" value="a" checked> seçim düðmesini týklayýnýz.<br>
 	<b>Adým 2: </b>Malzemenin ilgili  " Pcs. <input type="text" name="d" size=2 maxlength=2> " alanýna parça sayýsýný giriniz.<br>
 	<b>Adým 3: </b>Malzemeyi sepete (istem listesine) koymak için <input type="button" value="Sepete koy"> düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Gereksinimim olan malzeme katalog listesinde yok. Ne yapmalýyým?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Malzemeyi bulmalýsýnýz. Malzemenin marka adý, jenerik adý, sipariþ numarasý vb bilgisinin ya tamamýný ya da baþtan birkaç harfini 
				<nobr><span style="background-color:yellow" >" Aranan anahtar sözcük: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> alanýna giriniz.<br>
 	<b>Adým 2: </b>Malzemeyi bulmak için <input type="button" value="Malzemeyi bul"> düðmesini týklayýnýz.<br>
 	<b>Adým 3: </b>Arama malzemeyi veya aranan anahtar sözcüðe yakýn bir malzemeyi  bulur ise bir liste görüntülenir. <br>
 	<b>Adým 4: </b>Ýstem sepetine malzemenin bir adedini koymak ister iseniz, <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> düðmesini týklayýnýz. Malzeme sepete konulur ve aynýsý katalog listesine de eklenir.<br>
 	<b>Adým 5: </b>Malzemeyi sadece katalog listesine eklemek ister iseniz <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>> düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Malzeme hakkýnda daha fazla bilgi görmek istiyorum. Ne yapmalýyým?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Ya malzemenin ismini veya  <img <?php echo createComIcon('../','info3.gif','0') ?>> düðmesini týklayýnýz.<br>
 	<b>Adým 2: </b>Ürün hakkýnda tüm bilgileri gösteren bir pencere açýlýr.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Katalog listesinden bir ürün nasýl silinir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Malzemenin <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ýstem sepetindeki parça sayýsýný deðiþtirebilir miyim?
</b>
</font>
<ul>       	
 	<b>Evet.</b> Ýstem listesini sonlandýrmadan önce sadece parça sayýsý girdilerini düzenlemeniz yeterli olur.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Gereksinimim olan tüm malzemeler þimdi sepette. Sonra ne yapmalýyým?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Ýstem listesini  <?php if($x2=="pharma") print "eczaneye"; else print "týbbi ambara"; ?> gönderebilirsiniz. <br>Ýþleme baþlamak için <input type="button" value="Ýstem listesini sonlandýr"> düðmesini týklayýnýz.<br>
 	<b>Adým 2: </b>Ýstem listesi tekrar görüntülenir. Ýsminizi<nobr>"<span style="background-color:yellow" > Oluþturan <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alanýna giriniz.<br>
 	<b>Adým 3: </b>Ýstemin öncelik durumunu "<span style="background-color:yellow" > Normal<input type="radio" name="x" value="s" checked> Acil<input type="radio" name="x" > </span>" arasýndan seçiniz. Uygun kutuyu iþaretleyiniz.<br>
 	<b>Adým 4: </b>Onaylayan (doktor veya cerrah) ismini <nobr>"<span style="background-color:yellow" > Onaylayan <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alanýna girmelidir.<br>
 	<b>Adým 5: </b>Onaylayan (doktor veya cerrah) þifresini <nobr>"<span style="background-color:yellow" > Þifre: <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alanýna girmelidir.<br>
 	<b>Adým 6: </b>Ýstem listesini göndermek için  <input type="button" value="Bu istem listesini <?php if($x2=="pharma") print "eczaneye"; else print "týbbi ambara"; ?> gönder."> düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Ýstem listesini göndermeyi iptal etmeye karar verir iseniz, istem listesine geri gitmek için  "<span style="background-color:yellow" > Geri ve listeyi düzenle </span>" baðlantýsýný týklayýnýz.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Þimdi istem vermeyi sonlandýrmak istiyorum. Ne yapmalýyým?</b>
</font>
<ul>     
 	<b>Adým 1: </b> <?php if($x2=="pharma") print "Eczane"; else print "Týbbi ambar"; ?> alt menüsüne geri gitmek için  "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> Ýstem son </span>" baðlantýsýný týklayýnýz.<br>
</ul>	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir istem listesi oluþturmak istiyorum. Ne yapmalýyým?</b>
</font>
<ul>     
 	<b>Adým 1: </b>Boþ bir istem sepeti oluþturmak için  "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> Yeni bir istem listesi baþlat </span>"  baðlantýsýný týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Ýstem sepeti veya katalog listesi hakkýnda pencere içerisindeki  <img <?php echo createComIcon('../','frage.gif','0') ?>> düðmesini týklayarak ayrýntýlý bilgi alabilirsiniz.
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.
</ul>
<?php endif ?>


<?php if($src=="head") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<?php if($x2=="pharma") print "Farmasötik ürünler"; 
						else print "Týbbi ambardan ürünler"; ?> nasýl istem yapýlýr?
</b>
</font>
<ul>       	

 	<b>Adým 1: </b>Önce istem listesi oluþturunuz. Sað çerçevede bölüm, servis veya ameliyathaneniz için istem kataloðunu göreceksiniz. <p>
 	<b>Adým 2: </b>Gereksiniminiz olan malzeme katalog listesinde ise, sol çerçevedeki sepete (istem listesine) malzemeden <b>bir adet</b> koymak için  <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> düðmesine týklayýnýz.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ýstem sepetine bir malzemeden birden fazla sayýda koymak istiyorum. Nasýl yapýlýr?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Seçmek için ilgili malzemenin <input type="checkbox" name="a" value="a" checked> seçim düðmesini týklayýnýz.<br>
 	<b>Adým 2: </b>Malzemenin ilgili  " Pcs. <input type="text" name="d" size=2 maxlength=2> " alanýna parça sayýsýný giriniz.<br>
 	<b>Adým 3: </b>Malzemeyi sepete (istem listesine) koymak için <input type="button" value="Sepete koy"> düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Pencere içerisinde <img <?php echo createComIcon('../','frage.gif','0') ?>> düðmesini týklayarak istem sepeti veya katalog listesi hakkýnda ayrýntýlý bilgi edinebilirsiniz.
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.
</ul>
<?php endif ?>

<?php if($src=="catalog") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir malzeme sepete (istem listesine) nasýl konur?
</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Ýhtiyacýnýz olan malzeme katalog listesinde ise malzemeden <b>bir kalem</b> sol çerçevedeki istem listesine (sepet) koymak için  <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> düðmesine týklayýnýz.<p>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ýstem sepetine bir üründen birden fazla sayýda koymak istiyorum. Nasýl yapýlýr?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Seçmek için malzemeye karþýlýk gelen <input type="checkbox" name="a" value="a" checked> seçme düðmesini týklayýnýz.<br>
 	<b>Adým 2: </b>Parça sayýsýný  malzemenin ilgili " parça <input type="text" name="d" size=2 maxlength=2> " alanýna giriniz.<br>
 	<b>Adým 3: </b>Malzemeyi sepete (istem listesine) koymak için  <input type="button" value="Sepete koy"> düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Gereksindiðim malzeme katalog listesinde yok. Ne yapmalýyým?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Malzemeyi bulmalýsýnýz. Malzemenin marka, veya jenerik isim, veya sipariþ numarasý bilgisinin ya tamamýný veya birkaç harfini  
				<nobr><span style="background-color:yellow" >" Aranacak anahtar sözcük: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> alanýna giriniz.<br>
 	<b>Adým 2: </b>Malzemeyi bulmak için  <input type="button" value="Malzemeyi bul"> düðmesini týklayýnýz.<br>
 	<b>Adým 3: </b>Arama malzemeyi bulur ise veya arama anahtar sözcüðüne yakýn bir ürün bulunur ise bir liste görüntülenir.<br>
 	<b>Adým 4: </b>Eðer malzemeden bir parça istem sepetine koymak ister iseniz  <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> düðmesine týklayýnýz. Malzeme sepete konur ve ayný zamanda katalog listesine eklenir.<br>
 	<b>Adým 5: </b>Malzemeyi sadece katalog listesine eklemek ister iseniz, <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>> düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Malzeme hakkýnda daha fazla bilgi görmek istiyorum. Ne yapmalýyým?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Ya  <img <?php echo createComIcon('../','info3.gif','0') ?>> düðmesini veya malzemenin ismini týklayýnýz.<br>
 	<b>Adým 2: </b>Malzeme hakkýndaki tüm bilgileri gösteren bir pencere açýlýr.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir malzeme katalog listesinden nasýl silinir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Malzemenin <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> düðmesine týklayýnýz.<br>
</ul>

<?php endif ?>

<?php if($src=="orderlist") : ?>
	<?php if($x1=="0") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Halen sepet boþ.<p>
 Bir istem listesi oluþturmak için, gereksiniminiz olan malzemeyi sað çerçevedeki katalog listesinden seçip sepete koyunuz.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Malzeme sepete (istem listesine) nasýl konulur?
</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Gereksiniminiz olan malzeme katalog listesinde ise, malzemeden <b>bir adet</b> istem listesine (sepete) koymak için  <img <?php echo createComIcon('../','l-arrowgrnlrg.gif','0') ?>> düðmesini týklayýnýz.<br> Ýstem listesi otomatik olarak soldaki sepet çerçevesinde görüntülenir.<p>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Katalog listesinden sepete malzemelerin aranmasý, seçilmesi ve konulmasý konusunda ayrýntýlý bilgi için saðdaki istem katalog çerçevesi içerisindeki  <img <?php echo createComIcon('../','frage.gif','0') ?>> düðmesini týklayýnýz.<p>
</ul>

	<?php else : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ýstem sepetindeki parça sayýsýný deðiþtirebilir miyim?
</b>
</font>
<ul>       	
 	<b>Evet.</b> Ýstem listesini sonlandýrmadan önce parça sayýsý girdisini deðiþtirmeniz yeterli.
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Malzeme konusunda daha fazla bilgi görmek istiyorum. Ne yapmalýyým?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Malzemenin <img <?php echo createComIcon('../','info3.gif','0') ?>> düðmesini týklayýnýz.<br>
 	<b>Adým 2: </b>Ürün hakkýndaki tüm bilgileri gösteren bir pencere açýlýr.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir malzeme sepetten nasýl çýkarýlýr?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Malzemenin  <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Gereksindiðim tüm malzemeler þimdi sepette. Sonra ne yapmalýyým?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Ýstem listesini eczaneye gönderebilirsiniz. <br>Ýþlemi baþlatmak için  <input type="button" value="Ýstem listesini sonlandýr"> düðmesini týklayýnýz.<br>
 	<b>Adým 2: </b>Ýstem listesi tekrar görüntülenir. Ýsminizi <nobr>"<span style="background-color:yellow" > Oluþturan <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alanýna yazýnýz.<br>
 	<b>Adým 3: </b>Ýstemin öncelik durumunu  "<span style="background-color:yellow" > Normal<input type="radio" name="x" value="s" checked> Acil<input type="radio" name="x" > </span>" arasýndan seçiniz. Uygun seçim kutusunu iþaretleyiniz.<br>
 	<b>Adým 4: </b>Onaylayan (doktor veya cerrah) ismini <nobr>"<span style="background-color:yellow" > Onaylayan <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alanýna girmelidir.<br>
 	<b>Adým 5: </b>Onaylayan (doktor veya cerrah) þifresini <nobr>"<span style="background-color:yellow" > Þifre: <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alanýna girmelidir.<br>
 	<b>Adým 6: </b>Ýstem listesini göndermek için  <input type="button" value="Bu istem listesini eczaneye gönder"> düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Ýstem listesini göndermeyi iptal etmeye karar verir iseniz, "<span style="background-color:yellow" > Geri git ve listeyi düzenle </span>" baðlantýsýný týklayýnýz.
</ul>
	<?php endif ?>

<?php endif ?>


<?php if($src=="final") : ?>
	<?php if($x1=="1") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ýstemi sonlandýrmak istiyorum. Ne yapmalýyým?</b>
</font>
<ul>     
 	<b>Adým 1: </b>Eczane alt menüsüne geri dönmek için  "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> Ýstem sonu </span>" baðlantýsýný týklayýnýz.<br>
</ul>	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir istem listesi oluþturmak istiyorum. Ne yapmalýyým?</b>
</font>
<ul>     
 	<b>Adým 1: </b>Boþ bir istem sepeti oluþturmak için "<span style="background-color:yellow" > <img <?php echo createComIcon('../','arrow-blu.gif','0') ?>> Yeni bir istem listesi baþlat </span>" baðlantýsýný týklayýnýz.<br>
</ul>		<?php else : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Sonlandýrýlmýþ istem listesi nasýl gönderilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Ýsminizi <nobr>"<span style="background-color:yellow" > Oluþturan <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alanýna yazýnýz.<br>
 	<b>Adým 2: </b>Ýstemin öncelik durumunu  "<span style="background-color:yellow" > Normal<input type="radio" name="x" value="s" checked> Acil<input type="radio" name="x" > </span>" arasýndan seçiniz. Uygun seçim kutusunu iþaretleyiniz.<br>
 	<b>Adým 3: </b>Onaylayan (doktor veya cerrah) ismini <nobr>"<span style="background-color:yellow" > Onaylayan <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alanýna girmelidir.<br>
 	<b>Adým 4: </b>Onaylayan (doktor veya cerrah) þifresini <nobr>"<span style="background-color:yellow" > Þifre: <input type="text" name="c" size=15 maxlength=10> </span>"</nobr> alanýna girmelidir.<br>
 	<b>Adým 5: </b>Ýstem listesini göndermek için  <input type="button" value="Bu istem listesini eczaneye gönder"> düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Ýstem listesini göndermeyi iptal etmeye karar verir iseniz, "<span style="background-color:yellow" > Geri git ve listeyi düzenle </span>" baðlantýsýný týklayýnýz.
</ul>
	<?php endif ?>

<?php endif ?>
<!-- ++++++++++++++++++++++++++++++++++ archive ++++++++Çeviren Op. Dr. Bülent Potur ++++++++++++++ -->
<?php if($src=="arch") : ?>


<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Arþivdeki istem listelerini görmek istiyorum.</b></font>
<ul>  	<b>Adým 1: </b> Bölüm adý, kýsaltmasý, istem tarihi, öncelik ("acil") bilgilerinin tamamýný vaya ilk birkaç harfini 
				<nobr><span style="background-color:yellow" >" Aranacak anahtar sözcük: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> alanýna giriniz.<br>
 	<b>Adým 2: </b>Arama kategorilerine göre izleyen kutularý seçiniz veya seçimden çýkarýnýz:
<ul> 	
  	<input type="checkbox" name="d" checked> Tarih<br>
	<input type="checkbox" name="d" checked> Bölüm<br>
  	<input type="checkbox" name="d" checked> Öncelik<br>
	Ön seçimli olarak kutularýn üçü de seçilir ve arama her üç kategoride yapýlýr. Bir kategoriyi dýþarýda tutmak ister iseniz kutusuna týklayýp seçimden çýkarýnýz.
</ul> 	
<b>Adým 3: </b>Malzemeyi bulmak için <input type="button" value="Ara"> düðmesini týklayýnýz.<br>
 	<b>Adým 4: </b>Arama aranan anahtar sözcüðe yaklaþýk bir sonuç bulur ise bir liste görüntülenir. .<br>
 	<b>Adým 5: </b>Ýstemin liste düðmesini týklayýnýz <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>>. Ýstemin ayrýntýlarý görüntülenir<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Birkaç istem listelendi. Belirli bir istem nasýl görülür?</b></font>
<ul>  	
 	<b>Adým 1: </b>Ýstemin düðmesini týklayýnýz <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>>. Ýstemin ayrýntýlarý görüntülenir<br>
</ul>

<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Aramayý sonlandýrýp kapatmaya karar verir iseniz, <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.
</ul>


	<?php endif ?>
	
<?php if($src=="archshow") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ýstem listesindeki bir malzeme hakkýnda daha fazla bilgi görmek istiyorum. Ne yapmalýyým?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Malzemenin <img <?php echo createComIcon('../','info3.gif','0') ?>> düðmesini týklayýnýz.<br>
 	<b>Adým 2: </b>Ürün hakkýndaki tüm bilgileri gösteren bir pencere açýlýr.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Tekrar arþivdeki istemlerin listesini görmek istiyorum. Ne yapmalýyým?</b>
</font>
<ul>       	
 	<b>Adým 1: </b> <img <?php echo createLDImgSrc('../','back2.gif','0') ?>> düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Arþivdeki istem listesinde yeni bir arama yapmak istiyorum. Ne yapmalýyým?</b></font>
<ul>  	<b>Adým 1: </b> Bölüm adý, kýsaltmasý, istem tarihi, öncelik ("acil") bilgilerinin tamamýný vaya ilk birkaç harfini 
				<nobr><span style="background-color:yellow" >" Aranacak anahtar sözcük: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> alanýna giriniz.<br>
 	<b>Adým 2: </b>Arama kategorilerine göre izleyen kutularý seçiniz veya seçimden çýkarýnýz:
<ul> 	
  	<input type="checkbox" name="d" checked> Tarih<br>
	<input type="checkbox" name="d" checked> Bölüm<br>
  	<input type="checkbox" name="d" checked> Öncelik<br>
	Ön seçimli olarak kutularýn üçü de seçilir ve arama her üç kategoride yapýlýr. Bir kategoriyi dýþarýda tutmak ister iseniz kutusuna týklayýp seçimden çýkarýnýz.
</ul> 	
<b>Adým 3: </b>Malzemeyi bulmak için <input type="button" value="Ara"> düðmesini týklayýnýz.<br>
 	<b>Adým 4: </b>Arama aranan anahtar sözcüðe yaklaþýk bir sonuç bulur ise bir liste görüntülenir.<br>
</ul>
	<?php endif ?>	
	

<?php if($src=="db") : ?>
	<?php if($x1=="") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bilgi bankasýna bir ürün nasýl girilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Önce ürün hakkýnda bulunan tüm bilgileri ilgili giriþ alanlarýna giriniz.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ürünün bir resmini seçmek istiyorum. Nasýl yapýlýr?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>"<span style="background-color:yellow" > Resim dosyasý </span>" alanýndaki <input type="button" value="Araþtýr..."> düðmesini týklayýnýz. <br>
 	<b>Adým 2: </b>Bir doaya seçmek için küçük bir pencere açýlýr. Ýstediðiniz resim dosyasýný seçiniz ve "Tamam" ý týklayýnýz.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bulunan tüm ürün bilgisini girmeyi bitirdim. Nasýl kayýt edilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b> <input type="button" value="Kaydet"> düðmesini týklayýnýýz.<br>
</ul>
	<?php endif ?>	
	<?php if($x1=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir ürün bilgi bankasýna nasýl girilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b><input type="button" value="Yeni ürün"> düðmesini týklayýnýz.<br>
 	<b>Adým 2: </b>Giriþ formu görüntülenir.<br>
 	<b>Adým 3: </b>Yeni ürünüb bilgilerini giriniz.<br>
 	<b>Adým 4: </b>Bilgiyi kayýt etmek için  <input type="button" value="Kaydet"> düðmesini týklayýnýz.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Görüntülenen ürünün bilgisini düzenlemek istiyorum. Nasýl yapýlýr?</b>
</font>
<ul>       	
 	<b>Adým 1: </b> <input type="button" value="Güncelle veya düzenle"> düðmesini týklayýnýz.<br>
 	<b>Adým 2: </b>Ürün bilgisi düzenleme formuna otomatik olarak girilir.<br>
 	<b>Adým 3: </b>Bilgiyi düzenleyiniz.<br>
 	<b>Adým 4: </b>Yeni bilgiyi kayýt etmek için  <input type="button" value="Kaydet"> düðmesini týklayýnýz.<br>
</ul>
	
	<?php endif ?>	
<?php endif ?>	
</form>

