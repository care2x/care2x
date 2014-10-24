<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
Biyokimya Laboratuvarý - 
<?php
if($src=="create")
{
	switch($x1)
	{
	case "": print "Yeni kütük belgesine baþla";
						break;
	case "fresh": print "Yeni kütük belgesine baþla";
						break;
	case "get": print  "";
						break;
	case "logmain": print "Belgeli bir ameliyatýn kütük girdilerini düzenle";
						break;
	default: print "Yeni bir ameliyat kütüðü";	
	}
}
if($src=="time")
{
	print "Belgelendiriliyor ";
	switch($x1)
	{
	case "entry_out": print "giriþ ve çýkýþ süresi";
						break;
	case "cut_close": print "kesi ve sütür süresi";
						break;
	case "wait_time": print "boþ (bekleme) süresi";
						break;
	case "bandage_time": print "alçý-bandaj süresi";
						break;
	case "repos_time": print "repozisyon süresi";
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
	case "rotating":$person="bir meydancý hemþire"; 
						break;
	case "ana": $person="bir anestezi uzmaný";
	}
	print $person;
}
if($src=="search")
{
	print "Bir hastayý ara";	
/*	switch($x1)
	{
	case "search": print "Belirli bir belgeyi seçme";
						break;
	case "": 
						break;
	case "get": print  "Hastanýn ameliyat kütük belgesi";
						break;
	case "fresh": print "Bir hastanýn ameliyat kütük belgesini arama";
	}
*/}
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
	case "search": print  "Arþiv arama sonuçlarýnýn listesi";
						break;
	case "select": print "Hastanýn belgesi";
	}*/
}
if($src=="input")
{
	print "Tetkik sonuçlarýný girme";	
	/*switch($x1)
	{
	case "dummy": print "Arþiv";
						break;
	case "": print "Arþiv";
						break;
	case "?": print "Arþiv";
						break;
	case "search": print  "Arþiv arama sonuçlarýnýn listesi ";
						break;
	case "select": print "Hastanýn belgesi";
	}*/
}
 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >
<?php if($src=="person") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hýzlý seçim listesi <?php echo $person ?> yolu ile nasýl girilirt?</b>
</font>
<ul>       	
 	<b>Uyarý: </b>Eðer kiþinin ismi önceki bir iþlemde seçildi ise <?php echo $person ?> ismi hýzlý listede görünür.<p>
 	<b>Adým 1: </b>Önce iþlevinin "Ameliyathane iþlevi" seçim kutusunda doðru olarak seçilip seçilmediðini kontrol ediniz, seçilmemiþ ise kiþinin ameliyathane iþlevini doðru olarak seçiniz.<br>
 	<b>Adým 2: </b> <?php echo $person ?>'ýn soyadýný, veya adýný, veya <nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> bu kiþiyi <?php echo $person ?>... </span>"</nobr> olarak kaydet baðlantýsýný týklayýnýz.
	Cerrah otomatik olarak "güncel kayýtlar"  listesine eklenecektir.<p>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<?php echo ucfirst($person) ?> hýzlý seçim listesinde görülmüyor. <?php echo $person ?>'yi nasýl kaydetmeli?</b>
</font>
<ul>       	
 	<b>Adým 1: </b><?php echo $person ?>'in soyad ad bilgilerinin ya tamamýný ya da bir kýsmýný  "<span style="background-color:yellow" > Yeni ara <?php echo substr($person,2) ?>... </span>" alanýna giriniz.<br>
 	<b>Adým 2: </b> <input type="button" value="Tamam"> düðmesini týklayarak  <?php echo $person ?>'yi aramaya baþlayýnýz.<br>
 	<b>Adým 3: </b>Arama sonuçlarý listeler. Belgelendirmek istediðiniz <?php echo $person ?> 'in  ilgili  soyad, ad, veya <nobr>"<span style="background-color:yellow" > <img <?php echo createComIcon('../','uparrowgrnlrg.gif','0') ?>> Bu kiþiyi olarak kaydet <?php echo $person ?>... </span>"</nobr> baðlantýsýna týklayýnýz. 
</ul>


<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Listeden  <?php echo $person ?> nasýl silinir?</b></font> 
<ul>       	
 	<b>Adým 1: </b>Kiþinin isminin saðýndaki  <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> simgesini týklayýnýz.<br>
 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Ýþim bitti. Kütük kaydýna nasýl geri giderim?</b></font> 
<ul>       	
 	<b>Adým 1: </b> <?php echo $person ?>'yi seçtikten sonra görünen <img <?php echo createLDImgSrc('../','close2.gif','0') ?> align="absmiddle"> düðmesini týklayýnýz.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Ýptal etmeye karar verir iseniz  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düðmesini týklayýnýz.
</ul>
<?php endif ?>

<?php if($src=="time") : ?>
	<?php if($x1=="entry_out") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Giriþ ve çýkýþ zamanlarý nasýl belgelendirilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Giriþ saatini sol sütundaki "<span style="background-color:yellow" > giriþ saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanýna giriniz.<br>
 	<b>Adým 2: </b>Çýkýþ saatini sað sütundaki "<span style="background-color:yellow" > çýkýþ saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanýna giriniz.<p>
<ul>       	
 	<b>Ýpucu: </b>Giriþ alanýna þu aný otomatik olarak girmek için  "n" veya "N" (Now=Þimdi anlamýnda) giriniz.
</ul><br>
 	<b>Uyarý: </b>Bilgiyi kayýt etmeden önce birkaç giriþ ve çýkýþ zamanýný ayný anda kayýt edebilirsiniz.<p>
</ul>

	<?php endif ?>
	<?php if($x1=="cut_close") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Kesi ve sütür süreleri nasýl belgelendirilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Kesi yapýldýðý aný sol sütundaki "<span style="background-color:yellow" > baþlama saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanýna giriniz.<br>
 	<b>Adým 2: </b>Sütür anýný sað sütundaki "<span style="background-color:yellow" > bitiþ saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanýna giriniz.<p>
<ul>       	
 	<b>Ýpucu: </b>Giriþ alanýna þu aný otomatik olarak girmek için  "n" veya "N" (Now=Þimdi anlamýnda) giriniz.
</ul><br>
	<b>Uyarý: </b>Bilgiyi kayýt etmeden önce birkaç kesi ve sütür zamanýný ayný anda kayýt edebilirsiniz.<p>
</ul>
 	
	<?php endif ?>
	<?php if($x1=="wait_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Boþ (bekleme) süresi nasýl belgelendirilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Baþladýðý zamaný ilk sütundaki "<span style="background-color:yellow" > baþlama saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanýna giriniz.<br>
 	<b>Adým 2: </b>Bittiði zamaný ikinci sütundaki "<span style="background-color:yellow" > bitme saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanýna giriniz.<p>
<ul>       	
 	<b>Ýpucu: </b>Giriþ alanýna þu aný otomatik olarak girmek için  "n" veya "N" (Now=Þimdi anlamýnda) giriniz.
</ul><br>
	<b>Adým 3: </b>Üçüncü (sebep) sütunundan sebebi seçiniz.<p>
 	
 	<b>Uyarý: </b>Bilgiyi kayýt etmeden önce birkaç baþlama ve bitme saatini ve sebeplerini ayný anda kayýt edebilirsiniz.<p>
</ul>
 
	<?php endif ?>
	<?php if($x1=="bandage_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Alçý ve pansuman süreleri nasýl belgelendirilir?</b>
</font>
<ul>     
	<b>Adým 1: </b>Baþladýðý zamaný sol sütundaki "<span style="background-color:yellow" > baþlama saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanýna giriniz.<br>
 	<b>Adým 2: </b>Bittiði zamaný sað sütundaki "<span style="background-color:yellow" > bitme saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanýna giriniz.<p>
<ul>       	
 	<b>Ýpucu: </b>Giriþ alanýna þu aný otomatik olarak girmek için  "n" veya "N" (Now=Þimdi anlamýnda) giriniz.
</ul><br>
	
 	<b>Uyarý: </b>Bilgiyi kayýt etmeden önce birkaç baþlama ve bitme saatini ayný anda kayýt edebilirsiniz.<p>  	
 	
</ul>

	<?php endif ?>
	<?php if($x1=="repos_time") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Repozisyon süresi nasýl belgelendirilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Baþladýðý zamaný sol sütundaki "<span style="background-color:yellow" > baþlama saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanýna giriniz.<br>
 	<b>Adým 2: </b>Bittiði zamaný sað sütundaki "<span style="background-color:yellow" > bitme saati: <input type="text" name="d" size=5 maxlength=5> </span>" alanýna giriniz.<p>
<ul>       	
 	<b>Ýpucu: </b>Giriþ alanýna þu aný otomatik olarak girmek için  "n" veya "N" (Now=Þimdi anlamýnda) giriniz.
</ul><br>
 	<b>Uyarý: </b>Bilgiyi kayýt etmeden önce birkaç baþlama ve bitme saatini ayný anda kayýt edebilirsiniz.<p>  	
 	
</ul>

	<?php endif ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bilgi nasýl kayýt edilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Bilgiyi kaydetmek için  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz<br>
 	<b>Adým 2: </b>Ýþiniz bitti ise, pencereyi kapatýp kayýt kütüðü sayfasýna geri dönmek için  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b> Girilenleri silmek istiyorum ama "Yeni baþtan" düðmesi çalýþmýyor gibi görünüyor. Ne yapmalýyým?</b></font> 
<ul>       	
 	<b>Uyarý: </b>"Yeni baþtan" düðmesi týklanýnca sadece henüz kayýt edilmemiþ girdiler silinir. Eðer daha önceden kayýt edilmiþ girdileri silmek isterseniz, þu yönergeyi izleyiniz:<p>
 	<b>Adým 1: </b>Silmek istediðiniz zamanýn giriþ alanýný týklayýnýz.<br>
 	<b>Adým 2: </b>Zamaný klavyeden el ile  "Del" veya "Backspace" tuþlarýný kullanarak siliniz.<br>
 	<b>Adým 3: </b>Deðiþiklikleri kayýt etmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz.<br>
 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Ýptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düðmesini týklayýnýz.
</ul>
<?php endif ?>


<?php if($src=="create") : ?>
	<?php if($x1=="logmain") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir ameliyatýn kütük kaydý nasýl düzenlenir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Hastanýn kütük kaydý ile ilgili <img src="../img/update3.gif" width=15 height=14 border=0> düðmesini týklayýnýz.<br>
 	<b>Adým 2: </b>Hastanýn kütük kayýtlarý bir düzenleyici penceresinde açýlýr. Kayýtlarý burada bir ameliyatý belgelendirme yönergelerini izleyerek düzenleyebilirsiniz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hastanýn belgeler klasörü nasýl açýlýr?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Hastanýn numarasýnýn solundaki  <img <?php echo createComIcon('../','info3.gif','0') ?>> düðmesini týklayýnýz.<br>
 	<b>Adým 2: </b>Hastanýn belgeler klasörü yeni bir pencerede açýlýr.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Baþka bir bölüm ve/veya ameliyathaneye nasýl deðiþtirilir?</b>
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
 	<b>Adým 3: </b>Diðer bölüm ve/veya ameliyathaneye deðiþtirmek için <input type="button" value="Change"> düðmesini týklayýnýz.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Þu anda görüntülenenin dýþýnda belirli bir güne ait kütük kayýtlarý nasýl görüntülenir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Daha önceki günlerin kütük kayýtlarýný görüntülemek için, tablonun sol üst köþesindeki  "<span style="background-color:yellow" > Önceki gün </span>" baðlantýsýný týklayýnýz.<br>
	Ýstediðiniz günün kütük girdileri görüntülenene deðin ne kadar gerekirse o kadar týklayýnýz.<br>
 	<b>Adým 2: </b>Sonraki günlerin kütük girdilerini görüntülemek için tablonun sað üst köþesindeki  "<span style="background-color:yellow" > Sonraki gün </span>" baðlantýsýný týklayýnýz.<br>
	Ýstediðiniz günün kaydýna ulaþana deðin ne kadar gerekir ise o kadar týklayýnýz .<br>
</ul>

<hr>

	<?php endif ?>
	
	<?php if($x2=="material") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyat için kullanýlmýþ bir malzeme nasýl belgelendirilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Malzemenin kalem numarasýný "<span style="background-color:yellow" > Kalem numarasý: </span>" alanýna yazýnýz.<p>
	<b>Diðer yollar: </b>
	<ul type=disc>  	
	<li>Bir malzemenin ismi, ürün tanýmý, jenerik, lisans numarasý veya sipariþ numarasý bilgisinin tamamýný veya bir kýsmýný  "<span style="background-color:yellow" > Kalem numarasý: </span>" alanýna giriniz.
	<li>Barkod okuyucu ile malzemenin barkodunu okutturunuz.
	</ul><br> 
 	<b>Adým 2: </b>Ürünü aramak için ya  <input type="button" value="Tamam"> düðmesini týklatýnýz veya klavyeden entere basýnýz.<p> 
<ul>       	
 	<b>Uyarý: </b>Eðer arama bir tek sonuç bulur ise, aramanýn sonucu doðrudan belgeye eklenir.<p> 
 	<b>Uyarý: </b>Eðer arama birkaç sonuç bulur ise , bir liste görüntülenir. Malzemeyi belgeye eklemek için, malzeme kaleminin  kaleminin numarasýna, malzemenin ismine veya  <img <?php echo createComIcon('../','bul_arrowgrnlrg.gif','0') ?>> düðmesine týklayýnýz.<p> 
	</ul>
 	<b>Adým 3: </b>Malzeme listeye eklendi ise, gerekirse girilenleri  "<span style="background-color:yellow" > parça sayýsý</span>" alanýndan deðiþtirebilirsiniz.<p> 
<ul>       	
 	<b>Uyarý: </b>"parça sayýsý" alanýndaki bilgiyi deðiþtirdiðinizde "Kaydet" ve "Yeni baþtan" düðmeleri görüntülenir.<p> 
	</ul>
 	<b>Adým 4: </b>"parça sayýsý" alanýndaki bilgiyi deðiþtirdi iseniz, deðiþiklikleri kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Listeden bir malzeme nasýl çýkarýlýr?</b>
</font>
<ul> 
 	<b>Adým 1: </b>Malzemenin ilgili <img <?php echo createComIcon('../','delete2.gif','0','absmiddle') ?>> düðmesine týklayýnýz.<br> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Malzeme bulunmadý. Bilgisi nasýl el ile (zorla) girilir?</b>
</font>
<ul> 
 	<b>Adým 1: </b> "<span style="background-color:yellow" > <img <?php echo createComIcon('../','accessrights.gif','0') ?>> Malzemeyi el ile girmek için, burayý týklayýnýz. </span>" baðlantýsýný týklayýnýz.<br> 
 	<b>Adým 2: </b>Malzemenin bilgisini ilgili alanlara el ile giriniz.<p> 
 	<b>Adým 3: </b>Malzemenin bilgisini belgeye eklemek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz.<p> 
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Ýptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düðmesini týklayýnýz.
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ana kayýt kütüðü geri tekrar nasýl görüntülenir?</b>
</font>
<ul> 
 	<b>Adým 1: </b> "<span style="background-color:yellow" > <img <?php echo createComIcon('../','manfldr.gif','0') ?>> Kayýt kütüðünü göster. </span>" baðlantýsýný týklayýnýz.<br> 
</ul>
<hr>
	<?php endif ?>

	<?php if(($x1=="")||($x1=="fresh")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir ameliyatý kütük belgesine nasýl baþlanýr?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Önce hastayý bulunuz. Hastanýn numarasýný "<span style="background-color:yellow" > Hasta no: </span>" alanýna yazýnýz.<p>
	<b>Diðer seçenekler: </b>
	<ul type=disc>  	
	<li>Hastanýn soyad veya adýnýn tamamýný ya da birkaç harfini  "<span style="background-color:yellow" > Soyad, Ad </span>" alanýna giriniz .
	<li>Hastanýn doðum tarihinin tamamýný ya da ilk birkaç rakamýný "<span style="background-color:yellow" > Doðum tarihi </span>" alanýna giriniz.
	</ul>
 	<b>Adým 2: </b>Hastayý aramaya baþlamak için  <input type="button" value="Hastayý ara"> düðmesini týklayýnýz.<p> 
<ul>       	
 	<b>Uyarý: </b>Arama bir sonuç bulur ise, hastanýn temel bilgileri hemen ilgili alanlara girilmiþ görüntülenir.<p> 
 	<b>Uyarý: </b>Arama birkaç sonuç bulur ise,  bir liste görüntülenir. Belgelendirmek üzere hastayý seçmek için hastanýn soyad veya adýna týklayýnýz.<p> 
	</ul>
 	<b>Adým 3: </b>Daha fazla bilgi için <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> düðmesini týklayýnýz.<p> 

</ul>

	<?php else : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyat için taný nasýl girilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Tanýyý  "<span style="background-color:yellow" > Taný: </span>" alanýna yazýnýz.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Cerrah bilgisi nasýl girilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b> "<span style="background-color:yellow" > Cerrah </span>" baðlantýsýný týklayýnýz.<br>
 	<b>Adým 2: </b>Cerrah bilgisi için bir pencere açýlýr. <br>
 	<b>Adým 3: </b>Pencere içindeki bilgileri izleyiniz ya da daha fazla bilgi için pencere içerisindeki "Yardým" düðmesini týklayýnýz. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Asistan cerrah bilgisi nasýl girilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>"<span style="background-color:yellow" > Asistan </span>" baðlantýsýný týklayýnýz.<br>
 	<b>Adým 2: </b>Asistan cerrah bilgisini girmek için bir pencere açýlýr. <br>
 	<b>Adým 3: </b>Penceredeki bilgileri izleyiniz ya da daha fazla bilgi için pencere içerisindeki "Yardým" düðmesini týklayýnýz. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyat hemþiresi bilgisi nasýl girilir?</b>
</font>
<ul>       	
 	
	<b>Adým 1: </b>"<span style="background-color:yellow" > Ameliyat hemþiresi </span>" baðlantýsýný týklayýnýz.<br>
 	<b>Adým 2: </b>Ameliyat hemþiresi bilgisini girmek için bir pencere açýlýr. <br>
 	<b>Adým 3: </b>Penceredeki bilgileri izleyiniz ya da daha fazla bilgi için pencere içerisindeki "Yardým" düðmesini týklayýnýz. <br>
	</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yardýmcý hemþire bilgisi nasýl girilir?</b>
</font>
<ul>       	
 	
	<b>Adým 1: </b>"<span style="background-color:yellow" > Yardýmcý hemþire </span>" baðlantýsýný týklayýnýz.<br>
 	<b>Adým 2: </b>Yardýmcý hemþire bilgisini girmek için bir pencere açýlýr. <br>
 	<b>Adým 3: </b>Penceredeki bilgileri izleyiniz ya da daha fazla bilgi için pencere içerisindeki "Yardým" düðmesini týklayýnýz. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyatta kullanýlan anestezi tipi nasýl girilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Anestezi tipini "<span style="background-color:yellow" > Anestezi <select name="a">
                                                                     	<option > ITA</option>
                                                                     	<option > Plexus</option>
                                                                     	<option > ITA-Jet</option>
                                                                     	<option > ITA-Mask</option>
                                                                     	<option > LA</option>
                                                                     	<option > DS</option>
                                                                     	<option > AS</option>
                                                                     </select> </span>" alanýndan seçiniz.<p>
	<ul type=disc>       	
 	<li><b>ITA: </b>Intra-tracheal anesthesia<br>
 	<li><b>LA: </b>Local anesthesia<br>
 	<li><b>AS: </b>Analgesic-sedation<br>
 	<li><b>DS: </b>Equivalent to AS<br>
 	<li><b>Plexus: </b>Nervus plexus local anesthesia<br>
	</ul>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Anestezist bilgisi nasýl girilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>"<span style="background-color:yellow" > Anestezist </span>" baðlantýsýný týklayýnýz.<br>
 	<b>Adým 2: </b>Anestezist bilgisini girmek için bir pencere açýlýr. <br>
 	<b>Adým 3: </b>Penceredeki bilgileri izleyiniz ya da daha fazla bilgi için pencere içerisindeki "Yardým" düðmesini týklayýnýz. <br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ameliyata giriþ, kesi, sütür ve çýkýþ zamanlarý ilgili alanlarýndan doðrudan nasýl girilir?</b>
</font>
<ul>       	
 	<b>Giriþ zamaný: </b>Zamaný "<span style="background-color:yellow" > Giriþ:<input type="text" name="t" size=5 maxlength=5> </span>" alanýna yazýnýz.<br>
 	<b>Kesi zamaný: </b>Zamaný "<span style="background-color:yellow" > Kesi: <input type="text" name="t" size=5 maxlength=5> </span>" alanýna yazýnýz.<br>
 	<b>Sütür zamaný: </b>Zamaný "<span style="background-color:yellow" > Sütür: <input type="text" name="t" size=5 maxlength=5> </span>" alanýna yazýnýz.<br>
 	<b>Çýkýþ zamaný: </b>Zamaný "<span style="background-color:yellow" > Çýkýþ: <input type="text" name="t" size=5 maxlength=5> </span>" alanýna yazýnýz.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Birkaç zaman bilgisi hepsi birden nasýl girilir?</b>
</font>
<ul> <b>Adým 1: </b><p>    	
 	<b>Giriþ/Çýkýþ zamaný: </b>
 	Sol alt köþedeki  "<span style="background-color:yellow" > Giriþ/Çýkýþ <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" baðlantýsýný týklayýnýz.<p>
 	<b>Kesi/Sütür zamaný:</b>
 	Sol alt köþedeki  "<span style="background-color:yellow" > Kesi/Sütür <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" baðlantýsýný týklayýnýz.<p>
 	<b>Boþ zaman: </b>
 	Sol alt köþedeki "<span style="background-color:yellow" > Boþ zaman <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" baðlantýsýný týklayýnýz.<p>
 	<b>Alçý/Atel zamaný:</b>
 	Sol alt köþedeki "<span style="background-color:yellow" > Alçý/Atel <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" baðlantýsýný týklayýnýz.<p>
 	<b>Repozisyon zamaný: </b>
 	Sol alt köþedeki "<span style="background-color:yellow" > Repozisyon <img <?php echo createComIcon('../','bul_arrowgrnsm.gif','0','absmiddle') ?>> </span>" baðlantýsýný týklayýnýz.<p>
 	<b>Adým 2: </b>Bilgi girmek için bir pencere açýlýr. <br>
 	<b>Adým 3: </b>Penceredeki bilgileri izleyiniz ya da daha fazla bilgi için pencere içerisindeki "Yardým" düðmesini týklayýnýz. <br>
	</ul>


<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Grafik zaman çizelgesine nasýl bilgi girilir?</b>
</font>
<ul> <b>Adým 1: </b>Fare iþaretçisini zaman cetvelinde ilgili zaman bilgisine (örneðin Alçý/Atel) karþýlýk gelen zaman bilgisine getiriniz.<br>
 	<b>Adým 2: </b>Seçilen zamandaki zaman cetveline týklayýnýz.<p>
<b>Uyarý:</b> Ýlk deðer baþlangýç zamaný, ikinci deðer bitiþ zamaný, üçüncü deðer ikinci baþlangýç zamaný vs. olur.
	</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Tedavi veya operasyon bilgisi nasýl girilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Tedavi veya operasyonu "<span style="background-color:yellow" > Tedavi/Operasyon: </span>" alanýna yazýnýz.<br>
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Sonuçlar, gözlem ve ek notlar nasýl girilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Bunlarý "<span style="background-color:yellow" > Sonuçlar: </span>" alanýna yazýnýz.<br>
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
 	<b>Adým 1: </b> <img <?php echo createLDImgSrc('../','newpat2.gif','0') ?>> düðmesini týklayýnýz.<br>
 	<b>Adým 2: </b>Daha fazla bilgi için <img <?php echo createLDImgSrc('../','hilfe-r.gif','0') ?>> düðmesini tekrar týklayýnýz.<br>
	</ul>
	
<b>Uyarý</b>
<ul> Kapatmaya karar verir iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.
</ul>
	<?php endif ?>

<?php endif ?>



<?php if($src=="search") : ?>
<?php if(($x2!="")&&($x2!="0")) : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Raporunu <?php if($x1=="edit") print "düzenlemek"; else print "görmek"; ?> istediðim belirli bir hasta nasýl seçilir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Raporunu <?php if($x1=="edit") print "düzenlemek"; else print "görmek"; ?> istediðiniz hastanýn ilgili &nbsp;<button><img <?php echo createComIcon('../','update2.gif','0') ?>> <font size=1>Lab raporu</font></button> düðmesini týklayýnýz.<p> 
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Aramaya nasýl devam edilir?</b>
</font>
	<?php endif ?>
	<?php if(($x2=="")||($x2=="0")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir hasta nasýl aranýr?</b>
</font>
	<?php endif ?>
	
	<ul>       	
 	<b>Adým 1: </b>Bir hastanýn soyad, veya  ad, veya  doðum tarihi bilgisinin ya tamamýný veya birkaç harfini  "<span style="background-color:yellow" > Aranacak anahtar sözcüðü giriniz. <input type="text" name="m" size=20 maxlength=20> </span>" alanýna yazýnýz. <br>
 	<b>Adým 2: </b>Hastayý aramaya baþlamak için <img <?php echo createLDImgSrc('../','searchlamp.gif','0') ?>> düðmesini týklayýnýz.<p> 
<ul>       	
 	<b>Uyarý: </b>Arama bir sonuç verir ise, bir liste görüntülenir. <p>
	</ul>
	<?php if(($x2=="")||($x2=="0")) : ?>
 	<b>Adým 3: </b>Laboratuvar raporunu  <?php if($x1=="edit") print "düzenlemek"; else print "görmek"; ?> istediðiniz hastanýn &nbsp;<button><img <?php echo createComIcon('../','update2.gif','0') ?>> <font size=1>Lab raporu</font></button> düðmesini týklayýnýz.<p> 
	<?php endif ?>
</ul>

<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý: </b></font> 
<ul>       	
 Ýptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düðmesini týklayýnýz.
</ul>
<?php endif ?>

<?php if($src=="arch") : ?>
	<?php if($x2=="1") : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý: Son kütük kayýdý (kayýtlarý) </b></font> 
<ul>  Arþive her girdiðinizde son kaydedilen ameliyatlar derhal görüntülenir.
</ul>
	<?php endif ?>
	<?php if(($x3=="")&&($x1!="0")) : ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Bu gün hiç ameliyat yapýlmadý. </b></font> 
<ul>       	
Seçenek kutusunu açmak için "Seçenekler" i týklayýnýz.<br>
Arama moduna geçmek için "Ara" yý týklayýnýz.</ul>
	
	<?php endif ?>
	



<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Bir baþka günün arþivli kütük bilgilerini görmek istiyorum.</b></font>
<ul> <b>Önceki günü göstermek için: </b>Sol üst sütundaki  "<span style="background-color:yellow" > Önceki gün </span>" baðlantýsýný týklayýnýz. 
				Ýstenilen gün görüntüleninceye kadar ne kadar gerekir ise o kadar týklayýnýz.<p>
 <b>Sonraki günü göstermek için: </b>Sað üsr sütundaki "<span style="background-color:yellow" > Sonraki gün </span>" baðlantýsýný týklayýnýz. 
				Ýstenilen gün görüntüleninceye kadar bu baðlantýya týklamaya devam ediniz.<br>		
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> 
<font color="#990000"><b>Bir baþka ameliyathane veya bölümün kütük bilgilerini görmek istiyorum.</b></font>
<ul> <b>Adým 1: </b>Seçenek kutusundan bölümü seçiniz <nobr>"<span style="background-color:yellow" > Bölüm veya ameliyathaneye geçiniz <select name="o">
                                                                                                                                         	<option > Örnek bölüm 1</option>
                                                                                                                                         	<option > Örnek bölüm 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>".</nobr> <br>Ön seçimli ameliyathane otomatik olarak
		düzenlenir.<br>																																		  
	<b>Adým 2: </b>Veya ameliyathaneyi seçim kutusundan seçiniz <nobr>"<span style="background-color:yellow" > <select name="o">
                                                                                                                                         	<option > Örnek ameliyathane 1</option>
                                                                                                                                         	<option > Örnek ameliyathane 2</option>
                                                                                                                                         </select>
                                                                                                                                          </span>".</nobr> <br> Ýlgili bölüm ameliyathaneleri
		otomatik olarak düzenlenir.<br>																																		  																																		  
		<b>Adým 3: </b>Yeni bölüm veya ameliyathaneye geçmek için  <input type="button" value="Deðiþtir">  düðmesini týklayýnýz.<br>
</ul>
<?php if(($x3!="")) : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Görüntülenen bir kütük belgesi nasýl düzenlenir veya güncellenir?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Düzenleme moduna geçmek için en sol sütundaki ameliyat tarihinin altýndaki  <img src="../img/update3.gif" border=0> düðmesini týklayýnýz.<br>
 	<b>Adým 2: </b>Düzenleme modunda iken belgeyi düzenlemede daha fazla yardýma gereksiniminiz olur ise "Yardým" düðmesini týklayýnýz.<p> 
	</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Hastanýn veri klasörü nasýl açýlýr?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Hasta numarasýnýn solundaki  <img src="../img/info2.gif" border=0> düðmesini týklayýnýz.<br>
 	<b>Adým 2: </b>Hastanýn veri klasörü açýlýr. Daha fazla bilgiye gereksiniminiz olur ise açýlan penceredeki "Yardým" düðmesini týklayýnýz.<p> 
	</ul>
	<?php endif ?>
	
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Ýptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düðmesini týklayýnýz.
</ul>


	<?php endif ?>

<?php if($src=="input") : ?>
	<?php if($x1=="main") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Sonuç deðerleri nasýl girilir?</b>
</font>
<ul>       	
		<?php if($x2=="") 
			print '
 			<b>Adým 1: </b>Küme numarasýný "<span style="background-color:yellow" > Küme no: </span>" alanýna giriniz.<br>	
 			<b>Adým 2: </b>Gerekir ise muayene tarihini "<span style="background-color:yellow" > Muayene tarihi </span>" alanýna giriniz.<br>	';
	
		?>

	
 	<b>Adým	<?php if($x2=="") 
			print "3"; else print "1";
		?>:</b> Deðerleri ilgili parametre alanlarýna giriniz.<br>	
 	<b>Adým <?php if($x2=="") 
			print "4"; else print "2";
		?>: </b> Deðerleri kayýt etmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz.<p> 
 	<b>Uyarý: </b>Deðerleri kaydettikten sonra kapatmak ister iseniz,<br>  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.<br> 
</ul>
	<?php endif ?>
<?php if($x1=="few") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yalnýzca birkaç deðer girmem gerekiyor! Nasýl yapýlýr?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Deðerleri illgili parametre alanlarýna giriniz.<br> 
 	<b>Adým 2: </b>Parametre deðerlerini kayýt etmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz.<p> 
 	<b>Uyarý: </b>Parametre deðerlerini girmeyi bitirdi iseniz ve kapatmak istiyor iseniz <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.<br> 
</ul>
	<?php endif ?>
	<?php if($x1=="param") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ýstediðim parametre görüntülenmiyor! Doðru parametre grubuna nasýl geçerim?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Doðru parametre grubunu <nobr>"<span style="background-color:yellow" > Parametre grubunu seçiniz <select name="s">
     <option value="Sample parameter"> Örnek parametre</option> </select> </span>"</nobr> seçim kutusundan seçiniz.<p> 
 	<b>Adým 2: </b>Seçilen parametre grubuna geçmek için <img <?php echo createLDImgSrc('../','auswahl2.gif','0') ?>> düðmesini týklayýnýz.<p> 
</ul>
	<?php endif ?>
	<?php if($x1=="save") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Deðerleri nasýl kayýt etmeliyim?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Parametre deðerlerini kayýt etmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz.<p> 
 	<b>Uyarý: </b>Deðerleri kaydettikten sonra kapatmak için,<br>  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.<br> 
</ul>
	<?php endif ?>
	<?php if($x1=="correct") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yanlýþ bir deðer kayýt ettim. Nasýl düzeltirim?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Doðru deðeri ilgili parametre alanýna giriniz.<br> 
 	<b>Adým 2: </b>Doðru deðeri kayýt etmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz.<p> 
 	<b>Uyarý: </b>Deðerleri kaydettikten sonra kapatmak için,<br>  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.<br>
</ul>
	<?php endif ?>
	<?php if($x1=="note") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir deðer yerine bir not girmek istiyorum. Nasýl yapýlýr?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Ýlgili parametre alanýna yalnýzca notu yazýnýz.<br> 
 	<b>Adým 2: </b>Notu kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz.<p> 
 	<b>Uyarý: </b>Kaydettikten sonra kapatmak için,<br>  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.<br>
</ul>
	<?php endif ?>
	<?php if($x1=="done") : ?>
	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ýþ bitti. Þimdi ne var?</b>
</font>
<ul>       	
 	<b>Adým 1: </b>Tüm deðerleri kayýt etmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düðmesini týklayýnýz.<p> 
 	<b>Uyarý: </b> <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düðmesini týklayýnýz.<br> 
</ul>
	<?php endif ?>
	

<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarý:</b></font> 
<ul>       	
 Ýptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düðmesini týklayýnýz.
</ul>
<?php endif ?>
</form>

