<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-9">
<font face="Verdana, Arial" size=3 color="#0000cc">
<b>
<?php
if($x2=="pharma") print "Eczane - "; else print "Tıbbi ambar - ";
	switch($src)
	{
	case "input": if($x1=="update") print "Bir ürünün bilgisini düzenlemek";
                          else print "Bilgi bankasına yeni ürün girmek";
					break;
	case "search": print "Bir ürün arama";
					break;
	case "mng": print "Bilgi bankasındaki ürünleri düzenlemek";
					break;
	case "delete": print "Bir ürünü bilgi bankasından silmek";
					break;
	}


 ?></b></font>
<p><font size=2 face="verana,arial" >
<form action="#" >

	

<?php if($src=="input") : ?>
	<?php if($x1=="") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bilgi bankasına yeni bir ürün nasıl girilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Önce ürün hakkındaki tüm bilgileri ilgili alanlara giriniz.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ürünün bir resmini seçmek istiyorum. Nasıl yapılır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>"<span style="background-color:yellow" > Resim dosyası </span>" alanı üzerindeki <input type="button" value="Araştır..."> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Bir dosya seçmek için küçük bir pencere açılır. İstediğiniz resmi seçip "Tamam" ı tıklayınız.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ürünün tüm bilgilerini girmeyi bitirdim. Nasıl kayıt ederim?</b>
</font>
<ul>       	
 	<b>Adım 1: </b><input type="button" value="Kaydet"> düğmesini tıklayınız.<br>
</ul>
	<?php endif ?>	
	<?php if($x1=="save") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Yeni bir ürün bilgi bankasına nasıl girilir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b><input type="button" value="Yeni ürün"> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Giriş formu görüntülenir.<br>
 	<b>Adım 3: </b>Yeni ürün hakkındaki bulunan tüm bilgileri giriniz.<br>
 	<b>Adım 4: </b>Bilgiyi kayıt etmek için <input type="button" value="Kaydet"> düğmesini tıklayınız.<br>
</ul>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Şu anda görüntülenen ürünün bilgisini düzenlemek istiyorum. Nasıl yaparım?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> <input type="button" value="Güncelle veya düzenle"> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Ürün bilgisi otomatik olarak düzenleme formuna girilir.<br>
 	<b>Adım 3: </b>Bilgiyi düzenleyiniz.<br>
 	<b>Adım 4: </b>Yeni bilgiyi kayıt etmek için <input type="button" value="Kaydet"> düğmesini tıklayınız.<br>
</ul>
	
	<?php endif ?>	
	<?php if($x1=="update") : ?>
	<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Halen görüntülenen ürünü düzenlemek istiyorum. Nasıl yapılır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Gerekir ise önce giriş alanından bulunan bilgiyi siliniz.<p>
 	<b>Adım 2: </b>Yeni bilgiyi uygun giriş alanına yazınız.<p>
 	<b>Adım 3: </b>Yeni bilgiyi kayıt etmek için  <input type="button" value="Kaydet"> düğmesini tıklayınız.<br>
</ul>
	<?php endif ?>	
<?php endif ?>	

<?php if($src=="search") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir ürün nasıl aranır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b><nobr><span style="background-color:yellow" >" Bir anahtar sözcük ara...: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> alanına malzemelerin marka ismi, jenerik isim, veya sipariş numarası vs. bilgilerinin ya tamamını vaya baştan birkaç harfini giriniz.<br>
 	<b>Adım 2: </b>Malzemeyi bulmak için  <input type="button" value="Ara"> düğmesini tıklayınız.<br>
 	<b>Adım 3: </b>Eğer arama anahtar sözcüğe tam uyan bir ürün bulur ise, malzemenin ayrıntılı bilgisi görüntülenir.<br>
 	<b>Adım 4: </b>Eğer arama anahtar sözcüğe yakın birkaç malzeme bulur ise bir ürün listesi görüntülenir.<br>
</ul>
	<?php if($x1!="multiple") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Birkaç ürün listelendi. Belirli bir malzemenin bilgisi nasıl görülür?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Ya <img <?php echo createComIcon('../','info3.gif','0') ?>> düğmesini veya malzemenin ismini tıklayınız.<br>
</ul>
	<?php endif ?>
	<?php if($x1=="multiple") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Önceki malzeme listesini görmek istiyorum. Nasıl yaparım?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> <input type="button" value="Geri git"> düğmesini tıklayınız.<br>
</ul>
	<?php endif ?>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 İptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.
</ul>

<?php endif ?>

<?php if($src=="mng") : ?>
	<?php if(($x3=="1")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ürün bilgisi nasıl düzenlenir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Yeni ürün bilgisini düzenleyiniz.<br>
 	<b>Adım 2: </b>Yeni bilgiyi kayıt etmek için  <input type="button" value="Kaydet"> düğmesini tıklayınız.<br>
</ul>
	<?php endif ?>

	<?php if($x1=="multiple") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Halen görüntülenen ürün bilgisi nasıl düzenlenir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b><input type="button" value="Güncelle veya düzenle"> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Ürün bilgisi otomatik olarak düzenleme formuna girilir.<br>
 	<b>Adım 3: </b>Bilgiyi düzenleyiniz.<br>
 	<b>Adım 4: </b>Yeni bilgiyi kayıt etmek için  <input type="button" value="Kaydet"> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Halen görüntülenen ürün nasıl silinir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> <input type="button" value="Bilgi bankasından sil"> düğmesini tıklayınız.<br>
 	<b>Adım 2: </b>Gerçekten bilgi bankasından silmeyi isteyip istemediğiniz sorulur<br>
 	<b>Adım 3: </b>Gerçekten ürün bilgisini silmek istiyor iseniz, <input type="button" value="Evet, kesinlikle eminim. Bilgiyi sil."> düğmesini tıklayınız.<p>
 	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> Bilginin silinmesi geri alınamaz.<br>
</ul>	
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ürün bilgisini silmek istemiyorum. Ne yapmalıyım?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> "<span style="background-color:yellow" > Hayır, silme. Geri git </span>" bağlantısını tıklayınız.<br>
</ul>	
<?php endif ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bilgi bankasındaki bir ürün nasıl düzenlenir?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Önce ürünü bulunuz. <nobr><span style="background-color:yellow" >" Aranacak anahtar sözcük: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> alanına ürünün marka ismi, jenerik isim, veya sipariş numarası bilgisinin tamamını veya birkaç harfini giriniz.<br>
 	<b>Adım 2: </b>Malzemeyi bulmak için <input type="button" value="Ara"> düğmesini tıklayınız.<br>
 	<b>Adım 3: </b>Arama anahtar sözcüğün tam karşılığı bir malzeme bulur ise, malzeme hakkında ayrıntılı bilgi görüntülenir. <br>
 	<b>Adım 4: </b>Arama anahtar sözcüğe yakın bir kaç malzeme bulur ise bir malzeme listesi görüntülenir.<br>
</ul>
	<?php if(($x1!="multiple")&&($x3=="")) : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Birkaç malzeme listelendi. Belirli bir malzemenin bilgisi nasıl görünür?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> Ya  <img <?php echo createComIcon('../','info3.gif','0') ?>> düğmesini veya malzemenin ismini tıklayınız.<br>
</ul>
	<?php endif ?>
	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 İptal etmeye karar verir iseniz <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.
</ul>
<?php endif ?>



<?php if($src=="delete") : ?>
<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ürünü bilgi bankasından silmek istiyorum. Ne yapmalıyım?</b>
</font>
<ul>       	
 	<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> Ürünün silinmesi işlemi geri alınamaz.<p>
 	<b>Adım 1: </b>Ürünü silmek istediğinizden emin iseniz,  <input type="button" value="Evet, kesinlikle eminim. Bilgiyi sil"> bağlantısını tıklayınız.<br>
</ul>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Ürün bilgisini silmek istemiyorum. Ne yapmalıyım?</b>
</font>
<ul>       	
 	<b>Adım 1: </b> "<span style="background-color:yellow" > Hayır, silme. Geri git </span>" bağlantısını tıklayınız.<br>
</ul>	

<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b></font> 
<ul>       	
 İptal etmeye karar verir iseniz  <img <?php echo createLDImgSrc('../','cancel.gif','0') ?>> düğmesini tıklayınız.
</ul>

<?php endif ?>	

<?php if($src=="report") : ?>

<img <?php echo createComIcon('../','frage.gif','0') ?>> <font color="#990000"><b>
Bir rapor nasıl yazılır?</b>
</font>
<ul>       	
 	<b>Adım 1: </b>Raporunuzu 
				<nobr><span style="background-color:yellow" >" Rapor: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> alanına yazınız.<br>
 	<b>Adım 2: </b>Adınızı
				<nobr><span style="background-color:yellow" >" Raporu yazan: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> alanına yazınız.<br>
 	<b>Adım 3: </b>Sicil numaranızı
				<nobr><span style="background-color:yellow" >" Sicil No: <input type="text" name="s" size=10 maxlength=10> "</span></nobr> alanına yazınız.<br>
 	<b>Adım 4: </b>Raporu göndermek için  <input type="button" value="Gönder"> düğmesini tıklayınız.<br>
</ul>
<img <?php echo createComIcon('../','warn.gif','0','absmiddle') ?>> <font color="#990000"><b> Uyarı:</b><br></font> 
       	
İptal etmeye karar verir iseniz  <img <?php echo createLDImgSrc('../','close2.gif','0') ?>> düğmesini tıklayınız.
</ul>
<?php endif ?>	

</form>

