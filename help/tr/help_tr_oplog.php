<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
OR Logbook - 
<?php
if($src=="create")
{
	switch($x1)
	{
	case "": print "Yeni bir kütük belgesine baþla";
						break;
	case "fresh": print "Yeni bir kütük belgesine baþla";
						break;
	case "get": print  "";
						break;
	case "logmain": print "Belgelenmiþ bir ameliyatýn kütük girdilerini düzenle";
						break;
	default: print "Yeni bir ameliyat kütüðü";	
	}
}
if($src=="time")
{
	print "Belgelendiriliyor ";
	switch($x1)
	{
	case "entry_out": print "giriþ ve çýkýþ zamanlarý";
						break;
	case "cut_close": print "kesi ve sütür zamanlarý";
						break;
	case "wait_time": print "boþ (bekleme) zamanlarý";
						break;
	case "bandage_time": print "alçý atel zamanlarý";
						break;
	case "repos_time": print "repozisyon zamanlarý";
	}
}
if($src=="person")
{
	print "Belgelendiriliyor ";
	switch($x1)
	{
	case "operator":$person="bir cerrah"; 
						break;
	case "assist":$person="bir asistan cerrah"; 
						break;
	case "scrub": $person="bir ameliyat hemþiresi";
						break;
	case "rotating":$person="bir alet hemþiresi"; 
						break;
	case "ana": $person="bir anestezist";
	}
	print $person;
}
if($src=="search")
{
	switch($x1)
	{
	case "search": print "Belirli bir belge seçiliyor";
						break;
	case "": print "Bir ameliyatýn kütük belgesini arama";
						break;
	case "get": print  "Hastanýn ameliyatýnýn kütük belgesi";
						break;
	case "fresh": print "Bir ameliyatýn kütük belgesini arama";
	}
}
if($src=="arch")
{
	print "Arþiv";	
	/*switch($x1)
	{
	case "dummy": print "Arþiv";
						break;
	case "": print "Arþiv";
						break;
	case "?": print "Arþiv";
						break;
	case "search": print  "Arþiv arama sonuçlarý listesi";
						break;
	case "select": print "Hastanýn belgesi";
	}*/
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="person") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hýzlý seçim listesi ile <?php echo $person ?> nasýl girilir?</b>
</font>
<ul>       	
 	<b>Uyarý: </b>Eðer <?php echo $person ?> önceki ameliyatta seçildi ise, ismi hýzlý seçim listesinde listelenir.<p>
 	<b>Adým 1: </b>Önce görevinin "Ameliyathane görevi" seçim kutusundan doðru olarak seçilip seçilmediðini kontrol ediniz. Eðer seçilmemiþse ameliyathane görevini seçiniz veya düzeltiniz.<br>
 	<b>Asým 2: </b> <?php echo $person ?> nýn soyad veya ad veya <nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Bu kiþiyi <?php echo $person ?>...olarak kaydediniz </span>"</nobr> baðlantýsýna týklayýnýz.
	Cerrah otomatik olarak "güncel girdiler" listesine eklenecektir. <p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<?php echo ucfirst($person) ?> hýzlý seçim listesinde görünmüyor. <?php echo $person ?> nasýl girilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b> <?php echo $person ?>'ýn soyad veya adýnýn tamamýný veya ilk birkaç harfini   "<span style="background-color:yellow" > Yeni bir  <?php echo substr($person,2) ?>...ara </span>" alanýna giriniz.<br>
 	<b>Adým 2: </b> <?php echo $person ?> 'ý aramaya baþlamak için  <input type="button" value="Tamam"> düðmesini týklayýnýz.<br>
 	<b>Adým 3: </b>Arama sonuçlarý listeler. Belgelendirmek istediðiniz  <?php echo $person ?> nin soyad veya ad vaya ilgili <nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Bu kiþiyi  <?php echo $person ?>...olarak gir  </span>"</nobr> baðlantýsýna týklayýnýz. 
</ul>


<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Listeden <?php echo $person ?> nasýl silinir?</b></font> 
<ul>       	
 	<b>Adým 1: </b>Kiþinin isminin saðýndaki  <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> simgesini týklayýnýz.<br>
 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Ýþim bitti. Kütüðe nasýl geri giderim?</b></font> 
<ul>       	
 	<b>Adým 1: </b>Siz  <?php echo $person ?> seçtikten sonra görünen <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> düðmesini týklayýnýz.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Ýptal etmeye karar verirseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düðmesini týklayýnýz.
</ul>
<?php endif ?>

<?php if($src=="time") : ?>
	<?php if($x1=="entry_out") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Giriþ ve çýkýþ zamanlarý nasýl belgelendirilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Giriþ zamanýný sol sütundaki  "<span style="background-color:yellow" > giriþ saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanýna giriniz.<br>
 	<b>Adým 2: </b>Çýkýþ zamanýný sað sütundaki "<span style="background-color:yellow" > çýkýþ saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanýna giriniz.<p>
<ul>       	
 	<b>Ýpucu: </b>Þu anki zamaný otomatik olarak girmek için  "n" veya "N" (Now=þimdi anlamýnda) giriniz.
</ul><br>
 	<b>Uyarý: </b>Bilgiyi kayýt etmeden önce birkaç giriþ ve çýkýþ saatini birden girebilirsiniz.<p>
</ul>

	<?php endif ?>
	<?php if($x1=="cut_close") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Kesi ve sütür saatleri nasýl belgelendirilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Kesi zamanýný sol sütundaki "<span style="background-color:yellow" > baþlama saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanýna giriniz.<br>
 	<b>Adým 2: </b>Sütür zamanýný sað sütundaki  "<span style="background-color:yellow" > bitiþ saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanýna giriniz.<p>
<ul>       	
 	<b>Ýpucu: </b>Þu anki zamaný otomatik olarak girmek için  "n" veya "N" (Now=þimdi anlamýnda) giriniz.
</ul><br>
 	<b>Uyarý: </b>Bilgiyi kayýt etmeden önce birkaç kesi ve sütür saatini birden girebilirsiniz..<p>
</ul>

	<?php endif ?>
	<?php if($x1=="wait_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Boþ (bekleme) zamanlarý nasýl belgelendirilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Baþlama saatini ilk sütundaki  "<span style="background-color:yellow" > baþlama saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanýna giriniz.<br>
 	<b>Adým 2: </b>Bitiþ saatini ikinci sütundaki  "<span style="background-color:yellow" > bitiþ saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanýna giriniz.<p>
<ul>       	
 	<b>Ýpucu: </b>Þu anki zamaný otomatik olarak girmek için  "n" veya "N" (Now=þimdi anlamýnda) giriniz.
</ul><br>
 	<b>Adým 3: </b>Sebebi üçüncü sütundaki (sebep) seçim kutusundan seçiniz.<p>
 	<b>Uyarý: </b>Bilgiyi kayýt etmeden önce birkaç baþlama, bitiþ saati ve sebepleri birden girebilirsiniz.<p>
</ul>

	<?php endif ?>
	<?php if($x1=="bandage_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Alçý ve atel zamanlarý nasýl belgelendirilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Baþlama saatini ilk sütundaki  "<span style="background-color:yellow" > baþlama saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanýna giriniz.<br>
 	<b>Adým 2: </b>Bitiþ saatini ikinci sütundaki  "<span style="background-color:yellow" > bitiþ saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanýna giriniz.<p>
<ul>       	
 	<b>Ýpucu: </b>Þu anki zamaný otomatik olarak girmek için  "n" veya "N" (Now=þimdi anlamýnda) giriniz.
</ul><br>
 	<b>Uyarý: </b>Bilgiyi kayýt etmeden önce birkaç baþlama, bitiþ saati birden girebilirsiniz.<p>
</ul>

	<?php endif ?>
	<?php if($x1=="repos_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Repozisyon zamanlarý nasýl belgelendirilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Baþlama saatini ilk sütundaki  "<span style="background-color:yellow" > baþlama saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanýna giriniz.<br>
 	<b>Adým 2: </b>Bitiþ saatini ikinci sütundaki  "<span style="background-color:yellow" > bitiþ saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanýna giriniz.<p>
<ul>       	
 	<b>Ýpucu: </b>Þu anki zamaný otomatik olarak girmek için  "n" veya "N" (Now=þimdi anlamýnda) giriniz.
</ul><br>
 	<b>Uyarý: </b>Bilgiyi kayýt etmeden önce birkaç baþlama, bitiþ saati birden girebilirsiniz.<p>
</ul>

	<?php endif ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bilgi nasýl kayýt edilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Bilgiyi kayýt etmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz.<br>
 	<b>Adým 2: </b>Ýþiniz bitti ise, pencereyi kapatýp kütüðe geri dönmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Girilenleri silmek istiyorum fakat "Yeni baþtan" düðmesi çalýþmýyor görünüyor. Ne yapmalýyým?</b></font> 
<ul>       	
 	<b>Uyarý: </b>"Yeni baþtan" düðmesi týklandýðýnda yalnýzca kayýt edilmemiþ girdileri siler. Daha önceden kayýt edilmiþ girdileri silmek ister iseniz þu yönergeyi izleyiniz:<p>
 	<b>Adým 1: </b>Silmek istediðiniz zamanýn giriþ alanýný týklayýnýz.<br>
 	<b>Adým 2: </b>Zamaný el ile klavyedeki "sil" veya "geri" tuþlarýný kullanarak siliniz.<br>
 	<b>Adým 3: </b>Deðiþiklikleri kayýt etmek için  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Ýptal etmeye karar verir iseniz  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düðmesini týklayýnýz.
</ul>
<?php endif ?>


<?php if($src=="create") : ?>
	<?php if($x1=="logmain") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyatýn kütük kayýdý nasýl düzenlenir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Hastanýn kütük girdisinin ilgili  <img <?php echo createComIcon('../','dwnarrowgrnlrg.gif','0') ?>>  düðmesini týklayýnýz.<br>
 	<b>Adým 2: </b>Hastanýn kütük kayýtlarý editör çerçeveye kopyalanýr. Burada kayýtlarý bir ameliyatý belgelendirme yönergelerini izleyerek düzenleyebilirsiniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hastanýn belge klasörü nasýl açýlýr?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Hasta numarasýnýn solundaki  <img <?php echo createComIcon('../','info3.gif','0') ?>> düðmesini týklayýnýz.<br>
 	<b>Adým 2: </b>Hastanýn belge klasörü açýlýr.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Baþka bölüm ve/veya ameliyathaneye nasýl deðiþtirilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Seçim kutusundan bölümü seçiniz 
				<select name="dept" size=1>
				<?php
$Or2Dept=get_meta_tags("../global_conf/resolve_or2ordept.pid");
					$opabt=get_meta_tags("../global_conf/$lang/op_tag_dept.pid");

					while(list($x,$v)=each($opabt))
					{
						if($x=="anaesth") continue;
						print'
					<option value="'.$x.'"';
						if ($dept==$x) print " seçildi";
						print '> '.$v.'</option>';
					}
				?>
					
				</select>.
<br>
 	<b>Adým 2: </b>Seçim kutusundan ameliyathaneyi seçiniz <select name="saal" size=1 >
				<?php
while(list($x,$v)=each($Or2Dept))
					{
						print'
					<option value="'.$x.'"';
						if ($saal==$x) print " seçildi";
						print '> '.$x.'</option>';
					}
				?>
				</select>.
<br>
 	<b>Adým 3: </b>Baþka ameliyathane ve/veya bölüme deðiþtirmek için  <input type="button" value="Deðiþtir"> düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Halen gösterilenin dýþýnda belirli bir günün kütük kayýtlarý nasýl görüntülenir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Önceki gün(günler) in kütük girdilerini göstermek için tablonun üst sol köþesindeki  "<span style="background-color:yellow" > Önceki gün </span>" baðlantýsýný týklayýnýz.<br>
	Ýstenilen günün kütük girdileri görüntülenene deðin gerektiði kadar týklayýnýz.<br>
 	<b>Adým 2: </b>Sonraki gün(günler) in kütük girdilerini göstermek için tablonun üst sað köþesindeki  "<span style="background-color:yellow" > Sonraki gün </span>" baðlantýsýný týklayýnýz.<br>
	Ýstenilen günün kütük girdileri görüntülenene deðin gerektiði kadar týklayýnýz.<br>
</ul>

<hr>

	<?php endif ?>
	
	<?php if($x2=="material") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyatta kullanýlan malzeme nasýl belgelendirilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Malzemenin numarasýný "<span style="background-color:yellow" > Malzeme no.: </span>" alanýna yazýnýz.<p>
	<b>Diðer seçenekler: </b>
	<ul type=disc>  	
	<li>Malzemenin adý, ürün tanýmý, jenerik lisans numarasý, sipariþ numarasý bilgisinin ya tamamýný ya da ilk birkaç harfini  "<span style="background-color:yellow" > Malzeme no.: </span>" alanýna yazýnýz.
	<li>Malzemenin barkodunu barkod okuyucuya okutunuz.
	</ul><br> 
 	<b>Adým 2: </b>Ürünü aramak için  <input type="button" value="Tamam"> düðmesini týklayýnýz veya klavyede  "enter" tuþuna basýnýz.<p> 
<ul>       	
 	<b>Uyarý: </b>Eðer arama bir sonuç bulur ise, malzemenin bilgisi belgeye derhal eklenir.<p> 
 	<b>Uyarý: </b>Arama birkaç sonuç bulur ise, bir liste görüntülenir. Malzemeyi belgeye eklemek için malzemenin adýný, veya numarasýný, veya  <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> düðmesini týklayýnýz.<p> 
	</ul>
 	<b>Adým 3: </b>Eðer malzeme belgeye eklendi ise, eðer gerekir ise  "<span style="background-color:yellow" > parça sayýsý.</span>" alanýndaki bilgiyi deðiþtirebilirsiniz.<p> 
<ul>       	
 	<b>Uyarý: </b>"Parça sayýsý" alanýndaki girdiyi deðiþtirdiðiniz zaman "Kaydet" ve "Yeni baþtan" düðmeleri belirir.<p> 
	</ul>
 	<b>Adým 4: </b>Eðer "Parça sayýsý" alanýndaki girdiyi deðiþtirdi iseniz, deðiþiklikleri kayýt etmek için  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Listeden bir malzeme nasýl silinir?</b>
</font>
<ul> 
 	<b>Adým 1: </b>Ýlgili malzemenin <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> simgesini týklayýnýz.<br> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Malzeme bulunmadý. Bir malzemenin bilgisi nasýl el ile (zorla) girilir?</b>
</font>
<ul> 
 	<b>Adým 1: </b> "<span style="background-color:yellow" > <img <?php echo createComIcon('../','accessrights.gif','0') ?>> Malzemeyi el ile girmek için burayý týklayýnýz. </span>" baðlantýsýný týklayýnýz.<br> 
 	<b>Adým 2: </b>Malzeme bilgisini ilgili alanlara el ile giriniz.<p> 
 	<b>Adým 3: </b>Malzemenin bilgisini belgeye eklemek için  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Ýptal etmeye karar verirseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düðmesini týklayýnýz.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ana kütük geri nasýl görüntülenir?</b>
</font>
<ul> 
 	<b>Adým 1: </b> "<span style="background-color:yellow" > <img <?php echo createComIcon('../','manfldr.gif','0') ?>> Kütük kayýdýný göster. </span>" baðlantýsýný týklayýnýz.<br> 
</ul>
<hr>
	<?php endif ?>

	<?php if(($x1=="")||($x1=="fresh")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir ameliyatýn kütük belgesine nasýl baþlanýr?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Önce hastayý bulunuz. Hastanýn numarasýný "<span style="background-color:yellow" > Hasta no: </span>" alanýna yazýnýz.<p>
	<b>Diðer seçenekler: </b>
	<ul type=disc>  	
	<li>Hastanýn soyad veya adýnýn tamamýný veya ilk birkaç harfini  "<span style="background-color:yellow" > Soyad, Ad </span>" alanýna giriniz.
	<li>Hastanýn doðum tarihinin tamamýný veya ilk birkaç rakamýný  "<span style="background-color:yellow" > Doðum tarihi </span>" alanýna giriniz.
	</ul>
 	<b>Adým 2: </b>Hastayý aramaya baþlamak için  <input type="button" value="Hastayý ara"> düðmesini týklayýnýz.<p> 
<ul>       	
 	<b>Uyarý: </b>Eðer arama bir sonuç bulur ise, hastanýn temel bilgileri ilgili alanlara hemen girilir.<p> 
 	<b>Uyarý: </b>Arama birkaç sonuç bulur ise, bir liste görülür. Belgelendirmek için hastanýn soyadý veya adýný týklayýnýz.<p> 
	</ul>
 	<b>Adým 3: </b>Daha fazla bilgi için  <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> düðmesini tekrar týklayýnýz.<p> 

</ul>

	<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyat için taný nasýl girilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Tanýyý "<span style="background-color:yellow" > Taný: </span>" alanýna yazýnýz.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Cerrah bilgisi nasýl girilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>"<span style="background-color:yellow" > Cerrah </span>" baðlantýsýný týklayýnýz.<br>
 	<b>Adým 2: </b>Cerrahýn bilgisini girmek için bir pencere açýlýr. <br>
 	<b>Adým 3: </b>Penceredeki yönergeleri izleyiniz veya daha fazla bilgi için pencere içerisindeki "Yardým" düðmesini týklayýnýz. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Asistan cerrah bilgisi nasýl girilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b> "<span style="background-color:yellow" > Asistan </span>" baðlantýsýný týklayýnýz.<br>
 	<b>Adým 2: </b>Asistan cerrahýn bilgilerini girmek için bir pencere açýlýr. <br>
 	<b>Adým 3: </b>Penceredeki yönergeleri izleyiniz veya daha fazla bilgi için pencere içerisindeki "Yardým" düðmesini týklayýnýz. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyat hemþiresi bilgileri nasýl girilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b> "<span style="background-color:yellow" > Ameliyat hemþiresi </span>" baðlantýsýný týklayýnýz.<br>
 	<b>Adým 2: </b>Ameliyat hemþiresi bilgilerini girmek için bir pencere açýlýr. <br>
 	<b>Adým 3: </b>Penceredeki yönergeleri izleyiniz veya daha fazla bilgi için pencere içerisindeki "Yardým" düðmesini týklayýnýz.  <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Alet hemþiresi bilgileri nasýl girilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b> "<span style="background-color:yellow" > Alet hemþiresi </span>" baðlantýsýný týklayýnýz.<br>
 	<b>Adým 2: </b>Alet hemþiresi bilgilerini girmek için bir pencere açýlýr. <br>
 	<b>Adým 3: </b>Penceredeki yönergeleri izleyiniz veya daha fazla bilgi için pencere içerisindeki "Yardým" düðmesini týklayýnýz.  <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyatta kullanýlan anestezi tipi nasýl girilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>anestezi tipini  "<span style="background-color:yellow" > Anestezi <select name="a">
                                                                     	<option > ITA</option>
                                                                     	<option > Plexus</option>
                                                                     	<option > ITA-Jet</option>
                                                                     	<option > ITA-Mask</option>
                                                                     	<option > LA</option>
                                                                     	<option > DS</option>
                                                                     	<option > AS</option>
                                                                     </select> </span>" alanýndan seçiniz.<p>
	<ul type=disc>       	
 	<li><b>ITA: </b>Ýntra-trakeal anestezi<br>
 	<li><b>LA: </b>Lokal anestezi<br>
 	<li><b>AS: </b>Analjezik-sedasyon<br>
 	<li><b>DS: </b>AS ye eþdeðer<br>
 	<li><b>Plexus: </b>Pleksus bloðu lokal anestezi<br>
	</ul>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Anastezist bilgileri nasýl girilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b> "<span style="background-color:yellow" > Anestezist </span>" baðlantýsýný týklayýnýz.<br>
 	<b>Adým 2: </b>Anestezist bilgilerini girmek için bir pencere açýlýr. <br>
 	<b>Adým 3: </b>Penceredeki yönergeleri izleyiniz veya daha fazla bilgi için pencere içerisindeki "Yardým" düðmesini týklayýnýz. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Giriþ, kesi, sütür ve çýkýþ zamanlarý doðrudan ilgili alanlara nasýl girilir?</b>
</font>
<ul>       	
 	<b>Giriþ zamaný: </b>Giriþ zamanýný  "<span style="background-color:yellow" > Giriþ:<input type="text" name="t" size=5 maxlength=5> </span>" alanýna giriniz.<br>
 	<b>Kesi zamaný: </b>Kesi zamanýný "<span style="background-color:yellow" > Kesi: <input type="text" name="t" size=5 maxlength=5> </span>" alanýna giriniz.<br>
 	<b>Sütür zamaný: </b>Sütür zamanýný "<span style="background-color:yellow" > Sütür: <input type="text" name="t" size=5 maxlength=5> </span>" alanýna giriniz.<br>
 	<b>Çýkýþ zamaný: </b>Çýkýþ zamanýný "<span style="background-color:yellow" > Çýkýþ: <input type="text" name="t" size=5 maxlength=5> </span>" alanýna giriniz.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Birkaç zaman bilgisi hep bir arada nasýl girilir?</b>
</font>
<ul> <b>Adým 1: </b><p>    	
 	<b>Giriþ/Çýkýþ zamaný: </b>
 	Sol alt köþede bulunan  "<span style="background-color:yellow" > Giriþ/Çýkýþ <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" baðlantýsýný týklayýnýz.<p>
 	<b>Kesi/Sütür zamaný:</b>
 	Sol alt köþede bulunan  "<span style="background-color:yellow" > Kesi/Sütür <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" baðlantýsýný týklayýnýz.<p>
 	<b>Boþ zaman: </b>
 	Sol alt köþede bulunan "<span style="background-color:yellow" > Boþ zaman <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" baðlantýsýný týklayýnýz.<p>
 	<b>Alçý/Atel zamaný:</b>
 	Sol alt köþede bulunan "<span style="background-color:yellow" > Alçý/Atel <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" baðlantýsýný týklayýnýz.<p>
 	<b>Repozisyon zamaný: </b>
 	Sol alt köþede bulunan "<span style="background-color:yellow" > Repozisyon <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" baðlantýsýný týklayýnýz.<p>
 	<b>Adým 2: </b>Zaman bilgilerini girmek için bir pencere açýlýr. <br>
 	<b>Adým 3: </b>Penceredeki yönergeleri izleyiniz veya daha fazla bilgi için pencere içerisindeki "Yardým" düðmesini týklayýnýz.  <br>
	</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Grafik zaman çizelgesine zaman bilgisi nasýl girilir?</b>
</font>
<ul> <b>Adým 1: </b>Fare iþaretçisini zaman çizelgesinde ilgili zaman bilgisi için seçilen zaman üzerine götürünüz (Örneðin Alçý/Atel).<br>
 	<b>Adým 2: </b>Seçilen zamana karþýlýk gelen zaman çizelgesine týklayýnýz.<p>
<b>Uyarý:</b> Ýlk girdiðiniz baþlama zamaný, ikinci girdiðiniz bitiþ zamaný, üçüncü girdiðiniz ikinci baþlama zamaný vs. olur.
	</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Tedavi veya ameliyat bilgisi nasýl girilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Tedavi veya ameliyat bilgisini "<span style="background-color:yellow" > Tedavi/Ameliyat: </span>" alanýna giriniz.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Sonuçlar, gözlem, ek bilgiler nasýl girilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b> "<span style="background-color:yellow" > Sonuçlar: </span>" alanýna yazýnýz.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Kütük belgesi nasýl kayýt edilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b> <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir kütük belgesine nasýl baþlanýr?</b>
</font>
<ul>       	
 	<b>Adým 1: </b> <img <?php echo createLDImgSrc('../','newpat2.gif','0') ?>> düðmesini týklayýnýz<br>
 	<b>Adým 2: </b>Daha fazla bilgi için  <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> düðmesini tekrar týklayýnýz.<br>
	</ul>
	
<b>Uyarý</b>
<ul> Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.
</ul>
	<?php endif ?>

<?php endif ?>



<?php if($src=="search") : ?>
	<?php if(($x1=="fresh")||($x1=="")) : ?>


<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Belirli bir hastanýn belgesi nasýl araþtýrýlýr?</b>
</font>
<ul>       	
 	<b>Adým  1: </b>Hastanýn soyad, ad, veya doðum tarihi bilgilerinin ya tamamýný  veya ilk birkaç harfini  "<span style="background-color:yellow" > Anahtar sözcük: <input type="text" name="m" size=20 maxlength=20> </span>" alanýna giriniz. <br>
 	<b>Adým 2: </b>Hastanýn belgesini aramaya baþlamak için  <input type="button" value="Ara"> düðmesini týklayýnýz.<p> 
<ul>       	
 	<b>Uyarý: </b>Arama anahtar sözcüðün tam karþýlýðýný bulur ise, hastanýn belgesi derhal görüntülenir.<p> 
 	<b>Uyarý: </b>Eðer arama anahtar sözcüðe sadece yaklaþýk bir sözcük bulur ise bir liste görüntülenir. 
	Belgesini görüntülemek için hastanýn soyadýný týklayýnýz.<p> 
	</ul>
</ul>
	<?php endif ?>
<?php if(($x1=="search")&&($x3!="1")) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Belirli belge görüntülenmek üzere nasýl seçilir?</b>
</font>
<ul>       	
 	<b>Uyarý: </b> Belgesini görüntülemek için hastanýn soyadýný týklayýz.<p> 
</ul>

	<?php endif ?>
<?php if(($x1=="get")||($x3=="1")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Görüntülenen kütük belgesi nasýl düzenlenir veya güncellenir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Düzenleme moduna geçmek için ameliyat tarihinin altýndaki en sol sütunda bulunan  <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> düðmesini týklayýnýz.<br>
 	<b>Adým 2: </b>Düzenleme moduna geçtiðinizde belge düzenleme ilgili daha fazla yardýma gereksiniminiz olur ise "Yardým" düðmesini týklayýnýz.<p> 
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hastanýn belge klasörü nasýl açýlýr?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Hastanýn protokol numarasýnýn solundaki <img <?php echo createComIcon('../','info3.gif','0') ?>> düðmesini týklayýnýz.<br>
 	<b>Adým 2: </b>Hastanýn belge klasörü açýlýr. Daha fazla bilgiye gereksiniminiz olur ise pencere içerisindeki "Yardým" düðmesini týklayýnýz.<p> 
	</ul>

<?php endif ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Aramaya nasýl devam edilir?</b>
</font>
<ul>       	
 	<b>Adým  1: </b>Hastanýn soyad, ad, veya doðum tarihi bilgilerinin ya tamamýný  veya ilk birkaç harfini  "<span style="background-color:yellow" > Anahtar sözcük: <input type="text" name="m" size=20 maxlength=20> </span>" alanýna giriniz. <br>
 	<b>Adým 2: </b>Hastanýn belgesini aramaya baþlamak için  <input type="button" value="Ara"> düðmesini týklayýnýz.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Kapatmaya karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.
</ul>
<?php endif ?>

<?php if($src=="arch") : ?>
	<?php if($x2=="1") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý: Son kütük girdileri</b></font> 
<ul>  Arþive her giriþinizde, son tütüðe alýnmýþ amaliyatlar derhal görüntülenir.
</ul>
	<?php endif ?>
	<?php if(($x3=="")&&($x1!="0")) : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Bu tarihte hiç ameliyat yapýlmadý.</b></font> 
<ul>       	
Seçenekler kutusundan "Seçenekler" i týklayýnýz.<br>
Arama moduna geçmek için "Ara" yý týklayýnýz.</ul>
	
	<?php endif ?>
	



<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Bir baþka günün arþivlenmiþ kütük girdilerini görmek istiyorum.</b></font>
<ul> <b>Önceki günü görüntülemek için : </b>Üst sol sütundaki  "<span style="background-color:yellow" > Önceki gün </span>" baðlantýsýný týklayýnýz. 
				Bu baðlantýyý istenilen gün görüntülenene deðin ne kadar gerekir ise o kadar týklayýnýz.<p>
 <b>Sonraki günü görüntülemek için: </b>Üst sað sütundaki "<span style="background-color:yellow" > Sonraki gün </span>" baðlantýsýný týklayýnýz. 
				Ýstenilen gün görüntülenene deðin bu baðlantýyý ne kadar gerekir ise o kadar týklayýnýz.<br>		
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Bir baþka ameliyathane veya bölümün arþivlenmiþ kütük bilgilerini görmek istiyorum.</b></font>
<ul> <b>Adým 1: </b>Bölümü seçim kutusundan seçiniz <nobr>"<span style="background-color:yellow" > Bötüm veya ameliyathaneyi deðiþtiriniz <select name="o">
                                                                                                                                         	<option > Örnek bölüm 1</option>
                                                                                                                                         	<option > Örnek bölüm 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>".</nobr> <br>																  
	<b>Adým 2: </b>Veya ameliyathaneyi seçim kutusundan seçiniz <nobr>"<span style="background-color:yellow" > <select name="o">
                                                                                                                                         	<option > Örnek ameliyathane 1</option>
                                                                                                                                         	<option > Örnek ameliyathane 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>".</nobr> <br> 						  																																		  
		<b>Adým 3: </b>Yeni bölüm veya ameliyathaneye deðiþtirmek için Click the button <input type="button" value="Deðiþtir">  düðmesini týklayýnýz.<br>
</ul>
<?php if(($x3!="")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Görüntülenen kütük belgesi nasýl güncellenir veya düzenlenir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Düzenleme moduna geçmek için ameliyat tarihinin altýnda en sol sütundaki <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> düðmesini týklayýnýz.<br>
 	<b>Adým 2: </b>Düzenleme moduna geçtikten sonra daha fazla bilgiye gereksinim duyar iseniz "Yardým" düðmesini týklayýnýz.<p> 
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hastanýn veri klasörü nasýl açýlýr?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Hastanýn protokol numarasýnýn solundaki  <img <?php echo createComIcon('../','info3.gif','0') ?>> düðmesini týklayýnýz.<br>
 	<b>Adým 2: </b>Hastanýn bilgi klasörü açýlýr. Daha fazla açýklamaya gereksinim duyar iseniz "Yardým" düðmesini týklayýnýz.<p> 
	</ul>
	<?php endif ?>
	
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Ýptal etmeye karar verir iseniz  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düðmesini týklayýnýz.
</ul>


	<?php endif ?>


</form>

