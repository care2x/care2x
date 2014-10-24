<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<a name="howto">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b><?php if($x1=="docs") print "Doktor orderları"; else print "Hemşire gözlemi"; ?></b></font>
<form action="#" >
<p><font size=2 face="verdana,arial" >

<?php if($src=="") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<?php if($x1=="docs") print "Doktor orderları"; else print "Hemşire gözlemi"; ?> nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b>"<?php if($x1=="docs") print "Doktor orderları"; else print "Hemşire gözlemi"; ?>" sütunundaki "<span style="background-color:yellow" > Tarih: <input type="text" name="d" size=10 maxlength=10 value="10.10.2002"> </span>" alanına tarihi giriniz.<br>
		<font color="#000099" size=1><b>İp uçları:</b>
		<ul type=disc>
		<li>Günün tarihini girmek için "t" veya "T" (today=bugün anlamında) giriniz. Günün tarihi otomatik olarak tarih alanında görünür
		<li>Veya alanın altındaki <img <?php echo createComIcon('../','arrow-t.gif','0') ?>> düğmesini tıklayınız. Günün tarihi otomatik olarak tarih alanında görüntülenir.
		<li>Dünkü tarihi girmek için tarih alanına "y" veya "Y"  (Dün=yesterday) anlamında giriniz. Dünkü tarih otomatik olarak tarih alanında görüntülenir.
		</font>
		</ul>
	<b>Adım 2:  </b>"<?php if($x1=="docs") print "Doktor orderları"; else print "Hemşire gözlemi"; ?>" sütunundaki "<span style="background-color:yellow" > Zaman: <input type="text" name="d" size=10 maxlength=10 value="10.35"> </span>" alanına zamanı giriniz.<br>
		<font color="#000099" size=1><b>İpucu:</b>
		<ul type=disc>
		<li>Zaman alanına güncel zamanı girmek için "n" neya "N" (Now=şimdi anlamında) giriniz. Güncel zaman otomatik olarak zaman alanında görüntülenir.
		<li>Veya zaman alanının altındaki  <img <?php echo createComIcon('../','arrow-t.gif','0') ?>> simgesini tıklayınız. Güncel zaman zaman alanında görüntülenir.
		</font>
		</ul>
	<b>Adım 3: </b><?php if($x1=="docs") print "Doktor orderlarını"; else print "Hemşire gözlemini"; ?>  "<span style="background-color:yellow" > <?php if($x1=="docs") print "Doktor orderları"; else print "Hemşire gözlemi"; ?>: <input type="text" name="d" size=10 maxlength=10 value="Tetkik raporu"> </span>" alanına yazınız.<br>
		<font color="#000099" size=1><b>İpucu:</b>
		<ul type=disc>
		<li>  Eğer <img <?php echo createComIcon('../','warn.gif','0') ?>>  sembolünün  <?php if($x1=="docs") print "doktor orderları"; else print "hemşire gözlem kağıdı"; ?> başında görünmesini ister iseniz "<span style="background-color:yellow" > <input type="checkbox" name="c" value="c"> <img <?php echo createComIcon('../','warn.gif','0') ?>> Bu işareti başlangıca koyunuz. </span>" kutusunu işaretleyiniz,.
		<li> <?php if($x1=="docs") print "order veya"; ?> raporu belirgin yazmak ister iseniz, sözcük veya cümleyi yazmadan önce  <img <?php echo createComIcon($root_path,'color_marker_yellow.gif','0','',TRUE) ?>><?php echo '<b><font color="#000000">Başla</b></font>' ?> simgesini tıklayınız. Belirgin yazıya son vermek için belirgin yazının son harfini yazdıktan sonra  <img <?php echo createComIcon($root_path,'color_marker_yellow.gif','0','',TRUE) ?>><?php echo '<b><font color="#000000">Bitir</b></font>' ?> simgesini tıklayınız.
		</font>
		</ul>
	<b>Adım 4: </b>Ad soyad ilk harflerinizi "<span style="background-color:yellow" > İmza: <input type="text" name="d" size=3 maxlength=3 value="AHK"> </span>" alanına giriniz.<br>
  		<b>Uyarı: </b>İptal etmek isterseniz,  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 5: </b>Bilgiyi kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> simgesini tıklayınız.<br>
		<b>Adım 6: </b>İşiniz bitti ise, pencereyi kapatıp hastanın veri klasörüne geri gitmek için <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> simgesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
<?php if($x1=="docs") print "Doktora bir soru"; else print "Bir etkinlik raporu"; ?> nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b>Tarihi "<?php if($x1=="docs") print "Doktora sorular"; else print "Etkinlik raporu"; ?>" sütunundaki "<span style="background-color:yellow" > Tarih: <input type="text" name="d" size=10 maxlength=10 value="10.10.2002"> </span>" alanına giriniz.<br>
		<font color="#000099" size=1><b>İp uçları:</b>
		<ul type=disc>
		<li>Güncel tarihi girmek için tarih alanına "t" veya "T" (Today=Bugün anlamında) yazınız. Güncel tarih otomatik olarak tarih alanında görüntülenir.
		<li>Veya alanın altındaki  <img <?php echo createComIcon('../','arrow-t.gif','0') ?>> düğmesini tıklayınız. Güncel tarih otomatik olarak tarih alanında görüntülenir.
		<li>Dünün tarihini girmek için tarih alanına "y" veya "Y" (Yesterday=dün anlamında) yazınız. Dünkü tarih otomatik olarak tarih alanında görüntülenir.
		</font>
		</ul>
	<b>Adım 2: </b><?php if($x1=="docs") print "Soruyu "; else print "Etkinlik raporunu "; ?>  "<span style="background-color:yellow" > <?php if($x1=="docs") print "doktora sorular"; else print "etkinlik raporu"; ?>: <input type="text" name="d" size=10 maxlength=10 value="test report"> </span>" alanına yazınız.<br>
		<font color="#000099" size=1><b>İp uçları:</b>
		<ul type=disc>
		<li> <img <?php echo createComIcon('../','warn.gif','0') ?>> sembolünün  <?php if($x1=="docs") print "soru"; else print "etkinlik raporu"; ?> yazısının başlangıcında görünmesini ister iseniz  "<span style="background-color:yellow" > <input type="checkbox" name="c" value="c"> <img <?php echo createComIcon('../','warn.gif','0') ?>> Bu işareti başlangıca koyunuz </span>" seçim kutusunu işaretleyiniz.
		<li> <?php if($x1=="docs") print "order veya"; ?> raporun bir kısmını belirgin yazmak ister iseniz, cümle veya sözcüğü yazmadan önce  <img <?php echo createComIcon($root_path,'color_marker_yellow.gif','0','',TRUE) ?>><?php echo '<b><font color="#000000">Başla</b></font>' ?> simgesini tıklayınız. Belirgin yazıya son vermek için belirgin yazının son harfini yazdıktan sonra  <img <?php echo createComIcon($root_path,'color_marker_yellow.gif','0','',TRUE) ?>><?php echo '<b><font color="#000000">Bitir</b></font>' ?> simgesini tıklayınız.
		</font>
		</ul>
	<b>Adım 3: </b>Ad soyadınızın ilk harflerini "<span style="background-color:yellow" > İmza: <input type="text" name="d" size=3 maxlength=3 value="AHK"> </span>" alanına giriniz.<br>
  		<b>Uyarı: </b>İptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> simgesini tıklayınız.<br>
		<b>Adım 4: </b>Bilgiyi kayıt etmek için  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> simgesini tıklayınız.<br>
		<b>Adım 5: </b>İşiniz bitti ise, pencereyi kapatıp hastanın veri klasörüne geri dönmek için  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> simgesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
UYARI:</b></font>
<ul> 
	Aynı zamanda  <?php if($x1=="docs") print "doktor orderları ve doktora soruları"; else print "hemşire gözlemi ve etkinlik raporunu"; ?> girebilirsiniz.</ul>

<?php endif ?>
<?php if($src=="diagnosis") : ?>
<a name="extra"><a name="diag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a></a>
Tanısal rapor nasıl görüntülenir?</b></font>
<ul> 
  		<b>Uyarı: </b>Eğer bir tanısal rapor var ise, sol sütunda oluşturulduğu tarih, oluşturan diagnostik klinik veya bölüm  kısa bir not halinde görüntülenir..<p>
  		<b>Uyarı: </b>Listedeki ilk rapor derhal görüntülenir.<p>
	<b>Adım 1: </b>Görüntülemek istediğiniz tanısal raporun kısa notunu tıklayınız.<br>	
</ul>
<?php endif ?>
<?php if($src=="kg_atg_etc") : ?>
<a name="pt"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Günlük fizik tedavi (PT), anti tromboz jimnastiği (Atg), vs. bilgisi nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b>Bilgiyi e<br> "<span style="background-color:yellow" > Lütfen yeni bilgiyi buraya giriniz: </span>" alanına giriniz.<br>
  		<b>Uyarı: </b>Gerekir ise güncel bilgileri "<span style="background-color:yellow" > Güncel bilgiler: </span>" alanında düzenleyebilirsiniz.<br>
  		<b>Uyarı: </b>İptal etmek ister iseniz,  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 2: </b>Bilgiyi kayıt etmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 3: </b>Herhangi bir yanlışı düzeltmek ister iseniz, yanlış bilgiyi tıklayınız, doğrusu ile değiştiriniz, tekrar kaydediniz.<br>
		<b>Adım 4: </b>İşiniz bitti ise, pencereyi kapatıp çizelgeye geri dönmek için  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		
</ul>
<?php endif ?>
<?php if($src=="fotos") : ?>
<a name="coag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Bir fotoğraf nasıl ön izlenir?</b></font>
<ul> 
	<b>Adım 1: </b>Sol çerçevedeki pul resime tıklayınız. Tam büyüklükteki resim sağ çerçevede çekim tarihi ve çekim numarası ile birlikte görüntülenir.<br>
</ul>
<?php endif ?>
<?php if($src=="anticoag_dailydose") : ?>
<a name="daycoag"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Günlük antikoagülan uygulama bilgisi nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b> <br> "<span style="background-color:yellow" > Yeni bilgiyi buraya giriniz veya güncel bilgiyi düzenleyiniz: </span>" alanına ya dozajı veya uygulama bilgisini yazınız.<br>
  		<b>Uyarı: </b>İptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 2: </b>Bilgiyi kayıt etmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 3: </b>Herhangi bir yanlış bilgiyi düzeltmek ister iseniz, yanlış bilgi üzerine tıklayınız, doğrusu ile değiştiriniz ve tekrar kayıt ediniz.<br>
		<b>Adım 4: </b>İşiniz bitti ise, pencereyi kapatıp çizelgeye geri dönmek için  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		
</ul>
<?php endif ?>
<?php if($src=="lot_mat_etc") : ?>
<a name="lot"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
İmplantlar, küme numarası, sipariş numaraları vs. notları nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b><br> "<span style="background-color:yellow" > Lütfen yeni bilgiyi buraya giriniz: </span>" alanına implantlar, küme, sipariş no bilgisini yazınız.<br>
  		<b>Uyarı: </b>Gerekir ise güncel bilgileri "<span style="background-color:yellow" > Güncel bilgiler: </span>" alanında düzenleyebilirsiniz.<br>
  		<b>Uyarı: </b>İptal etmek ister iseniz,  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 2: </b>Bilgiyi kayıt etmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 3: </b>Herhangi bir yanlış bilgiyi düzeltmek ister iseniz, yanlış bilgi üzerine tıklayınız, doğrusu ile değiştiriniz ve tekrar kayıt ediniz.<br>
		<b>Adım 4: </b>İşiniz bitti ise, pencereyi kapatıp çizelgeye geri dönmek için  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		
</ul>
<?php endif ?>
<?php if($src=="medication") : ?>
<a name="med"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
İlaç ve doz bilgisi nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b>İlacı sol sütuna yazınız.<br> 
	<b>Step 2: </b>Doz planını orta sütuna yazınız.<br> 
	<b>Adım 3: </b>Gerekli ise ilacın renk kodu seçme kutusunu tıklayınız.<br> 
	<ul type=disc>
		<li>Beyaz normal veya ön seçimli.
		<li><span style="background-color:#00ff00" >Yeşil</span> antibiyotikler ve türevleri için.
		<li><span style="background-color:yellow" >Sarı</span> diyaliz ilaçları için.
		<li><span style="background-color:#0099ff" >Mavi</span> hematolojik (koagülan ve antikoagülan) ilaçlar için.
		<li><span style="background-color:#ff0000" >Kırmızı</span> intravenöz uygulanan ilaçlar için.
	</ul>
  	<b>Uyarı: </b>Gerekir ise güncel bilgileri düzenleyebilirsiniz.<br>
	<b>Adım 4: </b>İsminizi "<span style="background-color:yellow" > Hemşire: </span>" alanına yazınız.<br> 
  		<b>Uyarı: </b>İptal etmek ister iseniz,  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 5: </b>İlaç tedavi planını kayıt etmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 6: </b>Herhangi bir yanlış bilgiyi düzeltmek ister iseniz, yanlış bilgi üzerine tıklayınız, doğrusu ile değiştiriniz ve tekrar kayıt ediniz.<br>
		<b>Adım 7: </b>İşiniz bitti ise, pencereyi kapatıp çizelgeye geri dönmek için  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		
</ul>
<?php endif ?>
<?php if($src=="medication_dailydose") : ?>
	<?php if($x2) : ?>

<a name="daymed"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Günlük ilaç uygulaması ve dozaj bilgisi nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b>Seçilen ilacın giriş alanını tıklayınız.<br>
	<b>Adım 2: </b>Alana ya dozajı, ya aplikatör bilgisini, veya başla/bitir işaretlerini yazınız.<br>
  		<b>Uyarı: </b>İptal etmek ister iseniz,  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 3: </b>Birkaç bilgi girecek iseniz, kayıt etmeden önce hepsini giriniz.<br>
		<b>Adım 4: </b>Bilgiyi kayıt etmek için  <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 5: </b>Herhangi bir yanlış bilgiyi düzeltmek ister iseniz, yanlış bilgi üzerine tıklayınız, doğrusu ile değiştiriniz ve tekrar kayıt ediniz.<br>
		<b>Adım 6: </b>İşiniz bitti ise, pencereyi kapatıp çizelgeye geri dönmek için  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		
</ul>
	<?php else : ?>
<a name="daymed"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
"Henüz ilaç yok." yazıyor. Ne yapmalıyım?</b></font>
<ul> 
		<b>Adım 1: </b>Pencereyi kapatıp çizelgeye geri dönmek için  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
	<b>Adım 2: </b> "<span style="background-color:yellow" > İlaç tedavisi </span>" yazısını tıklayınız.<br>
	<b>Adım 3: </b>İlaç tedavisi ve doz şemalarının giriş alanlarını içeren bir pencere açılır.<br>
	<b>Adım 4: </b>İlacı sol sütuna yazınız.<br> 
	<b>Adım 5: </b>Doz şemasını orta sütuna yazınız.<br> 
	<b>Adım 6: </b>Gerekir ise ilacın renk kodu seçme kutusunu tıklayınız.<br> 
	<ul type=disc>
		<li>Beyaz normal veya ön seçimli.
		<li><span style="background-color:#00ff00" >Yeşil</span> antibiyotikler ve türevleri için.
		<li><span style="background-color:yellow" >Sarı</span> diyaliz ilaçları için.
		<li><span style="background-color:#0099ff" >Mavi</span> hematolojik (koagülan ve antikoagülan) ilaçlar için.
		<li><span style="background-color:#ff0000" >Kırmızı</span> intravenöz uygulanan ilaçlar için.
	</ul>
  	<b>Uyarı: </b>Gerekir ise güncel bilgileri de <br>düzenleyebilirsiniz.<br>
	<b>Adım 7: </b>İsminizi "<span style="background-color:yellow" > Hemşire: </span>" alanına yazınız.<br> 
  		<b>Uyarı: </b>İptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 8: </b>Tedavi planını kaydetmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 9: </b>Herhangi bir yanlış bilgiyi düzeltmek ister iseniz, yanlış bilgi üzerine tıklayınız, doğrusu ile değiştiriniz ve tekrar kayıt ediniz.<br>
		<b>Adım 10: </b>İşiniz bitti ise, pencereyi kapatıp çizelgeye geri dönmek için  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
</ul>
	<?php endif ?>
<?php endif ?>
<?php if($src=="iv_needle") : ?>
<a name="iv"><img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b></a>
Günlük intravenöz ilaç uygulama ve dozaj bilgisi nasıl girilir?</b></font>
<ul> 
	<b>Adım 1: </b>  "<span style="background-color:yellow" > Yeni bilgiyi buraya giriniz veya güncel bilgiyi düzenleyiniz: </span>" alanına ya dozajı veya uygulama bilgisini yazınız.<br>
  		<b>Uyarı: </b>İptal etmek ister iseniz, <img <?php echo createLDImgSrc('../','cancel.gif','0') ?> align="absmiddle"> düğmesini tıklayınız.<br>
		<b>Adım 2: </b>Bilgiyi kayıt etmek için <img <?php echo createLDImgSrc('../','savedisc.gif','0') ?>> düğmesini tıklayınız.<br>
		<b>Adım 3: </b>Herhangi bir yanlış bilgiyi düzeltmek ister iseniz, yanlış bilgi üzerine tıklayınız, doğrusu ile değiştiriniz ve tekrar kayıt ediniz.<br>
		<b>Adım 4: </b>İşiniz bitti ise, pencereyi kapatıp çizelgeye geri dönmek için  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.<br>
		
</ul>

<?php endif ?>

</form>

